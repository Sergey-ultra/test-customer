-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 28 2022 г., 11:12
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `customer`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `author_name`) VALUES
(1, 'Стругацкие'),
(2, 'Некрасов'),
(3, 'Толстой'),
(4, 'Лермонтов'),
(5, 'Достоевский'),
(6, 'Пушкин'),
(7, 'Булгаков'),
(8, 'Шолохов'),
(9, 'Тургенев'),
(10, 'Горький');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `book_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author_id`, `book_title`) VALUES
(1, 1, 'Книга 1'),
(2, 2, 'Книга 2'),
(3, 3, 'Книга 3'),
(4, 4, 'Книга 4'),
(5, 5, 'Книга 5'),
(6, 6, 'Книга 6'),
(7, 7, 'Книга 7'),
(8, 8, 'Книга 8'),
(9, 9, 'Книга 9'),
(10, 10, 'Книга 10');

-- --------------------------------------------------------

--
-- Структура таблицы `book_customer`
--

CREATE TABLE `book_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_customer`
--

INSERT INTO `book_customer` (`id`, `customer_id`, `book_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(5, 2, 4),
(4, 2, 9),
(6, 2, 10),
(10, 3, 1),
(7, 3, 8),
(8, 3, 9),
(9, 3, 10),
(11, 4, 4),
(12, 4, 5),
(13, 5, 7),
(14, 5, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL COMMENT '0 – пол не указан, 1 - юноша, 2 - девушка.',
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `gender`, `date`) VALUES
(1, 'Андрей', 1, '2003-02-26 21:00:00'),
(2, 'Маша', 2, '2000-02-07 21:00:00'),
(3, 'Сергей', 1, '1978-08-07 21:00:00'),
(4, 'Лена', 2, '1990-05-07 21:00:00'),
(5, 'Мария', 2, '1989-08-08 21:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `book_customer`
--
ALTER TABLE `book_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`,`book_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `book_customer`
--
ALTER TABLE `book_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
