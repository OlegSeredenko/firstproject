<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

$url ='https://api.openweathermap.org/data/2.5/weather';
$options = ['appid' => APIWEATHER, 'id' => 542420, 'units' => 'metric', 'lang' => 'en'];

$filename = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiWeather.txt';//говорим, что вот с этим файлом будем работать - здесь хранятся данные о валютах
$filenameTime = $_SERVER['DOCUMENT_ROOT'] . '/files/dataApiWeatherTime.txt';//говорим с каким файлом с временной отметкой работаем

$dataTime = file_get_contents($filenameTime);//вытаскиваем данные с файла
$bookshelfTime = unserialize($dataTime);//преобразуем данные в читаемый формат

$new_time = time();//берём новую отметку времени, если прошло больше установленного временного промежутка, то берём новую отметку и записывем в тот же текстовый файл
if (($new_time - 3600) >  $bookshelfTime) {
    $dataTime = serialize($new_time);
    file_put_contents($filenameTime, $dataTime);
    //var_dump('время обновилось');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($options));
    $response = curl_exec($ch);
    curl_close($ch);

    $x = json_decode($response, true);
    $resultApiWeather = ['sky' => $x['weather'][0]['description'],
    'temp' => $x['main']['temp'], 'feels_like' => $x['main']['feels_like'],
    'pressure' => round(($x['main']['pressure'] / 1.333), 2) ,
    'humidity' => $x['main']['humidity']];
    
    $data = serialize($resultApiWeather);
    file_put_contents($filename, $data);
} else {
    //var_dump('время осталось старым');
    $data = file_get_contents($filename);
    $bookshelf = unserialize($data);
    $resultApiWeather = $bookshelf;
}
