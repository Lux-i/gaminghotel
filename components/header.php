<?php
session_start();
$logged = false;

if(isset($_SESSION) && isset($_SESSION['logged'])){
    $anrede = $_SESSION['anrede'];
    $username = $_SESSION['username'];
    $vorname = $_SESSION['vorname'];
    $nachname = $_SESSION['nachname'];
    $email = $_SESSION['email'];  
    $password = $_SESSION['pwd'];
    $password_confirm = $_SESSION['pwd_confirm'];
    $logged = $_SESSION['logged'];
}
?>

<header id="header">
  <section id="logo">
    <h1 id="title">Göppel & Göppel Hotels</h1>
    <p id="jahrgang">seit 2024</p>
  </section>
  <?php include "user.php" ?>
</header>