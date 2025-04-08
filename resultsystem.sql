-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2025 at 03:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resultsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'admin@ucshpaan.edu.mm', '$2y$10$S98HkqN5hPoSlDvDzgWhsew6xthHU2tMrjx/RJhPUKjDGPEb/6/2u', '2025-04-06 11:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `fifth_1sem_cs`
--

CREATE TABLE `fifth_1sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-5101` int(11) DEFAULT NULL,
  `CST-5141` int(11) DEFAULT NULL,
  `CST-5102` int(11) DEFAULT NULL,
  `CS-5123` int(11) DEFAULT NULL,
  `CS-5114` int(11) DEFAULT NULL,
  `CS-5125` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fifth_1sem_cs`
--

INSERT INTO `fifth_1sem_cs` (`id`, `roll_no`, `E-5101`, `CST-5141`, `CST-5102`, `CS-5123`, `CS-5114`, `CS-5125`) VALUES
(1, '2021CS-1', 73, 69, 72, 68, 80, 79),
(2, '2021CS-2', 78, 69, 65, 70, 61, 76),
(3, '2021CS-3', 73, 59, 61, 69, 53, 78);

-- --------------------------------------------------------

--
-- Table structure for table `fifth_1sem_ct`
--

CREATE TABLE `fifth_1sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-5101` int(11) DEFAULT NULL,
  `CST-5141` int(11) DEFAULT NULL,
  `CST-5102` int(11) DEFAULT NULL,
  `CT-5133` int(11) DEFAULT NULL,
  `CT-5134` int(11) DEFAULT NULL,
  `CS-5135` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fifth_1sem_ct`
--

INSERT INTO `fifth_1sem_ct` (`id`, `roll_no`, `E-5101`, `CST-5141`, `CST-5102`, `CT-5133`, `CT-5134`, `CS-5135`) VALUES
(1, '2021CT-4', 84, 76, 68, 87, 74, 67),
(2, '2021CT-5', 64, 67, 71, 78, 63, 85),
(3, '2021CT-6', 64, 78, 67, 76, 64, 61);

-- --------------------------------------------------------

--
-- Table structure for table `first_1sem`
--

CREATE TABLE `first_1sem` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(100) NOT NULL,
  `M-1101` int(11) NOT NULL,
  `E-1101` int(11) NOT NULL,
  `P-1101` int(11) NOT NULL,
  `CST-1111` int(11) NOT NULL,
  `CST-1142` int(11) NOT NULL,
  `CST(SS)-1153` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `first_1sem`
--

INSERT INTO `first_1sem` (`id`, `roll_no`, `M-1101`, `E-1101`, `P-1101`, `CST-1111`, `CST-1142`, `CST(SS)-1153`) VALUES
(1, '2425CST-1', 49, 48, 59, 58, 60, 69),
(2, '2425CST-2', 65, 30, 60, 57, 48, 70),
(3, '2425CST-3', 50, 60, 61, 59, 63, 67);

-- --------------------------------------------------------

--
-- Table structure for table `first_2sem`
--

CREATE TABLE `first_2sem` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `M-1201` int(11) DEFAULT NULL,
  `E-1201` int(11) DEFAULT NULL,
  `P-1201` int(11) DEFAULT NULL,
  `CST-1211` int(11) DEFAULT NULL,
  `CST-1242` int(11) DEFAULT NULL,
  `CST(SS)-1253` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `first_2sem`
--

INSERT INTO `first_2sem` (`id`, `roll_no`, `M-1201`, `E-1201`, `P-1201`, `CST-1211`, `CST-1242`, `CST(SS)-1253`) VALUES
(1, '2425CST-6', 57, 67, 50, 68, 69, 59),
(2, '2425CST-7', 72, 60, 76, 62, 68, 60),
(3, '2425CST-8', 69, 57, 72, 60, 56, 62);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_1sem_cs`
--

CREATE TABLE `fourth_1sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-4101` int(11) DEFAULT NULL,
  `CST-4111` int(11) DEFAULT NULL,
  `CS-4142` int(11) DEFAULT NULL,
  `CS-4113` int(11) DEFAULT NULL,
  `CS-4124` int(11) DEFAULT NULL,
  `CST-4125` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fourth_1sem_cs`
--

