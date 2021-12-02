-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2021 at 11:28 AM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nayakweb_itcms`
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `designation`, `department`, `phone`, `email`, `image`, `password`, `role`, `status`) VALUES
(2, 'Manoj Kumar Dhal', 'EDP In-Charge', 'IT', '9777075594', 'edp.orissa@bmw-oslprestige.in', 'bmw.png', '1qaz2wsx', '2', 'Active'),
(14, 'Manager-IT', 'Manager', 'IT', '9874814738', 'manager.it@bmw-oslprestige.in', '1626939060.png', '1qaz2wsx', '1', 'Active');

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

--
-- Dumping data for table `admin_detect`
--

INSERT INTO `admin_detect` (`id`, `email`, `unique_identifier`, `browser_details`, `ip_address`, `check_time`) VALUES
(2, 'manager.it@bmw-oslprestige.in', '0WjzaZfO6js6r7F8XRYfU7Gvbs/Lx/0qqhcGf8Da/ls=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', '182.75.29.194', 1633499579),
(8, 'manager.it@bmw-oslprestige.in', 'qqGHsqtnZWoAdWMin/AwuGxXgHPEcHtdcnzOK0/xG3Y=', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', '182.75.29.194', 1633673599),
(9, 'manager.it@bmw-oslprestige.in', '/TMYoWV/pYYAN1Fupo0KQbKZtRw+4ESdvQlxqoPET3A=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', '182.75.29.194', 1633674136),
(10, 'manager.it@bmw-oslprestige.in', 'Eujq3i2x1mLhRaBy3WhmPpJLaSmd5/EPAu0ZhbY3irA=', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', '182.75.29.194', 1633694451);

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

--
-- Dumping data for table `assetdetails`
--

INSERT INTO `assetdetails` (`id`, `system_type`, `system_name`, `brand`, `model_no`, `serial_no`, `os`, `processor`, `ram`, `hard_disk`, `ip`, `antivirus`, `user`, `designation`, `department`, `location`) VALUES
(1, 'Server', 'ISPA-HUB', 'EATON (ISIS)', 'RX300S6', 'YL6T021874', 'windows server 2012 12rs standard (64 bits)', 'INTEL, Xeon (2) ', '8GB', '600GB', '192.168.1.175', 'Bit Defender\r\nConsole- Kolkata\r\nRenew Date- ', 'N/A', 'N/A', 'IT', 'Server Room'),
(2, 'Storage Device', 'NAS', 'Lenovo-EMC2', 'Px4-400d', '(1S) 70CM9000APS100001V', 'N/A', 'N/A', 'N/A', '1TB*4', '192.168.1.180', 'N/A', 'N/A', 'None', 'IT', 'Diagnosis Room'),
(3, 'CPU', 'SA1', 'ThinkCenter', '0864G4Q', 'L903963', 'windows 7 ultimate (32 bits)', 'Intel Core Duo', '2 GB', '500 GB', '192.168.1.198', 'Bit Defender, Console- Kolkata, Renew Date-', 'Shaikh Mustaque', 'Asst. Manager', 'Service-Car', 'Front Office'),
(4, 'CPU', 'service-pc', 'HP', 'HP Slim Desktop 290-POXXX', '8CG915H7D9', 'windows 10 pro (64 bits)', 'Intel Core 13-i3', '8GB', '1TB', '192.168.1.43', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Front Office'),
(5, 'CPU', 'DESKTOP-73KD9B0', 'HP', 'HP 280 G4 MT Business PC', 'INA851W9QM', 'windows 10 pro (64 bits)', 'Intel Core 13-i3', '4 GB', '1TB', '192.168.1.89', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Seema Rani Nayak', 'CRM', 'Service-Car', 'Front Office'),
(6, 'CPU', 'user-PC', 'HP', 'P2-1155il', '3CR219013Q', 'windows 7 professional (32 bits)', 'Intel P', '2 GB', '500 GB', '192.168.1.199', 'Bit Defender, Console- Kolkata, Renew Date- ', 'Jagan Samal', 'Service Advisor', 'Service-Motorrad', 'Front Office'),
(7, 'CPU', 'DESKTOP-MN6L4QL', 'Lenovo', '90NB0091IN', 'PG02FF5T', 'Windows 10 Home Single Language (64 bit)', 'Intel(R) i3-10100 CPU @ 3.60GHz', '4 GB', '1 TB', '192.168.1.146', 'None.', 'Gyana Ranjan Panda', 'Executive', 'Accounts', 'Front Office'),
(8, 'CPU', 'MALAYA_PC', 'HP', 'P6-2010IX', 'INA137TRJ5', 'windows 7 ultimate (32 bits)', 'Intel P', '2 GB', '500 GB', '192.168.1.78', 'Bit Defender, Console- Kolkata, Renew Date- ', 'Soumya Ranjan Sahoo', 'Executive', 'Accounts', 'Back Office'),
(9, 'ISID', 'Admin', 'Getac', 'S410', 'RK103S0585', 'windows 10 pro (64 bits)', 'Intel R Core (i5)', '16 GB', '1TB', '192.168.1.172 (Wireless) 192.168.1.253 (LAN)', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Technicians-Motorrad', 'Technician', 'Service-Motorrad', 'Service-Motorrad'),
(10, 'ISSS', 'ISSSNext-2', 'HP', 'HP 280 G4 MT Business PC', 'INA910ZP19', 'windows 10 pro (64 bits)', 'Intel R Core (i5)', '8GB', '1TB', '192.168.1.159', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(11, 'ISSS', 'ISSSNext-02', 'HP', 'HP elitedesk 800 G2 SFF', 'SGH612SK5R', 'windows 10 pro (64 bits)', 'Intel R Core (i5)', '8GB', '1TB', '192.168.1.158', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(12, 'CPU', 'Parts', 'HP', 'P6-2010IX', 'INA201YKYG', 'windows 7 Ultimate (32 bits)', 'Intel(R) Pentium(R)', '6 GB', '500 GB', '192.168.1.84', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Pravat Kumar Nayak', 'Executive', 'Spare-Parts', 'Spare Parts'),
(13, 'CPU', 'Parts-PC', 'Zebronics', 'H410M H', 'Mac: 18-C0-4D-B4-42-FC', 'windows 10 pro (64 bits)', 'Intel i3-10th Gen', '8GB', '1TB', '192.168.1.97', 'None', 'Maheswar Samal', 'Asst. Manager', 'Spare-Parts', 'Spare Parts'),
(14, 'CPU', 'User-PC', 'Compaq', 'CQ3320IX', 'INA02705J1', 'windows 7 ultimate (32 bits)', 'Pentium (R)', '1 GB', '320 GB', '192.168.1.122', 'None', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(15, 'Alignment Machine', 'Wheel Alignment', 'Lenovo', '0864G4Q', 'L903701', 'windows 7 professional', 'Intel Dual Core', '4 GB', '1 TB', 'N/A', 'None', 'Technicians', 'N/A', 'Service-Car', 'Workshop'),
(16, 'Brake Tester', 'DESKTOP-70OLI5R', 'HP', 'Inspiron 3277 AIO', '39JNN42', 'Windows 10 Home Single (64 bit)', 'Intel(R) Pentium', '4 GB', '1 TB', 'Automatic', 'None', 'Technicians-Car', 'Technician', 'Service-Car', 'Workshop'),
(17, 'CPU', 'DESKTOP-DRLR73E', 'Lenovo', '10159', 'ES13630457', 'windows 10 pro (64 bits)', 'Intel P', '2 GB', '500 GB', '192.168.0.104', 'None', 'Sushri Sangita Sahoo', 'CRE', 'Sales-Car', 'Showroom'),
(18, 'Laptop', 'AnsumanRay-PC', 'Dell', 'Vostro 15-3568', 'HB3KPJ2', 'windows 7 ultimate (64 bit)', 'Intel R Core i3', '4 GB', '1 TB', '192.168.1.144', 'None', 'Rajesh Mishra', 'Manager', 'Sales-Car', 'Showroom'),
(19, 'CPU', 'DESKTOP-99MKPC4', 'HP', 'HP 280 G4 MT Business PC', 'INA851W9S4', 'windows 10 pro (64 bits)', 'Intel Core', '8GB', '1TB', '192.168.1.179', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Sukhwinder Kaur', 'CRE', 'Sales-Motorrad', 'Showroom'),
(20, 'CPU', 'DESKTOP-Q1CJ04F', 'HP', 'HP 280 G4 MT Business PC', 'INA851W9SX', 'windows 10 pro (64 bits)', 'Intel Core', '4 GB', '1TB', '192.168.1.200', 'None', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(21, 'Laptop', 'hp-PC', 'Compaq', 'Compaq 610', 'CNU0052R7S', 'windows 7 ultimate (32 bits)', 'Intel Core 2Duo', '2 GB', '250 GB', 'Auto', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Sanmaya Das', 'Manager', 'Finance', 'Second Floor'),
(22, 'Laptop', 'LAPTOP-TSDFB60Q', 'Lenovo', 'Lenovo 81D6', 'PF1H9VZ9', 'windows 10 pro (64 bits)', 'AMD Core', '4 GB', '1TB', 'N/A', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'Biswajit Mohapatra', 'Executive', 'Sales-Motorrad', 'Showroom'),
(23, 'CPU', 'DESKTOP-2F1DLD3', 'HP', 'HP 280 G4 MT Business PC', 'INA851W9PS', 'windows 10 pro (64 bits)', 'Intel R (i3)', '4 GB', '1TB', '192.168.1.161', 'None', 'Sales-Motorrad Team', 'Executive', 'Sales-Motorrad', 'Showroom'),
(24, 'Laptop', 'volvo', 'HP', 'HP-240 G3 Notebook PC', 'CND4334H2R', 'windows 7 professional (64 bits)', 'Intel Core', '4 GB', '1TB', '192.168.1.87', 'Bit Defender, Console- Kolkata, Renew Date-', 'Subrat Kumar Pradhan', 'Manager', 'Accounts', 'Second Floor'),
(25, 'CPU', 'OSLPRESTIGE', 'Lenovo', 'Qitian-M4300', '5555555', 'windows 7 ultimate (32 bits)', 'Intel(R) Pentium', '2 GB', '320 GB', '192.168.1.15', 'Bit Defender, Console- Kolkata, Renew Date-', 'N/A', 'Executive', 'Marketing', 'Second Floor'),
(26, 'VR/EVE', 'BMW-CZC933BMK6', 'HP', 'HP 24G4 Workstation', 'CZC933BMK6', 'windows 10 pro for Workstations (64 bits)', 'Intel R', '32 GB', '512 GB', '192.168.1.152', 'Bit Defender, Console- Odisha, Renew Date- 2021-12-01', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(27, 'Welcome Terminal', 'JCP-PC', 'Compaq', 'CQ35201X', 'INA123PKDH', 'windows 7 professional (32 bits)', 'Pentium (R)', '1 GB', '320 GB', '192.168.1.138', 'Bit Defender, Console- Kolkata, Renew Date- ', 'N/A', 'N/A', 'Service-Car', 'Front Office'),
(31, 'CPU', 'Service Reception', 'Lenovo', '8985B11', 'L9HG192', 'windows 7 ultimate (64 bits)', 'Intel(R) Pentium(R) Dual', '3 GB', '160 GB', '192.168.1.139', 'None', 'N/A', 'N/A', 'Service-Car', 'Workshop'),
(37, 'Laptop (Personal)', 'HR-PC', 'Acer', 'Aspire 4736Z', 'LXPFZ0C0189332C3B71601', 'Windows 7 Ultimate (32 bit)', 'Pentium R Dual Core', '3 GB', '500 GB', '192.168.1.96', 'None', 'Ansuman Mallick', 'HR-Admin', 'HR', 'Back Office'),
(38, 'Laptop (Personal)', 'DESKTOP-350LU1N', 'acer', 'Aspire A515-51G', 'NXGT1SI0017390E0E63400', 'windows 10 pro (64 bits)', 'Intel R Core (i5)', '4 GB', '250 GB', '192.168.1.250', 'None', 'Chandan Kumar Nayak', 'Executive', 'IT', 'Back Office'),
(39, 'Laptop (Personal)', 'LAPTOP-A9HGP104', 'ASUSVivoBook', 'VivoBook_ASUSLaptop X512DA_X512DA', 'K8N0CV03Z201328', 'windows 10 Home (64 bits)', 'AMD Ryzen 5', '8 GB', '512 GB', 'Nonexzdfz', 'None', 'Ashis Prasad Sahoo', 'Executive', 'Sales-Motorrad', 'Sales-Motorrad'),
(40, 'Laptop (Personal)', 'LAPTOP-RF975DTO', 'Lenovo', '80X4', 'MP1B7HUW', 'windows 10 Home (64 bits)', 'Intel R i3', '4 GB', '1 TB', 'Not Assigned', 'None', 'Subhasis Mishra', 'Asst. Manager', 'Sales-Car', 'Showroom'),
(41, 'Laptop (Personal)', 'LAPTOP-TI5VKG4L', 'Lenovo', 'N/A', 'N/A', 'windows 10 pro (64 bits)', 'Intel R', '4 GB', '1 TB', 'N/A', 'None', 'Srikanta Acharya', 'Asst. Manager', 'Sales-Car', 'Showroom'),
(45, 'Dongle', '4G MiFi Router', 'Airtel', 'WD670', 'IMEI- 863334036680469', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Subrat Kumar Pradhan', 'Manager', 'Accounts', 'Second Floor'),
(47, 'IMIB', 'IMIBR2-0000146', 'GETAC', 'E100-AVL', 'RCB36E0117', 'Windows 10 Pro (32 bit)', 'Intel(R) Atom(TM)', '2 GB', '64 GB', '192.168.1.125', 'None', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(48, 'Wi-Fi', 'Osl-Prestige-Cuttack', 'Tenda', 'Wireless N-301', 'E0681012638019432', 'N/A', 'N/A', 'N/A', 'N/A', '192.168.1.163', 'N/A', 'Sales-Motorrad Team', 'Executive', 'Sales-Motorrad', 'Sales-Motorrad'),
(49, 'Wi-Fi', 'OSL-Prestige-Sales', 'D-Link', 'DIR-615', 'TW011J9002184', 'N/A', 'N/A', 'N/A', 'N/A', '192.168.1.222', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(50, 'Wi-Fi', 'BMW Workshop', 'tp-Link', 'TL-WR840N', '2179027010077', 'N/A', 'N/A', 'N/A', 'N/A', '192.168.1.248', 'N/A', 'N/A', 'N/A', 'Service-Car', 'Front Office'),
(51, 'ISAP', 'ISAP', 'Electrobit', 'EB9303613', '0010844141', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Workshop'),
(52, 'Wi-Fi', 'OSL-Prestige-Backoffice', 'D-Link', 'DIR-524', 'Q90B2B9006343', 'N/A', 'N/A', 'N/A', 'N/A', '192.168.1.111', 'N/A', 'N/A', 'N/A', 'IT', 'Back Office'),
(53, 'iPad', 'Osls ipad (1)', 'Apple', 'MR7F2HN/A', 'DMPZC2YZJF8J', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(54, 'iPad', 'Osls iPad (3)', 'Apple', 'MR7F2HN/A', 'DMPZC010JF8J', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(55, 'iPad', 'Osls iPad (5)', 'Apple', 'MR7F2HN/A', 'DMPZC2XGJF8J', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(56, 'iPad', 'Osls iPad (2)', 'Apple', 'MR7F2HN/A', 'DMPZC2LRJF8J', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(57, 'iPad', 'Osls iPad (6)', 'Apple', 'MRJN2HN/A', 'F9FXF675JMVR', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Back Office'),
(58, 'iPad', 'Osls iPad (4)', 'Apple', 'MRJN2HN/A', 'F9FYP6D1JMVR', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Srikanta Acharya', 'Asst. Manager', 'Sales-Car', 'Showroom'),
(59, 'iPad', 'Osls iPad (7)', 'Apple', 'MRJN2HN/A', 'DMPZ1HM9JMVR', 'iPadOS 15', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Subhasis Mishra', 'Asst. Manager', 'Sales-Car', 'Showroom'),
(60, 'Dongle', '4G MiFi Router', 'Airtel', 'WD670', 'IMEI- 863334036680386', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Shaikh Mustaque', 'Asst. Manager', 'Service-Car', 'Back Office'),
(61, 'BPS TV', 'BPS TV', 'LG', '55TA3E', '809KCYQL5226', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(62, 'Monitor', 'Compaq Monitor', 'Compaq', 'W185q ', 'CNT947C9LQ', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Soumya Ranjan Sahoo', 'Executive', 'Accounts', 'Back Office'),
(63, 'Monitor', 'lenovo pc', 'lenovo', 'N/A', '8ML1253E39N3907', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sushri Sangita Sahoo', 'CRE', 'Sales-Car', 'Showroom'),
(64, 'Monitor', 'MONITOR', 'DELL', 'E1910Hc', 'CN-0U417N-64180-12C-1975', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Seema Rani Nayak', 'CRM', 'Service-Car', 'Front Office'),
(65, 'Monitor', 'HP W1972a MONITOR', 'HP', 'W1972a', '6CM22213HR', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Front Office'),
(66, 'Monitor', 'HP Monitor', 'HP', 'v185e', 'CNT93455SB', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Jagan Samal', 'Service Advisor', 'Service-Motorrad', 'Front Office'),
(67, 'Printer', 'Printer-1', 'HP', 'Laserjet M1136 MFP', 'CNJKM9SDBK', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Front Office'),
(68, 'Printer', 'Printer-2', 'HP', 'Laserjet M1136 MFP', 'CNJKM3C1BT', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Gyana Ranjan Panda', 'Cashier', 'Finance', 'Back Office'),
(69, 'Printer', 'Printer-3', 'HP', 'Laserjet M1005 MFP', 'CNH8G5Y62J', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Ansuman Mallick', 'HR-Admin', 'HR', 'Back Office'),
(70, 'Monitor', 'Compaq monitor', 'Compaq', 'B191', 'CNC0450H43', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Motorrad Team', 'Executive', 'Sales-Motorrad', 'Sales-Motorrad'),
(71, 'Printer', 'Printer-4', 'HP', 'Laserjet M1007 MFP', 'VNF8P33161', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Maheswar Samal', 'Asst. Manager', 'Spare-Parts', 'Spare Parts'),
(72, 'Monitor', 'HP Monitor', 'HP', 'V190', '1CR9040DYF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sukhwinder Kaur', 'CRE', 'Sales-Motorrad', 'Sales-Motorrad'),
(73, 'Printer', 'Printer-5 (Wheel Alignment)', 'HP', 'Laserjet 2000', 'CN08B14HF2', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Service-Car', 'Workshop'),
(74, 'Monitor', 'HP Monitor', 'HP', '19ka', 'CNC9501SFS', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Executive', 'Marketing', 'Second Floor'),
(75, 'Printer', 'Printer-6', 'HP', 'Laserjet M1536 DNF MFP', 'CND9D20BFZ', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sushri Sangita Sahoo', 'Executive', 'Sales-Car', 'Showroom'),
(76, 'Printer', 'Printer-7', 'HP', 'Laserjet P1007 MFP', 'VNF5156508', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sukhwinder Kaur', 'Executive', 'Sales-Motorrad', 'Showroom'),
(77, 'Monitor', 'CCTV', 'HP', 'v185e', 'CNT93758M7', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'HR', 'Workshop'),
(78, 'Printer', 'Printer-8', 'HP', 'Laserjet P1007 MFP', 'VNFND01574', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Subrat Kumar Pradhan', 'Manager', 'Finance', 'Second Floor'),
(79, 'Printer', 'Printer-9 ( Break Tester )', 'EPSON', 'L130-B521D2', 'VJ5K235756', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Service-Car', 'Workshop'),
(80, 'ICOM', 'ICOM-1', 'ANATEL/ANTIA', 'AR10008059', '2125527 45/18 C', 'N/A', 'MAC-C4BA99048413', 'N/A', 'N/A', '192.168.1.42', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Workshop'),
(81, 'Monitor', 'HP Monitor', 'HP', 'LV1561w', 'CNC941RF1R', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Service-Car', 'Front Office'),
(82, 'Monitor', 'Welcome Terminal', 'Sony', 'KLV-32BX350', '3413453', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Service-Car', 'Front Office'),
(83, 'ICOM', 'ICOM-2', 'ANATEL/ANTIA', 'AR10008059', '2105632 19/16 A', 'N/A', 'MAC-C4BA9903E8A5', 'N/A', 'N/A', '192.168.1.5', 'NA', 'Technicians-Car', 'Technician', 'Service-Car', 'Workshop'),
(84, 'ICOM', 'ICOM-3', 'ANATEL/ANTIA', 'AR10008059', '2125641 45/18 C', 'N/A', 'MAC-C4BA990484F7', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Motorrad', 'Technician', 'Service-Motorrad', 'Workshop'),
(85, 'Monitor', 'LCD Monitor (wheel alignment)', 'lenovo', 'D186wA', 'V1V5630', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Workshop'),
(86, 'Monitor', 'LED Monitor', 'ZEBRONICS', 'ZEB-A19HD', '124307201899', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Maheswar Samal', 'Asst. Manager', 'Spare-Parts', 'Spare Parts'),
(87, 'Monitor', 'CCTV', 'HP', 'V190', '1CR9040DYP', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'HR', 'Sales-Motorrad'),
(88, 'VR/EVE', 'Vive headset', 'htc', 'N/A', 'FA917JJ01459', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(89, 'VR/EVE', 'Link box', 'htc', 'N/A', 'FA914A900449', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(90, 'VR/EVE', 'Vive controller 1', 'htc', 'N/A', 'FA917J001944', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(91, 'VR/EVE', 'Vive controller 2', 'htc', 'N/A', 'FA917J003059', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(92, 'VR/EVE', 'Base station 1', 'htc', 'N/A', 'FA915AA01339', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(93, 'VR/EVE', 'Base station 2', 'htc', 'N/A', 'FA915AA00642', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(94, 'VR/EVE', 'Headphone', 'htc', 'N/A', 'FA912AB02035', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(96, 'Monitor', 'HP Monitor', 'HP', 'S1935a', 'CNC133Q2HL', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Pravat Kumar Nayak', 'Executive', 'Spare-Parts', 'Spare Parts'),
(97, 'Monitor', 'Server ', 'lenovo', 'D186wA', 'V1V5589', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'IT', 'Server Room'),
(98, 'Monitor', 'LG Monitor', 'LG', 'W1643C', '101PMHW050601', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(99, 'Monitor', 'HP Monitor', 'HP', 'HSTND-9571-F', '3CQ8371JYB', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(100, 'Monitor', 'HP Monitor', 'HP', 'EliteD E232', 'CN45500D0Y', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Technicians-Car', 'Technician', 'Service-Car', 'Diagnosis Room'),
(101, 'Monitor', 'LENOVO LCD Monitor', 'lenovo', 'D186wA', 'V1V5654', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Shaikh Mustaque', 'Asst. Manager', 'Service-Car', 'Back Office'),
(102, 'Monitor', 'HP Monitor', 'HP', 'W1972a', '6CM3152430', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Gyana Ranjan Panda', 'Executive', 'Accounts', 'Back Office'),
(103, 'TV', 'LG TV 1', 'LG', '43LT340C0TB', '911PLUH021526', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(104, 'TV', 'LG TV 2', 'LG', '43LT340C0TB', '911PLFJ021483', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(105, 'VR/EVE', 'BMW POS Digital Player', 'HYRICAN', 'S SKU2', 'P10411400004', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Sales-Car', 'Showroom'),
(106, 'Key Reader', 'Key Reader Plus', 'ANATEL', 'N/A', '264261', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Front Office'),
(107, 'Key Reader', 'PGSYU0GC5HND', 'ANATEL', 'MTR 1-125 2000-00001', '024486', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Debi Prasad Satapathy', 'Service Advisor', 'Service-Car', 'Front Office'),
(108, 'Firewall', 'FORTIGATE-60D', 'FORTINET', 'FG-60D', 'FGT60D4614011464', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'IT', 'Server Room'),
(109, 'Projector', 'Benq Joybee GP1 series', 'Benq', 'GP1', 'PDT9A01132001', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'IT', 'Back Office');

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

--
-- Dumping data for table `assetrepair`
--

INSERT INTO `assetrepair` (`id`, `system_type`, `serial_no`, `user`, `repair_details`, `service_date`, `vendor`, `bill_no`, `cheque_no`, `bill_clear_date`, `total_cost`) VALUES
(7, 'Printer', 'None', 'Debi Prasad Satapathy', 'Teflon, Pickup, Roller, Power supply & maintenance.', '2021-01-07', 'Global Computer Solutions', '198', '012081', '2021-01-12', 1650),
(8, 'Printer', 'None', 'Sales-Car', 'Plumber Repairing.', '2021-02-01', 'Global Computer Solutions', '228', '', '', 767),
(11, 'Alignment Machine', 'N/A', 'Service-Car', 'Monitor Power Supply Unit repair.', '2021-09-06', 'Global Computer Solutions', '138', '', '', 950),
(12, 'Alignment Machine', 'N/A', 'Technicians-Car', 'Installation of OS (windows 7 professional)', '2021-09-11', 'Global Computer Solutions', '148', '', '', 350),
(13, 'Printer', 'N/A', 'Maheswar Samal', 'Teflon & Pressure roller changed.', '2021-09-20', 'Global Computer Solutions', '156', '', '', 1250);

-- --------------------------------------------------------

--
-- Table structure for table `assetstock`
--

CREATE TABLE `assetstock` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assetstock`
--

