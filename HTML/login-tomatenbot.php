<?php
//LOGIN


  if(!empty($_POST)) {
    error_log("Form submitted. Data: " . print_r($_POST, true));
    $email = $_POST['username'];
    $password = $_POST['pwd'];
  
    $data = array(
      "username" => $email,
      "password" => $password
    );
    $json_data = json_encode($data);
  
    $login = curl_init("https://tomatenbot.com/api/gaminghotel/login");
    curl_setopt($login, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($login, CURLOPT_POST, true);
    curl_setopt($login, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($login, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
    $response = curl_exec($login);
    $res_data = json_decode($response, false);
    if ($res_data === false) {
      echo 'Curl error: ' . curl_error($login);
    } else {
      if($res_data->ok === true){
        setcookie("loginToken", $res_data->token, time() + 60 * 60 * 24 * 3, "/", "localhost");
        curl_close($login);
        header("Location: /index.php");
        exit();
      }
    }

    error_log(print_r($res_data, true));

    curl_close($login);
  }

//REGISTER
if(!empty($_POST)) {
    error_log("Form submitted. Data: " . print_r($_POST, true));
    $anrede = $_POST['anrede'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $password_confirm = $_POST['pwd_confirm'];
  
    if ($password !== $password_confirm) {
      echo "Password nicht gleich";
      exit();
    }
  
    $data = array(
      "gender" => $anrede,
      "first_name" => $vorname,
      "last_name" => $nachname,
      "email" => $email,
      "username" => $username,
      "password" => $password
    );
    $json_data = json_encode($data);
  
    $register = curl_init("https://tomatenbot.com/api/gaminghotel/register");
    curl_setopt($register, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($register, CURLOPT_POST, true);
    curl_setopt($register, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($register, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
    $response = curl_exec($register);
    $res_data = json_decode($response, false);
    if ($res_data === false) {
      echo 'Curl error: ' . curl_error($register);
    } else {
      if($res_data->ok === true){
        setcookie("loginToken", $res_data->token, time() + 60 * 60 * 24 * 3, "/", "localhost");
        curl_close($register);
        header("Location: /HTML/me.php");
        exit();
      } else if($res_data->ok === false){
        $err_msg = $res_data->message;
      }
    }

    error_log(print_r($response, true));

    curl_close($register);
  }

//user.php
$username = "Log in";
    $link = "login.php";

    if(isset($_COOKIE["loginToken"])) {
        $getData = curl_init();

        $data = array(
          "token" => $_COOKIE["loginToken"]
        );
        $json_data = json_encode($data);
      
        $getData = curl_init("https://tomatenbot.com/api/gaminghotel/getUser");
        curl_setopt($getData, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($getData, CURLOPT_POST, true);
        curl_setopt($getData, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($getData, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        $user_data = curl_exec($getData);
        
        $user = json_decode($user_data, false);
        if(isset($user->username)){
            $username = $user->username;
            $link = "me.php";
        }
    
        curl_close($getData);
    }

//PASSWORD RESET

/*<section class="data-splitter">
                <button id="resetButton" class="button-cream border-none" onclick="showReset()">
                  Reset Password
                </button>
                <?php
                  include(__DIR__ . '/../components/reset_pw.php');
                ?>
</section>

<script src="../JS/me.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>

?>
*/