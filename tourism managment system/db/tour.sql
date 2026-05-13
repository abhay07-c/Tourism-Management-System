-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 08:35 AM
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
-- Database: `tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL,
  `mobile` bigint(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`, `mobile`, `name`, `email`) VALUES
(1, 'admin', 'Test@123', '2024-01-10 11:18:49', 7579266545, 'administrator\r\n', 'test123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL,
  `PackageId` int(11) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext DEFAULT NULL,
  `PersonCount` int(11) NOT NULL DEFAULT 1,
  `TotalAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `UserEmail`, `FromDate`, `ToDate`, `Comment`, `PersonCount`, `TotalAmount`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`) VALUES
(14, 2, 'tarun12@gmail.com', '16-09-2025', '20-09-2025', '', 1, 17000.00, '2025-09-15 16:16:14', 1, NULL, '2025-09-17 12:42:48'),
(15, 2, 'tarun12@gmail.com', '25-09-2025', '28-09-2025', 'tickit book plase inform me', 4, 68000.00, '2025-09-16 06:08:01', 1, NULL, '2025-09-17 12:42:40'),
(16, 3, 'admin', '17-09-2025', '22-09-2025', 'no', 5, 60000.00, '2025-09-16 15:28:50', 2, 'admin', '2025-09-17 12:43:17'),
(17, 3, 'admin', '17-09-2025', '22-09-2025', 'no', 5, 60000.00, '2025-09-16 15:29:53', 1, NULL, '2025-09-17 12:43:13'),
(21, 7, 'tarun12@gmail.com', '17-09-2025', '22-09-2025', '', 3, 45000.00, '2025-09-17 12:40:11', 1, NULL, '2025-09-17 12:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblenquiry`
--

INSERT INTO `tblenquiry` (`id`, `FullName`, `EmailId`, `MobileNumber`, `Subject`, `Description`, `PostingDate`, `Status`) VALUES
(5, 'Tarun', 'tarun12@gmail.com', '6354966544', 'tour information', 'any tourism imformation', '2025-09-12 11:03:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblissues`
--

CREATE TABLE `tblissues` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissues`
--

INSERT INTO `tblissues` (`id`, `UserEmail`, `Issue`, `Description`, `PostingDate`, `AdminRemark`, `AdminremarkDate`) VALUES
(1, 'tarun12@gmail.com', 'refund', 'i want refund', '2025-09-12 16:50:22', 'yes', '2025-09-13 14:20:04'),
(2, 'tarun12@gmail.com', 'refund', 'i want refund', '2025-09-12 16:53:52', 'yes', '2025-09-12 17:07:50'),
(3, 'tarun12@gmail.com', 'refund my money', 'i want refund this money', '2025-09-12 16:59:38', 'ok ', '2025-09-12 17:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `tourpackages`
--

CREATE TABLE `tourpackages` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageType` varchar(150) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackagePrice` decimal(10,2) DEFAULT NULL,
  `PackageFetures` varchar(255) DEFAULT NULL,
  `PackageDetails` mediumtext DEFAULT NULL,
  `PackageImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tourpackages`
--

INSERT INTO `tourpackages` (`PackageId`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageFetures`, `PackageDetails`, `PackageImage`, `Creationdate`, `UpdationDate`) VALUES
(2, ' goa Adventure', ' couple package', 'Goa', 17000.00, 'Pick-up & Drop', '\r\nncludes accommodation, tours of North and South Goa, meals, and sometimes special experiences like candlelight dinners, river cruises, photo-shoots\r\n', 'uploads/1757774528_goa-beachs.jpg', '2025-09-11 15:27:08', '2025-09-13 14:42:08'),
(3, 'Rajasthan Royal Retreat', 'Family ', 'Jaipur – Udaipur – Jodhpur – Jaisalmer', 12000.00, ' Stay in heritage palaces & boutique hotels ? Camel safari in Thar Desert ? Cultural folk dance & dinner ? Private chauffeur & guide ? All meals included ', 'Experience royal Rajasthan — lakes, forts, desert dunes, and vibrant bazaars. Includes sunset at Mehrangarh Fort and boat ride on Lake Pichola.', 'packagimage/licensed-image.jpg', '2025-09-16 14:58:55', NULL),
(4, 'Wild India Safari Adventure ', 'Family Type', 'Ranthambore (Rajasthan) + Bandhavgarh (Madhya Pradesh)', 17000.00, '? 6+ jungle safaris in open gypsys ? Luxury jungle lodges ? Expert naturalist guides ? All meals & park entry fees', 'Spot Bengal tigers, leopards, and exotic birds. Best time: Oct–Apr. Ideal for wildlife photographers and nature lovers.', 'packagimage/download (3).jpg', '2025-09-16 15:01:58', NULL),
(5, 'Backwaters Bliss', 'Family Type', 'Kerala', 17000.00, 'Houseboat cruise, tea plantation visit, Ayurvedic spa, all meals', 'Cruise through serene backwaters, visit misty hills; features luxury houseboat stay and local cuisine. Perfect for honeymooners or unwinding.', 'packagimage/images.jpg', '2025-09-16 15:19:04', NULL),
(6, 'Mumbai City Lights', 'Urban Exploration Tour', 'Mumbai (Maharashtra)', 12000.00, 'Bollywood tour, street food walk, Marine Drive, local transport', 'Gateway of India, Elephanta Caves; vibrant city experience with 4-star hotel. Great for first-time urban India visitors', 'packagimage/mumbai.jpg', '2025-09-16 15:22:11', NULL),
(7, 'Mysore Heritage Trail', 'Royal & Cultural Tour', 'Mysore (Karnataka', 15000.00, 'Palace visit, Brindavan Gardens, silk shopping, yoga session', 'Mysore Palace light show, Chamundi Hills; comfortable stays with South Indian breakfast. For history and wellness.', 'packagimage/1-chamundi-hills-mysuru-karnataka-city-body.jpg', '2025-09-16 15:26:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'tarun', 'tarun12@gmail.com', 9825514645, 'tarun@123'),
(2, 'alish', 'alish12@gmail.com', 9512445235, 'alish@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissues`
--
ALTER TABLE `tblissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourpackages`
--
ALTER TABLE `tourpackages`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblissues`
--
ALTER TABLE `tblissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourpackages`
--
ALTER TABLE `tourpackages`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
