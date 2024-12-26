<?php
//A DATABASE UTILITY FILE.

//STANDARD DB UTILITY

/**
 * creates a mysqli connection and returns it
 * @return mysqli a mysqli connection instance
 */
function connectDB()
{
    //require_once('dbaccess.php');
    //because this script is called from various file paths, dbaccess is currently hard-coded into this utility file
    //a process calculating the needed path could be incorporated
    $servername = "localhost";
    $username = "gaminghotel";
    $password = "!*K8FdmqAe}#ZMb";
    $dbname = "gaminghotel";

    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

/**
 * closes a mysqli connection
 * 
 * attempting to close an already closed connection should be safe
 * 
 * @param mysqli $connection a mysqli connection instance
 */
function closeConnection(mysqli $connection)
{
    $connection->close();
}

//TOKEN UTILITY

/**
 * validates the token of logged in user
 * 
 * uses the stored userid and token from the session and checks if stored token is valid for the user
 * @param mysqli $connection a mysqli connection instance
 * @return bool
 */
function validateToken(mysqli $connection)
{
    $userid = $_SESSION['user_id'];
    $auth_token = $_SESSION['auth_token'];

    $sql = "SELECT tokenhash FROM userauth
            WHERE userid = ? AND token_expires > NOW()";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $userid);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $tokenhash = $result->fetch_assoc()['tokenhash'];
        if (password_verify($auth_token, $tokenhash)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Checks if a certain user has a token in the db
 * @param mysqli $connection a mysqli connection instance
 * @param int $userid
 * @return bool
 */
function hasToken(mysqli $connection, $userid)
{
    $sql = "SELECT userid FROM userauth WHERE userid = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $userid);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    } else
        return false;
}

//USER PERMISSION UTILITY

enum Permission //Permission Levels
{
    case USER;
    case ADMIN;
}

/**
 * Checks if the logged in user has a certain permission
 * 
 * Also works if the user variable is not set (eg. the header is not loaded), as it performs a check against the db
 * 
 * @param mysqli $connection a mysqli connection instance
 * @param Permission $permission permission level enum to check against
 * @return bool
 */
function isPermitted(mysqli $connection, Permission $permission)
{
    $sql = "SELECT rolle FROM users WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user_id']);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user_role = $result->fetch_assoc()['rolle'];
        $user_permission = match ($user_role) {
            "user" => Permission::USER,
            "admin" => Permission::ADMIN
        };
        if ($permission == $user_permission) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }

}
?>