<?php
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
?>

<section class="login">
  <img
    class="h-50 img-fluid"
    src="/Public/Images/user-128.svg"
    alt="Login Icon" />
  <a class="navlink" href="/HTML/<?php echo $link?>"><?php echo $username?></a>
</section>