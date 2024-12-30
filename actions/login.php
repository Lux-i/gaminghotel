<?php
//login workflow for the login page

session_start();

require_once('../components/db_utils.php');

$conn = connectDB();
//exit if connection failed
if (!$conn) {
    header("Location: /HTML/login.php?error=Wir konnten keine Verbindung zu unserer Datenbank herstellen. Bitte versuche es später noch einmal.");
    closeConnection($conn);
    die();
}

//PWD-AUTH
if (isset($_POST['username']) && isset($_POST['pwd'])) {
    $sql = "SELECT pwd, id FROM users WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        //don't disclose if the passwort or username is incorrect
        //this ensures that potential attackers can not check if a ceratin username has a account (normally done with emails)
        //see holehe: https://github.com/megadose/holehe
        //this obscures if a password is incorrect or the username is simply not existent to a potential attacker
        header("Location: /HTML/login.php?error=Benutzername oder Passwort falsch");
        closeConnection($conn);
        die();
    } else {
        $row = $result->fetch_assoc();
        $pwd_hash = $row['pwd'];
        $userid = $row['id'];
        if (password_verify($_POST['pwd'], $pwd_hash)) {
            //TOKEN CREATION
            //tokens only work together with the right userid

            //randomly generated token is created using random_bytes() and converted to a hex representation
            $token = bin2hex(random_bytes(32));
            //hash the token to store in the database
            $tokenhash = password_hash($token, PASSWORD_ARGON2ID);
            //token expires in 1 week from the moment the token is generated
            $expire_date = date('Y-m-d H:i:s', strtotime("+1 week"));
            if (!hasToken($conn, $userid)) {
                //user has no token stored in the db, a new one is created
                $sql = "INSERT INTO userauth (userid, tokenhash, token_expires) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $userid, $tokenhash, $expire_date);
            } else {
                //user has an active token, this token will be overwritten
                $sql = "UPDATE userauth SET tokenhash = ?, token_expires = ? WHERE userid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $tokenhash, $expire_date, $userid);
            }
            if ($stmt->execute()) {
                //set session variables for authentication
                $_SESSION['auth_token'] = $token;
                $_SESSION['user_id'] = $userid;
                //set the user to be logged in in the session
                $_SESSION['logged'] = true;
                //redirect to the account page
                header("Location: /HTML/me.php");
                closeConnection($conn);
                die();
            } else {
                header("Location: /HTML/login.php?error=Fehler bei der Tokengenerierung");
                closeConnection($conn);
                die();
            }
        } else {
            header("Location: /HTML/login.php?error=Benutzername oder Passwort falsch");
            closeConnection($conn);
            die();
        }
    }
} else {
    header("Location: /HTML/login.php?error=Nutzername oder Passwort fehlen");
    closeConnection($conn);
    die();
}
?>