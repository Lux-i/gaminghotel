<?php
  include(__DIR__ . '/../components/header.php');
  include(__DIR__ . '/../components/nav.php');

  include(__DIR__ . '/accounts.php');
  if(isset($_POST['username']) && isset($_POST['pwd'])){
    if(isset($_SESSION['username']) && isset($_SESSION['pwd'])){
      if($_SESSION['username'] == $_POST['username'] && $_SESSION['pwd'] == $_POST['pwd']) {
        $_SESSION['logged'] = true;
        header("Location: /index.php");
        die;
      }
    }
    if($account1['username'] == $_POST['username'] && $account1['pwd'] == $_POST['pwd']){
      $_SESSION['logged'] = true;
      $_SESSION['anrede'] = $account1['gender'];
      $_SESSION['username'] = $account1['username'];
      $_SESSION['vorname'] = $account1['vorname'];
      $_SESSION['nachname'] = $account1['nachname'];
      $_SESSION['email'] = $account1['email'];  
      $_SESSION['pwd'] = $account1['pwd'];
      header("Location: /index.php");
      die;
    }
    if($account2['username'] == $_POST['username'] && $account2['pwd'] == $_POST['pwd']){
      $_SESSION['logged'] = true;
      $_SESSION['anrede'] = $account2['gender'];
      $_SESSION['username'] = $account2['username'];
      $_SESSION['vorname'] = $account2['vorname'];
      $_SESSION['nachname'] = $account2['nachname'];
      $_SESSION['email'] = $account2['email'];  
      $_SESSION['pwd'] = $account2['pwd'];
      header("Location: /index.php");
      die;
    }
    echo '<div class="d-flex justify-content-center"><div class="alert alert-danger mt-3 center-txt w-25" role="alert"> Username oder Passwort ist falsch!</div></div>';
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
    <main class="flex-row container">
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