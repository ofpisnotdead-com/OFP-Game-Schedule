ALTER TABLE `users` ADD `timezone` VARCHAR(255) NOT NULL DEFAULT 'Europe/Warsaw';
UPDATE `settings` SET `us_css3` = '../usersc/css/custom.css' WHERE `settings`.`id` = 1;

-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2021 at 09:27 PM
-- Server version: 10.2.36-MariaDB
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofpfagus_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_announce`
--

CREATE TABLE `gs_announce` (
  `id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_log`
--

CREATE TABLE `gs_log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_log_serv_mods`
--

CREATE TABLE `gs_log_serv_mods` (
  `id` int(11) NOT NULL,
  `logid` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `loadorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods`
--

CREATE TABLE `gs_mods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `access` varchar(10) NOT NULL,
  `forcename` tinyint(4) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `is_mp` tinyint(1) NOT NULL DEFAULT 1,
  `dls_new` int(11) NOT NULL DEFAULT 0,
  `dls_upd` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_admins`
--

CREATE TABLE `gs_mods_admins` (
  `id` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isowner` tinyint(1) NOT NULL DEFAULT 0,
  `right_edit` tinyint(1) NOT NULL DEFAULT 0,
  `right_update` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_links`
--

CREATE TABLE `gs_mods_links` (
  `id` int(11) NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `updateid` int(11) NOT NULL,
  `scriptid` int(11) NOT NULL,
  `fromver` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0,
  `alwaysnewest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_scripts`
--

CREATE TABLE `gs_mods_scripts` (
  `id` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `script` text NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_updates`
--

CREATE TABLE `gs_mods_updates` (
  `id` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `scriptid` int(11) NOT NULL,
  `version` float NOT NULL DEFAULT 1,
  `changelog` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv`
--

CREATE TABLE `gs_serv` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `port` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) NOT NULL,
  `version` float NOT NULL DEFAULT 1.99,
  `equalmodreq` tinyint(1) NOT NULL DEFAULT 0,
  `languages` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `access` varchar(10) NOT NULL,
  `maxcustomfilesize` varchar(10) NOT NULL,
  `voice` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_admins`
--

CREATE TABLE `gs_serv_admins` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isowner` tinyint(1) NOT NULL DEFAULT 0,
  `right_edit` tinyint(1) NOT NULL DEFAULT 0,
  `right_schedule` tinyint(1) NOT NULL DEFAULT 0,
  `right_mods` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_mods`
--

CREATE TABLE `gs_serv_mods` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0,
  `loadorder` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_times`
--

CREATE TABLE `gs_serv_times` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `starttime` timestamp NOT NULL DEFAULT current_timestamp(),
  `timezone` varchar(100) NOT NULL DEFAULT 'Europe/Warsaw',
  `duration` int(11) NOT NULL DEFAULT 60,
  `uniqueid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_announce`
--
ALTER TABLE `gs_announce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_log`
--
ALTER TABLE `gs_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_log_serv_mods`
--
ALTER TABLE `gs_log_serv_mods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_mods`
--
ALTER TABLE `gs_mods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_mods_admins`
--
ALTER TABLE `gs_mods_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modid` (`modid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `gs_mods_links`
--
ALTER TABLE `gs_mods_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniqueID` (`uniqueid`),
  ADD KEY `updateid` (`updateid`),
  ADD KEY `scriptid` (`scriptid`);

--
-- Indexes for table `gs_mods_scripts`
--
ALTER TABLE `gs_mods_scripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_mods_updates`
--
ALTER TABLE `gs_mods_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modid` (`modid`),
  ADD KEY `scriptid` (`scriptid`);

--
-- Indexes for table `gs_serv`
--
ALTER TABLE `gs_serv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`uniqueid`),
  ADD KEY `id2` (`uniqueid`),
  ADD KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_serv_admins`
--
ALTER TABLE `gs_serv_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ServerID` (`serverid`),
  ADD KEY `UserID` (`userid`);

--
-- Indexes for table `gs_serv_mods`
--
ALTER TABLE `gs_serv_mods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ModID` (`modid`),
  ADD KEY `ServerID` (`serverid`);

--
-- Indexes for table `gs_serv_times`
--
ALTER TABLE `gs_serv_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueID` (`uniqueid`),
  ADD KEY `ServerID` (`serverid`),
  ADD KEY `UserID` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_announce`
--
ALTER TABLE `gs_announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_log`
--
ALTER TABLE `gs_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_log_serv_mods`
--
ALTER TABLE `gs_log_serv_mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods`
--
ALTER TABLE `gs_mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_admins`
--
ALTER TABLE `gs_mods_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_links`
--
ALTER TABLE `gs_mods_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_scripts`
--
ALTER TABLE `gs_mods_scripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_updates`
--
ALTER TABLE `gs_mods_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv`
--
ALTER TABLE `gs_serv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_admins`
--
ALTER TABLE `gs_serv_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_mods`
--
ALTER TABLE `gs_serv_mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_times`
--
ALTER TABLE `gs_serv_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
