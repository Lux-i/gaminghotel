<?php
    function connectDB() {
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

    function closeConnection($connection) {
        $connection->close();
    }

    function validateToken($connection){
        $userid = $_SESSION['user_id'];
        $auth_token = $_SESSION['auth_token'];
        //echo "<br>VALIDATOR: Using userid: " . $userid;
        //echo "<br>VALIDATOR: Using token: ". $auth_token;
        $sql = "SELECT tokenhash FROM userauth
                WHERE userid = ? AND token_expires > NOW()";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $userid);
        //echo "<br>VALIDATOR: Executing validation statement";
        if($stmt->execute()){
            //echo "<br>VALIDATOR: Validation statement executed successfully";
            $result = $stmt->get_result();
            $tokenhash = $result->fetch_assoc()['tokenhash'];
            if(password_verify($auth_token, $tokenhash)){
                //echo "<br>VALIDATOR: Valid token";
                return true;
            } else {
                //echo "<br>VALIDATOR: Invalid token";
                return  false;
            }
        } else {
            //echo "<br>VALIDATOR: Error executing validation statement: ". $stmt->error;
            return false;
        }
    }

    function hasToken($connection, $userid) {
        $sql = "SELECT userid FROM userauth WHERE userid = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $userid);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return true;
            } else {
                return false;
            }
        } else return false;
    }
?>