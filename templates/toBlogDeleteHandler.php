<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';

$post_idEdit = $_SESSION['id'];
var_dump($post_idEdit);

if (!empty($_SESSION['id'])) {
    blogDelete($post_idEdit);
    header('Location: /templates/toBlogShow.php');
    die();
}
