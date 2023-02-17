<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/config/connect.php";

$fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
$login = mysqli_real_escape_string($connect, $_POST['login']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$password_confirm = mysqli_real_escape_string($connect, $_POST['password_confirm']);

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login`='$login'");/// извлекаем всю информацию из таблица по этому логину
if (mysqli_num_rows($check_login) > 0) {
    $_SESSION['message'] = 'Данный логин уже занят';// проверка на уникальность логина
    header('Location: /register');
} elseif (strlen($password) < 4) {
    $_SESSION['message'] = 'Пароль слишком короткий';// проверка - пароль должен быть длиной от 4 символов
    header('Location: /register');
} elseif (!ctype_alnum($password)) {
    $_SESSION['message'] = 'Пароль может состоять только из цифр и букв';// проверка - пароль должен состоять только из букв и цифр
    header('Location: /register');
} elseif ($password === $password_confirm) {
    //проверка допустимых расширений
    $srcFileName = strtolower($_FILES['avatar']['name']);
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
    if ((!in_array($extension, $allowedExtensions)) && ($_FILES['avatar']['name'] != '')) {
        $_SESSION['message'] = 'Загрузка файлов с таким расширением запрещена';
        header('Location: /register');
    } else {
        //загрузка файла в папку
        $path = "uploads/" . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке файла';
            header('Location: /register');
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `fullname`, `login`, `email`, `password`, `avatar`) 
        VALUES (NULL, '$fullname', '$login', '$email', '$password', '$path')");
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: /profile');
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: /register');
}
