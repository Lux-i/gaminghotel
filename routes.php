<?php
$routes = [
    "/" => [
        "default" => [
            "path" => "./HTML/main.php",
            "Title" => "Home"
        ],
        "hilfe" => [
            "path" => "./HTML/hilfe.php",
            "Title" => "Hilfe"
        ],
        "login" => [
            "path" => "./HTML/login.php",
            "Title" => "Login"
        ],
        "news" => [
            "path" => "./HTML/news.php",
            "Title" => "News"
        ],
        "artikel" => [
            "path" => "./HTML/article.php",
            "Title" => "Artikel"
        ],
        "buchen" => [
            "path" => "./HTML/buchen.php",
            "Title" => "Buchen"
        ],
        "me" => [
            "path" => "./HTML/me.php",
            "Title" => "Mein Konto"
        ],
        "logout" => [
            "path" => "./actions/logout.php",
            "Title" => "Logging out..."
        ]
    ],
    "error" => [
        "path" => "./HTML/error.php",
        "header" => true,
        "nav" => false,
        "footer" => true,
        "Title" => "Error - Page not found",
        "error" => true
    ]
];
?>