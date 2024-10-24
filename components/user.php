<?php
    $username = "Log in";

    if(isset($_COOKIE["login_token"])) {
        $login = curl_init();

        curl_setopt($login, CURLOPT_URL, "https://tomatenbot.com/api/gaminghotel/login");
        curl_setopt($login, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "token: " . $_COOKIE["login_token"]));
        curl_setopt($login, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($login, CURLOPT_HEADER, false);
    
        $user_data = curl_exec($login);
        $user = json_decode($user_data, false);
        if(isset($user->username)){
            $username = $user->username;
        }
    
        curl_close($login);
    }
?>

<section class="login">
  <img
    class="h-50 img-fluid"
    src="/Public/Images/user-128.svg"
    alt="Login Icon" />
  <a class="navlink" href="/HTML/login.php"><?php echo $username?></a>
</section>