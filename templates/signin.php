<?php

$login = mysqli_real_escape_string($connect, $_POST['login']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
if (mysqli_num_rows($check_user) <= 0) {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: /signin');
    die();
}

$user = mysqli_fetch_assoc($check_user);
/*не получилось пока
try{
    if (!password_verify($password, $user['password'])) {
        throw new Exception('Ошибка');
    }
}catch (Exception $e) {
    echo $e->getMessage();
}*/

if (password_verify($password, $user['password'])) {
    $_SESSION['user'] = [
        "id" => $user['id'],
        "fullname" => $user['fullname'],
        "avatar" => '../'. $user['avatar'],
        "email" => $user['email']
    ];
    // если пользователь не загрузил файл, то в профиле будет отображён аватар по умолчанию
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    // вырезаем расширение из имени файла
    $y = substr($_SESSION['user']['avatar'], -3);
    if (!in_array($y, $allowedExtensions)) {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "fullname" => $user['fullname'],
            "avatar" => "../assets/images/base_avatar.JPG",
            "email" => $user['email']
        ];
    }
    header('Location: /profile');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: /signin');
}
