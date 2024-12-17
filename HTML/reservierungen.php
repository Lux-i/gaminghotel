<?php
include(__DIR__ . '/../components/header.php');
include(__DIR__ . '/../components/nav.php');

//redirect auf die index.php wenn unangemeldeter user die seite über direkten link aufruft
if (!isset($user)) {
  header('Location: /index.php');
  die();
}

//ist der user angemeldet aber kein admin, wird die sql anfrage nicht ausgeführt
if ($user['rolle'] == 'admin') {
  require_once('../components/db_utils.php');
  $conn = connectDB();
  if (validateToken($conn)) {
    $sql = "SELECT bookings.id, start, end, extras, price, u.anrede, u.name, u.nachname, u.email, status FROM bookings
            JOIN users AS u ON u.id = bookings.userid
            ORDER BY bookings.id DESC";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $rownum = 0;
      $bookings = array();
      while ($row = $result->fetch_assoc()) {
        $bookings[$rownum++] = $row;
      }
    }
  }
  closeConnection($conn);
} else {
  header('Location: /index.php');
  die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buchen | Göppel & Göppel Hotels</title>
  <?php
  include(__DIR__ . '/../components/main_style.php');
  ?>
  <link rel="stylesheet" href="/CSS/login-register.css" />
</head>

<body class="ghostwhite">
  <?php
  echo '<h1 class="text-center">Reservierungen</h1>';
  include(__DIR__ . '/../components/in_work.php');
  ?>
  <?php if ($_SESSION['logged'] == true): ?>
    <?php if (!empty($bookings)): ?>
      <?php foreach ($bookings as $booking): ?>
        <main class="d-flex justify-content-center">
          <section class="login-window w-75">
            <p class="px-3">Reserviert für:
              <?php echo ucfirst($booking['anrede']) . " " . $booking['name'] . " " . $booking['nachname']; ?>
            </p>
            <p class="px-3">E-Mail: <?php echo $booking['email']; ?></p>
            <p class="px-3">Reserviert ab: <?php
            $epoch = $booking['start'];
            $dt = new DateTime("$epoch");
            echo $dt->format('d / m / Y'); ?>
              , Reserviert bis:
              <?php
              $epoch = $booking['end'];
              $dt = new DateTime("$epoch");
              echo $dt->format('d / m / Y'); ?>
            </p>
            <p class="px-3">Kosten: <?= $booking['price'] ?>€</p>
            <p class="px-3">Extras:
              <?php
              if ($booking['extras'] != NULL) {
                $extrasText = "";
                $extras = explode(',', $booking['extras']);
                foreach ($extras as $extra) {
                  $extrasText .= $extra . ' / ';
                }
                ;
                echo substr($extrasText, 0, -3);
              } else {
                echo "Keine extras.";
              }
              ?>
            </p>
            <p class="px-3">Status: <strong class=" <?php if($booking["status"] == "neu"){
              echo "text-primary";
            }elseif($booking["status"] == "bestätigt"){
              echo "text-success";
            }else{
              echo "text-danger";
            }?>"> <?= ucfirst($booking['status']) ?></strong></p>
            <section class="ml-3">
              <form class="form-check d-flex justify-content-start" action="change_booking_status.php" method="POST">
                <p><input type="number" value="<?php echo $booking["id"];?>" id="id" name="id" readonly hidden></input>
                <p><button type="submit" value="1" id="stornieren" name="change_status" class="btn btn-danger">Stornieren</button></p>
                <p><button type="submit" value="2" class="mx-3 btn btn-success" id="bestätigen" name="change_status">Bestätigen</button></p>
              </form>
          </section>
        </main>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">Keine offenen Reservierungen.</p>
    <?php endif; ?>
  <?php endif; ?>
  <?php
  include(__DIR__ . '/../components/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>