-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 09:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE badmintonweb;
USE badmintonweb;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badmintonweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandID` int(10) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `name`, `description`, `status`) VALUES
(1, 'Yonex', NULL, 1),
(2, 'Li-ning', NULL, 1),
(3, 'Victor', NULL, 1),
(4, 'Kumpoo', NULL, 1),
(5, 'Acpas', NULL, 1),
(6, 'Proace', NULL, 1),
(7, 'Mizuno', NULL, 1),
(8, 'Kawasaki', NULL, 1),
(9, 'Kuno', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `timeCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartdetail`
--

CREATE TABLE `cartdetail` (
  `cartDetailID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `catalogID` int(11) NOT NULL,
  `name` text NOT NULL,
  `parentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`catalogID`, `name`, `parentID`) VALUES
(1, 'Racket', NULL),
(2, 'String', NULL),
(3, 'Shuttle', NULL),
(4, 'Shoes', NULL),
(5, 'Bag', NULL),
(6, 'Shirt', NULL),
(7, 'Pants', NULL),
(8, 'Skirt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `functionID` int(11) NOT NULL,
  `functionName` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordertransaction`
--

CREATE TABLE `ordertransaction` (
  `orderID` int(11) NOT NULL,
  `transactionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `roleID` int(11) NOT NULL,
  `functionID` int(11) NOT NULL,
  `permissionName` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `catalogID` int(11) NOT NULL,
  `name` text NOT NULL,
  `urlAvatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `brandID`, `catalogID`, `name`, `urlAvatar`) VALUES
(1, 1, 1, 'Yonex Astrox 100zz Kurenai', ''),
(2, 1, 1, 'Yonex Nanoflare 1000z', ''),
(3, 2, 1, 'Li-ning Axforce Cannon', ''),
(4, 2, 1, 'Li-ning Halbertec 8000', ''),
(7, 4, 1, 'Kumpoo K520 pro', ''),
(8, 4, 1, 'Kumpoo PC 99 Pro', ''),
(9, 4, 1, 'Kumpoo Kongfu Rabbit', ''),
(10, 1, 2, 'Yonex BG 65', ''),
(11, 1, 2, 'Yonex BG 66 Ultimax', ''),
(12, 1, 2, 'Yonex BG 65 Titanium', ''),
(13, 2, 2, 'Li-ning NO.1', ''),
(14, 1, 2, 'BG 66', ''),
(15, 2, 1, 'Li-ning Axforce BigBang', ''),
(16, 2, 1, 'Li-ning Axforce 90', '');

-- --------------------------------------------------------

--
-- Table structure for table `racket`
--

