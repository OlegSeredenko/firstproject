<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';

$post_idEdit = (int)$_SESSION['id'];

if (!empty($_SESSION['id'])) {
    blogDelete($post_idEdit);
    header('Location: /toBlogShow');
    die();
}
