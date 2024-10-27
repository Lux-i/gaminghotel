<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konto | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
  </head>
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
      include(__DIR__ . '/../components/in_work.php');
    ?>
    <main>
        <h2 class="border-bottom-cream center-txt">Mein Konto</h2>
        <article class="container-lg flex-row jstfy-center">
            <section class="data-splitter width65">
                <p>Benutzername: <?php echo $user->username ?></p>
                <p>E-Mail:  <?php echo $user->email ?></p>
                <p>Vorname: <?php echo $user->firstName ?></p>
                <p>Nachname: <?php echo $user->lastName ?></p>
                <p>Geschlecht: <?php echo $user->gender ?></p>
                <p>Sie sind ein Mitglied seit:
                <?php
                    $date = new DateTime($user->Created);
                    $readableDate = $date->format("d.M.Y");
                    echo $readableDate; 
                ?></p>
            </section>
        </article>
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