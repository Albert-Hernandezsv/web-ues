-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2026 a las 17:48:01
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
-- Base de datos: `web_ues`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnis`
--

CREATE TABLE `alumnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnis`
--

INSERT INTO `alumnis` (`id`, `name`, `slug`, `headline`, `company`, `summary`, `content`, `image`, `published_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nombre de ejemplo', 'nombre-de-ejemplo', 'Cargo de ejemplo', 'Empresa de ejemplo', 'Este es un ejemplo del resumen del caso de exito del alumni', 'Este es un ejemplo de la historia completa del caso de exito del alumni', 'alumnis/xpEy1VJphnbXmNV4ntOPItFoO0ditNFTPUb5XcJ4.jpg', '2026-04-07 09:31:00', 1, '2026-04-07 21:31:55', '2026-04-07 21:31:55');

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
-- Estructura de tabla para la tabla `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `downloads`
--

INSERT INTO `downloads` (`id`, `title`, `description`, `file_path`, `file_type`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hoja de inscripción servicio social', 'Hoja de inscripción servicio social', 'downloads/GLN5mRj7AQnX9wfSltkNKkpffMbsDmhoFQpGUszk.doc', 'doc', 1, 1, '2026-04-03 04:16:08', '2026-04-03 23:49:57'),
(2, 'Guía para elaborar plan de trabajo de servicio social', 'Guía para elaborar plan de trabajo de servicio social', 'downloads/pzlACrDib2IULRR9Alny4garR8U7dKWPVguTvHeG.doc', 'doc', 1, 1, '2026-04-03 04:17:01', '2026-04-03 04:17:01'),
(3, 'Portada de Memoria de Servicio Social', 'Portada de Memoria de Servicio Social', 'downloads/9x1FdJdgvU8LUpV4QCOXWs8e8wO2EEWmbqbWH1YR.doc', 'doc', 1, 1, '2026-04-03 04:18:03', '2026-04-03 04:18:03'),
(4, 'Constancia de aprobación del plan de trabajo del servicio social', 'Constancia de aprobación del plan de trabajo del servicio social', 'downloads/sCuSlftMdVJbQ3URD0311B3RVv8puhkPsFPcOiG4.doc', 'doc', 1, 1, '2026-04-03 04:18:25', '2026-04-03 04:18:25'),
(5, 'Control de horas de servicio social', 'Control de horas de servicio social', 'downloads/PP0UpAnyzfUQxdDeRsTGarVVE1iSirQNm0DJShXL.doc', 'doc', 1, 1, '2026-04-03 04:18:45', '2026-04-03 04:18:45'),
(6, 'Ficha de control de tutorías de servicio social', 'Ficha de control de tutorías de servicio social', 'downloads/Sdcx1OPUG7hOWXVRqJeTdRVr5p6qVakGDZCyHePz.doc', 'doc', 1, 1, '2026-04-03 04:19:05', '2026-04-03 04:19:05'),
(7, 'Hoja de evaluación de servicio social', 'Hoja de evaluación de servicio social', 'downloads/a9n026xvoif07MiCLJ70gQWgnwukbhBT8Ism5aEh.doc', 'doc', 1, 1, '2026-04-03 04:19:26', '2026-04-03 04:19:26'),
(8, 'Carta de institución sobre cumplimiento de servicio social', 'Carta de institución sobre cumplimiento de servicio social', 'downloads/PvuSnABpVsi7QlK0W9UK8yHDhMDBkq0hFsLgCcsl.doc', 'doc', 1, 1, '2026-04-03 04:19:52', '2026-04-03 04:19:52'),
(9, 'Constancia 500 horas del docente tutor de servicio social', 'Constancia 500 horas del docente tutor de servicio social', 'downloads/DDvoBcuAR5a8ZthTYWG3LeQ550rNcbmgEGxEvE5l.doc', 'doc', 1, 1, '2026-04-03 04:20:16', '2026-04-03 04:20:16'),
(10, 'Resumen ejecutivo de proyectos de proyección social', 'Resumen ejecutivo de proyectos de proyección social', 'downloads/0QAJYd9QyRqDq8JakpxL6nfs7xcvMDM6kEPfMFT7.doc', 'doc', 1, 1, '2026-04-03 04:20:36', '2026-04-03 04:20:36'),
(11, 'Instructivo para asignación de estudiantes en instructorías', 'Instructivo para asignación de estudiantes en instructorías', 'downloads/quPgXl9NYOn7MGsv5IhxqNC4UCoheCAt0cu0YUUG.doc', 'doc', 1, 1, '2026-04-03 04:21:21', '2026-04-03 04:21:21'),
(12, 'Abandono o inactividad', 'Abandono o inactividad', 'downloads/xHrHLYYO6n5HP69O9TizqmgZr1fW1gMSGT9oez0P.doc', 'doc', 1, 1, '2026-04-03 04:21:40', '2026-04-03 04:21:40');

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
-- Estructura de tabla para la tabla `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `media_type` enum('image','video') NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `external_url` varchar(1000) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `subtitle`, `location`, `event_date`, `media_type`, `file_path`, `external_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nuestra Universidad', 'Edificio de la universidad', 'Facultad Multidisciplinaria de El Salvador', '2026-04-07', 'image', 'gallery/GQsBWhqKlhG6l4x1Tm1ecYiz4ETB8NGqvCJDuoid.jpg', NULL, 1, 1, '2026-04-07 21:47:38', '2026-04-07 21:47:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_slider_items`
--

