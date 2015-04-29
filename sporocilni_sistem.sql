-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 29. apr 2015 ob 19.12
-- Različica strežnika: 5.6.20
-- Različica PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Zbirka podatkov: `sporocilni_sistem`
--

-- --------------------------------------------------------

--
-- Struktura tabele `sporocilo`
--

CREATE TABLE IF NOT EXISTS `sporocilo` (
`ID_sporocila` int(11) NOT NULL,
  `vsebina` char(200) NOT NULL,
  `zadeva` char(20) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Odloži podatke za tabelo `sporocilo`
--

INSERT INTO `sporocilo` (`ID_sporocila`, `vsebina`, `zadeva`) VALUES
(1, 'TO je sporocilo 1!', 'test'),
(2, '?marko', 'Krnekajij'),
(3, 'Prosim za informacije', 'Prosnja'),
(4, 'Lepe pozdrave iz morja', 'Pozdravi!'),
(5, 'Trava je zdrava', 'Pritozba'),
(6, 'Vabim te na moj rojstni dan, ki bo v sobo 15.6.2015 ob 14.00 v cazinoju lev. Za jedaco in pijaco bo poskrbljeno. S seboj prinesi veliko dobre volje in denarja da  bomo lohka velik kockal', 'Vabilo na rojstni da'),
(7, 'Nogomet je nacin zivljenja', 'Nacin zivljenja');

-- --------------------------------------------------------

--
-- Struktura tabele `transakcija`
--

CREATE TABLE IF NOT EXISTS `transakcija` (
`ID_transakcije` int(11) NOT NULL,
  `cas` datetime NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `ID_sporocila` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Odloži podatke za tabelo `transakcija`
--

INSERT INTO `transakcija` (`ID_transakcije`, `cas`, `sender`, `reciever`, `ID_sporocila`) VALUES
(1, '2015-04-29 16:46:31', 1, 2, 1),
(2, '2015-04-29 16:55:04', 1, 2, 2),
(3, '2015-04-29 16:56:48', 2, 1, 3),
(4, '2015-04-29 17:01:04', 3, 4, 4),
(5, '2015-04-29 17:01:08', 4, 3, 5),
(6, '2015-04-29 17:01:13', 5, 1, 6),
(7, '2015-04-29 17:01:17', 5, 2, 6),
(8, '2015-04-29 17:01:21', 5, 3, 6),
(9, '2015-04-29 17:01:26', 5, 4, 6),
(10, '2015-04-29 17:07:31', 2, 4, 7),
(11, '2015-04-29 15:19:38', 2, 4, 7);

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE IF NOT EXISTS `uporabnik` (
`ID_uporabnika` int(11) NOT NULL,
  `ime` char(20) NOT NULL,
  `priimek` char(20) NOT NULL,
  `uporabnisko_ime` char(20) NOT NULL,
  `geslo` char(20) NOT NULL,
  `zadnja_prijava` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`ID_uporabnika`, `ime`, `priimek`, `uporabnisko_ime`, `geslo`, `zadnja_prijava`) VALUES
(1, 'Domen', 'Kos', 'dkos', 'kos', NULL),
(2, 'Mark', 'Kuhar', 'kmark', 'kuhar', NULL),
(3, 'Grega', 'Logar', 'glogar', 'logar', NULL),
(4, 'Patrik', 'Istinic', 'pistinic', 'istinic', NULL),
(5, 'Klemen', 'Kogovsek', 'kkogovsek', 'kogovsek', NULL),
(6, 'Tilen', 'Jesenko', 'tjesenko', 'jesenko', NULL),
(7, 'Janez', 'Kosir', 'jkosir', 'kosir', '2015-04-29 17:10:29'),
(8, 'Ziga', 'Mali', 'zmali', 'mali', NULL),
(9, '', '', '', '', NULL),
(10, 'Janez', 'Novak', 'jnovak', 'novak', NULL);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `sporocilo`
--
ALTER TABLE `sporocilo`
 ADD PRIMARY KEY (`ID_sporocila`), ADD UNIQUE KEY `ID_sporocila` (`ID_sporocila`);

--
-- Indeksi tabele `transakcija`
--
ALTER TABLE `transakcija`
 ADD PRIMARY KEY (`ID_transakcije`,`ID_sporocila`), ADD UNIQUE KEY `ID_transakcije` (`ID_transakcije`), ADD KEY `ID_sporocila` (`ID_sporocila`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
 ADD PRIMARY KEY (`ID_uporabnika`), ADD UNIQUE KEY `ID_uporabnika` (`ID_uporabnika`), ADD UNIQUE KEY `uporabnisko_ime` (`uporabnisko_ime`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `sporocilo`
--
ALTER TABLE `sporocilo`
MODIFY `ID_sporocila` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT tabele `transakcija`
--
ALTER TABLE `transakcija`
MODIFY `ID_transakcije` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
MODIFY `ID_uporabnika` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