CREATE TABLE `racket` (
  `productID` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `flex` text NOT NULL,
  `tension_max` int(11) NOT NULL,
  `grip` varchar(255) NOT NULL,
  `frame_build` text NOT NULL,
  `shaft_build` text NOT NULL,
  `weight` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `quantity` int(11) NOT NULL,
  `swing_weight` double NOT NULL,
  `balance_point` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `list_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racket`
--

INSERT INTO `racket` (`productID`, `color`, `price`, `discount`, `flex`, `tension_max`, `grip`, `frame_build`, `shaft_build`, `weight`, `status`, `quantity`, `swing_weight`, `balance_point`, `note`, `list_image`) VALUES
(7, 'Trắng', 700000, 650000, '8.5', 28, 'G5', 'Carbon Fiber ', 'Carbon Fiber ', 82, 1, 200, 85.6, 290, '', ''),
(7, 'Đen', 700000, 650000, '8.5', 28, 'G5', 'Carbon Fiber', 'Carbon Fiber', 82, 1, 200, 85.6, 290, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `roleName` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shuttle`
--

CREATE TABLE `shuttle` (
  `productID` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `list_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `string`
--

CREATE TABLE `string` (
  `productID` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `quantity` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `list_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `string`
--

INSERT INTO `string` (`productID`, `color`, `price`, `discount`, `status`, `quantity`, `country`, `note`, `list_image`) VALUES
(10, 'Trắng', 120000, 120000, 1, 200, 'Global', '', ''),
(10, 'Xanh chuối', 120000, 120000, 1, 200, 'Global', '', ''),
(12, 'Xanh chuối', 140000, 140000, 1, 200, 'Global', '', ''),
(12, 'Xanh chuối', 150000, 150000, 1, 200, 'JP', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `note` text NOT NULL,
  `time` datetime NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL DEFAULT '1',
  `timeCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `roleID` int(11) NOT NULL,
  `name` text NOT NULL,
  `mail` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `point` int(11) NOT NULL,
  `type` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  INSERT INTO `user` (`userID`, `username`, `password`, `timeCreated`, `roleID`, `name`, `mail`, `phoneNumber`, `point`, `type`, `status`)
  VALUES 
  (1, 'user1', 'password1', CURRENT_TIMESTAMP(), 1, 'User One', 'user1@example.com', '123456789', 0, 'regular', 'active'),
  (2, 'user2', 'password2', CURRENT_TIMESTAMP(), 1, 'User Two', 'user2@example.com', '987654321', 0, 'regular', 'active'),
  (3, 'user3', 'password3', CURRENT_TIMESTAMP(), 1, 'User Three', 'user3@example.com', '555555555', 0, 'regular', 'active'),
  (4, 'user4', 'password4', CURRENT_TIMESTAMP(), 1, 'User Four', 'user4@example.com', '111111111', 0, 'regular', 'active'),
  (5, 'user5', 'password5', CURRENT_TIMESTAMP(), 1, 'User Five', 'user5@example.com', '222222222', 0, 'regular', 'active'),
  (6, 'user6', 'password6', CURRENT_TIMESTAMP(), 1, 'User Six', 'user6@example.com', '333333333', 0, 'regular', 'active'),
  (7, 'user7', 'password7', CURRENT_TIMESTAMP(), 1, 'User Seven', 'user7@example.com', '444444444', 0, 'regular', 'active'),
  (8, 'user8', 'password8', CURRENT_TIMESTAMP(), 1, 'User Eight', 'user8@example.com', '666666666', 0, 'regular', 'active'),
  (9, 'user9', 'password9', CURRENT_TIMESTAMP(), 1, 'User Nine', 'user9@example.com', '777777777', 0, 'regular', 'active'),
  (10, 'user10', 'password10', CURRENT_TIMESTAMP(), 1, 'User Ten', 'user10@example.com', '888888888', 0, 'regular', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`),
  ADD KEY `brandID` (`brandID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `cartID` (`cartID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `cartdetail`
--
ALTER TABLE `cartdetail`
  ADD PRIMARY KEY (`cartDetailID`),
  ADD KEY `cartDetailID` (`cartDetailID`),
  ADD KEY `cartID` (`cartID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`catalogID`),
  ADD KEY `catalogID` (`catalogID`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`functionID`);

--
-- Indexes for table `ordertransaction`
--
ALTER TABLE `ordertransaction`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `transactionID` (`transactionID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID_2` (`orderID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD KEY `roleID` (`roleID`),
  ADD KEY `functionID` (`functionID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `brandID` (`brandID`),
  ADD KEY `catalogID` (`catalogID`);

--
-- Indexes for table `racket`
--
ALTER TABLE `racket`
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `shuttle`
--
ALTER TABLE `shuttle`
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `string`
--
ALTER TABLE `string`
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `transactionID` (`transactionID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartdetail`
--
ALTER TABLE `cartdetail`
  MODIFY `cartDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `catalogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `functionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertransaction`
--
ALTER TABLE `ordertransaction`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartdetail`
--
ALTER TABLE `cartdetail`
  ADD CONSTRAINT `cartdetail_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `cart` (`cartID`),
  ADD CONSTRAINT `cartdetail_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `ordertransaction`
--
ALTER TABLE `ordertransaction`
  ADD CONSTRAINT `ordertransaction_ibfk_1` FOREIGN KEY (`transactionID`) REFERENCES `transaction` (`transactionID`),
  ADD CONSTRAINT `ordertransaction_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`),
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`functionID`) REFERENCES `function` (`functionID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brandID`) REFERENCES `brand` (`brandID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`catalogID`) REFERENCES `catalog` (`catalogID`);

--
-- Constraints for table `racket`
--
ALTER TABLE `racket`
  ADD CONSTRAINT `racket_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `shuttle`
--
ALTER TABLE `shuttle`
  ADD CONSTRAINT `shuttle_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `string`
--
ALTER TABLE `string`
  ADD CONSTRAINT `string_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `cart` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
