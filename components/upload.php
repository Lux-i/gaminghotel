<?php
include(__DIR__ . '/../components/header.php');
require_once('../components/dbaccess.php');
require_once('db_utils.php');

// Create connection
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDir = "../Public/uploads/";
$thumbnail = "../Public/uploads/thumbnails/";
$target_thumbnail = $thumbnail . basename($_FILES["file"]["name"]);
$target_file = $uploadDir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$upload = true;


if (validateToken($conn)) {
    if (isPermitted($conn, Permission::ADMIN)) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        } else if (!is_dir($thumbnail)) {
            mkdir($thumbnail, 0777, true);
        }

        if (isset($_FILES['file'])) {
            if ($_FILES["file"]["type"] != "image/jpeg") {
                echo "Es dürfen nur Jpg-Dateien hochgeladen werden!";
                $upload = false;
            } else if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                if (list($width, $height) = getimagesize($target_file)) {
                    $new_width = 720;
                    $new_height = 480;
                    $aspectRatio = $new_width / $new_height; // = 1.5 => width = height * 1.5 , height = width / 1.5

                    //cut the biggest possible part of the picture with the right aspect ratio and compress to $new_* size
                    //try to resize with max width
                    if ($width / $height < $aspectRatio) {
                        $cut_width = $width;
                        $cut_height = $width / $aspectRatio;
                        $src_x = 0;
                        $src_y = ($height - $cut_height) / 2;
                    } else {
                        //resize with max height, if max width is not possible
                        $cut_width = $height * $aspectRatio;
                        $cut_height = $height;
                        $src_x = ($width - $cut_width) / 2;
                        $src_y = 0;
                    }

                    $thumb = imagecreatetruecolor($new_width, $new_height);
                    $source = imagecreatefromjpeg($target_file);
                    imagecopyresized($thumb, $source, 0, 0, $src_x, $src_y, $new_width, $new_height, $cut_width, $cut_height);
                    imagejpeg($thumb, $target_thumbnail);

                    $sql = "INSERT INTO news_articles (title,content,sub,img_path,upload_date) VALUES (?,?,?,?,CURRENT_DATE())";
                    $stmt = $conn->prepare($sql);
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $sub = mb_substr($content, 0, 120) . "...";
                    $img_path = $target_thumbnail;

                    $stmt->bind_param("ssss", $title, $content, $sub, $img_path);
                    if ($stmt->execute()) {
                        header('Location: /HTML/news.php');
                    }
                    closeConnection($conn);
                }

            } else {
                echo "Error ";
            }
        }
    } else {
        echo "Sie sind nicht berechtigt, diese Aktion auszuführen!";
    }
}
?>