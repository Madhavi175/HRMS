-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 12:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `Email`, `Password`) VALUES
(1, 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `emp_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`emp_id`, `name`) VALUES
(1, 'hrrr'),
(2, 'Madhavi Dhobalee'),
(3, 'Madhavi Dhobalee'),
(4, 'admiin'),
(5, 'madhu'),
(6, 'madhu'),
(7, 'technical head'),
(8, 'technical head'),
(9, 'madhu'),
(10, 'arya'),
(11, 'arya'),
(12, 'TCS IHP '),
(13, 'tcshp'),
(14, 'tcshp'),
(15, 'HR'),
(16, 'HR'),
(17, 'HIE');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeId` int(255) NOT NULL,
  `ProfileImage` varchar(250) NOT NULL,
  `FirstName` varchar(200) NOT NULL,
  `MiddleName` varchar(200) NOT NULL,
  `LastName` varchar(200) NOT NULL,
  `Birthdate` date NOT NULL,
  `Gender` int(10) NOT NULL,
  `Address1` varchar(500) NOT NULL,
  `Address2` varchar(500) NOT NULL,
  `Address3` varchar(500) NOT NULL,
  `State` int(250) NOT NULL,
  `City` int(11) NOT NULL,
  `Mobile` decimal(10,0) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `AadharNumber` varchar(25) NOT NULL,
  `MaritalStatus` int(11) NOT NULL,
  `Position` int(11) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `JoinDate` date NOT NULL,
  `Salary` int(250) NOT NULL,
  `LeaveDate` date DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `LastLogout` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `Role` int(11) NOT NULL,
  `ImageName` varchar(1000) DEFAULT NULL,
  `MacAddress` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeId`, `ProfileImage`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Gender`, `Address1`, `Address2`, `Address3`, `State`, `City`, `Mobile`, `Email`, `Password`, `AadharNumber`, `MaritalStatus`, `Position`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `JoinDate`, `Salary`, `LeaveDate`, `LastLogin`, `LastLogout`, `Status`, `Role`, `ImageName`, `MacAddress`) VALUES
