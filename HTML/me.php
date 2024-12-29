<?php
include(__DIR__ . '/../components/header.php');
include(__DIR__ . '/../components/nav.php');
include(__DIR__ . '/../components/in_work.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Konto | Göppel & Göppel Hotels</title>
  <?php
  include(__DIR__ . '/../components/main_style.php');
  ?>
  <link rel="stylesheet" href="/CSS/login-register.css" />
</head>

<body class="ghostwhite">
  <main>
    <h2 class="border-bottom-cream center-txt">Mein Konto</h2>
    <article class="container-lg flex-row jstfy-center">
      <section class="data-splitter width65 <?= ($logged == true) ? '' : 'center-txt'; ?>">
        <?php if ($_SESSION['logged'] == true): ?>
          <section class="mt-3" id="userdata">
            <p>Benutzername: <?= $user['username']; ?></p>
            <p>E-Mail: <?= $user['email']; ?></p>
            <p>Vorname: <?= $user['name'] ?></p>
            <p>Nachname: <?= $user['nachname']; ?></p>
            <p>Geschlecht: <?= ucfirst($user['anrede']); ?></p>
          </section>
          <form id="edit" class="flex-column" action="changeData.php" method="POST" hidden=true>
            <section class="container form-floating">
              <input class="container-md form-control" type="text" id="username" name="username"
                value="<?= $user['username'] ?>" aria-label="Nutzername" />
              <label for="username">Benutzername:</label>
            </section>
            <section class="container form-floating">
              <input class="container-md form-control" type="email" id="email" name="email" value="<?= $user['email'] ?>"
                aria-label="Email Adresse" />
              <label for="email">E-Mail:</label>
            </section>
            <section class="container form-floating">
              <input class="container-md form-control" type="text" id="vorname" name="vorname"
                value="<?= $user['name'] ?>" aria-label="Vorname" />
              <label for="vorname">Vorname:</label>
            </section>
            <section class="container form-floating">
              <input class="container-md form-control" type="text" id="nachname" name="nachname"
                value="<?= $user['nachname'] ?>" aria-label="Nachname" />
              <label for="nachname">Nachname:</label>
            </section>
            <section class="container">
              <select class="container-md form-control" name="anrede" id="anrede">
                <option value="herr" <?= ($user['anrede'] == 'herr') ? 'selected' : '' ?>>
                  Herr
                </option>
                <option value="frau" <?= ($user['anrede'] == 'frau') ? 'selected' : '' ?>>
                  Frau
                </option>
                <option value="divers" <?= ($user['anrede'] == 'divers') ? 'selected' : '' ?>>
                  Divers
                </option>
              </select>
            </section>
            <input class="button-cream border-none" style="position:fixed;bottom:10;right:15;" type="submit"
              id="submitButton" value="Änderungen bestätigen" required hidden disabled />
          </form>
          <section class="flex-row jstfy-space-around">
            <a href="logout.php">
              <button class="button-cream border-none">
                Logout
              </button>
            </a>
            <a href="change_pwd.php">
              <button class="button-cream border-none">
                Passwort ändern
              </button>
            </a>
            <button class="button-cream border-none" onclick="changeVisibility(this)">
              Edit
            </button>
          </section>
        <?php else: ?>
          <p>Sie sind nicht eingeloggt.</p>
        <?php endif; ?>
      </section>
    </article>
  </main>
  <?php
  include(__DIR__ . '/../components/footer.php');
  ?>
  <script src="/JS/changeData.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>