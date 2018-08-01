-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 07:45 AM
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
(1, 9, 'Ganit Softech', '77.0353033', '28.4657162', 'IGI Airpor', '77.0822128', '28.5550838', '30 min', 'all', '3', '10kg', '450', '150', '0', '2018-07-31 01:48:24', '2018-07-31 01:48:24'),
(2, 9, 'Ganit Softech', '77.0353033', '28.4657164', 'IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.0822128', '28.5550838', '30 min', 'all', '3', '10kg', '450', '150', '0', '2018-07-31 02:08:11', '2018-07-31 02:08:11'),
(3, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Near IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.099958', '28.556162', '30 min', 'all', '3', '10kg', '450', '150', '0', '2018-08-01 00:09:14', '2018-08-01 00:09:14'),
(4, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Near IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.109721', '28.551703', '30 min', 'all', '3', '10kg', '450', '150', '0', '2018-08-01 00:10:01', '2018-08-01 00:10:01'),
(5, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Near IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.099426', '28.543259', '30 min', 'all', '3', '10kg', '450', '150', '0', '2018-08-01 00:10:23', '2018-08-01 00:10:23'),
(6, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Near IGI Airport Terminal 3 Metro Station Indira Gandhi International Airport New Delhi Delhi', '77.072714', '28.559314', '30 min', 'best match', '3', '10kg', '450', '150', '0', '2018-08-01 00:10:49', '2018-08-01 00:10:49'),
(7, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Dwarka', '77.067995', '28.564289', '30 min', 'female', '3', '10kg', '450', '150', '0', '2018-08-01 00:11:16', '2018-08-01 00:11:16'),
(8, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Delhi Aerocity', '77.122087', '28.548118', '30 min', 'male', '3', '10kg', '450', '150', '0', '2018-08-01 00:12:22', '2018-08-01 00:12:22'),
(9, 9, 'Ganit Softech', '77.0353033', '28.4657163', 'Vasant Vihar', '77.160550', '28.556266', '30 min', 'best match', '3', '10kg', '450', '150', '0', '2018-08-01 00:14:40', '2018-08-01 00:14:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pools`
--
ALTER TABLE `pools`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pools`
--
ALTER TABLE `pools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
