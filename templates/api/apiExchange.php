<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
// говорим, что вот с этим файлом будем работать - здесь хранятся данные о валютах
$filename = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiExchange.txt';
// говорим с каким файлом с временной отметкой работаем
$filenameTime = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiExchangeTime.txt';
// вытаскиваем данные с файла
$dataTime = file_get_contents($filenameTime);
// преобразуем данные в читаемый формат
$bookshelfTime = unserialize($dataTime);
// берём новую отметку времени, если прошло больше установленного временного промежутка, то берём новую отметку и записывем в тот же текстовый файл
$new_time = time();
if ($new_time - 21600 >  $bookshelfTime) {
    $dataTime = serialize($new_time);
    file_put_contents($filenameTime, $dataTime);
    $curl = curl_init(APIEXCHANGE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    $y = json_decode($response, true);
    $resultApiExchange = [
    'eur' => round(((1 / $y['data']["EUR"]) * $y['data']["RUB"]), 2) , 
    'usd' => round(($y['data']["RUB"]), 2)
    ];
    $data = serialize($resultApiExchange);
    file_put_contents($filename, $data);
} else {
    $data = file_get_contents($filename);
    $bookshelf = unserialize($data);
    $resultApiExchange = $bookshelf;
}
