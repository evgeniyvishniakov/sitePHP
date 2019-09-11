-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 11 2019 г., 16:44
-- Версия сервера: 5.7.23
-- Версия PHP: 7.1.22

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
  `brands_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `brands_value`) VALUES
(1, 'Альфашина'),
(2, 'Белшина'),
(3, 'Росава'),
(4, 'Мишлен');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `categories_value`) VALUES
(1, 'Шины'),
(2, 'Диски'),
(3, 'Услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `diameter`
--

CREATE TABLE `diameter` (
  `id` int(11) NOT NULL,
  `diameter_value` varchar(32) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `diameter`
--

INSERT INTO `diameter` (`id`, `diameter_value`) VALUES
(1, 'R13'),
(2, 'R14'),
(3, 'R15'),
(4, 'R16'),
(5, 'R17');

-- --------------------------------------------------------

--
-- Структура таблицы `height`
--

CREATE TABLE `height` (
  `id` int(11) NOT NULL,
  `height_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `height`
--

INSERT INTO `height` (`id`, `height_value`) VALUES
(1, 55),
(2, 60),
(3, 65),
(4, 70),
(5, 75),
(6, 80),
(7, 85),
(8, 90),
(9, 95);

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
(23, 'Natalia', 'kolesniknat@gmail.com', 'd386b4689edef1642c6db966b1274950'),
(24, 'Evgenie', 'veshnikovsffriy@gmail.com', 'd386b4689edef1642c6db966b1274950'),
(25, 'Evgeniu', 'nataliiakolesfnik0496@gmail.com', 'd386b4689edef1642c6db966b1274950'),
(26, 'Loginss', 'veshnikovsriy@gmail.com', '508a212a8674fadc9e56b31899e82595'),
(28, 'Loginss', 'veshnikovsriy@gmail.com', '508a212a8674fadc9e56b31899e82595'),
(29, 'Loginss', 'veshnikovsriy@gmail.com', '508a212a8674fadc9e56b31899e82595');

-- --------------------------------------------------------

--
-- Структура таблицы `season`
--

CREATE TABLE `season` (
  `id` int(11) NOT NULL,
  `season_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `season`
--

INSERT INTO `season` (`id`, `season_value`) VALUES
(1, 'Лето'),
(2, 'Зима'),
(3, 'Всесезонка');

-- --------------------------------------------------------

--
-- Структура таблицы `tires`
--

CREATE TABLE `tires` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `article` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `stock` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `brands_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `season_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `categories_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `width_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `height_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `diameter_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sale` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `visible` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `foto` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `foto_gallery` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tires`
--

INSERT INTO `tires` (`id`, `name`, `article`, `stock`, `brands_id`, `season_id`, `categories_id`, `width_id`, `height_id`, `diameter_id`, `price`, `sale`, `visible`, `content`, `foto`, `foto_gallery`, `data`) VALUES
(2, 'Белшина', '4645', '1', '2', '1', '1', '3', '2', '3', '5000', 'NULL', '1', 'NULL', 'premiorri-viamaggiore-16570-r14-81t-999x0.jpeg', '', NULL),
(3, 'Росава П40', '4545', '1', '3', '1', '1', '4', '4', '1', '3333', 'NULL', '1', 'NULL', '75744324_images_11336631390.jpg', '', NULL),
(4, 'Мишлен 134', '34534', '1', '4', '1', '1', '5', '6', '5', '5555', 'NULL', '1', 'NULL', '-bc-10-15570-r13-75q--999x0.jpeg', '', NULL),
(5, 'Альфашина 146', '2342', '1', '1', '1', '1', '7', '8', '3', '5555', 'NULL', '1', 'NULL', 'premiorri-viamaggiore-16570-r14-81t-999x0.jpeg', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `width`
--

CREATE TABLE `width` (
  `id` int(11) NOT NULL,
  `width_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `width`
--

INSERT INTO `width` (`id`, `width_value`) VALUES
(1, 185),
(2, 195),
(3, 205),
(4, 215),
(5, 225),
(6, 235),
(7, 245);

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
-- Индексы таблицы `diameter`
--
ALTER TABLE `diameter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `height`
--
ALTER TABLE `height`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tires`
--
ALTER TABLE `tires`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `width`
--
ALTER TABLE `width`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `diameter`
--
ALTER TABLE `diameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `height`
--
ALTER TABLE `height`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `season`
--
ALTER TABLE `season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tires`
--
ALTER TABLE `tires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `width`
--
ALTER TABLE `width`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
