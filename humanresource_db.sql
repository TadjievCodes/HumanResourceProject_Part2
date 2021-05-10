-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 20, 2021 at 08:46 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `humanresource`
--
DROP DATABASE IF EXISTS `humanresource`;
CREATE DATABASE IF NOT EXISTS `humanresource` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `humanresource`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeFirstName` varchar(50) COLLATE utf8_bin NOT NULL,
  `EmployeeLastName` varchar(50) COLLATE utf8_bin NOT NULL,
  `Gender` varchar(1) COLLATE utf8_bin DEFAULT 'M',
  `InitialLevel` int(3) DEFAULT '1',
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `EmployeeID` (`EmployeeID`)
) ENGINE=MyISAM AUTO_INCREMENT=412 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP USER IF EXISTS 'human_resource_user'@'%';
CREATE USER 'human_resource_user'@'%' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON `humanresource`.* TO 'human_resource_user'@'%';

COMMIT;
