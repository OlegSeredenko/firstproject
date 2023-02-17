<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';
//проверка авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    $_SESSION['messageFromBlog'] = 'Записи в блог могут оставлять только авторизированные пользователи';
    header('Location: /toBlog');
    die();
}

$titleBlog = mysqli_real_escape_string($connect, $_POST['titleBlog']);
$textareaBlog = mysqli_real_escape_string($connect, $_POST['textareaBlog']);
$user_id = $_SESSION['user']['id'];
//сообщение об ошибке, если пользователь не загрузит изображение
if (empty($_FILES['imageBlog']['tmp_name'])) {
    $_SESSION['messageFromBlog'] = 'Без изображения запись не будет опубликована';
    header('Location: /toBlog');
    die();
} else {
    $img = $_FILES['imageBlog']['tmp_name'];
}
//получение расширения и размера изображения
$size_img = getimagesize($_FILES['imageBlog']['tmp_name']);

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
//создание нового изображения, в котрое будет вставлено изображение от пользователя
$dest = imagecreatetruecolor($size_img[0], $size_img[1]);
imagecopyresampled($dest, $src, 0, 0, 0, 0, $size_img[0], $size_img[1], $size_img[0], $size_img[1]);
//сохранение изображения и текста в блог от пользователя в БД

switch ($size_img['mime']) {
    case 'image/jpeg':
        $pathB = "uploadsBlog/" . time() . $_FILES['imageBlog']['name'];
        if (!imagejpeg($dest, '../' . $pathB)) {
            $_SESSION['message'] = 'Ошибка при загрузке файла';
            header('Location: /toBlog');
        }
        mysqli_query($connect, "INSERT INTO `posts` (id, title, text, insertedOn, userId, img) VALUES (NULL, '$titleBlog', '$textareaBlog', NOW(), $user_id, '$pathB' )");
        header('Location: /toBlogShow');
        break;
    case 'image/gif':
        $pathB = "uploadsBlog/" . time() . $_FILES['imageBlog']['name'];
        if (!imagegif($dest, '../' . $pathB)) {
            $_SESSION['message'] = 'Ошибка при загрузке файла';
            header('Location: /toBlog');
        }
        mysqli_query($connect, "INSERT INTO `posts` (id, title, text, insertedOn, userId, img) VALUES (NULL, '$titleBlog', '$textareaBlog', NOW(), $user_id, '$pathB' )");
        header('Location: /toBlogShow');
        break;
    case 'image/png':
        $pathB = "uploadsBlog/" . time() . $_FILES['imageBlog']['name'];
        if (!imagepng($dest, '../' . $pathB)) {
            $_SESSION['message'] = 'Ошибка при загрузке файла';
            header('Location: /toBlog');
        }
        mysqli_query($connect, "INSERT INTO `posts` (id, title, text, insertedOn, userId, img) VALUES (NULL, '$titleBlog', '$textareaBlog', NOW(), $user_id, '$pathB' )");
        header('Location: /toBlogShow');
        break;
}
