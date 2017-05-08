-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2017 a las 05:19:43
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sai`
--

CREATE TABLE `sai` (
  `sai_id` int(11) NOT NULL,
  `marca` varchar(35) CHARACTER SET utf8 NOT NULL,
  `modelo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `vatios` int(5) NOT NULL,
  `precio` double(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `sai`
--

INSERT INTO `sai` (`sai_id`, `marca`, `modelo`, `vatios`, `precio`) VALUES
(1, 'APC', 'Smart-UPS SRT', 450, 2596.00),
(2, 'Salicru', 'SPS One 700', 360, 54.00),
(3, 'Riello', 'UPS Vision Dual VSD 3000', 2700, 781.22),
(4, 'APC', 'Back-UPS Pro 1500', 865, 284.81),
(6, 'Riello', 'UPS iDialog IDG 600', 360, 52.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sai`
--
ALTER TABLE `sai`
  ADD PRIMARY KEY (`sai_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sai`
--
ALTER TABLE `sai`
  MODIFY `sai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
