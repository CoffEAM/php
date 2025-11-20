-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 20 2025 г., 09:41
-- Версия сервера: 8.0.44
-- Версия PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `publications`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cats`
--

CREATE TABLE `cats` (
  `id` smallint NOT NULL,
  `family` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `age` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cats`
--

INSERT INTO `cats` (`id`, `family`, `name`, `age`) VALUES
(1, 'Lion', 'Leo', 4),
(3, 'Cheetah', 'Charlie', 3),
(7, 'Lynx', 'Stumpy', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `classics`
--

CREATE TABLE `classics` (
  `author` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` smallint DEFAULT NULL,
  `isbn` char(13) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `classics`
--

INSERT INTO `classics` (`author`, `title`, `category`, `year`, `isbn`) VALUES
('1', '1', '1', 1, '1'),
('Mark Twain (Samuel Langhorne Clemens)', 'The Adventures of Tom Sawyer', 'Classic Fiction', 1876, '978123123'),
('Jane Austen', 'Pride and Prejudice', 'Classic Fiction', 1811, '978123124'),
('Charles Darwin', 'The Origin of Species', 'NonFiction', 1856, '978123125'),
('Charles Dickens', 'The Old Curiosity Shop', 'Classic Fiction', 1841, '978123126'),
('William Shakespeare', 'Romeo and Juliet', 'Play', 1594, '978123127'),
('Herman Melville', 'Moby Dick', 'Fiction', 1851, '978123129'),
('Азиз Мамедов', 'Как стать миллионером', 'Биография', 2024, '97832123128');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isbn` varchar(13) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`name`, `isbn`) VALUES
('Joe Bloggs', '978123123'),
('Mary Smith', '978123124'),
('Jack Wilson', '978123125');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classics`
--
ALTER TABLE `classics`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `author` (`author`(20)),
  ADD KEY `title` (`title`(20)),
  ADD KEY `category` (`category`(4)),
  ADD KEY `year` (`year`);
ALTER TABLE `classics` ADD FULLTEXT KEY `author_2` (`author`,`title`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`isbn`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cats`
--
ALTER TABLE `cats`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
