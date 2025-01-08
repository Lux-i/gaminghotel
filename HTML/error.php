<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error 404</title>
    <?php
    include(__DIR__ . '/../components/main_style.php');
    ?>
</head>

<body>
    <?php
    include(__DIR__ . '/../components/header.php');
    include(__DIR__ . '/../components/nav.php');
    ?>
    <main class="flex-column">
        <section>
            <h1 class="text-center">Error 404</h1>
            <br>
            <h2 class="text-center">Die Seite die Sie versucht haben aufzurufen, existiert nicht!</h2>
        </section>
        <section class="data-splitter"></section>
        <section class="d-flex flex-column justify-content-center">
            <h3 class="text-center">Eine dieser Seiten Gesucht?</h3>
            <section class="d-flex flex-column mx-auto">
                <a href="/HTML/hilfe.php" class="btn btn-primary mb-2">Hilfe</a>
                <a href="/HTML/news.php" class="btn btn-primary mb-2">News</a>
                <a href="/HTML/buchen.php" class="btn btn-primary mb-2">Buchen</a>
                <a href="/" class="btn btn-primary mb-2">Zurück zur Startseite</a>
            </section>
            <h4 class="text-center">Oder schauen sie zu unserer <a href="/sitemap.html">Sitemap</a></h4>
        </section>
    </main>
    <?php
    include(__DIR__ . '/../components/footer.php');
    ?>
</body>

</html>