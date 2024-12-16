<?php
session_start();
$logged = false;
if (!isset($_SESSION['logged'])) {
  $_SESSION['logged'] = false;
}

require_once('db_utils.php');

if (isset($_SESSION) && $_SESSION['logged']) {
  $conn = connectDB();
  if (!$conn)
    die();

  if (validateToken($conn)) {
    $sql = "SELECT anrede, name, nachname, username, email, rolle FROM users WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $logged = true;
    closeConnection($conn);
  } else {
    //user wird ausgeloggt, wenn der auth-token seine gültigkeit verliert
    header("Location: /HTML/logout.php");
  }
}
?>

<header id="header">
  <section id="logo">
    <h1 id="title">Göppel & Göppel Hotels</h1>
    <p id="jahrgang">seit 2024</p>
  </section>
  <?php include "user.php" ?>
</header>