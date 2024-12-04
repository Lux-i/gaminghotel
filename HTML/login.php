<?php
  include(__DIR__ . '/../components/header.php');
  include(__DIR__ . '/../components/nav.php');

  include(__DIR__ . '/accounts.php');
  require_once('../components/dbaccess.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  if(isset($_POST['username']) && isset($_POST['pwd'])){
    $sql = "SELECT pwd FROM users WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "RESULT: ";
    print_r($result);

    if($result->num_rows == 0){
      echo "Benutzer nicht gefunden";
      $conn->close();
      exit();
    } else {
      echo "<br/><br/>Benutzer gefunden";
      $pwd_hash = $result->fetch_assoc()['pwd'];
      echo "<br/><br/>";
      print_r($pwd_hash);
      if(password_verify($_POST['pwd'], $pwd_hash)){
        $sql = "SELECT anrede, name, nachname, username, email, rolle FROM users WHERE username = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userrow = $result->fetch_assoc();
        echo "<br/><br/>USER: ";
        print_r($userrow);
        $_SESSION['userobj'] = $userrow;
      } else {
        echo "<br/><br/>Passwort falsch";
        $conn->close();
        exit();
      }
    }
  }

  $conn->close();
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