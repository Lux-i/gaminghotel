<?php
include(__DIR__ . '/../components/header.php');
include(__DIR__ . '/../components/nav.php');

require_once('../components/dbaccess.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST)){
  if ($_POST['pwd'] !== $_POST['pwd_confirm']) {
    echo '<div class="d-flex justify-content-center"><div class="alert alert-danger mt-3 center-txt w-25" role="alert">Passwort ist nicht gleich!</div></div>';
  }else{
    $sql = "INSERT INTO users (anrede, name, nachname, username, email, pwd, rolle)
            VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    $anrede = $_POST['anrede'];
    $username = $_POST['username'];
    $vorname = ucfirst($_POST['vorname']);
    $nachname = ucfirst($_POST['nachname']);
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_ARGON2ID);
    $rolle = "user";

    $stmt->bind_param("sssssss",$anrede, $vorname, $nachname, $username, $email, $pwd, $rolle);

    if ($stmt->execute()) {
      echo '<div class="alert alert-success mt-3 center-txt w-25">New record created successfully!</div>';
    } else {
      echo '<div class="alert alert-danger mt-3 center-txt w-25" role="alert">Error: ' . $stmt->error . '</div>';
    }

    $conn->close();

    header('Location: login.php');
  }
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
                aria-label="Anrede"
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
