<?php

$log = "Log in";
$link = "login";

if (isset($user) && $logged == true) {
  $log = $user['username'];
  $link = "me";
}
?>

<section class="login">
  <img class="h-50 img-fluid" src="/Public/Images/user-128.svg" alt="Login Icon" />
  <a class="navlink" href="/<?php echo $link ?>"><?php echo $log ?></a>
</section>