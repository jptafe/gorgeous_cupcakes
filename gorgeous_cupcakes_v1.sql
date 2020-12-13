-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2015 at 12:32 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gorgeous_cupcakes`
--
CREATE DATABASE IF NOT EXISTS `gorgeous_cupcakes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gorgeous_cupcakes`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(10) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(256) NOT NULL,
  `categoryDescription` text NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryDescription`) VALUES
(1, 'Sweet', 'This category includes sweet cupcakes.'),
(2, 'Savoury', 'This category includes savoury cupcakes.'),
(3, 'Special occassion', 'This category includes special occasion cupcakes only available at specific times during the year e.g. Easter, Christmas.');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(10) NOT NULL AUTO_INCREMENT,
  `productName` varchar(256) NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productPhoto` varchar(256) DEFAULT NULL,
  `categoryID` int(10) NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productPrice`, `productPhoto`, `categoryID`) VALUES
(1, 'Chocolate chip', 'A sweet milk chocolate cupcake perfect for all ages.', '2.50', 'choc_chip.jpg', 1),
(2, 'Red velvet', 'A delicious dark red cake topped with cream cheese.', '2.70', 'red_velvet.jpg', 1),
(3, 'Easter nest', 'A fun vanilla Easter themed cupcake topped with an icing nest [April only].', '3.10', 'easter_nest.jpg', 3),
(4, 'Blueberry', 'A delicious moist cupcake made with fresh blueberries.', '2.50', 'blueberry.jpg', 1),
(5, 'Bacon and egg', 'A quirky savoury cupcake for the bacon lovers.', '3.50', '', 2),
(6, 'Coconut chocolate', 'A delightful blend of dark chocolate and coconut.', '2.50', 'coconut_choc.jpg', 1),
(7, 'Corn and spinach', 'A savoury favourite best eaten warm with butter on the side.', '3.20', 'corn_and_spinach.jpg', 2),
(8, 'Christmas tree', 'A vanilla Christmas themed cupcake topped with an icing tree [December only].', '3.10', 'christmas_tree.jpg', 3),
(9, 'White chocolate', 'A delicious white chocolate treat.', '2.50', 'white_choc.jpg', 1),
(10, 'Bacon and chocolate', 'A unique blend of bacon and chocolate.', '3.80', 'bacon_and_choc.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `username`, `password`, `salt`) VALUES
(1, '', '', 'test@test.com', 'admin', '7693e0fa45e46284a4e86729ce7704cf96a4d849d4c8b0474ae6928280efe31f', 'b846b99eee5b3e7ca5b8881c226e8175');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
