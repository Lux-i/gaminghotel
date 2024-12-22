<?php
include(__DIR__ . '/../components/header.php');
include(__DIR__ . '/../components/nav.php');
require_once('../components/db_utils.php');

$conn = connectDB();
//exit if connection failed
if (!$conn)
  die();

//PWD-AUTH
if (isset($_POST['username']) && isset($_POST['pwd'])) {
  $sql = "SELECT pwd, id FROM users WHERE username = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  echo "RESULT: ";
  print_r($result);

  if ($result->num_rows == 0) {
    echo "Benutzer nicht gefunden";
    exit();
  } else {
    echo "<br/><br/>Benutzer gefunden";
    $row = $result->fetch_assoc();
    $pwd_hash = $row['pwd'];
    $userid = $row['id'];
    if (password_verify($_POST['pwd'], $pwd_hash)) {
      //TOKEN CREATION
      //tokens only work together with the right userid

      //randomly generated token is created using random_bytes() and converted to a hex representation
      $token = bin2hex(random_bytes(32));
      //hash the token to store in the database
      $tokenhash = password_hash($token, PASSWORD_ARGON2ID);
      //token expires in 1 week from the moment the token is generated
      $expire_date = date('Y-m-d H:i:s', strtotime("+1 week"));
      if (!hasToken($conn, $userid)) {
        //user has no token stored in the db, a new one is created
        $sql = "INSERT INTO userauth (userid, tokenhash, token_expires) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $userid, $tokenhash, $expire_date);
      } else {
        //user has an active token, this token will be overwritten
        $sql = "UPDATE userauth SET tokenhash = ?, token_expires = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $tokenhash, $expire_date, $userid);
      }
      if ($stmt->execute()) {
        //set session variables for authentication
        $_SESSION['auth_token'] = $token;
        $_SESSION['user_id'] = $userid;
        //set the user to be logged in in the session
        $_SESSION['logged'] = true;
        //redirect to the account page
        header("Location:me.php");
        closeConnection($conn);
        die();
      } else {
        echo "<br/><br/>Fehler bei der Token generierung";
      }
    } else {
      echo "<br/><br/>Passwort falsch";
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
  <?php
  include(__DIR__ . '/../components/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>