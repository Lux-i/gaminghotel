<?php
if (!empty($_POST)) {
    session_start();

    if ($_SESSION["logged"] == true) {
        require_once '../components/db_utils.php';
        $conn = connectDB();
        if (validateToken($conn)) {

            //preisberechnung
            $prices = [
                'zimmer1' => 100,
                'zimmer2' => 130,
                'zimmer3' => 200,
                'Parkplatz' => 13,
                'Frühstück' => 18,
                'Haustiere' => 10
            ];
            $raum = $_POST["zimmer"];
            //preis für das Zimmer pro Tag
            $check_in = new DateTime($_POST["check_in"]);
            $check_out = new DateTime($_POST["check_out"]);
            if ($check_in >= $check_out) {
                closeConnection($conn);
                header('Location: buchen.php?error=Check-in datum nach oder gleich dem Abreise Datum');
                die();
            }
            $days = ($check_in->diff($check_out))->days;
            $price = $days * $prices[$raum];

            if (!empty($_POST['extras'])) {
                foreach ($_POST["extras"] as $extra) {
                    $price += $days * $prices[$extra];
                }
                $extras = implode(',', $_POST["extras"]);
            } else {
                $extras = NULL;
            }


            $sql = "INSERT INTO bookings (userid, start, end, extras, price, status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $status = "neu";

            $stmt->bind_param("isssis", $_SESSION["user_id"], $_POST["check_in"], $_POST["check_out"], $extras, $price,$status);

            if ($stmt->execute()) {
                closeConnection($conn);
                header('Location: meine_buchungen.php');
                die();
            } else {
                closeConnection($conn);
                header('Location: buchen.php?error=Ein Fehler ist aufgetreten!');
                die();
            }
        }
    }
} else {
    header('Location: buchen.php');
    die();
}