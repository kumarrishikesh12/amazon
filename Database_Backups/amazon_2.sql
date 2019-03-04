-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2019 at 09:44 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazon`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL COMMENT 'Category ID',
  `cname` varchar(100) NOT NULL COMMENT 'Category Name',
  `cdetails` varchar(255) NOT NULL COMMENT 'Category Details',
  `cicon` varchar(255) NOT NULL COMMENT 'Category Icons',
  `uid` int(11) NOT NULL COMMENT 'User ID ( Who Added )',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created Date',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Modified Date',
  `category_status` varchar(100) NOT NULL DEFAULT 'Active' COMMENT 'Category Status'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cdetails`, `cicon`, `uid`, `created`, `modified`, `category_status`) VALUES
(1, 'Electronics', 'Electronics Items, i.e: Computer, Mobile, Gaming Consoles, Audio & Video Systems. etc', 'electronics_icons.png', 1, '2019-02-18 18:35:54', '2019-02-18 18:35:54', 'Active'),
(2, 'Fashion', 'Men & Women Fashion Items, i.e: Clothing, Watches, footwear etc.', 'fashion_icons.png', 1, '2019-02-19 08:34:23', '2019-02-19 08:34:23', 'Active'),
(3, 'Home & Furniture', 'Home Decoration Items, i.e: Kitchen items, furnitures, tools etc..', 'Home_and_Furniture.png', 2, '2019-02-19 08:43:41', '2019-02-19 08:43:41', 'Active'),
(4, 'Sports, Books and Gaming etc.', 'Sports & Gaming and Books items, i.e: musical instruments,sports items,books, Gaming Controller etc.', 'football.jpeg', 2, '2019-02-19 08:47:43', '2019-02-19 08:47:43', 'Active'),
(5, 'Beauty & Personal Care', 'Beauty & Personal Care items, i.e: Hair care,Bath & Spa, Perfumes, Lipsticks etc.', 'beauty-care.png', 2, '2019-02-19 08:47:43', '2019-02-19 08:47:43', 'Active'),
(6, 'sweets & chocolates', 'sweets & chocolates', 'chocolate-bar.png', 1, '2019-02-26 14:09:53', '2019-02-26 14:09:53', 'Active'),
(7, 'blablabla bla', 'bla bla', 'chocolate-bar.png', 3, '2019-03-01 07:11:10', '2019-03-01 07:11:10', 'Deactivate');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL COMMENT 'Product_ID',
  `pname` varchar(150) NOT NULL COMMENT 'Product_Name',
  `product_category` varchar(255) NOT NULL COMMENT 'Product_Category',
  `product_price` varchar(255) NOT NULL COMMENT 'Product_Price',
  `product_description` varchar(255) NOT NULL COMMENT 'Product_Description',
  `product_image` varchar(255) NOT NULL COMMENT 'Product_Image',
  `other_product_image` mediumtext COMMENT 'Other Product Images',
  `uid` int(11) NOT NULL COMMENT 'User_ID',
  `product_status` varchar(100) NOT NULL DEFAULT 'Active' COMMENT 'Product_Status',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created_Date',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Modified_Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `product_category`, `product_price`, `product_description`, `product_image`, `other_product_image`, `uid`, `product_status`, `created`, `modified`) VALUES
(1, 'iphone-6s', '1', '25000.50', 'Its iphone-6s, Apple Brand Products', 'iPhone6s.png', 'iPhone6s5.png,iPhone6s-21.png', 1, 'Active', '2019-02-20 09:47:50', '2019-02-20 09:47:50'),
(2, 'Beauty Care', '2', '200.80', 'Beauty Care\'s Products', 'beauty-care.png', 'air_conditioner5.png,Android-TV6.png,beauty-care5.png,candy5.png,chocolate-bar5.png', 1, 'Deactivate', '2019-02-20 14:50:58', '2019-02-20 14:50:58'),
(3, 'iphone-4', '1,6', '230', 'its iphone-4, Apple Brand Products', 'iphone_4.png', NULL, 1, 'Active', '2019-02-20 14:51:44', '2019-02-20 14:51:44'),
(4, 'Android tv', '1', '180', 'Smart TV', 'Android-TV.png', NULL, 2, 'Active', '2019-02-20 16:30:44', '2019-02-20 16:30:44'),
(5, 'AC', '1', '185', 'AC', 'air_conditioner.png', NULL, 2, 'Active', '2019-02-20 16:57:34', '2019-02-20 16:57:34'),
(6, 'Harry Potter', '4,6', '25', 'Harry Potter and the Cursed Child', 'harry_potter.jpg', NULL, 1, 'Active', '2019-02-20 19:09:18', '2019-02-20 19:09:18'),
(7, 'Football', '4', '350', 'Nivia Football', 'football.jpeg', NULL, 1, 'Active', '2019-02-20 19:10:52', '2019-02-20 19:10:52'),
(8, 'Ps4', '1,4', '1600', 'Ps4', 'Ps-4.png', 'iPhone6s.png', 2, 'Active', '2019-02-21 09:42:20', '2019-02-21 09:42:20'),
(9, 'Candy', '2,6', '250', 'Sweets Chocos Candy', 'candy.png', NULL, 1, 'Active', '2019-02-26 18:44:22', '2019-02-26 18:44:22'),
(10, 'Laptop', '1', '35000', 'Laptop', 'laptop.png', NULL, 1, 'Active', '2019-02-27 09:45:44', '2019-02-27 09:45:44'),
(11, 'fireplace', '2,3', '30000', 'fireplace', 'fireplace.png', NULL, 1, 'Active', '2019-02-27 09:48:19', '2019-02-27 09:48:19'),
(12, 'Lotion', '2,5', '800', 'Lotion and Beauty Care ', 'lotion.png', NULL, 1, 'Active', '2019-02-27 09:51:03', '2019-02-27 09:51:03'),
(13, 'Product A', '1,2', '2500.20', 'Product A', 'iPhone6s.png', NULL, 1, 'Active', '2019-02-27 17:05:57', '2019-02-27 17:05:57'),
(14, 'Product B', '5', '255', 'Product B', 'beauty-care.png', NULL, 1, 'Active', '2019-02-28 10:44:07', '2019-02-28 10:44:07'),
(15, 'Product C', '1', '250.08', 'Product C', 'Android-TV.png', NULL, 3, 'Active', '2019-03-01 11:42:37', '2019-03-01 11:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `products_details`
--

CREATE TABLE `products_details` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created`, `modified`, `status`) VALUES
(1, 'Rishikesh', 'kumar', 'kumarrishikesh12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(2, 'Max', 'Rocky', 'maxrocky@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(3, 'rishii', 'kesh', 'kumarrishikesh121@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `user_id` (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `userid` (`uid`);

--
-- Indexes for table `products_details`
--
ALTER TABLE `products_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Product_ID', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products_details`
--
ALTER TABLE `products_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `userid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `products_details`
--
ALTER TABLE `products_details`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
