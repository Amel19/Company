-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 02:09 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firma`
--

-- --------------------------------------------------------

--
-- Table structure for table `firma_artikl`
--

CREATE TABLE `firma_artikl` (
  `artikl_id` int(11) NOT NULL,
  `artikl_naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `artikl_opis` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Nema opisa',
  `artikl_kategorija_id` int(11) NOT NULL,
  `cijena` decimal(4,2) NOT NULL,
  `jedinicna_mjera` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zaliha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_artikl`
--

INSERT INTO `firma_artikl` (`artikl_id`, `artikl_naziv`, `artikl_opis`, `artikl_kategorija_id`, `cijena`, `jedinicna_mjera`, `zaliha`) VALUES
(1, 'Ne?to', 'Nema opisa', 1, '20.00', 'kom', 88),
(2, 'Artikal', 'Nema', 2, '30.00', 'metar', 290);

-- --------------------------------------------------------

--
-- Table structure for table `firma_kategorija`
--

CREATE TABLE `firma_kategorija` (
  `kategorija_id` int(11) NOT NULL,
  `kategorija_naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_kategorija`
--

INSERT INTO `firma_kategorija` (`kategorija_id`, `kategorija_naziv`) VALUES
(1, 'Knjige'),
(2, 'Telefonija'),
(3, 'Namje?taj');

-- --------------------------------------------------------

--
-- Table structure for table `firma_narudzba`
--

CREATE TABLE `firma_narudzba` (
  `narudzba_id` int(11) NOT NULL,
  `narudzba_poslovni_partner_id` int(11) NOT NULL,
  `naziv_artikl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jedinicna_mjera` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kolicina` int(11) NOT NULL,
  `narudzba_status_id` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_narudzba`
--

INSERT INTO `firma_narudzba` (`narudzba_id`, `narudzba_poslovni_partner_id`, `naziv_artikl`, `jedinicna_mjera`, `kolicina`, `narudzba_status_id`, `datum`) VALUES
(1, 1, 'Neki artikal', 'kom', 200, 4, '2019-07-10 20:26:43'),
(2, 2, 'Ne?to', 'l', 100, 4, '2019-07-10 20:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `firma_narudzba_primka`
--

CREATE TABLE `firma_narudzba_primka` (
  `primka_id` int(11) NOT NULL,
  `narudzba_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_narudzba_primka`
--

INSERT INTO `firma_narudzba_primka` (`primka_id`, `narudzba_id`, `kolicina`, `datum`) VALUES
(1, 1, 200, '2019-07-10 20:26:43'),
(2, 2, 100, '2019-07-10 20:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `firma_poslovni_partner`
--

CREATE TABLE `firma_poslovni_partner` (
  `partner_id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_od` date DEFAULT NULL,
  `partner_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_poslovni_partner`
--

INSERT INTO `firma_poslovni_partner` (`partner_id`, `naziv`, `adresa`, `telefon`, `telefax`, `email`, `partner_od`, `partner_status_id`) VALUES
(1, 'BH Telecom', 'BiH', '000-213-322', '210-210-330', 'bh@telecom.com', '2019-07-03', 1),
(2, 'Bingo d.o.o', 'BiH', '232-322-333', '321321', 'bingo@bingo.com', '2019-07-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `firma_radno_mjesto`
--

CREATE TABLE `firma_radno_mjesto` (
  `mjesto_id` int(11) NOT NULL,
  `mjesto_ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mjesto_opis` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_radno_mjesto`
--

