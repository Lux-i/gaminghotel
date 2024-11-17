<?php
  include(__DIR__ . '/news-articles.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buchen | Göppel & Göppel Hotels</title>
    <?php
      include(__DIR__ . '/../components/main_style.php');
    ?>
    <link rel="stylesheet" href="../css/news.css">
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
      echo '<h1 class="text-center">News</h1>';
      include(__DIR__ . '/../components/in_work.php');
    ?>

    <?php foreach ($articles as $article): ?>
      <section class="container w-75 news-pre text-start p-0">
        <section class="txt-container">
          <h2><?= htmlspecialchars($article["title"]) ?></h2>
          <p><?= htmlspecialchars($article["sub"]) ?></p>
        </section>
        <section class="img-container">
          <img src="<?= htmlspecialchars($article["imgpath"])?>"/>
        </section>
      </section>
    <?php endforeach; ?>
    
    <?php  
      include(__DIR__ . '/../components/footer.php');
    ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>
</html>