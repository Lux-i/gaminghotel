<?php
//redirect to the index.php when a logged out user visits this page through a direct link
if (!isset($user)) {
  header('Location: /');
  die();
}

//if the user is logged in, but not an admin, the sql query won't be run
//the isPermitted() function is not used so db-utils and the db connection are not loaded for no reason
if ($user['rolle'] == 'admin') {
  require_once __DIR__ . '/../components/db_utils.php';
  $conn = connectDB();
  if (validateToken($conn)) {
    if (empty($_GET['filter']) && empty($_GET['id'])) {
      $sql = "SELECT bookings.id, start, end, extras, price, u.anrede, u.name, u.nachname, u.email, bookings.status, booking_submitted
              FROM bookings
              JOIN users AS u ON u.id = bookings.userid
              ORDER BY bookings.id DESC";
      $stmt = $conn->prepare($sql);
    } elseif (!empty($_GET['filter'])) {
      $sql = "SELECT bookings.id, start, end, extras, price, u.anrede, u.name, u.nachname, u.email, bookings.status, booking_submitted
              FROM bookings
              JOIN users AS u ON u.id = bookings.userid
              WHERE bookings.status = ?
              ORDER BY bookings.id DESC";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $_GET['filter']);
    } else {
      $sql = "SELECT bookings.id, start, end, extras, price, u.anrede, u.name, u.nachname, u.email, bookings.status, booking_submitted
              FROM bookings
              JOIN users AS u ON u.id = bookings.userid
              WHERE u.id = ?
              ORDER BY bookings.id DESC";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $_GET['id']);
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
} else {
  header('Location: /');
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

  <h1 class="text-center mt-4 mb-4">Reservierungen</h1>

  <?php if ($_SESSION['logged'] == true): ?>
    <section class="login-window w-50 container">
      <section class="flex-row flex-wrap justify-content-between align-items-center mx-2">
        <section class="">
          <h2>Filter:</h2>
        </section>
        <section>
          <a href="/reservierungen?filter=neu" class="px-4 btn btn-primary"> Neu </a>
        </section>
        <section>
          <a href="/reservierungen?filter=bestätigt" class="btn btn-success"> Bestätigt </a>
        </section>
        <section>
          <a href="/reservierungen?filter=storniert" class="btn btn-danger"> Storniert </a>
        </section>
        <section>
          <a href="/reservierungen" class="btn btn-secondary"> Filter löschen </a>
        </section>
      </section>
    </section>
    <?php if (!empty($bookings)): ?>
      <?php foreach ($bookings as $booking): ?>
        <main class="d-flex justify-content-center">
          <section class="login-window w-75">
            <p class="px-3">Reserviert für:
              <?= ucfirst($booking['anrede']) . " " . $booking['name'] . " " . $booking['nachname']; ?>
            </p>
            <p class="px-3">
              <?php
              $epoch = $booking['booking_submitted'];
              $dt = new DateTime($epoch);
              echo "Reserviert am: " . $dt->format('d.m.Y');
              ?>
            </p>
            <p class="px-3">Reserviert ab: 
              <?php
              $epoch = $booking['start'];
              $dt = new DateTime("$epoch");
              echo $dt->format('d / m / Y'); ?>
            </p>
            <p class="px-3">Reserviert bis:
              <?php
              $epoch = $booking['end'];
              $dt = new DateTime("$epoch");
              echo $dt->format('d / m / Y'); ?>
            </p>
            <p class="px-3">Status: <strong class=" <?php if ($booking["status"] == "neu") {
              echo "text-primary";
            } elseif ($booking["status"] == "bestätigt") {
              echo "text-success";
            } else {
              echo "text-danger";
            } ?>"> <?= ucfirst($booking['status']) ?></strong></p>
            <section class="container">
              <section class="row">
                <section class="col">
                  <a href="/reservierung?id=<?= $booking['id'] ?>" class="btn btn-secondary">Mehr anzeigen</a>
                </section>
              </section>
            </section>
        </main>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center mt-3">Keine offenen Reservierungen.</p>
    <?php endif; ?>
  <?php endif; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>