-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 02:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezauction_db`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(23, NULL, '1', 32, 'hellloooo guys', '2023-10-18 17:41:03'),
(24, NULL, '1', 35, 'hellloooo guys', '2023-10-18 17:42:55'),
(25, NULL, '1', 35, 'musta na kayo?', '2023-10-18 17:43:15'),
(26, NULL, '1', 35, 'musta na kayo?', '2023-10-18 17:43:33'),
(27, NULL, '1', 35, 'huhu', '2023-10-18 17:44:59'),
(28, NULL, '1', 34, 'huhu', '2023-10-18 17:51:11'),
(29, NULL, '43', 36, 'hellloooo guys', '2023-10-18 18:16:17'),
(30, NULL, '43', 36, 'huhu', '2023-10-18 18:53:04'),
(31, NULL, '43', 37, 'hellloooo guys', '2023-10-18 18:54:13'),
(32, NULL, '43', 37, 'musta na kayo?', '2023-10-18 18:54:26'),
(33, NULL, '43', 37, 'huhu', '2023-10-18 19:04:10'),
(34, NULL, '43', 38, 'huhu', '2023-10-18 19:08:02'),
(35, '45', NULL, 38, 'musta na kayo?', '2023-10-18 19:08:08'),
(36, NULL, '43', 38, 'hellloooo guys', '2023-10-18 19:08:19'),
(37, NULL, '46', 38, 'yoooo', '2023-10-18 19:12:21'),
(38, NULL, '46', 37, 'yoooo', '2023-10-18 19:14:46'),
(39, '45', NULL, 38, 'hehe', '2023-10-18 19:16:28');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidder_tbl`
--

INSERT INTO `bidder_tbl` (`id`, `unique_id`, `fname`, `lname`, `email`, `phone`, `image`, `password`, `otp`, `verification_status`, `Role`) VALUES
(43, 1430801141, 'Phoebe', 'Pascua', 'markynayaatienza16@gmail.com', '09154200225', '1697986356327707723_862750568266036_6744074916148815138_n.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Verified', 'bidder'),
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidding_access`
--

INSERT INTO `bidding_access` (`id`, `bidder`, `seller`, `address`, `city`, `phone`, `paypal`, `status`) VALUES
(3, 50, 51, 'asdasd', 'qqq', '09154200225', 'qweqw', 2),
(4, 51, 51, 'qwe', 'qwe', '09154200225', 'qwe', 2),
(5, 52, 52, 'address', 'city', '09154200225', 'paypal', 2),
(6, 43, 45, '642 RESSURRECTION STREET, CABCABEN, MARIVELES, BATAAN', 'Mariveles, Bataan', '09075964991', '12345', 2),
(7, 1, 45, '642 Ressurreccion St.', 'Balanga', '09075964991', '12345', 2),
(8, 46, 44, '642 Ressurreccion St.', 'Balanga', '09075964991', '12345', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bidding_tbl`
--

CREATE TABLE `bidding_tbl` (
  `id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `bidder_unique` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `bid_livestock_id` tinyint(4) NOT NULL,
  `bid_created` datetime NOT NULL DEFAULT current_timestamp(),
  `bid_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidding_tbl`
--

INSERT INTO `bidding_tbl` (`id`, `bidder_id`, `bidder_unique`, `fname`, `bid_amount`, `bid_livestock_id`, `bid_created`, `bid_status`) VALUES
(27, 49, '1429372094', '123123', 1000, 27, '2023-09-17 23:50:25', 0),
(28, 49, '1429372094', '123123', 10000, 28, '2023-09-18 11:35:34', 0),
(29, 49, '1429372094', '123123', 1000, 29, '2023-09-18 14:31:23', 0),
(30, 49, '1429372094', '123123', 10000, 30, '2023-09-18 20:44:27', 0),
(31, 49, '1429372094', '123123', 10000, 31, '2023-09-18 20:46:53', 0),
(32, 50, '', 'asdasd', 20, 32, '2023-10-17 03:41:17', 0),
(33, 50, '', 'asdasd', 0, 32, '2023-10-17 13:04:13', 0),
(34, 50, '', 'asdasd', 0, 32, '2023-10-17 13:04:22', 0),
(35, 52, '', 'qwekqwek', 200, 34, '2023-10-17 18:34:22', 0),
(36, 1, '', 'Mark', 200, 32, '2023-10-18 17:40:37', 0),
(37, 1, '', 'Mark', 800, 32, '2023-10-18 17:40:44', 0),
(38, 1, '', 'Mark', 900, 32, '2023-10-18 17:40:52', 0),
(39, 1, '', 'Mark', 800, 35, '2023-10-18 17:42:59', 0),
(40, 1, '', 'Mark', 1000, 35, '2023-10-18 17:46:14', 0),
(41, 43, '', 'asdasd', 1000, 36, '2023-10-18 18:24:48', 0),
(42, 43, '', 'asdasd', 1000, 37, '2023-10-18 18:54:02', 0),
(43, 46, '', 'aliah', 9000, 37, '2023-10-18 19:14:57', 0),
(44, 46, '', 'aliah', 500, 38, '2023-10-18 19:16:06', 0),
(45, 43, '', 'asdasd', 567, 39, '2023-10-19 12:44:05', 0),
(46, 43, '', 'asdasd', 500, 40, '2023-10-21 11:18:43', 0),
(47, 43, '', 'asdasd', 800, 41, '2023-10-21 11:46:07', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livestock_tbl`
--

INSERT INTO `livestock_tbl` (`id`, `head_count`, `description`, `weight`, `per_head`, `total_weight`, `selling_price`, `seller_id`, `live_status`, `live_date`, `live_end`) VALUES
(36, 5, 'Cow', 40, 35467, 56, 1223, 44, 3, '2023-10-18 18:13:43', '2023-10-18 19:13:43'),
(37, 5, 'Pig', 40, 121, 56, 1223, 44, 3, '2023-10-18 18:53:38', '2023-10-18 19:53:38'),
(38, 5, 'Pig', 40, 121, 56, 1223, 45, 3, '2023-10-18 19:07:44', '2023-10-18 20:07:44'),
(39, 12, 'Pig', 50, 35467, 1212121, 121, 43, 3, '2023-10-19 12:43:12', '2023-10-19 13:43:12'),
(40, 5, 'Cow', 40, 121, 1212121, 1223, 43, 3, '2023-10-21 11:17:00', '2023-10-21 12:17:00'),
(41, 5, 'Pig', 40, 121, 56, 1223, 43, 3, '2023-10-21 11:45:24', '2023-10-21 12:45:24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(51, 104576790, 'selleeeer', 'seller', 'seller@gmail.com', '09154211554', '1697469912bbk.png', '5b98aebe1d8080cea8e19f4da87218de', 0, 'Verified', 'seller');

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
-- Indexes for table `livestock_tbl`
--
ALTER TABLE `livestock_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id_fk` (`seller_id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bidding_tbl`
--
ALTER TABLE `bidding_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `livestock_tbl`
--
ALTER TABLE `livestock_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
