<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buchen | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
      include(__DIR__. '/../components/booking_data.php');
    ?>
    <link rel="stylesheet" href="/CSS/login-register.css" />
  </head>
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
      echo '<h1 class="text-center">Reservierungen</h1>';
      include(__DIR__ . '/../components/in_work.php');
    ?>
    <?php if ($_SESSION['logged'] == true) : ?> 

      <?php foreach ($bookings as $bookings): ?>
        <main class="d-flex justify-content-center">
          <section class="login-window w-75">
                <p">Reserviert für: <?php echo ucfirst($bookings['gender']) ." ". $bookings['vorname'] ." ". $bookings['nachname']; ?></p>
                <p>E-Mail: <?php echo $bookings['email']; ?></p>
          </section>
        </main>
      <?php endforeach;?>
      <?php else : ?>
              <p class="text-center">Sie sind nicht eingeloggt.</p>
    <?php endif; ?>
    <?php  
      include(__DIR__ . '/../components/footer.php');
    ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>
</html>