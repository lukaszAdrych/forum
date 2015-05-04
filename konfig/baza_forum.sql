-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: 85.17.73.180
-- Czas wygenerowania: 04 Maj 2015, 14:22
-- Wersja serwera: 5.5.43-1.cba-log
-- Wersja PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `portal`
--

CREATE TABLE IF NOT EXISTS `portal` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ilosc_postow` int(11) DEFAULT NULL,
  `ilosc_tematow` int(11) DEFAULT NULL,
  `ilosc_uzytkownikow` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `portal`
--

INSERT INTO `portal` (`id`, `ilosc_postow`, `ilosc_tematow`, `ilosc_uzytkownikow`) VALUES
(1, 6, 4, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `tresc` text NOT NULL,
  `data` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_user` int(6) NOT NULL,
  `id_topic` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_topic` (`id_topic`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`id`, `tresc`, `data`, `status`, `id_user`, `id_topic`) VALUES
(21, 'Tomek, 30 lat :)', '2015-05-04 11:53:16', 'aktywny', 25, 11),
(18, 'Hej, jestem Åukasz i mam 26 lat', '2015-05-04 11:51:11', 'aktywny', 24, 11),
(19, 'Jutro pojawi siÄ™ wykaz kar za przewinienia.', '2015-05-04 11:51:42', 'aktywny', 24, 9),
(17, 'DziaÅ‚ ten bÄ™dzie ukryty, wglÄ…d bÄ™dÄ… posiadaÄ‡ tylko moderatorzy', '2015-05-04 11:48:25', 'aktywny', 24, 12),
(20, 'Temat do wolnych rozmÃ³w, moÅ¼na tu pisaÄ‡ o wszystkim', '2015-05-04 11:52:25', 'aktywny', 24, 10),
(16, 'Temat poÅ›wiÄ™cony, na zasady korzystania z tego forum', '2015-05-04 11:43:52', 'ukryty', 25, 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_user` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `topic`
--

INSERT INTO `topic` (`id`, `nazwa`, `status`, `id_user`) VALUES
(12, 'Moderacja', 'ukryty', 25),
(11, 'UÅ¼ytkownicy', 'aktywny', 25),
(10, 'Rozmowa', 'aktywny', 25),
(9, 'Regulamin forum', 'aktywny', 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `hash_haslo` varchar(50) NOT NULL,
  `kod_aktywacja` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `nick`, `email`, `hash_haslo`, `kod_aktywacja`, `status`) VALUES
(25, 'tomasz', 'aich_osie@o2.pl', '1a7fcdd5a9fd433523268883cfded9d0', '55473e4566bb7', 'czytelnik'),
(24, 'lukasz', 'aichosie@gmail.com', '1a7fcdd5a9fd433523268883cfded9d0', '55473de5eb8b9', 'moderator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
