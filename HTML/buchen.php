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
  include(__DIR__ . '/../components/header.php');
  include(__DIR__ . '/../components/nav.php');
  include(__DIR__ . '/../components/in_work.php');
  ?>
  <main class="flex-row">
    <section class="login-window flex-row">
      <section style="border-right: 1px solid black;">
        <?php if ($_SESSION['logged'] == true): ?>
          <h2>Zimmer Buchen</h2>
          <section class="form-container ">
            <form id="bookform" class="flex-column" action="/actions/add_booking.php" method="POST">
              <section class="form-check">
                <section>
                  <input class="form-check-input" id="zimmer1" name="zimmer" type="radio" value="zimmer1" required>
                  <label class="form-check-label" for="zimmer1">Einzelzimmer</label>
                </section>
                <section>
                  <input class="form-check-input" id="zimmer2" name="zimmer" type="radio" value="zimmer2" required>
                  <label class="form-check-label" for="zimmer2">Doppelzimmer</label>
                </section>
                <section>
                  <input class="form-check-input" id="zimmer3" name="zimmer" type="radio" value="zimmer3" required>
                  <label class="form-check-label" for="zimmer3">Full-Squad Zimmer</label>
                </section>
              </section>
              <section class="row g-2 mt-2">
                <section class="col">
                  <label class="w-100" for="check_in">Check-In Datum</label>
                  <input type="date" min="<?= date("Y-m-d") ?>" class="inputfield container-md form-control"
                    aria-label="Check-In Datum" name="check_in" id="check_in">
                </section>
                <section class="col">
                  <label class="w-100" for="check_in">Check-Out Datum</label>
                  <input type="date" min="<?= date("Y-m-d", strtotime('+1 day')) ?>"
                    class="inputfield container-md form-control" aria-label="Check-Out Datum" name="check_out"
                    id="check_out">
                </section>
              </section>
              <section class="mt-3 form-check form-switch">
                <section>
                  <label>
                    <input class="form-check-input" type="checkbox" name="extras[]" value="Parkplatz"> Parkplatz (13€/Tag)
                  </label>
                </section>
                <section>
                  <label>
                    <input class="form-check-input" type="checkbox" name="extras[]" value="Frühstück"> Frühstück (18€/Tag)
                  </label>
                </section>
                <section>
                  <label>
                    <input class="form-check-input" type="checkbox" name="extras[]" value="Haustiere"> Haustiere (10€/Tag)
                  </label>
                </section>
              </section>
              <input class="submit_button" type="submit" id="submitButton" value="Registrieren" disabled required />
            </form>
          </section>
        </section>
        <section class="p-3 flex-column jstfy-center">
          <p id="price-txt" class="center-txt">0 €</p>
        </section>
      </section>
      <div>
      <?php else: ?>
        <p>Sie sind nicht eingeloggt.</p>
      <?php endif; ?>
    </div>
  </main>
  <?php
  include(__DIR__ . '/../components/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="../JS/bookingCost.js"></script>
</body>

</html>