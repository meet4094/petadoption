-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2023 at 02:01 AM
-- Server version: 10.3.37-MariaDB
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
-- Database: `aryatech_petadopion`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_name` varchar(512) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `on_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_ignore` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Global Activities';

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_name`, `user_type`, `ip`, `on_date`, `is_ignore`) VALUES
('login_try', 'user', '49.36.80.124', '2022-07-26 06:46:38', 0),
('login_try', 'user', '49.36.82.219', '2022-07-30 06:25:37', 0),
('login_try', 'user', '49.36.82.219', '2022-07-30 10:16:07', 0),
('login_try', 'user', '49.36.88.109', '2022-08-02 06:34:45', 0),
('login_try', 'user', '49.36.86.44', '2022-08-03 12:27:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_category`
--

CREATE TABLE `pets_category` (
  `id` int(11) NOT NULL,
  `category_image` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_date` datetime NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_category`
--

INSERT INTO `pets_category` (`id`, `category_image`, `name`, `created_date`, `modified_date`, `is_del`) VALUES
(1, '2c533672c7570214f159d4314c7f601b.png', 'Dog', '2022-07-14 12:19:03', '0000-00-00 00:00:00', 0),
(2, '89ea99616b1b9f55a1aaba1fb0f4e921.jpg', 'Cat', '2022-07-18 10:52:46', '0000-00-00 00:00:00', 0),
(3, '1099198aa06e72a25cd3e2d0c72c4ebb.jpg', 'Rabbit', '2022-07-30 10:11:50', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_comment`
--

CREATE TABLE `pets_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pets_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Delete , 0 = Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets_comment`
--

INSERT INTO `pets_comment` (`id`, `user_id`, `pets_id`, `comment`, `created_date`, `is_del`) VALUES
(1, 0, 10, '', '2022-07-26 11:42:35', 0),
(2, 0, 4, '', '2022-07-26 11:44:41', 0),
(3, 0, 4, '', '2022-07-26 11:48:42', 0),
(4, 0, 4, '', '2022-07-27 06:17:22', 0),
(5, 0, 10, '', '2022-07-27 06:18:10', 0),
(6, 0, 4, '', '2022-07-27 06:22:57', 0),
(7, 0, 9, '', '2022-07-27 07:13:36', 0),
(8, 0, 9, '', '2022-07-27 07:27:56', 0),
(9, 0, 9, '', '2022-07-29 04:29:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_details`
--

CREATE TABLE `pets_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `gender` tinyint(11) NOT NULL DEFAULT 1 COMMENT '1 = male, 0 = Female',
  `breed` varchar(500) NOT NULL,
  `weight` varchar(500) NOT NULL,
  `age` varchar(500) NOT NULL,
  `color` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `about` varchar(500) NOT NULL,
  `pets_category` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_details`
--

INSERT INTO `pets_details` (`id`, `user_id`, `name`, `gender`, `breed`, `weight`, `age`, `color`, `address`, `about`, `pets_category`, `created_date`, `modified_date`, `is_del`) VALUES
(4, 1, 'Tommy', 0, 'Bulldog', '18', '17', 'yallow', '22 Uxbridge Road Ealing, London W5 2RJ', '', '1', '2022-07-19 10:46:29', '2022-07-19 06:46:29', 0),
(9, 1, 'Oreva', 0, 'indian', '18', '11', 'Grey', 'india', 'xyz', '2', '2022-07-22 08:28:56', '2022-07-22 04:28:56', 0),
(11, 1, 'Rabbit', 0, 'Rabbits', '4', '5', 'White', 'India', 'xyz', '3', '2022-07-30 14:29:35', '2022-07-30 10:29:35', 0),
(15, 3, 'Thumper', 0, 'Angora', '5', '6', 'White', 'USA', 'XYZ', '3', '2022-08-02 13:36:25', '2022-08-02 09:36:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_like`
--

CREATE TABLE `pets_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pets_id` int(11) NOT NULL,
  `pets_like` tinyint(4) NOT NULL COMMENT '1 = Dislike , 0 = like',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Delete , 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_like`
--

INSERT INTO `pets_like` (`id`, `user_id`, `pets_id`, `pets_like`, `created_date`, `is_del`) VALUES
(5, 1, 4, 1, '2022-07-29 05:38:49', 0),
(39, 2, 9, 1, '2022-07-29 09:59:41', 0),
(41, 2, 10, 1, '2022-07-29 10:10:38', 0),
(69, 1, 10, 0, '2022-08-01 06:05:03', 0),
(85, 3, 15, 0, '2022-08-02 09:37:08', 0),
(95, 1, 11, 1, '2022-08-03 09:28:52', 0),
(100, 1, 15, 0, '2022-08-04 09:37:08', 0),
(102, 1, 9, 1, '2022-08-04 09:42:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_photos`
--

CREATE TABLE `pets_photos` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `photo` varchar(512) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '	1 = Deleted, 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_photos`
--

INSERT INTO `pets_photos` (`id`, `pet_id`, `photo`, `created_date`, `is_del`) VALUES
(10, 4, '08baea3165f4f14ba8b806905e6479c9.jpg', '2022-07-19 06:46:29', 0),
(11, 4, '24bb21052a4c3e4ae9131de8a1f27c48.jpg', '2022-07-19 06:46:29', 0),
(12, 4, '3df16a792bc339e10a57b68b564721d5.jpg', '2022-07-19 06:46:29', 0),
(36, 9, '32265b1a63f1a146b84b02e64d4534ce.jpg', '2022-07-22 04:28:56', 0),
(37, 9, '498314e9f75a17a0c643e0b7c459c8b4.jpg', '2022-07-22 04:28:56', 0),
(38, 9, 'a9fde731e88dad73654d8fd88fab7ce2.jpg', '2022-07-22 04:28:56', 0),
(43, 11, '7ea3afb5717ae41e4ef9e31b8dcd17f4.jpg', '2022-07-30 10:29:35', 0),
(44, 11, '7ea3afb5717ae41e4ef9e31b8dcd17f4.jpg', '2022-07-30 10:29:35', 0),
(45, 11, '7ea3afb5717ae41e4ef9e31b8dcd17f4.jpg', '2022-07-30 10:29:35', 0),
(46, 12, '2afcb602e4656c2ab96131b0baa62b4f.jpg', '2022-08-01 04:06:35', 0),
(49, 15, '09c26379b9b1a5808999da0b6c8d8aff.jpg', '2022-08-02 09:36:25', 0),
(50, 15, 'c7179debcd20a2b29814b75ceeb393cf.jpg', '2022-08-02 09:36:25', 0),
(51, 15, '4e04171985f9fd98552b8631d60d79ff.jpg', '2022-08-02 09:36:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_save`
--

CREATE TABLE `pets_save` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pets_id` int(11) NOT NULL,
  `pets_save` tinyint(4) NOT NULL DEFAULT 0 COMMENT '	1 =  Ansave , 0 = Save',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_save`
--

INSERT INTO `pets_save` (`id`, `user_id`, `pets_id`, `pets_save`, `created_date`, `is_del`) VALUES
(34, 1, 4, 1, '2022-08-03 09:18:36', 0),
(58, 1, 11, 1, '2022-08-04 08:59:04', 0),
(67, 1, 15, 1, '2022-08-04 09:37:22', 0),
(69, 1, 9, 1, '2022-08-04 09:42:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets_share`
--

CREATE TABLE `pets_share` (
  `id` int(11) NOT NULL,
  `pets_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Delete , 0 = Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets_share`
--

INSERT INTO `pets_share` (`id`, `pets_id`, `created_date`, `is_del`) VALUES
(1, 1, '2022-07-26 02:36:51', 0),
(2, 4, '2022-07-26 02:38:51', 0),
(3, 10, '2022-07-26 02:39:32', 0),
(4, 4, '2022-07-26 02:45:13', 0),
(5, 10, '2022-07-26 05:30:25', 0),
(6, 10, '2022-07-26 05:38:29', 0),
(7, 10, '2022-07-26 05:39:32', 0),
(8, 10, '2022-07-26 05:39:52', 0),
(9, 9, '2022-07-26 07:45:59', 0),
(10, 9, '2022-07-26 08:29:24', 0),
(11, 9, '2022-07-27 00:37:34', 0),
(12, 9, '2022-07-27 00:37:39', 0),
(13, 10, '2022-07-30 06:04:12', 0),
(14, 10, '2022-07-30 06:04:15', 0),
(15, 11, '2022-08-01 08:54:19', 0),
(16, 11, '2022-08-01 08:54:21', 0),
(17, 9, '2022-08-02 01:10:54', 0),
(18, 15, '2022-08-03 03:30:15', 0),
(19, 11, '2022-08-06 00:35:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `sid` int(11) NOT NULL,
  `setting_name` varchar(256) NOT NULL,
  `setting_value` text NOT NULL,
  `autoload` varchar(5) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Global Settings';

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`sid`, `setting_name`, `setting_value`, `autoload`) VALUES
(1, 'site_name', 'Video Status', 'yes'),
(2, 'unlock_login_interval', '24', 'yes'),
(3, 'no_of_login_attampt', '3', 'yes'),
(4, 'site_status', 'online', 'yes'),
(5, 'request_token', 'li58W70knA6n7aY', 'yes'),
(6, 'admin_email', 'admin@gmail.com', 'no'),
(7, 'admin_password', 'e10adc3949ba59abbe56e057f20f883e', 'no'),
(8, 'admin_forgotpassword_token', '5LTOgjkioqYBCgf9yfGJ', 'no'),
(9, 'support_email', 'alpll.1328@gmail.com', 'no'),
(10, 'api_server_url', 'https://envatomarket.aryatechlabs.com/digitalposter/api', 'no'),
(11, 'latest_apk_version_name', 'v1', 'no'),
(12, 'latest_apk_version_code', '1', 'no'),
(13, 'apk_file_url', 'https://www.google.com', 'no'),
(14, 'whats_new_on_latest_apk', 'Bug Fix.', 'no'),
(15, 'update_skipable', '1', 'no'),
(16, 'ads_enable', '0', 'no'),
(17, 'ads_network', 'AdMob', 'no'),
(18, 'admob_open_id', '', 'no'),
(19, 'admob_banner_ads_id', '', 'no'),
(20, 'admob_interstitial_ads_id', '', 'no'),
(21, 'admob_native_ads_placement_id', '', 'no'),
(22, 'ads_clicks', '', 'no'),
(23, 'adx_open_id', '', 'no'),
(24, 'adx_banner_ads_id', '', 'no'),
(25, 'adx_interstitial_ads_id', '', 'no'),
(26, 'adx_native_ads_placement_id', '', 'no'),
(27, 'fcm_url', 'https://fcm.googleapis.com/fcm/send', 'no'),
(28, 'fcm_key', 'AIzaSyBox0qjps3Px5jvFLDMp4AqsaqUUSNFHW8', 'no'),
(29, 'privacy_policy_url', 'https://www.google.com/', 'no'),
(30, 'share_app_link', 'https://www.google.com/', 'no'),
(31, 'postman_collection', '0e60f6ce5bd1a11188fcbed8ddd3425b.json', 'no'),
(32, 'logo', 'logo.png', 'no'),
(33, 'logo_wide', 'logo_wide.png', 'no'),
(34, 'favicon', 'favicon.ico', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `sh_users`
--

CREATE TABLE `sh_users` (
  `uid` int(11) NOT NULL,
  `google_id` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) NOT NULL,
  `change_email` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `invite_code` int(11) NOT NULL,
  `invite_by` int(11) NOT NULL,
  `enable_push` int(11) NOT NULL DEFAULT 1 COMMENT '0 = Disable,1 = Enable',
  `badge_count` int(11) NOT NULL DEFAULT 0,
  `push_count` int(11) NOT NULL DEFAULT 0,
  `last_seen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL,
  `is_first_login` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = First Login Complete',
  `is_create_profile` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Create Profile Complete',
  `is_active_profile` int(11) NOT NULL DEFAULT 1 COMMENT '0 = Deactivate Profile, 1 = Active',
  `is_active` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Inactive,1 = Active',
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sh_users`
--

INSERT INTO `sh_users` (`uid`, `google_id`, `facebook_id`, `name`, `last_name`, `email`, `address`, `change_email`, `avatar`, `mobile_number`, `invite_code`, `invite_by`, `enable_push`, `badge_count`, `push_count`, `last_seen`, `language`, `created_date`, `modified_date`, `is_first_login`, `is_create_profile`, `is_active_profile`, `is_active`, `is_del`) VALUES
(1, '', '', 'Garvpatel', '', 'xyz@gmail.com', '414cscscc', '', '14fedd3b550cbb85417d239eee3e3eaf.jpg', '12112121212', 50, 50, 1, 0, 0, '1657170822', 'en', '2022-07-07 09:13:42', '2022-07-07 05:13:42', 1, 0, 1, 0, 0),
(3, '', '', 'garv', '', 'garv@gmail.com', 'USA', '', '3a3bdb4281011dd24a8ec317fd41c833.jpg', '54566545677', 50, 50, 1, 0, 0, '1659421571', 'en', '2022-08-02 10:26:11', '2022-08-02 06:26:11', 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sh_users_device`
--

CREATE TABLE `sh_users_device` (
  `login_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `device_id` text NOT NULL,
  `device_token` text NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sh_users_device`
--

INSERT INTO `sh_users_device` (`login_id`, `user_id`, `auth_token`, `device_id`, `device_token`, `device_type`, `created_date`, `modified_date`, `is_del`) VALUES
(366, 3, 'eN16bsTxRhmjV5T', '', '', 'other', '2022-08-02 14:21:51', '0000-00-00 00:00:00', 0),
(425, 1, 'K7ibhyLDa3R94cy', '', '', 'other', '2022-08-26 17:58:27', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sh_users_meta`
--

CREATE TABLE `sh_users_meta` (
  `umid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_meta_key` varchar(40) NOT NULL,
  `user_meta_value` mediumtext NOT NULL,
  `autoload` tinyint(4) NOT NULL DEFAULT 1,
  `is_del` tinyint(4) NOT NULL COMMENT '1 = Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_users_meta`
--

INSERT INTO `sh_users_meta` (`umid`, `user_id`, `user_meta_key`, `user_meta_value`, `autoload`, `is_del`) VALUES
(1, 1, 'password', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(2, 1, 'last_action', '1661522306', 1, 0),
(3, 1, 'user_activation_token', 'sA0L7NyrWFncbxK', 0, 0),
(4, 1, 'last_login', '1661522306', 1, 0),
(5, 1, 'last_login_ip', '157.32.229.182', 0, 0),
(6, 1, 'last_login_device', '', 0, 0),
(13, 3, 'password', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(14, 3, 'last_action', '1659435711', 1, 0),
(15, 3, 'user_activation_token', 'I6Q8tOgRJugsZ6k', 0, 0),
(16, 3, 'last_login', '1659435711', 1, 0),
(17, 3, 'last_login_ip', '49.36.88.109', 0, 0),
(18, 3, 'last_login_device', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets_category`
--
ALTER TABLE `pets_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_comment`
--
ALTER TABLE `pets_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_details`
--
ALTER TABLE `pets_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_like`
--
ALTER TABLE `pets_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_photos`
--
ALTER TABLE `pets_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_save`
--
ALTER TABLE `pets_save`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_share`
--
ALTER TABLE `pets_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sh_users`
--
ALTER TABLE `sh_users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `sh_users_device`
--
ALTER TABLE `sh_users_device`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sh_users_meta`
--
ALTER TABLE `sh_users_meta`
  ADD PRIMARY KEY (`umid`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets_category`
--
ALTER TABLE `pets_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pets_comment`
--
ALTER TABLE `pets_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pets_details`
--
ALTER TABLE `pets_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pets_like`
--
ALTER TABLE `pets_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `pets_photos`
--
ALTER TABLE `pets_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pets_save`
--
ALTER TABLE `pets_save`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pets_share`
--
ALTER TABLE `pets_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sh_users`
--
ALTER TABLE `sh_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sh_users_device`
--
ALTER TABLE `sh_users_device`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `sh_users_meta`
--
ALTER TABLE `sh_users_meta`
  MODIFY `umid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sh_users_device`
--
ALTER TABLE `sh_users_device`
  ADD CONSTRAINT `sh_users_device_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sh_users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sh_users_meta`
--
ALTER TABLE `sh_users_meta`
  ADD CONSTRAINT `sh_users_meta_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sh_users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
