-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 09 2019 г., 19:55
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cu01904_subscr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mail_stats`
--

CREATE TABLE IF NOT EXISTS `mail_stats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscr_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mail_stats`
--

INSERT INTO `mail_stats` (`id`, `email`, `subscr_status`, `url`, `created_at`, `updated_at`) VALUES
(1, 'email4@mail.test', 'active', 'google.com', '2019-06-09 10:28:12', '2019-06-09 10:28:12'),
(2, 'email5@mail.test', 'active', 'google.com', '2019-06-09 10:28:12', '2019-06-09 10:28:12'),
(3, 'email1@mail.test', 'inactive', 'yahoo.com', '2019-06-09 10:50:29', '2019-06-09 10:50:29'),
(4, 'email2@mail.test', 'inactive', 'yahoo.com', '2019-06-09 10:50:29', '2019-06-09 10:50:29'),
(5, 'email3@mail.test', 'inactive', 'yahoo.com', '2019-06-09 10:50:29', '2019-06-09 10:50:29'),
(6, 'email4@mail.test', 'active', 'google.com', '2019-06-08 10:28:12', '2019-06-08 10:28:12'),
(7, 'email1@mail.test', 'inactive', 'yahoo.com', '2019-06-10 10:50:29', '2019-06-10 10:50:29'),
(8, 'email1@mail.test', 'inactive', 'yahoo.com', '2019-06-10 10:50:29', '2019-06-10 10:50:29'),
(9, 'email1@mail.test', 'inactive', 'yahoo.com', '2019-06-10 10:50:29', '2019-06-10 10:50:29'),
(10, 'email4@mail.test', 'active', 'google.com', '2019-06-10 10:28:12', '2019-06-10 10:28:12'),
(11, 'email1@mail.test', 'inactive', 'google.com', '2019-06-09 13:52:35', '2019-06-09 13:52:35'),
(12, 'email2@mail.test', 'inactive', 'google.com', '2019-06-09 13:52:35', '2019-06-09 13:52:35'),
(13, 'email3@mail.test', 'inactive', 'google.com', '2019-06-09 13:52:35', '2019-06-09 13:52:35');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_06_192026_create_subscriptions_table', 2),
(4, '2019_06_09_120439_create_mail_stats_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `html` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscr_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `subscr_status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'name1', 'email1@mail.test', 'inactive', NULL, '1', NULL, NULL, NULL),
(2, 'name2', 'email2@mail.test', 'inactive', NULL, '2', NULL, NULL, NULL),
(3, 'name3', 'email3@mail.test', 'inactive', NULL, '3', NULL, NULL, NULL),
(4, 'name4', 'email4@mail.test', 'active', NULL, '4', NULL, NULL, NULL),
(5, 'name5', 'email5@mail.test', 'active', NULL, '5', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
