-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2014 a las 18:21:13
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `notas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_alum2grado`
--

CREATE TABLE IF NOT EXISTS `ctrl_alum2grado` (
  `id_a2g` int(11) NOT NULL AUTO_INCREMENT,
  `alumn_code` varchar(10) NOT NULL,
  `id_gra` int(11) NOT NULL,
  PRIMARY KEY (`id_a2g`),
  UNIQUE KEY `alumn_code` (`alumn_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_alumnos`
--

CREATE TABLE IF NOT EXISTS `ctrl_alumnos` (
  `id_alumn` int(11) NOT NULL AUTO_INCREMENT,
  `alumn_code` varchar(10) NOT NULL,
  `alumn_nomb` varchar(250) NOT NULL,
  `alumn_apell` varchar(250) NOT NULL,
  `cod_grado` int(200) NOT NULL,
  `contrasena_alum` varchar(100) NOT NULL,
  `matricula` varchar(5) NOT NULL,
  PRIMARY KEY (`id_alumn`),
  UNIQUE KEY `id_alumn` (`id_alumn`,`alumn_code`),
  KEY `alumn_nomb` (`alumn_nomb`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_alumnos_backup`
--

CREATE TABLE IF NOT EXISTS `ctrl_alumnos_backup` (
  `id_alumn` int(11) NOT NULL AUTO_INCREMENT,
  `alumn_code` varchar(10) NOT NULL,
  `alumn_nomb` varchar(250) NOT NULL,
  `alumn_apell` varchar(250) NOT NULL,
  `cod_grado` int(200) NOT NULL,
  `contrasena_alum` varchar(100) NOT NULL,
  `matricula` varchar(5) NOT NULL,
  PRIMARY KEY (`id_alumn`),
  UNIQUE KEY `id_alumn` (`id_alumn`,`alumn_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_doc2grado`
--

CREATE TABLE IF NOT EXISTS `ctrl_doc2grado` (
  `id_ug` int(11) NOT NULL AUTO_INCREMENT,
  `code_asig` varchar(20) NOT NULL,
  `dcnt_id` varchar(30) NOT NULL,
  `id_gra` int(11) NOT NULL,
  PRIMARY KEY (`id_ug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_doc2materia`
--

CREATE TABLE IF NOT EXISTS `ctrl_doc2materia` (
  `id_um` int(11) NOT NULL AUTO_INCREMENT,
  `dcnt_id` varchar(50) NOT NULL,
  `id_mat` int(11) NOT NULL,
  `code_asig` varchar(20) NOT NULL,
  PRIMARY KEY (`id_um`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_docentes`
--

CREATE TABLE IF NOT EXISTS `ctrl_docentes` (
  `dcnt_id` int(250) NOT NULL AUTO_INCREMENT,
  `dcnt_nom` varchar(250) NOT NULL,
  `dcnt_ape` varchar(250) NOT NULL,
  `dcnt_cargo` varchar(50) NOT NULL,
  `dcnt_email` varchar(60) NOT NULL,
  `dcnt_user` varchar(200) NOT NULL,
  `dcnt_pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`dcnt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_gns`
--

CREATE TABLE IF NOT EXISTS `ctrl_gns` (
  `id_gns` int(11) NOT NULL AUTO_INCREMENT,
  `id_gra` int(11) NOT NULL,
  `id_niv` int(11) NOT NULL,
  `id_sec` int(11) NOT NULL,
  PRIMARY KEY (`id_gns`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_grados`
--

CREATE TABLE IF NOT EXISTS `ctrl_grados` (
  `id_gra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_gra` varchar(100) NOT NULL,
  `nivel_gra` varchar(200) NOT NULL,
  PRIMARY KEY (`id_gra`),
  UNIQUE KEY `nombre_gra` (`nombre_gra`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_materias`
--

CREATE TABLE IF NOT EXISTS `ctrl_materias` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_mat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mat`),
  UNIQUE KEY `nombre_mat` (`nombre_mat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_nivel`
--

CREATE TABLE IF NOT EXISTS `ctrl_nivel` (
  `id_niv` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_niv` varchar(50) NOT NULL,
  PRIMARY KEY (`id_niv`),
  UNIQUE KEY `nombre_niv` (`nombre_niv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notasbachillerato`
--

CREATE TABLE IF NOT EXISTS `ctrl_notasbachillerato` (
  `id_ntbch` int(255) NOT NULL AUTO_INCREMENT,
  `alumn_code` int(250) NOT NULL,
  `id_mat` smallint(50) NOT NULL,
  `id_gra` smallint(50) NOT NULL,
  `nbch_periodo` varchar(5) NOT NULL,
  `nbch_fecha` year(4) NOT NULL,
  `nbch_act1` double NOT NULL,
  `nbch_act2` double NOT NULL,
  `nbch_act3` double NOT NULL,
  `nbch_actprom` double NOT NULL,
  `nbch_auto` double NOT NULL,
  `nbch_hetero` double NOT NULL,
  `nbch_promedio` double NOT NULL,
  `nbch_prbobjetiva` double NOT NULL,
  `nbch_prbobjetiva_prom` double NOT NULL,
  `nbch_promedio_final` double NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_ntbch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notasbachillerato_backup`
--

CREATE TABLE IF NOT EXISTS `ctrl_notasbachillerato_backup` (
  `id_ntbch` int(255) NOT NULL AUTO_INCREMENT,
  `alumn_code` int(250) NOT NULL,
  `id_mat` smallint(50) NOT NULL,
  `id_gra` smallint(50) NOT NULL,
  `nbch_periodo` varchar(5) NOT NULL,
  `nbch_fecha` year(4) NOT NULL,
  `nbch_act1` double NOT NULL,
  `nbch_act2` double NOT NULL,
  `nbch_act3` double NOT NULL,
  `nbch_actprom` double NOT NULL,
  `nbch_auto` double NOT NULL,
  `nbch_hetero` double NOT NULL,
  `nbch_promedio` double NOT NULL,
  `nbch_prbobjetiva` double NOT NULL,
  `nbch_prbobjetiva_prom` double NOT NULL,
  `nbch_promedio_final` double NOT NULL,
  PRIMARY KEY (`id_ntbch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notasbachillerato_bbbb`
--

CREATE TABLE IF NOT EXISTS `ctrl_notasbachillerato_bbbb` (
  `id_ntbch` int(255) NOT NULL AUTO_INCREMENT,
  `alumn_code` int(250) NOT NULL,
  `id_mat` smallint(50) NOT NULL,
  `id_gra` smallint(50) NOT NULL,
  `nbch_periodo` varchar(5) NOT NULL,
  `nbch_fecha` year(4) NOT NULL,
  `nbch_act1` double NOT NULL,
  `nbch_act2` double NOT NULL,
  `nbch_act3` double NOT NULL,
  `nbch_actprom` double NOT NULL,
  `nbch_auto` double NOT NULL,
  `nbch_hetero` double NOT NULL,
  `nbch_promedio` double NOT NULL,
  `nbch_prbobjetiva` double NOT NULL,
  `nbch_prbobjetiva_prom` double NOT NULL,
  `nbch_promedio_final` double NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_ntbch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notasprimaria`
--

CREATE TABLE IF NOT EXISTS `ctrl_notasprimaria` (
  `id_ntpr` int(250) NOT NULL AUTO_INCREMENT,
  `id_alumn` int(250) NOT NULL,
  `id_mat` int(250) NOT NULL,
  `id_gra` varchar(250) NOT NULL,
  `ntpr_periodo` varchar(250) NOT NULL,
  `ntpr_fecha` year(4) NOT NULL,
  `ntpr_act1` double NOT NULL,
  `ntpr_act2` double NOT NULL,
  `ntpr_act3` double NOT NULL,
  `ntpr_actprom` double NOT NULL,
  `ntpr_examen` double NOT NULL,
  `ntpr_examen_pro` double NOT NULL,
  `ntpr_promedio` double NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_ntpr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notasprimaria_backup`
--

CREATE TABLE IF NOT EXISTS `ctrl_notasprimaria_backup` (
  `id_ntpr` int(250) NOT NULL AUTO_INCREMENT,
  `id_alumn` int(250) NOT NULL,
  `id_mat` int(250) NOT NULL,
  `id_gra` varchar(250) NOT NULL,
  `ntpr_periodo` varchar(250) NOT NULL,
  `ntpr_fecha` year(4) NOT NULL,
  `ntpr_act1` double NOT NULL,
  `ntpr_act2` double NOT NULL,
  `ntpr_act3` double NOT NULL,
  `ntpr_actprom` double NOT NULL,
  `ntpr_examen` double NOT NULL,
  `ntpr_examen_pro` double NOT NULL,
  `ntpr_promedio` double NOT NULL,
  PRIMARY KEY (`id_ntpr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notassecundaria`
--

CREATE TABLE IF NOT EXISTS `ctrl_notassecundaria` (
  `id_ntscn` int(250) NOT NULL AUTO_INCREMENT,
  `alumn_code` int(250) NOT NULL,
  `id_mat` int(250) NOT NULL,
  `id_grad` varchar(250) NOT NULL,
  `ntscn_periodo` varchar(250) NOT NULL,
  `ntscn_fecha` year(4) NOT NULL,
  `ntscn_act1` double NOT NULL,
  `ntscn_act2` double NOT NULL,
  `ntscn_act3` double NOT NULL,
  `ntscn_act_prom` double NOT NULL,
  `ntscn_auto` double NOT NULL,
  `ntscn_hetero` double NOT NULL,
  `ntscn_evaluacion_prom` double NOT NULL,
  `ntscn_prueba_obj` double NOT NULL,
  `ntscn_prueba_obj_prom` double NOT NULL,
  `ntscn_promedio` double NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_ntscn`),
  KEY `alumn_code` (`alumn_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_notassecundaria_backup`
--

CREATE TABLE IF NOT EXISTS `ctrl_notassecundaria_backup` (
  `id_ntscn` int(250) NOT NULL AUTO_INCREMENT,
  `alumn_code` int(250) NOT NULL,
  `id_mat` int(250) NOT NULL,
  `id_grad` varchar(250) NOT NULL,
  `ntscn_periodo` varchar(250) NOT NULL,
  `ntscn_fecha` year(4) NOT NULL,
  `ntscn_act1` double NOT NULL,
  `ntscn_act2` double NOT NULL,
  `ntscn_act3` double NOT NULL,
  `ntscn_act_prom` double NOT NULL,
  `ntscn_auto` double NOT NULL,
  `ntscn_hetero` double NOT NULL,
  `ntscn_evaluacion_prom` double NOT NULL,
  `ntscn_prueba_obj` double NOT NULL,
  `ntscn_prueba_obj_prom` double NOT NULL,
  `ntscn_promedio` double NOT NULL,
  PRIMARY KEY (`id_ntscn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_periodos`
--

CREATE TABLE IF NOT EXISTS `ctrl_periodos` (
  `prdo_id` tinyint(4) NOT NULL,
  `prdo_nom` varchar(15) NOT NULL,
  `prdo_status` varchar(2) NOT NULL,
  `enabled_period` int(11) NOT NULL,
  PRIMARY KEY (`prdo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ctrl_periodos`
--

INSERT INTO `ctrl_periodos` (`prdo_id`, `prdo_nom`, `prdo_status`, `enabled_period`) VALUES
(1, 'Primer Periodo', '0', 0),
(2, 'Segundo Periodo', '1', 0),
(3, 'Tercer Periodo', '0', 0),
(4, 'Cuarto Periodo', '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_seccion`
--

CREATE TABLE IF NOT EXISTS `ctrl_seccion` (
  `id_sec` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sec` varchar(60) NOT NULL,
  PRIMARY KEY (`id_sec`),
  UNIQUE KEY `nombre_sec` (`nombre_sec`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ctrl_seccion`
--

INSERT INTO `ctrl_seccion` (`id_sec`, `nombre_sec`) VALUES
(1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_usu2grado`
--

CREATE TABLE IF NOT EXISTS `ctrl_usu2grado` (
  `id_ug` int(11) NOT NULL AUTO_INCREMENT,
  `usu_code` varchar(10) NOT NULL,
  `id_gra` int(11) NOT NULL,
  PRIMARY KEY (`usu_code`),
  UNIQUE KEY `id` (`id_ug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_usu2materia`
--

CREATE TABLE IF NOT EXISTS `ctrl_usu2materia` (
  `id_um` int(11) NOT NULL AUTO_INCREMENT,
  `usu_code` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  PRIMARY KEY (`id_um`),
  UNIQUE KEY `id_um` (`id_um`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_usuarios`
--

CREATE TABLE IF NOT EXISTS `ctrl_usuarios` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `usu_code` int(10) NOT NULL,
  `usu_email` varchar(100) NOT NULL,
  `usu_pass` varchar(100) NOT NULL,
  `usu_nomb` varchar(40) NOT NULL,
  `usu_apell` varchar(40) NOT NULL,
  `usu_level` int(1) NOT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
