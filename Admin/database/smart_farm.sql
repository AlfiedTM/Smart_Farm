-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2021 at 05:40 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` smallint(255) UNSIGNED NOT NULL,
  `Admin_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_username` text COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Phone_number` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Admin_name`, `Admin_username`, `Admin_email`, `Phone_number`, `Password`, `Registration_date`) VALUES
(1, 'Alfred T Matakala', 'admin', 'alfredtwaambo@gmail.com', '+260975770988', 'e6e061838856bf47e1de730719fb2609', '2021-04-27 09:11:09'),
(3, 'Mashapi E Matimba', 'Mashapi E Matimba', 'mashapimatimba@gmail.com', '+260979516292', '5a1604e8dac1e9e6031c93028e018112', '2021-07-09 17:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `current_irrigation`
--

CREATE TABLE `current_irrigation` (
  `ID` smallint(255) UNSIGNED NOT NULL,
  `Plant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_irrigation`
--

INSERT INTO `current_irrigation` (`ID`, `Plant_name`) VALUES
(4, 'Chibwabwa');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `ID` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`ID`, `Description`) VALUES
(1, 'Ph'),
(2, 'Temperature'),
(3, 'Moisture'),
(4, 'Nitrogen'),
(5, 'Phosphorus'),
(6, 'Potassium'),
(7, 'Date'),
(8, 'Time');

-- --------------------------------------------------------

--
-- Table structure for table `farm_data`
--

CREATE TABLE `farm_data` (
  `ID` int(11) NOT NULL,
  `Ph` int(10) UNSIGNED NOT NULL,
  `Temperature` int(11) NOT NULL,
  `Moisture` int(10) UNSIGNED NOT NULL,
  `Nitrogen` tinyint(3) UNSIGNED NOT NULL,
  `Phosphorus` tinyint(3) UNSIGNED NOT NULL,
  `Potassium` tinyint(3) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farm_data`
--

INSERT INTO `farm_data` (`ID`, `Ph`, `Temperature`, `Moisture`, `Nitrogen`, `Phosphorus`, `Potassium`, `Date`, `Time`) VALUES
(1, 7, 45, 550, 5, 4, 7, '2021-07-05', '09:11:09'),
(2, 5, 35, 460, 5, 6, 7, '2021-07-07', '19:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `plant_records`
--

CREATE TABLE `plant_records` (
  `ID` smallint(255) UNSIGNED NOT NULL,
  `Plant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Ph_low` tinyint(3) UNSIGNED NOT NULL,
  `Ph_high` tinyint(3) UNSIGNED NOT NULL,
  `Temp_high` tinyint(4) NOT NULL,
  `Temp_low` tinyint(4) NOT NULL,
  `Moisture_high` smallint(5) UNSIGNED NOT NULL,
  `Moisture_low` smallint(5) UNSIGNED NOT NULL,
  `Nitrogen` tinyint(3) UNSIGNED NOT NULL,
  `Phosphorus` tinyint(3) UNSIGNED NOT NULL,
  `Potassium` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_records`
--

INSERT INTO `plant_records` (`ID`, `Plant_name`, `Ph_low`, `Ph_high`, `Temp_high`, `Temp_low`, `Moisture_high`, `Moisture_low`, `Nitrogen`, `Phosphorus`, `Potassium`) VALUES
(1, 'Maize', 2, 5, 20, 35, 550, 450, 9, 5, 4),
(2, 'Rape', 4, 8, 34, 20, 759, 540, 7, 4, 6),
(3, 'Mpiru', 6, 9, 30, 34, 780, 670, 7, 9, 2),
(4, 'Chibwabwa', 9, 5, 30, 34, 780, 670, 7, 9, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_email`,`ID`);

--
-- Indexes for table `current_irrigation`
--
ALTER TABLE `current_irrigation`
  ADD PRIMARY KEY (`ID`,`Plant_name`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `farm_data`
--
ALTER TABLE `farm_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `plant_records`
--
ALTER TABLE `plant_records`
  ADD PRIMARY KEY (`ID`,`Plant_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_irrigation`
--
ALTER TABLE `current_irrigation`
  ADD CONSTRAINT `current_irrigation_ibfk_1` FOREIGN KEY (`ID`,`Plant_name`) REFERENCES `plant_records` (`ID`, `Plant_name`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
