-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2024 a las 07:45:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cypher2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `nombre`, `apellido`, `email`, `username`, `password`, `fecha_nacimiento`, `imagen_perfil`, `biografia`, `created_at`, `updated_at`) VALUES
(1, 'Guillermo', 'Ibañez', 'g@g.com', 'guille.ibanez.cypher', '$2y$12$F25ZrUtegthjX6KEq3ux.eWRqwfbShsGfjc38uDXktZWZVLDNn7q2', NULL, 'default_profile_picture.png', NULL, '2024-05-03 08:52:18', '2024-05-03 08:52:18'),
(2, 'marcos', 'lopp', 'm@m.com', 'marcos.lop.cypher', '$2y$12$Q7XyKDWLUWziV9ZBwpbuVuPJA4uv3xvWx.xegJCwy392L0UxT0W5a', NULL, NULL, NULL, '2024-05-06 05:03:04', '2024-05-06 05:03:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_admins`
--

CREATE TABLE `chat_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chat_admins`
--

INSERT INTO `chat_admins` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'hola nuevo mensaje', '2024-05-03 09:00:01', '2024-05-03 09:00:01'),
(2, 1, 'hola nuevo mensaje', '2024-05-03 09:00:58', '2024-05-03 09:00:58'),
(3, 1, 'hola nuevo mensaje', '2024-05-03 09:00:59', '2024-05-03 09:00:59'),
(4, 1, 'hola segundo mensaje', '2024-05-03 09:01:27', '2024-05-03 09:01:27'),
(5, 1, 'mando mensaje desde chat global', '2024-05-03 09:31:06', '2024-05-03 09:31:06'),
(6, 1, 'miau', '2024-05-28 06:23:34', '2024-05-28 06:23:34'),
(7, 1, 'miau', '2024-05-28 06:25:27', '2024-05-28 06:25:27'),
(8, 1, 'primer mensaje con ajax', '2024-05-28 06:27:27', '2024-05-28 06:27:27'),
(9, 1, 'escribo un mensaje', '2024-05-28 06:29:30', '2024-05-28 06:29:30'),
(10, 1, 'hola ya funciona', '2024-05-28 06:29:46', '2024-05-28 06:29:46'),
(11, 1, 'hola ya funciona', '2024-05-28 06:29:46', '2024-05-28 06:29:46'),
(12, 1, 'hola ajax', '2024-05-28 06:30:33', '2024-05-28 06:30:33'),
(13, 1, 'hola', '2024-05-30 09:45:59', '2024-05-30 09:45:59'),
(14, 1, 'hola', '2024-05-30 09:46:30', '2024-05-30 09:46:30'),
(15, 1, 'hola', '2024-05-30 09:46:37', '2024-05-30 09:46:37'),
(16, 1, 'hola', '2024-05-30 09:52:01', '2024-05-30 09:52:01'),
(17, 1, 'hola', '2024-05-30 09:53:46', '2024-05-30 09:53:46'),
(18, 1, 'miau', '2024-05-30 09:53:52', '2024-05-30 09:53:52'),
(19, 1, 'funciona', '2024-05-30 19:25:34', '2024-05-30 19:25:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contenido` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `contenido`, `created_at`, `updated_at`) VALUES
(3, 8, 1, 'hola que tal', '2024-04-28 13:45:48', '2024-04-28 13:45:48'),
(15, 8, 1, 'gfjhgfjhfjhf', '2024-04-28 17:24:25', '2024-04-28 17:24:25'),
(16, 8, 1, 'fgfgfjghfjhf', '2024-04-28 17:24:56', '2024-04-28 17:24:56'),
(31, 8, 1, 'hola', '2024-05-15 11:32:33', '2024-05-15 11:32:33'),
(36, 8, 1, 'aaaa', '2024-05-22 11:35:24', '2024-05-22 11:35:24'),
(70, 8, 1, 'hola que tal', '2024-05-23 12:00:24', '2024-05-23 12:00:24'),
(71, 8, 1, 'asdasda', '2024-05-23 12:02:08', '2024-05-23 12:02:08'),
(72, 8, 1, 'sfsdfsdf', '2024-05-23 12:02:59', '2024-05-23 12:02:59'),
(73, 8, 1, 'asd', '2024-05-23 12:12:57', '2024-05-23 12:12:57'),
(74, 8, 1, 'holaaa', '2024-05-23 12:17:18', '2024-05-23 12:17:18'),
(75, 8, 1, 'asdadad', '2024-05-23 12:17:27', '2024-05-23 12:17:27'),
(76, 8, 1, 'sdasd', '2024-05-23 12:18:50', '2024-05-23 12:18:50'),
(77, 8, 1, 'asdasd', '2024-05-23 12:19:59', '2024-05-23 12:19:59'),
(78, 8, 1, 'asdasd', '2024-05-23 12:21:57', '2024-05-23 12:21:57'),
(79, 8, 1, 'asdasd', '2024-05-23 12:21:58', '2024-05-23 12:21:58'),
(80, 8, 1, 'hola ya fuincionas siono', '2024-05-23 12:22:08', '2024-05-23 12:22:08'),
(81, 8, 1, 'asdasd', '2024-05-23 12:22:37', '2024-05-23 12:22:37'),
(82, 8, 1, 'asdadas', '2024-05-23 12:24:22', '2024-05-23 12:24:22'),
(83, 8, 1, 'asd', '2024-05-23 12:29:10', '2024-05-23 12:29:10'),
(84, 8, 1, 'asdasda', '2024-05-23 12:29:55', '2024-05-23 12:29:55'),
(85, 8, 1, 'asasda', '2024-05-23 12:30:14', '2024-05-23 12:30:14'),
(86, 8, 1, 'asdasd', '2024-05-23 12:39:11', '2024-05-23 12:39:11'),
(87, 8, 1, 'easdasd', '2024-05-23 12:41:42', '2024-05-23 12:41:42'),
(88, 8, 1, 'asdasd', '2024-05-23 12:43:16', '2024-05-23 12:43:16'),
(97, 46, 1, 'hola', '2024-05-31 03:17:23', '2024-05-31 03:17:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `created_by`, `event_date`, `location`, `image`, `created_at`, `updated_at`) VALUES
(1, 'evento prueba nuevo', 'sdfsdfsdf', 1, '2024-12-12 12:12:00', 'calle moncasi', 'events/kIAFPaieQHJMHxVutFCSPAw3mgywbJZO86qnxJZ3.png', '2024-05-30 10:18:30', '2024-05-30 10:18:30'),
(2, 'evento con foto buena', 'hola', 40, '1212-12-12 12:12:00', '1212', 'events/D54qloMVUipHKC1z69VFcv6MvixwjwVHWrfLWA3Q.webp', '2024-05-30 11:25:53', '2024-05-30 11:25:53'),
(6, 'ACDC en ESPAÑA', 'AC/DC, la emblemática banda de rock australiana, anuncia con gran entusiasmo su regreso a España como parte de su última gira mundial. Conocidos por su potente energía en el escenario y éxitos que han definido generaciones, como \"Back in Black\", \"Highway to Hell\" y \"Thunderstruck\", AC/DC promete electrificar a sus fans con shows que capturan la esencia del rock and roll puro.', 1, '2024-05-31 21:00:00', 'Sevilla', 'events/IT2CcNj3PE0oZlBJi7yEcc4SR4WJziNtAfckXGNV.jpg', '2024-05-31 03:19:51', '2024-05-31 03:19:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_user`
--

CREATE TABLE `event_user` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `event_user`
--

INSERT INTO `event_user` (`event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `follows_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `follows_id`, `created_at`, `updated_at`) VALUES
(28, 2, 1, '2024-05-25 03:54:02', '2024-05-25 03:54:02'),
(57, 1, 2, '2024-05-31 03:14:16', '2024-05-31 03:14:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `biography` text DEFAULT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `banner_perfil` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `spotify_url` varchar(255) DEFAULT NULL,
  `soundcloud_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `apple_music_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `biography`, `imagen_perfil`, `banner_perfil`, `created_by`, `created_at`, `updated_at`, `spotify_url`, `soundcloud_url`, `youtube_url`, `apple_music_url`) VALUES
(1, 'pruebaaaaa', 'esto es una prueba desde admin', NULL, NULL, 1, '2024-05-24 08:36:51', '2024-05-31 02:49:15', NULL, NULL, NULL, NULL),
(2, 'prueba 2', 'biografia editada', NULL, NULL, 1, '2024-05-24 08:49:02', '2024-05-30 19:23:57', NULL, NULL, NULL, NULL),
(3, 'prueba', 'asda', NULL, NULL, 1, '2024-05-26 07:24:24', '2024-05-26 07:24:24', NULL, NULL, NULL, NULL),
(4, 'PruebaconNombres editado', NULL, NULL, NULL, 1, '2024-05-26 07:49:17', '2024-05-31 02:50:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_followers`
--

CREATE TABLE `group_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `group_followers`
--

INSERT INTO `group_followers` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(20, 1, 1, '2024-05-31 03:14:29', '2024-05-31 03:14:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_members`
--

CREATE TABLE `group_members` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `group_members`
--

INSERT INTO `group_members` (`group_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(2, 1, 'Creador', '2024-05-24 08:49:02', '2024-05-24 08:49:02'),
(3, 1, 'Creador', '2024-05-26 07:24:24', '2024-05-26 07:24:24'),
(3, 1, 'Miembro', '2024-05-26 07:24:24', '2024-05-26 07:24:24'),
(4, 1, 'Creador', '2024-05-26 07:49:17', '2024-05-26 07:49:17'),
(4, 2, 'Miembro', '2024-05-26 07:49:17', '2024-05-26 07:49:17'),
(4, 1, 'Miembro', '2024-05-26 07:49:17', '2024-05-26 07:49:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(78, 1, 33, '2024-05-23 11:34:11', '2024-05-23 11:34:11'),
(84, 1, 8, '2024-05-23 12:00:15', '2024-05-23 12:00:15'),
(93, 1, 37, '2024-05-28 13:23:54', '2024-05-28 13:23:54'),
(96, 1, 35, '2024-05-29 13:18:49', '2024-05-29 13:18:49'),
(97, 1, 45, '2024-05-30 18:19:56', '2024-05-30 18:19:56'),
(98, 1, 39, '2024-05-30 18:19:56', '2024-05-30 18:19:56'),
(100, 1, 48, '2024-05-31 03:06:20', '2024-05-31 03:06:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_23_133332_create_users_table', 2),
(5, '2024_04_23_133523_recreate_users_table', 2),
(6, '2024_04_23_143350_create_users_table', 3),
(7, '2024_04_23_143655_create_users_table', 4),
(8, '2024_04_23_143910_create_users_table', 5),
(9, '2024_04_23_144411_create_users_table', 6),
(10, '2024_04_23_150052_add_profile_picture_to_users_table', 7),
(11, '2024_04_23_190521_add_post_and_comment_tables', 8),
(12, '2024_04_24_074914_add_user_id_to_posts_table', 9),
(13, '2024_04_25_142016_create_likes_table', 10),
(14, '2024_04_28_145620_add_likes_count_to_posts_table', 11),
(15, '2024_04_28_181949_create_followers_table', 12),
(16, '2024_04_28_182222_create_followers_table', 13),
(17, '2024_04_28_185600_create_followers_table', 14),
(18, '2024_04_28_185932_create_followers_table', 15),
(19, '2024_04_28_190244_create_user_follows_table', 16),
(20, '2024_05_03_085641_create_admins_table', 17),
(21, '2024_05_03_102647_create_chat_admins_table', 17),
(22, '2024_05_03_105150_create_admins_table', 18),
(23, '2024_05_06_101545_create_notifications_table', 19),
(24, '2024_05_23_161801_create_user_social_links_table', 20),
(25, '2024_05_24_090751_create_groups_table', 21),
(26, '2024_05_24_090821_create_group_members_table', 21),
(27, '2024_05_24_091743_create_events_table', 22),
(28, '2024_05_24_112642_create_notifications_table', 23),
(29, '2024_05_26_144242_add_profile_images_to_groups_table', 24),
(30, '2024_05_26_162749_add_group_id_to_posts_table', 25),
(31, '2024_05_27_073036_create_group_followers_table', 26),
(32, '2024_05_27_073355_create_group_followers_table', 27),
(33, '2024_05_27_144639_create_reports_table', 28),
(34, '2024_05_30_071855_add_social_links_to_groups', 29),
(35, '2024_05_30_202823_create_event_user_table', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `data`, `read`, `created_at`, `updated_at`) VALUES
(1, 1, 'user_followed', '{\"message\":\"You have a new follower: \"}', 0, '2024-05-24 10:07:28', '2024-05-24 10:07:28'),
(9, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-27 09:06:58', '2024-05-27 09:06:58'),
(11, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 08:49:01', '2024-05-29 08:49:01'),
(15, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 08:51:09', '2024-05-29 08:51:09'),
(16, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 08:57:59', '2024-05-29 08:57:59'),
(17, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 08:58:14', '2024-05-29 08:58:14'),
(18, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:03:02', '2024-05-29 09:03:02'),
(19, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:04:07', '2024-05-29 09:04:07'),
(20, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:04:25', '2024-05-29 09:04:25'),
(21, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:06:09', '2024-05-29 09:06:09'),
(22, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:07:24', '2024-05-29 09:07:24'),
(23, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:07:38', '2024-05-29 09:07:38'),
(24, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:09:18', '2024-05-29 09:09:18'),
(25, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-29 09:10:48', '2024-05-29 09:10:48'),
(26, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-31 03:13:40', '2024-05-31 03:13:40'),
(27, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-31 03:13:54', '2024-05-31 03:13:54'),
(28, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-31 03:14:03', '2024-05-31 03:14:03'),
(29, 2, 'user_followed', '{\"message\":\"You have a new follower: \",\"follower_name\":null}', 0, '2024-05-31 03:14:16', '2024-05-31 03:14:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `texto` text NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `likes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `likes_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `texto`, `imagen_url`, `video_url`, `likes`, `created_at`, `updated_at`, `user_id`, `likes_count`, `group_id`) VALUES
(8, 'hola primer post', NULL, NULL, 0, '2024-04-25 12:34:17', '2024-05-23 12:00:15', 2, 1, NULL),
(28, 'as', '/storage/app/public/imagenes/74LQYeOkpCEaOsq1jWj8DxGPF2cyNu18CsxY7hKQ.jpg', NULL, 0, '2024-05-16 08:01:21', '2024-05-24 07:01:40', 1, 0, NULL),
(33, 'nueva publi', 'storage/imagenes/oLaSnE2YYR7FuOvmahBi12kPPalo6WPYirASCs1U.png', NULL, 0, '2024-05-22 06:33:55', '2024-05-23 11:34:11', 1, 1, NULL),
(34, 'asdasdasdasd', NULL, NULL, 0, '2024-05-22 06:54:56', '2024-05-22 06:54:56', 1, 0, NULL),
(35, 'qweqwe', 'storage/imagenes/zgxQmCH6n4Z8AKSWcmIqgRbe2HpZQEXPq9GiAEp3.png', NULL, 0, '2024-05-22 06:59:26', '2024-05-29 13:18:49', 1, 2, NULL),
(37, 'aaaaaaaaaaaa', 'storage/imagenes/6jlwxQyai456hJ2gQ7gdGHnzpCou9RxPHRtNX2se.png', NULL, 0, '2024-05-22 07:14:57', '2024-05-28 13:23:54', 1, 1, NULL),
(39, 'hola publico un post', NULL, NULL, 0, '2024-05-26 13:04:57', '2024-05-30 18:19:56', 1, 1, NULL),
(45, 'nuevo post', NULL, NULL, 0, '2024-05-30 18:19:52', '2024-05-30 18:19:56', 1, 1, NULL),
(46, 'prueba', NULL, NULL, 0, '2024-05-30 19:13:00', '2024-05-30 19:13:00', 1, 0, 2),
(48, 'desde el escenario', 'storage/imagenes/cAXiU2h3yJ5mdRlt9eKsaKAR4yF10dYSv8XXywB1.jpg', NULL, 0, '2024-05-31 03:06:17', '2024-05-31 03:06:20', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reportable_id` bigint(20) UNSIGNED NOT NULL,
  `reportable_type` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `reportable_id`, `reportable_type`, `reason`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 8, 'Post', 'spam', 'post denunciado', '2024-05-27 12:59:19', '2024-05-27 12:59:19'),
(6, 1, 8, 'Post', 'spam', 'DENUNCIO POST', '2024-05-27 13:13:15', '2024-05-27 13:13:15'),
(8, 1, 8, 'Post', 'spam', NULL, '2024-05-27 13:18:36', '2024-05-27 13:18:36'),
(10, 1, 8, 'Post', 'inappropriate', NULL, '2024-05-28 04:57:46', '2024-05-28 04:57:46'),
(13, 1, 93, 'Comment', 'abuse', 'asda', '2024-05-28 05:27:56', '2024-05-28 05:27:56'),
(14, 1, 93, 'Comment', 'other', 'asdasd', '2024-05-28 08:07:25', '2024-05-28 08:07:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UZiRWrqRrJTmETuAqRtQ6NE1sl4JtPYzoRgr2Ds7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmJBVlhjT0JnNUVQRXl5MFQ4eTR3MmttTFhRWU83RFVLY0h0MHV0ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ncm91cHMvMy9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717130532),
('yHwrukYC80vcYo9unFMgmepAHpP7qMtwNoEVG5At', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYzBxdFJsWllIMm5MZU0zU2piWFRPemt2R2I5aFg4R3ZBc01teUpqdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcHAtaW5mbyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzE3MTMxMzM2O319', 1717132935);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'default_profile_picture.png',
  `spotify_url` varchar(255) DEFAULT NULL,
  `soundcloud_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `apple_music_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email`, `username`, `password`, `fecha_nacimiento`, `imagen_perfil`, `biografia`, `created_at`, `updated_at`, `profile_picture`, `spotify_url`, `soundcloud_url`, `youtube_url`, `apple_music_url`) VALUES
(1, 'Guillermo', 'Ibanez', 'guilleibannez@gmail.com', 'Guille814', '$2y$12$g0erj.KU2bTi81N0Xoa2SuZp9jpSp7XNn2lVYe1Du3XkqC7WFxO2i', '2024-05-09', 'storage/profile_pictures/z00tyeCoN0OK7VsItdLOuoqAgXxdzwS9kxqZLmtJ.png', NULL, '2024-04-23 12:44:34', '2024-05-30 18:20:13', 'profile_pictures/default_profile_picture.png', 'https://open.spotify.com/asd', 'https://soundcloud.com/asdasd', 'https://youtube.com/user/asdasd', 'https://music.apple.com/asdad'),
(2, 'Maria', 'Rami', 'm@m.com', 'mampa_rami', '$2y$12$UFi7DtKhB8XlzhS1GtYXfub5O7CzmJFmydkPZi3cpiUQ/cCqWwGg2', NULL, 'profile_pictures/default_profile_picture.png', NULL, '2024-04-25 07:44:15', '2024-04-25 07:44:15', 'profile_pictures/default_profile_picture.png', NULL, NULL, NULL, NULL),
(7, 'Jerel', 'Gerhold', 'gutmann.rebekah@example.org', 'yhoeger', '$2y$12$uRIyvT384LpxDGELOcL0FOzOANbITExxEXhXVubJJGzKVvfPwdr86', '1980-07-15', 'default.jpg', 'Nulla est optio rerum optio quae consequatur. Facilis nostrum dolor libero fugit quis. Libero error nesciunt harum et.', '2024-05-30 09:03:28', '2024-05-30 09:03:28', 'default.jpg', NULL, NULL, NULL, NULL),
(8, 'Omen', 'Rath', 'jfriesen@example.org', 'americo.satterfield', '$2y$12$jfU5cTvuHcniharPBi9CmOQGk7jNFNsr5pIJxuyIGl8eC1/ORUqke', '1996-12-04', 'default.jpg', 'Laudantium ea molestiae voluptatem nobis. Architecto fuga qui ea et dolores. Inventore consequuntur ut sed quisquam optio. Aspernatur sapiente est magnam magnam. Quod dolorem quo sit optio vitae eius.', '2024-05-30 09:03:28', '2024-05-30 09:11:54', 'default.jpg', NULL, NULL, NULL, NULL),
(9, 'Wendy', 'Ondricka', 'eusebio56@example.org', 'elda.tromp', '$2y$12$oe66HrwPF4DtnTHu0U9KI.P62YYxRZhUbd.Lcf775q9xJK6WqZqBe', '1987-06-27', 'default.jpg', 'Impedit tempora officiis repudiandae et voluptatem vel. Ut doloremque sit dicta ea suscipit ducimus incidunt. Architecto omnis est laboriosam neque rerum ut vel.', '2024-05-30 09:03:29', '2024-05-30 09:03:29', 'default.jpg', NULL, NULL, NULL, NULL),
(10, 'Rubye', 'Harris', 'rjohnston@example.com', 'adah.kohler', '$2y$12$0tSVf2SU5AjNksbYHES2AOrg/RTwjbXogy7rueMjT6oL9GU2fnD/S', '2011-11-07', 'default.jpg', 'Eaque omnis est molestias est et eum. Ad neque repellat et dolore ratione. Et repellendus adipisci quas id.', '2024-05-30 09:03:29', '2024-05-30 09:03:29', 'default.jpg', NULL, NULL, NULL, NULL),
(11, 'Madelynn', 'Rohan', 'george74@example.org', 'brody.oreilly', '$2y$12$.qnhkDiNyPy6mmUzS3hJ0.2u96jrCW0J9WmviXKhTu1jznstezK7.', '2021-11-02', 'default.jpg', 'Voluptates excepturi ut quo quis vel qui. Fugiat praesentium beatae voluptates consequatur sapiente et. Ducimus voluptas minima numquam dicta. Ut magnam omnis possimus voluptas consequatur.', '2024-05-30 09:03:29', '2024-05-30 09:03:29', 'default.jpg', NULL, NULL, NULL, NULL),
(12, 'Delaney', 'Fahey', 'jefferey.osinski@example.com', 'jacky10', '$2y$12$n.2XxQQfnotczsxXCELwquLdO0eOIzVhfGizkhXJX7M3E7Q9mSyuG', '1987-07-30', 'default.jpg', 'Cumque consequatur rem reprehenderit quia voluptas voluptas ipsa eum. Omnis praesentium atque ipsam aliquid eos asperiores sequi. Voluptatem ut in minima.', '2024-05-30 09:03:29', '2024-05-30 09:03:29', 'default.jpg', NULL, NULL, NULL, NULL),
(13, 'Macie', 'Thiel', 'hsanford@example.com', 'bcasper', '$2y$12$PahiAokNMlgRgojtoUxnWuDnyelzWtGUxndsXNpwgP6xYq7tEgOyq', '1990-10-04', 'default.jpg', 'Cum nam sed commodi magni sunt reprehenderit a. Minima dolores qui necessitatibus consequatur. Occaecati corrupti pariatur libero totam dignissimos et quod dolor. Cupiditate voluptatum provident ipsum labore aliquam et mollitia.', '2024-05-30 09:03:30', '2024-05-30 09:03:30', 'default.jpg', NULL, NULL, NULL, NULL),
(14, 'Heidi', 'Leuschke', 'logan88@example.net', 'apollich', '$2y$12$5l6qlSEkLz78gDpiVn1eCuUZDVrAAaiQAT6TrhNVtJrhAnkaNadbq', '1983-06-20', 'default.jpg', 'In dolore possimus delectus dolorum. Velit vel nulla accusantium quidem voluptas quaerat.', '2024-05-30 09:03:30', '2024-05-30 09:03:30', 'default.jpg', NULL, NULL, NULL, NULL),
(16, 'Giovanni', 'Kilback', 'caterina43@example.net', 'immanuel78', '$2y$12$tqmZn2A789HBIv.iKM15qOJoXDyh.xNti.UAow6Crsyf7IY8xWuLu', '2004-05-22', 'default.jpg', 'Dolores corrupti libero eum autem. Quasi et occaecati non. Ad ratione delectus corporis eum dolor.', '2024-05-30 09:03:31', '2024-05-30 09:03:31', 'default.jpg', NULL, NULL, NULL, NULL),
(17, 'Morgan', 'Hand', 'kiehn.eudora@example.com', 'margot97', '$2y$12$cdaWotUD/3ALaGCrL4xTv.7v2hUaQTKVuLdHOF.0AmWFN9GXt2.2e', '1984-05-11', 'default.jpg', 'Dolorem quas perferendis sequi culpa natus neque nisi. Velit illo sit rerum cum quae vel. Voluptatem temporibus unde commodi.', '2024-05-30 09:03:31', '2024-05-30 09:03:31', 'default.jpg', NULL, NULL, NULL, NULL),
(18, 'Jaren', 'McDermott', 'nikko59@example.net', 'hilpert.trenton', '$2y$12$V/hSYdFwuMm8/0xfJN8.vOkbyz8ZuKmWVtKqcgC7eH8nzeAQNtEUm', '1974-01-22', 'default.jpg', 'Accusamus iure aliquam et ea. Maiores facere aspernatur consequatur perspiciatis ratione sit. Dolor quod aspernatur neque et quis cupiditate eius. Deserunt mollitia exercitationem possimus sed.', '2024-05-30 09:03:31', '2024-05-30 09:03:31', 'default.jpg', NULL, NULL, NULL, NULL),
(19, 'Percy', 'Nicolas', 'pattie60@example.net', 'rocio.lindgren', '$2y$12$50lKGyeYX7B9l79fKf13gOBCbwoKJC86mFVpwedbEq0OZz0hMRFuu', '2019-10-16', 'default.jpg', 'Dolores eum eius fugiat in. Minima facilis molestias rerum impedit. Aut nisi dicta illo architecto ut blanditiis est.', '2024-05-30 09:03:31', '2024-05-30 09:03:31', 'default.jpg', NULL, NULL, NULL, NULL),
(20, 'Green', 'Hyatt', 'bosco.nora@example.org', 'conner20', '$2y$12$osW1VpLrsFaaGi2SAa/AY.YaNLVdqwg2uCP4dR8U87xWnSvrhjyd2', '1978-12-01', 'default.jpg', 'Quo voluptatem eum reiciendis et similique aut voluptas vel. Minima et dolorem animi quidem repudiandae. A atque numquam dolore qui nam.', '2024-05-30 09:03:32', '2024-05-30 09:03:32', 'default.jpg', NULL, NULL, NULL, NULL),
(21, 'Andreanne', 'Hettinger', 'osinski.ransom@example.org', 'daphne.jenkins', '$2y$12$19kXivBMyX2NvZU9Bg6zzeLcnvES1yV.YQaFbUJZVC/LCjI7dqzNC', '2001-06-14', 'default.jpg', 'Esse deleniti consequatur voluptas sint ut voluptatem. Esse magnam accusantium labore reiciendis veritatis temporibus. Consequatur odio magni assumenda dolores velit voluptates.', '2024-05-30 09:03:32', '2024-05-30 09:03:32', 'default.jpg', NULL, NULL, NULL, NULL),
(22, 'Brando', 'Zboncak', 'amari76@example.com', 'terrell.tillman', '$2y$12$041PsIAQhFBaMnKzBIgXw.0MonbHTgukEn61Ot5ctstyoZgjbwJ6u', '1995-03-28', 'default.jpg', 'Sapiente sequi exercitationem explicabo dolorum reiciendis nemo et sed. Et sit enim ut magnam sed sapiente odit omnis. Veritatis corrupti veniam dolor voluptatibus rerum sint doloribus.', '2024-05-30 09:03:32', '2024-05-30 09:03:32', 'default.jpg', NULL, NULL, NULL, NULL),
(23, 'Murphy', 'Herzog', 'qwisozk@example.org', 'mfeil', '$2y$12$Mb7PTfz1Q7.hRssLXFXYAeo1H.XC.fF2e66xkKKgxAkVlQUFuaOqu', '1993-04-09', 'default.jpg', 'Sed in nobis dicta sit quia quam ut. Quae assumenda minus nulla est quisquam fugiat id. Atque iure est quia voluptate vitae expedita. Impedit voluptates aut et sint. Eligendi quia repellendus id.', '2024-05-30 09:03:33', '2024-05-30 09:03:33', 'default.jpg', NULL, NULL, NULL, NULL),
(24, 'Marcelle', 'Aufderhar', 'igreen@example.net', 'cecilia50', '$2y$12$nOki1j4khkEZygSPLnSeneY/m8KFtdnBrJObf1jMFoPNYV4nCS0HW', '1978-07-28', 'default.jpg', 'Molestias eaque sit aspernatur nam. Eos quaerat tenetur fugiat. Et animi blanditiis voluptatem velit dolorem dolor. Ut provident et dolor earum recusandae corporis nihil. Laborum molestias accusamus libero est sunt eius reiciendis.', '2024-05-30 09:03:33', '2024-05-30 09:03:33', 'default.jpg', NULL, NULL, NULL, NULL),
(25, 'Lenore', 'Howe', 'camryn83@example.com', 'rhett.frami', '$2y$12$5sWTBX.evp20ox3p6a5mbeU.NyU0AozQikUP6nJh8SWG8mEOzNPsy', '1988-09-09', 'default.jpg', 'Atque ea ut quo voluptas. Temporibus ipsum labore temporibus numquam iusto ut. Explicabo molestias quis omnis officia quasi sit sit. Quo blanditiis nulla fuga numquam id enim deserunt.', '2024-05-30 09:03:33', '2024-05-30 09:03:33', 'default.jpg', NULL, NULL, NULL, NULL),
(26, 'Electa', 'Erdman', 'april.schaden@example.net', 'jedidiah.beier', '$2y$12$1DlQhKzfIvdUSNENLZAw.eAiy1iXGDq1LsVFz0Kt5th4zY/DkYEvy', '1976-05-30', 'default.jpg', 'Iste numquam et expedita unde optio eum. Distinctio libero omnis illum et quo ut cupiditate. Porro voluptatem reprehenderit nisi amet eum harum occaecati.', '2024-05-30 09:03:34', '2024-05-30 09:03:34', 'default.jpg', NULL, NULL, NULL, NULL),
(27, 'Elian', 'Hermiston', 'arogahn@example.com', 'viviane.romaguera', '$2y$12$h5CKvxtwXYyHyR9NJ0Um/ejgXswgmxnytn.BxsgNyI9BvnNFUAszW', '2014-09-17', 'default.jpg', 'Cupiditate nisi totam mollitia vero similique sed reprehenderit. Sunt sed est quam non perspiciatis excepturi. Qui quia pariatur vero unde. Optio omnis repellat culpa quod consequatur quos.', '2024-05-30 09:03:34', '2024-05-30 09:03:34', 'default.jpg', NULL, NULL, NULL, NULL),
(28, 'Linwood', 'Volkman', 'yundt.pete@example.com', 'boyer.loy', '$2y$12$/T81hbsifsaHLyzsymqGxuzQKQivFfJ1vzCOBExay7wwZ6Kwrodiq', '2011-04-11', 'default.jpg', 'Quam aperiam aut consequatur et. Repudiandae pariatur maxime quis omnis rerum. Consequatur itaque assumenda fuga aliquid facilis earum veritatis.', '2024-05-30 09:03:34', '2024-05-30 09:03:34', 'default.jpg', NULL, NULL, NULL, NULL),
(29, 'Ronaldo', 'Kuvalis', 'ebert.tavares@example.com', 'ilarson', '$2y$12$OU1yG6M5TU87YJooBkTO1e024SpuLsoWCTYSlka7PQiEUKKrqV40K', '2007-07-30', 'default.jpg', 'Repellat hic est quia dolorem accusamus. Et repellendus impedit debitis veniam vel quisquam vitae. Voluptatem distinctio expedita veniam corporis eos. Assumenda et perspiciatis ex beatae est nisi officia quia. Architecto veniam veniam vel laboriosam excepturi velit sit.', '2024-05-30 09:03:35', '2024-05-30 09:03:35', 'default.jpg', NULL, NULL, NULL, NULL),
(30, 'Marcelina', 'Durgan', 'clifford31@example.org', 'kiarra.parisian', '$2y$12$4IDQKwTPwdeutmmP7JFynOxAjDwFy9rl4bVWttkKDt/3.t0XGPimS', '2001-03-31', 'default.jpg', 'Eius sint aut voluptatem repudiandae assumenda natus eos molestias. Ea sed id aut nihil praesentium neque. Soluta qui non ab ratione quod voluptas sint.', '2024-05-30 09:03:35', '2024-05-30 09:03:35', 'default.jpg', NULL, NULL, NULL, NULL),
(31, 'Levi', 'Fisher', 'conroy.cameron@example.net', 'nikolaus.zachery', '$2y$12$yXmSQ2tUTHhhsQ8NUBfTEuDyHC7QcwymK8Kgus7ZYHPn2CKCNCQqm', '2000-12-11', 'default.jpg', 'Ea vero qui dolor autem. Iure deserunt odit unde nihil ut laboriosam sapiente hic. Dolorum voluptatum laboriosam veritatis nihil aut. Quia ex omnis saepe ut nulla.', '2024-05-30 09:03:36', '2024-05-30 09:03:36', 'default.jpg', NULL, NULL, NULL, NULL),
(32, 'Sylvia', 'Fahey', 'ethan71@example.net', 'hmccullough', '$2y$12$DfiU2p1115siXEyC1Zq2UuLuU.0vf/wqmEcxp1SZCGNSjEWtrppZq', '1990-12-03', 'default.jpg', 'Fugit nostrum ut tempora minus quod rerum eum. Pariatur tempora aliquam deserunt explicabo quod non. Velit qui est et eum aut quos tempora accusamus. Rerum rerum molestiae facere expedita quod est.', '2024-05-30 09:03:36', '2024-05-30 09:03:36', 'default.jpg', NULL, NULL, NULL, NULL),
(33, 'Magdalena', 'Raynor', 'mina48@example.net', 'derek.mante', '$2y$12$C5Jbu97w2NuqG4z5G1Pal.eZH3WvjKzwnrzLQcMlLoFEPnMNeqdwO', '2016-11-18', 'default.jpg', 'In quos molestias fugiat. Itaque ab numquam reprehenderit tenetur. Sed dolore est officiis ea autem. Sequi et minus inventore a mollitia.', '2024-05-30 09:03:36', '2024-05-30 09:03:36', 'default.jpg', NULL, NULL, NULL, NULL),
(34, 'Heber', 'Raynor', 'iledner@example.com', 'kessler.annamarie', '$2y$12$u1U1UsoHthjziDfWzof1AuxEjVkVAqiv6YF5RC6gK/7ZvEf5c2Zwi', '2002-02-26', 'default.jpg', 'Tempore ut et natus aut qui. Officia quae facilis voluptates beatae tempora optio velit inventore. Neque quam dolorem ipsa asperiores. Et quod dolorum sunt nostrum nulla.', '2024-05-30 09:03:37', '2024-05-30 09:03:37', 'default.jpg', NULL, NULL, NULL, NULL),
(35, 'Eldred', 'Mosciski', 'slemke@example.org', 'bert.bosco', '$2y$12$JwfC/XTBFqu1fQrYtChxtOkp./CcJ1FqW5UmDLnM.stfFmLAvMQTO', '1985-11-14', 'default.jpg', 'Officiis velit quas at. Omnis odit dolor porro at. Reprehenderit excepturi architecto impedit nesciunt est est nesciunt.', '2024-05-30 09:03:37', '2024-05-30 09:03:37', 'default.jpg', NULL, NULL, NULL, NULL),
(36, 'Reina', 'Parker', 'grodriguez@example.net', 'conn.abe', '$2y$12$h5KsepZTVLwHxK37YQeUFuTRMBO6SbaE2OhwdWP4360KKKb034Wm2', '1985-04-16', 'default.jpg', 'Laudantium laborum est autem sit quod corporis natus. Aut aliquid qui voluptatem nisi autem nihil. Id doloribus animi sunt cum earum. Et blanditiis optio quod occaecati repellat vero molestiae.', '2024-05-30 09:03:37', '2024-05-30 09:03:37', 'default.jpg', NULL, NULL, NULL, NULL),
(37, 'Dagmar', 'Koch', 'shields.abdul@example.org', 'king.kohler', '$2y$12$qKkCaPsfCWJ50Khrnyc7vOPlnOqKn6TCs5LJVAFM51pU46/vt5.bi', '2017-08-23', 'default.jpg', 'Consequuntur enim et harum nisi laudantium. Quo voluptas corporis cupiditate laboriosam. Qui voluptatem reprehenderit reprehenderit deserunt sint omnis veritatis.', '2024-05-30 09:03:38', '2024-05-30 09:03:38', 'default.jpg', NULL, NULL, NULL, NULL),
(38, 'Alaina', 'Satterfield', 'krajcik.monique@example.net', 'bauch.deion', '$2y$12$V8qUzsgjvGiSHxyVMM9mbOVkmnFCOiW0.tIyx7a0d2AJ1xTAScGhm', '1981-10-11', 'default.jpg', 'Distinctio inventore voluptatem dolorum ea est dolorem voluptatem. Qui dolorem dolor ut et amet. Commodi sed quaerat et animi cum tempora. Unde voluptatum aut et soluta incidunt molestiae sunt.', '2024-05-30 09:03:38', '2024-05-30 09:03:38', 'default.jpg', NULL, NULL, NULL, NULL),
(39, 'Desmond', 'Wyman', 'velda.ward@example.org', 'lehner.jorge', '$2y$12$PbNq2gPSnBPtf5wYSakkSe0mKA6bD49KHSg7UqCLHOjVREj8k.WJy', '1995-01-09', 'default.jpg', 'Veritatis eaque minima numquam consequatur. Sit nulla ad eaque dolores sit. Dolorum explicabo adipisci eos quo qui maiores consequatur. Doloribus et temporibus ducimus non aut eveniet dolorem.', '2024-05-30 09:03:38', '2024-05-30 09:03:38', 'default.jpg', NULL, NULL, NULL, NULL),
(40, 'Phyllis', 'Kunze', 'savannah56@example.net', 'hjast', '$2y$12$j8iT2jsjQb0weO2Ft101Euba1g7WsoPaawelbdOg2dRzROH8rM2HS', '1986-11-17', 'default.jpg', 'Non sapiente excepturi eius velit unde. Beatae nisi deleniti nulla temporibus iste incidunt debitis blanditiis. Aut ipsum architecto reiciendis atque. Ducimus ad earum blanditiis quos delectus et iusto.', '2024-05-30 09:03:39', '2024-05-30 09:03:39', 'default.jpg', NULL, NULL, NULL, NULL),
(41, 'Solon', 'Roberts', 'michale.heaney@example.com', 'tom.tromp', '$2y$12$cimxpb75FenNkE4B7c5aJu.0H2mIZAy7I7GFnYm1Yu479TzP0dNpO', '1974-02-11', 'default.jpg', 'Voluptates deleniti reiciendis sed animi. Et minus accusantium eligendi voluptatum ut. Qui ea quia recusandae reprehenderit quod.', '2024-05-30 09:03:39', '2024-05-30 09:03:39', 'default.jpg', NULL, NULL, NULL, NULL),
(42, 'Verna', 'Rutherford', 'theodore.schmitt@example.net', 'gunner.aufderhar', '$2y$12$.6hLQ6xB3onZQxC715X9neaez2216tAl2nLexwmzFGxBUhC83ZXie', '1993-11-30', 'default.jpg', 'Non est corrupti ipsum. Et pariatur consequuntur eos voluptatem qui sed. Quo quia quo quaerat eum atque dolorem excepturi. Deleniti ducimus quo odit atque.', '2024-05-30 09:03:39', '2024-05-30 09:03:39', 'default.jpg', NULL, NULL, NULL, NULL),
(43, 'Hubert', 'Hamill', 'ceasar.tromp@example.com', 'bahringer.myrna', '$2y$12$.v1TjorSyoRyUIjWD9ilHuKfnNmCj2RgufUi70bk8e0sVu78BJBUC', '2004-04-19', 'default.jpg', 'Sed aliquam et est voluptas voluptatem. Ab rerum minus quo. Aliquid nam omnis sunt nemo qui repellat itaque quis. Consequatur impedit ab minus deserunt.', '2024-05-30 09:03:40', '2024-05-30 09:03:40', 'default.jpg', NULL, NULL, NULL, NULL),
(44, 'Lon', 'DuBuque', 'nola.shanahan@example.org', 'effertz.salma', '$2y$12$mhYAWK4wdp7EVA.MCxCBx.WQSv2JUA48Ys8MzgZy3mbhWfjXQxWT.', '2015-01-22', 'default.jpg', 'Pariatur dolores ut expedita voluptatem quos ad sit. Amet aliquid accusamus nam. Impedit ea non qui ipsum. Vero aliquid impedit et quis tenetur totam sunt omnis.', '2024-05-30 09:03:40', '2024-05-30 09:03:40', 'default.jpg', NULL, NULL, NULL, NULL),
(45, 'Ludwig', 'Tillman', 'kamryn.stroman@example.org', 'hirthe.fermin', '$2y$12$vLGEUmwZTXoe/2J4J4VDRuVMufFuliM9lMx7T2iosNRokBQ34y8wO', '2006-12-01', 'default.jpg', 'Molestiae ut qui amet voluptas iure mollitia dolores ut. Eveniet ut maxime voluptate ex maxime illo velit. Libero quia eum odio sint expedita quis officia excepturi. Architecto fugit voluptatem non dolore vel qui a.', '2024-05-30 09:03:41', '2024-05-30 09:03:41', 'default.jpg', NULL, NULL, NULL, NULL),
(46, 'Sid', 'Schneider', 'eryn.johns@example.net', 'giovani.conn', '$2y$12$tTLd2S/zeD3HUH2vWggY2.PklkZvPhpXusoxjon6rhr1kMPZ2IgMS', '2024-02-06', 'default.jpg', 'Reprehenderit perspiciatis nobis voluptas consectetur. Recusandae quo enim excepturi voluptas quidem ipsam nesciunt. Debitis quae ut aliquam laudantium et distinctio. Voluptatem dolorum atque quia deserunt ut autem.', '2024-05-30 09:03:41', '2024-05-30 09:03:41', 'default.jpg', NULL, NULL, NULL, NULL),
(47, 'Kaylin', 'Paucek', 'colten63@example.com', 'waelchi.jackson', '$2y$12$WyZ3lpoUJU9GeWPDrrho7u.i9gD8K.tZBjslIG3ZNsjwea8xXqCHG', '1976-06-04', 'default.jpg', 'Debitis neque aspernatur maxime quia aut dolorem. Et enim eum doloribus commodi sed in. Nihil odit aut aut officiis eligendi voluptatem. Omnis unde dolores eveniet omnis ratione unde sit.', '2024-05-30 09:03:41', '2024-05-30 09:03:41', 'default.jpg', NULL, NULL, NULL, NULL),
(48, 'London', 'Kemmer', 'beatty.lessie@example.net', 'heller.elda', '$2y$12$1xNDB5or4z5l6Hm.TeV5SOk.aL2qUK9o69fD3EwBpQfry2UePZiUy', '2001-09-02', 'default.jpg', 'Officia eos et velit iusto. Impedit quo dolor nobis. Illum sed itaque voluptatem molestiae.', '2024-05-30 09:03:42', '2024-05-30 09:03:42', 'default.jpg', NULL, NULL, NULL, NULL),
(49, 'Meta', 'Crist', 'hmonahan@example.net', 'hreinger', '$2y$12$Zxk3vXOqjBrsa1y9Ro5woul9j5MH57OxyTCYQjHvbzE2OtkGHboo2', '1975-06-25', 'default.jpg', 'Consequatur eveniet neque ratione sapiente rerum dolores. Animi ab repudiandae aliquid quis aut maiores et. Sint rerum odit autem neque ab. Nesciunt consequatur et labore blanditiis consectetur et.', '2024-05-30 09:03:42', '2024-05-30 09:03:42', 'default.jpg', NULL, NULL, NULL, NULL),
(50, 'Maymie', 'Hauck', 'davon65@example.com', 'estanton', '$2y$12$O3zYF5bqZ6EzRH41bDFfl.lZGHrvS2DcY/0/79ThTxqxuhsh3sCdS', '1978-03-27', 'default.jpg', 'Mollitia voluptatum eum in possimus est culpa provident facilis. Et enim qui incidunt similique. Qui error error quibusdam vel expedita perferendis non. Facere voluptatem vel rem repudiandae.', '2024-05-30 09:03:43', '2024-05-30 09:03:43', 'default.jpg', NULL, NULL, NULL, NULL),
(51, 'Ramona', 'Williamson', 'hwalker@example.net', 'felicia.lesch', '$2y$12$80IVSEgsdZX93q6.dY/Y2.bk2i7UR85GGgQ5/.o23FygHpTujBpHK', '2017-09-27', 'default.jpg', 'Aliquid neque odit quae reiciendis sit laudantium nostrum. Nihil vel fuga fuga et odit aut quos expedita. Consequatur est veniam aspernatur architecto. Eveniet atque maxime magni quis cum expedita.', '2024-05-30 09:03:43', '2024-05-30 09:03:43', 'default.jpg', NULL, NULL, NULL, NULL),
(52, 'Ramon', 'Huels', 'talon.klocko@example.net', 'katharina78', '$2y$12$TfhyBPMp6BexzDOlLmv1Neq/hKNvN86Uj64qDWdFtDfPyTih3pfc6', '2016-01-25', 'default.jpg', 'Nisi et aut velit esse qui. Laboriosam dignissimos explicabo alias corrupti aut. Explicabo dolores ducimus et rerum molestiae voluptas. Dignissimos aut est explicabo sed quasi reprehenderit neque.', '2024-05-30 09:03:43', '2024-05-30 09:03:43', 'default.jpg', NULL, NULL, NULL, NULL),
(53, 'Zoila', 'Crist', 'hiram44@example.org', 'will.anais', '$2y$12$0k9SDxklKaE3LN8CIVlioe4AT3SwLv.NNiK9vq7DxsGU.1MxnZ6cO', '2016-11-23', 'default.jpg', 'Dolorem expedita non facere error quidem eligendi. Assumenda culpa dolores doloremque alias asperiores blanditiis. Dolorem quo sed nihil ad cum ipsam est. Est error quo quo unde voluptates enim quo.', '2024-05-30 09:03:44', '2024-05-30 09:03:44', 'default.jpg', NULL, NULL, NULL, NULL),
(54, 'Orin', 'Klein', 'hettie.mueller@example.net', 'qboyle', '$2y$12$1AQeIiEr6hlS7okt9JFn/.o3nAxbGbDePvohv/T9q5KW8PXIH7JRe', '1979-04-17', 'default.jpg', 'Sunt fugit nostrum assumenda et quisquam laborum. Facere et iste ipsa consectetur velit tempore expedita.', '2024-05-30 09:03:44', '2024-05-30 09:03:44', 'default.jpg', NULL, NULL, NULL, NULL),
(55, 'Crawford', 'Roberts', 'nconnelly@example.com', 'odell55', '$2y$12$9oNPIByhPZzRPYFCeqpsyuRE0nssz6WXYgU0jVj8OMTRmJGXtn4I.', '1971-09-10', 'default.jpg', 'Facilis consequuntur placeat quia dolor ut ea nihil. Rerum voluptas quae perspiciatis consequatur voluptatum et. Ea voluptates ut ut distinctio a. A nostrum consequatur mollitia.', '2024-05-30 09:03:44', '2024-05-30 09:03:44', 'default.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_follows`
--

CREATE TABLE `user_follows` (
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `follows_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_social_links`
--

CREATE TABLE `user_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `social_network` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `chat_admins`
--
ALTER TABLE `chat_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_admins_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_created_by_foreign` (`created_by`);

--
-- Indices de la tabla `event_user`
--
ALTER TABLE `event_user`
  ADD KEY `event_user_event_id_foreign` (`event_id`),
  ADD KEY `event_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `followers_follower_id_follows_id_unique` (`follower_id`,`follows_id`),
  ADD KEY `followers_follows_id_foreign` (`follows_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_created_by_foreign` (`created_by`);

--
-- Indices de la tabla `group_followers`
--
ALTER TABLE `group_followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_followers_group_id_user_id_unique` (`group_id`,`user_id`),
  ADD KEY `group_followers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `group_members`
--
ALTER TABLE `group_members`
  ADD KEY `group_members_group_id_foreign` (`group_id`),
  ADD KEY `group_members_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `likes_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_group_id_foreign` (`group_id`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indices de la tabla `user_follows`
--
ALTER TABLE `user_follows`
  ADD PRIMARY KEY (`follower_id`,`follows_id`),
  ADD KEY `user_follows_follows_id_foreign` (`follows_id`);

--
-- Indices de la tabla `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_social_links_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `chat_admins`
--
ALTER TABLE `chat_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `group_followers`
--
ALTER TABLE `group_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `user_social_links`
--
ALTER TABLE `user_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat_admins`
--
ALTER TABLE `chat_admins`
  ADD CONSTRAINT `chat_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `followers_follows_id_foreign` FOREIGN KEY (`follows_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `group_followers`
--
ALTER TABLE `group_followers`
  ADD CONSTRAINT `group_followers_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_follows`
--
ALTER TABLE `user_follows`
  ADD CONSTRAINT `user_follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_follows_follows_id_foreign` FOREIGN KEY (`follows_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD CONSTRAINT `user_social_links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
