-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 09:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
  `staff_password` varchar(30) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`staff_id`, `staff_username`, `staff_password`, `user_type`) VALUES
('1', 'kwc', 'kwc123', 2),
('2', 'hewitt', 'hewitt123', 2),
('3', 'aidan', 'aidan123', 2),
('4', 'roncen', 'roncen123', 2),
('5', 'ashley', 'ashley123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(5) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'Baby Care', 'Baby items'),
(2, 'General Item', 'General items'),
(3, 'Medicine', 'Pills '),
(4, 'OTC Medicine', 'Over-the-counter medicine');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(5) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_stock` int(3) NOT NULL,
  `item_price` decimal(4,2) NOT NULL,
  `cat_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_description`, `item_stock`, `item_price`, `cat_id`) VALUES
(1, 'Baby Diaper Disposable', 'Baby Diaper-Small Singles', 9, '10.00', 1),
(2, 'Wet Wipes', 'Wet Wipes-10s Pack', 7, '5.00', 2),
(3, 'Antacid', 'Tab digene', 17, '15.00', 3),
(4, 'Glucose', 'Glucose Power 100 grams', 8, '12.00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(5) NOT NULL,
  `staff_id` char(5) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `staff_id`, `sales_date`, `sales_description`) VALUES
(29, '1', '2021-11-05', '5th November 2021 Sales Record'),
(30, '2', '2021-11-06', '6th November 2021 Sales Record'),
(31, '2', '2021-11-07', '7th November 2021 Sales Record'),
(32, '3', '2021-11-08', '8th November 2021 Sales Record'),
(33, '3', '2021-11-09', '9th November 2021 Sales Record'),
(34, '4', '2021-11-10', '10th November 2021 Sales Record'),
(35, '4', '2021-11-11', '11th November 2021 Sales Record'),
(36, '5', '2021-11-20', '20th November 2021 Sales Record'),
(37, '5', '2021-11-22', '22th November 2021 Sales Record'),
(39, '1', '2021-11-05', '5th November 2021 Sales Record'),
(50, '5', '2021-11-06', '6th November 2021 Sales Record'),
(51, '5', '2021-11-12', '12th November 2021 Sales Record');

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `sales_id` int(5) NOT NULL,
  `item_id` int(5) NOT NULL,
  `quantity` int(3) UNSIGNED NOT NULL,
  `quantity_price` double(7,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_item`
--

INSERT INTO `sales_item` (`sales_id`, `item_id`, `quantity`, `quantity_price`) VALUES
(29, 1, 3, 30.00),
(29, 2, 4, 20.00),
(29, 3, 5, 75.00),
(30, 1, 1, 10.00),
(30, 2, 2, 10.00),
(30, 3, 3, 45.00),
(30, 4, 4, 48.00),
(31, 1, 1, 10.00),
(31, 2, 1, 5.00),
(31, 3, 1, 15.00),
(31, 4, 1, 12.00),
(32, 2, 1, 5.00),
(33, 1, 1, 10.00),
(33, 4, 1, 12.00),
(34, 2, 2, 10.00),
(34, 3, 3, 45.00),
(35, 1, 1, 10.00),
(36, 1, 1, 10.00),
(36, 2, 2, 10.00),
(37, 1, 1, 10.00),
(37, 2, 1, 5.00),
(37, 3, 1, 15.00),
(37, 4, 1, 12.00),
(39, 1, 2, 20.00);

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
('1', 'k', 'wc', '2021-10-07', 'PJ', '123456789', 'M'),
('2', 'Hewitt', 'Cheong', '2001-11-01', 'Puchong', '987654321', 'M'),
('3', 'Muhammad', 'Aidan', '1999-11-04', 'Subang', '456123789', 'M'),
('4', 'Roncen', 'Lee', '2003-11-01', 'Kuala Lumpur', '159236478', 'M'),
('5', 'Ashley', 'Chai', '2008-11-01', 'Ipoh', '236159487', 'F');

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  ADD CONSTRAINT `sales_item_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `sales_item_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
