-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-09-2015 a las 23:07:15
-- Versión del servidor: 10.0.20-MariaDB-1~jessie-log
-- Versión de PHP: 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `grupo_10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno-Responsable`
--

CREATE TABLE IF NOT EXISTS `Alumno-Responsable` (
  `idAlumno` int(11) NOT NULL,
  `idResponsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE IF NOT EXISTS `Alumnos` (
`id` int(11) NOT NULL,
  `numeroDoc` int(11) NOT NULL,
  `tipoDoc` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` text NOT NULL,
  `mail` text NOT NULL,
  `direccion` text NOT NULL,
  `fechaIngreso` date NOT NULL,
  `fechaEgreso` date NOT NULL,
  `fechaAlta` date NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`id`, `numeroDoc`, `tipoDoc`, `nombre`, `apellido`, `fechaNacimiento`, `sexo`, `mail`, `direccion`, `fechaIngreso`, `fechaEgreso`, `fechaAlta`, `eliminado`) VALUES
(1, 32454321, 'dni', 'oscar', 'osacar', '2015-09-01', 'masculino', 'osacar@yahoo.com.ar', '32 13 14', '2015-09-01', '2015-09-03', '2015-09-10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Configuracion`
--

CREATE TABLE IF NOT EXISTS `Configuracion` (
`clave` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `mailContacto` text NOT NULL,
  `cantElem` int(11) NOT NULL,
  `habilitada` tinyint(1) NOT NULL DEFAULT '1',
  `textoDeshab` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuotas`
--

CREATE TABLE IF NOT EXISTS `Cuotas` (
`id` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  `tipo` text NOT NULL,
  `comisionCob` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `eliminada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cuotas`
--

INSERT INTO `Cuotas` (`id`, `anio`, `mes`, `numero`, `monto`, `tipo`, `comisionCob`, `fechaAlta`, `eliminada`) VALUES
(1, 2013, 5, 12, 12000, 'tipo1', 2, '2015-09-29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagos`
--

CREATE TABLE IF NOT EXISTS `Pagos` (
`id` int(11) NOT NULL,
  `idAlumno` int(11) NOT NULL,
  `idCuota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `becado` tinyint(1) NOT NULL,
  `fechaAlta` date NOT NULL,
  `fechaActualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Responsables`
--

CREATE TABLE IF NOT EXISTS `Responsables` (
`id` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` text NOT NULL,
  `mail` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
`id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `rol` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `username`, `password`, `habilitado`, `rol`) VALUES
(1, 'agus', '123', 1, 'adminstracion');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumno-Responsable`
--
ALTER TABLE `Alumno-Responsable`
 ADD PRIMARY KEY (`idResponsable`), ADD KEY `idAlumno` (`idAlumno`);

--
-- Indices de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Configuracion`
--
ALTER TABLE `Configuracion`
 ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `Cuotas`
--
ALTER TABLE `Cuotas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Pagos`
--
ALTER TABLE `Pagos`
 ADD PRIMARY KEY (`id`), ADD KEY `idAlumno` (`idAlumno`,`idCuota`), ADD KEY `idCuota` (`idCuota`);

--
-- Indices de la tabla `Responsables`
--
ALTER TABLE `Responsables`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Configuracion`
--
ALTER TABLE `Configuracion`
MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Cuotas`
--
ALTER TABLE `Cuotas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Pagos`
--
ALTER TABLE `Pagos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Responsables`
--
ALTER TABLE `Responsables`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumno-Responsable`
--
ALTER TABLE `Alumno-Responsable`
ADD CONSTRAINT `Alumno-Responsable_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `Alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Alumno-Responsable_ibfk_2` FOREIGN KEY (`idResponsable`) REFERENCES `Responsables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Pagos`
--
ALTER TABLE `Pagos`
ADD CONSTRAINT `Pagos_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `Alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Pagos_ibfk_2` FOREIGN KEY (`idCuota`) REFERENCES `Cuotas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
