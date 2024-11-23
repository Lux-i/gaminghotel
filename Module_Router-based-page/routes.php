<?php
$routes = [
    "/Module_Router-based-page/index.php" => [
        "path" => "./pages/main.php",
        "header" => true,
        "nav" => true,
        "footer" => true,
        "title" => "Home"
    ],
    "/about" => [
        "path" => "./pages/about.php",
        "header" => true,
        "nav" => true,
        "footer" => true,
        "title" => "About Us"
    ],
    "/error" => [
        "path" => "./pages/error.php",
        "header" => false,
        "nav" => false,
        "footer" => false,
        "title" => "Error"
    ]
];
?>