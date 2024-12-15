<?php
  include(__DIR__ . '/../components/header.php');
  include(__DIR__ . '/../components/nav.php');

  require_once('../components/db_utils.php');
  $conn = connectDB();
  if(validateToken($conn)){
    $sql = "SELECT start, end, extras, price FROM bookings
    WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
    if($stmt->execute()){
      $result = $stmt->get_result();
      $rownum = 0;
      $rows = array();
      while($row = $result->fetch_assoc()) {
        $rows[$rownum] = $row;
        echo "<br/>";
        print_r($rows[$rownum++]);
      }
    }
  }
  closeConnection($conn);
?>
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
      echo '<h1 class="text-center mt-2">Meine Buchungen</h1>';
      include(__DIR__ . '/../components/in_work.php');
    ?>
    <?php if ($_SESSION['logged'] == true) : ?> 
      <?php foreach ($bookings as $booking): ?>
        <?php if($booking['email'] == $user['email'] && $booking['vorname'] == $user['name'] && $booking['nachname'] == $user['nachname']): ?> 
        <main class="d-flex justify-content-center">
          <section class="login-window w-75">
                <p class="px-3">Reserviert für: <?php echo ucfirst($booking['gender']) ." ". $booking['vorname'] ." ". $booking['nachname']; ?></p>
                <p class="px-3">E-Mail: <?php echo $booking['email']; ?></p>
                <p class="px-3">Reserviert ab: <?php
                $epoch = $booking['start'];
                $dt = new DateTime("@$epoch"); 
                echo $dt->format('d / m / Y');?> 
                , Reserviert bis: 
                <?php
                $epoch = $booking['end'];
                $dt = new DateTime("@$epoch"); 
                echo $dt->format('d / m / Y');?> </p>
                <p class="px-3">Kosten: <?= $booking['price']?>€</p>
                <p class="px-3">Extras: <?php
                $extrasText = "";
                foreach($booking['extras'] as $extra){$extrasText .= $extra. ' / ';};
                echo substr($extrasText, 0, -3);
                ?></p>
          </section>
        </main>
        <?php elseif($booking['email'] != $user['email'] && $booking['vorname'] != $user['name'] && $booking['nachname'] != $user['nachname']): echo "";?>
        <?php else : ?>
            <p class="text-center">Sie haben keine Buchungen.</p>
        <?php endif;?>
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