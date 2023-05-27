-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2023 a las 02:39:50
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
-- Base de datos: `clinica_turnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda_medico`
--

CREATE TABLE `agenda_medico` (
  `id_medico` bigint(13) NOT NULL,
  `dia` varchar(3) DEFAULT NULL,
  `hora_in` time DEFAULT NULL,
  `hora_fn` time DEFAULT NULL,
  `usuario_log` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` varchar(8) NOT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `area`) VALUES
('gener', 'General'),
('neuro', 'Neurologia'),
('radio', 'Radiologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `numero_cita` int(10) NOT NULL,
  `id_clinica` varchar(5) DEFAULT NULL,
  `id_paciente` bigint(13) DEFAULT NULL,
  `id_medico` bigint(13) DEFAULT NULL,
  `id_tipo_cita` varchar(5) DEFAULT NULL,
  `fechaprogram` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechacita` datetime DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usuario_log` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinica`
--

CREATE TABLE `clinica` (
  `id_clinica` varchar(5) NOT NULL,
  `clinica` varchar(45) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clinica`
--

INSERT INTO `clinica` (`id_clinica`, `clinica`, `direccion`) VALUES
('coos', 'COOSALUD', NULL),
('sura', 'SURA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_semana`
--

CREATE TABLE `dia_semana` (
  `id_dia` varchar(3) NOT NULL,
  `dia` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dia_semana`
--

INSERT INTO `dia_semana` (`id_dia`, `dia`) VALUES
('1', 'Lunes'),
('2', 'Martes'),
('3', 'Miercoles'),
('4', 'Jueves'),
('5', 'Viernes'),
('6', 'Sabado'),
('7', 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `id_medico` bigint(13) NOT NULL,
  `tipo_documento` varchar(5) DEFAULT NULL,
  `id_area` varchar(8) DEFAULT NULL,
  `id_clinica` varchar(5) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id_medico`, `tipo_documento`, `id_area`, `id_clinica`, `nombre`, `telefono`) VALUES
(109141333928, 'CC', 'radio', 'coos', 'Chita Arellano Recio', '3151179774040'),
(122109783544, 'CC', 'neuro', 'sura', 'Adriana Gámez Giralt', '3156985704848'),
(123098939363, 'CC', 'neuro', 'coos', 'Evita Bermejo Céspedes', '3159708046424'),
(132068343931, 'CC', 'gener', 'sura', 'Antonio Echevarría Toledo', '3152497631333'),
(134956648296, 'CC', 'gener', 'sura', 'Carlota Abril Ibañez', '3155438208687'),
(148847251396, 'CC', 'radio', 'sura', 'Moisés Mínguez Fortuny', '3157193380686'),
(151149195878, 'CC', 'gener', 'coos', 'Maxi Llanos-Barrio', '3154322363409'),
(151521423001, 'CC', 'radio', 'coos', 'Gema Ojeda Bayón', '3157223051973'),
(151826347493, 'CC', 'neuro', 'sura', 'Moisés Goñi Guardia', '3154109268388'),
(161595467351, 'CC', 'gener', 'coos', 'Griselda Tolosa Galan', '3153813682384'),
(161698052866, 'CC', 'neuro', 'sura', 'Ceferino Vallejo Collado', '3159823576053'),
(163084855701, 'CC', 'gener', 'sura', 'Geraldo Bernat Estevez', '3151800089301'),
(163223905061, 'CC', 'radio', 'sura', 'Rocío de Uribe', '3157544330548'),
(163539352332, 'CC', 'radio', 'coos', 'Celestino Carretero Marquez', '3153683068962'),
(166674171352, 'CC', 'gener', 'coos', 'Guadalupe del Azcona', '3153240680583'),
(167548078933, 'CC', 'radio', 'sura', 'Milagros Acevedo Romeu', '3155273688791'),
(171610360348, 'CC', 'neuro', 'coos', 'Ramiro Sanchez Amador', '3153102150590'),
(178926010287, 'CC', 'gener', 'sura', 'Margarita Aramburu Mas', '3159337951337'),
(190160089324, 'CC', 'neuro', 'coos', 'Celestina Pagès Amat', '3157616187191'),
(190720510081, 'CC', 'gener', 'coos', 'Wilfredo Almeida Cabrero', '3158241385709');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` bigint(13) NOT NULL,
  `tipo_documento` varchar(5) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `tipo_documento`, `nombre`, `telefono`) VALUES
(1010585650, 'CC', 'Adrián Borrás Valderrama', '315074998309'),
(1058505924, 'TI', 'Lara Lara-Sastre', '315288061476'),
(1097128531, 'CC', 'Ámbar Porcel Expósito', '315471749233'),
(1149262235, 'CC', 'Laura Macias-Palau', '315291842775'),
(1253731092, 'CC', 'Fidela Cerro Quirós', '315772116117'),
(1302961172, 'TI', 'Isaías Canals-Marín', '315733526988'),
(1355191449, 'CC', 'Aureliano Cisneros Arias', '315205707998'),
(1430902601, 'CC', 'Trini Llabrés Segura', '315512134912'),
(1453309544, 'CC', 'Marta Plana Checa', '315987742662'),
(1499036224, 'TI', 'Morena del Maza', '315997134819'),
(1549691197, 'CC', 'Faustino del Jordán', '315965232529'),
(1551574192, 'TI', 'Luís Arenas Pi', '315828697933'),
(1578555542, 'TI', 'Leticia Prada Carlos', '315428991082'),
(1579771473, 'TI', 'Quique Cantero Zabaleta', '315685034703'),
(1714763923, 'TI', 'Ciro Román Tovar', '315965335620'),
(1768621962, 'TI', 'Concha del Campillo', '315663494486'),
(1788160987, 'TI', 'Nacho Ferrero Cano', '315319661561'),
(1802954934, 'CC', 'Eugenio Piquer Redondo', '315751098658'),
(1822997554, 'TI', 'Wálter de Gálvez', '315149938723'),
(1849033690, 'TI', 'Rubén Armas Batalla', '315371538792');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id_rol` varchar(5) NOT NULL,
  `rol` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cita`
--

CREATE TABLE `tipo_cita` (
  `id_tipo_cita` varchar(5) NOT NULL,
  `tipo_cita` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_cita`
--

INSERT INTO `tipo_cita` (`id_tipo_cita`, `tipo_cita`) VALUES
('PRIM', 'Primera Vez'),
('REV', 'Revision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipodoc` varchar(5) NOT NULL,
  `tipo_documento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipodoc`, `tipo_documento`) VALUES
('CC', 'Cedula Ciudadana'),
('TI', 'Tarjeta Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(5) NOT NULL,
  `id_rol` varchar(5) DEFAULT NULL,
  `identificacion` varchar(45) DEFAULT NULL,
  `psswrd` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda_medico`
--
ALTER TABLE `agenda_medico`
  ADD KEY `FK_REFERENCE_13` (`usuario_log`),
  ADD KEY `FK_REFERENCE_15` (`id_medico`),
  ADD KEY `FK_REFERENCE_5` (`dia`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`numero_cita`),
  ADD KEY `FK_REFERENCE_10` (`id_tipo_cita`),
  ADD KEY `FK_REFERENCE_12` (`usuario_log`),
  ADD KEY `FK_REFERENCE_7` (`id_paciente`),
  ADD KEY `FK_REFERENCE_8` (`id_medico`),
  ADD KEY `FK_REFERENCE_9` (`id_clinica`);

--
-- Indices de la tabla `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`id_clinica`);

--
-- Indices de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_medico`),
  ADD KEY `FK_REFERENCE_1` (`id_area`),
  ADD KEY `FK_REFERENCE_14` (`id_clinica`),
  ADD KEY `FK_REFERENCE_3` (`tipo_documento`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `FK_REFERENCE_2` (`tipo_documento`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_cita`
--
ALTER TABLE `tipo_cita`
  ADD PRIMARY KEY (`id_tipo_cita`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipodoc`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_REFERENCE_11` (`id_rol`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda_medico`
--
ALTER TABLE `agenda_medico`
  ADD CONSTRAINT `FK_REFERENCE_13` FOREIGN KEY (`USUARIO_LOG`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `FK_REFERENCE_15` FOREIGN KEY (`ID_MEDICO`) REFERENCES `medico` (`ID_MEDICO`),
  ADD CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`DIA`) REFERENCES `dia_semana` (`ID_DIA`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `FK_REFERENCE_10` FOREIGN KEY (`ID_TIPO_CITA`) REFERENCES `tipo_cita` (`ID_TIPO_CITA`),
  ADD CONSTRAINT `FK_REFERENCE_12` FOREIGN KEY (`USUARIO_LOG`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_PACIENTE`) REFERENCES `paciente` (`ID_PACIENTE`),
  ADD CONSTRAINT `FK_REFERENCE_8` FOREIGN KEY (`ID_MEDICO`) REFERENCES `medico` (`ID_MEDICO`),
  ADD CONSTRAINT `FK_REFERENCE_9` FOREIGN KEY (`ID_CLINICA`) REFERENCES `clinica` (`ID_CLINICA`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`ID_AREA`) REFERENCES `area` (`ID_AREA`),
  ADD CONSTRAINT `FK_REFERENCE_14` FOREIGN KEY (`ID_CLINICA`) REFERENCES `clinica` (`ID_CLINICA`),
  ADD CONSTRAINT `FK_REFERENCE_3` FOREIGN KEY (`TIPO_DOCUMENTO`) REFERENCES `tipo_documento` (`ID_TIPODOC`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `FK_REFERENCE_2` FOREIGN KEY (`TIPO_DOCUMENTO`) REFERENCES `tipo_documento` (`ID_TIPODOC`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`ID_ROL`) REFERENCES `rol_usuario` (`ID_ROL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
