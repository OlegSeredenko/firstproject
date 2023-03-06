<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/config/connect.php";

$idEditUser = $_SESSION['user']['id'];

// подготовка нового изображения пользователя
if (!empty($_FILES['newAvatar']['name'])) {
    if (isset($_SESSION['user']['avatar'])) {
        unlink($_SESSION['user']['avatar']);
    }
    $srcFileName = strtolower($_FILES['newAvatar']['name']);
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
    $path = "uploads/" . time() . $_FILES['newAvatar']['name'];
    if (!move_uploaded_file($_FILES['newAvatar']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = 'Ошибка при загрузке файла';
        header('Location: /register');
    }
    //запрос на обновление данных в БД
    try {
        global $pdo;
        $sql = "UPDATE `users` SET `avatar` = '$path'  WHERE `id` = '$idEditUser'";
        $affectedRowsNumber = $pdo->exec($sql);
        echo "Обновлено строк: $affectedRowsNumber";
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
    unset($sql);
}
// обновляем имя пользователя - логин останется старым (который указан при регситрации и с помощью которого происходит авторизация)
if (!empty($_POST['newFullname'])) {
    $newFullname = $_POST['newFullname'];
    try {
        global $pdo;
        $sql = "UPDATE `users` SET `fullname` = '$newFullname'  WHERE `id` = '$idEditUser'";
        $affectedRowsNumber = $pdo->exec($sql);
        echo "Обновлено строк: $affectedRowsNumber";
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
    unset($sql);
}
// обновляем почту пользователя
if (!empty($_POST['newEmail'])) {
    $newEmail = $_POST['newEmail'];
    try {
        global $pdo;
        $sql = "UPDATE `users` SET `email` = '$newEmail'  WHERE `id` = '$idEditUser'";
        $affectedRowsNumber = $pdo->exec($sql);
        echo "Обновлено строк: $affectedRowsNumber";
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
    unset($sql);
}
// обновляем изображение профиля и перенаправляем на страницу профиля
global $pdo;
$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id` = ?");
$stmt->execute([$idEditUser]);
$arr = [];
while ($row = $stmt->fetch())
{
    $arr[] = $row;
}
$_SESSION['user'] = [
    "id" => $arr[0]['id'],
    "fullname" => $arr[0]['fullname'],
    "avatar" => '../'. $arr[0]['avatar'],
    "email" => $arr[0]['email']
];
unset($stmt);
header('Location: /profile');
