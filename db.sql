-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2019 at 10:46 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trovelnama`
-- User: cringyuser
-- Pass: weirdpassword
--

-- --------------------------------------------------------

--
-- Table structure for table `historicdata`
--

CREATE TABLE `historicdata` (
  `UID_Finder` int(5) DEFAULT NULL,
  `UID_Provider` int(5) DEFAULT NULL,
  `Title` varchar(50) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `Duration` int(3) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Experience` varchar(200) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `DatePosted` date NOT NULL,
  `DateHired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `JID` int(5) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `UID_Provider` int(5) NOT NULL,
  `UID_Finder` int(5) DEFAULT NULL,
  `Skills` varchar(50) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `DateReq` date NOT NULL,
  `Duration` int(3) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `Stipend` int(15) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0',
  `DatePosted` date NOT NULL,
  `DateHired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JID`, `Title`, `UID_Provider`, `UID_Finder`, `Skills`, `Location`, `DateReq`, `Duration`, `Description`, `Stipend`, `Status`, `DatePosted`, `DateHired`) VALUES
(7000000, 'Test', 2, NULL, 'Test', 'Mumbai', '2019-03-22', 5, 'Test', 1000, 0, '2019-03-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobapplications`
--

CREATE TABLE `jobapplications` (
  `JID` int(5) NOT NULL,
  `UID` int(5) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobapplications`
--

INSERT INTO `jobapplications` (`JID`, `UID`, `Date`) VALUES
(7000000, 1, '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `PID` int(5) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `UID_Finder` int(5) NOT NULL,
  `UID_Provider` int(5) DEFAULT NULL,
  `Skills` varchar(100) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `DateAvail` date NOT NULL,
  `Duration` int(3) NOT NULL,
  `Experience` int(3) NOT NULL,
  `ExpDesc` varchar(200) DEFAULT NULL,
  `Status` int(1) DEFAULT '0',
  `DatePosted` date NOT NULL,
  `DateHired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`PID`, `Title`, `UID_Finder`, `UID_Provider`, `Skills`, `Location`, `DateAvail`, `Duration`, `Experience`, `ExpDesc`, `Status`, `DatePosted`, `DateHired`) VALUES
(3000000, 'Test', 1, NULL, 'Test', 'Bangalore', '2019-03-22', 3, 5, NULL, 0, '2019-03-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profileapplications`
--

CREATE TABLE `profileapplications` (
  `PID` int(5) NOT NULL,
  `UID` int(5) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profileapplications`
--

INSERT INTO `profileapplications` (`PID`, `UID`, `Date`) VALUES
(3000000, 2, '2019-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(5) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) DEFAULT NULL,
  `Email` varchar(32) NOT NULL,
  `Image` varchar(200) NOT NULL DEFAULT 'profilepic',
  `Pass` varchar(32) NOT NULL,
  `Addr` varchar(200) NOT NULL,
  `Contact` int(10) NOT NULL,
  `AltContact` int(10) DEFAULT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Fname`, `Lname`, `Email`, `Image`, `Pass`, `Addr`, `Contact`, `AltContact`, `DOB`) VALUES
(1, 'Deep', 'Mehta', 'deepme987@gmail.com', 'profilepic', 'test', 'B/204,Pooja Enclave, Ganesh Nagar', 2147483647, NULL, '1998-09-08'),
(2, 'Deep', 'Mehta', 'test10@gmail.com', 'profilepic', 'root', 'B/204,Pooja Enclave, Ganesh Nagar', 13, NULL, '2019-03-12'),
(3, 'Test', NULL, 'test@gmail.com', 'profilepic', 'root', 'aasf', 124, NULL, '2019-03-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`JID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `profileapplications`
--
ALTER TABLE `profileapplications`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Contact` (`Contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `JID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7000001;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `PID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3000001;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
