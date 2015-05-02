-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 02. maj 2015 ob 21.39
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
-- Struktura tabele `skupina`
--

CREATE TABLE IF NOT EXISTS `skupina` (
`id_skupine` int(11) NOT NULL,
  `naslov` varchar(20) NOT NULL,
  `id_lastnika` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Odloži podatke za tabelo `skupina`
--

INSERT INTO `skupina` (`id_skupine`, `naslov`, `id_lastnika`) VALUES
(3, 'Sluzba', 1),
(4, 'Prijatelji', 1),
(5, 'Druzba iz morja', 1),
(6, 'Nogomet grupa', 1),
(9, 'Burazi', 5);

-- --------------------------------------------------------

--
-- Struktura tabele `skupinauporabnik`
--

CREATE TABLE IF NOT EXISTS `skupinauporabnik` (
`id_skupinauporabnik` int(11) NOT NULL,
  `id_lastnika` int(11) NOT NULL,
  `id_skupine` int(11) NOT NULL,
  `id_dodanega` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Odloži podatke za tabelo `skupinauporabnik`
--

INSERT INTO `skupinauporabnik` (`id_skupinauporabnik`, `id_lastnika`, `id_skupine`, `id_dodanega`) VALUES
(6, 1, 4, 4),
(7, 1, 4, 8),
(8, 1, 6, 3),
(9, 1, 5, 6),
(10, 1, 4, 2),
(11, 1, 5, 4),
(12, 1, 4, 10),
(13, 1, 3, 7),
(14, 1, 3, 7);

-- --------------------------------------------------------

--
-- Struktura tabele `transakcija`
--

CREATE TABLE IF NOT EXISTS `transakcija` (
`ID_transakcije` int(11) NOT NULL,
  `cas` datetime NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `prebrano` tinyint(1) NOT NULL,
  `vsebina` char(200) DEFAULT NULL,
  `zadeva` char(20) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Odloži podatke za tabelo `transakcija`
--

INSERT INTO `transakcija` (`ID_transakcije`, `cas`, `sender`, `reciever`, `prebrano`, `vsebina`, `zadeva`) VALUES
(14, '2015-05-02 15:43:11', 1, 2, 0, 'TO je sporocilo 1!', 'test'),
(15, '2015-05-02 15:43:11', 1, 3, 0, 'ksakokdsoadksaods', 'Krnekajij'),
(16, '2015-05-02 15:43:11', 2, 3, 0, 'Prosim za informacije', 'Prosnja'),
(17, '2015-05-02 15:43:11', 3, 4, 0, 'Lepe pozdrave iz morja', 'Pozdravi!'),
(18, '2015-05-02 15:43:11', 5, 1, 0, 'Trava je zdrava', 'Pritozba'),
(19, '2015-05-02 15:43:11', 4, 5, 0, 'Vabim te na moj rojstni dan, ki bo v sobo 15.6.2015 ob 14.00 v cazinoju lev. Za jedaco in pijaco bo poskrbljeno. S seboj prinesi veliko dobre volje in denarja da  bomo lohka velik kockal', 'Vabilo na rojstni da'),
(20, '2015-05-02 15:43:11', 5, 4, 0, 'Nogomet je nacin zivljenja', 'Nacin zivljenja');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`ID_uporabnika`, `ime`, `priimek`, `uporabnisko_ime`, `geslo`, `zadnja_prijava`) VALUES
(1, 'Domen', 'Kos', 'dkos', 'kos', '2015-05-02 21:11:56'),
(2, 'Mark', 'Kuhar', 'kmark', 'kuhar', '2015-05-01 19:53:31'),
(3, 'Grega', 'Logar', 'glogar', 'logar', NULL),
(4, 'Patrik', 'Istinic', 'pistinic', 'istinic', NULL),
(5, 'Klemen', 'Kogovsek', 'kkogovsek', 'kogovsek', '2015-05-02 21:10:21'),
(6, 'Tilen', 'Jesenko', 'tjesenko', 'jesenko', NULL),
(7, 'Janez', 'Kosir', 'jkosir', 'kosir', '2015-04-29 17:10:29'),
(8, 'Ziga', 'Mali', 'zmali', 'mali', NULL),
(10, 'Janez', 'Novak', 'jnovak', 'novak', NULL),
(11, 'Marko', 'Gruden', 'mgruden', 'gruden', NULL),
(12, 'Kristjan', 'Grm', 'kgrm', 'grm', NULL);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `skupina`
--
ALTER TABLE `skupina`
 ADD PRIMARY KEY (`id_skupine`);

--
-- Indeksi tabele `skupinauporabnik`
--
ALTER TABLE `skupinauporabnik`
 ADD PRIMARY KEY (`id_skupinauporabnik`);

--
-- Indeksi tabele `transakcija`
--
ALTER TABLE `transakcija`
 ADD PRIMARY KEY (`ID_transakcije`), ADD UNIQUE KEY `ID_transakcije` (`ID_transakcije`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
 ADD PRIMARY KEY (`ID_uporabnika`), ADD UNIQUE KEY `ID_uporabnika` (`ID_uporabnika`), ADD UNIQUE KEY `uporabnisko_ime` (`uporabnisko_ime`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `skupina`
--
ALTER TABLE `skupina`
MODIFY `id_skupine` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT tabele `skupinauporabnik`
--
ALTER TABLE `skupinauporabnik`
MODIFY `id_skupinauporabnik` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT tabele `transakcija`
--
ALTER TABLE `transakcija`
MODIFY `ID_transakcije` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
MODIFY `ID_uporabnika` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
