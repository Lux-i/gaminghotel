<?php
include __DIR__ . '/../components/dbaccess.php';
require_once __DIR__ . '/../components/db_utils.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (empty($_GET['id'])) {
  header('Location: /reservierungen');
  die();
}

if (validateToken($conn)) {
  if (isPermitted($conn, PERMISSION::ADMIN)) {
    $sql = "SELECT bookings.id, start, end, extras, price, u.anrede, u.name, u.nachname, u.email, bookings.status, booking_submitted
            FROM bookings
            JOIN users AS u ON u.id = bookings.userid
            WHERE bookings.id = ?";
    $id = $_GET['id'];
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $booking = $result->fetch_assoc();
    }
  } else {
    header('Location: /reservierungen');
    die();
  }
} else {
  echo "Error";
}

closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details zur Reservierung</title>
  <?php
  include(__DIR__ . '/../components/main_style.php');
  ?>
  <link rel="stylesheet" href="../css/login-register.css" />
</head>

<body>
  <section>
    <h2 class="mt-3 text-center border-bottom-black w-75 mx-auto">Details zur Reservierung</h2>
  </section>
  <main class="d-flex justify-content-center">
    <section class="login-window">
      <p class="px-3">Reserviert für:
        <?= ucfirst($booking['anrede']) . " " . $booking['name'] . " " . $booking['nachname']; ?>
        <?php
        $epoch = $booking['booking_submitted'];
        $dt = new DateTime($epoch);
        echo " am " . $dt->format('d.m.Y');
        ?>
      </p>
      <p class="px-3">E-Mail: <?php echo $booking['email']; ?></p>
      <p class="px-3">Reserviert ab: <?php
      $epoch = $booking['start'];
      $dt = new DateTime("$epoch");
      echo $dt->format('d / m / Y'); ?>
        | Reserviert bis:
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
      <section class="container">
        <form class="form-check" action="/actions/change_booking_status.php" method="POST">
          <input type="number" value="<?= $booking["id"]; ?>" id="id" name="id" readonly hidden></input>
          <section class="flex-row flex-wrap">
            <section>
              <button type="submit" value="1" id="stornieren" name="change_status" class="btn btn-danger m-1" <?php if ($booking['status'] == "storniert")
                echo "hidden"; ?>>Stornieren</button>
            </section>
            <section>
              <button type="submit" value="2"
                class="<?php if ($booking['status'] != "storniert") ?> btn btn-success m-1" id="bestätigen"
                name="change_status" <?php if ($booking['status'] == "bestätigt")
                  echo "hidden"; ?>>Bestätigen</button>
            </section>
            <section>
              <a href="/reservierungen" class="btn btn-secondary m-1">Zurück</a>
            </section>
          </section>
        </form>
      </section>
  </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>