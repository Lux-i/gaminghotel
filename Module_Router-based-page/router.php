<?php
    include "routes.php";

    //change to get route from link
    $currentRoute = "/";
    $currentPage = $routes[$currentRoute];
    $title = $currentPage["title"];
    $filePath = $currentPage["path"];
?>