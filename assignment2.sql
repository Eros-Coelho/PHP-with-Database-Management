-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2025 at 05:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appliances`
--

CREATE TABLE `Appliances` (
  `applianceID` int(7) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `model` varchar(15) NOT NULL,
  `serial_number` int(6) NOT NULL,
  `purchase_date` varchar(10) NOT NULL,
  `warranty_expiration` varchar(10) NOT NULL,
  `appliance_cost` decimal(10,2) NOT NULL,
  `appliance_type` varchar(20) NOT NULL,
  `userID` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Appliances`
--

INSERT INTO `Appliances` (`applianceID`, `brand`, `model`, `serial_number`, `purchase_date`, `warranty_expiration`, `appliance_cost`, `appliance_type`, `userID`) VALUES
(56385, 'ElectroLux', '87-KS', 47295, '22/12/2001', '22/12/2031', 469.90, 'oven', 3156835),
(64938, 'Beeko', '37-GK', 39475, '15/09/2012', '15/09/2045', 649.90, 'fridge', 3141326),
(74952, 'Master', '45-HG', 48205, '22/02/2001', '22/12/2031', 89.00, 'washing-machine', 43872053),
(75639, 'Beeko', '67-JA', 65826, '22/02/2001', '22/12/2042', 99.00, 'Microwave', 3141694);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userID` int(7) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `eir_code` varchar(7) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `first_name`, `last_name`, `address`, `eir_code`, `phone`, `email`) VALUES
(3141326, 'Matthew', 'Johnson', 'Kinsale Rd', 'T12GH6R', 894361492, 'matthew.johnson@gmail.com'),
(3141694, 'Seamus', 'O\'Flannagan', 'Ireland, UK', 'T12GI87', 894639275, 'seamus.mcirish@gmail.ie'),
(3151456, 'john', 'connor', 'dublin road', 't12gh75', 891234567, 'johnconnor@gmail.com'),
(3151957, 'eros', 'coelho', 'wellington road', 't23df3a', 832086343, 'eros@gmail.com'),
(3156835, 'Carter', 'Grayson', 'St Patrick\'s Street', 'T12GH8A', 894628948, 'grayson.carter@email.com'),
(43872053, 'Mary', 'Lynch', 'Vila do Chaves', 'T23GH7A', 893964729, 'mary.lynch99@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appliances`
--
ALTER TABLE `Appliances`
  ADD PRIMARY KEY (`applianceID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appliances`
--
ALTER TABLE `Appliances`
  ADD CONSTRAINT `fk_appliance_user` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
