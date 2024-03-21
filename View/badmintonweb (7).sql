-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 06:48 PM
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
(9, 'Kuno', NULL, 1),
(10, 'Hải Yến', NULL, 1),
(11, 'Thành Công', NULL, 1),
(12, 'Xsmash', NULL, 1),
(13, 'Vinastar', NULL, 1);

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
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `brandID`, `catalogID`, `name`, `price`, `discount`, `status`, `description`) VALUES
(1, 1, 1, 'Vợt Cầu Lông Yonex Astrox 100zz', 0, 0, 1, 0),
(2, 1, 1, 'Vợt Cầu Lông Yonex Nanoflare 1000z', 0, 0, 1, 0),
(3, 2, 1, 'Vợt Cầu Lông Li-ning Axforce Cannon', 0, 0, 1, 0),
(4, 2, 1, 'Vợt Cầu Lông Li-ning Halbertec 8000', 0, 0, 1, 0),
(7, 4, 1, 'Vợt Cầu Lông Kumpoo K520 pro', 0, 0, 1, 0),
(8, 4, 1, 'Vợt Cầu Lông Kumpoo PC 99 Pro', 0, 0, 1, 0),
(9, 4, 1, 'Vợt Cầu Lông Kumpoo Kongfu Rabbit', 0, 0, 1, 0),
(10, 1, 2, 'Dây Cước Căng Vợt Yonex BG 65', 0, 0, 1, 0),
(11, 1, 2, 'Dây Cước Căng Vợt Yonex BG 66 Ultimax', 0, 0, 1, 0),
(12, 1, 2, 'Dây Cước Căng Vợt Yonex BG 65 Titanium', 0, 0, 1, 0),
(13, 2, 2, 'Dây Cước Căng Vợt Li-ning NO.1', 0, 0, 1, 0),
(14, 1, 2, 'Dây Cước Căng Vợt Yonex BG 66', 0, 0, 1, 0),
(15, 2, 1, 'Vợt Cầu Lông Li-ning Axforce BigBang', 0, 0, 1, 0),
(16, 2, 1, 'Vợt Cầu Lông Li-ning Axforce 90', 0, 0, 1, 0),
(17, 1, 2, 'Dây Cước Căng Vợt Yonex BG EXBOLT 65', 0, 0, 1, 0),
(18, 1, 2, 'Dây Cước Căng Vợt Yonex BG 80 Power', 0, 0, 1, 0),
(19, 1, 2, 'Dây Cước Vợt Yonex Aerosonic', 0, 0, 1, 0),
(20, 1, 2, 'Dây Cước Căng Vợt Yonex BG Aerobite Boost', 0, 0, 1, 0),
(21, 1, 2, 'Dây Cước Căng Vợt Yonex BG EXBOLT 63', 0, 0, 1, 0),
(22, 1, 2, 'Dây Cước Căng Vợt Yonex BG SKY', 0, 0, 1, 0),
(23, 2, 2, 'Dây Cước Căng Vợt Lining No.5', 0, 0, 1, 0),
(24, 2, 2, 'Dây Cước Căng Vợt Lining N65', 0, 0, 1, 0),
(25, 2, 2, 'Dây Cước Căng Vợt Lining N69', 0, 0, 1, 0),
(26, 2, 2, 'Dây Cước Căng Vợt Cầu Lông Lining N68', 0, 0, 1, 0),
(27, 3, 2, 'Dây Cước Căng Vợt Victor VBS-66N', 0, 0, 1, 0),
(28, 3, 2, 'Dây Cước Căng Vợt Victor Hello Kitty VS-KT63', 0, 0, 1, 0),
(29, 3, 2, 'Dây Cước Căng Vợt Victor VS 780', 0, 0, 1, 0),
(30, 3, 2, 'Dây Cước Căng Vợt Victor VS 68', 0, 0, 1, 0),
(31, 3, 1, 'Vợt Cầu Lông Victor Thruster Ryuga Metallic', 0, 0, 1, 0),
(32, 3, 1, 'Vợt Cầu Lông Victor Ryuga II Pro', 0, 0, 1, 0),
(33, 7, 3, 'Ống Cầu Lông Hải Yến S100', 0, 0, 1, 0),
(34, 13, 3, 'Ống Cầu Lông Vina Star Loại 2', 0, 0, 1, 0),
(35, 13, 3, 'Ống Cầu Lông Vina Star Loại 1', 0, 0, 1, 0),
(36, 10, 3, 'Ống Cầu Lông Hải Yến S100', 0, 0, 1, 0),
(37, 10, 3, 'Ống Cầu Lông Hải Yến S90', 0, 0, 1, 0),
(38, 10, 3, 'Ống Cầu Lông Hải Yến S80', 0, 0, 1, 0),
(39, 10, 3, 'Ống Cầu Lông Hải Yến S70', 0, 0, 1, 0),
(40, 10, 3, 'Ống Cầu Lông Hải Yến Xám Bạc', 0, 0, 1, 0),
(41, 10, 3, 'Ống Cầu Lông Hải Yến Xanh Dương', 0, 0, 1, 0),
(42, 10, 3, 'Ống Cầu Lông Hải Yến Đỏ Bạc', 0, 0, 1, 0),
(43, 10, 3, 'Ống Cầu Lông Hải Yến Xanh Đỏ', 0, 0, 1, 0),
(44, 13, 3, 'Ống Cầu Lông Vina Star Đỏ', 0, 0, 1, 0),
(45, 13, 3, 'Ống Cầu Lông Vina Star Bạc Xanh', 0, 0, 1, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `productID` int(11) NOT NULL,
  `variantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`productID`, `variantID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(10, 6),
(13, 6),
(14, 5),
(14, 6),
(26, 6),
(39, 7),
(39, 8);

-- --------------------------------------------------------

--
-- Table structure for table `variantdetail`
--

CREATE TABLE `variantdetail` (
  `variantID` int(11) NOT NULL,
  `color` text DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `grip` text DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `list_image` varchar(2555) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variantdetail`
--

INSERT INTO `variantdetail` (`variantID`, `color`, `weight`, `grip`, `size`, `speed`, `quantity`, `list_image`, `status`) VALUES
(1, 'Kurenai', '3U', 'G5', 0, 0, 200, '../../images/product/7/7.1.jpg,../../images/product/7/7.1.jpg', 1),
(2, 'Dark Navi', '3U', 'G5', 0, 0, 200, '../../images/product/7/7.1.jpg,../../images/product/7/7.1.jpg', 1),
(3, 'Kurenai', '4U', 'G5', 0, 0, 200, '', 1),
(4, 'Dark Navi', '4U', 'G5', 0, 0, 200, '', 1),
(5, 'Xanh chuối', NULL, NULL, NULL, NULL, 200, '', 1),
(6, 'Trắng', NULL, NULL, NULL, NULL, 200, '', 1),
(7, NULL, NULL, NULL, NULL, 76, 200, '', 1),
(8, NULL, NULL, NULL, NULL, 77, 200, '', 1);

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
  ADD PRIMARY KEY (`roleID`,`functionID`) USING BTREE,
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
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

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
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`productID`,`variantID`) USING BTREE,
  ADD KEY `variantID` (`variantID`);

--
-- Indexes for table `variantdetail`
--
ALTER TABLE `variantdetail`
  ADD PRIMARY KEY (`variantID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
-- AUTO_INCREMENT for table `variantdetail`
--
ALTER TABLE `variantdetail`
  MODIFY `variantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `variant_ibfk_2` FOREIGN KEY (`variantID`) REFERENCES `variantdetail` (`variantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
