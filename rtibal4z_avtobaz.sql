-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2015 г., 16:37
-- Версия сервера: 5.5.45
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rtibal4z_avtobaz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pb_marka`
--

CREATE TABLE IF NOT EXISTS `pb_marka` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `pb_marka`
--

INSERT INTO `pb_marka` (`id`, `name`, `product`) VALUES
(1, 'AUDI', 1),
(2, 'BMW', 2),
(3, 'CADILLAC', 0),
(4, 'CHEVROLET', 0),
(5, 'CHRYSLER', 0),
(6, 'Daewoo', 0),
(7, 'Dodge', 0),
(8, 'FIAT', 0),
(9, 'FORD', 0),
(10, 'ALFA ROMEO', 0),
(11, 'Honda', 0),
(12, 'Hyundai', 0),
(13, 'Infiniti', 0),
(14, 'Iveco', 0),
(15, 'Jeep', 0),
(16, 'Kia', 0),
(17, 'Lada', 0),
(18, 'Land Rover', 0),
(19, 'Lexus', 0),
(20, 'Lincoln', 0),
(21, 'Mazda', 0),
(22, 'Mercedes', 0),
(23, 'Mitsubishi', 0),
(24, 'Nissan', 0),
(25, 'Opel', 0),
(26, 'Peugeot', 0),
(27, 'Renault', 0),
(28, 'Skoda', 0),
(29, 'SSANGYONG', 0),
(30, 'Subaru', 0),
(31, 'Suzuki', 0),
(32, 'Toyota', 0),
(33, 'Vauxhall', 0),
(34, 'VOLVO', 0),
(35, 'VW', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pb_model`
--

CREATE TABLE IF NOT EXISTS `pb_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marka` varchar(10) COLLATE cp1251_bin NOT NULL,
  `name` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=86 ;

--
-- Дамп данных таблицы `pb_model`
--

INSERT INTO `pb_model` (`id`, `marka`, `name`) VALUES
(9, 'AUDI', 'A4 (ZF)'),
(8, 'AUDI', 'A4 (KOYO)'),
(10, 'AUDI', 'A6 (KOYO)'),
(11, 'AUDI', 'A6 (ZF)'),
(12, 'AUDI', '80 B4'),
(13, 'AUDI', '80'),
(14, 'ALFA ROMEO', '156'),
(15, 'BMW', '3 ( E36 )'),
(16, 'BMW', '3 ( E36 )'),
(17, 'CADILLAC', 'ESCALADE'),
(18, 'CHEVROLET', 'LACETTI'),
(19, 'CHRYSLER', 'PACIFICA'),
(20, 'CHRYSLER', 'PT Cruiser'),
(21, 'CHRYSLER', 'Sebring'),
(22, 'CHRYSLER', 'VOYAGER III'),
(23, 'CHRYSLER', 'VOYAGER IV'),
(24, 'Daewoo', 'Espero'),
(25, 'Daewoo', 'Gentra'),
(26, 'Daewoo', 'Lacetti'),
(27, 'Daewoo', 'Leganza'),
(28, 'Daewoo', 'Magnus'),
(29, 'Daewoo', 'Nubira'),
(30, 'Dodge', 'Ram 1500'),
(31, 'Dodge', 'RAM 2500'),
(32, 'FIAT', 'ALBEA'),
(33, 'FIAT', 'ULYSSE'),
(34, 'FORD', 'EXPLORER'),
(35, 'FORD', 'FOCUS'),
(36, 'FORD', 'Fusion'),
(37, 'FORD', 'GALAXY'),
(38, 'FORD', 'Mondeo'),
(39, 'FORD', 'MONDEO III'),
(40, 'FORD', 'SCORPIO'),
(41, 'FORD', 'TRANSIT VI'),
(42, 'FORD', 'TRANSIT V'),
(43, 'FORD', 'TRANSIT IV'),
(44, 'Honda', 'Accord'),
(45, 'Honda', 'Accord (American build)'),
(46, 'Honda', 'Accord VII'),
(47, 'Honda', 'Civic седан VI'),
(48, 'Honda', 'Concerto'),
(49, 'Honda', 'CR-V'),
(50, 'Honda', 'Odissey'),
(51, 'Honda', 'Odissey (правый руль)'),
(52, 'Honda', 'Pilot'),
(53, 'Honda', 'Prelude'),
(54, 'Honda', 'RIDGELINE'),
(55, 'Honda', 'Stream'),
(56, 'Hyundai', 'Grand Starex'),
(57, 'Hyundai ', 'Elantra'),
(58, 'Hyundai ', 'Getz'),
(59, 'Hyundai ', 'H1/Starex'),
(60, 'Hyundai', 'Matrix'),
(61, 'Hyundai', 'Santa FE'),
(62, 'Hyundai', 'Santa Fe II'),
(63, 'Hyundai', 'Sonata II'),
(64, 'Hyundai', 'Sonata III'),
(65, 'Hyundai', 'Sonata NF V'),
(66, 'Hyundai', 'Tucson'),
(67, 'Hyundai', 'Veracruz'),
(68, 'Hyundai', 'Libero'),
(69, 'Hyundai', 'Porter'),
(70, 'Infiniti', 'FX II'),
(71, 'Infiniti', 'FX'),
(72, 'Infiniti', 'QX56'),
(73, 'Iveco', 'Daily'),
(74, 'Jeep', 'Grand Cherokee III'),
(75, 'Kia', 'Bongo'),
(76, 'Kia', 'Bongo'),
(77, 'Kia', 'Carnival II'),
(78, 'Kia', 'Carnival III'),
(79, 'Kia', 'Cerato'),
(80, 'Kia', 'Magentis II'),
(81, 'Kia', 'Sorento'),
(82, 'Kia', 'SPECTRA'),
(83, 'Kia', 'Sportage II'),
(84, 'Lada', '(ВАЗ 2110-12)'),
(85, 'Lada ', 'Largus (ВАЗ)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
