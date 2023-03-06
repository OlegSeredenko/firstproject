<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';

$titleBlogEdit = $_POST['titleBlogEdit'];
$textareaBlogEdit = $_POST['textareaBlogEdit'];

$post_idEdit = $_SESSION['id'];

if (!empty($_POST['titleBlogEdit'])) {
    try {
        global $pdo;
        $sql = "UPDATE `posts` SET `title` = '$titleBlogEdit'  WHERE `id` = '$post_idEdit'";
        $affectedRowsNumber = $pdo->exec($sql);
        unset($sql);
        echo "Обновлено строк: $affectedRowsNumber";
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
if (!empty($_POST['textareaBlogEdit'])) {
    try {
        global $pdo;
        $sql = "UPDATE `posts` SET `text` = '$textareaBlogEdit'  WHERE `id` = '$post_idEdit'";
        $affectedRowsNumber = $pdo->exec($sql);
        unset($sql);
        echo "Обновлено строк: $affectedRowsNumber";
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

if (!empty($_FILES['imageBlogEdit']['tmp_name'])) {
    // unlink('../' . $getMessageBlogForEdit[0]['img']); // как удалить картинку
    // unlink(dirname(__FILE__) . '/' . $v);// как удалить картинку

    $img = $_FILES['imageBlogEdit']['tmp_name'];
    // получение расширения и размера изображения
    $size_img = getimagesize($_FILES['imageBlogEdit']['tmp_name']);
    
    switch ($size_img['mime']) {
        case 'image/jpeg':
            $src = imagecreatefromjpeg($img);
            $ext = "jpg";
            break;
        case 'image/gif':
            $src = imagecreatefromgif($img);
            $ext = "gif";
            break;
        case 'image/png':
            $src = imagecreatefrompng($img);
            $ext = "png";
            break;
        default:
    }
    // создание нового изображения, в котрое будет вставлено изображение от пользователя
    $dest = imagecreatetruecolor($size_img[0], $size_img[1]);
    imagecopyresampled($dest, $src, 0, 0, 0, 0, $size_img[0], $size_img[1], $size_img[0], $size_img[1]);
    // сохранение изображения и текста в блог от пользователя в БД
    switch ($size_img['mime']) {
        case 'image/jpeg':
            $pathB = "uploadsBlog/" . time() . $_FILES['imageBlogEdit']['name'];
            if (!imagejpeg($dest, '../../' . $pathB)) {
                $_SESSION['messmessageFromBlogage'] = 'Ошибка при загрузке файла';
                header('Location: /toBlog');
            }
            try {
                global $pdo;
                $sql = "UPDATE `posts` SET `img` = '$pathB'  WHERE `id` = '$post_idEdit'";
                $affectedRowsNumber = $pdo->exec($sql);
                echo "Обновлено строк: $affectedRowsNumber";
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        case 'image/gif':
            $pathB = "uploadsBlog/" . time() . $_FILES['imageBlogEdit']['name'];
            if (!imagegif($dest, '../../' . $pathB)) {
                $_SESSION['messageFromBlog'] = 'Ошибка при загрузке файла';
                header('Location: /toBlog');
            }
            try {
                global $pdo;
                $sql = "UPDATE `posts` SET `img` = '$pathB'  WHERE `id` = '$post_idEdit'";
                $affectedRowsNumber = $pdo->exec($sql);
                echo "Обновлено строк: $affectedRowsNumber";
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        case 'image/png':
            $pathB = "uploadsBlog/" . time() . $_FILES['imageBlogEdit']['name'];
            if (!imagepng($dest, '../../' . $pathB)) {
                $_SESSION['messageFromBlog'] = 'Ошибка при загрузке файла';
                header('Location: /toBlog');
            }
            try {
                global $pdo;
                $sql = "UPDATE `posts` SET `img` = '$pathB'  WHERE `id` = '$post_idEdit'";
                $affectedRowsNumber = $pdo->exec($sql);
                echo "Обновлено строк: $affectedRowsNumber";
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
    }
}
header('Location: /toBlogShow');
