<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/config/connect.php";

$fullname = $_POST['fullname'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
// извлекаем всю информацию из таблица по этому логину
global $pdo;
$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `login`= ?");
$stmt->execute([$login]);
$check_login = [];
while ($row = $stmt->fetch())
{
    $check_login[] = $row;
}
unset($stmt);

if (!empty($check_login)) {
    // проверка на уникальность логина
    $_SESSION['message'] = 'Данный логин уже занят';
    header('Location: /register');
} elseif (strlen($password) < 4) {
    // проверка - пароль должен быть длиной от 4 символов
    $_SESSION['message'] = 'Пароль слишком короткий';
    header('Location: /register');
} elseif (!ctype_alnum($password)) {
    // проверка - пароль должен состоять только из букв и цифр
    $_SESSION['message'] = 'Пароль может состоять только из цифр и букв';
    header('Location: /register');
} elseif ($password === $password_confirm) {
    // проверка допустимых расширений
    $srcFileName = strtolower($_FILES['avatar']['name']);
    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF'];
    $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
    if ((!in_array($extension, $allowedExtensions)) && ($_FILES['avatar']['name'] != '')) {
        $_SESSION['message'] = 'Загрузка файлов с таким расширением запрещена';
        header('Location: /register');
    } else {
        // загрузка файла в папку
        $path = "uploads/" . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке файла';
            header('Location: /register');
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            global $pdo;
            $sql = "INSERT INTO `users` (`id`, `fullname`, `login`, `email`, `password`, `avatar`) 
            VALUES (NULL, '$fullname', '$login', '$email', '$password', '$path')";
            $affectedRowsNumber = $pdo->exec($sql);
            unset($sql);
            echo "Обновлено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: /profile');
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: /register');
}
