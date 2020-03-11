-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 17 2020 г., 15:09
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `baxegjrr_medcard`
--
CREATE DATABASE IF NOT EXISTS `baxegjrr_medcard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `baxegjrr_medcard`;

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `doctors_id` int(11) NOT NULL,
  `doctors_name` varchar(25) NOT NULL,
  `doctors_speciality` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `doctors_visits`
--

CREATE TABLE `doctors_visits` (
  `doctors_id` int(11) NOT NULL,
  `visits_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `medcard`
--

CREATE TABLE `medcard` (
  `medcard_id` int(11) NOT NULL,
  `medcard_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `medcard_patients`
--

CREATE TABLE `medcard_patients` (
  `medcard_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `medcard_visits`
--

CREATE TABLE `medcard_visits` (
  `medcard_id` int(11) NOT NULL,
  `visits_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `patients_id` int(11) NOT NULL,
  `patients_surname` varchar(255) NOT NULL,
  `patients_name` varchar(255) NOT NULL,
  `patients_patronymic` varchar(255) NOT NULL,
  `patients_dob` date DEFAULT NULL,
  `patients_tel` varchar(255) NOT NULL,
  `patients_sex` varchar(25) DEFAULT NULL,
  `patients_addr` varchar(255) DEFAULT NULL,
  `patients_passp_series` int(11) DEFAULT NULL,
  `patients_passp_number` int(11) DEFAULT NULL,
  `patients_passp_issued_by` varchar(255) DEFAULT NULL,
  `patients_passp_date` date DEFAULT NULL,
  `patients_passp_code` varchar(25) DEFAULT NULL,
  `patients_insur` varchar(255) DEFAULT NULL,
  `patients_job` varchar(255) DEFAULT NULL,
  `patients_drugIntolerance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `services_code` varchar(24) NOT NULL,
  `services_type` varchar(24) NOT NULL,
  `services_name` varchar(255) NOT NULL,
  `services_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `services_visits`
--

CREATE TABLE `services_visits` (
  `services_id` int(11) NOT NULL,
  `visits_id` int(11) NOT NULL,
  `services_count` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_login` varchar(25) NOT NULL,
  `users_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `fio` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `visits`
--

CREATE TABLE `visits` (
  `visits_id` int(11) NOT NULL,
  `visits_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctors_id`);

--
-- Индексы таблицы `doctors_visits`
--
ALTER TABLE `doctors_visits`
  ADD PRIMARY KEY (`doctors_id`,`visits_id`),
  ADD KEY `FK_doctors_visits_visits_id` (`visits_id`);

--
-- Индексы таблицы `medcard`
--
ALTER TABLE `medcard`
  ADD PRIMARY KEY (`medcard_id`);

--
-- Индексы таблицы `medcard_patients`
--
ALTER TABLE `medcard_patients`
  ADD PRIMARY KEY (`medcard_id`,`patients_id`),
  ADD KEY `medcard_patients_ibfk_2` (`patients_id`);

--
-- Индексы таблицы `medcard_visits`
--
ALTER TABLE `medcard_visits`
  ADD PRIMARY KEY (`medcard_id`,`visits_id`),
  ADD KEY `FK_medcard_visits_visits_id` (`visits_id`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patients_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Индексы таблицы `services_visits`
--
ALTER TABLE `services_visits`
  ADD UNIQUE KEY `services_id` (`services_id`,`visits_id`) USING BTREE,
  ADD KEY `FK_services_visits_visits_id` (`visits_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD KEY `fk_users_info_users1_idx` (`users_id`);

--
-- Индексы таблицы `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visits_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctors_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `patients_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `visits`
--
ALTER TABLE `visits`
  MODIFY `visits_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctors_visits`
--
ALTER TABLE `doctors_visits`
  ADD CONSTRAINT `FK_doctors_visits_doctors_id` FOREIGN KEY (`doctors_id`) REFERENCES `doctors` (`doctors_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_doctors_visits_visits_id` FOREIGN KEY (`visits_id`) REFERENCES `visits` (`visits_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `medcard_patients`
--
ALTER TABLE `medcard_patients`
  ADD CONSTRAINT `medcard_patients_ibfk_2` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`patients_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medcard_patients_ibfk_3` FOREIGN KEY (`medcard_id`) REFERENCES `medcard` (`medcard_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `medcard_visits`
--
ALTER TABLE `medcard_visits`
  ADD CONSTRAINT `FK_medcard_visits_visits_id` FOREIGN KEY (`visits_id`) REFERENCES `visits` (`visits_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medcard_visits_ibfk_1` FOREIGN KEY (`medcard_id`) REFERENCES `medcard` (`medcard_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `services_visits`
--
ALTER TABLE `services_visits`
  ADD CONSTRAINT `services_visits_ibfk_1` FOREIGN KEY (`services_id`) REFERENCES `services` (`services_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `services_visits_ibfk_2` FOREIGN KEY (`visits_id`) REFERENCES `visits` (`visits_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `fk_users_info_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
