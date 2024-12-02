-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 03:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `photo`) VALUES
(1, 'John', 'Doe', 'admin@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service` text NOT NULL,
  `subservice` text NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `result` int(1) NOT NULL,
  `user_active` int(1) NOT NULL,
  `staff_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `service`, `subservice`, `datetime`, `status`, `result`, `user_active`, `staff_active`) VALUES
(1, 1, 'Laboratory', 'Chem 8', '2024-10-28 11:00:00', 1, 1, 0, 0),
(2, 1, 'Xray', '', '2024-10-28 14:00:00', 0, 0, 0, 0),
(3, 1, '2D Echo', '', '2024-10-28 15:00:00', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `service` text NOT NULL,
  `item` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_used` int(11) NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `service`, `item`, `quantity`, `quantity_used`, `photo`, `last_updated`) VALUES
(1, 'Laboratory', '3 CC TERUMO SYRINGE', 16, 3, '1266120622_3 CC TERUMO SYRINGE.png', '2024-10-26 12:56:29.653821'),
(2, 'Laboratory', '5 CC TERUMO SYRINGE', 5, 3, '1136652991_5 CC TERUMO SYRINGE.png', '2024-10-26 12:56:29.653821'),
(3, 'Laboratory', '10 CC TERUMO SYRINGE', 2, 3, '2095942641_10 CC TERUMO SYRINGE.png', '2024-10-26 12:56:29.653821'),
(4, 'Laboratory', '25 G NEEDLES', 3, 3, '821822049_25G NEEDLES.png', '2024-10-26 12:56:29.653821'),
(5, 'Laboratory', 'INSIGHT URINE STRIP', 15, 3, '1870011070_INSIGHT URINE STRIP.png', '2024-10-26 12:56:29.653821'),
(6, 'Laboratory', 'TOURNIQUET', 10, 3, '655486959_TOURNIQUET.png', '2024-10-26 12:56:29.653821'),
(7, 'Laboratory', 'RBS TEST STRIP', 50, 3, '2077785508_RBS TEST STRIP.png', '2024-10-26 12:56:29.653821'),
(8, 'Laboratory', 'PLASTIC CONICAL TUBE', 100, 3, '2134219680_PLASTIC CONICAL TUBE.png', '2024-10-26 12:56:29.653821'),
(9, 'Laboratory', 'LAVANDER TUBE (K2 EDTA)', 10, 3, '2073121048_LAVENDER TUBE (K2 EDTA).png', '2024-10-26 12:56:29.653821'),
(10, 'Laboratory', 'K2 EDTA MICROTAINER TUBES', 5, 3, '1708955145_K2 EDTA MICROTAINER TUBES.png', '2024-10-26 12:56:29.653821'),
(11, 'Laboratory', 'YELLOW TOP (GEL SEPARATOR)', 10, 3, '1342073046_YELLOW TOP GELL SEPARATOR.png', '2024-10-26 12:56:29.653821'),
(12, 'Laboratory', 'RED TUBE (PLAIN)', 5, 3, '1756496267_RED TUBE PLAIN.png', '2024-10-26 12:56:29.653821'),
(13, 'Laboratory', 'FACE MASK', 10, 3, '567478004_FACE MASK.png', '2024-10-26 12:56:29.653821'),
(14, 'Laboratory', 'PLAIN SLIDES', 5, 3, '15359056_PLAIN SLIDES.png', '2024-10-26 12:56:29.653821'),
(15, 'Laboratory', '70% ALCOHOL', 4, 3, '579784762_ALCOHOL.png', '2024-10-26 12:56:29.653821'),
(16, 'Laboratory', 'COTTON', 4, 3, '498719567_COTTON.png', '2024-10-26 12:56:29.653821'),
(17, 'Laboratory', 'MICROPORE TAPE', 3, 3, '2012556043_MICROROPE TAPE.png', '2024-10-26 12:56:29.653821'),
(18, 'Laboratory', 'URINE CONTAINER (50 ML)', 100, 3, '673082786_URINE CONTAINER 50 ML.png', '2024-10-26 12:56:29.653821'),
(19, 'Laboratory', 'STOOL CONTAINER', 500, 3, '1537227135_STOOL CONTAINER.png', '2024-10-26 12:56:29.653821'),
(20, 'Laboratory', 'APPLICATOR STICK', 3, 3, '1401540142_APPLICATOR STICK.png', '2024-10-26 12:56:29.653821'),
(21, 'Laboratory', 'LANCET', 2, 3, '351929360_LANCET.png', '2024-10-26 12:56:29.653821'),
(22, 'Laboratory', 'FOBT KITS', 1, 3, '343979724_FOBT KIT.png', '2024-10-26 12:56:29.653821'),
(23, 'Laboratory', 'GLOVES (SMALL)', 5, 3, '277982386_GLOVES.png', '2024-10-26 12:56:29.653821'),
(24, 'Laboratory', 'GLOVE (LARGE)', 5, 3, '677317852_GLOVES.png', '2024-10-26 12:56:29.653821'),
(25, 'Laboratory', 'HBSAG STRIPS', 10, 3, '1728790374_HBSAG STRIPS.png', '2024-10-26 12:56:29.653821'),
(26, 'Laboratory', 'RPR/VDRL STRIPS', 5, 3, '720747256_RPRVDRL STRIPS.png', '2024-10-26 12:56:29.653821'),
(27, 'Laboratory', 'PREGNANCY TEST STRIPS KITS', 2, 3, '783582024_PREGNANCY TEST STRIPS KITS.png', '2024-10-26 12:56:29.653821'),
(28, 'Laboratory', 'H. PYLORI', 3, 3, '1779050449_H PYLORI.png', '2024-10-26 12:56:29.653821'),
(29, 'Laboratory', 'DENGUE NS1AG', 1, 3, '1396919174_DENGUE NS1AG.png', '2024-10-26 12:56:29.653821'),
(30, 'Laboratory', 'DENGUE IGG/IGM', 1, 3, '1458868430_DENGUE IGGIGM.png', '2024-10-26 12:56:29.653821'),
(31, 'Laboratory', 'GLUCOSE', 3, 3, '166634033_GLUCOSE.png', '2024-10-26 12:56:29.653821'),
(32, 'Laboratory', 'CHOLESTEROL', 3, 3, '413589475_CHOLESTEROL.png', '2024-10-26 12:56:29.653821'),
(33, 'Laboratory', 'TRIGLYCERIDES', 3, 3, '273417972_TRIGLYCERIDES.png', '2024-10-26 12:56:29.653821'),
(34, 'Laboratory', 'BLOOD URIC ACID (BUA)', 3, 3, '1553235414_BLOOD URIC ACID.png', '2024-10-26 12:56:29.653821'),
(35, 'Laboratory', 'HDL', 10, 3, '1392100094_HDL.png', '2024-10-26 12:56:29.653821'),
(36, 'Laboratory', 'CREATININE', 3, 3, '29133050_CREATININE.png', '2024-10-26 12:56:29.653821'),
(37, 'Laboratory', 'UREA (BUN)', 3, 3, '345184545_UREA (BUN).png', '2024-10-26 12:56:29.653821'),
(38, 'Laboratory', 'SGOT', 3, 3, '904071791_SGOT.png', '2024-10-26 12:56:29.653821'),
(39, 'Laboratory', 'SGPT', 3, 3, '432005144_SGPT.png', '2024-10-26 12:56:29.653821'),
(40, 'Laboratory', 'NORMAL & PATHOLOGIC CTRL.', 2, 3, '622793847_NORMAL & PATHOLOGIC CTRL..png', '2024-10-26 12:56:29.653821'),
(41, 'Laboratory', 'FINECARE HBA1C KITS', 5, 3, '294838304_FINCARE HBA1C KITS.png', '2024-10-26 12:56:29.653821'),
(42, 'Laboratory', 'FINECARE PSA KITS', 3, 3, '283487164_FINCARE PSA KITS.png', '2024-10-26 12:56:29.653821'),
(43, 'Laboratory', 'NSS', 1, 3, '1190269649_NSS.png', '2024-10-26 12:56:29.653821'),
(44, 'Laboratory', 'LOW,NORMAL,HIGH CONTROL', 1, 3, '1125560265_LOW, NORMAL, HIGH.png', '2024-10-26 12:56:29.653821'),
(45, 'Laboratory', 'DILUENT', 3, 3, '1739927725_DILUENT.png', '2024-10-26 12:56:29.653821'),
(46, 'Laboratory', 'LYSE', 3, 3, '1290167094_LYSE.png', '2024-10-26 12:56:29.653821'),
(47, 'Laboratory', 'PROBE CLEANSER', 3, 3, '1497681415_PROBE CLEANSER.png', '2024-10-26 12:56:29.653821'),
(48, 'Laboratory', 'CALIBRATION PACK', 3, 3, '2052033940_CALIBRATION PACK.png', '2024-10-26 12:56:29.653821'),
(49, 'Laboratory', 'MBM', 3, 3, 'default_image.png', '2024-10-26 12:56:29.653821'),
(50, 'X-RAY', 'X-ray Film', 1, 0, '323667084_X-RAY FILM.png', '2024-10-24 11:03:25.215838'),
(51, 'X-RAY', 'Gown', 20, 0, '2122944693_GOWN.png', '2024-10-24 11:03:37.690428'),
(52, 'X-RAY', 'Gloves', 3, 0, '1170538990_GLOVES (1).png', '2024-10-24 11:03:51.091042'),
(53, 'X-RAY', 'Protective Glasses', 4, 0, '1111080844_PROTECTIVE EYE GLASS.png', '2024-10-24 11:04:11.883191'),
(54, 'X-RAY', 'Alcohol', 2, 0, '853869998_ALCOHOL (1).png', '2024-10-24 11:04:24.620464'),
(55, '2D Echo', 'Ultrasound Gel', 5, 0, '789293792_ULTRASOUND GEL.png', '2024-10-24 11:08:12.814399'),
(56, '2D Echo', 'Electrode Pads', 20, 0, '1329168836_ELECTRODE PADS.png', '2024-10-24 11:08:27.445522'),
(57, '2D Echo', 'Paper Towel', 7, 0, '1251666766_PAPER TOWEL.png', '2024-10-24 11:08:40.229936'),
(58, '2D Echo', 'Gloves', 3, 0, '1882475113_GLOVES.png', '2024-10-24 11:12:11.744344'),
(59, '2D Echo', 'Gown', 10, 0, '383430382_GOWN.png', '2024-10-24 11:12:34.825376'),
(60, '2D Echo', 'Wipes', 10, 0, '594372030_WIPES.png', '2024-10-24 11:12:48.601524'),
(61, '2D Echo', 'Transducer Cover', 10, 0, '1523999921_TRANSDUCER COVER.png', '2024-10-24 11:12:58.946423'),
(62, 'Ultrasound', 'Ultrasound Gel', 10, 0, '1019310407_ULTRASOUND GEL (1).png', '2024-10-24 11:15:47.433763'),
(63, 'Ultrasound', 'Gowns', 10, 0, '574950518_GOWN (1).png', '2024-10-24 11:16:03.550615'),
(64, 'Ultrasound', 'Gloves', 3, 0, '42253771_GLOVES (1).png', '2024-10-24 11:16:17.703225'),
(65, 'Ultrasound', 'Face Masks', 7, 0, '1331784351_FACE MASK.png', '2024-10-24 11:16:30.205105'),
(66, 'Ultrasound', 'Probe Covers', 10, 0, '1231525547_PROBE COVER.png', '2024-10-24 11:16:48.396150'),
(67, 'ECG', 'Electrode Gel', 20, 0, '922188497_ELECTRODE GEL.png', '2024-10-24 11:19:55.944884'),
(68, 'ECG', 'ECG Paper', 20, 0, '1822526713_ECG PAPER.png', '2024-10-24 11:20:08.974953'),
(69, 'ECG', 'Gloves', 3, 0, '967323842_GLOVES.png', '2024-10-24 11:20:20.335469'),
(70, 'ECG', 'Alcohol Swab', 10, 0, '1107783020_ALCOHOL SWAB.png', '2024-10-24 11:20:30.194176'),
(71, 'ECG', 'Electrode Clip', 5, 0, '1811707699_ELECTRODE CLIP.png', '2024-10-24 11:20:44.160521'),
(72, 'ECG', 'Gown', 10, 0, '702575022_GOWN.png', '2024-10-24 11:20:55.800934'),
(73, 'ECG', 'Acohol', 2, 0, '890473900_ALCOHOL.png', '2024-10-24 11:21:05.800644'),
(74, 'ECG', 'Electrode Pads', 20, 0, '627196299_ELECTRODE PADS.png', '2024-10-24 11:21:22.887501');

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `machine_id` int(11) NOT NULL,
  `service` text NOT NULL,
  `machine` text NOT NULL,
  `quantity` text NOT NULL,
  `status` int(1) NOT NULL,
  `schedule_maintenance` text NOT NULL,
  `downtime` text NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`machine_id`, `service`, `machine`, `quantity`, `status`, `schedule_maintenance`, `downtime`, `photo`, `last_updated`) VALUES
