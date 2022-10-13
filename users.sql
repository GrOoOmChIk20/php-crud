-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 13 2022 г., 18:22
-- Версия сервера: 5.7.33
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sibers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthday` text,
  `id_admin` int(1) NOT NULL DEFAULT '0',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `gender`, `birthday`, `id_admin`, `is_deleted`) VALUES
(36, 'admin', '$2y$10$o0261yTm/ztVkYDb3/tYbO0YEEgS9njjkr.kDOHZSqEQDMCr0oJcC', 'Super', 'Admin', 'm', '1228251600', 1, '0'),
(51, 'user1', '$2y$10$SJ5HgM7Uv.co3PjybCv0E.VTu4hyzYqEkhUOmQMENtL7AuHRlgF3i', 'Kuzimina', 'Anna', 'f', '1223409600', 0, '0'),
(52, 'user2', '$2y$10$sgl5HMEJY7ep7um6fOulxuukFSLIzJ1/tN9GiBQmbsfnF/7vOoEQG', 'Ivanov', 'Maksim', 'm', '1222718400', 0, '0'),
(53, 'user3', '$2y$10$dEI9zcr4G1/71hl.m9TV5O73sh0YcaOWIKpSW3d/s2t2LC7pF8pX2', 'Filippov', 'Artyom', 'm', '1222804800', 0, '0'),
(54, 'user4', '$2y$10$Ov7xso2xbffb8bYvIk0ZduS6m.JHH2KEUNex3ByyHGgFKmtnAlcVi', 'Vinogradova', 'Elizaveta', 'f', '1218052800', 0, '0'),
(55, 'user5', '$2y$10$oFeh95UTZSu7kK2RPnwTQuAvPZNvrYUvk7Wxvo5s/YdkzEdwxzzgW', 'Maliceva', 'Elizaveta', 'f', '1220558400', 0, '0'),
(56, 'user6', '$2y$10$IepolM0QJ6G6TV9wZXEze.dFXVvG9S29ra9xHfHwEw7kgP//DZqMG', 'Gerasimova', 'Emiliya', 'f', '1072731600', 0, '0'),
(57, 'user7', '$2y$10$FJyZ00JKj9a4bPCkN5zPkuqC0crRIvq1lv.rUqTdqqjyBqzcUnMAO', 'Rusanova', 'Polina', 'f', '884293200', 0, '0'),
(58, 'user9', '$2y$10$yZB.5XJGEn2PtGijrFFgRejnu/9pAvKFm34clue.z.UtEcKFZN5Vm', 'Melaniya', 'Andreeva', 'f', '1222632000', 0, '0'),
(59, 'user10', '$2y$10$pUbEbWjtd.ecXtkNEsr7FuDeJ.//oEjPc0etRgsW6fHdlnJfhYRsS', 'Daniil', 'Losev', 'm', '1223755200', 0, '0'),
(60, 'user11', '$2y$10$OnxJ2BXGd0VlCrADj3DfVeyKv1.a2nvBjEQzgQ7uPy1bfBOAemrRG', 'Egor', 'ZHuravlev', 'm', '1223064000', 0, '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
