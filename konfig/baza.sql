-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Maj 2015, 21:01
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE IF NOT EXISTS `kontakt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(25) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefon` varchar(12) DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `kontakt_user_fk` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `kontakt`
--

INSERT INTO `kontakt` (`id`, `imie`, `nazwisko`, `email`, `telefon`, `data_urodzenia`, `id_user`) VALUES
(1, 'Åukasz', 'Adrych', 'lukadych@gmail.com', '533 333 222', '1989-03-27', 24),
(2, 'Tomasz', 'Grett', 'komer@wp.pl', '322-444-333', '1965-06-15', 24),
(7, 'Andrzej', 'Kowalki', 'andrej@wp.pl', '777-787-321', '1980-11-15', 24),
(9, 'Monika', 'Nowak', 'nowak@gmail.com', '765-812-314', '1993-05-30', 25),
(10, 'Marian', 'Ferrer', 'ferr@o2.pl', '655-566-324', '1975-05-15', 25),
(11, 'Mariusz', 'Tree', 'tree@o2.pl', '678-235-563', '1965-06-15', 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(30) NOT NULL,
  `hash_haslo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `nick`, `hash_haslo`) VALUES
(25, 'tomasz', '1a7fcdd5a9fd433523268883cfded9d0'),
(24, 'lukasz', '1a7fcdd5a9fd433523268883cfded9d0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
