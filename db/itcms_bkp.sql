-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 05:15 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itcms_bkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('2','1') NOT NULL,
  `status` enum('Active','Deactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_detect`
--

CREATE TABLE `admin_detect` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `browser_details` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `check_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assetdetails`
--

CREATE TABLE `assetdetails` (
  `id` int(11) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `hard_disk` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `antivirus` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assetrepair`
--

CREATE TABLE `assetrepair` (
  `id` int(11) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `repair_details` varchar(255) NOT NULL,
  `service_date` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `bill_clear_date` varchar(255) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assetstock`
--

CREATE TABLE `assetstock` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catriedge`
--

CREATE TABLE `catriedge` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `service_date` varchar(255) NOT NULL,
  `refill_amount` int(11) NOT NULL,
  `repair_details` varchar(255) NOT NULL,
  `repair_amount` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `bill_clear_date` varchar(255) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catriedge_type`
--

CREATE TABLE `catriedge_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_routine`
--

CREATE TABLE `daily_routine` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation`) VALUES
(1, 'N/A'),
(2, 'Asst. Manager'),
(3, 'Service Advisor'),
(4, 'CRM'),
(6, 'Cashier'),
(7, 'Executive'),
(8, 'CRE'),
(9, 'Manager'),
(10, 'EDP In-Charge'),
(11, 'HR-Admin'),
(12, 'Technician');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `service_date` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `bill_clear_date` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `from_date` date NOT NULL DEFAULT '2020-12-14',
  `till_date` date NOT NULL,
  `catriedge_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `assetrepair_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(1, 'Diagnosis Room'),
(2, 'Front Office'),
(3, 'Back Office'),
(4, 'Service-Motorrad'),
(5, 'Spare Parts'),
(6, 'Workshop'),
(7, 'Showroom'),
(8, 'Sales-Motorrad'),
(9, 'Second Floor'),
(10, 'Server Room');

-- --------------------------------------------------------

--
-- Table structure for table `network_map`
--

CREATE TABLE `network_map` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `iobox_port_no` int(11) NOT NULL,
  `switch_port_no` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `network_map`
--

INSERT INTO `network_map` (`id`, `user`, `iobox_port_no`, `switch_port_no`, `location`) VALUES
(1, '', 1, 1, 'server'),
(2, '', 2, 2, 'server'),
(3, '', 3, 3, 'server'),
(4, '', 4, 4, 'server'),
(5, 'N/A', 5, 5, 'server'),
(6, '', 6, 6, 'server'),
(7, '', 7, 7, 'server'),
(8, '', 8, 8, 'server'),
(9, '', 9, 9, 'server'),
(10, '', 10, 10, 'server'),
(11, '', 11, 11, 'server'),
(12, '', 12, 12, 'server'),
(13, '', 13, 13, 'server'),
(14, '', 14, 14, 'server'),
(15, '', 15, 15, 'server'),
(16, '', 16, 16, 'server'),
(17, '', 17, 17, 'server'),
(18, '', 18, 18, 'server'),
(19, '', 19, 19, 'server'),
(20, '', 20, 20, 'server'),
(21, '', 21, 21, 'server'),
(22, '', 22, 22, 'server'),
(23, '', 23, 23, 'server'),
(24, '', 24, 24, 'server'),
(25, '', 1, 1, 'front_office'),
(26, '', 2, 2, 'front_office'),
(27, '', 3, 3, 'front_office'),
(28, '', 4, 4, 'front_office'),
(29, 'Ansuman Mallick', 5, 5, 'front_office'),
(30, 'g', 6, 66, 'front_office'),
(31, '', 7, 7, 'front_office'),
(32, '', 8, 8, 'front_office'),
(33, '', 9, 9, 'front_office'),
(34, '', 10, 10, 'front_office'),
(35, '', 11, 11, 'front_office'),
(36, '', 12, 12, 'front_office'),
(37, 'Gyan Ranjan Panda', 13, 6, 'front_office'),
(38, '', 14, 14, 'front_office'),
(39, '', 15, 15, 'front_office'),
(40, '', 16, 16, 'front_office'),
(41, '', 17, 17, 'front_office'),
(42, '', 18, 18, 'front_office'),
(43, '', 19, 19, 'front_office'),
(44, '', 20, 20, 'front_office'),
(45, '', 21, 21, 'front_office'),
(46, '', 22, 22, 'front_office'),
(47, '', 23, 23, 'front_office'),
(48, '', 24, 24, 'front_office'),
(49, '', 1, 1, 'showroom'),
(50, '', 2, 2, 'showroom'),
(51, '', 3, 3, 'showroom'),
(52, '', 4, 4, 'showroom'),
(53, 'Sukhi', 5, 5, 'showroom'),
(54, '', 6, 6, 'showroom'),
(55, '', 7, 7, 'showroom'),
(56, '', 8, 8, 'showroom'),
(57, '', 9, 9, 'showroom'),
(58, '', 10, 10, 'showroom'),
(59, '', 11, 11, 'showroom'),
(60, '', 12, 12, 'showroom'),
(61, '', 13, 13, 'showroom'),
(62, '', 14, 14, 'showroom'),
(63, '', 15, 15, 'showroom'),
(64, '', 16, 16, 'showroom'),
(65, '', 17, 17, 'showroom'),
(66, '', 18, 18, 'showroom'),
(67, '', 19, 19, 'showroom'),
(68, '', 20, 20, 'showroom'),
(69, '', 21, 21, 'showroom'),
(70, '', 22, 22, 'showroom'),
(71, '', 23, 23, 'showroom'),
(72, '', 24, 24, 'showroom'),
(73, '', 1, 1, 'sec_floor'),
(74, '', 2, 2, 'sec_floor'),
(75, '', 3, 3, 'sec_floor'),
(76, '', 4, 4, 'sec_floor'),
(77, 'Debi', 5, 5, 'sec_floor'),
(78, '', 6, 6, 'sec_floor'),
(79, '', 7, 7, 'sec_floor'),
(80, '', 8, 8, 'sec_floor'),
(81, '', 9, 9, 'sec_floor'),
(82, '', 10, 10, 'sec_floor'),
(83, '', 11, 11, 'sec_floor'),
(84, '', 12, 12, 'sec_floor'),
(85, '', 13, 13, 'sec_floor'),
(86, '', 14, 14, 'sec_floor'),
(87, '', 15, 15, 'sec_floor'),
(88, '', 16, 16, 'sec_floor'),
(89, '', 17, 17, 'sec_floor'),
(90, '', 18, 18, 'sec_floor'),
(91, '', 19, 19, 'sec_floor'),
(92, '', 20, 20, 'sec_floor'),
(93, '', 21, 21, 'sec_floor'),
(94, '', 22, 22, 'sec_floor'),
(95, '', 23, 23, 'sec_floor'),
(96, '', 24, 24, 'sec_floor');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `added_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `asset_details` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_of_purchase` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `bill_clear_date` varchar(255) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `isp` varchar(255) NOT NULL,
  `circuit_id` int(11) NOT NULL,
  `sr_no` int(11) NOT NULL,
  `main_ip` varchar(255) NOT NULL,
  `cc_no_charge` varchar(255) NOT NULL,
  `cc_charge` varchar(255) NOT NULL,
  `crm` varchar(255) NOT NULL,
  `crm_phone` varchar(255) NOT NULL,
  `crm_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_type`
--

CREATE TABLE `system_type` (
  `id` int(11) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_type`
--

INSERT INTO `system_type` (`id`, `system_type`, `description`) VALUES
(1, 'CPU', ''),
(2, 'Laptop', ''),
(3, 'Laptop (Personal)', ''),
(4, 'iPad', ''),
(5, 'Dongle', ''),
(6, 'ICOM', ''),
(7, 'ISAP', ''),
(8, 'IMIB', ''),
(9, 'Key Reader', ''),
(11, 'Wi-Fi', ''),
(12, 'Printer', ''),
(13, 'Server', ''),
(14, 'Storage Device', ''),
(15, 'Firewall', ''),
(16, 'ISID', ''),
(17, 'ISSS', ''),
(20, 'Welcome Terminal', ''),
(21, 'BPS TV', ''),
(24, 'Alignment Machine', ''),
(25, 'Brake Tester', ''),
(26, 'VR/EVE', ''),
(27, 'TV', ''),
(28, 'Monitor', ''),
(29, 'Projector', '');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` enum('Active','Completed') NOT NULL,
  `status_all` varchar(255) NOT NULL DEFAULT 'valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_detect`
--
ALTER TABLE `admin_detect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetdetails`
--
ALTER TABLE `assetdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetrepair`
--
ALTER TABLE `assetrepair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetstock`
--
ALTER TABLE `assetstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catriedge`
--
ALTER TABLE `catriedge`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `catriedge_type`
--
ALTER TABLE `catriedge_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_routine`
--
ALTER TABLE `daily_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_map`
--
ALTER TABLE `network_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_type`
--
ALTER TABLE `system_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_detect`
--
ALTER TABLE `admin_detect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetdetails`
--
ALTER TABLE `assetdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetrepair`
--
ALTER TABLE `assetrepair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetstock`
--
ALTER TABLE `assetstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catriedge`
--
ALTER TABLE `catriedge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catriedge_type`
--
ALTER TABLE `catriedge_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_routine`
--
ALTER TABLE `daily_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `network_map`
--
ALTER TABLE `network_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_type`
--
ALTER TABLE `system_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
