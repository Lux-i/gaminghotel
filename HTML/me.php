<?php
  include(__DIR__ . '/../components/header.php');
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
    <?php 
      include(__DIR__ . '/../components/nav.php');
      include(__DIR__ . '/../components/in_work.php');
    ?>
    <main>
        <h2 class="border-bottom-cream center-txt">Mein Konto</h2>
        <article class="container-lg flex-row jstfy-center">
          <section class="data-splitter width65 <?php echo ($logged == true) ? '' : 'center-txt'; ?>">
            <?php if ($_SESSION['logged'] == true) : ?>
            <section class="flex-row jstfy-space-between">
              <p>Benutzername: <?php echo $username; ?></p>
              <input type="text" class="h-25"></input>
            </section>
            <section class="flex-row jstfy-space-between">
              <p>E-Mail: <?php echo $email; ?></p>
              <input type="text" class="h-25"></input>
            </section>
            <section class="flex-row jstfy-space-between">
              <p>Vorname: <?php echo $vorname?></p>
              <input type="text" class="h-25"></input>
              </section>
            <section class="flex-row jstfy-space-between">
              <p>Nachname: <?php echo $nachname; ?></p>
              <input type="text" class="h-25"></input>
              </section>
            <section class="flex-row jstfy-space-between">
              <p>Geschlecht: <?php echo $anrede; ?></p>
              <input type="text" class="h-25"></input>
            </section>
              <a href="logout.php"> <button class="button-cream border-none"> Logout </button> </a>
            <?php else : ?>
              <p>Sie sind nicht eingeloggt.</p>
            <?php endif; ?>
          </section>
        </article>
    </main>
    <?php
      include(__DIR__ . '/../components/footer.php');
    ?>
    <button style="position: fixed;right: 12;bottom: 8;" class="bg-primary button-cream border-none">
      Tote hose
    </button>
  </body>
</html>