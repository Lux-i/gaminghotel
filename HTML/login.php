<?php
include './components/error_handler.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Göppel & Göppel Hotels</title>
  <?php
  include './components/main_style.php';
  ?>
  <link rel="stylesheet" href="/CSS/login-register.css" />
</head>

<body class="ghostwhite" id="impressum">
  <main class="flex-row container">
    <section class="login-window">
      <h2>Login</h2>
      <section class="flex-column form-container">
        <form class="flex-column" action="/actions/login.php" method="POST">
          <section class="input_group container form-floating">
            <input class="inputfield container-md form-control" type="text" id="username" name="username" required
              placeholder="maxi93" aria-label="Nutzername" />
            <label for="username">Nutzername:</label>
          </section>
          <section class="input_group container form-floating">
            <input class="inputfield container-md form-control" type="password" id="pwd" name="pwd"
              placeholder="Passwort" aria-label="Passwort" />
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>