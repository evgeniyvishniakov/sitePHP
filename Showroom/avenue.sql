-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 09 2019 г., 22:09
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `avenue`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `foto`, `name`) VALUES
(1, '', 'Puma'),
(2, '', 'Nike'),
(3, '', 'Adidas'),
(4, '', 'Reebok');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'Каталог'),
(2, 0, 'Мужское'),
(3, 0, 'Женское'),
(10, 0, 'Бренды'),
(11, 0, 'Контакты'),
(14, 0, 'Комплекты');

-- --------------------------------------------------------

--
-- Структура таблицы `child_catategories`
--

CREATE TABLE `child_catategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `child_catategories`
--

INSERT INTO `child_catategories` (`id`, `name`, `slag`) VALUES
(1, 'Куртки', 'kurtky'),
(2, 'Штаны', 'shtany'),
(3, 'Футболки', 'futbolky'),
(4, 'Шорты', 'shorty'),
(5, 'Свитерa', 'svitera'),
(6, 'Кофты', 'kofty'),
(7, 'Рубашки', 'rubashky');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Красный'),
(2, 'Зеленый'),
(3, 'Желтый'),
(4, 'Синий'),
(5, 'Коричневый'),
(6, 'Фиолетовый');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `title`) VALUES
(1, 'index', 'index', 'Главная'),
(2, 'sing', 'sing', 'Авторизация'),
(3, 'catalog', 'catalog', 'Каталог'),
(6, '404', '404', 'Ошибка');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `color` varchar(20) NOT NULL,
  `categories_name` varchar(20) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `child_cat_name` varchar(20) NOT NULL,
  `child_cat_id` int(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `foto`, `name`, `price`, `sale`, `size`, `color`, `categories_name`, `categories_id`, `child_cat_name`, `child_cat_id`, `brand`, `quantity`) VALUES
(1356, 'photo2.png', 'Спортивная кофта Puma', 200, 0, 'm', 'Зеленый', 'Женское', 3, 'Футболки', 3, 'Puma', 10),
(1392, 'ba74aa9d-2d1a-11e8-b3b3-00155d516702.jpeg', 'Штаны Adidas', 750, 50, 'm', 'Красный', 'Мужское', 2, 'Куртки', 1, 'Adidas', 10),
(1393, '8500501_2.jpg', 'Куртка', 400, 40, 'xs', 'Желтый', 'Мужское', 2, 'Куртки', 1, 'Nike', 20),
(1395, 'DSZ0023CA_1.jpg', 'Шорты Armani', 400, 40, 'xs', 'Красный', 'Мужское', 2, 'Шорты', 4, 'Adidas', 10),
(1405, 'b788688b-046d-11e9-8a80-002590da0462-8.jpeg', 'Рубашка Asos', 800, 0, 'xs', 'Коричневый', 'Женское', 3, 'Рубашки', 7, 'Puma', 10),
(1406, 'rus_plBolf-1703-69428_1.jpg', 'Рубашка Zara', 1200, 0, 'm', 'Синий', 'Мужское', 2, 'Рубашки', 7, 'Adidas', 10),
(1407, '274.jpg', 'Штаны Nike', 800, 0, 's', 'Зеленый', 'Женское', 3, 'Штаны', 2, 'Nike', 22),
(1408, '4d4fa9f0ea8e635dd5493e885687441a.jpg', 'Штаны Puma', 500, 0, 'm', 'Синий', 'Женское', 3, 'Штаны', 2, 'Puma', 8),
(1409, '0e8ea6f09f42be8be9f9f7f89259a410.jpg', 'Свитер Nike', 700, 0, 'l', 'Фиолетовый', 'Мужское', 2, 'Свитерa', 5, 'Reebok', 1),
(1410, '73411_1.jpg', 'Свитер Puma', 800, 0, 'xs', 'Синий', 'Мужское', 2, 'Свитерa', 5, 'Puma', 8),
(1411, '1.jpg', 'Кофта Reebok', 1500, 0, 'xl', 'Фиолетовый', 'Мужское', 2, 'Кофты', 6, 'Reebok', 6),
(1412, '1028534779_w640_h640_svitshot-zhenskij-kofta.jpg', 'Кофта Adidas', 700, 0, 'xl', 'Красный', 'Женское', 3, 'Кофты', 6, 'Adidas', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `register`
--

INSERT INTO `register` (`id`, `login`, `email`, `password`) VALUES
(3, 'Evgenii', 'vishniakovvv@gmail.com', 'd386b4689edef1642c6db966b1274950'),
(6, 'Evgeniiooo', 'vishniakovvccv@gmail.com', '0e3f0ba44604fb1aabcaa250db9c10fc'),
(21, 'Evgeniifff', 'vishniakovaa@gmail.com', 'a34a3ff36a654a73c12ef8b04107e741'),
(22, 'Eeniifffff', 'vishniakovaa@gmail.com', 'b9dcb7dc8474225f14d85867d28f5e10'),
(23, 'Natalia', 'kolesniknat@gmail.com', 'd386b4689edef1642c6db966b1274950');

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(1, 'xxs'),
(2, 'xs'),
(3, 's'),
(4, 'm'),
(5, 'l'),
(6, 'xl'),
(7, 'xxl'),
(8, 'xxxl');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `child_catategories`
--
ALTER TABLE `child_catategories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `child_catategories`
--
ALTER TABLE `child_catategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1413;

--
-- AUTO_INCREMENT для таблицы `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
