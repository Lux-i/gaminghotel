<?php
session_start();
$logged = false;
//set logged to false if unset
if (!isset($_SESSION['logged'])) {
  $_SESSION['logged'] = false;
}

require_once('db_utils.php');

//only run if logged in
if ($_SESSION['logged']) {
  $conn = connectDB();
  //exit if connection failed
  if (!$conn)
    die();

  if (validateToken($conn)) {
    //load user data
    $sql = "SELECT anrede, name, nachname, username, email, rolle FROM users WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    //set user assoc array and update logged state
    $user = $result->fetch_assoc();
    $logged = true; //variable to use for code including this header
    closeConnection($conn);
  } else {
    //User gets logged out if the stored token is invalid
    header("Location: /HTML/logout.php");
    exit();
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