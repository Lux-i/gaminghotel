<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/components/main_style.php');
    ?>
    <link rel="stylesheet" href="CSS/index.css" />
  </head>
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/components/header.php');
      include(__DIR__ . '/components/nav.php');
    ?>
    <main>
      <article id="data-splitter">
        <h2
          class="border-bottom-cream flex-row jstfy-center container-sm"
          id="page-title">
          Göppel & Göppel Hotel - Wien
        </h2>
        <?php 
            include(__DIR__ . '/components/in_work.php');
        ?>
        <section class="data-splitter flex-row jstfy-center">
          <p class="width65">
            Willkommen im Göppel & Göppel Hotel, dem ersten Gaming-Hotel in
            Wien! Hier erwartet euch ein einzigartiges Erlebnis, das speziell
            für Gamer geschaffen wurde. Genießt modernste Gaming-Stationen,
            wöchentlich spannende Events und eine Atmosphäre, die für alle
            Spieler und E-Sport-Fans perfekt ist.
            <br />
            <strong
              >Ob Casual Gamer oder Profi – bei uns findet jeder die perfekte
              Balance zwischen Komfort und Spielspaß.
            </strong>
          </p>
        </section>
        <section class="data-splitter flex-row jstfy-center">
          <a href="/HTML/buchen.php" class="button-cream">
            <strong>Jetzt Gaming-Aufenthalt buchen!</strong>
          </a>
        </section>
        <section class="data-splitter flex-row jstfy-center">
          <p class="width75">
            Unsere komfortablen Zimmer sind so gestaltet, dass ihr euch voll und
            ganz aufs Gaming konzentrieren könnt. Mit High-Speed-Internet,
            ergonomischen Gaming-Stühlen und Monitoren mit hoher
            Bildwiederholrate wird jeder Aufenthalt zum unvergesslichen
            Erlebnis. Entspannt euch nach einem intensiven Gaming-Tag in unseren
            gemütlichen Lounges und knüpft Kontakte mit anderen Gamern aus aller
            Welt!
            <br />
            <img
              src="/Public/Images/Hotel_room_single.jpg"
              alt="Einzel Gamingzimmer"
              style="margin-top: 10px"
              class="width100 shadow_purple" />
            <img
              src="/Public/Images/Hotel_room_teams.jpg"
              alt="Team Gamingzimmer"
              style="margin-top: 10px"
              class="width100 shadow_purple" />
          </p>
        </section>
        <section class="data-container flex-column center-txt jstfy-center">
          <h3>Haben sie Fragen?</h3>
          <section class="data-splitter flex-row jstfy-center">
            <p class="width75">
              Besuchen Sie unser
              <a href="/HTML/hilfe.php#faq">FAQ</a>, um Antworten auf häufig
              gestellte Fragen zu finden.
              <br />
              <br />
              Keine Antwort auf Ihre Frage gefunden? Schreiben Sie uns gerne
              eine E-Mail an
              <a href="mailto:gaminghotel@tomatenbot.com">
                gaminghotel@tomatenbot.com
              </a>
              , und wir werden Ihnen so schnell wie möglich weiterhelfen.
            </p>
          </section>
        </section>
      </article>
    </main>
    <?php 
      include(__DIR__ . '/components/footer.php');
    ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>
</html>