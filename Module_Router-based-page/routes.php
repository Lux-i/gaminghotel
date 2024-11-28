<?php
$routes = [
    /*"/Module_Router-based-page/index.php" => [
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
    ]*/
    "/" => [
        "Module_Router-based-page" => [
            "index.php" => [
                "path" => "./pages/main.php",
                "header" => true,
                "nav" => true,
                "footer" => true,
                "title" => "Home"
            ],
            "default" => [
                "path" => "./pages/whitepaper.php",
                "header" => true,
                "nav" => true,
                "footer" => true,
                "title" => "About Router"
            ]
        ],
        "Another Sub-path" => [
            "Test1" => [
                "path" => "./pages/test1.php",
                "header" => true,
                "nav" => true,
                "footer" => true,
                "Title" => "Test1"
            ],
            "Test2" => [
                "path" => "./pages/test2.php",
                "header" => true,
                "nav" => true,
                "footer" => true,
                "Title" => "Test2"
            ]
        ],
        "default" => [
            "path" => "./pages/main.php",
            "header" => true,
            "nav" => true,
            "footer" => true,
            "Title" => "Home"
        ]
    ],
    "error" => [
        "path" => "./pages/error.php",
        "header" => true,
        "nav" => false,
        "footer" => true,
        "Title" => "Error - Page not found",
        "error" => true
    ]
];
?>