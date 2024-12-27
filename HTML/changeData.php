<?php
include '../components/header.php';
require_once('../components/db_utils.php');

if (!empty($_POST)) {

    // Create connection
    $conn = connectDB();
    if (!$conn)
        die();

    if (!isset($_POST['pwd'])) {
        //update userdata, as no new pwd is set in POST

        $sql = "UPDATE users 
        SET anrede = ?, name = ?, nachname = ?, username = ?, email = ?
        WHERE id = ?";
        $stmt = $conn->prepare($sql);
        //n = new
        //if the POST-DATA of a specific field is empty, use the stored user data (update field with same value)
        //könnte optimiert werden, mit automatisch erstellten sql statements pro neuem datenset -> verringerung der DB load
        $n_anrede = (empty($_POST['anrede'])) ? $user['anrede'] : $_POST['anrede'];
        $n_username = (empty($_POST['username'])) ? $user['username'] : $_POST['username'];
        $n_vorname = (empty($_POST['vorname'])) ? $user['vorname'] : ucfirst($_POST['vorname']);
        $n_nachname = (empty($_POST['nachname'])) ? $user['nachname'] : ucfirst($_POST['nachname']);
        $n_email = (empty($_POST['email'])) ? $user['email'] : $_POST['email'];

        //allow admins to set a userid through get array
        $userid = isset($_GET['user']) && isPermitted($conn, Permission::ADMIN) ? $_GET['user'] : $_SESSION['user_id'];

        $stmt->bind_param("sssssi", $n_anrede, $n_vorname, $n_nachname, $n_username, $n_email, $userid);


    } else {
        //update the password, as pwd is set in POST

        if ($_POST['new_pwd'] == $_POST['new_pwd_again']) {
            //old pwd input with db pwd check
            $sql = "SELECT pwd FROM users WHERE id = ?;";
            $stmt = $conn->prepare($sql);

            //allow admins to set a userid through get array
            $userid = isset($_GET['user']) && isPermitted($conn, Permission::ADMIN) ? $_GET['user'] : $_SESSION['user_id'];

            $stmt->bind_param("s", $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            $pwd_hash = $result->fetch_assoc()['pwd'];

            if (password_verify($_POST['pwd'], $pwd_hash) || isPermitted($conn, Permission::ADMIN)) {
                //old pwd is correct, hash and store new password (or admin performing update)
                $n_pwd = password_hash($_POST['new_pwd'], PASSWORD_ARGON2ID);

                $sql = "UPDATE users SET pwd = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $n_pwd, $userid);
            } else {
                closeConnection($conn);
                header('Location: change_pwd.php?error=Altes passwort falsch!');
                die();
            }

        } else {
            closeConnection($conn);
            header('Location: change_pwd.php?error=Die neuen Passwörter stimmen nicht überein!');
            die();
        }
    }

    if ($stmt->execute()) {
        echo '<div class="alert alert-success mt-3 center-txt w-25">Update successful!</div>';
    } else {
        echo '<div class="alert alert-danger mt-3 center-txt w-25" role="alert">Error: ' . $stmt->error . '</div>';
    }

    if (isset($_GET['user']) && isPermitted($conn, Permission::ADMIN)) {
        header('Location: users.php');
        closeConnection($conn);
        die();
    }

    closeConnection($conn);
}

header('Location: me.php');
