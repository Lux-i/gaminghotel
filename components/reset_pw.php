<!-- Password reset api handling -->
<?php
  if(!empty($_POST)) {
    error_log("Form submitted. Data: " . print_r($_POST, true));
    $password = $_POST['new_pwd'];
    $password_confirm = $_POST['new_pwd_r'];

    if ($password !== $password_confirm) {
      echo "Password nicht gleich";
      exit();
    }
  
    $data = array(
      "paddword" => $password
    );
    $json_data = json_encode($data);
  
    $reset = curl_init("https://tomatenbot.com/api/gaminghotel/passwordreset");
    curl_setopt($reset, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($reset, CURLOPT_POST, true);
    curl_setopt($reset, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($reset, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
    $response = curl_exec($reset);
    $res_data = json_decode($response, false);
    if ($res_data === false) {
      echo 'Curl error: ' . curl_error($reset);
    } else {
      if($res_data->ok === true){
        setcookie("loginToken", $res_data->token, time() + 60 * 60 * 24 * 3, "/", "localhost");
        curl_close($reset);
        header("Location: /index.php");
        exit();
      }
    }

    error_log(print_r($res_data, true));

    curl_close($reset);
  }
?>

<section id="resetSection" class="flex-column form-container" hidden>
  <form class="flex-column" method="POST">
  <section class="input_group container form-floating">
      <input
        class="inputfield container-md form-control"
        type="password"
        name="new_pwd"
        required
        aria-label="Neues Passwort" />
      <label for="new_pwd">Neues Passwort:</label>
    </section>
    <section class="input_group container form-floating">
      <input
        class="inputfield container-md form-control"
        type="password"
        name="new_pwd_r"
        aria-label="Neues Passwort wiederholen" />
      <label for="new_pwd_r">Neues Passwort wiederholen</label>
    </section>
    <input class="submit_button" type="submit" value="Passwort zurücksetzen" />
  </form>
</section>