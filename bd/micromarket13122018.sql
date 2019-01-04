-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.26-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para marketbbdd
CREATE DATABASE IF NOT EXISTS `marketbbdd` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `marketbbdd`;

-- Volcando estructura para procedimiento marketbbdd.buscar_cliente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_cliente`(in carnet varchar(20))
BEGIN
      SELECT * FROM cliente WHERE ci=carnet;
    END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.buscar_usuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_usuario`(
in usu varchar(100)
)
BEGIN
SELECT id_usuario,nombre, usuario, estado, contrasenia, tipo
                            FROM usuario_login
                            WHERE usuario = usu AND estado=1;
end//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.cantidad_peso
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidad_peso`()
BEGIN
       SELECT p.id_prod,p.nro_plu
      , p.nombre as nomProducto
      , CASE p.tipo WHEN 1 THEN 'Cantidad' WHEN 2 THEN 'Peso' END AS tipo
      , p.precio, p.cod_plu, s.nombre as nomSeccion
    FROM producto p, seccion s
    WHERE p.idseccion = s.id_seccion and p.estado=1;
    END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `ci` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `ci_UNIQUE` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla marketbbdd.cliente: ~242 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id_cliente`, `ci`, `nombre`, `estado`, `fecha_registro`) VALUES
	(9, '12345678', 'sergio', 0, '2018-11-12 11:16:59'),
	(10, '758945', 'mendoza sara', 0, '2018-11-12 12:55:39'),
	(11, '123456', 'maria', 0, '2018-11-12 12:59:12'),
	(12, '5774727', 'Elizabeth Julia Gonzales Perez', 1, '2018-11-12 13:04:30'),
	(13, '3798155', 'RUTH DELICIA  CUEVAS VIDEA', 1, '2018-11-12 14:11:31'),
	(14, '5746772', 'ZULMA  RIOS HURTADO', 1, '2018-11-12 15:03:57'),
	(15, '5746674', 'LILIAN JUDITH MIRANDA YUCRA', 1, '2018-11-12 15:21:44'),
	(16, '7266508', 'SILVANA MARIA VILLANUVA CALLE', 1, '2018-11-12 15:29:11'),
	(17, '5065337', 'ANSELMA CATARI MAMAN', 1, '2018-11-12 15:35:01'),
	(18, '4746169', 'ZELMA LUNA INOCENTE', 1, '2018-11-12 15:49:20'),
	(19, '5726702', 'ANA MARIA SORIA GALVARRO SANDY', 1, '2018-11-12 15:58:10'),
	(20, '7421133', 'KARLA ALISON SORIA GALVARRO SANDY', 1, '2018-11-12 16:02:13'),
	(21, '12581399', 'PAOLA FLORES ALVAREZ', 1, '2018-11-12 16:23:47'),
	(22, '7389663', 'SYRLEY PAMELA TORREZ MIRANDA', 1, '2018-11-12 20:52:39'),
	(23, '4039474', 'mary blanco villca', 1, '2018-11-12 23:19:13'),
	(24, '1911124', 'CECILIA MENDOZA ARIAS', 1, '2018-11-15 21:16:25'),
	(25, '12911124', 'CECILIA MENDOZA ARIAS', 1, '2018-11-15 21:17:28'),
	(26, '5743964', 'ISABEL MAMANI COLQUE', 1, '2018-11-15 21:38:14'),
	(27, '7451329', 'DELIA OLGUIN', 1, '2018-11-15 22:15:08'),
	(28, '4053474', 'MENKA VILCAEZ', 1, '2018-11-15 23:36:46'),
	(29, '7349525', 'MAURA POMA QUISPE', 1, '2018-11-16 13:39:38'),
	(30, '5066987', 'TATIANA VILLCA  LARA', 1, '2018-11-16 14:06:32'),
	(31, '7280017', 'SULEMA COLQUE CONDORI', 1, '2018-11-16 14:15:24'),
	(32, '5772039', 'CARLA ISABEL VALENCIA MENDOZA', 1, '2018-11-16 14:25:20'),
	(33, '4063851', 'JHOVANA MARTINEZ MAMANI', 1, '2018-11-16 14:36:12'),
	(34, '7280418', 'ROSANNA TERESA DE  JESUS PADILLA OROS', 1, '2018-11-16 14:52:23'),
	(35, '5743839', 'YOVANA TOLA VELASCO', 1, '2018-11-16 15:01:52'),
	(36, '6520076', 'ANA COLQUE POMA', 1, '2018-11-16 18:17:48'),
	(37, '7329619', 'ZAIDA MARCELA ZUNA ZUBIETA', 1, '2018-11-16 19:17:36'),
	(38, '6328610', 'AMBAR MILCA  FLORES CALLATA', 1, '2018-11-16 19:33:11'),
	(39, '10548052', 'MIRIAM MARCOS COPALI', 1, '2018-11-16 20:00:34'),
	(40, '8611059', 'LUCIA TORRICO MAMANI', 1, '2018-11-16 20:45:19'),
	(41, '3554654', 'PATRICIA RIOS APAZA', 1, '2018-11-16 20:55:20'),
	(42, '7298042', 'MAYRA IGNACIO VELASCO', 1, '2018-11-16 21:04:59'),
	(43, '12548937', 'SUSANA ALVAREZ QUISPE', 1, '2018-11-16 21:13:21'),
	(44, '7387123', 'RUTH JIMENA ARHUATA MEJIA', 1, '2018-11-16 21:50:42'),
	(45, '8550979', 'LEONIDAS QUISPE FLORES', 1, '2018-11-17 12:46:58'),
	(46, '4049066', 'BETTY ROSA MICHAGA  MAMANI', 1, '2018-11-17 12:57:26'),
	(47, '5086120', 'MARTHA QUISPE FLORES', 1, '2018-11-17 13:09:22'),
	(48, '13994006', 'ALEJANDRINA  MAMANI GABRIEL', 1, '2018-11-17 13:17:47'),
	(49, '5765720', 'RUBENIA PAOLA MAMANI PORTILLO', 1, '2018-11-17 13:32:21'),
	(50, '3529446', 'ROSMERY ZENTENO RAFAEL', 1, '2018-11-17 13:38:50'),
	(51, '4068463', 'AIDA ROXANA CHUNGARA GARISTO', 1, '2018-11-17 13:50:39'),
	(52, '4022808', 'MILVIA GABRIEL FLORES', 1, '2018-11-17 14:13:22'),
	(53, '5514661', 'SALOME PACO MENDOZA', 1, '2018-11-17 14:20:08'),
	(54, '5738848', 'NITZA LUZ CASTILLO CALLE', 1, '2018-11-17 14:37:30'),
	(55, '13827483', 'NIEVES CHAMBI  CANAVIRI', 1, '2018-11-17 14:59:22'),
	(56, '5765894', 'MARIA JOSE GUTIERREZ ARANCIBIA', 1, '2018-11-17 15:21:19'),
	(57, '4079830', 'LUCY NINA CONDORI', 1, '2018-11-17 16:56:26'),
	(58, '5939644', 'NELLY TELLEZ COPA', 1, '2018-11-17 17:44:27'),
	(59, '7303562', 'Karen Esdenka Urquidi Hinojosa', 1, '2018-11-17 19:23:39'),
	(60, '7426404', 'MARIBEL CANCHRI GARCIA', 1, '2018-11-17 20:11:58'),
	(61, '5764966', 'CLAUDIA ANDREA CANEDO BUSTAMANTE', 1, '2018-11-17 20:45:08'),
	(62, '7425437', 'SILVIA ALEJANDRA CHOQUE HUARACHI', 1, '2018-11-19 15:23:10'),
	(63, '7376877', 'Alejandra Lidia Velazco Bohorquez', 1, '2018-11-19 17:27:24'),
	(64, '7382508', 'VICENTA HUANCA HINOJOSA', 1, '2018-11-19 20:06:56'),
	(65, '7352717', 'LUCY CAROLINA COLQUE ROBLES', 1, '2018-11-19 20:21:48'),
	(66, '5063870', 'NAREL VANESSA DAZA PEÃƒâ€˜A', 1, '2018-11-19 21:09:54'),
	(67, '5067222', 'PAMELA ELIANA GARCIA ROJAS', 1, '2018-11-20 14:19:58'),
	(68, '4021306', 'SUSY MABEL VERA RODRIGUEZ', 1, '2018-11-20 15:22:28'),
	(69, '6665230', 'IVETH DUEÃƒâ€˜AS CUEVAS', 1, '2018-11-20 15:31:58'),
	(70, '7380148', 'MARIBEL CANAVIRI CANAZA', 1, '2018-11-20 15:42:05'),
	(71, '7333188', 'LUCIA EUSEBIA YUCRA ALVAREZ', 1, '2018-11-20 16:49:57'),
	(72, '7347576', 'JENNY ISABEL CANAVIRI FLORES', 1, '2018-11-20 19:09:15'),
	(73, '5725914', 'MARIA EUGENIA MAMANI MIRANDA', 1, '2018-11-20 20:22:51'),
	(74, '5742205', 'MAGALY ZULMA SOTO MAGNE', 1, '2018-11-21 12:54:15'),
	(75, '5765706', 'SANDRA GOMEZ MOLLO', 1, '2018-11-21 14:44:01'),
	(76, '4066541', 'SONIA VILLCA FLORES', 1, '2018-11-21 14:52:15'),
	(77, '5738950', 'MARLENE PACO CHAVEZ', 1, '2018-11-21 15:32:52'),
	(78, '7265311', 'CASILDA RODRIGUEZ MAMANI', 1, '2018-11-21 17:49:43'),
	(79, '7266531', 'ROXANA ZUBIETA  ROJAS', 1, '2018-11-21 19:58:27'),
	(80, '10008343', 'ISAMAR MARYHEL MUÃƒâ€˜OZ LEYVA', 1, '2018-11-21 20:43:21'),
	(81, '5720245', 'BERTHA CHOQUE COLQUE', 1, '2018-11-21 20:58:37'),
	(82, '7335848', 'JUDE JHANET CONDORI CHOQUE', 1, '2018-11-22 12:59:37'),
	(83, '7312959', 'MARUJA BASCO RODRIGUEZ', 1, '2018-11-22 13:20:08'),
	(84, '5771362', 'WENDY KARINA AGUILAR SUMA', 1, '2018-11-22 13:49:36'),
	(85, '12677165', 'DEMECIA CONDORI GUTIERREZ', 1, '2018-11-22 13:59:44'),
	(86, '4051353', 'KARINA CRUZ BERRIOS', 1, '2018-11-22 14:33:35'),
	(87, '5066433', 'SUSANA INES MAMANI HUARACHI', 1, '2018-11-22 14:58:05'),
	(88, '4038363', 'ZULMA NANCY MAMANI MAMANI', 1, '2018-11-22 15:59:42'),
	(89, '7369492', 'ANDREA GENESIS CRUZ RUFINO', 1, '2018-11-22 16:11:06'),
	(90, '5738196', 'GOMEZ CONDORI FLORENCIA', 1, '2018-11-22 16:36:28'),
	(91, '7269625', 'MARIA RAQUEL MAIZU QUISPE', 1, '2018-11-22 19:37:31'),
	(92, '4043282', 'REYNA MONTOYA MARTINEZ', 1, '2018-11-22 20:09:38'),
	(93, '7313299', 'EVA CAYOJA CONDORI', 1, '2018-11-22 20:29:11'),
	(94, '10566049', 'LIZETH LESBI CHUCA SEMPERTEGUI', 1, '2018-11-22 20:31:59'),
	(95, '6645016', 'LISBETH PAMELA CUENCA DAVILA', 1, '2018-11-23 13:53:59'),
	(96, '4068235', 'JAQUELINE RAMOS PACA', 1, '2018-11-23 14:24:35'),
	(97, '6605146', 'JULIANA CHOQUE MAMANI', 1, '2018-11-23 15:18:44'),
	(98, '5934763', 'SEBERINA TOLA FLORES', 1, '2018-11-23 15:57:38'),
	(99, '7923422', 'MARGARITA JAIMES ORELLANA', 1, '2018-11-23 18:08:49'),
	(100, '5739713', 'LOURDES JESUSA ROMERO MENDOZA', 1, '2018-11-23 18:26:35'),
	(101, '7260784', 'MIRIAM PASCUAL ACHACOLLO', 1, '2018-11-23 18:53:39'),
	(102, '8581520', 'GISSELLE ZENTENO SILVA', 1, '2018-11-23 18:55:14'),
	(103, '5796639', 'IRIS ALTAMIRANO TAPÃƒÂA', 1, '2018-11-23 19:29:41'),
	(104, '4069420', 'ESCARLETH SHIRLEY ENCINAS COLQUE', 1, '2018-11-23 19:40:23'),
	(105, '12614470', 'MARUJA CHAJMI GABRIEL', 1, '2018-11-23 20:11:35'),
	(106, '5066828', 'JHOSSELYNE BARBARA ROCHA CHOQUE', 1, '2018-11-23 20:25:19'),
	(107, '4048464', 'JHOANNA GISELA ROCHA CHOQUE', 1, '2018-11-23 20:26:52'),
	(108, '4060056', 'LIZET VANESA GUEVARA', 1, '2018-11-23 20:39:05'),
	(109, '5766720', 'INGRID ARIANA FLORES RIVERA', 1, '2018-11-23 21:25:26'),
	(110, '5271693', 'DEISY MARISOL LOPEZ PEREDO', 1, '2018-11-24 12:46:03'),
	(111, '7283539', 'GLADYS MARTINEZ MAMANI', 1, '2018-11-24 13:41:38'),
	(112, '13135396', 'JORGE POLICARPIO ELIZABETH', 1, '2018-11-24 13:46:51'),
	(113, '7269021', 'MONICA PATRICIA CALLE QUISPE', 1, '2018-11-24 14:01:32'),
	(114, '7415213', 'TANIA MAMANI FERNANDEZ', 1, '2018-11-24 14:19:13'),
	(115, '5720293', 'JANNETH CHOQUE LAPACA', 1, '2018-11-24 14:19:47'),
	(116, '7265472', 'ROSMERY CHAMBI FLORES', 1, '2018-11-24 14:24:44'),
	(117, '5729121', 'WILMA GLADYS MOLLO QUISPE', 1, '2018-11-24 14:41:11'),
	(118, '7272355', 'CECILIA HUANCA FLORES', 1, '2018-11-24 14:54:25'),
	(119, '7261070', 'GETRUDES LOYDA MAMANI SANIZO', 1, '2018-11-24 15:02:39'),
	(120, '5740235', 'EMMA SOTO MAMANI', 1, '2018-11-24 15:09:20'),
	(121, '7898849', 'CLAUDIA VERONICA ROJAS FLORES', 1, '2018-11-24 15:14:52'),
	(122, '5764437', 'RITA MOLLO FLORES', 1, '2018-11-24 15:18:47'),
	(123, '4079403', 'PATRICIA GUTIERREZ CAPO', 1, '2018-11-24 15:26:38'),
	(124, '3559473', 'JACQUELINE SOFFY PEREZ GOMEZ', 1, '2018-11-24 15:46:57'),
	(125, '4052373', 'MARITZA HUANCA VILLCA', 1, '2018-11-24 15:58:36'),
	(126, '8063897', 'ALVINA HUAYLLA ZEBALLOS', 1, '2018-11-24 16:05:46'),
	(127, '5733983', 'ELIZABETH CONDORI FLORES', 1, '2018-11-24 16:21:59'),
	(128, '7269795', 'ANGELICA GOMEZ ORTIZ', 1, '2018-11-24 16:31:03'),
	(129, '5489980', 'AMALIA LLANOS CRUZ', 1, '2018-11-24 16:50:49'),
	(130, '5765956', 'MABEL ERIKA MAMANI JANCO', 1, '2018-11-24 17:48:47'),
	(131, '5069518', 'RUTH CLAUDIA HUMEREZ FLORES', 1, '2018-11-24 18:03:31'),
	(132, '5534623', 'MERY SARA LORA CHOCATA', 1, '2018-11-24 18:27:12'),
	(133, '7365207', 'SONIA AGUIRRE AGUIRRE', 1, '2018-11-24 19:02:30'),
	(134, '3538813', 'SANDRA NORKA PARDO CHOQUE', 1, '2018-11-26 14:08:00'),
	(135, '4063106', 'PAMELA PATRICIA TORREZ ALVAREZ', 1, '2018-11-26 14:15:55'),
	(136, '7309009', 'JANET NIÃƒâ€˜EZ CRISPIN', 1, '2018-11-26 14:21:04'),
	(137, '7368785', 'LIDIA CRUZ CHUQUICHAMBI', 1, '2018-11-26 16:06:59'),
	(138, '8552206', 'DEYSI ANZE FLORES', 1, '2018-11-26 16:16:06'),
	(139, '7328181', 'JUANA BLANCO MAMANI', 1, '2018-11-26 17:02:55'),
	(140, '5764709', 'MAGALY PATY  ROMAN ZUBIETA', 1, '2018-11-26 17:03:34'),
	(141, '4077675', 'SONIA KAREN SOLIZ QUISPE', 1, '2018-11-26 17:13:57'),
	(142, '7266096', 'ANDREINA MAGDALIZ VALENCIA RAMIREZ', 1, '2018-11-26 17:27:25'),
	(143, '5746666', 'CRISELDA CHOQUE ALARCON', 1, '2018-11-26 17:45:21'),
	(144, '7386436', 'JUANA VENTURA SOLIZ', 1, '2018-11-26 18:32:06'),
	(145, '7422221', 'LOURDES CALIZAYA ZARATE', 1, '2018-11-26 19:39:58'),
	(146, '4040347', 'PAOLA MARZANO OXA', 1, '2018-11-26 19:48:56'),
	(147, '4078959', 'MARICRUZ QUISPE APAZA', 1, '2018-11-26 19:51:46'),
	(148, '4027504', 'MIGUELINA MAMANI GARCIA', 1, '2018-11-26 20:37:25'),
	(149, '7277939', 'DORIS CANDELARIA VARGAS CALLE', 1, '2018-11-26 21:53:53'),
	(150, '4070781', 'ADELA MONTOYA MARTINEZ', 1, '2018-11-26 22:06:29'),
	(151, '3976008', 'PORFIDIA MAMANI CORREA', 1, '2018-11-27 13:10:17'),
	(152, '7385891', 'MARIA JOSE RAMOS RAMIREZ', 1, '2018-11-27 14:18:47'),
	(153, '3559999', 'MARIA LUISA HUARACHI RAMOS', 1, '2018-11-27 14:29:43'),
	(154, '4920828', 'OLGA APAZA MAMANI', 1, '2018-11-27 14:44:42'),
	(155, '7271393', 'MIRIAN ALARCON  JUANIQUINA', 1, '2018-11-27 14:52:14'),
	(156, '7324162', 'NEYZA  DIAZ QUIROGA', 1, '2018-11-27 15:14:33'),
	(157, '7280659', 'RAQUEL AYMARITA PIZARRO PRADA', 1, '2018-11-27 16:01:47'),
	(158, '7383310', 'XINA TICONA QUISPE', 1, '2018-11-27 16:31:52'),
	(159, '7260384', 'SUZAN PAMELA COLQUE AYAVIRI', 1, '2018-11-27 18:10:17'),
	(160, '5759423', 'EMILDA CONDORI AIZA', 1, '2018-11-28 13:15:41'),
	(161, '5747258', 'DANIELA ARIANA VELASQUEZ SANCHEZ', 1, '2018-11-28 13:55:38'),
	(162, '7390555', 'NADITH ROSARIO TICONA MARTINEZ', 1, '2018-11-28 14:18:10'),
	(163, '7417046', 'AMALIA URURI ZARATE', 1, '2018-11-28 14:25:41'),
	(164, '5775287', 'LIZETH NUÃƒâ€˜EZ CADIZ', 1, '2018-11-28 18:53:45'),
	(165, '7920437', 'SAMIRA CANCHARI REVOLLO', 1, '2018-11-28 19:09:12'),
	(166, '7308355', 'BRIZA  BIANKA TERCEROS CESPEDES', 1, '2018-11-28 19:14:51'),
	(167, '7373999', 'MARIA CAROLINA PAREDES RAMIREZ', 1, '2018-11-28 19:26:04'),
	(168, '7299956', 'GRACIELA CHAMBI PADILLA', 1, '2018-11-28 19:30:18'),
	(169, '7317501', 'ROSSEMARY RAFAEL LOPEZ', 1, '2018-11-28 20:11:25'),
	(170, '12590728', 'YOLISA PACARA TAQUI', 1, '2018-11-29 13:24:54'),
	(171, '5746659', 'MARILIN MACHACA AJHUACHO', 1, '2018-11-29 13:42:16'),
	(172, '1348911', 'PETRONA RUFINA CHURQUI GOMEZ', 1, '2018-11-29 13:48:32'),
	(173, '7358324', 'WARA  CHOQUECALLATA CONDORI', 1, '2018-11-29 14:19:18'),
	(174, '7275089', 'MARINA CHOQUE MAMANI', 1, '2018-11-29 14:24:56'),
	(175, '3518016', 'ELIZABETH ROXANA RAMOS CONDORI', 1, '2018-11-29 14:33:51'),
	(176, '4062483', 'MARIA CRUZ RAMIREZ de CHURA', 1, '2018-11-29 14:39:10'),
	(177, '7903149', 'VALERIA CANAVIRI MAMANI', 1, '2018-11-29 14:55:39'),
	(178, '8535274', 'MARLENE ANTONIO QUICHARI', 1, '2018-11-29 15:17:43'),
	(179, '5779478', 'FABIOLA ERIKA MORON GALARZA', 1, '2018-11-29 15:59:26'),
	(180, '5034741', 'INGRID JESSICA ROBLES BURGOA', 1, '2018-11-29 16:29:28'),
	(181, '7304763', 'DINA CHOQUE TICLLA', 1, '2018-11-29 16:55:01'),
	(182, '3553524', 'JENNY  GARNICA OQUENDO', 1, '2018-11-29 17:06:47'),
	(183, '7334511', 'Gonzales Visa Leonilda Avigail', 1, '2018-11-29 17:39:51'),
	(184, '7341414', 'LIZETH DAYSI RAMOS MAMANI', 1, '2018-11-29 18:56:24'),
	(185, '5727350', 'ZULMA ROBLES CALANI', 1, '2018-11-29 19:14:33'),
	(186, '5064279', 'AIDEE VIRGINIA AMELLER HUMEREZ', 1, '2018-11-29 19:56:19'),
	(187, '7453621', 'ANA PAMELA ROMERO VILLARROEL', 1, '2018-11-29 20:04:45'),
	(188, '7347669', 'DANIELA VANESSA MAMANI CHOQUE', 1, '2018-11-29 20:10:47'),
	(189, '5065257', 'MARGARITA QUISPE FELIPE', 1, '2018-11-29 20:16:47'),
	(190, '5760103', 'MARTHA MARCA QUISPE', 1, '2018-11-29 20:41:43'),
	(191, '7365792', 'ROSSIO RODRIGUEZ CONDORI', 1, '2018-11-29 21:02:24'),
	(192, '4040294', 'MONICA DE LA ASUNCION CALLATA PARDO', 1, '2018-11-30 13:10:42'),
	(193, '7399158', 'SONIA ROSARIO FERNANDEZ ARANIBAR', 1, '2018-11-30 13:34:58'),
	(194, '5067999', 'PAMELA ARROYO MARCA', 1, '2018-11-30 14:00:15'),
	(195, '6515051', 'NEVA INGRID RAMIREZ ORELLANA', 1, '2018-11-30 14:00:48'),
	(196, '7369363', 'TATIANA TORREZ FRANCO', 1, '2018-11-30 14:29:45'),
	(197, '7370385', 'MELINA LAURA FLORES CHAVEZ', 1, '2018-11-30 14:44:15'),
	(198, '5726112', 'MELINA MYRNA SILES VERDUGUEZ', 1, '2018-11-30 15:02:15'),
	(199, '5735819', 'FLORINDA HERRERA LOVERA', 1, '2018-11-30 16:13:16'),
	(200, '5720943', 'JAHEL RIOS JIMENEZ', 1, '2018-11-30 16:17:27'),
	(201, '4045911', 'ROSA BOYAN PATI', 1, '2018-11-30 16:40:11'),
	(202, '5762414', 'SILVIA EUGENIA JAMACHI GUZMAN', 1, '2018-11-30 17:27:14'),
	(203, '7301217', 'ANGELICA CANAVIRI RAMIREZ', 1, '2018-11-30 18:26:50'),
	(204, '7276004', 'JUDITH MAMANI MAMANI', 1, '2018-11-30 19:30:05'),
	(205, '7302290', 'DEYSI ORDOÃƒâ€˜EZ AYMA', 1, '2018-11-30 19:38:06'),
	(206, '5776437', 'ALEYDA EULATE ESCOBAR', 1, '2018-11-30 19:53:10'),
	(207, '3083331', 'RUTH MERY CHOQUE CUSICANQUI', 1, '2018-11-30 20:03:54'),
	(208, '7391986', 'PATRICIA ARISTA ANDRADE', 1, '2018-11-30 20:16:47'),
	(209, '7369225', 'DELIANA CONDORI PINAYA', 1, '2018-11-30 20:25:48'),
	(210, '5779695', 'GLADYS COPA BONIFACIO', 1, '2018-11-30 20:38:01'),
	(211, '5861296', 'LENNY TATIANA BLANCO BASCOPE', 1, '2018-11-30 21:36:01'),
	(212, '5779194', 'TRIFONIA COAQUIRA COAQUIRA', 1, '2018-11-30 21:51:39'),
	(213, '6896123', 'PAULINA  MARCA de CACHI', 1, '2018-12-01 12:56:27'),
	(214, '5757720', 'LOLA LUNA PINTO', 1, '2018-12-01 12:59:43'),
	(215, '3556693', 'JUDITH ARIVIRI CHECA', 1, '2018-12-01 13:01:13'),
	(216, '7282825', 'ROSSE MARY CALLE ITAMARI', 1, '2018-12-01 13:22:32'),
	(217, '7282729', 'MARIA ISABEL MORALES CHOQUE', 1, '2018-12-01 13:52:02'),
	(218, '3528769', 'ANGELICA FARFAN MURGA', 1, '2018-12-01 14:05:10'),
	(219, '7271554', 'DANIA CRUZ TUPA', 1, '2018-12-01 14:22:21'),
	(220, '4078452', 'JEANNETH MORALES CAMACHO', 1, '2018-12-01 14:40:29'),
	(221, '6576435', 'FILOMENA BAUTISTA ARELY', 1, '2018-12-01 14:48:55'),
	(222, '5764194', 'ROXANA ADUVIRI APAZA', 1, '2018-12-01 15:04:46'),
	(223, '4039597', 'MARIA ELENA EQUIZA FLORES', 1, '2018-12-01 15:22:21'),
	(224, '12369782', 'PAOLA ANDREA CONDARCO MACIAS', 1, '2018-12-01 15:32:31'),
	(225, '3547673', 'DELIA CHOQUE TICONA', 1, '2018-12-01 15:49:08'),
	(226, '5733605', 'SHIRLEY ROCIO SILES ZENTENO', 1, '2018-12-01 15:56:31'),
	(227, '3559982', 'DIANA CANDIDA  MISERICORDIA FLORES', 1, '2018-12-01 16:04:48'),
	(228, '7302429', 'GUISELLE GLADYS FULGUERA AYMA', 1, '2018-12-01 16:14:55'),
	(229, '8422791', 'ROSIO ELIAS QUIBE', 1, '2018-12-01 16:23:50'),
	(230, '5500743', 'NATIVIDAD CHOQUE CARME', 1, '2018-12-01 16:35:55'),
	(231, '5777884', 'JIMENA LAZARTE VELIZ', 1, '2018-12-01 16:45:50'),
	(232, '7321132', 'MADAI COPA QUELCA', 1, '2018-12-01 16:57:28'),
	(233, '7393152', 'MARLENY AMELIA COPA CARBAJAL', 1, '2018-12-01 17:02:30'),
	(234, '5932147', 'GABRIELA ARANCIBIA FERNANDEZ', 1, '2018-12-01 17:20:02'),
	(235, '5066398', 'INDIRA SANCHEZ ROCHA', 1, '2018-12-03 12:52:05'),
	(236, '3559537', 'JANETTE ZENTENO LIMACHI', 1, '2018-12-03 13:20:44'),
	(237, '6725635', 'ISABEL COLQUE ROJAS', 1, '2018-12-03 13:24:30'),
	(238, '4045708', 'LILIANA MERY TORRICO DELGADO', 1, '2018-12-03 14:07:41'),
	(239, '7325288', 'PASTORA CASTILLO FABIAN', 1, '2018-12-03 14:14:37'),
	(240, '7273069', 'PAOLA ALEJANDRA MADRID TOLEDO', 1, '2018-12-03 14:33:13'),
	(241, '3518917', 'JEANETTE ROSARIO CHOQUE SANTOS', 1, '2018-12-03 14:42:48'),
	(242, '7377746', 'CLARALIZ MELINA COLQUE VILLCA', 1, '2018-12-03 14:47:47'),
	(243, '9136773', 'JUANA VELASQUEZ CONDORI', 1, '2018-12-03 15:22:58'),
	(244, '7329721', 'DHEISI MAMANI LIZETE', 1, '2018-12-03 16:41:35'),
	(245, '6114329', 'JUANA FIGUEREDO RADA', 1, '2018-12-03 17:08:42'),
	(246, '5769317', 'NAYRA ROXANA BELTRAN ALANEZ', 1, '2018-12-03 17:18:52'),
	(247, '7302517', 'ABIGAIL KATERINE CORREA ALCOCER', 1, '2018-12-03 17:53:22'),
	(248, '3528868', 'ROCIO KARINA HEREDIA RAMIREZ', 1, '2018-12-03 19:11:56'),
	(249, '7320089', 'JESSICA RAQUEL QUISPE QUECHARI', 1, '2018-12-03 19:30:07'),
	(250, '12590245', 'ROSMERI COPATITI PAIRO', 1, '2018-12-03 21:33:06');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla marketbbdd.compra_r
