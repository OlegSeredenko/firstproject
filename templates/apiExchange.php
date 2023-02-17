<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

$filename = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiExchange.txt';//говорим, что вот с этим файлом будем работать - здесь хранятся данные о валютах
$filenameTime = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiExchangeTime.txt';//говорим с каким файлом с временной отметкой работаем

$dataTime = file_get_contents($filenameTime);//вытаскиваем данные с файла
$bookshelfTime = unserialize($dataTime);//преобразуем данные в читаемый формат

$new_time = time();//берём новую отметку времени, если прошло больше установленного временного промежутка, то берём новую отметку и записывем в тот же текстовый файл
if (($new_time - 21600) >  $bookshelfTime) {
    $dataTime = serialize($new_time);
    file_put_contents($filenameTime, $dataTime);
    //var_dump('время обновилось');

    $curl = curl_init(APIEXCHANGE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    $y = json_decode($response, true);
    $resultApiExchange = ['eur' => round(((1 / $y['data']["EUR"]) * $y['data']["RUB"]), 2) , 'usd' => round(($y['data']["RUB"]), 2)];
    $data = serialize($resultApiExchange);
    file_put_contents($filename, $data);
} else {
    //var_dump('время осталось старым');
    $data = file_get_contents($filename);
    $bookshelf = unserialize($data);
    $resultApiExchange = $bookshelf;
}
