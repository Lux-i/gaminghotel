<?php

require_once('../components/dbaccess.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST)) {
    if ($_POST['pwd'] !== $_POST['pwd_confirm']) {
        header('Location: /HTML/register.php?error=Passwort ist nicht gleich');
        die();
    } else {
        $sql = "INSERT INTO users (anrede, name, nachname, username, email, pwd, rolle)
            VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);

        $anrede = $_POST['anrede'];
        $username = $_POST['username'];
        $vorname = ucfirst($_POST['vorname']);
        $nachname = ucfirst($_POST['nachname']);
        $email = $_POST['email'];
        $pwd = password_hash($_POST['pwd'], PASSWORD_ARGON2ID);
        $rolle = "user";

        $stmt->bind_param("sssssss", $anrede, $vorname, $nachname, $username, $email, $pwd, $rolle);

        if (!$stmt->execute()) {
            header("Location: /HTML/register.php?error=" . $stmt->$error);
            die();
        }

        $conn->close();

        header('Location: /HTML/login.php');
    }
} else {
    header('Location: /HTML/register.php');
}
?>