-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2018 at 11:46 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidyanew`
--

-- --------------------------------------------------------

--
-- Table structure for table `marksheets`
--

CREATE TABLE `marksheets` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `mark_subject` int(10) UNSIGNED NOT NULL,
  `mark_student` int(10) UNSIGNED NOT NULL,
  `mark_test_1` int(3) DEFAULT '0',
  `outof_test_1` int(3) DEFAULT '0',
  `mark_test_2` int(3) DEFAULT '0',
  `outof_test_2` int(3) DEFAULT '0',
  `mark_test_3` int(3) DEFAULT '0',
  `outof_test_3` int(3) DEFAULT '0',
  `mark_test_4` int(3) DEFAULT '0',
  `outof_test_4` int(3) DEFAULT '0',
  `mark_test_5` int(3) DEFAULT '0',
  `outof_test_5` int(3) DEFAULT '0',
  `mark_test_6` int(3) DEFAULT '0',
  `outof_test_6` int(3) DEFAULT '0',
  `mark_test_7` int(3) NOT NULL DEFAULT '0',
  `outof_test_7` int(3) NOT NULL DEFAULT '0',
  `mark_test_8` int(3) NOT NULL DEFAULT '0',
  `outof_test_8` int(3) NOT NULL DEFAULT '0',
  `mark_test_9` int(3) NOT NULL DEFAULT '0',
  `outof_test_9` int(3) NOT NULL DEFAULT '0',
  `mark_test_10` int(3) NOT NULL DEFAULT '0',
  `outof_test_10` int(3) NOT NULL DEFAULT '0',
  `mark_test_11` int(3) NOT NULL DEFAULT '0',
  `outof_test_11` int(3) NOT NULL DEFAULT '0',
  `mark_test_12` int(3) NOT NULL DEFAULT '0',
  `outof_test_12` int(3) NOT NULL DEFAULT '0',
  `mark_test_13` int(3) NOT NULL DEFAULT '0',
  `outof_test_13` int(3) NOT NULL DEFAULT '0',
  `mark_test_14` int(3) NOT NULL DEFAULT '0',
  `outof_test_14` int(3) NOT NULL DEFAULT '0',
  `mark_test_15` int(3) NOT NULL DEFAULT '0',
  `outof_test_15` int(3) NOT NULL DEFAULT '0',
  `mark_test_16` int(3) NOT NULL DEFAULT '0',
  `outof_test_16` int(3) NOT NULL DEFAULT '0',
  `mark_test_17` int(3) NOT NULL DEFAULT '0',
  `outof_test_17` int(3) NOT NULL DEFAULT '0',
  `mark_test_18` int(3) NOT NULL DEFAULT '0',
  `outof_test_18` int(3) NOT NULL DEFAULT '0',
  `mark_test_19` int(3) NOT NULL DEFAULT '0',
  `outof_test_19` int(3) NOT NULL DEFAULT '0',
  `mark_test_20` int(3) NOT NULL DEFAULT '0',
  `outof_test_20` int(3) NOT NULL DEFAULT '0',
  `mark_total` int(8) NOT NULL DEFAULT '0',
  `mark_added` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marksheets`
--
ALTER TABLE `marksheets`
  ADD PRIMARY KEY (`mark_id`),
  ADD KEY `mark_student` (`mark_student`),
  ADD KEY `mark_subject` (`mark_subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marksheets`
--
ALTER TABLE `marksheets`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `marksheets`
--
ALTER TABLE `marksheets`
  ADD CONSTRAINT `marksheets_ibfk_2` FOREIGN KEY (`mark_subject`) REFERENCES `subjects` (`sub_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