CREATE TABLE `home_slider_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `home_slider_items`
--

INSERT INTO `home_slider_items` (`id`, `page_id`, `title`, `subtitle`, `image`, `link`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bienvenidos', 'Formación en tecnología e innovación', 'slider/gV0UQdHFsQdNnZDpZqgvIhE3cOIWYMFY0vMvZVLC.jpg', NULL, 1, 1, '2026-04-02 16:16:13', '2026-04-02 22:30:03'),
(2, 1, 'Desarrollo de Software', 'Conoce nuestra carrera', 'slider/06ibx9FlilBStZMH3KX0SAa5i9KKSefCH4MnC4Ou.jpg', 'ingreso', 2, 1, '2026-04-02 16:16:13', '2026-04-03 23:21:48'),
(3, 1, 'Tu futuro profesional', 'Prepárate para el mundo digital', 'slider/8FjqMIWW7HZCKP63sj8eykrZ7ao7wWNbZ0b6EEup.jpg', 'perfil_egresado', 3, 1, '2026-04-02 16:16:13', '2026-04-03 23:21:48');

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
(4, '2025_04_02_153350_create_pages_table', 1),
(5, '2026_04_02_153350_create_home_slider_items_table', 1),
(6, '2026_04_02_153350_create_page_sections_table', 1),
(7, '2026_04_02_153351_create_news_table', 1),
(8, '2026_04_02_160806_add_menu_fields_to_pages_table', 1),
(9, '2026_04_02_164353_create_page_section_items_table', 2),
(10, '2026_04_02_220322_create_downloads_table', 3),
(11, '2026_04_07_152107_create_alumnis_table', 4),
(12, '2026_04_07_153847_create_galleries_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `summary`, `content`, `image`, `published_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Estrenamos sitio web', 'estrenamos-sitio-web', 'Estrenamos nuestro nuevo sitio web enfocado en la carrera de Ingeniería en Desarrollo de Software', 'Nos complace presentar el nuevo sitio web de la carrera de Ingeniería en Desarrollo de Software de la Facultad Multidisciplinaria de Occidente de la Universidad de El Salvador, creado con el propósito de ofrecer un espacio digital moderno, accesible e informativo para estudiantes, aspirantes, docentes y visitantes en general.\r\n\r\nEste nuevo portal ha sido diseñado para brindar información clara y organizada sobre la carrera, incluyendo aspectos importantes como el perfil profesional, áreas de formación, oportunidades académicas, noticias, actividades y recursos de interés. Además, busca fortalecer la identidad de la carrera y mejorar la comunicación con la comunidad universitaria.\r\n\r\nA través de este sitio web, los usuarios podrán conocer mejor la propuesta académica de Ingeniería en Desarrollo de Software, mantenerse al tanto de novedades y acceder de forma más sencilla a contenido relevante relacionado con la formación profesional en el área tecnológica.\r\n\r\nEste lanzamiento representa un paso importante en el fortalecimiento de la presencia digital de la carrera, apostando por una plataforma que sirva como punto de encuentro entre la universidad y quienes desean formarse en una disciplina clave para el presente y el futuro.\r\n\r\nInvitamos a toda la comunidad a explorar este nuevo espacio, conocer sus secciones y aprovechar la información que se estará actualizando constantemente para beneficio de todos.', 'news/7xkxfjANT18IaBOhlNZIxyPbodhzY0qUsCaCy5fV.png', '2026-04-02 14:24:00', 1, '2026-04-03 02:25:04', '2026-04-03 23:42:37'),
(2, '¡Felices vacaciones de semana santa!', 'felices-vacaciones-de-semana-santa', 'En el desarrollo de todo gran proyecto, las pausas son vitales para tener una mejor visión', 'Esta Semana Santa, hagamos un alto en nuestra rutina académica. Que estos días sean un espacio genuino para la paz, la reflexión y el encuentro familiar. ✝️🕊️\r\nRecarguen energías y nos vemos el martes 7 de abril para seguir adelante.', 'news/nFidvy6X3gIS6McX67z8zgAhmUCEqwHClwqQPBwb.jpg', '2026-04-03 11:43:00', 1, '2026-04-03 23:43:52', '2026-04-03 23:43:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `show_in_menu` tinyint(1) NOT NULL DEFAULT 1,
  `menu_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `title`, `status`, `show_in_menu`, `menu_order`, `created_at`, `updated_at`) VALUES
(1, 'Inicio', 'inicio', 'Página de inicio', 1, 1, 1, '2026-04-02 16:15:35', '2026-04-02 16:15:35'),
(2, 'Ingreso', 'ingreso', 'Ingreso UES 2026', 1, 1, 2, '2026-04-02 16:45:49', '2026-04-02 16:45:49'),
(3, 'Noticias', 'noticias', 'Noticias', 1, 1, 5, '2026-04-02 19:59:27', '2026-04-02 19:59:27'),
(4, 'Plan de estudios', 'plan_estudio', 'Plan de estudios', 1, 1, 4, '2026-04-02 20:30:25', '2026-04-02 20:30:25'),
(5, 'Perfil de egresado', 'perfil_egresado', 'Perfil de egresado', 1, 1, 3, '2026-04-02 21:06:53', '2026-04-02 21:06:53'),
(6, 'Contacto', 'contacto', 'Contacto', 1, 1, 6, '2026-04-02 21:24:43', '2026-04-02 21:24:43'),
(7, 'Descargas', 'descargas', 'Descargas', 1, 1, 7, '2026-04-02 22:04:24', '2026-04-02 22:04:24'),
(8, 'Pre-egresados', 'pre-egresados', 'Pre-egresados', 1, 1, 8, '2026-04-02 22:22:08', '2026-04-02 22:22:08'),
(10, 'Alumnis', 'alumnis', 'Alumnis', 1, 1, 9, '2026-04-07 15:22:13', '2026-04-07 15:22:13'),
(11, 'Galería', 'galeria', 'Galería', 1, 1, 10, '2026-04-07 15:39:54', '2026-04-07 15:39:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `page_sections`
--

CREATE TABLE `page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `section_key` varchar(100) NOT NULL,
  `section_name` varchar(150) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_1_link` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_2_link` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `extra_1` varchar(255) DEFAULT NULL,
  `extra_2` varchar(255) DEFAULT NULL,
  `extra_3` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `page_sections`
--

INSERT INTO `page_sections` (`id`, `page_id`, `section_key`, `section_name`, `title`, `subtitle`, `content`, `image_1`, `image_1_link`, `image_2`, `image_2_link`, `button_text`, `button_link`, `extra_1`, `extra_2`, `extra_3`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'home_info', 'Sección informativa', 'Ingeniería en Desarrollo de Software', NULL, 'La carrera de Ingeniería en Desarrollo de Software de la Facultad Multidisciplinaria de Occidente prepara profesionales capaces de diseñar, desarrollar, implementar y mantener soluciones informáticas que respondan a las necesidades actuales de la sociedad, las empresas y las instituciones.\r\n\r\nEn un mundo cada vez más impulsado por la tecnología, el desarrollo de software se ha convertido en una de las áreas más importantes para la transformación digital. Por ello, esta carrera brinda a sus estudiantes una formación sólida en programación, bases de datos, arquitectura de software, análisis de sistemas, desarrollo web, aplicaciones móviles, redes, seguridad informática y gestión de proyectos tecnológicos.\r\n\r\nEstudiar Ingeniería en Desarrollo de Software en la Universidad de El Salvador representa la oportunidad de construir una base académica y profesional que permita contribuir activamente al desarrollo tecnológico del país, generando soluciones que impulsen la productividad, la educación, la comunicación y la innovación.', 'sections/home/YVrX93diKZkwAQ2lfFqiHARyoyC5czqbGxI2tbjr.jpg', 'ingreso', 'sections/home/MPeap3199qQtBp0YD2xxJfgOzS2wl74EdyDEuWK2.jpg', 'perfil_egresado', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 16:15:51', '2026-04-03 23:20:03'),
(2, 1, 'home_plan', 'Resumen plan de estudios', 'Plan de estudios', NULL, 'La Ingeniería en Desarrollo de Software promueve una formación integral basada en conocimientos técnicos, investigación, creatividad y responsabilidad social. De esta manera, busca formar profesionales que no solo dominen la tecnología, sino que también sean capaces de utilizarla para generar un impacto positivo en la sociedad.', NULL, NULL, NULL, NULL, 'Ver más', 'plan_estudio', 'Programación y desarrollo web', 'Bases de datos y análisis de sistemas', 'Ingeniería de software y tecnologías emergentes', 2, 1, '2026-04-02 16:16:00', '2026-04-03 23:19:13'),
(3, 1, 'home_news', 'Encabezado noticias', 'Noticias y avisos', NULL, 'Conoce las noticias más recientes relacionadas con la carrera y sus actividades académicas.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 16:16:07', '2026-04-02 16:16:07'),
(4, 2, 'ingreso_hero', 'Hero Ingreso', 'INGRESO 2027', '¡TU FUTURO COMIENZA AQUÍ!', 'Toda persona interesada en participar en el proceso de ingreso deberá seguir los pasos establecidos y completar cada etapa en el período correspondiente.', 'sections/ingreso/E78U3kt5639Ws3HEcv7LaQnmOChPzyN3mhTWWHCu.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 16:46:01', '2026-04-03 23:46:12'),
(5, 2, 'ingreso_periodo', 'Periodo de ingreso', 'Período de inscripción', NULL, 'El proceso de ingreso estará habilitado durante el período oficial establecido por la Universidad de El Salvador.', NULL, NULL, NULL, NULL, NULL, NULL, 'Del xx de xxxx al xx de xxxxx de xxxx', NULL, NULL, 2, 1, '2026-04-02 16:46:11', '2026-04-03 23:46:12'),
(6, 2, 'ingreso_steps', 'Pasos del proceso', 'Pasos para realizar tu proceso de ingreso', NULL, 'Sigue cada uno de los pasos para completar correctamente tu proceso de admisión.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 16:46:18', '2026-04-02 16:46:18'),
(7, 2, 'ingreso_recordatorio', 'Recordatorio', 'Recordatorio importante', NULL, 'En cualquier momento del proceso podrás ingresar con tu usuario y contraseña al sistema institucional para dar seguimiento a tu solicitud y continuar desde la última acción registrada.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 16:46:24', '2026-04-02 16:46:24'),
(8, 2, 'ingreso_contacto', 'Contacto ingreso', '¿Necesitas más información?', NULL, 'Para consultas relacionadas con el proceso de ingreso, puedes escribir al correo oficial o acceder al portal institucional.', NULL, NULL, NULL, NULL, 'Ir al portal de ingreso', 'https://eel.ues.edu.sv/ingreso', 'ingreso.universitario@ues.edu.sv', NULL, NULL, 5, 1, '2026-04-02 16:46:31', '2026-04-02 16:46:31'),
(9, 3, 'news_hero', 'Hero Noticias', 'Noticias y avisos', 'Mantente al día con la carrera', 'Conoce actividades, avisos, eventos y novedades relacionadas con Ingeniería en Desarrollo de Software.', 'sections/news/ag9Tj5p7gF97hA9uqYlGW4VwyVlS9CAcwA9RCAbb.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 19:59:49', '2026-04-03 02:23:28'),
(10, 3, 'news_intro', 'Introducción Noticias', 'Información actualizada', NULL, 'En esta sección encontrarás las publicaciones más recientes relacionadas con la carrera, procesos académicos, actividades institucionales y avisos importantes.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 19:59:49', '2026-04-02 19:59:49'),
(11, 4, 'plan_hero', 'Hero Plan de Estudios', 'Plan de estudios', 'Formación integral para el desarrollo de soluciones tecnológicas', 'Conoce la estructura académica de la carrera Ingeniería en Desarrollo de Software y las áreas de conocimiento que fortalecen tu perfil profesional durante los diez ciclos de formación.', 'sections/plan/RVeuHScC06fS5gCSsjOIsDKxCbOXLc3OOmgaSXUE.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 20:30:38', '2026-04-03 02:35:53'),
(12, 4, 'plan_intro', 'Introducción', 'Una formación académica orientada al futuro', NULL, 'El plan de estudios está diseñado para desarrollar competencias en programación, bases de datos, ingeniería de software, redes, sistemas operativos, gestión empresarial y tecnologías emergentes. Su estructura permite una evolución progresiva desde fundamentos técnicos hasta asignaturas de especialización y aplicación profesional.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 20:30:38', '2026-04-02 20:30:38'),
(13, 4, 'plan_summary', 'Resumen académico', 'Resumen general del programa', NULL, 'La carrera está organizada en diez ciclos académicos y combina asignaturas obligatorias y electivas para fortalecer tanto la base técnica como la capacidad analítica, empresarial y humana del futuro profesional.', NULL, NULL, NULL, NULL, NULL, NULL, '10 ciclos', '4 UV por asignatura', NULL, 3, 1, '2026-04-02 20:30:38', '2026-04-02 20:30:38'),
(14, 4, 'plan_areas', 'Áreas de formación', 'Áreas clave de formación', NULL, 'Estas son algunas de las áreas que estructuran el desarrollo académico y profesional del estudiante.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 20:30:38', '2026-04-02 20:30:38'),
(15, 4, 'plan_cycles', 'Malla por ciclos', 'Malla curricular por ciclos', NULL, 'Explora las asignaturas organizadas según cada ciclo del plan de estudios de la carrera.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 20:30:38', '2026-04-02 20:30:38'),
(16, 4, 'plan_cta', 'Llamado a la acción', 'Sigue explorando la carrera', NULL, 'Conoce también el perfil de egresado y descubre las competencias que desarrollará el profesional formado en Ingeniería en Desarrollo de Software.', NULL, NULL, NULL, NULL, 'Ver perfil de egresado', 'perfil_egresado', NULL, NULL, NULL, 6, 1, '2026-04-02 20:30:38', '2026-04-03 03:15:08'),
(17, 5, 'perfil_hero', 'Hero Perfil', 'Perfil de egresado', 'Formación para responder a los desafíos del entorno tecnológico', 'Conoce las competencias, capacidades y características que distinguen al profesional formado en Ingeniería en Desarrollo de Software.', 'sections/perfil/ZRUsNiHi0oledguLhlWUYjtE03zHmo3oQSndbofU.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 21:07:03', '2026-04-03 03:12:22'),
(18, 5, 'perfil_intro', 'Introducción', 'Una formación orientada a la solución de problemas', NULL, 'La carrera busca formar ingenieros capaces de mejorar, proponer y aplicar de manera eficiente y efectiva sus conocimientos en la solución de problemas mediante el análisis, diseño, construcción, implantación, mantenimiento y administración de software complejo, promoviendo además la competitividad, la ética, la colaboración y la responsabilidad social.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 21:07:03', '2026-04-02 21:07:03'),
(19, 5, 'perfil_competencias', 'Competencias', 'Competencias y capacidades del profesional', NULL, 'Estas competencias reflejan el alcance formativo y el tipo de soluciones que puede desarrollar el futuro profesional.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 21:07:03', '2026-04-02 21:07:03'),
(20, 5, 'perfil_expectativas', 'Expectativas del mercado', 'Expectativas actuales del entorno laboral', NULL, 'El entorno laboral actual exige profesionales altamente adaptables, con pensamiento crítico, habilidades técnicas sólidas y capacidad para integrarse en equipos multidisciplinarios. La globalización y la transformación digital demandan especialistas capaces de innovar, resolver problemas complejos y utilizar tecnologías emergentes para generar valor en las organizaciones.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 21:07:03', '2026-04-07 20:36:36'),
(21, 5, 'perfil_aspirante', 'Perfil del aspirante', 'Características deseables del aspirante', NULL, 'El aspirante ideal a la carrera debe contar con capacidades y actitudes que favorezcan su desarrollo académico y profesional.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 21:07:03', '2026-04-02 21:07:03'),
(22, 5, 'perfil_egresado', 'Perfil profesional del egresado', 'Perfil profesional del egresado', NULL, 'El egresado de Ingeniería en Desarrollo de Software es un profesional con capacidad de desarrollar, implementar y administrar software aplicativo, mejorando la productividad, operatividad y gestión de las organizaciones. Cuenta con visión para desarrollar soluciones aplicando procesos, modelos, estándares y herramientas de calidad, y está calificado para planear, diseñar, evaluar, controlar, instalar, integrar, construir, administrar y mantener soluciones innovadoras en aplicaciones de tecnología de información y software.', NULL, NULL, NULL, NULL, 'Ver plan de estudios', 'plan_estudio', NULL, NULL, NULL, 6, 1, '2026-04-02 21:07:03', '2026-04-03 03:14:52'),
(23, 6, 'contacto_hero', 'Hero Contacto', 'Contáctanos', 'Estamos para ayudarte', 'Ponte en contacto con la carrera de Ingeniería en Desarrollo de Software de la Facultad Multidisciplinaria de Occidente. Aquí encontrarás nuestros canales oficiales de comunicación y ubicación.', 'sections/contacto/aLK9gGFMDoQv79lBPaRoP63ceTdjKEEOkOz3550A.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 21:24:51', '2026-04-03 03:28:31'),
(24, 6, 'contacto_info', 'Información de contacto', 'Información de contacto', NULL, 'Puedes comunicarte con nosotros por teléfono o correo electrónico para resolver dudas relacionadas con la carrera.', NULL, NULL, NULL, NULL, NULL, NULL, '2484 0807', 'ids.fmocc@ues.edu.sv', NULL, 2, 1, '2026-04-02 21:24:51', '2026-04-02 21:24:51'),
(25, 6, 'contacto_social', 'Redes sociales', 'Redes sociales oficiales', NULL, 'Síguenos en nuestras plataformas oficiales para conocer noticias, avisos y actividades relacionadas con la carrera.', NULL, NULL, NULL, NULL, 'Visitar Facebook', 'https://www.facebook.com/idsfmocc', NULL, NULL, NULL, 3, 1, '2026-04-02 21:24:51', '2026-04-02 21:24:51'),
(26, 6, 'contacto_maps', 'Ubicación', 'Ubicación', NULL, 'Nos encontramos en la Facultad Multidisciplinaria de Occidente de la Universidad de El Salvador.', NULL, NULL, NULL, NULL, 'Ver en Google Maps', 'https://www.google.com/maps/place/Facultad+Multidisciplinaria+de+Occidente+UES/@13.972913,-89.5781233,3750m/data=!3m1!1e3!4m6!3m5!1s0x8f62e8f193eda62f:0xd40e3f2801fddb61!8m2!3d13.970256!4d-89.5731047!16s%2Fg%2F1213hpnv?entry=ttu&g_ep=EgoyMDI2MDMzMS4wIKXMD', NULL, NULL, NULL, 4, 1, '2026-04-02 21:24:51', '2026-04-02 21:24:51'),
(27, 6, 'contacto_cta', 'CTA final', 'Comunícate con nosotros', NULL, 'Estamos comprometidos con brindarte información clara y oportuna sobre la carrera, su proceso de ingreso y sus oportunidades de formación.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 21:24:51', '2026-04-02 21:24:51'),
(28, 7, 'downloads_hero', 'Hero Descargas', 'Descargas', 'Documentos y recursos disponibles', 'En esta sección encontrarás archivos y documentos de interés relacionados con la carrera, disponibles para su consulta y descarga.', 'sections/descargas/5rSXKzVhFYZOgBbv8A01ob1CpQzS4uwjFqWqsMYH.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 22:04:46', '2026-04-03 04:13:18'),
(29, 7, 'downloads_intro', 'Introducción Descargas', 'Recursos disponibles', NULL, 'Accede a documentos informativos, formularios, guías, archivos académicos y otros recursos importantes disponibles para descarga.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 22:04:46', '2026-04-02 22:04:46'),
(59, 8, 'preegreso_hero', 'Hero Pre-egresados', 'Pre-egresados', 'Información clave para estudiantes avanzados de la carrera', 'Conoce las líneas de especialización, trabajos de grado y requisitos del servicio social para estudiantes de Ingeniería en Desarrollo de Software.', 'sections/preegresados/0N9CTMzMQkI0AtxH0GpNXFMA6IoAI9UabpvC4nTa.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 14:59:52', '2026-04-07 21:11:44'),
(60, 8, 'preegreso_intro', 'Introducción', 'Información para tu etapa final de formación', NULL, 'Esta sección reúne información importante para estudiantes que ya cursan etapas avanzadas de la carrera y necesitan orientación sobre especializaciones, trabajos de grado y servicio social.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(61, 8, 'preegreso_especializaciones_intro', 'Introducción especializaciones', 'Líneas de especialización', NULL, 'Las líneas de especialización se desbloquean al llegar a cuarto año. La primera materia electiva que el estudiante curse define la línea que continuará. En 2025 se ofertaron dos líneas: Diseño de Software y Desarrollo de Software. También debe considerarse que, por demanda mayoritaria, podría ofertarse solo una línea.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(62, 8, 'preegreso_especializaciones_materias', 'Materias por especialización', 'Materias por línea de especialización', NULL, 'A continuación se detallan las materias que corresponden a cada línea según el pensum 2021.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(63, 8, 'preegreso_trabajos_grado', 'Trabajos de grado', 'Trabajos de grado', NULL, 'Las opciones de trabajos de grado incluyen varias modalidades académicas y profesionales. Para su oferta, debes estar pendiente de publicaciones en redes sociales y por este medio.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(64, 8, 'preegreso_servicio_social_intro', 'Introducción servicio social', 'Servicio social', NULL, 'El Reglamento General de Proyección Social de la Universidad de El Salvador define el servicio social como la actividad retributiva, obligatoria y prioritariamente gratuita que realiza todo estudiante en beneficio de la sociedad, previo a obtener el título académico.', NULL, NULL, NULL, NULL, NULL, NULL, '500 horas', 'Mínimo 3 meses / máximo 18 meses', NULL, 6, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(65, 8, 'preegreso_servicio_social_requisitos', 'Requisitos servicio social', 'Requisitos para iniciar servicio social', NULL, 'Estos requisitos deben cumplirse antes de iniciar el trámite correspondiente.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(66, 8, 'preegreso_servicio_social_objetivos', 'Objetivos servicio social', 'Objetivos del servicio social', NULL, 'El servicio social busca fortalecer la relación entre la formación universitaria y la sociedad.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(67, 8, 'preegreso_servicio_social_modalidades', 'Modalidades servicio social', 'Modalidades del servicio social', NULL, 'En la FMOcc UES se contemplan distintas modalidades aprobadas para desarrollar el servicio social.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(68, 8, 'preegreso_servicio_social_pasos', 'Pasos servicio social', 'Pasos para iniciar y realizar el trámite del servicio social', NULL, 'Antes de iniciar, debes verificar en tu expediente que tienes acreditado al menos el 60% de unidades valorativas de la carrera.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 1, '2026-04-07 14:59:52', '2026-04-07 14:59:52'),
(69, 8, 'preegreso_cta', 'CTA final', 'Mantente pendiente de los avisos oficiales', NULL, 'Para procesos de especialización, trabajos de grado y servicio social, revisa con frecuencia este sitio, la sección de descargas y las redes sociales oficiales de la carrera.', NULL, NULL, NULL, NULL, 'Ir a descargas', 'descargas', NULL, NULL, NULL, 11, 1, '2026-04-07 14:59:52', '2026-04-07 21:11:44'),
(70, 10, 'alumnis_hero', 'Hero Alumnis', 'Alumnis', 'Historias que inspiran', 'Conoce casos de éxito de ex-estudiantes de Ingeniería en Desarrollo de Software y descubre cómo su formación académica ha impactado su vida profesional.', 'sections/alumnis/g4OKCTYVYFW0e0GC1B7EMIPQaZozovyjRxdoRME9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:22:26', '2026-04-07 21:30:42'),
(71, 10, 'alumnis_intro', 'Introducción Alumnis', 'Casos de éxito', NULL, 'En esta sección compartimos experiencias, trayectorias y logros de graduados que han destacado en distintos ámbitos profesionales.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:22:26', '2026-04-07 15:22:26'),
(72, 11, 'gallery_hero', 'Hero Galería', 'Galería', 'Momentos, actividades y experiencias', 'Explora imágenes y videos de actividades, eventos y espacios relacionados con la carrera Ingeniería en Desarrollo de Software.', 'sections/galeria/uTAmjqhe5CRcvrojpcP91IiKrwMs7FrJI23WQh85.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:40:05', '2026-04-07 21:46:43'),
(73, 11, 'gallery_intro', 'Introducción Galería', 'Contenido multimedia', NULL, 'En esta sección podrás encontrar material visual de actividades académicas, eventos institucionales, visitas, exposiciones y otros momentos importantes de la carrera.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:40:05', '2026-04-07 15:40:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `page_section_items`
--

CREATE TABLE `page_section_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `extra_1` varchar(255) DEFAULT NULL,
  `extra_2` varchar(255) DEFAULT NULL,
  `extra_3` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `page_section_items`
--

INSERT INTO `page_section_items` (`id`, `page_section_id`, `title`, `subtitle`, `content`, `image`, `link`, `extra_1`, `extra_2`, `extra_3`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, '01. Registro de datos', NULL, 'Accede al sistema de ingreso para crear tu cuenta. Se solicitará tu correo electrónico personal, donde recibirás un código de verificación.', NULL, 'https://eel.ues.edu.sv/ingreso', NULL, NULL, NULL, 1, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(2, 6, '02. Prueba de aptitudes', NULL, 'Ingresa con tu usuario y contraseña para realizar la prueba de aptitudes, la cual orientará tu elección mediante una lista de carreras sugeridas.', NULL, 'https://eel.ues.edu.sv/ingreso', NULL, NULL, NULL, 2, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(3, 6, '03. Selección de carrera', NULL, 'Selecciona modalidad, sede, facultad y carrera según tus intereses y disponibilidad.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(4, 6, '04. Curso de refuerzo', NULL, 'Inscríbete al curso de refuerzo académico en línea para fortalecer conocimientos de bachillerato y prepararte para la prueba de conocimiento general.', NULL, 'https://ingreso.ues.edu.sv/login/index.php', NULL, NULL, NULL, 4, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(5, 6, '05. Impresión de comprobante', NULL, 'Accede con tu usuario y contraseña para imprimir tu comprobante de inscripción F-1, donde encontrarás la información relacionada con tu prueba.', NULL, 'https://eel.ues.edu.sv/ingreso', NULL, NULL, NULL, 5, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(6, 6, '06. Aviso importante', NULL, 'Cada aspirante debe estar pendiente de las notificaciones enviadas a su correo electrónico para atender observaciones o actualizaciones del proceso.', NULL, NULL, NULL, NULL, NULL, 6, 1, '2026-04-02 16:46:38', '2026-04-02 16:46:38'),
(7, 12, 'Desarrollo de software', NULL, 'Formación en programación, paradigmas, lógica, orientación a objetos, desarrollo web, móvil y reutilización de software.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 20:30:52', '2026-04-02 20:30:52'),
(8, 12, 'Bases de datos y arquitectura', NULL, 'Aprendizaje progresivo en modelado, diseño, programación y administración de bases de datos, así como arquitectura de software.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 20:30:52', '2026-04-02 20:30:52'),
(9, 12, 'Redes, sistemas y nube', NULL, 'Estudio de sistemas operativos, redes, programación en red y computación en la nube como soporte de infraestructuras modernas.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 20:30:52', '2026-04-02 20:30:52'),
(10, 12, 'Gestión y negocios', NULL, 'Integración de contenidos empresariales, finanzas, gestión del capital humano, proyectos y negocios vinculados al sector tecnológico.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 20:30:52', '2026-04-02 20:30:52'),
(11, 12, 'Innovación y tecnologías emergentes', NULL, 'Espacios para electivas como machine learning, testing, seguridad, software dirigido por modelos e informática industrial.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 20:30:52', '2026-04-02 20:30:52'),
(12, 15, 'Ciclo 1', NULL, 'ITE135 - Inglés Técnico I\r\nIIS135 - Introducción a la Ingeniería de Software\r\nIBD135 - Introducción a las Bases de Datos\r\nMAT135 - Matemática Aplicada I\r\nPAP135 - Paradigmas de Programación', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(13, 15, 'Ciclo 2', NULL, 'FIN135 - Física para Ingeniería\r\nITE235 - Inglés Técnico II\r\nIIA135 - Investigación en Ingeniería Aplicada\r\nMAT235 - Matemática Aplicada II\r\nPYE135 - Probabilidad y Estadística', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(14, 15, 'Ciclo 3', NULL, 'DPB135 - Diseño y Programación de Base de Datos\r\nITE335 - Inglés Técnico III\r\nLDP135 - Lógica de Programación\r\nMED135 - Manejo de Estructura de Datos\r\nPEC135 - Principios de Economía', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(15, 15, 'Ciclo 4', NULL, 'ABD135 - Administración de Bases de Datos\r\nISL135 - Introducción al Software Libre\r\nLDD135 - Lógica y Diseño Digital\r\nPOO135 - Programación Orientada a Objetos\r\nPTR135 - Psicología del Trabajo', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(16, 15, 'Ciclo 5', NULL, 'AFI135 - Análisis de las Finanzas\r\nADS135 - Análisis y Diseño de Software I\r\nCDA135 - Cálculo Numérico para Desarrollo de Aplicaciones\r\nDAW135 - Desarrollo de Aplicaciones Web\r\nDEC135 - Diseño y Estructura de Computadoras', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(17, 15, 'Ciclo 6', NULL, 'ADS235 - Análisis y Diseño de Software II\r\nGPO135 - Gestión y Programación de Sistemas Operativos I\r\nIGE135 - Introducción a la Gestión Empresarial\r\nPDN135 - Plan de Negocios\r\nPMM135 - Programación de Modelos Matemáticos', NULL, NULL, NULL, NULL, NULL, 6, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(18, 15, 'Ciclo 7', NULL, 'CMP135 - Compiladores\r\nDAM135 - Desarrollo de Aplicaciones Móviles I\r\nDTW135 - Desarrollo y Técnicas de Aplicaciones Web\r\nGPO235 - Gestión y Programación de Sistemas Operativos II\r\nINE135 - Ingeniería de Negocios\r\nRED135 - Redes I', NULL, NULL, NULL, NULL, NULL, 7, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(19, 15, 'Ciclo 8', NULL, 'CPN135 - Computación en la Nube\r\nDAM235 - Desarrollo de Aplicaciones Móviles II\r\nDSM135 - Desarrollo de Software dirigido por Modelos\r\nDSI135 - Dinámica de Sistemas\r\nMCH135 - Machine Learning\r\nRED235 - Redes II\r\nCAS135 - Testing y Calidad del Software', NULL, NULL, NULL, NULL, NULL, 8, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(20, 15, 'Ciclo 9', NULL, 'AIW135 - Arquitectura de la Información Web\r\nDLA135 - Derecho Laboral\r\nEPR135 - Ética Profesional\r\nGCH135 - Gestión del Capital Humano\r\nGPR135 - Gestión y Programación de Sistemas Operativos en Red\r\nIFN135 - Informática Industrial\r\nSDS135 - Seguridad en el Desarrollo de Software', NULL, NULL, NULL, NULL, NULL, 9, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(21, 15, 'Ciclo 10', NULL, 'ARS135 - Arquitectura de Software\r\nAPR135 - Asesoría Profesional\r\nASI135 - Auditoría de Sistemas Informáticos\r\nDRS135 - Desarrollo y Reutilización de Software\r\nGPS135 - Gestión de Proyectos de Software\r\nSTE135 - Seminario de Tesis', NULL, NULL, NULL, NULL, NULL, 10, 1, '2026-04-02 20:31:04', '2026-04-02 20:31:04'),
(22, 16, 'Resolución de problemas mediante software', NULL, 'Identificar metodologías para la resolución de problemas mediante el análisis, diseño, construcción, implantación, mantenimiento y administración de software.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 21:07:19', '2026-04-02 21:07:19'),
(23, 16, 'Optimización de procesos', NULL, 'Diseñar software que permita agilizar procesos y dar solución a problemas en diferentes áreas con criterios de optimización de recursos.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 21:07:19', '2026-04-02 21:07:19'),
(24, 16, 'Desarrollo en distintos dominios', NULL, 'Diseñar, desarrollar e implementar software para sistemas informáticos complejos en dominios de aplicación como comercio, industria, financiero, judicial y gubernamental.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 21:07:19', '2026-04-02 21:07:19'),
(25, 16, 'Detección de oportunidades de mejora', NULL, 'Identificar oportunidades de mejora con base en tecnología informática y de comunicaciones en organizaciones de distintos dominios.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 21:07:19', '2026-04-02 21:07:19'),
(26, 16, 'Evaluación integral de soluciones', NULL, 'Diseñar, evaluar, administrar y seleccionar alternativas de solución considerando factibilidad tecnológica, operativa, de implementación, cultura organizacional, recurso humano, políticas institucionales, normativa, medio ambiente y retorno de la inversión.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 21:07:19', '2026-04-02 21:07:19'),
(27, 17, 'Resolución de problemas', NULL, 'Capacidad de resolución de problemas mediante análisis, diseño, construcción, implantación, mantenimiento y administración de software.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(28, 17, 'Dominio tecnológico', NULL, 'Dominio de distintas tecnologías utilizadas en el área de desarrollo de software.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(29, 17, 'Administración de sistemas e infraestructura', NULL, 'Capacidad de administrar sistemas informáticos e infraestructura tecnológica.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(30, 17, 'Levantamiento de requerimientos', NULL, 'Comprensión y descripción de requerimientos informáticos.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(31, 17, 'Soluciones multiplataforma', NULL, 'Capacidad de integrar soluciones tecnológicas multiplataforma.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(32, 17, 'Gestión y negocios', NULL, 'Capacidad de llevar a cabo un plan de negocios y gestionar proyectos de desarrollo de software.', NULL, NULL, NULL, NULL, NULL, 6, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(33, 17, 'Redes, seguridad y auditoría', NULL, 'Capacidad de diseñar y administrar redes informáticas, asegurar datos e infraestructura y auditar sistemas informáticos.', NULL, NULL, NULL, NULL, NULL, 7, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(34, 17, 'Calidad y trabajo colaborativo', NULL, 'Buena capacidad de comunicación, gestión del tiempo, trabajo en equipo y aseguramiento de la calidad.', NULL, NULL, NULL, NULL, NULL, 8, 1, '2026-04-02 21:07:28', '2026-04-02 21:07:28'),
(35, 18, 'Autoaprendizaje', NULL, 'Capacidad de adaptación al autoaprendizaje.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(36, 18, 'Base lógico-matemática', NULL, 'Aptitud para la matemática, la física y la solución de problemas.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(37, 18, 'Análisis y síntesis', NULL, 'Capacidad de análisis y síntesis para comprender y resolver situaciones complejas.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(38, 18, 'Perseverancia', NULL, 'Perseverancia para lograr objetivos académicos y profesionales.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(39, 18, 'Creatividad e innovación', NULL, 'Creatividad, innovación, dinamismo y capacidad de adaptarse al avance tecnológico mundial.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(40, 18, 'Trabajo en equipo', NULL, 'Disposición para el trabajo colaborativo.', NULL, NULL, NULL, NULL, NULL, 6, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(41, 18, 'Organización y compromiso', NULL, 'Organización y alto sentido de compromiso.', NULL, NULL, NULL, NULL, NULL, 7, 1, '2026-04-02 21:07:36', '2026-04-02 21:07:36'),
(42, 20, 'Diseño de Software', 'Especialización 1', 'Se centra en la arquitectura de sistemas complejos, el modelado y el diseño de arquitecturas eficientes para mejorar la experiencia del usuario y el rendimiento del software en proyectos innovadores.', NULL, NULL, 'Puede ofertarse o no según demanda', NULL, NULL, 1, 1, '2026-04-02 22:22:40', '2026-04-02 22:22:40'),
(43, 20, 'Desarrollo de Software', 'Especialización 2', 'Se centra en implementar y optimizar aplicaciones con tecnologías emergentes, fortaleciendo habilidades en computación en la nube, machine learning y seguridad para crear soluciones innovadoras.', NULL, NULL, 'Puede ofertarse o no según demanda', NULL, NULL, 2, 1, '2026-04-02 22:22:40', '2026-04-02 22:22:40'),
(44, 20, 'Ciclo VII al X', 'Diseño de Software', 'Ciclo VII: Compiladores (CMP135).\r\nPrerrequisito: GPO135.\r\n\r\nCiclo VIII: Dinámica de Sistemas (DSI135) y Desarrollo de Software Dirigido por Modelos (DSM135).\r\nPrerrequisito: CMP135.\r\n\r\nCiclo IX: Gestión y Programación de Sistemas Operativos en Red (GPR135) y Arquitectura de la Información Web (AIW135).\r\nPrerrequisitos: DSI135 y DSM135.\r\n\r\nCiclo X: Arquitectura de Software (ARS135).\r\nPrerrequisitos: GPR135 y AIW135.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 22:22:50', '2026-04-07 20:36:36'),
(45, 20, 'Ciclo VII al X', 'Desarrollo de Software', 'Ciclo VII: Desarrollo y Técnicas de Aplicaciones Web (DTW135).\r\nPrerrequisito: DAW135.\r\n\r\nCiclo VIII: Computación en la Nube (CPN135) y Machine Learning (MCH135).\r\nPrerrequisito: DTW135.\r\n\r\nCiclo IX: Seguridad en el Desarrollo de Software (SDS135) e Informática Industrial (IFN135).\r\nPrerrequisitos: CPN135 y MCH135.\r\n\r\nCiclo X: Desarrollo y Reutilización de Software (DRS135).\r\nPrerrequisitos: SDS135 e IFN135.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 22:22:50', '2026-04-07 20:36:36'),
(46, 21, 'Tesis', NULL, 'Modalidad formal de investigación y desarrollo académico.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(47, 21, 'Pasantías', NULL, 'Experiencia práctica supervisada en instituciones u organizaciones.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(48, 21, 'Monografías', NULL, 'Desarrollo documental y analítico sobre un tema específico.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(49, 21, 'Proyectos de innovación tecnológica', NULL, 'Proyectos orientados a soluciones innovadoras con base tecnológica.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(50, 21, 'Apoyo en centro de investigaciones multidisciplinario', NULL, 'Participación en proyectos vinculados a investigación y apoyo institucional.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(51, 21, 'Cursos de especialización', NULL, 'Alternativa académica según la oferta vigente.', NULL, NULL, NULL, NULL, NULL, 6, 1, '2026-04-02 22:23:19', '2026-04-02 22:23:19'),
(52, 22, 'Requisito 1', '60% de unidades valorativas', 'Haber cursado como mínimo el 60% de unidades valorativas de la carrera y contar con la respectiva constancia emitida por la Administración Académica de la Facultad. Para uso interno se verifica en el sistema Prometeo; para uso externo se usa constancia de nivel de estudio o avance del plan.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-02 22:23:29', '2026-04-02 22:23:29'),
(53, 22, 'Requisito 2', 'Aprobación de Proyección Social', 'Tener la aprobación del jefe o jefa de la Unidad de Proyección Social. Esto se legaliza mediante Carta de Asignación al Proyecto o Programa, delimitando la fecha de inicio del servicio social.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-02 22:23:29', '2026-04-02 22:23:29'),
(54, 22, 'Objetivos del servicio social', 'Objetivos', 'Contribuir al desarrollo y transformación de la sociedad, potenciar la formación académica del futuro profesional y fortalecer su humanización y conciencia social.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-02 22:23:29', '2026-04-02 22:23:29'),
(55, 22, 'Modalidades', 'Modalidades aprobadas', 'Virtual, presencial y semipresencial.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-02 22:23:29', '2026-04-02 22:23:29'),
(63, 61, 'Diseño de Software', 'Línea 1', 'Se centra en la arquitectura de sistemas complejos, aprendiendo modelado y diseñando arquitecturas eficientes para mejorar la experiencia del usuario y el rendimiento del software en proyectos innovadores.', 'sections/preegresados/xprBaXHuDcQsfLqHlP28EAPATpBEq68qv8cZT178.webp', NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:02:33', '2026-04-07 21:11:44'),
(64, 61, 'Desarrollo de Software', 'Línea 2', 'Se centra en implementar y optimizar aplicaciones con tecnologías emergentes, desarrollando habilidades en computación en la nube, machine learning y seguridad para crear soluciones innovadoras.', 'sections/preegresados/jdV0SHt4SInnoDJTdelU39zKYE4wYc81FvF9lWuD.jpg', NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:02:33', '2026-04-07 21:11:44'),
(65, 62, 'Diseño de Software', 'Materias por ciclo', 'Ciclo VII:\r\n35 - Compiladores (CMP135)\r\nPrerrequisito: GPO135\r\n\r\nCiclo VIII:\r\n39 - Dinámica de Sistemas (DSI135)\r\nPrerrequisito: CMP135\r\n40 - Desarrollo de Software Dirigido por Modelos (DSM135)\r\nPrerrequisito: CMP135\r\n\r\nCiclo IX:\r\n44 - Gestión y Programación de Sistemas Operativos en Red (GPR135)\r\nPrerrequisitos: DSI135, DSM135\r\n45 - Arquitectura de la Información Web (AIW135)\r\nPrerrequisitos: DSI135, DSM135\r\n\r\nCiclo X:\r\n50 - Arquitectura de Software (ARS135)\r\nPrerrequisitos: GPR135, AIW135', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:02:50', '2026-04-07 15:02:50'),
(66, 62, 'Desarrollo de Software', 'Materias por ciclo', 'Ciclo VII:\r\n35 - Desarrollo y Técnicas de Aplicaciones Web (DTW135)\r\nPrerrequisito: DAW135\r\n\r\nCiclo VIII:\r\n39 - Computación en la Nube (CPN135)\r\nPrerrequisito: DTW135\r\n40 - Machine Learning (MCH135)\r\nPrerrequisito: DTW135\r\n\r\nCiclo IX:\r\n44 - Seguridad en el Desarrollo de Software (SDS135)\r\nPrerrequisitos: CPN135, MCH135\r\n45 - Informática Industrial (IFN135)\r\nPrerrequisitos: CPN135, MCH135\r\n\r\nCiclo X:\r\n50 - Desarrollo y Reutilización de Software (DRS135)\r\nPrerrequisitos: SDS135, IFN135', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:02:50', '2026-04-07 15:02:50'),
(67, 63, 'Tesis', NULL, 'Modalidad formal de investigación y desarrollo académico.', 'sections/preegresados/BNCYQ3V1526PO1GIAu4V9FoACXdqSu1Vfm6h4mXu.jpg', NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:44'),
(68, 63, 'Pasantías profesionales', NULL, 'Experiencia práctica supervisada en instituciones u organizaciones.', 'sections/preegresados/3C8PZrbaCDT2QkbajkzPZnQC9kEamf1Bl5mkuodo.png', NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:45'),
(69, 63, 'Monografías', NULL, 'Trabajo documental y analítico sobre un tema específico.', 'sections/preegresados/36BRXfz1NILqD1qWLL86lcNqx8hi4CGRz0kwK2ET.jpg', NULL, NULL, NULL, NULL, 3, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:45'),
(70, 63, 'Proyectos de innovación tecnológica', NULL, 'Proyectos orientados a soluciones innovadoras con base tecnológica.', 'sections/preegresados/SB9TCHkoi0u8TGi3Gww2Al0eSROuY47vgXs9z6rg.jpg', NULL, NULL, NULL, NULL, 4, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:45'),
(71, 63, 'Apoyo en el centro de investigación multidisciplinario', NULL, 'Participación en proyectos vinculados a investigación y apoyo institucional.', 'sections/preegresados/0fXkZfvov2vx79CSNPiqz0va3HcwCUr9KkxNn5wO.png', NULL, NULL, NULL, NULL, 5, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:45'),
(72, 63, 'Cursos de especialización', NULL, 'Alternativa académica según la oferta vigente.', 'sections/preegresados/owqp05bvutl2Dvoada9kOHxF3VsqNLZF7DrI3XnL.jpg', NULL, NULL, NULL, NULL, 6, 1, '2026-04-07 15:03:06', '2026-04-07 21:11:45'),
(73, 65, 'Requisito 1', '60% de unidades valorativas', 'Haber cursado como mínimo el 60% de unidades valorativas de la carrera y contar con la respectiva constancia emitida por la Administración Académica de la Facultad. Para uso interno se verifica en sistema Prometeo; para uso externo se utiliza constancia de nivel de estudio o avance de plan de estudio.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:03:21', '2026-04-07 15:03:21'),
(74, 65, 'Requisito 2', 'Aprobación de Proyección Social', 'Tener la aprobación del o la jefe(a) de la Unidad de Proyección Social. Esto se legaliza con Carta de Asignación al Proyecto o Programa, donde se delimita la fecha de inicio del Servicio Social.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:03:21', '2026-04-07 15:03:21'),
(75, 66, 'Objetivo 1', NULL, 'Contribuir al desarrollo y transformación de la sociedad, especialmente a los sectores más vulnerables con la formación académica de los y las estudiantes de la UES.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:03:37', '2026-04-07 15:03:37'),
(76, 66, 'Objetivo 2', NULL, 'Potenciar la formación académica del futuro profesional mediante la interacción con la sociedad.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:03:37', '2026-04-07 15:03:37'),
(77, 66, 'Objetivo 3', NULL, 'Fortalecer la humanización y conciencia social del futuro profesional de la UES.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-07 15:03:37', '2026-04-07 15:03:37'),
(78, 67, 'Virtual', NULL, 'Modalidad aprobada por la FMOcc UES para realizar servicio social.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:04:01', '2026-04-07 15:04:01'),
(79, 67, 'Presencial', NULL, 'Modalidad aprobada por la FMOcc UES para realizar servicio social.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:04:01', '2026-04-07 15:04:01'),
(80, 67, 'Semipresencial', NULL, 'Modalidad aprobada por la FMOcc UES para realizar servicio social.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-07 15:04:01', '2026-04-07 15:04:01'),
(81, 67, 'Tutorías y proyectos', NULL, 'También se puede realizar servicio social apoyando en tutorías, en proyectos universitarios internos o externos, según se vayan consiguiendo y ofertando los proyectos.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-07 15:04:01', '2026-04-07 15:04:01'),
(82, 68, 'Paso 1', NULL, 'Descargar la hoja de inscripción para realizar el servicio social en la sección descargas.', NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-04-07 15:04:18', '2026-04-07 15:04:18'),
(83, 68, 'Paso 2', NULL, 'Enviar la hoja de inscripción de servicio social y la carta de la institución donde realizará el servicio social al correo institucional del coordinador(a) de la Subunidad de Proyección Social del departamento académico correspondiente, en un período máximo de 10 días hábiles antes de iniciar. Luego agregar la solicitud institucional con los datos del estudiante y actividades, y cuando se apruebe, enviar la hoja de inscripción y la declaración jurada si aplica.', NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-04-07 15:04:18', '2026-04-07 15:04:18'),
(84, 68, 'Paso 3', NULL, 'Presentar el proyecto de servicio social en un período máximo de 15 días hábiles después de iniciado el proyecto. El formato puede descargarse en la sección descargas.', NULL, NULL, NULL, NULL, NULL, 3, 1, '2026-04-07 15:04:18', '2026-04-07 15:04:18'),
(85, 68, 'Paso 4', NULL, 'Entenderse con el docente tutor del servicio social y llevar control de asesorías.', NULL, NULL, NULL, NULL, NULL, 4, 1, '2026-04-07 15:04:18', '2026-04-07 15:04:18'),
(86, 68, 'Nota importante', NULL, 'Ningún servicio social es retroactivo. Nadie está autorizado a realizarlo sin haber completado el trámite respectivo en el departamento académico correspondiente. Además, de preferencia, todos los trámites deberán realizarse en modalidad virtual hasta nuevo aviso.', NULL, NULL, NULL, NULL, NULL, 5, 1, '2026-04-07 15:04:18', '2026-04-07 15:04:18');

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
('fs73gH2GmA7CYVmQrjgl7aO9njOqD7V319S5IEIP', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZzQzU3ZhV0Vyd3E4QXIyRGVxUU5WU2FiWHVGd213WWtxM1dCbDI5NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLXVlcy9wdWJsaWMvYWRtaW4vZ2FsZXJpYS8xL2VkaXQiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLmdhbGxlcnkuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1775576867);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@ues.edu.sv', NULL, '$2y$12$6PLJSW4K2wBwF4zKK6Zd3ekEIX8B3VClfvzP./aTnKmKl.yVCVYPS', NULL, '2026-04-02 22:28:30', '2026-04-02 22:29:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumnis_slug_unique` (`slug`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `home_slider_items`
--
ALTER TABLE `home_slider_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_slider_items_page_id_foreign` (`page_id`);

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
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`);

--
-- Indices de la tabla `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indices de la tabla `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_sections_page_id_section_key_unique` (`page_id`,`section_key`);

--
-- Indices de la tabla `page_section_items`
--
ALTER TABLE `page_section_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_section_items_page_section_id_foreign` (`page_section_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnis`
--
ALTER TABLE `alumnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `home_slider_items`
--
ALTER TABLE `home_slider_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `page_section_items`
--
ALTER TABLE `page_section_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `home_slider_items`
--
ALTER TABLE `home_slider_items`
  ADD CONSTRAINT `home_slider_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `page_sections`
--
ALTER TABLE `page_sections`
  ADD CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `page_section_items`
--
ALTER TABLE `page_section_items`
  ADD CONSTRAINT `page_section_items_page_section_id_foreign` FOREIGN KEY (`page_section_id`) REFERENCES `page_sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
