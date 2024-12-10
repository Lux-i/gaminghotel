<?php
session_start();
if (isset($_POST)) {
    if(!empty($_POST['pwd'])){
        if($_POST['pwd'] == $_SESSION['pwd'] && $_POST['new_pwd'] == $_POST['new_pwd_again']){
            /*
                pw needs to be hashed again and a update sql statement needs to be executed
            */
        } else {
            header('Location: change_pwd.php?error=wrong input');
            die();
        }
    }
}

require_once('../components/db_utils.php');

// Create connection
$conn = connectDB();
if(!$conn) die();

if(!empty($_POST)){
    /*
        sql statement uses id, which isn't stored
        either store the id for now or wait till the token auth system is finished
    */
    $sql = "UPDATE users 
            SET anrede = ?, name = ?, nachname = ?, username = ?, email = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    //n = new
    $n_anrede = $_POST['anrede'];
    $n_username = $_POST['username'];
    $n_vorname = ucfirst($_POST['vorname']);
    $n_nachname = ucfirst($_POST['nachname']);
    $n_email = $_POST['email'];
    $n_pwd = password_hash($_POST['pwd'], PASSWORD_ARGON2ID);

    $stmt->bind_param("sssssi", /*fill user data*/);

    if ($stmt->execute()) {
      echo '<div class="alert alert-success mt-3 center-txt w-25">New record created successfully!</div>';
    } else {
      echo '<div class="alert alert-danger mt-3 center-txt w-25" role="alert">Error: ' . $stmt->error . '</div>';
    }

    $conn->close();
}

header('Location: me.php');
?>