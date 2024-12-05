<?php
session_start();
$logged = false;

if(isset($_SESSION) && isset($_SESSION['logged'])){
    $user = $_SESSION['user'];
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