-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2018 at 05:00 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ivcts`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_test` (`var1` INT)  BEGIN   
    DECLARE start  INT unsigned DEFAULT 1;  
    DECLARE finish INT unsigned DEFAULT 10;

    SELECT  var1, start, finish;

    SELECT * FROM places WHERE place BETWEEN start AND finish; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `employeeId` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `username`, `password`, `employeeId`, `isAdmin`, `isDeleted`) VALUES
(1, 'tnson', '$2y$13$IHMwc5.3uSpv0qf2c8MweO6B2Rry6BEfeogYm3pZbcQagPFIJ0W7y', 1, 1, 0),
(2, 'toan', '$2y$13$IVu/pUjGu0lznCBOk0SbKup.qRgZX7Hb8IkC4EX1GnG5MVaSe5tcC', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configID` int(11) NOT NULL,
  `configName` varchar(255) NOT NULL DEFAULT '''''',
  `value` varchar(255) NOT NULL DEFAULT ''''''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `departmentStatus` tinyint(1) NOT NULL DEFAULT '1',
  `displayOrder` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `employeeName` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `employeeCode` varchar(6) NOT NULL,
  `levelID` int(11) NOT NULL,
  `employeeStatus` tinyint(1) NOT NULL DEFAULT '1',
  `sectionID` int(11) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(4) NOT NULL DEFAULT '''''',
  `supervisorID` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `lastUpdate` date DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `maritalStatus` tinyint(1) DEFAULT '0',
  `telephone` varchar(20) DEFAULT '''',
  `mobile` varchar(20) DEFAULT '''',
  `registeredAddress` varchar(250) DEFAULT '''',
  `currentAddress` varchar(250) DEFAULT '''',
  `email` varchar(50) DEFAULT NULL,
  `rank` tinyint(1) DEFAULT '1',
  `ivisAccount` varchar(45) DEFAULT NULL,
  `redmineAccount` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `employeeName`, `username`, `password`, `employeeCode`, `levelID`, `employeeStatus`, `sectionID`, `isAdmin`, `salt`, `supervisorID`, `startDate`, `endDate`, `lastUpdate`, `DoB`, `maritalStatus`, `telephone`, `mobile`, `registeredAddress`, `currentAddress`, `email`, `rank`, `ivisAccount`, `redmineAccount`) VALUES
(1, 'son', 'son', '$2y$13$4A4DrvCL43h6JEkpPEFk7etlJID/ohB/v8.Uu/i61MlRQGWGnQUaW', '00011', 5, 1, 3, 1, '\'\'', NULL, '2018-07-01', '2018-07-28', NULL, '2018-08-01', 1, NULL, '111', '', '\'', '', 1, NULL, NULL),
(2, 'Nguyễn Duy Việt Toàn', 'toan', '$2y$13$n0K4QMqG62Luy.PhuEQlh.Hv/OQ9.j1IumTQ3Zc8uoE578AyvGoqK', '0001', 5, 1, 2, 0, '\'\'', 1234, '2018-06-14', '2018-08-10', NULL, '1997-08-08', 0, '0974895872', '01649973459', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', 'viettoan.bk1997@gmail.com', 3, 'tret', 'tretert'),
(25, 'Nguyễn Vũ', 'vu', '$2y$13$JKmH8Yg.Nd.SsQI.gIosf.8LDwfokCteKEKfaeIP4tqaLZNSxB3Na', '0002', 2, 1, 4, 0, '\'\'', 0, NULL, NULL, NULL, NULL, 1, '', '12345', '', '', '', 2, NULL, NULL),
(26, 'huy', 'huy', '$2y$13$dc8etHFUKxHwwlSE8PZ6G.ZCyKq.KMncysE2ISrvQdC2ujSXsg.mS', '0003', 1, 1, 4, 0, '\'\'', 0, NULL, NULL, NULL, NULL, 1, '', '', '', '', '', NULL, NULL, NULL),
(27, 'Hùng', 'hung', '$2y$13$DQRVT/DcGjK6Dtj1eSdEkux/5roV4unq7V3o.4rmD94ZlR2ZgIYfy', '0004', 2, 1, 4, 0, '\'\'', 0, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL),
(28, 'Dũng', NULL, '$2y$13$.sn/kKWPz7EFXP69rvDke.UZ.Nm7KwVRD9LMhVWla7OW2y5S21ADy', '1212', 2, 1, 10, 0, '\'\'', 0, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_employee` AFTER DELETE ON `employee` FOR EACH ROW INSERT INTO employee_l (employeeCode,employeeName, username, levelID,sectionID,rank, status, startDate, endDate, DoB, supervisorId,maritalStatus,mobile,telephone,email,registeredAddress,currentAddress,action )
VALUES (OLD.employeeCode, OLD.employeeName, OLD.username, OLD.levelID, OLD.sectionID, OLD.rank, OLD.employeeStatus, OLD.startDate, OLD.endDate, OLD.DoB, OLD.supervisorID, OLD.maritalStatus,OLD.mobile,OLD.telephone,OLD.email,OLD.registeredAddress,OLD.currentAddress,'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_employee` AFTER INSERT ON `employee` FOR EACH ROW INSERT INTO employee_l (employeeCode,employeeName, username, levelID,sectionID,rank, status, startDate, endDate, DoB, supervisorId,maritalStatus,mobile,telephone,email,registeredAddress,currentAddress,action )
VALUES (NEW.employeeCode, NEW.employeeName, NEW.username, NEW.levelID, NEW.sectionID, NEW.rank, NEW.employeeStatus, NEW.startDate, NEW.endDate, NEW.DoB, NEW.supervisorID, NEW.maritalStatus,NEW.mobile,NEW.telephone,NEW.email,NEW.registeredAddress,NEW.currentAddress,'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_employee` AFTER UPDATE ON `employee` FOR EACH ROW INSERT INTO employee_l (employeeCode,employeeName, username, levelID,sectionID,rank, status, startDate, endDate, DoB, supervisorId,maritalStatus,mobile,telephone,email,registeredAddress,currentAddress,action )
VALUES (NEW.employeeCode, NEW.employeeName, NEW.username, NEW.levelID, NEW.sectionID, NEW.rank, NEW.employeeStatus, NEW.startDate, NEW.endDate, NEW.DoB, NEW.supervisorID, NEW.maritalStatus,NEW.mobile,NEW.telephone,NEW.email,NEW.registeredAddress,NEW.currentAddress,'UPDATE')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_l`
--

CREATE TABLE `employee_l` (
  `ID` int(11) NOT NULL,
  `employeeCode` varchar(6) COLLATE utf8_vietnamese_ci NOT NULL,
  `employeeName` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `levelID` int(11) DEFAULT NULL,
  `sectionID` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `Dob` date DEFAULT NULL,
  `supervisorID` int(11) DEFAULT NULL,
  `maritalStatus` tinyint(1) DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `registeredAddress` text COLLATE utf8_vietnamese_ci,
  `currentAddress` text COLLATE utf8_vietnamese_ci,
  `updateBy` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `note` text COLLATE utf8_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `employee_l`
--

INSERT INTO `employee_l` (`ID`, `employeeCode`, `employeeName`, `username`, `levelID`, `sectionID`, `rank`, `status`, `startDate`, `endDate`, `Dob`, `supervisorID`, `maritalStatus`, `mobile`, `telephone`, `email`, `registeredAddress`, `currentAddress`, `updateBy`, `updateTime`, `action`, `note`) VALUES
(6, '0001', 'toan', 'toan', 7, 5, 1, 1, '2018-08-01', '2018-07-31', '2018-07-31', 0, 0, '01649973459', '01649973459', 'baoviet1212@gmail.com', '\'', 'thành phố kontum', NULL, '2018-07-17 08:27:36', 'UPDATE', NULL),
(7, '1212', 'sss1', 'ss', 9, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-17 08:57:54', 'INSERT', NULL),
(8, '1111', 'hung', 'hung', 1, 2, 1, 0, NULL, NULL, NULL, NULL, 0, '01649973459', NULL, 'hung@gmail.com', '\'', '\'', NULL, '2018-07-17 08:59:12', 'INSERT', NULL),
(9, '0006', 'vu', 'vuISB1997', 19, 2, 3, 0, NULL, NULL, NULL, NULL, 0, '1234567890', NULL, 'vu@gmail.com', '\'', 'hcm', NULL, '2018-07-17 08:59:12', 'INSERT', NULL),
(10, '0988', 'huy', NULL, 6, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '', '', 'huy@gmail.com', '', '', NULL, '2018-07-17 08:59:12', 'INSERT', NULL),
(11, '323', 'dsad', NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', NULL, '2018-07-17 08:59:12', 'INSERT', NULL),
(12, '12', 'dasdasd', NULL, 7, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', NULL, '2018-07-17 08:59:12', 'INSERT', NULL),
(13, '00011', 'son', 'son', 5, 3, 1, 1, '2018-07-01', '2018-07-28', '2018-08-01', NULL, 1, '111', NULL, '', '', '\'', NULL, '2018-07-17 09:06:03', 'UPDATE', NULL),
(14, '0002', 'vu', NULL, 8, 2, 2, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-17 09:30:20', 'INSERT', NULL),
(15, '0002', 'vu', 'vu', 8, 2, 2, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-17 09:32:58', 'UPDATE', NULL),
(16, '0002', 'vu', 'vu', 8, 2, 2, 1, NULL, NULL, NULL, 0, NULL, '12345', '', '', '', '', NULL, '2018-07-17 13:29:02', 'UPDATE', NULL),
(17, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 5, 3, 1, '2018-08-01', '2018-07-31', '1997-08-08', 0, 0, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'thành phố kontum', 'thành phố Hồ Chí Mình', NULL, '2018-07-17 13:44:41', 'UPDATE', NULL),
(18, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 0, 0, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'thành phố kontum', 'thành phố Hồ Chí Mình', NULL, '2018-07-17 13:50:47', 'UPDATE', NULL),
(19, '0002', 'Nguyễn Vũ', 'vu', 8, 2, 2, 1, NULL, NULL, NULL, 0, NULL, '12345', '', '', '', '', NULL, '2018-07-17 16:46:39', 'UPDATE', NULL),
(20, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 0, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'thành phố kontum', 'thành phố Hồ Chí Mình', NULL, '2018-07-17 16:51:12', 'UPDATE', NULL),
(21, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 1, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 0, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'thành phố kontum', 'thành phố Hồ Chí Mình', NULL, '2018-07-17 16:51:26', 'UPDATE', NULL),
(22, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 1, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'thành phố kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:52:41', 'UPDATE', NULL),
(23, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 1, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:57:39', 'UPDATE', NULL),
(24, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 7, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:57:52', 'UPDATE', NULL),
(25, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 5, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:58:03', 'UPDATE', NULL),
(26, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 2, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'baoviet1212@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:58:15', 'UPDATE', NULL),
(27, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 2, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 1, '01649973459', '0974895872', 'viettoan.bk1997@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:58:52', 'UPDATE', NULL),
(28, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 2, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 0, '01649973459', '0974895872', 'viettoan.bk1997@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-17 16:59:01', 'UPDATE', NULL),
(29, '0002', 'Nguyễn Vũ', 'vu', 8, 4, 2, 1, NULL, NULL, NULL, 0, 1, '12345', '', '', '', '', NULL, '2018-07-18 10:48:25', 'UPDATE', NULL),
(30, '0002', 'Nguyễn Vũ', 'vu', 8, 4, 2, 1, NULL, NULL, NULL, 0, 1, '12345', '', '', '', '', NULL, '2018-07-18 11:12:20', 'UPDATE', NULL),
(31, '0003', 'huy', NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-18 13:19:29', 'INSERT', NULL),
(32, '0002', 'Nguyễn Vũ', 'vu', 2, 4, 2, 1, NULL, NULL, NULL, 0, 1, '12345', '', '', '', '', NULL, '2018-07-18 14:00:08', 'UPDATE', NULL),
(33, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 5, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 0, '01649973459', '0974895872', 'viettoan.bk1997@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-07-18 14:00:28', 'UPDATE', NULL),
(34, '0003', 'huy', 'huy', 1, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-19 08:40:32', 'UPDATE', NULL),
(35, '0003', 'huy', 'huy', 1, 4, NULL, 1, NULL, NULL, NULL, 0, 1, '', '', '', '', '', NULL, '2018-07-22 18:43:22', 'UPDATE', NULL),
(36, '0004', 'Hùng', NULL, 2, 4, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-22 18:44:04', 'INSERT', NULL),
(37, '0004', 'Hùng', 'hung', 2, 4, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-23 08:34:23', 'UPDATE', NULL),
(38, '0002', 'Nguyễn Vũ', 'vu', 2, 4, 2, 1, NULL, NULL, NULL, 0, 1, '12345', '', '', '', '', NULL, '2018-07-26 08:49:11', 'UPDATE', NULL),
(39, '1212', 'Dũng', NULL, 2, 10, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-27 15:21:50', 'INSERT', NULL),
(40, '12121', 'Dũng', NULL, 2, 10, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-27 15:29:28', 'UPDATE', NULL),
(41, '1212', 'Dũng', NULL, 2, 10, NULL, 1, NULL, NULL, NULL, 0, NULL, '', '', '', '', '', NULL, '2018-07-27 15:30:49', 'UPDATE', NULL),
(42, '0001', 'Nguyễn Duy Việt Toàn', 'toan', 5, 2, 3, 1, '2018-06-14', '2018-08-10', '1997-08-08', 1234, 0, '01649973459', '0974895872', 'viettoan.bk1997@gmail.com', 'Thu Bồn Street, Kontum', 'C1 Department, 9 District, Hồ Chí Mình', NULL, '2018-08-03 08:56:53', 'UPDATE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enum_define`
--

CREATE TABLE `enum_define` (
  `enumDefine` int(11) NOT NULL,
  `tableName` varchar(255) NOT NULL DEFAULT '''''',
  `colName` varchar(255) NOT NULL DEFAULT '''''',
  `value` tinyint(2) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL DEFAULT '''''',
  `displayOrder` smallint(2) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enum_define`
--

INSERT INTO `enum_define` (`enumDefine`, `tableName`, `colName`, `value`, `description`, `displayOrder`, `enabled`) VALUES
(1, 'project', 'projectStatus', 0, 'Closed', 0, 1),
(2, 'project', 'projectStatus', 1, 'Open', 0, 1),
(3, 'project', 'OTStatus', 0, 'False', 0, 1),
(4, 'project', 'OTStatus', 1, 'True', 0, 1),
(5, 'period', 'periodStatus', 0, 'New', 0, 1),
(6, 'period', 'periodStatus', 1, 'In Progress', 0, 1),
(7, 'period', 'periodStatus', 2, 'Closed', 0, 1),
(8, 'employee_language_skill', 'level', 0, 'Unable', 0, 1),
(9, 'employee_language_skill', 'level', 1, 'Below average', 0, 1),
(10, 'employee_language_skill', 'level', 2, 'Average', 0, 1),
(11, 'employee_language_skill', 'level', 3, 'Good', 0, 1),
(12, 'employee_language_skill', 'level', 4, 'Excellent', 0, 1),
(13, 'employee_technical_skill', 'level', 0, 'Unable', 0, 1),
(14, 'employee_technical_skill', 'level', 1, 'A little bit', 0, 1),
(15, 'employee_technical_skill', 'level', 2, 'Average', 0, 1),
(16, 'employee_technical_skill', 'level', 3, 'Good', 0, 1),
(17, 'employee_technical_skill', 'level', 4, 'Excellent', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_privilege`
--

CREATE TABLE `group_privilege` (
  `groupId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '',
  `hasChild` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `group_privilege`
--

INSERT INTO `group_privilege` (`groupId`, `name`, `icon`, `hasChild`) VALUES
(2, 'Project', 'fa-book', 1),
(3, 'Employee', 'fa-user', 1),
(4, 'Report', 'fa-file', 1),
(5, 'Resource', 'fa-photo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `levelID` int(11) NOT NULL,
  `levelName` varchar(255) NOT NULL,
  `levelStatus` tinyint(1) NOT NULL DEFAULT '1',
  `displayOrder` tinyint(2) NOT NULL DEFAULT '0',
  `levelCode` varchar(10) NOT NULL DEFAULT 'EM'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`levelID`, `levelName`, `levelStatus`, `displayOrder`, `levelCode`) VALUES
(1, 'Production Director', 1, 1, 'PD'),
(2, 'Production Manager', 1, 3, 'PM'),
(3, 'Production Leader', 1, 6, 'PL'),
(4, 'Production Sub Leader', 1, 8, 'PL'),
(5, 'Senior Software Engineer', 1, 9, 'EM'),
(6, 'Middle Software Engineer', 1, 10, 'EM'),
(7, 'Junior Software Engineer', 1, 12, 'EM'),
(8, 'Senior Manager', 1, 2, 'PM'),
(9, 'Senior Production Leader', 1, 4, 'PL'),
(10, 'Senior Technical Expert', 1, 5, 'PL'),
(11, 'Technical Expert', 1, 7, 'PL'),
(12, 'QC Manager', 1, 12, 'PM'),
(13, 'QC Leader', 1, 13, 'PL'),
(14, 'QC Expert', 1, 14, 'PL'),
(15, 'QC Sub Leader', 1, 15, 'PL'),
(16, 'Senior QC Engineer', 1, 16, 'EM'),
(17, 'QC Specialist', 1, 17, 'EM'),
(18, 'Interpreter Manager', 1, 18, 'PM'),
(19, 'Senior Interpreter Leader', 1, 19, 'PL'),
(20, 'Interpreter Expert', 1, 20, 'PL'),
(21, 'Interpreter Sub Leader', 1, 21, 'PL'),
(22, 'Senior Interpreter', 1, 22, 'EM'),
(23, 'Middle Interpreter', 1, 23, 'EM'),
(24, 'Junior Interpreter', 1, 24, 'EM'),
(25, 'Senior Web Designer', 1, 25, 'EM'),
(26, 'Middle Web Designer', 1, 26, 'EM'),
(27, 'Junior Web Designer', 1, 27, 'EM'),
(28, 'Technical Specialist', 1, 28, 'EM');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `periodID` int(11) NOT NULL,
  `month` smallint(2) NOT NULL DEFAULT '1',
  `year` smallint(2) NOT NULL DEFAULT '2017',
  `workingHour` smallint(3) DEFAULT '0',
  `periodStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`periodID`, `month`, `year`, `workingHour`, `periodStatus`) VALUES
(1, 3, 2018, 160, 1),
(2, 4, 2018, 152, 1),
(3, 5, 2018, 160, 1),
(4, 1, 2017, 0, 1),
(11, 6, 2018, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `power`
--

CREATE TABLE `power` (
  `workingId` int(11) NOT NULL,
  `privilegeId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `accountPower` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `power`
--

INSERT INTO `power` (`workingId`, `privilegeId`, `accountId`, `accountPower`) VALUES
(77, 7, 2, '$2y$13$61j38Chs/ZpeOkyTGwyLq.6FzAWsQLreDqghQDhVbnXgEjmRhg0xO'),
(78, 10, 25, '$2y$13$vbaQw8yRMaBgWdLMx7LmU.fkkaZXt/8e.5/CTzEL4d07tJNF8ry1y'),
(79, 10, 2, '$2y$13$M7pYQ9ZVau3TvCosv7AvCeo/zpkvJoBWDzY3EhZ2LgcV5V2bgYDQ2'),
(81, 9, 2, '$2y$13$79r8cbwI.hDsRxM4cJvkxeFgeprKk/U7JFPdphlTL0k/KGT6qz7xi'),
(82, 14, 2, '$2y$13$sBSx8x23sCigmJ1qaZaRa.B6CdgmlFGAZxyjN1MsF1uJbf7zy7zUy'),
(83, 14, 25, '$2y$13$AJc9mMOdopkNMiWNnXxejuV1aRbSmLikBV3.MLuSmeT7gxXb.S2QG'),
(84, 14, 26, '$2y$13$GK5ZGlWlD2P.KT9viJpRf.T19hyVD1IZyE/1RLGjhlHOedCKfph2.'),
(85, 15, 26, '$2y$13$ywLO/p12d.cwftYrNcxvpOggdJX89e2XcAW4EGkTSo6AjP/AolwvC'),
(86, 8, 2, '$2y$13$jDzmMQ8iJXt3nuGY9wCMtO0YXYPeABvS1I4fFBxShK.K2QsE.wnwu'),
(87, 11, 2, '$2y$13$bCdrtTPSdorS5AwgT9RG5uJHprNjMVHsJPxZy7PMduRs6DU2LcP8G'),
(88, 13, 2, '$2y$13$lM8jeq76v0jI3nvLh/n82uS9OIO483DugvuD/1utSJEPEnhitwS4u'),
(89, 15, 2, '$2y$13$F1u93Iop/2slL0yeGeLBQO9YzKT59IzlzjrFySy6rCrJrI3qDBUWi'),
(90, 16, 2, '$2y$13$Rnn2xDT6ISrumKYDT8k.AuZjBZ3mdYkCjMB1pmhb8alOi.khggJYi'),
(91, 17, 2, '$2y$13$mEycpp2z2.Byi4QRFYBpCePiGwQWZA6FiP0dDAXZB9rOc9pm9OVD2'),
(92, 18, 2, '$2y$13$t2JdTs104l3E8MoM5k9RCO4cktGwKXulKc.Qfsska3gouPyvKuiZa');

--
-- Triggers `power`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_power` AFTER DELETE ON `power` FOR EACH ROW INSERT INTO `power_l`(employeeID,privilegeID,value) VALUES(OLD.accountId,OLD.privilegeId,NULL)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_power` AFTER INSERT ON `power` FOR EACH ROW INSERT INTO `power_l`(employeeID,privilegeID,value) VALUES(NEW.accountId,NEW.privilegeId,NEW.accountPower)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_power` AFTER UPDATE ON `power` FOR EACH ROW INSERT INTO `power_l`(employeeID,privilegeID,value) VALUES(NEW.accountId,NEW.privilegeId,NEW.accountPower)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `power_l`
--

CREATE TABLE `power_l` (
  `ID` int(11) NOT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `privilegeID` int(11) DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `updateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updateBy` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `power_l`
--

INSERT INTO `power_l` (`ID`, `employeeID`, `privilegeID`, `value`, `updateTime`, `updateBy`, `note`) VALUES
(1, 25, 9, '$2y$13$lqKaehCmdbkEbKPCm6kmQu4CajoLh5K4cw2Pp.SNv1pMaI9YcNiOe', '2018-07-17 10:38:15', NULL, NULL),
(2, 2, 9, '$2y$13$UGe88pY1o5hOzlEY73vdlePZEbsZWObgKWfI9lcZc7JsCnucc5QvK', '2018-07-17 10:38:15', NULL, NULL),
(3, 2, 9, '$2y$13$79r8cbwI.hDsRxM4cJvkxeFgeprKk/U7JFPdphlTL0k/KGT6qz7xi', '2018-07-17 10:38:38', NULL, NULL),
(4, 25, 9, NULL, '2018-07-17 10:38:44', NULL, NULL),
(5, 2, 10, '$2y$13$M7pYQ9ZVau3TvCosv7AvCeo/zpkvJoBWDzY3EhZ2LgcV5V2bgYDQ2', '2018-07-17 11:28:47', NULL, NULL),
(6, 2, 14, '$2y$13$sBSx8x23sCigmJ1qaZaRa.B6CdgmlFGAZxyjN1MsF1uJbf7zy7zUy', '2018-07-18 15:19:24', NULL, NULL),
(7, 25, 14, '$2y$13$AJc9mMOdopkNMiWNnXxejuV1aRbSmLikBV3.MLuSmeT7gxXb.S2QG', '2018-07-18 15:19:25', NULL, NULL),
(8, 26, 14, '$2y$13$GK5ZGlWlD2P.KT9viJpRf.T19hyVD1IZyE/1RLGjhlHOedCKfph2.', '2018-07-18 15:19:25', NULL, NULL),
(9, 26, 15, '$2y$13$ywLO/p12d.cwftYrNcxvpOggdJX89e2XcAW4EGkTSo6AjP/AolwvC', '2018-07-27 15:40:18', NULL, NULL),
(10, 2, 8, '$2y$13$jDzmMQ8iJXt3nuGY9wCMtO0YXYPeABvS1I4fFBxShK.K2QsE.wnwu', '2018-08-03 08:54:33', NULL, NULL),
(11, 2, 11, '$2y$13$bCdrtTPSdorS5AwgT9RG5uJHprNjMVHsJPxZy7PMduRs6DU2LcP8G', '2018-08-03 08:54:46', NULL, NULL),
(12, 2, 13, '$2y$13$lM8jeq76v0jI3nvLh/n82uS9OIO483DugvuD/1utSJEPEnhitwS4u', '2018-08-03 08:54:53', NULL, NULL),
(13, 2, 15, '$2y$13$LB2aAjS8pCWINozHyk.TFO7i5XMeV7Zlv6G0RtnkieDh5qX739Wey', '2018-08-03 08:55:02', NULL, NULL),
(14, 2, 15, '$2y$13$F1u93Iop/2slL0yeGeLBQO9YzKT59IzlzjrFySy6rCrJrI3qDBUWi', '2018-08-03 08:55:10', NULL, NULL),
(15, 2, 16, '$2y$13$0vSUoteZyq11geDpvPjTCO.0pyNWL2nqtfWfHJlJti0rvIOk8Km4e', '2018-08-03 08:55:18', NULL, NULL),
(16, 2, 16, '$2y$13$Rnn2xDT6ISrumKYDT8k.AuZjBZ3mdYkCjMB1pmhb8alOi.khggJYi', '2018-08-03 08:55:27', NULL, NULL),
(17, 2, 17, '$2y$13$mEycpp2z2.Byi4QRFYBpCePiGwQWZA6FiP0dDAXZB9rOc9pm9OVD2', '2018-08-03 08:55:28', NULL, NULL),
(18, 2, 18, '$2y$13$t2JdTs104l3E8MoM5k9RCO4cktGwKXulKc.Qfsska3gouPyvKuiZa', '2018-08-03 08:55:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `privilegeId` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `groupId` int(11) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `functionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`privilegeId`, `isDeleted`, `name`, `groupId`, `link`, `functionId`) VALUES
(7, 0, 'Create Project', 2, '/project/create-project', 7),
(8, 0, 'Project Sale Plan For SDC', 2, '/project/project-sale-plan?p=1', 8),
(9, 0, 'Manage', 3, '/employee/manage', 9),
(10, 0, 'Account', 3, '/employee/account', 10),
(11, 0, 'Input Actual', 5, '/resource/input-actual', 6),
(13, 0, 'Input Plan 1', 5, '/resource/input-plan', 5),
(14, 0, 'Rpt Compare Effort', 4, '/report/rpt-compare-effort', 11),
(15, 0, 'Effort', 4, '/report/effort', 12),
(16, 0, 'Period Report', 4, '/report/period', 13),
(17, 0, 'Project Report', 4, '/report/project', 14),
(18, 0, 'Project Sale Plan For PM', 2, '/project/project-sale-plan?p=0', 15);

-- --------------------------------------------------------

--
-- Table structure for table `project_group`
--

CREATE TABLE `project_group` (
  `groupID` int(11) NOT NULL,
  `groupNAme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_group`
--

INSERT INTO `project_group` (`groupID`, `groupNAme`) VALUES
(3, 'abcd'),
(6, 'abcxyz'),
(1, 'BookLive'),
(4, 'QT Font'),
(2, 'VPM');

-- --------------------------------------------------------

--
-- Table structure for table `project_l`
--

CREATE TABLE `project_l` (
  `ID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL DEFAULT '0',
  `projectName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `projectCode` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '''''',
  `OTStatus` tinyint(4) NOT NULL DEFAULT '1',
  `projectStatus` tinyint(1) NOT NULL DEFAULT '0',
  `endDate` datetime DEFAULT NULL,
  `redmineURL` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `redmineID` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ivisID` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sdcCode` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `updateBy` int(11) NOT NULL,
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(10) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_l`
--

INSERT INTO `project_l` (`ID`, `projectID`, `projectName`, `projectCode`, `OTStatus`, `projectStatus`, `endDate`, `redmineURL`, `redmineID`, `ivisID`, `sdcCode`, `groupId`, `updateBy`, `updateTime`, `action`, `note`) VALUES
(4, 4, 'WebView vs Chrome Custom Tabs', '126864', 1, 1, '2018-03-29 00:00:00', 'http://10.1.0.190/redmine/projects/booklive/issues', '126864', '126864', '126864', 1, 1, '2018-03-29 10:58:40', 'INSERT', ''),
(5, 5, 'Android task', '127129', 0, 0, '2018-03-25 00:00:00', 'http://10.1.0.190/redmine/projects', '127129', '127129', '127129', 3, 1, '2018-03-29 11:04:47', 'INSERT', ''),
(6, 6, 'Iphone task', '127088', 0, 1, '2018-03-30 00:00:00', 'http://10.1.0.190/redmine/projects', '127088', '127088', '127088', 3, 1, '2018-03-29 11:05:59', 'INSERT', ''),
(7, 7, 'Font-family', '126810', 1, 1, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/projects/qtfont/issues', '126810', '126810', '126810', 4, 1, '2018-03-29 11:07:18', 'INSERT', ''),
(15, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', 2, 1, '2018-03-29 14:26:39', 'INSERT', ''),
(16, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', NULL, 1, '2018-03-29 14:26:54', 'UPDATE', ''),
(17, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', 2, 1, '2018-03-29 14:29:20', 'UPDATE', ''),
(18, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', NULL, 1, '2018-03-29 14:30:04', 'UPDATE', ''),
(19, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', 2, 1, '2018-03-29 14:33:23', 'UPDATE', ''),
(20, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', 2, 1, '2018-03-29 14:35:19', 'UPDATE', ''),
(21, 14, 'Investigating', '1', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects', '1', '1', '1', 2, 1, '2018-03-29 14:37:55', 'DELETE', ''),
(22, 14, 'Investigating', '1', 1, 0, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects/booklive', '1', '1', '1', NULL, 1, '2018-03-29 14:38:39', 'INSERT', ''),
(23, 14, 'Investigating', '126172', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects/booklive', '126172', '126172', '126172', 2, 1, '2018-03-29 14:39:26', 'UPDATE', ''),
(24, 15, 'Camera Android app', '120910', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120910', NULL, 1, '2018-04-04 13:49:56', 'INSERT', ''),
(26, 16, 'iyui', 'iyui', 0, 1, NULL, '', '', '', '', NULL, 1, '2018-06-27 09:53:14', 'REMOVE', 'This record was removed by root@localhost'),
(27, 21, 'Camera Android', '120911', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120911', 3, 1, '2018-07-04 10:09:25', 'INSERT', ''),
(28, 21, 'Camera Android', '120911', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120911', 3, 1, '2018-07-04 10:14:41', 'DELETE', ''),
(29, 15, 'Camera Android app', '120910', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120910', NULL, 1, '2018-07-04 14:56:04', 'UPDATE', ''),
(30, 15, 'Camera Android app', '120910', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues', '120910', '120910', '120910', NULL, 1, '2018-07-16 13:38:51', 'UPDATE', ''),
(31, 15, 'Camera Android app', '120910', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120910', NULL, 1, '2018-07-16 13:42:48', 'UPDATE', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_r`
--

CREATE TABLE `project_r` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `projectCode` varchar(10) NOT NULL DEFAULT '''''',
  `OTStatus` tinyint(4) NOT NULL DEFAULT '1',
  `projectStatus` tinyint(1) NOT NULL DEFAULT '0',
  `endDate` datetime DEFAULT NULL,
  `redmineURL` varchar(512) DEFAULT NULL,
  `redmineID` varchar(50) DEFAULT NULL,
  `ivisID` varchar(50) DEFAULT NULL,
  `sdcCode` varchar(45) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `updateBy` int(11) NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_r`
--

INSERT INTO `project_r` (`projectID`, `projectName`, `projectCode`, `OTStatus`, `projectStatus`, `endDate`, `redmineURL`, `redmineID`, `ivisID`, `sdcCode`, `groupId`, `updateBy`, `enabled`) VALUES
(4, 'WebView vs Chrome Custom Tabs', '126864', 1, 1, '2018-03-29 00:00:00', 'http://10.1.0.190/redmine/projects/booklive/issues', '126864', '126864', '126864', 1, 1, b'1'),
(5, 'Android task', '127129', 0, 0, '2018-03-25 00:00:00', 'http://10.1.0.190/redmine/projects', '127129', '127129', '127129', 3, 1, b'1'),
(6, 'Iphone task', '127088', 0, 1, '2018-03-30 00:00:00', 'http://10.1.0.190/redmine/projects', '127088', '127088', '127088', 3, 1, b'1'),
(7, 'Font-family', '126810', 1, 1, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/projects/qtfont/issues', '126810', '126810', '126810', 4, 1, b'1'),
(14, 'Investigating', '126172', 0, 1, '2018-03-02 00:00:00', 'http://10.1.0.190/redmine/projects/booklive', '126172', '126172', '126172', 2, 1, b'1'),
(15, 'Camera Android app', '120910', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120910', NULL, 1, b'1'),
(21, 'Camera Android', '120911', 1, 0, '2018-04-01 00:00:00', 'http://10.1.0.190/redmine/issues/120910', '120910', '120910', '120911', 3, 1, b'0');

--
-- Triggers `project_r`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_project_r` AFTER DELETE ON `project_r` FOR EACH ROW INSERT INTO project_l (projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateBy, action, note)
VALUES (OLD.projectID, OLD.projectName, OLD.projectCode, OLD.OTStatus, OLD.projectStatus, OLD.endDate, OLD.redmineURL, OLD.redmineID, OLD.ivisID, OLD.sdcCode, OLD.groupId, OLD.updateBy, 'REMOVE', CONCAT('This record was removed by ', CURRENT_USER()))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_project_r` AFTER INSERT ON `project_r` FOR EACH ROW INSERT INTO project_l (projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateBy, action)
VALUES (NEW.projectID, NEW.projectName, NEW.projectCode, NEW.OTStatus, NEW.projectStatus, NEW.endDate, NEW.redmineURL, NEW.redmineID, NEW.ivisID, NEW.sdcCode, NEW.groupId, NEW.updateBy, 'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_project_r` AFTER UPDATE ON `project_r` FOR EACH ROW IF OLD.enabled = 0 AND NEW.enabled = 1 THEN
INSERT INTO project_l (projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateBy, action)
VALUES (NEW.projectID, NEW.projectName, NEW.projectCode, NEW.OTStatus, NEW.projectStatus, NEW.endDate, NEW.redmineURL, NEW.redmineID, NEW.ivisID, NEW.sdcCode, NEW.groupId, NEW.updateBy, 'INSERT');
ELSEIF NEW.enabled = 1 THEN
INSERT INTO project_l (projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateBy, action)
VALUES (NEW.projectID, NEW.projectName, NEW.projectCode, NEW.OTStatus, NEW.projectStatus, NEW.endDate, NEW.redmineURL, NEW.redmineID, NEW.ivisID, NEW.sdcCode, NEW.groupId, NEW.updateBy, 'UPDATE');
ELSE
INSERT INTO project_l (projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateBy, action)
VALUES (NEW.projectID, NEW.projectName, NEW.projectCode, NEW.OTStatus, NEW.projectStatus, NEW.endDate, NEW.redmineURL, NEW.redmineID, NEW.ivisID, NEW.sdcCode, NEW.groupId, NEW.updateBy, 'DELETE');
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `project_saleplan_l`
--

CREATE TABLE `project_saleplan_l` (
  `ID` int(11) NOT NULL,
  `saleplanID` int(11) NOT NULL DEFAULT '0',
  `projectID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL,
  `position` varchar(3) NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(10) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_saleplan_l`
--

INSERT INTO `project_saleplan_l` (`ID`, `saleplanID`, `projectID`, `sectionID`, `periodID`, `rankID`, `typeID`, `effort`, `position`, `updateBy`, `updateTime`, `action`, `note`) VALUES
(1, 1, 4, 2, 1, 3, 1, '10.00', '', 1, '2018-04-04 11:22:20', 'INSERT', ''),
(2, 2, 14, 3, 1, 2, 2, '20.00', '', 1, '2018-04-04 11:44:34', 'INSERT', ''),
(3, 3, 6, 4, 1, 1, 1, '30.00', '', 1, '2018-04-04 11:45:39', 'INSERT', ''),
(4, 4, 5, 5, 1, 3, 2, '40.00', '', 1, '2018-04-04 11:47:30', 'INSERT', ''),
(5, 5, 7, 6, 1, 2, 1, '50.00', '', 1, '2018-04-04 11:52:08', 'INSERT', ''),
(6, 6, 15, 7, 1, 1, 2, '60.00', '', 1, '2018-04-04 14:37:08', 'INSERT', ''),
(7, 1, 4, 2, 1, 3, 1, '1.00', '', 1, '2018-04-04 14:37:31', 'UPDATE', ''),
(8, 7, 4, 2, 1, 3, 2, '2.00', '', 1, '2018-04-05 11:49:01', 'INSERT', ''),
(9, 8, 4, 2, 1, 1, 1, '3.00', '', 1, '2018-04-05 16:44:56', 'INSERT', ''),
(10, 10, 4, 2, 1, 1, 2, '4.00', '', 1, '2018-04-05 16:45:22', 'INSERT', ''),
(11, 11, 4, 2, 1, 2, 1, '5.00', '', 1, '2018-04-05 16:46:32', 'INSERT', ''),
(12, 12, 4, 2, 1, 2, 2, '6.00', '', 1, '2018-04-05 16:46:49', 'INSERT', ''),
(13, 1, 4, 2, 1, 3, 1, '1.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(14, 11, 4, 2, 1, 2, 1, '5.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(15, 10, 4, 2, 1, 1, 2, '4.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(16, 8, 4, 2, 1, 1, 1, '3.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(17, 7, 4, 2, 1, 3, 2, '2.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(18, 12, 4, 2, 1, 2, 2, '6.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(19, 4, 5, 5, 1, 3, 2, '40.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(20, 3, 6, 4, 1, 1, 1, '30.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(21, 5, 7, 6, 1, 2, 1, '50.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(22, 2, 14, 3, 1, 2, 2, '20.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(23, 6, 15, 7, 1, 1, 2, '60.00', '', 1, '2018-04-26 16:28:36', 'UPDATE', ''),
(24, 1, 4, 2, 1, 3, 1, '1.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(25, 11, 4, 2, 1, 2, 1, '5.00', 'PM', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(26, 10, 4, 2, 1, 1, 2, '4.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(27, 8, 4, 2, 1, 1, 1, '3.00', 'PM', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(28, 7, 4, 2, 1, 3, 2, '2.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(29, 12, 4, 2, 1, 2, 2, '6.00', 'PM', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(30, 4, 5, 5, 1, 3, 2, '40.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(31, 3, 6, 4, 1, 1, 1, '30.00', 'PM', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(32, 5, 7, 6, 1, 2, 1, '50.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(33, 2, 14, 3, 1, 2, 2, '20.00', 'PM', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(34, 6, 15, 7, 1, 1, 2, '60.00', 'SDC', 1, '2018-04-26 16:31:01', 'UPDATE', ''),
(41, 17, 4, 2, 2, 1, 1, '3.00', 'PM', 1, '2018-05-31 16:21:42', 'INSERT', ''),
(42, 18, 4, 2, 2, 2, 1, '5.00', 'PM', 1, '2018-05-31 16:21:42', 'INSERT', ''),
(43, 19, 4, 2, 2, 2, 2, '6.00', 'PM', 1, '2018-05-31 16:21:42', 'INSERT', ''),
(44, 2, 14, 3, 1, 2, 2, '20.00', 'SDC', 1, '2018-07-31 15:32:45', 'UPDATE', ''),
(45, 12, 4, 2, 1, 2, 2, '6.00', '', 1, '2018-07-31 15:42:24', 'UPDATE', ''),
(46, 22, 15, 4, 1, 1, 1, '30.00', 'PM', 1, '2018-07-31 15:47:07', 'INSERT', ''),
(47, 2, 15, 3, 1, 2, 2, '20.00', 'PM', 1, '2018-07-31 15:48:51', 'UPDATE', ''),
(48, 3, 6, 3, 1, 1, 1, '30.00', 'PM', 1, '2018-07-31 15:49:54', 'UPDATE', ''),
(49, 22, 15, 3, 1, 1, 1, '30.00', 'PM', 1, '2018-07-31 15:50:02', 'UPDATE', ''),
(50, 3, 14, 3, 1, 1, 1, '30.00', 'PM', 1, '2018-07-31 15:50:55', 'UPDATE', ''),
(51, 24, 15, 3, 1, 2, 2, '20.00', 'SDC', 1, '2018-07-31 15:54:37', 'INSERT', ''),
(52, 25, 4, 2, 1, 1, 1, '3.00', 'SDC', 1, '2018-07-31 15:54:56', 'INSERT', ''),
(53, 2, 15, 4, 1, 2, 2, '20.00', '', 1, '2018-08-01 08:58:37', 'UPDATE', ''),
(54, 40, 15, 4, 1, 1, 1, '30.00', 'PM', 1, '2018-08-01 08:58:55', 'INSERT', ''),
(55, 41, 14, 4, 1, 1, 1, '500.00', 'PM', 1, '2018-08-01 08:59:42', 'INSERT', ''),
(56, 22, 15, 3, 1, 1, 1, '300.00', '', 1, '2018-08-01 09:00:02', 'UPDATE', ''),
(57, 40, 15, 4, 1, 1, 1, '300.00', '', 1, '2018-08-01 09:01:10', 'UPDATE', ''),
(58, 40, 15, 4, 1, 1, 1, '300.00', 'PM', 1, '2018-08-01 09:02:41', 'UPDATE', ''),
(59, 2, 15, 4, 1, 2, 2, '20.00', 'PM', 1, '2018-08-01 09:02:44', 'UPDATE', ''),
(60, 22, 15, 3, 1, 1, 1, '300.00', 'PM', 1, '2018-08-01 09:02:49', 'UPDATE', ''),
(61, 12, 4, 2, 1, 2, 2, '6.00', 'PM', 1, '2018-08-01 09:02:53', 'UPDATE', ''),
(62, 40, 15, 4, 1, 1, 1, '300.00', '', 1, '2018-08-01 09:04:07', 'DELETE', ''),
(63, 19, 4, 2, 2, 2, 2, '60.00', '', 1, '2018-08-01 09:04:21', 'UPDATE', ''),
(64, 19, 4, 2, 2, 2, 2, '60.00', 'PM', 1, '2018-08-01 09:05:27', 'UPDATE', ''),
(65, 11, 4, 2, 1, 2, 1, '50.00', '', 1, '2018-08-01 09:06:20', 'UPDATE', ''),
(66, 17, 4, 2, 2, 1, 1, '30.00', '', 1, '2018-08-01 09:10:16', 'UPDATE', ''),
(67, 8, 4, 2, 1, 1, 1, '30.00', '', 1, '2018-08-01 09:14:30', 'UPDATE', ''),
(68, 45, 4, 2, 1, 2, 1, '50.00', 'PM', 1, '2018-08-01 09:21:56', 'INSERT', ''),
(69, 18, 4, 2, 2, 2, 1, '50.00', 'PM', 1, '2018-08-01 09:26:37', 'UPDATE', ''),
(70, 17, 4, 2, 2, 1, 1, '30.00', 'SDC', 1, '2018-08-01 09:26:54', 'UPDATE', ''),
(71, 11, 4, 2, 1, 2, 1, '50.00', 'SDC', 1, '2018-08-01 09:26:59', 'UPDATE', ''),
(72, 40, 15, 4, 1, 1, 1, '300.00', 'SDC', 1, '2018-08-01 09:27:02', 'DELETE', ''),
(73, 11, 4, 2, 1, 2, 1, '30.00', 'SDC', 1, '2018-08-01 09:28:32', 'UPDATE', ''),
(74, 7, 4, 2, 1, 3, 2, '20.00', 'SDC', 1, '2018-08-01 09:28:38', 'UPDATE', ''),
(75, 24, 15, 4, 1, 2, 2, '20.00', 'SDC', 1, '2018-08-01 09:28:50', 'UPDATE', ''),
(76, 0, 4, 2, 1, 1, 1, '30.00', '', 1, '2018-08-01 11:04:21', 'REMOVE', 'This record was removed by root@localhost');

-- --------------------------------------------------------

--
-- Table structure for table `project_saleplan_r`
--

CREATE TABLE `project_saleplan_r` (
  `saleplanID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL,
  `position` varchar(3) NOT NULL DEFAULT 'PM',
  `updateBy` int(11) NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_saleplan_r`
--

INSERT INTO `project_saleplan_r` (`saleplanID`, `projectID`, `sectionID`, `periodID`, `rankID`, `typeID`, `effort`, `position`, `updateBy`, `enabled`) VALUES
(1, 4, 2, 1, 3, 1, '1.00', 'SDC', 1, b'1'),
(2, 15, 4, 1, 2, 2, '20.00', 'PM', 1, b'1'),
(3, 14, 3, 1, 1, 1, '30.00', 'PM', 1, b'1'),
(4, 5, 5, 1, 3, 2, '40.00', 'SDC', 1, b'1'),
(5, 7, 6, 1, 2, 1, '50.00', 'SDC', 1, b'1'),
(6, 15, 7, 1, 1, 2, '60.00', 'SDC', 1, b'1'),
(7, 4, 2, 1, 3, 2, '20.00', 'SDC', 1, b'1'),
(10, 4, 2, 1, 1, 2, '4.00', 'SDC', 1, b'1'),
(11, 4, 2, 1, 2, 1, '30.00', 'SDC', 1, b'1'),
(12, 4, 2, 1, 2, 2, '6.00', 'PM', 1, b'1'),
(17, 4, 2, 2, 1, 1, '30.00', 'SDC', 1, b'1'),
(18, 4, 2, 2, 2, 1, '50.00', 'PM', 1, b'1'),
(19, 4, 2, 2, 2, 2, '60.00', 'PM', 1, b'1'),
(22, 15, 3, 1, 1, 1, '300.00', 'PM', 1, b'1'),
(24, 15, 4, 1, 2, 2, '20.00', 'SDC', 1, b'1'),
(25, 4, 2, 1, 1, 1, '3.00', 'SDC', 1, b'1'),
(40, 15, 4, 1, 1, 1, '300.00', 'SDC', 1, b'0'),
(41, 14, 4, 1, 1, 1, '500.00', 'PM', 1, b'1'),
(45, 4, 2, 1, 2, 1, '50.00', 'PM', 1, b'1');

--
-- Triggers `project_saleplan_r`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_project_saleplan_r` AFTER DELETE ON `project_saleplan_r` FOR EACH ROW INSERT INTO project_saleplan_l (projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy, action, note)
VALUES (OLD.projectID, OLD.sectionID, OLD.periodID, OLD.rankID, OLD.typeID, OLD.effort, OLD.position, OLD.updateBy, 'REMOVE', CONCAT('This record was removed by ', CURRENT_USER()))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_project_saleplan_r` AFTER INSERT ON `project_saleplan_r` FOR EACH ROW INSERT INTO project_saleplan_l (saleplanID, projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy, action)
VALUES (NEW.saleplanID, NEW.projectID, NEW.sectionID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.position, NEW.updateBy, 'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_project_saleplan_r` AFTER UPDATE ON `project_saleplan_r` FOR EACH ROW IF OLD.enabled = 0 AND NEW.enabled = 1 THEN
INSERT INTO project_saleplan_l (saleplanID, projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy, action)
VALUES (NEW.saleplanID, NEW.projectID, NEW.sectionID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.position, NEW.updateBy, 'INSERT');
ELSEIF NEW.enabled = 1 THEN
INSERT INTO project_saleplan_l (saleplanID, projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy, action)
VALUES (NEW.saleplanID, NEW.projectID, NEW.sectionID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.position, NEW.updateBy, 'UPDATE');
ELSE
INSERT INTO project_saleplan_l (saleplanID, projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy, action)
VALUES (NEW.saleplanID, NEW.projectID, NEW.sectionID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.position, NEW.updateBy, 'DELETE');
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rankID` int(11) NOT NULL,
  `rankName` varchar(45) NOT NULL DEFAULT 'A',
  `rankStatus` tinyint(4) DEFAULT '1',
  `displayOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rankID`, `rankName`, `rankStatus`, `displayOrder`) VALUES
(1, 'A', 1, 1),
(2, 'B', 1, 2),
(3, 'O', 1, 0),
(4, 'C', 1, 3),
(5, 'R', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionID` int(11) NOT NULL,
  `sectionName` varchar(255) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `sectionStatus` tinyint(1) NOT NULL DEFAULT '1',
  `displayOrder` tinyint(2) NOT NULL DEFAULT '0',
  `headID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `sectionName`, `departmentID`, `sectionStatus`, `displayOrder`, `headID`) VALUES
(2, 'Section 1', 1, 1, 1, NULL),
(3, 'Section 2', 1, 1, 2, NULL),
(4, 'Section 3', 2, 1, 3, NULL),
(5, 'Section 4', 2, 1, 4, NULL),
(6, 'Section 5', 3, 1, 5, NULL),
(7, 'Section 6', 3, 1, 6, NULL),
(8, 'Section 7', 4, 1, 7, NULL),
(9, 'Section 8', 4, 1, 8, NULL),
(10, 'Section 9', 5, 1, 9, NULL),
(11, 'Section 10', 5, 1, 10, NULL),
(12, 'Section 11', 6, 1, 11, NULL),
(13, 'Section 12', 6, 1, 12, NULL),
(14, 'QC', 7, 1, 13, NULL),
(15, 'CS', 18, 1, 14, NULL),
(16, 'ISS', 19, 1, 15, NULL),
(17, 'TEST_DATA', 20, 1, 16, NULL),
(18, 'Section17', 1, 0, 17, NULL),
(19, 'Section18', 1, 0, 18, NULL),
(22, 'Section19', 2, 0, 0, NULL),
(23, 'Section 20', 1, 0, 0, NULL),
(24, 'Section21', 1, 0, 0, NULL),
(25, 'Section22', 1, 0, 0, NULL),
(26, 'Section23', 1, 0, 0, NULL),
(27, 'Section24', 1, 0, 0, NULL),
(28, 'Section25', 1, 0, 0, NULL),
(29, 'Section26', 2, 0, 0, NULL),
(30, 'Section28', 1, 0, 0, NULL),
(31, 'Section28', 2, 0, 0, NULL),
(32, 'Section29', 3, 0, 0, NULL),
(33, 'Section30', 1, 0, 0, NULL),
(34, 'Section 31', 2, 0, 0, NULL),
(35, 'Section 32', 2, 0, 0, NULL),
(36, 'Section 33', 2, 0, 0, NULL),
(37, 'Section 34', 2, 0, 0, NULL),
(38, 'Section 35', 2, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spend_time_actual_l`
--

CREATE TABLE `spend_time_actual_l` (
  `ID` int(11) NOT NULL,
  `spendTimeID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL DEFAULT '0.00',
  `ot` decimal(6,2) NOT NULL DEFAULT '0.00',
  `updateBy` int(11) NOT NULL,
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(10) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spend_time_actual_l`
--

INSERT INTO `spend_time_actual_l` (`ID`, `spendTimeID`, `sectionID`, `employeeID`, `projectID`, `periodID`, `rankID`, `typeID`, `effort`, `ot`, `updateBy`, `updateTime`, `action`, `note`) VALUES
(1, 1, 2, 1, 15, 1, 3, 1, '1.00', '1.00', 1, '2018-04-16 18:18:53', 'INSERT', ''),
(2, 2, 3, 1, 4, 1, 1, 2, '2.00', '2.00', 1, '2018-04-16 18:58:33', 'INSERT', ''),
(3, 2, 3, 1, 4, 1, 1, 2, '2.00', '2.00', 1, '2018-04-16 19:32:24', 'DELETE', ''),
(4, 2, 3, 1, 4, 1, 1, 2, '2.00', '2.00', 1, '2018-04-16 19:33:00', 'INSERT', ''),
(5, 1, 2, 1, 15, 1, 3, 1, '1.00', '1.00', 1, '2018-04-17 10:14:05', 'DELETE', ''),
(6, 3, 3, 1, 14, 1, 2, 1, '5.00', '9.00', 1, '2018-04-17 10:17:33', 'INSERT', ''),
(7, 1, 2, 1, 15, 1, 3, 1, '1.00', '1.00', 1, '2018-04-23 18:13:36', 'REMOVE', 'This record was removed by root@localhost'),
(8, 4, 3, 1, 14, 1, 1, 2, '2.00', '2.00', 1, '2018-07-31 15:24:36', 'INSERT', ''),
(9, 5, 3, 1, 15, 1, 1, 2, '2.00', '2.00', 1, '2018-07-31 15:24:52', 'INSERT', ''),
(10, 6, 2, 2, 4, 1, 3, 2, '2.00', '2.00', 1, '2018-08-01 08:22:09', 'INSERT', ''),
(11, 7, 2, 2, 15, 1, 3, 2, '2.00', '2.00', 1, '2018-08-01 08:22:18', 'INSERT', ''),
(12, 6, 2, 2, 14, 1, 3, 2, '2.00', '2.00', 1, '2018-08-01 08:22:26', 'UPDATE', ''),
(13, 8, 2, 2, 4, 1, 3, 2, '2.00', '2.00', 1, '2018-08-01 08:22:37', 'INSERT', ''),
(14, 7, 4, 25, 15, 1, 3, 2, '2.00', '2.00', 1, '2018-08-01 08:22:53', 'UPDATE', ''),
(15, 9, 4, 27, 15, 1, 3, 2, '20.00', '2.00', 1, '2018-08-01 08:23:23', 'INSERT', ''),
(16, 10, 4, 26, 15, 1, 3, 2, '180.00', '2.00', 1, '2018-08-01 08:23:45', 'INSERT', ''),
(17, 10, 4, 26, 14, 1, 3, 2, '180.00', '2.00', 1, '2018-08-01 08:23:54', 'UPDATE', ''),
(18, 8, 2, 2, 4, 1, 3, 2, '150.00', '2.00', 1, '2018-08-01 10:12:54', 'UPDATE', '');

-- --------------------------------------------------------

--
-- Table structure for table `spend_time_actual_r`
--

CREATE TABLE `spend_time_actual_r` (
  `spendTimeID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL DEFAULT '0.00',
  `ot` decimal(6,2) NOT NULL DEFAULT '0.00',
  `updateBy` int(11) NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spend_time_actual_r`
--

INSERT INTO `spend_time_actual_r` (`spendTimeID`, `sectionID`, `employeeID`, `projectID`, `periodID`, `rankID`, `typeID`, `effort`, `ot`, `updateBy`, `enabled`) VALUES
(2, 3, 1, 4, 1, 1, 2, '2.00', '2.00', 1, b'1'),
(3, 3, 1, 14, 1, 2, 1, '5.00', '9.00', 1, b'1'),
(4, 3, 1, 14, 1, 1, 2, '2.00', '2.00', 1, b'1'),
(5, 3, 1, 15, 1, 1, 2, '2.00', '2.00', 1, b'1'),
(6, 2, 2, 14, 1, 3, 2, '2.00', '2.00', 1, b'1'),
(7, 4, 25, 15, 1, 3, 2, '2.00', '2.00', 1, b'1'),
(8, 2, 2, 4, 1, 3, 2, '150.00', '2.00', 1, b'1'),
(9, 4, 27, 15, 1, 3, 2, '20.00', '2.00', 1, b'1'),
(10, 4, 26, 14, 1, 3, 2, '180.00', '2.00', 1, b'1');

--
-- Triggers `spend_time_actual_r`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_spend_time_actual_r` AFTER DELETE ON `spend_time_actual_r` FOR EACH ROW INSERT INTO spend_time_actual_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action, note)
VALUES (OLD.spendTimeID, OLD.sectionID, OLD.employeeID, OLD.projectID, OLD.periodID, OLD.rankID, OLD.typeID, OLD.effort, OLD.ot, OLD.updateBy, 'REMOVE', CONCAT('This record was removed by ', CURRENT_USER()))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_spend_time_actual_r` AFTER INSERT ON `spend_time_actual_r` FOR EACH ROW INSERT INTO spend_time_actual_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_spend_time_actual_r` AFTER UPDATE ON `spend_time_actual_r` FOR EACH ROW IF OLD.enabled = 0 AND NEW.enabled = 1 THEN
INSERT INTO spend_time_actual_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'INSERT');
ELSEIF NEW.enabled = 1 THEN
INSERT INTO spend_time_actual_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'UPDATE');
ELSE
INSERT INTO spend_time_actual_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'DELETE');
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `spend_time_plan_l`
--

CREATE TABLE `spend_time_plan_l` (
  `ID` int(11) NOT NULL,
  `spendTimeID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL DEFAULT '0.00',
  `ot` decimal(6,2) NOT NULL DEFAULT '0.00',
  `updateBy` int(11) NOT NULL,
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(10) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spend_time_plan_l`
--

INSERT INTO `spend_time_plan_l` (`ID`, `spendTimeID`, `sectionID`, `employeeID`, `projectID`, `periodID`, `rankID`, `typeID`, `effort`, `ot`, `updateBy`, `updateTime`, `action`, `note`) VALUES
(1, 1, 3, 1, 7, 1, 2, 2, '5.00', '5.00', 1, '2018-04-16 19:43:27', 'INSERT', ''),
(2, 7, 3, 1, 14, 1, 2, 1, '5.00', '0.00', 1, '2018-04-17 10:54:36', 'INSERT', ''),
(3, 1, 3, 2, 7, 2, 2, 2, '5.00', '5.00', 1, '2018-07-19 16:56:14', 'UPDATE', ''),
(4, 7, 3, 1, 14, 1, 2, 1, '100.00', '0.00', 1, '2018-07-22 11:58:09', 'UPDATE', ''),
(5, 1, 3, 2, 7, 2, 2, 2, '50.00', '5.00', 1, '2018-07-22 11:58:19', 'UPDATE', ''),
(6, 8, 3, 1, 15, 1, 2, 1, '55.00', '0.00', 1, '2018-07-22 16:52:28', 'INSERT', ''),
(7, 1, 3, 2, 7, 2, 2, 2, '150.00', '5.00', 1, '2018-07-22 18:44:41', 'UPDATE', ''),
(8, 1, 4, 25, 7, 1, 2, 2, '150.00', '5.00', 1, '2018-07-22 18:45:15', 'UPDATE', ''),
(9, 1, 4, 2, 7, 1, 2, 2, '150.00', '5.00', 1, '2018-07-22 18:45:59', 'UPDATE', ''),
(10, 9, 4, 25, 15, 1, 2, 1, '160.00', '0.00', 1, '2018-07-22 18:46:50', 'INSERT', ''),
(11, 10, 4, 26, 15, 1, 1, 1, '160.00', '0.00', 1, '2018-07-22 18:47:34', 'INSERT', ''),
(12, 11, 4, 27, 15, 1, 1, 1, '155.00', '0.00', 1, '2018-07-22 18:47:56', 'INSERT', ''),
(13, 12, 3, 1, 15, 1, 3, 2, '12.00', '1.00', 1, '2018-07-24 09:28:43', 'INSERT', ''),
(14, 1, 4, 0, 7, 1, 2, 2, '150.00', '5.00', 1, '2018-07-24 10:43:24', 'DELETE', ''),
(15, 13, 2, 2, 15, 11, 3, 1, '112.00', '12.00', 1, '2018-07-24 10:56:09', 'INSERT', ''),
(16, 13, 2, 2, 15, 1, 3, 1, '112.00', '12.00', 1, '2018-07-24 10:57:33', 'UPDATE', ''),
(17, 12, 3, 1, 15, 1, 3, 2, '12.00', '1.00', 1, '2018-07-24 14:14:51', 'DELETE', ''),
(18, 1, 4, 1, 7, 1, 2, 2, '150.00', '5.00', 1, '2018-07-25 11:10:47', 'DELETE', ''),
(19, 1, 4, 1, 7, 1, 2, 2, '150.00', '5.00', 1, '2018-07-25 11:13:43', 'REMOVE', 'This record was removed by root@localhost'),
(20, 11, 4, 27, 15, 1, 1, 1, '155.00', '0.00', 1, '2018-07-25 11:25:50', 'DELETE', ''),
(21, 7, 3, 1, 14, 1, 2, 2, '100.00', '0.00', 1, '2018-07-25 11:27:45', 'UPDATE', ''),
(22, 19, 3, 1, 15, 1, 1, 2, '55.00', '0.00', 1, '2018-07-25 13:29:09', 'INSERT', ''),
(23, 19, 3, 1, 15, 1, 1, 1, '55.00', '0.00', 1, '2018-07-25 13:29:20', 'UPDATE', ''),
(24, 19, 3, 1, 15, 1, 1, 1, '55.00', '0.00', 1, '2018-07-25 14:03:33', 'REMOVE', 'This record was removed by root@localhost'),
(25, 20, 3, 1, 15, 1, 1, 1, '55.00', '0.00', 1, '2018-07-25 14:29:10', 'INSERT', ''),
(26, 21, 3, 1, 15, 1, 3, 1, '55.00', '0.00', 1, '2018-07-25 15:10:46', 'INSERT', ''),
(27, 12, 3, 1, 15, 1, 3, 2, '55.00', '0.00', 1, '2018-07-25 16:24:43', 'INSERT', ''),
(28, 24, 3, 1, 14, 1, 1, 2, '96.00', '0.00', 1, '2018-07-25 16:34:08', 'INSERT', ''),
(29, 25, 4, 25, 15, 1, 3, 1, '160.00', '0.00', 1, '2018-07-25 16:35:24', 'INSERT', ''),
(30, 21, 3, 1, 15, 1, 4, 1, '55.00', '0.00', 1, '2018-07-27 13:25:36', 'UPDATE', ''),
(31, 25, 4, 25, 15, 1, 5, 1, '160.00', '0.00', 1, '2018-07-27 13:25:47', 'UPDATE', ''),
(32, 26, 10, 28, 15, 1, 1, 2, '1111.00', '0.00', 1, '2018-07-27 15:35:06', 'INSERT', ''),
(33, 27, 10, 28, 15, 11, 1, 2, '1111.00', '0.00', 1, '2018-07-27 15:36:01', 'INSERT', ''),
(34, 27, 10, 28, 15, 11, 1, 2, '111.00', '0.00', 1, '2018-07-27 16:24:11', 'UPDATE', ''),
(35, 26, 10, 28, 15, 1, 1, 2, '111.00', '0.00', 1, '2018-07-27 16:24:14', 'UPDATE', ''),
(36, 26, 10, 28, 15, 1, 1, 2, '50.00', '0.00', 1, '2018-07-27 16:34:36', 'UPDATE', ''),
(37, 28, 2, 2, 4, 1, 3, 1, '112.00', '12.00', 1, '2018-07-30 13:58:51', 'INSERT', ''),
(38, 29, 2, 2, 14, 1, 3, 1, '112.00', '12.00', 1, '2018-07-30 13:59:02', 'INSERT', ''),
(39, 30, 2, 2, 5, 1, 3, 1, '112.00', '12.00', 1, '2018-07-30 13:59:13', 'INSERT', ''),
(40, 31, 2, 2, 6, 1, 3, 1, '112.00', '12.00', 1, '2018-07-30 13:59:22', 'INSERT', ''),
(41, 32, 2, 2, 7, 1, 3, 1, '112.00', '12.00', 1, '2018-07-30 13:59:29', 'INSERT', '');

-- --------------------------------------------------------

--
-- Table structure for table `spend_time_plan_r`
--

CREATE TABLE `spend_time_plan_r` (
  `spendTimeID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `periodID` int(11) NOT NULL,
  `rankID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `effort` decimal(6,2) NOT NULL DEFAULT '0.00',
  `ot` decimal(6,2) NOT NULL DEFAULT '0.00',
  `updateBy` int(11) NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spend_time_plan_r`
--

INSERT INTO `spend_time_plan_r` (`spendTimeID`, `sectionID`, `employeeID`, `projectID`, `periodID`, `rankID`, `typeID`, `effort`, `ot`, `updateBy`, `enabled`) VALUES
(7, 3, 1, 14, 1, 2, 2, '100.00', '0.00', 1, b'1'),
(8, 3, 1, 15, 1, 2, 1, '55.00', '0.00', 1, b'1'),
(9, 4, 25, 15, 1, 2, 1, '160.00', '0.00', 1, b'1'),
(10, 4, 26, 15, 1, 1, 1, '160.00', '0.00', 1, b'1'),
(11, 4, 27, 15, 1, 1, 1, '155.00', '0.00', 1, b'0'),
(12, 3, 1, 15, 1, 3, 2, '55.00', '0.00', 1, b'1'),
(13, 2, 2, 15, 1, 3, 1, '112.00', '12.00', 1, b'1'),
(20, 3, 1, 15, 1, 1, 1, '55.00', '0.00', 1, b'1'),
(21, 3, 1, 15, 1, 4, 1, '55.00', '0.00', 1, b'1'),
(24, 3, 1, 14, 1, 1, 2, '96.00', '0.00', 1, b'1'),
(25, 4, 25, 15, 1, 5, 1, '160.00', '0.00', 1, b'1'),
(26, 10, 28, 15, 1, 1, 2, '50.00', '0.00', 1, b'1'),
(27, 10, 28, 15, 11, 1, 2, '111.00', '0.00', 1, b'1'),
(28, 2, 2, 4, 1, 3, 1, '112.00', '12.00', 1, b'1'),
(29, 2, 2, 14, 1, 3, 1, '112.00', '12.00', 1, b'1'),
(30, 2, 2, 5, 1, 3, 1, '112.00', '12.00', 1, b'1'),
(31, 2, 2, 6, 1, 3, 1, '112.00', '12.00', 1, b'1'),
(32, 2, 2, 7, 1, 3, 1, '112.00', '12.00', 1, b'1');

--
-- Triggers `spend_time_plan_r`
--
DELIMITER $$
CREATE TRIGGER `LOG_DELETE_spend_time_plan_r` AFTER DELETE ON `spend_time_plan_r` FOR EACH ROW INSERT INTO spend_time_plan_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action, note)
VALUES (OLD.spendTimeID, OLD.sectionID, OLD.employeeID, OLD.projectID, OLD.periodID, OLD.rankID, OLD.typeID, OLD.effort, OLD.ot, OLD.updateBy, 'REMOVE', CONCAT('This record was removed by ', CURRENT_USER()))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_INSERT_spend_time_plan_r` AFTER INSERT ON `spend_time_plan_r` FOR EACH ROW INSERT INTO spend_time_plan_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOG_UPDATE_spend_time_plan_r` AFTER UPDATE ON `spend_time_plan_r` FOR EACH ROW IF OLD.enabled = 0 AND NEW.enabled = 1 THEN
INSERT INTO spend_time_plan_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'INSERT');
ELSEIF NEW.enabled = 1 THEN
INSERT INTO spend_time_plan_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'UPDATE');
ELSE
INSERT INTO spend_time_plan_l (spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateBy, action)
VALUES (NEW.spendTimeID, NEW.sectionID, NEW.employeeID, NEW.projectID, NEW.periodID, NEW.rankID, NEW.typeID, NEW.effort, NEW.ot, NEW.updateBy, 'DELETE');
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(45) NOT NULL DEFAULT 'DL',
  `typeStatus` tinyint(4) DEFAULT '1',
  `displayOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeID`, `typeName`, `typeStatus`, `displayOrder`) VALUES
(1, 'DL', 1, 0),
(2, 'SP', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountId`),
  ADD KEY `account_employee_fk` (`employeeId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD KEY `sectionID` (`sectionID`),
  ADD KEY `employee_ibfk_1` (`levelID`);

--
-- Indexes for table `employee_l`
--
ALTER TABLE `employee_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enum_define`
--
ALTER TABLE `enum_define`
  ADD PRIMARY KEY (`enumDefine`);

--
-- Indexes for table `group_privilege`
--
ALTER TABLE `group_privilege`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`levelID`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`periodID`),
  ADD UNIQUE KEY `month` (`month`,`year`);

--
-- Indexes for table `power`
--
ALTER TABLE `power`
  ADD PRIMARY KEY (`workingId`),
  ADD UNIQUE KEY `privilegeId` (`privilegeId`,`accountId`) USING BTREE,
  ADD KEY `fk_employee` (`accountId`);

--
-- Indexes for table `power_l`
--
ALTER TABLE `power_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`privilegeId`),
  ADD UNIQUE KEY `functionId` (`functionId`),
  ADD UNIQUE KEY `functionId_2` (`functionId`),
  ADD KEY `privilege_ibfk_1` (`groupId`);

--
-- Indexes for table `project_group`
--
ALTER TABLE `project_group`
  ADD PRIMARY KEY (`groupID`),
  ADD UNIQUE KEY `groupNAme` (`groupNAme`);

--
-- Indexes for table `project_l`
--
ALTER TABLE `project_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project_r`
--
ALTER TABLE `project_r`
  ADD PRIMARY KEY (`projectID`),
  ADD UNIQUE KEY `projectCode` (`projectCode`),
  ADD UNIQUE KEY `projectName` (`projectName`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `project_saleplan_l`
--
ALTER TABLE `project_saleplan_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project_saleplan_r`
--
ALTER TABLE `project_saleplan_r`
  ADD PRIMARY KEY (`saleplanID`),
  ADD UNIQUE KEY `projectID_2` (`projectID`,`rankID`,`typeID`,`periodID`,`sectionID`,`position`) USING BTREE,
  ADD KEY `projectID` (`projectID`),
  ADD KEY `sectionID` (`sectionID`),
  ADD KEY `project_saleplan_ibfk_3_idx` (`typeID`),
  ADD KEY `project_saleplan_ibfk_4_idx` (`rankID`),
  ADD KEY `project_saleplan_ibfk_5_idx` (`periodID`),
  ADD KEY `updateBy` (`updateBy`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rankID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `spend_time_actual_l`
--
ALTER TABLE `spend_time_actual_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `spend_time_actual_r`
--
ALTER TABLE `spend_time_actual_r`
  ADD PRIMARY KEY (`spendTimeID`),
  ADD UNIQUE KEY `ONLY_ONE_EXIST` (`sectionID`,`employeeID`,`projectID`,`periodID`,`rankID`,`typeID`) USING BTREE,
  ADD KEY `projectID` (`projectID`),
  ADD KEY `periodID` (`periodID`),
  ADD KEY `rankID` (`rankID`),
  ADD KEY `typeID` (`typeID`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `updateBy` (`updateBy`);

--
-- Indexes for table `spend_time_plan_l`
--
ALTER TABLE `spend_time_plan_l`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `spend_time_plan_r`
--
ALTER TABLE `spend_time_plan_r`
  ADD PRIMARY KEY (`spendTimeID`),
  ADD UNIQUE KEY `ONLY_ONE_EXIST` (`sectionID`,`employeeID`,`projectID`,`periodID`,`rankID`,`typeID`) USING BTREE,
  ADD KEY `projectID` (`projectID`),
  ADD KEY `periodID` (`periodID`),
  ADD KEY `rankID` (`rankID`),
  ADD KEY `typeID` (`typeID`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `updateBy` (`updateBy`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `employee_l`
--
ALTER TABLE `employee_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `enum_define`
--
ALTER TABLE `enum_define`
  MODIFY `enumDefine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `group_privilege`
--
ALTER TABLE `group_privilege`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `levelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `periodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `power`
--
ALTER TABLE `power`
  MODIFY `workingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `power_l`
--
ALTER TABLE `power_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `privilegeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project_group`
--
ALTER TABLE `project_group`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_l`
--
ALTER TABLE `project_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `project_r`
--
ALTER TABLE `project_r`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_saleplan_l`
--
ALTER TABLE `project_saleplan_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `project_saleplan_r`
--
ALTER TABLE `project_saleplan_r`
  MODIFY `saleplanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rankID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `spend_time_actual_l`
--
ALTER TABLE `spend_time_actual_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `spend_time_actual_r`
--
ALTER TABLE `spend_time_actual_r`
  MODIFY `spendTimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `spend_time_plan_l`
--
ALTER TABLE `spend_time_plan_l`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `spend_time_plan_r`
--
ALTER TABLE `spend_time_plan_r`
  MODIFY `spendTimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_employee_fk` FOREIGN KEY (`employeeId`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`levelID`) REFERENCES `level` (`levelID`) ON DELETE CASCADE;

--
-- Constraints for table `power`
--
ALTER TABLE `power`
  ADD CONSTRAINT `fk_employee` FOREIGN KEY (`accountId`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `working_privilege_fk` FOREIGN KEY (`privilegeId`) REFERENCES `privilege` (`privilegeId`) ON DELETE CASCADE;

--
-- Constraints for table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group_privilege` (`groupId`) ON DELETE CASCADE;

--
-- Constraints for table `project_saleplan_r`
--
ALTER TABLE `project_saleplan_r`
  ADD CONSTRAINT `project_saleplan_r_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `project_r` (`projectID`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_saleplan_r_ibfk_2` FOREIGN KEY (`sectionID`) REFERENCES `section` (`sectionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_saleplan_r_ibfk_3` FOREIGN KEY (`typeID`) REFERENCES `type` (`typeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_saleplan_r_ibfk_4` FOREIGN KEY (`rankID`) REFERENCES `rank` (`rankID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_saleplan_r_ibfk_5` FOREIGN KEY (`periodID`) REFERENCES `period` (`periodID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_saleplan_r_ibfk_6` FOREIGN KEY (`updateBy`) REFERENCES `employee` (`employeeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `spend_time_actual_r`
--
ALTER TABLE `spend_time_actual_r`
  ADD CONSTRAINT `spend_time_actual_r_ibfk_1` FOREIGN KEY (`sectionID`) REFERENCES `section` (`sectionID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_2` FOREIGN KEY (`projectID`) REFERENCES `project_r` (`projectID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_3` FOREIGN KEY (`periodID`) REFERENCES `period` (`periodID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_4` FOREIGN KEY (`rankID`) REFERENCES `rank` (`rankID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_5` FOREIGN KEY (`typeID`) REFERENCES `type` (`typeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_6` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `spend_time_actual_r_ibfk_7` FOREIGN KEY (`updateBy`) REFERENCES `employee` (`employeeID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
