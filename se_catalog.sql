-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 13 2020 г., 22:19
-- Версия сервера: 10.3.15-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `se_catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `slug`) VALUES
(3, 'new-category'),
(1, 'test-category');

-- --------------------------------------------------------

--
-- Структура таблицы `category_goods`
--

CREATE TABLE `category_goods` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_goods`
--

INSERT INTO `category_goods` (`id`, `category_id`, `goods_id`) VALUES
(1, 3, 2),
(2, 1, 2),
(9, 3, 3),
(10, 1, 3),
(11, 1, 4),
(13, 1, 6),
(23, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `slug`, `price`) VALUES
(1, 'test-goods', 22),
(2, 'new-goods', 44),
(3, 'test-goods2', 4),
(4, 'goods', 2),
(6, 'goods-with-photo', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(5, 'Goods/Goods1/987701.jpg', 1, NULL, 'Goods', '9927415507-2', ''),
(6, 'Goods/Goods1/6b988d.jpg', 1, NULL, 'Goods', '96df58d1cf-2', '');

-- --------------------------------------------------------

--
-- Структура таблицы `lang_category`
--

CREATE TABLE `lang_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `lang` enum('ru','en') NOT NULL DEFAULT 'ru',
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang_category`
--

INSERT INTO `lang_category` (`id`, `category_id`, `lang`, `name`, `description`) VALUES
(4, 3, 'ru', 'Новая категория', 'Это новая категория на русском'),
(5, 3, 'en', 'En-category', 'descriprion');

-- --------------------------------------------------------

--
-- Структура таблицы `lang_goods`
--

CREATE TABLE `lang_goods` (
  `id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `lang` enum('ru','en') NOT NULL DEFAULT 'ru',
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang_goods`
--

INSERT INTO `lang_goods` (`id`, `goods_id`, `lang`, `name`, `description`) VALUES
(1, 2, 'ru', 'Переведённый товар', 'Описание товара на русском языке'),
(4, 1, 'ru', 'Первый товар', 'Это первый добавленный товар'),
(5, 1, 'en', 'Translate test goods', 'This is how it work');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140622_111540_create_image_table', 1581585001),
('m140622_111545_add_name_to_image_table', 1581585001),
('m200213_091559_db_structure', 1581597499);

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `lang_goods_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `lang_goods_id`, `time`, `email`, `message`) VALUES
(1, 4, '2020-02-13 18:36:31', 'test@test.tt', 'привет');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `category_goods`
--
ALTER TABLE `category_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_goods_fk_category_id` (`category_id`),
  ADD KEY `category_goods_fk_goods_id` (`goods_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lang_category`
--
ALTER TABLE `lang_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_category_fk_category_id` (`category_id`);

--
-- Индексы таблицы `lang_goods`
--
ALTER TABLE `lang_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_goods_fk_goods_id` (`goods_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_fk_lang_goods_id` (`lang_goods_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `category_goods`
--
ALTER TABLE `category_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `lang_category`
--
ALTER TABLE `lang_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `lang_goods`
--
ALTER TABLE `lang_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_goods`
--
ALTER TABLE `category_goods`
  ADD CONSTRAINT `category_goods_fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_goods_fk_goods_id` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `lang_category`
--
ALTER TABLE `lang_category`
  ADD CONSTRAINT `lang_category_fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `lang_goods`
--
ALTER TABLE `lang_goods`
  ADD CONSTRAINT `lang_goods_fk_goods_id` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_fk_lang_goods_id` FOREIGN KEY (`lang_goods_id`) REFERENCES `lang_goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
