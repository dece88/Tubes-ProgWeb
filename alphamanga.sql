-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2019 at 05:21 AM
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
-- Database: `alphamanga`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `mangaid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `userid`, `mangaid`) VALUES
(3, 22, 89),
(4, 20, 89),
(5, 20, 119),
(6, 20, 110),
(7, 20, 104),
(8, 20, 121);

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `idmanga` int(10) NOT NULL,
  `title` varchar(500) NOT NULL,
  `directory_path` varchar(500) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `counter` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`idmanga`, `title`, `directory_path`, `status`, `counter`) VALUES
(89, 'Arifureta Shokugyou de Sekai Saikyou', '../manga/Arifureta Shokugyou de Sekai Saikyou', 'REGULAR', 1027),
(90, 'Black Clover', '../manga/Black Clover', 'REGULAR', 2),
(91, 'Fairy Tail', '../manga/Fairy Tail', 'REGULAR', 1),
(92, 'Nanatsu no Taizai', '../manga/Nanatsu no Taizai', 'REGULAR', 3),
(93, 'One Piece', '../manga/One Piece', 'REGULAR', 0),
(94, 'Rave Master', '../manga/Rave Master', 'REGULAR', 2),
(95, 'Sword Art Online Project Alicization', '../manga/Sword Art Online Project Alicization', 'REGULAR', 1),
(96, 'Tensei Shitara Slime Datta Ken', '../manga/Tensei Shitara Slime Datta Ken', 'REGULAR', 0),
(97, 'Tensei Shitara Slime Datta Ken Spin Off', '../manga/Tensei Shitara Slime Datta Ken Spin Off', 'REGULAR', 0),
(98, 'The Isolator Realization of Absolute Solitude', '../manga/The Isolator Realization of Absolute Solitude', 'REGULAR', 0),
(99, 'The New Gate', '../manga/The New Gate', 'REGULAR', 1),
(100, 'Honzuki no Gekokujou', '../manga/Honzuki no Gekokujou', 'REGULAR', 1),
(101, 'Jimina Ken Sei Wa Sore Demo Saikyoudesu', '../manga/Jimina Ken Sei Wa Sore Demo Saikyoudesu', 'REGULAR', 0),
(102, 'Koushaku Reijou no Tashinami', '../manga/Koushaku Reijou no Tashinami', 'REGULAR', 0),
(104, 'Nisekoi', '../manga/Nisekoi', 'LATEST', 18),
(105, 'One Punch Man', '../manga/One Punch Man', 'LATEST', 94),
(106, 'Seirei Gensouki', '../manga/Seirei Gensouki', 'REGULAR', 0),
(107, 'Shingeki no Kyojin', '../manga/Shingeki no Kyojin', 'LATEST', 904),
(108, 'Shokugeki No Soma', '../manga/Shokugeki No Soma', 'LATEST', 1801),
(109, 'World Teacher Isekaishiki Kyouiku Agent', '../manga/World Teacher Isekaishiki Kyouiku Agent', 'LATEST', 99),
(110, 'Boku no Hero Academia', '../manga/Boku no Hero Academia', 'LATEST', 194),
(111, 'Bokutachi wa Benkyou ga Dekinai', '../manga/Bokutachi wa Benkyou ga Dekinai', 'REGULAR', 2),
(112, 'Darwins Game', '../manga/Darwins Game', 'REGULAR', 0),
(113, 'Kaguya-sama wa Kokurasetai Tensai Tachi no Renai Zunousen', '../manga/Kaguya-sama wa Kokurasetai Tensai Tachi no Renai Zunousen', 'REGULAR', 0),
(114, 'Magi - Sinbad no Bouken', '../manga/Magi - Sinbad no Bouken', 'REGULAR', 0),
(116, 'Namaikizakari', '../manga/Namaikizakari', 'REGULAR', 0),
(117, 'Otome Game no Hametsu Flag shika nai Akuyaku Reijou ni Tensei shite shimatta', '../manga/Otome Game no Hametsu Flag shika nai Akuyaku Reijou ni Tensei shite shimatta', 'REGULAR', 0),
(118, 'Pochi Kuro', '../manga/Pochi Kuro', 'REGULAR', 0),
(119, 'The Promised Neverland', '../manga/The Promised Neverland', 'REGULAR', 0),
(120, 'Masamune-kun no Revenge', '../manga/Masamune-kun no Revenge', 'REGULAR', 2),
(121, 'Boukensha ni Naritai to Miyako ni Deteitta Musume ga S Rank ni Natteta', '../manga/Boukensha ni Naritai to Miyako ni Deteitta Musume ga S Rank ni Natteta', 'REGULAR', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE `reader` (
  `userid` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `info` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`userid`, `username`, `email`, `pass`, `photo`, `info`) VALUES
(18, 'daniel', 'daniel@gmail.com', 'aa47f8215c6f30a0dcdb2a36a9f4168e', '../Image/Profile_Picture/kuroko.jpg', 'Admin'),
(19, 'sherina', 'sherina@gmail.com', '5b869ebb471a1aecc621306025334c49', '../Image/Profile_Picture/kanata.png', 'Admin'),
(20, 'hanjaya', 'hanjayasuryalim@gmail.com', 'ab761a8afb4736ae9726aaecf53f67cd', '../Image/Profile_Picture/kuroko2.jpg', 'Admin'),
(22, 'bokir', 'bokir@gmail.com', '7575a4bf62577fabd0bac3bc73228e87', '../Image/Profile_Picture/profile.png', 'Reguler');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`idmanga`);

--
-- Indexes for table `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `idmanga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `reader`
--
ALTER TABLE `reader`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
