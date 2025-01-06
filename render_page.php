<?php
if ($USE_HEADER)
    include __DIR__ . "/components/header.php";
if ($USE_NAV)
    include __DIR__ . "/components/nav.php";
include $PAGE_PATH;
if ($USE_FOOTER)
    include __DIR__ . "/components/footer.php";
?>