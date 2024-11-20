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
    <link rel="stylesheet" href="/CSS/login-register.css" />
  </head>
  <body class="ghostwhite">
    <?php 
      include(__DIR__ . '/../components/header.php');
      include(__DIR__ . '/../components/nav.php');
      echo '<h1 class="text-center">News</h1>';
      include(__DIR__ . '/../components/in_work.php');
    ?>
<?php if ($_SESSION['logged'] == true) : ?> 

  <main class="d-flex flex-row">
    <section class="login-window mb-3 w-75">
    <form action="/components/upload.php" method="POST" enctype="multipart/form-data">
      <h2 class="border-bottom-black">Neuer Artikel</h2>
      <div class="mb-4">
        <label for="file">Banner</label>
        <input id="file" name="file" type="file" class="inputfield container-md form-control">
      </div>
      <div class="mb-4">
        <label for="title">Titel</label>
        <input id="title" type="text" class="inputfield container-md form-control">
      </div>
      <div class="mb-4">
        <label for="content">Inhalt</label>
        <textarea class="inputfield container-md form-control" name="content" id="content" rows="4" cols="50"></textarea>
      </div>
      <div class="d-flex justify-content-center">
        <input class="submit_button w-25" type="submit" name="submit" value="Veröffentlichen" />
      </div>
    </form>
    </section>
  </main>

  <?php else : ?>

    <?php endif; ?>

    <?php foreach ($articles as $article): ?>
      <a href="article.php?id=<?= urlencode($article['id']) ?>"
      class="d-block text-decoration-none text-reset container w-75 news-pre text-start p-0">
        <section class="txt-container">
          <h2><?= htmlspecialchars($article["title"]) ?></h2>
          <p><?= htmlspecialchars($article["sub"]) ?></p>
        </section>
        <section class="img-container">
          <img src="<?= htmlspecialchars($article["imgpath"])?>"/>
        </section>
      </a>
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