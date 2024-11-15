<!-- Code zur dynamischen Veränderung der a_href-Links. Bis jetzt unnötig -->
<?php
  /*
  //Regex überprüfung, ob "/HTML" im Ordner des include() files enthalten ist.
  if (preg_match("/\/HTML/", __DIR__)) {
      //Wenn in /HTML und dessen subfolder, lasse string leer
      $linkPrefix = '';
  } else {
      //Wenn file im root-Ornder, addiere /HTML
      $linkPrefix = '/HTML';
  }
  */
?>

<nav class="navbar navbar-expand-sm">
  <div class="container ms-1">
    <button class="navbar-toggler d-block d-sm-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link navlink" aria-current="page" href="/index.php">Hauptseite</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/buchen.php">Buchung</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/hilfe.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/hilfe.php">Hilfe</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navlink" href="/HTML/reservierungen.php">Reservierungen</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>