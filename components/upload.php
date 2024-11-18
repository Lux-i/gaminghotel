<?php
$uploadDir = "uploads/";
$thumbnail = "uploads/thumbnails/";
$target_thumbnail = $thumbnail . basename($_FILES["file"]["name"]);
$target_file = $uploadDir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$upload = true;



    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    if(isset($_FILES['file'])){
        if($imageFileType != "jpg"){
            echo "Es dürfen nur Jpg-Dateien hochgeladen werden!";
            $upload = false;
        }else if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
            /*if(list($width, $height) = getimagesize('target_file')){
                $thumb = imagecreatetruecolor($width, $height);
                $source = imagecreatefromjpeg($target_file);
                imagecopyresized($thumb, $source, 0,0,0,0,720,480, $width, $height);
                imagejpeg($thumb);
            }*/

            echo "Artikel abgeschickt ";
        }else{
            echo "Error ";
        }
    }
?>