<?php
if(isset($_GET['error'])){
  $err_msg = $_GET['error'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buchen | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
    <link rel="stylesheet" href="/CSS/login-register.css" />
  </head>
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
    ?>
        <main class="flex-row container">
        <section class="login-window">
        <h2>Passwort ändern</h2>
          <section class="flex-column form-container">
            <form class="flex-column" action="changeData.php" method="POST">
            <section class="input_group container form-floating">
                <input
                  class="inputfield container-md form-control"
                  type="password"
                  id="pwd"
                  name="pwd"
                  required
                  aria-label="altes Passwort" />
                <label for="pwd">altes Passwort</label>
              </section>
              <section class="input_group container form-floating">
                <input
                  class="inputfield container-md form-control"
                  type="password"
                  id="new_pwd"
                  name="new_pwd"
                  required
                  aria-label="Neues Passwort" />
                <label for="new_pwd">Neues Passwort</label>
              </section>
              <section class="input_group container form-floating">
                <input
                  class="inputfield container-md form-control"
                  type="password"
                  id="new_pwd_again"
                  name="new_pwd_again"
                  required
                  aria-label="Neues Passwort wiederholen" />
                <label for="new_pwd_again">Neues Passwort wiederholen</label>
              </section>
              <?php if(isset($err_msg)):echo '<p class="center-txt">'.$err_msg.'</p>'; endif?>
            <div>  
              <input class="submit_button" type="submit" value="Bestätigen" />
              <a href="/HTML/me.php"><button class="submit_button">Abbrechen</button></a>
            </div>
            </form>
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