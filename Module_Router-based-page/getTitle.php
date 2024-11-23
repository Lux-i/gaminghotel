<?php
    include "routes.php";

    //change to extract the route from link
    $currentRoute = $_SERVER['REQUEST_URI'];
    return $routes[$currentRoute]["title"];
?>