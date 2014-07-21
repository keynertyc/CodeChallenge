-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-07-2014 a las 17:44:57
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbcodechallenge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditcards`
--

CREATE TABLE `creditcards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `cardnumber` varchar(20) DEFAULT NULL,
  `expirationdate_month` varchar(2) DEFAULT NULL,
  `expirationdate_year` varchar(4) DEFAULT NULL,
  `securitycode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `creditcards`
--

INSERT INTO `creditcards` (`id`, `user_id`, `cardnumber`, `expirationdate_month`, `expirationdate_year`, `securitycode`) VALUES
(1, 1, '4242424242424242', '12', '2014', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(128) DEFAULT NULL,
  `object_id_field` varchar(128) DEFAULT 'id',
  `object_id` varchar(256) DEFAULT NULL,
  `property` varchar(128) DEFAULT NULL,
  `type` enum('EMAIL','PUSH','SMS') DEFAULT NULL,
  `data` text,
  `send_on` datetime DEFAULT NULL,
  `timezone` varchar(128) DEFAULT 'UTC',
  `condition` varchar(128) DEFAULT NULL,
  `sent` tinyint(1) DEFAULT '0',
  `sent_on` datetime DEFAULT NULL,
  `errors` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `model`, `object_id_field`, `object_id`, `property`, `type`, `data`, `send_on`, `timezone`, `condition`, `sent`, `sent_on`, `errors`, `created`, `modified`) VALUES
(1, 'User', 'id', '1', 'email', 'EMAIL', '{"settings":"default","subject":"Welcome!","template":"welcome","emailFormat":"html","viewVars":{"first_name":"Code","last_name":"Challenge","email":"keyner.peru@gmail.com"}}', NULL, 'UTC', NULL, 0, NULL, NULL, '2014-07-21 22:44:14', '2014-07-21 22:44:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(90) DEFAULT NULL,
  `lastname` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Keyner', 'TYC', 'keyner.peru@gmail.com', 'f2e9f16923529d9375d4ae3aecb6ab5dc00dc062');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
