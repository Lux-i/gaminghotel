<?php
session_start();
if (isset($_POST)) {
    $_SESSION['anrede'] = !empty($_POST['gender']) ? $_POST['gender'] : $_SESSION['anrede'];
    $_SESSION['username'] = !empty($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
    $_SESSION['vorname'] = !empty($_POST['vorname']) ? $_POST['vorname'] : $_SESSION['vorname'];
    $_SESSION['nachname'] = !empty($_POST['nachname']) ? $_POST['nachname'] : $_SESSION['nachname'];
    $_SESSION['email'] = !empty($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
}
header('Location: me.php');
?>