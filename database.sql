-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2022 at 12:42 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
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
-- Database: `pjumqjwa_beam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `ewallet` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `bwallet` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `pm` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `ewallet`, `bwallet`, `pm`, `email`, `password`) VALUES
(1, '999999999999mm', '1CZFQGufERnJ8uUWnotcEjjq5D2nhUUiGd', '7567t78g87t6778778', 'admin@turischool.com', 'Today@2022');

-- --------------------------------------------------------

--
-- Table structure for table `adminmessage`
--

CREATE TABLE `adminmessage` (
  `id` int(6) NOT NULL,
  `email` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `status` tinyint(4) NOT NULL,
  `msgid` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `btc`
--

CREATE TABLE `btc` (
  `id` int(11) NOT NULL,
  `plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cointype` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `allamount` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `usd` double NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `tnxid` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `refcode` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `referred` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `btc`
--

INSERT INTO `btc` (`id`, `plan`, `cointype`, `allamount`, `mode`, `usd`, `type`, `email`, `status`, `account`, `comment`, `tnxid`, `refcode`, `referred`, `date`) VALUES
(1, '', 'TETHER TRC20 ', '', '', 300, 'Deposit', 'prestigeguy10@gmail.com', 'pending', 'Class 1', '', 'tnx61f72862b5006', '', '', '2022-01-31 00:08:02'),
(2, '', 'BITCOIN ', '', '', 1500, 'Deposit', 'gseun129@gmail.com', 'approved', 'Class 4', '', 'tnx61f7a6b7f235c', '', '', '2022-01-31 09:07:03'),
(3, '', 'Bitcoin', '', '', 250, 'Deposit', 'gseun129@gmail.com', 'approved', 'Class 1', '', 'tnx61fba1b7259cc', '', '', '2022-02-03 09:34:47'),
(4, '', '', '', 'Bitcoin', 250, 'Withdrawal', 'gseun129@gmail.com', 'pending', 'kjhgfdfghjk', '', '', '', '', '2022-02-03 09:56:19'),
(5, '', '', '', 'Bitcoin', 10, 'Withdrawal', 'gseun129@gmail.com', 'pending', '0x96dbebc358dd47d62179ef95ca2253772b899211', '', '', '', '', '2022-02-03 09:59:47'),
(6, '', 'Bitcoin', '', '', 500, 'Deposit', 'Roselynwilliams3107@gmail.com', 'pending', 'Class 1', '', 'tnx61fbac749607d', '', '', '2022-02-03 10:20:36'),
(7, '', '', '', 'Bitcoin', 120, 'Withdrawal', 'gseun129@gmail.com', 'pending', '2345678', '', '', '', '', '2022-02-03 11:50:14'),
(8, '', 'Bitcoin', '', '', 550, 'Deposit', 'gseun129@gmail.com', 'approved', 'Starter Plan', '', 'tnx6200ed80aa07d', '', '', '2022-02-07 09:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pname` varchar(111) NOT NULL,
  `increase` double NOT NULL,
  `bonus` double NOT NULL,
  `duration` int(111) NOT NULL,
  `pdate` varchar(111) NOT NULL,
  `froms` double NOT NULL,
  `activate` tinyint(4) NOT NULL,
  `usd` double NOT NULL,
  `profit` double NOT NULL,
  `payday` varchar(100) NOT NULL,
  `lprofit` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `email`, `pname`, `increase`, `bonus`, `duration`, `pdate`, `froms`, `activate`, `usd`, `profit`, `payday`, `lprofit`, `status`, `date`) VALUES