(1, '', 'admin', 'admin', 'admin', '1994-10-09', 1, 'address1', 'address2', 'address3', 0, 2, 9999999999, 'admin@gmail.com', 'admin', '12354658496', 2, 1, 1, '2017-01-01 00:00:00', 1, '2017-01-31 10:33:33', '2017-01-11', 0, '2017-01-18', '2024-09-08 20:32:20', '2024-09-12 13:52:24', 1, 1, 'images (2).jpg', ''),
(2, '60af48744294d0e6caedf751d52e002c.jpg', 'Madhavi', 'sanjay', 'dhobale', '2005-05-17', 2, 'nagpur', 'nagpuur', 'nagpurr', 0, 0, 9322465817, 'pihu@gmail.com', '$2y$10$aXnwMwEeSElUq.HMml', '24356789785', 2, 2, 1, '2017-01-17 11:03:40', 3, '2017-02-07 12:34:57', '2024-08-07', 25, '2024-10-31', '2017-02-21 15:50:05', '2017-02-21 15:57:51', 1, 3, 'images (1).jpg', '40-8D-5C-B1-B7-7D'),
(9, 'IMG-20230815-WA0032.jpg', 'xyz', 'abc', 'pqr', '2024-08-15', 2, 'Nagpur', 'Nagpur', '', 0, 8, 9665687710, 'pqr@gmail.com', '1234567890-=', '2134567890', 1, 3, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-15', 0, '2024-08-15', NULL, NULL, 2, 1, NULL, ''),
(10, 'IMG-20240226-WA0004.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-09-15', 2, 'Nagpur', 'Nagpur', '', 0, 13, 9665687710, 'madhu19@gmail.com', '123', '2134567890', 2, 2, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-15', 0, '2024-08-15', NULL, NULL, 1, 3, NULL, ''),
(13, 'IMG-20230815-WA0060.jpg', 'xyz', 'abc', 'xyz', '2024-08-15', 1, 'Nagpur', 'Nagpur', '', 0, 12, 9665687710, 'abc12@gmail.com', '23456', '2134567890', 2, 2, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-09-15', 0, '2024-08-15', NULL, NULL, 1, 3, NULL, ''),
(14, 'IMG-20230815-WA0060.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-15', 2, 'Nagpur', 'Nagpur', '', 0, 12, 9665687710, 'etyujkl@gmail.com', '123', '2134567890', 1, 2, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-15', 0, '2024-08-15', NULL, NULL, 1, 1, NULL, ''),
(34, 'uploads/download.jpeg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-21', 1, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'pihu0987098@gmail.com', '87', '2134567890', 1, 7, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-31', 0, '2024-08-25', '2024-09-02 15:26:46', NULL, 2, 1, NULL, ''),
(543, '', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-12', 2, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'madhavi1500@gmail.com', '5667', '2134567890', 2, 6, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-09-15', 0, '2024-08-13', NULL, NULL, 1, 1, NULL, ''),
(8080, 'uploads/grid.png', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-12', 1, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'madhiiiiiiiiavi1500@gmail.com', '0880', '2134567890', 2, 2, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-09-15', 2147483647, '2024-08-21', NULL, NULL, 1, 2, NULL, ''),
(8081, 'Snapchat-1927480181.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-13', 1, 'Nagpur', 'Nagpur', '', 0, 10, 9665687710, 'etyujk2qwerr56tyul@gmail.com', '345678', '2134567890', 1, 6, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-13', 0, '2024-08-13', NULL, NULL, 1, 1, NULL, ''),
(8082, '', 'nitin', 'h', 'patel', '2017-02-17', 1, 'nr, new laxminarayan temple ,virani moti', 'nakhatrana', '', 0, 8, 9408020069, 'nitinchhabhaiya@gmail.com', '123.', 'sdfds5644dsf', 2, 2, 3, '2017-02-08 10:42:08', 3, '2017-02-08 11:43:07', '2017-02-09', 0, '2017-02-08', '2017-02-09 15:41:37', '2017-02-09 15:57:23', 1, 3, '311497journal.pone.0020409.g003.png', '40-8D-5C-B1-B7-7D'),
(8083, 'IMG-20230815-WA0032.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-15', 2, 'Nagpur', 'Nagpur', '', 0, 10, 9665687710, 'madhu@gmail.com', '123', '2134567890', 2, 8, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-15', 0, '2024-08-15', NULL, NULL, 1, 3, NULL, ''),
(8084, 'IMG-20230815-WA0014.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-15', 2, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'chnakuuyjk@gmail.com', '123', '2134567890', 1, 6, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-09-15', 0, '2024-08-13', NULL, NULL, 1, 1, NULL, ''),
(8085, '', 'sagar', 'tulsidas', 'somjiyani', '2016-07-01', 1, 'fggfrgrfg', 'rgrfgrfg', 'rgegfrgvdfre', 0, 9, 4523543234, 'nitin@gmail.com', 'bbbbb', 'zcxfcewr42353', 2, 2, 1, '2017-02-11 10:18:40', 1, '2017-02-11 10:19:09', '2017-02-21', 0, '0000-00-00', '2017-02-24 11:30:44', '2017-02-23 18:28:04', 1, 3, '63666images.jpg', '40-8D-5C-B1-B7-7D'),
(8086, '66c83423168930.00262812.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-15', 1, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'madhavi09898@gmail.com', '098', '2134567890', 2, 1, 3, '2017-02-20 10:19:28', 3, '2017-02-20 10:46:56', '2024-08-07', 0, '2024-08-12', '2017-02-24 11:27:02', '2017-02-24 11:30:38', 1, 1, '219924Tulips.jpg', '40-8D-5C-B1-B7-7D'),
(8087, '', 'asdf', 'adfs', 'asdf', '2017-02-08', 1, 'dsfa', 'adfs', 'asdf', 0, 7, 3451243543, 'ankit@gmail.com', 'asdf', 'afasdfasdf', 1, 7, 3, '2017-02-08 04:18:31', 3, '2017-02-08 04:42:30', '2017-02-10', 0, '2017-02-18', NULL, NULL, 1, 2, '151244images (3).jpg', '40-8D-5C-B1-B7-7D'),
(8088, 'IMG-20240226-WA0004.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-21', 2, 'Nagpur', 'Nagpur', '', 0, 0, 9665687710, 'madhu1978@gmail.com', '876', '2134567890', 2, 2, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-21', 0, '2024-08-15', NULL, NULL, 1, 1, NULL, ''),
(8089, 'IMG-20230815-WA0014.jpg', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-13', 2, 'Nagpur', 'Nagpur', 'Nagpur', 0, 10, 9665687710, 'abc1@gmail.com', '0987', '2134567890', 1, 8, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-13', 0, '0000-00-00', '2024-08-13 22:10:23', NULL, 1, 1, NULL, ''),
(8090, '', 'Madhavi', 'Sanjay', 'Dhobale', '2024-08-12', 2, 'Nagpur', 'Nagpur', 'Nagpur', 0, 12, 9665687710, 'madhu1@gmail.com', '456', '2134567890', 1, 1, 0, '0000-00-00 00:00:00', NULL, NULL, '2024-08-12', 0, '2024-08-12', '2024-09-08 20:36:39', NULL, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees_data`
--

CREATE TABLE `employees_data` (
  `EmployeeId` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Birthdate` varchar(255) NOT NULL,
  `Gender` varchar(244) NOT NULL,
  `MaritalStatus` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `Address1` varchar(255) NOT NULL,
  `Address2` varchar(255) NOT NULL,
  `Address3` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `AadharNumber` int(255) NOT NULL,
  `JoinDate` varchar(255) NOT NULL,
  `LeaveDate` varchar(255) NOT NULL,
  `StatusId` varchar(255) NOT NULL,
  `RoleId` varchar(255) NOT NULL,
  `PositionId` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `SalaryPaid` varchar(255) NOT NULL,
  `SalaryUnpaid` varchar(255) NOT NULL,
  `ProfileImage` varchar(255) NOT NULL,
  `DaysPresent` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_data`
--

INSERT INTO `employees_data` (`EmployeeId`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Gender`, `MaritalStatus`, `Mobile`, `Address1`, `Address2`, `Address3`, `State`, `City`, `AadharNumber`, `JoinDate`, `LeaveDate`, `StatusId`, `RoleId`, `PositionId`, `Email`, `Password`, `Salary`, `SalaryPaid`, `SalaryUnpaid`, `ProfileImage`, `DaysPresent`) VALUES
(1, 'Madhu', 'Sanjay', 'dhobale', '2005/05/17', 'Female', 'UnMarried', '09665687710', 'Nagpur', 'Nagpur', 'Nagpur', 'Maharashtra', ' Nagpur ', 2134567890, '2024/08/07', '2024/09/30', 'Active', 'Employee', 'PHP Developer', 'madhu@gmail.com', '123', '15k', '220,000', '5,000', '66e6fd1b8e09a-flower pot.jpg', 4),
(2, 'Madhavi', 'Sanjay', 'Dhobale', '2024/05/14', 'Female', 'UnMarried', '09665687710', 'Nagpur', 'Nagpur', '', 'Maharashtra', ' Nagpur ', 2134567890, '2024/09/23', '2024/09/30', 'Active', 'Employee', 'Android', 'pihu89@gmail.com', '98', '20,000', '14,000', '6,000', '66e70d8732c05-download (1).jpeg', 9),
(4, 'Arya', 'Sanjay', 'Dhobale', '2013/08/17', 'Female', 'UnMarried', '09665687710', 'Nagpur', 'Nagpur', '', 'Delhi', ' New Delhi ', 2134567890, '2024/09/30', '2024/09/23', 'Active', 'Admin', 'C##', 'pihu0987@gmail.com', '123', '15k', '20,000', '2,000', '66e7161236d29-WhatsApp Image 2024-09-14 at 17.11.52_270a61ae.jpg', 7),
(5, 'Mansi', 'bcd', 'Dongre', '2024/09/02', 'Female', 'UnMarried', '98785444344', 'RUI', 'NAGPUR', 'MAHARASTRA', 'Dadra & Nagar Haveli', ' Luari ', 2147483647, '2024/09/24', '2024/09/30', 'Active', 'Employee', 'java', 'mansi@gmail.com', '8989', '20,000', '5,000', '15,000', '66e7d0a996b2b-Boadicea Brown - Real Silver Jewellery + Be kind to yourself blogger (boadiceabrown) - Profile _ Pinterest.jpg', 0),
(6, 'Leena', 'bcd', 'Suryawanshi', '2024/09/10', 'Female', 'UnMarried', '7865333545', 'Nagpur', 'Nagpur', 'Nagpur', 'Maharashtra', ' Nagpur ', 2147483647, '2024/08/07', '2024/09/25', 'Active', 'Employee', 'PHP Developer', 'leena@gmail.com', '8989', '15k', '5000', '10000', '66e7d10233543-Cream White Cherry Blossom Branch _ Fake Spring Flowers _ Afloral_com.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payments`
--

CREATE TABLE `employee_payments` (
  `PaymentId` int(11) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `BankName` varchar(100) NOT NULL,
  `AccountNumber` int(20) NOT NULL,
  `IFSCCode` varchar(20) NOT NULL,
  `BranchName` varchar(100) NOT NULL,
  `PANCard` varchar(10) NOT NULL,
  `AadharCard` int(12) NOT NULL,
  `Salary` varchar(100) NOT NULL,
  `Reimbursement` int(100) NOT NULL,
  `LoanStatus` varchar(100) NOT NULL,
  `TaxDeduction` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_payments`
--

INSERT INTO `employee_payments` (`PaymentId`, `EmployeeId`, `Name`, `Address`, `Pincode`, `BankName`, `AccountNumber`, `IFSCCode`, `BranchName`, `PANCard`, `AadharCard`, `Salary`, `Reimbursement`, `LoanStatus`, `TaxDeduction`) VALUES
(9, 1, 'Madhavi Sanjay Dhobale', 'Nagpur,MHADA colony Khapriii', 441108, 'Bank of india', 2147483647, 'HNV7589489', 'khapri', '1234557899', 2147483647, '30000', 400, 'Pending', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `leavedays`
--

CREATE TABLE `leavedays` (
  `LeaveDayId` bigint(20) NOT NULL,
  `LeaveDay` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leavedays`
--

INSERT INTO `leavedays` (`LeaveDayId`, `LeaveDay`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `leavedetails`
--

CREATE TABLE `leavedetails` (
  `Detail_Id` bigint(20) NOT NULL,
  `EmpId` bigint(20) NOT NULL,
  `TypesLeaveId` int(10) NOT NULL,
  `Reason` varchar(500) NOT NULL,
  `StateDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `LeaveStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leavedetails`
--

INSERT INTO `leavedetails` (`Detail_Id`, `EmpId`, `TypesLeaveId`, `Reason`, `StateDate`, `EndDate`, `LeaveStatus`) VALUES
(4, 2, 1, 'holiday', '2017-01-31', '2017-02-02', 'Accept'),
(5, 2, 3, 'holiday', '2017-01-31', '2017-02-02', 'Denied'),
(6, 2, 1, 'holiday', '2017-01-31', '2017-02-02', 'Denied'),
(7, 2, 4, 'holiday', '2017-01-31', '2017-02-02', 'Accept'),
(8, 2, 5, 'holiday', '2017-01-31', '2017-02-02', 'Denied'),
(9, 1, 1, 'Sick', '2017-02-12', '2017-03-15', 'Accept'),
(10, 1, 3, 'regarding the college issues', '2024-08-22', '2024-08-23', 'Denied'),
(11, 1, 4, 'regarding the college issues', '2024-08-21', '2024-08-21', 'Accept'),
(12, 1, 5, 'regarding the college issues', '2024-08-21', '2024-08-21', 'Accept'),
(13, 1, 1, 'medical issue', '1970-01-01', '1970-01-01', 'Denied'),
(14, 1, 3, 'medical issue', '1970-01-01', '1970-01-01', 'Accept'),
(15, 1, 4, 'regarding the college issues', '1970-01-01', '1970-01-01', 'Accept'),
(16, 1, 3, 'regarding the college issues', '2024-08-23', '2015-07-14', 'Denied'),
(17, 1, 3, 'dont ask........', '2024-08-27', '2024-08-30', 'Accept'),
(18, 1, 1, 'medical issue', '2024-09-08', '2024-09-10', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `id` int(11) NOT NULL,
  `EmployeeId` int(15) NOT NULL,
  `LoginTime` varchar(255) NOT NULL,
  `LogoutTime` datetime DEFAULT NULL,
  `TotalHours` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` (`id`, `EmployeeId`, `LoginTime`, `LogoutTime`, `TotalHours`) VALUES
(1, 1, '2024-09-16 12:35:34', '2024-09-16 12:38:38', '3 minute(s)'),
(2, 2, '2024-09-16 12:36:45', '2024-09-16 14:54:21', '2 hour(s) 17 minute(s)'),
(3, 4, '2024-09-16 12:36:49', NULL, ''),
(4, 6, '2024-09-16 12:36:52', NULL, ''),
(5, 1, '2024-09-16 12:41:46', NULL, ''),
(6, 4, '2024-09-16 14:58:55', '2024-09-18 11:28:45', '44 hour(s) 29 minute(s)'),
(7, 5, '2024-09-16 14:59:46', '2024-09-27 11:57:42', '260 hour(s) 57 minute(s)'),
(8, 1, '2024-09-27 11:57:26', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_info`
--

CREATE TABLE `payroll_info` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Shift` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `FromMonth` varchar(100) NOT NULL,
  `ToMonth` varchar(100) NOT NULL,
  `Duration` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_info`
--

INSERT INTO `payroll_info` (`id`, `Name`, `Department`, `Shift`, `Year`, `FromMonth`, `ToMonth`, `Duration`) VALUES
(1, 'Madhavi Dhobale', 'Admin', 'Morning', 2024, 'January', 'May', '6 months');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pid` int(100) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pmgr` varchar(255) NOT NULL,
  `plocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `pname`, `pmgr`, `plocation`) VALUES
(123456, 'clone of facebook', 'madhavii dhobale', 'khapri');

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE `todo_list` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `action` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todo_list`
--

INSERT INTO `todo_list` (`id`, `task`, `datetime`, `status`, `action`) VALUES
(3, 'Dashboard Activity Management', '2024-09-16 01:00:00', 'Done', ''),
(5, 'regarding hospital management', '2024-09-17 17:51:00', 'Done', ''),
(7, 'attendance activity', '2024-09-17 01:00:00', 'Done', '');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_leave`
--

CREATE TABLE `type_of_leave` (
  `LeaveId` bigint(20) NOT NULL,
  `Type_of_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `type_of_leave`
--

INSERT INTO `type_of_leave` (`LeaveId`, `Type_of_Name`) VALUES
(1, 'sick leave'),
(3, 'casual leave'),
(4, 'privilege leave'),
(5, 'half day leave');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `vid` int(100) NOT NULL,
  `vname` varchar(250) NOT NULL,
  `vidate` varchar(255) NOT NULL,
  `vedate` varchar(255) NOT NULL,
  `vpreq` varchar(255) NOT NULL,
  `vdreq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`vid`, `vname`, `vidate`, `vedate`, `vpreq`, `vdreq`) VALUES
(21, 'madhavi', '2024-09-07', '2024-09-08', 'web developersssssssss', 'b.voc');

-- --------------------------------------------------------

--
-- Table structure for table `working_data_of_emp`
--

CREATE TABLE `working_data_of_emp` (
  `id` int(255) NOT NULL,
  `year` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `working_data_of_emp`
--

INSERT INTO `working_data_of_emp` (`id`, `year`, `month`, `day`) VALUES
(1, '3456', '43', '23'),
(2, '1234', '45', '57'),
(3, '2024', '12', '23'),
(4, '2019', '05', '23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeId`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `employees_data`
--
ALTER TABLE `employees_data`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `employee_payments`
--
ALTER TABLE `employee_payments`
  ADD PRIMARY KEY (`PaymentId`);

--
-- Indexes for table `leavedays`
--
ALTER TABLE `leavedays`
  ADD PRIMARY KEY (`LeaveDayId`);

--
-- Indexes for table `leavedetails`
--
ALTER TABLE `leavedetails`
  ADD PRIMARY KEY (`Detail_Id`);

--
-- Indexes for table `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_info`
--
ALTER TABLE `payroll_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_leave`
--
ALTER TABLE `type_of_leave`
  ADD PRIMARY KEY (`LeaveId`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `working_data_of_emp`
--
ALTER TABLE `working_data_of_emp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `emp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8091;

--
-- AUTO_INCREMENT for table `employees_data`
--
ALTER TABLE `employees_data`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_payments`
--
ALTER TABLE `employee_payments`
  MODIFY `PaymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leavedays`
--
ALTER TABLE `leavedays`
  MODIFY `LeaveDayId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leavedetails`
--
ALTER TABLE `leavedetails`
  MODIFY `Detail_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payroll_info`
--
ALTER TABLE `payroll_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- AUTO_INCREMENT for table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_of_leave`
--
ALTER TABLE `type_of_leave`
  MODIFY `LeaveId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `vid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `working_data_of_emp`
--
ALTER TABLE `working_data_of_emp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
