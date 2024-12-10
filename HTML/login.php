<?php
  include(__DIR__ . '/../components/header.php');
  include(__DIR__ . '/../components/nav.php');
  require_once('../components/db_utils.php');

  $conn = connectDB();
  if(!$conn) die();

  #REGION PWD-AUTH
  if(isset($_POST['username']) && isset($_POST['pwd'])){
    $sql = "SELECT pwd, id FROM users WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "RESULT: ";
    print_r($result);

    if($result->num_rows == 0){
      echo "Benutzer nicht gefunden";
      exit();
    } else {
      echo "<br/><br/>Benutzer gefunden";
      $row = $result->fetch_assoc();
      $pwd_hash = $row['pwd'];
      $userid = $row['id'];
      #ENDREGION
      if(password_verify($_POST['pwd'], $pwd_hash)){
        $token = bin2hex(random_bytes(32));
        $tokenhash = password_hash($token, PASSWORD_ARGON2ID);
        $expire_date = date('Y-m-d H:i:s', strtotime("+1 week"));
        if(!hasToken($conn, $userid)){
          //user hat keinen token in der db, neuer wird erstellt
          $sql = "INSERT INTO userauth (userid, tokenhash, token_expires) VALUES (?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("iss", $userid, $tokenhash, $expire_date);
        } else {
          //user hat einen aktiven token, dieser wird überschrieben
          $sql = "UPDATE userauth SET tokenhash = ?, token_expires = ? WHERE userid = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ssi", $tokenhash, $expire_date, $userid);
        }
        if ($stmt->execute()) {
          $_SESSION['auth_token'] = $token;
          $_SESSION['user_id'] = $userid;
          $_SESSION['logged'] = true;
          header("Location:me.php");
        } else {
          echo "<br/><br/>Fehler bei der Token generierung";
          closeConnection($conn);
          exit();
        }
      } else {
        echo "<br/><br/>Passwort falsch";
        closeConnection($conn);
        exit();
      }
    }
  }
  closeConnection($conn);
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