(1, 'gseun129@gmail.com', 'Class 4', 2, 0, 25, '2022-01-31 04:14:51', 1500, 0, 1500, 750, '2022/04/01', 210, '', '2022-01-31 09:14:51'),
(2, 'gseun129@gmail.com', 'Class 1', 1.3, 0, 10, '2022-02-03 04:35:01', 200, 0, 250, 32.5, '2022/04/01', 13, '', '2022-02-03 09:35:01'),
(3, 'gseun129@gmail.com', 'Starter Plan', 50, 0, 7, '2022-02-07 11:17:04', 500, 0, 550, 1925, '2022/04/01', 0, '', '2022-02-07 10:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `messageadmin`
--

CREATE TABLE `messageadmin` (
  `id` int(6) NOT NULL,
  `email` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `status` tinyint(4) NOT NULL,
  `msgid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package1`
--

CREATE TABLE `package1` (
  `id` int(6) NOT NULL,
  `pname` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `increase` double NOT NULL,
  `bonus` double NOT NULL,
  `duration` int(11) NOT NULL,
  `froms` double NOT NULL,
  `tos` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `package1`
--

INSERT INTO `package1` (`id`, `pname`, `increase`, `bonus`, `duration`, `froms`, `tos`) VALUES
(5, 'Starter Plans', 50, 0, 7, 500, 5000),
(6, 'Advance Plan', 75, 0, 7, 5000, 10000),
(8, 'Professional Plan', 80, 0, 7, 10000, 15000),
(9, 'Ultimate Plan', 100, 0, 7, 15000, 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(200) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `wl` int(200) NOT NULL,
  `rb` int(200) NOT NULL,
  `currency` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `bname` varchar(200) NOT NULL,
  `baddress` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `cy` varchar(200) NOT NULL,
  `hea` varchar(200) NOT NULL,
  `act` varchar(200) NOT NULL,
  `inert` varchar(200) NOT NULL,
  `jso` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sname`, `wl`, `rb`, `currency`, `branch`, `bname`, `baddress`, `email`, `phone`, `title`, `logo`, `cy`, `hea`, `act`, `inert`, `jso`) VALUES
(2, 'trustfxaid.com', 200, 20, '', '', 'Trust FX Aid', '', 'admin@trustfxaid.com', '', 'Welcome to Trust FX Aid', '', '2022', '../../vendor/twilio/sdk/Services/header.php', 'https://scriptsdemo.website/superadmin/btc_activation.php', '../../vendor/twilio/sdk/Services/initializer.php', '');

-- --------------------------------------------------------

--
-- Table structure for table `tfa`
--

CREATE TABLE `tfa` (
  `id` int(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `qrcode` blob NOT NULL,
  `result` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `refcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `session` tinyint(4) NOT NULL,
  `referred` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profit` double NOT NULL,
  `refbonus` double NOT NULL,
  `walletbalance` double NOT NULL,
  `pm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eth` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `btc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_front` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_back` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`, `password`, `refcode`, `session`, `referred`, `profit`, `refbonus`, `walletbalance`, `pm`, `eth`, `btc`, `date`, `phone`, `zip`, `country`, `account`, `id_front`, `id_back`) VALUES
(2, 'Promise ', 'Promise', 'promise129@gmail.com', 'promise129', '111111', '33MV9kCl8M', 0, '', 2484.5, 0, 5334.5, '', '', '', '2022-01-31 09:02:42', '09023568478', '100234', 'Nigeria', 'Starter', 'gseun129@gmail.com7.jpg', 'gseun129@gmail.com3.jpg'),
(3, 'Roselyn', '', 'Roselynwilliams3107@gmail.com', 'Roselyn007', 'makemoney', 'fhauD9bshT', 0, '', 0, 0, 0, '', '', '', '2022-02-03 09:58:03', '+447868703105', '06435', 'United Kingdom', 'Ultimate', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(122) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `name`, `address`) VALUES
(81, 'Ethereum', '098765tgyhjkojhgh'),
(83, 'perfectmoney', 'perfectmoney'),
(84, 'Bitcoins', '1CZFQGufERnJ8uUWnotcEjjq5D2nhUUiGd');

-- --------------------------------------------------------

--
-- Table structure for table `wbtc`
--

CREATE TABLE `wbtc` (
  `id` int(11) NOT NULL,
  `moni` double NOT NULL,
  `mode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tnx` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `wal` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wbtc`
--

INSERT INTO `wbtc` (`id`, `moni`, `mode`, `email`, `status`, `tnx`, `wal`, `date`) VALUES
(29, 500, 'BTC', 'gseun129@gmail.com', 'pending', 'tnx60ae1b7c7eabb', 'Tuuyfgugy', '2021-05-26 09:57:16'),
(30, 200, 'BTC', 'gseun129@gmail.com', 'pending', 'tnx60ae346591224', 'Hdjejdjdndjdheh', '2021-05-26 11:43:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminmessage`
--
ALTER TABLE `adminmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `btc`
--
ALTER TABLE `btc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messageadmin`
--
ALTER TABLE `messageadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package1`
--
ALTER TABLE `package1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tfa`
--
ALTER TABLE `tfa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wbtc`
--
ALTER TABLE `wbtc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminmessage`
--
ALTER TABLE `adminmessage`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `btc`
--
ALTER TABLE `btc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messageadmin`
--
ALTER TABLE `messageadmin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package1`
--
ALTER TABLE `package1`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tfa`
--
ALTER TABLE `tfa`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `wbtc`
--
ALTER TABLE `wbtc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
