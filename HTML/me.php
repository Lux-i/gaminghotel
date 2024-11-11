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
          <section class="data-splitter width65 <?php echo isset($user) ? '' : 'center-txt'; ?>">
            <?php if ($_SESSION['logged'] == true) : ?>
              <p>Benutzername: <?php echo $username; ?></p>
              <p>E-Mail: <?php echo $email; ?></p>
              <p>Vorname: <?php echo $vorname?></p>
              <p>Nachname: <?php echo $nachname; ?></p>
              <p>Geschlecht: <?php echo $anrede; ?></p>
              <a href="logout.php"> <button class="button-cream border-none"> Logout </button> </>
            <?php else : ?>
              <p>Sie sind nicht eingeloggt.</p>
            <?php endif; ?>
          </section>
        </article>
    </main>
    <?php
      include(__DIR__ . '/../components/footer.php');
    ?>
    
  </body>
</html>