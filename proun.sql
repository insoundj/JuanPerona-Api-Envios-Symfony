-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2023 a las 12:15:44
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proun`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'juan@gmail.com', '[]', '$2y$13$doUV7oHZc8bDPaO45LlGL.Gk.3GzUOv2jTHmDW7B4QF8zwEc/wKVq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `recogida` longtext NOT NULL COMMENT '(DC2Type:json)',
  `destino` longtext NOT NULL COMMENT '(DC2Type:json)',
  `localizador` varchar(255) NOT NULL,
  `vehiculo` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id`, `uuid`, `recogida`, `destino`, `localizador`, `vehiculo`, `user_id`) VALUES
(1, 0x6349905299f84048bdd482482975228f, '{\"nombre\":\"Madrid\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Ciudad Real\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '1c85duwfob', 'coche', 1),
(2, 0x6428e786419b43048f9a2ad80b493243, '{\"nombre\":\"Daimiel\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Toledo\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '6p2ytdgr5m', 'coche', 1),
(3, 0xb3583a403c304fbc9b446d8e8e4b6246, '{\"nombre\":\"Aviles\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Oviedo\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', 'sp768a0rtx', 'furgoneta', 1),
(4, 0xd1629a42a4da411c97c85b301f9e4e7a, '{\"nombre\":\"Valencia\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Zamora\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '0u91tnopy5', 'compartido', 1),
(5, 0xcc6148bfbc52452eb3fc9e0ddeaadbc6, '{\"nombre\":\"Madrid\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Barcelona\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '13n1ka9826', 'compartido', 1),
(6, 0xd2de2ba3afde4902a1125e4628b6c74a, '{\"nombre\":\"Daimiel\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', '{\"nombre\":\"Ciudad Real\",\"latitud\":\"40.37032828636249\",\"longitud\":\"-3.6843720154096196\"}', 'jswk006l2u', 'coche', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230512152207', '2023-05-12 17:22:30', 1408),
('DoctrineMigrations\\Version20230512193645', '2023-05-12 21:37:04', 395),
('DoctrineMigrations\\Version20230513081641', '2023-05-13 10:16:55', 3045),
('DoctrineMigrations\\Version20230515104317', '2023-05-15 12:43:31', 2837),
('DoctrineMigrations\\Version20230515114952', '2023-05-15 13:50:10', 2435);



--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_754737D5A76ED395` (`user_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `FK_754737D5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
