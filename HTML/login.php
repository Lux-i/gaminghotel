<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Göppel & Göppel Hotels</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous" />
    <link rel="stylesheet" href="/CSS/main.css" />
    <link rel="stylesheet" href="/CSS/login-register.css" />
  </head>
  <body class="ghostwhite" id="impressum">
    <?php 
      include(__DIR__ . '/../components/header.php');
    ?>
    <?php 
      include(__DIR__ . '/../components/nav.php');
    ?>
    <main class="flex-row">
      <section id="login_fenster">
        <h2>Login</h2>
        <section class="flex-column" id="login_inhalt">
          <form class="flex-column">
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="username"
                name="username"
                placeholder="Nutzername"
                aria-label="Username" />
              <label for="username">Nutzername</label>
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
