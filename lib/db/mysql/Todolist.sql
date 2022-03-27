-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2022 a las 22:30:23
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `todolist`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTareas` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(120) DEFAULT NULL,
  `estado` enum('Pendiente','En curso','Completado') NOT NULL,
  `fec_creacion` date NOT NULL,
  `fec_modif` date NOT NULL,
  `fec_fintarea` date DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTareas`, `titulo`, `descripcion`, `estado`, `fec_creacion`, `fec_modif`, `fec_fintarea`, `idUsuario`) VALUES
(1, 'Añadir login a la aplicación Tareas', 'Añadir toda la funcionalidad de login para que cada usuario tenga sus propias tareas.', 'Pendiente', '2022-03-09', '2022-03-09', NULL, 6),
(2, 'Añadir funcionalidad PDO', 'Añadir la funcionalidad de PDO a la aplicación Tasks. Ahora mismo solo está con jSon.', 'Pendiente', '2022-03-09', '2022-03-09', NULL, 5),
(3, 'Formulario Contacto Error 232 v3', 'Formulario Contacto Error 232 en Internet Explorer v3', 'En curso', '2022-03-11', '2022-03-14', '2022-03-22', 5),
(4, 'Estructurar repositorio', 'Reorganizar ficheros', 'Completado', '2022-03-09', '2022-03-09', NULL, 1),
(5, 'Añadir create PDO', 'Añadir Create con PDO a la aplicación Tasks.', 'En curso', '2022-03-09', '2022-03-09', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`) VALUES
(1, 'María'),
(2, 'Eva'),
(5, 'Pedro'),
(6, 'Juan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTareas`),
  ADD KEY `idUsuario_idx` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
