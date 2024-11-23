<?php
    include "routes.php";

    //change to extract the route from link
    $currentRoute = $_SERVER['REQUEST_URI'];
    $currentPage = $routes[$currentRoute];
    $filePath = $currentPage["path"];
    if($currentPage["header"]) include "../components/header.php";
    if($currentPage["nav"]) include "../components/nav.php";
    include $filePath;
    if($currentPage["footer"]) include "../components/footer.php";
?>