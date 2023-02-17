<?php
require $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";

$connect = mysqli_connect(HOST, NAME, PASSWORD, DATABASE);


if (!$connect) {
    die('Ошибка подключения к базе данных');
}
/*
try {
    if (!$connect) {
        throw new Exception('Ошибка подключения к базе данных');
    }
}catch (Exception $e) {
    echo $e->getMessage();
}*/