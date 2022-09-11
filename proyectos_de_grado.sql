-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2022 a las 23:49:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectos_de_grado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `Codigo_Adm` int(15) NOT NULL,
  `Nombre_Adm` varchar(50) NOT NULL,
  `Apellidos_Adm` varchar(50) NOT NULL,
  `Cedula_Adm` int(15) NOT NULL,
  `Cel_Adm` int(15) NOT NULL,
  `Correo_Adm` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`Codigo_Adm`, `Nombre_Adm`, `Apellidos_Adm`, `Cedula_Adm`, `Cel_Adm`, `Correo_Adm`) VALUES
(0, 'admin', 'admin', 0, 123456789, 'admin@admin.co'),
(123456789, 'Secretaria', 'Estudiantil', 123456789, 2147483647, 'secretaria@udenar.edu.co'),
(217036022, 'Santiago', 'Coral', 1088219264, 2147483647, 'santiagocoral80@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `Codigo_Doc` int(15) NOT NULL,
  `Cedula_Doc` int(11) NOT NULL,
  `Nombre_Doc` varchar(50) NOT NULL,
  `Apellidos_Doc` varchar(50) NOT NULL,
  `Cel_Doc` int(15) NOT NULL,
  `Correo_Doc` varchar(50) NOT NULL,
  `Codigo_Est` int(15) DEFAULT NULL,
  `Cod_proyecto` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`Codigo_Doc`, `Cedula_Doc`, `Nombre_Doc`, `Apellidos_Doc`, `Cel_Doc`, `Correo_Doc`, `Codigo_Est`, `Cod_proyecto`) VALUES
(456, 1088219264, 'Jorge', 'Arévalo', 123456789, 'alexandererazo184@gmail.com', 123, 30),
(1000, 1088219264, 'Otro', 'Docente', 13245679, 'alexandererazo184@gmail.com', 123, 30),
(1001, 1088219264, 'Santiago S', 'Coral', 235645623, 'santiagocoral80@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `Codigo_Est` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Cedula_Est` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos_Est` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `Programa_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Correo_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Cel_Est` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `Sede_Est` enum('Ipiales','Tuquerres','Tumaco','Pasto') COLLATE utf8_spanish_ci NOT NULL,
  `Codigo_Doc` int(15) DEFAULT NULL,
  `Cod_proyecto` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`Codigo_Est`, `Cedula_Est`, `Nombre_Est`, `Apellidos_Est`, `Programa_Est`, `Correo_Est`, `Cel_Est`, `Sede_Est`, `Codigo_Doc`, `Cod_proyecto`) VALUES
('123', '1088219264', 'Santiago Alejandro', 'Coral', 'ingenieria de sistemas', 'santiagocoral80@gmail.com', '321548526', 'Tuquerres', 456, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `Cod_proyecto` int(15) NOT NULL,
  `Nombre_proyecto` varchar(50) NOT NULL,
  `url_proy` varchar(500) NOT NULL,
  `Cod_Est` int(15) NOT NULL,
  `comentarios` varchar(1000) DEFAULT NULL,
  `calificaciones` varchar(50) NOT NULL DEFAULT 'NO APROBADO',
  `Codigo_Doc` int(15) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`Cod_proyecto`, `Nombre_proyecto`, `url_proy`, `Cod_Est`, `comentarios`, `calificaciones`, `Codigo_Doc`, `fecha`) VALUES
(30, 'Anteproyecto sistema web', 'documentos/123/compiladores.trab.docx', 123, '. Primer comentario.\n Segundo comentario', 'APROBADO', 456, '2022-09-09 14:51:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Usuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_Usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Tipo_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Usuario`, `Password`, `Nombre_Usuario`, `Tipo_Usuario`) VALUES
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 1),
(123, '123', '4a22af727c7201f7d3a7632d0b13e9d805753c3d', 'ESTUDIANTE', 2),
(456, '456', '4a22af727c7201f7d3a7632d0b13e9d805753c3d', 'DOCENTE', 3),
(1001, '1001', '4a22af727c7201f7d3a7632d0b13e9d805753c3d', 'DOCENTE', 3),
(123456789, '123456789', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ADMINISTRADOR', 1),
(217036022, '217036022', '4a22af727c7201f7d3a7632d0b13e9d805753c3d', 'ADMINISTRADOR', 1),
(218036062, '1000', '4a22af727c7201f7d3a7632d0b13e9d805753c3d', 'DOCENTE', 3),
(2147483647, '2148798756', '4c042bd61f45cd872c79519c4e8f9c52066bf662', 'ESTUDIANTE', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Codigo_Adm`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`Codigo_Doc`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`Codigo_Est`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`Cod_proyecto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `Cod_proyecto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
