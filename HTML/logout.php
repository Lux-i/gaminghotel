<?php
session_start();
$_SESSION['logged'] = false;
$logged = $_SESSION['logged'];
session_destroy();
session_write_close();
header('Location: login.php');
die;
?>
