<?php
include(__DIR__ . '/../components/header.php');
include(__DIR__ . '/../components/nav.php');

require_once('../components/db_utils.php');
$conn = connectDB();
if (validateToken($conn)) {
  if (empty($_GET['filter'])) {
    $sql = "SELECT id, start, end, extras, price, status FROM bookings
      WHERE userid = ?
      ORDER BY bookings.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
  } else {
    $sql = "SELECT id, start, end, extras, price, status FROM bookings
      WHERE userid =? AND status =?
      ORDER BY bookings.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $_SESSION['user_id'], $_GET['filter']);
  }
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
  <h1 class="text-center my-2">Meine Buchungen</h1>
  <?php if ($_SESSION['logged'] == true): ?>
    <section class="login-window container">
      <section class="flex-row flex-wrap justify-content-around align-items-center mx-2">
        <section class="">
          <h2>Filter:</h2>
        </section>
        <section>
          <a href="meine_buchungen.php?filter=neu" class="px-4 btn btn-primary"> Neu </a>
        </section>
        <section>
          <a href="meine_buchungen.php?filter=bestätigt" class="btn btn-success"> Bestätigt </a>
        </section>
        <section>
          <a href="meine_buchungen.php?filter=storniert" class="btn btn-danger"> Storniert </a>
        </section>
        <section>
          <a href="meine_buchungen.php" class="btn btn-secondary"> Filter löschen </a>
        </section>
      </section>
    </section>
    <?php if (!empty($bookings)): ?>
      <?php foreach ($bookings as $booking): ?>
        <main class="d-flex justify-content-center">
          <section class="login-window width-75">
            <p class="px-3">Reserviert für:
              <?php echo ucfirst($user['anrede']) . " " . $user['name'] . " " . $user['nachname']; ?>
            </p>
            <p class="px-3">E-Mail: <?php echo $user['email']; ?></p>
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
            <p class="px-3">Status: <strong class=" <?php if ($booking["status"] == "neu") {
              echo "text-primary";
            } elseif ($booking["status"] == "bestätigt") {
              echo "text-success";
            } else {
              echo "text-danger";
            } ?>"> <?= ucfirst($booking['status']) ?></strong></p>
            <section class="ml-3">
              <?php if ($booking['status'] != "storniert"): ?>
                <form class="form-check" action="/actions/change_booking_status.php" method="POST">
                  <input type="number" value="<?php echo $booking["id"]; ?>" id="id" name="id" readonly hidden></input>
                    <label><input class="form-check-input" type="checkbox" id="check" required> Ich bestätige, dass ich die
                      Buchung stornieren möchte.</label>
                  <p><button type="submit" value="1" id="stornieren" name="change_status"
                      class="mt-2 btn btn-danger">Stornieren</button></p>
                </form>
              <?php endif; ?>
            </section>
          </section>
        </main>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center mt-2">Sie haben keine Buchungen.</p>
    <?php endif; ?>
  <?php else: ?>
    <p class="text-center">Sie sind nicht eingeloggt.</p>
  <?php endif; ?>
  <?php
  include(__DIR__ . '/../components/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>