INSERT INTO `assetstock` (`id`, `asset_name`, `quantity`) VALUES
(13, '12A Catriedge.', 5),
(14, '78A Catriedge.', 1),
(16, 'D-Link 8-Port Network Switch.', 1),
(17, 'D-Link Wi-Fi.', 1),
(18, '88A Catriedge.', 1),
(19, 'CPU Fan.', 1),
(20, 'RJ-45 connector box.', 1),
(21, 'Wireless Keyboard.', 1),
(22, 'DDR-2 RAM', 3),
(23, 'Mouse', 2),
(24, 'Printer Roller', 1);

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

--
-- Dumping data for table `catriedge`
--

INSERT INTO `catriedge` (`id`, `type`, `user`, `vendor`, `service_date`, `refill_amount`, `repair_details`, `repair_amount`, `bill_no`, `cheque_no`, `bill_clear_date`, `total_cost`) VALUES
(71, '88A', 'Debi Prasad Satapathy', 'Gayatri Computers', '2020-12-14', 300, 'N/A', 0, '1748', '012080', '2021-01-12', 300),
(72, '88A', 'Gyana Ranjan Panda', 'Gayatri Computers', '2020-12-14', 300, 'N/A', 0, '1748', '012080', '2021-01-12', 300),
(73, '88A', 'Debi Prasad Satapathy', 'Gayatri Computers', '2020-12-28', 300, 'N/A', 0, '1848', '012080', '2021-01-12', 300),
(75, '88A', 'Gyana Ranjan Panda', 'Gayatri Computers', '2020-12-28', 300, 'N/A', 0, '1848', '012080', '2021-01-12', 300),
(76, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-01-18', 300, 'N/A', 0, '209', '012100', '2021-02-11', 300),
(77, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-01-22', 300, 'N/A', 0, '219', '012100', '2021-02-11', 300),
(78, '88A', 'N/A', 'Global Computer Solutions', '2021-01-22', 300, 'N/A', 0, '219', '012100', '2021-02-11', 300),
(79, '88A', 'Maheswar Samal', 'Global Computer Solutions', '2021-02-12', 300, 'Drum Change.', 118, '246', '012105', '2021-03-06', 418),
(80, '88A', 'Sukhwinder Kaur', 'Global Computer Solutions', '2021-02-12', 300, 'N/A', 0, '246', '012105', '2021-03-06', 300),
(81, '78A', 'Sales-Car', 'Global Computer Solutions', '2021-02-12', 300, 'N/A', 0, '246', '012105', '2021-03-06', 300),
(82, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-02-23', 300, 'N/A', 0, '260', '012105', '2021-03-06', 300),
(83, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-02-24', 300, 'N/A', 0, '262', '012105', '2021-03-06', 300),
(84, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-03-23', 300, 'N/A', 0, '292', '012123', '2021-05-11', 300),
(85, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-04-23', 300, 'N/A', 0, '24', '012123', '2021-05-11', 300),
(86, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-04-23', 300, 'MAG Roller Change.', 118, '24', '012123', '2021-05-11', 418),
(87, '88A', 'Maheswar Samal', 'Gayatri Computers', '2020-12-14', 300, 'N/A', 0, '1748', '012080', '2021-01-12', 300),
(90, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-07-06', 300, 'N/A', 0, '63', '0121239', '2021-07-28', 300),
(91, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-07-06', 300, 'N/A', 0, '63', '0121239', '2021-07-28', 300),
(92, '88A', 'Sukhwinder Kaur', 'Global Computer Solutions', '2021-07-06', 300, 'N/A', 0, '63', '0121239', '2021-07-28', 300),
(93, '88A', 'Maheswar Samal', 'Global Computer Solutions', '2021-07-13', 300, 'N/A', 0, '72', '0121239', '2021-07-28', 300),
(94, '88A', 'N/A', 'Global Computer Solutions', '2021-07-13', 300, 'N/A', 0, '72', '0121239', '2021-07-28', 300),
(95, '78A', 'Sales-Car', 'Global Computer Solutions', '2021-07-16', 300, 'N/A', 0, '76', '0121239', '2021-07-28', 300),
(96, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-07-28', 300, 'Laser toner spares pcr.', 118, '86', '', '', 418),
(97, '12A', 'Ansuman Mallick', 'Global Computer Solutions', '2021-07-29', 300, '1. Drum Change.\r\n2. Blade Change.', 198, '90', '', '', 498),
(98, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-08-27', 300, 'No', 0, '131', '', '', 300),
(99, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-08-27', 300, 'Drum change.', 118, '132', '', '', 418),
(100, '78A', 'Sales-Car', 'Global Computer Solutions', '2021-09-09', 300, 'No', 0, '146', '', '', 300),
(101, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-09-23', 300, 'Magnet roller changed.', 80, '162', '', '', 380),
(102, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-09-23', 300, 'NA', 0, '162', '', '', 300),
(103, '88A', 'Maheswar Samal', 'Global Computer Solutions', '2021-09-23', 300, 'Wiper blade, PCR & Drum changed.', 340, '162', '', '', 640),
(104, '88A', 'N/A', 'Global Computer Solutions', '2021-09-23', 0, 'PCR changed.', 80, '162', '', '', 80),
(105, '88A', 'Gyana Ranjan Panda', 'Global Computer Solutions', '2021-10-06', 300, 'N/A', 0, 'N/A', '', '', 300),
(106, '78A', 'Sales-Car', 'Global Computer Solutions', '2021-10-06', 300, 'Drum & Magnet roller changed.', 0, 'NA', '', '', 300),
(107, '88A', 'Debi Prasad Satapathy', 'Global Computer Solutions', '2021-10-06', 300, 'NA', 0, 'N/A', '', '', 300);

-- --------------------------------------------------------

--
-- Table structure for table `catriedge_type`
--

CREATE TABLE `catriedge_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catriedge_type`
--

INSERT INTO `catriedge_type` (`id`, `type`) VALUES
(1, '12A'),
(2, '78A'),
(3, '88A');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company`) VALUES
(1, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011');

-- --------------------------------------------------------

--
-- Table structure for table `daily_routine`
--

CREATE TABLE `daily_routine` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_routine`
--

INSERT INTO `daily_routine` (`id`, `task`, `status`) VALUES
(1, 'Display today\'s service history on Welcome Terminal. ', '0'),
(2, 'Restart ISAP.', '0'),
(3, 'Restart DCOM service in ISPA HUB. ', '0'),
(4, 'Health check ISPI Admin Client in ISPA HUB, ISSS-1, ISSS-2, ISID, IMIB, SA System & CRM System.', '0'),
(5, 'Check updates in S-Gate portal cockpit.', '0'),
(6, 'Check working of EVE in VR Zone.', '0'),
(7, 'Start BPS Server.', '0');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(1, 'Sales-Car'),
(2, 'Sales-Motorrad'),
(3, 'Service-Car'),
(4, 'Service-Motorrad'),
(5, 'Accounts'),
(6, 'IT'),
(7, 'Spare-Parts'),
(11, 'HR'),
(12, 'Finance'),
(13, 'Marketing');

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

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `details`, `user`, `service_date`, `vendor`, `bill_no`, `bill_clear_date`, `cheque_no`, `cost`, `company`, `from_date`, `till_date`, `catriedge_id`, `purchase_id`, `assetrepair_id`) VALUES
(11, 'Teflon, Pickup, Roller, Power supply & maintenance.', 'Debi Prasad Satapathy', '2021-01-07', 'Global Computer Solutions', '198', '2021-01-12', '012081', 1650, 'OSL Prestige Pvt. Ltd., Odisha. At- Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-04-30', NULL, 0, 7),
(12, 'Plumber Repairing.', 'Sales-Car', '2021-02-01', 'Global Computer Solutions', '228', '', '', 767, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-18', 0, 0, 8),
(20, 'D-Link RJ-45 connector box.', 'N/A', '2020-12-16', 'Global Computer Solutions', '180', '2021-01-12', '012081', 700, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-15', 0, 10, 0),
(21, '18.5\" compaq monitor.', 'Sales-Motorrad Team', '2020-12-29', 'Gayatri Computers', '1855', '2020-12-30', '000455', 4580, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 11, 0),
(22, 'Zebronics UPS.', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 1650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 12, 0),
(23, 'Frontech keyboard.', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 200, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 13, 0),
(24, 'Logitech-M90 mouse.', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 14, 0),
(25, 'Zebronics UPS.', 'Sukhwinder Kaur', '2021-01-19', 'Global Computer Solutions', '210', '', '', 1650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 15, 0),
(26, 'Exide UPS battery. (A.E.O.B)', 'Pravat Kumar Nayak', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-19', 0, 16, 0),
(27, 'Exide UPS battery. (A.E.O.B)', 'Shaikh Mustaque', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 17, 0),
(28, 'Exide UPS battery. (A.E.O.B)', 'Sales-Car', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 18, 0),
(29, 'Exide UPS battery. (A.E.O.B)', 'Sales-Car', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 19, 0),
(30, 'Exide UPS battery. (A.E.O.B)', 'Sales-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 20, 0),
(31, 'Exide UPS battery. (A.E.O.B)', 'Service-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 21, 0),
(32, 'Exide UPS battery. (A.E.O.B)', 'Service-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 22, 0),
(33, 'Zebronics LED monitor.', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 23, 0),
(34, 'NVIDIA GT Force GT 710 Graphics Card.', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 24, 0),
(35, 'DDR-4 RAM 8GB.', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 25, 0),
(36, 'Zebronics CPU Cabinet with SMPS.', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '2021-03-06', '012105', 1300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 26, 0),
(37, 'Gigabyte mother board.', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '2021-03-06', '012105', 5400, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 27, 0),
(38, 'i3-10th Gen processor.', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '2021-03-06', '012105', 7100, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 28, 0),
(39, 'CPU Fan.', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '2021-03-06', '012105', 350, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 29, 0),
(40, 'Seagate 1TB HDD.', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '2021-03-06', '012105', 3200, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-20', 0, 30, 0),
(41, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2020-12-14', 'Gayatri Computers', '1748', '2021-01-12', '012080', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 71, 0, 0),
(42, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2020-12-14', 'Gayatri Computers', '1748', '2021-01-12', '012080', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 72, 0, 0),
(43, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2020-12-28', 'Gayatri Computers', '1848', '2021-01-12', '012080', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 73, 0, 0),
(45, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2020-12-28', 'Gayatri Computers', '1848', '2021-01-12', '012080', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 75, 0, 0),
(46, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-01-18', 'Global Computer Solutions', '209', '2021-02-11', '012100', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 76, 0, 0),
(47, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-01-22', 'Global Computer Solutions', '219', '2021-02-11', '012100', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 77, 0, 0),
(48, 'Catriedge refill/repair.', 'N/A', '2021-01-22', 'Global Computer Solutions', '219', '2021-02-11', '012100', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 78, 0, 0),
(49, 'Catriedge refill/repair.', 'Maheswar Samal', '2021-02-12', 'Global Computer Solutions', '246', '2021-03-06', '012105', 418, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 79, 0, 0),
(50, 'Catriedge refill/repair.', 'Sukhwinder Kaur', '2021-02-12', 'Global Computer Solutions', '246', '2021-03-06', '012105', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 80, 0, 0),
(51, 'Catriedge refill/repair.', 'Sales-Car', '2021-02-12', 'Global Computer Solutions', '246', '2021-03-06', '012105', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 81, 0, 0),
(52, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-02-23', 'Global Computer Solutions', '260', '2021-03-06', '012105', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 82, 0, 0),
(53, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-02-24', 'Global Computer Solutions', '262', '2021-03-06', '012105', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-22', 83, 0, 0),
(54, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-03-23', 'Global Computer Solutions', '292', '2021-05-11', '012123', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-27', 84, 0, 0),
(55, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-04-23', 'Global Computer Solutions', '24', '2021-05-11', '012123', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-27', 85, 0, 0),
(56, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-04-23', 'Global Computer Solutions', '24', '2021-05-11', '012123', 418, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-27', 86, 0, 0),
(57, 'Catriedge refill/repair.', 'Maheswar Samal', '2020-12-14', 'Gayatri Computers', '1748', '2021-01-12', '012080', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-27', 87, 0, 0),
(60, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-07-06', 'Global Computer Solutions', '63', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 90, 0, 0),
(61, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-07-06', 'Global Computer Solutions', '63', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 91, 0, 0),
(62, 'Catriedge refill/repair.', 'Sukhwinder Kaur', '2021-07-06', 'Global Computer Solutions', '63', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 92, 0, 0),
(63, 'Catriedge refill/repair.', 'Maheswar Samal', '2021-07-13', 'Global Computer Solutions', '72', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 93, 0, 0),
(64, 'Catriedge refill/repair.', 'N/A', '2021-07-13', 'Global Computer Solutions', '72', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 94, 0, 0),
(65, 'Catriedge refill/repair.', 'Sales-Car', '2021-07-16', 'Global Computer Solutions', '76', '2021-07-28', '0121239', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 95, 0, 0),
(66, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-07-28', 'Global Computer Solutions', '86', '', '', 418, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 96, 0, 0),
(67, 'Frontech keyboard.', 'Service-Car', '2021-07-29', 'Global Computer Solutions', '88', '', '', 236, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 0, 31, 0),
(69, 'Zebronics keyboard.', 'Service-Car', '2021-07-29', 'Global Computer Solutions', '88', '', '', 236, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-07-30', 0, 33, 0),
(77, 'Exide UPS battery. (A.E.O.B)', 'Debi Prasad Satapathy', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-08-12', 0, 41, 0),
(78, 'Catriedge refill/repair.', 'Ansuman Mallick', '2021-07-29', 'Global Computer Solutions', '90', '', '', 498, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-08-11', 97, 0, 0),
(79, 'Switch D Link 8 port DES-1008C', 'Service-Motorrad', '2021-08-10', 'Global Computer Solutions', '105', '', '', 780, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-08-12', 0, 42, 0),
(80, 'Exide CS 7-12 (12V 7AH) UPS Battery. [A.E.O.B]', 'Debi Prasad Satapathy', '2021-08-11', 'Global Computer Solutions', '106', '', '', 700, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-08-12', 0, 43, 0),
(81, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-08-27', 'Global Computer Solutions', '131', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-01', 98, 0, 0),
(82, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-08-27', 'Global Computer Solutions', '132', '', '', 418, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-01', 99, 0, 0),
(83, 'Monitor Power Supply Unit repair.', 'Service-Car', '2021-09-06', 'Global Computer Solutions', '138', '', '', 950, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-07', 0, 0, 11),
(84, 'New Lenovo CPU.', 'Gyana Ranjan Panda', '2021-08-27', 'Kolkata Setup', '92', '', '', 27000, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-09', 0, 44, 0),
(85, 'Catriedge refill/repair.', 'Sales-Car', '2021-09-09', 'Global Computer Solutions', '146', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-14', 100, 0, 0),
(86, 'Parallel Card PCI 2 Serial 1 Parallel (PCI Express)', 'Service-Car', '2021-09-10', 'Global Computer Solutions', '147', '', '', 850, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-21', 0, 45, 0),
(87, 'Installation of OS (windows 7 professional)', 'Technicians-Car', '2021-09-11', 'Global Computer Solutions', '148', '', '', 350, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-21', 0, 0, 12),
(88, 'Teflon & Pressure roller changed.', 'Maheswar Samal', '2021-09-20', 'Global Computer Solutions', '156', '', '', 1250, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-21', 0, 0, 13),
(89, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-09-23', 'Global Computer Solutions', '162', '', '', 380, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-24', 101, 0, 0),
(90, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-09-23', 'Global Computer Solutions', '162', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-24', 102, 0, 0),
(91, 'Catriedge refill/repair.', 'Maheswar Samal', '2021-09-23', 'Global Computer Solutions', '162', '', '', 640, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-24', 103, 0, 0),
(92, 'Catriedge refill/repair.', 'N/A', '2021-09-23', 'Global Computer Solutions', '162', '', '', 80, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-09-24', 104, 0, 0),
(93, 'Catriedge refill/repair.', 'Gyana Ranjan Panda', '2021-10-06', 'Global Computer Solutions', 'N/A', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-10-06', 105, 0, 0),
(94, 'Catriedge refill/repair.', 'Sales-Car', '2021-10-06', 'Global Computer Solutions', 'NA', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-10-06', 106, 0, 0),
(95, 'Catriedge refill/repair.', 'Debi Prasad Satapathy', '2021-10-06', 'Global Computer Solutions', 'N/A', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-10-06', 107, 0, 0),
(96, 'Logitech Mouse', 'Debi Prasad Satapathy', '2021-10-06', 'Global Computer Solutions', '176', '', '', 300, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-10-06', 0, 46, 0),
(97, 'Exide CS 7-12(12V 7AH) battery. [A.E.O.B]', 'Shaikh Mustaque', '2021-10-06', 'Global Computer Solutions', '176', '', '', 720, 'OSL Prestige Pvt. Ltd., Bhanapur, Cuttack, Odisha. Pin- 753011', '2020-12-14', '2021-10-06', 0, 47, 0);

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

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `asset_details`, `serial_no`, `user`, `date_of_purchase`, `vendor`, `bill_no`, `cheque_no`, `bill_clear_date`, `total_cost`) VALUES
(10, 'D-Link RJ-45 connector box.', 'N/A', 'N/A', '2020-12-16', 'Global Computer Solutions', '180', '012081', '2021-01-12', 700),
(11, '18.5\" compaq monitor.', 'CNC0450H43', 'Sales-Motorrad Team', '2020-12-29', 'Gayatri Computers', '1855', '000455', '2020-12-30', 4580),
(12, 'Zebronics UPS.', 'ZEBVU725122017402', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 1650),
(13, 'Frontech keyboard.', 'N/A', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 200),
(14, 'Logitech-M90 mouse.', 'N/A', 'Sales-Motorrad Team', '2021-01-19', 'Global Computer Solutions', '210', '', '', 300),
(15, 'Zebronics UPS.', 'ZEBVU725122017403', 'Sukhwinder Kaur', '2021-01-19', 'Global Computer Solutions', '210', '', '', 1650),
(16, 'Exide UPS battery. (A.E.O.B)', '4XLL249499', 'Pravat Kumar Nayak', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650),
(17, 'Exide UPS battery. (A.E.O.B)', '4XLL249500', 'Shaikh Mustaque', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650),
(18, 'Exide UPS battery. (A.E.O.B)', '4XLL249496', 'Sales-Car', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650),
(19, 'Exide UPS battery. (A.E.O.B)', '4XLL249498', 'Sales-Car', '2021-01-19', 'Global Computer Solutions', '210', '', '', 650),
(20, 'Exide UPS battery. (A.E.O.B)', '4WLL253892', 'Sales-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650),
(21, 'Exide UPS battery. (A.E.O.B)', '4WLL253891', 'Service-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650),
(22, 'Exide UPS battery. (A.E.O.B)', '4WLL253890', 'Service-Car', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650),
(23, 'Zebronics LED monitor.', 'ZEBA19HDLED124307201899', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0),
(24, 'NVIDIA GT Force GT 710 Graphics Card.', '835168021686', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0),
(25, 'DDR-4 RAM 8GB.', '09017007870123', 'Maheswar Samal', '2021-02-22', 'Kolkata Setup', 'N/A', '', '', 0),
(26, 'Zebronics CPU Cabinet with SMPS.', 'N/A', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '012105', '2021-03-06', 1300),
(27, 'Gigabyte mother board.', 'N/A', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '012105', '2021-03-06', 5400),
(28, 'i3-10th Gen processor.', 'N/A', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '012105', '2021-03-06', 7100),
(29, 'CPU Fan.', 'N/A', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '012105', '2021-03-06', 350),
(30, 'Seagate 1TB HDD.', 'N/A', 'Maheswar Samal', '2021-02-23', 'Global Computer Solutions', '263', '012105', '2021-03-06', 3200),
(31, 'Frontech keyboard.', 'N/A', 'Service-Car', '2021-07-29', 'Global Computer Solutions', '88', '', '', 236),
(33, 'Zebronics keyboard.', 'N/A', 'Service-Car', '2021-07-29', 'Global Computer Solutions', '88', '', '', 236),
(41, 'Exide UPS battery. (A.E.O.B)', '4WLL253893', 'Debi Prasad Satapathy', '2021-01-20', 'Global Computer Solutions', '210', '', '', 650),
(42, 'Switch D Link 8 port DES-1008C', 'QS7L309007180', 'Service-Motorrad', '2021-08-10', 'Global Computer Solutions', '105', '', '', 780),
(43, 'Exide CS 7-12 (12V 7AH) UPS Battery. [A.E.O.B]', '4QML322617', 'Debi Prasad Satapathy', '2021-08-11', 'Global Computer Solutions', '106', '', '', 700),
(44, 'New Lenovo CPU.', 'PG02FF5T', 'Gyana Ranjan Panda', '2021-08-27', 'Kolkata Setup', '92', '', '', 27000),
(45, 'Parallel Card PCI 2 Serial 1 Parallel (PCI Express)', 'N/A', 'Service-Car', '2021-09-10', 'Global Computer Solutions', '147', '', '', 850),
(46, 'Logitech Mouse', '2020HS02PK59', 'Debi Prasad Satapathy', '2021-10-06', 'Global Computer Solutions', '176', '', '', 300),
(47, 'Exide CS 7-12(12V 7AH) battery. [A.E.O.B]', '4UML254375', 'Shaikh Mustaque', '2021-10-06', 'Global Computer Solutions', '176', '', '', 720);

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

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `isp`, `circuit_id`, `sr_no`, `main_ip`, `cc_no_charge`, `cc_charge`, `crm`, `crm_phone`, `crm_email`) VALUES
(3, 'Airtel', 13420273, 27906420, '10.7.172.23', '1800102001', '1244609696', 'Sibanath Swain', '9831028968', 'sibanath.swain@airtel.com');

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

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task`, `reg_date`, `user`, `status`, `status_all`) VALUES
(3, 'VR light blue in one side', '2021-04-02', 'Sales-Car', 'Completed', 'valid'),
(4, 'Create a new appointment in OAS button not showing for a particular vehicle. (Mini Cooper)', '2021-04-02', 'Seema Rani Nayak', 'Completed', 'valid'),
(5, 'Printer not working properly.', '2021-04-02', 'Maheswar Samal', 'Completed', 'valid'),
(6, 'ISTA version 4.28.31.228.93 is available for installation.\r\nSystems: ISSS-1, ISSS-2, ISID', '2021-04-02', 'Service-All', 'Completed', 'valid'),
(8, 'Dr.Ananta Kumar Agasti, X1 sDrive 20 d x line delivery presentation.', '2021-04-07', 'Sales-Car', 'Completed', 'valid'),
(9, 'UPS required for ISAP wi-fi.', '2021-04-07', 'Service-All', 'Completed', 'valid'),
(10, 'Key Reader unable to read vehicle data (New Vehicle)', '2021-04-13', 'Debi Prasad Satapathy', 'Completed', 'valid'),
(12, 'Programming data is available for installation. (4.28.41)\r\nSystem: ISSS, ISSS-2, ISID', '2021-04-16', 'Service-All', 'Completed', 'valid'),
(13, 'Catriedge refilling needed.', '2021-04-16', 'Gyana Ranjan Panda', 'Completed', 'valid'),
(15, 'Catriedge refilling needed.', '2021-04-21', 'Debi Prasad Satapathy', 'Completed', 'valid'),
(16, 'VR box no display (blue screen)', '2021-04-20', 'Sales-Car', 'Completed', 'valid'),
(17, 'UPS no backup problem.', '2021-04-20', 'Debi Prasad Satapathy', 'Completed', 'valid'),
(18, 'PC ran into a problem. (H/W not supporting windows 10. Needs to be downgraded to windows 7)', '2021-04-21', 'Service-All', 'Completed', 'valid'),
(20, 'ISTA version 4.29.15.23407 is available for download.\r\nSystems: ISSS-1, ISSS-2, ISID', '2021-04-28', 'Service-All', 'Completed', 'valid'),
(22, 'Printer issue.', '2021-05-03', 'Sales-Car', 'Completed', 'valid'),
(23, 'Date format is in mm/dd/yyyy style. Needs to be change to dd/mm/yyyy in DMS.', '2021-05-03', 'Maheswar Samal', 'Completed', 'valid'),
(25, 'Problem while generating E-Invoice from DMS. (Terminal: 192.168.0.13)', '2021-05-05', 'Maheswar Samal', 'Completed', 'valid'),
(26, 'HDD version 2.10.7774.15644 is available for download.', '2021-05-05', 'Service-All', 'Completed', 'valid'),
(28, 'ISTA 4.29.21 has been released and is available for download and installation.\r\nSystems: ISSS-1, ISSS-2, ISID', '2021-05-18', 'Service-All', 'Completed', 'valid'),
(32, 'ISTA/P version 3.68.1.001 available for installation.\r\nSystems: ISSS-1, ISSS-2', '2021-05-21', 'Technicians-Car', 'Completed', 'valid'),
(34, 'ISTA 4.29.30.23425 has been released and is available for download and installation.\r\nSystems: ISID, ISSS-1 & ISSS-2', '2021-06-03', 'Service-All', 'Completed', 'valid'),
(35, 'ETK not available in DMS terminal server 192.168.0.13', '2021-06-03', 'Maheswar Samal', 'Completed', 'valid'),
(36, 'HDD-Update 2.10.7802.26188 as well as New Grace note content has been released and is available for download and installation.', '2021-06-03', 'Service-All', 'Completed', 'valid'),
(37, 'Shared storage is almost full.', '2021-06-07', 'IT', 'Completed', 'valid'),
(38, 'VR Zone Error', '2021-06-05', 'Sales-Car', 'Completed', 'valid'),
(50, 'System configuration of all users required.', '2021-07-13', 'IT', 'Completed', 'valid'),
(51, 'Copy all data from old laptop to new one.', '2021-07-15', 'Rajesh Mishra', 'Completed', 'valid'),
(52, 'Update ISTA to latest version in ISID.', '2021-07-15', 'Technicians-Motorrad', 'Completed', 'valid'),
(53, 'Display latest pictures in TV,iPad. (Sent By: Antaryami Pati)', '2021-07-16', 'Sales-Car', 'Completed', 'valid'),
(55, 'Catriedge: Black lines comming while printing.', '2021-07-19', 'Gyana Ranjan Panda', 'Completed', 'valid'),
(56, 'IMIB MA version 10.23.4430 is available for download.', '2021-07-19', 'Service-Car', 'Completed', 'valid'),
(57, 'VW catriedge refilling needed.', '2021-07-19', 'N/A', 'Completed', 'valid'),
(59, 'Copy PST file and configure outlook in laptop.', '2021-07-23', 'Shaikh Mustaque', 'Completed', 'valid'),
(60, '12A catriedge refilling needed.', '2021-07-26', 'Ansuman Mallick', 'Completed', 'valid'),
(61, 'Ista luncher version 1.29.24.1119 update in ISSS1, ISSS2 & ISID.', '2021-07-26', 'IT', 'Completed', 'valid'),
(62, 'ISPI Output Manager version 21.1.420.197 is available for download in ISPA HUB.', '2021-07-26', 'IT', 'Completed', 'valid'),
(63, 'Welcome terminal boot failure.', '2021-07-29', 'Service-Car', 'Completed', 'valid'),
(64, 'ISPA Next Client version 21.1.380.354 is available to download.', '2021-07-30', 'Service-Car', 'Completed', 'valid'),
(65, 'ISPA Mobile V2 version 21.1.420.27 is available for download.', '2021-07-30', 'Service-Car', 'Completed', 'valid'),
(66, 'Black spots comming in print out. (12A Catriedge)', '2021-08-02', 'Ansuman Mallick', 'Completed', 'valid'),
(67, 'ISTA version 4.30.30.23898 is available for installation.\r\nSystems: ISTA, ISSS-1, ISSS-2.', '2021-08-03', 'IT', 'Completed', 'valid'),
(68, 'Keyreader Plus Firmware 01.33.0000 has been released and is available for download and installation.', '2021-08-03', 'Debi Prasad Satapathy', 'Completed', 'valid'),
(69, 'Watchdog error in VR Zone.', '2021-08-09', 'IT', 'Completed', 'valid'),
(70, 'White screen problem.', '2021-08-09', 'Maheswar Samal', 'Completed', 'valid'),
(71, 'ISTA4 4.30.43.23915 has been released and is available for download and installation.', '2021-08-13', 'Service-Car', 'Completed', 'valid'),
(72, 'Restart ISPA HUB while leaving office today.', '2021-08-16', 'IT', 'Completed', 'valid'),
(85, 'Update the ISTA version 4.31.16.24249 together with the ICOM Next FW 03-15-07.', '2021-08-20', 'Service-Motorrad', 'Completed', 'valid'),
(86, 'Send Benq projector to service center. (BBSR)', '2021-08-20', 'IT', 'Completed', 'valid'),
(87, 'Backup account cashier pc & install new one.', '2021-09-01', 'Gyana Ranjan Panda', 'Completed', 'valid'),
(88, 'Contact F1 solution for any update regarding BenQ projector.', '2021-09-01', 'IT', 'Completed', 'valid'),
(91, 'ISTA version 4.31.20.24265 available for download.\r\nSystem: ISID', '2021-09-14', 'Service-Motorrad', 'Completed', 'valid'),
(92, 'Printer needs to be repaired.', '2021-09-16', 'Maheswar Samal', 'Completed', 'valid'),
(93, 'ISPI Process Service needs to be updated.', '2021-09-18', 'IT', 'Active', 'valid'),
(94, 'ISPA Client update pending in ISID.', '2021-09-18', 'Service-Motorrad', 'Completed', 'valid'),
(95, '88A Catriedge refilling needed.\r\nUsers: Gyana Ranjan Panda, Debi Prasad Satapathy & Maheshwar Samal.', '2021-09-20', 'IT', 'Completed', 'valid'),
(96, 'Paper stocks while printing.', '2021-09-20', 'Ansuman Mallick', 'Completed', 'valid'),
(97, 'Receive benq projector from F1 solutions.', '2021-09-20', 'IT', 'Completed', 'valid'),
(98, 'Network printer not working from SA system.', '2021-09-21', 'IT', 'Completed', 'valid'),
(99, 'ISTA & HDD update pending in ISID.', '2021-09-28', 'IT', 'Completed', 'valid'),
(100, 'ISTA4 4.31.31.24274 has been released and is available via DMWF.\r\nSystems: ISID, ISSS 1, ISSS 2', '2021-09-29', 'IT', 'Completed', 'valid'),
(101, 'ISTA 4.31.40 has been released and is available for download and installation.\r\nSystems: ISID,ISSS 1, ISSS 2.', '2021-10-07', 'IT', 'Active', 'valid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`) VALUES
(3, 'Shaikh Mustaque'),
(4, 'Debi Prasad Satapathy'),
(5, 'Seema Rani Nayak'),
(6, 'Jagan Samal'),
(7, 'Gyana Ranjan Panda'),
(8, 'Soumya Ranjan Sahoo'),
(12, 'Pravat Kumar Nayak'),
(13, 'Maheswar Samal'),
(14, 'Technicians-Car'),
(17, 'Sushri Sangita Sahoo'),
(18, 'Rajesh Mishra'),
(19, 'Sukhwinder Kaur'),
(21, 'Sanmaya Das'),
(22, 'Biswajit Mohapatra'),
(23, 'Sales-Motorrad Team'),
(24, 'Subrat Kumar Pradhan'),
(25, 'Antaryami Pati'),
(28, 'Manoj Kumar Dhal'),
(30, 'Ansuman Mallick'),
(31, 'Chandan Kumar Nayak'),
(32, 'Ashis Prasad Sahoo'),
(33, 'Subhasis Mishra'),
(34, 'Srikanta Acharya'),
(36, 'Technicians-Motorrad'),
(38, 'N/A');

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
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor`, `address`) VALUES
(1, 'Global Computer Solutions', 'BBSR'),
(2, 'Gayatri Computers', ''),
(3, 'Kolkata Setup', ''),
(4, 'Bit Defender Gravity Zone\r\n', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin_detect`
--
ALTER TABLE `admin_detect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assetdetails`
--
ALTER TABLE `assetdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `assetrepair`
--
ALTER TABLE `assetrepair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assetstock`
--
ALTER TABLE `assetstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `catriedge`
--
ALTER TABLE `catriedge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `catriedge_type`
--
ALTER TABLE `catriedge_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_routine`
--
ALTER TABLE `daily_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_type`
--
ALTER TABLE `system_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