INSERT INTO `fourth_1sem_cs` (`id`, `roll_no`, `E-4101`, `CST-4111`, `CS-4142`, `CS-4113`, `CS-4124`, `CST-4125`) VALUES
(1, '2122CS-1', 69, 59, 79, 60, 58, 59),
(2, '2122CS-2', 67, 91, 89, 89, 65, 78),
(3, '2122CS-3', 67, 69, 68, 60, 57, 60);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_1sem_ct`
--

CREATE TABLE `fourth_1sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-4101` int(11) DEFAULT NULL,
  `CST-4111` int(11) DEFAULT NULL,
  `CT-4132` int(11) DEFAULT NULL,
  `CT-4133` int(11) DEFAULT NULL,
  `CT-4134` int(11) DEFAULT NULL,
  `CST-4125` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fourth_1sem_ct`
--

INSERT INTO `fourth_1sem_ct` (`id`, `roll_no`, `E-4101`, `CST-4111`, `CT-4132`, `CT-4133`, `CT-4134`, `CST-4125`) VALUES
(1, '2122CT-4', 58, 68, 59, 69, 60, 48),
(2, '2122CT-5', 58, 59, 67, 60, 61, 62),
(3, '2122CT-6', 62, 50, 63, 69, 68, 60);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_2sem_cs`
--

CREATE TABLE `fourth_2sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-4211` int(11) DEFAULT NULL,
  `CST-4242` int(11) DEFAULT NULL,
  `CS-4223` int(11) DEFAULT NULL,
  `CS-4214` int(11) DEFAULT NULL,
  `CS-4225` int(11) DEFAULT NULL,
  `CST-4257` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fourth_2sem_cs`
--

INSERT INTO `fourth_2sem_cs` (`id`, `roll_no`, `CST-4211`, `CST-4242`, `CS-4223`, `CS-4214`, `CS-4225`, `CST-4257`) VALUES
(1, '2122CS-11', 68, 59, 72, 69, 63, 53),
(2, '2122CS-12', 78, 76, 90, 69, 85, 71),
(3, '2122CS-13', 65, 78, 70, 68, 71, 64);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_2sem_ct`
--

CREATE TABLE `fourth_2sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-4211` int(11) DEFAULT NULL,
  `CST-4242` int(11) DEFAULT NULL,
  `CT-4233` int(11) DEFAULT NULL,
  `CT-4234` int(11) DEFAULT NULL,
  `CT-4236` int(11) DEFAULT NULL,
  `CST-4257` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fourth_2sem_ct`
--

INSERT INTO `fourth_2sem_ct` (`id`, `roll_no`, `CST-4211`, `CST-4242`, `CT-4233`, `CT-4234`, `CT-4236`, `CST-4257`) VALUES
(1, '2122CT-21', 78, 78, 57, 67, 67, 68),
(2, '2122CT-22', 65, 67, 58, 79, 63, 67),
(3, '2122CT-23', 64, 69, 84, 78, 75, 73);

-- --------------------------------------------------------

--
-- Table structure for table `second_1sem_cst`
--

CREATE TABLE `second_1sem_cst` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-1201` int(11) DEFAULT NULL,
  `CST-2111` int(11) DEFAULT NULL,
  `CST-1242` int(11) DEFAULT NULL,
  `CST-2133` int(11) DEFAULT NULL,
  `CST-2124` int(11) DEFAULT NULL,
  `CST(SK)-2155` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `second_1sem_cst`
--

INSERT INTO `second_1sem_cst` (`id`, `roll_no`, `E-1201`, `CST-2111`, `CST-1242`, `CST-2133`, `CST-2124`, `CST(SK)-2155`) VALUES
(1, '2324CST-20', 78, 70, 69, 87, 74, 67),
(2, '2324CST-21', 56, 87, 78, 67, 59, 78),
(3, '2324CST-22', 80, 87, 71, 78, 82, 79);

-- --------------------------------------------------------

--
-- Table structure for table `second_2sem_cs`
--

CREATE TABLE `second_2sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-2201` int(11) DEFAULT NULL,
  `CST-2211` int(11) DEFAULT NULL,
  `CST-2242` int(11) DEFAULT NULL,
  `CST-2223` int(11) DEFAULT NULL,
  `CST-2254` int(11) DEFAULT NULL,
  `CST(SS)-2205` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `second_2sem_cs`
--

INSERT INTO `second_2sem_cs` (`id`, `roll_no`, `E-2201`, `CST-2211`, `CST-2242`, `CST-2223`, `CST-2254`, `CST(SS)-2205`) VALUES
(1, '2324CS-10', 59, 60, 71, 68, 55, 64),
(2, '2324CS-11', 60, 75, 63, 71, 68, 57),
(3, '2324CS-12', 76, 59, 45, 60, 68, 62);

-- --------------------------------------------------------

--
-- Table structure for table `second_2sem_ct`
--

CREATE TABLE `second_2sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `E-2201` int(11) DEFAULT NULL,
  `CST-2211` int(11) DEFAULT NULL,
  `CST-2242` int(11) DEFAULT NULL,
  `CST-2223` int(11) DEFAULT NULL,
  `CST-2234` int(11) DEFAULT NULL,
  `CST(SS)-2235` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `second_2sem_ct`
