-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2022 at 03:02 AM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp_idealsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `cp_api_settings`
--

CREATE TABLE `cp_api_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_api_settings`
--

INSERT INTO `cp_api_settings` (`id`, `name`, `token`) VALUES
(25, 'admin@creditpanel.co.in', '5977ad93c8c7fe432f3173763eafdbf0bc8823e8d59f87aa84147097bce47cb974d707823fc04400');

-- --------------------------------------------------------

--
-- Table structure for table `cp_site_settings`
--

CREATE TABLE `cp_site_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(15) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(15) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `terms` text NOT NULL,
  `policy` varchar(30) NOT NULL,
  `support_email` varchar(30) NOT NULL,
  `support_phone` varchar(30) NOT NULL,
  `footer` varchar(30) NOT NULL,
  `live_chat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_site_settings`
--

INSERT INTO `cp_site_settings` (`id`, `title`, `description`, `keywords`, `logo`, `favicon`, `colour`, `terms`, `policy`, `support_email`, `support_phone`, `footer`, `live_chat`) VALUES
(2, 'Panda', 'this is panda sample', 'credit panel', 'images_BV3NVRLU.png', 'images_SMRWKB12', '#ffff', 'this is my first sample', 'sample', 'example@gmail.com', '+91-999-9999', 'Footer', 'Thanks');

-- --------------------------------------------------------

--
-- Table structure for table `headlines`
--

CREATE TABLE `headlines` (
  `id` int(10) UNSIGNED NOT NULL,
  `headline` text NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_unique_id` varchar(50) NOT NULL,
  `user_type` enum('admin','reseller','user') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `company` varchar(255) NOT NULL,
  `profilepic` text,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `parent_id` bigint(20) NOT NULL,
  `credit` double NOT NULL DEFAULT '0',
  `updated_at` varchar(30) DEFAULT NULL,
  `created_at` varchar(30) NOT NULL,
  `rollback` enum('Disable','Enable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_unique_id`, `user_type`, `full_name`, `username`, `email_id`, `pwd`, `mobile`, `company`, `profilepic`, `status`, `parent_id`, `credit`, `updated_at`, `created_at`, `rollback`) VALUES
(1, 'adm01', 'admin', 'IdealSoft', 'admin', 'admin@creditpanel.co.in', 'CP!@#123neo', '8788405045', 'Credit Panel', 'images_2J55A4HK.jpg', 'Active', 0, 90000000, '2022-10-30 11:15:38', '2022-07-07 13:26:07', 'Disable'),
(67, 'CP-19535762', 'user', 'Amol', 'CP14961489', 'amol@gmail.com', '123456', '8788405045', '', NULL, 'Active', 0, 5, '2022-10-31 09:18:11', '2022-10-31 09:18:11', 'Disable'),
(68, 'CP-65254581', 'user', 'hemant', 'CP34826961', 'test@gmail.com', '123456', '9461001408', '', NULL, 'Active', 0, 1, '2022-11-01 05:01:59', '2022-11-01 05:01:59', 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `created_at` varchar(30) NOT NULL,
  `updated_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `send_wp_msgs`
--

CREATE TABLE `send_wp_msgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login_id` bigint(20) NOT NULL,
  `campaign_unique_id` varchar(50) NOT NULL,
  `campaign_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_count` bigint(20) NOT NULL,
  `image-1` text NOT NULL,
  `image-2` text NOT NULL,
  `image-3` text NOT NULL,
  `image-4` text NOT NULL,
  `upload_pdf` text NOT NULL,
  `send_audio` text NOT NULL,
  `send_video` text NOT NULL,
  `dp_image` text NOT NULL,
  `repybtn1` text,
  `repybtn2` text,
  `ctabtn1` text,
  `ctabtn2` text,
  `status` enum('pending','process','delivered','discard') NOT NULL DEFAULT 'pending',
  `updated_at` varchar(30) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `sort_date_wise` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `send_wp_msgs`
--

INSERT INTO `send_wp_msgs` (`id`, `login_id`, `campaign_unique_id`, `campaign_name`, `message`, `number_count`, `image-1`, `image-2`, `image-3`, `image-4`, `upload_pdf`, `send_audio`, `send_video`, `dp_image`, `repybtn1`, `repybtn2`, `ctabtn1`, `ctabtn2`, `status`, `updated_at`, `created_at`, `sort_date_wise`) VALUES
(476, 58, 'CP-39234908', '', 'This is text message.<br />\r\nko', 1, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-10-29 02:23:43', '2022-10-29 02:23:43', '2022-10-29'),
(477, 67, 'CP-86736499', '', 'hi test ', 2, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-11-01 02:50:03', '2022-11-01 02:50:03', '2022-11-01'),
(478, 67, 'CP-51933382', '', 'hello', 2, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-11-01 02:52:29', '2022-11-01 02:52:29', '2022-11-01'),
(479, 67, 'CP-40419300', '', 'this is panda message', 2, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-11-01 02:54:47', '2022-11-01 02:54:47', '2022-11-01'),
(480, 67, 'CP-39984665', '', 'this is panda', 3, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-11-01 02:58:31', '2022-11-01 02:58:31', '2022-11-01'),
(481, 67, 'CP-77592321', '', 'wrwr', 3, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '2022-11-01 03:08:01', '2022-11-01 03:08:01', '2022-11-01'),
(482, 67, 'CP-49331064', '', '12312312', 3, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'pending', '2022-11-01 03:09:24', '2022-11-01 03:09:24', '2022-11-01'),
(483, 68, 'CP-26949665', '', 'hello <br />\r\ntesting', 17, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'delivered', '2022-11-01 10:48:02', '2022-11-01 10:36:20', '2022-11-01'),
(484, 68, 'CP-16060347', '', 'hello', 2, '', '', '', '', '', '', '', '', NULL, NULL, '+919461001408', 'https://idealsoft.in', 'pending', '2022-11-01 10:46:03', '2022-11-01 10:46:03', '2022-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` bigint(20) NOT NULL,
  `credit` double DEFAULT NULL COMMENT '(no. of sms)',
  `status` tinyint(1) NOT NULL,
  `old_credit` double DEFAULT NULL,
  `per_sms_price` double DEFAULT NULL COMMENT '(rate in paise)',
  `tax_status` enum('No','Yes') DEFAULT 'No',
  `tax_percentage` bigint(20) DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `login_user_unique_id` varchar(50) DEFAULT NULL,
  `user_unique_id` varchar(50) DEFAULT NULL,
  `txn_type` enum('credit','debit') DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `credit`, `status`, `old_credit`, `per_sms_price`, `tax_status`, `tax_percentage`, `tax_amount`, `total_amount`, `description`, `login_user_unique_id`, `user_unique_id`, `txn_type`, `created_at`) VALUES
(54, 5000, 0, 14999, 18, 'Yes', 18, 16200, 106200, '595959', 'CP-14880881', 'CP-58565007', 'credit', '2022-10-29 02:26:24'),
(55, 999, 0, 9999, 20, 'Yes', 18, 3596.4, 23576.4, '789789', 'CP-14880881', 'CP-58565007', 'credit', '2022-10-29 02:28:00'),
(56, 200, 0, 9000, 18, 'Yes', 18, 648, 4248, '123123', 'CP-14880881', 'CP-58565007', 'credit', '2022-10-30 10:56:10'),
(57, 100, 0, NULL, NULL, 'No', NULL, NULL, NULL, NULL, 'CP-14880881', 'CP-58565007', 'debit', '2022-10-30 10:56:32'),
(58, 3664, 0, 3999273664, 20, 'Yes', 18, 13190.4, 86470.4, '4645terte', 'adm01', 'CP-99668650', 'credit', '2022-10-30 11:13:36'),
(59, 664, 0, NULL, NULL, 'No', NULL, NULL, NULL, NULL, 'adm01', 'CP-99668650', 'debit', '2022-10-30 11:13:57'),
(60, 664, 0, 3999270664, 20, 'No', 18, 0, 13280, '789789789', 'adm01', 'CP-92956767', 'credit', '2022-10-30 11:15:19'),
(61, 64, 0, NULL, NULL, 'No', NULL, NULL, NULL, NULL, 'adm01', 'CP-92956767', 'debit', '2022-10-30 11:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `wp_mobile_listings`
--

CREATE TABLE `wp_mobile_listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `status` enum('pending','process','delivered','discard') NOT NULL DEFAULT 'pending',
  `send_wp_msgs_id` bigint(20) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `sort_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `wp_mobile_listings`
--

INSERT INTO `wp_mobile_listings` (`id`, `mobile_no`, `status`, `send_wp_msgs_id`, `created_at`, `sort_date`) VALUES
(176, '918788405045', 'pending', 476, '2022-10-29 02:23:43', '2022-10-29'),
(177, '918788405045\r', 'pending', 477, '2022-11-01 02:50:03', '2022-11-01'),
(178, '918407904149', 'pending', 477, '2022-11-01 02:50:03', '2022-11-01'),
(179, '918788405045\r', 'pending', 478, '2022-11-01 02:52:29', '2022-11-01'),
(180, '918407904149', 'pending', 478, '2022-11-01 02:52:29', '2022-11-01'),
(181, '918788405045\r', 'pending', 479, '2022-11-01 02:54:47', '2022-11-01'),
(182, '918407904149', 'pending', 479, '2022-11-01 02:54:47', '2022-11-01'),
(183, '918788405045\r', 'pending', 480, '2022-11-01 02:58:31', '2022-11-01'),
(184, '918407904149\r', 'pending', 480, '2022-11-01 02:58:31', '2022-11-01'),
(185, '918625805045', 'pending', 480, '2022-11-01 02:58:31', '2022-11-01'),
(186, '2342342323423\r', '', 481, '2022-11-01 03:08:01', '2022-11-01'),
(187, '2342342342\r', '', 481, '2022-11-01 03:08:01', '2022-11-01'),
(188, '2342342', '', 481, '2022-11-01 03:08:01', '2022-11-01'),
(189, '123213123123\r', 'pending', 482, '2022-11-01 03:09:24', '2022-11-01'),
(190, '123123123123\r', 'pending', 482, '2022-11-01 03:09:24', '2022-11-01'),
(191, '12312312312312', 'pending', 482, '2022-11-01 03:09:24', '2022-11-01'),
(192, '\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(193, 'Contact\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(194, '918928550552\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(195, '919310108108\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(196, '91935044170\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(197, '918687881384\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(198, '918128282200\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(199, '918390108752\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(200, '7088974486\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(201, '917080164407\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(202, '919032324422\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(203, '918081829956\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(204, '918949451670\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(205, '919461001408\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(206, '919461001407\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(207, '919351435516\r', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(208, '919461528664', 'delivered', 483, '2022-11-01 10:36:20', '2022-11-01'),
(209, '919461001408\r', 'pending', 484, '2022-11-01 10:46:03', '2022-11-01'),
(210, '919461001407', 'pending', 484, '2022-11-01 10:46:03', '2022-11-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `cp_api_settings`
--
ALTER TABLE `cp_api_settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `cp_site_settings`
--
ALTER TABLE `cp_site_settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `headlines`
--
ALTER TABLE `headlines`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `send_wp_msgs`
--
ALTER TABLE `send_wp_msgs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `wp_mobile_listings`
--
ALTER TABLE `wp_mobile_listings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_api_settings`
--
ALTER TABLE `cp_api_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cp_site_settings`
--
ALTER TABLE `cp_site_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `headlines`
--
ALTER TABLE `headlines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `send_wp_msgs`
--
ALTER TABLE `send_wp_msgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `wp_mobile_listings`
--
ALTER TABLE `wp_mobile_listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
