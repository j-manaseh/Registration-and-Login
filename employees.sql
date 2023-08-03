-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 06:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwft`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `Title` text NOT NULL,
  `Department` text NOT NULL,
  `snumber` int(10) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `Email`, `phone`, `Title`, `Department`, `snumber`, `Password`) VALUES
(1, 'Joshua', 'Wakomo', 'joshmanaseh@gmail.com', 2147483647, 'intern', 'ICT', 491, '$argon2i$v=19$m=65536,t=4,p=1$V25pUTBrVmJ4bjFGcDlkbw$VEPBVvagKeJ8XXM5RiZ+EZzkiYNLt8U+MNshzMNh2Z0'),
(2, 'Joshua', 'Wakomo', 'joshmanaseh2@gmail.com', 2147483647, 'ICT intern', 'ICT', 491, '$argon2i$v=19$m=65536,t=4,p=1$UXJrVVYzT3puYktHRWpIaw$kBdPZZt9jUGpSDXkGV62rIeV8pkBcGuxwpRypjz3B5o');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
