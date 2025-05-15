-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 05:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptops`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(5) NOT NULL,
  `Name` varchar(35) NOT NULL,
  `E_Mail` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Mobile_No` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` int(5) NOT NULL,
  `Prod_ID` int(5) NOT NULL,
  `User_ID` int(5) NOT NULL,
  `Prod_Img` varchar(30) NOT NULL,
  `Prod_Name` varchar(20) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Shipping_Charge` int(3) NOT NULL,
  `Price` int(6) NOT NULL,
  `Net_Price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Contact_ID` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `E_Mail` varchar(50) NOT NULL,
  `Message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `E_Mail` varchar(50) NOT NULL,
  `Rating` int(1) NOT NULL,
  `Message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(5) NOT NULL,
  `User_ID` int(5) NOT NULL,
  `Prod_ID` int(5) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Order_Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(5) NOT NULL,
  `User_ID` int(5) NOT NULL,
  `Prod_ID` int(5) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `E_Mail` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(15) NOT NULL,
  `Pincode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Prod_ID` int(5) NOT NULL,
  `Prod_Name` varchar(20) NOT NULL,
  `Com_Name` varchar(20) NOT NULL,
  `Shipping_Charge` int(3) NOT NULL,
  `Price` int(6) NOT NULL,
  `Net_Price` int(6) NOT NULL,
  `Prod_Img` varchar(30) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Prod_ID`, `Prod_Name`, `Com_Name`, `Shipping_Charge`, `Price`, `Net_Price`, `Prod_Img`, `Description`) VALUES
(1, 'Laptop', 'HP', 500, 80000, 75000, 'img2.jpg', 'i7 12th gen, 8GB RAM,15.5inch display,RGB keyboard'),
(2, 'Laptop', 'HP', 200, 50000, 40000, 'img4.jpg', 'i3 12th gen,8GB RAM,15.5 inch,RGB keyboard'),
(3, 'Laptop', 'DELL', 500, 85000, 80000, 'img8.jpg', 'i7 13th gen,16GB RAM,256GB storage,15.5 inch,4GB G'),
(4, 'Laptop', 'Lanovo', 800, 58999, 55999, 'img10.jpg', 'i5 13th gen process.128GB SSD,15 inch,4GB graphics'),
(5, 'Laptop', 'ASUS', 200, 85000, 82000, 'img3.jpg', 'i5 12th gen processor, flip screen, 16GB RAM, 256G'),
(6, 'Laptop', 'Lanovo', 500, 80000, 78000, 'img7.jpg', 'i5 13th gen, 12GB RAM,256 Storage'),
(7, 'Laptop', 'MAC', 200, 150000, 140000, 'a7.jpg', '512GB Rom, 15inch screen, flip'),
(8, 'Laptop', 'ASUS', 500, 95000, 90000, 'img11.jpg', 'i7 13th gen, 16GB RAM, 512 GB Storage'),
(9, 'Laptop', 'ACER', 1000, 74000, 72000, 'img11.jpg', 'i7 13th gen,16GB storage, 15inch monitor,flip scre'),
(10, 'Laptop', 'MICROSOFT', 200, 55000, 48000, '31.jpg', 'MagicBook X16 (2024), 12th Gen Intel Core i5-12450'),
(11, 'Laptop', 'MICROSOFT', 200, 54000, 48000, '32.JPG', 'Microsoft Surface 7th Edition Qualcomm Snapdragon'),
(12, 'Laptop', 'MSI', 200, 54000, 49000, 'img6.jpg', 'MSI NEW GAMING Intel Core i5 11Th Gen 1115G4'),
(13, 'Laptop', 'SAMSUNG', 200, 54000, 49000, 'img21.jpg', 'NEW SAMSUNG THIN  Intel Core i5 13Th Gen 1115G4'),
(14, 'Laptop', 'FUJITSU', 200, 54000, 52000, '34.jpg', 'FUJITSU FMV MH AMD Ryzen 7 Zen 3 (15.6 inch, 16GB,'),
(15, 'Laptop', 'FUJITSU', 200, 54000, 53500, '33.jpg', 'FUJITSU FMV MH AMD INTEL I7 Zen 3 (15.6 inch, 16GB');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(5) NOT NULL,
  `First_Name` varchar(15) NOT NULL,
  `Last_Name` varchar(15) NOT NULL,
  `E_Maial` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Mobile_No` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `Wishlist_Id` int(5) NOT NULL,
  `User_ID` int(5) DEFAULT NULL,
  `Prod_ID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `Prod_ID` (`Prod_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Contact_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Prod_ID` (`Prod_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Prod_ID` (`Prod_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Prod_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Wishlist_Id`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Prod_ID` (`Prod_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Contact_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Prod_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `Wishlist_Id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