CREATE TABLE IF NOT EXISTS `compra_r` (
  `id_compra` bigint(20) NOT NULL,
  `nro_recibo` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `total` float NOT NULL,
  `total_literal` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `estado` int(11) DEFAULT NULL COMMENT 'esta pordefinirse los estados que se tendra',
  PRIMARY KEY (`id_compra`),
  KEY `FK_CLI_DET` (`id_cliente`),
  KEY `FK_USER_DET` (`id_usuario`),
  CONSTRAINT `FK_CLI_DET` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_DET` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_login` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla marketbbdd.compra_r: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `compra_r` DISABLE KEYS */;
INSERT INTO `compra_r` (`id_compra`, `nro_recibo`, `total`, `total_literal`, `fecha`, `id_cliente`, `id_usuario`, `estado`) VALUES
	(1, '1', 154, 'CIENTO CINCUENTA Y CUATRO con 00/100 Bs.', '2018-12-12 15:11:34', 11, 5, NULL),
	(2, '2', 4520, 'CUATRO  MIL QUINIENTOS VEINTE con 00/100 Bs.', '2018-12-12 19:29:09', 11, 5, NULL),
	(3, '3', 1986, ' MIL NOVECIENTOS OCHENTA Y SEIS con 00/100 Bs.', '2018-12-12 19:38:17', 11, 5, NULL),
	(4, '4', 96, 'NOVENTA Y SEIS con 00/100 Bs.', '2018-12-12 19:43:17', 11, 5, NULL),
	(5, '5', 230, 'DOSCIENTOS TREINTA con 00/100 Bs.', '2018-12-12 19:46:44', 11, 5, NULL),
	(6, '6', 230, 'DOSCIENTOS TREINTA con 00/100 Bs.', '2018-12-12 20:00:12', 11, 5, NULL),
	(7, '7', 346, 'TRESCIENTOS CUARENTA Y SEIS con 00/100 Bs.', '2018-12-13 15:22:56', 11, 5, NULL),
	(8, '8', 525, 'QUINIENTOS VEINTICINCO con 00/100 Bs.', '2018-12-13 20:43:07', 11, 5, NULL),
	(9, '9', 509.5, 'QUINIENTOS NUEVE con 50 100 Bs.', '2018-12-13 22:15:09', 20, 5, NULL),
	(10, '10', 397, 'TRESCIENTOS NOVENTA Y SIETE con 00/100 Bs.', '2018-12-14 02:47:30', 32, 5, NULL),
	(11, '11', 2557, 'DOS  MIL QUINIENTOS CINCUENTA Y SIETE con 00/100 Bs.', '2018-12-14 02:47:55', 64, 5, NULL),
	(12, '12', 2769, 'DOS  MIL SETECIENTOS SESENTA Y NUEVE con 00/100 Bs.', '2018-12-14 02:48:19', 87, 5, NULL),
	(13, '13', 2924, 'DOS  MIL NOVECIENTOS VEINTICUATRO con 00/100 Bs.', '2018-12-14 02:48:47', 111, 5, NULL),
	(14, '14', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:51:32', 135, 5, NULL),
	(15, '15', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:51:46', 141, 5, NULL),
	(16, '16', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:51:59', 165, 5, NULL),
	(17, '17', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:52:13', 184, 5, NULL),
	(18, '18', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:52:26', 205, 5, NULL),
	(19, '19', 3329, 'TRES  MIL TRESCIENTOS VEINTINUEVE con 00/100 Bs.', '2018-12-14 02:52:41', 218, 5, NULL),
	(20, '20', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:53:15', 224, 5, NULL),
	(21, '21', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:53:26', 227, 5, NULL),
	(22, '22', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:53:40', 235, 5, NULL),
	(23, '23', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:53:57', 237, 5, NULL),
	(24, '24', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:54:09', 240, 5, NULL),
	(25, '25', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:54:22', 243, 5, NULL),
	(26, '26', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:54:34', 235, 5, NULL),
	(27, '27', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:54:48', 189, 5, NULL),
	(28, '28', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:55:01', 170, 5, NULL),
	(29, '29', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:55:15', 155, 5, NULL),
	(30, '30', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:55:33', 186, 5, NULL),
	(31, '31', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:56:23', 204, 5, NULL),
	(32, '32', 3636.1, 'TRES  MIL SEISCIENTOS TREINTA Y SEIS con 10 100 Bs.', '2018-12-14 02:56:35', 209, 5, NULL),
	(33, '33', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:57:17', 162, 5, NULL),
	(34, '34', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:57:28', 175, 5, NULL),
	(35, '35', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:57:40', 184, 5, NULL),
	(36, '36', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:57:52', 207, 5, NULL),
	(37, '37', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:58:02', 218, 5, NULL),
	(38, '38', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:58:13', 224, 5, NULL),
	(39, '39', 4492.7, 'CUATRO  MIL CUATROCIENTOS NOVENTA Y DOS con 70 100 Bs.', '2018-12-14 02:58:32', 245, 5, NULL);
/*!40000 ALTER TABLE `compra_r` ENABLE KEYS */;

-- Volcando estructura para procedimiento marketbbdd.detalleVentasPorRangoFechas
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `detalleVentasPorRangoFechas`(
	IN `fecha_a` DATE,
	IN `fecha_b` DATE


)
BEGIN
SELECT cl.nombre, cl.ci, id_compra, date(c.fecha) as fecha 
FROM  compra_r as c , cliente as cl
WHERE cl.id_cliente = c.id_cliente AND (c.fecha) BETWEEN fecha_a and fecha_b;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.detalle_venta
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `detalle_venta`(
	IN `id` int
)
BEGIN
SELECT p.nro_plu, p.nombre, p.precio, pe.peso_cantidad, pe.preciototal, p.idseccion  
FROM producto as p
INNER JOIN producto_etiquetado as pe ON p.id_prod = pe.id_prod
where pe.id_compra = id
ORDER BY p.idseccion;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.eliminarCliente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCliente`(
in id_c int
)
BEGIN
delete from cliente where id_cliente=id_c;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.eliminarProducto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarProducto`(
in id_p int
)
BEGIN
UPDATE producto set estado=0 where id_prod=id_p;
end//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.eliminarUsuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarUsuario`(
in id_u int
)
BEGIN
delete from usuario_login where id_usuario=id_u;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.existe_usuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `existe_usuario`(in usu varchar(100), out valor bool)
BEGIN
set valor =false;
if exists(select usuario from usuario_login where usuario=usu)
    
    then
        set valor= true;
    else 
        set valor = false;
    end if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.genera_plu
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `genera_plu`()
BEGIN
      SELECT IFNULL(MAX(nro_plu),0)+1  AS numero FROM producto;
    END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.insertarcliente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarcliente`(
in ci varchar(20),
in Nombre varchar(200)
)
BEGIN
insert into cliente(ci,nombre) values(ci,nombre);
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.insertarProducto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarProducto`(
IN nro_plu_p INT,
IN nombre_p VARCHAR(100),
IN tipo_p INT,
IN precio_p FLOAT,
IN cod_plu_p VARCHAR(200),
IN id_seccion BIGINT(11)
)
BEGIN
INSERT INTO producto (nro_plu,nombre,tipo,precio,cod_plu,fecha_registro,idseccion)VALUES(nro_plu_p,nombre_p,tipo_p,precio_p,cod_plu_p,NOW(),id_seccion);
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.insertarTiene
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarTiene`( in idp bigint, in ids bigint)
BEGIN
    insert into tiene values(ids,idp);  
    END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.insertarUsuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarUsuario`(
in Nombre varchar(200),
in fecha_registro datetime,
in Usuario varchar(100),
in contrasenia varchar(255),
in tipo int(11)
)
BEGIN
insert into usuario_login(nombre, fecha_registro, usuario, contrasenia, tipo) values(Nombre,fecha_registro,Usuario,contrasenia,tipo);
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.listar_seccion
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_seccion`()
BEGIN
      SELECT * FROM seccion where estado=1;
    END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.lista_clientes
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `lista_clientes`(
in cat bigint)
BEGIN
select * from cliente;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.lista_productos
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `lista_productos`()
BEGIN
select p.nro_plu, p.nombre as nombreuno ,p.tipo as tipo,p.precio,p.cod_plu, s.nombre as nombredos  from producto p, seccion s where idseccion=id_seccion order by p.nro_plu; 
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.modificarCliente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarCliente`(
in id_c int,
in ci varchar(20),
in Nombre varchar(200)
)
BEGIN
update cliente set nombre=Nombre, ci=ci where id_cliente=id_c;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.modificarUsuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarUsuario`(
in id_u int,
in Nombre varchar(200),
in fecha_reg datetime,
in Usuario varchar(100),
in contrasenia varchar(255),
in estado tinyint(1),
in tipo int(11)
)
BEGIN
update usuario_login set nombre=Nombre, fecha_registro=fecha_reg,usuario=Usuario,contrasenia=contrasenia,estado=estado,tipo=tipo where id_usuario=id_u;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.modificar_producto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_producto`(
in nombre_p varchar(100),
in precio_p float,
in tipo_p int,
in plu varchar(200),
in seccion bigint,
in id_p bigint
)
BEGIN
UPDATE producto set nombre=nombre_p, precio=precio_p, tipo=tipo_p, cod_plu=plu, idSeccion=seccion where id_prod=id_p;
end//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.Numeros_a_Letras
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `Numeros_a_Letras`(IN lnEntero TEXT)
BEGIN
DECLARE lcRetorno VARCHAR(512);
DECLARE lnTerna INT;
DECLARE lcMiles VARCHAR(512);
DECLARE lcCadena VARCHAR(512);
DECLARE lnUnidades INT;
DECLARE lnDecenas INT;
DECLARE lnCentenas INT;
IF lnEntero > 0 THEN
SET lcRetorno = '';
SET lnTerna = 1 ;
WHILE lnEntero > 0 DO
-- Recorro columna por columna
SET lcCadena = '';
SET lnUnidades = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;
SET lnDecenas = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;
SET lnCentenas = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;
-- Analizo las unidades
SET lcCadena =
CASE /* UNIDADES */
WHEN lnUnidades = 1 AND lnTerna = 1 THEN CONCAT('UNO ',lcCadena)
WHEN lnUnidades = 1 AND lnTerna <> 1 THEN CONCAT('',lcCadena)
WHEN lnUnidades = 2 THEN CONCAT('DOS ',lcCadena)
WHEN lnUnidades = 3 THEN CONCAT('TRES ',lcCadena)
WHEN lnUnidades = 4 THEN CONCAT('CUATRO ',lcCadena)
WHEN lnUnidades = 5 THEN CONCAT('CINCO ',lcCadena)
WHEN lnUnidades = 6 THEN CONCAT('SEIS ',lcCadena)
WHEN lnUnidades = 7 THEN CONCAT('SIETE ',lcCadena)
WHEN lnUnidades = 8 THEN CONCAT('OCHO ',lcCadena)
WHEN lnUnidades = 9 THEN CONCAT('NUEVE ',lcCadena)
ELSE lcCadena
END ;/* UNIDADES */
-- Analizo las decenas
SET lcCadena =
CASE /* DECENAS */
WHEN lnDecenas = 1 THEN
CASE lnUnidades
WHEN 0 THEN 'DIEZ '
WHEN 1 THEN 'ONCE '
WHEN 2 THEN 'DOCE '
WHEN 3 THEN 'TRECE '
WHEN 4 THEN 'CATORCE '
WHEN 5 THEN 'QUINCE '
ELSE CONCAT('DIECI',lcCadena)
END
WHEN lnDecenas = 2 AND lnUnidades = 0 THEN CONCAT('VEINTE ',lcCadena)
WHEN lnDecenas = 2 AND lnUnidades <> 0 THEN CONCAT('VEINTI',lcCadena)
WHEN lnDecenas = 3 AND lnUnidades = 0 THEN CONCAT('TREINTA ',lcCadena)
WHEN lnDecenas = 3 AND lnUnidades <> 0 THEN CONCAT('TREINTA Y ',lcCadena)
WHEN lnDecenas = 4 AND lnUnidades = 0 THEN CONCAT('CUARENTA ',lcCadena)
WHEN lnDecenas = 4 AND lnUnidades <> 0 THEN CONCAT('CUARENTA Y ',lcCadena)
WHEN lnDecenas = 5 AND lnUnidades = 0 THEN CONCAT('CINCUENTA ',lcCadena)
WHEN lnDecenas = 5 AND lnUnidades <> 0 THEN CONCAT('CINCUENTA Y ',lcCadena)
WHEN lnDecenas = 6 AND lnUnidades = 0 THEN CONCAT('SESENTA ',lcCadena)
WHEN lnDecenas = 6 AND lnUnidades <> 0 THEN CONCAT('SESENTA Y ',lcCadena)
WHEN lnDecenas = 7 AND lnUnidades = 0 THEN CONCAT('SETENTA ',lcCadena)
WHEN lnDecenas = 7 AND lnUnidades <> 0 THEN CONCAT('SETENTA Y ',lcCadena)
WHEN lnDecenas = 8 AND lnUnidades = 0 THEN CONCAT('OCHENTA ',lcCadena)
WHEN lnDecenas = 8 AND lnUnidades <> 0 THEN CONCAT('OCHENTA Y ',lcCadena)
WHEN lnDecenas = 9 AND lnUnidades = 0 THEN CONCAT('NOVENTA ',lcCadena)
WHEN lnDecenas = 9 AND lnUnidades <> 0 THEN CONCAT('NOVENTA Y ',lcCadena)
ELSE lcCadena
END ;/* DECENAS */
-- Analizo las centenas
SET lcCadena =
CASE /* CENTENAS */
WHEN lnCentenas = 1 AND lnUnidades = 0 AND lnDecenas = 0 THEN CONCAT('CIEN ',lcCadena)
WHEN lnCentenas = 1 AND NOT(lnUnidades = 0 AND lnDecenas = 0) THEN CONCAT('CIENTO ',lcCadena)
WHEN lnCentenas = 2 THEN CONCAT('DOSCIENTOS ',lcCadena)
WHEN lnCentenas = 3 THEN CONCAT('TRESCIENTOS ',lcCadena)
WHEN lnCentenas = 4 THEN CONCAT('CUATROCIENTOS ',lcCadena)
WHEN lnCentenas = 5 THEN CONCAT('QUINIENTOS ',lcCadena)
WHEN lnCentenas = 6 THEN CONCAT('SEISCIENTOS ',lcCadena)
WHEN lnCentenas = 7 THEN CONCAT('SETECIENTOS ',lcCadena)
WHEN lnCentenas = 8 THEN CONCAT('OCHOCIENTOS ',lcCadena)
WHEN lnCentenas = 9 THEN CONCAT('NOVECIENTOS ',lcCadena)
ELSE lcCadena
END ;/* CENTENAS */
-- Analizo los millares
SET lcCadena =
CASE /* TERNA */
WHEN lnTerna = 1 THEN lcCadena
WHEN lnTerna = 2 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL ')
WHEN lnTerna = 3 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' MILLON ')
WHEN lnTerna = 3 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' MILLONES ')
WHEN lnTerna = 4 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL MILLONES ')
WHEN lnTerna = 5 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' BILLON ')
WHEN lnTerna = 5 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' BILLONES ')
WHEN lnTerna = 6 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL BILLONES ')
WHEN lnTerna = 7 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' TRILLON ')
WHEN lnTerna = 7 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' TRILLONES ')
WHEN lnTerna = 8 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL TRILLONES ')
ELSE ''
END ;/* MILLARES */
-- Armo el retorno columna a columna
SET lcRetorno = CONCAT(lcCadena,lcRetorno);
SET lnTerna = lnTerna + 1;
END WHILE ; /* WHILE */
ELSE
SET lcRetorno = 'CERO' ;
END IF ;
SELECT RTRIM(lcRetorno) ;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.obtener_id_producto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_id_producto`( in nro_plu_F int)
BEGIN
       select id_prod from producto where nro_plu=nro_plu_F;
    END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id_prod` bigint(20) NOT NULL AUTO_INCREMENT,
  `nro_plu` int(11) NOT NULL COMMENT 'es el numero que esta registrado en la balanza',
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` int(11) NOT NULL COMMENT 'si es pesable 2 y si es unidad 1',
  `precio` float NOT NULL,
  `cod_plu` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_limite` bigint(11) DEFAULT NULL,
  `idseccion` bigint(20) NOT NULL,
  PRIMARY KEY (`id_prod`),
  UNIQUE KEY `nro_plu_UNIQUE` (`nro_plu`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `cod_plu_UNIQUE` (`cod_plu`),
  KEY `fk_producto_seccion1_idx` (`idseccion`),
  CONSTRAINT `fk_producto_seccion1` FOREIGN KEY (`idseccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla marketbbdd.producto: ~105 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id_prod`, `nro_plu`, `nombre`, `tipo`, `precio`, `cod_plu`, `estado`, `fecha_registro`, `fecha_actualizacion`, `id_limite`, `idseccion`) VALUES
	(1, 1, 'filete', 2, 50, '2001', 1, '2018-11-28 11:49:31', '2018-11-28 11:49:31', NULL, 1),
	(2, 2, 'pulpa', 2, 48, '2002', 1, '2018-11-28 11:51:39', '2018-11-28 11:51:39', NULL, 1),
	(3, 3, 'cabeza de lomo', 2, 48, '2003', 1, '2018-11-28 18:42:13', '2018-11-28 18:42:13', NULL, 1),
	(4, 4, 'peceto', 2, 42, '2004', 1, '2018-11-28 18:43:06', '2018-11-28 18:43:06', NULL, 1),
	(5, 5, 'corte pescadito', 2, 38, '2005', 1, '2018-11-28 18:43:31', '2018-11-28 18:43:31', NULL, 1),
	(6, 6, 'molida', 2, 38, '2006', 1, '2018-11-28 18:44:39', '2018-11-28 18:44:39', NULL, 1),
	(7, 7, 'albondiga', 2, 26, '2007', 1, '2018-11-28 18:45:05', '2018-11-28 18:45:05', NULL, 1),
	(8, 8, 'milaneza de carne', 1, 28, '1008', 1, '2018-11-28 18:45:51', '2018-11-28 18:45:51', NULL, 1),
	(9, 9, 'lapimg', 2, 36, '2009', 1, '2018-11-28 18:46:16', '2018-11-28 18:46:16', NULL, 1),
	(10, 10, 'chuleta', 2, 43, '2010', 1, '2018-11-28 18:47:11', '2018-11-28 18:47:11', NULL, 1),
	(11, 11, 'witu', 2, 36, '2011', 1, '2018-11-28 19:06:40', '2018-11-28 19:06:40', NULL, 1),
	(12, 12, 'churrasco', 2, 36, '2012', 1, '2018-11-28 19:07:10', '2018-11-28 19:07:10', NULL, 1),
	(13, 13, 'cadera', 2, 36, '2013', 1, '2018-11-28 19:07:38', '2018-11-28 19:07:38', NULL, 1),
	(14, 14, 'paleta', 2, 36, '2014', 1, '2018-11-28 19:08:16', '2018-11-28 19:08:16', NULL, 1),
	(15, 15, 'pecho', 2, 30, '2015', 1, '2018-11-28 19:08:45', '2018-11-28 19:08:45', NULL, 1),
	(16, 16, 'jiba', 2, 30, '2016', 1, '2018-11-28 19:09:19', '2018-11-28 19:09:19', NULL, 1),
	(17, 17, 'aujilla', 2, 34, '2017', 1, '2018-11-28 19:09:54', '2018-11-28 19:09:54', NULL, 1),
	(18, 18, 'tira/costilla', 2, 34, '2018', 1, '2018-11-28 19:10:22', '2018-11-28 19:10:22', NULL, 1),
	(19, 19, 'ozubuco', 2, 28, '2019', 1, '2018-11-28 19:10:44', '2018-11-28 19:10:44', NULL, 1),
	(20, 20, 'janara', 2, 42, '2020', 1, '2018-11-28 19:11:26', '2018-11-28 19:11:26', NULL, 1),
	(21, 21, 'chorizo', 2, 36, '2021', 1, '2018-11-28 19:12:09', '2018-11-28 19:12:09', NULL, 1),
	(22, 22, 'corazon', 2, 30, '2022', 1, '2018-11-28 19:12:56', '2018-11-28 19:12:56', NULL, 1),
	(23, 23, 'higado', 2, 22, '2023', 1, '2018-11-28 19:14:12', '2018-11-28 19:14:12', NULL, 1),
	(24, 24, 'panza cocida', 2, 32, '2024', 1, '2018-11-28 19:14:43', '2018-11-28 19:14:43', NULL, 1),
	(25, 25, 'hamburguesa de res peque', 1, 7, '1025', 1, '2018-11-28 19:15:47', '2018-11-28 19:15:47', NULL, 1),
	(26, 26, 'silpancho de res', 1, 34, '1026', 1, '2018-11-28 19:16:18', '2018-11-28 19:16:18', NULL, 1),
	(27, 27, 'huevo25', 1, 0.85, '1027', 0, '2018-11-28 19:17:47', '2018-11-28 19:17:47', NULL, 1),
	(28, 28, 'huevo22', 1, 0.75, '1028', 0, '2018-11-28 19:18:13', '2018-11-28 19:18:13', NULL, 1),
	(29, 29, 'pollo', 2, 17, '2029', 1, '2018-11-28 19:36:09', '2018-11-28 19:36:09', NULL, 2),
	(30, 30, 'pierna de pollo', 2, 15, '2030', 1, '2018-11-28 19:36:42', '2018-11-28 19:36:42', NULL, 2),
	(31, 31, 'alas de pollo', 2, 15, '2031', 1, '2018-11-28 19:37:48', '2018-11-28 19:37:48', NULL, 2),
	(32, 32, 'pecho de pollo', 2, 15, '2032', 1, '2018-11-28 19:38:22', '2018-11-28 19:38:22', NULL, 2),
	(33, 33, 'pescado trucha', 2, 60, '2033', 1, '2018-11-28 19:39:05', '2018-11-28 19:39:05', NULL, 2),
	(34, 34, 'pescado pacu', 2, 50, '2034', 1, '2018-11-28 19:39:35', '2018-11-28 19:39:35', NULL, 2),
	(35, 35, 'pescado surubi', 2, 50, '2035', 1, '2018-11-28 19:40:00', '2018-11-28 19:40:00', NULL, 2),
	(36, 36, 'zanahoria', 2, 5, '2036', 1, '2018-11-28 19:42:30', '2018-11-28 19:42:30', NULL, 3),
	(37, 37, 'haba', 2, 7, '2037', 1, '2018-11-28 19:43:16', '2018-11-28 19:43:16', NULL, 3),
	(38, 38, 'zapallo', 2, 6.5, '2038', 1, '2018-11-28 19:43:48', '2018-11-28 19:43:48', NULL, 3),
	(39, 39, 'cebolla con cola', 2, 4.5, '2039', 1, '2018-11-28 19:45:05', '2018-11-28 19:45:05', NULL, 3),
	(40, 40, 'cebolla/cabeza', 2, 5, '2040', 1, '2018-11-28 19:45:28', '2018-11-28 19:45:28', NULL, 3),
	(41, 41, 'tomate', 2, 9, '2041', 1, '2018-11-28 19:46:05', '2018-11-28 19:46:05', NULL, 3),
	(42, 42, 'achojcha', 2, 12, '2042', 1, '2018-11-28 19:47:52', '2018-11-28 19:47:52', NULL, 3),
	(43, 43, 'remolacha', 2, 4.5, '2043', 1, '2018-11-28 19:48:30', '2018-11-28 19:48:30', NULL, 3),
	(44, 44, 'vainita', 2, 9, '2044', 1, '2018-11-28 19:49:01', '2018-11-28 19:49:01', NULL, 3),
	(45, 45, 'arveja', 2, 8.9, '2045', 1, '2018-11-28 19:57:28', '2018-11-28 19:57:28', NULL, 3),
	(46, 46, 'perejil', 1, 2.5, '1046', 1, '2018-11-28 19:57:54', '2018-11-28 19:57:54', NULL, 3),
	(47, 47, 'espinaca', 2, 12.7, '2047', 1, '2018-11-28 19:58:26', '2018-11-28 19:58:26', NULL, 3),
	(48, 48, 'brocoli', 1, 5, '1048', 1, '2018-11-28 19:58:58', '2018-11-28 19:58:58', NULL, 3),
	(49, 49, 'apio', 1, 2.5, '1049', 1, '2018-11-28 19:59:25', '2018-11-28 19:59:25', NULL, 3),
	(50, 50, 'acelga', 1, 2.5, '1050', 1, '2018-11-28 19:59:55', '2018-11-28 19:59:55', NULL, 3),
	(51, 51, 'repollo pequeÃ±o', 1, 2.5, '1051', 1, '2018-11-28 20:00:23', '2018-11-28 20:00:23', NULL, 3),
	(52, 52, 'coliflor', 1, 3, '1052', 1, '2018-11-28 20:01:22', '2018-11-28 20:01:22', NULL, 3),
	(53, 53, 'berro', 1, 5, '1053', 1, '2018-11-28 20:01:53', '2018-11-28 20:01:53', NULL, 3),
	(54, 54, 'pepino', 1, 5, '1054', 1, '2018-11-28 20:02:25', '2018-11-28 20:02:25', NULL, 3),
	(55, 55, 'berenjena', 1, 5, '1055', 1, '2018-11-28 20:02:48', '2018-11-28 20:02:48', NULL, 3),
	(56, 56, 'pimenton', 1, 5, '1056', 1, '2018-11-28 20:03:14', '2018-11-28 20:03:14', NULL, 3),
	(57, 57, 'platano de freir', 1, 1.5, '1057', 1, '2018-11-28 20:03:49', '2018-11-28 20:03:49', NULL, 3),
	(58, 58, 'yuca', 2, 8.9, '2058', 1, '2018-11-28 20:07:28', '2018-11-28 20:07:28', NULL, 4),
	(59, 59, 'camote', 2, 7.9, '2059', 1, '2018-11-28 20:07:53', '2018-11-28 20:07:53', NULL, 4),
	(60, 60, 'papa grande', 2, 5.5, '2060', 1, '2018-11-28 20:08:33', '2018-11-28 20:08:33', NULL, 4),
	(61, 61, 'papa pequeÃƒÂ±a', 2, 5, '2061', 1, '2018-11-28 20:11:03', '2018-11-28 20:11:03', NULL, 4),
	(62, 62, 'papa holandesa', 2, 6, '2062', 1, '2018-11-28 20:12:03', '2018-11-28 20:12:03', NULL, 4),
	(63, 63, 'papaliza', 2, 4, '2063', 1, '2018-11-28 20:12:25', '2018-11-28 20:12:25', NULL, 4),
	(64, 64, 'papa morada', 2, 4.5, '2064', 1, '2018-11-28 20:12:53', '2018-11-28 20:12:53', NULL, 4),
	(65, 65, 'durazno', 1, 10, '1065', 1, '2018-11-28 20:15:24', '2018-11-28 20:15:24', NULL, 5),
	(66, 66, 'uva', 2, 25, '2066', 1, '2018-11-28 20:16:06', '2018-11-28 20:16:06', NULL, 5),
	(67, 67, 'frutilla', 1, 7, '1067', 1, '2018-11-28 20:16:41', '2018-11-28 20:16:41', NULL, 5),
	(68, 68, 'achachairu', 1, 1, '1068', 1, '2018-11-28 20:17:22', '2018-11-28 20:17:22', NULL, 5),
	(69, 69, 'asai', 1, 1, '1069', 1, '2018-11-28 20:17:45', '2018-11-28 20:17:45', NULL, 5),
	(70, 70, 'sandia grande', 1, 13, '1070', 1, '2018-11-28 20:19:01', '2018-11-28 20:19:01', NULL, 5),
	(71, 71, 'chirimoya', 1, 1, '1071', 1, '2018-11-28 20:19:24', '2018-11-28 20:19:24', NULL, 5),
	(72, 72, 'mango grande', 1, 1.5, '1072', 1, '2018-11-28 20:19:55', '2018-11-28 20:19:55', NULL, 5),
	(73, 73, 'papaya grande', 1, 13, '1073', 1, '2018-11-28 20:20:25', '2018-11-28 20:20:25', NULL, 5),
	(74, 74, 'pera', 1, 1, '1074', 1, '2018-11-28 20:20:52', '2018-11-28 20:20:52', NULL, 5),
	(75, 75, 'tuna', 1, 1, '1075', 1, '2018-11-28 20:21:22', '2018-11-28 20:21:22', NULL, 5),
	(76, 76, 'pomelo', 1, 1, '1076', 1, '2018-11-28 20:21:41', '2018-11-28 20:21:41', NULL, 5),
	(77, 77, 'granada', 1, 1, '1077', 1, '2018-11-28 20:22:02', '2018-11-28 20:22:02', NULL, 5),
	(78, 78, 'guayaba', 1, 1, '1078', 1, '2018-11-28 20:22:28', '2018-11-28 20:22:28', NULL, 5),
	(79, 79, 'lima', 1, 1, '1079', 1, '2018-11-28 20:22:49', '2018-11-28 20:22:49', NULL, 5),
	(80, 80, 'ciruelo', 1, 5, '1080', 1, '2018-11-28 20:23:04', '2018-11-28 20:23:04', NULL, 5),
	(81, 81, 'palta', 1, 7.5, '1081', 1, '2018-11-28 20:23:28', '2018-11-28 20:23:28', NULL, 5),
	(82, 82, 'menbrillo', 1, 1, '1082', 1, '2018-11-28 20:23:52', '2018-11-28 20:23:52', NULL, 5),
	(83, 83, 'maracuya', 1, 1, '1083', 1, '2018-11-28 20:24:10', '2018-11-28 20:24:10', NULL, 5),
	(84, 84, 'mandarina', 1, 1, '1084', 1, '2018-11-28 20:24:32', '2018-11-28 20:24:32', NULL, 5),
	(85, 85, 'melon', 1, 1, '1085', 1, '2018-11-28 20:25:03', '2018-11-28 20:25:03', NULL, 5),
	(86, 86, 'higo', 1, 1, '1086', 1, '2018-11-28 20:25:24', '2018-11-28 20:25:24', NULL, 5),
	(87, 87, 'platano', 1, 0.7, '1087', 1, '2018-11-28 20:25:40', '2018-11-28 20:25:40', NULL, 5),
	(88, 88, 'manzana', 1, 1.5, '1088', 1, '2018-11-28 20:26:23', '2018-11-28 20:26:23', NULL, 5),
	(89, 89, 'piÃƒÂ±a grande', 1, 10, '1089', 1, '2018-11-28 20:26:53', '2018-11-28 20:26:53', NULL, 5),
	(90, 90, 'copoazu', 1, 1, '1090', 1, '2018-11-28 20:27:17', '2018-11-28 20:27:17', NULL, 5),
	(91, 91, 'durazno (oregon)', 2, 1, '2091', 1, '2018-11-28 20:27:55', '2018-11-28 20:27:55', NULL, 5),
	(92, 92, 'limon', 1, 0.6, '1092', 1, '2018-11-28 20:28:19', '2018-11-28 20:28:19', NULL, 5),
	(93, 93, 'naranja', 1, 0.6, '1093', 1, '2018-11-28 20:28:47', '2018-11-28 20:28:47', NULL, 5),
	(94, 94, 'mango pequeÃƒÂ±o', 1, 0.8, '1094', 1, '2018-11-28 20:29:22', '2018-11-28 20:29:22', NULL, 5),
	(95, 95, 'riÃƒÂ±on', 1, 18, '1095', 1, '2018-12-03 19:17:03', '2018-12-03 19:17:03', NULL, 1),
	(96, 96, 'cola', 2, 36, '2096', 1, '2018-12-03 19:17:35', '2018-12-03 19:17:35', NULL, 1),
	(97, 97, 'pescado ispi', 2, 45, '2097', 1, '2018-12-03 19:21:27', '2018-12-03 19:21:27', NULL, 2),
	(98, 98, 'hamburguesa de res grande', 1, 29, '1098', 1, '2018-12-03 19:24:22', '2018-12-03 19:24:22', NULL, 1),
	(101, 99, 'repollo grande', 1, 5, '1099', 1, '2018-12-03 19:50:48', '2018-12-03 19:50:48', NULL, 3),
	(102, 100, 'sandia mediana', 1, 10, '1100', 1, '2018-12-03 20:08:57', '2018-12-03 20:08:57', NULL, 5),
	(103, 101, 'sandia pequeÃƒÂ±a', 1, 8, '1101', 1, '2018-12-03 20:09:16', '2018-12-03 20:09:16', NULL, 5),
	(104, 102, 'mango mediano', 1, 1, '1102', 1, '2018-12-03 20:11:07', '2018-12-03 20:11:07', NULL, 5),
	(107, 103, 'papaya mediano', 1, 10, '1103', 1, '2018-12-03 20:13:35', '2018-12-03 20:13:35', NULL, 5),
	(108, 104, 'papaya pequeÃƒÂ±o', 1, 8, '1104', 1, '2018-12-03 20:13:59', '2018-12-03 20:13:59', NULL, 5),
	(109, 105, 'piÃƒÂ±a pequeÃƒÂ±o', 1, 7, '1105', 1, '2018-12-03 20:17:26', '2018-12-03 20:17:26', NULL, 5);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para procedimiento marketbbdd.producto_categoria
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_categoria`(
in cat bigint)
BEGIN
select * from producto where id_cat=cat;
END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.producto_etiquetado
CREATE TABLE IF NOT EXISTS `producto_etiquetado` (
  `id_etiqueta` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_barras` bigint(11) NOT NULL COMMENT 'codigo de barras generado por productos etiquetados',
  `preciototal` float NOT NULL COMMENT 'precio deacurdo al peso o cantidad del producto',
  `peso_cantidad` float NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'estado si se vendio o no',
  `id_prod` bigint(20) DEFAULT NULL,
  `id_compra` bigint(20) DEFAULT NULL COMMENT 'aqui esta el id de la compra si es que se vende este producto',
  PRIMARY KEY (`id_etiqueta`),
  KEY `FK_PROD_DET` (`id_prod`),
  KEY `FK_COMPRA_DET` (`id_compra`),
  CONSTRAINT `FK_COMPRA_DET` FOREIGN KEY (`id_compra`) REFERENCES `compra_r` (`id_compra`),
  CONSTRAINT `FK_PROD_DET` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla marketbbdd.producto_etiquetado: ~32 rows (aproximadamente)
/*!40000 ALTER TABLE `producto_etiquetado` DISABLE KEYS */;
INSERT INTO `producto_etiquetado` (`id_etiqueta`, `cod_barras`, `preciototal`, `peso_cantidad`, `estado`, `id_prod`, `id_compra`) VALUES
	(40, 2002, 144, 3, 1, 2, 1),
	(41, 1051, 10, 4, 1, 51, 1),
	(42, 1100, 70, 7, 1, 102, 2),
	(43, 2001, 4450, 89, 1, 1, 2),
	(44, 2004, 1890, 45, 1, 4, 3),
	(45, 2002, 96, 2, 1, 2, 3),
	(46, 2002, 96, 2, 1, 2, 4),
	(47, 2002, 96, 2, 1, 2, 5),
	(48, 2002, 96, 2, 1, 2, 5),
	(49, 2006, 38, 1, 1, 6, 5),
	(50, 2002, 96, 2, 1, 2, 6),
	(51, 2002, 96, 2, 1, 2, 6),
	(52, 2006, 38, 1, 1, 6, 6),
	(53, 2002, 336, 7, 1, 2, 7),
	(54, 1099, 10, 2, 1, 101, 7),
	(55, 2002, 96, 2, 1, 2, 8),
	(56, 2001, 100, 2, 1, 1, 8),
	(57, 2030, 45, 3, 1, 30, 8),
	(58, 2003, 144, 3, 1, 3, 8),
	(59, 1053, 15, 3, 1, 53, 8),
	(60, 1073, 39, 3, 1, 73, 8),
	(61, 2063, 12, 3, 1, 63, 8),
	(62, 1100, 20, 2, 1, 102, 8),
	(63, 1102, 2, 2, 1, 104, 8),
	(64, 2007, 52, 2, 1, 7, 8),
	(65, 2004, 168, 4, 1, 4, 9),
	(66, 2043, 18, 4, 1, 43, 9),
	(67, 1075, 45, 45, 1, 75, 9),
	(68, 1072, 7.5, 5, 1, 72, 9),
	(69, 2033, 240, 4, 1, 33, 9),
	(70, 2060, 22, 4, 1, 60, 9),
	(71, 2064, 9, 2, 1, 64, 9),
	(72, 2003, 240, 5, 1, 3, 10),
	(73, 2005, 152, 4, 1, 5, 10),
	(74, 1079, 5, 5, 1, 79, 10),
	(75, 2003, 240, 5, 1, 3, 11),
	(76, 2005, 152, 4, 1, 5, 11),
	(77, 1079, 5, 5, 1, 79, 11),
	(78, 2003, 2160, 45, 1, 3, 11),
	(79, 2003, 240, 5, 1, 3, 12),
	(80, 2005, 152, 4, 1, 5, 12),
	(81, 1079, 5, 5, 1, 79, 12),
	(82, 2003, 2160, 45, 1, 3, 12),
	(83, 1101, 32, 4, 1, 103, 12),
	(84, 2097, 180, 4, 1, 97, 12),
	(85, 2003, 240, 5, 1, 3, 13),
	(86, 2005, 152, 4, 1, 5, 13),
	(87, 1079, 5, 5, 1, 79, 13),
	(88, 2003, 2160, 45, 1, 3, 13),
	(89, 1101, 32, 4, 1, 103, 13),
	(90, 2097, 180, 4, 1, 97, 13),
	(91, 1089, 50, 5, 1, 89, 13),
	(92, 1073, 65, 5, 1, 73, 13),
	(93, 1104, 40, 5, 1, 108, 13),
	(94, 2003, 240, 5, 1, 3, 14),
	(95, 2005, 152, 4, 1, 5, 14),
	(96, 1079, 5, 5, 1, 79, 14),
	(97, 2003, 2160, 45, 1, 3, 14),
	(98, 1101, 32, 4, 1, 103, 14),
	(99, 2097, 180, 4, 1, 97, 14),
	(100, 1089, 50, 5, 1, 89, 14),
	(101, 1073, 65, 5, 1, 73, 14),
	(102, 1104, 40, 5, 1, 108, 14),
	(103, 2097, 225, 5, 1, 97, 14),
	(104, 2022, 180, 6, 1, 22, 14),
	(105, 2003, 240, 5, 1, 3, 15),
	(106, 2005, 152, 4, 1, 5, 15),
	(107, 1079, 5, 5, 1, 79, 15),
	(108, 2003, 2160, 45, 1, 3, 15),
	(109, 1101, 32, 4, 1, 103, 15),
	(110, 2097, 180, 4, 1, 97, 15),
	(111, 1089, 50, 5, 1, 89, 15),
	(112, 1073, 65, 5, 1, 73, 15),
	(113, 1104, 40, 5, 1, 108, 15),
	(114, 2097, 225, 5, 1, 97, 15),
	(115, 2022, 180, 6, 1, 22, 15),
	(116, 2003, 240, 5, 1, 3, 16),
	(117, 2005, 152, 4, 1, 5, 16),
	(118, 1079, 5, 5, 1, 79, 16),
	(119, 2003, 2160, 45, 1, 3, 16),
	(120, 1101, 32, 4, 1, 103, 16),
	(121, 2097, 180, 4, 1, 97, 16),
	(122, 1089, 50, 5, 1, 89, 16),
	(123, 1073, 65, 5, 1, 73, 16),
	(124, 1104, 40, 5, 1, 108, 16),
	(125, 2097, 225, 5, 1, 97, 16),
	(126, 2022, 180, 6, 1, 22, 16),
	(127, 2003, 240, 5, 1, 3, 17),
	(128, 2005, 152, 4, 1, 5, 17),
	(129, 1079, 5, 5, 1, 79, 17),
	(130, 2003, 2160, 45, 1, 3, 17),
	(131, 1101, 32, 4, 1, 103, 17),
	(132, 2097, 180, 4, 1, 97, 17),
	(133, 1089, 50, 5, 1, 89, 17),
	(134, 1073, 65, 5, 1, 73, 17),
	(135, 1104, 40, 5, 1, 108, 17),
	(136, 2097, 225, 5, 1, 97, 17),
	(137, 2022, 180, 6, 1, 22, 17),
	(138, 2003, 240, 5, 1, 3, 18),
	(139, 2005, 152, 4, 1, 5, 18),
	(140, 1079, 5, 5, 1, 79, 18),
	(141, 2003, 2160, 45, 1, 3, 18),
	(142, 1101, 32, 4, 1, 103, 18),
	(143, 2097, 180, 4, 1, 97, 18),
	(144, 1089, 50, 5, 1, 89, 18),
	(145, 1073, 65, 5, 1, 73, 18),
	(146, 1104, 40, 5, 1, 108, 18),
	(147, 2097, 225, 5, 1, 97, 18),
	(148, 2022, 180, 6, 1, 22, 18),
	(149, 2003, 240, 5, 1, 3, 19),
	(150, 2005, 152, 4, 1, 5, 19),
	(151, 1079, 5, 5, 1, 79, 19),
	(152, 2003, 2160, 45, 1, 3, 19),
	(153, 1101, 32, 4, 1, 103, 19),
	(154, 2097, 180, 4, 1, 97, 19),
	(155, 1089, 50, 5, 1, 89, 19),
	(156, 1073, 65, 5, 1, 73, 19),
	(157, 1104, 40, 5, 1, 108, 19),
	(158, 2097, 225, 5, 1, 97, 19),
	(159, 2022, 180, 6, 1, 22, 19),
	(160, 2003, 240, 5, 1, 3, 20),
	(161, 2005, 152, 4, 1, 5, 20),
	(162, 1079, 5, 5, 1, 79, 20),
	(163, 2003, 2160, 45, 1, 3, 20),
	(164, 1101, 32, 4, 1, 103, 20),
	(165, 2097, 180, 4, 1, 97, 20),
	(166, 1089, 50, 5, 1, 89, 20),
	(167, 1073, 65, 5, 1, 73, 20),
	(168, 1104, 40, 5, 1, 108, 20),
	(169, 2097, 225, 5, 1, 97, 20),
	(170, 2022, 180, 6, 1, 22, 20),
	(171, 2058, 44.5, 5, 1, 58, 20),
	(172, 2035, 200, 4, 1, 35, 20),
	(173, 2045, 35.6, 4, 1, 45, 20),
	(174, 2039, 27, 6, 1, 39, 20),
	(175, 2003, 240, 5, 1, 3, 21),
	(176, 2005, 152, 4, 1, 5, 21),
	(177, 1079, 5, 5, 1, 79, 21),
	(178, 2003, 2160, 45, 1, 3, 21),
	(179, 1101, 32, 4, 1, 103, 21),
	(180, 2097, 180, 4, 1, 97, 21),
	(181, 1089, 50, 5, 1, 89, 21),
	(182, 1073, 65, 5, 1, 73, 21),
	(183, 1104, 40, 5, 1, 108, 21),
	(184, 2097, 225, 5, 1, 97, 21),
	(185, 2022, 180, 6, 1, 22, 21),
	(186, 2058, 44.5, 5, 1, 58, 21),
	(187, 2035, 200, 4, 1, 35, 21),
	(188, 2045, 35.6, 4, 1, 45, 21),
	(189, 2039, 27, 6, 1, 39, 21),
	(190, 2003, 240, 5, 1, 3, 22),
	(191, 2005, 152, 4, 1, 5, 22),
	(192, 1079, 5, 5, 1, 79, 22),
	(193, 2003, 2160, 45, 1, 3, 22),
	(194, 1101, 32, 4, 1, 103, 22),
	(195, 2097, 180, 4, 1, 97, 22),
	(196, 1089, 50, 5, 1, 89, 22),
	(197, 1073, 65, 5, 1, 73, 22),
	(198, 1104, 40, 5, 1, 108, 22),
	(199, 2097, 225, 5, 1, 97, 22),
	(200, 2022, 180, 6, 1, 22, 22),
	(201, 2058, 44.5, 5, 1, 58, 22),
	(202, 2035, 200, 4, 1, 35, 22),
	(203, 2045, 35.6, 4, 1, 45, 22),
	(204, 2039, 27, 6, 1, 39, 22),
	(205, 2003, 240, 5, 1, 3, 23),
	(206, 2005, 152, 4, 1, 5, 23),
	(207, 1079, 5, 5, 1, 79, 23),
	(208, 2003, 2160, 45, 1, 3, 23),
	(209, 1101, 32, 4, 1, 103, 23),
	(210, 2097, 180, 4, 1, 97, 23),
	(211, 1089, 50, 5, 1, 89, 23),
	(212, 1073, 65, 5, 1, 73, 23),
	(213, 1104, 40, 5, 1, 108, 23),
	(214, 2097, 225, 5, 1, 97, 23),
	(215, 2022, 180, 6, 1, 22, 23),
	(216, 2058, 44.5, 5, 1, 58, 23),
	(217, 2035, 200, 4, 1, 35, 23),
	(218, 2045, 35.6, 4, 1, 45, 23),
	(219, 2039, 27, 6, 1, 39, 23),
	(220, 2003, 240, 5, 1, 3, 24),
	(221, 2005, 152, 4, 1, 5, 24),
	(222, 1079, 5, 5, 1, 79, 24),
	(223, 2003, 2160, 45, 1, 3, 24),
	(224, 1101, 32, 4, 1, 103, 24),
	(225, 2097, 180, 4, 1, 97, 24),
	(226, 1089, 50, 5, 1, 89, 24),
	(227, 1073, 65, 5, 1, 73, 24),
	(228, 1104, 40, 5, 1, 108, 24),
	(229, 2097, 225, 5, 1, 97, 24),
	(230, 2022, 180, 6, 1, 22, 24),
	(231, 2058, 44.5, 5, 1, 58, 24),
	(232, 2035, 200, 4, 1, 35, 24),
	(233, 2045, 35.6, 4, 1, 45, 24),
	(234, 2039, 27, 6, 1, 39, 24),
	(235, 2003, 240, 5, 1, 3, 25),
	(236, 2005, 152, 4, 1, 5, 25),
	(237, 1079, 5, 5, 1, 79, 25),
	(238, 2003, 2160, 45, 1, 3, 25),
	(239, 1101, 32, 4, 1, 103, 25),
	(240, 2097, 180, 4, 1, 97, 25),
	(241, 1089, 50, 5, 1, 89, 25),
	(242, 1073, 65, 5, 1, 73, 25),
	(243, 1104, 40, 5, 1, 108, 25),
	(244, 2097, 225, 5, 1, 97, 25),
	(245, 2022, 180, 6, 1, 22, 25),
	(246, 2058, 44.5, 5, 1, 58, 25),
	(247, 2035, 200, 4, 1, 35, 25),
	(248, 2045, 35.6, 4, 1, 45, 25),
	(249, 2039, 27, 6, 1, 39, 25),
	(250, 2003, 240, 5, 1, 3, 26),
	(251, 2005, 152, 4, 1, 5, 26),
	(252, 1079, 5, 5, 1, 79, 26),
	(253, 2003, 2160, 45, 1, 3, 26),
	(254, 1101, 32, 4, 1, 103, 26),
	(255, 2097, 180, 4, 1, 97, 26),
	(256, 1089, 50, 5, 1, 89, 26),
	(257, 1073, 65, 5, 1, 73, 26),
	(258, 1104, 40, 5, 1, 108, 26),
	(259, 2097, 225, 5, 1, 97, 26),
	(260, 2022, 180, 6, 1, 22, 26),
	(261, 2058, 44.5, 5, 1, 58, 26),
	(262, 2035, 200, 4, 1, 35, 26),
	(263, 2045, 35.6, 4, 1, 45, 26),
	(264, 2039, 27, 6, 1, 39, 26),
	(265, 2003, 240, 5, 1, 3, 27),
	(266, 2005, 152, 4, 1, 5, 27),
	(267, 1079, 5, 5, 1, 79, 27),
	(268, 2003, 2160, 45, 1, 3, 27),
	(269, 1101, 32, 4, 1, 103, 27),
	(270, 2097, 180, 4, 1, 97, 27),
	(271, 1089, 50, 5, 1, 89, 27),
	(272, 1073, 65, 5, 1, 73, 27),
	(273, 1104, 40, 5, 1, 108, 27),
	(274, 2097, 225, 5, 1, 97, 27),
	(275, 2022, 180, 6, 1, 22, 27),
	(276, 2058, 44.5, 5, 1, 58, 27),
	(277, 2035, 200, 4, 1, 35, 27),
	(278, 2045, 35.6, 4, 1, 45, 27),
	(279, 2039, 27, 6, 1, 39, 27),
	(280, 2003, 240, 5, 1, 3, 28),
	(281, 2005, 152, 4, 1, 5, 28),
	(282, 1079, 5, 5, 1, 79, 28),
	(283, 2003, 2160, 45, 1, 3, 28),
	(284, 1101, 32, 4, 1, 103, 28),
	(285, 2097, 180, 4, 1, 97, 28),
	(286, 1089, 50, 5, 1, 89, 28),
	(287, 1073, 65, 5, 1, 73, 28),
	(288, 1104, 40, 5, 1, 108, 28),
	(289, 2097, 225, 5, 1, 97, 28),
	(290, 2022, 180, 6, 1, 22, 28),
	(291, 2058, 44.5, 5, 1, 58, 28),
	(292, 2035, 200, 4, 1, 35, 28),
	(293, 2045, 35.6, 4, 1, 45, 28),
	(294, 2039, 27, 6, 1, 39, 28),
	(295, 2003, 240, 5, 1, 3, 29),
	(296, 2005, 152, 4, 1, 5, 29),
	(297, 1079, 5, 5, 1, 79, 29),
	(298, 2003, 2160, 45, 1, 3, 29),
	(299, 1101, 32, 4, 1, 103, 29),
	(300, 2097, 180, 4, 1, 97, 29),
	(301, 1089, 50, 5, 1, 89, 29),
	(302, 1073, 65, 5, 1, 73, 29),
	(303, 1104, 40, 5, 1, 108, 29),
	(304, 2097, 225, 5, 1, 97, 29),
	(305, 2022, 180, 6, 1, 22, 29),
	(306, 2058, 44.5, 5, 1, 58, 29),
	(307, 2035, 200, 4, 1, 35, 29),
	(308, 2045, 35.6, 4, 1, 45, 29),
	(309, 2039, 27, 6, 1, 39, 29),
	(310, 2003, 240, 5, 1, 3, 30),
	(311, 2005, 152, 4, 1, 5, 30),
	(312, 1079, 5, 5, 1, 79, 30),
	(313, 2003, 2160, 45, 1, 3, 30),
	(314, 1101, 32, 4, 1, 103, 30),
	(315, 2097, 180, 4, 1, 97, 30),
	(316, 1089, 50, 5, 1, 89, 30),
	(317, 1073, 65, 5, 1, 73, 30),
	(318, 1104, 40, 5, 1, 108, 30),
	(319, 2097, 225, 5, 1, 97, 30),
	(320, 2022, 180, 6, 1, 22, 30),
	(321, 2058, 44.5, 5, 1, 58, 30),
	(322, 2035, 200, 4, 1, 35, 30),
	(323, 2045, 35.6, 4, 1, 45, 30),
	(324, 2039, 27, 6, 1, 39, 30),
	(325, 2003, 240, 5, 1, 3, 31),
	(326, 2005, 152, 4, 1, 5, 31),
	(327, 1079, 5, 5, 1, 79, 31),
	(328, 2003, 2160, 45, 1, 3, 31),
	(329, 1101, 32, 4, 1, 103, 31),
	(330, 2097, 180, 4, 1, 97, 31),
	(331, 1089, 50, 5, 1, 89, 31),
	(332, 1073, 65, 5, 1, 73, 31),
	(333, 1104, 40, 5, 1, 108, 31),
	(334, 2097, 225, 5, 1, 97, 31),
	(335, 2022, 180, 6, 1, 22, 31),
	(336, 2058, 44.5, 5, 1, 58, 31),
	(337, 2035, 200, 4, 1, 35, 31),
	(338, 2045, 35.6, 4, 1, 45, 31),
	(339, 2039, 27, 6, 1, 39, 31),
	(340, 2003, 240, 5, 1, 3, 32),
	(341, 2005, 152, 4, 1, 5, 32),
	(342, 1079, 5, 5, 1, 79, 32),
	(343, 2003, 2160, 45, 1, 3, 32),
	(344, 1101, 32, 4, 1, 103, 32),
	(345, 2097, 180, 4, 1, 97, 32),
	(346, 1089, 50, 5, 1, 89, 32),
	(347, 1073, 65, 5, 1, 73, 32),
	(348, 1104, 40, 5, 1, 108, 32),
	(349, 2097, 225, 5, 1, 97, 32),
	(350, 2022, 180, 6, 1, 22, 32),
	(351, 2058, 44.5, 5, 1, 58, 32),
	(352, 2035, 200, 4, 1, 35, 32),
	(353, 2045, 35.6, 4, 1, 45, 32),
	(354, 2039, 27, 6, 1, 39, 32),
	(355, 2003, 240, 5, 1, 3, 33),
	(356, 2005, 152, 4, 1, 5, 33),
	(357, 1079, 5, 5, 1, 79, 33),
	(358, 2003, 2160, 45, 1, 3, 33),
	(359, 1101, 32, 4, 1, 103, 33),
	(360, 2097, 180, 4, 1, 97, 33),
	(361, 1089, 50, 5, 1, 89, 33),
	(362, 1073, 65, 5, 1, 73, 33),
	(363, 1104, 40, 5, 1, 108, 33),
	(364, 2097, 225, 5, 1, 97, 33),
	(365, 2022, 180, 6, 1, 22, 33),
	(366, 2058, 44.5, 5, 1, 58, 33),
	(367, 2035, 200, 4, 1, 35, 33),
	(368, 2045, 35.6, 4, 1, 45, 33),
	(369, 2039, 27, 6, 1, 39, 33),
	(370, 2030, 675, 45, 1, 30, 33),
	(371, 2023, 176, 8, 1, 23, 33),
	(372, 1087, 5.6, 8, 1, 87, 33),
	(373, 2003, 240, 5, 1, 3, 34),
	(374, 2005, 152, 4, 1, 5, 34),
	(375, 1079, 5, 5, 1, 79, 34),
	(376, 2003, 2160, 45, 1, 3, 34),
	(377, 1101, 32, 4, 1, 103, 34),
	(378, 2097, 180, 4, 1, 97, 34),
	(379, 1089, 50, 5, 1, 89, 34),
	(380, 1073, 65, 5, 1, 73, 34),
	(381, 1104, 40, 5, 1, 108, 34),
	(382, 2097, 225, 5, 1, 97, 34),
	(383, 2022, 180, 6, 1, 22, 34),
	(384, 2058, 44.5, 5, 1, 58, 34),
	(385, 2035, 200, 4, 1, 35, 34),
	(386, 2045, 35.6, 4, 1, 45, 34),
	(387, 2039, 27, 6, 1, 39, 34),
	(388, 2030, 675, 45, 1, 30, 34),
	(389, 2023, 176, 8, 1, 23, 34),
	(390, 1087, 5.6, 8, 1, 87, 34),
	(391, 2003, 240, 5, 1, 3, 35),
	(392, 2005, 152, 4, 1, 5, 35),
	(393, 1079, 5, 5, 1, 79, 35),
	(394, 2003, 2160, 45, 1, 3, 35),
	(395, 1101, 32, 4, 1, 103, 35),
	(396, 2097, 180, 4, 1, 97, 35),
	(397, 1089, 50, 5, 1, 89, 35),
	(398, 1073, 65, 5, 1, 73, 35),
	(399, 1104, 40, 5, 1, 108, 35),
	(400, 2097, 225, 5, 1, 97, 35),
	(401, 2022, 180, 6, 1, 22, 35),
	(402, 2058, 44.5, 5, 1, 58, 35),
	(403, 2035, 200, 4, 1, 35, 35),
	(404, 2045, 35.6, 4, 1, 45, 35),
	(405, 2039, 27, 6, 1, 39, 35),
	(406, 2030, 675, 45, 1, 30, 35),
	(407, 2023, 176, 8, 1, 23, 35),
	(408, 1087, 5.6, 8, 1, 87, 35),
	(409, 2003, 240, 5, 1, 3, 36),
	(410, 2005, 152, 4, 1, 5, 36),
	(411, 1079, 5, 5, 1, 79, 36),
	(412, 2003, 2160, 45, 1, 3, 36),
	(413, 1101, 32, 4, 1, 103, 36),
	(414, 2097, 180, 4, 1, 97, 36),
	(415, 1089, 50, 5, 1, 89, 36),
	(416, 1073, 65, 5, 1, 73, 36),
	(417, 1104, 40, 5, 1, 108, 36),
	(418, 2097, 225, 5, 1, 97, 36),
	(419, 2022, 180, 6, 1, 22, 36),
	(420, 2058, 44.5, 5, 1, 58, 36),
	(421, 2035, 200, 4, 1, 35, 36),
	(422, 2045, 35.6, 4, 1, 45, 36),
	(423, 2039, 27, 6, 1, 39, 36),
	(424, 2030, 675, 45, 1, 30, 36),
	(425, 2023, 176, 8, 1, 23, 36),
	(426, 1087, 5.6, 8, 1, 87, 36),
	(427, 2003, 240, 5, 1, 3, 37),
	(428, 2005, 152, 4, 1, 5, 37),
	(429, 1079, 5, 5, 1, 79, 37),
	(430, 2003, 2160, 45, 1, 3, 37),
	(431, 1101, 32, 4, 1, 103, 37),
	(432, 2097, 180, 4, 1, 97, 37),
	(433, 1089, 50, 5, 1, 89, 37),
	(434, 1073, 65, 5, 1, 73, 37),
	(435, 1104, 40, 5, 1, 108, 37),
	(436, 2097, 225, 5, 1, 97, 37),
	(437, 2022, 180, 6, 1, 22, 37),
	(438, 2058, 44.5, 5, 1, 58, 37),
	(439, 2035, 200, 4, 1, 35, 37),
	(440, 2045, 35.6, 4, 1, 45, 37),
	(441, 2039, 27, 6, 1, 39, 37),
	(442, 2030, 675, 45, 1, 30, 37),
	(443, 2023, 176, 8, 1, 23, 37),
	(444, 1087, 5.6, 8, 1, 87, 37),
	(445, 2003, 240, 5, 1, 3, 38),
	(446, 2005, 152, 4, 1, 5, 38),
	(447, 1079, 5, 5, 1, 79, 38),
	(448, 2003, 2160, 45, 1, 3, 38),
	(449, 1101, 32, 4, 1, 103, 38),
	(450, 2097, 180, 4, 1, 97, 38),
	(451, 1089, 50, 5, 1, 89, 38),
	(452, 1073, 65, 5, 1, 73, 38),
	(453, 1104, 40, 5, 1, 108, 38),
	(454, 2097, 225, 5, 1, 97, 38),
	(455, 2022, 180, 6, 1, 22, 38),
	(456, 2058, 44.5, 5, 1, 58, 38),
	(457, 2035, 200, 4, 1, 35, 38),
	(458, 2045, 35.6, 4, 1, 45, 38),
	(459, 2039, 27, 6, 1, 39, 38),
	(460, 2030, 675, 45, 1, 30, 38),
	(461, 2023, 176, 8, 1, 23, 38),
	(462, 1087, 5.6, 8, 1, 87, 38),
	(463, 2003, 240, 5, 1, 3, 39),
	(464, 2005, 152, 4, 1, 5, 39),
	(465, 1079, 5, 5, 1, 79, 39),
	(466, 2003, 2160, 45, 1, 3, 39),
	(467, 1101, 32, 4, 1, 103, 39),
	(468, 2097, 180, 4, 1, 97, 39),
	(469, 1089, 50, 5, 1, 89, 39),
	(470, 1073, 65, 5, 1, 73, 39),
	(471, 1104, 40, 5, 1, 108, 39),
	(472, 2097, 225, 5, 1, 97, 39),
	(473, 2022, 180, 6, 1, 22, 39),
	(474, 2058, 44.5, 5, 1, 58, 39),
	(475, 2035, 200, 4, 1, 35, 39),
	(476, 2045, 35.6, 4, 1, 45, 39),
	(477, 2039, 27, 6, 1, 39, 39),
	(478, 2030, 675, 45, 1, 30, 39),
	(479, 2023, 176, 8, 1, 23, 39),
	(480, 1087, 5.6, 8, 1, 87, 39);
/*!40000 ALTER TABLE `producto_etiquetado` ENABLE KEYS */;

-- Volcando estructura para procedimiento marketbbdd.Recibo_cliente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `Recibo_cliente`(in id_r int)
BEGIN
select r.nro_recibo, r.fecha , c.nombre , c.ci, r.total, r.total_literal, r.fecha from compra_r r, cliente c where c.id_cliente=r.id_cliente and r.id_compra=id_r;
END//
DELIMITER ;

-- Volcando estructura para procedimiento marketbbdd.reporte_dia
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_dia`()
    COMMENT 'crea el reporte de ventas por dia por caja o usuario que atendia'
BEGIN
select r.nro_recibo, r.fecha , c.nombre , c.ci, r.total,p.nombre, p.precio, pe.peso_cantidad, pe.preciototal
  from cliente c,producto p, producto_etiquetado pe, compra_r r 
    where c.id_cliente=r.id_cliente 
      and c.ci='6846341' and r.fecha='2018-03-05 15:25:14'  
            and p.id_prod=pe.id_prod ;
END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.seccion
CREATE TABLE IF NOT EXISTS `seccion` (
  `id_seccion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `valor_ticket` varchar(50) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_seccion`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla marketbbdd.seccion: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` (`id_seccion`, `nombre`, `valor_ticket`, `fecha_registro`, `fecha_actualizacion`, `estado`) VALUES
	(1, 'CARNE Y/O DERIVADOS', '100 100 80', '2018-11-28 16:41:41', '2018-11-28 11:41:41', 1),
	(2, 'POLLO Y/O PESCADO', '50 50 49.20', '2018-11-28 16:42:56', '2018-11-28 11:42:56', 1),
	(3, 'VERDURAS', '80 0 0', '2018-11-28 16:44:24', '2018-11-28 11:44:24', 1),
	(4, 'TUBERCULOS', '60 0 0', '2018-11-28 16:44:56', '2018-11-28 11:44:56', 1),
	(5, 'FRUTAS', '45 0 0', '2018-11-28 16:45:48', '2018-11-28 11:45:48', 1);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;

-- Volcando estructura para procedimiento marketbbdd.SumarSeccionesVenta
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `SumarSeccionesVenta`(
	IN `id` INT
)
BEGIN
SELECT p.idseccion, SUM(pe.preciototal) as suma  
FROM producto as p
INNER JOIN producto_etiquetado as pe ON p.id_prod = pe.id_prod
where pe.id_compra = id
GROUP BY p.idseccion;
END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `id_venta` int(11) NOT NULL DEFAULT '0',
  `total_ticket` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla marketbbdd.ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- Volcando estructura para procedimiento marketbbdd.usuario_estado1
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `usuario_estado1`()
BEGIN
select * from usuario_login where estado=1;
END//
DELIMITER ;

-- Volcando estructura para tabla marketbbdd.usuario_login
CREATE TABLE IF NOT EXISTS `usuario_login` (
  `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasenia` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` int(11) NOT NULL DEFAULT '2',
  `fecha_registro` datetime NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla marketbbdd.usuario_login: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario_login` DISABLE KEYS */;
INSERT INTO `usuario_login` (`id_usuario`, `nombre`, `usuario`, `contrasenia`, `estado`, `tipo`, `fecha_registro`, `fecha_actualizacion`) VALUES
	(1, 'Haki Ari', 'hakiari.com', '$2y$10$kFXCe9R5NugF6b4PzarJqulRGCqbIk4E22F3Ouw/RWp2YLH/g41oe', 1, 0, '2018-02-01 02:26:10', '2018-02-07 10:11:35'),
	(2, 'josue daniel gutierrez quispe', 'josuedg', '$2y$10$haU7WOd1e8lFE/pG0HhJcumVGv4QcqV1Yp2CT3U9/l27LYTsoEr.u', 0, 1, '2018-08-11 18:48:59', '2018-08-11 14:48:59'),
	(3, 'abad alvarez claros', 'aalvarez', '$2y$10$c2iKNzURy0P5AVfg0KWrj.7gaI/Fu.9hRZIL7zNrsSTjixmX8/dPu', 0, 1, '2018-08-11 22:27:43', '2018-08-11 18:27:43'),
	(4, 'delia olguin orihuela', 'dolguin', '$2y$10$I8mvCGNI.2wjeI/hEb7rhOSCvgmFAY7bk1kouZlE4jFlEth0mjI9.', 0, 2, '2018-08-11 22:34:45', '2018-08-11 18:34:45'),
	(5, 'Luis Miguel Mendoza Ticona', 'lmendoza', '$2y$10$cX8BWe4o.TWTu2uoHt.16exSpaDaUfIckgVVVe5KlPhcqb/pieZGK', 1, 1, '2018-10-06 19:23:09', '2018-10-06 13:23:09'),
	(6, 'Delia Olguin Orihuela', 'deolguin', '$2y$10$vRD6BSwIPs/oSR8ef6G1FOF6hUx9dCSZ/INIOS2web0Ho30VJOw2m', 1, 1, '2018-12-03 23:37:01', '2018-12-03 18:37:01'),
	(7, 'sergio quispe', 'sergui', '$2y$10$ZRwP0lsG2XuDVdElcvCIzueutD/wZJy5dadu2tuBRlde5jUG68bKG', 1, 1, '2018-12-04 03:47:30', '2018-12-03 22:47:30');
/*!40000 ALTER TABLE `usuario_login` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
