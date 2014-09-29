-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2014 at 01:32 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airlines`
--
CREATE DATABASE IF NOT EXISTS `airlines` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `airlines`;

-- --------------------------------------------------------

--
-- Table structure for table `aircrafts`
--

CREATE TABLE IF NOT EXISTS `aircrafts` (
  `AcID` int(11) NOT NULL AUTO_INCREMENT,
  `AcName` varchar(65) NOT NULL,
  `Capacity` int(11) NOT NULL,
  PRIMARY KEY (`AcID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `aircrafts`
--

INSERT INTO `aircrafts` (`AcID`, `AcName`, `Capacity`) VALUES
(1, 'PUNX-001', 40),
(2, 'PUNX-002', 40),
(3, 'PUNX-003', 40),
(4, 'PUNX-004', 40),
(5, 'PUNX-005', 40),
(6, 'PUNX-006', 40),
(7, 'PUNX-007', 40),
(8, 'PUNX-008', 40),
(9, 'PUNX-009', 40),
(10, 'PUNX-010', 40);

-- --------------------------------------------------------

--
-- Table structure for table `aircraftseat`
--

CREATE TABLE IF NOT EXISTS `aircraftseat` (
  `SnId` int(11) NOT NULL AUTO_INCREMENT,
  `SeatNumber` varchar(5) NOT NULL,
  PRIMARY KEY (`SnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `aircraftseat`
--

INSERT INTO `aircraftseat` (`SnId`, `SeatNumber`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5'),
(6, 'A6'),
(7, 'A7'),
(8, 'A8'),
(9, 'A9'),
(10, 'B1'),
(11, 'B2'),
(12, 'B3'),
(13, 'B4'),
(14, 'B5'),
(15, 'B6'),
(16, 'B7'),
(17, 'B8'),
(18, 'B9'),
(19, 'C1'),
(20, 'C2'),
(21, 'C3'),
(22, 'C4'),
(23, 'C5'),
(24, 'C6'),
(25, 'C7'),
(26, 'C8'),
(27, 'C9'),
(28, 'D1'),
(29, 'D2'),
(30, 'D3'),
(31, 'D4'),
(32, 'D5'),
(33, 'D6'),
(34, 'D7'),
(35, 'D8'),
(36, 'D9'),
(37, 'E1'),
(38, 'E2'),
(39, 'E3'),
(40, 'E4');

-- --------------------------------------------------------

--
-- Table structure for table `airfare`
--

CREATE TABLE IF NOT EXISTS `airfare` (
  `AfID` int(11) NOT NULL AUTO_INCREMENT,
  `Route` int(11) NOT NULL,
  `Fare` int(11) NOT NULL,
  PRIMARY KEY (`AfID`),
  KEY `fk_route` (`Route`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `airfare`
--

INSERT INTO `airfare` (`AfID`, `Route`, `Fare`) VALUES
(1, 1, 1100),
(2, 1, 1200),
(3, 1, 1300),
(4, 1, 1400),
(5, 1, 1500),
(6, 2, 1100),
(7, 2, 1200),
(8, 2, 1300),
(9, 2, 1400),
(10, 2, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `ApID` int(11) NOT NULL AUTO_INCREMENT,
  `AirportCode` varchar(65) NOT NULL,
  `Location` varchar(65) NOT NULL,
  `Country` varchar(65) NOT NULL,
  PRIMARY KEY (`ApID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`ApID`, `AirportCode`, `Location`, `Country`) VALUES
(1, 'CEB', 'Cebu', 'Philippines'),
(2, 'MAN', 'Metro Manila', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE IF NOT EXISTS `contact_details` (
  `CnID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `ZipCode` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  PRIMARY KEY (`CnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`CnID`, `Email`, `Mobile`, `Street`, `ZipCode`, `City`, `Country`) VALUES
(1, 'jeraldpunx@yahoo.com', '09123123231', 'Cebu City', '3000', 'Cebu City', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `DsID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Amount` decimal(11,1) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`DsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`DsID`, `Title`, `Amount`, `Description`) VALUES
(1, 'Adult', '1.0', ''),
(2, 'Child', '0.7', ''),
(3, 'Infant', '0.6', '');

-- --------------------------------------------------------

--
-- Table structure for table `flight_schedule`
--

CREATE TABLE IF NOT EXISTS `flight_schedule` (
  `FsID` int(11) NOT NULL AUTO_INCREMENT,
  `FlightDate` date NOT NULL,
  `Departure` time NOT NULL,
  `Arrival` time NOT NULL,
  `AirCraft` int(11) NOT NULL,
  `AirFare` int(11) NOT NULL,
  PRIMARY KEY (`FsID`),
  KEY `fk_airfare` (`AirFare`),
  KEY `fk_aircraft` (`AirCraft`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `flight_schedule`
--

INSERT INTO `flight_schedule` (`FsID`, `FlightDate`, `Departure`, `Arrival`, `AirCraft`, `AirFare`) VALUES
(1, '2014-03-06', '08:00:00', '09:00:00', 1, 1),
(2, '2014-03-06', '09:00:00', '10:00:00', 2, 2),
(3, '2014-03-06', '10:00:00', '11:00:00', 3, 3),
(4, '2014-03-06', '11:00:00', '12:00:00', 4, 4),
(5, '2014-03-06', '12:00:00', '13:00:00', 5, 5),
(6, '2014-03-06', '13:00:00', '14:00:00', 6, 6),
(7, '2014-03-06', '14:00:00', '15:00:00', 7, 7),
(8, '2014-03-06', '15:00:00', '16:00:00', 8, 8),
(9, '2014-03-06', '16:00:00', '17:00:00', 9, 9),
(10, '2014-03-06', '17:00:00', '18:00:00', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE IF NOT EXISTS `passenger` (
  `PsID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `BDay` date NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Contact` int(11) NOT NULL,
  PRIMARY KEY (`PsID`),
  KEY `fk_contact` (`Contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`PsID`, `Title`, `Name`, `BDay`, `Gender`, `Type`, `Contact`) VALUES
(1, 'Mr', 'Jerald Patalinghug', '1994-12-15', 'Male', 'Adult', 1),
(2, 'Miss', 'David Laude', '1992-03-04', 'Female', 'Child', 1),
(3, 'Miss', 'Eloise Mamac', '2014-03-02', 'Female', 'Child', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `RtID` int(11) NOT NULL AUTO_INCREMENT,
  `Origin` int(11) NOT NULL,
  `Destination` int(11) NOT NULL,
  PRIMARY KEY (`RtID`),
  KEY `fk_origin` (`Origin`),
  KEY `fk_destination` (`Destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`RtID`, `Origin`, `Destination`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `TsID` int(11) NOT NULL AUTO_INCREMENT,
  `TicketCode` varchar(8) DEFAULT NULL,
  `BookingDate` date NOT NULL,
  `Passenger` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Flight` int(11) NOT NULL,
  `SnID` int(11) NOT NULL,
  PRIMARY KEY (`TsID`),
  KEY `fk_passenger` (`Passenger`),
  KEY `fk_discount` (`Discount`),
  KEY `fk_flight` (`Flight`),
  KEY `fk_SnID` (`SnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TsID`, `TicketCode`, `BookingDate`, `Passenger`, `Discount`, `Flight`, `SnID`) VALUES
(1, '82NRIE1F', '2014-03-06', 1, 1, 1, 1),
(2, '82NRIE1F', '2014-03-06', 1, 1, 8, 1),
(3, '82NRIE1F', '2014-03-06', 2, 2, 1, 2),
(4, '82NRIE1F', '2014-03-06', 2, 2, 8, 2),
(5, '82NRIE1F', '2014-03-06', 3, 2, 1, 3),
(6, '82NRIE1F', '2014-03-06', 3, 2, 8, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airfare`
--
ALTER TABLE `airfare`
  ADD CONSTRAINT `fk_route` FOREIGN KEY (`Route`) REFERENCES `route` (`RtID`);

--
-- Constraints for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD CONSTRAINT `fk_aircraft` FOREIGN KEY (`AirCraft`) REFERENCES `aircrafts` (`AcID`),
  ADD CONSTRAINT `fk_airfare` FOREIGN KEY (`AirFare`) REFERENCES `airfare` (`AfID`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `fk_contact` FOREIGN KEY (`Contact`) REFERENCES `contact_details` (`CnID`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `fk_destination` FOREIGN KEY (`Destination`) REFERENCES `airport` (`ApID`),
  ADD CONSTRAINT `fk_origin` FOREIGN KEY (`Origin`) REFERENCES `airport` (`ApID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_discount` FOREIGN KEY (`Discount`) REFERENCES `discount` (`DsID`),
  ADD CONSTRAINT `fk_flight` FOREIGN KEY (`Flight`) REFERENCES `flight_schedule` (`FsID`),
  ADD CONSTRAINT `fk_passenger` FOREIGN KEY (`Passenger`) REFERENCES `passenger` (`PsID`),
  ADD CONSTRAINT `fk_SnID` FOREIGN KEY (`SnID`) REFERENCES `aircraftseat` (`SnId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
