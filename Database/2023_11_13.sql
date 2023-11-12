-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 05:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `th_ez_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `verification_status` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `unique_id`, `fname`, `lname`, `email`, `phone`, `image`, `password`, `otp`, `verification_status`, `Role`) VALUES
(1, 766654171, 'Mark', 'Mahilum', 'markynayaatienza16@gmail.com', '09459976989', '1686570801rizz1.png', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'admin'),
(45, 12312312, 'fname', 'lname', 'q@q', '09154200335', '1697538620q.png', '4aba2310438b9b590ea3a5524740dff5', 0, 'Verified', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auctionchat`
--

CREATE TABLE `auctionchat` (
  `id` bigint(20) NOT NULL,
  `seller` text DEFAULT NULL,
  `user` text DEFAULT NULL,
  `auction` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auctionchat`
--

INSERT INTO `auctionchat` (`id`, `seller`, `user`, `auction`, `text`, `date`) VALUES
(1, NULL, '50', 32, 'qweasdasd', '2023-10-17 15:29:27'),
(2, NULL, '50', 32, 'qweqwe', '2023-10-17 15:31:42'),
(3, NULL, '50', 32, 'qweqwe', '2023-10-17 15:31:45'),
(4, NULL, '50', 32, 'asdasd', '2023-10-17 15:31:48'),
(5, NULL, '50', 32, 'asdasd', '2023-10-17 15:31:50'),
(6, NULL, '50', 32, 'asd', '2023-10-17 15:31:51'),
(7, NULL, '50', 32, 'asd', '2023-10-17 15:31:52'),
(8, NULL, '50', 32, 'hatdog padin po', '2023-10-17 15:38:39'),
(9, '51', NULL, 32, 'qqwe', '2023-10-17 15:48:27'),
(10, '51', NULL, 32, 'qw', '2023-10-17 15:55:43'),
(11, NULL, '50', 32, 'qq', '2023-10-17 15:56:16'),
(12, NULL, '50', 33, 'ampogi ko', '2023-10-17 15:59:03'),
(13, NULL, '50', 32, 'asd', '2023-10-17 16:01:36'),
(14, NULL, '50', 32, 'test nga', '2023-10-17 16:02:40'),
(15, NULL, '50', 32, 'asd', '2023-10-17 16:03:25'),
(16, '51', NULL, 33, 'qqqq', '2023-10-17 16:07:14'),
(17, '51', NULL, 32, 'qq', '2023-10-17 16:07:19'),
(18, '52', NULL, 34, 'qqqq', '2023-10-17 16:09:05'),
(19, '52', NULL, 34, 'whatsup madlang people', '2023-10-17 16:09:15'),
(20, NULL, '52', 34, 'ni haw ma', '2023-10-17 18:34:11'),
(21, NULL, '52', 34, 'pa bid ako 200', '2023-10-17 18:34:18'),
(22, '52', NULL, 34, 'tenenenenen', '2023-10-17 18:35:45'),
(23, NULL, '46', 35, 'test', '2023-10-25 19:11:04'),
(24, NULL, '46', 35, 'good day', '2023-10-25 19:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_tbl`
--

CREATE TABLE `bidder_tbl` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `verification_status` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidder_tbl`
--

INSERT INTO `bidder_tbl` (`id`, `unique_id`, `fname`, `lname`, `email`, `phone`, `image`, `password`, `otp`, `verification_status`, `Role`) VALUES
(43, 1430801141, 'asdasd', 'asdasd', 'markynayaatienza16@gmail.com', '09154200225', '1697536503q.png', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'bidder'),
(46, 1506817914, 'aliah', 'sdfsdf', 'rareviolet18@gmail.com', '09876543211', '1686730801female1.png', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'bidder'),
(47, 1430801141, 'aaa', 'Mahilum', 'bidder@bidder', '09459976989', '1686324082reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'bidder'),
(48, 1430801141, 'Jonas', 'Cobbage', 'bidder@bidder2', '09459976989', '1686324082reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'bidder'),
(49, 1429372094, '123123', '123123', 'joshuaenore74@gmail.com', '12312312312', '16933766792593468.png', 'f5bb0c8de146c67b44babbf4e6584cc0', 0, 'Verified', 'bidder'),
(50, 776999350, 'hamburger', 'asdasd', 'bidder@gmail.com', '09154200225', '1697536896qq.png', '140d3ea2b0c7a720b8fcc236deedd04f', 0, 'Verified', 'bidder'),
(51, 892148278, 'casd', 'asd', 'qwe@gmail.com', '09154200114', '1697520039qq.png', 'd4685fa5b1645e8cd17b4c558e1465c4', 0, 'Verified', 'bidder'),
(52, 72373868, 'checkcheck', 'qwekqwek', 'qwekqwek@gmail.com', '09154200225', '1697538767qq.png', '046e126b1cfd1dd4d5adcc61524e996e', 0, 'Verified', 'bidder');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_win`
--

CREATE TABLE `bidder_win` (
  `bidder_win_id` int(11) NOT NULL,
  `bidder_win_user` varchar(200) NOT NULL,
  `bidder_win_room` varchar(200) NOT NULL,
  `bidder_win_status` varchar(200) NOT NULL,
  `bidder_win_date` varchar(200) NOT NULL,
  `bidder_amount` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidder_win`
--

INSERT INTO `bidder_win` (`bidder_win_id`, `bidder_win_user`, `bidder_win_room`, `bidder_win_status`, `bidder_win_date`, `bidder_amount`) VALUES
(11, '1429372094', '30', '0', 'September 18,2023 - 08:44:43 PM', '10000'),
(10, '1429372094', '29', '0', 'September 18,2023 - 02:39:52 PM', '1000'),
(12, '1429372094', '31', '0', 'September 18,2023 - 08:46:58 PM', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `bidding_access`
--

CREATE TABLE `bidding_access` (
  `id` int(11) NOT NULL,
  `bidder` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `phone` text NOT NULL,
  `paypal` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidding_access`
--

INSERT INTO `bidding_access` (`id`, `bidder`, `seller`, `address`, `city`, `phone`, `paypal`, `status`) VALUES
(3, 50, 51, 'asdasd', 'qqq', '09154200225', 'qweqw', 2),
(4, 51, 51, 'qwe', 'qwe', '09154200225', 'qwe', 2),
(5, 52, 52, 'address', 'city', '09154200225', 'paypal', 2),
(6, 46, 45, 'Area-3 Fantail Street Sitio Veterans', 'Quezon City', '09063387451', 'markgonzalespersonal@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bidding_tbl`
--

CREATE TABLE `bidding_tbl` (
  `id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `bidder_unique` varchar(200) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `bid_livestock_id` tinyint(4) NOT NULL,
  `bid_created` datetime NOT NULL DEFAULT current_timestamp(),
  `bid_status` tinyint(4) NOT NULL DEFAULT 0,
  `is_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidding_tbl`
--

INSERT INTO `bidding_tbl` (`id`, `bidder_id`, `bidder_unique`, `fname`, `bid_amount`, `bid_livestock_id`, `bid_created`, `bid_status`, `is_sent`) VALUES
(1, 46, '', 'aliah', 12000, 3, '2023-11-12 23:31:31', 5, 1),
(2, 46, '', 'aliah', 23000, 2, '2023-11-12 23:31:36', 5, 1),
(3, 46, '', 'aliah', 11000, 1, '2023-11-12 23:31:40', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(10) NOT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `payment_id` int(10) DEFAULT NULL,
  `bidder_id` int(10) DEFAULT NULL,
  `seller_id` int(10) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `net_amount`, `name`, `payment_id`, `bidder_id`, `seller_id`, `date_time`) VALUES
(1, '2760.00', '(Pirate Crew) ', 1, 46, 45, '2023-11-12 23:33:33'),
(2, '5290.00', '(kanding) ', 2, 46, 45, '2023-11-12 23:33:44'),
(3, '2530.00', '(cow) ', 3, 46, 45, '2023-11-12 23:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_tbl`
--

CREATE TABLE `livestock_tbl` (
  `id` int(11) NOT NULL,
  `head_count` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `weight` int(11) NOT NULL,
  `per_head` int(11) NOT NULL,
  `total_weight` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `live_status` tinyint(4) NOT NULL DEFAULT 0,
  `live_date` datetime NOT NULL DEFAULT current_timestamp(),
  `live_end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `livestock_tbl`
--

INSERT INTO `livestock_tbl` (`id`, `head_count`, `description`, `weight`, `per_head`, `total_weight`, `selling_price`, `seller_id`, `live_status`, `live_date`, `live_end`) VALUES
(1, 1, 'cow', 78, 1000, 78, 1000, 45, 3, '2023-11-12 23:30:28', '2023-11-13 00:30:28'),
(2, 1, 'kanding', 88, 19000, 88, 19000, 45, 3, '2023-11-12 23:30:42', '2023-11-13 00:30:42'),
(3, 1, 'Pirate Crew', 108, 10000, 108, 10000, 45, 3, '2023-11-12 23:31:03', '2023-11-13 00:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `internal_remarks` text DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `external_reference` varchar(50) DEFAULT NULL,
  `bidder_id` int(10) DEFAULT NULL,
  `seller_id` int(10) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `livestock_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `net_amount`, `internal_remarks`, `organization`, `external_reference`, `bidder_id`, `seller_id`, `date_time`, `livestock_id`) VALUES
(1, '12000.00', '9240.00', '\r\n                Admin commission of 2,760.00(0.23%) has been\r\n                    deducted to livestock sold amount 12000\r\n            ', 'PAYPAL', 'PAYID-MVIPAPA61X04970B7651430W', 46, 45, '2023-11-12 23:33:33', 3),
(2, '23000.00', '17710.00', '\r\n                Admin commission of 5,290.00(0.23%) has been\r\n                    deducted to livestock sold amount 23000\r\n            ', 'PAYPAL', 'PAYID-MVIPAUQ1VF76138ED332992U', 46, 45, '2023-11-12 23:33:44', 2),
(3, '11000.00', '8470.00', '\r\n                Admin commission of 2,530.00(0.23%) has been\r\n                    deducted to livestock sold amount 11000\r\n            ', 'PAYPAL', 'PAYID-MVIPAXQ9JK29024B36798942', 46, 45, '2023-11-12 23:33:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller_tbl`
--

CREATE TABLE `seller_tbl` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `verification_status` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller_tbl`
--

INSERT INTO `seller_tbl` (`id`, `unique_id`, `fname`, `lname`, `email`, `phone`, `image`, `password`, `otp`, `verification_status`, `Role`) VALUES
(43, 122021909, 'mark', 'mahilum', 'markynayaatienza16@gmail.com', '09459976989', '1686321611reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(44, 689957133, 'mello', 'mahilum', 'melatienza4@gmail.com', '09459976989', '1686322811reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(45, 1347899266, 'shan', 'sintos', 'shanniasintos18@gmail.com', '09459976989', '1686658945rizz.png', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(46, 170627412, 'Test', 'Seller', 'testseller@gmail.com', '091234567890', '1686727386white.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(47, 122021909, 'mark', 'mahilum', 'seller@seller', '09459976989', '1686321611reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(48, 122021909, 'Shania', 'Sintos', 'seller@seller2', '09459976989', '1686321611reyna.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'seller'),
(50, 371367389, 'asd', 'asdas', 'joshuaenore24@gmail.com', '12345678912', '16933765232593468.png', '4297f44b13955235245b2497399d7a93', 0, 'Verified', 'seller'),
(51, 104576790, 'selleeeer', 'seller', 'seller@gmail.com', '09154211554', '1697469912bbk.png', '5b98aebe1d8080cea8e19f4da87218de', 0, 'Verified', 'seller'),
(52, 887991633, 'fire', 'water', 'water@gmail.com', '09154200225', '1697539560qq.png', '57182ab0d0ad8224c065c6413c5e4e93', 0, 'Verified', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctionchat`
--
ALTER TABLE `auctionchat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidder_tbl`
--
ALTER TABLE `bidder_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidder_win`
--
ALTER TABLE `bidder_win`
  ADD PRIMARY KEY (`bidder_win_id`);

--
-- Indexes for table `bidding_access`
--
ALTER TABLE `bidding_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidding_tbl`
--
ALTER TABLE `bidding_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock_tbl`
--
ALTER TABLE `livestock_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id_fk` (`seller_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_tbl`
--
ALTER TABLE `seller_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `auctionchat`
--
ALTER TABLE `auctionchat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `bidder_tbl`
--
ALTER TABLE `bidder_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `bidder_win`
--
ALTER TABLE `bidder_win`
  MODIFY `bidder_win_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bidding_access`
--
ALTER TABLE `bidding_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bidding_tbl`
--
ALTER TABLE `bidding_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `livestock_tbl`
--
ALTER TABLE `livestock_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller_tbl`
--
ALTER TABLE `seller_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livestock_tbl`
--
ALTER TABLE `livestock_tbl`
  ADD CONSTRAINT `livestock_tbl_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
