-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2019 at 02:39 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rssnewsreader`
--

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_attempts`
--

CREATE TABLE `rssnewsreader_phpauth_attempts` (
  `id` int(11) NOT NULL,
  `ip` char(39) NOT NULL,
  `expiredate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_config`
--

CREATE TABLE `rssnewsreader_phpauth_config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_emails_banned`
--

CREATE TABLE `rssnewsreader_phpauth_emails_banned` (
  `id` int(11) NOT NULL,
  `domain` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_requests`
--

CREATE TABLE `rssnewsreader_phpauth_requests` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` enum('activation','reset') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_sessions`
--

CREATE TABLE `rssnewsreader_phpauth_sessions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `hash` char(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_phpauth_users`
--

CREATE TABLE `rssnewsreader_phpauth_users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 0,
  `dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rssnewsreader_urls`
--

CREATE TABLE `rssnewsreader_urls` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rssnewsreader_phpauth_attempts`
--
ALTER TABLE `rssnewsreader_phpauth_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `rssnewsreader_phpauth_config`
--
ALTER TABLE `rssnewsreader_phpauth_config`
  ADD UNIQUE KEY `setting` (`setting`);

--
-- Indexes for table `rssnewsreader_phpauth_emails_banned`
--
ALTER TABLE `rssnewsreader_phpauth_emails_banned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rssnewsreader_phpauth_requests`
--
ALTER TABLE `rssnewsreader_phpauth_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `token` (`token`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `rssnewsreader_phpauth_sessions`
--
ALTER TABLE `rssnewsreader_phpauth_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rssnewsreader_phpauth_users`
--
ALTER TABLE `rssnewsreader_phpauth_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `rssnewsreader_urls`
--
ALTER TABLE `rssnewsreader_urls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rssnewsreader_phpauth_attempts`
--
ALTER TABLE `rssnewsreader_phpauth_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rssnewsreader_phpauth_emails_banned`
--
ALTER TABLE `rssnewsreader_phpauth_emails_banned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rssnewsreader_phpauth_requests`
--
ALTER TABLE `rssnewsreader_phpauth_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rssnewsreader_phpauth_sessions`
--
ALTER TABLE `rssnewsreader_phpauth_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rssnewsreader_phpauth_users`
--
ALTER TABLE `rssnewsreader_phpauth_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rssnewsreader_urls`
--
ALTER TABLE `rssnewsreader_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
