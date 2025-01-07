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
        "register" => [
            "path" => "./HTML/register.php",
            "Title" => "Register"
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
        "meine_buchungen" => [
            "path" => "./HTML/meine_buchungen.php",
            "Title" => "Meine Buchungen"
        ],
        "reservierungen" => [
            "path" => "./HTML/reservierungen.php",
            "Title" => "Reservierungsmanager"
        ],
        "reservierung" => [
            "path" => "./HTML/reservierung.php",
            "Title" => "Reservierungsmanager"
        ],
        "userpanel" => [
            "path" => "./HTML/users.php",
            "Title" => "Usermanager"
        ],
        "user" => [
            "path" => "./HTML/user.php",
            "Title" => "Usermanager"
        ],
        "impressum" => [
            "path" => "./HTML/impressum.php",
            "Title" => "Impressum"
        ],
        "sitemap" => [
            "path" => "./sitemap.html",
            "Title" => "Sitemap",
            "header" => false,
            "nav" => false,
            "footer" => false
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