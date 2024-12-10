<?php
include '../components/header.php';
require_once('../components/db_utils.php');

if(!empty($_POST)){

    // Create connection
    $conn = connectDB();
    if(!$conn) die();

    if(!isset($_POST['pwd'])){
        //pwd feld nicht im POST, userdata update durchführen

        $sql = "UPDATE users 
        SET anrede = ?, name = ?, nachname = ?, username = ?, email = ?
        WHERE id = ?";
        $stmt = $conn->prepare($sql);
        //n = new
        //wenn die POST-DATA leer ist, benutze user data (mit gleichen daten updaten)
        //könnte optimiert werden, mit automatisch erstellten sql statements pro neuem datenset -> verringerung der DB load
        $n_anrede = (empty($_POST['anrede'])) ? $user['anrede'] : $_POST['anrede'];
        $n_username = (empty($_POST['username'])) ? $user['username'] : $_POST['username'];
        $n_vorname = (empty($_POST['vorname'])) ? $user['vorname'] : ucfirst($_POST['vorname']);
        $n_nachname = (empty($_POST['nachname'])) ? $user['nachname'] : ucfirst($_POST['nachname']);
        $n_email = (empty($_POST['email'])) ? $user['email'] : $_POST['email'];

        $stmt->bind_param("sssssi", $n_anrede, $n_vorname, $n_nachname, $n_username, $n_email, $_SESSION['user_id']);

        
    } else {
        //pwd feld im POST, pwd update durchführen

        if($_POST['new_pwd'] == $_POST['new_pwd_again']){
            //old pwd input with db pwd check
            $sql = "SELECT pwd FROM users WHERE id = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $pwd_hash = $result->fetch_assoc()['pwd'];

            if(password_verify($_POST['pwd'], $pwd_hash)){
                $n_pwd = password_hash($_POST['new_pwd'], PASSWORD_ARGON2ID);

                $sql = "UPDATE users SET pwd = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $n_pwd, $_SESSION['user_id']);
            } else {
                header('Location: change_pwd.php?error=Altes passwort falsch!');
            die();
            }

        } else {
            header('Location: change_pwd.php?error=Die neuen Passwörter stimmen nicht überein!');
            die();
        }     
    }

    if ($stmt->execute()) {
        echo '<div class="alert alert-success mt-3 center-txt w-25">Update successful!</div>';
    } else {
        echo '<div class="alert alert-danger mt-3 center-txt w-25" role="alert">Error: ' . $stmt->error . '</div>';
    }

    $conn->close();
}

header('Location: me.php');
?>