<?php
session_start();
$logged = $_SESSION['logged'];
$_SESSION['logged'] = false;
/*session_destroy();
session_write_close();*/
header('Location: login.php');
die;
?>
