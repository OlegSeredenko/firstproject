<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/config/connect.php";

$idEditUser = $_SESSION['user']['id'];

// подготовка нового изображения пользователя
if (!empty($_FILES['newAvatar']['name'])) {
    unlink($_SESSION['user']['avatar']);
    $srcFileName = strtolower($_FILES['newAvatar']['name']);
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
    $path = "uploads/" . time() . $_FILES['newAvatar']['name'];
    if (!move_uploaded_file($_FILES['newAvatar']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = 'Ошибка при загрузке файла';
        //header('Location: /register');
    }
    //запрос на обновление данных в БД
    mysqli_query($connect, "UPDATE `users` SET `avatar` = '$path'  WHERE `id` = '$idEditUser'");
    //unset($_FILES['newAvatar']);
}
// обновляем имя пользователя - логин останется старым (который указан при регситрации и с помощью которого происходит авторизация)
if (!empty($_POST['newFullname'])) {
    $newFullname = $_POST['newFullname'];
    mysqli_query($connect, "UPDATE `users` SET `fullname` = '$newFullname'  WHERE `id` = '$idEditUser'");
}
// обновляем почту пользователя
if (!empty($_POST['newEmail'])) {
    $newEmail = $_POST['newEmail'];
    mysqli_query($connect, "UPDATE `users` SET `email` = '$newEmail'  WHERE `id` = '$idEditUser'");
}
// обновляем изображение профиля и перенаправляем на страницу профиля
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$idEditUser'");
if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        "id" => $user['id'],
        "fullname" => $user['fullname'],
        "avatar" => '../'. $user['avatar'],
        "email" => $user['email']
    ];
    header('Location: /profile');
}
