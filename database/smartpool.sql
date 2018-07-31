-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 11:31 AM
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(13, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(14, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(15, '2016_06_01_000004_create_oauth_clients_table', 1),
(16, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(17, '2018_07_24_101641_create_settings_table', 2),
(18, '2018_07_30_052429_create_pools_table', 3),
(19, '2018_07_30_052439_create_pools_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0174bb75daf6306fbc6bef72e388b95905b54576082fd66359f4b5e50a8e36e1fdbc3eb6d05fd825', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:55:01', '2018-07-26 00:55:01', '2018-08-02 06:25:01'),
('187d27bc9b8755778427b6f829e04dac778cf765f20996208e6a73c7d794de5f20b46d29d7dff94b', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:41:50', '2018-07-26 00:41:50', '2018-08-02 06:11:50'),
('20037a73a73179898578f7e9ed59f795a7f9ad9d7e3250180c165483a2a28c228d8d3122a8228fd2', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 07:26:19', '2018-07-25 07:26:19', '2018-08-01 12:56:20'),
('3288da82da2423e4cdc7da1ae85a8b2fb75e6fd9ac15222898a89a74456d977256f06f03bf388b72', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 06:23:09', '2018-07-25 06:23:09', '2018-08-01 11:53:09'),
('3703e3acde6306698351f7c3c10106956f18f17bf146a4c30fa18161983c218c1980ba5ed1ebb415', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 06:12:42', '2018-07-25 06:12:42', '2018-08-01 11:42:42'),
('41e7372c7dce55b94cc3793fe1d1224649726430bb5fe8ab26758cf83476e96137d98ff218a6dbc3', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-27 05:36:33', '2018-07-27 05:36:33', '2018-08-03 11:06:34'),
('52cc9e68286407d90d77c713903d7cb7b79d77b77bbbffdf431d3d776f7d3c369aa268d07fa2abdc', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 02:49:18', '2018-07-26 02:49:18', '2018-08-02 08:19:18'),
('5c86470b1b74f323f385c5c50f7467c225a461d5277eca68fd9223ab36f72e14bf6984ce2d2d3b6f', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:58:28', '2018-07-26 00:58:28', '2018-08-02 06:28:28'),
('643ae12ff2cf4f1c2e4c9551119f6b6f5123bdc6b9748d58f8eb4f94d9f098dfb35278e22f7aacda', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:58:52', '2018-07-26 00:58:52', '2018-08-02 06:28:52'),
('692d224653910bd8c1a1c005c8b5140476951a22ef6db919edefb7de9583aaecfbde4707a7ea888d', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 08:10:59', '2018-07-25 08:10:59', '2018-08-01 13:41:00'),
('6e9e3771a4ad93a7c400222df762c29a4ae8dae10f6b0d99a5f99fe04344e03ecffbfef1c9c363cc', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:12:34', '2018-07-26 00:12:34', '2018-08-02 05:42:35'),
('9f7588652bd55c66f80dbaaca2d58c853b8a90ec98466cb68a69b558ed46dd5824c43ccbfca44ad9', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:03:16', '2018-07-26 00:03:16', '2018-08-02 05:33:17'),
('ad3eea8cdb124eee6ea674af99889a6865e796a0979eaa09d5529bf487e1a4c85f4aa9a1df5485c3', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:41:07', '2018-07-26 00:41:07', '2018-08-02 06:11:07'),
('b32fb3a0570cd7ee22284bbe209d3d1d6e55922cf0e5cd0c11e7fc3b177643246cde51e24cf08511', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 01:02:49', '2018-07-26 01:02:49', '2018-08-02 06:32:50'),
('c92e97975d237584de86e366a34264b2f718a1d8a40ca7bf6316847e1a03b6234a604f4b4b344651', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 01:00:22', '2018-07-26 01:00:22', '2018-08-02 06:30:22'),
('d11b947d5223967d95e5a77083ad5379a2963182d991ea3672acac1cc4fe811809ec0caa3281118a', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 00:58:47', '2018-07-26 00:58:47', '2018-08-02 06:28:47'),
('d16644803568631c870579be669f47a5a088ae084bc8a675f14ca211cd0c79f6762cab09d5f454b2', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 06:08:06', '2018-07-25 06:08:06', '2018-08-01 11:38:06'),
('e89fb85cfc734beefb51bcc6f4d177f2ddfe94f30b366676ed898a28f11ed702e7487352026cb59e', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 02:49:39', '2018-07-26 02:49:39', '2018-08-02 08:19:39'),
('eb70da2762aff5850a03ab651281ab31d23fe58fb2a6d1e2be7b2d6642cc73b82bd5c1cfac5fc25c', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-25 07:28:37', '2018-07-25 07:28:37', '2018-08-01 12:58:37'),
('f635fdcbc289b4af5f6352649cf12006cb628b393d59fd227db6ecac142033de9aa96b54a31015aa', 9, 1, 'Personal Access Token', '[]', 0, '2018-07-26 01:01:10', '2018-07-26 01:01:10', '2018-08-02 06:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '0KzdDIHS0njrm6075kQhALtLxbFpHSxUlWmswlDo', 'http://localhost', 1, 0, 0, '2018-07-25 06:07:50', '2018-07-25 06:07:50'),
(2, NULL, 'Laravel Password Grant Client', '7flPJEPP82jbVGxKytDIMydMDnLxOqOM7EICxL0q', 'http://localhost', 0, 1, 0, '2018-07-25 06:07:50', '2018-07-25 06:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-07-25 06:07:50', '2018-07-25 06:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('varsha.mittal@ganitsoftech.com', '$2y$10$foSWK1aRpsmgEdfAr48nreUfq7SrcURRdm2dQTOT6SPWTDc82JWby', '2018-07-31 00:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `pools`
--

CREATE TABLE `pools` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeframe` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_poolers` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luggage_capacity` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_fare` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_person_fare` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seats_full` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pools`
--

INSERT INTO `pools` (`id`, `user_id`, `start_location`, `start_longitude`, `start_latitude`, `end_location`, `end_longitude`, `end_latitude`, `timeframe`, `preference`, `num_of_poolers`, `luggage_capacity`, `expected_fare`, `per_person_fare`, `seats_full`, `created_at`, `updated_at`) VALUES
(1, 9, 'Ganit Softech', '77.0353033', '28.4657162', 'IGI Airpor', '77.0822128', '28.5550838', '30 min', 'all', '3', '10kg', '450', '150', '1', '2018-07-31 01:48:24', '2018-07-31 01:48:24'),
(2, 9, 'Ganit Softech', '77.0353033', '28.4657164', 'IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.0822128', '28.5550838', '30 min', 'all', '3', '10kg', '450', '150', '1', '2018-07-31 02:08:11', '2018-07-31 02:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `scope` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `scope`, `settings_name`, `value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Web', 'logo', '', 1, '2018-07-25 06:05:53', NULL),
(2, 'Web', 'title_bar', '', 1, '2018-07-25 06:05:53', NULL),
(3, 'Web', 'favicon_icon', '', 1, '2018-07-25 06:05:53', NULL),
(4, 'Web', 'facebook_link', '', 1, '2018-07-25 06:05:53', NULL),
(5, 'Web', 'google_plus_link', '', 1, '2018-07-25 06:05:53', NULL),
(6, 'Web', 'twitter_link', '', 1, '2018-07-25 06:05:53', NULL),
(7, 'Web', 'linkedin_link', '', 1, '2018-07-25 06:05:53', NULL),
(8, 'Page', 'about_us', '', 1, '2018-07-25 06:05:53', NULL),
(9, 'Page', 'contact_us', '', 1, '2018-07-25 06:05:53', NULL),
(10, 'Page', 'terms_and_conditions', '', 1, '2018-07-25 06:05:53', NULL),
(11, 'Page', 'privacy_policies', '', 1, '2018-07-25 06:05:53', NULL),
(12, 'Page', 'refund_policies', '', 1, '2018-07-25 06:05:53', NULL),
(13, 'Page', 'faq', '', 1, '2018-07-25 06:05:53', NULL),
(14, 'App', 'radius', '2000', 1, '2018-07-25 06:05:53', NULL),
(15, 'App', 'google_api_key', '', 1, '2018-07-25 06:05:53', NULL),
(16, 'App', 'play_store_link', '', 1, '2018-07-25 06:05:53', NULL),
(17, 'App', 'app_store_link', '', 1, '2018-07-25 06:05:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isd` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+91',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00000000000',
  `profession` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature` enum('intro','extro') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` longtext COLLATE utf8mb4_unicode_ci,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `app_user_id`, `first_name`, `last_name`, `gender`, `dob`, `email`, `password`, `isd`, `phone`, `profession`, `nature`, `remember_token`, `api_token`, `isAdmin`, `created_at`, `updated_at`) VALUES
(1, 'sp_hbashdsjadsadsajd', 'Varsha', 'Mittal', NULL, '0000-00-00', 'varsha.mittal@ganitsoftech.com', '$2y$10$iyEedw2aPaCsolCwklpKhOv4b6QYB6rAKfxg3apsmfjOKer7VEqQS', '+91', '8974561000', NULL, NULL, '7raVWRrKnikrdVYb9UuVACl3red55eA1WJ6fFJFN9Q3MZBiZGLZq34UyjfbC', '', 1, '2018-07-27 08:07:40', '2018-07-27 08:07:40'),
(2, 'sp_qwertyuiuyewqwq', 'User2', 'Name', NULL, '0000-00-00', 'user2@gmail.com', '$2y$10$xu1GluxSjhHA8GeLk0LFBuVzhU7KuuLbaximYqNTQR9Twb78CYJ..', '+91', '3216549870', NULL, NULL, 'yG9G5Yl00npG9nvgHgaBUpDqEQ1oyIxuUeGWrtLLVKMUGzJaKR3hyVliDh2v', '', 0, '2018-07-23 01:18:03', NULL),
(6, 'sp_lkjhgfdsasdfghj', 'Testing', '7', NULL, '0000-00-00', 'varsha.mittal@ganitsoftech.com', '$2y$10$Hr9lrmY3h5N.724jBNDfIuUxdSekh2OPwafV10E.JkXKZWOJz3FPG', '+91', '1235467895', NULL, NULL, NULL, '', 1, '2018-07-25 00:21:51', '2018-07-25 00:21:51'),
(9, 'sp_bjsd876sadsadj', 'api', 'Test', 'female', '1993-10-20', 'api@test.con', '$2y$10$lKJkL4ibAdWjaj96YvmEOerkD6HF84tTSUujdHk8dl10O1beB1wP.', '+91', '3692580147', 'Business', 'intro', 'F8r8Pn7mhwKZsAu9zKc29z2hIo3pvAWW3LEBmvgH6aoiX8YQAAG1lLXoYta1', 'jBAlNasEkPneBete', 0, '2018-07-25 06:06:45', '2018-07-31 00:58:41'),
(13, 'sp_sadsadsad21321', NULL, NULL, NULL, '0000-00-00', NULL, NULL, '+91', '8974561001', NULL, NULL, NULL, NULL, 0, '2018-07-27 04:49:41', '2018-07-27 04:49:41'),
(14, 'sp_FnmjHZ30p7', NULL, NULL, NULL, NULL, NULL, NULL, '+91', '9638527410', NULL, NULL, NULL, '8AbFizi5ZvjSKlRa', 0, '2018-07-30 08:33:45', '2018-07-30 08:33:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pools`
--
ALTER TABLE `pools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pools`
--
ALTER TABLE `pools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
