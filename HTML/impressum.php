<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Impressum | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
    <link rel="stylesheet" href="/CSS/impressum.css" />
  </head>
  <body class="ghostwhite" id="impressum">
    <?php 
      include(__DIR__ . '/../components/header.php');
    ?>
    <?php 
      include(__DIR__ . '/../components/nav.php');
    ?>
    <main class="flex-column">
      <article id="impress-data-field">
        <h2 class="border-bottom-cream" id="page-title">Impressum</h2>
        <section class="data-splitter">
          <p class="impress-data" id="hotelname">Göppel & Göppel Wien</p>
          <p class="impress-data" id="name">Göppel & Göppel Hotels GmbH</p>
          <p class="impress-data" id="addr">
            Goldschlagstraße 30<br />
            1150 Wien<br />
            Österreich
          </p>
        </section>
        <section class="data-splitter">
          <p class="impress-data" id="mail">
            E-Mail: if24b041@technikum-wien.at
          </p>
          <p class="impress-data" id="telefon">Tel. +43 6763470022</p>
        </section>
        <section class="data-splitter">
          <p class="impress-data" id="mitgliedschaften">
            Wirtschaftskammer Wien
          </p>
          <p class="impress-data" id="uid">UID-Nr: ATU69205734</p>
          <p class="impress-data" id="fn">Firmenbuchnummer: FN 947593a</p>
          <p class="impress-data" id="fng">Handelsgericht Wien</p>
          <p class="impress-data" id="gegenstand">Hotelbetreibung</p>
        </section>
        <section class="data-splitter">
          <p class="impress-data" id="recht">
            Berufsrecht:
            <br />
            <a
              href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&Gesetzesnummer=10007517"
              >Gewerbeordnung:</a
            >
            <a href="http://www.ris.bka.gv.at/">www.ris.bka.gv.at</a>
          </p>
          <p class="impress-data" id="behörte">Magistrat der Stadt Wien</p>
        </section>
        <section class="data-splitter">
          <h3 class="border-bottom-cream" id="mb_title">Hinter dem Projekt</h3>
          <section class="mitarbeitende flex-row jstfy-space-around">
            <section class="mitarbeiter flex-column center-items">
              <img
                class="impress-data mb_picture"
                src="/Public/Images/Luxor_ESVÖ.jpg" />
              <p class="impress-data mb_name">Lucjan Lubomski</p>
            </section>
            <section class="mitarbeiter flex-column center-items">
              <img
                class="impress-data mb_picture"
                src="/Public/Images/IMG-20230514-WA0019.jpg" />
              <p class="impress-data mb_name">Kacper Titowski</p>
            </section>
          </section>
        </section>
        <section class="data-splitter">
          <section
            class="impress-data disclaimer border-top-cream"
            id="disclaimer_legal">
            <p>
              WICHTIGER DISCLAIMER:<br /><br />
              Diese Seite ist ein Schulprojekt und ist in jedem Szenario als
              solches zu sehen.<br />
              <br />
              Diese Seite steht nicht in Verbindung mit dem Gewerbe "GISA-Zahl:
              36751129" von "Lucjan Lubomski",<br />
              sowie ist diese Seite kein Erzeugnis und/oder Produkt dieses
              Gewerbes.<br />
              Diese Seite ist unter keinem Umstand als gewerbliche Tätigkeit des
              Gewerbes zuzuordnen.<br />
              <br />
              Der komplette Inhalt dieser Seite ist fiktiv.
              <br /><br />
            </p>
            <p>
              Daten des Gewerbes:<br />
              Lucjan Przemysław Lubomski<br />
              Forsthausgasse 26B/2/2<br />
              1200 Wien
            </p>
            <p>GISA-Zahl: 36751129</p>
            <p>Behörde: Magistrat der Stadt Wien</p>
            <p>
              Dienstleistungen in der automatischen Datenverarbeitung und
              Informationstechnik
            </p>
          </section>
        </section>
      </article>
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
