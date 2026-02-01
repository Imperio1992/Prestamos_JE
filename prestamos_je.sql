-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2026 a las 05:46:05
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
-- Base de datos: `prestamos_je`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `tipo` enum('ENTRADA','SALIDA') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `medio` enum('EFECTIVO','BANCO') DEFAULT 'EFECTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `tipo`, `monto`, `concepto`, `id_empleado`, `fecha`, `medio`) VALUES
(148, 'ENTRADA', 3050.00, 'INGRESO BANCA MOVIL', 1, '2026-01-25 22:58:49', 'BANCO'),
(149, 'ENTRADA', 5000.00, 'INGRESO EFECTIVO', 1, '2026-01-30 22:59:26', 'EFECTIVO'),
(150, 'ENTRADA', 3060.00, 'INGRESO BANCA MOVIL', 1, '2026-01-30 22:59:32', 'BANCO'),
(151, 'ENTRADA', 0.00, 'INGRESO BANCA MOVIL', 1, '2026-01-30 22:59:40', 'BANCO'),
(152, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(153, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(154, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(155, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(156, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(157, 'ENTRADA', 420.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(158, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(159, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(160, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(161, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(162, 'ENTRADA', 30.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(163, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(164, 'ENTRADA', 90.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(165, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(166, 'ENTRADA', 900.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(167, 'ENTRADA', 1200.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(168, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(169, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(170, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(171, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(172, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(173, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(174, 'ENTRADA', 1200.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(175, 'ENTRADA', 600.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(176, 'ENTRADA', 720.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(177, 'ENTRADA', 600.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(178, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(179, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(180, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(181, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(182, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(183, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(184, 'ENTRADA', 600.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(185, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(186, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(187, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(188, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(189, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(190, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(191, 'ENTRADA', 210.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(192, 'ENTRADA', 90.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(193, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(194, 'ENTRADA', 210.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(195, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(196, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(197, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(198, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(199, 'ENTRADA', 150.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(200, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(201, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(202, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(203, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(204, 'ENTRADA', 360.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(205, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(206, 'ENTRADA', 2100.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(207, 'ENTRADA', 1200.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(208, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(209, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(210, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(211, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(212, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(213, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(214, 'ENTRADA', 600.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(215, 'ENTRADA', 300.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(216, 'ENTRADA', 150.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(217, 'ENTRADA', 90.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(218, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(219, 'ENTRADA', 60.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(220, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(221, 'ENTRADA', 120.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(222, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(223, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(224, 'ENTRADA', 180.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(225, 'ENTRADA', 1200.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(226, 'ENTRADA', 240.00, 'Cobranza diaria', 2, '2026-01-31 00:00:00', 'EFECTIVO'),
(227, 'SALIDA', 300.00, 'GASOLINA', 1, '2026-01-31 20:03:56', 'EFECTIVO'),
(228, 'SALIDA', 200.00, 'GASOLINA', 1, '2026-01-31 20:04:06', 'EFECTIVO'),
(229, 'SALIDA', 200.00, 'GASOLINA', 1, '2026-01-31 20:04:13', 'EFECTIVO'),
(230, 'SALIDA', 200.00, 'GASOLINA', 1, '2026-01-31 20:04:20', 'EFECTIVO'),
(231, 'SALIDA', 200.00, 'GASOLINA', 1, '2026-01-31 20:04:27', 'BANCO'),
(232, 'ENTRADA', 10.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:04:40', 'EFECTIVO'),
(233, 'ENTRADA', 10.00, 'INGRESO BANCA MOVIL', 1, '2026-01-31 20:04:43', 'BANCO'),
(234, 'SALIDA', 10000.00, 'PRESTAMO ENTREGADO', 1, '2026-01-31 20:09:18', 'EFECTIVO'),
(235, 'SALIDA', 1000.00, 'PRESTAMO ENTREGADO', 1, '2026-01-31 20:13:19', 'EFECTIVO'),
(236, 'ENTRADA', 0.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:13:43', 'EFECTIVO'),
(237, 'ENTRADA', 6890.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:13:46', 'EFECTIVO'),
(238, 'ENTRADA', 10000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:29:23', 'EFECTIVO'),
(239, 'ENTRADA', 4180.00, 'INGRESO BANCA MOVIL', 1, '2026-01-31 20:29:33', 'BANCO'),
(240, 'ENTRADA', 9000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:29:43', 'EFECTIVO'),
(241, 'ENTRADA', 900.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:29:46', 'EFECTIVO'),
(242, 'ENTRADA', 20000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:29:50', 'EFECTIVO'),
(243, 'SALIDA', 25000.00, 'RETIRO GANANCIA PROPIETARIO', 1, '2026-01-31 20:30:08', 'EFECTIVO'),
(244, 'SALIDA', 5000.00, 'BONO GANANCIA ASESOR', 1, '2026-01-31 20:30:08', 'EFECTIVO'),
(245, 'ENTRADA', 30000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:30:16', 'EFECTIVO'),
(246, 'SALIDA', 25000.00, 'RETIRO GANANCIA PROPIETARIO', 1, '2026-01-31 20:30:24', 'EFECTIVO'),
(247, 'SALIDA', 5000.00, 'BONO GANANCIA ASESOR', 1, '2026-01-31 20:30:24', 'EFECTIVO'),
(248, 'ENTRADA', 600000.00, 'INGRESO EFECTIVO', 5, '2026-01-31 20:30:43', 'EFECTIVO'),
(249, 'SALIDA', 25000.00, 'RETIRO GANANCIA PROPIETARIO', 5, '2026-01-31 20:30:45', 'EFECTIVO'),
(250, 'SALIDA', 5000.00, 'BONO GANANCIA ASESOR', 5, '2026-01-31 20:30:45', 'EFECTIVO'),
(251, 'SALIDA', 9900.00, 'PRESTAMO #82 ENTREGADO', 1, '2026-01-31 20:41:55', 'EFECTIVO'),
(252, 'SALIDA', 2100.00, 'PRESTAMO #82 ENTREGADO', 1, '2026-01-31 20:41:55', 'BANCO'),
(253, 'ENTRADA', 12000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 20:59:58', 'EFECTIVO'),
(254, 'ENTRADA', 30000.00, 'INGRESO EFECTIVO', 1, '2026-01-31 21:00:03', 'EFECTIVO'),
(255, 'SALIDA', 4000.00, 'PRESTAMO #83', 1, '2026-01-31 21:02:32', 'EFECTIVO'),
(256, 'SALIDA', 8000.00, 'PRESTAMO #83', 1, '2026-01-31 21:02:32', 'BANCO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `curp_ine` varchar(25) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `numero_exterior` varchar(20) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `autoriza_credito` enum('SI','NO') DEFAULT 'NO',
  `estatus` enum('ACTIVO','MAL_HISTORIAL','BLOQUEADO') DEFAULT 'ACTIVO',
  `id_asesor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `negocio` varchar(150) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `numero_ext` varchar(10) DEFAULT NULL,
  `fecha_bloqueo` date DEFAULT NULL,
  `fecha_desbloqueo` date DEFAULT NULL,
  `dias_bloqueo` int(11) DEFAULT NULL,
  `motivo_bloqueo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `curp_ine`, `nombre`, `apellido`, `fecha_nacimiento`, `direccion`, `numero_exterior`, `colonia`, `telefono`, `autoriza_credito`, `estatus`, `id_asesor`, `id_usuario`, `fecha_registro`, `negocio`, `observaciones`, `numero_ext`, `fecha_bloqueo`, `fecha_desbloqueo`, `dias_bloqueo`, `motivo_bloqueo`) VALUES
(1, '1111111', 'Maricela Guadalupe', 'Castro Rosas', NULL, 'Rancho Agua Blanca', '5517', 'Pradera Bonita', '6444009533', 'SI', 'BLOQUEADO', 1, 1, '2026-01-25 04:10:36', 'Abarrotes Rancho Alegre', '', NULL, '2026-01-31', '2026-01-31', 90, NULL),
(2, '11111', 'Nereyda Guadalupe', 'Perez Perez', NULL, 'Miguel guerrero', '715', 'Nuevo Cajeme', '6442339095', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:22:09', 'Mini Super G', '', NULL, NULL, NULL, NULL, NULL),
(4, '', 'Guadalupe Isabel', 'Amaya gutierres', NULL, 'Opalo', '1775', 'Valle Verde', '6441213395', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:31:38', 'Mini Super G', '', NULL, NULL, NULL, NULL, NULL),
(5, '', 'Juan', 'Mendivil', NULL, 'Miguel Guerrero', '829', 'Nuevo Cajeme', '6441020466', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:32:29', 'Carnitas y Chicharrones Nuevo Cajeme', '', NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Maria', 'Gonzales', NULL, 'Alfonzo Ezparza', '1514', 'Cajeme', '6441685652', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:41:20', 'Tacos Noe - Norte', '', NULL, NULL, NULL, NULL, NULL),
(9, '', 'Reyna Guadalupe', 'Higuera Aldama', NULL, 'Alfonzo Esparza', '1430', 'Matias Mendez', '6442256222', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:49:35', 'Tortilleria Trini', '', NULL, NULL, NULL, NULL, NULL),
(10, 'MEZG851203HSRDML09', 'Gilberto', 'Medina Zamora', '1985-12-03', 'Calle Guerrero', '2801', 'Fraccionamientos las Haciendas - Seccion Monjes', '6441284830', 'SI', 'ACTIVO', 1, 1, '2026-01-25 04:53:56', 'Abarrotes GyL -Tienda Alex NISSI', '', NULL, NULL, NULL, NULL, NULL),
(11, '', 'Martin Rafael', 'Torres', NULL, 'Sabila', '2402', 'Amanecer 1', '6441427231', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:04:35', 'Burritos', '', NULL, NULL, NULL, NULL, NULL),
(12, '', 'Olga Marible', 'Zavala Zavala', NULL, 'Palmareca', '2816', 'Manlio Flavio Beltrones', '6442197322', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:05:34', 'Tortilleria Maribel - Abarrotes Miranda', '', NULL, NULL, NULL, NULL, NULL),
(13, '', 'Rosa Amelia', 'Zalava Chavira', NULL, 'Palmareca', '2816', 'Manlio Flavio Beltrones', '6442390396', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:06:37', 'Tortilleria Maribel - Abarrotes Miranda', '', NULL, NULL, NULL, NULL, NULL),
(14, '', 'Norma Alicia', 'Ureña', NULL, 'Aciron', '2837', 'Manlio Flavio Beltrones', '6441399490', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:08:48', 'Tamales Norma', '', NULL, NULL, NULL, NULL, NULL),
(15, '', 'Ana Karen', 'Escalante Ureña', NULL, 'Aciron', '2851', 'Manlio Flavio Beltrones', '6442038342', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:10:03', 'Restaurante Moka-Cafe', '', NULL, NULL, NULL, NULL, NULL),
(16, '', 'Francisco', 'Armenta Angulo', NULL, 'Etiopia', '1453', 'Alameda - Villa Bonita', '6444876918', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:12:15', 'Copias Xeroxs - 5 de Febrero e Hidalgo', '', NULL, NULL, NULL, NULL, NULL),
(17, '', 'Claudia', 'Zavala', NULL, 'Veracruz', '542', 'Centro', '6441187975', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:13:23', 'Floreria el Resy de las Rosas', '', NULL, NULL, NULL, NULL, NULL),
(18, '', 'Ricardo', 'Sainz Callejas', NULL, 'Ignacio Pesqueira', '168', 'Campestre', '6444301606', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:14:29', 'Floreria Axiflor', '', NULL, NULL, NULL, NULL, NULL),
(19, '', 'Jesus Alejandrina', 'Portillo Arredondo', NULL, 'Valle de Bataconsica', '1728', 'Fraccionamiento San Anselmo', '6444080470', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:15:37', 'Tortilleria Alex', '', NULL, NULL, NULL, NULL, NULL),
(20, '', 'Claudia Veronica', 'Quintana Vega', NULL, 'Ares', '1837', 'San Rafael', '6442582855', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:49:12', 'Tortilleria Alex', '', NULL, NULL, NULL, NULL, NULL),
(21, '', 'Brenda Berenice', 'Vega Hernandez', NULL, 'Ares', '1857', 'San Rafel', '6441214279', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:50:04', 'Sushi - Lume', '', NULL, NULL, NULL, NULL, NULL),
(22, '', 'Rosa Melia', 'Portillo Arredondo', NULL, 'Antonio Yocupicio', '131', 'Nueva Palmira', '6441530934', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:51:36', 'Tortilleria Alex', '', NULL, NULL, NULL, NULL, NULL),
(23, '', 'Teresa de Jesus', 'Valdez Martinez', NULL, 'Valle Rico', '2028', 'Miravalle', '6442331924', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:54:44', 'Abarrotes Teresita', '', NULL, NULL, NULL, NULL, NULL),
(24, '', 'Yeni Lorenia', 'Mellado Castro', NULL, 'Jacinto Lopez', '1325', 'Ampliacion Miravalle', '6442396388', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:55:35', 'Sushi House 300', '', NULL, NULL, NULL, NULL, NULL),
(25, '', 'Celina', 'Leon Gil', NULL, 'Pistillo', '1424', 'Fraccionamiento Primavera', '6442032937', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:56:48', 'Boutique Celina', '', NULL, NULL, NULL, NULL, NULL),
(26, '', 'Elsa Guadalupe', 'Felix Morales', NULL, 'Pistilo', '1523', 'Fraccionamiento Primavera', '6441246822', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:57:41', 'Tacos y Birria - Elsa', '', NULL, NULL, NULL, NULL, NULL),
(27, '', 'Fatima', 'Rodriguez Jacubo', NULL, 'Valle del Algodon', '1511', 'Valle Dorado', '6441992996', 'SI', 'ACTIVO', 1, 1, '2026-01-25 05:58:37', 'Tacos y Birria - Elsa', '', NULL, NULL, NULL, NULL, NULL),
(28, 'MRAYRG530916HSRRNYG607', 'Jose Rogelio', 'Martinez Ayala', '1953-09-16', 'Chihuahua', '3407', 'Fraccionamiento Reforma', '6441895484', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:00:59', 'Abarrotes Lupita', '', NULL, NULL, NULL, NULL, NULL),
(29, '', 'Maria Guadalupe', 'Peña', NULL, 'Ponciano Arriaga', '133', 'Cortinas', '6441717021', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:03:21', 'Bazar Lupita', '', NULL, NULL, NULL, NULL, NULL),
(30, 'AAVE620614MSRNRR08', 'Ernestina', 'Anaya Verduzco', '1962-06-14', 'Topacio', '5827', 'Fraccionamiento Mision San Rafael', '6442230757', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:05:12', 'Abarrotes Eve - California y 300', '', NULL, NULL, NULL, NULL, NULL),
(31, '', 'Lucia Guadalupe', 'Millan Lopez', NULL, 'Jose Maria la Fragua', '120', 'Cortinas', '6441518445', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:07:13', 'Enfermera de Urgencias IMSS', '', NULL, NULL, NULL, NULL, NULL),
(32, '', 'Andrea', 'Millan Lopez', NULL, 'Jose Maria Lafragua', '120', 'Cortinas', '6441154915', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:08:20', 'Costuras de Uniformes', '', NULL, NULL, NULL, NULL, NULL),
(33, 'SASL061231MSRNNSA7', 'Leslie Lizeth', 'Sanchez Sanchez', '2006-12-31', 'Raymundo Sarabia', '350', 'Luis Echeverria', '6444784789', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:10:38', 'Tortilleria Luis Echeverria', '', NULL, NULL, NULL, NULL, NULL),
(34, 'JICG710404MCHMRD06', 'Maria Guadalupe', 'Jimenez Corral', '1971-04-04', 'raymundo sarabia', '350', 'Luis Echeverria', '6442170433', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:13:53', 'Tortilleria y Panaderia Luis Echeverria', '', NULL, NULL, NULL, NULL, NULL),
(35, 'GAJR040707HSRRMDA2', 'Raudy Moises', 'Garcia Jimenez', '2004-07-07', 'Raymundo Sarabia', '350', 'Luis Echeverria', '6442531470', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:17:06', 'Tortilleria Luis Echeverria - Uber', '', NULL, NULL, NULL, NULL, NULL),
(36, '', 'Daniela', 'Lizo Baynori', NULL, 'Patria', '806', 'Ezperanza Tznado', '6441425787', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:19:00', 'Burritos y Tortillas de Harina', '', NULL, NULL, NULL, NULL, NULL),
(37, '', 'Oneyda', 'Baynori Hernandez', NULL, 'Patria', '806', 'Esperanza Tiznado', '6441151059', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:20:03', 'Cahuamanta Sube y Baja 2', '', NULL, NULL, NULL, NULL, NULL),
(38, 'LIBA010406MSRZYMA6', 'America Azucena', 'Lizo Baynori', '2001-04-06', 'Patria', '806', 'Ezperanza Tiznado', '6442001238', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:22:01', 'Cahuamanta Sube y Baja 2', '', NULL, NULL, NULL, NULL, NULL),
(39, 'AIRA741107HBCVYL02', 'Alfredo Acuña', 'Avina Reyes', '1974-11-07', 'La Venta', '2104', 'Las Villas Seccion las Espigas', '6444549929', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:25:00', 'Cahuamantha Sube y Baja 2', '', NULL, NULL, NULL, NULL, NULL),
(40, 'SARM831218HSRLBR03', 'Marcos Joaquin', 'Salmeron Rabago', '1983-12-18', 'Pistilo', '1424', 'Fraccionamiento Primavera', '6442085542', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:29:25', 'Boutique Celina', '', NULL, NULL, NULL, NULL, NULL),
(41, 'AAPM820107MCHLNR09', 'Miriam Guillermina', 'Alcala Ponce', '1982-01-07', '23 Regimiento', '1026', 'Pradera Bonita', '6442591008', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:32:52', 'Abarrotes 23 Regimiento', '', NULL, NULL, NULL, NULL, NULL),
(42, 'MEGF030122HSRXNDA9', 'Fidel', 'Mexia Gonzalez', '2003-01-22', 'Calle Santa Margarita', '2621', 'Fraccionamiento Campanario', '6410000000', 'NO', 'ACTIVO', 5, 1, '2026-01-25 06:32:59', 'Sushi coahuila', '', NULL, NULL, NULL, NULL, NULL),
(43, '', 'Maricela Guadalupe', 'Castro Rosas', NULL, 'Rancho Agua Blanca', '5517', 'Pradera Bonita', '6444009533', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:37:05', 'Abarrotes Rancho Alegre', '', NULL, NULL, NULL, NULL, NULL),
(44, 'FEER020622HSRLNLA1', 'Jose Raul', 'Feliz Enriquez', '2002-06-22', 'Rancho las Peñas', '5731', 'Pradera Bonita', '6442613502', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:00:00', 'Abarrotes y Tortilleria Rancho Peñas 5731', '', NULL, NULL, NULL, NULL, NULL),
(45, '', 'Maria Elsa', 'Enriquez', NULL, 'Rancho las Peñas', '5731', 'Pradera Bonita', '6442613502', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:48:24', 'Abarrots y Tortilleria Rancho Peñas 5731', '', NULL, NULL, NULL, NULL, NULL),
(46, '', 'Melissa', 'Lin Arce', NULL, 'Calle Anza', '925', 'Fraccionamiento Mission San Gabriel', '6442326589', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:52:06', 'Abarotes Melissa', '', NULL, NULL, NULL, NULL, NULL),
(47, '', 'Virginia', 'Inzunza', NULL, 'Calle Hualahuices', '1912', 'Las Fuentes', '6444076228', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:53:33', 'Tortilleria Virginia', '', NULL, NULL, NULL, NULL, NULL),
(48, 'VIPC901015MSRLLN04', 'Cinthya Lourdes', 'Villareal Polino', '1990-10-15', 'Hualahuises', '1921', 'Las Fuentes', '6441938500', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:00:00', 'Bazar Coahuila', '', NULL, NULL, NULL, NULL, NULL),
(49, 'CAZR960524HSLRPM08', 'Jose Ramon', 'Carrillo Zepeda', '1996-05-24', 'Hualahuises', '1921', 'Las Fuentes', '6442089503', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:00:21', 'Plataforma Uber, didi', '', NULL, NULL, NULL, NULL, NULL),
(50, '', 'Sergio Sahuedi', 'Rivera Prado', NULL, 'Tecuala', '2003', 'Las Fuentes', '6442288757', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:07:04', 'Mestro y Tecnico de Taller de Celulares', '', NULL, NULL, NULL, NULL, NULL),
(51, '', 'Ileana', 'Ortega Beltran', NULL, 'Pascola', '1810', 'Posadas del Sol', '6441149290', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:07:47', 'Tortilleria Ileana', '', NULL, NULL, NULL, NULL, NULL),
(52, 'ZAMR860316MSRYRS02', 'Rosa Elia', 'Zayas Murillo', '1986-03-31', 'Santa Matilde', '1822', 'Posadas del Sol', '6441984612', 'SI', 'ACTIVO', 1, 1, '2026-01-25 06:00:00', 'Tortilleria Ileana', '', NULL, NULL, NULL, NULL, NULL),
(53, '', 'Zulema Josefina', 'de la Cruz Betancourt', NULL, 'Vicente Suarez', '441', 'Faustino Felix', '6444206688', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:18:38', 'NOVEDADES ZULEMA Moctezuma 732-C', '', NULL, NULL, NULL, NULL, NULL),
(54, 'OUAM840302MSRSNR00', 'Martha Fabiola', 'Osuna Atuna', '1984-03-02', 'Rio San Ignacio', '837', 'Libertad', '6441274770', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:20:16', 'Abarrotes Martha', '', NULL, NULL, NULL, NULL, NULL),
(55, 'CAFU971004HSRSRZ02', 'Uzziel Francisco', 'Casillas Fornes', '1997-10-04', 'Cerrada del Silencio', '6051', 'Fraccionamiento Nueva Palmira', '6441592838', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:23:22', 'Fruteria Verde Fresco', '', NULL, NULL, NULL, NULL, NULL),
(56, 'CAFD011016HSRSRNA7', 'Daniel Alberto', 'Casillas Fornes', '2001-10-16', 'Cerrada del Silencio', '6051', 'Fraccionamiento Nueva Palmira', '6441945843', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:25:02', 'Fruteria Verde fresco', '', NULL, NULL, NULL, NULL, NULL),
(57, 'PALJ951206MSRZPC05', 'Jocelin Anaid', 'De la Paz Lopez', '1995-12-06', 'Calle Marcelino Davalos', '651', 'Libertad', '6441361634', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:28:04', 'Salon Studio A6 - Belleza, Cosmetica y Cuidado Personal', '', NULL, NULL, NULL, NULL, NULL),
(58, 'OIPJ970107HSRRCN08', 'Juan Jose', 'Ortiz Pacheco', '1997-01-07', 'Marcelino Davalos', '621', 'Libertad', '6644769676', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:30:26', 'Studio A6 - Uber', '', NULL, NULL, NULL, NULL, NULL),
(59, 'BUGJ940407HSRSMN00', 'Juan Carlos', 'Bustillos Gomez', '1994-04-07', 'Medellin Oeste', '3637', 'Urbi Villa del Rey', '6442025080', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:33:37', 'Tortilleria 21 - Lomas Residencial', '', NULL, NULL, NULL, NULL, NULL),
(60, '', 'Maria Luisa', 'Ibarra Ramos', NULL, 'Niños Heroes', '720', 'Comuripa', '6441171070', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:34:24', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(61, '', 'Edna', 'Amarillas Figueroa', NULL, 'Vicente Padilla', '503', 'Hogar y Patrimonio - Ezperanza', '6442551495', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:35:35', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(62, 'BATO911119MSRLRR06', 'Oralia Rosalia', 'Ballesteros Torres', '1991-11-19', 'Callde del Ajusco', '316', 'Fraccionamiento los Encinos', '6444555302', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:36:58', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(63, '', 'Monica', 'Mendoza Aguero', NULL, 'Carlos Amaya', '2918', 'Pioneros', '6441427916', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:37:39', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(64, '', 'Rosa Elena', 'Cruz Perez', NULL, 'Carlos Amaya', '2922', 'Pioneros', '6442505375', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:38:44', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(65, 'CUPI850815MCHRRR03', 'Maria Iracema', 'Cruz Perez', '1985-08-15', 'Carlos Amaya H.', '132', 'Pionerios', '6441737575', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:40:03', 'Tortilleria Jonger', '', NULL, NULL, NULL, NULL, NULL),
(66, '', 'Randdy Alberto', 'Borboa Renteria', NULL, 'Coahuila', '2325', 'Campestre', '6441661959', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:41:57', 'Pinturas Michoacan', '', NULL, NULL, NULL, NULL, NULL),
(67, 'REOM671222MSRYSR09', 'Maricela', 'Reyes Osuna', '1967-12-22', 'Calle de los Arrecifes', '3106', 'Residencial Casa Blanca', '6441621258', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:43:32', 'Estetica Maricela - Hotel Bugambilias', '', NULL, NULL, NULL, NULL, NULL),
(68, '', 'Monica', 'Quiñonez Pineda', NULL, 'Calle Cauque', '1929', 'Infonavit Yokujimari', '6442300832', 'SI', 'ACTIVO', 1, 1, '2026-01-25 07:59:46', 'Abarrotes Kokys', '', NULL, NULL, NULL, NULL, NULL),
(69, '', 'Margarita', 'Durazo', NULL, 'Francisco Urbalejo', '645', 'Campestre', '6441903218', 'SI', 'ACTIVO', 1, 1, '2026-01-25 08:02:39', 'Tacos Dorados Michoacan', '', NULL, NULL, NULL, NULL, NULL),
(70, 'aaaaa', 'prueba', 'prueba', '2001-01-01', 'asdasd', 'S/N', 'asdasd', '44564534534', 'SI', 'ACTIVO', 1, 1, '2026-01-31 05:13:42', 'as', '', NULL, NULL, NULL, NULL, NULL),
(71, '', 'otra prueba', 'comono', '2001-01-01', 'aqui nomas', 'S/N', 'por ahi', '646464646464', 'SI', 'BLOQUEADO', 1, 1, '2026-01-31 05:23:50', '', '', NULL, '2026-01-31', '2026-01-31', 1, NULL),
(72, '', 'una nueva prueba', 'aqui nomas', '2010-01-01', 'alalala', 'lal', 'alalala', '6464646464', 'SI', 'ACTIVO', 1, 1, '2026-01-31 06:04:20', '', '', NULL, NULL, NULL, NULL, NULL),
(73, '', 'ok', 'ok', '2000-01-01', 'aasas', 'S/N', 'asasd', '32132132132', 'SI', 'BLOQUEADO', 1, 1, '2026-01-31 06:06:47', '', '', NULL, '2026-01-31', '2026-02-15', 15, 'No Cumple con pagos a tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `ine_empleado` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `curp_seguro` varchar(20) DEFAULT NULL,
  `puesto` enum('GERENTE','SUPERVISOR','ASESOR') DEFAULT NULL,
  `estatus` enum('ACTIVO','BAJA') DEFAULT 'ACTIVO',
  `rol` enum('ASESOR','SUPERVISOR','GERENTE') NOT NULL DEFAULT 'ASESOR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `ine_empleado`, `nombre`, `apellido`, `direccion`, `telefono`, `curp_seguro`, `puesto`, `estatus`, `rol`) VALUES
(1, NULL, 'Omar Eduardo', 'Jaramillo Tinoco', 'Rododendro 2928', '6441177054', NULL, NULL, 'ACTIVO', 'ASESOR'),
(2, NULL, 'Estanislao', 'Jaramillo Apodaca', 'Calle de la Paterna 817', '6441985354', NULL, NULL, 'ACTIVO', 'GERENTE'),
(3, NULL, 'Josue Estanislao', 'Jaramillo Sanchez', 'Calle de la Paterna 922', '6441451847', NULL, NULL, 'ACTIVO', 'SUPERVISOR'),
(4, NULL, 'Arturo', 'Gastelum', '', '6442155999', NULL, NULL, 'ACTIVO', 'SUPERVISOR'),
(5, NULL, 'Manuel', 'Lutt', '', '6442404570', NULL, NULL, 'ACTIVO', 'ASESOR'),
(6, NULL, 'Julio', 'Merino', '', '6441023028', NULL, NULL, 'ACTIVO', 'ASESOR'),
(7, NULL, 'Jorge', 'Gastelum', '', '6441439101', NULL, NULL, 'ACTIVO', 'ASESOR'),
(8, NULL, 'Fernando', 'Lopez', '', '6441593830', NULL, NULL, 'ACTIVO', 'ASESOR'),
(9, NULL, 'Efrain', 'Mendivil', '', '6442157956', NULL, NULL, 'ACTIVO', 'ASESOR'),
(10, NULL, 'Jonathan', 'Quijada', '', '6442287241', NULL, NULL, 'ACTIVO', 'ASESOR'),
(11, NULL, 'Arturo', 'Lopez', '', '6449979456', NULL, NULL, 'ACTIVO', 'ASESOR'),
(12, NULL, 'Pablo', 'Gil', '', '6442767862', NULL, NULL, 'ACTIVO', 'ASESOR'),
(13, NULL, 'Antonio', 'Gastelum', '', '6441296238', NULL, NULL, 'ACTIVO', 'ASESOR'),
(14, NULL, 'Carlos', 'Rabago', '', '6442467747', NULL, NULL, 'ACTIVO', 'ASESOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cambio_asesor`
--

CREATE TABLE `historial_cambio_asesor` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `asesor_anterior` int(11) DEFAULT NULL,
  `asesor_nuevo` int(11) DEFAULT NULL,
  `autorizado_por` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clientes`
--

CREATE TABLE `historial_clientes` (
  `id_historial` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `asesor_anterior` int(11) NOT NULL,
  `asesor_nuevo` int(11) NOT NULL,
  `autorizado_por` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_clientes`
--

INSERT INTO `historial_clientes` (`id_historial`, `id_cliente`, `asesor_anterior`, `asesor_nuevo`, `autorizado_por`, `fecha`) VALUES
(1, 1, 1, 3, 1, '2026-01-24 07:09:39'),
(2, 1, 3, 3, 1, '2026-01-24 07:14:21'),
(3, 1, 3, 3, 1, '2026-01-24 07:14:24'),
(4, 6, 5, 6, 1, '2026-01-24 07:23:47'),
(5, 1, 3, 6, 1, '2026-01-24 07:27:07'),
(6, 5, 5, 6, 1, '2026-01-24 07:27:14'),
(7, 2, 1, 6, 1, '2026-01-24 07:27:20'),
(8, 2, 6, 7, 1, '2026-01-24 07:28:00'),
(9, 5, 6, 8, 1, '2026-01-24 07:28:06'),
(10, 1, 6, 8, 1, '2026-01-24 07:28:12'),
(11, 5, 8, 7, 1, '2026-01-24 07:40:20'),
(12, 1, 8, 7, 1, '2026-01-24 07:40:26'),
(13, 2, 7, 6, 1, '2026-01-24 08:01:29'),
(14, 5, 7, 6, 1, '2026-01-24 08:01:35'),
(15, 1, 7, 6, 1, '2026-01-24 08:01:39'),
(16, 42, 1, 6, 1, '2026-01-25 09:02:18'),
(17, 42, 6, 5, 1, '2026-01-25 09:04:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_empleados`
--

CREATE TABLE `historial_empleados` (
  `id_historial` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `realizado_por` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_empleados`
--

INSERT INTO `historial_empleados` (`id_historial`, `id_empleado`, `accion`, `fecha`, `realizado_por`) VALUES
(1, 1, 'ALTA', '2026-01-23 22:39:35', 'gerente'),
(2, 2, 'ALTA', '2026-01-24 00:46:38', 'gerente'),
(3, 3, 'ALTA', '2026-01-24 01:23:37', 'gerente'),
(4, 4, 'ALTA', '2026-01-24 01:27:39', 'gerente'),
(5, 5, 'ALTA', '2026-01-24 01:27:52', 'gerente'),
(6, 1, 'REACTIVADO', '2026-01-24 01:34:16', 'gerente'),
(7, 1, 'REACTIVADO', '2026-01-24 01:40:06', 'gerente'),
(8, 1, 'REACTIVADO', '2026-01-24 01:41:57', 'gerente'),
(9, 6, 'ALTA', '2026-01-24 01:45:02', 'gerente'),
(10, 1, 'REACTIVADO', '2026-01-24 01:54:45', 'gerente'),
(11, 1, 'ALTA', '2026-01-24 02:10:25', 'gerente'),
(12, 2, 'ALTA', '2026-01-24 09:30:35', 'admin'),
(13, 3, 'ALTA', '2026-01-24 20:58:47', 'admin'),
(14, 4, 'ALTA', '2026-01-24 21:33:48', 'admin'),
(15, 5, 'ALTA', '2026-01-24 21:34:36', 'admin'),
(16, 6, 'ALTA', '2026-01-24 21:35:29', 'admin'),
(17, 7, 'ALTA', '2026-01-24 21:36:04', 'admin'),
(18, 8, 'ALTA', '2026-01-24 21:37:26', 'admin'),
(19, 9, 'ALTA', '2026-01-24 21:38:33', 'admin'),
(20, 10, 'ALTA', '2026-01-24 21:39:57', 'admin'),
(21, 11, 'ALTA', '2026-01-24 21:41:25', 'admin'),
(22, 12, 'ALTA', '2026-01-24 21:42:05', 'admin'),
(23, 13, 'ALTA', '2026-01-24 21:42:48', 'admin'),
(24, 14, 'ALTA', '2026-01-24 21:43:20', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `fecha_pago` datetime NOT NULL DEFAULT current_timestamp(),
  `monto_pagado` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_prestamo`, `fecha_pago`, `monto_pagado`) VALUES
(112, 2, '2026-01-31 00:00:00', 60.00),
(113, 3, '2026-01-31 00:00:00', 120.00),
(114, 4, '2026-01-31 00:00:00', 300.00),
(115, 5, '2026-01-31 00:00:00', 180.00),
(116, 6, '2026-01-31 00:00:00', 300.00),
(117, 7, '2026-01-31 00:00:00', 420.00),
(118, 8, '2026-01-31 00:00:00', 240.00),
(119, 9, '2026-01-31 00:00:00', 300.00),
(120, 10, '2026-01-31 00:00:00', 120.00),
(121, 11, '2026-01-31 00:00:00', 60.00),
(122, 12, '2026-01-31 00:00:00', 30.00),
(123, 13, '2026-01-31 00:00:00', 60.00),
(124, 14, '2026-01-31 00:00:00', 90.00),
(125, 15, '2026-01-31 00:00:00', 300.00),
(126, 16, '2026-01-31 00:00:00', 900.00),
(127, 17, '2026-01-31 00:00:00', 1200.00),
(128, 18, '2026-01-31 00:00:00', 300.00),
(129, 19, '2026-01-31 00:00:00', 300.00),
(130, 20, '2026-01-31 00:00:00', 180.00),
(131, 21, '2026-01-31 00:00:00', 120.00),
(132, 22, '2026-01-31 00:00:00', 120.00),
(133, 23, '2026-01-31 00:00:00', 240.00),
(134, 24, '2026-01-31 00:00:00', 1200.00),
(135, 25, '2026-01-31 00:00:00', 600.00),
(136, 26, '2026-01-31 00:00:00', 720.00),
(137, 27, '2026-01-31 00:00:00', 600.00),
(138, 28, '2026-01-31 00:00:00', 180.00),
(139, 29, '2026-01-31 00:00:00', 120.00),
(140, 30, '2026-01-31 00:00:00', 120.00),
(141, 31, '2026-01-31 00:00:00', 240.00),
(142, 32, '2026-01-31 00:00:00', 60.00),
(143, 33, '2026-01-31 00:00:00', 180.00),
(144, 34, '2026-01-31 00:00:00', 600.00),
(145, 35, '2026-01-31 00:00:00', 180.00),
(146, 36, '2026-01-31 00:00:00', 300.00),
(147, 37, '2026-01-31 00:00:00', 120.00),
(148, 38, '2026-01-31 00:00:00', 300.00),
(149, 39, '2026-01-31 00:00:00', 180.00),
(150, 40, '2026-01-31 00:00:00', 180.00),
(151, 41, '2026-01-31 00:00:00', 210.00),
(152, 42, '2026-01-31 00:00:00', 90.00),
(153, 43, '2026-01-31 00:00:00', 300.00),
(154, 44, '2026-01-31 00:00:00', 210.00),
(155, 45, '2026-01-31 00:00:00', 240.00),
(156, 46, '2026-01-31 00:00:00', 180.00),
(157, 47, '2026-01-31 00:00:00', 60.00),
(158, 48, '2026-01-31 00:00:00', 180.00),
(159, 50, '2026-01-31 00:00:00', 150.00),
(160, 51, '2026-01-31 00:00:00', 120.00),
(161, 52, '2026-01-31 00:00:00', 240.00),
(162, 53, '2026-01-31 00:00:00', 300.00),
(163, 54, '2026-01-31 00:00:00', 120.00),
(164, 55, '2026-01-31 00:00:00', 360.00),
(165, 56, '2026-01-31 00:00:00', 300.00),
(166, 57, '2026-01-31 00:00:00', 2100.00),
(167, 58, '2026-01-31 00:00:00', 1200.00),
(168, 59, '2026-01-31 00:00:00', 300.00),
(169, 60, '2026-01-31 00:00:00', 300.00),
(170, 61, '2026-01-31 00:00:00', 180.00),
(171, 62, '2026-01-31 00:00:00', 240.00),
(172, 63, '2026-01-31 00:00:00', 180.00),
(173, 64, '2026-01-31 00:00:00', 180.00),
(174, 65, '2026-01-31 00:00:00', 600.00),
(175, 66, '2026-01-31 00:00:00', 300.00),
(176, 67, '2026-01-31 00:00:00', 150.00),
(177, 68, '2026-01-31 00:00:00', 90.00),
(178, 69, '2026-01-31 00:00:00', 60.00),
(179, 70, '2026-01-31 00:00:00', 60.00),
(180, 71, '2026-01-31 00:00:00', 120.00),
(181, 72, '2026-01-31 00:00:00', 120.00),
(182, 73, '2026-01-31 00:00:00', 180.00),
(183, 74, '2026-01-31 00:00:00', 180.00),
(184, 76, '2026-01-31 00:00:00', 180.00),
(185, 77, '2026-01-31 00:00:00', 1200.00),
(186, 78, '2026-01-31 00:00:00', 240.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `monto_prestado` decimal(10,2) DEFAULT NULL,
  `interes` decimal(10,2) DEFAULT NULL,
  `total_pagar` decimal(10,2) DEFAULT NULL,
  `pago_diario` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `dias` int(11) DEFAULT 20,
  `estado` enum('ACTIVO','PAGADO','ATRASADO') DEFAULT 'ACTIVO',
  `interes_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `saldo_actual` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_cliente`, `id_empleado`, `monto_prestado`, `interes`, `total_pagar`, `pago_diario`, `fecha_inicio`, `dias`, `estado`, `interes_total`, `saldo_actual`) VALUES
(1, 1, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'PAGADO', 0.00, 4800.00),
(2, 2, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(3, 4, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(4, 5, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(5, 6, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(6, 6, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(7, 9, 1, 7000.00, 1400.00, 8400.00, 420.00, '2026-01-25', 20, 'ACTIVO', 0.00, 8400.00),
(8, 10, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(9, 11, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(10, 12, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(11, 13, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(12, 12, 1, 500.00, 100.00, 600.00, 30.00, '2026-01-25', 20, 'ACTIVO', 0.00, 600.00),
(13, 14, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(14, 15, 1, 1500.00, 300.00, 1800.00, 90.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1800.00),
(15, 16, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(16, 17, 1, 15000.00, 3000.00, 18000.00, 900.00, '2026-01-25', 20, 'ACTIVO', 0.00, 18000.00),
(17, 17, 1, 20000.00, 4000.00, 24000.00, 1200.00, '2026-01-25', 20, 'ACTIVO', 0.00, 24000.00),
(18, 18, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(19, 19, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(20, 20, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(21, 21, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(22, 22, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(23, 23, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(24, 24, 1, 20000.00, 4000.00, 24000.00, 1200.00, '2026-01-25', 20, 'ACTIVO', 0.00, 24000.00),
(25, 24, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-01-25', 20, 'ACTIVO', 0.00, 12000.00),
(26, 25, 1, 12000.00, 2400.00, 14400.00, 720.00, '2026-01-25', 20, 'ACTIVO', 0.00, 14400.00),
(27, 25, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-01-25', 20, 'ACTIVO', 0.00, 12000.00),
(28, 26, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(29, 27, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(30, 28, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(31, 29, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(32, 29, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(33, 30, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(34, 31, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-01-25', 20, 'ACTIVO', 0.00, 12000.00),
(35, 32, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(36, 33, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(37, 33, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(38, 34, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(39, 35, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(40, 36, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(41, 37, 1, 3500.00, 700.00, 4200.00, 210.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4200.00),
(42, 38, 1, 1500.00, 300.00, 1800.00, 90.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1800.00),
(43, 39, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(44, 41, 1, 3500.00, 700.00, 4200.00, 210.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4200.00),
(45, 43, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(46, 44, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(47, 45, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(48, 45, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(49, 45, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'PAGADO', 0.00, 4800.00),
(50, 47, 1, 2500.00, 500.00, 3000.00, 150.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3000.00),
(51, 49, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(52, 50, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(53, 51, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(54, 52, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(55, 53, 1, 6000.00, 1200.00, 7200.00, 360.00, '2026-01-25', 20, 'ACTIVO', 0.00, 7200.00),
(56, 54, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(57, 55, 1, 35000.00, 7000.00, 42000.00, 2100.00, '2026-01-25', 20, 'ACTIVO', 0.00, 42000.00),
(58, 55, 1, 20000.00, 4000.00, 24000.00, 1200.00, '2026-01-25', 20, 'ACTIVO', 0.00, 24000.00),
(59, 56, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(60, 57, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(61, 57, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(62, 58, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(63, 59, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(64, 59, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(65, 60, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-01-25', 20, 'ACTIVO', 0.00, 12000.00),
(66, 61, 1, 5000.00, 1000.00, 6000.00, 300.00, '2026-01-25', 20, 'ACTIVO', 0.00, 6000.00),
(67, 62, 1, 2500.00, 500.00, 3000.00, 150.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3000.00),
(68, 63, 1, 1500.00, 300.00, 1800.00, 90.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1800.00),
(69, 64, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(70, 65, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-01-25', 20, 'ACTIVO', 0.00, 1200.00),
(71, 61, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(72, 66, 1, 2000.00, 400.00, 2400.00, 120.00, '2026-01-25', 20, 'ACTIVO', 0.00, 2400.00),
(73, 67, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(74, 67, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(75, 67, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'PAGADO', 0.00, 3600.00),
(76, 68, 1, 3000.00, 600.00, 3600.00, 180.00, '2026-01-25', 20, 'ACTIVO', 0.00, 3600.00),
(77, 69, 1, 20000.00, 4000.00, 24000.00, 1200.00, '2026-01-25', 20, 'ACTIVO', 0.00, 24000.00),
(78, 46, 1, 4000.00, 800.00, 4800.00, 240.00, '2026-01-25', 20, 'ACTIVO', 0.00, 4800.00),
(79, 25, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-02-01', 20, 'ACTIVO', 0.00, 0.00),
(80, 36, 1, 10000.00, 2000.00, 12000.00, 600.00, '2026-02-01', 20, 'ACTIVO', 0.00, 0.00),
(81, 30, 1, 1000.00, 200.00, 1200.00, 60.00, '2026-02-01', 20, 'ACTIVO', 0.00, 0.00),
(82, 30, 1, 12000.00, 2400.00, 14400.00, 720.00, '2026-02-01', 20, 'ACTIVO', 0.00, 0.00),
(83, 44, 1, 12000.00, 2400.00, 14400.00, 720.00, '2026-02-01', 20, 'ACTIVO', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol` enum('GERENTE','SUPERVISOR','ASESOR') DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `rol`, `id_empleado`) VALUES
(1, 'admin', '$2y$10$YUt0CaPru8/8b8PQwS1/LeSalQy16zUNimfah6myuIt8VfSwEZW2W', 'GERENTE', 2),
(2, 'omar1', '$2y$10$Rb.tTNxyx0cbCEaiBAZP0ukg2c/waxyWk/QFHjsqDvodS51eeDW/W', 'ASESOR', 1),
(3, 'Jaramillo', '$2y$10$y2JkzNd6q3ph6mhBcyB5HuqPHab5o8h4ulTWQ/jrLPNiVLP7dJbvq', 'GERENTE', NULL),
(4, 'josue1', '$2y$10$y2JkzNd6q3ph6mhBcyB5HuqPHab5o8h4ulTWQ/jrLPNiVLP7dJbvq', 'SUPERVISOR', 3),
(5, 'arturo1', '$2y$10$v2dHddtQC6oREqVgrqvx9e.J3Il6.hg8gvSdoVUKFPqVrQijYlOjW', 'SUPERVISOR', 4),
(6, 'manuel1', '$2y$10$7iPDQvyv1hpnZD0IHJsLP.z2a15jLBPBhjsZEzenlCPrGA6O0cnyq', 'ASESOR', 5),
(7, 'julio1', '$2y$10$rDtxSF0CrbVr.XhqHB503.or.jxVJry6V2x4GFOZSOi43HzpQ.UHO', 'ASESOR', 6),
(8, 'jorge1', '$2y$10$NR5XCUMdh264jhzTuGqv2.LL4CdpzP1VCf55ZL6INvG6olgt32T.u', 'ASESOR', 7),
(9, 'fernando1', '$2y$10$/Vmig/s17o1jDYBDyllUg.j5mxVTqxplQF4n8PUYsOU4G9H8BFvny', 'ASESOR', 8),
(10, 'efrain1', '$2y$10$IAbZJhO/wIrVtI41voUTTuzr36brRJrWMltNmDv3sXb9WSq3K7R1e', 'ASESOR', 9),
(11, 'jonathan', '$2y$10$b6kEexPyFd.xegHBMePWCOzhqEWZ1WPZ4KakQDyVdXZt78EQR2DQS', 'ASESOR', 10),
(12, 'arturo2', '$2y$10$52YEV3krWm1disQ4waLwCO3ZgZHF3jcGRwTqMF23LzTqXXU7vslBe', 'ASESOR', 11),
(13, 'pablo1', '$2y$10$SLoJeAfYwNno1ASM9tSDEuMPkdIZ1ldaT6VnQHMOaxrqxHCcVRifS', 'ASESOR', 12),
(14, 'antonio1', '$2y$10$d/CzSFwIQgcCZjPpbaE.Bedkf8c7lMgiSoowKcK4W.QnIZ2T3kdlu', 'ASESOR', 13),
(15, 'carlos1', '$2y$10$Q4eYaIYRXHxb7FHtKu3gP.u0wW0jG7UGfKyl/LCJLTuKYgogqXp.S', 'ASESOR', 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_usuario` (`id_usuario`),
  ADD KEY `fk_clientes_asesor_empleado` (`id_asesor`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `historial_cambio_asesor`
--
ALTER TABLE `historial_cambio_asesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_clientes`
--
ALTER TABLE `historial_clientes`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `historial_empleados`
--
ALTER TABLE `historial_empleados`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `idx_pagos_prestamo` (`id_prestamo`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `historial_cambio_asesor`
--
ALTER TABLE `historial_cambio_asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_clientes`
--
ALTER TABLE `historial_clientes`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `historial_empleados`
--
ALTER TABLE `historial_empleados`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_asesor_empleado` FOREIGN KEY (`id_asesor`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `fk_clientes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
