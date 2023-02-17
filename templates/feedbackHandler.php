<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';

$name_feedback = htmlspecialchars(trim($_POST['name_feedback']));
$email_feedback = htmlspecialchars(trim($_POST['email_feedback']));
$header_feedback = htmlspecialchars(trim($_POST['header_feedback']));
$message_feedback = htmlspecialchars(trim($_POST['message_feedback']));

$_SESSION['name_feedback'] = $name_feedback;
$_SESSION['email_feedback'] = $email_feedback;
$_SESSION['header_feedback'] = $header_feedback;
$_SESSION['message_feedback'] = $message_feedback;

if (strlen($_SESSION['name_feedback']) <= 1) {
    $_SESSION['error_name_feedback'] = "Введите корректное имя";
    redirect();
} elseif (strlen($_SESSION['email_feedback']) <= 4) {
    $_SESSION['error_email_feedback'] = "Вы ввели некорректный email";
    redirect();
} elseif (strlen($_SESSION['header_feedback']) <= 3) {
    $_SESSION['error_header_feedback'] = "Вы не указали тему сообщения";
    redirect();
} else {
    $header_feedback = "=?utf-8?B?" . base64_encode($header_feedback) . "?=";
    $headers = "From: $email_feedback\r\nReply-to: $email_feedback\r\nContent-type:text/plain; charset=utf-8\r\n";
    mail("seredenich@yandex.ru", $header_feedback, $message_feedback, $headers);
    $_SESSION['success_mail_feedbakc'] = "Вы успешно отправили письмо";
    redirect();
}
