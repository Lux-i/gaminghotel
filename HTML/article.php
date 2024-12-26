<?php
    include(__DIR__ . '/../components/header.php');
    include(__DIR__ . '/../components/nav.php');
    include(__DIR__ . '/news-articles.php');
    require_once('../components/dbaccess.php');
    require_once('../components/db_utils.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

    if(empty($_GET['id'])){
        header('Location: news.php');
        die();
    }

    if(validateToken($conn)){
        $sql = "SELECT * FROM news_articles WHERE id = ?";
        $id = $_GET['id'];
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            $article = $result->fetch_assoc();
        }
    }else{
        echo "Error";
    }

    closeConnection($conn);

    /*$article = null;
    foreach ($articles as $a) {
        if($a['id'] == $_GET['id']){
            $article = $a;
            break;
        }
    }

    if($article == null){
        header('Location: news.php');
        die();
    }*/
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
    <article class="container text-start px-5 mt-4 bg-secondary-subtle">
        <section class="txt-container pt-4">
            <h1 class="text-center"><?= ucfirst($article['title']);?></h1>
            <h3><?= $article['sub'];?></h3>
        </section>
        <section class="img-container">
            <img src="<?= $article['img_path'] ?>"/>
        </section>
        <section class="txt-container mt-3 pb-4">
            <p><?= $article['content'];?></p>
        </section>
    </article>
</body>
</html>