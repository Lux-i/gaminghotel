<?php
if(!empty($_POST)){
    session_start();

    if ($_SESSION["logged"] == true) {
        require_once '../components/db_utils.php';
        $conn = connectDB();
        if (validateToken($conn)) {
            if($_POST["change_status"] == 1){
                $sql = "UPDATE bookings SET status = 'storniert' WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_POST["id"]);
            }elseif($_POST["change_status"] == 2){
                $sql = "UPDATE bookings SET status = 'bestätigt' WHERE id =?";
                $stmt = $conn->prepare($sql);
                echo $_POST["id"];
                $stmt->bind_param("i", $_POST["id"]);
            }
            if ($stmt->execute()) {
                closeConnection($conn);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            } else {
                closeConnection($conn);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }
        }
    }


}else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}
?>