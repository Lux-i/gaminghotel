<?php
    
    $log = "Log in";
    $link = "login.php";

    if(isset($username) && $logged == true){
      $log = $username;
      $link = "me.php";
    }
?>

<section class="login">
  <img
    class="h-50 img-fluid"
    src="/Public/Images/user-128.svg"
    alt="Login Icon" />
  <a class="navlink" href="/HTML/<?php echo $link?>"><?php echo $log?></a>
</section>