<?php
/**
 * creates a mysqli connection and returns it
 * @return mysqli
 */
function connectDB()
{
    //require_once('dbaccess.php');
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

function closeConnection($connection)
{
    $connection->close();
}

/**
 * validates the token of logged in user
 * 
 * uses the stored userid and token from the session and checks if stored token is valid for the user
 * @param mysqli $connection a mysqli connection instance
 * @return bool
 */
function validateToken($connection)
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

function hasToken($connection, $userid)
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
?>