INSERT INTO `firma_radno_mjesto` (`mjesto_id`, `mjesto_ime`, `mjesto_opis`) VALUES
(1, 'Zaposlenik', 'Zaposlenik u prodavnici'),
(2, 'Administrator', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `firma_status`
--

CREATE TABLE `firma_status` (
  `status_id` int(11) NOT NULL,
  `status_ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_status`
--

INSERT INTO `firma_status` (`status_id`, `status_ime`) VALUES
(1, 'Aktivan'),
(2, 'Izbrisan'),
(3, 'Na čekanju'),
(4, 'Primljeno');

-- --------------------------------------------------------

--
-- Table structure for table `firma_tip_placanja`
--

CREATE TABLE `firma_tip_placanja` (
  `placanje_id` int(11) NOT NULL,
  `placanje_naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firma_tip_placanja`
--

INSERT INTO `firma_tip_placanja` (`placanje_id`, `placanje_naziv`) VALUES
(1, 'Gotovina'),
(2, 'Kreditna kartica'),
(3, 'Debitna kartica');

-- --------------------------------------------------------

--
-- Table structure for table `kredencijal`
--

CREATE TABLE `kredencijal` (
  `kredencijal_id` int(11) NOT NULL,
  `kredencijal_ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kredencijal`
--

INSERT INTO `kredencijal` (`kredencijal_id`, `kredencijal_ime`) VALUES
(1, 'Zaposlenik'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_id` int(11) NOT NULL,
  `racun_zaposlenik_id` int(11) NOT NULL,
  `racun_tip_placanja_id` int(11) NOT NULL,
  `komentar` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uplaceno` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`racun_id`, `racun_zaposlenik_id`, `racun_tip_placanja_id`, `komentar`, `datum`, `total`, `uplaceno`) VALUES
(1, 1, 2, 'Nema komentara', '2019-07-10 20:27:59', '540.00', '540.00');

-- --------------------------------------------------------

--
-- Table structure for table `racun_stavka`
--

CREATE TABLE `racun_stavka` (
  `stavka_id` int(11) NOT NULL,
  `racun_id` int(11) NOT NULL,
  `artikl_id` int(11) NOT NULL,
  `kolicina` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racun_stavka`
--

INSERT INTO `racun_stavka` (`stavka_id`, `racun_id`, `artikl_id`, `kolicina`) VALUES
(1, 1, 2, '10'),
(2, 1, 1, '12');

-- --------------------------------------------------------

--
-- Table structure for table `zaposlenik`
--

CREATE TABLE `zaposlenik` (
  `zaposlenik_id` int(11) NOT NULL,
  `zaposlenik_ime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zaposlenik_prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zaposlenik_adresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zaposlenik_telefon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_godine` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_datum_zaposlenja` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_korisnicko_ime` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_sifra` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaposlenik_kredencijal_id` int(11) NOT NULL,
  `zaposlenik_status_id` int(11) NOT NULL,
  `zaposlenik_radno_mjesto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zaposlenik`
--

INSERT INTO `zaposlenik` (`zaposlenik_id`, `zaposlenik_ime`, `zaposlenik_prezime`, `zaposlenik_adresa`, `zaposlenik_telefon`, `zaposlenik_email`, `zaposlenik_godine`, `zaposlenik_datum_zaposlenja`, `zaposlenik_korisnicko_ime`, `zaposlenik_sifra`, `zaposlenik_kredencijal_id`, `zaposlenik_status_id`, `zaposlenik_radno_mjesto_id`) VALUES
(1, 'Zaposlenik', 'Prezime', 'Adresa', '000-000-000', 'zaposlenik@zaposlenik.com', '22', '2019-01-01', 'zaposlenik', 'a846c18f0ea77349dbfb20d3851d4170', 1, 1, 1),
(2, 'Administrator', 'Administrator', 'Adresa', '000-000-000', 'Administrator@email.com', '24', '2019-01-01', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 2, 1, 2),
(3, 'Novi zaposlenik', 'Prezime', 'Adresa', '000-032-032', 'novi@novi.com', '25', '2019-07-18', 'novi', 'c768d640b22d75803e950148eec1c010', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `firma_artikl`
--
ALTER TABLE `firma_artikl`
  ADD PRIMARY KEY (`artikl_id`),
  ADD KEY `Fk_artikl_kategorija` (`artikl_kategorija_id`);

--
-- Indexes for table `firma_kategorija`
--
ALTER TABLE `firma_kategorija`
  ADD PRIMARY KEY (`kategorija_id`);

--
-- Indexes for table `firma_narudzba`
--
ALTER TABLE `firma_narudzba`
  ADD PRIMARY KEY (`narudzba_id`),
  ADD KEY `Fk_partner_narudzba` (`narudzba_poslovni_partner_id`),
  ADD KEY `Fk_narudzba_status` (`narudzba_status_id`);

--
-- Indexes for table `firma_narudzba_primka`
--
ALTER TABLE `firma_narudzba_primka`
  ADD PRIMARY KEY (`primka_id`),
  ADD KEY `Fk_narudzba_primka` (`narudzba_id`);

--
-- Indexes for table `firma_poslovni_partner`
--
ALTER TABLE `firma_poslovni_partner`
  ADD PRIMARY KEY (`partner_id`),
  ADD KEY `FK_partner_status` (`partner_status_id`);

--
-- Indexes for table `firma_radno_mjesto`
--
ALTER TABLE `firma_radno_mjesto`
  ADD PRIMARY KEY (`mjesto_id`);

--
-- Indexes for table `firma_status`
--
ALTER TABLE `firma_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `firma_tip_placanja`
--
ALTER TABLE `firma_tip_placanja`
  ADD PRIMARY KEY (`placanje_id`);

--
-- Indexes for table `kredencijal`
--
ALTER TABLE `kredencijal`
  ADD PRIMARY KEY (`kredencijal_id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_id`),
  ADD KEY `Fk_racun_zaposlenik` (`racun_zaposlenik_id`),
  ADD KEY `Fk_racun_placanje` (`racun_tip_placanja_id`);

--
-- Indexes for table `racun_stavka`
--
ALTER TABLE `racun_stavka`
  ADD PRIMARY KEY (`stavka_id`),
  ADD KEY `Fk_racun` (`racun_id`),
  ADD KEY `Fk_artikl_stavka` (`artikl_id`);

--
-- Indexes for table `zaposlenik`
--
ALTER TABLE `zaposlenik`
  ADD PRIMARY KEY (`zaposlenik_id`),
  ADD KEY `FK_zaposlenik_kredencijal` (`zaposlenik_kredencijal_id`),
  ADD KEY `FK_zaposlenik_status` (`zaposlenik_status_id`),
  ADD KEY `Fk_zaposlenik_mjesto` (`zaposlenik_radno_mjesto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `firma_artikl`
--
ALTER TABLE `firma_artikl`
  MODIFY `artikl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firma_kategorija`
--
ALTER TABLE `firma_kategorija`
  MODIFY `kategorija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `firma_narudzba`
--
ALTER TABLE `firma_narudzba`
  MODIFY `narudzba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firma_narudzba_primka`
--
ALTER TABLE `firma_narudzba_primka`
  MODIFY `primka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firma_poslovni_partner`
--
ALTER TABLE `firma_poslovni_partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firma_radno_mjesto`
--
ALTER TABLE `firma_radno_mjesto`
  MODIFY `mjesto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firma_status`
--
ALTER TABLE `firma_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `firma_tip_placanja`
--
ALTER TABLE `firma_tip_placanja`
  MODIFY `placanje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kredencijal`
--
ALTER TABLE `kredencijal`
  MODIFY `kredencijal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `racun_stavka`
--
ALTER TABLE `racun_stavka`
  MODIFY `stavka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zaposlenik`
--
ALTER TABLE `zaposlenik`
  MODIFY `zaposlenik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `firma_artikl`
--
ALTER TABLE `firma_artikl`
  ADD CONSTRAINT `Fk_artikl_kategorija` FOREIGN KEY (`artikl_kategorija_id`) REFERENCES `firma_kategorija` (`kategorija_id`);

--
-- Constraints for table `firma_narudzba`
--
ALTER TABLE `firma_narudzba`
  ADD CONSTRAINT `Fk_narudzba_status` FOREIGN KEY (`narudzba_status_id`) REFERENCES `firma_status` (`status_id`),
  ADD CONSTRAINT `Fk_partner_narudzba` FOREIGN KEY (`narudzba_poslovni_partner_id`) REFERENCES `firma_poslovni_partner` (`partner_id`);

--
-- Constraints for table `firma_narudzba_primka`
--
ALTER TABLE `firma_narudzba_primka`
  ADD CONSTRAINT `Fk_narudzba_primka` FOREIGN KEY (`narudzba_id`) REFERENCES `firma_narudzba` (`narudzba_id`);

--
-- Constraints for table `firma_poslovni_partner`
--
ALTER TABLE `firma_poslovni_partner`
  ADD CONSTRAINT `FK_partner_status` FOREIGN KEY (`partner_status_id`) REFERENCES `firma_status` (`status_id`);

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `Fk_racun_placanje` FOREIGN KEY (`racun_tip_placanja_id`) REFERENCES `firma_tip_placanja` (`placanje_id`),
  ADD CONSTRAINT `Fk_racun_zaposlenik` FOREIGN KEY (`racun_zaposlenik_id`) REFERENCES `zaposlenik` (`zaposlenik_id`);

--
-- Constraints for table `racun_stavka`
--
ALTER TABLE `racun_stavka`
  ADD CONSTRAINT `Fk_artikl_stavka` FOREIGN KEY (`artikl_id`) REFERENCES `firma_artikl` (`artikl_id`),
  ADD CONSTRAINT `Fk_racun` FOREIGN KEY (`racun_id`) REFERENCES `racun` (`racun_id`);

--
-- Constraints for table `zaposlenik`
--
ALTER TABLE `zaposlenik`
  ADD CONSTRAINT `FK_zaposlenik_kredencijal` FOREIGN KEY (`zaposlenik_kredencijal_id`) REFERENCES `kredencijal` (`kredencijal_id`),
  ADD CONSTRAINT `FK_zaposlenik_status` FOREIGN KEY (`zaposlenik_status_id`) REFERENCES `firma_status` (`status_id`),
  ADD CONSTRAINT `Fk_zaposlenik_mjesto` FOREIGN KEY (`zaposlenik_radno_mjesto_id`) REFERENCES `firma_radno_mjesto` (`mjesto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
