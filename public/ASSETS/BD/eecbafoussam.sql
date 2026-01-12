-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2026 at 09:09 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eecbafoussam`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int NOT NULL AUTO_INCREMENT,
  `name_surName` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` int NOT NULL,
  `mot_de_passe` varchar(8) NOT NULL,
  `Date-creation` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `Date-modification` timestamp(6) NULL DEFAULT NULL,
  `Date-logout` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idlogin`, `name_surName`, `email`, `telephone`, `mot_de_passe`, `Date-creation`, `Date-modification`, `Date-logout`) VALUES
(1, 'foyet vallone', 'bautzenfoyet@gmail.com', 654389609, '$2y$10$X', '2026-01-02 15:26:25.000000', '2026-01-02 15:26:25.000000', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
