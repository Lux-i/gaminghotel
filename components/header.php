<?php
  session_start();
  $logged = false;
  if(!isset($_SESSION['logged'])){
    $_SESSION['logged'] = false;
  }

  require_once('db_utils.php');

  if(isset($_SESSION) && $_SESSION['logged']){
    $conn = connectDB();
    if(!$conn) die();
    
    //echo "<br>VALIDATING...";
    if(validateToken($conn)){
      $sql = "SELECT anrede, name, nachname, username, email, rolle FROM users WHERE id = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_SESSION['user_id']);
      $stmt->execute();
      //echo "<br>EXECUTED USERDATA STATEMENT";
      $result = $stmt->get_result();
      //echo "<br>RESULT : ";
      //print_r($result);
      $user = $result->fetch_assoc();
      //echo "<br>USER : ";
      //print_r($user);
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