(1, 'Laboratory', 'Oven (DIGISYSTEM Oven Dryer)', '1', 0, '2024-10-26', '2024-10-25', '165399636_Oven (DIGISYSTEM Oven Dryer).png', '2024-10-25 11:07:50.187193'),
(2, 'Laboratory', 'Clinical Centrifuge (DIGISYSTEM DSC-200T – 6 placer) (6 placer)', '1', 0, '', '', '788914835_Clinical Centrifuge (DIGISYSTEM DSC-200T – 6 placer).png', '2024-10-24 10:59:42.026598'),
(3, 'Laboratory', 'STATFAX 1904', '1', 0, '', '', '223316950_STATFAX 1904.png', '2024-10-24 10:59:54.236691'),
(4, 'Laboratory', 'CBS-50 Electrolytes Analyzer', '1', 0, '', '', '3123184_CBS-50 Electrolytes Analyzer.png', '2024-10-24 11:00:07.464602'),
(5, 'Laboratory', 'BIOELAB ES-160', '1', 0, '', '', '1566853523_BIOELAB ES-160.png', '2024-10-24 11:00:21.740380'),
(6, 'Laboratory', 'WONDFO FINECARE FIA METER PLUS', '1', 0, '', '', '2044644351_WONDFO FINECARE FIA METER PLUS.png', '2024-10-24 11:00:41.655597'),
(7, 'Laboratory', 'DIGISYSTEM DSC-100MH (24 placer)', '1', 0, '', '', '1372646103_DIGISYSTEM DSC-100MH (24 placer).png', '2024-10-24 11:00:54.904535'),
(8, 'Laboratory', 'OLYMPUS OPTICAL CO., LTD. (CX23LEDRFS1)', '1', 0, '', '', '790769783_OLYMPUS OPTICAL CO., LTD. (CX23LEDRFS1).png', '2024-10-24 11:01:10.634754'),
(9, 'Laboratory', 'BIOELAB EC-38 HEMATOLOGY ANNALYZER', '1', 0, '', '', '2006940846_BIOELAB EC-38 HEMATOLOGY ANNALYZER.png', '2024-10-24 11:01:23.391444'),
(10, 'X-RAY', 'X-ray Machine', '1', 0, '', '', '249001600_X-RAY MACHINE.png', '2024-10-24 11:05:29.140349'),
(11, 'X-RAY', 'Computer', '1', 0, '', '', '1678134244_COMPUTER (1).png', '2024-10-24 11:05:45.700044'),
(12, 'X-RAY', 'Printer', '1', 0, '', '', '1885766835_PRINTER (1).png', '2024-10-24 11:06:06.773629'),
(13, '2D Echo', 'Echocardiography Machine', '1', 0, '', '', '1937384935_ECHOCARDIOGRAPHY MACHINE.png', '2024-10-24 11:13:42.465327'),
(14, '2D Echo', 'Computer', '1', 0, '', '', '1254994117_COMPUTER.png', '2024-10-24 11:13:58.423876'),
(15, '2D Echo', 'Printer', '1', 0, '', '', '1968601972_PRINTER.png', '2024-10-24 11:14:09.544816'),
(16, 'Ultrasound', 'Ultrasound Machine', '1', 0, '', '', '2024703147_ULTRASOUND MACHINE.png', '2024-10-24 11:17:22.917923'),
(17, 'Ultrasound', 'Tranducers', '1', 0, '', '', '1472076744_TRANDUCERS.png', '2024-10-24 11:17:40.614557'),
(18, 'Ultrasound', 'Ultrasound Gel Warmer', '1', 0, '', '', '817685525_ULTRASOUND GEL WARMER.png', '2024-10-24 11:17:51.734951'),
(19, 'Ultrasound', 'Printer', '1', 0, '', '', '518428322_PRINTER (1).png', '2024-10-24 11:18:04.126358'),
(20, 'ECG', 'Electrocardiograph', '1', 0, '', '', '1591758453_ELECTROCARDIOGRAPH MACHINE.png', '2024-10-24 11:21:48.639320'),
(21, 'ECG', 'Computer (with ECG software)', '1', 0, '', '', '186610869_COMPUTER.png', '2024-10-24 11:22:40.969690'),
(22, 'ECG', 'Printer', '1', 0, '', '', '1364973855_PRINTER.png', '2024-10-24 11:22:58.323563');

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `patient_record_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service` text NOT NULL,
  `subservice` text NOT NULL,
  `result_impression` text NOT NULL,
  `fbs` text NOT NULL,
  `cholesterol` text NOT NULL,
  `triglycerides` text NOT NULL,
  `hdl` text NOT NULL,
  `ldl` text NOT NULL,
  `uric_acid` text NOT NULL,
  `creatinine` text NOT NULL,
  `bun` text NOT NULL,
  `sgot_ast` text NOT NULL,
  `sgpt_alt` text NOT NULL,
  `na` text NOT NULL,
  `k` text NOT NULL,
  `cl` text NOT NULL,
  `color` text NOT NULL,
  `transparency` text NOT NULL,
  `ph_reaction` text NOT NULL,
  `specific_gravity` text NOT NULL,
  `albumin` text NOT NULL,
  `sugar` text NOT NULL,
  `consistency` text NOT NULL,
  `wbc` text NOT NULL,
  `rbc` text NOT NULL,
  `hematocrit` text NOT NULL,
  `hemoglobin` text NOT NULL,
  `granulocytes` text NOT NULL,
  `lymphocytes` text NOT NULL,
  `mid` text NOT NULL,
  `platelet` text NOT NULL,
  `user_active` int(1) NOT NULL,
  `staff_active` int(1) NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_role` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_role`, `firstname`, `lastname`, `email`, `password`, `photo`) VALUES
(1, 'Laboratory', 'Staff', 'Laboratory', 'stafflaboratory@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', ''),
(2, 'X-RAY', 'Staff', 'X-ray', 'staffxray@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', ''),
(3, '2D Echo', 'Staff', '2D Echo', 'staff2decho@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', ''),
(4, 'Ultrasound', 'Staff', 'Ultrasound', 'staffultrasound@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', ''),
(5, 'ECG', 'Staff', 'ECG', 'staffecg@gmail.com', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contact_number` text NOT NULL,
  `gender` text NOT NULL,
  `age` text NOT NULL,
  `birthday` text NOT NULL,
  `address` text NOT NULL,
  `photo` text NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`machine_id`);

--
-- Indexes for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`patient_record_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `machine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient_records`
--
ALTER TABLE `patient_records`
  MODIFY `patient_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