--

INSERT INTO `second_2sem_ct` (`id`, `roll_no`, `E-2201`, `CST-2211`, `CST-2242`, `CST-2223`, `CST-2234`, `CST(SS)-2235`) VALUES
(1, '2324CT-13', 30, 68, 69, 50, 67, 69),
(2, '2324CT-14', 71, 60, 80, 68, 73, 67),
(3, '2324CT-15', 89, 61, 79, 78, 65, 67);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `roll_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll_no`, `email`, `year`, `major`, `semester`) VALUES
(1, 'Aung Ko', '2425CST-1', 'aungko@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'First Semester'),
(2, 'Zaw Min', '2425CST-2', 'zawmin@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'First Semester'),
(3, 'Hlaing Win', '2425CST-3', 'hlaingwin@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'First Semester'),
(4, 'Nyein Chan', '2425CST-6', 'nyeinchan@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'Second Semester'),
(5, 'Kyaw Zay Ya', '2425CST-7', 'kyawzayya@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'Second Semester'),
(6, 'Min Thu', '2425CST-8', 'minthu@ucshpaan.edu.mm', 'First Year', 'Computer Science and Technology', 'Second Semester'),
(8, 'Aung Kyaw Moe', '2324CS-11', 'aungkyawmoe@ucshpaan.edu.mm', 'Second Year', 'Computer Science', 'Second Semester'),
(9, 'Ko Ko Gyi', '2324CS-10', 'kokogyi@ucshpaan.edu.mm', 'Second Year', 'Computer Science', 'Second Semester'),
(10, 'Win Myint', '2324CS-12', 'winmyint@ucshpaan.edu.mm', 'Second Year', 'Computer Science', 'Second Semester'),
(11, 'Htet Naing', '2324CT-13', 'htetnaing@ucshpaan.edu.mm', 'Second Year', 'Computer Technology', 'Second Semester'),
(12, 'Lin Tun', '2324CT-14', 'lintun@ucshpaan.edu.mm', 'Second Year', 'Computer Technology', 'Second Semester'),
(13, 'Soe Moe', '2324CT-15', 'soemoe@ucshpaan.edu.mm', 'Second Year', 'Computer Technology', 'Second Semester'),
(14, 'Tun Tun', '2223CS-100', 'tuntun@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'First Semester'),
(15, 'Naing Lin', '2223CS-101', 'nainglin@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'First Semester'),
(16, 'Pyae Phyo Aung', '2223CT-103', 'pyaephyoaung@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'First Semester'),
(17, 'Wai Yan Tun', '2223CT-104', 'waiyantun@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'First Semester'),
(18, 'Hein Htet', '2223CT-105', 'heinhtet@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'First Semester'),
(19, 'Thura Zaw', '2223CT-106', 'thurazaw@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'First Semester'),
(20, 'Kaung Myat', '2223CS-109', 'kaungmyat@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'First Semester'),
(21, 'Moe Kyaw', '2223CS-30', 'moekyaw@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'Second Semester'),
(22, 'Nandar Hlaing', '2223CS-32', 'nandarhlaing@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'Second Semester'),
(23, 'Ei Mon', '2223CS-33', 'eimon@ucshpaan.edu.mm', 'Third Year', 'Computer Science', 'Second Semester'),
(24, 'Su Su Hlaing', '2223CT-31', 'susuhlaing@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'Second Semester'),
(25, 'Thin Zar', '2223CT-37', 'thinzar@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'Second Semester'),
(26, 'May Myat Noe', '2223CT-40', 'maymyatnoe@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'Second Semester'),
(27, 'Phyu Phyu Thin', '2223CT-38', 'phyuphyuthin@ucshpaan.edu.mm', 'Third Year', 'Computer Technology', 'Second Semester'),
(28, 'Htet Htet Moe Oo', '2122CS-1', 'htethtetmoeoo@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'First Semester'),
(29, 'Shwe Yee', '2122CS-2', 'shweyee@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'First Semester'),
(30, 'Chit Su', '2122CS-3', 'chitsu@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'First Semester'),
(31, 'Moe Moe Aye', '2122CT-4', 'moemoeaye@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'First Semester'),
(32, 'Khin Myat Mon', '2122CT-5', 'khinmyatmon@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'First Semester'),
(33, 'Aye Aye Win', '2122CT-6', 'ayeayewin@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'First Semester'),
(34, 'Soe Pyae', '2122CS-11', 'soepyae@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'Second Semester'),
(35, 'May Zin', '2122CS-12', 'mayzin@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'Second Semester'),
(36, 'Zin Mar Oo', '2122CS-13', 'zinmaroo@ucshpaan.edu.mm', 'Fourth Year', 'Computer Science', 'Second Semester'),
(37, 'Aung Myo', '2122CT-21', 'aungmyo@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'Second Semester'),
(38, 'Zay Yar', '2122CT-22', 'zayyar@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'Second Semester'),
(39, 'Kaung Htet', '2122CT-23', 'kaunghtet@ucshpaan.edu.mm', 'Fourth Year', 'Computer Technology', 'Second Semester'),
(40, 'Nyein Nyein', '2021CS-1', 'nyeinnyein@ucshpaan.edu.mm', 'Fifth Year', 'Computer Science', 'First Semester'),
(41, 'Thant Zin', '2021CS-2', 'thantzin@ucshpaan.edu.mm', 'Fifth Year', 'Computer Science', 'First Semester'),
(42, 'Zun Than', '2021CS-3', 'zunthan@ucshpaan.edu.mm', 'Fifth Year', 'Computer Science', 'First Semester'),
(43, 'Kyaw Win', '2021CT-4', 'kyawwin@ucshpaan.edu.mm', 'Fifth Year', 'Computer Technology', 'First Semester'),
(44, 'Myo Min', '2021CT-5', 'myomin@ucshpaan.edu.mm', 'Fifth Year', 'Computer Technology', 'First Semester'),
(45, 'Moe Naing', '2021CT-6', 'moenaing@ucshpaan.edu.mm', 'Fifth Year', 'Computer Technology', 'First Semester'),
(46, 'Thiri Kyaw', '2324CST-20', 'thirikyaw@ucshpaan.edu.mm', 'Second Year', 'Computer Science and Technology', 'First Semester'),
(47, 'Kyi Kyi', '2324CST-21', 'kyikyi@ucshpaan.edu.mm', 'Second Year', 'Computer Science and Technology', 'First Semester'),
(48, 'Nanda Aye', '2324CST-22', 'nandaaye@ucshpaan.edu.mm', 'Second Year', 'Computer Science and Technology', 'First Semester');

-- --------------------------------------------------------

--
-- Table structure for table `third_1sem_cs`
--

CREATE TABLE `third_1sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-3131` int(11) DEFAULT NULL,
  `CST-3142` int(11) DEFAULT NULL,
  `CST-3113` int(11) DEFAULT NULL,
  `CS-3124` int(11) DEFAULT NULL,
  `CS-3125` int(11) DEFAULT NULL,
  `CS(SK)-3156` int(11) DEFAULT NULL,
  `CST(SK)-3157` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `third_1sem_cs`
--

INSERT INTO `third_1sem_cs` (`id`, `roll_no`, `CST-3131`, `CST-3142`, `CST-3113`, `CS-3124`, `CS-3125`, `CS(SK)-3156`, `CST(SK)-3157`) VALUES
(1, '2223CS-100', 82, 89, 88, 75, 69, 76, 78),
(2, '2223CS-101', 70, 56, 72, 60, 59, 67, 66),
(3, '2223CS-109', 67, 72, 75, 76, 80, 69, 68);

-- --------------------------------------------------------

--
-- Table structure for table `third_1sem_ct`
--

CREATE TABLE `third_1sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-3131` int(11) DEFAULT NULL,
  `CST-3142` int(11) DEFAULT NULL,
  `CST-3113` int(11) DEFAULT NULL,
  `CT-3134` int(11) DEFAULT NULL,
  `CT-3135` int(11) DEFAULT NULL,
  `CT(SK)-3136` int(11) DEFAULT NULL,
  `CST(SK)-3157` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `third_1sem_ct`
--

INSERT INTO `third_1sem_ct` (`id`, `roll_no`, `CST-3131`, `CST-3142`, `CST-3113`, `CT-3134`, `CT-3135`, `CT(SK)-3136`, `CST(SK)-3157`) VALUES
(1, '2223CT-103', 68, 58, 73, 69, 55, 56, 63),
(2, '2223CT-104', 86, 68, 69, 74, 60, 57, 62),
(3, '2223CT-105', 78, 69, 72, 67, 74, 72, 61),
(4, '2223CT-106', 73, 68, 68, 58, 69, 53, 79);

-- --------------------------------------------------------

--
-- Table structure for table `third_2sem_cs`
--

CREATE TABLE `third_2sem_cs` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-3211` int(11) DEFAULT NULL,
  `CST-3242` int(11) DEFAULT NULL,
  `CST-3213` int(11) DEFAULT NULL,
  `CS-3224` int(11) DEFAULT NULL,
  `CST-3235` int(11) DEFAULT NULL,
  `CST-3256` int(11) DEFAULT NULL,
  `CST-3257` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `third_2sem_cs`
--

INSERT INTO `third_2sem_cs` (`id`, `roll_no`, `CST-3211`, `CST-3242`, `CST-3213`, `CS-3224`, `CST-3235`, `CST-3256`, `CST-3257`) VALUES
(1, '2223CS-30', 62, 69, 71, 68, 74, 59, 76),
(2, '2223CS-32', 68, 59, 73, 87, 75, 67, 80),
(3, '2223CS-33', 86, 70, 69, 84, 90, 67, 87);

-- --------------------------------------------------------

--
-- Table structure for table `third_2sem_ct`
--

CREATE TABLE `third_2sem_ct` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `CST-3211` int(11) DEFAULT NULL,
  `CST-3242` int(11) DEFAULT NULL,
  `CST-3213` int(11) DEFAULT NULL,
  `CT-3234` int(11) DEFAULT NULL,
  `CST-3235` int(11) DEFAULT NULL,
  `CST-3256` int(11) DEFAULT NULL,
  `CST-3257` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `third_2sem_ct`
--

INSERT INTO `third_2sem_ct` (`id`, `roll_no`, `CST-3211`, `CST-3242`, `CST-3213`, `CT-3234`, `CST-3235`, `CST-3256`, `CST-3257`) VALUES
(1, '2223CT-31', 68, 58, 88, 60, 78, 58, 77),
(2, '2223CT-37', 78, 68, 70, 60, 71, 68, 84),
(3, '2223CT-38', 38, 49, 59, 59, 60, 60, 47),
(4, '2223CT-40', 86, 69, 60, 60, 68, 70, 67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `fifth_1sem_cs`
--
ALTER TABLE `fifth_1sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fifth_1sem_ct`
--
ALTER TABLE `fifth_1sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_1sem`
--
ALTER TABLE `first_1sem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_2sem`
--
ALTER TABLE `first_2sem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fourth_1sem_cs`
--
ALTER TABLE `fourth_1sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fourth_1sem_ct`
--
ALTER TABLE `fourth_1sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fourth_2sem_cs`
--
ALTER TABLE `fourth_2sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fourth_2sem_ct`
--
ALTER TABLE `fourth_2sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_1sem_cst`
--
ALTER TABLE `second_1sem_cst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_2sem_cs`
--
ALTER TABLE `second_2sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_2sem_ct`
--
ALTER TABLE `second_2sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_1sem_cs`
--
ALTER TABLE `third_1sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_1sem_ct`
--
ALTER TABLE `third_1sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_2sem_cs`
--
ALTER TABLE `third_2sem_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_2sem_ct`
--
ALTER TABLE `third_2sem_ct`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fifth_1sem_cs`
--
ALTER TABLE `fifth_1sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fifth_1sem_ct`
--
ALTER TABLE `fifth_1sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_1sem`
--
ALTER TABLE `first_1sem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_2sem`
--
ALTER TABLE `first_2sem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fourth_1sem_cs`
--
ALTER TABLE `fourth_1sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fourth_1sem_ct`
--
ALTER TABLE `fourth_1sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fourth_2sem_cs`
--
ALTER TABLE `fourth_2sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fourth_2sem_ct`
--
ALTER TABLE `fourth_2sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `second_1sem_cst`
--
ALTER TABLE `second_1sem_cst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `second_2sem_cs`
--
ALTER TABLE `second_2sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `second_2sem_ct`
--
ALTER TABLE `second_2sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `third_1sem_cs`
--
ALTER TABLE `third_1sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `third_1sem_ct`
--
ALTER TABLE `third_1sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `third_2sem_cs`
--
ALTER TABLE `third_2sem_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `third_2sem_ct`
--
ALTER TABLE `third_2sem_ct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
