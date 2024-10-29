<?php
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
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
    <link rel="stylesheet" href="/CSS/login-register.css" />
  </head>
  <body class="ghostwhite" id="impressum">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
    ?>
    <main class="flex-row">
      <section class="login-window">
        <h2>Login</h2>
        <section class="flex-column form-container">
          <form class="flex-column" method="POST">
          <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="username"
                name="username"
                required
                placeholder="maxi93"
                aria-label="Nutzername" />
              <label for="username">Nutzername:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="password"
                id="pwd"
                name="pwd"
                placeholder="Passwort"
                aria-label="Passwort" />
              <label for="pwd">Passwort</label>
            </section>
            <input class="submit_button" type="submit" value="Login" />
          </form>
          <p>
            Sie haben noch kein Konto?
            <a href="/HTML/register.php">Hier registrieren</a>
          </p>
        </section>
      </section>
    </main>
    <?php 
      include(__DIR__ . '/../components/footer.php');
    ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>
</html>
