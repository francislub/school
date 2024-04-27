-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 11:34 AM
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
-- Database: `employee_akpoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `id` int(11) NOT NULL,
  `employeeID` varchar(150) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `password` varchar(15) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `employee_type` varchar(60) NOT NULL,
  `date_appointment` varchar(20) NOT NULL,
  `basic_salary` varchar(60) NOT NULL,
  `gross_pay` varchar(60) NOT NULL,
  `status` varchar(1) NOT NULL,
  `leave_status` varchar(20) NOT NULL,
  `photo` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`id`, `employeeID`, `fullname`, `password`, `sex`, `email`, `dob`, `phone`, `address`, `qualification`, `dept`, `employee_type`, `date_appointment`, `basic_salary`, `gross_pay`, `status`, `leave_status`, `photo`) VALUES
(7, 'STAFF/FKP/2023/4860', 'Ndueso Akpabio', 'escobar2012', 'Male', 'newleastpaysolution@gmail.com', '12/9/1980', '08067361023', '12 Ikono rd', 'Msc', 'Bursary', 'Academic', '9/9/2023', '21000', '25000', '1', 'Pending', 'uploadImage/Profile/2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblleave`
--

CREATE TABLE `tblleave` (
  `ID` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `leaveID` varchar(6700) NOT NULL,
  `start_date` varchar(25) NOT NULL,
  `end_date` varchar(25) NOT NULL,
  `reason` varchar(5000) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblleave`
--

INSERT INTO `tblleave` (`ID`, `email`, `leaveID`, `start_date`, `end_date`, `reason`, `status`) VALUES
(14, 'newleastpaysolution@gmail.com', '2023399', '2023-10-29', '2023-11-15', 'Maternity Leave', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(12) NOT NULL,
  `password` varchar(15) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `fullname` varchar(34) NOT NULL,
  `photo` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `phone`, `fullname`, `photo`) VALUES
('admin', 'admin123', '0905656', 'Caroline Bassey', 'uploadImage/Profile/User.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblleave`
--
ALTER TABLE `tblleave`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblleave`
--
ALTER TABLE `tblleave`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
