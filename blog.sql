-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 06 2023 г., 10:24
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `insertedOn` datetime DEFAULT NULL,
  `userId` int UNSIGNED DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `insertedOn`, `userId`, `img`) VALUES
(33, 'Вьетнам', 'Более 80 % территории Вьетнама занимают низкие и средневысотные горы. На севере друг параллельно другу протягиваются глыбово-складчатые хребты юго-восточного простирания — Хоангльеншон (с высшей точкой Вьетнама горой Фаншипан — 3143 м), Шусунгтяотяй, Шамшао, разделённые узкими, глубокими продольными долинами. Вдоль западной границы протягиваются горы Чыонгшон (Аннамские горы). В центральной и южной части страны расположены цокольные и базальтовые плато — Плейку, Даклак, Ламвьен, Зилинь, составляющие Центральное плато.', '2023-02-10 08:33:06', 2, 'uploadsBlog/1676007186v.jpg'),
(34, 'Мьянма', 'Мьянма граничит с Индией (1463 км) и Бангладеш (193 км) на западе, с Китаем (2185 км) на северо-востоке, с Лаосом (235 км) на востоке, с Таиландом (1800 км) на юго-востоке. С юга и юго-запада её берега омываются водами Бенгальского залива и залива Моутама (Мартабан), а также Андаманского моря. Площадь страны, включая прилегающие острова, составляет 678 тыс. км², длина береговой линии — 1930 км.', '2023-02-10 08:34:40', 2, 'uploadsBlog/1676007280Bagan,_Burma.jpg'),
(35, 'Бангладеш', 'Бангладеш расположена в дельте рек Брахмапутра и Ганг. Дельта образована в месте слияния рек Ганг (местное название Падма), Брахмапутра (Джамуна) и Мегхна и их притоков. Ганг сливается с Джамуной (главный канал Брахмапутры) и затем, слившись с Мегхной, впадает в Бенгальский залив. Отложения рек создают в дельте наиболее удобренные плантации в мире. Бангладеш имеет 58 трансграничных рек, и вопросы, возникающие при использовании водных ресурсов, являются очень острыми при обсуждении с Индией[54]. Большая часть страны расположена лишь на несколько метров выше уровня моря, и есть предположение, что 10 % страны будет затоплено при повышении уровня моря на один метр[55].', '2023-02-10 08:45:12', 2, 'uploadsBlog/1676007912bang.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname`, `login`, `email`, `password`, `avatar`) VALUES
(1, 'Oleg', 'Oleg', 'Oleg@Oleg.com', '$2y$10$L1qQn5R6eRz4mA3/vo6BT.tgWqD9I5WmtEHVtfSKjpw13YPckwBkC', 'uploads/1674552576Fh7HOfwXEAA9L52.jpg'),
(2, 'Dima', 'Dima', 'Dima@Dima.com', '$2y$10$Ph5UyvJ.Gz18Mewub2VeA.txyiU5DHMBlpgXh8I.Bl/o6cqaqaeay', 'uploads/1678086428FotFhAQXsAALOBv.jpg'),
(8, 'Kira', 'Kira', 'Kira@Kira.com', '$2y$10$CDuutYwDBE4YPAJNTirIkeE1VEYmLau0G1Fg8xicKiKRRovWy0HeG', 'uploads/1677353434'),
(9, 'Nika', 'Nika', 'Nika@Nika.com', '$2y$10$7B.GwDhX2fIydn5m6XjuueBZPfw8UC2EseDwML2UV5qn2tmC9CCHa', 'uploads/1677523829');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
