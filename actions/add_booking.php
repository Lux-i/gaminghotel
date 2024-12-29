<?php
if (!empty($_POST)) {
    session_start();

    if ($_SESSION["logged"] == true) {
        require_once '../components/db_utils.php';
        require_once 'room_sys.php';
        $conn = connectDB();
        if (validateToken($conn)) {

            //price calculation
            $prices = [
                'single' => 100,
                'duo' => 170,
                'squad' => 400,
                'Parkplatz' => 13,
                'Frühstück' => 18,
                'Haustiere' => 10
            ];
            $raum = $_POST["zimmer"];
            //check if the booking duration is valid
            $check_in = new DateTime($_POST["check_in"]);
            $check_out = new DateTime($_POST["check_out"]);
            if ($check_in >= $check_out) {
                closeConnection($conn);
                header('Location: /HTML/buchen.php?error=Check-in datum nach oder gleich dem Abreise Datum');
                die();
            }
            //price for the room per day
            $days = ($check_in->diff($check_out))->days;
            $price = $days * $prices[$raum];

            //add the price of the extras selected to the price for the booking
            if (!empty($_POST['extras'])) {
                foreach ($_POST["extras"] as $extra) {
                    $price += $days * $prices[$extra];
                }
                $extras = implode(',', $_POST["extras"]);
            } else {
                //store NULL in the db extras string, if none have been selected
                $extras = NULL;
            }

            //retrieve a suitable and available room
            $room = getRoom($conn, $_POST['zimmer'], $_POST['check_in'], $_POST['check_out']);

            if ($room == 0) {
                //no suitable room found
                closeConnection($conn);
                header('Location: /HTML/buchen.php?error=Es ist kein ' . $_POST['zimmer'] . ' Raum für ihren gewählten Zeitraum verfügbar');
                die();
            }

            //add booking entry into db
            $sql = "INSERT INTO bookings (userid, start, end, extras, price, status, roomid) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $status = "neu";

            $stmt->bind_param("isssisi", $_SESSION["user_id"], $_POST["check_in"], $_POST["check_out"], $extras, $price, $status, $room);

            if ($stmt->execute()) {
                closeConnection($conn);
                header('Location: /HTML/meine_buchungen.php');
                die();
            } else {
                closeConnection($conn);
                header('Location: /HTML/buchen.php?error=Ein Fehler ist aufgetreten!');
                die();
            }
        }
    }
} else {
    header('Location: /HTML/buchen.php');
    die();
}