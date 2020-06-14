-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 01:54 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eas`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `pw` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `pw`, `name`, `type`, `department`) VALUES
(123, 'admin', 'ADMIN', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `stud_name` varchar(45) NOT NULL,
  `stud_department` varchar(45) NOT NULL,
  `stud_sem` varchar(45) NOT NULL,
  `stud_year` varchar(45) NOT NULL,
  `event_id` varchar(45) NOT NULL,
  `event_name` varchar(45) NOT NULL,
  `event_start` varchar(45) NOT NULL,
  `event_end` varchar(45) NOT NULL,
  `attend_time` varchar(45) NOT NULL,
  `attend_date` varchar(45) NOT NULL,
  `history` varchar(45) NOT NULL,
  `equivalent` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `basis_for_per_year_report`
-- (See below for the actual view)
--
CREATE TABLE `basis_for_per_year_report` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` bigint(20)
,`Deficiency` int(11)
,`Total Points` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(45) NOT NULL,
  `no_of_years` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `no_of_years`) VALUES
(1, 'COMPUTER STUDIES', '4'),
(2, 'AB', '4'),
(3, 'ACCOUNTANCY', '5'),
(4, 'BUSINESS', '4'),
(5, 'EDUCATION', '4'),
(6, 'ENGINEERING', '5');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sy` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `eqv` int(11) NOT NULL,
  `p1` varchar(45) NOT NULL,
  `p2` varchar(45) NOT NULL,
  `p3` varchar(45) NOT NULL,
  `p4` varchar(45) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `first_year_basis_report`
-- (See below for the actual view)
--
CREATE TABLE `first_year_basis_report` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` bigint(12)
,`Deficiency` int(11)
,`Total Points` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `first_year_events`
-- (See below for the actual view)
--
CREATE TABLE `first_year_events` (
`id` int(11)
,`name` varchar(45)
,`sy` varchar(45)
,`type` varchar(45)
,`department` varchar(45)
,`eqv` int(11)
,`p1` varchar(45)
,`p2` varchar(45)
,`p3` varchar(45)
,`p4` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `first_year_per_dep_points`
-- (See below for the actual view)
--
CREATE TABLE `first_year_per_dep_points` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `first_year_per_dep_points_list`
-- (See below for the actual view)
--
CREATE TABLE `first_year_per_dep_points_list` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fourth_year_basis_report`
-- (See below for the actual view)
--
CREATE TABLE `fourth_year_basis_report` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` bigint(12)
,`Deficiency` int(11)
,`Total Points` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fourth_year_events`
-- (See below for the actual view)
--
CREATE TABLE `fourth_year_events` (
`id` int(11)
,`name` varchar(45)
,`sy` varchar(45)
,`type` varchar(45)
,`department` varchar(45)
,`eqv` int(11)
,`p1` varchar(45)
,`p2` varchar(45)
,`p3` varchar(45)
,`p4` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fourth_year_per_dep_points`
-- (See below for the actual view)
--
CREATE TABLE `fourth_year_per_dep_points` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fourth_year_per_dep_points_list`
-- (See below for the actual view)
--
CREATE TABLE `fourth_year_per_dep_points_list` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `action` text NOT NULL,
  `time` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `per_event_year_points`
-- (See below for the actual view)
--
CREATE TABLE `per_event_year_points` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` double
,`Deficiency` double
,`Total Points` int(11)
,`Percentage` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `second_year_basis_report`
-- (See below for the actual view)
--
CREATE TABLE `second_year_basis_report` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` bigint(12)
,`Deficiency` int(11)
,`Total Points` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `second_year_events`
-- (See below for the actual view)
--
CREATE TABLE `second_year_events` (
`id` int(11)
,`name` varchar(45)
,`sy` varchar(45)
,`type` varchar(45)
,`department` varchar(45)
,`eqv` int(11)
,`p1` varchar(45)
,`p2` varchar(45)
,`p3` varchar(45)
,`p4` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `second_year_per_dep_points`
-- (See below for the actual view)
--
CREATE TABLE `second_year_per_dep_points` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `second_year_per_dep_points_list`
-- (See below for the actual view)
--
CREATE TABLE `second_year_per_dep_points_list` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `setsy`
--

CREATE TABLE `setsy` (
  `id` int(11) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setsy`
--

INSERT INTO `setsy` (`id`, `sem`, `year`) VALUES
(1, '1st Semester', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `year_level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_attendance_per_event`
-- (See below for the actual view)
--
CREATE TABLE `student_attendance_per_event` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` double
,`Deficiency` double
,`Total Points` int(11)
,`Percentage` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_summary_attendance_per_year`
-- (See below for the actual view)
--
CREATE TABLE `student_summary_attendance_per_year` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` double
,`Deficiency` double
,`Total Points` decimal(32,0)
,`Percentage` double
);

-- --------------------------------------------------------

--
-- Table structure for table `stud_pool`
--

CREATE TABLE `stud_pool` (
  `id` int(11) NOT NULL,
  `card` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `year_level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `third_year_basis_report`
-- (See below for the actual view)
--
CREATE TABLE `third_year_basis_report` (
`stud_id` int(11)
,`stud_name` varchar(45)
,`stud_department` varchar(45)
,`event_name` varchar(45)
,`year_level` varchar(45)
,`School Year` varchar(45)
,`Attendance` bigint(12)
,`Deficiency` int(11)
,`Total Points` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `third_year_events`
-- (See below for the actual view)
--
CREATE TABLE `third_year_events` (
`id` int(11)
,`name` varchar(45)
,`sy` varchar(45)
,`type` varchar(45)
,`department` varchar(45)
,`eqv` int(11)
,`p1` varchar(45)
,`p2` varchar(45)
,`p3` varchar(45)
,`p4` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `third_year_per_dep_points`
-- (See below for the actual view)
--
CREATE TABLE `third_year_per_dep_points` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `third_year_per_dep_points_list`
-- (See below for the actual view)
--
CREATE TABLE `third_year_per_dep_points_list` (
`dept_name` varchar(45)
,`year_level` varchar(45)
,`eqv` decimal(32,0)
,`sy` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `timesched`
--

CREATE TABLE `timesched` (
  `id` int(11) NOT NULL,
  `1` time NOT NULL,
  `2` time NOT NULL,
  `3` time NOT NULL,
  `4` time NOT NULL,
  `5` time NOT NULL,
  `6` time NOT NULL,
  `7` time NOT NULL,
  `8` time NOT NULL,
  `9` time NOT NULL,
  `10` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesched`
--

INSERT INTO `timesched` (`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`) VALUES
(1, '08:00:00', '09:00:00', '10:00:00', '11:00:00', '00:00:00', '01:00:00', '02:00:00', '03:00:00', '04:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE `tmp` (
  `id` int(11) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp`
--

INSERT INTO `tmp` (`id`, `sem`, `year`) VALUES
(1, '1st Semester', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tmpadv`
--

CREATE TABLE `tmpadv` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpattendance`
--

CREATE TABLE `tmpattendance` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `attend_time` time NOT NULL,
  `history` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpeqv`
--

CREATE TABLE `tmpeqv` (
  `id` int(11) NOT NULL,
  `eqv_first` int(11) NOT NULL,
  `eqv_second` int(11) NOT NULL,
  `eqv_third` int(11) NOT NULL,
  `eqv_fourth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpevent`
--

CREATE TABLE `tmpevent` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `start_date` varchar(45) NOT NULL,
  `end_date` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `eqv_first` varchar(45) NOT NULL,
  `second_start` time NOT NULL,
  `second_end` time NOT NULL,
  `eqv_second` varchar(45) NOT NULL,
  `third_start` time NOT NULL,
  `third_end` time NOT NULL,
  `eqv_third` varchar(45) NOT NULL,
  `fourth_start` time NOT NULL,
  `fourth_end` time NOT NULL,
  `eqv_fourth` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpoff`
--

CREATE TABLE `tmpoff` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `pos` varchar(45) NOT NULL,
  `sem` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `year_level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpparticipants`
--

CREATE TABLE `tmpparticipants` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `first_p` varchar(45) NOT NULL,
  `second_p` varchar(45) NOT NULL,
  `third_p` varchar(45) NOT NULL,
  `fourth_p` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpsched`
--

CREATE TABLE `tmpsched` (
  `id` int(11) NOT NULL,
  `first_start` time NOT NULL,
  `first_end` time NOT NULL,
  `second_start` time NOT NULL,
  `second_end` time NOT NULL,
  `third_start` time NOT NULL,
  `third_end` time NOT NULL,
  `fourth_start` time NOT NULL,
  `fourth_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `basis_for_per_year_report`
--
DROP TABLE IF EXISTS `basis_for_per_year_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `basis_for_per_year_report`  AS  select `first_year_basis_report`.`stud_id` AS `stud_id`,`first_year_basis_report`.`stud_name` AS `stud_name`,`first_year_basis_report`.`stud_department` AS `stud_department`,`first_year_basis_report`.`event_name` AS `event_name`,`first_year_basis_report`.`year_level` AS `year_level`,`first_year_basis_report`.`School Year` AS `School Year`,`first_year_basis_report`.`Attendance` AS `Attendance`,`first_year_basis_report`.`Deficiency` AS `Deficiency`,`first_year_basis_report`.`Total Points` AS `Total Points` from `first_year_basis_report` union select `second_year_basis_report`.`stud_id` AS `stud_id`,`second_year_basis_report`.`stud_name` AS `stud_name`,`second_year_basis_report`.`stud_department` AS `stud_department`,`second_year_basis_report`.`event_name` AS `event_name`,`second_year_basis_report`.`year_level` AS `year_level`,`second_year_basis_report`.`School Year` AS `School Year`,`second_year_basis_report`.`Attendance` AS `Attendance`,`second_year_basis_report`.`Deficiency` AS `Deficiency`,`second_year_basis_report`.`Total Points` AS `Total Points` from `second_year_basis_report` union select `third_year_basis_report`.`stud_id` AS `stud_id`,`third_year_basis_report`.`stud_name` AS `stud_name`,`third_year_basis_report`.`stud_department` AS `stud_department`,`third_year_basis_report`.`event_name` AS `event_name`,`third_year_basis_report`.`year_level` AS `year_level`,`third_year_basis_report`.`School Year` AS `School Year`,`third_year_basis_report`.`Attendance` AS `Attendance`,`third_year_basis_report`.`Deficiency` AS `Deficiency`,`third_year_basis_report`.`Total Points` AS `Total Points` from `third_year_basis_report` union select `fourth_year_basis_report`.`stud_id` AS `stud_id`,`fourth_year_basis_report`.`stud_name` AS `stud_name`,`fourth_year_basis_report`.`stud_department` AS `stud_department`,`fourth_year_basis_report`.`event_name` AS `event_name`,`fourth_year_basis_report`.`year_level` AS `year_level`,`fourth_year_basis_report`.`School Year` AS `School Year`,`fourth_year_basis_report`.`Attendance` AS `Attendance`,`fourth_year_basis_report`.`Deficiency` AS `Deficiency`,`fourth_year_basis_report`.`Total Points` AS `Total Points` from `fourth_year_basis_report` order by `year_level` desc ;

-- --------------------------------------------------------

--
-- Structure for view `first_year_basis_report`
--
DROP TABLE IF EXISTS `first_year_basis_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `first_year_basis_report`  AS  select `student`.`id` AS `stud_id`,`student`.`name` AS `stud_name`,`student`.`department` AS `stud_department`,`first_year_events`.`name` AS `event_name`,`student`.`year_level` AS `year_level`,`first_year_events`.`sy` AS `School Year`,`first_year_events`.`eqv` - `first_year_events`.`eqv` AS `Attendance`,`first_year_events`.`eqv` AS `Deficiency`,`first_year_events`.`eqv` AS `Total Points` from (`student` join `first_year_events`) where `student`.`department` = `first_year_events`.`department` and `first_year_events`.`sy` = `first_year_events`.`sy` and `first_year_events`.`p1` = `student`.`year_level` group by `student`.`id`,`first_year_events`.`sy`,`first_year_events`.`name` order by `student`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `first_year_events`
--
DROP TABLE IF EXISTS `first_year_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `first_year_events`  AS  select `events`.`id` AS `id`,`events`.`name` AS `name`,`events`.`sy` AS `sy`,`events`.`type` AS `type`,`events`.`department` AS `department`,`events`.`eqv` AS `eqv`,`events`.`p1` AS `p1`,`events`.`p2` AS `p2`,`events`.`p3` AS `p3`,`events`.`p4` AS `p4` from `events` where `events`.`p1` <> '' group by `events`.`sy`,`events`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `first_year_per_dep_points`
--
DROP TABLE IF EXISTS `first_year_per_dep_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `first_year_per_dep_points`  AS  select `first_year_events`.`department` AS `dept_name`,`first_year_events`.`p1` AS `year_level`,sum(`first_year_events`.`eqv`) AS `eqv`,`first_year_events`.`sy` AS `sy` from `first_year_events` group by `first_year_events`.`department`,`first_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `first_year_per_dep_points_list`
--
DROP TABLE IF EXISTS `first_year_per_dep_points_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `first_year_per_dep_points_list`  AS  select `first_year_per_dep_points`.`dept_name` AS `dept_name`,`first_year_per_dep_points`.`year_level` AS `year_level`,`first_year_per_dep_points`.`eqv` AS `eqv`,`first_year_per_dep_points`.`sy` AS `sy` from `first_year_per_dep_points` union select `department`.`dept_name` AS `dept_name`,`first_year_events`.`p1` AS `year_level`,0 AS `eqv`,`first_year_events`.`sy` AS `sy` from (`first_year_events` join `department`) where !exists(select 1 from `first_year_per_dep_points` where `first_year_per_dep_points`.`dept_name` = `department`.`dept_name` and `first_year_events`.`sy` = `first_year_per_dep_points`.`sy`) group by `department`.`dept_name`,`first_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `fourth_year_basis_report`
--
DROP TABLE IF EXISTS `fourth_year_basis_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fourth_year_basis_report`  AS  select `student`.`id` AS `stud_id`,`student`.`name` AS `stud_name`,`student`.`department` AS `stud_department`,`fourth_year_events`.`name` AS `event_name`,`student`.`year_level` AS `year_level`,`fourth_year_events`.`sy` AS `School Year`,`fourth_year_events`.`eqv` - `fourth_year_events`.`eqv` AS `Attendance`,`fourth_year_events`.`eqv` AS `Deficiency`,`fourth_year_events`.`eqv` AS `Total Points` from (`student` join `fourth_year_events`) where `student`.`department` = `fourth_year_events`.`department` and `fourth_year_events`.`sy` = `fourth_year_events`.`sy` and `fourth_year_events`.`p4` = `student`.`year_level` group by `student`.`id`,`fourth_year_events`.`sy`,`fourth_year_events`.`name` order by `student`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `fourth_year_events`
--
DROP TABLE IF EXISTS `fourth_year_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fourth_year_events`  AS  select `events`.`id` AS `id`,`events`.`name` AS `name`,`events`.`sy` AS `sy`,`events`.`type` AS `type`,`events`.`department` AS `department`,`events`.`eqv` AS `eqv`,`events`.`p1` AS `p1`,`events`.`p2` AS `p2`,`events`.`p3` AS `p3`,`events`.`p4` AS `p4` from `events` where `events`.`p4` <> '' group by `events`.`sy`,`events`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `fourth_year_per_dep_points`
--
DROP TABLE IF EXISTS `fourth_year_per_dep_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fourth_year_per_dep_points`  AS  select `fourth_year_events`.`department` AS `dept_name`,`fourth_year_events`.`p4` AS `year_level`,sum(`fourth_year_events`.`eqv`) AS `eqv`,`fourth_year_events`.`sy` AS `sy` from `fourth_year_events` group by `fourth_year_events`.`department`,`fourth_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `fourth_year_per_dep_points_list`
--
DROP TABLE IF EXISTS `fourth_year_per_dep_points_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fourth_year_per_dep_points_list`  AS  select `fourth_year_per_dep_points`.`dept_name` AS `dept_name`,`fourth_year_per_dep_points`.`year_level` AS `year_level`,`fourth_year_per_dep_points`.`eqv` AS `eqv`,`fourth_year_per_dep_points`.`sy` AS `sy` from `fourth_year_per_dep_points` union select `department`.`dept_name` AS `dept_name`,`fourth_year_events`.`p4` AS `year_level`,0 AS `eqv`,`fourth_year_events`.`sy` AS `sy` from (`fourth_year_events` join `department`) where !exists(select 1 from `fourth_year_per_dep_points` where `fourth_year_per_dep_points`.`dept_name` = `department`.`dept_name` and `fourth_year_events`.`sy` = `fourth_year_per_dep_points`.`sy`) group by `department`.`dept_name`,`fourth_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `per_event_year_points`
--
DROP TABLE IF EXISTS `per_event_year_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `per_event_year_points`  AS  select `student_attendance_per_event`.`stud_id` AS `stud_id`,`student_attendance_per_event`.`stud_name` AS `stud_name`,`student_attendance_per_event`.`stud_department` AS `stud_department`,`student_attendance_per_event`.`event_name` AS `event_name`,`student_attendance_per_event`.`year_level` AS `year_level`,`student_attendance_per_event`.`School Year` AS `School Year`,`student_attendance_per_event`.`Attendance` AS `Attendance`,`student_attendance_per_event`.`Deficiency` AS `Deficiency`,`student_attendance_per_event`.`Total Points` AS `Total Points`,`student_attendance_per_event`.`Percentage` AS `Percentage` from `student_attendance_per_event` union select `basis_for_per_year_report`.`stud_id` AS `stud_id`,`basis_for_per_year_report`.`stud_name` AS `stud_name`,`basis_for_per_year_report`.`stud_department` AS `stud_department`,`basis_for_per_year_report`.`event_name` AS `event_name`,`basis_for_per_year_report`.`year_level` AS `year_level`,`basis_for_per_year_report`.`School Year` AS `School Year`,`basis_for_per_year_report`.`Attendance` AS `Attendance`,`basis_for_per_year_report`.`Deficiency` AS `Deficiency`,`basis_for_per_year_report`.`Total Points` AS `Total Points`,coalesce((`basis_for_per_year_report`.`Total Points` - `basis_for_per_year_report`.`Attendance`) / `basis_for_per_year_report`.`Total Points` * 100,0) AS `Percentage` from `basis_for_per_year_report` where !exists(select 1 from `student_attendance_per_event` where `student_attendance_per_event`.`stud_id` = `basis_for_per_year_report`.`stud_id` and `student_attendance_per_event`.`event_name` = `basis_for_per_year_report`.`event_name`) group by `basis_for_per_year_report`.`stud_id`,`basis_for_per_year_report`.`School Year`,`basis_for_per_year_report`.`event_name` order by `stud_name` desc ;

-- --------------------------------------------------------

--
-- Structure for view `second_year_basis_report`
--
DROP TABLE IF EXISTS `second_year_basis_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `second_year_basis_report`  AS  select `student`.`id` AS `stud_id`,`student`.`name` AS `stud_name`,`student`.`department` AS `stud_department`,`second_year_events`.`name` AS `event_name`,`student`.`year_level` AS `year_level`,`second_year_events`.`sy` AS `School Year`,`second_year_events`.`eqv` - `second_year_events`.`eqv` AS `Attendance`,`second_year_events`.`eqv` AS `Deficiency`,`second_year_events`.`eqv` AS `Total Points` from (`student` join `second_year_events`) where `student`.`department` = `second_year_events`.`department` and `second_year_events`.`sy` = `second_year_events`.`sy` and `second_year_events`.`p2` = `student`.`year_level` group by `student`.`id`,`second_year_events`.`sy`,`second_year_events`.`name` order by `student`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `second_year_events`
--
DROP TABLE IF EXISTS `second_year_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `second_year_events`  AS  select `events`.`id` AS `id`,`events`.`name` AS `name`,`events`.`sy` AS `sy`,`events`.`type` AS `type`,`events`.`department` AS `department`,`events`.`eqv` AS `eqv`,`events`.`p1` AS `p1`,`events`.`p2` AS `p2`,`events`.`p3` AS `p3`,`events`.`p4` AS `p4` from `events` where `events`.`p2` <> '' group by `events`.`sy`,`events`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `second_year_per_dep_points`
--
DROP TABLE IF EXISTS `second_year_per_dep_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `second_year_per_dep_points`  AS  select `second_year_events`.`department` AS `dept_name`,`second_year_events`.`p2` AS `year_level`,sum(`second_year_events`.`eqv`) AS `eqv`,`second_year_events`.`sy` AS `sy` from `second_year_events` group by `second_year_events`.`department`,`second_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `second_year_per_dep_points_list`
--
DROP TABLE IF EXISTS `second_year_per_dep_points_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `second_year_per_dep_points_list`  AS  select `second_year_per_dep_points`.`dept_name` AS `dept_name`,`second_year_per_dep_points`.`year_level` AS `year_level`,`second_year_per_dep_points`.`eqv` AS `eqv`,`second_year_per_dep_points`.`sy` AS `sy` from `second_year_per_dep_points` union select `department`.`dept_name` AS `dept_name`,`second_year_events`.`p2` AS `year_level`,0 AS `eqv`,`second_year_events`.`sy` AS `sy` from (`second_year_events` join `department`) where !exists(select 1 from `second_year_per_dep_points` where `second_year_per_dep_points`.`dept_name` = `department`.`dept_name` and `second_year_events`.`sy` = `second_year_per_dep_points`.`sy`) group by `department`.`dept_name`,`second_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `student_attendance_per_event`
--
DROP TABLE IF EXISTS `student_attendance_per_event`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_attendance_per_event`  AS  select `attendance`.`stud_id` AS `stud_id`,`attendance`.`stud_name` AS `stud_name`,`attendance`.`stud_department` AS `stud_department`,`attendance`.`event_name` AS `event_name`,`student`.`year_level` AS `year_level`,`attendance`.`stud_year` AS `School Year`,sum(`attendance`.`equivalent`) AS `Attendance`,`events`.`eqv` - sum(`attendance`.`equivalent`) AS `Deficiency`,`events`.`eqv` AS `Total Points`,(`events`.`eqv` - sum(`attendance`.`equivalent`)) / `events`.`eqv` * 100 AS `Percentage` from ((`attendance` join `events` on(`attendance`.`event_id` = `events`.`id`)) join `student` on(`student`.`id` = `attendance`.`stud_id`)) where `events`.`id` = `attendance`.`event_id` and `attendance`.`stud_department` = `events`.`department` group by `attendance`.`event_id`,`attendance`.`stud_year`,`attendance`.`stud_id` ;

-- --------------------------------------------------------

--
-- Structure for view `student_summary_attendance_per_year`
--
DROP TABLE IF EXISTS `student_summary_attendance_per_year`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_summary_attendance_per_year`  AS  select `per_event_year_points`.`stud_id` AS `stud_id`,`per_event_year_points`.`stud_name` AS `stud_name`,`per_event_year_points`.`stud_department` AS `stud_department`,`per_event_year_points`.`year_level` AS `year_level`,`per_event_year_points`.`School Year` AS `School Year`,sum(`per_event_year_points`.`Attendance`) AS `Attendance`,sum(`per_event_year_points`.`Deficiency`) AS `Deficiency`,sum(`per_event_year_points`.`Total Points`) AS `Total Points`,sum(`per_event_year_points`.`Deficiency`) / sum(`per_event_year_points`.`Total Points`) * 100 AS `Percentage` from `per_event_year_points` group by `per_event_year_points`.`stud_id`,`per_event_year_points`.`School Year` order by `per_event_year_points`.`stud_name` ;

-- --------------------------------------------------------

--
-- Structure for view `third_year_basis_report`
--
DROP TABLE IF EXISTS `third_year_basis_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `third_year_basis_report`  AS  select `student`.`id` AS `stud_id`,`student`.`name` AS `stud_name`,`student`.`department` AS `stud_department`,`third_year_events`.`name` AS `event_name`,`student`.`year_level` AS `year_level`,`third_year_events`.`sy` AS `School Year`,`third_year_events`.`eqv` - `third_year_events`.`eqv` AS `Attendance`,`third_year_events`.`eqv` AS `Deficiency`,`third_year_events`.`eqv` AS `Total Points` from (`student` join `third_year_events`) where `student`.`department` = `third_year_events`.`department` and `third_year_events`.`sy` = `third_year_events`.`sy` and `third_year_events`.`p3` = `student`.`year_level` group by `student`.`id`,`third_year_events`.`sy`,`third_year_events`.`name` order by `student`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `third_year_events`
--
DROP TABLE IF EXISTS `third_year_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `third_year_events`  AS  select `events`.`id` AS `id`,`events`.`name` AS `name`,`events`.`sy` AS `sy`,`events`.`type` AS `type`,`events`.`department` AS `department`,`events`.`eqv` AS `eqv`,`events`.`p1` AS `p1`,`events`.`p2` AS `p2`,`events`.`p3` AS `p3`,`events`.`p4` AS `p4` from `events` where `events`.`p3` <> '' group by `events`.`sy`,`events`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `third_year_per_dep_points`
--
DROP TABLE IF EXISTS `third_year_per_dep_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `third_year_per_dep_points`  AS  select `third_year_events`.`department` AS `dept_name`,`third_year_events`.`p3` AS `year_level`,sum(`third_year_events`.`eqv`) AS `eqv`,`third_year_events`.`sy` AS `sy` from `third_year_events` group by `third_year_events`.`department`,`third_year_events`.`sy` ;

-- --------------------------------------------------------

--
-- Structure for view `third_year_per_dep_points_list`
--
DROP TABLE IF EXISTS `third_year_per_dep_points_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `third_year_per_dep_points_list`  AS  select `third_year_per_dep_points`.`dept_name` AS `dept_name`,`third_year_per_dep_points`.`year_level` AS `year_level`,`third_year_per_dep_points`.`eqv` AS `eqv`,`third_year_per_dep_points`.`sy` AS `sy` from `third_year_per_dep_points` union select `department`.`dept_name` AS `dept_name`,`third_year_events`.`p3` AS `year_level`,0 AS `eqv`,`third_year_events`.`sy` AS `sy` from (`third_year_events` join `department`) where !exists(select 1 from `third_year_per_dep_points` where `third_year_per_dep_points`.`dept_name` = `department`.`dept_name` and `third_year_events`.`sy` = `third_year_per_dep_points`.`sy`) group by `department`.`dept_name`,`third_year_events`.`sy` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setsy`
--
ALTER TABLE `setsy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_pool`
--
ALTER TABLE `stud_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesched`
--
ALTER TABLE `timesched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpadv`
--
ALTER TABLE `tmpadv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpattendance`
--
ALTER TABLE `tmpattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpeqv`
--
ALTER TABLE `tmpeqv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpevent`
--
ALTER TABLE `tmpevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpoff`
--
ALTER TABLE `tmpoff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpparticipants`
--
ALTER TABLE `tmpparticipants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmpsched`
--
ALTER TABLE `tmpsched`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setsy`
--
ALTER TABLE `setsy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stud_pool`
--
ALTER TABLE `stud_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesched`
--
ALTER TABLE `timesched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmpadv`
--
ALTER TABLE `tmpadv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpattendance`
--
ALTER TABLE `tmpattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpeqv`
--
ALTER TABLE `tmpeqv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpevent`
--
ALTER TABLE `tmpevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpoff`
--
ALTER TABLE `tmpoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpparticipants`
--
ALTER TABLE `tmpparticipants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpsched`
--
ALTER TABLE `tmpsched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
