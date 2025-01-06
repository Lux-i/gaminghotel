<nav class="navbar navbar-expand-md">
  <div class="container ms-1">
    <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        </button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link navlink" aria-current="page" href="/index.php">Hauptseite</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/news.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/hilfe.php">Hilfe</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/buchen.php" <?php if ($_SESSION['logged'] != true) {
              echo 'hidden';
            } ?>>Buchung</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/meine_buchungen.php" <?php if ($_SESSION['logged'] != true) {
              echo 'hidden';
            } ?>>Meine Buchungen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/reservierungen.php" <?php if ($_SESSION['logged'] != true || $user['rolle'] != 'admin') {
              echo 'hidden';
            } ?>>Reservierungen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/users.php" <?php if ($_SESSION['logged'] != true || $user['rolle'] != 'admin') {
              echo 'hidden';
            } ?>>Userpanel</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>