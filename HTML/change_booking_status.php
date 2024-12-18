<?php
if (!empty($_POST)) {
    session_start();

    if ($_SESSION["logged"] == true) {
        require_once '../components/db_utils.php';
        $conn = connectDB();
        if (validateToken($conn)) {
            //USER PERMISSION CHECK
            if(isPermitted($conn, Permission::ADMIN)){
                switch($_POST['change_status']){
                    case 1:
                        $sql = "UPDATE bookings SET status = 'storniert' WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_POST["id"]);
                        break;
                    case 2:
                        $sql = "UPDATE bookings SET status = 'bestätigt' WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_POST["id"]);
                }

            } elseif(isPermitted($conn, Permission::USER)){
                if($_POST['change_status'] == 1){
                    $sql = "UPDATE bookings SET status = 'storniert' WHERE id = ? AND userid = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $_POST["id"], $_SESSION['user_id']);
                }
            }

            //fehler case wenn user den change-status zu einem (für sie) ungültigen wert verändern
            if(empty($stmt)){
                closeConnection($conn);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }
            
            if ($stmt->execute()) {
                closeConnection($conn);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            } else {
                closeConnection($conn);
                //error hinzufügen? sonnst if unnötig
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }
        }
    }


} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}
?>