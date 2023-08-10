-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2023 at 07:45 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'mngr', 'mngr');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `phone`) VALUES
(1, 'Ophthalmologist', '1001'),
(2, 'Neurologist', '1002'),
(3, 'ENT', '1003'),
(4, 'Dermatologist', '1004'),
(5, 'Internist', '1005'),
(6, 'Psychologist', '1006');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

DROP TABLE IF EXISTS `disease`;
CREATE TABLE IF NOT EXISTS `disease` (
  `patient_id` int NOT NULL,
  `disease` varchar(100) NOT NULL,
  `treatment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`patient_id`, `disease`, `treatment`) VALUES
(2, '', ''),
(0, '', ''),
(1, 'Shortage in seeing', 'systane ultra drops');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `specialism` varchar(100) NOT NULL,
  `dep_id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `city`, `street`, `specialism`, `dep_id`, `username`, `password`) VALUES
(1, 'Mohamed', 'Bastawy', '015550', 'Arab El M3mal', '6 Zarief', 'Ophthalmologist', 1, 'basta', 'basta123'),
(2, 'Ahmed', 'Ayman', '010203', 'Cairo', 'Nasser', 'ENT', 3, 'ayman', 'ayman147'),
(3, 'Mahmoud', 'Mohamed', '0101010', 'Cairo', 'ElHdayea', 'Psychologist', 6, 'hoda', 'hoda1234');

-- --------------------------------------------------------

--
-- Table structure for table `doc_treats_pat`
--

DROP TABLE IF EXISTS `doc_treats_pat`;
CREATE TABLE IF NOT EXISTS `doc_treats_pat` (
  `doctor_id` int NOT NULL,
  `patient_id` int NOT NULL,
  PRIMARY KEY (`doctor_id`,`patient_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doc_treats_pat`
--

INSERT INTO `doc_treats_pat` (`doctor_id`, `patient_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `dep_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_care_pat`
--

DROP TABLE IF EXISTS `nur_care_pat`;
CREATE TABLE IF NOT EXISTS `nur_care_pat` (
  `nurse_id` int NOT NULL,
  `patient_id` int NOT NULL,
  PRIMARY KEY (`nurse_id`,`patient_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `age` int DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `dep_id` int NOT NULL,
  `room_number` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`),
  KEY `room_number` (`room_number`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `age`, `phone`, `city`, `street`, `gender`, `dep_id`, `room_number`, `username`, `password`) VALUES
(1, 'Kerolos', 'Adel', 22, '012220', 'Suez', 'Makram', 'male', 1, 5, 'koko', 'koko159'),
(2, 'amr', 'madboly', 22, '123456', 'Cairo', 'Tahrir', 'male', 1, 5, 'amr', 'amr');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `number` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `floor_num` int NOT NULL,
  `dep_id` int NOT NULL,
  PRIMARY KEY (`number`),
  KEY `dep_id` (`dep_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ward_boy`
--

DROP TABLE IF EXISTS `ward_boy`;
CREATE TABLE IF NOT EXISTS `ward_boy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
