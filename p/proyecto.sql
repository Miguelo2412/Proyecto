-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2023 a las 06:41:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `identificacion` char(10) NOT NULL,
  `NIT` char(10) NOT NULL,
  `tipo_documento` enum('C.C','T.I','C.E') NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre2` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` enum('Hombre','Mujer','Indefinido') DEFAULT NULL,
  `estado_civil` enum('soltero(a)','casado(a)','viudo(a)','divorciado(a)') DEFAULT NULL,
  `telefono` double NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`identificacion`, `NIT`, `tipo_documento`, `nombre`, `nombre2`, `apellido`, `apellido2`, `fecha_nacimiento`, `genero`, `estado_civil`, `telefono`, `correo`) VALUES
('1074810385', '5125', 'T.I', 'Miguel ', 'Angel', 'Zamora', 'Guerrero', '2005-12-24', 'Hombre', 'soltero(a)', 3132139963, 'mzamora163@vidanueva.edu.co'),
('3669853362', '5125', 'C.C', 'Helmut', 'Henrique', 'Romero', 'Ramirez', '2000-04-30', 'Hombre', 'soltero(a)', 3158074034, 'helmutramirez@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `NIT` char(10) NOT NULL,
  `nombre_empresa` varchar(50) NOT NULL,
  `telefono` double NOT NULL,
  `correo` varchar(50) NOT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `barrio` varchar(50) NOT NULL,
  `nomenclatura` varchar(20) NOT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`NIT`, `nombre_empresa`, `telefono`, `correo`, `municipio`, `barrio`, `nomenclatura`, `twitter`, `facebook`, `instagram`, `youtube`) VALUES
('5125', 'Microsoft', 6013264700, 'Microsoft@gmail.com', 'Distrito Capital', 'Santa Bárbara', 'Cl. 92 #11-51', 'https://twitter.com/Microsoft', 'https://www.facebook.com/Microsoft', 'https://www.instagram.com/microsoft/', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(15) NOT NULL,
  `identidad_usu` int(14) NOT NULL,
  `tipo_docu_usu` varchar(50) NOT NULL,
  `nombre_usu` varchar(50) NOT NULL,
  `apellido_usu` varchar(50) NOT NULL,
  `telefono_usu` double NOT NULL,
  `direccion_usu` varchar(50) NOT NULL,
  `correo_usu` varchar(50) NOT NULL,
  `usuario_sistema` varchar(50) NOT NULL,
  `password_usu` text NOT NULL,
  `tipo_usu` varchar(50) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `identidad_usu`, `tipo_docu_usu`, `nombre_usu`, `apellido_usu`, `telefono_usu`, `direccion_usu`, `correo_usu`, `usuario_sistema`, `password_usu`, `tipo_usu`, `img`) VALUES
(45, 1074810385, 'TI', 'Miguel Angel', 'Zamora Guerra', 3143834838, 'Cll 23 N0-07', 'mzamora@gmail.com', 'Miguelooo', '$2y$10$Qs9I0yUDsd7o5ajgSvO4weJ1qEMYwoAR9JwlZnTMhq4iJfd.ei4L.', 'Socio', 'Shoto Todoroki ajustada.jpg'),
(47, 1023366994, 'CC', 'Diego', 'Camino Rodriguez', 3028141442, 'Cra 1-2B', 'dieguito@gmail', 'Daisho', '$2y$10$k4H1EyHSwNHNkpW7goENUObOrsIUfRv2n3YvFbLvH56nGSjYRjZrO', 'Asociado', 'viego.jpg'),
(48, 1087112694, 'TI', 'Héctor Manuel', 'Estupiñán Escobar', 3146414238, 'cra 30N 17 93	', 'h.hmeae@gmail.com', 'hectorskob', '$2y$10$a2jda/9Lx4QlXBKXqGPam.6DM32MUttBZgtTylcl9fSgf8jfcrPg6', 'Asociado', 'hectorskob.jpg'),
(50, 1074672699, 'CC', 'Johan Daniel', 'Calvijo Moreno', 3132600755, 'Cll 85 Av9-B', 'Pantheongay@gmail	', 'Pantheon4ever', '$2y$10$7B.9PG7yA8MtWEv4ECtQt.odMoc1bPYaG24nrdsPEaV6eMuMry6vW', 'Asociado', 'Daniel.jpg'),
(51, 1023370588, 'TI', 'Laura', 'Aldana', 3153386020, 'Cra 19 A n. 1 sur 84', 'Laurisaldana8@gmail.com', 'Dakdear', '$2y$10$dxjd4/abbPNyyO/fNQpuB.7Z.lUJZzPL6btPVvpsK1YgSqlBxO3R6', 'Asociado', 'samira.jpg'),
(53, 1073672845, 'TI', 'Kevin', 'Gomez', 3042196606, 'calle 12b-2b', 'kdanielgomezc@gmail.com', 'kevin123', '$2y$10$F.aC1ak/F2ookW84X3.Zh.6Ul7EpMRqrX14m16oo3eJx90BBu49eK', 'Asociado', 'Miss-Fortune.jpg'),
(54, 1012329993, 'CC', 'Cristian', 'Mora', 3234856412, 'Cll97-B Av201', 'cristian@gmail.com', 'cristian3808', '$2y$10$eC.lZ8704ZCjY1xsFtdOzusmhHf0PWMrETZfYJUGqa/dUTPAh.mx6', 'Asociado', 'Crocker.jpg'),
(55, 1072192478, 'CC', 'Marco Yesid', 'Yepes Cárdenas', 3163252684, 'Clle 98B Cra 77-R', 'marcoyesid@gmail.com', 'Yepes0264', '$2y$10$N/7fRthoRmsUssUji3ZnrefJlItEboVnDqHekEHimAJVxSm1644T6', 'Asociado', 'descarga.jpg'),
(56, 1016002894, 'CC', 'Jaider', 'Barrera', 3207560689, 'Calle 14B #14-56', 'barrerajaider@gmail.com', 'Jaider Fri fayer', '$2y$10$O5mmeGpOG/Nmk2iKca1rXORnRpKE.x6tqXOP7LV5YGwNS3zYhlA3m', 'Asociado', 'jh.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`identificacion`),
  ADD KEY `NIT` (`NIT`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`NIT`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`NIT`) REFERENCES `empresa` (`NIT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
