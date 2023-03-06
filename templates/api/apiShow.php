<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/api/apiExchange.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/api/apiWeather.php';

?>
<!doctype html>
<html lang="ru">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/head.php"?>
    <body>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php"?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <!--Один из трех столбцов-->
                    </div>
                    <div class="weather" ><small>
                        <?php echo "г.Краснодар " . "<br>";
                        echo "Небо " . $resultApiWeather['sky'] . "<br>";
                        echo "Температура " . $resultApiWeather['temp'] . " ℃" . "<br>";
                        echo "Ощущается как " . $resultApiWeather['feels_like'] . " ℃" . "<br>";
                        echo "Давление " . $resultApiWeather['pressure'] . " мм рт.ст." . "<br>";
                        echo "Видимость " . $resultApiWeather['humidity'] . " метров";
                        ?></small>
                    </div>
                    <div class="exchange" ><small>
                        <?php echo "Евро " . $resultApiExchange['eur'] . " рублей" . "<br>";
                        echo "Доллар " . $resultApiExchange['usd'] . " рублей" . "<br>";
                        ?></small>
                    </div>
                    <div class="col-md">
                        <!--Один из трех столбцов-->
                    </div>
                </div>
            </div>
        </main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php"?>
    </body>
</html>