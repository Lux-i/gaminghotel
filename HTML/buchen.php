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
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
      include(__DIR__ . '/../components/in_work.php');
    ?>
    <main class="flex-row">
      <section class="login-window">
        <h2>Zimmer Buchen</h2>
        <section class="flex-column form-container">
          <form class="flex-column" method="POST">
            <section class="input_group container">
              <select
                class="inputfield container-md form-control"
                name="anrede"
                id="anrede"
                required>
                <option value="herr">Herr</option>
                <option value="frau">Frau</option>
                <option value="divers">Divers</option>
              </select>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="vorname"
                name="vorname"
                required
                placeholder="Max"
                aria-label="Vorname" />
              <label for="vorname">Vorname:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="nachname"
                name="nachname"
                required
                placeholder="Mustermann"
                aria-label="Nachname" />
              <label for="nachname">Nachname:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="email"
                id="email"
                name="email"
                placeholder="max.mustermann@example.com"
                required
                aria-label="Email Adresse" />
              <label for="email">E-Mail Adresse:</label>
            </section>
            <section class="input_group container form-floating">
              <input
                class="inputfield container-md form-control"
                type="text"
                id="username"
                name="username"
                required
                placeholder="maxi93"
                aria-label="Nutzername" />
              <label for="username">Nutzername:</label>
            </section>
            <input
              class="submit_button"
              type="submit"
              value="Reservieren"
              required />
          </form>
        </section>
      </section>
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