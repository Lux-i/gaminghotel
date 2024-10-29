<?php
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
      }
    }

    error_log(print_r($response, true));

    curl_close($register);
  }
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Göppel & Göppel Hotels</title>
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
        <h2>Registrieren</h2>
        <section class="flex-column form-container">
          <form class="flex-column" method="POST">
            <section class="input_group container">
              <select
                class="inputfield container-md form-control"
                name="anrede"
                id="anrede"
                required>
                <option value="herr">Herr</option>
                <option value="frau">Frau</option>
                <option value="divers">Divers</option>
              </select>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="vorname"
                name="vorname"
                required
                placeholder="Max"
                aria-label="Vorname" />
              <label for="vorname">Vorname:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="nachname"
                name="nachname"
                required
                placeholder="Mustermann"
                aria-label="Nachname" />
              <label for="nachname">Nachname:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="email"
                id="email"
                name="email"
                placeholder="max.mustermann@example.com"
                required
                aria-label="Email Adresse" />
              <label for="email">E-Mail Adresse:</label>
            </section>
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
                required
                aria-label="Passwort" />
              <label for="pwd">Password:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="password"
                id="pwd_confirm"
                name="pwd_confirm"
                required
                aria-label="Passwort wiederholen" />
              <label for="pwd">Password wiederholen:</label>
            </section>
            <input
              class="submit_button"
              type="submit"
              value="Registrieren"
              required />
          </form>
          <p>
            Sie haben schon ein Konto?
            <a href="/HTML/login.php">Hier anmelden</a>
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
