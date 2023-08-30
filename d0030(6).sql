-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2023 at 12:00 PM
-- Server version: 5.7.42-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d0030`
--

-- --------------------------------------------------------

--
-- Table structure for table `acts`
--

CREATE TABLE `acts` (
  `act_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `deathdate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `icd` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `medicaloperation` varchar(50) DEFAULT NULL,
  `operation_date` int(11) DEFAULT NULL,
  `operation_reason` text,
  `death_investigated` varchar(200) DEFAULT NULL,
  `death_verifyed` varchar(12) DEFAULT NULL,
  `death_occurred` varchar(255) DEFAULT NULL,
  `explain_death` text,
  `placeddeathoccurred` varchar(1000) DEFAULT NULL,
  `unborn_twins` varchar(3) DEFAULT NULL,
  `born_already_dead` varchar(3) DEFAULT NULL,
  `hildren_24` varchar(3) DEFAULT NULL,
  `living_duration` varchar(34) DEFAULT NULL,
  `weight_child` int(11) DEFAULT NULL,
  `pregnancy_period` int(11) DEFAULT NULL,
  `mother_age` int(11) DEFAULT NULL,
  `mother_condition` text,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `admission_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `paymethod` varchar(50) NOT NULL DEFAULT 'cash',
  `timestamp` int(11) NOT NULL,
  `dischargedate` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `attended` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`admission_id`, `patient_id`, `mode`, `paymethod`, `timestamp`, `dischargedate`, `admin_id`, `status`, `attended`) VALUES
(1, 4, 'normal', 'insurance', 1686047230, 1692119066, 163, 2, NULL),
(2, 2, 'normal', 'insurance', 1686930190, 1689960201, 163, 2, NULL),
(3, 6, 'normal', 'cash', 1687458439, 1692311335, 163, 2, NULL),
(4, 7, 'normal', 'cash', 1687498767, 1688366502, 163, 2, NULL),
(5, 8, 'normal', 'cash', 1687500512, 1692311286, 163, 2, NULL),
(6, 8, 'normal', 'insurance', 1687769968, 1692311344, 163, 2, NULL),
(7, 8, 'normal', 'insurance', 1687947856, 1692311354, 163, 2, NULL),
(19, 14, 'normal', 'insurance', 1690404301, 1690434504, 163, 2, NULL),
(8, 8, 'normal', 'insurance', 1688362914, 1692311362, 163, 2, NULL),
(9, 7, 'normal', 'insurance', 1688366634, 1690402045, 163, 2, NULL),
(10, 9, 'normal', 'insurance', 1690005643, 1690402036, 163, 2, NULL),
(11, 10, 'normal', 'insurance', 1690006600, 1690233394, 163, 2, NULL),
(12, 6, 'normal', 'cash', 1690035367, 1690402054, 163, 2, NULL),
(13, 11, 'normal', 'insurance', 1690212011, 1690231944, 163, 2, NULL),
(14, 2, 'normal', 'insurance', 1690222790, 1690231951, 163, 2, NULL),
(15, 12, 'normal', 'insurance', 1690226155, 1690231964, 163, 2, NULL),
(16, 12, 'normal', 'insurance', 1690232077, 1692651427, 163, 2, NULL),
(17, 13, 'normal', 'credit', 1690264275, 1693040856, 163, 2, NULL),
(18, 11, 'normal', 'insurance', 1690274915, 0, 163, 1, NULL),
(20, 15, 'normal', 'cash', 1690404341, 1692589504, 163, 2, NULL),
(21, 17, 'normal', 'credit', 1690404409, 1690434527, 163, 2, NULL),
(22, 18, 'emergency', 'insurance', 1690404439, 1690434519, 163, 2, NULL),
(23, 10, 'normal', 'insurance', 1690438463, 1692651413, 163, 2, NULL),
(24, 25, 'normal', 'insurance', 1690448777, 0, 163, 1, NULL),
(25, 18, 'normal', 'insurance', 1690451705, 1692430684, 163, 2, NULL),
(26, 21, 'normal', 'insurance', 1690451894, 1690458999, 163, 2, NULL),
(27, 17, 'normal', 'credit', 1690452896, 0, 163, 1, NULL),
(28, 21, 'normal', 'insurance', 1690459025, 0, 163, 1, NULL),
(29, 14, 'emergency', 'insurance', 1690875605, 0, 163, 1, 1),
(30, 2, 'normal', 'cash', 1692010655, 1692875667, 163, 2, NULL),
(31, 4, 'emergency', 'insurance', 1692119119, 0, 163, 1, 1),
(32, 27, 'normal', 'insurance', 1692310848, 0, 163, 1, NULL),
(33, 8, 'normal', 'insurance', 1692311451, 1692312626, 163, 2, NULL),
(34, 8, 'normal', 'insurance', 1692312787, 1692612702, 163, 2, NULL),
(35, 18, 'normal', 'insurance', 1692430851, 1692434574, 163, 2, NULL),
(36, 18, 'emergency', 'insurance', 1692434793, 0, 163, 1, 1),
(37, 15, 'emergency', 'cash postpaid', 1692589641, 0, 163, 1, 1),
(38, 6, 'normal', 'cash', 1692598967, 0, 163, 1, NULL),
(39, 8, 'emergency', 'insurance', 1692612728, 0, 163, 1, 1),
(40, 10, 'normal', 'insurance', 1692651501, 1692694850, 163, 2, NULL),
(41, 10, 'normal', 'insurance', 1692694883, 1693284598, 163, 2, NULL),
(42, 2, 'normal', 'insurance', 1692875713, 1693040796, 163, 2, NULL),
(43, 9, 'normal', 'insurance', 1693041081, 0, 163, 1, NULL),
(44, 10, 'normal', 'insurance', 1693284702, 0, 163, 1, NULL),
(45, 13, 'normal', 'cash', 1693287326, 0, 163, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admitted`
--

CREATE TABLE `admitted` (
  `admitted_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `admissiondate` int(11) NOT NULL,
  `dischargedate` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admitted`
--

INSERT INTO `admitted` (`admitted_id`, `admission_id`, `bed_id`, `price`, `admissiondate`, `dischargedate`, `admin_id`, `status`) VALUES
(1, 13, 3, '50000', 1690146000, 1690146000, 165, 2),
(2, 18, 3, '30000', 1690232400, 1690405200, 165, 2),
(3, 8, 18, '250000', 1690232400, 1690405200, 165, 2),
(4, 19, 9, '30000', 1690405200, 1690405200, 165, 2),
(5, 18, 5, '40000', 1690405200, 0, 165, 1),
(6, 28, 9, '30000', 1690405200, 0, 165, 1);

-- --------------------------------------------------------

--
-- Table structure for table `agegroups`
--

CREATE TABLE `agegroups` (
  `agegroup_id` int(11) NOT NULL,
  `agegroup` varchar(100) NOT NULL,
  `code` varchar(2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agegroups`
--

INSERT INTO `agegroups` (`agegroup_id`, `agegroup`, `code`, `status`) VALUES
(1, '0-11 mois', 'A', 1),
(2, '12-59 mois', 'B', 1),
(3, '5-9 ans', 'C', 1),
(4, '10-14 ans', 'D', 1),
(5, '15-19 ans', 'E', 1),
(6, '20-24 ans', 'F', 1),
(7, '25-29 ans', 'G', 1),
(8, '30-34 ans', 'H', 1),
(9, '35-39 ans', 'I', 1),
(10, '40-44ans', 'J', 1),
(11, '45-49ans', 'K', 1),
(12, '50 ans et +', 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ambulantordereditems`
--

CREATE TABLE `ambulantordereditems` (
  `ambulantordereditem_id` int(11) NOT NULL,
  `ambulantorder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `cpfigure` varchar(100) NOT NULL,
  `unitprice` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ambulantorders`
--

CREATE TABLE `ambulantorders` (
  `ambulantorder_id` int(11) NOT NULL,
  `patientname` varchar(200) NOT NULL,
  `processed` varchar(5) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareport`
--

CREATE TABLE `anaesthesiareport` (
  `anareport_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `proce_dure` varchar(255) DEFAULT NULL,
  `surgeon` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `npo` varchar(255) NOT NULL,
  `allergy` varchar(255) NOT NULL,
  `mallampati` varchar(255) NOT NULL,
  `prevhx` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareport`
--

INSERT INTO `anaesthesiareport` (`anareport_id`, `patient_id`, `proce_dure`, `surgeon`, `weight`, `npo`, `allergy`, `mallampati`, `prevhx`, `admin_id`, `comment`, `date`, `time`, `status`) VALUES
(1, 8, 'check', 'jesca john', '65', '20', 'yes', '45', 'no', 177, 'hello I see the patient is ready for operation', '2023-07-27', '13:44:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareport2`
--

CREATE TABLE `anaesthesiareport2` (
  `anareport2_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `surgeon` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportcns`
--

CREATE TABLE `anaesthesiareportcns` (
  `anareportcns_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportcns`
--

INSERT INTO `anaesthesiareportcns` (`anareportcns_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'bns', '20');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportgen`
--

CREATE TABLE `anaesthesiareportgen` (
  `id` int(11) NOT NULL,
  `anaesthesiareport2_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareporthem`
--

CREATE TABLE `anaesthesiareporthem` (
  `anareporthem_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareporthem`
--

INSERT INTO `anaesthesiareporthem` (`anareporthem_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'bt', '21');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportlabs`
--

CREATE TABLE `anaesthesiareportlabs` (
  `anareportlab_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportlabs`
--

INSERT INTO `anaesthesiareportlabs` (`anareportlab_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, '01A', '23');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportmont`
--

CREATE TABLE `anaesthesiareportmont` (
  `id` int(11) NOT NULL,
  `anaesthesiareport2_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportonc`
--

CREATE TABLE `anaesthesiareportonc` (
  `anareportonc_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportonc`
--

INSERT INTO `anaesthesiareportonc` (`anareportonc_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'ng', '9');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportoth`
--

CREATE TABLE `anaesthesiareportoth` (
  `anareportoth_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportoth`
--

INSERT INTO `anaesthesiareportoth` (`anareportoth_id`, `anaesthesiareport_id`, `type`, `value`) VALUES
(1, 1, 'rf', '3');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportpe`
--

CREATE TABLE `anaesthesiareportpe` (
  `anareportpe_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportpe`
--

INSERT INTO `anaesthesiareportpe` (`anareportpe_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'yu', 'gh'),
(2, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportpla`
--

CREATE TABLE `anaesthesiareportpla` (
  `anareportpla_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportpla`
--

INSERT INTO `anaesthesiareportpla` (`anareportpla_id`, `anaesthesiareport_id`, `type`, `value`) VALUES
(1, 1, 'fg', '5');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportpul`
--

CREATE TABLE `anaesthesiareportpul` (
  `anareportpul_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportpul`
--

INSERT INTO `anaesthesiareportpul` (`anareportpul_id`, `anaesthesiareport_id`, `type`, `value`) VALUES
(1, 1, 'tv', '12');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportreext`
--

CREATE TABLE `anaesthesiareportreext` (
  `id` int(11) NOT NULL,
  `anaesthesiareport2_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportreg`
--

CREATE TABLE `anaesthesiareportreg` (
  `id` int(11) NOT NULL,
  `anaesthesiareport2_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportrenal`
--

CREATE TABLE `anaesthesiareportrenal` (
  `anareportrenal_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportrenal`
--

INSERT INTO `anaesthesiareportrenal` (`anareportrenal_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'sx', '0.36');

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportven`
--

CREATE TABLE `anaesthesiareportven` (
  `id` int(11) NOT NULL,
  `anaesthesiareport2_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anaesthesiareportvitals`
--

CREATE TABLE `anaesthesiareportvitals` (
  `anareportvit_id` int(11) NOT NULL,
  `anaesthesiareport_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anaesthesiareportvitals`
--

INSERT INTO `anaesthesiareportvitals` (`anareportvit_id`, `anaesthesiareport_id`, `type`, `result`) VALUES
(1, 1, 'blood', '13');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` int(11) NOT NULL,
  `bedname` varchar(100) NOT NULL,
  `bedfee` varchar(10) DEFAULT NULL,
  `ward_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bed_id`, `bedname`, `bedfee`, `ward_id`, `status`) VALUES
(3, '1', '10000', 27, 1),
(4, '2', '10000', 27, 1),
(5, '1', '10000', 25, 1),
(6, '2', '10000', 25, 1),
(7, '3', '10000', 25, 1),
(8, '4', '10000', 25, 1),
(9, '1', '10000', 24, 1),
(10, '2', '10000', 24, 1),
(11, '3', '10000', 24, 1),
(12, '4', '10000', 24, 1),
(13, '5', '10000', 24, 1),
(14, '6', '10000', 24, 1),
(15, '7', '10000', 24, 1),
(16, '8', '10000', 24, 1),
(17, '9', '10000', 24, 1),
(18, '10', '10000', 24, 1),
(19, '1', '10000', 26, 1),
(20, '2', '10000', 26, 1),
(21, '3', '10000', 26, 1),
(22, '4', '10000', 26, 1),
(23, '5', '10000', 26, 1),
(24, '6', '10000', 26, 1),
(25, '7', '10000', 26, 1),
(26, '08', '10000', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `clinic` int(11) NOT NULL DEFAULT '0',
  `admission_id` int(11) DEFAULT NULL,
  `patientsque_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `amount` int(25) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `patient_id`, `clinic`, `admission_id`, `patientsque_id`, `type`, `type_id`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-05-15 13:45:34', '2023-08-15 17:04:26'),
(2, 4, 0, 1, 153, 'medical_service', 67, 4000, 'insurance', 4, '2023-06-06 10:27:10', '2023-08-15 17:04:26'),
(3, 2, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-06-16 15:32:38', '2023-07-21 17:23:21'),
(4, 2, 0, 2, 154, 'medical_service', 68, 5000, 'insurance', 4, '2023-06-16 15:43:10', '2023-07-21 17:23:21'),
(5, 3, 0, NULL, NULL, 'unselective', 1363, 1500, 'credit', 0, '2023-06-16 15:53:05', '2023-06-23 05:25:28'),
(6, 2, 0, 2, 157, 'lab', 31, 11000, 'cash', 4, '2023-06-17 11:19:34', '2023-07-21 17:23:21'),
(7, 2, 0, 2, 158, 'radiography', 18, 6000, 'cash', 4, '2023-06-17 11:19:34', '2023-07-21 17:23:21'),
(8, 5, 0, NULL, NULL, 'unselective', 1363, 1500, 'cash', 2, '2023-06-17 11:32:53', '2023-06-23 05:57:31'),
(9, 6, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 4, '2023-06-22 18:21:47', '2023-07-26 20:07:34'),
(10, 6, 0, 3, 159, 'medical_service', 69, 6000, 'cash', 4, '2023-06-22 18:27:19', '2023-07-26 20:07:34'),
(11, 6, 0, 3, 160, 'radiography', 19, 0, 'cash', 5, '2023-06-22 18:36:36', '2023-07-03 05:33:10'),
(12, 7, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 4, '2023-06-23 05:35:57', '2023-07-03 06:41:42'),
(13, 7, 0, 4, 162, 'medical_service', 70, 5000, 'cash', 4, '2023-06-23 05:39:27', '2023-07-03 06:41:42'),
(14, 8, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 5, '2023-06-23 05:57:05', '2023-06-26 08:36:52'),
(15, 8, 0, 5, 163, 'medical_service', 71, 5000, 'cash', 5, '2023-06-23 06:08:32', '2023-06-26 08:36:52'),
(16, 8, 0, 6, 164, 'medical_service', 72, 5000, 'insurance', 4, '2023-06-26 08:59:28', '2023-07-03 05:15:20'),
(17, 8, 0, 6, 165, 'lab', 32, 6000, 'insurance', 4, '2023-06-26 09:09:35', '2023-07-03 05:15:20'),
(18, 8, 0, 6, 166, 'radiography', 20, 2000, 'insurance', 4, '2023-06-26 09:09:35', '2023-07-03 05:15:20'),
(19, 8, 0, 7, 167, 'medical_service', 73, 5000, 'insurance', 4, '2023-06-28 10:24:16', '2023-07-03 05:15:20'),
(20, 8, 0, 7, 168, 'lab', 33, 12000, 'insurance', 4, '2023-06-28 10:33:56', '2023-07-03 05:15:20'),
(21, 8, 0, 7, 169, 'radiography', 21, 20000, 'insurance', 4, '2023-06-28 10:33:56', '2023-07-03 05:15:20'),
(22, 8, 0, 8, 173, 'medical_service', 74, 5000, 'insurance', 4, '2023-07-03 05:41:54', '2023-07-27 05:09:03'),
(23, 8, 0, 8, 174, 'lab', 34, 12000, 'insurance', 4, '2023-07-03 05:56:01', '2023-07-27 05:09:03'),
(24, 8, 0, 8, 175, 'radiography', 22, 20000, 'insurance', 4, '2023-07-03 05:56:01', '2023-07-27 05:09:03'),
(25, 7, 0, 9, 178, 'medical_service', 75, 1000, 'insurance', 4, '2023-07-03 06:43:54', '2023-07-26 20:07:25'),
(26, 9, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-21 20:06:59', '2023-07-26 20:07:16'),
(27, 10, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-22 06:13:44', '2023-07-24 21:16:34'),
(28, 10, 0, 11, 180, 'medical_service', 76, 2000, 'insurance', 4, '2023-07-22 06:16:40', '2023-07-24 21:16:34'),
(29, 10, 0, 11, 181, 'lab', 35, 6000, 'insurance', 4, '2023-07-22 06:30:02', '2023-07-24 21:16:34'),
(30, 10, 0, 11, 182, 'radiography', 23, 15000, 'insurance', 4, '2023-07-22 06:30:02', '2023-07-24 21:16:34'),
(31, 6, 0, 12, 188, 'medical_service', 77, 5000, 'cash', 4, '2023-07-22 14:16:07', '2023-07-26 20:07:34'),
(32, 6, 0, 12, 189, 'radiography', 24, 0, 'cash', 4, '2023-07-22 14:18:48', '2023-07-26 20:07:34'),
(33, 10, 0, 11, 191, 'lab', 36, 2000, 'insurance', 4, '2023-07-24 15:07:25', '2023-07-24 21:16:34'),
(34, 10, 0, 11, 192, 'radiography', 25, 15000, 'insurance', 4, '2023-07-24 15:07:25', '2023-07-24 21:16:34'),
(35, 11, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-24 15:15:27', '2023-07-24 20:52:24'),
(36, 11, 0, 13, 193, 'medical_service', 78, 2000, 'insurance', 4, '2023-07-24 15:20:11', '2023-07-24 20:52:24'),
(37, 11, 0, 13, 194, 'lab', 37, 9000, 'insurance', 4, '2023-07-24 15:23:48', '2023-07-24 20:52:24'),
(38, 11, 0, 13, 195, 'radiography', 26, 15000, 'insurance', 4, '2023-07-24 15:23:48', '2023-07-24 20:52:24'),
(39, 2, 0, 14, 201, 'medical_service', 79, 10000, 'insurance', 4, '2023-07-24 18:19:50', '2023-07-24 20:52:31'),
(40, 12, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-24 18:31:21', '2023-07-24 20:52:44'),
(41, 12, 0, 15, 203, 'medical_service', 80, 3000, 'cash', 4, '2023-07-24 19:15:55', '2023-07-24 20:52:44'),
(42, 11, 0, 13, 205, 'medical_service', 81, 3000, 'cash', 4, '2023-07-24 19:20:14', '2023-07-24 20:52:24'),
(43, 11, 0, 13, 193, 'admission', 1, 50000, 'insurance', 4, '2023-07-24 19:21:40', '2023-07-24 20:52:24'),
(44, 12, 0, 16, 207, 'medical_service', 82, 10000, 'insurance', 4, '2023-07-24 20:54:37', '2023-08-21 20:57:07'),
(45, 12, 0, 16, 209, 'lab', 38, 2000, 'insurance', 4, '2023-07-24 21:04:41', '2023-08-21 20:57:07'),
(46, 12, 0, 16, 210, 'radiography', 27, 20000, 'insurance', 4, '2023-07-24 21:04:41', '2023-08-21 20:57:07'),
(47, 13, 0, NULL, NULL, 'unselective', 1363, 1500, 'credit', 2, '2023-07-25 05:48:35', '2023-07-25 05:49:12'),
(48, 13, 0, 17, 215, 'medical_service', 83, 5000, 'credit', 2, '2023-07-25 05:51:15', '2023-07-25 05:51:33'),
(49, 13, 0, 17, 216, 'medical_service', 84, 1000, 'credit', 2, '2023-07-25 08:28:05', '2023-07-25 08:32:27'),
(50, 13, 0, 17, 217, 'pharmacy', 1, 700, 'credit', 2, '2023-07-25 08:28:05', '2023-07-25 08:32:27'),
(51, 13, 0, 17, 218, 'medical_service', 85, 1000, 'credit', 2, '2023-07-25 08:28:28', '2023-07-25 08:32:27'),
(52, 13, 0, 17, 219, 'pharmacy', 2, 700, 'credit', 2, '2023-07-25 08:28:28', '2023-07-25 08:32:27'),
(53, 13, 0, 17, 220, 'medical_service', 86, 1000, 'credit', 2, '2023-07-25 08:30:54', '2023-07-25 08:32:27'),
(54, 13, 0, 17, 221, 'pharmacy', 3, 700, 'credit', 2, '2023-07-25 08:30:54', '2023-07-25 08:32:27'),
(55, 11, 0, 18, 223, 'medical_service', 87, 2000, 'insurance', 2, '2023-07-25 08:48:35', '2023-07-25 08:49:02'),
(56, 11, 0, 18, 224, 'lab', 39, 30000, 'cash', 2, '2023-07-25 08:50:33', '2023-07-25 08:54:10'),
(57, 11, 0, 18, 227, 'radiography', 28, 15000, 'insurance', 2, '2023-07-25 10:32:43', '2023-07-25 10:33:05'),
(58, 11, 0, 18, 223, 'admission', 2, 30000, 'insurance', 2, '2023-07-25 10:33:59', '2023-07-25 12:28:03'),
(59, 12, 0, 16, 229, 'pharmacy', 4, 700, 'insurance', 4, '2023-07-25 10:36:02', '2023-08-21 20:57:07'),
(60, 12, 0, 16, 230, 'pharmacy', 5, 700, 'insurance', 4, '2023-07-25 10:37:30', '2023-08-21 20:57:07'),
(61, 12, 0, 16, 231, 'lab', 40, 20000, 'insurance', 4, '2023-07-25 10:40:46', '2023-08-21 20:57:07'),
(62, 8, 0, 8, 232, 'lab', 41, 15000, 'insurance', 5, '2023-07-25 10:44:49', '2023-07-26 20:18:23'),
(63, 8, 0, 8, 233, 'lab', 42, 4000, 'insurance', 5, '2023-07-25 10:45:39', '2023-07-26 20:18:23'),
(64, 8, 0, 8, 234, 'lab', 43, 4000, 'insurance', 5, '2023-07-25 10:49:13', '2023-07-26 20:18:23'),
(65, 8, 0, 8, 235, 'lab', 44, 4000, 'insurance', 5, '2023-07-25 10:52:09', '2023-07-26 20:18:23'),
(66, 8, 0, 8, 236, 'lab', 45, 4000, 'insurance', 5, '2023-07-25 10:55:47', '2023-07-26 20:18:23'),
(67, 8, 0, 8, 237, 'lab', 46, 4000, 'insurance', 5, '2023-07-25 10:57:06', '2023-07-26 20:18:23'),
(68, 12, 0, 16, 238, 'lab', 47, 15000, 'cash', 4, '2023-07-25 10:58:19', '2023-08-21 20:57:07'),
(69, 12, 0, 16, 239, 'lab', 48, 0, 'cash', 4, '2023-07-25 11:01:16', '2023-08-21 20:57:07'),
(70, 8, 0, 8, 173, 'admission', 3, 250000, 'insurance', 5, '2023-07-25 11:08:52', '2023-07-26 20:18:23'),
(71, 11, 0, 18, 241, 'pharmacy', 6, 6000, 'insurance', 2, '2023-07-25 11:50:21', '2023-07-25 12:28:03'),
(72, 12, 0, 16, 242, 'pharmacy', 7, 700, 'insurance', 4, '2023-07-25 12:04:28', '2023-08-21 20:57:07'),
(73, 12, 0, 16, 243, 'pharmacy', 8, 200, 'insurance', 4, '2023-07-26 07:53:12', '2023-08-21 20:57:07'),
(74, 14, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-26 20:03:11', '2023-07-27 05:08:24'),
(75, 15, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 4, '2023-07-26 20:03:29', '2023-08-21 03:45:04'),
(76, 16, 0, NULL, NULL, 'unselective', 1363, 1200, '', 5, '2023-07-26 20:03:43', '2023-07-26 20:06:15'),
(77, 17, 0, NULL, NULL, 'unselective', 1363, 1500, 'credit', 4, '2023-07-26 20:04:27', '2023-07-27 05:08:47'),
(78, 18, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-26 20:09:52', '2023-07-27 05:08:39'),
(79, 14, 0, 19, 244, 'medical_service', 88, 5000, 'insurance', 4, '2023-07-26 20:45:01', '2023-07-27 05:08:24'),
(80, 15, 0, 20, 245, 'medical_service', 89, 15000, 'cash', 4, '2023-07-26 20:45:41', '2023-08-21 03:45:04'),
(81, 17, 0, 21, 246, 'medical_service', 90, 10000, 'credit', 4, '2023-07-26 20:46:49', '2023-07-27 05:08:47'),
(82, 15, 0, 20, 247, 'lab', 49, 6000, 'cash', 4, '2023-07-26 20:59:42', '2023-08-21 03:45:04'),
(83, 15, 0, 20, 248, 'radiography', 29, 0, 'cash', 4, '2023-07-26 20:59:42', '2023-08-21 03:45:04'),
(84, 14, 0, 19, 244, 'admission', 4, 30000, 'insurance', 4, '2023-07-26 21:01:17', '2023-07-27 05:08:24'),
(85, 15, 0, 20, 251, 'pharmacy', 9, 700, 'cash', 4, '2023-07-27 04:28:03', '2023-08-21 03:45:04'),
(86, 15, 0, 20, 252, 'medical_service', 91, 1000, 'cash', 4, '2023-07-27 04:28:36', '2023-08-21 03:45:04'),
(87, 15, 0, 20, 255, 'radiography', 30, 0, 'cash', 4, '2023-07-27 05:23:10', '2023-08-21 03:45:04'),
(88, 15, 0, 20, 259, 'medical_service', 92, 454000, 'cash', 4, '2023-07-27 05:58:26', '2023-08-21 03:45:04'),
(89, 10, 0, 23, 261, 'medical_service', 93, 2000, 'insurance', 4, '2023-07-27 06:14:23', '2023-08-21 20:56:53'),
(90, 10, 0, 23, 262, 'medical_service', 94, 1000, 'insurance', 4, '2023-07-27 06:19:11', '2023-08-21 20:56:53'),
(91, 12, 0, 16, 264, 'medical_service', 95, 1000, 'cash', 4, '2023-07-27 07:09:58', '2023-08-21 20:57:07'),
(92, 19, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 2, '2023-07-27 07:17:53', '2023-07-27 07:18:58'),
(93, 25, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 2, '2023-07-27 08:45:23', '2023-07-27 08:45:44'),
(94, 25, 0, 24, 266, 'medical_service', 96, 2000, 'insurance', 2, '2023-07-27 09:06:17', '2023-07-27 09:06:32'),
(95, 25, 0, 24, 267, 'pharmacy', 10, 400, 'insurance', 2, '2023-07-27 09:07:54', '2023-07-27 09:08:15'),
(96, 21, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-27 09:17:46', '2023-07-27 11:56:39'),
(97, 21, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-27 09:19:34', '2023-07-27 11:56:39'),
(98, 21, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 4, '2023-07-27 09:19:35', '2023-07-27 11:56:39'),
(99, 18, 0, 25, 268, 'medical_service', 97, 2000, 'insurance', 4, '2023-07-27 09:55:05', '2023-08-19 07:38:04'),
(100, 21, 0, 26, 269, 'medical_service', 98, 2000, 'insurance', 4, '2023-07-27 09:58:14', '2023-07-27 11:56:39'),
(101, 8, 0, 8, 270, 'medical_service', 99, 5000, 'cash', 4, '2023-07-27 10:05:30', '2023-08-17 22:28:06'),
(102, 17, 0, 27, 271, 'medical_service', 100, 5000, 'credit', 2, '2023-07-27 10:14:56', '2023-07-27 10:16:09'),
(103, 17, 0, 27, 272, 'pharmacy', 11, 0, 'credit', 2, '2023-07-27 10:22:19', '2023-07-27 10:29:04'),
(104, 17, 0, 27, 273, 'lab', 50, 25000, 'cash', 2, '2023-07-27 10:22:19', '2023-07-27 10:29:04'),
(105, 21, 0, 26, 276, 'lab', 51, 7000, 'insurance', 4, '2023-07-27 10:49:41', '2023-07-27 11:56:39'),
(106, 21, 0, 26, 277, 'radiography', 31, 15000, 'insurance', 4, '2023-07-27 10:49:41', '2023-07-27 11:56:39'),
(107, 21, 0, 28, 279, 'medical_service', 101, 2000, 'insurance', 2, '2023-07-27 11:57:05', '2023-07-27 11:57:21'),
(108, 21, 0, 28, 280, 'lab', 52, 7000, 'insurance', 2, '2023-07-27 11:59:40', '2023-07-27 12:00:17'),
(109, 21, 0, 28, 281, 'radiography', 32, 15000, 'insurance', 2, '2023-07-27 11:59:40', '2023-07-27 12:00:17'),
(110, 21, 0, 28, 284, 'pharmacy', 12, 0, 'insurance', 2, '2023-07-27 12:32:24', '2023-07-27 12:33:00'),
(111, 8, 0, 8, 286, 'lab', 53, 43000, 'insurance', 4, '2023-07-27 12:41:55', '2023-08-17 22:28:06'),
(112, 18, 0, 25, 287, 'pharmacy', 13, 0, 'insurance', 4, '2023-07-27 12:44:16', '2023-08-19 07:38:04'),
(113, 11, 0, 18, 223, 'admission', 5, 40000, 'insurance', 2, '2023-07-27 13:49:25', '2023-07-27 13:49:59'),
(114, 21, 0, 28, 289, 'medical_service', 102, 3000, 'cash', 2, '2023-07-27 13:58:52', '2023-07-27 14:00:04'),
(115, 21, 0, 28, 279, 'admission', 6, 30000, 'insurance', 2, '2023-07-27 14:45:33', '2023-07-27 14:51:35'),
(116, 21, 0, 28, 293, 'lab', 54, 8500, 'insurance', 2, '2023-07-27 21:09:46', '2023-07-27 21:10:04'),
(117, 21, 0, 28, 294, 'radiography', 33, 15000, 'insurance', 2, '2023-07-27 21:29:23', '2023-07-27 21:29:59'),
(118, 21, 0, 28, 296, 'radiography', 34, 15000, 'insurance', 2, '2023-07-27 21:33:04', '2023-07-27 21:33:20'),
(119, 21, 0, 28, 297, 'medical_service', 103, 453000, 'cash', 2, '2023-07-27 21:54:08', '2023-07-27 21:54:27'),
(120, 21, 0, 28, 297, 'medical_service', 104, 1000, 'insurance', 2, '2023-07-27 21:54:08', '2023-07-27 21:54:27'),
(121, 21, 0, 28, 299, 'medical_service', 105, 453000, 'cash', 2, '2023-07-28 09:01:54', '2023-07-28 09:03:00'),
(122, 21, 0, 28, 299, 'medical_service', 106, 1000, 'insurance', 2, '2023-07-28 09:01:54', '2023-07-28 09:03:00'),
(123, 26, 0, NULL, NULL, 'unselective', 1363, 1200, 'cash', 2, '2023-07-28 09:32:48', '2023-07-28 09:33:23'),
(124, 14, 0, 29, 301, 'medical_service', 107, 5000, 'insurance', 1, '2023-08-01 07:40:05', '2023-08-01 07:40:05'),
(125, 2, 0, 30, 302, 'medical_service', 108, 10000, 'cash', 2, '2023-08-14 10:57:35', '2023-08-24 11:31:25'),
(126, 4, 0, 31, 303, 'medical_service', 109, 3000, 'insurance', 1, '2023-08-15 17:05:19', '2023-08-15 17:05:19'),
(127, 2, 0, 30, 304, 'pharmacy', 14, 1900, 'cash', 2, '2023-08-17 17:10:50', '2023-08-24 11:31:25'),
(128, 27, 0, NULL, NULL, 'unselective', 1363, 2000, 'insurance', 2, '2023-08-17 22:08:30', '2023-08-17 22:13:44'),
(129, 8, 0, 33, 306, 'medical_service', 111, 5000, 'insurance', 4, '2023-08-17 22:30:51', '2023-08-17 22:50:26'),
(130, 8, 0, 33, 307, 'pharmacy', 15, 30400, 'insurance', 4, '2023-08-17 22:37:58', '2023-08-17 22:50:26'),
(131, 8, 0, 34, 308, 'medical_service', 112, 5000, 'insurance', 4, '2023-08-17 22:53:07', '2023-08-21 10:11:42'),
(132, 8, 0, 34, 309, 'pharmacy', 16, 28000, 'insurance', 4, '2023-08-17 23:00:10', '2023-08-21 10:11:42'),
(133, 18, 0, 35, 310, 'medical_service', 113, 2000, 'insurance', 4, '2023-08-19 07:40:51', '2023-08-19 08:42:54'),
(134, 18, 0, 35, 311, 'lab', 55, 4500, 'insurance', 4, '2023-08-19 08:06:41', '2023-08-19 08:42:54'),
(135, 18, 0, 35, 312, 'radiography', 35, 15000, 'insurance', 4, '2023-08-19 08:06:41', '2023-08-19 08:42:54'),
(136, 18, 0, 35, 314, 'pharmacy', 17, 1400, 'insurance', 4, '2023-08-19 08:34:37', '2023-08-19 08:42:54'),
(137, 18, 0, 36, 315, 'medical_service', 114, 2000, 'insurance', 1, '2023-08-19 08:46:33', '2023-08-19 08:46:33'),
(138, 15, 0, 37, 316, 'medical_service', 115, 5000, 'cash', 1, '2023-08-21 03:47:21', '2023-08-21 03:47:21'),
(139, 14, 0, 29, 318, 'lab', 57, 20000, 'insurance', 1, '2023-08-21 06:02:03', '2023-08-21 06:02:03'),
(140, 14, 0, 29, 319, 'radiography', 36, 20000, 'insurance', 1, '2023-08-21 06:02:03', '2023-08-21 06:02:03'),
(141, 14, 0, 29, 320, 'lab', 58, 3000, 'insurance', 1, '2023-08-21 06:20:24', '2023-08-21 06:20:24'),
(142, 6, 0, 38, 321, 'medical_service', 116, 5000, 'cash', 2, '2023-08-21 06:22:47', '2023-08-21 06:23:11'),
(143, 6, 0, 38, 322, 'lab', 59, 20000, 'cash', 2, '2023-08-21 06:24:38', '2023-08-29 05:40:41'),
(144, 6, 0, 38, 323, 'radiography', 37, 35000, 'cash', 2, '2023-08-21 06:24:38', '2023-08-29 05:40:41'),
(145, 8, 0, 39, 324, 'medical_service', 117, 5000, 'insurance', 1, '2023-08-21 10:12:08', '2023-08-21 10:12:08'),
(146, 10, 0, 40, 328, 'medical_service', 118, 2000, 'insurance', 4, '2023-08-21 20:58:21', '2023-08-22 09:00:50'),
(147, 10, 0, 40, 329, 'lab', 60, 11900, 'insurance', 4, '2023-08-21 21:14:47', '2023-08-22 09:00:50'),
(148, 10, 0, 40, 330, 'radiography', 39, 30000, 'insurance', 4, '2023-08-21 21:14:47', '2023-08-22 09:00:50'),
(149, 10, 0, 41, 331, 'medical_service', 119, 2000, 'insurance', 2, '2023-08-22 09:01:23', '2023-08-22 09:03:45'),
(150, 10, 0, 41, 332, 'radiography', 40, 30000, 'insurance', 2, '2023-08-22 09:10:00', '2023-08-22 09:11:39'),
(151, 2, 0, 42, 334, 'medical_service', 120, 5000, 'insurance', 2, '2023-08-24 11:15:13', '2023-08-24 11:31:25'),
(152, 2, 0, 42, 335, 'lab', 61, 10000, 'cash', 2, '2023-08-24 11:25:29', '2023-08-24 11:31:25'),
(153, 2, 0, 42, 336, 'radiography', 41, 30000, 'insurance', 8, '2023-08-24 11:25:29', '2023-08-24 11:31:25'),
(154, 9, 0, 43, 338, 'medical_service', 121, 2000, 'insurance', 2, '2023-08-26 09:11:21', '2023-08-26 09:12:57'),
(155, 9, 0, 43, 339, 'lab', 62, 15000, 'insurance', 1, '2023-08-26 09:23:26', '2023-08-26 09:23:26'),
(156, 9, 0, 43, 340, 'radiography', 42, 15000, 'insurance', 1, '2023-08-26 09:23:26', '2023-08-26 09:23:26'),
(157, 10, 0, 44, 342, 'medical_service', 122, 2000, 'insurance', 2, '2023-08-29 04:51:42', '2023-08-29 04:52:18'),
(158, 10, 0, 44, 343, 'lab', 63, 10000, 'insurance', 2, '2023-08-29 05:02:12', '2023-08-29 05:03:48'),
(159, 10, 0, 44, 344, 'radiography', 43, 15000, 'insurance', 2, '2023-08-29 05:02:12', '2023-08-29 05:03:48'),
(160, 13, 0, 45, 346, 'medical_service', 123, 5000, 'cash', 2, '2023-08-29 05:35:26', '2023-08-29 05:36:25'),
(161, 13, 0, 45, 347, 'lab', 64, 10000, 'cash', 2, '2023-08-29 05:38:42', '2023-08-29 05:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `bill_payments`
--

CREATE TABLE `bill_payments` (
  `bill_payment_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount` int(25) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_payments`
--

INSERT INTO `bill_payments` (`bill_payment_id`, `bill_id`, `amount`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 30, 0, 'cash', '2023-05-15 13:11:17', '2023-05-15 13:11:17'),
(2, 1, 2000, 'insurance', '2023-05-15 13:49:17', '2023-05-15 13:49:17'),
(3, 2, 4000, 'insurance', '2023-06-06 10:27:32', '2023-06-06 10:27:32'),
(4, 3, 2000, 'insurance', '2023-06-16 15:36:19', '2023-06-16 15:36:19'),
(5, 4, 5000, 'insurance', '2023-06-16 16:00:37', '2023-06-16 16:00:37'),
(6, 6, 1200, 'cash', '2023-06-22 18:22:53', '2023-06-22 18:22:53'),
(7, 9, 1200, 'cash', '2023-06-22 18:30:51', '2023-06-22 18:30:51'),
(8, 10, 6000, 'cash', '2023-06-22 18:30:51', '2023-06-22 18:30:51'),
(9, 6, 0, 'cash', '2023-06-22 18:37:35', '2023-06-22 18:37:35'),
(10, 7, 1200, 'cash', '2023-06-23 05:36:18', '2023-06-23 05:36:18'),
(11, 8, 1200, 'cash', '2023-06-23 05:57:31', '2023-06-23 05:57:31'),
(12, 12, 1200, 'cash', '2023-06-23 06:11:32', '2023-06-23 06:11:32'),
(13, 13, 5000, 'cash', '2023-06-23 06:11:32', '2023-06-23 06:11:32'),
(14, 16, 5000, 'insurance', '2023-06-26 09:01:57', '2023-06-26 09:01:57'),
(15, 17, 6000, 'insurance', '2023-06-26 09:17:30', '2023-06-26 09:17:30'),
(16, 18, 2000, 'insurance', '2023-06-26 09:17:30', '2023-06-26 09:17:30'),
(17, 19, 5000, 'insurance', '2023-06-28 10:25:53', '2023-06-28 10:25:53'),
(18, 20, 12000, 'insurance', '2023-06-28 10:39:08', '2023-06-28 10:39:08'),
(19, 21, 20000, 'insurance', '2023-06-28 10:39:08', '2023-06-28 10:39:08'),
(20, 22, 5000, 'insurance', '2023-07-03 05:44:27', '2023-07-03 05:44:27'),
(21, 23, 12000, 'insurance', '2023-07-03 06:06:37', '2023-07-03 06:06:37'),
(22, 24, 20000, 'insurance', '2023-07-03 06:06:37', '2023-07-03 06:06:37'),
(23, 25, 1000, 'insurance', '2023-07-03 06:47:38', '2023-07-03 06:47:38'),
(24, 26, 2000, 'insurance', '2023-07-21 20:07:44', '2023-07-21 20:07:44'),
(25, 27, 2000, 'insurance', '2023-07-22 06:14:10', '2023-07-22 06:14:10'),
(26, 28, 2000, 'insurance', '2023-07-22 06:17:04', '2023-07-22 06:17:04'),
(27, 29, 6000, 'insurance', '2023-07-22 06:39:47', '2023-07-22 06:39:47'),
(28, 30, 15000, 'insurance', '2023-07-22 06:39:47', '2023-07-22 06:39:47'),
(29, 31, 5000, 'cash', '2023-07-22 14:17:00', '2023-07-22 14:17:00'),
(30, 32, 0, 'cash', '2023-07-22 14:19:59', '2023-07-22 14:19:59'),
(31, 35, 2000, 'insurance', '2023-07-24 15:16:14', '2023-07-24 15:16:14'),
(32, 36, 2000, 'insurance', '2023-07-24 15:20:30', '2023-07-24 15:20:30'),
(33, 37, 9000, 'insurance', '2023-07-24 15:24:19', '2023-07-24 15:24:19'),
(34, 38, 15000, 'insurance', '2023-07-24 15:24:19', '2023-07-24 15:24:19'),
(35, 33, 2000, 'insurance', '2023-07-24 15:31:26', '2023-07-24 15:31:26'),
(36, 34, 15000, 'insurance', '2023-07-24 15:31:26', '2023-07-24 15:31:26'),
(37, 39, 10000, 'insurance', '2023-07-24 18:20:43', '2023-07-24 18:20:43'),
(38, 40, 2000, 'insurance', '2023-07-24 18:32:17', '2023-07-24 18:32:17'),
(39, 41, 3000, 'cash', '2023-07-24 19:17:07', '2023-07-24 19:17:07'),
(40, 42, 3000, 'cash', '2023-07-24 19:22:13', '2023-07-24 19:22:13'),
(41, 43, 50000, 'insurance', '2023-07-24 19:22:13', '2023-07-24 19:22:13'),
(42, 44, 10000, 'insurance', '2023-07-24 20:55:14', '2023-07-24 20:55:14'),
(43, 45, 2000, 'insurance', '2023-07-24 21:05:30', '2023-07-24 21:05:30'),
(44, 46, 20000, 'insurance', '2023-07-24 21:05:30', '2023-07-24 21:05:30'),
(45, 47, 1500, 'credit', '2023-07-25 05:49:12', '2023-07-25 05:49:12'),
(46, 48, 5000, 'credit', '2023-07-25 05:51:33', '2023-07-25 05:51:33'),
(47, 49, 1000, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(48, 50, 700, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(49, 51, 1000, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(50, 52, 700, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(51, 53, 1000, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(52, 54, 700, 'credit', '2023-07-25 08:32:27', '2023-07-25 08:32:27'),
(53, 55, 2000, 'insurance', '2023-07-25 08:49:02', '2023-07-25 08:49:02'),
(54, 56, 30000, 'cash', '2023-07-25 08:54:10', '2023-07-25 08:54:10'),
(55, 57, 15000, 'insurance', '2023-07-25 10:33:05', '2023-07-25 10:33:05'),
(56, 59, 700, 'insurance', '2023-07-25 11:57:07', '2023-07-25 11:57:07'),
(57, 60, 700, 'insurance', '2023-07-25 11:57:07', '2023-07-25 11:57:07'),
(58, 61, 20000, 'insurance', '2023-07-25 11:57:07', '2023-07-25 11:57:07'),
(59, 68, 15000, 'cash', '2023-07-25 11:57:07', '2023-07-25 11:57:07'),
(60, 69, 0, 'cash', '2023-07-25 11:57:07', '2023-07-25 11:57:07'),
(61, 72, 700, 'insurance', '2023-07-25 12:04:51', '2023-07-25 12:04:51'),
(62, 58, 30000, 'insurance', '2023-07-25 12:28:03', '2023-07-25 12:28:03'),
(63, 71, 6000, 'insurance', '2023-07-25 12:28:03', '2023-07-25 12:28:03'),
(64, 73, 200, 'insurance', '2023-07-26 07:55:07', '2023-07-26 07:55:07'),
(65, 78, 2000, 'insurance', '2023-07-26 20:15:00', '2023-07-26 20:15:00'),
(66, 74, 2000, 'insurance', '2023-07-26 20:16:02', '2023-07-26 20:16:02'),
(67, 75, 1200, 'cash', '2023-07-26 20:16:13', '2023-07-26 20:16:13'),
(68, 77, 1500, 'credit', '2023-07-26 20:17:49', '2023-07-26 20:17:49'),
(69, 79, 5000, 'insurance', '2023-07-26 20:47:54', '2023-07-26 20:47:54'),
(70, 81, 10000, 'credit', '2023-07-26 20:48:18', '2023-07-26 20:48:18'),
(71, 80, 15000, 'cash', '2023-07-26 20:48:33', '2023-07-26 20:48:33'),
(72, 84, 30000, 'insurance', '2023-07-26 21:19:10', '2023-07-26 21:19:10'),
(73, 82, 6000, 'cash', '2023-07-26 21:20:54', '2023-07-26 21:20:54'),
(74, 83, 0, 'cash', '2023-07-26 21:20:54', '2023-07-26 21:20:54'),
(75, 85, 700, 'cash', '2023-07-27 04:28:57', '2023-07-27 04:28:57'),
(76, 86, 1000, 'cash', '2023-07-27 04:28:57', '2023-07-27 04:28:57'),
(77, 87, 0, 'cash', '2023-07-27 05:23:28', '2023-07-27 05:23:28'),
(78, 88, 454000, 'cash', '2023-07-27 05:58:50', '2023-07-27 05:58:50'),
(79, 89, 2000, 'insurance', '2023-07-27 06:17:37', '2023-07-27 06:17:37'),
(80, 90, 1000, 'insurance', '2023-07-27 06:20:48', '2023-07-27 06:20:48'),
(81, 91, 1000, 'cash', '2023-07-27 07:10:27', '2023-07-27 07:10:27'),
(82, 92, 1200, 'cash', '2023-07-27 07:18:58', '2023-07-27 07:18:58'),
(83, 93, 2000, 'insurance', '2023-07-27 08:45:44', '2023-07-27 08:45:44'),
(84, 94, 2000, 'insurance', '2023-07-27 09:06:32', '2023-07-27 09:06:32'),
(85, 95, 400, 'insurance', '2023-07-27 09:08:15', '2023-07-27 09:08:15'),
(86, 96, 2000, 'insurance', '2023-07-27 09:23:27', '2023-07-27 09:23:27'),
(87, 97, 2000, 'insurance', '2023-07-27 09:23:27', '2023-07-27 09:23:27'),
(88, 98, 2000, 'insurance', '2023-07-27 09:23:27', '2023-07-27 09:23:27'),
(89, 100, 2000, 'insurance', '2023-07-27 09:59:53', '2023-07-27 09:59:53'),
(90, 102, 5000, 'credit', '2023-07-27 10:16:09', '2023-07-27 10:16:09'),
(91, 101, 5000, 'cash', '2023-07-27 10:16:11', '2023-07-27 10:16:11'),
(92, 99, 2000, 'insurance', '2023-07-27 10:16:32', '2023-07-27 10:16:32'),
(93, 103, 0, 'credit', '2023-07-27 10:29:04', '2023-07-27 10:29:04'),
(94, 104, 25000, 'cash', '2023-07-27 10:29:04', '2023-07-27 10:29:04'),
(95, 105, 7000, 'insurance', '2023-07-27 10:50:40', '2023-07-27 10:50:40'),
(96, 106, 15000, 'insurance', '2023-07-27 10:50:40', '2023-07-27 10:50:40'),
(97, 107, 2000, 'insurance', '2023-07-27 11:57:21', '2023-07-27 11:57:21'),
(98, 108, 7000, 'insurance', '2023-07-27 12:00:17', '2023-07-27 12:00:17'),
(99, 109, 15000, 'insurance', '2023-07-27 12:00:17', '2023-07-27 12:00:17'),
(100, 110, 0, 'insurance', '2023-07-27 12:33:00', '2023-07-27 12:33:00'),
(101, 112, 0, 'insurance', '2023-07-27 12:45:15', '2023-07-27 12:45:15'),
(102, 113, 40000, 'insurance', '2023-07-27 13:49:59', '2023-07-27 13:49:59'),
(103, 114, 3000, 'cash', '2023-07-27 14:00:04', '2023-07-27 14:00:04'),
(104, 115, 30000, 'insurance', '2023-07-27 14:51:35', '2023-07-27 14:51:35'),
(105, 116, 8500, 'insurance', '2023-07-27 21:10:04', '2023-07-27 21:10:04'),
(106, 117, 15000, 'insurance', '2023-07-27 21:29:59', '2023-07-27 21:29:59'),
(107, 118, 15000, 'insurance', '2023-07-27 21:33:20', '2023-07-27 21:33:20'),
(108, 119, 453000, 'cash', '2023-07-27 21:54:27', '2023-07-27 21:54:27'),
(109, 120, 1000, 'insurance', '2023-07-27 21:54:27', '2023-07-27 21:54:27'),
(110, 121, 453000, 'cash', '2023-07-28 09:03:00', '2023-07-28 09:03:00'),
(111, 122, 1000, 'insurance', '2023-07-28 09:03:00', '2023-07-28 09:03:00'),
(112, 123, 1200, 'cash', '2023-07-28 09:33:23', '2023-07-28 09:33:23'),
(113, 111, 43000, 'insurance', '2023-07-28 21:00:44', '2023-07-28 21:00:44'),
(114, 125, 5000, 'cash', '2023-08-14 11:02:14', '2023-08-14 11:02:14'),
(115, 128, 2000, 'insurance', '2023-08-17 22:13:44', '2023-08-17 22:13:44'),
(116, 129, 5000, 'insurance', '2023-08-17 22:31:55', '2023-08-17 22:31:55'),
(117, 130, 30400, 'insurance', '2023-08-17 22:39:00', '2023-08-17 22:39:00'),
(118, 131, 5000, 'insurance', '2023-08-17 22:54:24', '2023-08-17 22:54:24'),
(119, 132, 28000, 'insurance', '2023-08-17 23:02:37', '2023-08-17 23:02:37'),
(120, 133, 2000, 'insurance', '2023-08-19 07:42:23', '2023-08-19 07:42:23'),
(121, 134, 4500, 'insurance', '2023-08-19 08:08:33', '2023-08-19 08:08:33'),
(122, 135, 0, 'insurance', '2023-08-19 08:08:33', '2023-08-19 08:08:33'),
(123, 135, 4500, 'insurance', '2023-08-19 08:08:58', '2023-08-19 08:08:58'),
(124, 135, 15000, 'insurance', '2023-08-19 08:09:50', '2023-08-19 08:09:50'),
(125, 136, 1400, 'insurance', '2023-08-19 08:36:48', '2023-08-19 08:36:48'),
(126, 142, 5000, 'cash', '2023-08-21 06:23:11', '2023-08-21 06:23:11'),
(127, 146, 2000, 'insurance', '2023-08-21 21:04:20', '2023-08-21 21:04:20'),
(128, 147, 11900, 'insurance', '2023-08-21 21:16:53', '2023-08-21 21:16:53'),
(129, 148, 30000, 'insurance', '2023-08-21 21:16:53', '2023-08-21 21:16:53'),
(130, 149, 2000, 'insurance', '2023-08-22 09:03:45', '2023-08-22 09:03:45'),
(131, 150, 30000, 'insurance', '2023-08-22 09:11:39', '2023-08-22 09:11:39'),
(132, 125, 5000, 'cash', '2023-08-22 10:55:04', '2023-08-22 10:55:04'),
(133, 127, 0, 'cash', '2023-08-22 10:55:04', '2023-08-22 10:55:04'),
(134, 125, 5000, 'cash', '2023-08-22 20:57:56', '2023-08-22 20:57:56'),
(135, 127, 0, 'cash', '2023-08-22 20:57:56', '2023-08-22 20:57:56'),
(136, 125, 5000, 'cash', '2023-08-24 11:16:16', '2023-08-24 11:16:16'),
(137, 127, 0, 'cash', '2023-08-24 11:16:16', '2023-08-24 11:16:16'),
(138, 151, 0, 'insurance', '2023-08-24 11:16:16', '2023-08-24 11:16:16'),
(139, 125, 10000, 'cash', '2023-08-24 11:31:25', '2023-08-24 11:31:25'),
(140, 127, 1900, 'cash', '2023-08-24 11:31:25', '2023-08-24 11:31:25'),
(141, 151, 5000, 'insurance', '2023-08-24 11:31:25', '2023-08-24 11:31:25'),
(142, 152, 10000, 'cash', '2023-08-24 11:31:25', '2023-08-24 11:31:25'),
(143, 153, 13100, 'insurance', '2023-08-24 11:31:25', '2023-08-24 11:31:25'),
(144, 154, 2000, 'insurance', '2023-08-26 09:12:57', '2023-08-26 09:12:57'),
(145, 157, 2000, 'insurance', '2023-08-29 04:52:18', '2023-08-29 04:52:18'),
(146, 158, 10000, 'insurance', '2023-08-29 05:03:48', '2023-08-29 05:03:48'),
(147, 159, 15000, 'insurance', '2023-08-29 05:03:48', '2023-08-29 05:03:48'),
(148, 160, 5000, 'cash', '2023-08-29 05:36:25', '2023-08-29 05:36:25'),
(149, 161, 5000, 'cash', '2023-08-29 05:39:33', '2023-08-29 05:39:33'),
(150, 161, 5000, 'cash', '2023-08-29 05:40:10', '2023-08-29 05:40:10'),
(151, 143, 20000, 'cash', '2023-08-29 05:40:41', '2023-08-29 05:40:41'),
(152, 144, 35000, 'cash', '2023-08-29 05:40:41', '2023-08-29 05:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `bloodtypes`
--

CREATE TABLE `bloodtypes` (
  `bloodtype_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `bloodtype` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloodtypes`
--

INSERT INTO `bloodtypes` (`bloodtype_id`, `code`, `bloodtype`, `status`) VALUES
(1, 'GR', 'Le concentré de globules rouges', 1),
(2, 'PLQ', 'Le concentré standard des plaquettes', 1),
(3, 'PLM', 'Le plasma frais congelé', 1),
(4, 'SG', 'Le sang total', 1),
(5, 'ALB', 'L’albumine', 1);

-- --------------------------------------------------------

--
-- Table structure for table `childbirthoutcomes`
--

CREATE TABLE `childbirthoutcomes` (
  `childbirthoutcome_id` int(11) NOT NULL,
  `childbirth_id` int(11) NOT NULL,
  `outcome` varchar(200) NOT NULL,
  `apgar` varchar(1000) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `childbirths`
--

CREATE TABLE `childbirths` (
  `childbirth_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `qualification` int(11) NOT NULL,
  `risk` varchar(100) NOT NULL,
  `gesture` varchar(500) NOT NULL,
  `parity` varchar(500) NOT NULL,
  `childrenalive` int(11) NOT NULL,
  `abortions` int(11) NOT NULL,
  `diabetes` varchar(3) NOT NULL,
  `bloodpressure` varchar(3) NOT NULL,
  `birthatrisk` varchar(3) NOT NULL,
  `childbirthtype` varchar(100) NOT NULL,
  `abortion` varchar(3) NOT NULL,
  `malaria` varchar(3) NOT NULL,
  `anemia` varchar(3) NOT NULL,
  `motherdied` varchar(3) NOT NULL,
  `ptme` varchar(200) NOT NULL,
  `deliverydate` int(11) NOT NULL,
  `contraceptive` varchar(500) NOT NULL,
  `releasedate` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE `classifications` (
  `classification_id` int(11) NOT NULL,
  `classification` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`classification_id`, `classification`, `status`) VALUES
(1, 'Test name', 0),
(2, 'Parasitology', 1),
(3, 'Haematology', 1),
(4, 'Phlebotomy', 1),
(5, 'Serology', 1),
(6, 'Microbiology', 1),
(7, 'Clinical chemistry', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientcredits`
--

CREATE TABLE `clientcredits` (
  `clientcredit_id` int(11) NOT NULL,
  `creditclient_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientcredits`
--

INSERT INTO `clientcredits` (`clientcredit_id`, `creditclient_id`, `date`, `amount`, `status`) VALUES
(3, 2, 1684011600, 10000, 1),
(4, 3, 1684098000, 1000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinicreport`
--

CREATE TABLE `clinicreport` (
  `clinicreport_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `clinic_client_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinicreport`
--

INSERT INTO `clinicreport` (`clinicreport_id`, `service_id`, `clinic_client_id`, `details`, `admin_id`, `timestamp`, `status`) VALUES
(1, 1368, 1, '<p>I have given 32 pills and vaccinated her.&nbsp;</p>\r\n', 166, 1692302243, 1),
(2, 1366, 1, '<p>I have given 32 pills and vaccinated her.&nbsp;</p>\r\n', 166, 1692302243, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_clients`
--

CREATE TABLE `clinic_clients` (
  `clinic_cl_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `weight` varchar(125) DEFAULT NULL,
  `bloodgroup` varchar(125) DEFAULT NULL,
  `pregnancy_month` varchar(125) DEFAULT NULL,
  `partner_name` varchar(255) DEFAULT NULL,
  `partner_mobile` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` int(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_clients`
--

INSERT INTO `clinic_clients` (`clinic_cl_id`, `name`, `location`, `dob`, `phone`, `weight`, `bloodgroup`, `pregnancy_month`, `partner_name`, `partner_mobile`, `user_id`, `timestamp`, `status`) VALUES
(1, 'Test Pregnant Patient', 'Meko', NULL, '0755000000', '61', 'B+', '2', 'Test Husband', '0766000000', 166, 1692288878, 1),
(2, 'Test Clinic Patient', 'Igoma', '1991-08-08', '0700111111', '67', 'A+', 'February', 'Test Partner', '0788234567', 166, 1692301950, 1);

-- --------------------------------------------------------

--
-- Table structure for table `complications`
--

CREATE TABLE `complications` (
  `complication_id` int(11) NOT NULL,
  `complication` varchar(500) NOT NULL,
  `childbirth_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consumed`
--

CREATE TABLE `consumed` (
  `consumed_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consumeditems`
--

CREATE TABLE `consumeditems` (
  `consumeditem_id` int(11) NOT NULL,
  `consumed_id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditclients`
--

CREATE TABLE `creditclients` (
  `creditclient_id` int(11) NOT NULL,
  `clientname` varchar(255) NOT NULL,
  `location` varchar(511) DEFAULT NULL,
  `credittype` varchar(191) DEFAULT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `details` varchar(1023) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditclients`
--

INSERT INTO `creditclients` (`creditclient_id`, `clientname`, `location`, `credittype`, `contacts`, `email`, `details`, `type`, `status`) VALUES
(1, 'Mohr', '99165 Orval Square', 'Postpaid', '658-342-7042', 'your.email+fakedata99061@gmail.com', 'busy', 'organisation', '0'),
(2, 'LORETO GIRLS SECONDARY SCHOOL', 'NYAKATO', 'Postpaid', '000000', '', '', 'organisation', '1'),
(3, 'NYAKAHOJA SECONDARY SCHOOL', 'MWANZA', 'Postpaid', '0784131303', 'nyakahojaschool@gmail.com', '', 'organisation', '1'),
(4, 'Cocacola', 'Nyakato', 'Postpaid', '0734163864', 'info@cocacola.co.tz', 'Bottling company', 'organisation', '1'),
(5, 'ELCT-ELVD Head Office', 'ilemela', 'Postpaid', '07540575978', 'adriaerasm@ymail.com', 'Church', 'organisation', '1'),
(6, 'butimba', 'butimba', 'Postpaid', '0625175124', 'joram@lab.com', '', 'organisation', '1');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryevents`
--

CREATE TABLE `deliveryevents` (
  `deliveryevent_id` int(11) NOT NULL,
  `deliveryevent` varchar(500) NOT NULL,
  `childbirth_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`, `status`) VALUES
(1, 'ADMINISTRATION', 1),
(2, 'OPD', 1),
(3, 'IPD', 1),
(4, 'RCH', 0),
(5, 'Pharmacy', 0),
(6, 'Accounting', 0),
(7, 'Checkout', 0),
(8, 'Reception', 0),
(9, 'Laboratory', 0),
(10, 'CTC', 0),
(11, 'Theatre', 0),
(12, 'Head of Nurse', 0),
(13, 'Radiology', 1),
(14, 'laboratory', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_sections`
--

CREATE TABLE `department_sections` (
  `section_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_sections`
--

INSERT INTO `department_sections` (`section_id`, `department_id`, `section_name`, `status`) VALUES
(1, 1, 'ACCOUNTING', 1),
(2, 1, 'HUMAN RESOURCE', 1),
(3, 1, 'STORAGE AND INVENTORY', 1),
(4, 1, 'MANAGEMENT', 1),
(5, 3, 'THEATRE', 1),
(6, 3, 'WARD MANAGEMENT', 1),
(7, 3, 'LABOUR', 1),
(8, 2, 'TRIAGE', 1),
(9, 2, 'RECEPTION', 1),
(10, 2, 'PHARMACY', 1),
(11, 2, 'LABORATORY', 1),
(12, 2, 'MOTHER AND CHILD CARE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation`, `status`) VALUES
(1, 'DAF', 1),
(2, 'Doctor Gynecologist', 1),
(3, 'Driver', 1),
(4, 'Accounting', 1),
(5, 'Laboratory assistant.', 1),
(6, 'Nurse', 1),
(7, 'Block Nurse', 1),
(8, 'Nursing Head Nurse', 1),
(9, 'Nurse Emergency', 1),
(10, 'Hygienist', 1),
(11, 'Sentinel', 1),
(12, 'Anesthetist', 1),
(13, 'ORL', 1),
(14, 'Radiologist', 1),
(15, 'SIS', 1),
(16, 'cashier', 1),
(17, 'computer scientist', 1),
(18, 'Pediatrician', 1),
(19, 'Doctor Surgeon', 1),
(20, 'Doctor Neurologist', 1),
(21, 'Doctor Pediatrician', 1),
(22, 'Doctor Dematologist', 1),
(23, 'Doctor Cardiologist', 1),
(24, 'Electrician', 1),
(25, 'Logistician', 1),
(26, 'Laundry', 1),
(27, 'T Radiologist', 1),
(28, 'General manager', 1),
(29, 'Oxygen Production', 1),
(30, 'Chief Accountant', 1),
(31, 'Doctor Dentist', 1),
(32, 'Doctor Radiologist', 1),
(33, 'Head Nurse Emergency', 1),
(34, 'Sales Pharmacy Nurse', 1),
(35, 'midwife', 1),
(36, 'Ophthalmologist', 1),
(37, 'Chef Nursing', 1),
(38, 'Generalist', 1),
(39, 'Oncologist', 1),
(40, 'Checkout', 1),
(41, 'Head of cash', 1),
(42, 'nsengiyumva steven', 0),
(43, 'Anesthesiologist Resuscitator', 1),
(44, 'Radiologist Technician', 1),
(45, 'Neurologist', 1),
(46, 'Gastro-Enterologist', 1),
(47, 'Clinical Officer', 1),
(48, 'Receptionist', 1),
(49, 'Cachier', 0),
(50, 'Pharmacist', 1),
(51, 'Insurance Officer', 1),
(52, 'Patron', 1),
(53, 'Director', 1),
(54, 'Store Keeper', 1),
(55, 'Medical Officer Incharge', 1),
(56, 'Medical officer', 1),
(57, 'health record technician', 1),
(58, 'laboratory technician', 0),
(59, 'laboratory technologist', 1),
(60, 'matron', 1),
(61, 'Ass health recorder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discharged`
--

CREATE TABLE `discharged` (
  `discharged_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `dischargedate` int(200) NOT NULL,
  `treatment` varchar(200) DEFAULT NULL,
  `pregnant` varchar(4) DEFAULT NULL,
  `diagnosis` varchar(200) DEFAULT NULL,
  `remarks` varchar(500) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discharged`
--

INSERT INTO `discharged` (`discharged_id`, `admitted_id`, `dischargedate`, `treatment`, `pregnant`, `diagnosis`, `remarks`, `admin_id`, `timestamp`, `status`) VALUES
(1, 1, 1690146000, NULL, NULL, NULL, 'amepona', 165, 1690231852, 1),
(2, 4, 1690405200, NULL, NULL, NULL, 'anaendelea vizuri', 165, 1690434091, 1),
(3, 2, 1690405200, NULL, NULL, NULL, 'amepona', 166, 1690434261, 1),
(4, 3, 1690405200, NULL, NULL, NULL, 'zzzzz', 166, 1690465652, 1);

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `disease_id` int(11) NOT NULL,
  `codenumber` varchar(20) NOT NULL,
  `codename` varchar(1000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`disease_id`, `codenumber`, `codename`, `admin_id`, `timestamp`, `status`) VALUES
(1, 'A00.0', 'Cholera due to Vibrio cholerae 01, biovar cholerae', 9, 1626901200, 1),
(2, 'A00.1', 'Cholera due to Vibrio cholerae 01, biovar eltor', 9, 1626901200, 1),
(3, 'A00.9', 'Cholera, unspecified', 9, 1626901200, 1),
(4, 'A01.0', 'Typhoid fever', 9, 1626901200, 1),
(5, 'A01.1', 'Paratyphoid fever A', 9, 1626901200, 1),
(6, 'A01.2', 'Paratyphoid fever B', 9, 1626901200, 1),
(7, 'A01.3', 'Paratyphoid fever C', 9, 1626901200, 1),
(8, 'A01.4', 'Paratyphoid fever, unspecified', 9, 1626901200, 1),
(9, 'A02.0', 'Salmonella enteritis', 9, 1626901200, 1),
(10, 'A02.1', 'Salmonella sepsis', 9, 1626901200, 1),
(11, 'A02.2', 'Localized salmonella infections', 9, 1626901200, 1),
(12, 'A02.8', 'Other specified salmonella infections', 9, 1626901200, 1),
(13, 'A03.0', 'Shigellosis due to Shigella dysenteriae', 9, 1626901200, 1),
(14, 'A03.1', 'Shigellosis due to Shigella flexneri', 9, 1626901200, 1),
(15, 'A03.2', 'Shigellosis due to Shigella boydii', 9, 1626901200, 1),
(16, 'A03.3', 'Shigellosis due to Shigella sonnei', 9, 1626901200, 1),
(17, 'A03.8', 'Other shigellosis', 9, 1626901200, 1),
(18, 'A03.9', 'Shigellosis, unspecified', 9, 1626901200, 1),
(19, 'A04.0', 'Enteropathogenic Escherichia coli infection', 9, 1626901200, 1),
(20, 'A04.1', 'Enterotoxigenic Escherichia coli infection', 9, 1626901200, 1),
(21, 'A04.2', 'Enteroinvasive Escherichia coli infection', 9, 1626901200, 1),
(22, 'A04.3', 'Enterohaemorrhagic Escherichia coli infection', 9, 1626901200, 1),
(23, 'A04.4', 'Other intestinal Escherichia coli infections', 9, 1626901200, 1),
(24, 'A04.5', 'Campylobacter enteritis', 9, 1626901200, 1),
(25, 'A04.6', 'Enteritis due to Yersinia enterocolitica', 9, 1626901200, 1),
(26, 'A04.7', 'Enterocolitis due to Clostridium difficile', 9, 1626901200, 1),
(27, 'A04.8', 'Other specified bacterial intestinal infections', 9, 1626901200, 1),
(28, 'A04.9', 'Bacterial intestinal infection, unspecified', 9, 1626901200, 1),
(29, 'A05.0', 'Foodborne staphylococcal intoxication', 9, 1626901200, 1),
(30, 'A05.1', 'Botulism', 9, 1626901200, 1),
(31, 'A05.2', 'Foodborne Clostridium perfringens [Clostridium welchii] intoxication', 9, 1626901200, 1),
(32, 'A05.3', 'Foodborne Vibrio parahaemolyticus intoxication', 9, 1626901200, 1),
(33, 'A05.4', 'Foodborne Bacillus cereus intoxication', 9, 1626901200, 1),
(34, 'A05.8', 'Other specified bacterial foodborne intoxications', 9, 1626901200, 1),
(35, 'A05.9', 'Bacterial foodborne intoxication, unspecified', 9, 1626901200, 1),
(36, 'A06.0', 'Acute amoebic dysentery', 9, 1626901200, 1),
(37, 'A06.1', 'Chronic intestinal amoebiasis', 9, 1626901200, 1),
(38, 'A06.2', 'Amoebic nondysenteric colitis', 9, 1626901200, 1),
(39, 'A06.3', 'Amoeboma of intestine', 9, 1626901200, 1),
(40, 'A06.4', 'Amoebic liver abscess', 9, 1626901200, 1),
(41, 'A06.5', 'Amoebic lung abscess', 9, 1626901200, 1),
(42, 'A06.6', 'Amoebic brain abscess', 9, 1626901200, 1),
(43, 'A06.7', 'Cutaneous amoebiasis', 9, 1626901200, 1),
(44, 'A06.8', 'Amoebic infection of other sites', 9, 1626901200, 1),
(45, 'A06.9', 'Amoebiasis, unspecified', 9, 1626901200, 1),
(46, 'A07.0', 'Balantidiasis', 9, 1626901200, 1),
(47, 'A07.1', 'Giardiasis [lambliasis]', 9, 1626901200, 1),
(48, 'A07.2', 'Cryptosporidiosis', 9, 1626901200, 1),
(49, 'A07.3', 'Isosporiasis', 9, 1626901200, 1),
(50, 'A07.8', 'Other specified protozoal intestinal diseases', 9, 1626901200, 1),
(51, 'A07.9', 'Protozoal intestinal disease, unspecified', 9, 1626901200, 1),
(52, 'A08.0', 'Rotaviral enteritis', 9, 1626901200, 1),
(53, 'A08.1', 'Acute gastroenteropathy due to Norovirus', 9, 1626901200, 1),
(54, 'A08.2', 'Adenoviral enteritis', 9, 1626901200, 1),
(55, 'A08.3', 'Other viral enteritis', 9, 1626901200, 1),
(56, 'A08.4', 'Viral intestinal infection, unspecified', 9, 1626901200, 1),
(57, 'A08.5', 'Other specified intestinal infections', 9, 1626901200, 1),
(58, 'A09.0', 'Other and unspecified gastroenteritis and colitis of infectious origin', 9, 1626901200, 1),
(59, 'A09.9', 'Gastroenteritis and colitis of unspecified origin', 9, 1626901200, 1),
(60, 'A15.0', 'Tuberculosis of lung, confirmed by sputum microscopy with or without culture', 9, 1626901200, 1),
(61, 'A15.1', 'Tuberculosis of lung, confirmed by culture only', 9, 1626901200, 1),
(62, 'A15.2', 'Tuberculosis of lung, confirmed histologically', 9, 1626901200, 1),
(63, 'A15.3', 'Tuberculosis of lung, confirmed by unspecified means', 9, 1626901200, 1),
(64, 'A15.4', 'Tuberculosis of intrathoracic lymph nodes, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(65, 'A15.5', 'Tuberculosis of larynx, trachea and bronchus, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(66, 'A15.6', 'Tuberculous pleurisy, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(67, 'A15.7', 'Primary respiratory tuberculosis, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(68, 'A15.8', 'Other respiratory tuberculosis, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(69, 'A15.9', 'Respiratory tuberculosis unspecified, confirmed bacteriologically and histologically', 9, 1626901200, 1),
(70, 'A16.0', 'Tuberculosis of lung, bacteriologically and histologically negative', 9, 1626901200, 1),
(71, 'A16.1', 'Tuberculosis of lung, bacteriological and histological examination not done', 9, 1626901200, 1),
(72, 'A16.2', 'Tuberculosis of lung, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(73, 'A16.3', 'Tuberculosis of intrathoracic lymph nodes, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(74, 'A16.4', 'Tuberculosis of larynx, trachea and bronchus, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(75, 'A16.5', 'Tuberculous pleurisy, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(76, 'A16.7', 'Primary respiratory tuberculosis without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(77, 'A16.8', 'Other respiratory tuberculosis, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(78, 'A16.9', 'Respiratory tuberculosis unspecified, without mention of bacteriological or histological confirmation', 9, 1626901200, 1),
(79, 'A17.0', 'Tuberculous meningitis', 9, 1626901200, 1),
(80, 'A17.1', 'Meningeal tuberculoma', 9, 1626901200, 1),
(81, 'A17.8', 'Other tuberculosis of nervous system', 9, 1626901200, 1),
(82, 'A17.9', 'Tuberculosis of nervous system, unspecified', 9, 1626901200, 1),
(83, 'A18.0', 'Tuberculosis of bones and joints', 9, 1626901200, 1),
(84, 'A18.1', 'Tuberculosis of genitourinary system', 9, 1626901200, 1),
(85, 'A18.2', 'Tuberculous peripheral lymphadenopathy', 9, 1626901200, 1),
(86, 'A18.3', 'Tuberculosis of intestines, peritoneum and mesenteric glands', 9, 1626901200, 1),
(87, 'A18.4', 'Tuberculosis of skin and subcutaneous tissue', 9, 1626901200, 1),
(88, 'A18.5', 'Tuberculosis of eye', 9, 1626901200, 1),
(89, 'A18.6', 'Tuberculosis of ear', 9, 1626901200, 1),
(90, 'A18.7', 'Tuberculosis of adrenal glands', 9, 1626901200, 1),
(91, 'A18.8', 'Tuberculosis of other specified organs', 9, 1626901200, 1),
(92, 'A19.0', 'Acute miliary tuberculosis of a single specified site', 9, 1626987600, 1),
(93, 'A19.1', 'Acute miliary tuberculosis of multiple sites', 9, 1626987600, 1),
(94, 'A19.2', 'Acute miliary tuberculosis, unspecified', 9, 1626987600, 1),
(95, 'A19.8', 'Other miliary tuberculosis', 9, 1626987600, 1),
(96, 'A19.9', 'Miliary tuberculosis, unspecified', 9, 1626987600, 1),
(97, 'A20.0', 'Bubonic plague', 9, 1626987600, 1),
(98, 'A20.1', 'Cellulocutaneous plague', 9, 1626987600, 1),
(99, 'A20.2', 'Pneumonic plague', 9, 1626987600, 1),
(100, 'A20.3', 'Plague meningitis', 9, 1626987600, 1),
(101, 'A20.7', 'Septicaemic plague', 9, 1626987600, 1),
(102, 'A20.8', 'Other forms of plague', 9, 1626987600, 1),
(103, 'A20.9', 'Plague, unspecified', 9, 1626987600, 1),
(104, 'A21.0', 'Ulceroglandular tularaemia', 9, 1626987600, 1),
(105, 'A21.1', 'Oculoglandular tularaemia', 9, 1626987600, 1),
(106, 'A21.2', 'Pulmonary tularaemia', 9, 1626987600, 1),
(107, 'A21.3', 'Gastrointestinal tularaemia', 9, 1626987600, 1),
(108, 'A21.7', 'Generalized tularaemia', 9, 1626987600, 1),
(109, 'A21.8', 'Other forms of tularaemia', 9, 1626987600, 1),
(110, 'A21.9', 'Tularaemia, unspecified', 9, 1626987600, 1),
(111, 'A22.0', 'Cutaneous anthrax', 9, 1626987600, 1),
(112, 'A22.1', 'Pulmonary anthrax', 9, 1626987600, 1),
(113, 'A22.2', 'Gastrointestinal anthrax', 9, 1626987600, 1),
(114, 'A22.7', 'Anthrax sepsis', 9, 1626987600, 1),
(115, 'A22.8', 'Other forms of anthrax', 9, 1626987600, 1),
(116, 'A22.9', 'Anthrax, unspecified', 9, 1626987600, 1),
(117, 'A23.0', 'Brucellosis due to Brucella melitensis', 9, 1626987600, 1),
(118, 'A23.1', 'Brucellosis due to Brucella abortus', 9, 1626987600, 1),
(119, 'A23.2', 'Brucellosis due to Brucella suis', 9, 1626987600, 1),
(120, 'A23.3', 'Brucellosis due to Brucella canis', 9, 1626987600, 1),
(121, 'A23.8', 'Other brucellosis', 9, 1626987600, 1),
(122, 'A23.9', 'Brucellosis, unspecified', 9, 1626987600, 1),
(123, 'A24.0', 'Glanders', 9, 1626987600, 1),
(124, 'A24.1', 'Acute and fulminating melioidosis', 9, 1626987600, 1),
(125, 'A24.2', 'Subacute and chronic melioidosis', 9, 1626987600, 1),
(126, 'A24.3', 'Other melioidosis', 9, 1626987600, 1),
(127, 'A24.4', 'Melioidosis, unspecified', 9, 1626987600, 1),
(128, 'A25.0', 'Spirillosis', 9, 1626987600, 1),
(129, 'A25.1', 'Streptobacillosis', 9, 1626987600, 1),
(130, 'A25.9', 'Rat-bite fever, unspecified', 9, 1626987600, 1),
(131, 'A26.0', 'Cutaneous erysipeloid', 9, 1626987600, 1),
(132, 'A26.7', 'Erysipelothrix sepsis', 9, 1626987600, 1),
(133, 'A26.8', 'Other forms of erysipeloid', 9, 1626987600, 1),
(134, 'A26.9', 'Erysipeloid, unspecified', 9, 1626987600, 1),
(135, 'A27.0', 'Leptospirosis icterohaemorrhagica', 9, 1626987600, 1),
(136, 'A27.8', 'Other forms of leptospirosis', 9, 1626987600, 1),
(137, 'A27.9', 'Leptospirosis, unspecified', 9, 1626987600, 1),
(138, 'A28.0', 'Pasteurellosis', 9, 1626987600, 1),
(139, 'A28.1', 'Cat-scratch disease', 9, 1626987600, 1),
(140, 'A28.2', 'Extraintestinal yersiniosis', 9, 1626987600, 1),
(141, 'A28.8', 'Other specified zoonotic bacterial diseases, not elsewhere classified', 9, 1626987600, 1),
(142, 'A28.9', 'Zoonotic bacterial disease, unspecified', 9, 1626987600, 1),
(143, 'A30.0', 'Indeterminate leprosy', 9, 1626987600, 1),
(144, 'A30.1', 'Tuberculoid leprosy', 9, 1626987600, 1),
(145, 'A30.2', 'Borderline tuberculoid leprosy', 9, 1626987600, 1),
(146, 'A30.3', 'Borderline leprosy', 9, 1626987600, 1),
(147, 'A30.4', 'Borderline lepromatous leprosy', 9, 1626987600, 1),
(148, 'A30.5', 'Lepromatous leprosy', 9, 1626987600, 1),
(149, 'A30.8', 'Other forms of leprosy', 9, 1626987600, 1),
(150, 'A30.9', 'Leprosy, unspecified', 9, 1626987600, 1),
(151, 'A31.0', 'Pulmonary mycobacterial infection', 9, 1626987600, 1),
(152, 'A31.1', 'Cutaneous mycobacterial infection', 9, 1626987600, 1),
(153, 'A31.8', 'Other mycobacterial infections', 9, 1626987600, 1),
(154, 'A31.9', 'Mycobacterial infection, unspecified', 9, 1626987600, 1),
(155, 'A32.0', 'Cutaneous listeriosis', 9, 1626987600, 1),
(156, 'A32.1', 'Listerial meningitis and meningoencephalitis', 9, 1626987600, 1),
(157, 'A32.7', 'Listerial sepsis', 9, 1626987600, 1),
(158, 'A32.8', 'Other forms of listeriosis', 9, 1626987600, 1),
(159, 'A32.9', 'Listeriosis, unspecified', 9, 1626987600, 1),
(160, 'A33', 'Tetanus neonatorum', 9, 1626987600, 1),
(161, 'A34', 'Obstetrical tetanus', 9, 1626987600, 1),
(162, 'A35', 'Other tetanus', 9, 1626987600, 1),
(163, 'A36.0', 'Pharyngeal diphtheria', 9, 1626987600, 1),
(164, 'A36.1', 'Nasopharyngeal diphtheria', 9, 1626987600, 1),
(165, 'A36.2', 'Laryngeal diphtheria', 9, 1626987600, 1),
(166, 'A36.3', 'Cutaneous diphtheria', 9, 1626987600, 1),
(167, 'A36.8', 'Other diphtheria', 9, 1626987600, 1),
(168, 'A36.9', 'Diphtheria, unspecified', 9, 1626987600, 1),
(169, 'A37.0', 'Whooping cough due to Bordetella pertussis', 9, 1626987600, 1),
(170, 'A37.1', 'Whooping cough due to Bordetella parapertussis', 9, 1626987600, 1),
(171, 'A37.8', 'Whooping cough due to other Bordetella species', 9, 1626987600, 1),
(172, 'A37.9', 'Whooping cough, unspecified', 9, 1626987600, 1),
(173, 'A38', 'Scarlet fever', 9, 1626987600, 1),
(174, 'A39.0', 'Meningococcal meningitis', 9, 1626987600, 1),
(175, 'A39.1', 'Waterhouse-Friderichsen syndrome', 9, 1626987600, 1),
(176, 'A39.2', 'Acute meningococcaemia', 9, 1626987600, 1),
(177, 'A39.3', 'Chronic meningococcaemia', 9, 1626987600, 1),
(178, 'A39.4', 'Meningococcaemia, unspecified', 9, 1626987600, 1),
(179, 'A39.5', 'Meningococcal heart disease', 9, 1626987600, 1),
(180, 'A39.8', 'Other meningococcal infections', 9, 1626987600, 1),
(181, 'A39.9', 'Meningococcal infection, unspecified', 9, 1626987600, 1),
(182, 'A40.0', 'Sepsis due to streptococcus, group A', 9, 1626987600, 1),
(183, 'A40.1', 'Sepsis due to streptococcus, group B', 9, 1626987600, 1),
(184, 'A40.2', 'Sepsis due to streptococcus, group D and enterococcus', 9, 1626987600, 1),
(185, 'A40.3', 'Sepsis due to Streptococcus pneumoniae', 9, 1626987600, 1),
(186, 'A40.8', 'Other streptococcal sepsis', 9, 1626987600, 1),
(187, 'A40.9', 'Streptococcal sepsis, unspecified', 9, 1626987600, 1),
(188, 'A41.0', 'Sepsis due to Staphylococcus aureus', 9, 1626987600, 1),
(189, 'A41.1', 'Sepsis due to other specified staphylococcus', 9, 1626987600, 1),
(190, 'A41.2', 'Sepsis due to unspecified staphylococcus', 9, 1626987600, 1),
(191, 'A41.3', 'Sepsis due to Haemophilus influenzae', 9, 1626987600, 1),
(192, 'A41.4', 'Sepsis due to anaerobes', 9, 1626987600, 1),
(193, 'A41.5', 'Sepsis due to other Gram-negative organisms', 9, 1626987600, 1),
(194, 'A41.8', 'Other specified sepsis', 9, 1626987600, 1),
(195, 'A41.9', 'Sepsis, unspecified', 9, 1626987600, 1),
(196, 'A42.0', 'Pulmonary actinomycosis', 9, 1626987600, 1),
(197, 'A42.1', 'Abdominal actinomycosis', 9, 1626987600, 1),
(198, 'A42.2', 'Cervicofacial actinomycosis', 9, 1626987600, 1),
(199, 'A42.7', 'Actinomycotic sepsis', 9, 1626987600, 1),
(200, 'A42.8', 'Other forms of actinomycosis', 9, 1626987600, 1),
(201, 'A42.9', 'Actinomycosis, unspecified', 9, 1626987600, 1),
(202, 'A43.0', 'Pulmonary nocardiosis', 9, 1626987600, 1),
(203, 'A43.1', 'Cutaneous nocardiosis', 9, 1626987600, 1),
(204, 'A43.8', 'Other forms of nocardiosis', 9, 1626987600, 1),
(205, 'A43.9', 'Nocardiosis, unspecified', 9, 1626987600, 1),
(206, 'A44.0', 'Systemic bartonellosis', 9, 1626987600, 1),
(207, 'A44.1', 'Cutaneous and mucocutaneous bartonellosis', 9, 1626987600, 1),
(208, 'A44.8', 'Other forms of bartonellosis', 9, 1626987600, 1),
(209, 'A44.9', 'Bartonellosis, unspecified', 9, 1626987600, 1),
(210, 'A46', 'Erysipelas', 9, 1626987600, 1),
(211, 'A48.0', 'Gas gangrene', 9, 1626987600, 1),
(212, 'A48.1', 'Legionnaires disease', 9, 1626987600, 1),
(213, 'A48.2', 'Nonpneumonic Legionnaires disease [Pontiac fever]', 9, 1626987600, 1),
(214, 'A48.3', 'Toxic shock syndrome', 9, 1626987600, 1),
(215, 'A48.4', 'Brazilian purpuric fever', 9, 1626987600, 1),
(216, 'A49.0', 'Staphylococcal infection, unspecified site', 9, 1626987600, 1),
(217, 'A49.1', 'Streptococcal and enterococcal infection, unspecified site', 9, 1626987600, 1),
(218, 'A49.2', 'Haemophilus influenzae infection, unspecified site', 9, 1626987600, 1),
(219, 'A49.3', 'Mycoplasma infection, unspecified site', 9, 1626987600, 1),
(220, 'A49.8', 'Other bacterial infections of unspecified site', 9, 1626987600, 1),
(221, 'A49.9', 'Bacterial infection, unspecified', 9, 1626987600, 1),
(222, 'A50.0', 'Early congenital syphilis, symptomatic', 9, 1626987600, 1),
(223, 'A50.1', 'Early congenital syphilis, latent', 9, 1626987600, 1),
(224, 'A50.2', 'Early congenital syphilis, unspecified', 9, 1626987600, 1),
(225, 'A50.3', 'Late congenital syphilitic oculopathy', 9, 1626987600, 1),
(226, 'A50.4', 'Late congenital neurosyphilis [juvenile neurosyphilis]', 9, 1626987600, 1),
(227, 'A50.5', 'Other late congenital syphilis, symptomatic', 9, 1626987600, 1),
(228, 'A50.6', 'Late congenital syphilis, latent', 9, 1626987600, 1),
(229, 'A50.7', 'Late congenital syphilis, unspecified', 9, 1626987600, 1),
(230, 'A50.9', 'Congenital syphilis, unspecified', 9, 1626987600, 1),
(231, 'A51.0', 'Primary genital syphilis', 9, 1626987600, 1),
(232, 'A51.1', 'Primary anal syphilis', 9, 1626987600, 1),
(233, 'A51.2', 'Primary syphilis of other sites', 9, 1626987600, 1),
(234, 'A51.3', 'Secondary syphilis of skin and mucous membranes', 9, 1626987600, 1),
(235, 'A51.4', 'Other secondary syphilis', 9, 1626987600, 1),
(236, 'A51.5', 'Early syphilis, latent', 9, 1626987600, 1),
(237, 'A51.9', 'Early syphilis, unspecified', 9, 1626987600, 1),
(238, 'A52.0', 'Cardiovascular syphilis', 9, 1626987600, 1),
(239, 'A52.1', 'Symptomatic neurosyphilis', 9, 1626987600, 1),
(240, 'A52.2', 'Asymptomatic neurosyphilis', 9, 1626987600, 1),
(241, 'A52.3', 'Neurosyphilis, unspecified', 9, 1626987600, 1),
(242, 'A52.7', 'Other symptomatic late syphilis', 9, 1626987600, 1),
(243, 'A52.8', 'Late syphilis, latent', 9, 1626987600, 1),
(244, 'A52.9', 'Late syphilis, unspecified', 9, 1626987600, 1),
(245, 'A53.0', 'Latent syphilis, unspecified as early or late', 9, 1626987600, 1),
(246, 'A53.9', 'Syphilis, unspecified', 9, 1626987600, 1),
(247, 'A54.0', 'Gonococcal infection of lower genitourinary tract without periurethral or accessory gland abscess', 9, 1626987600, 1),
(248, 'A54.1', 'Gonococcal infection of lower genitourinary tract with periurethral and accessory gland abscess', 9, 1626987600, 1),
(249, 'A54.2', 'Gonococcal pelviperitonitis and other gonococcal genitourinary infections', 9, 1626987600, 1),
(250, 'A54.3', 'Gonococcal infection of eye', 9, 1626987600, 1),
(251, 'A54.4', 'Gonococcal infection of musculoskeletal system', 9, 1626987600, 1),
(252, 'A54.5', 'Gonococcal pharyngitis', 9, 1626987600, 1),
(253, 'A54.6', 'Gonococcal infection of anus and rectum', 9, 1626987600, 1),
(254, 'A54.8', 'Other gonococcal infections', 9, 1626987600, 1),
(255, 'A54.9', 'Gonococcal infection, unspecified', 9, 1626987600, 1),
(256, 'A55', 'Chlamydial lymphogranuloma (venereum)', 9, 1626987600, 1),
(257, 'A56.0', 'Chlamydial infection of lower genitourinary tract', 9, 1626987600, 1),
(258, 'A56.1', 'Chlamydial infection of pelviperitoneum and other genitourinary organs', 9, 1626987600, 1),
(259, 'A56.2', 'Chlamydial infection of genitourinary tract, unspecified', 9, 1626987600, 1),
(260, 'A56.3', 'Chlamydial infection of anus and rectum', 9, 1626987600, 1),
(261, 'A56.4', 'Chlamydial infection of pharynx', 9, 1626987600, 1),
(262, 'A56.8', 'Sexually transmitted chlamydial infection of other sites', 9, 1626987600, 1),
(263, 'A57', 'Chancroid', 9, 1626987600, 1),
(264, 'A58', 'Granuloma inguinale', 9, 1626987600, 1),
(275, 'A65', 'Nonvenereal syphilis', 9, 1626987600, 1),
(266, 'A59.0', 'Urogenital trichomoniasis', 9, 1626987600, 1),
(267, 'A59.8', 'Trichomoniasis of other sites', 9, 1626987600, 1),
(268, 'A59.9', 'Trichomoniasis, unspecified', 9, 1626987600, 1),
(269, 'A60.0', 'Herpesviral infection of genitalia and urogenital tract', 9, 1626987600, 1),
(270, 'A60.1', 'Herpesviral infection of perianal skin and rectum', 9, 1626987600, 1),
(271, 'A60.9', 'Anogenital herpesviral infection, unspecified', 9, 1626987600, 1),
(272, 'A63.0', 'Anogenital (venereal) warts', 9, 1626987600, 1),
(273, 'A63.8', 'Other specified predominantly sexually transmitted diseases', 9, 1626987600, 1),
(274, 'A64', 'Unspecified sexually transmitted disease', 9, 1626987600, 1),
(276, 'A66.0', 'Initial lesions of yaws', 9, 1626987600, 1),
(277, 'A66.1', 'Multiple papillomata and wet crab yaws', 9, 1626987600, 1),
(278, 'A66.2', 'Other early skin lesions of yaws', 9, 1626987600, 1),
(279, 'A66.3', 'Hyperkeratosis of yaws', 9, 1626987600, 1),
(280, 'A66.4', 'Gummata and ulcers of yaws', 9, 1626987600, 1),
(281, 'A66.5', 'Gangosa', 9, 1626987600, 1),
(282, 'A66.6', 'Bone and joint lesions of yaws', 9, 1626987600, 1),
(283, 'A66.7', 'Other manifestations of yaws', 9, 1626987600, 1),
(284, 'A66.8', 'Latent yaws', 9, 1626987600, 1),
(285, 'A66.9', 'Yaws, unspecified', 9, 1626987600, 1),
(286, 'A67.0', 'Primary lesions of pinta', 9, 1626987600, 1),
(287, 'A67.1', 'Intermediate lesions of pinta', 9, 1626987600, 1),
(288, 'A67.2', 'Late lesions of pinta', 9, 1626987600, 1),
(289, 'A67.3', 'Mixed lesions of pinta', 9, 1626987600, 1),
(290, 'A67.9', 'Pinta, unspecified', 9, 1626987600, 1),
(291, 'A68.0', 'Louse-borne relapsing fever', 9, 1626987600, 1),
(292, 'A68.1', 'Tick-borne relapsing fever', 9, 1626987600, 1),
(293, 'A68.9', 'Relapsing fever, unspecified', 9, 1626987600, 1),
(294, 'A69.0', 'Necrotizing ulcerative stomatitis', 9, 1626987600, 1),
(295, 'A69.1', 'Other Vincent infections', 9, 1626987600, 1),
(296, 'A69.2', 'Lyme disease', 9, 1626987600, 1),
(297, 'A69.8', 'Other specified spirochaetal infections', 9, 1626987600, 1),
(298, 'A69.9', 'Spirochaetal infection, unspecified', 9, 1626987600, 1),
(299, 'A70', 'Chlamydia psittaci infection', 9, 1626987600, 1),
(300, 'A71.0', 'Initial stage of trachoma', 9, 1626987600, 1),
(301, 'A71.1', 'Active stage of trachoma', 9, 1626987600, 1),
(302, 'A71.9', 'Trachoma, unspecified', 9, 1626987600, 1),
(303, 'A74.0', 'Chlamydial conjunctivitis', 9, 1626987600, 1),
(304, 'A74.8', 'Other chlamydial diseases', 9, 1626987600, 1),
(305, 'A74.9', 'Chlamydial infection, unspecified', 9, 1626987600, 1),
(306, 'A75.0', 'Epidemic louse-borne typhus fever due to Rickettsia prowazekii', 9, 1626987600, 1),
(307, 'A75.1', 'Recrudescent typhus [Brill disease]', 9, 1626987600, 1),
(308, 'A75.2', 'Typhus fever due to Rickettsia typhi', 9, 1626987600, 1),
(309, 'A75.3', 'Typhus fever due to Rickettsia tsutsugamushi', 9, 1626987600, 1),
(310, 'A75.9', 'Typhus fever, unspecified', 9, 1626987600, 1),
(311, 'A77.0', 'Spotted fever due to Rickettsia rickettsii', 9, 1626987600, 1),
(312, 'A77.1', 'Spotted fever due to Rickettsia conorii', 9, 1626987600, 1),
(313, 'A77.2', 'Spotted fever due to Rickettsia sibirica', 9, 1626987600, 1),
(314, 'A77.3', 'Spotted fever due to Rickettsia australis', 9, 1626987600, 1),
(315, 'A77.8', 'Other spotted fevers', 9, 1626987600, 1),
(316, 'A77.9', 'Spotted fever, unspecified', 9, 1626987600, 1),
(317, 'A78', 'Q fever', 9, 1626987600, 1),
(318, 'A79.0', 'Trench fever', 9, 1626987600, 1),
(319, 'A79.1', 'Rickettsialpox due to Rickettsia akari', 9, 1626987600, 1),
(320, 'A79.8', 'Other specified rickettsioses', 9, 1626987600, 1),
(321, 'A79.9', 'Rickettsiosis, unspecified', 9, 1626987600, 1),
(322, 'A80.0', 'Acute paralytic poliomyelitis, vaccine-associated', 9, 1626987600, 1),
(323, 'A80.1', 'Acute paralytic poliomyelitis, wild virus, imported', 9, 1626987600, 1),
(324, 'A80.2', 'Acute paralytic poliomyelitis, wild virus, indigenous', 9, 1626987600, 1),
(325, 'A80.3', 'Acute paralytic poliomyelitis, other and unspecified', 9, 1626987600, 1),
(326, 'A80.4', 'Acute nonparalytic poliomyelitis', 9, 1626987600, 1),
(327, 'A80.9', 'Acute poliomyelitis, unspecified', 9, 1626987600, 1),
(328, 'A81.0', 'Creutzfeldt-Jakob disease', 9, 1626987600, 1),
(329, 'A81.1', 'Subacute sclerosing panencephalitis', 9, 1626987600, 1),
(330, 'A81.2', 'Progressive multifocal leukoencephalopathy', 9, 1626987600, 1),
(331, 'A81.8', 'Other atypical virus infections of central nervous system', 9, 1626987600, 1),
(332, 'A81.9', 'Atypical virus infection of central nervous system, unspecified', 9, 1626987600, 1),
(333, 'A82.0', 'Sylvatic rabies', 9, 1626987600, 1),
(334, 'A82.1', 'Urban rabies', 9, 1626987600, 1),
(335, 'A82.9', 'Rabies, unspecified', 9, 1626987600, 1),
(336, 'A83.0', 'Japanese encephalitis', 9, 1626987600, 1),
(337, 'A83.1', 'Western equine encephalitis', 9, 1626987600, 1),
(338, 'A83.2', 'Eastern equine encephalitis', 9, 1626987600, 1),
(339, 'A83.3', 'St Louis encephalitis', 9, 1626987600, 1),
(340, 'A83.4', 'Australian encephalitis', 9, 1626987600, 1),
(341, 'A83.5', 'California encephalitis', 9, 1626987600, 1),
(342, 'A83.6', 'Rocio virus disease', 9, 1626987600, 1),
(343, 'A83.8', 'Other mosquito-borne viral encephalitis', 9, 1626987600, 1),
(344, 'A83.9', 'Mosquito-borne viral encephalitis, unspecified', 9, 1626987600, 1),
(345, 'A84.0', 'Far Eastern tick-borne encephalitis [Russian spring-summer encephalitis]', 9, 1626987600, 1),
(346, 'A84.1', 'Central European tick-borne encephalitis', 9, 1626987600, 1),
(347, 'A84.8', 'Other tick-borne viral encephalitis', 9, 1626987600, 1),
(348, 'A84.9', 'Tick-borne viral encephalitis, unspecified', 9, 1626987600, 1),
(349, 'A85.0', 'Enteroviral encephalitis', 9, 1626987600, 1),
(350, 'A85.1', 'Adenoviral encephalitis', 9, 1626987600, 1),
(351, 'A85.2', 'Arthropod-borne viral encephalitis, unspecified', 9, 1626987600, 1),
(352, 'A85.8', 'Other specified viral encephalitis', 9, 1626987600, 1),
(353, 'A86', 'Unspecified viral encephalitis', 9, 1626987600, 1),
(354, 'A87.0', 'Enteroviral meningitis', 9, 1626987600, 1),
(355, 'A87.1', 'Adenoviral meningitis', 9, 1626987600, 1),
(356, 'A87.2', 'Lymphocytic choriomeningitis', 9, 1626987600, 1),
(357, 'A87.8', 'Other viral meningitis', 9, 1626987600, 1),
(358, 'A87.9', 'Viral meningitis, unspecified', 9, 1626987600, 1),
(359, 'A88.0', 'Enteroviral exanthematous fever [Boston exanthem]', 9, 1626987600, 1),
(360, 'A88.1', 'Epidemic vertigo', 9, 1626987600, 1),
(361, 'A88.8', 'Other specified viral infections of central nervous system', 9, 1626987600, 1),
(362, 'A89', 'Unspecified viral infection of central nervous system', 9, 1626987600, 1),
(363, 'A92.0', 'Chikungunya virus disease', 9, 1626987600, 1),
(364, 'A92.1', 'O\'nyong-nyong fever', 9, 1626987600, 1),
(365, 'A92.2', 'Venezuelan equine fever', 9, 1626987600, 1),
(366, 'A92.3', 'West Nile virus infection', 9, 1626987600, 1),
(367, 'A92.4', 'Rift Valley fever', 9, 1626987600, 1),
(368, 'A92.5', 'Zika virus disease', 9, 1626987600, 1),
(369, 'A92.8', 'Other specified mosquito-borne viral fevers', 9, 1626987600, 1),
(370, 'A92.9', 'Mosquito-borne viral fever, unspecified', 9, 1626987600, 1),
(371, 'A93.0', 'Oropouche virus disease', 9, 1626987600, 1),
(372, 'A93.1', 'Sandfly fever', 9, 1626987600, 1),
(373, 'A93.2', 'Colorado tick fever', 9, 1626987600, 1),
(374, 'A93.8', 'Other specified arthropod-borne viral fevers', 9, 1626987600, 1),
(375, 'A94', 'Unspecified arthropod-borne viral fever', 9, 1626987600, 1),
(376, 'A95.0', 'Sylvatic yellow fever', 9, 1626987600, 1),
(377, 'A95.1', 'Urban yellow fever', 9, 1626987600, 1),
(378, 'A95.9', 'Yellow fever, unspecified', 9, 1626987600, 1),
(379, 'A96.0', 'Junin haemorrhagic fever', 9, 1626987600, 1),
(380, 'A96.1', 'Machupo haemorrhagic fever', 9, 1626987600, 1),
(381, 'A96.2', 'Lassa fever', 9, 1626987600, 1),
(382, 'A96.8', 'Other arenaviral haemorrhagic fevers', 9, 1626987600, 1),
(383, 'A96.9', 'Arenaviral haemorrhagic fever, unspecified', 9, 1626987600, 1),
(384, 'A97.0', 'Dengue without warning signs', 9, 1626987600, 1),
(385, 'A97.1', 'Dengue with warning signs', 9, 1626987600, 1),
(386, 'A97.9', 'Dengue, unspecified', 9, 1626987600, 1),
(387, 'A98.0', 'Crimean-Congo haemorrhagic fever', 9, 1626987600, 1),
(388, 'A98.1', 'Omsk haemorrhagic fever', 9, 1626987600, 1),
(389, 'A98.2', 'Kyasanur Forest disease', 9, 1626987600, 1),
(390, 'A98.3', 'Marburg virus disease', 9, 1626987600, 1),
(391, 'A98.4', 'Ebola virus disease', 9, 1626987600, 1),
(392, 'A98.5', 'Haemorrhagic fever with renal syndrome', 9, 1626987600, 1),
(393, 'A98.8', 'Other specified viral haemorrhagic fevers', 9, 1626987600, 1),
(394, 'A99', 'Unspecified viral haemorrhagic fever', 9, 1626987600, 1),
(395, 'B00.0', 'Eczema herpeticum', 9, 1627074000, 1),
(396, 'B00.1', 'Herpesviral vesicular dermatitis', 9, 1627074000, 1),
(397, 'B00.2', 'Herpesviral gingivostomatitis and pharyngotonsillitis', 9, 1627074000, 1),
(398, 'B00.3', 'Herpesviral meningitis', 9, 1627074000, 1),
(399, 'B00.4', 'Herpesviral encephalitis', 9, 1627074000, 1),
(400, 'B00.5', 'Herpesviral ocular disease', 9, 1627074000, 1),
(401, 'B00.7', 'Disseminated herpesviral disease', 9, 1627074000, 1),
(402, 'B00.8', 'Other forms of herpesviral infection', 9, 1627074000, 1),
(403, 'B00.9', 'Herpesviral infection, unspecified', 9, 1627074000, 1),
(404, 'B01.0', 'Varicella meningitis', 9, 1627074000, 1),
(405, 'B01.1', 'Varicella encephalitis', 9, 1627074000, 1),
(406, 'B01.2', 'Varicella pneumonia', 9, 1627074000, 1),
(407, 'B01.8', 'Varicella with other complications', 9, 1627074000, 1),
(408, 'B01.9', 'Varicella without complication', 9, 1627074000, 1),
(409, 'B02.0', 'Zoster encephalitis', 9, 1627074000, 1),
(410, 'B02.1', 'Zoster meningitis', 9, 1627074000, 1),
(411, 'B02.2', 'Zoster with other nervous system involvement', 9, 1627074000, 1),
(412, 'B02.3', 'Zoster ocular disease', 9, 1627074000, 1),
(413, 'B02.7', 'Disseminated zoster', 9, 1627074000, 1),
(414, 'B02.8', 'Zoster with other complications', 9, 1627074000, 1),
(415, 'B02.9', 'Zoster without complication', 9, 1627074000, 1),
(416, 'B03', 'Smallpox', 9, 1627074000, 1),
(417, 'B04', 'Monkeypox', 9, 1627074000, 1),
(418, 'B05.0', 'Measles complicated by encephalitis', 9, 1627074000, 1),
(419, 'B05.1', 'Measles complicated by meningitis', 9, 1627074000, 1),
(420, 'B05.3', 'Measles complicated by otitis media', 9, 1627074000, 1),
(421, 'B05.4', 'Measles with intestinal complications', 9, 1627074000, 1),
(422, 'B05.8', 'Measles with other complications', 9, 1627074000, 1),
(423, 'B05.9', 'Measles without complication', 9, 1627074000, 1),
(424, 'B06.0', 'Rubella with neurological complications', 9, 1627074000, 1),
(425, 'B06.8', 'Rubella with other complications', 9, 1627074000, 1),
(426, 'B06.9', 'Rubella without complication', 9, 1627074000, 1),
(427, 'B07', 'Viral warts', 9, 1627074000, 1),
(428, 'B08.0', 'Other orthopoxvirus infections', 9, 1627074000, 1),
(429, 'B08.1', 'Molluscum contagiosum', 9, 1627074000, 1),
(430, 'B08.2', 'Exanthema subitum [sixth disease]', 9, 1627074000, 1),
(431, 'B08.3', 'Erythema infectiosum [fifth disease]', 9, 1627074000, 1),
(432, 'B08.4', 'Enteroviral vesicular stomatitis with exanthem', 9, 1627074000, 1),
(433, 'B08.5', 'Enteroviral vesicular pharyngitis', 9, 1627074000, 1),
(434, 'B08.8', 'Other specified viral infections characterized by skin and mucous membrane lesions', 9, 1627074000, 1),
(435, 'B09', 'Unspecified viral infection characterized by skin and mucous membrane lesions', 9, 1627074000, 1),
(436, 'B15.0', 'Hepatitis A with hepatic coma', 9, 1627074000, 1),
(437, 'B15.9', 'Hepatitis A without hepatic coma', 9, 1627074000, 1),
(438, 'B16.0', 'Acute hepatitis B with delta-agent (coinfection) with hepatic coma', 9, 1627074000, 1),
(439, 'B16.1', 'Acute hepatitis B with delta-agent (coinfection) without hepatic coma', 9, 1627074000, 1),
(440, 'B16.2', 'Acute hepatitis B without delta-agent with hepatic coma', 9, 1627074000, 1),
(441, 'B16.9', 'Acute hepatitis B without delta-agent and without hepatic coma', 9, 1627074000, 1),
(442, 'B17.0', 'Acute delta-(super)infection in chronic hepatitis B', 9, 1627074000, 1),
(443, 'B17.1', 'Acute hepatitis C', 9, 1627074000, 1),
(444, 'B17.2', 'Acute hepatitis E', 9, 1627074000, 1),
(445, 'B17.8', 'Other specified acute viral hepatitis', 9, 1627074000, 1),
(446, 'B17.9', 'Acute viral hepatitis, unspecified', 9, 1627074000, 1),
(447, 'B18.0', 'Chronic viral hepatitis B with delta-agent', 9, 1627074000, 1),
(448, 'B18.1', 'Chronic viral hepatitis B without delta-agent', 9, 1627074000, 1),
(449, 'B18.2', 'Chronic viral hepatitis C', 9, 1627074000, 1),
(450, 'B18.8', 'Other chronic viral hepatitis', 9, 1627074000, 1),
(451, 'B18.9', 'Chronic viral hepatitis, unspecified', 9, 1627074000, 1),
(452, 'B19.0', 'Unspecified viral hepatitis with hepatic coma', 9, 1627074000, 1),
(453, 'B19.9', 'Unspecified viral hepatitis without hepatic coma', 9, 1627074000, 1),
(454, 'B20.0', 'HIV disease resulting in mycobacterial infection', 9, 1627074000, 1),
(455, 'B20.1', 'HIV disease resulting in other bacterial infections', 9, 1627074000, 1),
(456, 'B20.2', 'HIV disease resulting in cytomegaloviral disease', 9, 1627074000, 1),
(457, 'B20.3', 'HIV disease resulting in other viral infections', 9, 1627074000, 1),
(458, 'B20.4', 'HIV disease resulting in candidiasis', 9, 1627074000, 1),
(459, 'B20.5', 'HIV disease resulting in other mycoses', 9, 1627074000, 1),
(460, 'B20.6', 'HIV disease resulting in Pneumocystis jirovecii pneumonia', 9, 1627074000, 1),
(461, 'B20.7', 'HIV disease resulting in multiple infections', 9, 1627074000, 1),
(462, 'B20.8', 'HIV disease resulting in other infectious and parasitic diseases', 9, 1627074000, 1),
(463, 'B20.9', 'HIV disease resulting in unspecified infectious or parasitic disease', 9, 1627074000, 1),
(464, 'B21.0', 'HIV disease resulting in Kaposi sarcoma', 9, 1627074000, 1),
(465, 'B21.1', 'HIV disease resulting in Burkitt lymphoma', 9, 1627074000, 1),
(466, 'B21.2', 'HIV disease resulting in other types of non-Hodgkin lymphoma', 9, 1627074000, 1),
(467, 'B21.3', 'HIV disease resulting in other malignant neoplasms of lymphoid, haematopoietic and related tissue', 9, 1627074000, 1),
(468, 'B21.7', 'HIV disease resulting in multiple malignant neoplasms', 9, 1627074000, 1),
(469, 'B21.8', 'HIV disease resulting in other malignant neoplasms', 9, 1627074000, 1),
(470, 'B21.9', 'HIV disease resulting in unspecified malignant neoplasm', 9, 1627074000, 1),
(471, 'B22.0', 'HIV disease resulting in encephalopathy', 9, 1627074000, 1),
(472, 'B22.1', 'HIV disease resulting in lymphoid interstitial pneumonitis', 9, 1627074000, 1),
(473, 'B22.2', 'HIV disease resulting in wasting syndrome', 9, 1627074000, 1),
(474, 'B22.7', 'HIV disease resulting in multiple diseases classified elsewhere', 9, 1627074000, 1),
(475, 'B23.0', 'Acute HIV infection syndrome', 9, 1627074000, 1),
(476, 'B23.1', 'HIV disease resulting in (persistent) generalized lymphadenopathy', 9, 1627074000, 1),
(477, 'B23.2', 'HIV disease resulting in haematological and immunological abnormalities, not elsewhere classified', 9, 1627074000, 1),
(478, 'B23.8', 'HIV disease resulting in other specified conditions', 9, 1627074000, 1),
(479, 'B24', 'Unspecified human immunodeficiency virus [HIV] disease', 9, 1627074000, 1),
(480, 'B25.0', 'Cytomegaloviral pneumonitis', 9, 1627074000, 1),
(481, 'B25.1', 'Cytomegaloviral hepatitis', 9, 1627074000, 1),
(482, 'B25.2', 'Cytomegaloviral pancreatitis', 9, 1627074000, 1),
(483, 'B25.8', 'Other cytomegaloviral diseases', 9, 1627074000, 1),
(484, 'B25.9', 'Cytomegaloviral disease, unspecified', 9, 1627074000, 1),
(485, 'B26.0', 'Mumps orchitis', 9, 1627074000, 1),
(486, 'B26.1', 'Mumps meningitis', 9, 1627074000, 1),
(487, 'B26.2', 'Mumps encephalitis', 9, 1627074000, 1),
(488, 'B26.3', 'Mumps pancreatitis', 9, 1627074000, 1),
(489, 'B26.8', 'Mumps with other complications', 9, 1627074000, 1),
(490, 'B26.9', 'Mumps without complication', 9, 1627074000, 1),
(491, 'B27.0', 'Gammaherpesviral mononucleosis', 9, 1627074000, 1),
(492, 'B27.1', 'Cytomegaloviral mononucleosis', 9, 1627074000, 1),
(493, 'B27.8', 'Other infectious mononucleosis', 9, 1627074000, 1),
(494, 'B27.9', 'Infectious mononucleosis, unspecified', 9, 1627074000, 1),
(495, 'B30.0', 'Keratoconjunctivitis due to adenovirus', 9, 1627074000, 1),
(496, 'B30.1', 'Conjunctivitis due to adenovirus', 9, 1627074000, 1),
(497, 'B30.2', 'Viral pharyngoconjunctivitis', 9, 1627074000, 1),
(498, 'B30.3', 'Acute epidemic haemorrhagic conjunctivitis (enteroviral)', 9, 1627074000, 1),
(499, 'B30.8', 'Other viral conjunctivitis', 9, 1627074000, 1),
(500, 'B30.9', 'Viral conjunctivitis, unspecified', 9, 1627074000, 1),
(501, 'B33.0', 'Epidemic myalgia', 9, 1627074000, 1),
(502, 'B33.1', 'Ross River disease', 9, 1627074000, 1),
(503, 'B33.2', 'Viral carditis', 9, 1627074000, 1),
(504, 'B33.3', 'Retrovirus infections, not elsewhere classified', 9, 1627074000, 1),
(505, 'B33.4', 'Hantavirus (cardio-)pulmonary syndrome [HPS] [HCPS]', 9, 1627074000, 1),
(506, 'B33.8', 'Other specified viral diseases', 9, 1627074000, 1),
(507, 'B34.0', 'Adenovirus infection, unspecified site', 9, 1627074000, 1),
(508, 'B34.1', 'Enterovirus infection, unspecified site', 9, 1627074000, 1),
(509, 'B34.2', 'Coronavirus infection, unspecified site', 9, 1627074000, 1),
(510, 'B34.3', 'Parvovirus infection, unspecified site', 9, 1627074000, 1),
(511, 'B34.4', 'Papovavirus infection, unspecified site', 9, 1627074000, 1),
(512, 'B34.8', 'Other viral infections of unspecified site', 9, 1627074000, 1),
(513, 'B34.9', 'Viral infection, unspecified', 9, 1627074000, 1),
(514, 'B35.0', 'Tinea barbae and tinea capitis', 9, 1627074000, 1),
(515, 'B35.1', 'Tinea unguium', 9, 1627074000, 1),
(516, 'B35.2', 'Tinea manuum', 9, 1627074000, 1),
(517, 'B35.3', 'Tinea pedis', 9, 1627074000, 1),
(518, 'B35.4', 'Tinea corporis', 9, 1627074000, 1),
(519, 'B35.5', 'Tinea imbricata', 9, 1627074000, 1),
(520, 'B35.6', 'Tinea inguinalis [Tinea cruris]', 9, 1627074000, 1),
(521, 'B35.8', 'Other dermatophytoses', 9, 1627074000, 1),
(522, 'B35.9', 'Dermatophytosis, unspecified', 9, 1627074000, 1),
(523, 'B36.0', 'Pityriasis versicolor', 9, 1627074000, 1),
(524, 'B36.1', 'Tinea nigra', 9, 1627074000, 1),
(525, 'B36.2', 'White piedra', 9, 1627074000, 1),
(526, 'B36.3', 'Black piedra', 9, 1627074000, 1),
(527, 'B36.8', 'Other specified superficial mycoses', 9, 1627074000, 1),
(528, 'B37.0', 'Candidal stomatitis', 9, 1627074000, 1),
(529, 'B37.1', 'Pulmonary candidiasis', 9, 1627074000, 1),
(530, 'B37.2', 'Candidiasis of skin and nail', 9, 1627074000, 1),
(531, 'B37.3', 'Candidiasis of vulva and vagina', 9, 1627074000, 1),
(532, 'B37.4', 'Candidiasis of other urogenital sites', 9, 1627074000, 1),
(533, 'B37.5', 'Candidal meningitis', 9, 1627074000, 1),
(534, 'B37.6', 'Candidal endocarditis', 9, 1627074000, 1),
(535, 'B37.7', 'Candidal sepsis', 9, 1627074000, 1),
(536, 'B37.8', 'Candidiasis of other sites', 9, 1627074000, 1),
(537, 'B37.9', 'Candidiasis, unspecified', 9, 1627074000, 1),
(538, 'B38.0', 'Acute pulmonary coccidioidomycosis', 9, 1627074000, 1),
(539, 'B38.1', 'Chronic pulmonary coccidioidomycosis', 9, 1627074000, 1),
(540, 'B38.2', 'Pulmonary coccidioidomycosis, unspecified', 9, 1627074000, 1),
(541, 'B38.3', 'Cutaneous coccidioidomycosis', 9, 1627074000, 1),
(542, 'B38.4', 'Coccidioidomycosis meningitis', 9, 1627074000, 1),
(543, 'B38.7', 'Disseminated coccidioidomycosis', 9, 1627074000, 1),
(544, 'B38.8', 'Other forms of coccidioidomycosis', 9, 1627074000, 1),
(545, 'B38.9', 'Coccidioidomycosis, unspecified', 9, 1627074000, 1),
(546, 'B39.0', 'Acute pulmonary histoplasmosis capsulati', 9, 1627074000, 1),
(547, 'B39.1', 'Chronic pulmonary histoplasmosis capsulati', 9, 1627074000, 1),
(548, 'B39.2', 'Pulmonary histoplasmosis capsulati, unspecified', 9, 1627074000, 1),
(549, 'B39.3', 'Disseminated histoplasmosis capsulati', 9, 1627074000, 1),
(550, 'B39.4', 'Histoplasmosis capsulati, unspecified', 9, 1627074000, 1),
(551, 'B39.5', 'Histoplasmosis duboisii', 9, 1627074000, 1),
(552, 'B39.9', 'Histoplasmosis, unspecified', 9, 1627074000, 1),
(553, 'B40.0', 'Acute pulmonary blastomycosis', 9, 1627074000, 1),
(554, 'B40.1', 'Chronic pulmonary blastomycosis', 9, 1627074000, 1),
(555, 'B40.2', 'Pulmonary blastomycosis, unspecified', 9, 1627074000, 1),
(556, 'B40.3', 'Cutaneous blastomycosis', 9, 1627074000, 1),
(557, 'B40.7', 'Disseminated blastomycosis', 9, 1627074000, 1),
(558, 'B40.8', 'Other forms of blastomycosis', 9, 1627074000, 1),
(559, 'B40.9', 'Blastomycosis, unspecified', 9, 1627074000, 1),
(560, 'B41.0', 'Pulmonary paracoccidioidomycosis', 9, 1627074000, 1),
(561, 'B41.7', 'Disseminated paracoccidioidomycosis', 9, 1627074000, 1),
(562, 'B41.8', 'Other forms of paracoccidioidomycosis', 9, 1627074000, 1),
(563, 'B41.9', 'Paracoccidioidomycosis, unspecified', 9, 1627074000, 1),
(564, 'B42.0', 'Pulmonary sporotrichosis', 9, 1627074000, 1),
(565, 'B42.1', 'Lymphocutaneous sporotrichosis', 9, 1627074000, 1),
(566, 'B42.7', 'Disseminated sporotrichosis', 9, 1627074000, 1),
(567, 'B42.8', 'Other forms of sporotrichosis', 9, 1627074000, 1),
(568, 'B42.9', 'Sporotrichosis, unspecified', 9, 1627074000, 1),
(569, 'B43.0', 'Cutaneous chromomycosis', 9, 1627074000, 1),
(570, 'B43.1', 'Phaeomycotic brain abscess', 9, 1627074000, 1),
(571, 'B43.2', 'Subcutaneous phaeomycotic abscess and cyst', 9, 1627074000, 1),
(572, 'B43.8', 'Other forms of chromomycosis', 9, 1627074000, 1),
(573, 'B43.9', 'Chromomycosis, unspecified', 9, 1627074000, 1),
(574, 'B44.0', 'Invasive pulmonary aspergillosis', 9, 1627074000, 1),
(575, 'B44.1', 'Other pulmonary aspergillosis', 9, 1627074000, 1),
(576, 'B44.2', 'Tonsillar aspergillosis', 9, 1627074000, 1),
(577, 'B44.7', 'Disseminated aspergillosis', 9, 1627074000, 1),
(578, 'B44.8', 'Other forms of aspergillosis', 9, 1627074000, 1),
(579, 'B44.9', 'Aspergillosis, unspecified', 9, 1627074000, 1),
(580, 'B45.0', 'Pulmonary cryptococcosis', 9, 1627074000, 1),
(581, 'B45.1', 'Cerebral cryptococcosis', 9, 1627074000, 1),
(582, 'B45.2', 'Cutaneous cryptococcosis', 9, 1627074000, 1),
(583, 'B45.3', 'Osseous cryptococcosis', 9, 1627074000, 1),
(584, 'B45.7', 'Disseminated cryptococcosis', 9, 1627074000, 1),
(585, 'B45.8', 'Other forms of cryptococcosis', 9, 1627074000, 1),
(586, 'B45.9', 'Cryptococcosis, unspecified', 9, 1627074000, 1),
(587, 'B46.0', 'Pulmonary mucormycosis', 9, 1627074000, 1),
(588, 'B46.1', 'Rhinocerebral mucormycosis', 9, 1627074000, 1),
(589, 'B46.2', 'Gastrointestinal mucormycosis', 9, 1627074000, 1),
(590, 'B46.3', 'Cutaneous mucormycosis', 9, 1627074000, 1),
(591, 'B46.4', 'Disseminated mucormycosis', 9, 1627074000, 1),
(592, 'B46.5', 'Mucormycosis, unspecified', 9, 1627074000, 1),
(593, 'B46.8', 'Other zygomycoses', 9, 1627074000, 1),
(594, 'B46.9', 'Zygomycosis, unspecified', 9, 1627074000, 1),
(595, 'B47.0', 'Eumycetoma', 9, 1627074000, 1),
(596, 'B47.1', 'Actinomycetoma', 9, 1627074000, 1),
(597, 'B47.9', 'Mycetoma, unspecified', 9, 1627074000, 1),
(598, 'B48.0', 'Lobomycosis', 9, 1627074000, 1),
(599, 'B48.1', 'Rhinosporidiosis', 9, 1627074000, 1),
(600, 'B48.2', 'Allescheriasis', 9, 1627074000, 1),
(601, 'B48.3', 'Geotrichosis', 9, 1627074000, 1),
(602, 'B48.4', 'Penicillosis', 9, 1627074000, 1),
(603, 'B48.5', 'Pneumocystosis', 9, 1627074000, 1),
(604, 'B48.7', 'Opportunistic mycoses', 9, 1627074000, 1),
(605, 'B48.8', 'Other specified mycoses', 9, 1627074000, 1),
(606, 'B49', 'Unspecified mycosis', 9, 1627074000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorexam`
--

CREATE TABLE `doctorexam` (
  `doctorexam_id` int(11) NOT NULL,
  `complaint` text NOT NULL,
  `physical_exam` text NOT NULL,
  `systematic_exam` text NOT NULL,
  `provisional_diagnosis` varchar(255) NOT NULL,
  `final_diagnosis` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `patientque_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorexam`
--

INSERT INTO `doctorexam` (`doctorexam_id`, `complaint`, `physical_exam`, `systematic_exam`, `provisional_diagnosis`, `final_diagnosis`, `status`, `timestamp`, `admission_id`, `patientque_id`) VALUES
(1, '<p>stomach</p>\r\n', '<p>temperaature measure</p>\r\n', '', '3', '', 1, '0', 0, 0),
(2, '<p>Testing</p>\r\n', '<p>testing</p>\r\n', '', '1', '', 1, '0', 29, 301),
(3, '<p>testing</p>\r\n', '<p>testing</p>\r\n', '', '4', '', 1, 'UNIX_TIMESTAMP()', 29, 301),
(4, '<p>testing for nana</p>\r\n', '<p>testing for that</p>\r\n', '', '4', '', 1, 'UNIX_TIMESTAMP()', 38, 321),
(5, '<p>headache</p>\r\n', '<p>temperature</p>\r\n', '', '99', '', 1, 'UNIX_TIMESTAMP()', 0, 0),
(6, '<p>stomach ache</p>\r\n\r\n<p>lack of apetite</p>\r\n', '<p>Temperature check</p>\r\n\r\n<p>heart beat measure&nbsp;</p>\r\n', '<p>deep breathing&nbsp;</p>\r\n', '3', '', 1, 'UNIX_TIMESTAMP()', 40, 328),
(7, '<p>headache</p>\r\n', '<p>heart beats</p>\r\n', '<p>shshs jsssjsj</p>\r\n', '267', '', 1, 'UNIX_TIMESTAMP()', 41, 331),
(8, '<p>headache</p>\r\n', '<p>temperature is high</p>\r\n', '<p>pains</p>\r\n', '197', '', 1, 'UNIX_TIMESTAMP()', 42, 334),
(9, '<p>headache, lack of apetite, loosing visibility</p>\r\n', '<p>high temperature, white colored eyes&nbsp;</p>\r\n', '<p>skin contrasting&nbsp;</p>\r\n', '121', '', 1, 'UNIX_TIMESTAMP()', 43, 338),
(10, '<p>headache</p>\r\n', '<p>temperature</p>\r\n', '<p>skin blur</p>\r\n', '27', '', 1, 'UNIX_TIMESTAMP()', 44, 342),
(11, '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '4', '', 1, 'UNIX_TIMESTAMP()', 45, 346);

-- --------------------------------------------------------

--
-- Table structure for table `doctorreports`
--

CREATE TABLE `doctorreports` (
  `doctorreport_id` int(11) NOT NULL,
  `drug` text NOT NULL,
  `dosage` int(11) DEFAULT NULL,
  `prescription` varchar(200) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `doctorexam_id` int(11) DEFAULT NULL,
  `details` varchar(1000) NOT NULL,
  `labmeasure` varchar(50) DEFAULT NULL,
  `radiomeasure` varchar(50) DEFAULT NULL,
  `complaint` varchar(1023) DEFAULT NULL,
  `physical_exam` varchar(1023) DEFAULT NULL,
  `systematic_exam` varchar(1023) DEFAULT NULL,
  `provisional_diagnosis` varchar(255) DEFAULT NULL,
  `final_diagnosis` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorreports`
--

INSERT INTO `doctorreports` (`doctorreport_id`, `drug`, `dosage`, `prescription`, `patientsque_id`, `doctorexam_id`, `details`, `labmeasure`, `radiomeasure`, `complaint`, `physical_exam`, `systematic_exam`, `provisional_diagnosis`, `final_diagnosis`, `status`) VALUES
(106, '', NULL, '', 154, NULL, '<p>measure</p>\r\n', '4', '', '<p>stomachache</p>\r\n', '<p>heating&nbsp;</p>\r\n', '<p>heatings</p>\r\n', '1,2,3', '1,2,3', 1),
(107, '', NULL, '', 154, NULL, '<p>measure</p>\r\n', '5', '', '<p>stomachache</p>\r\n', '<p>heating&nbsp;</p>\r\n', '<p>heatings</p>\r\n', '1,2,3', '1,2,3', 1),
(108, '', NULL, '', 154, NULL, '<p>measure</p>\r\n', '7', '', '<p>stomachache</p>\r\n', '<p>heating&nbsp;</p>\r\n', '<p>heatings</p>\r\n', '1,2,3', '1,2,3', 1),
(109, '', NULL, '', 154, NULL, '<p>take</p>\r\n', '', '1', '<p>stomachache</p>\r\n', '<p>heating&nbsp;</p>\r\n', '<p>heatings</p>\r\n', '1,2,3', '1,2,3', 1),
(110, '', NULL, '', 154, NULL, '<p>take</p>\r\n', '', '2', '<p>stomachache</p>\r\n', '<p>heating&nbsp;</p>\r\n', '<p>heatings</p>\r\n', '1,2,3', '1,2,3', 1),
(111, '', NULL, '', 159, NULL, '<p>very sick</p>\r\n', '', '2', '<p>mdmsdm am dm</p>\r\n', '<p>e wme we</p>\r\n', '<p>k smf w</p>\r\n', '3,5', '3,5', 1),
(112, '', NULL, '', 159, NULL, '<p>very sick</p>\r\n', '', '3', '<p>mdmsdm am dm</p>\r\n', '<p>e wme we</p>\r\n', '<p>k smf w</p>\r\n', '3,5', '3,5', 1),
(113, '', NULL, '', 164, NULL, '<p>measure</p>\r\n', '6', '', '<p>stomach ache</p>\r\n', '<p>backborne pain</p>\r\n', '<p>heating</p>\r\n', '1', '2', 1),
(114, '', NULL, '', 164, NULL, '<p>measure</p>\r\n', '12', '', '<p>stomach ache</p>\r\n', '<p>backborne pain</p>\r\n', '<p>heating</p>\r\n', '1', '2', 1),
(115, '', NULL, '', 164, NULL, '<p>take the PV screens</p>\r\n', '', '2', '<p>stomach ache</p>\r\n', '<p>backborne pain</p>\r\n', '<p>heating</p>\r\n', '1', '2', 1),
(116, '', NULL, '', 167, NULL, '<p>measure the patient</p>\r\n', '14', '', '<p>stomach ache</p>\r\n', '<p>body abnormal heating, headache, swollen stomach</p>\r\n', '<p>heat measure</p>\r\n', '1', '1', 1),
(117, '', NULL, '', 167, NULL, '<p>measure the patient</p>\r\n', '16', '', '<p>stomach ache</p>\r\n', '<p>body abnormal heating, headache, swollen stomach</p>\r\n', '<p>heat measure</p>\r\n', '1', '1', 1),
(118, '', NULL, '', 167, NULL, '<p>take them with k shape</p>\r\n', '', '1', '<p>stomach ache</p>\r\n', '<p>body abnormal heating, headache, swollen stomach</p>\r\n', '<p>heat measure</p>\r\n', '1', '1', 1),
(119, '', NULL, '', 167, NULL, '<p>take them with k shape</p>\r\n', '', '4', '<p>stomach ache</p>\r\n', '<p>body abnormal heating, headache, swollen stomach</p>\r\n', '<p>heat measure</p>\r\n', '1', '1', 1),
(120, '', NULL, '', 173, NULL, '<p>take the examination</p>\r\n', '14', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(121, '', NULL, '', 173, NULL, '<p>take the examination</p>\r\n', '16', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(122, '', NULL, '', 173, NULL, '<p>take the images</p>\r\n', '', '1', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(123, '', NULL, '', 173, NULL, '<p>take the images</p>\r\n', '', '2', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(124, '', NULL, '', 180, NULL, '<p>INVESTIGATION</p>\r\n', '6', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(125, '', NULL, '', 180, NULL, '<p>INVESTIGATION</p>\r\n', '13', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(126, '', NULL, '', 180, NULL, '<p>INVESTIGATION</p>\r\n', '14', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(127, '', NULL, '', 180, NULL, '', '', '2', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(128, '35', NULL, '18', 180, NULL, '', '', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(129, '35', NULL, '18', 180, NULL, '<p>aanze na hizo</p>\r\n', '', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(130, '35', NULL, '18', 180, NULL, '<p>mpe zote</p>\r\n', '', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(131, '', NULL, '', 188, NULL, '', '', '2', '<p>Patient is sick and feeling joint pains</p>\r\n', '', '', '', '', 1),
(132, '', NULL, '', 188, NULL, '', '', '3', '<p>Patient is sick and feeling joint pains</p>\r\n', '', '', '', '', 1),
(133, '', NULL, '', 180, NULL, '<p>apimwe vizuri</p>\r\n', '13', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(134, '', NULL, '', 180, NULL, '', '', '4', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(135, '', NULL, '', 193, NULL, '<p>chapchap mpimeni</p>\r\n', '13', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(136, '', NULL, '', 193, NULL, '<p>chapchap mpimeni</p>\r\n', '14', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(137, '', NULL, '', 193, NULL, '<p>chapchap mpimeni</p>\r\n', '16', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(138, '', NULL, '', 193, NULL, '', '', '2', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(139, '35', NULL, '12', 193, NULL, '<p>unywe dawa zote vizuri</p>\r\n', '', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(140, '110', NULL, '12', 180, NULL, '', '', '', '<p>FEVER, HEAD ACHE, MUSCLE PAIN</p>\r\n', '', '', '51', '4', 1),
(141, '36', NULL, '20', 193, NULL, '', '', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(142, '', NULL, '', 193, NULL, '', '', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(143, '', NULL, '', 193, NULL, '', '', '', '<p>Head ache</p>\r\n\r\n<p>Stomach ache</p>\r\n', '<p>Normal</p>\r\n', '', '4,5', '4', 1),
(144, '35', NULL, '18', 207, NULL, '<p>muumpe maelekezo ya dawa vizuri</p>\r\n', '', '', '', '', '', '', '', 1),
(145, '', NULL, '', 207, NULL, '<p>malaria&nbsp;</p>\r\n', '13', '', '', '', '', '', '', 1),
(146, '', NULL, '', 207, NULL, '', '', '3', '', '', '', '', '', 1),
(147, '', NULL, '', 207, NULL, '', '', '', '', '', '', '', '', 1),
(148, '', NULL, '', 207, NULL, '', '', '', '', '', '', '', '', 1),
(149, '', NULL, '', 215, NULL, '<p>test vital sign zotee</p>\r\n', '', '', '<p>stomach ache</p>\r\n', '<p>stomach swell</p>\r\n', '<p>vomtting</p>\r\n', '38', '37', 1),
(150, '', NULL, '', 215, NULL, '<p>test vital sign zotee</p>\r\n', '', '', '<p>stomach ache</p>\r\n', '<p>stomach swell</p>\r\n', '<p>vomtting</p>\r\n', '38', '37', 1),
(151, '', NULL, '', 215, NULL, '<p>test vital sign zotee</p>\r\n', '', '', '<p>stomach ache</p>\r\n', '<p>stomach swell</p>\r\n', '<p>vomtting</p>\r\n', '38', '37', 1),
(152, '', NULL, '', 223, NULL, '<p>test for liver function</p>\r\n', '52', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(153, '', NULL, '', 223, NULL, '<p>stomach</p>\r\n', '', '2', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(154, '', NULL, '', 223, NULL, '', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(155, '', NULL, '', 207, NULL, '<p>completed</p>\r\n', '16', '', '', '', '', '', '', 1),
(156, '', NULL, '', 207, NULL, '<p>completed</p>\r\n', '45', '', '', '', '', '', '', 1),
(157, '', NULL, '', 173, NULL, '<p>continue</p>\r\n', '22', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(158, '', NULL, '', 173, NULL, '<p>hb&nbsp;</p>\r\n', '6', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(159, '', NULL, '', 173, NULL, '<p>hb&nbsp;</p>\r\n', '6', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(160, '', 0, '', 173, NULL, '<p>hb&nbsp;</p>\r\n', '6', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(161, '', 0, '', 173, NULL, '<p>hb&nbsp;</p>\r\n', '6', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(162, '', 0, '', 207, NULL, '<p>testing&nbsp;</p>\r\n', '26', '', '', '', '', '', '', 1),
(163, '', 0, '', 207, NULL, '', '44', '', '', '', '', '', '', 1),
(164, '', 0, '', 173, NULL, '', '', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(165, '36', 12, '1*5', 223, NULL, '<p>well done</p>\r\n', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(166, '38', 12, '1*4', 223, NULL, '<p>well done</p>\r\n', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(167, '35', 7, '15', 207, NULL, '<p>amalizee</p>\r\n', '', '', '', '', '', '', '', 1),
(168, '35', 2, '18', 207, NULL, '', '', '', '', '', '', '', '', 1),
(169, '', 0, '', 245, NULL, '<p>Mpime vizuri kabisaa</p>\r\n', '6', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(170, '', 0, '', 245, NULL, '<p>Mpime vizuri kabisaa</p>\r\n', '14', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(171, '', 0, '', 245, NULL, '', '', '3', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(172, '35', 7, '30', 245, NULL, '<p>kama itakuwa haipo utambadilishia</p>\r\n', '', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(173, '', 0, '', 245, NULL, '<p>piima uzito tu</p>\r\n', '', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(174, '', 0, '', 245, NULL, '<p>tumbo lote</p>\r\n', '', '1', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(175, '', 0, '', 245, NULL, 'sdsv', '', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(176, '', 0, '', 245, NULL, '', '', '', '<p>mafua</p>\r\n\r\n<p>kikohozi</p>\r\n\r\n<p>tumbo kuuma</p>\r\n', '<p>homa</p>\r\n', '<p>chakula alichokula</p>\r\n', '2', '3', 1),
(177, '', 0, '', 261, NULL, '<p>check patient vitals</p>\r\n', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>Very sick</p>\r\n', '', '', 1),
(178, '', 0, '', 207, NULL, '', '', '', '', '', '', '', '', 1),
(179, '35', 2, '20', 266, NULL, '<p>apewe zote</p>\r\n', '', '', '', '', '', '', '', 1),
(180, '110', 2, '20', 266, NULL, '<p>apewe zote</p>\r\n', '', '', '', '', '', '', '', 1),
(181, '', 0, '', 173, NULL, '<p>check</p>\r\n', '', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(182, '', 0, '', 271, NULL, '', '', '', '', '', '', '', '', 1),
(183, '', 0, '', 271, NULL, '', '7', '', '', '', '', '', '', 1),
(184, '', 0, '', 271, NULL, '', '8', '', '', '', '', '', '', 1),
(185, '', 0, '', 271, NULL, '', '12', '', '', '', '', '', '', 1),
(186, '', 0, '', 271, NULL, '', '16', '', '', '', '', '', '', 1),
(187, '', 0, '', 269, NULL, '<p>hiv test</p>\r\n', '5', '', '<p>headache&nbsp; fever diarrhoea</p>\r\n', '<p>dehydrated and pain</p>\r\n', '<p>all system are normal</p>\r\n', '4', '', 1),
(188, '', 0, '', 269, NULL, '<p>hiv test</p>\r\n', '6', '', '<p>headache&nbsp; fever diarrhoea</p>\r\n', '<p>dehydrated and pain</p>\r\n', '<p>all system are normal</p>\r\n', '4', '', 1),
(189, '', 0, '', 269, NULL, '<p>hiv test</p>\r\n', '14', '', '<p>headache&nbsp; fever diarrhoea</p>\r\n', '<p>dehydrated and pain</p>\r\n', '<p>all system are normal</p>\r\n', '4', '', 1),
(190, '', 0, '', 269, NULL, '', '', '2', '<p>headache&nbsp; fever diarrhoea</p>\r\n', '<p>dehydrated and pain</p>\r\n', '<p>all system are normal</p>\r\n', '4', '', 1),
(191, '', 0, '', 279, NULL, '<p>hiv test</p>\r\n', '5', '', '', '', '', '4', '', 1),
(192, '', 0, '', 279, NULL, '<p>hiv test</p>\r\n', '6', '', '', '', '', '4', '', 1),
(193, '', 0, '', 279, NULL, '<p>hiv test</p>\r\n', '14', '', '', '', '', '4', '', 1),
(194, '', 0, '', 279, NULL, '', '', '2', '', '', '', '4', '', 1),
(195, '35', 0, '500mg tds po', 279, NULL, '', '', '', '', '', '', '', '', 1),
(196, '', 0, '', 261, NULL, '', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>Very sick</p>\r\n', '2', '', 1),
(197, '', 0, '', 173, NULL, '', '7', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(198, '', 0, '', 173, NULL, '', '23', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(199, '', 0, '', 173, NULL, '', '32', '', '<p>stomach ache</p>\r\n', '<p>temperature measure</p>\r\n', '<p>heating</p>\r\n', '1', '1', 1),
(200, '36', 0, '250mg tds 5/7', 268, NULL, '<p>use amoxicillin after manti marilia treatme</p>\r\n', '', '', '', '', '', '', '', 1),
(201, '111', 0, '5mls tds 3/7', 268, NULL, '<p>use amoxicillin after manti marilia treatme</p>\r\n', '', '', '', '', '', '', '', 1),
(202, '', 0, '', 223, NULL, '', '', '', '<p>Very sick</p>\r\n', '<p>Very Sick</p>\r\n', '<p>very SIck</p>\r\n', '4', '', 1),
(203, '', 0, '', 279, NULL, '', '', '', '', '', '', '', '', 1),
(204, '', 0, '', 279, NULL, '', '', '', '', '', '', '', '', 1),
(205, '', 0, '', 279, NULL, '', '', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(206, '', 0, '', 279, NULL, '', '4', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(207, '', 0, '', 279, NULL, '', '6', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(208, '', 0, '', 279, NULL, '', '7', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(209, '', 0, '', 279, NULL, '', '13', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(210, '', 0, '', 279, NULL, '<p>take it carefully</p>\r\n', '', '1', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(211, '', 0, '', 279, NULL, '<p>zxzxxzcxzccx</p>\r\n', '', '3', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(212, '', 0, '', 279, NULL, '<p>zzzzzzzzz</p>\r\n', '', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(213, '', 0, '', 279, NULL, '<p>mshone vidonda vyotee</p>\r\n', '', '', '<p>sever headache</p>\r\n', '<p>pale</p>\r\n', '<p>normal</p>\r\n', '4', '4', 1),
(214, '101', 32, 'Moderate pain of the patient', 302, NULL, 'Array', '', '', '', '', '', '', '', 1),
(215, '183', 24, 'Treating chickenpox', 302, NULL, 'Array', '', '', '', '', '', '', '', 1),
(216, '183', 2, 'Smallpox treatment', 306, NULL, 'Array', '', '', '<p>headache</p>\r\n', '<p>body is over heat</p>\r\n', '', '416', '', 1),
(217, '101', 1, 'Relieve pains', 306, NULL, 'Array', '', '', '<p>headache</p>\r\n', '<p>body is over heat</p>\r\n', '', '416', '', 1),
(218, '101', 1, 'Smallpox treatment', 308, NULL, 'Array', '', '', '', '', '', '', '', 1),
(219, '179', 2, 'Relieve pain', 308, NULL, 'Array', '', '', '', '', '', '', '', 1),
(220, '', 0, '', 310, NULL, '<p>measure those 2</p>\r\n', '4', '', '<p>headache</p>\r\n', '<p>temperature measurement</p>\r\n', '', '3', '', 1),
(221, '', 0, '', 310, NULL, '<p>measure those 2</p>\r\n', '7', '', '<p>headache</p>\r\n', '<p>temperature measurement</p>\r\n', '', '3', '', 1),
(222, '', 0, '', 310, NULL, '', '', '1', '<p>headache</p>\r\n', '<p>temperature measurement</p>\r\n', '', '3', '', 1),
(223, '183', 2, 'relieving muscles', 310, NULL, 'Array', '', '', '', '', '', '', '', 1),
(224, '', 0, '', 301, 2, '<p>testing</p>\r\n', '58', '', '<p>Testing</p>\r\n', '<p>testing</p>\r\n', '', '1', '', 1),
(225, '', 0, '', 301, 2, '<p>testing</p>\r\n', '61', '', '<p>Testing</p>\r\n', '<p>testing</p>\r\n', '', '1', '', 1),
(226, '', 0, '', 301, 3, '<p>test</p>\r\n', '7', '', '<p>testing</p>\r\n', '<p>testing</p>\r\n', '', '4', '', 1),
(227, '', 0, '', 321, 4, '<p>testing</p>\r\n', '58', '', '<p>testing for nana</p>\r\n', '<p>testing for that</p>\r\n', '', '4', '', 1),
(228, '', 0, '', 321, 4, '<p>testing</p>\r\n', '61', '', '<p>testing for nana</p>\r\n', '<p>testing for that</p>\r\n', '', '4', '', 1),
(229, '', 0, '', 328, 6, '<p>Take those test measures&nbsp;</p>\r\n', '39', '', '<p>stomach ache</p>\r\n\r\n<p>lack of apetite</p>\r\n', '<p>Temperature check</p>\r\n\r\n<p>heart beat measure&nbsp;</p>\r\n', '<p>deep breathing&nbsp;</p>\r\n', '3', '', 1),
(230, '', 0, '', 328, 6, '<p>Take those test measures&nbsp;</p>\r\n', '61', '', '<p>stomach ache</p>\r\n\r\n<p>lack of apetite</p>\r\n', '<p>Temperature check</p>\r\n\r\n<p>heart beat measure&nbsp;</p>\r\n', '<p>deep breathing&nbsp;</p>\r\n', '3', '', 1),
(231, '', 0, '', 328, 6, '', '', '1', '<p>stomach ache</p>\r\n\r\n<p>lack of apetite</p>\r\n', '<p>Temperature check</p>\r\n\r\n<p>heart beat measure&nbsp;</p>\r\n', '<p>deep breathing&nbsp;</p>\r\n', '3', '', 1),
(232, '', 0, '', 328, 6, '', '', '4', '<p>stomach ache</p>\r\n\r\n<p>lack of apetite</p>\r\n', '<p>Temperature check</p>\r\n\r\n<p>heart beat measure&nbsp;</p>\r\n', '<p>deep breathing&nbsp;</p>\r\n', '3', '', 1),
(233, '', 0, '', 331, 7, '', '', '1', '<p>headache</p>\r\n', '<p>heart beats</p>\r\n', '<p>shshs jsssjsj</p>\r\n', '267', '', 1),
(234, '', 0, '', 331, 7, '', '', '2', '<p>headache</p>\r\n', '<p>heart beats</p>\r\n', '<p>shshs jsssjsj</p>\r\n', '267', '', 1),
(235, '', 0, '', 334, 8, '<p>take these tests</p>\r\n', '60', '', '<p>headache</p>\r\n', '<p>temperature is high</p>\r\n', '<p>pains</p>\r\n', '197', '', 1),
(236, '', 0, '', 334, 8, '<p>take these tests</p>\r\n', '61', '', '<p>headache</p>\r\n', '<p>temperature is high</p>\r\n', '<p>pains</p>\r\n', '197', '', 1),
(237, '', 0, '', 334, 8, '', '', '3', '<p>headache</p>\r\n', '<p>temperature is high</p>\r\n', '<p>pains</p>\r\n', '197', '', 1),
(238, '', 0, '', 338, 9, '<p>Take those tests.</p>\r\n', '62', '', '<p>headache, lack of apetite, loosing visibility</p>\r\n', '<p>high temperature, white colored eyes&nbsp;</p>\r\n', '<p>skin contrasting&nbsp;</p>\r\n', '121', '', 1),
(239, '', 0, '', 338, 9, '<p>Take those tests.</p>\r\n', '63', '', '<p>headache, lack of apetite, loosing visibility</p>\r\n', '<p>high temperature, white colored eyes&nbsp;</p>\r\n', '<p>skin contrasting&nbsp;</p>\r\n', '121', '', 1),
(240, '', 0, '', 338, 9, '<p>Take those tests.</p>\r\n', '64', '', '<p>headache, lack of apetite, loosing visibility</p>\r\n', '<p>high temperature, white colored eyes&nbsp;</p>\r\n', '<p>skin contrasting&nbsp;</p>\r\n', '121', '', 1),
(241, '', 0, '', 338, 9, '', '', '2', '<p>headache, lack of apetite, loosing visibility</p>\r\n', '<p>high temperature, white colored eyes&nbsp;</p>\r\n', '<p>skin contrasting&nbsp;</p>\r\n', '121', '', 1),
(242, '', 0, '', 342, 10, '<p>take those measurements&nbsp;</p>\r\n', '63', '', '<p>headache</p>\r\n', '<p>temperature</p>\r\n', '<p>skin blur</p>\r\n', '27', '', 1),
(243, '', 0, '', 342, 10, '<p>take those measurements&nbsp;</p>\r\n', '64', '', '<p>headache</p>\r\n', '<p>temperature</p>\r\n', '<p>skin blur</p>\r\n', '27', '', 1),
(244, '', 0, '', 342, 10, '', '', '1', '<p>headache</p>\r\n', '<p>temperature</p>\r\n', '<p>skin blur</p>\r\n', '27', '', 1),
(245, '', 0, '', 346, 11, '<p>new</p>\r\n', '63', '', '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '4', '', 1),
(246, '', 0, '', 346, 11, '<p>new</p>\r\n', '64', '', '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '<p>pateint has joint pains</p>\r\n', '4', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doneexams`
--

CREATE TABLE `doneexams` (
  `doneexam_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(10) NOT NULL,
  `analyser` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `pregnant` varchar(10) NOT NULL,
  `exitmode` varchar(100) NOT NULL,
  `destination` varchar(10) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examcategories`
--

CREATE TABLE `examcategories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examcategories`
--

INSERT INTO `examcategories` (`category_id`, `category`, `examtype_id`, `status`) VALUES
(1, 'Bilan Hepatique', 1, 1),
(2, 'Bilan dâ€™athÃ©rome', 1, 1),
(3, 'Autres', 1, 1),
(4, 'LARVES ET OEUFS', 9, 1),
(5, 'PROTOZOAIRES(Formes vegetatives)', 9, 1),
(6, 'FLAGELLES(Formes vegetatives)', 9, 1),
(7, 'ELEMENTS NON PARASITAIRES', 9, 1),
(8, 'FLAGELLES(Formes kystiques)', 9, 1),
(9, 'PROTOZOAIRES(Formes kystiques)', 9, 1),
(10, 'Albimunurie', 1, 0),
(11, 'HÃ©moglobine gluquÃ©e', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `examdetails`
--

CREATE TABLE `examdetails` (
  `examdetail_id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `result` varchar(100) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `examination_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `prescriber` varchar(100) NOT NULL,
  `examcode` varchar(10) NOT NULL,
  `examination` varchar(1000) NOT NULL,
  `examresult` varchar(50) NOT NULL,
  `examvalue` varchar(100) NOT NULL,
  `pregnant` varchar(4) NOT NULL,
  `exitmode` varchar(50) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `exam` varchar(500) NOT NULL,
  `siunit` varchar(11) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `usuallyvalue` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examtypes`
--

CREATE TABLE `examtypes` (
  `examtype_id` int(11) NOT NULL,
  `examtype` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examtypes`
--

INSERT INTO `examtypes` (`examtype_id`, `examtype`, `status`) VALUES
(1, 'Biochemistry exam', 1),
(3, 'Balance sheet or hormone test', 1),
(4, 'Serology examination', 1),
(5, 'Hematology examination', 1),
(6, 'Examination of tumor markers and other special examinations', 1),
(7, 'Blood parasitology examination', 1),
(8, 'Examen parasitologie intestinaux macroscopiques', 0),
(9, 'Microscopic intestinal parasitology examination', 1),
(10, 'Antibiogram bulletin', 1),
(11, 'Gross intestinal parasitology examination', 1),
(12, 'NFS exam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gynaecologyreports`
--

CREATE TABLE `gynaecologyreports` (
  `gynaecologyreport_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `results` varchar(1000) NOT NULL,
  `conclusion` varchar(1000) NOT NULL,
  `responsible` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indications`
--

CREATE TABLE `indications` (
  `indication_id` int(11) NOT NULL,
  `indication` varchar(500) NOT NULL,
  `childbirth_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insurancecompanies`
--

CREATE TABLE `insurancecompanies` (
  `insurancecompany_id` int(11) NOT NULL,
  `company` varchar(300) NOT NULL,
  `plan` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurancecompanies`
--

INSERT INTO `insurancecompanies` (`insurancecompany_id`, `company`, `plan`, `status`) VALUES
(1, 'SOCABU', NULL, 0),
(2, 'SAAT', NULL, 0),
(3, 'BICOR', NULL, 0),
(4, 'COOPEC', NULL, 0),
(5, 'MIS SANTE', NULL, 0),
(6, 'BNDE', NULL, 0),
(7, 'ASSURANCE INKINZO', NULL, 0),
(8, 'SOCAR', NULL, 0),
(9, 'AMMS', NULL, 0),
(10, 'Econet Leo', NULL, 0),
(11, 'ASCOMA BURUNDI', NULL, 0),
(12, 'BRARUDI', NULL, 0),
(13, 'BRB', NULL, 0),
(14, 'MUSAT', NULL, 0),
(15, 'MS+', NULL, 0),
(16, 'SOGEAR', NULL, 0),
(17, 'CIGNA', NULL, 0),
(18, 'Jubilee Life Insurance', NULL, 1),
(19, 'National Health Insurance Fund (NHIF)', NULL, 1),
(20, 'Sanlam Life Insurance (T) Limited', NULL, 0),
(21, 'Alliance Life Assurance Limited', NULL, 0),
(22, 'Milembe Insurance', NULL, 0),
(23, 'Assemble Assurance', NULL, 1),
(24, 'Strategic Insurance', NULL, 1),
(25, 'National Insurance Corporation', NULL, 0),
(26, 'Britam Insurance Tanzania Limited', NULL, 0),
(27, 'National Social Security Fund (NSSF)', NULL, 1),
(28, 'LORETO SEC SCHOOL', NULL, 0),
(29, 'BISMARK SEC SCHOOL', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `insurancetypes`
--

CREATE TABLE `insurancetypes` (
  `insurancetype_id` int(11) NOT NULL,
  `insurancetype` varchar(500) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `maxamount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insuredinventoryitems`
--

CREATE TABLE `insuredinventoryitems` (
  `insuredinventoryitem_id` int(11) NOT NULL,
  `inventoryitem_id` int(11) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insuredinventoryitems`
--

INSERT INTO `insuredinventoryitems` (`insuredinventoryitem_id`, `inventoryitem_id`, `insurancecompany_id`, `charge`, `status`) VALUES
(1, 100, 18, '1200', 0),
(2, 62, 19, '28000', 1),
(3, 91, 19, '20', 1),
(4, 179, 19, '100', 1),
(5, 180, 19, '6000', 1),
(6, 181, 19, '1500', 1),
(7, 182, 19, '1300', 1),
(8, 183, 19, '250', 1),
(9, 184, 19, '200', 1),
(10, 186, 19, '150', 1),
(11, 188, 19, '0', 1),
(12, 189, 19, '75', 1),
(13, 190, 19, '150', 1),
(14, 191, 19, '15000', 1),
(15, 192, 19, '3000', 1),
(16, 193, 19, '3000', 1),
(17, 194, 19, '7500', 1),
(18, 195, 19, '190', 1),
(19, 196, 19, '4500', 1),
(20, 197, 19, '3000', 1),
(21, 198, 19, '2600', 1),
(22, 199, 19, '200', 1),
(23, 200, 19, '300', 1),
(24, 201, 19, '0', 1),
(25, 202, 19, '16000', 1),
(26, 204, 19, '0', 1),
(27, 205, 19, '150', 1),
(28, 206, 19, '1950', 1),
(29, 207, 19, '4000', 1),
(30, 208, 19, '5000', 1),
(31, 209, 19, '8500', 1),
(32, 210, 19, '2000', 1),
(33, 212, 19, '0', 1),
(34, 213, 19, '2000', 1),
(35, 214, 19, '2500', 1),
(36, 215, 19, '2000', 1),
(37, 217, 19, '0', 1),
(38, 219, 19, '5000', 1),
(39, 222, 19, '7000', 1),
(40, 223, 19, '2500', 1),
(41, 229, 19, '300', 1),
(42, 230, 19, '300', 1),
(43, 232, 18, '250', 1),
(44, 232, 19, '250', 1),
(45, 233, 19, '2000', 1),
(46, 233, 23, '3000', 1),
(47, 233, 24, '2000', 1),
(48, 234, 23, '150', 1),
(49, 234, 18, '150', 1),
(50, 234, 19, '150', 1),
(51, 234, 24, '150', 1),
(52, 234, 27, '150', 1),
(53, 235, 18, '4700', 1),
(54, 235, 24, '4500', 1),
(55, 236, 18, '250', 1),
(56, 237, 19, '5500', 1),
(57, 238, 19, '25000', 1),
(58, 239, 19, '750', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insuredinvestigationtypes`
--

CREATE TABLE `insuredinvestigationtypes` (
  `insuredinvestigationtype_id` int(11) NOT NULL,
  `investigationtype_id` int(11) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insuredinvestigationtypes`
--

INSERT INTO `insuredinvestigationtypes` (`insuredinvestigationtype_id`, `investigationtype_id`, `insurancecompany_id`, `charge`, `status`) VALUES
(1, 23, 19, '10000', 1),
(2, 23, 18, '20000', 1),
(3, 23, 23, '20000', 1),
(4, 23, 24, '20000', 1),
(5, 23, 27, '20000', 1),
(6, 11, 18, '15000', 1),
(7, 11, 23, '15000', 1),
(8, 11, 24, '15000', 1),
(9, 11, 27, '15000', 1),
(10, 9, 18, '15000', 1),
(11, 9, 23, '15000', 1),
(12, 9, 24, '15000', 0),
(13, 9, 24, '15000', 1),
(14, 9, 27, '15000', 1),
(15, 49, 18, '20000', 1),
(16, 12, 19, '2000', 1),
(17, 49, 23, '20000', 1),
(18, 12, 18, '2000', 1),
(19, 49, 24, '20000', 1),
(20, 49, 27, '20000', 1),
(21, 12, 23, '2000', 1),
(22, 2, 19, '3000', 1),
(23, 12, 24, '2000', 1),
(24, 2, 18, '3000', 1),
(25, 12, 27, '2000', 1),
(26, 2, 23, '3000', 1),
(27, 2, 24, '3000', 1),
(28, 2, 27, '3000', 1),
(29, 29, 18, '15000', 1),
(30, 22, 18, '15000', 1),
(31, 29, 23, '15000', 1),
(32, 22, 23, '15000', 1),
(33, 29, 24, '15000', 1),
(34, 22, 24, '15000', 1),
(35, 29, 27, '15000', 1),
(36, 22, 27, '15000', 1),
(37, 35, 18, '15000', 1),
(38, 51, 18, '30000', 1),
(39, 51, 23, '30000', 1),
(40, 51, 24, '30000', 1),
(41, 51, 27, '30000', 1),
(42, 35, 23, '15000', 1),
(43, 35, 24, '15000', 1),
(44, 35, 27, '15000', 1),
(45, 52, 18, '30000', 1),
(46, 52, 23, '30000', 1),
(47, 52, 24, '30000', 1),
(48, 52, 27, '30000', 1),
(49, 31, 18, '10000', 1),
(50, 31, 19, '6000', 1),
(51, 4, 18, '5000', 1),
(52, 31, 23, '10000', 1),
(53, 4, 19, '3000', 1),
(54, 31, 24, '10000', 1),
(55, 4, 23, '5000', 1),
(56, 31, 27, '10000', 1),
(57, 5, 18, '3000', 1),
(58, 4, 24, '5000', 1),
(59, 5, 19, '3000', 1),
(60, 4, 27, '5000', 1),
(61, 5, 23, '3000', 1),
(62, 5, 24, '3000', 1),
(63, 5, 27, '3000', 1),
(64, 38, 18, '7000', 1),
(65, 37, 18, '10000', 1),
(66, 38, 23, '7000', 1),
(67, 37, 23, '10000', 1),
(68, 38, 24, '7000', 1),
(69, 38, 27, '7000', 1),
(70, 37, 24, '10000', 1),
(71, 37, 27, '10000', 1),
(72, 6, 19, '2000', 1),
(73, 40, 19, '10000', 1),
(74, 6, 18, '4000', 1),
(75, 40, 18, '10000', 1),
(76, 6, 23, '4000', 1),
(77, 40, 23, '10000', 1),
(78, 6, 24, '4000', 1),
(79, 40, 24, '10000', 1),
(80, 6, 27, '4000', 1),
(81, 40, 27, '10000', 1),
(82, 41, 19, '10000', 1),
(83, 41, 18, '10000', 1),
(84, 41, 23, '10000', 1),
(85, 41, 24, '10000', 1),
(86, 41, 27, '10000', 1),
(87, 38, 19, '5000', 1),
(88, 37, 19, '5000', 1),
(89, 13, 19, '2000', 1),
(90, 13, 18, '2000', 1),
(91, 39, 19, '1900', 1),
(92, 39, 18, '4000', 1),
(93, 13, 23, '2000', 1),
(94, 13, 24, '2000', 1),
(95, 39, 23, '4000', 1),
(96, 13, 27, '2000', 1),
(97, 39, 24, '4000', 1),
(98, 39, 27, '4000', 1),
(99, 36, 18, '10000', 1),
(100, 36, 23, '10000', 1),
(101, 36, 24, '10000', 1),
(102, 14, 19, '2000', 1),
(103, 36, 27, '10000', 1),
(104, 14, 18, '2000', 1),
(105, 48, 18, '15000', 1),
(106, 14, 23, '2000', 1),
(107, 48, 23, '15000', 1),
(108, 14, 24, '2000', 1),
(109, 48, 24, '15000', 1),
(110, 14, 27, '2000', 1),
(111, 48, 27, '15000', 1),
(112, 30, 19, '5000', 1),
(113, 16, 19, '5000', 1),
(114, 30, 18, '10000', 1),
(115, 16, 18, '10000', 1),
(116, 30, 23, '10000', 1),
(117, 16, 23, '10000', 1),
(118, 30, 24, '10000', 1),
(119, 30, 27, '10000', 1),
(120, 16, 24, '10000', 1),
(121, 16, 27, '10000', 1),
(122, 47, 18, '15000', 1),
(123, 7, 19, '1500', 1),
(124, 47, 23, '15000', 1),
(125, 7, 18, '3000', 1),
(126, 47, 24, '15000', 1),
(127, 7, 23, '3000', 1),
(128, 47, 27, '15000', 0),
(129, 7, 24, '3000', 1),
(130, 47, 27, '15000', 1),
(131, 7, 27, '3000', 1),
(132, 15, 19, '2000', 1),
(133, 15, 18, '2000', 1),
(134, 15, 23, '2000', 1),
(135, 15, 23, '2000', 0),
(136, 15, 27, '2000', 1),
(137, 15, 24, '2000', 1),
(138, 53, 19, '2000', 1),
(139, 53, 18, '2000', 1),
(140, 53, 23, '2000', 1),
(141, 53, 24, '2000', 1),
(142, 53, 27, '2000', 1),
(143, 54, 18, '2000', 1),
(144, 54, 19, '2000', 1),
(145, 54, 23, '2000', 1),
(146, 54, 24, '2000', 1),
(147, 54, 27, '2000', 1),
(148, 54, 28, '2000', 1),
(149, 54, 29, '2000', 1),
(150, 55, 18, '2000', 1),
(151, 55, 19, '2000', 1),
(152, 55, 23, '2000', 1),
(153, 55, 24, '2000', 1),
(154, 55, 27, '2000', 1),
(155, 55, 27, '2000', 1),
(156, 55, 28, '2000', 1),
(157, 55, 29, '2000', 1),
(158, 56, 18, '10000', 1),
(159, 56, 19, '5000', 1),
(160, 56, 23, '10000', 1),
(161, 56, 24, '10000', 1),
(162, 56, 27, '10000', 1),
(163, 56, 28, '10000', 1),
(164, 56, 29, '10000', 1),
(165, 57, 18, '10000', 1),
(166, 57, 19, '6000', 1),
(167, 57, 23, '10000', 1),
(168, 57, 24, '10000', 1),
(169, 57, 27, '10000', 1),
(170, 57, 28, '10000', 1),
(171, 57, 29, '10000', 1),
(172, 58, 18, '15000', 1),
(173, 58, 19, '6000', 1),
(174, 58, 23, '10000', 1),
(175, 58, 24, '15000', 1),
(176, 58, 27, '10000', 1),
(177, 58, 28, '10000', 0),
(178, 58, 29, '10000', 0),
(179, 12, 28, '2000', 1),
(180, 12, 29, '2000', 1),
(181, 37, 28, '10000', 1),
(182, 37, 29, '10000', 1),
(183, 38, 28, '7000', 1),
(184, 38, 29, '7000', 1),
(185, 6, 28, '4000', 1),
(186, 6, 29, '4000', 1),
(187, 13, 28, '2000', 1),
(188, 13, 29, '2000', 1),
(189, 39, 28, '4000', 1),
(190, 39, 29, '4000', 1),
(191, 14, 28, '2000', 1),
(192, 14, 29, '2000', 1),
(193, 16, 28, '10000', 1),
(194, 16, 29, '10000', 1),
(195, 7, 28, '3000', 1),
(196, 7, 29, '3000', 1),
(197, 61, 19, '10000', 1),
(198, 62, 19, '5000', 1),
(199, 62, 18, '5000', 1),
(200, 63, 19, '5000', 1),
(201, 63, 18, '5000', 1),
(202, 64, 18, '5000', 1),
(203, 64, 19, '5000', 1),
(204, 65, 18, '50000', 1),
(205, 65, 19, '50000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insuredradiotypes`
--

CREATE TABLE `insuredradiotypes` (
  `insuredradiotype_id` int(11) NOT NULL,
  `investigationtype_id` int(11) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insuredradiotypes`
--

INSERT INTO `insuredradiotypes` (`insuredradiotype_id`, `investigationtype_id`, `insurancecompany_id`, `charge`, `status`) VALUES
(1, 1, 18, '20000', 1),
(2, 1, 19, '15000', 1),
(3, 1, 23, '20000', 1),
(4, 1, 24, '30000', 1),
(5, 1, 27, '20000', 1),
(6, 2, 18, '30000', 1),
(7, 2, 19, '15000', 1),
(8, 2, 23, '15000', 1),
(9, 2, 24, '30000', 1),
(10, 2, 27, '15000', 1),
(11, 3, 18, '30000', 1),
(12, 3, 19, '15000', 1),
(13, 3, 23, '20000', 1),
(14, 3, 24, '30000', 1),
(15, 3, 27, '20000', 1),
(16, 4, 18, '30000', 1),
(17, 4, 19, '15000', 1),
(18, 4, 23, '15000', 1),
(19, 4, 24, '30000', 1),
(20, 4, 27, '15000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insuredservices`
--

CREATE TABLE `insuredservices` (
  `insuredservice_id` int(11) NOT NULL,
  `medicalservice_id` int(11) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `charge` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insuredservices`
--

INSERT INTO `insuredservices` (`insuredservice_id`, `medicalservice_id`, `insurancecompany_id`, `charge`, `status`) VALUES
(1, 1318, 18, '5000', 1),
(2, 1319, 18, '5000', 1),
(3, 1319, 19, '5000', 1),
(4, 1319, 23, '5000', 1),
(5, 1319, 24, '5000', 1),
(6, 1319, 27, '5000', 1),
(7, 1320, 18, '5000', 1),
(8, 1320, 19, '5000', 1),
(9, 1320, 23, '5000', 1),
(10, 1320, 24, '5000', 1),
(11, 1320, 27, '5000', 1),
(12, 1322, 19, '2000', 1),
(13, 1325, 19, '0', 1),
(14, 1326, 19, '0', 1),
(15, 1327, 19, '0', 1),
(16, 1328, 19, '0', 1),
(17, 1331, 19, '2000', 1),
(18, 1332, 19, '0', 1),
(19, 1333, 19, '0', 1),
(20, 1335, 19, '25000', 1),
(21, 1336, 18, '1500', 1),
(22, 1336, 23, '1500', 1),
(23, 1336, 24, '1500', 1),
(24, 1336, 27, '1500', 1),
(25, 1337, 18, '1500', 1),
(26, 1337, 23, '1500', 1),
(27, 1337, 23, '1500', 1),
(28, 1337, 24, '1500', 1),
(29, 1337, 27, '1500', 1),
(30, 1338, 18, '30000', 1),
(31, 1338, 19, '20000', 1),
(32, 1338, 23, '30000', 1),
(33, 1338, 24, '20000', 1),
(34, 1338, 27, '20000', 1),
(35, 1340, 18, '2000', 1),
(36, 1340, 23, '2000', 1),
(37, 1340, 24, '2000', 1),
(38, 1340, 27, '2000', 1),
(39, 1341, 18, '50000', 1),
(40, 1341, 23, '50000', 1),
(41, 1341, 24, '50000', 1),
(42, 1341, 27, '50000', 1),
(43, 1342, 18, '5000', 1),
(44, 1342, 19, '5000', 1),
(45, 1343, 18, '1000', 1),
(46, 1343, 19, '1000', 1),
(47, 1344, 18, '2000', 1),
(48, 1344, 19, '2000', 1),
(49, 1345, 18, '2000', 1),
(50, 1345, 19, '2000', 1),
(51, 1346, 18, '10000', 1),
(52, 1346, 19, '5000', 1),
(53, 1346, 23, '10000', 1),
(54, 1346, 24, '10000', 1),
(55, 1346, 27, '10000', 1),
(56, 1347, 18, '2500', 1),
(57, 1347, 19, '2000', 1),
(58, 1347, 23, '3000', 1),
(59, 1347, 24, '2000', 1),
(60, 1347, 27, '2000', 1),
(61, 1348, 18, '2500', 1),
(62, 1348, 19, '2000', 1),
(63, 1348, 23, '3000', 1),
(64, 1348, 24, '2000', 1),
(65, 1348, 27, '2000', 1),
(66, 1349, 18, '10000', 1),
(67, 1349, 19, '5000', 1),
(68, 1349, 23, '10000', 1),
(69, 1349, 24, '10000', 1),
(70, 1349, 27, '10000', 1),
(71, 1350, 18, '7000', 1),
(72, 1350, 19, '5000', 1),
(73, 1350, 23, '7000', 1),
(74, 1350, 24, '7000', 1),
(75, 1350, 27, '7000', 1),
(76, 1351, 18, '2500', 1),
(77, 1351, 19, '2000', 1),
(78, 1351, 23, '2000', 1),
(79, 1351, 24, '1996', 1),
(80, 1351, 27, '2000', 1),
(81, 1352, 18, '2000', 1),
(82, 1352, 19, '2000', 1),
(83, 1352, 23, '2000', 1),
(84, 1352, 24, '2000', 1),
(85, 1352, 27, '2000', 1),
(86, 1353, 18, '3000', 1),
(87, 1353, 19, '2000', 1),
(88, 1353, 23, '3000', 1),
(89, 1353, 24, '3000', 1),
(90, 1353, 27, '3000', 1),
(91, 1354, 18, '15000', 1),
(92, 1354, 19, '6000', 1),
(93, 1354, 23, '15000', 1),
(94, 1354, 24, '15000', 1),
(95, 1355, 18, '4000', 1),
(96, 1355, 19, '1900', 1),
(97, 1355, 23, '4000', 1),
(98, 1355, 24, '4000', 1),
(99, 1355, 27, '4000', 1),
(100, 1356, 18, '4000', 1),
(101, 1356, 19, '2000', 1),
(102, 1356, 23, '4000', 1),
(103, 1356, 24, '4000', 1),
(104, 1356, 27, '4000', 1),
(105, 1357, 18, '3000', 1),
(106, 1357, 19, '2000', 1),
(107, 1357, 23, '3000', 1),
(108, 1357, 24, '3000', 1),
(109, 1357, 27, '3000', 1),
(110, 1358, 18, '3000', 1),
(111, 1358, 19, '2000', 1),
(112, 1358, 23, '3000', 1),
(113, 1358, 24, '3000', 1),
(114, 1358, 27, '3000', 1),
(115, 1359, 18, '3000', 1),
(116, 1359, 19, '6000', 1),
(117, 1359, 23, '3000', 1),
(118, 1359, 24, '3000', 1),
(119, 1359, 27, '3000', 1),
(120, 1360, 18, '3000', 1),
(121, 1360, 19, '1500', 1),
(122, 1360, 23, '3000', 1),
(123, 1360, 24, '3000', 1),
(124, 1360, 27, '3000', 1),
(125, 1361, 18, '5000', 1),
(126, 1361, 19, '2000', 1),
(127, 1361, 23, '3000', 1),
(128, 1361, 24, '5000', 1),
(129, 1361, 27, '5000', 1),
(130, 1362, 18, '7000', 1),
(131, 1362, 19, '7500', 1),
(132, 1362, 23, '8000', 1),
(133, 1363, 18, '2000', 1),
(134, 1363, 19, '2000', 1),
(135, 1363, 23, '2000', 1),
(136, 1363, 24, '2000', 1),
(137, 1363, 27, '2000', 1),
(138, 1364, 23, '0', 1),
(139, 1364, 18, '0', 1),
(140, 1364, 23, '0', 1),
(141, 1364, 24, '0', 1),
(142, 1364, 27, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insuredwards`
--

CREATE TABLE `insuredwards` (
  `insuredward_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `insurancecompany_id` int(11) NOT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insuredwards`
--

INSERT INTO `insuredwards` (`insuredward_id`, `ward_id`, `insurancecompany_id`, `charge`, `status`) VALUES
(1, 27, 19, '8000', 1),
(2, 27, 18, '10000', 1),
(3, 25, 19, '8000', 1),
(4, 27, 23, '10000', 1),
(5, 25, 18, '10000', 1),
(6, 27, 24, '10000', 1),
(7, 25, 23, '10000', 1),
(8, 27, 27, '10000', 1),
(9, 25, 24, '10000', 1),
(10, 25, 27, '10000', 1),
(11, 24, 19, '8000', 1),
(12, 26, 19, '8000', 1),
(13, 24, 18, '10000', 1),
(14, 26, 18, '10000', 1),
(15, 24, 23, '10000', 1),
(16, 26, 23, '10000', 1),
(17, 24, 24, '10000', 0),
(18, 26, 24, '10000', 0),
(19, 24, 24, '10000', 1),
(20, 26, 24, '10000', 1),
(21, 24, 27, '10000', 1),
(22, 26, 27, '10000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventoryitems`
--

CREATE TABLE `inventoryitems` (
  `inventoryitem_id` int(11) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `measurement_id` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `creditprice` int(11) DEFAULT NULL,
  `strength` varchar(500) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventoryitems`
--

INSERT INTO `inventoryitems` (`inventoryitem_id`, `itemname`, `type`, `measurement_id`, `minimum`, `unitprice`, `creditprice`, `strength`, `subcategory_id`, `timestamp`, `status`) VALUES
(1, 'Actinac plus', 'Medical', 3, 100, 500, NULL, '125', 1, 1654117200, 0),
(2, 'Actinac plus', 'Medical', 3, 200, 500, NULL, '125', 1, 1654117200, 0),
(3, 'Acyclovir tabs', 'Medical', 3, 100, 500, NULL, '200 mil', 25, 1654117200, 0),
(4, 'Acyclovir tabs', 'Medical', 3, 100, 500, NULL, '200 mil', 25, 1654117200, 0),
(5, 'Acyclovir tabs', 'Medical', 3, 100, 500, NULL, '200 mil', 25, 1654117200, 0),
(6, 'Adrenaline injection', 'Medical', 5, 10, 3000, NULL, '1 mg/ml', 26, 1654117200, 0),
(7, 'Adrenaline injection', 'Medical', 5, 10, 3000, NULL, '1 mg/ml', 26, 1654117200, 0),
(8, 'Albendazole suspension', 'Medical', 6, 50, 2000, NULL, '40 mg/ml', 26, 1654117200, 0),
(9, 'Albendazole suspension', 'Medical', 6, 50, 2000, NULL, '40 mg/ml', 26, 1654117200, 0),
(10, 'Allopurinol', 'Medical', 3, 300, 500, NULL, '300 mg', 26, 1654117200, 0),
(11, 'Allopurinol', 'Medical', 3, 300, 500, NULL, '300 mg', 26, 1654117200, 0),
(12, 'ALU 12', 'Medical', 7, 10, 3000, NULL, '140 mg', 26, 1654117200, 0),
(13, 'ALU 24', 'Medical', 7, 20, 4000, NULL, '140 mg', 26, 1654117200, 0),
(14, 'ALU 6', 'Medical', 7, 10, 3000, NULL, '140 mg', 26, 1654117200, 0),
(15, 'ALU 18', 'Medical', 7, 10, 3000, NULL, '140 mg', 26, 1654117200, 0),
(16, 'ALU 18', 'Medical', 7, 10, 3000, NULL, '140 mg', 26, 1654117200, 0),
(17, 'Aminophyline injection', 'Medical', 5, 10, 4000, NULL, '25 mg/ml', 26, 1654117200, 0),
(18, 'Aminophyline tablets', 'Medical', 3, 100, 200, NULL, '100 mg', 26, 1654117200, 0),
(19, 'Aminophyline tablets', 'Medical', 3, 100, 200, NULL, '100 mg', 26, 1654117200, 0),
(20, 'Amitriptyline tablet', 'Medical', 3, 100, 300, NULL, '10 mg', 26, 1654117200, 0),
(21, 'Amitriptyline tablet', 'Medical', 3, 100, 300, NULL, '10 mg', 26, 1654117200, 0),
(22, 'Amlbpine tablet', 'Medical', 3, 60, 300, NULL, '5 mg', 27, 1654117200, 0),
(23, 'Amlbpine tablet', 'Medical', 3, 60, 300, NULL, '5 mg', 27, 1654117200, 0),
(24, 'Amoxicillin DT', 'Medical', 3, 10, 200, NULL, '250 mg', 27, 1654117200, 0),
(25, 'Amoxicillin DT', 'Medical', 3, 10, 200, NULL, '250 mg', 27, 1654117200, 0),
(26, 'Amoxicillin DT', 'Medical', 3, 10, 200, NULL, '250 mg', 27, 1654117200, 0),
(27, 'Amoxicillin capsule', 'Medical', 8, 1500, 100, NULL, '250 mg', 27, 1654117200, 0),
(28, 'Amoxicillin capsule', 'Medical', 8, 1500, 100, NULL, '250 mg', 27, 1654117200, 0),
(29, 'Ampicillin injection', 'Medical', 9, 20, 3500, NULL, '500 mg', 27, 1654117200, 0),
(30, 'Amoxicillin suspension', 'Medical', 6, 20, 2000, NULL, '125 mg/5 ml', 27, 1654117200, 0),
(31, 'iTem Name', 'Medical', 2, 1000, 200, NULL, 'strong', 24, 1654203600, 0),
(32, 'Test Item', 'Medical', 4, 10000, 800, NULL, 'Strong', 26, 1654203600, 0),
(33, 'Test Item', 'Medical', 5, 5600, 650, NULL, 'Weak', 0, 1654203600, 0),
(34, 'Ampliclox capsule', 'Medical', 8, 2000, 300, NULL, '500 mg', 0, 1654203600, 0),
(35, 'Amoxicillin capsule', 'Medicine', 8, 898, 100, NULL, '250 mg', 0, 1654203600, 1),
(36, 'Amoxicillin DT', 'Medicine', 3, 972, 200, NULL, '250 mg', 0, 1654203600, 1),
(37, 'Phenoxymthylpenicillin', 'Medicine', 3, 1000, 100, NULL, '250 mg', 0, 1654203600, 1),
(38, 'Flucloxacillin', 'Medicine', 3, 490, 300, NULL, '250 mg', 0, 1654203600, 1),
(39, 'Ampliclox capsule', 'Medicine', 8, 1000, 300, NULL, '500 mg', 0, 1654203600, 1),
(40, 'Benzathine penicillin injection', 'Medicine', 9, 10, 4000, NULL, '2.4 mu', 0, 1654203600, 1),
(41, 'Benzylpenicillin penicillin sodium injection', 'Medicine', 9, 50, 3000, NULL, '5000000 i.u', 0, 1654203600, 1),
(42, 'Flucamox capsule', 'Medicine', 8, 100, 1000, NULL, '500 mg', 0, 1654203600, 1),
(43, 'Flucamox syrup', 'Medicine', 6, 5, 12000, NULL, '250 mg/5 ml', 0, 1654203600, 1),
(44, 'Agumentine suspension', 'Medicine', 6, 5, 20000, 20000, '228.5 mg/5 ml', 0, 1654203600, 1),
(45, 'Agumentine tablet 625 mg', 'Medicine', 3, 150, 2000, NULL, '625 mg', 0, 1654203600, 1),
(46, 'Agumentine tablet 375 mg', 'Medicine', 3, 100, 1500, NULL, '375 mg', 0, 1654203600, 1),
(47, 'Agumentine tablet DT 228.5 mg', 'Medicine', 3, 50, 1500, NULL, '228.5 mg', 0, 1654203600, 1),
(48, 'Ampicillin injection', 'Medicine', 9, 30, 3000, NULL, '500 mg', 0, 1654203600, 1),
(49, 'Ampliclox injection', 'Medicine', 9, 30, 3000, NULL, '500 mg', 0, 1654203600, 1),
(50, 'Ampliclox suspension', 'Medicine', 6, 40, 3000, NULL, '250 mg/5 ml', 0, 1654203600, 1),
(51, 'Neonatal ampliclox oral drop', 'Medicine', 6, 5, 8000, NULL, '90 mg/0.6 ml', 0, 1654203600, 1),
(52, 'Amoxicillin suspension', 'Medicine', 6, 20, 3000, NULL, '125 mg/5 ml', 0, 1654203600, 1),
(53, 'Cephalexin capsule', 'Medicine', 8, 200, 500, NULL, '500 mg', 0, 1654203600, 1),
(54, 'Cefalexin capsule', 'Medicine', 8, 200, 300, NULL, '250 mg', 0, 1654203600, 1),
(55, 'Cephalexin suspension', 'Medicine', 6, 15, 5000, NULL, '125 mg/5 ml', 0, 1654203600, 1),
(56, 'Ceftriaxone injection', 'Medicine', 9, 250, 4000, NULL, '1 g', 0, 1654203600, 1),
(57, 'Cefadroxil capsule', 'Medicine', 8, 50, 1000, NULL, '500 mg', 0, 1654203600, 1),
(58, 'Cefpodoxime tablet', 'Medicine', 3, 20, 3000, NULL, '200 mg', 0, 1654203600, 1),
(59, 'Cefpodoxime suspension', 'Medicine', 6, 5, 20000, NULL, '250 mg/5 ml', 0, 1654203600, 1),
(60, 'Cefixime capsule', 'Medicine', 8, 20, 3000, NULL, '200 mg', 0, 1654203600, 1),
(61, 'Cefixime suspension', 'Medicine', 6, 5, 20000, NULL, '100 mg/5 ml', 0, 1654203600, 1),
(62, 'Ceftriaxone+ salbactum injection', 'Medicine', 9, 5, 20000, NULL, '1.5 g', 0, 1654203600, 1),
(63, 'Doxycline', 'Medicine', 8, 1000, 100, NULL, '100 mg', 0, 1654203600, 1),
(64, 'Gentamicin', 'Medicine', 5, 200, 1000, NULL, '80 mg', 0, 1654203600, 1),
(65, 'Gentamicin eye drop', 'Medicine', 6, 10, 3000, NULL, '1 drop', 0, 1654203600, 1),
(66, 'Erythromycin', 'Medicine', 3, 500, 100, NULL, '250 mg', 0, 1654203600, 1),
(67, 'Erythromycin suspension', 'Medicine', 6, 20, 3000, NULL, '125 mg/5 ml', 0, 1654203600, 1),
(68, 'Azithromycin', 'Medicine', 3, 60, 2000, NULL, '500 mg', 0, 1654203600, 1),
(69, 'Azithromycin suspension', 'Medicine', 6, 5, 4000, NULL, '40 mg/ml', 0, 1654203600, 1),
(70, 'Co-trimoxazole', 'Medicine', 3, 500, 100, NULL, '480 mg', 0, 1654203600, 1),
(71, 'Co-trimoxazole syrup', 'Medicine', 6, 24, 3000, NULL, '248.5 mg/5 ml', 0, 1654203600, 1),
(72, 'Metronidazole', 'Medicine', 3, 3000, 200, NULL, '200 mg', 0, 1654203600, 1),
(73, 'Metronidazole suspension', 'Medicine', 6, 24, 3000, NULL, '200 mg/5 ml', 0, 1654203600, 1),
(74, 'Metronidazole injection', 'Medicine', 6, 30, 2000, NULL, '500 mg/100 ml', 0, 1654203600, 1),
(75, 'Tinidazole', 'Medicine', 3, 60, 500, NULL, '500 mg', 0, 1654203600, 1),
(76, 'Secnidazole', 'Medicine', 3, 20, 1000, NULL, '1 g', 0, 1654203600, 1),
(77, 'Netazox', 'Medicine', 3, 30, 1000, NULL, '500 mg', 0, 1654203600, 1),
(78, 'Ciprofloxacin', 'Medicine', 3, 1000, 200, NULL, '500 mg', 0, 1654203600, 1),
(79, 'Ciprofloxacin injection', 'Medicine', 6, 10, 3000, NULL, '200 mg/100 ml', 0, 1654203600, 1),
(80, 'Ciprofloxacin eye-drop', 'Medicine', 6, 5, 4000, NULL, '5 ml', 0, 1654203600, 1),
(81, 'Nitrofurantoin', 'Medicine', 3, 300, 100, NULL, '100 mg', 0, 1654203600, 1),
(82, 'Nirfloxacin', 'Medicine', 3, 200, 500, NULL, '400 mg', 0, 1654203600, 1),
(83, 'Norfoxacin+ tinidazole', 'Medicine', 3, 100, 1000, NULL, '1000 mg', 0, 1654203600, 1),
(84, 'Ciprofloxacin + tinidazole', 'Medicine', 3, 100, 1500, NULL, '1000 mg', 0, 1654203600, 1),
(85, 'Levofloxacin', 'Medicine', 3, 100, 1500, NULL, '500 mg', 0, 1654203600, 1),
(86, 'Albendazole tablet', 'Medicine', 3, 50, 2000, NULL, '400 mg', 35, 1654290000, 1),
(87, 'Albendazole suspension', 'Medicine', 6, 30, 2000, NULL, '200 mg/5 ml', 35, 1654290000, 1),
(88, 'Ferrous sulphate + folic acid tablets', 'Medicine', 3, 1000, 100, NULL, '200 mg/5 mg', 36, 1654290000, 1),
(89, 'Folic acid', 'Medicine', 3, 1000, 100, NULL, '5 mg', 37, 1654290000, 1),
(90, 'Hemovit suspension', 'Medicine', 6, 10, 5000, NULL, '200 mg', 37, 1654290000, 1),
(91, 'Salbutamol', 'Medicine', 3, 200, 100, NULL, '4 mg', 38, 1654290000, 1),
(92, 'Salbutamol inhaler', 'Medicine', 6, 5, 8000, NULL, '100 mcg/actuation', 38, 1654290000, 1),
(93, 'Aminophyline tablets', 'Medicine', 3, 100, 100, NULL, '100 mg', 39, 1654290000, 1),
(94, 'Aminophyline injection', 'Medicine', 9, 10, 3000, NULL, '250 mg/100 mil', 39, 1654290000, 1),
(95, 'Piroxicam capsule', 'Medicine', 8, 500, 200, NULL, '20 mg', 40, 1654290000, 1),
(96, 'Prednisolone tablet', 'Medicine', 3, 1000, 100, NULL, '5 mg', 40, 1654290000, 1),
(97, 'Tramadol injection', 'Medicine', 5, 20, 3000, NULL, '100 mg/5 mil', 40, 1654290000, 1),
(98, 'Tramadol capsule', 'Medicine', 8, 300, 500, NULL, '50 mg', 40, 1654290000, 1),
(99, 'Meloxicam', 'Medicine', 3, 100, 2000, NULL, '15 mg', 40, 1654290000, 1),
(100, 'Aceclofenac (actinac)', 'Medicine', 3, 100, 500, 600, '100 mg', 40, 1654290000, 1),
(101, 'Acetaminophen (Dentamol)', 'Medicine', 3, 30, 500, NULL, '500 mg', 41, 1654290000, 1),
(102, 'Flamar-MX', 'Medicine', 3, 30, 500, NULL, '500 mg', 41, 1654290000, 1),
(103, 'Hyoscine butylbromide', 'Medicine', 3, 100, 500, NULL, '10 mg', 41, 1654290000, 1),
(104, 'Hyoscine butylbromide injection', 'Medicine', 5, 30, 3000, NULL, '20 mg/10 mil', 41, 1654290000, 1),
(105, 'Diclofenac', 'Medicine', 3, 100, 100, NULL, '50 mg', 41, 1654290000, 1),
(106, 'Diclofenac gel', 'Medicine', 11, 30, 2000, NULL, '10 mg', 41, 1654290000, 1),
(107, 'Diclofenac injection', 'Medicine', 5, 100, 2000, NULL, '75 mg/3mil', 41, 1654290000, 1),
(108, 'Ibuprofen', 'Medicine', 3, 300, 200, NULL, '200 mg', 41, 1654290000, 1),
(109, 'Ibuprofen syrup', 'Medicine', 6, 30, 3000, NULL, '100 mg/5 mil', 41, 1654290000, 1),
(110, 'Paracetamol', 'Medicine', 3, 39980, 100, NULL, '500 mg', 41, 1654290000, 1),
(111, 'Paracetamol syrup', 'Medicine', 6, 99, 2000, NULL, '120 mg/5 mil', 41, 1654290000, 1),
(112, 'Paracetamol suppositories', 'Medicine', 11, 10, 2000, NULL, '250 mg', 41, 1654290000, 1),
(113, 'Paracetamol injection', 'Medicine', 6, 10, 10000, NULL, '1 g/100 mil', 41, 1654290000, 1),
(114, 'Meftal-spas', 'Medicine', 3, 120, 500, NULL, '250 mg', 41, 1654290000, 1),
(115, 'Mefenamic acid', 'Medicine', 3, 100, 300, NULL, '250 mg', 41, 1654290000, 1),
(116, 'Meftal-500', 'Medicine', 3, 100, 500, NULL, '500 mg', 41, 1654290000, 1),
(117, 'Meftal-P', 'Medicine', 3, 100, 300, NULL, '100 mg', 41, 1654290000, 1),
(118, 'Meftal-Forte', 'Medicine', 3, 50, 500, NULL, '500 mg', 41, 1654290000, 1),
(119, 'Relcer gel 100 ml', 'Medicine', 6, 20, 3000, NULL, '100 ml', 42, 1654549200, 1),
(120, 'Relcer gel 180 ml', 'Medicine', 6, 10, 6000, NULL, '1 g', 42, 1654549200, 1),
(121, 'Magnesium trisilicate tablets', 'Medicine', 3, 1000, 100, NULL, '250 mg', 42, 1654549200, 1),
(122, 'Sucrafil O gel', 'Medicine', 6, 10, 12000, NULL, '1020 mg/ 10 ml', 42, 1654549200, 1),
(123, 'Pantoprazole tablets', 'Medicine', 3, 90, 1000, NULL, '400 mg', 43, 1654549200, 1),
(124, 'Pantoprazole injection', 'Medicine', 9, 10, 20000, NULL, '40 mg', 42, 1654549200, 1),
(125, 'Omeprazole capsules', 'Medicine', 8, 1500, 300, NULL, '20 mg', 43, 1654549200, 1),
(126, 'Omeprazole injection', 'Medicine', 9, 5, 12000, NULL, '20 mg', 43, 1654549200, 1),
(127, 'Lansoprazole delayed-release + clarithromycin tablets', 'Medicine', 3, 5, 40000, NULL, '780 mg', 43, 1654549200, 1),
(128, 'Bendroflumethiazide', 'Medicine', 3, 200, 100, NULL, '5 mg', 0, 1654549200, 1),
(129, 'Furosemide', 'Medicine', 3, 200, 100, NULL, '40 mg', 0, 1654549200, 1),
(130, 'Spirinolactome', 'Medicine', 3, 100, 200, NULL, '250 mg', 0, 1654549200, 1),
(131, 'Methylodopa', 'Medicine', 3, 200, 200, NULL, '250 mg', 0, 1654549200, 1),
(132, 'Propranolol', 'Medicine', 3, 100, 200, NULL, '40 mg', 0, 1654549200, 1),
(133, 'Atenolol', 'Medicine', 3, 200, 100, NULL, '50 mg', 0, 1654549200, 1),
(134, 'Captopril', 'Medicine', 3, 100, 200, NULL, '25 mg', 0, 1654549200, 1),
(135, 'Nifedipine SR', 'Medicine', 3, 300, 200, NULL, '20 mg', 0, 1654549200, 1),
(136, 'Amiodipine', 'Medicine', 3, 90, 300, NULL, '5 mg', 0, 1654549200, 1),
(137, 'Hydralazine', 'Medicine', 5, 2, 10000, NULL, '25 mg', 0, 1654549200, 1),
(138, 'Furosemide injection', 'Medicine', 5, 20, 2000, NULL, '40 mg', 0, 1654549200, 1),
(139, 'Promethazine hydrochloride', 'Medicine', 3, 100, 200, NULL, '25 mg', 54, 1654549200, 1),
(140, 'Promethazine hydrochloride injection', 'Medicine', 9, 10, 2000, NULL, '10 mg', 54, 1654549200, 1),
(141, 'Dexamethasone injection', 'Medicine', 5, 20, 4000, NULL, '4 mg/ml', 54, 1654549200, 1),
(142, 'Dexamethasone tablets', 'Medicine', 3, 200, 500, NULL, '0.5 mg', 54, 1654549200, 1),
(143, 'Hydrocotrisone injection', 'Medicine', 9, 30, 3000, NULL, '100 mg', 54, 1654549200, 1),
(144, 'Hydrocortisone cream', 'Medicine', 4, 20, 3000, NULL, '15 g', 54, 1654549200, 1),
(145, 'Hydrocortisone eye-drop', 'Medicine', 6, 5, 3000, NULL, '0.1 mg', 54, 1654549200, 1),
(146, 'Betamethasone (celestamine)', 'Medicine', 3, 30, 1000, NULL, '2.25 mg', 54, 1654549200, 1),
(147, 'Cetirizine hydrochloride tablets', 'Medicine', 3, 1000, 100, NULL, '10 mg', 55, 1654549200, 1),
(148, 'Cetirizine hydrochloride syrup', 'Medicine', 6, 20, 5000, NULL, '5 mg', 55, 1654549200, 1),
(149, 'Loratadine oral solution', 'Medicine', 6, 5, 10000, NULL, '5 mg', 55, 1654549200, 1),
(150, 'Loratadine tablets', 'Medicine', 3, 20, 1000, NULL, '10 mg', 55, 1654549200, 1),
(151, 'Chlorphenamine', 'Medicine', 3, 100, 100, NULL, '4 mg', 55, 1654549200, 1),
(152, 'Metformin', 'Medicine', 3, 200, 500, NULL, '500 mg', 56, 1654722000, 1),
(153, 'Metformin + glibenclamide', 'Medicine', 3, 100, 500, NULL, '505 mg', 56, 1654722000, 1),
(154, 'Glibenclamide', 'Medicine', 3, 200, 500, NULL, '5 mg', 57, 1654722000, 1),
(155, 'Nystatin', 'Medicine', 6, 10, 4000, NULL, '100000 I.U', 63, 1654722000, 1),
(156, 'Nystatin pessaries', 'Medicine', 12, 10, 5000, NULL, '100000 I.U', 63, 1654722000, 1),
(157, 'Nystatin tablets', 'Medicine', 3, 200, 500, NULL, '100000 I.U', 63, 1654722000, 1),
(158, 'Clotrimazole cream 1%', 'Medicine', 4, 20, 3000, NULL, '20 mg', 64, 1654722000, 1),
(159, 'Clotrimazole vagina pessaries', 'Medicine', 12, 15, 3000, NULL, '100 mg', 64, 1654722000, 1),
(160, 'Clotrimazole vagina cream 2%', 'Medicine', 4, 20, 3000, NULL, '15 g', 64, 1654722000, 1),
(161, 'Ketoconazole + zinc pyrithione (shampoo)', 'Medicine', 6, 2, 20000, NULL, '60 ml', 64, 1654722000, 1),
(162, 'Ketoconazole cream 2%', 'Medicine', 4, 5, 8000, NULL, '30 g', 64, 1654722000, 1),
(163, 'Fluconazole', 'Medicine', 3, 50, 1000, NULL, '150 mg', 64, 1654722000, 1),
(164, 'Fluconazole injection', 'Medicine', 6, 10, 10000, NULL, '200 mg', 64, 1654722000, 1),
(165, 'Clobetasol propionate, miconazole nitrate & gentamicin sulphate cream (sonaderm))', 'Medicine', 4, 15, 6000, NULL, '10 g', 67, 1654722000, 1),
(166, 'Clotrimazole + anhydrous beclometasone dipropiate (candid-B) cream', 'Medicine', 4, 10, 6000, NULL, '15 gm', 67, 1654722000, 1),
(167, 'Clotrimazole, betamethasone & neomycin sulphate (funbact-A/skderm) cream', 'Medicine', 4, 15, 6000, NULL, '30 g', 67, 1654722000, 1),
(168, 'Betamethasone dipropionate, clotrimazole, gentamicin sulphate (gentrisone) cream', 'Medicine', 4, 5, 6000, NULL, '10 g', 67, 1654722000, 1),
(169, 'Betamethazone +  chlorocresol cream 0.1%', 'Medicine', 4, 5, 5000, NULL, '15 g', 67, 1654722000, 1),
(170, 'Clotrimazole, betamethasone, dipropionate & neomycin sulphate (candiderma) cream', 'Medicine', 4, 10, 6000, NULL, '10 mg', 67, 1654722000, 1),
(171, 'Griseofulvin', 'Medicine', 3, 500, 500, NULL, '500 mg', 65, 1654722000, 1),
(172, 'Benzoic acid, salicylic acid (whitfield\'s)', 'Medicine', 4, 20, 2000, NULL, '20 g', 65, 1654722000, 1),
(173, 'Calamine lotion', 'Medicine', 6, 5, 3000, NULL, '100 ml', 67, 1654722000, 1),
(174, 'Metronidazole gel', 'Medicine', 4, 5, 8000, NULL, '30 g', 0, 1654722000, 1),
(175, 'Silver sulfadiazine (silverkant) cream', 'Medicine', 4, 5, 5000, NULL, '15 gm', 0, 1654722000, 1),
(176, 'Oxytocin', 'Medicine', 5, 20, 5000, NULL, '10 I.U/ml', 0, 1654722000, 1),
(177, 'Misoprostol', 'Medicine', 3, 5, 20000, NULL, '200 mg', 0, 1654722000, 1),
(178, 'losartan potassium 50mg+Hydrochlothiazide 12.5mg(losartan H)', 'Medicine', 3, 10, 1000, 1000, '62.5mg', 52, 1679691600, 1),
(179, 'Acetylsalicylic Acid (Asprin)', 'Medicine', 3, 10, 500, 500, '75mg', 41, 1679691600, 1),
(180, 'Amoxycillin+clavlunate injection', 'Medicine', 6, 10, 10000, 10000, '1.2g', 32, 1679691600, 1),
(181, 'Terbinafine', 'Medicine', 3, 30, 2000, 2000, '250mg', 65, 1679691600, 1),
(182, 'ampicillin+cloxacillin inj (ampiclox)', 'Medicine', 6, 10, 3500, 3500, '500mg', 32, 1679691600, 1),
(183, 'Acyclovir', 'Medicine', 3, 700, 700, 700, '200mg', 74, 1679691600, 1),
(184, 'Metoclopramide', 'Medicine', 3, 30, 500, 500, '10mg', 76, 1679691600, 1),
(185, 'phenobarbitone', 'Medicine', 3, 30, 0, 0, '30mg', 75, 1679691600, 1),
(186, 'Domperidone', 'Medicine', 3, 100, 500, 500, '10mg', 76, 1679691600, 1),
(187, 'haloperidol', 'Medicine', 3, 30, 0, 0, '1.5mg', 77, 1679691600, 1),
(188, 'ZECUF Lozenges', 'Medicine', 3, 10, 500, 500, '', 78, 1679691600, 1),
(189, 'Bisacodyl', 'Medicine', 3, 100, 500, 500, '5mg', 79, 1679691600, 1),
(190, 'Loperamide Hydrochloride', 'Medicine', 8, 100, 500, 500, '2mg', 79, 1679691600, 1),
(191, 'Fluticasone furoate(Avamys)', 'Medicine', 6, 1, 20000, 20000, '27.5mcg', 41, 1679691600, 1),
(192, 'Bromhexine Syrup', 'Medicine', 6, 5, 4000, 4000, '100mls', 81, 1679691600, 1),
(193, 'Ascoril D Syrup', 'Medicine', 6, 5, 5000, 5000, '100mls', 81, 1679691600, 1),
(194, 'Lactulose Suspension', 'Medicine', 6, 5, 15000, 15000, '200mls', 79, 1679691600, 1),
(195, 'Ampicillin+Cloxacillin(Ampiclox)', 'Medicine', 8, 500, 400, 40, '250mg', 83, 1679691600, 1),
(196, 'Lindane Lotion (Scaboma)', 'Medicine', 6, 2, 12000, 12000, '1%', 78, 1679691600, 1),
(197, 'Ampicillin+Cloxacillin(Ampiclox) Suspension', 'Medicine', 6, 5, 5500, 5500, '500mls', 83, 1679691600, 1),
(198, 'Metoclopramide Syrup', 'Medicine', 6, 5, 5000, 5000, '5mg/5mls', 76, 1679691600, 1),
(199, 'cephalexin', 'Medicine', 8, 500, 500, 500, '250mg', 83, 1679691600, 1),
(200, 'cephalexin', 'Medicine', 8, 500, 1000, 1000, '500mg', 83, 1679691600, 1),
(201, 'Ampicillin', 'Medicine', 8, 500, 200, 200, '250MG', 83, 1679691600, 1),
(202, 'ALU Suspension', 'Medicine', 6, 5, 9000, 9000, '360/2160mg', 71, 1679691600, 1),
(203, 'Diclofenac+Paracetamol+Chlorzoxazone(Flamar MX)', 'Medicine', 3, 50, 0, 0, '0mg', 86, 1679691600, 1),
(204, 'Good morning Syrup', 'Medicine', 6, 5, 4000, 4000, '100mls', 81, 1679691600, 1),
(205, 'Ibuprofen+Paracetamol  (Koflame)', 'Medicine', 3, 200, 500, 500, '400mg/325mg', 86, 1679691600, 1),
(206, 'Vitamin B Complex Syrup', 'Medicine', 6, 5, 3500, 3500, '100mls', 85, 1679691600, 1),
(207, 'Artesunate', 'Medicine', 6, 10, 6000, 6000, '30mg', 70, 1679691600, 1),
(208, 'Artesunate', 'Medicine', 6, 10, 8000, 8000, '60mg', 70, 1679691600, 1),
(209, 'Artesunate', 'Medicine', 6, 10, 15000, 15000, '120mg', 70, 1679691600, 1),
(210, 'Multivitamin Syrup', 'Medicine', 6, 5, 3500, 3500, '100mls', 85, 1679691600, 1),
(211, 'Atropine Sulphate', 'Medicine', 9, 5, 0, 0, '0', 85, 1679691600, 1),
(212, 'Belladonna', 'Medicine', 6, 5, 7000, 7000, '100mls', 88, 1679691600, 1),
(213, 'Metoclopramide inj', 'Medicine', 9, 10, 3500, 3500, '10mg', 76, 1679691600, 1),
(214, 'Zinc Sulphate Syrup', 'Medicine', 6, 5, 5000, 5000, '100mls', 80, 1679691600, 1),
(215, 'Vitamin B Complex inj', 'Medicine', 6, 20, 3500, 3500, '10mg', 85, 1679691600, 1),
(216, 'Ondansetron(emeset) inj', 'Medicine', 9, 10, 7000, 7000, '4mg', 76, 1679691600, 1),
(217, 'SCOTT\'S (Emulsion Food Supplement)', 'Medicine', 6, 5, 8000, 8000, '100mls', 79, 1679691600, 1),
(218, 'Calcium gluconate', 'Medicine', 9, 2, 0, 0, '100mg/ml', 85, 1679778000, 1),
(219, 'Phytonadione(vitamin K)', 'Medicine', 8, 10, 8000, 8000, '1mg/ml', 85, 1679778000, 1),
(220, 'Phenobarbitone inj', 'Medicine', 9, 5, 0, 0, '200mg', 75, 1679778000, 1),
(221, 'Magnesium Sulphate inj', 'Medicine', 9, 2, 0, 0, '50%', 85, 1679778000, 1),
(222, 'Tranexamic Acid inj', 'Medicine', 9, 5, 10000, 10000, '500mg', 85, 1679778000, 1),
(223, 'Tranexamic Acid', 'Medicine', 3, 10, 4000, 4000, '500mg', 85, 1679778000, 1),
(224, 'Diazepam', 'Medicine', 9, 5, 0, 0, '10mg', 77, 1679778000, 1),
(225, 'Adrenaline', 'Medicine', 9, 5, 0, 0, '1mg', 85, 1679778000, 1),
(226, 'Mebendazole', 'Medicine', 3, 100, 0, 0, '100mg', 85, 1679778000, 1),
(227, 'Artesunate+Mefloquine', 'Medicine', 3, 10, 0, 0, '600/750mg', 70, 1679778000, 1),
(228, 'Dihydroartemisin-Piperaquine(Ridmal/Duo-cortexin)', 'Medicine', 3, 30, 0, 0, '40/320mg', 70, 1679778000, 1),
(229, 'Allopurinol', 'Medicine', 3, 60, 1000, 1000, '300mg', 90, 1679864400, 1),
(230, 'Sulfadoxine Pyrimethamine(SP)', 'Medicine', 3, 150, 700, 700, '1500/75mg', 71, 1679864400, 1),
(231, 'Dexamethasone eye drop 0.1%', 'Medicine', 6, 5, 0, 0, '10mls', 82, 1679864400, 1),
(232, 'test_medical_item', 'Medicine', 3, 100, 200, 270, '0.4', 42, 1680037200, 1),
(233, 'dawa2', 'Medicine', 3, 12, 1000, 1000, '30mg', 81, 1690232400, 1),
(234, 'Dawa 500gm', 'Medicine', 3, 1000, 100, 100, '500mlgm', 41, 1690232400, 1),
(235, 'dawa3', 'Medicine', 6, 12, 3500, 3500, '500mg', 42, 1690232400, 1),
(236, 'Syringe', 'Medical', 13, 100, 200, 400, '', 0, 1690837200, 1),
(237, 'Gloves', 'Medical', 13, 20, 5000, 5500, '', 0, 1691528400, 1),
(238, 'Mask', 'Medical', 13, 20, 20000, 25000, '', 0, 1691528400, 1),
(239, 'Drip Bottle', 'Medical', 14, 30, 500, 1000, '', 0, 1691528400, 1),
(240, 'White Papers', 'Non Medical', 16, 50, 10000, 12000, '', 0, 1691528400, 1),
(241, 'Pen', 'Non Medical', 13, 30, 8000, 10000, '', 0, 1691528400, 1),
(242, 'Pencil', 'Non Medical', 13, 30, 3000, 4000, '', 0, 1691528400, 1),
(243, 'Table', 'Non Medical', 15, 10, 150000, 180000, '', 0, 1691528400, 1),
(244, 'Chair', 'Non Medical', 15, 5, 120000, 130000, '', 0, 1691528400, 1),
(245, 'Aceclofenac (actinac)', 'Medicine', 3, 10, 20000, 20000, '', 0, 1692910800, 1),
(246, 'Acetylsalicylic Acid (Asprin)', 'Medicine', 3, 200, 400, 400, '', 0, 1692910800, 1),
(247, 'Agumentine tablet 625 mg', 'Medicine', 3, 300, 1000, 1000, '', 0, 1692910800, 1),
(248, 'ADHESIVE PLASTER', 'Medical', 12, 200, 500, 5000, '', 0, 1692910800, 1),
(249, 'BLOOD GROUP REAGENT', 'Medical', 12, 400, 5000, 10000, '', 0, 1692910800, 1),
(250, 'computer', 'Non Medical', 12, 2, 200000, 200000, '', 0, 1692910800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `investigationselect`
--

CREATE TABLE `investigationselect` (
  `investigationselect_id` int(11) NOT NULL,
  `investigationtype_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigationselect`
--

INSERT INTO `investigationselect` (`investigationselect_id`, `investigationtype_id`, `answer`, `timestamp`, `status`, `admin_id`) VALUES
(1, 61, 'Reactive', 1692589232, 1, 182),
(2, 61, 'Non Reactive', 1692589232, 1, 182),
(3, 62, 'Positive', 1693039639, 1, 182),
(4, 62, 'Negative', 1693039639, 1, 182),
(5, 63, 'A Rh D Positive', 1693040033, 1, 182),
(6, 63, 'B Rh D Positive', 1693040033, 1, 182),
(7, 63, 'AB Rh D Positive', 1693040033, 1, 182),
(8, 63, 'O Rh D Positive', 1693040033, 1, 182),
(9, 63, 'A Rh D Negative', 1693040033, 1, 182),
(10, 63, 'B Rh D Negative', 1693040033, 1, 182),
(11, 63, 'AB Rh D Negative', 1693040033, 1, 182),
(12, 63, 'O Rh D Negative', 1693040033, 1, 182);

-- --------------------------------------------------------

--
-- Table structure for table `investigationsubtypes`
--

CREATE TABLE `investigationsubtypes` (
  `investigationsubtype_id` int(11) NOT NULL,
  `investigationtype_id` int(11) NOT NULL,
  `subtype` varchar(100) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investigationsubtypes`
--

INSERT INTO `investigationsubtypes` (`investigationsubtype_id`, `investigationtype_id`, `subtype`, `unit_id`, `status`) VALUES
(1, 51, 'Clotting time', 11, 1),
(2, 51, 'Bleeding time (BT)', 11, 1),
(3, 51, 'Blood for culture and sensitivity', 9, 1),
(4, 52, 'Clotting time', 11, 1),
(5, 52, 'Bleeding time (BT)', 11, 1),
(6, 52, 'Blood for culture and sensitivity', 9, 1),
(7, 53, 'MRDT', 8, 1),
(8, 54, 'MRDT', 8, 1),
(9, 55, 'Bloos Slide for malaria', 13, 1),
(10, 56, 'Brucella', 8, 1),
(11, 57, 'Blood Grouping & X-match', 8, 1),
(12, 58, 'group', 16, 1),
(13, 58, 'group', 17, 1),
(14, 59, 'mch', 6, 1),
(15, 59, 'mchc', 2, 1),
(16, 59, 'haematocrit', 4, 1),
(17, 60, 'widal test', 15, 1),
(18, 61, 'RPR_test', 0, 1),
(19, 62, 'Test Sickel Cell', 0, 1),
(20, 63, 'Test Blood Grouping', 5, 1),
(21, 64, 'Test Hemoglobin(HB)', 2, 1),
(22, 65, 'WCB', 18, 1),
(23, 65, 'Lymph#', 18, 1),
(24, 65, 'Mid#', 18, 1),
(25, 65, 'Gran#', 18, 1),
(26, 65, 'Lymph%', 19, 1),
(27, 65, 'Mid%', 19, 1),
(28, 65, 'Gran%', 19, 1),
(29, 65, 'RBC', 20, 1),
(30, 65, 'HGB', 2, 1),
(31, 65, 'HCT', 19, 1),
(32, 65, 'MCT', 5, 1),
(33, 65, 'MCH', 6, 1),
(34, 65, 'MCHC', 2, 1),
(35, 65, 'RDW-CV', 19, 1),
(36, 65, 'RDW-SD', 5, 1),
(37, 65, 'PLT', 18, 1),
(38, 65, 'MPW', 5, 1),
(39, 65, 'PDW', 18, 1),
(40, 65, 'P-LCR', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `investigationtypes`
--

CREATE TABLE `investigationtypes` (
  `investigationtype_id` int(11) NOT NULL,
  `investigationtype` varchar(100) NOT NULL,
  `classification_id` int(11) NOT NULL,
  `unitprice` varchar(50) NOT NULL,
  `creditprice` varchar(50) DEFAULT NULL,
  `unit_id` varchar(50) NOT NULL,
  `range_type` int(11) NOT NULL DEFAULT '0',
  `has_answers` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investigationtypes`
--

INSERT INTO `investigationtypes` (`investigationtype_id`, `investigationtype`, `classification_id`, `unitprice`, `creditprice`, `unit_id`, `range_type`, `has_answers`, `status`) VALUES
(2, 'Blood group', 3, '3000', NULL, '5', 0, 0, 0),
(3, 'Blood group', 3, '3000', NULL, '5', 0, 0, 0),
(4, 'Cross matching', 3, '3000', NULL, '9', 0, 0, 1),
(5, 'Erythrocytes sedimentation rate (ESR)', 3, '3000', NULL, '10', 0, 0, 1),
(6, 'Hemoglobin(HB) estimation', 3, '4000', NULL, '5', 0, 0, 1),
(7, 'Urine Pregnancy test (UPT)', 7, '3000', NULL, '5', 0, 0, 1),
(8, 'Prothrombine time(PT)', 3, '10000', NULL, '11', 0, 0, 1),
(9, 'Bleeding Time (BT)', 3, '10000', NULL, '11', 0, 0, 0),
(10, 'Clotting time', 3, '10000', NULL, '11', 0, 0, 0),
(11, 'APTT', 3, '10000', NULL, '11', 0, 0, 1),
(12, 'Blood Smear(BS)', 2, '2000', NULL, '12', 0, 0, 1),
(13, 'Malaria Rapid Diagnostic (MRDT)', 2, '2000', NULL, '5', 0, 0, 1),
(14, 'Stool Analysis', 2, '2000', NULL, '9', 0, 0, 1),
(15, 'Urine-Microscope', 2, '2000', NULL, '13', 0, 0, 1),
(16, 'Uric Acid', 7, '10000', NULL, '3', 0, 0, 1),
(17, 'LDL', 7, '10000', NULL, '3', 0, 0, 1),
(18, 'HDL', 7, '10000', NULL, '3', 0, 0, 1),
(19, 'Triglycerides', 7, '10000', NULL, '3', 0, 0, 1),
(20, 'Sodium', 7, '10000', NULL, '14', 0, 0, 1),
(21, 'Potassium', 7, '10000', NULL, '14', 0, 0, 1),
(22, 'Calcium', 7, '10000', NULL, '14', 0, 0, 1),
(23, 'Alkaline Phosphate', 7, '10000', NULL, '3', 0, 0, 1),
(24, 'PTH', 7, '15000', NULL, '9', 0, 0, 1),
(25, 'TSH', 7, '15000', NULL, '9', 0, 0, 1),
(26, 'FT3', 7, '15000', NULL, '9', 0, 0, 1),
(27, 'FT4', 7, '15000', NULL, '9', 0, 0, 1),
(28, 'PSA', 7, '15000', NULL, '9', 0, 0, 1),
(29, 'C.R.P', 7, '15000', NULL, '9', 0, 0, 1),
(30, 'Urea', 7, '10000', NULL, '3', 0, 0, 1),
(31, 'Creatimine', 7, '10000', NULL, '3', 0, 0, 1),
(32, 'S.G.P.T (ASAT)', 7, '30000', NULL, '3', 0, 0, 1),
(33, 'Urine Pregnancy test (UPT)', 7, '30000', NULL, '5', 0, 0, 0),
(34, 'S.G.O.T (ASAT)', 7, '30000', NULL, '3', 0, 0, 1),
(35, 'Cholestrol', 7, '10000', NULL, '3', 0, 0, 1),
(36, 'Rheumatoid factor', 6, '10000', NULL, '5', 0, 0, 1),
(37, 'H.pylor Antigen test', 6, '7000', NULL, '5', 0, 0, 1),
(38, 'H.pylor Antibody test', 6, '7000', NULL, '5', 0, 0, 1),
(39, 'Rapid Plasma Regain (RPR)', 6, '4000', NULL, '14', 0, 0, 1),
(40, 'Hepatitis B', 6, '10000', NULL, '14', 0, 0, 1),
(41, 'Hepatitis C', 6, '10000', NULL, '14', 0, 0, 1),
(42, 'HIV', 6, '0', NULL, '5', 0, 0, 1),
(43, 'AFB', 6, '0', NULL, '9', 0, 0, 1),
(44, 'COVD 19 antigen test', 6, '0', NULL, '5', 0, 0, 1),
(45, 'TPHA', 6, '10000', NULL, '5', 0, 0, 1),
(46, 'GRAM STAIN', 6, '10000', NULL, '9', 0, 0, 1),
(47, 'Urine for Culture and Sensitivity', 6, '15000', NULL, '9', 0, 0, 1),
(48, 'Stool for Culture and Sensitivity', 6, '15000', NULL, '9', 0, 0, 1),
(49, 'Blood for Culture and Sensitivity', 6, '15000', NULL, '9', 0, 0, 0),
(50, 'HVS', 6, '15000', NULL, '9', 0, 0, 1),
(51, 'Liver function test', 7, '30000', NULL, '', 0, 0, 1),
(52, 'Liver function test', 7, '30000', NULL, '', 0, 0, 1),
(53, 'MRDT', 2, '', '2000', '5', 0, 0, 0),
(54, 'MRDT', 2, '0', '2000', '5', 0, 0, 0),
(55, 'Bloos Slide for malaria', 2, '0', '2000', '13', 0, 0, 0),
(56, 'Brucella', 2, '0', '10000', '5', 0, 0, 0),
(57, 'Blood Grouping & X-match', 3, '10000', '', '5', 0, 0, 0),
(58, 'Blood Grouping & X-match', 3, '10000', '', '5', 0, 0, 1),
(59, 'fbc', 3, '1000', '10000', '', 0, 0, 1),
(60, 'widal test', 5, '', '3000', '14', 0, 0, 1),
(61, 'RPR_test', 5, '10000', '15000', '', 0, 1, 1),
(62, 'Test Sickel Cell', 3, '5000', '7500', '', 0, 1, 1),
(63, 'Test Blood Grouping', 3, '5000', '7500', '5', 0, 1, 1),
(64, 'Test Hemoglobin(HB)', 3, '5000', '7500', '2', 1, 0, 1),
(65, 'Full Blood Picture (FBP)', 3, '50000', '75000', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `investigationtypesrange`
--

CREATE TABLE `investigationtypesrange` (
  `typesrange_id` int(11) NOT NULL,
  `investigationtype_id` int(11) DEFAULT NULL,
  `investigationsubtype_id` int(11) DEFAULT NULL,
  `normalx` float DEFAULT NULL,
  `normaly` float DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigationtypesrange`
--

INSERT INTO `investigationtypesrange` (`typesrange_id`, `investigationtype_id`, `investigationsubtype_id`, `normalx`, `normaly`, `timestamp`, `status`, `admin_id`) VALUES
(1, 64, NULL, 14, 17, 1693040702, 1, 182),
(2, 22, NULL, 4, 10, 1693337612, 1, 0),
(3, 23, NULL, 0.8, 4, 1693337612, 1, 0),
(4, 24, NULL, 0.1, 1.5, 1693337612, 1, 0),
(5, 25, NULL, 2, 7, 1693337612, 1, 0),
(6, 26, NULL, 20, 40, 1693337612, 1, 0),
(7, 27, NULL, 3, 15, 1693337612, 1, 0),
(8, 28, NULL, 50, 70, 1693337612, 1, 0),
(9, 29, NULL, 3.5, 5, 1693337612, 1, 0),
(10, 30, NULL, 11, 15, 1693337612, 1, 0),
(11, 31, NULL, 37, 47, 1693337612, 1, 0),
(12, 32, NULL, 80, 100, 1693337612, 1, 0),
(13, 33, NULL, 27, 34, 1693337612, 1, 0),
(14, 34, NULL, 32, 36, 1693337612, 1, 0),
(15, 35, NULL, 11, 16, 1693337612, 1, 0),
(16, 36, NULL, 35, 56, 1693337612, 1, 0),
(17, 37, NULL, 100, 300, 1693337612, 1, 0),
(18, 38, NULL, 6.5, 12, 1693337612, 1, 0),
(19, 39, NULL, 15.7, 17, 1693337612, 1, 0),
(20, 40, NULL, 11, 45, 1693337612, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issueddrugs`
--

CREATE TABLE `issueddrugs` (
  `issueddrug_id` int(11) NOT NULL,
  `drug` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issueddrugs`
--

INSERT INTO `issueddrugs` (`issueddrug_id`, `drug`, `quantity`, `patientsque_id`, `admission_id`, `admin_id`, `status`) VALUES
(1, 46, 10, 33, 0, 198, 1),
(2, 110, 12, 33, 0, 198, 1),
(3, 38, 50, 107, 0, 205, 1),
(4, 35, 15, 229, 0, 168, 1),
(5, 35, 7, 221, 0, 168, 1),
(6, 35, 7, 221, 0, 168, 1),
(7, 36, 13, 241, 0, 168, 1),
(8, 38, 10, 241, 0, 168, 1),
(9, 35, 15, 230, 0, 168, 1),
(10, 35, 30, 251, 0, 168, 1),
(11, 35, 20, 267, 0, 168, 1),
(12, 110, 20, 267, 0, 168, 1),
(13, 36, 15, 287, 0, 168, 1),
(14, 111, 1, 287, 0, 168, 1),
(15, 35, 30, 284, 0, 168, 1),
(16, 183, 32, 307, 33, 168, 1),
(17, 101, 16, 307, 33, 168, 1),
(18, 101, 24, 309, 34, 168, 1),
(19, 179, 32, 309, 34, 168, 1),
(20, 183, 2, 314, 35, 168, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemcategories`
--

CREATE TABLE `itemcategories` (
  `itemcategory_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemcategories`
--

INSERT INTO `itemcategories` (`itemcategory_id`, `category`, `type`, `status`) VALUES
(1, 'MÃ©dicaments essentiels GÃ©nÃ©riques', 'Medical items', 0),
(2, 'Produits de la nutrition', 'Medical items', 0),
(3, 'Antipaludiques', 'Medical items', 0),
(4, 'Contraceptifs', 'Medicine', 1),
(5, 'Antituberculeux', 'Medicine', 1),
(6, 'Produits VIH/IST', 'Medical items', 0),
(7, 'Antibiotiques', 'Medical items', 0),
(8, 'Anti-infectieux', 'Medical items', 0),
(9, 'AnÃ©sthesiques et fluides mÃ©dicaux', 'Medical items', 0),
(10, 'AnalgÃ©siques', 'Medical items', 0),
(11, 'Antimigraineux', 'Medical items', 0),
(12, 'Antineoplasiques, Immunosuppresseurs et Medicaments des soins palliatifs', 'Medical items', 0),
(13, 'Antiparkinsoniens', 'Medicine', 1),
(14, 'MEDICAMENTS UTILISES EN HEMATOLOGIE', 'Medical items', 0),
(15, 'PRODUITS SANGUINS ET SUBSTITUTS DU PLASMA', 'Medical items', 0),
(16, 'MEDICAMENTS UTILISES EN CARDIO-ANGEIOLOGIE', 'Medical items', 0),
(17, 'MEDICAMENTS UTILISES EN DERMATOLOGIE', 'Medical items', 0),
(18, 'Antiviral', 'Medical items', 0),
(19, 'Adrenegic agonist', 'Medicine', 1),
(20, 'Antihelminthes', 'Medicine', 1),
(21, 'Antigout', 'Medicine', 1),
(22, 'Antimalaria', 'Medicine', 1),
(23, 'Antiathma', 'Medical items', 0),
(24, 'Antidepressant', 'Medicine', 1),
(25, 'Antihypertensive', 'Medicine', 1),
(26, 'Antibiotic', 'Medicine', 1),
(27, 'Antiviral', 'Medicine', 1),
(28, 'Antipain', 'Medical items', 0),
(29, 'Anthelminic', 'Medicine', 1),
(30, 'Antianemia', 'Medicine', 1),
(31, 'Antiasthmatic', 'Medicine', 1),
(32, 'Anti-inflammatory', 'Medicine', 1),
(33, 'Anti-acid', 'Medicine', 1),
(34, 'Antihistamine', 'Medicine', 1),
(35, 'Antidiabetics', 'Medicine', 1),
(36, 'Antidiabetic', 'Medicine', 1),
(37, 'Antifungus', 'Medicine', 1),
(38, 'Prostaglandins', 'Medicine', 1),
(39, 'antiepileptic', 'Medicine', 1),
(40, 'antipsychotic', 'Medicine', 1),
(41, 'antiemetic', 'Medicine', 1),
(42, 'miscellaneous', 'Medicine', 1),
(43, 'Cathartics', 'Medicine', 1),
(44, 'cough', 'Medicine', 1),
(45, 'antidiarrhoea', 'Medicine', 1),
(46, 'steroids', 'Medicine', 1),
(47, 'antiscabies', 'Medicine', 1),
(48, 'other', 'Medicine', 1),
(49, 'Analgesia', 'Medicine', 1),
(50, 'Antispasmodic', 'Medicine', 1),
(51, 'Cylinge', 'Non Medical items', 0),
(52, 'Consumable', 'Medical items', 1),
(53, 'Furniture', 'Non Medical items', 1),
(54, 'Stationeries', 'Non Medical items', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `itemname` varchar(500) NOT NULL,
  `itemcategory_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laborders`
--

CREATE TABLE `laborders` (
  `laborder_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `paymentmethod` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `approvedby` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laborders`
--

INSERT INTO `laborders` (`laborder_id`, `patientsque_id`, `admin_id`, `timestamp`, `payment`, `paymentmethod`, `payment_id`, `source`, `approvedby`, `status`) VALUES
(29, 155, 165, 1686931575, 0, 'insurance', '0', 'reception', 0, 0),
(30, 156, 165, 1686931779, 0, 'insurance', '0', 'reception', 0, 0),
(31, 157, 165, 1687000774, 0, 'insurance', '0', 'reception', 0, 0),
(32, 165, 165, 1687770575, 0, 'insurance', '0', 'reception', 0, 0),
(33, 168, 165, 1687948436, 0, 'insurance', '0', 'reception', 0, 0),
(34, 174, 165, 1688363761, 0, 'insurance', '0', 'reception', 0, 0),
(35, 181, 165, 1690007402, 0, 'insurance', '0', 'reception', 0, 0),
(36, 191, 165, 1690211245, 0, 'insurance', '0', 'reception', 0, 0),
(37, 194, 165, 1690212228, 0, 'insurance', '0', 'reception', 0, 0),
(38, 209, 165, 1690232681, 0, 'insurance', '0', 'reception', 0, 0),
(39, 224, 165, 1690275033, 0, 'cash', '0', 'reception', 0, 0),
(40, 231, 165, 1690281646, 0, 'insurance', '0', 'reception', 0, 0),
(41, 232, 165, 1690281889, 0, 'insurance', '0', 'reception', 0, 0),
(42, 233, 165, 1690281939, 0, 'insurance', '0', 'reception', 0, 0),
(43, 234, 165, 1690282153, 0, 'insurance', '0', 'reception', 0, 0),
(44, 235, 165, 1690282329, 0, 'insurance', '0', 'reception', 0, 0),
(45, 236, 165, 1690282547, 0, 'insurance', '0', 'reception', 0, 0),
(46, 237, 165, 1690282626, 0, 'insurance', '0', 'reception', 0, 0),
(47, 238, 165, 1690282699, 0, 'cash', '0', 'reception', 0, 0),
(48, 239, 165, 1690282876, 0, 'cash', '0', 'reception', 0, 0),
(49, 247, 165, 1690405182, 0, 'cash', '0', 'reception', 0, 0),
(50, 273, 165, 1690453339, 0, 'cash', '0', 'reception', 0, 0),
(51, 276, 165, 1690454981, 0, 'insurance', '0', 'reception', 0, 0),
(52, 280, 165, 1690459180, 0, 'insurance', '0', 'reception', 0, 0),
(53, 286, 165, 1690461715, 0, 'insurance', '0', 'reception', 0, 0),
(54, 293, 165, 1690492186, 0, 'insurance', '0', 'reception', 0, 0),
(55, 311, 165, 1692432401, 0, 'insurance', '0', 'reception', 0, 0),
(56, 317, 165, 1692590010, 0, 'cash', '0', 'reception', 0, 0),
(57, 318, 165, 1692597723, 0, 'insurance', '0', 'reception', 0, 0),
(58, 320, 165, 1692598824, 0, 'insurance', '0', 'reception', 0, 0),
(59, 322, 165, 1692599078, 0, 'cash', '0', 'reception', 0, 0),
(60, 329, 165, 1692652487, 0, 'insurance', '0', 'reception', 0, 0),
(61, 335, 165, 1692876329, 0, 'cash', '0', 'reception', 0, 0),
(62, 339, 165, 1693041806, 0, 'insurance', '0', 'reception', 0, 0),
(63, 343, 165, 1693285332, 0, 'insurance', '0', 'reception', 0, 0),
(64, 347, 165, 1693287522, 0, 'cash', '0', 'reception', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `labreports`
--

CREATE TABLE `labreports` (
  `labreport_id` int(11) NOT NULL,
  `title` text,
  `sample_id` text NOT NULL,
  `subtype` int(11) NOT NULL DEFAULT '0',
  `test` varchar(1000) NOT NULL,
  `siunit` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `result` varchar(1000) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `clinic` int(11) NOT NULL DEFAULT '0',
  `details` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labreports`
--

INSERT INTO `labreports` (`labreport_id`, `title`, `sample_id`, `subtype`, `test`, `siunit`, `admission_id`, `start`, `end`, `result`, `patientsque_id`, `clinic`, `details`, `status`, `timestamp`, `admin_id`, `approved`) VALUES
(26, NULL, '', 0, '12', 0, 0, '00:00:00', '00:00:00', '0.4', 165, 0, '<p>She has sufficient blood cycle</p>', 1, 0, 0, 0),
(27, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', '+4.3 Amoeba', 168, 0, '<p>The patient has normal uric acid but is diagonized with amoeba bacteria&nbsp;</p>', 1, 0, 0, 0),
(28, NULL, '', 0, '16', 0, 0, '00:00:00', '00:00:00', '-9.6 Moderate yz', 168, 0, '<p>The patient has normal uric acid but is diagonized with amoeba bacteria&nbsp;</p>', 1, 0, 0, 0),
(29, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', '2 AMB', 174, 0, '<p>The patient has normal uric acid. The patient is diagnosized with Amoeba.</p>', 1, 0, 0, 0),
(30, NULL, '', 0, '16', 0, 0, '00:00:00', '00:00:00', '0.62', 174, 0, '<p>The patient has normal uric acid. The patient is diagnosized with Amoeba.</p>', 1, 0, 0, 0),
(31, NULL, '', 0, '6', 0, 0, '00:00:00', '00:00:00', 'NORMAL', 181, 0, '', 1, 0, 0, 0),
(32, NULL, '', 0, '13', 0, 0, '00:00:00', '00:00:00', 'NEGATIVE', 181, 0, '', 1, 0, 0, 0),
(33, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', 'NEGATIVE', 181, 0, '', 1, 0, 0, 0),
(34, NULL, '', 0, '13', 0, 0, '00:00:00', '00:00:00', 'NEGATIVE', 194, 0, '<p>Mkojo wake mchafu sanaa</p>', 1, 0, 0, 0),
(35, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', 'POSITVE', 194, 0, '<p>Mkojo wake mchafu sanaa</p>', 1, 0, 0, 0),
(36, NULL, '', 0, '16', 0, 0, '00:00:00', '00:00:00', 'VERY BAD', 194, 0, '<p>Mkojo wake mchafu sanaa</p>', 1, 0, 0, 0),
(37, NULL, '', 0, '13', 0, 0, '00:00:00', '00:00:00', 'malaria20', 209, 0, '<p>anamalaria nyingi</p>', 1, 0, 0, 0),
(38, NULL, '', 0, '52', 0, 0, '00:00:00', '00:00:00', 'positive', 224, 0, '', 1, 0, 0, 0),
(39, NULL, '', 0, '6', 0, 0, '00:00:00', '00:00:00', '12', 247, 0, '<p>anachoo kichafu</p>', 1, 0, 0, 0),
(40, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', 'yes', 247, 0, '<p>anachoo kichafu</p>', 1, 0, 0, 0),
(41, NULL, '', 0, '16', 0, 0, '00:00:00', '00:00:00', '450', 231, 0, '<p>normal&nbsp;</p>', 1, 0, 0, 0),
(42, NULL, '', 0, '45', 0, 0, '00:00:00', '00:00:00', 'positive', 231, 0, '<p>normal&nbsp;</p>', 1, 0, 0, 0),
(43, NULL, '', 0, '7', 0, 0, '00:00:00', '00:00:00', 'pos', 273, 0, '', 1, 0, 0, 0),
(44, NULL, '', 0, '8', 0, 0, '00:00:00', '00:00:00', '14', 273, 0, '', 1, 0, 0, 0),
(45, NULL, '', 0, '12', 0, 0, '00:00:00', '00:00:00', ' nps', 273, 0, '', 1, 0, 0, 0),
(46, NULL, '', 0, '16', 0, 0, '00:00:00', '00:00:00', '450', 273, 0, '', 1, 0, 0, 0),
(47, NULL, '', 0, '5', 0, 0, '00:00:00', '00:00:00', '30mmhg/30min', 276, 0, '<p>stool sample not collected</p>', 1, 0, 0, 0),
(48, NULL, '', 0, '6', 0, 0, '00:00:00', '00:00:00', '14.5g/dl', 276, 0, '<p>stool sample not collected</p>', 1, 0, 0, 0),
(49, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', '', 276, 0, '<p>stool sample not collected</p>', 1, 0, 0, 0),
(50, NULL, '', 0, '5', 0, 0, '00:00:00', '00:00:00', '30mmhg/30min', 280, 0, '<p>Stool sample not collected.</p>', 1, 0, 0, 0),
(51, NULL, '', 0, '6', 0, 0, '00:00:00', '00:00:00', '14.5g/dl', 280, 0, '<p>Stool sample not collected.</p>', 1, 0, 0, 0),
(52, NULL, '', 0, '14', 0, 0, '00:00:00', '00:00:00', '', 280, 0, '<p>Stool sample not collected.</p>', 1, 0, 0, 0),
(53, NULL, '', 0, '4', 0, 0, '00:00:00', '00:00:00', '0.4', 311, 0, '<p>these are results</p>', 1, 0, 0, 0),
(54, NULL, '', 0, '7', 0, 0, '00:00:00', '00:00:00', 'null', 311, 0, '<p>these are results</p>', 1, 0, 0, 0),
(55, NULL, '', 0, '61', 0, 42, '14:30:00', '14:36:00', '1', 335, 0, '<p>the patient is reacting</p>', 1, 1692877093, 167, 0),
(56, 'SICKEL CELL TEST TO  DETERMINE THE PATIENT STATUS', '', 0, '62', 0, 43, '12:30:00', '12:36:00', '4', 339, 0, '<p>The patient has problem in generating enough blood due to less cell but he has no sickel cell.</p>', 1, 1693042659, 167, 214),
(57, 'BLOOD GROUPING OF PATIENT', '', 0, '63', 5, 44, '08:05:00', '08:15:00', '5', 343, 0, '<p>That is what has been found.&nbsp;</p>', 1, 1693285924, 167, 214),
(58, 'Hemoglobin(HB) TEST EXAMINATION', '', 0, '64', 2, 44, '08:14:00', '20:16:00', '18', 343, 0, '', 1, 1693286394, 167, 214),
(59, 'well done ', '', 0, '63', 5, 45, '12:07:00', '12:13:00', '7', 347, 0, '<p>well done</p>', 1, 1693291203, 167, 0),
(60, 'Testing Edited', '', 0, '64', 2, 45, '11:01:00', '11:45:00', '12', 347, 0, '<p>Test completed</p>', 1, 1693291787, 167, 214),
(61, 'NEW REPORT ', '12', 0, '58', 5, 38, '12:00:00', '12:30:00', '12', 322, 0, '<p>WELL DONE</p>', 1, 1693327276, 167, 0);

-- --------------------------------------------------------

--
-- Table structure for table `labreportsubtype`
--

CREATE TABLE `labreportsubtype` (
  `labsubtype_id` int(11) NOT NULL,
  `labreport_id` int(11) NOT NULL,
  `subtype_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `results` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `labunits`
--

CREATE TABLE `labunits` (
  `measurement_id` int(11) NOT NULL,
  `measurement` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labunits`
--

INSERT INTO `labunits` (`measurement_id`, `measurement`, `status`) VALUES
(1, 'btee', 0),
(2, 'g/dl', 1),
(3, 'mg/dl', 1),
(4, 'mmol/dl', 1),
(5, 'fl', 1),
(6, 'pg', 1),
(7, 'mm/30min', 1),
(8, 'Positive/negative', 0),
(9, '(Technician input)', 1),
(10, 'mm/hr', 1),
(11, '/sec', 1),
(12, '/200WBC', 1),
(13, '/HPF', 1),
(14, 'mmol/L', 1),
(15, 'Reactive/Non-reactive', 0),
(16, 'A POS', 1),
(17, 'B POS', 1),
(18, '10^g/L', 1),
(19, '%', 1),
(20, '10^12/L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicalcase`
--

CREATE TABLE `medicalcase` (
  `medicalcase_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `progress` text NOT NULL,
  `treatment` text NOT NULL,
  `diet` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalcase`
--

INSERT INTO `medicalcase` (`medicalcase_id`, `admitted_id`, `date`, `progress`, `treatment`, `diet`, `admin_id`, `status`) VALUES
(1, 3, 1690232400, 'Progressing well', 'done', 'done', 166, 1),
(2, 4, 1690405200, 'finer', 'dawa', 'good', 166, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicalservices`
--

CREATE TABLE `medicalservices` (
  `medicalservice_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `medicalservice` varchar(200) NOT NULL,
  `clinic` int(11) DEFAULT NULL,
  `clinictype` int(11) DEFAULT NULL,
  `charge` int(11) NOT NULL,
  `creditprice` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalservices`
--

INSERT INTO `medicalservices` (`medicalservice_id`, `section_id`, `medicalservice`, `clinic`, `clinictype`, `charge`, `creditprice`, `status`) VALUES
(1339, 18, 'Examination form', NULL, NULL, 10000, NULL, 0),
(1338, 29, 'Incision and drainage', NULL, NULL, 20000, NULL, 0),
(1337, 29, 'IV injection', NULL, NULL, 1500, NULL, 0),
(1336, 29, 'IM injection', NULL, NULL, 1500, NULL, 1),
(1335, 24, 'Delivery', NULL, NULL, 35000, NULL, 0),
(1334, 29, 'Operation', NULL, NULL, 450000, NULL, 1),
(1333, 30, 'Weighing', NULL, NULL, 2000, NULL, 0),
(1332, 30, 'Postnatal care', NULL, NULL, 2000, NULL, 0),
(1331, 30, 'Antenatal mother care', NULL, NULL, 2000, NULL, 0),
(1330, 30, 'Weighing', NULL, NULL, 2000, NULL, 0),
(1329, 30, 'Vaccination', NULL, NULL, 0, NULL, 0),
(1328, 30, 'IUCD removal', NULL, NULL, 10000, NULL, 0),
(1327, 30, 'IUCD insertion', NULL, NULL, 10000, NULL, 0),
(1326, 30, 'Implanon removal', NULL, NULL, 10000, NULL, 0),
(1325, 30, 'Implanon insertion', NULL, NULL, 10000, NULL, 0),
(1324, 30, 'HB test', NULL, NULL, 3000, NULL, 0),
(1323, 30, 'Urinarisis', NULL, NULL, 2000, NULL, 0),
(1322, 30, 'Consultation (New attendance)', NULL, NULL, 2000, NULL, 0),
(1321, 25, 'Vital scene', NULL, NULL, 0, NULL, 0),
(1320, 18, 'Consultation (Revisit)', NULL, NULL, 3000, NULL, 0),
(1319, 18, 'Consultation (New attendance)', NULL, NULL, 5000, NULL, 0),
(1318, 18, 'Consultation (New attendance)', NULL, NULL, 5000, NULL, 0),
(1317, 22, 'test 2', NULL, NULL, 9000, NULL, 0),
(1316, 22, 'test 2', NULL, NULL, 9000, NULL, 0),
(1315, 22, 'test 2', NULL, NULL, 9000, NULL, 0),
(1314, 22, 'test 2', NULL, NULL, 9000, NULL, 0),
(1313, 26, 'test1', NULL, NULL, 500, NULL, 0),
(1312, 18, 'Consultation (New attendance)', NULL, NULL, 5000, NULL, 0),
(1340, 29, 'ADRENALINE NASAL PACK', NULL, NULL, 2000, 2000, 1),
(1341, 29, 'CARTON DRIP', NULL, NULL, 50000, 50000, 1),
(1342, 29, 'TEST Medical Consultation', NULL, NULL, 5000, 5000, 1),
(1343, 29, 'TEST Vital Sign Measurements', NULL, NULL, 1000, 1000, 1),
(1344, 28, 'TEST Urine', NULL, NULL, 2000, 2500, 0),
(1345, 28, 'TEST Malaria', NULL, NULL, 2000, 2500, 0),
(1346, 28, 'Brucella', NULL, NULL, 10000, 10000, 0),
(1347, 28, 'Blood Smear for malaria', NULL, NULL, 2000, 2000, 0),
(1348, 28, 'MRDT', NULL, NULL, 2000, 2000, 0),
(1349, 28, 'Uric Acid', NULL, NULL, 10000, 10000, 0),
(1350, 28, 'H.pylori Stool Ag', NULL, NULL, 7000, 7000, 0),
(1351, 29, 'stoolanalysis', NULL, NULL, 2000, 2000, 1),
(1352, 28, 'urinalysis', NULL, NULL, 2000, 2000, 0),
(1353, 28, 'ESR', NULL, NULL, 3000, 3000, 0),
(1354, 28, 'FBP', NULL, NULL, 15000, 15000, 0),
(1355, 28, 'RPR', NULL, NULL, 4000, 4000, 0),
(1356, 28, 'Hb', NULL, NULL, 4000, 4000, 0),
(1357, 28, 'RBG', NULL, NULL, 3000, 3000, 0),
(1358, 28, 'FBG', NULL, NULL, 3000, 3000, 0),
(1359, 28, 'B.Grouping and xmatch', NULL, NULL, 10000, 10000, 0),
(1360, 28, 'UPT', NULL, NULL, 3000, 3000, 0),
(1361, 29, 'consultation', NULL, NULL, 5000, 5000, 1),
(1362, 29, 'Test Service', NULL, NULL, 5000, 6000, 1),
(1363, 26, 'Registration Fee', NULL, NULL, 1200, 1500, 2),
(1364, 29, 'Dressing', NULL, NULL, 3000, 5000, 1),
(1365, 32, 'Contraception', 1, 1, 0, 0, 1),
(1366, 32, 'Vaccination', 1, 1, 0, 0, 1),
(1367, 32, 'HIV Care', 1, 1, 0, 0, 1),
(1368, 32, 'Pills', 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

CREATE TABLE `minor` (
  `minor_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `casetype` text CHARACTER SET utf8mb4 NOT NULL,
  `details` text NOT NULL,
  `clinic` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `noninsuredservices`
--

CREATE TABLE `noninsuredservices` (
  `noninsuredservice_id` int(11) NOT NULL,
  `medicalservice_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurseordereditems`
--

CREATE TABLE `nurseordereditems` (
  `nurseordereditem_id` int(11) NOT NULL,
  `nurseorder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitprice` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurseorders`
--

CREATE TABLE `nurseorders` (
  `nurseorder_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nursereports`
--

CREATE TABLE `nursereports` (
  `nursereport_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `measurement` varchar(100) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nursereports`
--

INSERT INTO `nursereports` (`nursereport_id`, `type`, `measurement`, `patientsque_id`, `details`, `status`) VALUES
(5, 'Weight', '55', 201, '<p>anamkono mmoja</p>\r\n', 1),
(6, 'height', '23', 201, '<p>anamkono mmoja</p>\r\n', 1),
(7, '', '', 203, '<p>ametolewa nyuzi</p>\r\n', 1),
(8, 'BP', '102', 216, '<p>very sick</p>\r\n', 1),
(9, 'Weight', '102', 216, '<p>very sick</p>\r\n', 1),
(10, 'Weight', '55', 218, '', 1),
(11, 'Weight', '55', 252, '<p>uzito ni 55kg tu</p>\r\n', 1),
(12, '', '', 220, '', 1),
(13, 'Weight', '55', 259, '', 1),
(14, 'BP', '120/50mmHg', 262, '<p>Needs to execirse more</p>\r\n', 1),
(15, 'Weight', '23', 262, '<p>Needs to execirse more</p>\r\n', 1),
(16, 'weight', '57', 264, '<p>good weight</p>\r\n', 1),
(17, '', '', 289, '<p>stitching come after one wk</p>\r\n', 1),
(18, '', '', 289, '<p>stitching</p>\r\n', 1),
(19, 'Weight', '55', 297, '<p>weefdsads</p>\r\n', 1),
(20, 'height', '6ft', 297, '<p>weefdsads</p>\r\n', 1),
(21, 'Weight', '55', 299, '<p>normal</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nursingsheetmedications`
--

CREATE TABLE `nursingsheetmedications` (
  `nursingsheetmedication_id` int(11) NOT NULL,
  `nursingsheet_id` int(11) NOT NULL,
  `medication` varchar(100) NOT NULL,
  `consumption` varchar(1000) NOT NULL,
  `frequency` text,
  `admissionroot` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nursingsheetmedications`
--

INSERT INTO `nursingsheetmedications` (`nursingsheetmedication_id`, `nursingsheet_id`, `medication`, `consumption`, `frequency`, `admissionroot`, `status`) VALUES
(1, 1, '110', '18', '1', 'Oral', 1),
(2, 2, '100', '12', '12', '  IVD', 1),
(3, 3, '101', '12', '2', 'Oral', 1),
(4, 4, '100', '18', '3', 'Oral', 1),
(5, 5, '45', '18', '3', 'Oral', 1),
(6, 6, '100', '1', '1', 'Oral', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nursingsheets`
--

CREATE TABLE `nursingsheets` (
  `nursingsheet_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nursingsheets`
--

INSERT INTO `nursingsheets` (`nursingsheet_id`, `admitted_id`, `date`, `time`, `admin_id`, `status`) VALUES
(1, 1, 1690146000, 'Evening', 166, 1),
(2, 3, 1690232400, 'Morning', 166, 1),
(3, 4, 1690405200, 'Morning', 166, 1),
(4, 3, 1690405200, 'Noon', 166, 1),
(5, 3, 1690405200, 'Morning', 166, 1),
(6, 6, 1690405200, 'Evening', 166, 1);

-- --------------------------------------------------------

--
-- Table structure for table `observationsheets`
--

CREATE TABLE `observationsheets` (
  `observation_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `bp` varchar(500) DEFAULT NULL,
  `t` varchar(255) DEFAULT NULL,
  `p` varchar(255) DEFAULT NULL,
  `r` varchar(255) DEFAULT NULL,
  `fluid` varchar(255) DEFAULT NULL,
  `oral` varchar(255) DEFAULT NULL,
  `iv` varchar(255) DEFAULT NULL,
  `tot` varchar(255) DEFAULT NULL,
  `urine` varchar(255) NOT NULL,
  `vomit` varchar(255) DEFAULT NULL,
  `aspirate` varchar(255) DEFAULT NULL,
  `total2` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationsheets`
--

INSERT INTO `observationsheets` (`observation_id`, `admitted_id`, `date`, `time`, `bp`, `t`, `p`, `r`, `fluid`, `oral`, `iv`, `tot`, `urine`, `vomit`, `aspirate`, `total2`, `balance`, `admin_id`, `status`) VALUES
(1, 3, '2023-07-25', '12:00:00', '34', '4', '44', '444', 'ttt', 't', '4', '44', '44', '44', '44454', '545', '5454', 166, 1),
(2, 4, '2023-07-27', '00:00:00', 'high', '', '', '', 'black', '', '', '', '', '', '', '', '', 166, 1),
(3, 6, '2023-07-27', '00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', 166, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obstetrics`
--

CREATE TABLE `obstetrics` (
  `obstetric_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(4) NOT NULL,
  `entrymode` varchar(200) NOT NULL,
  `ptme` varchar(1000) NOT NULL,
  `exitdate` int(11) NOT NULL,
  `exittime` varchar(10) NOT NULL,
  `exitmode` varchar(200) NOT NULL,
  `authorizedexitmode` varchar(200) NOT NULL,
  `diagnosiscode` varchar(10) NOT NULL,
  `diagnosis` varchar(200) NOT NULL,
  `context` varchar(1000) NOT NULL,
  `postprocedureinfection` varchar(4) NOT NULL,
  `paymentmethod` int(11) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `operation_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `anareport_id` int(11) NOT NULL,
  `anareport2_id` int(11) DEFAULT NULL,
  `anesthesiologist` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordereditems`
--

CREATE TABLE `ordereditems` (
  `ordereditem_id` int(11) NOT NULL,
  `stockorder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `cpfigure` varchar(200) DEFAULT NULL,
  `issued` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordereditems`
--

INSERT INTO `ordereditems` (`ordereditem_id`, `stockorder_id`, `item_id`, `quantity`, `section`, `cpfigure`, `issued`, `status`) VALUES
(1, 1, 100, 100, 'pharmacy', NULL, NULL, NULL),
(2, 1, 87, 10, 'pharmacy', NULL, NULL, NULL),
(3, 1, 45, 50, 'pharmacy', NULL, NULL, NULL),
(4, 2, 100, 10, 'pharmacy', NULL, NULL, NULL),
(5, 3, 100, 50, 'pharmacy', NULL, NULL, NULL),
(6, 3, 45, 5, 'pharmacy', NULL, NULL, NULL),
(7, 3, 87, 5, 'pharmacy', NULL, NULL, NULL),
(8, 4, 179, 2, 'doctor', NULL, NULL, NULL),
(9, 4, 183, 2, 'doctor', NULL, NULL, NULL),
(10, 5, 100, 2, 'nurse', NULL, NULL, NULL),
(11, 5, 44, 1, 'nurse', NULL, NULL, NULL),
(12, 5, 87, 2, 'nurse', NULL, NULL, NULL),
(13, 6, 130, 2, 'nurse', NULL, NULL, NULL),
(14, 6, 100, 10, 'nurse', NULL, NULL, NULL),
(15, 7, 101, 10, 'nurse', NULL, NULL, NULL),
(16, 7, 179, 10, 'nurse', NULL, NULL, NULL),
(17, 7, 183, 10, 'nurse', NULL, NULL, NULL),
(18, 7, 232, 10, 'nurse', NULL, NULL, NULL),
(19, 8, 237, 5, 'lab', NULL, NULL, NULL),
(20, 8, 238, 10, 'lab', NULL, NULL, NULL),
(21, 8, 236, 15, 'lab', NULL, NULL, NULL),
(22, 9, 244, 1, 'pharmacy', NULL, NULL, NULL),
(23, 9, 241, 5, 'pharmacy', NULL, NULL, NULL),
(24, 9, 242, 5, 'pharmacy', NULL, NULL, NULL),
(25, 9, 240, 3, 'pharmacy', NULL, NULL, NULL),
(26, 10, 100, 20, 'pharmacy', NULL, NULL, NULL),
(27, 10, 45, 20, 'pharmacy', NULL, NULL, NULL),
(28, 10, 87, 20, 'pharmacy', NULL, NULL, NULL),
(29, 0, 244, 5, 'nurse', NULL, NULL, NULL),
(30, 0, 101, 90, 'nurse', NULL, NULL, NULL),
(31, 11, 101, 10, 'nurse', NULL, NULL, NULL),
(32, 11, 179, 10, 'nurse', NULL, NULL, NULL),
(33, 11, 183, 10, 'nurse', NULL, NULL, NULL),
(34, 0, 101, 5, 'nurse', NULL, NULL, NULL),
(35, 0, 179, 5, 'nurse', NULL, NULL, NULL),
(36, 0, 183, 100, 'nurse', NULL, NULL, NULL),
(37, 12, 101, 10, 'lab', NULL, NULL, NULL),
(38, 12, 179, 34, 'lab', NULL, NULL, NULL),
(39, 12, 183, 5, 'lab', NULL, NULL, NULL),
(40, 12, 232, 32, 'lab', NULL, NULL, NULL),
(41, 13, 250, -2, 'lab', NULL, NULL, NULL),
(42, 14, 239, 23, 'lab', NULL, NULL, NULL),
(43, 14, 237, 2, 'lab', NULL, NULL, NULL),
(44, 14, 238, 3, 'lab', NULL, NULL, NULL),
(45, 14, 236, 5, 'lab', NULL, NULL, NULL),
(46, 15, 100, 1000, 'pharmacy', NULL, NULL, NULL),
(47, 16, 100, 1900, 'pharmacy', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patienthistory`
--

CREATE TABLE `patienthistory` (
  `patient_history_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `patientque_id` int(11) NOT NULL,
  `admitted_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `timestamp` int(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patienthistory`
--

INSERT INTO `patienthistory` (`patient_history_id`, `admission_id`, `patient_id`, `patientque_id`, `admitted_id`, `status`, `timestamp`, `admin_id`) VALUES
(1, 25, 18, 268, 0, 1, 0, 163),
(2, 35, 18, 310, 0, 1, 0, 163),
(3, 20, 15, 245, 0, 1, 0, 163),
(4, 34, 8, 308, 0, 1, 0, 163),
(5, 23, 10, 261, 0, 1, 0, 163),
(6, 16, 12, 207, 0, 1, 0, 163),
(7, 40, 10, 328, 0, 1, 0, 163),
(8, 30, 2, 302, 0, 1, 0, 163),
(9, 42, 2, 334, 0, 1, 0, 163),
(10, 17, 13, 215, 0, 1, 0, 163),
(11, 41, 10, 331, 0, 1, 0, 163);

-- --------------------------------------------------------

--
-- Table structure for table `patientlabs`
--

CREATE TABLE `patientlabs` (
  `patientlab_id` int(11) NOT NULL,
  `laborder_id` int(11) NOT NULL,
  `investigationtype_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientlabs`
--

INSERT INTO `patientlabs` (`patientlab_id`, `laborder_id`, `investigationtype_id`, `charge`, `status`) VALUES
(37, 31, 7, 3000, 1),
(38, 32, 12, 2000, 1),
(39, 33, 14, 2000, 1),
(40, 33, 16, 10000, 1),
(41, 34, 14, 2000, 1),
(42, 34, 16, 10000, 1),
(43, 35, 6, 2000, 1),
(44, 35, 13, 2000, 1),
(45, 35, 14, 2000, 1),
(46, 36, 13, 2000, 1),
(47, 37, 13, 2000, 1),
(48, 37, 14, 2000, 1),
(49, 37, 16, 5000, 1),
(50, 38, 13, 2000, 1),
(51, 39, 52, 30000, 1),
(52, 40, 16, 10000, 1),
(53, 40, 45, 10000, 1),
(54, 41, 22, 15000, 1),
(55, 42, 6, 4000, 1),
(56, 43, 6, 4000, 1),
(57, 44, 6, 4000, 1),
(58, 45, 6, 4000, 1),
(59, 46, 6, 4000, 1),
(60, 47, 26, 15000, 1),
(61, 48, 44, 0, 1),
(62, 49, 6, 4000, 1),
(63, 49, 14, 2000, 1),
(64, 50, 7, 3000, 1),
(65, 50, 8, 10000, 1),
(66, 50, 12, 2000, 1),
(67, 50, 16, 10000, 1),
(68, 51, 5, 3000, 1),
(69, 51, 6, 2000, 1),
(70, 51, 14, 2000, 1),
(71, 52, 5, 3000, 1),
(72, 52, 6, 2000, 1),
(73, 52, 14, 2000, 1),
(74, 53, 7, 3000, 1),
(75, 53, 23, 20000, 1),
(76, 53, 32, 20000, 1),
(77, 54, 4, 3000, 1),
(78, 54, 6, 2000, 1),
(79, 54, 7, 1500, 1),
(80, 54, 13, 2000, 1),
(81, 55, 4, 3000, 1),
(82, 55, 7, 1500, 1),
(83, 57, 58, 10000, 1),
(84, 57, 61, 10000, 1),
(85, 58, 7, 3000, 1),
(86, 59, 58, 10000, 3),
(87, 59, 61, 10000, 1),
(88, 60, 39, 1900, 1),
(89, 60, 61, 10000, 1),
(90, 61, 60, 0, 1),
(91, 61, 61, 10000, 3),
(92, 62, 62, 5000, 3),
(93, 62, 63, 5000, 1),
(94, 62, 64, 5000, 1),
(95, 63, 63, 5000, 3),
(96, 63, 64, 5000, 3),
(97, 64, 63, 5000, 3),
(98, 64, 64, 5000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `patientradios`
--

CREATE TABLE `patientradios` (
  `patientradio_id` int(11) NOT NULL,
  `radioorder_id` int(11) NOT NULL,
  `radioinvestigationtype_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientradios`
--

INSERT INTO `patientradios` (`patientradio_id`, `radioorder_id`, `radioinvestigationtype_id`, `charge`, `status`) VALUES
(7, 18, 1, 3000, 1),
(8, 18, 2, 3000, 1),
(9, 19, 2, 0, 1),
(10, 19, 3, 0, 1),
(11, 20, 2, 2000, 1),
(12, 21, 1, 10000, 1),
(13, 21, 4, 10000, 1),
(14, 22, 1, 10000, 1),
(15, 22, 2, 10000, 1),
(16, 23, 2, 15000, 1),
(17, 24, 2, 0, 1),
(18, 24, 3, 0, 1),
(19, 25, 4, 15000, 1),
(20, 26, 2, 15000, 1),
(21, 27, 3, 20000, 1),
(22, 28, 2, 15000, 1),
(23, 29, 3, 0, 1),
(24, 30, 1, 0, 1),
(25, 31, 2, 15000, 1),
(26, 32, 2, 15000, 1),
(27, 33, 1, 15000, 1),
(28, 34, 3, 15000, 1),
(29, 35, 1, 15000, 2),
(30, 36, 1, 20000, 3),
(31, 37, 1, 20000, 3),
(32, 37, 2, 15000, 3),
(33, 39, 1, 15000, 2),
(34, 39, 4, 15000, 2),
(35, 40, 1, 15000, 3),
(36, 40, 2, 15000, 2),
(37, 41, 3, 30000, 2),
(38, 42, 2, 15000, 2),
(39, 43, 1, 15000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `secondname` varchar(200) NOT NULL,
  `thirdname` varchar(200) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `maritalstatus` varchar(20) NOT NULL,
  `spousename` varchar(50) NOT NULL,
  `spousephone` varchar(50) NOT NULL,
  `spouseaddress` varchar(200) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `employmentstatus` varchar(50) NOT NULL,
  `employername` varchar(100) NOT NULL,
  `employeraddress` varchar(100) NOT NULL,
  `employernumber` varchar(50) NOT NULL,
  `emergencyname` varchar(100) NOT NULL,
  `emergencyrelationship` varchar(50) NOT NULL,
  `emergencyphone` varchar(50) NOT NULL,
  `emergencyaddress` varchar(100) NOT NULL,
  `paymenttype` varchar(50) NOT NULL,
  `creditclient` varchar(50) NOT NULL,
  `insurancecompany` varchar(50) NOT NULL,
  `subscribername` varchar(100) NOT NULL,
  `socialsecuritynumber` varchar(100) NOT NULL,
  `policyidnumber` varchar(100) NOT NULL,
  `insuranceemployer` varchar(100) NOT NULL,
  `insurancedob` varchar(50) NOT NULL,
  `insurancecardext` varchar(4) NOT NULL,
  `secondarysubscribername` varchar(100) NOT NULL,
  `vote` varchar(120) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `maximum_coverage` varchar(255) DEFAULT NULL,
  `subscriptiontype` varchar(50) DEFAULT NULL,
  `primary_name` varchar(255) DEFAULT NULL,
  `primary_org` varchar(255) DEFAULT NULL,
  `primary_relationship` varchar(255) DEFAULT NULL,
  `patientrelation` varchar(100) NOT NULL,
  `workphone` varchar(50) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `temp` varchar(225) DEFAULT NULL,
  `bp` varchar(22) DEFAULT NULL,
  `height` varchar(10) NOT NULL,
  `allergies` varchar(200) NOT NULL,
  `diseases` varchar(200) NOT NULL,
  `pregnancies` varchar(11) NOT NULL,
  `smoke` varchar(3) NOT NULL,
  `drink` varchar(3) NOT NULL,
  `druguse` varchar(3) NOT NULL,
  `drugtypes` varchar(200) NOT NULL,
  `exercise` varchar(3) NOT NULL,
  `specialdiet` varchar(3) NOT NULL,
  `activities` varchar(500) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `docext` varchar(4) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `primary_contact` varchar(255) DEFAULT NULL,
  `clinic` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `firstname`, `secondname`, `thirdname`, `gender`, `dob`, `maritalstatus`, `spousename`, `spousephone`, `spouseaddress`, `religion`, `occupation`, `phone`, `address`, `email`, `employmentstatus`, `employername`, `employeraddress`, `employernumber`, `emergencyname`, `emergencyrelationship`, `emergencyphone`, `emergencyaddress`, `paymenttype`, `creditclient`, `insurancecompany`, `subscribername`, `socialsecuritynumber`, `policyidnumber`, `insuranceemployer`, `insurancedob`, `insurancecardext`, `secondarysubscribername`, `vote`, `contact`, `maximum_coverage`, `subscriptiontype`, `primary_name`, `primary_org`, `primary_relationship`, `patientrelation`, `workphone`, `bloodgroup`, `weight`, `temp`, `bp`, `height`, `allergies`, `diseases`, `pregnancies`, `smoke`, `drink`, `druguse`, `drugtypes`, `exercise`, `specialdiet`, `activities`, `ext`, `docext`, `admin_id`, `timestamp`, `level`, `status`, `primary_contact`, `clinic`) VALUES
(1, 'CATHERINE', 'CHARLES', 'GEORGE', 'Female', '886539600', '', '', '', '', '', 'farmer', '0656800268', 'MACHINJIONI', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 190, 1684155412, 4, '0', NULL, 0),
(2, 'MISHERI', 'CHRISTIAN', '', 'Female', '1598216400', '', '', '', '', '', 'CHILD', '0762399259', 'NYAMADOKE', '', 'Full time', 'Munoclub', '', '123456', '', '', '', '', 'credit', '3', '18', '', '', '23456', '', '', '', '', NULL, '07895684583', '2000000', 'primary', '', '', '', '', '', 'O', '80', NULL, NULL, '123', 'Allergic to mazie', 'Null', '', '', '', '', '', '', '', '', '', '', 190, 1684156175, 2, '1', '', 0),
(3, 'CATHERINR', 'CHARLES', 'GEORGE', 'Female', '894920400', '', '', '', '', '', 'STUDENT', '0656800268', 'MACHINJIONI', '', '', '', '', '', '', '', '', '', 'credit', '4', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 190, 1684156835, 4, '3', NULL, 0),
(4, 'test1', 'patient', '', 'Male', '740782800', '', '', '', '', '', 'accountant', '0700123456', 'Kiseke Sokoni', '', 'Full time', '', '', 'Ufanisi Africa', 'relative test1', 'Cousin', '0600123456', 'Bwiru', 'insurance', '', '23', '', '', '09287636', '', '', '', '', NULL, '', '1000000', 'primary', '', '', '', '', '', 'A-', '46', NULL, NULL, '1.62', 'No', 'No', '', '', '', '', '', '', '', '', '', '', 163, 1684157673, 2, '1', '', 0),
(5, 'Ufanisi', 'Patient', '', 'Female', '769122000', '', '', '', '', '', 'accountant', '0784000000', 'Ilemela', '', 'Full time', 'Nyakahoja', '', '0732000000', 'Ufanisi Relative', 'Brother', '0753000000', 'Kisesa', 'credit', '4', '19', '', '', '09386483753', '', '', '', '', NULL, '', '', 'primary', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1686999837, 4, '3', '', 0),
(6, 'Kahunde', 'ELIz', '', 'Female', '', '', '', '', '', '', 'DOctor', '256893938929', 'Entebbe', '', '', '', '', '', 'James', 'Brother', '25678948583', 'Nakawa', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'O', '78', NULL, NULL, '233', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1687458040, 2, '1', NULL, 0),
(7, 'Test2', 'Patient', '', 'Male', '736549200', '', '', '', '', '', 'Driver', '0784083864', 'Ghana', '', '', '', '', '', 'relative2 patient', 'brother', '0783874753', 'Kisesa', 'insurance', '', '18', '', '', '094874656538', '', '', '', '', NULL, '', '', 'primary', '', 'Lake Oil', 'procurement officer', '', '', 'B-', '54', NULL, NULL, '1.52', 'NO', 'NO', '', '', '', '', '', '', '', '', '', '', 163, 1687498488, 2, '1', '0788386584', 0),
(8, 'test3', 'patient', '', 'Female', '438469200', '', '', '', '', '', 'nurse', '0745238745', 'Isamilo', '', '', '', '', '', 'Jesca Magambo', 'sister', '0785983865', 'Nyegezi', 'insurance', '', '24', '', '', '094874654', '', '', '', '', NULL, '', '', 'primary', '', 'ABM Africultural Agency', 'Cashier', '', '', 'A-', '65', NULL, NULL, '1.48', 'Meat', 'no', '2', '', '', '', '', '', '', '', '', '', 163, 1687499715, 2, '1', '0784764635', 0),
(9, 'DEMO', 'TEST', '1', 'Male', '942958800', '', '', '', '', '', 'ENGINEER', '0745224876', 'NYAKATO', '', '', '', '', '', '', '', '', '', 'insurance', '', '19', '', '', '1273647237', '', '', '', '', NULL, '', '', 'secondary', 'CHILD', '', '', '', '', 'B+', '56', NULL, NULL, '4', '', '', '', '', '', '', '', '', '', '', '', '', 184, 1689969375, 2, '1', '', 0),
(10, 'DEMO', 'GUEST', '2', 'Male', '879282000', '', '', '', '', '', 'FARMER', '0783245676', 'BUTIMBA', '', '', '', '', '', '', '', '', '', 'insurance', '', '19', '', '', '763456789', '', '', '', '', NULL, '', '', 'secondary', 'CHILD', '', '', '', '', '0+', '79', NULL, NULL, '4', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690006295, 2, '1', '', 0),
(11, 'GUEST', 'DEMO', 'CLIENT', 'Male', '724021200', '', '', '', '', '', 'BUSINESS MAN', '0783456754', 'MTWARA', '', '', '', '', '', '', '', '', '', 'insurance', '', '19', '', '', '1234532', '', '', '', '', NULL, '', '', 'secondary', 'CHILD', '', '', '', '', 'A+', '60', NULL, NULL, '12', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690211528, 2, '1', '', 0),
(12, 'HAIKA', 'BARIKI', 'SAM', 'Female', '942958800', '', '', '', '', '', 'PHARMACIST', '0743125674', 'DODOMA', '', '', '', '', '', '', '', '', '', 'insurance', '2', '27', '', '', '12321234', '', '', '', '', NULL, '', '', 'secondary', 'DAUGHTER', '', '', '', '', 'A+', '75', NULL, NULL, '4', 'KITIMOTO', '', '', '', '', '', '', '', '', '', '', '', 163, 1690223343, 2, '1', '', 0),
(13, 'AAA', 'BBB', 'CCC', 'Male', '944946000', '', '', '', '', '', 'MVUVI', '0675846567', 'KIGOMA', '', '', '', '', '', '', '', '', '', 'credit', '3', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'AB', '60', NULL, NULL, '6', 'NYAMA', '', '', '', '', '', '', '', '', '', '', '', 163, 1690263995, 2, '1', NULL, 0),
(14, 'SALIM', 'OMARY', 'SEIF', 'Male', '866667600', '', '', '', '', '', 'ENTERPRENEUR', '0743565378', 'BUHONGWA', '', '', '', '', '', '', '', '', '', 'insurance', '', '27', '', '', '8765427327', '', '', '', '', NULL, '', '', 'primary', '', 'JWTZ', 'EMPLOYER', '', '', 'A+', '79', NULL, NULL, '12', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690400600, 2, '1', '0765678893', 0),
(15, 'JOHN', 'MOSES', 'SAM', 'Male', '905720400', '', '', '', '', '', 'DRIVER', '0623456724', 'MADUKA TISA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'AB', '79', NULL, NULL, '6', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690400940, 2, '1', NULL, 0),
(16, 'ANGEL', 'JACKSON', 'JUMA', 'Female', '973976400', '', '', '', '', '', 'TEACHER', '0714706703', 'MAHINA', '', '', '', '', '', 'MICHAEL', 'HUSBAND', '0786545638', 'MAHINA', 'insurance', '', '19', '', '', '1253185652', '', '', '', '', NULL, '', '', 'secondary', 'CHILD', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690401006, 4, '0', '', 0),
(17, 'RAMADHANI', 'ABUBAKARY', 'KHALID', 'Male', '986331600', '', '', '', '', '', 'STUDENT', '0787678712', 'NATIONAL', '', '', '', '', '', '', '', '', '', 'credit', '3', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'B+', '79', NULL, NULL, '5', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690401103, 2, '1', NULL, 0),
(18, 'ANGEL', 'JACKSON', '', 'Female', '1068757200', '', '', '', '', '', 'PHARMACIST', '0714706703', 'MAHINA', '', '', '', '', '', 'MICHAEL', 'HUSBAND', '0786545638', 'MAHINA', 'insurance', '', '19', '', '', '23434533453', '', '', '', '', NULL, '', '', 'secondary', 'wife', '', '', '', '', 'O', '75', NULL, NULL, '6', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690402087, 2, '1', '', 0),
(19, 'NEW', 'DEMO', 'PATIENT', 'Male', '907448400', '', '', '', '', '', 'accountant', '0737562788', 'nyakato', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690442228, 3, '1', NULL, 0),
(20, 'elizabeth', 'shemdoe', 'joram', 'Female', '1017867600', '', '', '', '', '', 'mkulima', '+255659406176', 'Mwanza', '', '', '', '', '', 'joram joh', 'baba', '+255659406176', 'Mwanza', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690444586, 4, '3', NULL, 0),
(21, 'mpoki', 'jafari', 'Ngomesi', 'Male', '577659600', '', '', '', '', '', 'ICT OFFICE', '0752011567', 'kangae', '', '', '', '', '', 'happy kabalila', 'wife', '0768062362', '423', 'insurance', '', '19', '', '', '101301740960', '', '', '', '', NULL, '', '', 'secondary', '', '', '', '', '', 'o', '64', NULL, NULL, '7', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690444730, 2, '1', '', 0),
(22, 'edward', 'mbwambo', 'daniel', 'Male', '604465200', '', '', '', '', '', 'doctor', '0743565378', 'mahina', '', '', '', '', '', 'magreth', 'wife', '0743565378', 'mahina', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690444736, 4, '3', NULL, 0),
(23, 'sophia', 'alphan', 'kimaro', 'Female', '883342800', '', '', '', '', '', 'pharmacy', '0743418207', 'igoma', '', '', '', '', '', 'saphina kimaro', 'mother', '0754999054', 'igoma', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690445189, 4, '3', NULL, 0),
(24, 'mangira', 'fyolo', 'mangira', 'Male', '949438800', '', '', '', '', '', 'mkulima', '+255659406176', 'buhongwa', '', '', '', '', '', 'joram joh', 'kaka', '+255659406176', 'Mwanza', 'insurance', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690445570, 4, '3', NULL, 0),
(25, 'aaaa', 'bbbb', 'cccc', 'Male', '942354000', '', '', '', '', '', 'FARMER', '0784121204', 'kiloleli', '', '', '', '', '', '', '', '', '', 'insurance', '', '19', '', '', '1234556', '', '', '', '', NULL, '', '', 'secondary', '', '', '', '', '', 'A+', '75', NULL, NULL, '4', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690447456, 2, '1', '', 0),
(26, 'biggie', 'jackson', 'skudu', 'Male', '939589200', '', '', '', '', '', 'Teacher', '0714706703', 'MAHINA', '', '', '', '', '', '', '', '', '', 'insurance', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1690536744, 3, '1', NULL, 0),
(27, 'Test', 'Clinic', '', 'Female', '681598800', '', 'Test Partner', '0788234567', '', '', 'Teacher', '0700111111', 'Igoma', '', '', '', '', '', 'Test Partner', 'Partner', '0788234567', 'Nyakato', 'insurance', '', '19', '', '', '093736310188383', '', '', '', '', '09823', '', '10000000', 'primary', '', 'Government', 'Teaching Staff', '', '', 'A+', '61', '32', '0.42', '1.6', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1692309646, 2, '1', '0626984764', 2),
(28, 'Test', 'Pregnant', '', 'Female', '', '', 'Test Husband', '0766000000', '', '', 'dsfgh', '0755000000', 'Meko', '', '', '', '', '', 'Test Husband', '', '0766000000', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', 163, 1693339333, 4, '3', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientservices`
--

CREATE TABLE `patientservices` (
  `patientservice_id` int(11) NOT NULL,
  `serviceorder_id` int(11) NOT NULL,
  `medicalservice_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientservices`
--

INSERT INTO `patientservices` (`patientservice_id`, `serviceorder_id`, `medicalservice_id`, `charge`, `status`) VALUES
(99, 67, 1340, 2000, 1),
(100, 67, 1351, 2000, 1),
(101, 68, 1361, 5000, 1),
(102, 69, 1361, 5000, 1),
(103, 69, 1343, 1000, 1),
(104, 70, 1361, 5000, 1),
(105, 71, 1361, 5000, 1),
(106, 72, 1361, 5000, 1),
(107, 73, 1361, 5000, 1),
(108, 74, 1361, 5000, 1),
(109, 75, 1343, 1000, 1),
(110, 76, 1361, 2000, 1),
(111, 77, 1361, 5000, 1),
(112, 78, 1361, 2000, 1),
(113, 79, 1361, 5000, 1),
(114, 79, 1342, 5000, 1),
(115, 80, 1364, 3000, 1),
(116, 81, 1364, 3000, 1),
(117, 82, 1361, 5000, 1),
(118, 82, 1343, 5000, 1),
(119, 83, 1361, 5000, 1),
(120, 84, 1343, 1000, 1),
(121, 85, 1343, 1000, 1),
(122, 86, 1343, 1000, 1),
(123, 87, 1361, 2000, 1),
(124, 88, 1361, 5000, 1),
(125, 89, 1361, 5000, 1),
(126, 89, 1342, 5000, 1),
(127, 89, 1362, 5000, 1),
(128, 90, 1361, 5000, 1),
(129, 90, 1364, 5000, 1),
(130, 91, 1343, 1000, 1),
(131, 92, 1364, 3000, 1),
(132, 92, 1334, 450000, 1),
(133, 92, 1343, 1000, 1),
(134, 93, 1361, 2000, 1),
(135, 94, 1343, 1000, 1),
(136, 95, 1343, 1000, 1),
(137, 96, 1361, 2000, 1),
(138, 97, 1361, 2000, 1),
(139, 98, 1361, 2000, 1),
(140, 99, 1362, 5000, 1),
(141, 100, 1361, 5000, 1),
(142, 101, 1361, 2000, 1),
(143, 102, 1364, 3000, 1),
(144, 103, 1364, 3000, 1),
(145, 103, 1334, 450000, 1),
(146, 104, 1343, 1000, 1),
(147, 105, 1364, 3000, 1),
(148, 105, 1334, 450000, 1),
(149, 106, 1343, 1000, 1),
(150, 107, 1361, 5000, 1),
(151, 108, 1361, 5000, 2),
(152, 108, 1342, 5000, 1),
(153, 109, 1361, 3000, 1),
(154, 110, 1368, 0, 1),
(155, 110, 1366, 0, 1),
(156, 111, 1361, 5000, 2),
(157, 112, 1361, 5000, 2),
(158, 113, 1361, 2000, 2),
(159, 114, 1361, 2000, 1),
(160, 115, 1361, 5000, 1),
(161, 116, 1361, 5000, 2),
(162, 117, 1361, 5000, 1),
(163, 118, 1361, 2000, 2),
(164, 119, 1361, 2000, 2),
(165, 120, 1361, 5000, 2),
(166, 121, 1361, 2000, 2),
(167, 122, 1361, 2000, 2),
(168, 123, 1361, 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patientsque`
--

CREATE TABLE `patientsque` (
  `patientsque_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `attendant` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `paymethod` varchar(255) NOT NULL DEFAULT 'cash',
  `admin_id` int(11) NOT NULL,
  `admintype` varchar(200) NOT NULL,
  `prev_id` int(11) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientsque`
--

INSERT INTO `patientsque` (`patientsque_id`, `admission_id`, `room`, `attendant`, `payment`, `paymethod`, `admin_id`, `admintype`, `prev_id`, `timestamp`, `status`) VALUES
(153, 1, 'nurse', 166, 1, 'insurance', 163, 'receptionist', NULL, 1686047230, 0),
(154, 2, 'doctor', 165, 1, 'insurance', 163, 'receptionist', NULL, 1686930190, 1),
(155, 2, 'lab', 167, 0, 'cash', 165, 'doctor', 154, 1686931575, 0),
(156, 2, 'lab', 167, 0, 'cash', 165, 'doctor', 154, 1686931779, 0),
(157, 2, 'lab', 167, 0, 'cash', 165, 'doctor', 154, 1687000774, 0),
(158, 2, 'radiography', 176, 0, 'cash', 165, 'doctor', 154, 1687000774, 0),
(159, 3, 'doctor', 165, 1, 'cash', 163, 'receptionist', NULL, 1687458439, 1),
(160, 3, 'radiography', 176, 1, 'cash', 165, 'doctor', 159, 1687458996, 1),
(161, 3, 'doctor', 176, 1, 'cash', 176, 'radiographer', 160, 1687459911, 0),
(162, 4, 'doctor', 165, 0, 'cash', 163, 'receptionist', NULL, 1687498767, 0),
(163, 5, 'doctor', 165, 0, 'cash', 163, 'receptionist', NULL, 1687500512, 0),
(164, 6, 'doctor', 165, 1, 'insurance', 163, 'receptionist', NULL, 1687769968, 1),
(165, 6, 'lab', 167, 1, 'insurance', 165, 'doctor', 164, 1687770575, 1),
(166, 6, 'radiography', 176, 1, 'insurance', 165, 'doctor', 164, 1687770575, 0),
(167, 7, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1687947856, 1),
(168, 7, 'lab', 0, 1, 'insurance', 165, 'doctor', 167, 1687948436, 1),
(169, 7, 'radiography', 0, 1, 'insurance', 165, 'doctor', 167, 1687948436, 1),
(170, 6, 'doctor', 165, 1, 'cash', 167, 'lab technician', 165, 1687949970, 0),
(171, 7, 'doctor', 165, 1, 'cash', 167, 'lab technician', 168, 1687950538, 0),
(172, 7, 'doctor', 0, 1, 'cash', 211, 'radiographer', 169, 1687954001, 0),
(173, 8, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1688362914, 1),
(174, 8, 'lab', 0, 1, 'insurance', 165, 'doctor', 173, 1688363761, 1),
(175, 8, 'radiography', 0, 1, 'insurance', 165, 'doctor', 173, 1688363761, 1),
(176, 8, 'doctor', 165, 1, 'cash', 167, 'lab technician', 174, 1688364791, 1),
(177, 8, 'doctor', 165, 1, 'cash', 211, 'radiographer', 175, 1688365279, 1),
(178, 9, 'nurse', 0, 1, 'insurance', 163, 'receptionist', NULL, 1688366634, 0),
(179, 10, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1690005643, 0),
(180, 11, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690006600, 1),
(181, 11, 'lab', 0, 1, 'insurance', 165, 'doctor', 180, 1690007402, 1),
(182, 11, 'radiography', 0, 1, 'insurance', 165, 'doctor', 180, 1690007402, 1),
(183, 11, 'doctor', 165, 1, 'cash', 167, 'lab technician', 181, 1690008147, 1),
(184, 11, 'doctor', 165, 1, 'cash', 211, 'radiographer', 182, 1690008252, 1),
(185, 11, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 180, 1690008436, 0),
(186, 11, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 180, 1690009646, 0),
(187, 11, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 180, 1690010392, 0),
(188, 12, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1690035367, 1),
(189, 12, 'radiography', 0, 1, 'cash', 165, 'doctor', 188, 1690035528, 1),
(190, 12, 'doctor', 165, 1, 'cash', 176, 'radiographer', 189, 1690035815, 1),
(191, 11, 'lab', 0, 1, 'insurance', 165, 'doctor', 180, 1690211245, 0),
(192, 11, 'radiography', 0, 1, 'insurance', 165, 'doctor', 180, 1690211245, 0),
(193, 13, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1690212011, 1),
(194, 13, 'lab', 0, 1, 'insurance', 165, 'doctor', 193, 1690212228, 1),
(207, 16, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690232077, 1),
(195, 13, 'radiography', 0, 1, 'insurance', 165, 'doctor', 193, 1690212228, 1),
(196, 13, 'doctor', 165, 1, 'cash', 167, 'lab technician', 194, 1690212369, 1),
(197, 13, 'doctor', 165, 1, 'cash', 211, 'radiographer', 195, 1690212438, 1),
(198, 13, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 193, 1690212655, 0),
(199, 11, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 180, 1690212806, 0),
(200, 13, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 193, 1690218968, 0),
(201, 14, 'nurse', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690222790, 1),
(202, 14, 'doctor', 163, 0, 'cash', 166, 'nurse', 201, 1690222906, 1),
(203, 15, 'nurse', 0, 1, 'cash', 163, 'receptionist', NULL, 1690226155, 1),
(204, 15, 'doctor', 163, 0, 'cash', 166, 'nurse', 203, 1690226341, 1),
(205, 13, 'nurse', 0, 1, 'cash', 165, 'doctor', 193, 1690226414, 0),
(206, 13, 'admission', 0, 0, 'cash', 165, 'doctor', 193, 1690226500, 0),
(208, 16, 'pharmacy', 0, 0, 'cash', 165, 'doctor', 207, 1690232681, 0),
(209, 16, 'lab', 0, 1, 'insurance', 165, 'doctor', 207, 1690232681, 1),
(210, 16, 'radiography', 0, 1, 'insurance', 165, 'doctor', 207, 1690232681, 1),
(211, 16, 'referral', 0, 0, 'cash', 165, 'doctor', 207, 1690232681, 0),
(212, 16, 'doctor', 165, 1, 'cash', 167, 'lab technician', 209, 1690232814, 1),
(213, 16, 'doctor', 165, 1, 'cash', 211, 'radiographer', 210, 1690233012, 1),
(214, 16, 'acts', 165, 0, 'cash', 165, 'doctor', 207, 1690233293, 0),
(215, 17, 'doctor', 0, 1, 'credit', 163, 'receptionist', NULL, 1690264275, 1),
(216, 17, 'nurse', 0, 1, 'credit', 165, 'doctor', 215, 1690273685, 1),
(217, 17, 'pharmacy', 0, 1, 'credit', 165, 'doctor', 215, 1690273685, 0),
(218, 17, 'nurse', 0, 1, 'credit', 165, 'doctor', 215, 1690273708, 1),
(219, 17, 'pharmacy', 0, 1, 'credit', 165, 'doctor', 215, 1690273708, 0),
(220, 17, 'nurse', 0, 1, 'credit', 165, 'doctor', 215, 1690273854, 1),
(221, 17, 'pharmacy', 0, 1, 'credit', 165, 'doctor', 215, 1690273854, 1),
(222, 17, 'doctor', 165, 0, 'cash', 166, 'nurse', 216, 1690274706, 1),
(223, 18, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690274915, 1),
(224, 18, 'lab', 0, 1, 'cash', 165, 'doctor', 223, 1690275033, 1),
(225, 17, 'doctor', 165, 0, 'cash', 166, 'nurse', 218, 1690277746, 1),
(226, 18, 'doctor', 165, 1, 'cash', 167, 'lab technician', 224, 1690277825, 1),
(227, 18, 'radiography', 0, 1, 'insurance', 165, 'doctor', 223, 1690281163, 0),
(228, 18, 'admission', 0, 0, 'cash', 165, 'doctor', 223, 1690281239, 0),
(229, 16, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 207, 1690281362, 1),
(230, 16, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 207, 1690281450, 1),
(231, 16, 'lab', 0, 1, 'insurance', 165, 'doctor', 207, 1690281646, 1),
(232, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690281889, 0),
(233, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690281939, 0),
(234, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690282153, 0),
(235, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690282329, 0),
(236, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690282547, 0),
(237, 8, 'lab', 0, 0, 'cash', 165, 'doctor', 173, 1690282626, 0),
(238, 16, 'lab', 0, 1, 'insurance', 165, 'doctor', 207, 1690282699, 6),
(239, 16, 'lab', 0, 1, 'insurance', 165, 'doctor', 207, 1690282876, 0),
(240, 8, 'admission', 0, 1, 'cash', 165, 'doctor', 173, 1690283332, 5),
(241, 18, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 223, 1690285821, 1),
(242, 16, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 207, 1690286668, 0),
(243, 16, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 207, 1690357992, 0),
(244, 19, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690404301, 1),
(245, 20, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1690404341, 1),
(246, 21, 'nurse', 0, 1, 'credit', 163, 'receptionist', NULL, 1690404409, 1),
(247, 20, 'lab', 0, 1, 'cash', 165, 'doctor', 245, 1690405182, 1),
(248, 20, 'radiography', 0, 1, 'cash', 165, 'doctor', 245, 1690405182, 1),
(249, 19, 'admission', 0, 0, 'cash', 165, 'doctor', 244, 1690405277, 5),
(250, 20, 'doctor', 165, 1, 'cash', 167, 'lab technician', 247, 1690407491, 1),
(251, 20, 'pharmacy', 0, 1, 'cash', 165, 'doctor', 245, 1690432083, 1),
(252, 20, 'nurse', 0, 1, 'cash', 165, 'doctor', 245, 1690432116, 1),
(253, 20, 'doctor', 165, 0, 'cash', 166, 'nurse', 252, 1690432339, 1),
(254, 17, 'doctor', 165, 0, 'cash', 166, 'nurse', 220, 1690435267, 1),
(255, 20, 'radiography', 0, 1, 'cash', 165, 'doctor', 245, 1690435390, 1),
(256, 20, 'doctor', 165, 1, 'cash', 211, 'radiographer', 248, 1690435592, 1),
(257, 20, 'doctor', 165, 1, 'cash', 211, 'radiographer', 255, 1690435616, 1),
(258, 20, 'referral', 0, 0, 'cash', 165, 'doctor', 245, 1690435825, 0),
(259, 20, 'nurse', 0, 1, 'cash', 165, 'doctor', 245, 1690437506, 1),
(260, 20, 'doctor', 165, 1, 'cash', 166, 'nurse', 259, 1690437581, 1),
(261, 23, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690438463, 1),
(262, 23, 'nurse', 0, 1, 'insurance', 165, 'doctor', 261, 1690438751, 1),
(263, 23, 'doctor', 165, 1, 'cash', 166, 'nurse', 262, 1690438922, 1),
(264, 16, 'nurse', 0, 1, 'cash', 165, 'doctor', 207, 1690441798, 1),
(265, 16, 'doctor', 165, 1, 'cash', 166, 'nurse', 264, 1690441870, 1),
(266, 24, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690448777, 1),
(267, 24, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 266, 1690448874, 1),
(268, 25, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690451705, 1),
(269, 26, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690451894, 1),
(270, 8, 'anesthesiology', 0, 1, 'cash', 165, 'doctor', 173, 1690452330, 1),
(271, 27, 'doctor', 0, 1, 'credit', 163, 'receptionist', NULL, 1690452896, 1),
(272, 27, 'pharmacy', 0, 1, 'credit', 165, 'doctor', 271, 1690453339, 0),
(273, 27, 'lab', 0, 1, 'credit', 165, 'doctor', 271, 1690453339, 1),
(274, 16, 'doctor', 165, 1, 'cash', 167, 'lab technician', 231, 1690453588, 1),
(275, 27, 'doctor', 165, 1, 'cash', 167, 'lab technician', 273, 1690453857, 1),
(276, 26, 'lab', 0, 1, 'insurance', 165, 'doctor', 269, 1690454981, 1),
(277, 26, 'radiography', 0, 1, 'insurance', 165, 'doctor', 269, 1690454981, 0),
(278, 26, 'doctor', 165, 1, 'cash', 0, 'lab technician', 276, 1690458844, 1),
(279, 28, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1690459025, 1),
(280, 28, 'lab', 0, 1, 'insurance', 165, 'doctor', 279, 1690459180, 1),
(281, 28, 'radiography', 0, 1, 'insurance', 165, 'doctor', 279, 1690459180, 1),
(282, 28, 'doctor', 165, 1, 'cash', 167, 'lab technician', 280, 1690459287, 1),
(283, 28, 'doctor', 165, 1, 'cash', 211, 'radiographer', 281, 1690459794, 1),
(284, 28, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 279, 1690461144, 1),
(285, 28, 'lab', 0, 0, 'cash', 165, 'doctor', 279, 1690461144, 6),
(286, 8, 'lab', 0, 1, 'insurance', 165, 'doctor', 173, 1690461715, 0),
(287, 25, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 268, 1690461856, 1),
(288, 18, 'admission', 0, 0, 'cash', 165, 'doctor', 223, 1690465765, 5),
(289, 28, 'nurse', 0, 1, 'cash', 165, 'doctor', 279, 1690466332, 1),
(290, 28, 'doctor', 165, 1, 'cash', 166, 'nurse', 289, 1690466853, 1),
(291, 28, 'doctor', 165, 1, 'cash', 166, 'nurse', 289, 1690467086, 1),
(292, 28, 'admission', 0, 0, 'cash', 165, 'doctor', 279, 1690469133, 5),
(293, 28, 'lab', 0, 1, 'insurance', 165, 'doctor', 279, 1690492186, 0),
(294, 28, 'radiography', 0, 1, 'insurance', 165, 'doctor', 279, 1690493363, 1),
(295, 28, 'doctor', 165, 1, 'cash', 211, 'radiographer', 294, 1690493505, 1),
(296, 28, 'radiography', 0, 1, 'insurance', 165, 'doctor', 279, 1690493584, 0),
(297, 28, 'nurse', 0, 1, 'cash', 165, 'doctor', 279, 1690494848, 1),
(298, 28, 'doctor', 165, 1, 'cash', 166, 'nurse', 297, 1690495077, 1),
(299, 28, 'nurse', 0, 1, 'cash', 165, 'doctor', 279, 1690534914, 1),
(300, 28, 'doctor', 165, 1, 'cash', 166, 'nurse', 299, 1690536118, 1),
(301, 29, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1690875605, 1),
(302, 30, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1692010655, 1),
(303, 31, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1692119119, 0),
(304, 30, 'pharmacy', 0, 1, 'cash', 165, 'doctor', 302, 1692292250, 0),
(305, 32, 'clinic', 0, 1, 'cash', 163, 'receptionist', NULL, 1692310848, 0),
(306, 33, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1692311451, 1),
(307, 33, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 306, 1692311878, 1),
(308, 34, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1692312787, 1),
(309, 34, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 308, 1692313210, 1),
(310, 35, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1692430851, 1),
(311, 35, 'lab', 0, 1, 'insurance', 165, 'doctor', 310, 1692432401, 1),
(312, 35, 'radiography', 0, 1, 'insurance', 165, 'doctor', 310, 1692432401, 0),
(313, 35, 'doctor', 165, 1, 'cash', 167, 'lab technician', 311, 1692432818, 1),
(314, 35, 'pharmacy', 0, 1, 'insurance', 165, 'doctor', 310, 1692434077, 1),
(315, 36, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1692434793, 0),
(316, 37, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1692589641, 0),
(317, 0, 'lab', 0, 0, 'cash', 165, 'doctor', 0, 1692590010, 0),
(318, 29, 'lab', 0, 0, 'cash', 165, 'doctor', 301, 1692597723, 6),
(319, 29, 'radiography', 0, 0, 'cash', 165, 'doctor', 301, 1692597723, 1),
(320, 29, 'lab', 0, 0, 'cash', 165, 'doctor', 301, 1692598824, 0),
(321, 38, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1692598967, 1),
(322, 38, 'lab', 0, 1, 'cash', 165, 'doctor', 321, 1692599078, 0),
(323, 38, 'radiography', 0, 1, 'cash', 165, 'doctor', 321, 1692599078, 1),
(324, 39, 'doctor', 0, 0, 'cash', 163, 'receptionist', NULL, 1692612728, 1),
(325, 39, 'radiography', 0, 0, 'cash', 165, 'doctor', 324, 1692612810, 0),
(326, 29, 'doctor', 165, 1, 'cash', 176, 'radiographer', 301, 1692622302, 1),
(327, 38, 'doctor', 165, 1, 'cash', 176, 'radiographer', 321, 1692624059, 1),
(328, 40, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1692651501, 1),
(329, 40, 'lab', 0, 1, 'insurance', 165, 'doctor', 328, 1692652487, 0),
(330, 40, 'radiography', 0, 1, 'insurance', 165, 'doctor', 328, 1692652487, 0),
(331, 41, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1692694883, 1),
(332, 41, 'radiography', 0, 1, 'insurance', 165, 'doctor', 331, 1692695400, 0),
(333, 41, 'doctor', 165, 1, 'cash', 176, 'radiographer', 331, 1692696848, 8),
(334, 42, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1692875713, 1),
(335, 42, 'lab', 0, 1, 'cash', 165, 'doctor', 334, 1692876329, 1),
(336, 42, 'radiography', 0, 1, 'cash', 165, 'doctor', 334, 1692876329, 0),
(337, 42, 'doctor', 165, 1, 'cash', 167, 'lab technician', 334, 1692877093, 1),
(338, 43, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1693041081, 1),
(339, 43, 'lab', 0, 1, 'insurance', 165, 'doctor', 338, 1693041806, 1),
(340, 43, 'radiography', 0, 1, 'insurance', 165, 'doctor', 338, 1693041806, 0),
(341, 43, 'doctor', 165, 1, 'cash', 167, 'lab technician', 338, 1693042659, 1),
(342, 44, 'doctor', 0, 1, 'insurance', 163, 'receptionist', NULL, 1693284702, 1),
(343, 44, 'lab', 0, 1, 'insurance', 165, 'doctor', 342, 1693285332, 1),
(344, 44, 'radiography', 0, 1, 'insurance', 165, 'doctor', 342, 1693285332, 0),
(345, 44, 'doctor', 165, 1, 'cash', 167, 'lab technician', 342, 1693285924, 1),
(346, 45, 'doctor', 0, 1, 'cash', 163, 'receptionist', NULL, 1693287326, 1),
(347, 45, 'lab', 0, 1, 'cash', 165, 'doctor', 346, 1693287522, 1),
(348, 45, 'doctor', 165, 1, 'cash', 167, 'lab technician', 346, 1693291203, 1),
(349, 38, 'doctor', 165, 1, 'cash', 167, 'lab technician', 321, 1693327276, 8);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `paymentmethod_id` int(11) NOT NULL,
  `paymentmethod` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`paymentmethod_id`, `paymentmethod`, `code`, `status`) VALUES
(1, 'carte d\'assurance maladie', 'CAM', 1),
(2, 'mutuelle de la fonction publique', 'MFP', 1),
(3, 'société', 'SOC', 1),
(4, 'Police Nationale du Burundi', 'PNB', 1),
(5, 'militaire', 'FND', 1),
(6, 'indigent', 'IND', 1),
(7, 'Paiement cash', 'PC', 1),
(8, 'soins gratuits', 'GS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expected` int(11) NOT NULL,
  `mode` varchar(200) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymethod`
--

CREATE TABLE `paymethod` (
  `paymethod_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymethod`
--

INSERT INTO `paymethod` (`paymethod_id`, `patient_id`, `method`, `user_id`, `created_at`, `status`) VALUES
(39, 4, 'insurance', 163, '2023-05-15 06:42:35', 1),
(40, 2, 'insurance', 163, '2023-06-16 08:23:51', 1),
(41, 3, 'credit', 163, '2023-06-16 08:44:58', 1),
(42, 2, 'credit', 163, '2023-06-17 04:00:11', 1),
(43, 5, 'credit', 163, '2023-06-17 04:04:58', 1),
(44, 5, 'insurance', 163, '2023-06-17 04:05:16', 1),
(46, 7, 'insurance', 163, '2023-06-23 10:33:06', 1),
(47, 8, 'insurance', 163, '2023-06-26 01:43:16', 1),
(48, 9, 'insurance', 163, '2023-07-21 13:01:34', 1),
(49, 10, 'insurance', 163, '2023-07-21 23:12:04', 1),
(50, 11, 'insurance', 163, '2023-07-24 08:12:43', 1),
(51, 12, 'insurance', 163, '2023-07-24 11:29:45', 1),
(52, 13, 'credit', 163, '2023-07-24 22:47:30', 1),
(53, 14, 'insurance', 163, '2023-07-26 12:52:44', 1),
(54, 16, 'insurance', 163, '2023-07-26 12:52:55', 1),
(55, 17, 'credit', 163, '2023-07-26 12:53:11', 1),
(56, 18, 'insurance', 163, '2023-07-26 13:08:48', 1),
(57, 21, 'insurance', 163, '2023-07-27 01:02:41', 1),
(58, 21, 'insurance', 163, '2023-07-27 01:02:42', 2),
(59, 24, 'credit', 163, '2023-07-27 01:15:32', 2),
(60, 24, 'credit', 163, '2023-07-27 01:21:57', 2),
(61, 25, 'insurance', 163, '2023-07-27 01:44:33', 1),
(62, 24, 'insurance', 163, '2023-07-27 13:27:57', 2),
(63, 26, 'insurance', 163, '2023-08-01 00:24:41', 2),
(64, 27, 'insurance', 163, '2023-08-17 15:04:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceuticalforms`
--

CREATE TABLE `pharmaceuticalforms` (
  `pharmaceuticalform_id` int(11) NOT NULL,
  `pharmaceuticalform` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacologicalclasses`
--

CREATE TABLE `pharmacologicalclasses` (
  `pharmacologicalclass_id` int(11) NOT NULL,
  `pharmacologicalclass` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyitems`
--

CREATE TABLE `pharmacyitems` (
  `pharmacyitem_id` int(11) NOT NULL,
  `genericname` varchar(200) NOT NULL,
  `commercialname` varchar(200) NOT NULL,
  `pharmacologicalclass_id` int(11) NOT NULL,
  `pharmaceuticalform_id` int(11) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyordereditems`
--

CREATE TABLE `pharmacyordereditems` (
  `pharmacyordereditem_id` int(11) NOT NULL,
  `item_id` varchar(30) NOT NULL,
  `pharmacyorder_id` int(11) NOT NULL,
  `prescription` varchar(200) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `dosage` text NOT NULL,
  `freq` text NOT NULL,
  `details` text NOT NULL,
  `expiry` date DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacyordereditems`
--

INSERT INTO `pharmacyordereditems` (`pharmacyordereditem_id`, `item_id`, `pharmacyorder_id`, `prescription`, `quantity`, `dosage`, `freq`, `details`, `expiry`, `status`) VALUES
(1, '35', 1, '18', '7', '', '', '', NULL, 1),
(2, '35', 2, '18', '7', '', '', '', NULL, 1),
(3, '35', 3, '18', '7', '', '', '', NULL, 2),
(4, '35', 4, '15', '7', '', '', '', NULL, 2),
(5, '35', 5, '15', '7', '', '', '', NULL, 2),
(6, '36', 6, '1*5', '12', '', '', '', NULL, 2),
(7, '38', 6, '1*4', '12', '', '', '', NULL, 2),
(8, '35', 7, '15', '7', '', '', '', NULL, 1),
(9, '35', 8, '18', '2*3', '', '', '', NULL, 1),
(10, '35', 9, '30', '7', '', '', '', NULL, 2),
(11, '35', 10, '20', '2*3', '', '', '', NULL, 2),
(12, '110', 10, '20', '2*3', '', '', '', NULL, 2),
(13, '', 11, '', '', '', '', '', NULL, 1),
(14, '35', 12, '500mg tds po', '', '', '', '', NULL, 2),
(15, '36', 13, '250mg tds 5/7', '', '', '', '', NULL, 2),
(16, '111', 13, '5mls tds 3/7', '', '', '', '', NULL, 2),
(17, '101', 14, 'Moderate pain of the patient', '1', '32', 'every after 8 hours ', '<p>Make sure he is not taking them while is hungry.&nbsp;</p>\r\n', '2023-11-15', 1),
(18, '183', 14, 'Treating chickenpox', '2', '24', 'every after 12 hours', 'She should not drink milk, during the dose.', '2023-10-10', 1),
(19, '183', 15, 'Smallpox treatment', '32', '2 per in take', 'every after 8 hours', '<p>Take when you have eaten</p>\r\n', '2023-10-10', 2),
(20, '101', 15, 'Relieve pains', '16', '1 per in take', 'every after 8 hours', 'Take them along other medicine. Do not use milk during the dose.', '2023-11-15', 2),
(21, '101', 16, 'Smallpox treatment', '24', '1 per in take', 'every after 8 hours', '<p>Do not take before eat.&nbsp;</p>\r\n', '2023-11-15', 2),
(22, '179', 16, 'Relieve pain', '32', '2 per in take', 'every after 8 hours ', 'This pain killer should be taken at per with main small pox tablets', '2023-11-21', 2),
(23, '183', 17, 'relieving muscles', '2 per in take', '', '', '', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyorders`
--

CREATE TABLE `pharmacyorders` (
  `pharmacyorder_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admitted_id` int(11) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `insurer` int(11) NOT NULL,
  `percentage` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacyorders`
--

INSERT INTO `pharmacyorders` (`pharmacyorder_id`, `patientsque_id`, `admin_id`, `admitted_id`, `timestamp`, `payment`, `insurer`, `percentage`, `source`, `status`) VALUES
(1, 217, 165, NULL, 1690273685, 0, 0, '0', 'doctor', 0),
(2, 219, 165, NULL, 1690273708, 1, 164, 'insurance', 'doctor', 1),
(3, 221, 165, NULL, 1690273854, 0, 0, '0', 'doctor', 0),
(4, 229, 165, NULL, 1690281362, 0, 0, '0', 'doctor', 0),
(5, 230, 165, NULL, 1690281450, 0, 0, '0', 'doctor', 0),
(6, 241, 165, NULL, 1690285821, 1, 164, 'insurance', 'doctor', 1),
(7, 242, 165, NULL, 1690286668, 1, 164, 'insurance', 'doctor', 1),
(8, 243, 165, NULL, 1690357992, 1, 164, 'insurance', 'doctor', 1),
(9, 251, 165, NULL, 1690432083, 0, 0, '0', 'doctor', 0),
(10, 267, 165, NULL, 1690448874, 1, 164, 'insurance', 'doctor', 1),
(11, 272, 165, NULL, 1690453339, 0, 0, '0', 'doctor', 0),
(12, 284, 165, NULL, 1690461144, 1, 164, 'insurance', 'doctor', 1),
(13, 287, 165, NULL, 1690461856, 1, 164, 'insurance', 'doctor', 1),
(14, 304, 165, NULL, 1692292250, 1, 164, 'cash', 'doctor', 1),
(15, 307, 165, NULL, 1692311878, 1, 164, 'insurance', 'doctor', 1),
(16, 309, 165, NULL, 1692313210, 1, 164, 'insurance', 'doctor', 1),
(17, 314, 165, NULL, 1692434077, 1, 164, 'insurance', 'doctor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pharstockorders`
--

CREATE TABLE `pharstockorders` (
  `pharstockorder_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharstockorders`
--

INSERT INTO `pharstockorders` (`pharstockorder_id`, `store`, `timestamp`, `admin_id`, `status`) VALUES
(1, 2, 1691408093, 168, 0),
(2, 2, 1691489735, 168, 1),
(3, 2, 1691587676, 168, 1),
(4, 2, 1692304305, 168, 0),
(5, 2, 1692856067, 168, 0),
(6, 2, 1692915700, 168, 1);

-- --------------------------------------------------------

--
-- Table structure for table `postnatalreports`
--

CREATE TABLE `postnatalreports` (
  `postnatalreport_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `birthdate` varchar(15) NOT NULL,
  `maritalsituation` varchar(10) NOT NULL,
  `hivknown` varchar(10) NOT NULL,
  `onarvs` varchar(10) NOT NULL,
  `testing` varchar(100) NOT NULL,
  `fearvs` varchar(10) NOT NULL,
  `babyname` varchar(100) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `firstvisit` varchar(100) NOT NULL,
  `othervisits` varchar(100) NOT NULL,
  `onctx` varchar(100) NOT NULL,
  `babiessampled` varchar(100) NOT NULL,
  `vitamina` varchar(100) NOT NULL,
  `pfmembership` varchar(10) NOT NULL,
  `arvwomenmembership` varchar(10) NOT NULL,
  `obstetricfistulas` varchar(10) NOT NULL,
  `puerperalinfection` varchar(10) NOT NULL,
  `problems` varchar(1000) NOT NULL,
  `decisions` varchar(1000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `admitted_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `tovalue` varchar(100) NOT NULL,
  `ta` varchar(100) NOT NULL,
  `fr` varchar(100) NOT NULL,
  `pulse` varchar(1000) NOT NULL,
  `oxygensaturation` varchar(100) NOT NULL,
  `clinicalsigns` varchar(1000) NOT NULL,
  `physicalsigns` varchar(1000) NOT NULL,
  `diagnostichypothesis` varchar(1000) NOT NULL,
  `processinginprocess` varchar(1000) NOT NULL,
  `recommendations` varchar(1000) NOT NULL,
  `type` varchar(10) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progressmedications`
--

CREATE TABLE `progressmedications` (
  `progressmedication_id` int(11) NOT NULL,
  `progress_id` int(11) NOT NULL,
  `drug` int(11) NOT NULL,
  `price` varchar(20) NOT NULL,
  `prescription` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `qualification_id` int(11) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`qualification_id`, `qualification`, `admin_id`, `status`) VALUES
(1, 'Master of Science in Nursing (MSN)', 173, 0),
(2, 'Doctor of Occupational Therapy (OTD)', 173, 1),
(3, 'Bachelor of Science in Nursing (BSN)', 173, 1),
(4, 'Doctor of Dental Medicine (DMD)', 173, 1),
(5, 'Doctor of Medicine (M.D.)', 173, 1),
(6, 'Doctor of Pharmacy (Pharm.D.)', 173, 1),
(7, 'Doctor of Nursing Practice (DNP)', 173, 1),
(8, 'Nurse', 182, 1),
(9, 'Patron/Matron', 182, 1),
(10, 'Clinic Officer', 182, 1);

-- --------------------------------------------------------

--
-- Table structure for table `radioinvestigationtypes`
--

CREATE TABLE `radioinvestigationtypes` (
  `radioinvestigationtype_id` int(11) NOT NULL,
  `investigationtype` varchar(255) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `unitprice` varchar(50) NOT NULL,
  `creditprice` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radioinvestigationtypes`
--

INSERT INTO `radioinvestigationtypes` (`radioinvestigationtype_id`, `investigationtype`, `unit_id`, `unitprice`, `creditprice`, `status`) VALUES
(1, 'KUB Ultrasound', '2', '20000', '20000', 1),
(2, 'OBS ultrasound', '2', '15000', '15000', 1),
(3, 'abd-pelvic ultrasound', '2', '20000', '20000', 1),
(4, 'obs ultrasond 2nd', '2', '10000', '10000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `radiolodyreporttitle`
--

CREATE TABLE `radiolodyreporttitle` (
  `reporttitle` int(11) NOT NULL,
  `title` text NOT NULL,
  `summary` text NOT NULL,
  `conclusion` text,
  `admission_id` int(11) NOT NULL,
  `patientque_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiolodyreporttitle`
--

INSERT INTO `radiolodyreporttitle` (`reporttitle`, `title`, `summary`, `conclusion`, `admission_id`, `patientque_id`, `timestamp`, `status`) VALUES
(1, 'test report', 'test summary', NULL, 28, 296, 1692620439, 1),
(2, 'Testing tilte', 'test summary', 'well donec', 29, 319, 1692621768, 1),
(3, 'Title report', 'clinic summary', 'well done', 38, 323, 1692623986, 1),
(4, 'KUN ULTRA SOUND REPORT', 'We want to determine whether this patient has  a swollen muscle', 'The patient requires immediately attention', 41, 332, 1692696848, 1);

-- --------------------------------------------------------

--
-- Table structure for table `radiologyimages`
--

CREATE TABLE `radiologyimages` (
  `radioimage_id` int(11) NOT NULL,
  `radiology_report_id` int(11) NOT NULL,
  `image` varchar(12) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiologyimages`
--

INSERT INTO `radiologyimages` (`radioimage_id`, `radiology_report_id`, `image`, `status`) VALUES
(1, 1, 'jpg', 1),
(2, 1, 'png', 1),
(3, 1, 'png', 1),
(4, 1, 'jpg', 1),
(5, 2, 'jpg', 1),
(6, 2, 'jpg', 1),
(7, 2, 'jpg', 1),
(8, 3, 'jpg', 1),
(9, 3, 'jpg', 1),
(10, 4, 'jpg', 1),
(11, 4, 'jpg', 1),
(12, 5, 'png', 1),
(13, 6, 'jpg', 1),
(14, 7, 'jpg', 1),
(15, 8, 'jpg', 1),
(16, 9, 'jpg', 1),
(17, 10, 'jpg', 1),
(18, 11, 'jpg', 1),
(19, 12, 'jpg', 1),
(20, 13, 'jpg', 1),
(21, 14, 'png', 1),
(22, 14, 'png', 1),
(23, 15, 'png', 1),
(24, 15, 'jpg', 1),
(25, 16, 'jpg', 1),
(26, 16, 'jpg', 1),
(27, 17, 'jpg', 1),
(28, 17, 'jpg', 1),
(29, 18, 'png', 1),
(30, 19, '', 1),
(31, 20, 'jpg', 1),
(32, 20, 'jpeg', 1),
(33, 20, 'jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `radiologyreports`
--

CREATE TABLE `radiologyreports` (
  `radiologyreport_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `clinic` int(11) NOT NULL DEFAULT '0',
  `report_id` int(11) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `results` varchar(1000) NOT NULL,
  `conclusion` varchar(1000) NOT NULL,
  `responsible` varchar(100) NOT NULL,
  `exitmode` varchar(50) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiologyreports`
--

INSERT INTO `radiologyreports` (`radiologyreport_id`, `patientsque_id`, `month`, `year`, `reason`, `clinic`, `report_id`, `description`, `start`, `end`, `results`, `conclusion`, `responsible`, `exitmode`, `destination`, `admin_id`, `timestamp`, `status`) VALUES
(1, 160, 'June', 2023, '', 0, NULL, 'very Sick patient', NULL, NULL, 'very sick patient', 'very sick', 'Doctor jimmy', 'transfert intra hÃ´pital', '', 176, 1687459911, 1),
(2, 169, 'June', 2023, 'Chest in and out expansive', 0, NULL, 'The undersigned patient has problem in muscular tile 2 due to swollen of stomach tissue', NULL, NULL, 'more in expansion', 'the condition can be normalized with stomach muscles relaxation', '', 'transfert intra hÃ´pital', '', 211, 1687954001, 1),
(3, 175, 'July', 2023, 'Radiology Report', 0, NULL, 'The cardiology is a bit expansive ', NULL, NULL, '1', 'There is abnormality curve at cardiology tissue', '', '', '', 211, 1688365279, 1),
(4, 175, 'July', 2023, 'Radiology Report', 0, NULL, 'Stomach muscles are tighten at cavity', NULL, NULL, '2', 'There is abnormality curve at cardiology tissue', '', '', '', 211, 1688365279, 1),
(5, 182, 'July', 2023, 'Radiology Report', 0, NULL, 'severe', NULL, NULL, '2', 'not normal', '', '', '', 211, 1690008252, 1),
(6, 189, 'July', 2023, 'Radiology Report', 0, NULL, 'patient has severe cancer', NULL, NULL, '2', 'the patient is dying and will not be fun soon', '', '', '', 176, 1690035815, 1),
(7, 189, 'July', 2023, 'Radiology Report', 0, NULL, 'patient is not doing well', NULL, NULL, '3', 'the patient is dying and will not be fun soon', '', '', '', 176, 1690035815, 1),
(8, 195, 'July', 2023, 'Radiology Report', 0, NULL, 'uvimbe kidogo', NULL, NULL, '2', 'Afanyiwe upasuaji', '', '', '', 211, 1690212438, 1),
(9, 210, 'July', 2023, 'Radiology Report', 0, NULL, 'skull crack', NULL, NULL, '3', 'immediately operation needed', '', '', '', 211, 1690233012, 1),
(10, 248, 'July', 2023, 'Radiology Report', 0, NULL, 'fine', NULL, NULL, '3', 'hana tatizo lolote', '', '', '', 211, 1690435592, 1),
(11, 255, 'July', 2023, 'Radiology Report', 0, NULL, 'uvimbe kwa mbali', NULL, NULL, '1', 'uvimbe mdogo', '', '', '', 211, 1690435616, 1),
(12, 281, 'July', 2023, 'Radiology Report', 0, NULL, 'single tone live intrauterine fetus seen with active cardiac activities', NULL, NULL, '2', 'normal intrauterine fetus at GA 32WKS', '', '', '', 211, 1690459794, 1),
(13, 294, 'July', 2023, 'Radiology Report', 0, NULL, 'zzzzzzzzzzzz', NULL, NULL, '1', 'zzzzzzzzz', '', '', '', 211, 1690493505, 1),
(14, 296, 'August', 2023, 'Radiology Report', 0, NULL, 'well done', '12:00:00', '12:34:00', '1', '', '', '', '', 176, 1692620500, 1),
(15, 296, 'August', 2023, 'Radiology Report', 0, NULL, 'well done', '12:34:00', '12:45:00', '', '', '', '', '', 176, 1692620611, 1),
(16, 296, 'August', 2023, 'Radiology Report', 0, NULL, 'well done', '13:02:00', '13:45:00', '', '', '', '', '', 176, 1692620645, 1),
(17, 319, 'August', 2023, 'Radiology Report', 0, 2, 'well done', '12:01:00', '12:23:00', '1', 'well donec', '', '', '', 176, 1692622302, 1),
(18, 323, 'August', 2023, 'Radiology Report', 0, 3, 'the demo', '11:23:00', '11:50:00', '1', '', '', '', '', 176, 1692624020, 1),
(19, 323, 'August', 2023, 'Radiology Report', 0, 3, 'well done', '11:02:00', '11:23:00', '2', 'well done', '', '', '', 176, 1692624059, 1),
(20, 332, 'August', 2023, 'Radiology Report', 0, 4, 'We found the tissue is swollen, and muscles are greatly affected.', '12:10:00', '12:30:00', '1', 'The patient requires immediately attention', '', '', '', 176, 1692696848, 1);

-- --------------------------------------------------------

--
-- Table structure for table `radioorders`
--

CREATE TABLE `radioorders` (
  `radioorder_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `paymentmethod` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `approvedby` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radioorders`
--

INSERT INTO `radioorders` (`radioorder_id`, `patientsque_id`, `admin_id`, `timestamp`, `payment`, `paymentmethod`, `payment_id`, `source`, `approvedby`, `status`) VALUES
(18, 158, 165, 1687000774, 0, 'insurance', '0', 'reception', 0, 0),
(19, 160, 165, 1687458996, 0, 'cash', '0', 'reception', 0, 0),
(20, 166, 165, 1687770575, 0, 'insurance', '0', 'reception', 0, 0),
(21, 169, 165, 1687948436, 0, 'insurance', '0', 'reception', 0, 0),
(22, 175, 165, 1688363761, 0, 'insurance', '0', 'reception', 0, 0),
(23, 182, 165, 1690007402, 0, 'insurance', '0', 'reception', 0, 0),
(24, 189, 165, 1690035528, 0, 'cash', '0', 'reception', 0, 0),
(25, 192, 165, 1690211245, 0, 'insurance', '0', 'reception', 0, 0),
(26, 195, 165, 1690212228, 0, 'insurance', '0', 'reception', 0, 0),
(27, 210, 165, 1690232681, 0, 'insurance', '0', 'reception', 0, 0),
(28, 227, 165, 1690281163, 0, 'insurance', '0', 'reception', 0, 0),
(29, 248, 165, 1690405182, 0, 'cash', '0', 'reception', 0, 0),
(30, 255, 165, 1690435390, 0, 'cash', '0', 'reception', 0, 0),
(31, 277, 165, 1690454981, 0, 'insurance', '0', 'reception', 0, 0),
(32, 281, 165, 1690459180, 0, 'insurance', '0', 'reception', 0, 0),
(33, 294, 165, 1690493363, 0, 'insurance', '0', 'reception', 0, 0),
(34, 296, 165, 1690493584, 0, 'insurance', '0', 'reception', 0, 0),
(35, 312, 165, 1692432401, 0, 'insurance', '0', 'reception', 0, 0),
(36, 319, 165, 1692597723, 0, 'insurance', '0', 'reception', 0, 0),
(37, 323, 165, 1692599078, 0, 'cash', '0', 'reception', 0, 0),
(38, 325, 165, 1692612810, 0, 'cash', '0', 'reception', 0, 0),
(39, 330, 165, 1692652487, 0, 'insurance', '0', 'reception', 0, 0),
(40, 332, 165, 1692695400, 0, 'insurance', '0', 'reception', 0, 0),
(41, 336, 165, 1692876329, 0, 'insurance', '0', 'reception', 0, 0),
(42, 340, 165, 1693041806, 0, 'insurance', '0', 'reception', 0, 0),
(43, 344, 165, 1693285332, 0, 'insurance', '0', 'reception', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reaction_id` int(11) NOT NULL,
  `transfusion_id` int(11) NOT NULL,
  `reaction` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referr_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(225) NOT NULL,
  `HPI` varchar(225) DEFAULT NULL,
  `ROS` varchar(255) DEFAULT NULL,
  `PMH` varchar(255) DEFAULT NULL,
  `diagnosis` text,
  `treatment` text,
  `reason` text,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`referr_id`, `patient_id`, `date`, `HPI`, `ROS`, `PMH`, `diagnosis`, `treatment`, `reason`, `admin_id`, `status`) VALUES
(1, 12, '1690232681', '', '', '', '', '', '', 165, 1),
(2, 15, '1690435825', 'dssvd', 'sdsv', 'vsvdvds', 'dvsdvv', 'dvdsvdvd', '', 165, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration_requests`
--

CREATE TABLE `registration_requests` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `nurse` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_requests`
--

INSERT INTO `registration_requests` (`id`, `patient_id`, `nurse`, `employee`, `date`, `status`) VALUES
(4, 4, 166, 163, '2023-05-15 16:53:22', 0),
(5, 2, 166, 163, '2023-06-16 18:38:22', 0),
(6, 6, 166, 163, '2023-06-22 21:24:16', 0),
(7, 7, 166, 163, '2023-06-23 08:36:53', 0),
(8, 8, 166, 163, '2023-06-23 09:00:15', 0),
(9, 9, 1, 163, '2023-07-21 23:08:31', 0),
(10, 10, 1, 163, '2023-07-22 09:15:05', 0),
(11, 11, 1, 163, '2023-07-24 18:16:41', 0),
(12, 12, 1, 163, '2023-07-24 21:32:46', 0),
(13, 13, 1, 163, '2023-07-25 08:49:48', 0),
(14, 14, 1, 163, '2023-07-26 23:30:38', 0),
(15, 18, 1, 163, '2023-07-26 23:30:46', 0),
(16, 15, 1, 163, '2023-07-26 23:30:52', 0),
(17, 17, 1, 163, '2023-07-26 23:31:00', 0),
(18, 25, 1, 163, '2023-07-27 12:04:15', 0),
(19, 21, 1, 163, '2023-07-27 12:27:35', 0),
(20, 19, 1, 163, '2023-07-27 13:13:23', 1),
(21, 26, 1, 163, '2023-08-01 10:19:45', 1),
(22, 27, 1, 163, '2023-08-18 01:15:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `measurement` varchar(100) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `responsiblequalifications`
--

CREATE TABLE `responsiblequalifications` (
  `responsiblequalification_id` int(11) NOT NULL,
  `responsiblequalification` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restockitems`
--

CREATE TABLE `restockitems` (
  `restockitem_id` int(11) NOT NULL,
  `restockorder_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` varchar(120) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unitcharge` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restockitems`
--

INSERT INTO `restockitems` (`restockitem_id`, `restockorder_id`, `product_id`, `type`, `quantity`, `unitcharge`, `status`) VALUES
(1, 1, 35, 'Medicine', 100, 100, 1),
(2, 1, 38, 'Medicine', 120, 150, 1),
(3, 1, 39, 'Medicine', 125, 500, 1),
(4, 4, 103, 'Medicine', 200, 1000, 1),
(5, 4, 53, 'Medicine', 100, 300, 1),
(6, 4, 63, 'Medicine', 150, 500, 1),
(7, 4, 38, 'Medicine', 1000, 250, 1),
(8, 4, 236, 'Medical', 300, 200, 1),
(9, 5, 39, 'Medicine', 7, 500, 1),
(10, 5, 35, 'Medicine', 6, 100, 1),
(11, 6, 36, 'Medicine', 200, 100, 1),
(12, 6, 36, 'Medicine', 1000, 50, 1),
(13, 6, 37, 'Medicine', 100, 100, 1),
(14, 6, 43, 'Medicine', 150, 200, 1),
(15, 7, 236, 'Medical', 1000, 200, 1),
(16, 7, 237, 'Medical', 20, 5000, 1),
(17, 7, 238, 'Medical', 30, 20000, 1),
(18, 7, 239, 'Medical', 100, 500, 1),
(19, 8, 52, 'Medicine', 600, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restockorders`
--

CREATE TABLE `restockorders` (
  `restockorder_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `deliver_date` date DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restockorders`
--

INSERT INTO `restockorders` (`restockorder_id`, `store_id`, `supplier_id`, `deliver_date`, `timestamp`, `admin_id`, `status`) VALUES
(1, 3, 8, '2023-08-10', 1691269200, 175, 1),
(2, 3, 8, '2023-08-10', 1691269200, 175, 5),
(3, 3, 8, '2023-08-10', 1691269200, 175, 5),
(4, 3, 9, '2023-08-12', 1691269200, 175, 0),
(5, 2, 8, '2023-08-16', 1691269200, 175, 0),
(6, 3, 0, '0000-00-00', 1691269200, 175, 0),
(7, 3, 0, '0000-00-00', 1691528400, 175, 1),
(8, 3, 0, '0000-00-00', 1692219600, 175, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `salary_id` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `salary`, `status`) VALUES
(1, 1500000, 0),
(2, 200000, 0),
(3, 15, 0),
(4, 500000, 0),
(5, 300000, 1),
(6, 2500000, 1),
(7, 1000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scannerreports`
--

CREATE TABLE `scannerreports` (
  `scannerreport_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `results` varchar(1000) NOT NULL,
  `conclusion` varchar(1000) NOT NULL,
  `responsible` varchar(100) NOT NULL,
  `exitmode` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secs`
--

CREATE TABLE `secs` (
  `section_id` int(11) NOT NULL,
  `service` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section` varchar(200) NOT NULL,
  `_department_id` int(10) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section`, `_department_id`, `status`) VALUES
(26, 'RECEPTION', 2, 0),
(29, 'MEDICAL TREATMENT', 2, 1),
(31, 'testingi', NULL, 0),
(32, 'CLINIC', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicecategories`
--

CREATE TABLE `servicecategories` (
  `servicecategory_id` int(11) NOT NULL,
  `servicecategory` varchar(500) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serviceorders`
--

CREATE TABLE `serviceorders` (
  `serviceorder_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `paymentmethod` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `approvedby` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceorders`
--

INSERT INTO `serviceorders` (`serviceorder_id`, `patientsque_id`, `admin_id`, `timestamp`, `payment`, `paymentmethod`, `payment_id`, `source`, `approvedby`, `status`) VALUES
(66, 152, 163, 1684058930, 0, 'cash', '0', 'reception', 0, 0),
(65, 151, 163, 1684058461, 0, 'credit', '0', 'reception', 0, 0),
(64, 150, 163, 1684055589, 0, 'insurance', '0', 'reception', 0, 0),
(67, 153, 163, 1686047230, 0, 'insurance', '0', 'reception', 0, 0),
(68, 154, 163, 1686930190, 0, 'insurance', '0', 'reception', 0, 0),
(69, 159, 163, 1687458439, 0, 'cash', '0', 'reception', 0, 0),
(70, 162, 163, 1687498767, 0, 'cash', '0', 'reception', 0, 0),
(71, 163, 163, 1687500512, 0, 'cash', '0', 'reception', 0, 0),
(72, 164, 163, 1687769968, 0, 'insurance', '0', 'reception', 0, 0),
(73, 167, 163, 1687899600, 1, 'insurance', '73', 'reception', 164, 1),
(74, 173, 163, 1688331600, 1, 'insurance', '74', 'reception', 164, 1),
(75, 178, 163, 1688331600, 1, 'insurance', '75', 'reception', 164, 1),
(76, 180, 163, 1689973200, 1, 'insurance', '76', 'reception', 164, 1),
(77, 188, 163, 1689973200, 1, 'cash', '77', 'reception', 164, 1),
(78, 193, 163, 1690146000, 1, 'insurance', '78', 'reception', 164, 1),
(79, 201, 163, 1690146000, 1, 'insurance', '79', 'reception', 164, 1),
(80, 203, 163, 1690146000, 1, 'cash', '80', 'reception', 164, 1),
(81, 205, 165, 1690226414, 0, 'cash', '0', 'doctor', 0, 0),
(82, 207, 163, 1690146000, 1, 'insurance', '82', 'reception', 164, 1),
(83, 215, 163, 1690232400, 1, 'credit', '83', 'reception', 164, 1),
(84, 216, 165, 1690273685, 0, 'credit', '0', 'reception', 0, 0),
(85, 218, 165, 1690273708, 0, 'credit', '0', 'reception', 0, 0),
(86, 220, 165, 1690273854, 0, 'credit', '0', 'reception', 0, 0),
(87, 223, 163, 1690232400, 1, 'insurance', '87', 'reception', 164, 1),
(88, 244, 163, 1690318800, 1, 'insurance', '88', 'reception', 164, 1),
(89, 245, 163, 1690318800, 1, 'cash', '89', 'reception', 164, 1),
(90, 246, 163, 1690318800, 1, 'credit', '90', 'reception', 164, 1),
(91, 252, 165, 1690405200, 1, 'cash', '91', 'doctor', 164, 1),
(92, 259, 165, 1690405200, 1, 'cash', '92', 'doctor', 164, 1),
(93, 261, 163, 1690405200, 1, 'insurance', '93', 'reception', 164, 1),
(94, 262, 165, 1690405200, 1, 'insurance', '94', 'reception', 164, 1),
(95, 264, 165, 1690405200, 1, 'cash', '95', 'doctor', 164, 1),
(96, 266, 163, 1690405200, 1, 'insurance', '96', 'reception', 164, 1),
(97, 268, 163, 1690405200, 1, 'insurance', '97', 'reception', 164, 1),
(98, 269, 163, 1690405200, 1, 'insurance', '98', 'reception', 164, 1),
(99, 270, 165, 1690405200, 1, 'cash', '99', 'doctor', 164, 1),
(100, 271, 163, 1690405200, 1, 'credit', '100', 'reception', 164, 1),
(101, 279, 163, 1690405200, 1, 'insurance', '101', 'reception', 164, 1),
(102, 289, 165, 1690405200, 1, 'cash', '102', 'doctor', 164, 1),
(103, 297, 165, 1690491600, 1, 'cash', '103', 'doctor', 164, 1),
(104, 297, 165, 1690491600, 1, 'cash', '104', 'doctor', 164, 1),
(105, 299, 165, 1690491600, 1, 'cash', '105', 'doctor', 164, 1),
(106, 299, 165, 1690491600, 1, 'cash', '106', 'doctor', 164, 1),
(107, 301, 163, 1690875605, 0, 'insurance', '0', 'reception', 0, 0),
(108, 302, 163, 1692824400, 1, 'cash', '108', 'reception', 164, 1),
(109, 303, 163, 1692119119, 0, 'insurance', '0', 'reception', 0, 0),
(110, 1, 166, 1692290003, 1, '', '0', 'clinic', 0, 0),
(111, 306, 163, 1692306000, 1, 'insurance', '111', 'reception', 164, 1),
(112, 308, 163, 1692306000, 1, 'insurance', '112', 'reception', 164, 1),
(113, 310, 163, 1692392400, 1, 'insurance', '113', 'reception', 164, 1),
(114, 315, 163, 1692434793, 0, 'insurance', '0', 'reception', 0, 0),
(115, 316, 163, 1692589641, 0, 'cash', '0', 'reception', 0, 0),
(116, 321, 163, 1692565200, 1, 'cash', '116', 'reception', 164, 1),
(117, 324, 163, 1692612728, 0, 'insurance', '0', 'reception', 0, 0),
(118, 328, 163, 1692651600, 1, 'insurance', '118', 'reception', 164, 1),
(119, 331, 163, 1692651600, 1, 'insurance', '119', 'reception', 164, 1),
(120, 334, 163, 1692824400, 1, 'cash', '120', 'reception', 164, 1),
(121, 338, 163, 1692997200, 1, 'insurance', '121', 'reception', 164, 1),
(122, 342, 163, 1693256400, 1, 'insurance', '122', 'reception', 164, 1),
(123, 346, 163, 1693256400, 1, 'cash', '123', 'reception', 164, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siunits`
--

CREATE TABLE `siunits` (
  `siunit_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siunits`
--

INSERT INTO `siunits` (`siunit_id`, `name`, `status`) VALUES
(1, 'normal', 0),
(2, 'N/A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `contractstart` int(11) NOT NULL,
  `contractend` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `role` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `education` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_relationship` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(255) DEFAULT NULL,
  `emergency_contact_address` varchar(255) DEFAULT NULL,
  `salarylevel` varchar(255) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `fullname`, `phone`, `gender`, `email`, `username`, `ext`, `designation_id`, `department_id`, `contractstart`, `contractend`, `salary`, `role`, `password`, `education`, `qualification`, `emergency_contact`, `emergency_contact_relationship`, `emergency_contact_phone`, `emergency_contact_address`, `salarylevel`, `timestamp`, `status`) VALUES
(9, 'Hospital Admin', '+2567890394859', 'Male', 'admin@elctelvdhospital.info', '', 'png', 4, 2, 984949200, 1682197200, 2, 'admin', '8d00035823299378da2ee507befe18ea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1623272400, 1),
(153, 'BARAKAEL AMOS STEPHANO', '0755315843', 'Male', 'skibaste19@gmail.com', '', '', 38, 1, 1577826000, 1672434000, 2, 'doctor', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643058000, 0),
(154, 'Grace chungizi', '0768964653', 'Female', 'chungizig@gmail.com', '', '', 8, 12, 1577826000, 1672434000, 2, 'patron', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 0),
(155, 'Baraka Bernard Masamaki', '0746353362', 'Male', 'barakamsamaki@gmail.com', '', '', 47, 2, 1627765200, 1690750800, 2, 'doctor', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 0),
(156, 'Gloria Rodgers Moshi', '0767870212', 'Female', 'gloryrodgers04@gmail.com', '', '', 47, 2, 1604178000, 1672434000, 2, 'doctor', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 1),
(157, 'Edijost R Rwegarulira', '0766713326', 'Male', 'edijostivan@gmail.com', '', '', 5, 9, 1635714000, 1698699600, 2, 'lab technician', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 0),
(158, 'Yusta Adam Kuliani', '0754744417', 'Female', 'yustakullian88@gmail.com', '', '', 4, 8, 1609448400, 1672434000, 2, 'receptionist', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 0),
(159, 'Erick Rugengah', '0754504753', 'Male', 'erickrugengah.ggg@gmail.com', '', '', 5, 9, 1601499600, 1667163600, 2, 'lab technician', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 1),
(160, 'Vedastus Joseph', '0759052072', 'Male', 'vedastusjoseph026@gmail.com', '', '', 6, 3, 1609448400, 1672434000, 2, 'nurse', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643317200, 0),
(161, 'Lazaro Shiwa', '0753230672', 'Female', 'lazaroshiwa@gmail.com', '', '', 6, 3, 1601499600, 1664485200, 2, 'nurse', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643576400, 0),
(162, 'Danford Robert', '0683103334', 'Male', 'rdanford95@gmail.com', '', '', 34, 5, 1648760400, 1711832400, 2, 'store manager', 'dcf877b18896c5fa70fbbd4dc9c8adb0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643576400, 0),
(163, 'Ufanisi Reception', '0780000000', 'Female', 'receptionist@elctelvdhospital.info', 'receptionist', 'jpg', 48, 8, 1643662800, 1672693200, 2, 'receptionist', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(164, 'Ufanisi Cashier', '0789290023', 'Female', 'cashier@elctelvdhospital.info', 'cashier', 'jpg', 16, 6, 1643662800, 1708981200, 2, 'cashier', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(165, 'Ufanisi Doctor', '0765129826', 'Male', 'doctor@elctelvdhospital.info', 'doctor', 'jpg', 38, 2, 1643490000, 1682542800, 1, 'doctor', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(166, 'Ufanisi Nurse', '0735182318', 'Female', 'nurse@elctelvdhospital.info', 'nurse', 'jpg', 6, 3, 1626123600, 1677013200, 4, 'nurse', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(167, 'Ufanisi Lab', '0745128765', 'Male', 'lab@elctelvdhospital.info', 'lab', 'jpg', 5, 9, 1643662800, 1706734800, 4, 'lab technician', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(168, 'Ufanisi Pharmacist', '0741982753', 'Male', 'pharmacist@elctelvdhospital.info', 'pharmacist', 'jpg', 50, 5, 1643662800, 1676926800, 1, 'pharmacist', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(169, 'Ufanisi Insurance', '0678239837', 'Female', 'insurance@elctelvdhospital.info', 'insurance', 'jpg', 51, 2, 1643749200, 1676408400, 4, 'insurance officer', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 0),
(170, 'Ufanisi Accountant', '0773193876', 'Female', 'accountant@elctelvdhospital.info', 'accountant', 'jpg', 30, 1, 1609794000, 1708549200, 1, 'accountant', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(171, 'Ufanisi Patron', '0788209837', 'Male', 'patron@elctelvdhospital.info', 'patron', 'jpg', 52, 2, 1639429200, 1677013200, 4, 'patron', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(172, 'Ufanisi Director', '0627129837', 'Male', 'director@elctelvdhospital.info', '', 'jpg', 53, 1, 1643662800, 1708635600, 1, 'director', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1645045200, 1),
(173, 'System Maintainer', '0764238726', 'Male', 'kisb@elctelvdhospital.info', 'kisb', 'png', 4, 8, 1625518800, 1654462800, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625518800, 1),
(174, 'Insurance Ufanisi', '0700129836', 'Female', 'insurance@elctelvdhospital.info', '', 'jpg', 51, 2, 1667250000, 1702328400, 2, 'insurance officer', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1669496400, 1),
(175, 'Ufanisi Store', '0788129846', 'Female', 'store@elctelvdhospital.info', 'store', 'jpg', 54, 1, 1667250000, 1702328400, 4, 'store manager', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1669496400, 1),
(176, 'Ufanisi Radiographer', '0789286537', 'Male', 'radiology@elctelvdhospital.info', 'radiology', 'png', 14, 2, 1667250000, 1703624400, 4, 'radiographer', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1669496400, 1),
(177, 'Ufanisi anethetist', '0714286405', 'Male', 'anesthesiologist@elctelvdhospital.info', 'anesthe', 'png', 12, 3, 1667336400, 1707771600, 1, 'anesthesiologist', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1669496400, 1),
(178, 'Elizabeth Ernest Shemdoe', '+255654648228', 'Female', 'bteshemdoe@gmail.com', '', 'png', 55, 1, 1667250000, 1761944400, 1, 'admin', 'ae7a25b7096d92090a1fd3b79bccff1f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1669669200, 1),
(182, 'test admin', '430-909-3375', 'Male', 'test@admin.com', '', '', 28, 1, 1675198800, 1703883600, 1, 'admin', '3acc087583c175ab2da69f88038f6163', 'Bachelor Degree', 'Doc', '', '', '', '', '', 1676667600, 1),
(183, 'Joshua Misalaba', '0748228275', 'Male', 'test@radiographer.com', '', '', 14, 2, 1676667600, 1708203600, 4, 'radiographer', '94714923ead323f8066598b8dea7beb0', 'Bachelor Degree', '', '', '', '', '', '', 1676667600, 1),
(184, 'Test Receptionist', '0748228275', 'Female', 'test@receptionist.com', '', '', 48, 2, 1676667600, 1708203600, 2, 'receptionist', 'd39f2a8079b4b72d11fb10b5b4c0c2ab', 'Certificate', '', '', '', '', '', '', 1676667600, 1),
(185, 'Test Nurse', '0748228275', 'Female', 'test@nurse.com', '', '', 6, 2, 1676667600, 1708203600, 4, 'nurse', '8cb5ecf58225ff7cfc5dd1ae7e5734b2', 'Diploma', '', '', '', '', '', '', 1676667600, 1),
(186, 'Test Doctor', '0748228275', 'Male', 'test@doctor.com', '', '', 2, 2, 1676667600, 1708203600, 1, 'doctor', '5801ca80a254ce1e2f637a0ea1146bcb', 'Post Graduate', '', '', '', '', '', '', 1676667600, 1),
(187, 'Test Cashier', '0754345424', 'Male', 'test@cashier.com', '', '', 16, 2, 1676667600, 1708203600, 4, 'cashier', '35501adfb3c36bdf6e1196c3168934cf', 'Diploma', '', '', '', '', '', '', 1676667600, 1),
(188, 'Jema Felis', '0765668194', 'Female', 'felisjema@gmail.com', '', '', 34, 2, 1675198800, 1738270800, 2, 'pharmacist', '815b0f114c26c52554f091cc0586c607', 'Certificate', 'ADO', 'JOSHUA JAPHET', 'FATHER', '0753633927', 'MMMMM', '', 1676667600, 1),
(189, 'Elizabeth E Shemdoe', '255654648228', 'Female', 'queenlishers@gmail.com', '', '', 56, 2, 1667250000, 1888088400, 2, 'doctor', '9173aaadaa0030461a8bd660866eaafc', 'Bachelor Degree', 'MO', 'happiness martin', 'mother', '0753989903', '1035', '', 1676667600, 1),
(190, 'Yusta Kullian', '0754744417', 'Female', 'yustakullian92@gmail.com', '', '', 57, 2, 1672520400, 1735592400, 2, 'receptionist', 'a66263816be86dd2dabed9775f5fd97e', 'Diploma', 'health record technician', 'suzan kullian', 'sister', '0758518968', '3173', '', 1676667600, 1),
(191, 'Mahangila M Mahangila', '0768545835, 0683451361', 'Male', 'mahangilamahangila3@gmail.com', '', '', 59, 2, 1672520400, 1735592400, 2, 'lab technician', '6b56fb9311fb299593117c4c42354dd5', 'Diploma', 'Lab Technologist', 'Ellen Mahangila ', 'SISTER', '0744071298', 'Buhira', '', 1676926800, 1),
(192, 'Grace I Chungizi', '0768964653', 'Female', 'gracechungizi@gmail.com', '', '', 60, 1, 1672520400, 1735592400, 2, 'nurse', 'cdeff5dfb49699672ec854068e90d029', 'Diploma', 'Registered Nurse', 'Daniel Paul', 'Husband', '0767974103', 'Kanyerere', '', 1676926800, 1),
(193, 'Elkana Reuben Lyanga', '0765786369', 'Male', 'elkanalyanga@gmail.com', '', '', 4, 1, 1669842000, 1732136400, 4, 'accountant', '93ceaadabde350c40f4d35e7b125b99a', 'Bachelor Degree', '', 'Gladness Rodgers', 'Wife', '0768565960', '', '', 1676926800, 0),
(194, 'Elkana Lyanga', '0765786369', 'Male', 'elkanalyanga@gmail.com', '', '', 4, 1, 1669842000, 1732914000, 4, 'admin', '93ceaadabde350c40f4d35e7b125b99a', 'Bachelor Degree', '', 'Gladness Rodgers', 'Wife', '0768565960', '3173', '', 1676926800, 1),
(195, 'Sophia Efraim', '0759355918', 'Female', 'sophiaefraim@gmail.com', '', '', 16, 2, 1672520400, 1735592400, 2, 'cashier', 'e3ec1a6c2d009e19a95e4cc38ea1898a', 'Certificate', 'cashier', 'Mary E Tesha', 'sister', '0759242915', 'nyamadoke', '', 1676926800, 1),
(196, 'Magreth Mayengela', '0769435246', 'Female', 'magrethmayengela46@hotmail.com', '', '', 61, 2, 1672520400, 1735592400, 2, 'receptionist', '804fdee9a2c8da2fc4312971173924cc', 'Certificate', 'Ass Health recorder', 'Dickson Revocatus', 't', '0743460267', 'Nansio', '', 1677013200, 1),
(197, 'Erick Rugengah', '0754504753', 'Male', 'erick.rugengah@yahoo.com', '', '', 59, 2, 1667250000, 1730322000, 2, 'lab technician', '7ac0f907d9184f7af857e2f6300abd66', 'Certificate', 'Ass Lab technologist', 'Merick Rugengah', 'Brother', '0684706500', 'Arusha', '', 1677013200, 1),
(198, 'Gidion Sostenes', '0782061583', 'Male', 'gideonsostenes1@gmail.com', '', '', 50, 2, 1661979600, 1693429200, 2, 'pharmacist', '1995a324d00d03f41a463190ae473d94', 'Diploma', 'pharmacist', 'Sostenes Gidion', 'FATHER', '0754450831', 'NYAMHONGORO', '', 1677099600, 1),
(199, 'Elkana Reuben Lyanga', '0765786369', 'Male', 'elyanga.elvdnhc@gmail.com', '', '', 4, 2, 1669842000, 1732914000, 4, 'accountant', '230fa7dbcd3f40f72d9c21bc3497857b', 'Bachelor Degree', 'Accountant', 'Gladness Rodgers', 'Wife', '0768565960', '', '', 1677186000, 1),
(200, 'Denis J Robert', '0687768020', 'Male', 'denisjrobert93@gmail.com', '', '', 14, 2, 1669842000, 1732914000, 2, 'radiographer', '76ee75e765dc285583ffac15cb14fa3a', 'Diploma', 'Radiographer', '0752501945', 'SISTER', '0752501945', '1066', '', 1677531600, 1),
(201, 'Test Accountant', '0748228275', 'Male', 'test@accountant.com', '', '', 4, 1, 1678914000, 1760562000, 4, 'accountant', '7516132c51e75ce65534cbdcc96c2c45', 'Bachelor Degree', '', '', '', '', '', '', 1678914000, 1),
(202, 'Elkana Reuben Lyanga', '0765786369', 'Male', 'storemanager.nhc@gmail.com', '', '', 54, 1, 1669842000, 1732914000, 4, 'store manager', '941280784dbc07421e669a3ae3c1c080', 'Bachelor Degree', 'Accountant', 'Gladness Rodgers', 'Wife', '0768565960', '', '', 1679259600, 1),
(203, 'Rosemary John Ntemi', '0787176781', 'Female', 'rj241140@gmail.com', '', '', 50, 2, 1661979600, 1725051600, 4, 'pharmacist', 'f608e9e957d5a46ed9e3544073d1d2b3', 'Diploma', 'pharmaceutical technician', 'Mary Charles', 'mother', '0767089605', 'Buswelu', '', 1679346000, 1),
(204, 'Reception OPD', '00000000', 'Female', 'receptionelct@gmail.com', '', '', 57, 2, 1679950800, 1680296400, 2, 'receptionist', '86ff51b8fd8e352d146d1ed6d364b54c', 'Diploma', 'Ass Health recorder', 'recep', 't', '00000', 'Buswelu', '', 1679950800, 1),
(205, 'pharmacy', '00000000', 'Male', 'pharmacyelct@gmail.com', '', '', 50, 2, 1679864400, 1680296400, 2, 'pharmacist', '244e347feaae88e55b29401431e98953', 'Diploma', 'pharmaceutical technician', 'recep', 't', '00000', 'Buswelu', '', 1679950800, 1),
(206, 'Nurse opd', '00000000', 'Female', 'nurseelct@gmail.com', '', '', 6, 2, 1679864400, 1680296400, 2, 'nurse', 'e58aaacd102d22053d8eb66c84a45e64', 'Diploma', 'nurse', 'recep', 't', '00000', 'Buswelu', '', 1679950800, 1),
(207, 'Cashier OPD', '00000000', 'Female', 'cashierelct@gmail.com', '', '', 16, 2, 1643317200, 1680210000, 2, 'cashier', 'e63d8ba628d547a9d13d1752a5131d55', 'Certificate', '', 'cash', 'Money', '00000', 'Nansio', '', 1679950800, 1),
(208, 'Radiology', '00000000', 'Male', 'radiologyelct@gmail.com', '', '', 14, 2, 1679778000, 1680296400, 2, 'radiographer', 'e560f3e4a6fb61bd350ad3a052959507', 'Diploma', 'radiologist', 'recep', 't', '00000', 'Buswelu', '', 1679950800, 1),
(209, 'Laboratory OPD', '0000000', 'Male', 'labelct@gmail.com', '', '', 59, 2, 1643576400, 1685480400, 2, 'lab technician', '2e63a2fa2a70d228b8b7a7c2e9bf303d', 'Diploma', '', 'Lab', 'Reagents', '00000', 'h', '', 1679950800, 1),
(210, 'labtech', '000000', 'Male', 'test@lab.com', '', '', 59, 2, 1681074000, 1683320400, 2, 'lab technician', 'c71d3bab952a255840a7c8fcae218ab2', 'Bachelor Degree', '344rtg', '', '', '00000', '00000000000', '', 1681765200, 1),
(211, 'ufanisi Radiology', '0700497648', 'Male', 'radiology@elctelvdhospital.info', '', 'jpg', 0, 2, 1687813200, 1719522000, 0, 'radiographer', 'e10adc3949ba59abbe56e057f20f883e', '', 'Radiologgraphy', 'dorice ufanisi', 'Sister', '0747653863', 'Igoma', '5', 1687899600, 1),
(212, 'Mpoki Jafari', '0752011567', 'Male', 'jafampoki@gmail.com', '', 'jpg', 4, 1, 1671656400, 1924117200, 5, 'admin', '3d99703e3833a0a4d01b7be2148824bc', 'Bachelor Degree', '', '0626930314', 'wife', '0765898344', '423Mwanza', '5', 1690232400, 1),
(213, 'Head Physician Doctor', '0784000000', 'Male', 'head@elctelvdhospital.info', 'head', 'jpg', 19, 1, 1691442000, 1754600400, 0, 'head physician', 'e10adc3949ba59abbe56e057f20f883e', 'Post Graduate', '5', 'Test Emmergency Name', 'Brother', '0788000000', 'Kiseke', '6', 1691442000, 1),
(214, 'Ufanisi Technologist', '0754000000', 'Male', 'technologist@elctelvdhospital.info', 'technologist', 'jpg', 59, 14, 1690837200, 1724619600, 0, 'lab technologist', 'e10adc3949ba59abbe56e057f20f883e', 'Bachelor Degree', '10', 'Test Technologist Emmergency', 'Brother', '0783000000', 'Butimba', '7', 1692997200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffdepts`
--

CREATE TABLE `staffdepts` (
  `staffdept_id` int(11) NOT NULL,
  `servicecategory_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffdepts`
--

INSERT INTO `staffdepts` (`staffdept_id`, `servicecategory_id`, `staff_id`, `status`) VALUES
(203, 23, 96, 1),
(252, 8, 21, 1),
(146, 24, 93, 1),
(191, 22, 98, 1),
(32, 3, 31, 1),
(195, 21, 95, 1),
(69, 24, 94, 1),
(33, 4, 31, 1),
(34, 5, 31, 1),
(35, 6, 31, 1),
(36, 7, 31, 1),
(37, 8, 31, 1),
(38, 9, 31, 1),
(39, 10, 31, 1),
(40, 11, 31, 1),
(41, 12, 31, 1),
(42, 13, 31, 1),
(43, 14, 31, 1),
(44, 15, 31, 1),
(45, 16, 31, 1),
(46, 17, 31, 1),
(47, 18, 31, 1),
(48, 19, 31, 1),
(49, 20, 31, 1),
(50, 21, 31, 1),
(51, 22, 31, 1),
(52, 23, 31, 1),
(53, 24, 31, 1),
(54, 25, 31, 1),
(55, 26, 31, 1),
(173, 9, 99, 1),
(57, 26, 30, 1),
(214, 23, 111, 1),
(286, 6, 34, 1),
(123, 26, 33, 1),
(319, 27, 64, 1),
(70, 24, 0, 1),
(71, 26, 0, 1),
(72, 24, 101, 1),
(73, 26, 101, 1),
(74, 6, 0, 1),
(75, 24, 0, 1),
(76, 6, 0, 1),
(77, 24, 0, 1),
(78, 26, 0, 1),
(318, 23, 64, 1),
(139, 24, 55, 1),
(82, 24, 102, 1),
(83, 28, 102, 1),
(84, 17, 58, 1),
(359, 17, 91, 1),
(86, 17, 36, 1),
(97, 28, 40, 1),
(98, 28, 0, 1),
(99, 28, 103, 1),
(100, 28, 29, 1),
(101, 26, 104, 1),
(102, 28, 105, 1),
(103, 26, 106, 1),
(110, 28, 32, 1),
(111, 28, 69, 1),
(112, 28, 26, 1),
(113, 28, 70, 1),
(279, 26, 107, 1),
(115, 26, 44, 1),
(116, 26, 35, 1),
(119, 27, 24, 1),
(317, 27, 62, 1),
(322, 23, 108, 1),
(263, 6, 51, 1),
(306, 6, 59, 1),
(127, 6, 48, 1),
(292, 3, 54, 1),
(358, 28, 74, 1),
(350, 8, 52, 1),
(208, 32, 109, 1),
(132, 18, 25, 1),
(201, 22, 110, 1),
(186, 18, 117, 1),
(272, 6, 112, 1),
(154, 18, 37, 1),
(157, 18, 43, 1),
(183, 5, 49, 1),
(205, 24, 113, 1),
(207, 24, 109, 1),
(206, 6, 109, 1),
(179, 18, 114, 1),
(171, 18, 115, 1),
(172, 27, 116, 1),
(187, 5, 50, 1),
(184, 9, 49, 1),
(188, 9, 50, 1),
(193, 22, 97, 1),
(194, 33, 97, 1),
(196, 3, 118, 1),
(200, 16, 110, 1),
(229, 27, 100, 1),
(202, 26, 110, 1),
(204, 27, 96, 1),
(218, 28, 119, 1),
(217, 24, 119, 1),
(216, 6, 119, 1),
(212, 6, 120, 1),
(213, 24, 120, 1),
(215, 27, 111, 1),
(262, 28, 121, 1),
(261, 24, 121, 1),
(260, 6, 121, 1),
(255, 18, 22, 1),
(254, 8, 22, 1),
(227, 21, 122, 1),
(228, 17, 123, 1),
(230, 29, 100, 1),
(245, 34, 127, 1),
(307, 6, 124, 1),
(233, 6, 125, 1),
(234, 24, 125, 1),
(235, 21, 126, 1),
(237, 13, 42, 1),
(238, 36, 42, 1),
(243, 4, 85, 1),
(242, 4, 57, 1),
(246, 5, 88, 1),
(247, 9, 88, 1),
(248, 31, 88, 1),
(251, 3, 21, 1),
(253, 18, 21, 1),
(256, 25, 22, 1),
(264, 24, 51, 1),
(265, 6, 0, 1),
(266, 24, 0, 1),
(267, 28, 0, 1),
(268, 6, 0, 1),
(269, 24, 0, 1),
(270, 6, 0, 1),
(271, 24, 0, 1),
(273, 24, 112, 1),
(274, 34, 112, 1),
(275, 6, 128, 1),
(276, 24, 128, 1),
(280, 34, 129, 1),
(281, 37, 129, 1),
(282, 38, 129, 1),
(283, 37, 130, 1),
(284, 38, 130, 1),
(287, 28, 34, 1),
(288, 28, 131, 1),
(289, 28, 132, 1),
(290, 28, 133, 1),
(291, 28, 134, 1),
(293, 8, 54, 1),
(349, 3, 52, 1),
(296, 3, 53, 1),
(297, 8, 53, 1),
(298, 3, 135, 1),
(299, 8, 135, 1),
(300, 6, 0, 1),
(301, 24, 0, 1),
(302, 6, 136, 1),
(303, 24, 136, 1),
(304, 5, 87, 1),
(305, 9, 87, 1),
(308, 24, 124, 1),
(309, 27, 20, 1),
(316, 23, 62, 1),
(321, 27, 137, 1),
(320, 23, 137, 1),
(314, 3, 0, 1),
(315, 3, 0, 1),
(323, 27, 108, 1),
(327, 37, 138, 1),
(326, 26, 138, 1),
(328, 23, 0, 1),
(329, 27, 0, 1),
(335, 27, 139, 1),
(334, 23, 139, 1),
(336, 21, 0, 1),
(340, 9, 140, 1),
(339, 5, 140, 1),
(341, 10, 141, 1),
(342, 11, 141, 1),
(343, 21, 142, 1),
(344, 6, 143, 1),
(345, 24, 143, 1),
(346, 34, 143, 1),
(348, 32, 144, 1),
(351, 28, 52, 1),
(354, 37, 145, 1),
(353, 37, 146, 1),
(355, 28, 147, 1),
(356, 6, 148, 1),
(357, 24, 148, 1),
(360, 17, 149, 1),
(361, 34, 150, 1),
(362, 37, 150, 1),
(363, 37, 151, 1),
(365, 21, 152, 1),
(379, 29, 158, 1),
(378, 27, 158, 1),
(377, 18, 157, 1),
(376, 21, 153, 1),
(373, 21, 154, 1),
(374, 21, 155, 1),
(375, 21, 156, 1),
(380, 18, 159, 1),
(381, 28, 160, 1),
(382, 21, 161, 1),
(384, 17, 162, 1),
(385, 27, 163, 1),
(386, 40, 163, 1),
(387, 29, 164, 1),
(388, 4, 165, 1),
(389, 16, 165, 1),
(390, 21, 165, 1),
(391, 6, 166, 1),
(392, 16, 166, 1),
(393, 26, 166, 1),
(394, 26, 167, 1),
(395, 6, 168, 1),
(396, 26, 168, 1),
(397, 27, 169, 1),
(398, 40, 169, 1),
(399, 29, 170, 1),
(400, 28, 171, 1),
(401, 28, 172, 1),
(402, 29, 172, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stillbirthstatus`
--

CREATE TABLE `stillbirthstatus` (
  `stillbirthstatus_id` int(11) NOT NULL,
  `stillbirthstatus` varchar(500) NOT NULL,
  `childbirth_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

CREATE TABLE `stockitems` (
  `stockitem_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store` int(11) DEFAULT NULL,
  `type` varchar(120) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `expiry` date DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `pharstockorder_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`stockitem_id`, `product_id`, `store`, `type`, `quantity`, `expiry`, `admin_id`, `timestamp`, `status`, `pharstockorder_id`) VALUES
(1, 67, 3, NULL, 10, NULL, 202, 1679300856, 1, NULL),
(2, 100, 3, NULL, 300, NULL, 202, 1679398202, 1, NULL),
(3, 44, 3, NULL, 6, NULL, 202, 1679398317, 1, NULL),
(4, 44, 3, NULL, 6, NULL, 202, 1679398426, 1, NULL),
(5, 46, 3, NULL, 60, NULL, 202, 1679398468, 1, NULL),
(6, 45, 3, NULL, 60, NULL, 202, 1679398502, 1, NULL),
(7, 45, 3, NULL, 60, NULL, 202, 1679398525, 1, NULL),
(8, 87, 3, NULL, 40, NULL, 202, 1679398615, 1, NULL),
(9, 94, 3, NULL, 25, NULL, 202, 1679398816, 1, NULL),
(10, 93, 3, NULL, 100, NULL, 202, 1679398909, 1, NULL),
(11, 35, 3, NULL, 2000, NULL, 202, 1679399356, 1, NULL),
(12, 136, 3, NULL, 4245, NULL, 202, 1679399391, 1, NULL),
(13, 36, 3, NULL, 500, NULL, 202, 1679399437, 1, NULL),
(14, 52, 3, NULL, 20, NULL, 202, 1679400481, 1, NULL),
(15, 48, 3, NULL, 40, NULL, 202, 1679400481, 1, NULL),
(16, 39, 3, NULL, 1000, NULL, 202, 1679400481, 1, NULL),
(17, 49, 3, NULL, 30, NULL, 202, 1679400481, 1, NULL),
(18, 50, 3, NULL, 10, NULL, 202, 1679400481, 1, NULL),
(19, 133, 3, NULL, 400, NULL, 202, 1679400481, 1, NULL),
(20, 68, 3, NULL, 126, NULL, 202, 1679400481, 1, NULL),
(21, 69, 3, NULL, 30, NULL, 202, 1679400481, 1, NULL),
(22, 40, 3, NULL, 39, NULL, 202, 1679400481, 1, NULL),
(23, 41, 3, NULL, 30, NULL, 202, 1679400481, 1, NULL),
(24, 146, 3, NULL, 60, NULL, 202, 1679400481, 1, NULL),
(25, 168, 3, NULL, 15, NULL, 202, 1679400481, 1, NULL),
(26, 134, 3, NULL, 400, NULL, 202, 1679400481, 1, NULL),
(27, 173, 3, NULL, 12, NULL, 202, 1679400481, 1, NULL),
(28, 57, 3, NULL, 100, NULL, 202, 1679400481, 1, NULL),
(29, 58, 3, NULL, 100, NULL, 202, 1679400481, 1, NULL),
(30, 56, 3, NULL, 150, NULL, 202, 1679400481, 1, NULL),
(31, 62, 3, NULL, 10, NULL, 202, 1679400481, 1, NULL),
(32, 148, 3, NULL, 10, NULL, 202, 1679400481, 1, NULL),
(33, 55, 3, NULL, 30, NULL, 202, 1679401210, 1, NULL),
(34, 147, 3, NULL, 1400, NULL, 202, 1679401210, 1, NULL),
(35, 78, 3, NULL, 1000, NULL, 202, 1679401210, 1, NULL),
(36, 151, 3, NULL, 4000, NULL, 202, 1679401210, 1, NULL),
(37, 80, 3, NULL, 10, NULL, 202, 1679401210, 1, NULL),
(38, 165, 3, NULL, 10, NULL, 202, 1679401210, 1, NULL),
(39, 166, 3, NULL, 10, NULL, 202, 1679401210, 1, NULL),
(40, 79, 3, NULL, 55, NULL, 202, 1679401210, 1, NULL),
(41, 158, 3, NULL, 10, NULL, 202, 1679401210, 1, NULL),
(42, 159, 3, NULL, 180, NULL, 202, 1679401210, 1, NULL),
(43, 160, 3, NULL, 25, NULL, 202, 1679401210, 1, NULL),
(44, 167, 3, NULL, 5, NULL, 202, 1679401210, 1, NULL),
(45, 70, 3, NULL, 500, NULL, 202, 1679401210, 1, NULL),
(46, 71, 3, NULL, 15, NULL, 202, 1679401210, 1, NULL),
(47, 141, 3, NULL, 60, NULL, 202, 1679401210, 1, NULL),
(48, 142, 3, NULL, 300, NULL, 202, 1679401210, 1, NULL),
(49, 106, 3, NULL, 80, NULL, 202, 1679401210, 1, NULL),
(50, 63, 3, NULL, 100, NULL, 202, 1679401210, 1, NULL),
(51, 107, 3, NULL, 420, NULL, 202, 1679401210, 1, NULL),
(52, 67, 3, NULL, 5, NULL, 202, 1679401210, 1, NULL),
(53, 88, 3, NULL, 1000, NULL, 202, 1679401210, 1, NULL),
(54, 102, 3, NULL, 170, NULL, 202, 1679401899, 1, NULL),
(55, 42, 3, NULL, 160, NULL, 202, 1679401899, 1, NULL),
(56, 163, 3, NULL, 250, NULL, 202, 1679401899, 1, NULL),
(57, 89, 3, NULL, 1600, NULL, 202, 1679401899, 1, NULL),
(58, 129, 3, NULL, 1400, NULL, 202, 1679401899, 1, NULL),
(59, 138, 3, NULL, 30, NULL, 202, 1679401899, 1, NULL),
(60, 64, 3, NULL, 100, NULL, 202, 1679401899, 1, NULL),
(61, 154, 3, NULL, 450, NULL, 202, 1679401899, 1, NULL),
(62, 90, 3, NULL, 10, NULL, 202, 1679401899, 1, NULL),
(63, 137, 3, NULL, 6, NULL, 202, 1679401899, 1, NULL),
(64, 144, 3, NULL, 30, NULL, 202, 1679401899, 1, NULL),
(65, 143, 3, NULL, 10, NULL, 202, 1679401899, 1, NULL),
(66, 104, 3, NULL, 20, NULL, 202, 1679401899, 1, NULL),
(67, 108, 3, NULL, 1000, NULL, 202, 1679479444, 1, NULL),
(68, 109, 3, NULL, 10, NULL, 202, 1679479444, 1, NULL),
(69, 149, 3, NULL, 10, NULL, 202, 1679490848, 1, NULL),
(70, 121, 3, NULL, 100, NULL, 202, 1679490848, 1, NULL),
(71, 115, 3, NULL, 400, NULL, 202, 1679490848, 1, NULL),
(72, 99, 3, NULL, 200, NULL, 202, 1679490848, 1, NULL),
(73, 152, 3, NULL, 1400, NULL, 202, 1679490848, 1, NULL),
(74, 153, 3, NULL, 60, NULL, 202, 1679490848, 1, NULL),
(75, 72, 3, NULL, 3000, NULL, 202, 1679490848, 1, NULL),
(76, 174, 3, NULL, 5, NULL, 202, 1679490848, 1, NULL),
(77, 74, 3, NULL, 60, NULL, 202, 1679490848, 1, NULL),
(78, 73, 3, NULL, 20, NULL, 202, 1679490848, 1, NULL),
(79, 177, 3, NULL, 36, NULL, 202, 1679490848, 1, NULL),
(80, 77, 3, NULL, 30, NULL, 202, 1679490848, 1, NULL),
(81, 135, 3, NULL, 1500, NULL, 202, 1679492399, 1, NULL),
(82, 83, 3, NULL, 700, NULL, 202, 1679492399, 1, NULL),
(83, 155, 3, NULL, 20, NULL, 202, 1679492399, 1, NULL),
(84, 157, 3, NULL, 500, NULL, 202, 1679492399, 1, NULL),
(85, 125, 3, NULL, 1500, NULL, 202, 1679492399, 1, NULL),
(86, 126, 3, NULL, 5, NULL, 202, 1679492399, 1, NULL),
(87, 124, 3, NULL, 10, NULL, 202, 1679492399, 1, NULL),
(88, 123, 3, NULL, 690, NULL, 202, 1679492399, 1, NULL),
(89, 110, 3, NULL, 4000, NULL, 202, 1679492399, 1, NULL),
(90, 113, 3, NULL, 20, NULL, 202, 1679492399, 1, NULL),
(91, 112, 3, NULL, 70, NULL, 202, 1679492399, 1, NULL),
(92, 111, 3, NULL, 15, NULL, 202, 1679492399, 1, NULL),
(93, 96, 3, NULL, 500, NULL, 202, 1679492399, 1, NULL),
(94, 132, 3, NULL, 300, NULL, 202, 1679492399, 1, NULL),
(95, 119, 3, NULL, 21, NULL, 202, 1679492399, 1, NULL),
(96, 120, 3, NULL, 25, NULL, 202, 1679492399, 1, NULL),
(97, 92, 3, NULL, 3, NULL, 202, 1679492399, 1, NULL),
(98, 76, 3, NULL, 40, NULL, 202, 1679492399, 1, NULL),
(99, 175, 3, NULL, 29, NULL, 202, 1679492399, 1, NULL),
(100, 91, 3, NULL, 700, NULL, 202, 1679492399, 1, NULL),
(101, 130, 3, NULL, 10, NULL, 202, 1679492399, 1, NULL),
(102, 122, 3, NULL, 10, NULL, 202, 1679492399, 1, NULL),
(103, 75, 3, NULL, 280, NULL, 202, 1679492399, 1, NULL),
(104, 98, 3, NULL, 1800, NULL, 202, 1679492399, 1, NULL),
(105, 97, 3, NULL, 30, NULL, 202, 1679492399, 1, NULL),
(106, 232, 3, 'Medicine', 500, '2023-05-31', 202, 1680159233, 1, NULL),
(107, 232, 3, 'Medicine', 20, '2023-05-25', 202, 1680159233, 1, NULL),
(108, 100, 3, 'Medicine', 100, '2027-10-22', 175, 1690379653, 1, NULL),
(109, 113, 3, NULL, 5000, '2030-06-12', 175, 1690385906, 1, NULL),
(110, 100, 3, 'Medicine', 1000, '2023-12-06', 175, 1691355271, 1, NULL),
(111, 101, 3, 'Medicine', 1200, '2023-11-15', 175, 1691355271, 1, NULL),
(112, 179, 3, 'Medicine', 800, '2023-11-21', 175, 1691355271, 1, NULL),
(113, 183, 3, 'Medicine', 1300, '2023-10-10', 175, 1691355271, 1, NULL),
(114, 101, 2, 'Medicine', 100, '2023-11-15', 168, 1691408093, 3, 1),
(115, 179, 2, 'Medicine', 200, '2023-11-21', 168, 1691408093, 3, 1),
(116, 183, 2, 'Medicine', 250, '2023-10-10', 168, 1691408093, 3, 1),
(117, 232, 2, 'Medicine', 100, '2023-05-31', 168, 1691408093, 3, 1),
(118, 101, 2, 'Medicine', 200, '2023-11-15', 168, 1691489735, 1, 2),
(119, 179, 2, 'Medicine', 150, '2023-11-21', 168, 1691489735, 1, 2),
(120, 183, 2, 'Medicine', 300, '2023-10-10', 168, 1691489735, 1, 2),
(121, 232, 2, 'Medicine', 100, '2023-05-31', 168, 1691489735, 1, 2),
(122, 239, 3, 'Medical', 100, '0000-00-00', 175, 1691587455, 1, NULL),
(123, 237, 3, 'Medical', 200, '0000-00-00', 175, 1691587455, 1, NULL),
(124, 238, 3, 'Medical', 200, '0000-00-00', 175, 1691587455, 1, NULL),
(125, 236, 3, 'Medical', 500, '0000-00-00', 175, 1691587455, 1, NULL),
(126, 239, 2, 'Medical', 50, '0000-00-00', 168, 1691587676, 1, 3),
(127, 237, 2, 'Medical', 20, '0000-00-00', 168, 1691587676, 1, 3),
(128, 238, 2, 'Medical', 30, '0000-00-00', 168, 1691587676, 1, 3),
(129, 236, 2, 'Medical', 50, '0000-00-00', 168, 1691587676, 1, 3),
(130, 244, 3, 'Non Medical', 15, '0000-00-00', 175, 1691600901, 1, NULL),
(131, 241, 3, 'Non Medical', 50, '0000-00-00', 175, 1691600901, 1, NULL),
(132, 242, 3, 'Non Medical', 100, '0000-00-00', 175, 1691600901, 1, NULL),
(133, 243, 3, 'Non Medical', 20, '0000-00-00', 175, 1691600901, 1, NULL),
(134, 240, 3, 'Non Medical', 50, '0000-00-00', 175, 1691600901, 1, NULL),
(135, 100, 3, 'Medicine', 200, '2027-12-31', 175, 1692304099, 1, NULL),
(136, 100, 2, 'Medicine', 100, '0000-00-00', 168, 1692304305, 3, 4),
(137, 100, 2, 'Medicine', 23, '2023-08-24', 168, 1692856067, 3, 5),
(138, 101, 2, 'Medicine', 100, '2023-11-15', 168, 1692856067, 3, 5),
(139, 179, 2, 'Medicine', 200, '2023-11-21', 168, 1692856067, 3, 5),
(140, 179, 2, 'Medicine', 10, '2023-11-21', 182, 1692856752, 3, 5),
(141, 100, 3, 'Medicine', 400, '2026-06-21', 175, 1692914062, 1, NULL),
(142, 188, 3, 'Medicine', 600, '2024-05-03', 175, 1692914062, 1, NULL),
(143, 179, 3, 'Medicine', 699, '2028-07-28', 175, 1692914062, 1, NULL),
(144, 248, 3, 'Medical', 60, '0000-00-00', 175, 1692914116, 1, NULL),
(145, 249, 3, 'Medical', 700, '0000-00-00', 175, 1692914116, 1, NULL),
(146, 239, 3, 'Medical', 90, '0000-00-00', 175, 1692914116, 1, NULL),
(147, 237, 3, 'Medical', 100, '0000-00-00', 175, 1692914116, 1, NULL),
(148, 236, 3, 'Medical', 80, '0000-00-00', 175, 1692914116, 1, NULL),
(149, 239, 3, 'Medical', 500, '0000-00-00', 175, 1692914116, 1, NULL),
(150, 250, 3, 'Non Medical', 5, '0000-00-00', 175, 1692914146, 1, NULL),
(151, 244, 3, 'Non Medical', 29, '0000-00-00', 175, 1692914146, 1, NULL),
(152, 243, 3, 'Non Medical', 56, '0000-00-00', 175, 1692914146, 1, NULL),
(153, 250, 3, 'Non Medical', 500, '0000-00-00', 175, 1692914678, 1, NULL),
(154, 244, 3, 'Non Medical', 540, '0000-00-00', 175, 1692914678, 1, NULL),
(155, 242, 3, 'Non Medical', 3354, '0000-00-00', 175, 1692914678, 1, NULL),
(156, 241, 3, 'Non Medical', 234, '0000-00-00', 175, 1692914678, 1, NULL),
(157, 250, 3, 'Non Medical', 30, '0000-00-00', 175, 1692914678, 1, NULL),
(158, 179, 2, 'Medicine', 45, '2023-11-21', 168, 1692915700, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `stockorders`
--

CREATE TABLE `stockorders` (
  `stockorder_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `type` varchar(125) DEFAULT NULL,
  `approvedby` varchar(11) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockorders`
--

INSERT INTO `stockorders` (`stockorder_id`, `section`, `reason`, `type`, `approvedby`, `admin_id`, `timestamp`, `status`) VALUES
(1, 'pharmacy', '0', NULL, NULL, 205, 1680176268, 1),
(2, 'pharmacy', '0', NULL, NULL, 205, 1680176713, 1),
(3, 'pharmacy', '0', NULL, NULL, 205, 1681736897, 4),
(4, 'doctor', '0', NULL, NULL, 165, 1690443186, 0),
(5, 'nurse', '0', 'Medicine', NULL, 166, 1690956158, 4),
(6, 'nurse', '0', 'Medicine', NULL, 166, 1691048292, 0),
(7, 'nurse', '0', 'Medicine', '213', 166, 1691579556, 1),
(8, 'lab', '0', 'Medical', '213', 167, 1691588485, 1),
(9, 'pharmacy', '0', 'Non Medical', NULL, 168, 1691601250, 0),
(10, 'pharmacy', '0', '', '182', 168, 1692856827, 1),
(11, 'nurse', '0', 'Medicine', NULL, 166, 1692857482, 0),
(12, 'lab', '0', '', '182', 167, 1692914735, 1),
(13, 'lab', '0', '', '182', 167, 1692914757, 1),
(14, 'lab', '0', '', '182', 167, 1692914784, 1),
(15, 'pharmacy', '0', '', NULL, 168, 1692915509, 0),
(16, 'pharmacy', '0', '', '182', 168, 1692915531, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `store` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store`, `status`) VALUES
(1, 'store 1', 0),
(2, 'PHARMACY', 0),
(3, 'MAIN STORE', 1),
(4, 'laboratory', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `subcategory`, `category_id`, `status`) VALUES
(1, 'AnalgÃ©siques non opioÃ¯des et anti-inflammatoires non stÃ©roÃ¯diens', 10, 1),
(2, 'AnalgÃ©siques opioÃ¯des', 10, 1),
(3, 'Antigoutteux', 10, 1),
(4, 'Anthelminthiques', 8, 1),
(5, 'AntibactÃ©riens', 8, 1),
(6, 'Antifongiques', 8, 0),
(7, 'Antifongiques', 8, 1),
(8, 'Antiviraux', 8, 1),
(9, 'Antiprotozoaires', 8, 1),
(10, 'Traitement de la crise', 11, 1),
(11, 'ProphylaxieÂ ', 11, 1),
(12, 'ImmunodÃ©presseurs', 12, 1),
(13, 'Cytotoxiques', 12, 1),
(14, 'Hormones et antihormones', 12, 1),
(15, 'MÃ©dicaments des soins palliatifs', 12, 1),
(16, 'AntianÃ©miques', 14, 1),
(17, 'MÃ©dicaments de lâ€™hÃ©mostase', 14, 1),
(18, 'Antiangoreux', 16, 1),
(19, 'Antiarythmiques', 16, 1),
(20, 'Antihypertenseurs', 16, 1),
(21, 'MÃ©dicaments de l\'insuffisance cardiaque', 16, 1),
(22, 'Antithrombotiques', 16, 1),
(23, 'HypolipÃ©miants', 16, 1),
(24, 'Antibiotiques', 7, 1),
(25, 'Antiviral', 18, 0),
(26, 'Alpha or beta agonist', 19, 1),
(27, 'Calcium-channel blocker', 25, 1),
(28, 'Penicillin', 26, 1),
(29, 'Cephalosporin', 26, 1),
(30, 'Tetracycline', 26, 1),
(31, 'Aminoglycoside', 26, 1),
(32, 'Macrolide', 26, 1),
(33, 'Sulfonamide', 26, 1),
(34, 'Quinolone', 26, 1),
(35, 'Benzimidazoles', 29, 1),
(36, 'Microcytic', 30, 1),
(37, 'Megaloblastic', 30, 1),
(38, 'Î²2 sympathomimetris', 31, 1),
(39, 'Methylxanthines', 31, 1),
(40, 'Opioid analgesics', 32, 1),
(41, 'Non-opioid analgesics', 32, 1),
(42, 'Histamine antagonistic', 33, 1),
(43, 'Protonpomp inhibitor (PPI)', 33, 1),
(44, 'Thiazide diuretics', 25, 1),
(45, 'Diuretics', 25, 0),
(46, 'Loop diuretic', 25, 1),
(47, 'Potassium sparing diuretics', 25, 1),
(48, 'Central adrenergic inhibitor', 25, 1),
(49, 'Beta blockers non-selective selective', 25, 1),
(50, 'Alpha and beta blockers', 25, 1),
(51, 'ACE inhibitors', 25, 1),
(52, 'Angiotensin II receptor agonist (ARB\'s)', 25, 1),
(53, 'Direct vasodilators', 25, 1),
(54, '1st generation', 34, 1),
(55, '2nd generation', 34, 1),
(56, 'Biguanides', 36, 1),
(57, 'Sulfonylureas', 36, 1),
(58, 'Maglitinide', 36, 1),
(59, 'thiazolinedione', 36, 1),
(60, 'Dipeptidyl peptidase 4 (DPP-4) inhibitors', 36, 1),
(61, 'Sodium-glucose cotransporter (SGLT2) inhibitors', 36, 1),
(62, 'Î±-glucosidase inhibitors', 36, 1),
(63, 'Polyenes', 37, 1),
(64, 'Azoles', 37, 1),
(65, 'Allamines', 37, 1),
(66, 'Echinocandins', 37, 1),
(67, 'Cortcosteroids', 37, 1),
(68, 'Quinoline', 22, 1),
(69, 'Antifolates', 22, 1),
(70, 'Artemisinin derivatives', 22, 1),
(71, 'Antimicrobials', 22, 1),
(72, 'nad', 41, 0),
(73, 'Nad', 27, 0),
(74, 'other', 27, 1),
(75, 'other', 39, 1),
(76, 'other', 41, 1),
(77, 'other', 40, 1),
(78, 'other', 42, 1),
(79, 'other', 43, 1),
(80, 'other', 45, 1),
(81, 'other', 44, 1),
(82, 'other', 46, 1),
(83, 'other', 26, 1),
(84, 'other', 47, 1),
(85, 'other', 48, 1),
(86, 'other', 49, 1),
(87, 'other', 50, 0),
(88, 'Other', 50, 1),
(89, 'Other', 24, 1),
(90, 'Other', 21, 1),
(91, 'Other', 20, 1),
(92, 'Other', 35, 1),
(93, 'Other', 4, 1),
(94, 'Other', 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplierproducts`
--

CREATE TABLE `supplierproducts` (
  `supplierproduct_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplierproducts`
--

INSERT INTO `supplierproducts` (`supplierproduct_id`, `product_id`, `price`, `supplier_id`, `status`) VALUES
(23, 35, 100, 8, 1),
(24, 38, 150, 8, 1),
(25, 39, 500, 8, 1),
(26, 103, 1000, 9, 1),
(27, 53, 300, 9, 1),
(28, 63, 500, 9, 1),
(29, 38, 250, 9, 1),
(30, 236, 200, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `suppliername` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `suppliername`, `address`, `phone`, `email`, `admin_id`, `timestamp`, `status`) VALUES
(8, 'ABC Pharmaceutical Limited', 'Lwagasole', '0784000000', 'abcpharma@gmail.com', 182, 1691182800, 1),
(9, 'Ufanisi Supplier', 'Mwanza', '070000000', 'supplier@ufanisi.com', 182, 1691269200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `surgeryhistory`
--

CREATE TABLE `surgeryhistory` (
  `surgeryhistory_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgeryhistory`
--

INSERT INTO `surgeryhistory` (`surgeryhistory_id`, `patient_id`, `month`, `year`, `status`) VALUES
(46, 4, '', '', 1),
(47, 2, 'February', '2005', 1),
(48, 6, '', '', 1),
(49, 7, 'June', '2013', 1),
(50, 8, '', '', 1),
(51, 9, '', '', 1),
(52, 10, '', '', 1),
(53, 11, '', '', 1),
(54, 12, '', '', 1),
(55, 13, 'October', '2018', 1),
(56, 14, '', '', 1),
(57, 18, '', '2022', 1),
(58, 15, '', '', 1),
(59, 17, '', '', 1),
(60, 25, '', '', 1),
(61, 21, 'November', '2018', 1),
(62, 21, '', '', 1),
(63, 21, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_name`
--

CREATE TABLE `table_name` (
  `Generic_name` varchar(100) DEFAULT NULL,
  `Commercial_name` varchar(100) DEFAULT NULL,
  `Pharmacological_class` varchar(100) DEFAULT NULL,
  `Measurement_unit` varchar(100) DEFAULT NULL,
  `pharmaceutical_form` varchar(100) DEFAULT NULL,
  `Dosage` double DEFAULT NULL,
  `Prix` double DEFAULT NULL,
  `Minimum_reorder_point` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfusions`
--

CREATE TABLE `transfusions` (
  `transfusion_id` int(11) NOT NULL,
  `patientsque_id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `requesttime` varchar(10) NOT NULL,
  `bloodtype` int(11) NOT NULL,
  `quantityrequested` varchar(10) NOT NULL,
  `packetsrequested` int(11) NOT NULL,
  `quantityreceived` varchar(10) NOT NULL,
  `packetsreceived` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `receipttime` varchar(10) NOT NULL,
  `packetnumbers` varchar(200) NOT NULL,
  `response` varchar(20) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unitmeasurements`
--

CREATE TABLE `unitmeasurements` (
  `measurement_id` int(11) NOT NULL,
  `measurement` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitmeasurements`
--

INSERT INTO `unitmeasurements` (`measurement_id`, `measurement`, `status`) VALUES
(1, 'Milligram', 0),
(2, 'Gram', 0),
(3, 'Tablet', 1),
(4, 'Tube', 1),
(5, 'Ample', 1),
(6, 'Bottle', 1),
(7, 'Strip', 1),
(8, 'Capsule', 1),
(9, 'Vial', 1),
(10, 'Vial', 0),
(11, 'Gel', 1),
(12, 'Each', 1),
(13, 'Box', 1),
(14, 'Bottle', 1),
(15, 'Piece', 1),
(16, 'Ream', 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `measurement_id` int(11) NOT NULL,
  `measurement` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`measurement_id`, `measurement`, `status`) VALUES
(1, 'Î¼IU / ml', 1),
(2, 'ng / ml', 1),
(3, 'nmol / L', 1),
(4, 'Pmol / L', 1),
(5, 'micrograme/ml', 1),
(6, 'Pmol / ml', 1),
(7, '%', 1),
(8, 'mmol/l', 1),
(9, 'Ul/l', 1),
(10, 'UI/24H', 1),
(11, 'g/l', 1),
(12, 'Î¼mol/l', 1),
(13, 'UI/ml', 1),
(14, '3.8-5.8%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usedcredit`
--

CREATE TABLE `usedcredit` (
  `usedcredit_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `creditclient_id` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usedcredit`
--

INSERT INTO `usedcredit` (`usedcredit_id`, `service_id`, `creditclient_id`, `date`, `amount`, `status`) VALUES
(8, 13, 3, '1690232400', 1500, 1),
(9, 13, 3, '1690232400', 5000, 1),
(10, 13, 3, '1690232400', 3000, 1),
(11, 17, 3, '1690318800', 1500, 1),
(12, 17, 3, '1690318800', 10000, 1),
(13, 17, 3, '1690405200', 5000, 1),
(14, 17, 3, '1690405200', 25000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `ward_id` int(11) NOT NULL,
  `wardname` varchar(200) NOT NULL,
  `wardtype_id` int(11) NOT NULL,
  `bedfee` varchar(10) DEFAULT NULL,
  `creditfee` varchar(10) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`ward_id`, `wardname`, `wardtype_id`, `bedfee`, `creditfee`, `status`) VALUES
(3, 'Lit 1', 3, NULL, NULL, 0),
(4, 'Lit 2', 3, NULL, NULL, 0),
(5, 'COMMON ROOM 47', 3, NULL, NULL, 0),
(6, 'VIP 44', 9, NULL, NULL, 0),
(7, 'VIP 45', 9, NULL, NULL, 0),
(8, 'COMMON ROOM 48', 3, NULL, NULL, 0),
(9, 'COMMON ROOM 49', 3, NULL, NULL, 0),
(10, 'COMMON ROOM 50', 3, NULL, NULL, 0),
(11, 'COMMON ROOM 51', 3, NULL, NULL, 0),
(12, 'ROOM 21', 12, NULL, NULL, 0),
(13, 'ROOM 22', 12, NULL, NULL, 0),
(14, 'ROOM  24', 12, NULL, NULL, 0),
(15, 'ROOM 26', 12, NULL, NULL, 0),
(16, 'ROOM 27', 12, NULL, NULL, 0),
(17, 'ROOM 30', 12, NULL, NULL, 0),
(18, 'ROOM 32', 12, NULL, NULL, 0),
(19, 'ROOM 33', 12, NULL, NULL, 0),
(20, 'ROOM 31', 12, NULL, NULL, 0),
(21, 'ROOM 28', 12, NULL, NULL, 0),
(22, 'ROOM 29', 12, NULL, NULL, 0),
(23, 'INTENSIVE CARE', 13, NULL, NULL, 0),
(24, 'Patricia', 9, '10000', '10000', 1),
(25, 'Labour', 1, '10000', '10000', 1),
(26, 'Patricia 2', 12, '10000', '10000', 1),
(27, 'Common room', 13, '10000', '10000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wardtypes`
--

CREATE TABLE `wardtypes` (
  `wardtype_id` int(11) NOT NULL,
  `wardtype` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wardtypes`
--

INSERT INTO `wardtypes` (`wardtype_id`, `wardtype`, `status`) VALUES
(1, 'MATERNITY', 1),
(2, 'Paediatric', 0),
(3, 'COMMON ROOM', 0),
(4, 'SALLE COMMUNE No 48', 0),
(5, 'SALLE COMMUNE No 49', 0),
(6, 'SALLE COMMUNE No 50', 0),
(7, 'SALLE COMMUNE No 51', 0),
(8, 'SALLE COMMUNE No 52', 0),
(9, 'MALE', 1),
(10, 'CHAMBRE SIMPLE', 0),
(11, 'AWAKENING', 0),
(12, 'FEMALE', 1),
(13, 'EMERGENCY ROOM', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acts`
--
ALTER TABLE `acts`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`admission_id`);

--
-- Indexes for table `admitted`
--
ALTER TABLE `admitted`
  ADD PRIMARY KEY (`admitted_id`);

--
-- Indexes for table `agegroups`
--
ALTER TABLE `agegroups`
  ADD PRIMARY KEY (`agegroup_id`);

--
-- Indexes for table `ambulantordereditems`
--
ALTER TABLE `ambulantordereditems`
  ADD PRIMARY KEY (`ambulantordereditem_id`);

--
-- Indexes for table `ambulantorders`
--
ALTER TABLE `ambulantorders`
  ADD PRIMARY KEY (`ambulantorder_id`);

--
-- Indexes for table `anaesthesiareport`
--
ALTER TABLE `anaesthesiareport`
  ADD PRIMARY KEY (`anareport_id`);

--
-- Indexes for table `anaesthesiareport2`
--
ALTER TABLE `anaesthesiareport2`
  ADD PRIMARY KEY (`anareport2_id`);

--
-- Indexes for table `anaesthesiareportcns`
--
ALTER TABLE `anaesthesiareportcns`
  ADD PRIMARY KEY (`anareportcns_id`);

--
-- Indexes for table `anaesthesiareportgen`
--
ALTER TABLE `anaesthesiareportgen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anaesthesiareporthem`
--
ALTER TABLE `anaesthesiareporthem`
  ADD PRIMARY KEY (`anareporthem_id`);

--
-- Indexes for table `anaesthesiareportlabs`
--
ALTER TABLE `anaesthesiareportlabs`
  ADD PRIMARY KEY (`anareportlab_id`);

--
-- Indexes for table `anaesthesiareportmont`
--
ALTER TABLE `anaesthesiareportmont`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anaesthesiareportonc`
--
ALTER TABLE `anaesthesiareportonc`
  ADD PRIMARY KEY (`anareportonc_id`);

--
-- Indexes for table `anaesthesiareportoth`
--
ALTER TABLE `anaesthesiareportoth`
  ADD PRIMARY KEY (`anareportoth_id`);

--
-- Indexes for table `anaesthesiareportpe`
--
ALTER TABLE `anaesthesiareportpe`
  ADD PRIMARY KEY (`anareportpe_id`);

--
-- Indexes for table `anaesthesiareportpla`
--
ALTER TABLE `anaesthesiareportpla`
  ADD PRIMARY KEY (`anareportpla_id`);

--
-- Indexes for table `anaesthesiareportpul`
--
ALTER TABLE `anaesthesiareportpul`
  ADD PRIMARY KEY (`anareportpul_id`);

--
-- Indexes for table `anaesthesiareportreext`
--
ALTER TABLE `anaesthesiareportreext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anaesthesiareportreg`
--
ALTER TABLE `anaesthesiareportreg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anaesthesiareportrenal`
--
ALTER TABLE `anaesthesiareportrenal`
  ADD PRIMARY KEY (`anareportrenal_id`);

--
-- Indexes for table `anaesthesiareportven`
--
ALTER TABLE `anaesthesiareportven`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anaesthesiareportvitals`
--
ALTER TABLE `anaesthesiareportvitals`
  ADD PRIMARY KEY (`anareportvit_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `bill_payments`
--
ALTER TABLE `bill_payments`
  ADD PRIMARY KEY (`bill_payment_id`);

--
-- Indexes for table `bloodtypes`
--
ALTER TABLE `bloodtypes`
  ADD PRIMARY KEY (`bloodtype_id`);

--
-- Indexes for table `childbirthoutcomes`
--
ALTER TABLE `childbirthoutcomes`
  ADD PRIMARY KEY (`childbirthoutcome_id`);

--
-- Indexes for table `childbirths`
--
ALTER TABLE `childbirths`
  ADD PRIMARY KEY (`childbirth_id`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`classification_id`);

--
-- Indexes for table `clientcredits`
--
ALTER TABLE `clientcredits`
  ADD PRIMARY KEY (`clientcredit_id`);

--
-- Indexes for table `clinicreport`
--
ALTER TABLE `clinicreport`
  ADD PRIMARY KEY (`clinicreport_id`);

--
-- Indexes for table `clinic_clients`
--
ALTER TABLE `clinic_clients`
  ADD PRIMARY KEY (`clinic_cl_id`);

--
-- Indexes for table `complications`
--
ALTER TABLE `complications`
  ADD PRIMARY KEY (`complication_id`);

--
-- Indexes for table `consumed`
--
ALTER TABLE `consumed`
  ADD PRIMARY KEY (`consumed_id`);

--
-- Indexes for table `consumeditems`
--
ALTER TABLE `consumeditems`
  ADD PRIMARY KEY (`consumeditem_id`);

--
-- Indexes for table `creditclients`
--
ALTER TABLE `creditclients`
  ADD PRIMARY KEY (`creditclient_id`);

--
-- Indexes for table `deliveryevents`
--
ALTER TABLE `deliveryevents`
  ADD PRIMARY KEY (`deliveryevent_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `department_sections`
--
ALTER TABLE `department_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `discharged`
--
ALTER TABLE `discharged`
  ADD PRIMARY KEY (`discharged_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `doctorexam`
--
ALTER TABLE `doctorexam`
  ADD PRIMARY KEY (`doctorexam_id`);

--
-- Indexes for table `doctorreports`
--
ALTER TABLE `doctorreports`
  ADD PRIMARY KEY (`doctorreport_id`);

--
-- Indexes for table `doneexams`
--
ALTER TABLE `doneexams`
  ADD PRIMARY KEY (`doneexam_id`);

--
-- Indexes for table `examcategories`
--
ALTER TABLE `examcategories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `examdetails`
--
ALTER TABLE `examdetails`
  ADD PRIMARY KEY (`examdetail_id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`examination_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `examtypes`
--
ALTER TABLE `examtypes`
  ADD PRIMARY KEY (`examtype_id`);

--
-- Indexes for table `gynaecologyreports`
--
ALTER TABLE `gynaecologyreports`
  ADD PRIMARY KEY (`gynaecologyreport_id`);

--
-- Indexes for table `indications`
--
ALTER TABLE `indications`
  ADD PRIMARY KEY (`indication_id`);

--
-- Indexes for table `insurancecompanies`
--
ALTER TABLE `insurancecompanies`
  ADD PRIMARY KEY (`insurancecompany_id`);

--
-- Indexes for table `insurancetypes`
--
ALTER TABLE `insurancetypes`
  ADD PRIMARY KEY (`insurancetype_id`);

--
-- Indexes for table `insuredinventoryitems`
--
ALTER TABLE `insuredinventoryitems`
  ADD PRIMARY KEY (`insuredinventoryitem_id`);

--
-- Indexes for table `insuredinvestigationtypes`
--
ALTER TABLE `insuredinvestigationtypes`
  ADD PRIMARY KEY (`insuredinvestigationtype_id`);

--
-- Indexes for table `insuredradiotypes`
--
ALTER TABLE `insuredradiotypes`
  ADD PRIMARY KEY (`insuredradiotype_id`);

--
-- Indexes for table `insuredservices`
--
ALTER TABLE `insuredservices`
  ADD PRIMARY KEY (`insuredservice_id`);

--
-- Indexes for table `insuredwards`
--
ALTER TABLE `insuredwards`
  ADD PRIMARY KEY (`insuredward_id`);

--
-- Indexes for table `inventoryitems`
--
ALTER TABLE `inventoryitems`
  ADD PRIMARY KEY (`inventoryitem_id`);

--
-- Indexes for table `investigationselect`
--
ALTER TABLE `investigationselect`
  ADD PRIMARY KEY (`investigationselect_id`);

--
-- Indexes for table `investigationsubtypes`
--
ALTER TABLE `investigationsubtypes`
  ADD PRIMARY KEY (`investigationsubtype_id`);

--
-- Indexes for table `investigationtypes`
--
ALTER TABLE `investigationtypes`
  ADD PRIMARY KEY (`investigationtype_id`);

--
-- Indexes for table `investigationtypesrange`
--
ALTER TABLE `investigationtypesrange`
  ADD PRIMARY KEY (`typesrange_id`);

--
-- Indexes for table `issueddrugs`
--
ALTER TABLE `issueddrugs`
  ADD PRIMARY KEY (`issueddrug_id`);

--
-- Indexes for table `itemcategories`
--
ALTER TABLE `itemcategories`
  ADD PRIMARY KEY (`itemcategory_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `laborders`
--
ALTER TABLE `laborders`
  ADD PRIMARY KEY (`laborder_id`);

--
-- Indexes for table `labreports`
--
ALTER TABLE `labreports`
  ADD PRIMARY KEY (`labreport_id`);

--
-- Indexes for table `labreportsubtype`
--
ALTER TABLE `labreportsubtype`
  ADD PRIMARY KEY (`labsubtype_id`);

--
-- Indexes for table `labunits`
--
ALTER TABLE `labunits`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `medicalcase`
--
ALTER TABLE `medicalcase`
  ADD PRIMARY KEY (`medicalcase_id`);

--
-- Indexes for table `medicalservices`
--
ALTER TABLE `medicalservices`
  ADD PRIMARY KEY (`medicalservice_id`);

--
-- Indexes for table `minor`
--
ALTER TABLE `minor`
  ADD PRIMARY KEY (`minor_id`);

--
-- Indexes for table `noninsuredservices`
--
ALTER TABLE `noninsuredservices`
  ADD PRIMARY KEY (`noninsuredservice_id`);

--
-- Indexes for table `nurseordereditems`
--
ALTER TABLE `nurseordereditems`
  ADD PRIMARY KEY (`nurseordereditem_id`);

--
-- Indexes for table `nurseorders`
--
ALTER TABLE `nurseorders`
  ADD PRIMARY KEY (`nurseorder_id`);

--
-- Indexes for table `nursereports`
--
ALTER TABLE `nursereports`
  ADD PRIMARY KEY (`nursereport_id`);

--
-- Indexes for table `nursingsheetmedications`
--
ALTER TABLE `nursingsheetmedications`
  ADD PRIMARY KEY (`nursingsheetmedication_id`);

--
-- Indexes for table `nursingsheets`
--
ALTER TABLE `nursingsheets`
  ADD PRIMARY KEY (`nursingsheet_id`);

--
-- Indexes for table `observationsheets`
--
ALTER TABLE `observationsheets`
  ADD PRIMARY KEY (`observation_id`);

--
-- Indexes for table `obstetrics`
--
ALTER TABLE `obstetrics`
  ADD PRIMARY KEY (`obstetric_id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `ordereditems`
--
ALTER TABLE `ordereditems`
  ADD PRIMARY KEY (`ordereditem_id`);

--
-- Indexes for table `patienthistory`
--
ALTER TABLE `patienthistory`
  ADD PRIMARY KEY (`patient_history_id`);

--
-- Indexes for table `patientlabs`
--
ALTER TABLE `patientlabs`
  ADD PRIMARY KEY (`patientlab_id`);

--
-- Indexes for table `patientradios`
--
ALTER TABLE `patientradios`
  ADD PRIMARY KEY (`patientradio_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patientservices`
--
ALTER TABLE `patientservices`
  ADD PRIMARY KEY (`patientservice_id`);

--
-- Indexes for table `patientsque`
--
ALTER TABLE `patientsque`
  ADD PRIMARY KEY (`patientsque_id`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`paymentmethod_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `paymethod`
--
ALTER TABLE `paymethod`
  ADD PRIMARY KEY (`paymethod_id`);

--
-- Indexes for table `pharmaceuticalforms`
--
ALTER TABLE `pharmaceuticalforms`
  ADD PRIMARY KEY (`pharmaceuticalform_id`);

--
-- Indexes for table `pharmacologicalclasses`
--
ALTER TABLE `pharmacologicalclasses`
  ADD PRIMARY KEY (`pharmacologicalclass_id`);

--
-- Indexes for table `pharmacyitems`
--
ALTER TABLE `pharmacyitems`
  ADD PRIMARY KEY (`pharmacyitem_id`);

--
-- Indexes for table `pharmacyordereditems`
--
ALTER TABLE `pharmacyordereditems`
  ADD PRIMARY KEY (`pharmacyordereditem_id`);

--
-- Indexes for table `pharmacyorders`
--
ALTER TABLE `pharmacyorders`
  ADD PRIMARY KEY (`pharmacyorder_id`);

--
-- Indexes for table `pharstockorders`
--
ALTER TABLE `pharstockorders`
  ADD PRIMARY KEY (`pharstockorder_id`);

--
-- Indexes for table `postnatalreports`
--
ALTER TABLE `postnatalreports`
  ADD PRIMARY KEY (`postnatalreport_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `progressmedications`
--
ALTER TABLE `progressmedications`
  ADD PRIMARY KEY (`progressmedication_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `radioinvestigationtypes`
--
ALTER TABLE `radioinvestigationtypes`
  ADD PRIMARY KEY (`radioinvestigationtype_id`);

--
-- Indexes for table `radiolodyreporttitle`
--
ALTER TABLE `radiolodyreporttitle`
  ADD PRIMARY KEY (`reporttitle`);

--
-- Indexes for table `radiologyimages`
--
ALTER TABLE `radiologyimages`
  ADD PRIMARY KEY (`radioimage_id`);

--
-- Indexes for table `radiologyreports`
--
ALTER TABLE `radiologyreports`
  ADD PRIMARY KEY (`radiologyreport_id`);

--
-- Indexes for table `radioorders`
--
ALTER TABLE `radioorders`
  ADD PRIMARY KEY (`radioorder_id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reaction_id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referr_id`);

--
-- Indexes for table `registration_requests`
--
ALTER TABLE `registration_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `responsiblequalifications`
--
ALTER TABLE `responsiblequalifications`
  ADD PRIMARY KEY (`responsiblequalification_id`);

--
-- Indexes for table `restockitems`
--
ALTER TABLE `restockitems`
  ADD PRIMARY KEY (`restockitem_id`);

--
-- Indexes for table `restockorders`
--
ALTER TABLE `restockorders`
  ADD PRIMARY KEY (`restockorder_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `scannerreports`
--
ALTER TABLE `scannerreports`
  ADD PRIMARY KEY (`scannerreport_id`);

--
-- Indexes for table `secs`
--
ALTER TABLE `secs`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `servicecategories`
--
ALTER TABLE `servicecategories`
  ADD PRIMARY KEY (`servicecategory_id`);

--
-- Indexes for table `serviceorders`
--
ALTER TABLE `serviceorders`
  ADD PRIMARY KEY (`serviceorder_id`);

--
-- Indexes for table `siunits`
--
ALTER TABLE `siunits`
  ADD PRIMARY KEY (`siunit_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `staffdepts`
--
ALTER TABLE `staffdepts`
  ADD PRIMARY KEY (`staffdept_id`);

--
-- Indexes for table `stillbirthstatus`
--
ALTER TABLE `stillbirthstatus`
  ADD PRIMARY KEY (`stillbirthstatus_id`);

--
-- Indexes for table `stockitems`
--
ALTER TABLE `stockitems`
  ADD PRIMARY KEY (`stockitem_id`);

--
-- Indexes for table `stockorders`
--
ALTER TABLE `stockorders`
  ADD PRIMARY KEY (`stockorder_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `supplierproducts`
--
ALTER TABLE `supplierproducts`
  ADD PRIMARY KEY (`supplierproduct_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `surgeryhistory`
--
ALTER TABLE `surgeryhistory`
  ADD PRIMARY KEY (`surgeryhistory_id`);

--
-- Indexes for table `transfusions`
--
ALTER TABLE `transfusions`
  ADD PRIMARY KEY (`transfusion_id`);

--
-- Indexes for table `unitmeasurements`
--
ALTER TABLE `unitmeasurements`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `usedcredit`
--
ALTER TABLE `usedcredit`
  ADD PRIMARY KEY (`usedcredit_id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`ward_id`);

--
-- Indexes for table `wardtypes`
--
ALTER TABLE `wardtypes`
  ADD PRIMARY KEY (`wardtype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acts`
--
ALTER TABLE `acts`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `admitted`
--
ALTER TABLE `admitted`
  MODIFY `admitted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agegroups`
--
ALTER TABLE `agegroups`
  MODIFY `agegroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ambulantordereditems`
--
ALTER TABLE `ambulantordereditems`
  MODIFY `ambulantordereditem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ambulantorders`
--
ALTER TABLE `ambulantorders`
  MODIFY `ambulantorder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareport`
--
ALTER TABLE `anaesthesiareport`
  MODIFY `anareport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareport2`
--
ALTER TABLE `anaesthesiareport2`
  MODIFY `anareport2_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareportcns`
--
ALTER TABLE `anaesthesiareportcns`
  MODIFY `anareportcns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportgen`
--
ALTER TABLE `anaesthesiareportgen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareporthem`
--
ALTER TABLE `anaesthesiareporthem`
  MODIFY `anareporthem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportlabs`
--
ALTER TABLE `anaesthesiareportlabs`
  MODIFY `anareportlab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportmont`
--
ALTER TABLE `anaesthesiareportmont`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareportonc`
--
ALTER TABLE `anaesthesiareportonc`
  MODIFY `anareportonc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportoth`
--
ALTER TABLE `anaesthesiareportoth`
  MODIFY `anareportoth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportpe`
--
ALTER TABLE `anaesthesiareportpe`
  MODIFY `anareportpe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anaesthesiareportpla`
--
ALTER TABLE `anaesthesiareportpla`
  MODIFY `anareportpla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportpul`
--
ALTER TABLE `anaesthesiareportpul`
  MODIFY `anareportpul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportreext`
--
ALTER TABLE `anaesthesiareportreext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareportreg`
--
ALTER TABLE `anaesthesiareportreg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareportrenal`
--
ALTER TABLE `anaesthesiareportrenal`
  MODIFY `anareportrenal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anaesthesiareportven`
--
ALTER TABLE `anaesthesiareportven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anaesthesiareportvitals`
--
ALTER TABLE `anaesthesiareportvitals`
  MODIFY `anareportvit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `bill_payments`
--
ALTER TABLE `bill_payments`
  MODIFY `bill_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `bloodtypes`
--
ALTER TABLE `bloodtypes`
  MODIFY `bloodtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `childbirthoutcomes`
--
ALTER TABLE `childbirthoutcomes`
  MODIFY `childbirthoutcome_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `childbirths`
--
ALTER TABLE `childbirths`
  MODIFY `childbirth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classifications`
--
ALTER TABLE `classifications`
  MODIFY `classification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clientcredits`
--
ALTER TABLE `clientcredits`
  MODIFY `clientcredit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinicreport`
--
ALTER TABLE `clinicreport`
  MODIFY `clinicreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic_clients`
--
ALTER TABLE `clinic_clients`
  MODIFY `clinic_cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complications`
--
ALTER TABLE `complications`
  MODIFY `complication_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consumed`
--
ALTER TABLE `consumed`
  MODIFY `consumed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consumeditems`
--
ALTER TABLE `consumeditems`
  MODIFY `consumeditem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creditclients`
--
ALTER TABLE `creditclients`
  MODIFY `creditclient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deliveryevents`
--
ALTER TABLE `deliveryevents`
  MODIFY `deliveryevent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department_sections`
--
ALTER TABLE `department_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `discharged`
--
ALTER TABLE `discharged`
  MODIFY `discharged_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=607;

--
-- AUTO_INCREMENT for table `doctorexam`
--
ALTER TABLE `doctorexam`
  MODIFY `doctorexam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctorreports`
--
ALTER TABLE `doctorreports`
  MODIFY `doctorreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `doneexams`
--
ALTER TABLE `doneexams`
  MODIFY `doneexam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examcategories`
--
ALTER TABLE `examcategories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `examdetails`
--
ALTER TABLE `examdetails`
  MODIFY `examdetail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `examination_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examtypes`
--
ALTER TABLE `examtypes`
  MODIFY `examtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gynaecologyreports`
--
ALTER TABLE `gynaecologyreports`
  MODIFY `gynaecologyreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indications`
--
ALTER TABLE `indications`
  MODIFY `indication_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurancecompanies`
--
ALTER TABLE `insurancecompanies`
  MODIFY `insurancecompany_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `insurancetypes`
--
ALTER TABLE `insurancetypes`
  MODIFY `insurancetype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insuredinventoryitems`
--
ALTER TABLE `insuredinventoryitems`
  MODIFY `insuredinventoryitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `insuredinvestigationtypes`
--
ALTER TABLE `insuredinvestigationtypes`
  MODIFY `insuredinvestigationtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `insuredradiotypes`
--
ALTER TABLE `insuredradiotypes`
  MODIFY `insuredradiotype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `insuredservices`
--
ALTER TABLE `insuredservices`
  MODIFY `insuredservice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `insuredwards`
--
ALTER TABLE `insuredwards`
  MODIFY `insuredward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inventoryitems`
--
ALTER TABLE `inventoryitems`
  MODIFY `inventoryitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `investigationselect`
--
ALTER TABLE `investigationselect`
  MODIFY `investigationselect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `investigationsubtypes`
--
ALTER TABLE `investigationsubtypes`
  MODIFY `investigationsubtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `investigationtypes`
--
ALTER TABLE `investigationtypes`
  MODIFY `investigationtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `investigationtypesrange`
--
ALTER TABLE `investigationtypesrange`
  MODIFY `typesrange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `issueddrugs`
--
ALTER TABLE `issueddrugs`
  MODIFY `issueddrug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `itemcategories`
--
ALTER TABLE `itemcategories`
  MODIFY `itemcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laborders`
--
ALTER TABLE `laborders`
  MODIFY `laborder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `labreports`
--
ALTER TABLE `labreports`
  MODIFY `labreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `labreportsubtype`
--
ALTER TABLE `labreportsubtype`
  MODIFY `labsubtype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labunits`
--
ALTER TABLE `labunits`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `medicalcase`
--
ALTER TABLE `medicalcase`
  MODIFY `medicalcase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicalservices`
--
ALTER TABLE `medicalservices`
  MODIFY `medicalservice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1369;

--
-- AUTO_INCREMENT for table `minor`
--
ALTER TABLE `minor`
  MODIFY `minor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noninsuredservices`
--
ALTER TABLE `noninsuredservices`
  MODIFY `noninsuredservice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurseordereditems`
--
ALTER TABLE `nurseordereditems`
  MODIFY `nurseordereditem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurseorders`
--
ALTER TABLE `nurseorders`
  MODIFY `nurseorder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nursereports`
--
ALTER TABLE `nursereports`
  MODIFY `nursereport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nursingsheetmedications`
--
ALTER TABLE `nursingsheetmedications`
  MODIFY `nursingsheetmedication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nursingsheets`
--
ALTER TABLE `nursingsheets`
  MODIFY `nursingsheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `observationsheets`
--
ALTER TABLE `observationsheets`
  MODIFY `observation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obstetrics`
--
ALTER TABLE `obstetrics`
  MODIFY `obstetric_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordereditems`
--
ALTER TABLE `ordereditems`
  MODIFY `ordereditem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `patienthistory`
--
ALTER TABLE `patienthistory`
  MODIFY `patient_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patientlabs`
--
ALTER TABLE `patientlabs`
  MODIFY `patientlab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `patientradios`
--
ALTER TABLE `patientradios`
  MODIFY `patientradio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `patientservices`
--
ALTER TABLE `patientservices`
  MODIFY `patientservice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `patientsque`
--
ALTER TABLE `patientsque`
  MODIFY `patientsque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `paymentmethod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymethod`
--
ALTER TABLE `paymethod`
  MODIFY `paymethod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pharmaceuticalforms`
--
ALTER TABLE `pharmaceuticalforms`
  MODIFY `pharmaceuticalform_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacologicalclasses`
--
ALTER TABLE `pharmacologicalclasses`
  MODIFY `pharmacologicalclass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacyitems`
--
ALTER TABLE `pharmacyitems`
  MODIFY `pharmacyitem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacyordereditems`
--
ALTER TABLE `pharmacyordereditems`
  MODIFY `pharmacyordereditem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pharmacyorders`
--
ALTER TABLE `pharmacyorders`
  MODIFY `pharmacyorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pharstockorders`
--
ALTER TABLE `pharstockorders`
  MODIFY `pharstockorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `postnatalreports`
--
ALTER TABLE `postnatalreports`
  MODIFY `postnatalreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progressmedications`
--
ALTER TABLE `progressmedications`
  MODIFY `progressmedication_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `qualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `radioinvestigationtypes`
--
ALTER TABLE `radioinvestigationtypes`
  MODIFY `radioinvestigationtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `radiolodyreporttitle`
--
ALTER TABLE `radiolodyreporttitle`
  MODIFY `reporttitle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `radiologyimages`
--
ALTER TABLE `radiologyimages`
  MODIFY `radioimage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `radiologyreports`
--
ALTER TABLE `radiologyreports`
  MODIFY `radiologyreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `radioorders`
--
ALTER TABLE `radioorders`
  MODIFY `radioorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration_requests`
--
ALTER TABLE `registration_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsiblequalifications`
--
ALTER TABLE `responsiblequalifications`
  MODIFY `responsiblequalification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restockitems`
--
ALTER TABLE `restockitems`
  MODIFY `restockitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `restockorders`
--
ALTER TABLE `restockorders`
  MODIFY `restockorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scannerreports`
--
ALTER TABLE `scannerreports`
  MODIFY `scannerreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secs`
--
ALTER TABLE `secs`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `servicecategories`
--
ALTER TABLE `servicecategories`
  MODIFY `servicecategory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceorders`
--
ALTER TABLE `serviceorders`
  MODIFY `serviceorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `siunits`
--
ALTER TABLE `siunits`
  MODIFY `siunit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `staffdepts`
--
ALTER TABLE `staffdepts`
  MODIFY `staffdept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `stillbirthstatus`
--
ALTER TABLE `stillbirthstatus`
  MODIFY `stillbirthstatus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockitems`
--
ALTER TABLE `stockitems`
  MODIFY `stockitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `stockorders`
--
ALTER TABLE `stockorders`
  MODIFY `stockorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `supplierproducts`
--
ALTER TABLE `supplierproducts`
  MODIFY `supplierproduct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surgeryhistory`
--
ALTER TABLE `surgeryhistory`
  MODIFY `surgeryhistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `transfusions`
--
ALTER TABLE `transfusions`
  MODIFY `transfusion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unitmeasurements`
--
ALTER TABLE `unitmeasurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usedcredit`
--
ALTER TABLE `usedcredit`
  MODIFY `usedcredit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `wardtypes`
--
ALTER TABLE `wardtypes`
  MODIFY `wardtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
