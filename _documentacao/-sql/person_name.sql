-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2016 at 11:24 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ca`
--

-- --------------------------------------------------------

--
-- Table structure for table `person_name`
--

CREATE TABLE `person_name` (
  `id_ps` int(10) UNSIGNED NOT NULL,
  `ps_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ps_preferencial` int(11) NOT NULL,
  `ps_hidden` int(11) NOT NULL,
  `ps_situacao` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person_name`
--
ALTER TABLE `person_name`
  ADD PRIMARY KEY (`id_ps`),
  ADD UNIQUE KEY `person_name_ps_name_unique` (`ps_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person_name`
--
ALTER TABLE `person_name`
  MODIFY `id_ps` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
