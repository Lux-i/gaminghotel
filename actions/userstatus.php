<?php
if (isset($_GET['user']) && isset($_GET['status'])) {
    session_start();
    require_once('../components/db_utils.php');
    $conn = connectDB();
    if (validateToken($conn)) {
        if (isPermitted($conn, Permission::ADMIN)) {
            $sql = "UPDATE users SET status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $_GET['status'], $_GET["user"]);
            $stmt->execute();
            header('Location: /HTML/users.php');
            closeConnection($conn);
            die();
        }
    }
}
?>