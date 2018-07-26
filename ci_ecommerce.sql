-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2018 at 04:38 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 7.2.5-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1' COMMENT '1:active 2:deleted',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores categories related information' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Facewash', '0000-00-00 00:00:00', '2018-07-25 05:57:08', 2),
(2, 'divya12', '0000-00-00 00:00:00', '2018-07-25 05:10:16', 2),
(3, 'Apparels Clothing & Footwear', '0000-00-00 00:00:00', '2018-07-25 06:22:30', 2),
(4, 'Nike Shoes for Women', '0000-00-00 00:00:00', '2018-07-24 07:18:10', 2),
(5, 'Nike Shoes for Women', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'Apparels Clothing & Footwear', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'Nike Shoes for Men', '0000-00-00 00:00:00', '2018-07-24 09:27:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1' COMMENT '1:active 2:deleted',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores order related information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores payment method related information' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_name`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Cash On ', '0000-00-00 00:00:00', '2018-07-25 05:11:07', 2),
(2, 'Cash On Delivery', '0000-00-00 00:00:00', '2018-07-25 05:11:10', 1),
(3, 'Cash On', '0000-00-00 00:00:00', '2018-07-25 05:11:31', 2),
(4, 'Paypal Payment ', '0000-00-00 00:00:00', '2018-07-25 05:20:46', 2),
(5, 'Paypal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(150) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_discount` varchar(100) NOT NULL,
  `prodect_selling_price` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT '0000-00-00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1' COMMENT '1:active 2:deleted',
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_description`, `product_price`, `product_discount`, `prodect_selling_price`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 'Himalaya Neem Tulsi Face Wash', 'Himalaya Neem Tulsi Face Wash - an ayurvedic blend that clears all pores and gives smooth skin', '250', '10', '225', '0000-00-00', '2018-07-25 05:58:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` smallint(6) NOT NULL DEFAULT '2',
  `user_gender` smallint(6) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(50) NOT NULL,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1' COMMENT '1:active 2:deleted',
  PRIMARY KEY (`user_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type_id`, `user_gender`, `user_firstname`, `user_lastname`, `user_mobile`, `user_email`, `user_password`, `created_at`, `updated_at`, `ip_address`, `is_deleted`) VALUES
(1, 1, 1, 'shriya', 'jain', '', 'shriya.jain@example.co.in', '854469e585065641dc27ffe6a361a5c5fd09969a', '0000-00-00 00:00:00', '2018-07-24 08:53:17', '', 1),
(11, 2, 2, 'divya', 'jain', '5622356663', 'divya@example.co.in', '2b717289e448c4f616c987b953b8b84ebf538f87', '0000-00-00 00:00:00', '2018-07-24 09:07:09', '127.0.0.1', 2),
(12, 2, 3, 'avni', 'sharma', '5622356663', 'avni@example.co.in', '4593dc67afcdaf8dfe2699a055f55c8400e946b5', '0000-00-00 00:00:00', '2018-07-24 09:07:33', '127.0.0.1', 1),
(13, 2, 1, 'sid', 'jain', '985632589', 'sid.jain@example.co.in', '4593dc67afcdaf8dfe2699a055f55c8400e946b5', '0000-00-00 00:00:00', '2018-07-24 09:22:38', '127.0.0.1', 1),
(15, 1, 2, 'divya', 'jain', '5622356663', 'divya.jain@example.co.in', 'f6c3cf2ef2f782e6c8fb19a194ab9b4880e49fdf', '0000-00-00 00:00:00', '2018-07-24 10:53:19', '127.0.0.1', 1),
(16, 2, 1, 'sid', 'jain', '5622356663', 'sid.jain1@example.co.in', '866fd51329478576e24620c970434a6fe548aeb6', '0000-00-00 00:00:00', '2018-07-24 11:01:47', '127.0.0.1', 1),
(17, 2, 2, 'divya', 'jain', '5622356663', 'shriya.jain1@example.co.in', 'bb37947fc21aa326865e78262323ff102c83b981', '0000-00-00 00:00:00', '2018-07-25 07:00:53', '127.0.0.1', 1),
(18, 2, 0, 'shriya', 'jain', '985632589', 'shruti@example.co.in', 'bb37947fc21aa326865e78262323ff102c83b981', '0000-00-00 00:00:00', '2018-07-25 07:29:27', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` varchar(8) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '1' COMMENT '1:active 2:deleted',
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores user type related information' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `type`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
