<?php
$login = $_POST['login'];
$password = $_POST['password'];

global $pdo;
$stmt = $pdo->prepare('SELECT * FROM `users` WHERE `login` = ?');
$stmt->execute([$login]);
$user = [];
while ($row = $stmt->fetch())
{
    $user[] = $row;
}
unset($stmt);

if (password_verify($password, $user[0]['password'])) {
    $_SESSION['user'] = [
        "id" => $user[0]['id'],
        "fullname" => $user[0]['fullname'],
        "avatar" => '../'. $user[0]['avatar'],
        "email" => $user[0]['email']
    ];
    // если пользователь не загрузил файл, то в профиле будет отображён аватар по умолчанию
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    // вырезаем расширение из имени файла
    $y = substr($_SESSION['user']['avatar'], -3);
    if (!in_array($y, $allowedExtensions)) {
        $_SESSION['user'] = [
            "id" => $user[0]['id'],
            "fullname" => $user[0]['fullname'],
            "avatar" => "../assets/images/base_avatar.JPG",
            "email" => $user[0]['email']
        ];
    }
    header('Location: /profile');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: /signin');
}
