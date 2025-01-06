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
  include '../components/error_handler.php';
  ?>
  <main class="flex-row">
    <section class="login-window flex-row ">
      <section style="border-right: 1px solid black;">
        <?php if ($_SESSION['logged'] == true): ?>
          <h2>Zimmer Buchen</h2>
          <section class="form-container ">
            <form id="bookform" class="flex-column" action="/actions/add_booking.php" method="POST">
              <fieldset class="form-check">
              <legend class="col-form-label">Auswahl des Zimmers</legend>
                <section>
                  <input class="form-check-input" id="single" name="zimmer" type="radio" value="single" required>
                  <label class="form-check-label" for="single">Einzelzimmer</label>
                </section>
                <section>
                  <input class="form-check-input" id="duo" name="zimmer" type="radio" value="duo" required>
                  <label class="form-check-label" for="duo">Doppelzimmer</label>
                </section>
                <section>
                  <input class="form-check-input" id="squad" name="zimmer" type="radio" value="squad" required>
                  <label class="form-check-label" for="squad">Full-Squad Zimmer</label>
                </section>
              </fieldset>
              <section class="row g-2 mt-2">
                <section class="col">
                  <label class="w-100" for="check_in">Check-In Datum</label>
                  <input type="date" min="<?= date("Y-m-d", strtotime('+1 day')) ?>"
                    class="inputfield container-md form-control"
                    aria-label="Check-In Datum" name="check_in" id="check_in">
                </section>
                <section class="col">
                  <label class="w-100" for="check_out">Check-Out Datum</label>
                  <input type="date" min="<?= date("Y-m-d", strtotime('+2 day')) ?>"
                    class="inputfield container-md form-control" aria-label="Check-Out Datum" name="check_out"
                    id="check_out">
                </section>
              </section>
              <fieldset class="mt-3 form-check form-switch">
                <legend class="col-form-label">Extras</legend>
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
              </fieldset>
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