<?php
  include(__DIR__ . '/../components/header.php');


  if(isset($_POST['username']) && isset($_POST['pwd']) && $_SESSION['logged'] == false){
    if($_SESSION['username'] == $_POST['username'] && $_SESSION['pwd'] == $_POST['pwd']) {
      $_SESSION['logged'] = true;
      header("Location: /index.php");
      exit;
    }elseif($_SESSION['username'] !== $_POST['username'] || $_SESSION['pwd'] !== $_POST['pwd']){
      echo "Username oder Passwort ist falsch";
    }
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