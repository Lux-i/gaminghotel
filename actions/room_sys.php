<?php

//system to return a fitting room for a booking
//based on availability and a weigt algo prioritizing a balanced spread between rooms

/**
 * get all available rooms of the given type for the given date range
 * utility file for getRoom
 * @param string $type - the type of room to look for (e.g., 'single', 'duo', 'squad');
 * @param string $start - the starting date of the requested booking
 * @param string $end - the ending date of the requested booking
 * @return array all rooms that match given criteria
 */
function getRooms($conn, $type, $start, $end)
{

    require_once '../components/db_utils.php';
    $rooms = [];

    //the ORDER BY in the sql query handles the sorting by weight
    //the HAVING NOT EXISTS rules out all rooms with overlapping bookings
    //while the main query counts all bookings a room as, which is the (initial) weight
    $sql = "SELECT r.id AS roomid, COUNT(b.id) AS weight FROM rooms r
            LEFT JOIN bookings b ON r.id = b.roomid
                AND (b.end < ? OR b.start > ?)
                AND NOT b.status = 'storniert'
            WHERE r.type = ?
            GROUP BY r.id
            HAVING NOT EXISTS (
                SELECT 1
                FROM bookings b_overlap
                WHERE  b_overlap.roomid = r.id
                    AND b_overlap.start <= ? 
                    AND b_overlap.end >= ?
                    AND NOT b_overlap.status = 'storniert'
            )
            ORDER BY weight ASC, roomid ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $start, $end, $type, $end, $start);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $step = 0;
        while ($row = $result->fetch_assoc()) {
            $rooms[$step++] = $row;
        }
    }
    //rooms is always returned
    //getRoom will check if the array is empty and return id 0 (invalid), for the add_booking process to fail

    return $rooms;
}

/**
 * returns the most suitable room for a booking
 * @param string $type - the type of room to look for (e.g., 'single', 'duo', 'squad');
 * @param string $start - the starting date of the requested booking
 * @param string $end - the ending date of the requested booking
 * @return int the id of the most suitable room
 */
function getRoom($conn, $type, $start, $end)
{
    require_once '../components/db_utils.php';

    //getting all available rooms already sorted
    $rooms = getRooms($conn, $type, $start, $end);
    //if no suitable room found, return an empty room id
    if (empty($rooms)) {
        return 0;
    }

    //the weight returned by the sql query is only the count of bookings on that room
    //we will now calculate an extra weight factor onto each room depending on how far these bookings are away
    if ($rooms[0]["weight"] == 0) {
        //if a room has 0 weight (0 bookings) just assign (return) this room and skip the process below
        return $rooms[0]["roomid"];
    }
    foreach ($rooms as &$room) {
        //get all bookings for exactly this room (if any)
        $sql = "SELECT start, end FROM bookings
                WHERE roomid = ? AND NOT status = 'storniert'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room["roomid"]);
        //if this if statement fails, no wrong value is returned, but all rooms where execution might fail just won't be adjusted in weight
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            //calulate factor
            //the factor is based on how many days away the closest booking is
            //the more days away, the smaller the weight gain
            $closestDays = 0;

            //while loop to determine the least amount of days another booking will be away
            while ($row = $result->fetch_assoc()) {
                //dates of each booking for this room
                $bStart = new DateTime($row["start"]);
                $bEnd = new DateTime($row["end"]);
                //dates of the current booking to add
                $cStart = new DateTime($start);
                $cEnd = new DateTime($end);

                if ($bStart > $cStart) {
                    //already existing booking starts after the current new one ends
                    $difference = $cEnd->diff($bStart)->days;
                } else {
                    //already existing booking ends before the current new one start
                    $difference = $bEnd->diff($cStart)->days;
                }
                //only update closest days when the new difference is lower (eg. the booking is closer)
                $closestDays = $difference;
            }

            //weight stays the same when the nearest booking is 5 days away
            //if a booking is closer than that the weight gets punished (higher) else lower
            $factor = 0.2 * $closestDays;
            $newWeight = $room['weight'] / $factor;

            //apply the newWeight to the room weight
            $room["weight"] = $newWeight;
        }
    }

    //delete reference ("pointer") $room;
    unset($room);

    //after all rooms got their weight adjusted, resort $rooms array
    //sorting with the spaceship operator (a < b = -1, a == b = 0, a > b = 1)
    usort($rooms, function ($a, $b) {
        return $a["weight"] <=> $b["weight"];
    });

    return $rooms[0]["roomid"];
}

?>