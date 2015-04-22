

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Zbirka podatkov: `sporocilni_sistem`
--
CREATE DATABASE IF NOT EXISTS `sporocilni_sistem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sporocilni_sistem`;

-- --------------------------------------------------------

--
-- Struktura tabele `sporocilo`
--

CREATE TABLE IF NOT EXISTS `sporocilo` (
  `ID_sporocila` int(11) NOT NULL,
  `vsebina` char(200) NOT NULL,
  `zadeva` char(20) DEFAULT NULL,
  PRIMARY KEY (`ID_sporocila`),
  UNIQUE KEY `ID_sporocila` (`ID_sporocila`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `transakcija`
--

CREATE TABLE IF NOT EXISTS `transakcija` (
  `ID_transakcije` int(11) NOT NULL,
  `cas` datetime NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `ID_sporocila` int(11) NOT NULL,
  PRIMARY KEY (`ID_transakcije`,`ID_sporocila`),
  UNIQUE KEY `ID_transakcije` (`ID_transakcije`),
  KEY `ID_sporocila` (`ID_sporocila`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE IF NOT EXISTS `uporabnik` (
  `ID_uporabnika` int(11) NOT NULL auto_increment,
  `ime` char(20) NOT NULL,
  `priimek` char(20) NOT NULL,
  `uporabnisko_ime` char(20) NOT NULL,
  `geslo` char(20) NOT NULL,
  `zadnja_prijava` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_uporabnika`),
  UNIQUE KEY `ID_uporabnika` (`ID_uporabnika`),
  UNIQUE KEY `uporabnisko_ime` (`uporabnisko_ime`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`ime`, `priimek`, `uporabnisko_ime`, `geslo`, `zadnja_prijava`) VALUES
( 'Domen', 'Kos', 'dkos', 'kos', NULL),
( 'Mark', 'Kuhar', 'kmark', 'kuhar', NULL),
('Grega', 'Logar', 'glogar', 'logar', NULL),
('Patrik', 'Istinic', 'pistinic', 'istinic', NULL),
('Klemen', 'Kogovsek', 'kkogovsek', 'kogovsek', NULL),
('Tilen', 'Jesenko', 'tjesenko', 'jesenko', NULL);

