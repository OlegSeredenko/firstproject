<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
var_dump($_SESSION['user']['avatar']);
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';
$getMessageBlogForEdit = getMessageBlogForEdit(49);
$x = $getMessageBlogForEdit[0]['img'];
unlink(dirname(__FILE__) . '/' . $x);
var_dump($getMessageBlogForEdit[0]['img']);
*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';


//то же самое для страницы с блогом
if ($_SERVER['REQUEST_URI'] == '/toBlogShow') {
    require_once 'templates/toBlogShow.php';
    die();
}
//то же самое для страницы для записей для блога
if ($_SERVER['REQUEST_URI'] == '/toBlog') {
    require_once 'templates/toBlog.php';
    die();
}
//то же самое для страницы обратной связи
if ($_SERVER['REQUEST_URI'] == '/feedback') {
    require_once 'templates/feedback.php';
    die();
}
//то же самое для погоды и валюты
if ($_SERVER['REQUEST_URI'] == '/apiShow') {
    require_once 'templates/apiShow.php';
    die();
}
//то же самое для страницы регистрации
if ($_SERVER['REQUEST_URI'] == '/register') {
    require_once 'templates/register.php';
    die();
}
//то же самое для страницы профиля
if ($_SERVER['REQUEST_URI'] == '/profile') {
    require_once 'templates/profile.php';
    die();
}
//то же самое для страницы редактирования профиля
if ($_SERVER['REQUEST_URI'] == '/profileEdit') {
    require_once 'templates/profileEdit.php';
    die();
}
if ($_SERVER['REQUEST_URI'] == '/profileEditHandler') {
    require_once 'templates/profileEditHandler.php';
    die();
}
//то же самое для страницы авторизации
if ($_SERVER['REQUEST_URI'] == '/signin') {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        require_once 'templates/signin.php';
    } else {
        require_once 'templates/auth.php';
    }
    die();
}

if (!empty($_SESSION['user'])) {
    header('Location: /templates/profile.php');
} else {
    header('Location: /signin');
}
die();
