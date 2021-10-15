-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2021 at 11:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_sreps`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `staff_id` char(5) NOT NULL,
  `staff_username` varchar(30) NOT NULL,
  `staff_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`staff_id`, `staff_username`, `staff_password`) VALUES
('1', 'kwc', 'kwc123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` char(5) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_description`) VALUES
('1', 'pills', 'supplements for the sick people'),
('2', 'syringe', 'vaccine');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` char(5) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_price` decimal(4,2) NOT NULL,
  `item_stock` int(3) UNSIGNED NOT NULL,
  `cat_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_description`, `item_price`, `item_stock`, `cat_id`) VALUES
('1', 'Viagra', 'Enlarge d', '40.00', 5, '1'),
('123', 'Viagra', 'covid 19 vaccine', '40.00', 5, '2'),
('20000', 'AZ', 'covid 19 vaccine', '40.00', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` mediumint(5) UNSIGNED NOT NULL,
  `staff_id` char(5) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `staff_id`, `sales_date`, `sales_description`) VALUES
(22, '1', '2021-10-15', 'Testing4');

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `sales_id` mediumint(5) UNSIGNED NOT NULL,
  `item_id` char(5) NOT NULL,
  `quantity` int(3) UNSIGNED NOT NULL,
  `quantity_price` decimal(7,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_item`
--

INSERT INTO `sales_item` (`sales_id`, `item_id`, `quantity`, `quantity_price`) VALUES
(22, '1', 1, '40.00'),
(22, '123', 1, '40.00'),
(22, '20000', 1, '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` char(5) NOT NULL,
  `staff_fname` varchar(30) NOT NULL,
  `staff_lname` varchar(30) NOT NULL,
  `staff_dob` date NOT NULL,
  `staff_address` varchar(255) NOT NULL,
  `staff_phone` varchar(15) NOT NULL,
  `staff_gender` char(1) DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_dob`, `staff_address`, `staff_phone`, `staff_gender`) VALUES
('1', 'k', 'wc', '2021-10-07', 'dsadasdasdsadasd', '123423213213', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_username` (`staff_username`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`sales_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` mediumint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `sales_id` mediumint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD CONSTRAINT `sales_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `sales_item_ibfk_3` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
