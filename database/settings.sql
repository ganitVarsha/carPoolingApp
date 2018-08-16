-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 12:14 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `scope` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'textbox',
  `settings_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `scope`, `input_type`, `settings_label`, `settings_name`, `value`, `priority`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Web', 'file', 'Logo', 'logo', '', 1, 1, '2018-07-25 11:35:53', NULL),
(2, 'Web', 'textbox', 'Title Bar', 'title_bar', '', 3, 1, '2018-07-25 11:35:53', NULL),
(3, 'Web', 'file', 'Favicon Icon', 'favicon_icon', '', 2, 1, '2018-07-25 11:35:53', NULL),
(4, 'Web', 'textbox', 'Facebook Link', 'facebook_link', '', 4, 1, '2018-07-25 11:35:53', NULL),
(5, 'Web', 'textbox', 'Google Plus Link', 'google_plus_link', '', 5, 1, '2018-07-25 11:35:53', NULL),
(6, 'Web', 'textbox', 'Twitter Link', 'twitter_link', '', 6, 1, '2018-07-25 11:35:53', NULL),
(7, 'Web', 'textbox', 'LinkedIn Link', 'linkedin_link', '', 7, 1, '2018-07-25 11:35:53', NULL),
(8, 'Page', 'textarea', 'About Us', 'about_us', '', 1, 1, '2018-07-25 11:35:53', NULL),
(9, 'Page', 'textarea', 'Contact Us', 'contact_us', '', 2, 1, '2018-07-25 11:35:53', NULL),
(10, 'Page', 'textarea', 'Terms And Conditions', 'terms_and_conditions', '', 3, 1, '2018-07-25 11:35:53', NULL),
(11, 'Page', 'textarea', 'Privacy Policies', 'privacy_policies', '', 4, 1, '2018-07-25 11:35:53', NULL),
(12, 'Page', 'textarea', 'Refund Policies', 'refund_policies', '', 5, 1, '2018-07-25 11:35:53', NULL),
(13, 'Page', 'textarea', 'FAQs', 'faq', '', 6, 1, '2018-07-25 11:35:53', NULL),
(14, 'App', 'textbox', 'Radius', 'radius', '2', 1, 1, '2018-07-25 11:35:53', NULL),
(15, 'App', 'textbox', 'Google API Key', 'google_api_key', '', 2, 1, '2018-07-25 11:35:53', NULL),
(16, 'App', 'textbox', 'Playstore Link', 'play_store_link', '', 3, 1, '2018-07-25 11:35:53', NULL),
(17, 'App', 'textbox', 'App Store Link', 'app_store_link', '', 4, 1, '2018-07-25 11:35:53', NULL),
(18, 'App', 'textbox', 'Google Direction API Key', 'google_direction_api_key', '', 5, 1, '2018-07-25 11:35:53', NULL),
(19, 'App', 'textbox', 'Facebook Secret Key App ID', 'facebook_secret_key_app_appId', '', 6, 1, '2018-08-16 15:00:00', NULL),
(20, 'App', 'textbox', 'Google Plus Secret Key App ID', 'google_plus_secret_key_app_appId', '', 7, 1, '2018-08-16 15:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
