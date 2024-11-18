<?php
    include('./news-articles.php');

    if(empty($_GET['id'])){
        header('Location: news.php');
        die();
    }

    $article = null;
    foreach ($articles as $a) {
        if($a['id'] == $_GET['id']){
            $article = $a;
            break;
        }
    }

    if($article == null){
        header('Location: news.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title']?></title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
    <link rel="stylesheet" href="../css/news.css">
</head>
<body>
    <article class="container text-start p-0">
        <section class="txt-container">
            <h1><?= $article['title'];?></h1>
            <h2><?= $article['sub'];?></h2>
        </section>
        <section class="img-container">
            <img src="<?= $article['imgpath'] ?>"/>
        </section>
        <section class="txt-container">
            <p><?= $article['content'];?></p>
        </section>
    </article>
</body>
</html>