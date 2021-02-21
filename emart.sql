-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 02:27 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emart`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `categoryid`) VALUES
(1, 'test', 72),
(2, 'test2', 72),
(6, 'test', 73),
(9, 'test34', 99),
(10, 'test345', 99),
(13, 'gadget2 brand', 101),
(14, 'gadget2 brand2', 101),
(15, 'gadget1 brand1', 100),
(16, 'gadget1 brand2', 100),
(17, 'gaming console brand 1', 102);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping` float NOT NULL,
  `tax` float NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` date DEFAULT NULL,
  `transactionid` int(11) NOT NULL,
  `storeid` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `return_status` varchar(255) DEFAULT 'For Review',
  `for_pickup` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `productid`, `price`, `quantity`, `shipping`, `tax`, `date_created`, `delivery_date`, `transactionid`, `storeid`, `status`, `reason`, `proof`, `return_status`, `for_pickup`) VALUES
(127, 112, 114, 140, 2, 0, 33.6, '2021-02-03 09:05:26', NULL, 144, 70, 'pending', NULL, NULL, 'For Review', 1),
(128, 112, 115, 130, 1, 50, 13, '2021-02-03 09:10:16', NULL, 145, 70, 'pending', NULL, NULL, 'For Review', 0),
(129, 112, 115, 130, 2, 50, 24, '2021-02-03 09:39:31', NULL, 146, 70, 'pending', NULL, NULL, 'For Review', 0),
(130, 112, 114, 140, 1, 50, 24, '2021-02-03 09:39:31', NULL, 146, 70, 'pending', NULL, NULL, 'For Review', 0),
(131, 112, 114, 140, 2, 50, 12, '2021-02-03 09:55:27', NULL, 149, 70, 'pending', NULL, NULL, 'For Review', 0),
(132, 112, 115, 130, 2, 50, 12, '2021-02-03 09:56:45', NULL, 150, 70, 'pending', NULL, NULL, 'For Review', 0),
(133, 112, 118, 120, 1, 50, 12, '2021-02-04 03:15:10', NULL, 151, 70, 'pending', NULL, NULL, 'For Review', 0),
(134, 112, 117, 120, 1, 50, 12, '2021-02-04 03:15:10', NULL, 151, 70, 'pending', NULL, NULL, 'For Review', 0),
(135, 112, 118, 120, 1, 50, 12, '2021-02-04 03:18:08', NULL, 152, 70, 'pending', NULL, NULL, 'For Review', 0),
(136, 112, 117, 120, 1, 50, 12, '2021-02-04 03:18:08', NULL, 152, 70, 'pending', NULL, NULL, 'For Review', 0),
(137, 112, 118, 120, 1, 50, 12, '2021-02-04 03:18:54', NULL, 153, 70, 'pending', NULL, NULL, 'For Review', 0),
(138, 112, 117, 120, 1, 50, 12, '2021-02-04 03:18:55', NULL, 153, 70, 'pending', NULL, NULL, 'For Review', 0),
(139, 112, 118, 120, 1, 50, 12, '2021-02-04 03:19:21', NULL, 154, 70, 'pending', NULL, NULL, 'For Review', 0),
(140, 112, 117, 120, 1, 50, 12, '2021-02-04 03:19:21', NULL, 154, 70, 'pending', NULL, NULL, 'For Review', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `transactionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `tax_total` float NOT NULL,
  `grand_total` float NOT NULL,
  `shipping_total` float NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `transactionid`, `userid`, `fullname`, `address`, `contact`, `email`, `instruction`, `total`, `tax_total`, `grand_total`, `shipping_total`, `date_created`) VALUES
(118, 144, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 280, 33.6, 313.6, 0, '2021-02-03 09:05:25'),
(119, 145, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 108, 13, 171, 50, '2021-02-03 09:10:16'),
(120, 146, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 340, 41, 481, 100, '2021-02-03 09:39:31'),
(121, 147, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 280, 33.6, 363.6, 50, '2021-02-03 09:53:37'),
(122, 148, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 280, 33.6, 363.6, 50, '2021-02-03 09:55:09'),
(123, 149, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 280, 33.6, 363.6, 50, '2021-02-03 09:55:26'),
(124, 150, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 216, 25.92, 291.92, 50, '2021-02-03 09:56:45'),
(125, 151, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 220, 26, 346, 100, '2021-02-04 03:15:09'),
(126, 152, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 220, 26, 346, 100, '2021-02-04 03:18:08'),
(127, 153, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 220, 26, 346, 100, '2021-02-04 03:18:54'),
(128, 154, 112, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '', 220, 26, 346, 100, '2021-02-04 03:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'parent',
  `deleted` int(11) NOT NULL,
  `isactive` int(11) DEFAULT 1,
  `level` int(11) DEFAULT 1,
  `breadcrumbs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `type`, `deleted`, `isactive`, `level`, `breadcrumbs`) VALUES
(72, 'Electronic Devices', 'parent', 0, 1, 1, 'Electronic Devices'),
(73, 'TV & Home Appliances', 'parent', 0, 1, 1, 'TV & Home Appliances'),
(74, 'Health & Beauty', 'parent', 0, 1, 1, 'Health & Beauty'),
(75, 'Babies & Toys', 'parent', 0, 1, 1, 'Babies & Toys'),
(76, 'Groceries & Pets', 'parent', 0, 1, 1, 'Groceries & Pets'),
(77, 'Home & Living', 'parent', 0, 1, 1, 'Home & Living'),
(79, 'Fashion', 'parent', 0, 1, 1, 'Fashion'),
(80, 'Sports & Lifystyle', 'parent', 0, 1, 1, 'Sports & Lifystyle'),
(81, 'Automotives & Motorcycles', 'parent', 0, 1, 1, 'Automotives & Motorcycles'),
(82, 'Mobiles', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Mobiles</span>\n        	<span id=\"level3\"></span>\n        '),
(83, 'Tablets', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Tablets</span>\n        	<span id=\"level3\"></span>\n        '),
(84, 'Laptops', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Laptops</span>\n        	<span id=\"level3\"></span>\n        '),
(85, 'Desktop', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Desktop</span>\n        	<span id=\"level3\"></span>\n        '),
(86, 'Security Cameras', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Security Cameras</span>\n        	<span id=\"level3\"></span>\n        '),
(87, 'Digital Cameras', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Digital Cameras</span>\n        	<span id=\"level3\"></span>\n        '),
(88, 'Gaming Consoles', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Gaming Consoles</span>\n        	<span id=\"level3\"></span>\n        '),
(89, 'Gadgets', '72', 0, 1, 2, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt; Gadgets</span>\n        	<span id=\"level3\"></span>\n        '),
(90, 'Traditional Laptops', '84', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Laptops</span>\n        	<span id=\"level3\">&gt; Traditional Laptops</span>\n        '),
(91, 'Gaming', '84', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Laptops</span>\n        	<span id=\"level3\">&gt; Gaming</span>\n        '),
(92, '2 in 1s', '84', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Laptops</span>\n        	<span id=\"level3\">&gt; 2 in 1s</span>\n        '),
(93, 'All in One', '85', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Desktop</span>\n        	<span id=\"level3\">&gt; All in One</span>\n        '),
(94, 'Gaming', '85', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Desktop</span>\n        	<span id=\"level3\">&gt; Gaming</span>\n        '),
(95, 'DIY', '85', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Desktop</span>\n        	<span id=\"level3\">&gt; DIY</span>\n        '),
(96, 'Ip Security Cameras', '86', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Security Cameras</span>\n        	<span id=\"level3\">&gt; Ip Security Cameras</span>\n        '),
(97, 'CCTV Security Cameras', '86', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Security Cameras</span>\n        	<span id=\"level3\">&gt; CCTV Security Cameras</span>\n        '),
(100, 'Gadget1', '89', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Gadgets</span>\n        	<span id=\"level3\">&gt; Gadget1</span>\n        '),
(101, 'Gadget2', '89', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Gadgets</span>\n        	<span id=\"level3\">&gt; Gadget2</span>\n        '),
(102, 'gaming console cat', '88', 0, 1, 3, '\n        	<span id=\"level1\">Electronic Devices</span>\n        	<span id=\"level2\">&gt;Gaming Consoles</span>\n        	<span id=\"level3\">&gt; gaming console cat</span>\n        ');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `cartid` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_fee`
--

CREATE TABLE `delivery_fee` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `fee` float NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_fee`
--

INSERT INTO `delivery_fee` (`id`, `storeid`, `municipality`, `fee`, `date_added`) VALUES
(2, 49, 'Mogpog', 56, '2021-01-23 13:29:46'),
(3, 49, 'Boac', 55, '2021-01-23 13:32:23'),
(6, 50, 'Mogpog', 30, '2021-01-24 03:31:06'),
(7, 50, 'Boac', 20, '2021-01-24 09:14:02'),
(8, 58, 'Boac', 20, '2021-01-30 03:48:09'),
(9, 58, 'Gasan', 50, '2021-01-30 03:48:15'),
(10, 66, 'Boac', 20, '2021-02-02 04:30:42'),
(11, 69, 'Boac', 20, '2021-02-03 08:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `shipping` float NOT NULL,
  `tax` float NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipping_details` varchar(255) DEFAULT NULL,
  `shipping_day` int(11) DEFAULT NULL,
  `minimum` float DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `storeid`, `shipping`, `tax`, `productid`, `date_created`, `shipping_details`, `shipping_day`, `minimum`) VALUES
(2, 37, 5, 12, NULL, '2020-12-19 03:02:27', NULL, NULL, 1),
(7, 35, 0, 0, NULL, '2020-12-19 23:37:57', '5 to 7 business days.', NULL, 1),
(8, 44, 0, 0, NULL, '2020-12-26 01:15:52', '<blockquote><ul><li>5 to 7 working days</li></ul></blockquote>', NULL, 1),
(9, 45, 0, 12, NULL, '2020-12-27 22:27:05', '2 to 3 business days.', 4, 1),
(10, 50, 50, 12, NULL, '2021-01-03 05:56:58', '5- 3 working days', 8, 120),
(11, 49, 30, 12, NULL, '2021-01-05 11:53:23', NULL, NULL, 122),
(12, 58, 50, 12, NULL, '2021-01-30 03:20:02', NULL, NULL, 600),
(13, 64, 50, 12, NULL, '2021-01-31 03:04:39', NULL, NULL, 500),
(14, 63, 10, 12, NULL, '2021-01-31 04:21:40', NULL, NULL, 50),
(15, 66, 50, 12, NULL, '2021-02-02 04:30:52', NULL, NULL, 300),
(16, 69, 50, 12, NULL, '2021-02-03 08:09:05', NULL, NULL, 200),
(17, 70, 50, 12, NULL, '2021-02-03 09:04:20', NULL, NULL, 100);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `liked` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `storeid`, `liked`, `dislike`, `userid`, `date_created`) VALUES
(2, 37, 1, 0, 52, '2020-12-22 10:45:22'),
(3, 37, 0, 1, 53, '2020-12-22 10:45:22'),
(4, 44, 1, 0, 64, '2020-12-26 01:56:31'),
(5, 45, 0, 1, 66, '2020-12-27 06:09:22'),
(6, 45, 1, 0, 65, '2020-12-28 22:56:02'),
(7, 49, 1, 0, 36, '2021-01-02 22:15:35'),
(8, 50, 1, 0, 70, '2021-01-03 00:56:54'),
(9, 70, 1, 0, 112, '2021-02-05 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `storeid` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `productid` int(11) NOT NULL,
  `active` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `storeid`, `date_added`, `productid`, `active`) VALUES
(7, 'f9c5b7e914fe719d4f5ff3e1cf1cc9ce.jpg', 30, '2020-12-05 05:39:53', 15, 0),
(8, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 05:39:53', 15, 0),
(9, 'f9c5b7e914fe719d4f5ff3e1cf1cc9ce.jpg', 30, '2020-12-05 05:41:03', 16, 0),
(10, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 05:41:03', 16, 0),
(11, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 05:42:25', 17, 0),
(12, 'a13bc497d96a924a4a1e30f1cd33bd99.png', 30, '2020-12-05 05:42:25', 17, 1),
(13, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 05:49:55', 18, 1),
(14, 'a13bc497d96a924a4a1e30f1cd33bd99.png', 30, '2020-12-05 07:07:34', 19, 1),
(15, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 07:08:42', 20, 1),
(16, 'd323beda795bf2eb257cdb927519fe33.jpg', 30, '2020-12-05 09:01:55', 21, 1),
(17, 'a13bc497d96a924a4a1e30f1cd33bd99.png', 30, '2020-12-05 17:14:15', 22, 1),
(18, '64befa18637bf0cb5338cecd2e1b0d5c.png', 30, '2020-12-08 12:03:09', 23, 0),
(19, '0ff0a3d73e6d6aa1d6deddaa9fdde263.png', 30, '2020-12-08 12:03:10', 23, 0),
(20, 'cf5fd04d6ec622c04bd600dca8dbda5a.jpg', 30, '2020-12-08 12:03:10', 23, 1),
(21, 'b1dd01812b22d34c373e011261ab5fb9.png', 30, '2020-12-08 12:04:14', 24, 0),
(22, 'ad194cbe90a56f2011fab3605ef5af18.png', 30, '2020-12-08 12:04:14', 24, 0),
(23, '886e30a9b6550441af714a7efac86cfd.png', 30, '2020-12-08 12:04:15', 24, 1),
(24, 'b78af42860da3f09f83d28fc5a3b1845.png', 30, '2020-12-08 12:04:51', 25, 0),
(25, '45f16d478734c0f03af662cd5f7b6455.png', 30, '2020-12-08 12:04:52', 25, 0),
(26, '69a092cb9f65318156ea615836f13646.png', 30, '2020-12-08 12:04:52', 25, 1),
(27, '0ff0a3d73e6d6aa1d6deddaa9fdde263.png', 30, '2020-12-08 12:05:50', 26, 0),
(28, 'b1dd01812b22d34c373e011261ab5fb9.png', 30, '2020-12-08 12:05:50', 26, 0),
(29, '64befa18637bf0cb5338cecd2e1b0d5c.png', 30, '2020-12-08 12:05:50', 26, 1),
(30, 'b78af42860da3f09f83d28fc5a3b1845.png', 30, '2020-12-08 12:08:20', 27, 1),
(31, '69a092cb9f65318156ea615836f13646.png', 30, '2020-12-08 12:08:20', 27, 0),
(32, '45f16d478734c0f03af662cd5f7b6455.png', 30, '2020-12-08 12:08:20', 27, 0),
(33, 'b1dd01812b22d34c373e011261ab5fb9.png', 30, '2020-12-08 12:13:52', 28, 1),
(34, '45f16d478734c0f03af662cd5f7b6455.png', 30, '2020-12-08 12:13:52', 28, 0),
(35, 'e260b9bc6e950293d73b0775d3548998.jpg', 30, '2020-12-12 18:03:52', 29, 0),
(36, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 30, '2020-12-12 18:03:52', 29, 1),
(37, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 30, '2020-12-12 18:03:52', 29, 0),
(38, '4718599b5374d058571a331d43e2ab5f.jpg', 30, '2020-12-12 18:03:52', 29, 0),
(39, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-13 06:38:57', 30, 0),
(40, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-13 06:38:58', 30, 1),
(41, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-13 06:38:58', 30, 0),
(42, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-13 06:38:58', 30, 0),
(43, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-13 06:50:35', 31, 0),
(44, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-13 06:50:35', 31, 0),
(45, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-13 06:50:35', 31, 0),
(46, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-13 06:50:36', 31, 1),
(47, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-13 06:50:56', 32, 1),
(48, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-13 06:50:56', 32, 0),
(49, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-13 06:50:56', 32, 0),
(50, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-13 06:50:56', 32, 0),
(51, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-13 06:51:03', 33, 0),
(52, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-13 06:51:03', 33, 1),
(53, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-13 06:51:03', 33, 0),
(54, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-13 06:51:03', 33, 0),
(55, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-13 06:51:17', 34, 0),
(56, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-13 06:51:17', 34, 0),
(57, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-13 06:51:17', 34, 1),
(58, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-13 06:51:18', 34, 0),
(59, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 37, '2020-12-19 03:01:31', 35, 0),
(60, 'e260b9bc6e950293d73b0775d3548998.jpg', 37, '2020-12-19 03:01:31', 35, 0),
(61, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 37, '2020-12-19 03:01:31', 35, 1),
(62, '4718599b5374d058571a331d43e2ab5f.jpg', 37, '2020-12-19 03:01:31', 35, 0),
(63, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 37, '2020-12-19 03:01:31', 35, 0),
(64, 'e260b9bc6e950293d73b0775d3548998.jpg', 37, '2020-12-19 03:02:56', 36, 0),
(65, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 37, '2020-12-19 03:02:56', 36, 0),
(66, '4718599b5374d058571a331d43e2ab5f.jpg', 37, '2020-12-19 03:02:56', 36, 0),
(67, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 37, '2020-12-19 03:02:56', 36, 1),
(68, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-19 12:30:23', 37, 0),
(69, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-19 12:30:23', 37, 0),
(70, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-19 12:30:24', 37, 1),
(71, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 35, '2020-12-19 12:30:55', 38, 0),
(72, 'e260b9bc6e950293d73b0775d3548998.jpg', 35, '2020-12-19 12:30:55', 38, 1),
(73, '4718599b5374d058571a331d43e2ab5f.jpg', 35, '2020-12-19 12:30:56', 38, 0),
(74, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-19 12:30:56', 38, 0),
(75, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 44, '2020-12-26 01:10:16', 39, 0),
(76, '4718599b5374d058571a331d43e2ab5f.jpg', 44, '2020-12-26 01:10:16', 39, 0),
(77, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 44, '2020-12-26 01:10:16', 39, 0),
(78, 'e260b9bc6e950293d73b0775d3548998.jpg', 44, '2020-12-26 01:10:16', 39, 1),
(79, '4718599b5374d058571a331d43e2ab5f.jpg', 45, '2020-12-26 05:38:51', 40, 1),
(80, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 45, '2020-12-26 05:38:51', 40, 0),
(81, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 45, '2020-12-27 00:01:47', 41, 1),
(82, 'd323beda795bf2eb257cdb927519fe33.jpg', 45, '2020-12-28 23:04:23', 42, 0),
(83, 'f9c5b7e914fe719d4f5ff3e1cf1cc9ce.jpg', 45, '2020-12-28 23:04:23', 42, 1),
(84, '89198e184a06ce87c29cbe2721d811df.webp', 45, '2020-12-29 20:34:19', 43, 0),
(85, 'e66ab1f5c18482747a09dcbc7da7a084.webp', 45, '2020-12-29 20:34:19', 43, 1),
(86, '57496bb5cf6c642e861cc509274b11fe.webp', 45, '2020-12-29 20:34:20', 43, 0),
(87, '5ebecc232998e9ad9aa73567f75ac2a3.webp', 45, '2020-12-29 20:36:46', 44, 1),
(88, '627b18b8013527a8bef8cadca6223791.webp', 45, '2020-12-29 20:36:46', 44, 0),
(89, '86ecad0cfb6691263b54b2b233d7e10e.webp', 45, '2020-12-29 20:39:10', 45, 0),
(90, 'd0e4a7a2a23264bbc60fc45f2f07dc14.webp', 45, '2020-12-29 20:39:10', 45, 1),
(91, '5197bd9341aaa8d4cb996387e1ecd98a.webp', 49, '2021-01-02 22:02:02', 46, 1),
(92, 'e5f42d066d9cbf1ab979ee47603e4a9c.webp', 49, '2021-01-02 22:04:59', 47, 1),
(93, 'c5135b4dc9c8bd480e31ae18631206ef.webp', 49, '2021-01-02 22:05:00', 47, 0),
(94, 'd3c6f24a33dfbe7c2389e562f0ddbb4b.webp', 49, '2021-01-02 22:05:00', 47, 0),
(95, 'a8b3ac24afc94e7979225b0f4aee5f0a.webp', 49, '2021-01-02 22:05:00', 47, 0),
(96, '8d2edcd1e9573b8f7b852b9bbb4e35e8.webp', 49, '2021-01-02 22:08:01', 48, 1),
(97, '2d6e94a4b27bbac8615beea9f90aec7b.webp', 49, '2021-01-02 22:08:01', 48, 0),
(98, '817d54c5e62d477de7d81a772d5635fd.webp', 49, '2021-01-02 22:08:01', 48, 0),
(99, 'd3a6ee3328bb1b85068cb98d7752017f.webp', 50, '2021-01-02 23:28:17', 49, 1),
(100, '77795125c8e6732c66a5bdb6bc272af0.webp', 50, '2021-01-02 23:28:17', 49, 0),
(101, '8d2801ca027958992cea2fe7cb9262b5.webp', 50, '2021-01-02 23:28:17', 49, 0),
(102, '644f299d8bcee76ec42d15a22fcfe15a.webp', 50, '2021-01-02 23:31:20', 50, 0),
(103, '36f690d6ac67a8947445f3db0278b256.webp', 50, '2021-01-02 23:31:20', 50, 1),
(104, '3af78334f915ec9e3ffb73204a44de59.webp', 50, '2021-01-02 23:31:21', 50, 0),
(105, '46748fc44903d48a3a3092c0ef89c81f.webp', 50, '2021-01-02 23:44:21', 51, 0),
(106, 'a597b33302b9049a1f5c478998b62074.webp', 50, '2021-01-02 23:44:22', 51, 1),
(107, '52f37ad9ce6382fba255238073cee5bf.webp', 50, '2021-01-02 23:44:22', 51, 0),
(108, '860207a547ed0cd8bd627c69a0260bb2.webp', 50, '2021-01-02 23:44:22', 51, 0),
(109, '46748fc44903d48a3a3092c0ef89c81f.webp', 49, '2021-01-03 05:51:19', 52, 1),
(110, 'a597b33302b9049a1f5c478998b62074.webp', 49, '2021-01-03 05:51:19', 52, 0),
(111, '52f37ad9ce6382fba255238073cee5bf.webp', 49, '2021-01-03 05:51:19', 52, 0),
(112, '431ba5fa4670c279c47011f5e37ba038.jpg', 49, '2021-01-20 23:06:30', 53, 1),
(113, '431ba5fa4670c279c47011f5e37ba038.jpg', 49, '2021-01-20 23:12:18', 54, 1),
(114, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-24 04:27:55', 55, 1),
(115, 'ee1337728027d3a72ffa1443ee740c7c.jpg', 50, '2021-01-26 09:50:21', 56, 1),
(116, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 09:53:19', 57, 1),
(117, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 09:54:13', 58, 1),
(118, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 10:05:00', 59, 1),
(119, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 10:05:38', 60, 1),
(120, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 10:06:07', 61, 1),
(121, 'ee1337728027d3a72ffa1443ee740c7c.jpg', 50, '2021-01-26 15:30:38', 62, 1),
(122, 'ee1337728027d3a72ffa1443ee740c7c.jpg', 50, '2021-01-26 15:35:41', 63, 1),
(123, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 16:09:36', 64, 1),
(124, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 16:47:59', 65, 1),
(125, 'e260b9bc6e950293d73b0775d3548998.jpg', 50, '2021-01-26 20:03:43', 66, 1),
(126, 'e260b9bc6e950293d73b0775d3548998.jpg', 50, '2021-01-26 20:33:19', 67, 1),
(127, 'e260b9bc6e950293d73b0775d3548998.jpg', 50, '2021-01-26 20:36:11', 68, 1),
(128, 'e260b9bc6e950293d73b0775d3548998.jpg', 50, '2021-01-26 20:38:03', 69, 1),
(129, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 50, '2021-01-26 23:03:48', 70, 1),
(130, '1fb91c8792c4fa5d28fa8831973dbe41.jpg', 49, '2021-01-28 12:17:50', 71, 1),
(131, 'd1398cd08dca7e5ecda025cddf356535.png', 50, '2021-01-28 13:28:11', 72, 1),
(132, '05d0e7b29d64e56dc46ac86ef0afb3d7.jpg', 57, '2021-01-30 00:04:00', 73, 1),
(133, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 57, '2021-01-30 00:10:01', 74, 1),
(134, '1fb91c8792c4fa5d28fa8831973dbe41.jpg', 57, '2021-01-30 00:24:18', 75, 1),
(135, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 58, '2021-01-30 03:17:29', 76, 1),
(136, 'd1398cd08dca7e5ecda025cddf356535.png', 57, '2021-01-30 03:22:51', 77, 1),
(137, '1fb91c8792c4fa5d28fa8831973dbe41.jpg', 58, '2021-01-30 03:41:57', 78, 1),
(138, '05d0e7b29d64e56dc46ac86ef0afb3d7.jpg', 63, '2021-01-30 20:46:20', 79, 1),
(139, 'd5fa42ff3d5b6145063a4b91633021af.jpg', 64, '2021-01-31 03:03:08', 80, 1),
(140, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 63, '2021-01-31 04:23:02', 81, 1),
(141, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 64, '2021-01-31 04:50:38', 82, 1),
(142, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 63, '2021-01-31 05:14:14', 83, 1),
(143, 'ae48fdf86e1d2e14eb67ca72fa953b8e.jpg', 64, '2021-01-31 06:01:01', 84, 1),
(144, 'd1398cd08dca7e5ecda025cddf356535.png', 64, '2021-01-31 11:25:57', 85, 1),
(145, '05d0e7b29d64e56dc46ac86ef0afb3d7.jpg', 63, '2021-01-31 12:10:43', 86, 1),
(146, '05d0e7b29d64e56dc46ac86ef0afb3d7.jpg', 63, '2021-01-31 12:57:08', 87, 1),
(147, 'd5fa42ff3d5b6145063a4b91633021af.jpg', 63, '2021-02-01 11:58:11', 88, 1),
(148, 'd5fa42ff3d5b6145063a4b91633021af.jpg', 63, '2021-02-01 12:03:19', 89, 1),
(149, '05d0e7b29d64e56dc46ac86ef0afb3d7.jpg', 63, '2021-02-01 12:20:44', 90, 1),
(150, 'e260b9bc6e950293d73b0775d3548998.jpg', 63, '2021-02-01 21:05:30', 91, 1),
(151, 'e260b9bc6e950293d73b0775d3548998.jpg', 63, '2021-02-01 21:06:39', 92, 1),
(152, 'e260b9bc6e950293d73b0775d3548998.jpg', 63, '2021-02-01 21:07:54', 93, 1),
(153, '590a2d03320e83ebd29fd8ea74b8942a.jpg', 63, '2021-02-01 21:13:44', 94, 0),
(154, '4718599b5374d058571a331d43e2ab5f.jpg', 63, '2021-02-01 21:13:44', 94, 1),
(155, '3935efd44ee8c28711d31e39127aace2.png', 66, '2021-02-02 04:29:24', 95, 1),
(156, '3935efd44ee8c28711d31e39127aace2.png', 66, '2021-02-02 05:05:53', 96, 1),
(157, '3935efd44ee8c28711d31e39127aace2.png', 66, '2021-02-02 05:07:56', 97, 1),
(158, '3935efd44ee8c28711d31e39127aace2.png', 66, '2021-02-02 05:22:26', 98, 1),
(159, '1bb87d41d15fe27b500a4bfcde01bb0e.png', 66, '2021-02-02 18:01:18', 99, 1),
(160, 'f50c73d00fda2bd6d78ce4082e70f008.png', 66, '2021-02-02 18:05:48', 100, 1),
(161, 'f50c73d00fda2bd6d78ce4082e70f008.png', 66, '2021-02-02 18:14:13', 101, 1),
(162, 'f50c73d00fda2bd6d78ce4082e70f008.png', 66, '2021-02-02 18:22:41', 102, 1),
(163, '1bb87d41d15fe27b500a4bfcde01bb0e.png', 66, '2021-02-02 19:28:30', 103, 1),
(164, '1bb87d41d15fe27b500a4bfcde01bb0e.png', 67, '2021-02-02 20:32:17', 104, 1),
(165, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 07:58:54', 105, 1),
(166, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 07:59:44', 106, 1),
(167, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:00:03', 107, 1),
(168, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:02:06', 108, 1),
(169, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:02:36', 109, 1),
(170, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:03:05', 110, 1),
(171, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:04:26', 111, 1),
(172, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:05:42', 112, 1),
(173, '3935efd44ee8c28711d31e39127aace2.png', 69, '2021-02-03 08:08:20', 113, 1),
(174, '3935efd44ee8c28711d31e39127aace2.png', 70, '2021-02-03 09:01:53', 114, 1),
(175, '3935efd44ee8c28711d31e39127aace2.png', 70, '2021-02-03 09:09:09', 115, 1),
(176, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 70, '2021-02-03 12:26:20', 116, 1),
(177, 'edab7ba7e203cd7576d1200465194ea8.jpg', 70, '2021-02-03 13:21:41', 117, 1),
(178, 'f3ccdd27d2000e3f9255a7e3e2c48800.jpg', 70, '2021-02-04 01:44:44', 118, 1),
(179, '156005c5baf40ff51a327f1c34f2975b.jpg', 70, '2021-02-04 01:53:01', 119, 1),
(180, '799bad5a3b514f096e69bbc4a7896cd9.jpg', 70, '2021-02-04 01:53:43', 120, 1),
(181, 'd0096ec6c83575373e3a21d129ff8fef.jpg', 70, '2021-02-04 01:54:10', 121, 1),
(182, '18e2999891374a475d0687ca9f989d83.jpg', 70, '2021-02-04 01:54:36', 122, 1),
(183, 'fe5df232cafa4c4e0f1a0294418e5660.jpg', 70, '2021-02-04 01:55:11', 123, 1),
(184, '31320a35aa87a8bd8b65e793a6b41d02.png', 70, '2021-02-07 13:43:54', 124, 1),
(185, '8aa8557f131b553bd27b4352f9742638.png', 70, '2021-02-07 15:00:27', 125, 1),
(186, '8aa8557f131b553bd27b4352f9742638.png', 70, '2021-02-07 15:05:26', 126, 1),
(187, 'b8bc8bbfc7443a8b945a3a0b74a622f5.jpg', 70, '2021-02-21 13:23:06', 127, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `storeid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'Order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `body`, `seen`, `date_added`, `storeid`, `userid`, `type`) VALUES
(260, 'Subscription Payment: Card', '<p>Jordan Sadiwa paid a monthly subscription.</p>', 1, '2021-02-03 09:00:43', 70, NULL, 'cardSubscription'),
(261, 'New Orders', '<p>You have (6) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-03 12:24:00', 70, NULL, 'Order'),
(262, 'New Orders', '<p>You have (6) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-03 13:20:06', 70, NULL, 'Order'),
(263, 'New Orders', '<p>You have (6) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-04 00:42:56', 70, NULL, 'Order'),
(264, 'New Orders', '<p>You have (6) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-04 01:43:29', 70, NULL, 'Order'),
(265, '\r\n                  <div>Low Stock Alert: <b>1 Product(s)</b> are currently low in stock.<!-- <div class=\"small text-gray-500\">December 2, 2019</div> -->\r\n              	</div>', '<b>The following products are low in stock:</b> <ul><li>Chair(6)</li></ul>', 0, '2021-02-07 13:19:25', 70, NULL, 'Order'),
(266, 'New Orders', '<p>You have (14) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-07 13:19:25', 70, NULL, 'Order'),
(267, '<div>Subscription Alert: Expiration.\r\n			  	</div>', '<p>Your subscription will expire in 10 days (2021-03-03)</p>', 0, '2021-02-21 04:15:13', 70, NULL, 'Order'),
(268, '\r\n                  <div>Low Stock Alert: <b>2 Product(s)</b> are currently low in stock.<!-- <div class=\"small text-gray-500\">December 2, 2019</div> -->\r\n              	</div>', '<b>The following products are low in stock:</b> <ul><li>Chair(6)</li><li>Iphone6(14)</li></ul>', 0, '2021-02-21 04:15:13', 70, NULL, 'Order'),
(269, 'New Orders', '<p>You have (14) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-21 04:15:14', 70, NULL, 'Order'),
(270, '<div>Subscription Alert: Expiration.\r\n			  	</div>', '<p>Your subscription will expire in 10 days (2021-03-03)</p>', 0, '2021-02-21 11:56:38', 70, NULL, 'Order'),
(271, '\r\n                  <div>Low Stock Alert: <b>2 Product(s)</b> are currently low in stock.<!-- <div class=\"small text-gray-500\">December 2, 2019</div> -->\r\n              	</div>', '<b>The following products are low in stock:</b> <ul><li>Chair(6)</li><li>Iphone6(14)</li></ul>', 0, '2021-02-21 11:56:38', 70, NULL, 'Order'),
(272, 'New Orders', '<p>You have (14) new order(s).</p>\r\n				<p>Click <a href=\'neworder.php\'>here</a> to process them.</p>', 0, '2021-02-21 11:56:38', 70, NULL, 'Order');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `captured_at` datetime NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) DEFAULT NULL,
  `payment_for` varchar(255) DEFAULT 'ecommerce',
  `codsub_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `amount`, `currency`, `payment_status`, `captured_at`, `userid`, `payment_for`, `codsub_date`) VALUES
(148, 'ch_1IGhE6JmfnsrzK57yzO4CKlz', 1000.00, 'PHP', 'Captured', '2021-02-03 18:00:43', 111, 'subscription', NULL),
(149, 'ch_1IGhIZJmfnsrzK57jNULi6dZ', 313.60, 'PHP', 'Captured', '2021-02-03 18:05:25', 112, 'ecommerce', NULL),
(150, 'ch_1IGhNHJmfnsrzK57aPLucY2K', 171.00, 'PHP', 'Captured', '2021-02-03 18:10:16', 112, 'ecommerce', NULL),
(151, 'COD', 481.00, 'PHP', 'Pending', '2021-02-03 18:39:30', 112, 'ecommerce', NULL),
(152, 'COD', 363.60, 'PHP', 'Pending', '2021-02-03 18:53:36', 112, 'ecommerce', NULL),
(153, 'COD', 363.60, 'PHP', 'Pending', '2021-02-03 18:55:09', 112, 'ecommerce', NULL),
(154, 'COD', 363.60, 'PHP', 'Pending', '2021-02-03 18:55:26', 112, 'ecommerce', NULL),
(155, 'ch_1IGi6JJmfnsrzK571zGWwk76', 291.92, 'PHP', 'Captured', '2021-02-03 18:56:44', 112, 'ecommerce', NULL),
(156, 'ch_1IGyJBJmfnsrzK57R1fnsU1M', 346.00, 'PHP', 'Captured', '2021-02-04 12:15:09', 112, 'ecommerce', NULL),
(157, 'ch_1IGyM5JmfnsrzK57O5tCjz4G', 346.00, 'PHP', 'Captured', '2021-02-04 12:18:08', 112, 'ecommerce', NULL),
(158, 'ch_1IGyMpJmfnsrzK577DLGp8YF', 346.00, 'PHP', 'Captured', '2021-02-04 12:18:54', 112, 'ecommerce', NULL),
(159, 'ch_1IGyNGJmfnsrzK57gEtSpGCI', 346.00, 'PHP', 'Captured', '2021-02-04 12:19:21', 112, 'ecommerce', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `discountid` int(11) DEFAULT NULL,
  `storeid` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `userid`, `productid`, `qty`, `price`, `date_created`, `discountid`, `storeid`, `tax`, `transaction_id`) VALUES
(13, 66, 45, 1, 90, '2020-12-30 10:18:35', NULL, 45, 12, 56),
(14, 66, 45, 1, 90, '2020-12-30 10:18:35', NULL, 45, 12, 56),
(15, 66, 45, 1, 90, '2020-12-30 10:18:35', NULL, 45, 12, 56),
(16, 66, 45, 1, 90, '2020-12-30 10:21:02', NULL, 45, 12, 57),
(17, 66, 45, 1, 90, '2020-12-30 10:21:02', NULL, 45, 12, 57),
(18, 66, 45, 1, 90, '2020-12-30 10:21:02', NULL, 45, 12, 57),
(19, 66, 45, 1, 90, '2020-12-30 10:21:22', NULL, 45, 12, 58),
(20, 66, 45, 1, 90, '2020-12-30 10:21:22', NULL, 45, 12, 58),
(21, 66, 45, 1, 90, '2020-12-30 10:21:22', NULL, 45, 12, 58),
(22, 66, 45, 1, 90, '2020-12-30 10:22:01', NULL, 45, 12, 59),
(23, 70, 46, 1, 250, '2021-01-02 23:49:56', NULL, 49, 0, 69),
(24, 70, 46, 1, 250, '2021-01-02 23:50:19', NULL, 49, 0, 70),
(25, 70, 46, 1, 250, '2021-01-02 23:51:53', NULL, 49, 0, 71),
(26, 70, 46, 1, 250, '2021-01-02 23:52:47', NULL, 49, 0, 72),
(27, 70, 46, 1, 250, '2021-01-02 23:53:10', NULL, 49, 0, 73),
(28, 70, 46, 1, 250, '2021-01-02 23:57:07', NULL, 49, 0, 78),
(29, 72, 51, 1, 150, '2021-01-03 05:54:05', NULL, 50, 0, 80),
(30, 72, 51, 1, 150, '2021-01-03 05:54:05', NULL, 50, 0, 80),
(31, 72, 51, 1, 150, '2021-01-03 05:54:05', NULL, 50, 0, 80),
(32, 72, 51, 1, 150, '2021-01-03 05:54:05', NULL, 50, 0, 80),
(33, 72, 51, 1, 150, '2021-01-03 05:54:05', NULL, 50, 0, 80);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `batchnumber` varchar(255) NOT NULL,
  `remaining_qty` int(11) NOT NULL DEFAULT 0,
  `deducted` int(11) NOT NULL DEFAULT 0,
  `expiry_date` date NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `dateadded` date DEFAULT current_timestamp(),
  `price` float NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `variant` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `productid`, `batchnumber`, `remaining_qty`, `deducted`, `expiry_date`, `qty`, `dateadded`, `price`, `cost`, `deleted`, `variant`) VALUES
(103, 114, '2102031', 95, 0, '2021-03-05', 100, '2021-02-03', 140, 120, 0, NULL),
(104, 115, '210203104', 99, 0, '2021-03-06', 101, '2021-02-03', 100, 120, 0, 'small'),
(105, 115, '210203104', 103, 0, '2021-03-06', 103, '2021-02-03', 102, 120, 0, 'medium-green'),
(106, 115, '210203104', 105, 0, '2021-03-06', 105, '2021-02-03', 104, 120, 0, 'medium-red'),
(107, 115, '210203104', 107, 0, '2021-03-06', 107, '2021-02-03', 106, 120, 0, 'medium'),
(108, 115, '210203104', 106, 0, '2021-03-06', 109, '2021-02-03', 108, 120, 0, 'small-green'),
(109, 115, '210203104', 201, 0, '2021-03-06', 201, '2021-02-03', 200, 120, 0, 'small-red'),
(110, 115, '210203104', 203, 0, '2021-03-06', 203, '2021-02-03', 202, 120, 0, 'green-medium'),
(111, 115, '210203104', 205, 0, '2021-03-06', 205, '2021-02-03', 204, 120, 0, 'green-small'),
(112, 115, '210203104', 207, 0, '2021-03-06', 207, '2021-02-03', 206, 120, 0, 'red'),
(113, 115, '210203104', 209, 0, '2021-03-06', 209, '2021-02-03', 208, 120, 0, 'red-medium'),
(114, 115, '210203104', 2011, 0, '2021-03-06', 2011, '2021-02-03', 2010, 120, 0, 'red-small'),
(115, 115, '210203104', 2013, 0, '2021-03-06', 2013, '2021-02-03', 2012, 120, 0, 'green'),
(116, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Hot'),
(117, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Spicy-Green'),
(118, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Spicy-Red'),
(119, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 12, 100, 0, 'Spicy-Medium'),
(120, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Spicy-Small'),
(121, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Spicy'),
(122, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Hot-Green'),
(123, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Hot-Red'),
(124, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Hot-Medium'),
(125, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 12, 100, 0, 'Hot-Small'),
(126, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Green-Spicy'),
(127, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Green-Hot'),
(128, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 12, 100, 0, 'Red'),
(129, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 100, 100, 0, 'Green-Medium'),
(130, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Green-Small'),
(131, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Red-Spicy'),
(132, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 121, 100, 0, 'Red-Hot'),
(133, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 120, 100, 0, 'Green'),
(134, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 100, 100, 0, 'Red-Medium'),
(135, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 100, 100, 0, 'Red-Small'),
(136, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Medium-Spicy'),
(137, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Medium-Hot'),
(138, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 121, 100, 0, 'Medium-Green'),
(139, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 120, 100, 0, 'Medium-Red'),
(140, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 100, 100, 0, 'Small'),
(141, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 100, 100, 0, 'Small-Spicy'),
(142, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 12, 100, 0, 'Small-Hot'),
(143, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 1, 100, 0, 'Small-Green'),
(144, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 121, 100, 0, 'Small-Red'),
(145, 116, '210203116', 1, 0, '2021-02-23', 1, '2021-02-03', 120, 100, 0, 'Medium'),
(146, 117, '210203146', 96, 0, '2021-02-24', 100, '2021-02-03', 100, 100, 0, 'Big'),
(147, 117, '210203146', 100, 0, '2021-02-24', 100, '2021-02-03', 120, 100, 0, 'Extra Big'),
(148, 118, '210204148', 96, 0, '2021-02-25', 100, '2021-02-04', 120, 100, 0, NULL),
(149, 119, '210204149', 100, 0, '2021-02-23', 100, '2021-02-04', 150, 100, 0, NULL),
(150, 120, '210204150', 100, 0, '2021-02-23', 100, '2021-02-04', 160, 100, 0, NULL),
(151, 121, '210204151', 100, 0, '2021-02-24', 100, '2021-02-04', 170, 100, 0, NULL),
(152, 122, '210204152', 6, 0, '2021-03-04', 6, '2021-02-04', 800, 100, 0, NULL),
(153, 123, '210204153', 100, 0, '2021-03-05', 100, '2021-02-04', 15000, 12000, 0, NULL),
(154, 124, '210207154', 100, 0, '2021-03-02', 100, '2021-02-07', 150, 120, 0, NULL),
(155, 125, '210207155', 14, 0, '2021-03-05', 14, '2021-02-08', 120, 100, 0, NULL),
(156, 126, '210207155', 100, 0, '2021-03-05', 100, '2021-02-08', 120, 100, 0, 'Green'),
(157, 126, '210207155', 101, 0, '2021-03-05', 101, '2021-02-08', 121, 100, 0, 'Red'),
(158, 126, '210207155', 102, 0, '2021-03-05', 102, '2021-02-08', 122, 100, 0, 'Blue'),
(159, 127, '210221159', 100, 0, '2021-02-24', 100, '2021-02-21', 120, 100, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productt`
--

CREATE TABLE `productt` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `storeid` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `active` int(11) DEFAULT 1,
  `expiration` date DEFAULT NULL,
  `remaining_qty` int(11) DEFAULT 0,
  `deducted` int(11) DEFAULT 0,
  `deleted` int(11) DEFAULT 0,
  `default_variant` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productt`
--

INSERT INTO `productt` (`id`, `categoryid`, `name`, `price`, `brand`, `quantity`, `rating`, `date_added`, `storeid`, `description`, `cost`, `active`, `expiration`, `remaining_qty`, `deducted`, `deleted`, `default_variant`) VALUES
(114, 23, 'Product1', 140, 'asdsadsa', 95, 0, '2021-02-03 09:01:53', 70, 'asdsad', 120, 1, '2021-03-05', 100, 0, 1, ''),
(115, 23, 'Variant Product', 130, 'band', 5569, 0, '2021-02-03 09:09:08', 70, 'asdsad', 120, 1, '2021-03-06', 5574, 0, 1, 'small'),
(116, 23, '3 variant', 120, 'Brand', 30, 0, '2021-02-03 12:26:18', 70, 'asdsad', 100, 1, '2021-02-23', 30, 0, 0, 'Hot'),
(117, 23, '1 variant', 120, 'clot', 196, 0, '2021-02-03 13:21:40', 70, 'asdsad', 100, 1, '2021-02-24', 200, 0, 0, 'Big'),
(118, 23, 'Tshirt', 120, 'Brand', 96, 0, '2021-02-04 01:44:43', 70, 'asdsadas', 100, 1, '2021-02-25', 100, 0, 0, ''),
(119, 23, 'Kuya Wil Jacket', 150, 'jacket', 100, 0, '2021-02-04 01:53:00', 70, 'asdsad', 100, 1, '2021-02-23', 100, 0, 0, ''),
(120, 23, 'Short', 160, 'short', 100, 0, '2021-02-04 01:53:43', 70, 'asdsd', 100, 1, '2021-02-23', 100, 0, 0, ''),
(121, 23, 'Blue Bag', 170, 'bag', 100, 0, '2021-02-04 01:54:10', 70, 'asdsad', 100, 1, '2021-02-24', 100, 0, 0, ''),
(122, 23, 'Chair', 800, 'chair', 6, 0, '2021-02-04 01:54:36', 70, 'adsad', 100, 1, '2021-03-04', 6, 0, 0, ''),
(123, 23, 'Apple Watch', 15000, 'watch', 100, 0, '2021-02-04 01:55:11', 70, 'asdsd', 12000, 1, '2021-03-05', 100, 0, 0, ''),
(124, 96, 'Category Product', 150, 'Bike', 100, 0, '2021-02-07 13:43:53', 70, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor ', 120, 1, '2021-03-02', 100, 0, 0, ''),
(125, 82, 'Iphone6', 120, 'Apple', 14, 0, '2021-02-07 15:00:27', 70, 'asdsad', 100, 1, '2021-03-05', 14, 0, 0, ''),
(126, 82, 'Iphone67', 120, 'Apple', 303, 0, '2021-02-07 15:05:25', 70, 'asdsad', 100, 1, '2021-03-05', 303, 0, 0, 'Green'),
(127, 89, 'test gadget', 120, '15', 100, 0, '2021-02-21 13:23:05', 70, 'asdasd', 100, 1, '2021-02-24', 100, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `storeid`, `productid`, `name`, `date_added`) VALUES
(1, 63, 89, 'asd12', '2021-02-01 12:03:19'),
(2, 63, 89, 'asd122', '2021-02-01 12:03:19'),
(3, 63, 90, 'Best performance of battery', '2021-02-01 12:20:45'),
(4, 63, 90, '5 years warranty for this product', '2021-02-01 12:20:45'),
(5, 63, 90, 'Best performance of battery', '2021-02-01 12:20:45'),
(6, 63, 94, 'Lorem', '2021-02-01 21:13:45'),
(7, 63, 94, 'Ipsum', '2021-02-01 21:13:45'),
(8, 66, 95, 'Description1', '2021-02-02 04:29:24'),
(9, 66, 95, '3', '2021-02-02 04:29:24'),
(10, 66, 95, 'desc', '2021-02-02 04:29:24'),
(11, 66, 96, 'desc 1', '2021-02-02 05:05:53'),
(12, 66, 96, 'desc 2', '2021-02-02 05:05:53'),
(13, 66, 96, 'desc 3', '2021-02-02 05:05:53'),
(14, 66, 97, 'asdas', '2021-02-02 05:07:56'),
(15, 66, 99, 'test1', '2021-02-02 18:01:18'),
(16, 66, 99, 'test2', '2021-02-02 18:01:19'),
(17, 66, 101, 'test', '2021-02-02 18:14:13'),
(18, 66, 101, 'eest3', '2021-02-02 18:14:13'),
(19, 66, 102, 'asd', '2021-02-02 18:22:41'),
(20, 66, 102, 'asdsadas', '2021-02-02 18:22:41'),
(21, 70, 115, 'test', '2021-02-03 09:09:09'),
(22, 70, 115, 'test2', '2021-02-03 09:09:09'),
(23, 70, 118, 'list1', '2021-02-04 01:44:44'),
(24, 70, 118, 'list2', '2021-02-04 01:44:45'),
(25, 70, 125, 'list1', '2021-02-07 15:00:28'),
(26, 70, 125, 'list2', '2021-02-07 15:00:28'),
(27, 70, 126, 'list1', '2021-02-07 15:05:26'),
(28, 70, 126, 'list2', '2021-02-07 15:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `vendorid` int(11) NOT NULL,
  `materialid` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `storeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `vendorid`, `materialid`, `date_purchased`, `type`, `qty`, `date_created`, `storeid`) VALUES
(16, 1, 8, '2020-01-21', 'cash', 1, '2020-11-06 11:12:08', 21);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `productid`, `userid`, `rating`, `date_added`, `comment`) VALUES
(1, 29, 46, 5, '2020-12-12 18:42:12', 'sadas'),
(2, 29, 46, 5, '2020-12-12 18:44:18', 'sadas'),
(3, 29, 46, 5, '2020-12-12 18:44:34', 'sadas'),
(4, 29, 46, 5, '2020-12-12 18:45:07', 'sadas'),
(5, 29, 46, 5, '2020-12-12 18:45:19', 'sadas'),
(6, 29, 46, 4, '2020-12-12 18:50:10', 'asd'),
(7, 29, 46, 3, '2020-12-12 18:50:37', 'sdfds'),
(8, 29, 46, 0, '2020-12-13 02:41:14', 'test'),
(9, 29, 46, 0, '2020-12-13 02:42:25', 'test2'),
(10, 29, 46, 0, '2020-12-13 02:44:04', 'test3'),
(11, 29, 46, 3, '2020-12-13 02:44:39', 'asdasdsa'),
(12, 29, 46, 3, '2020-12-13 02:45:08', 'asdasdsadsa32'),
(13, 29, 46, 3, '2020-12-13 02:45:56', '34534543'),
(14, 29, 46, 3, '2020-12-13 02:46:43', '3'),
(15, 29, 46, 2, '2020-12-13 02:48:41', 'last'),
(16, 29, 46, 2, '2020-12-13 02:50:33', 'FASDA'),
(17, 29, 52, 5, '2020-12-13 06:08:40', 'asdsad'),
(18, 33, 52, 3, '2020-12-16 18:10:56', 'test'),
(19, 36, 56, 3, '2020-12-19 03:14:55', 'sadsadsad'),
(20, 39, 64, 0, '2020-12-26 01:44:00', 'test'),
(21, 39, 64, 4, '2020-12-26 01:53:36', 'test'),
(22, 39, 64, 0, '2020-12-26 01:55:51', 'ASDSAD'),
(23, 42, 66, 5, '2020-12-28 23:05:46', 'Test Comment'),
(24, 42, 66, 2, '2020-12-28 23:40:18', 'sasad'),
(25, 42, 66, 5, '2020-12-28 23:40:56', 'sdfds'),
(26, 42, 66, 0, '2020-12-28 23:42:26', 'sdfsdf'),
(27, 42, 66, 0, '2020-12-28 23:42:54', 'sdfdsf'),
(28, 44, 65, 4, '2021-01-02 02:11:19', 'test'),
(29, 44, 65, 5, '2021-01-02 02:12:36', 'sdfsdfsd'),
(30, 44, 65, 0, '2021-01-02 02:12:50', 'asd'),
(31, 47, 36, 2, '2021-01-02 22:16:57', 'test rev'),
(32, 46, 73, 3, '2021-01-03 05:45:02', 'test'),
(33, 46, 71, 3, '2021-01-21 02:41:15', 'test rating'),
(34, 46, 71, 2, '2021-01-21 02:46:58', 'test'),
(35, 50, 71, 3, '2021-01-24 17:24:48', 'test'),
(36, 50, 71, 0, '2021-01-24 17:26:11', 'test2'),
(37, 50, 71, 0, '2021-01-24 17:26:40', 'test3'),
(38, 50, 71, 0, '2021-01-24 17:28:17', 'test4'),
(39, 50, 71, 0, '2021-01-24 17:38:43', 'test'),
(40, 50, 72, 0, '2021-01-24 18:01:31', 'tesy');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  `other_details` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `storeid`, `productid`, `qty`, `date_purchased`, `other_details`, `date_created`) VALUES
(4, 21, 11, 22, '2020-02-21', '', '2020-11-06 14:34:32'),
(5, 21, 11, 22, '2020-01-21', '', '2020-11-06 14:34:36'),
(6, 21, 12, 224, '2020-01-21', '', '2020-11-06 14:34:41'),
(7, 21, 12, 2, '2020-02-21', '', '2020-11-06 14:34:49'),
(8, 21, 11, 23, '2020-12-01', '', '2020-11-06 16:03:01'),
(9, 21, 11, 534, '2020-11-01', '', '2020-11-06 16:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `terms` text DEFAULT NULL,
  `privacy` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `overview` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `userid`, `terms`, `privacy`, `contact`, `about`, `overview`) VALUES
(1, './uploads/logo/logo.png', 36, '<div class=\"EN\">\r\n                        <div>\r\n                            <h2>TERMS AND CONDITIONS</h2>\r\n                            <p><span>This site is owned and operated by eMart.</span></p>\r\n                            <h3>AGREEMENT</h3>\r\n                            <p><span>eMart contains multiple Web pages operated by eMart. This offer is available for you and is subject to the acceptance of the following terms and conditions. Your use of the eMart site and related offers represents your consent to all such terms contained herein. eMart reserves the right to change the terms in which this offer is being offered. Please check this page for any changes. eMart seeks to ensure that all available information on the website is accurate and true, however there is no guarantee. These terms and conditions apply exclusively, although in contrast to the general or specific conditions or stipulations of the buyer. These conditions will remain in force during the sale and during the relevant activities relating to such sale.</span></p>\r\n                            <h3>BASIC TERMS OF THE AGREEMENT</h3>\r\n                            <p><span>The price of this product is the price set at the time of purchase and may change from time to time if it is used to complete a new purchase. In no event shall the purchase price of today guarantee a price for future purchases not related. The price does not include shipping and applicable operating costs that may be evaluated based on the amount of purchase.</span></p>\r\n                            <p><span>Live email support is available:</span><span> </span><a href=\"mailto:support@emart.com\"><span> </span><span>support@emart.com</span></a></p>\r\n                            <p>Or you may call us toll-free:</p>\r\n                            <div class=\"billing_support\">\r\n                                <div>\r\n                                    <p><strong>CA : </strong><span>1 (888) 254-5183</span></p>\r\n                                    <p><strong>IE : </strong><span>1800 903 218</span></p>\r\n                                    <p><strong>NZ : </strong><span>0800 359 816</span></p>\r\n                                    <p><strong>US : </strong><span>1 (877) 359-4160</span></p>\r\n                                    <p><strong>ZA : </strong><span>080 099 5067</span></p>\r\n                                </div>\r\n                            </div>\r\n                            <h3>CANCELLATIONS / REFUNDS</h3>\r\n                            <p>To cancel your order at any time, please contact our Customer Service Department.</p>\r\n                            <p><span>Live Email Support</span><span>:  </span><a class=\"supp\" href=\"mailto:support@emart.com\">support@emart.com</a></p>\r\n                            <div class=\"billing_support\">\r\n                                <div>\r\n                                    <p><strong>CA : </strong><span>1 (888) 254-5183</span></p>\r\n                                    <p><strong>IE : </strong><span>1800 903 218</span></p>\r\n                                    <p><strong>NZ : </strong><span>0800 359 816</span></p>\r\n                                    <p><strong>US : </strong><span>1 (877) 359-4160</span></p>\r\n                                    <p><strong>ZA : </strong><span>080 099 5067</span></p>\r\n                                </div>\r\n                            </div>\r\n                            <p><span>If the cancellation is made after the order has been shipped, you will be responsible for the payment of the product that has been (1) already been shipped or (2) has already been given to you when you call.</span></p>\r\n                            <p><span>You can receive a refund of any Product that you ordered up to thirty (30) days after the completion of your order. Customers will receive a refund for the product ordered, and repetitive refunds are not allowed, unless at the time of delivery the product is defective. eMart reserves the right to refuse to refund all customers who make repeated requests for refunds or who, in the opinion of eMart, require refunds in bad faith.</span></p>\r\n                            <p><span>In order to process the refund, you must contact our customer service and provide your name and account information. If you provide incorrect information, we will not be able to access your account and we will not complete the return. Refunds can take up to two weeks to appear on your credit card according to the bank that issued the credit card.</span></p>\r\n                            <h3>SHIPPING / RETURNS</h3>\r\n                            <p><span>Standard shipping usually takes 14-21 working days. If you want to return the unused product please do so by sending the address indicated below.</span></p>\r\n                            <p>Please send all returns to:</p>\r\n                            <p><span><strong>eMart</strong>: <br>6525 Gunpark Dr, Ste 370-346<br> Boulder, CO 80301 USA</span></p>\r\n                            <p><span>Customers are responsible for any shipping fees associated with their return, and may be subject to a restocking fee.</span></p>\r\n                            <h3>RELATIONS WITH THIRD PARTIES</h3>\r\n                            <p><span>eMart is not responsible for web-casting or any other form of transmission received from any Linked Site. eMart is providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by eMart the site or any association with its officers or directors.</span></p>\r\n                            <h3>NO UNLAWFUL OR PROHIBITED USE</h3>\r\n                            <p><span>As a condition of your use of eMart, you agree not to use the Site for any purpose that is unlawful or prohibited by these terms and conditions. You may not use eMart to damage, disable or impair the website eMart. You may not obtain or seek to obtain any materials or information through any means not intentionally made available or provided for through our website.</span></p>\r\n                            <h3>USER REGISTRATION AND ELECTRONIC SIGNATURE</h3>\r\n                            <p><span>You must register as a \"member\" of the eMart in order to access certain functions of the site. You must provide current, complete and accurate information about you when you register as a member. You agree that such information is true and complete. You agree to maintain and keep your personal information current and update the information as needed. Without your true information, eMart can not be held responsible for any access or access problem.</span></p>\r\n                            <p><span>Once the registration is completed you consent to these Terms and Conditions, you gave us your approval and electronic signature for this offer, and, therefore, the authorization. Only in this way the charge and the acceptance can be confirmed.</span></p>\r\n                            <h3>DISCLAIMER</h3>\r\n                            <p><span>THE INFORMATION, SOFTWARE, PRODUCTS, AND SERVICES INCLUDED IN OR AVAILABLE THROUGH THE WEB SITE eMart MAY INCLUDE INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION.</span></p>\r\n                            <p><span>eMart MAKES NO REPRESENTATIONS OR WARRANTIES AS TO THE RELIABILITY, FITNESS, TIMELINESS, AND ACCURACY OF THE INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS CONTAINED ON THE SITE. TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL eMart AND / OR ITS SUPPLIERS BE LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL, CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF USE, DATA OR PROFITS, ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE USE OR PERFORMANCE OF THE PRODUCTS OR SERVICES.</span></p>\r\n                            <h3>TERMINATION / ACCESS RESTRICTION</h3>\r\n                            <div>\r\n                                <p><span>eMart reserves the right, in its sole discretion, to terminate your access to the website and the related services or any portion thereof at any time, without notice. You agree that no joint venture, partnership, employment, or agency relationship exists between you and eMart as a result of this agreement or use of the services. This agreement is written in English, which must be considered the official language of the text of this contract, regardless of the language in which these terms may have been translated. If you wish to receive a copy of these terms, please send a request to:</span><span> </span><a href=\"mailto:support@emart.com\"><span> </span><span>support@emart.com</span></a></p>\r\n                            </div>\r\n                            <h3>NOTICES OF INTELLECTUAL PROPERTY, COPYRIGHT AND TRADEMARKS:</h3>\r\n                            <p><span>eMart and all its related logos are trademarks or trade names. You may not copy, imitate or use the above without the prior written consent of eMart. You may not alter, modify or in any way change these HTML logos, or use them in a manner deemed offensive according eMart or use them in any way that implies sponsorship or endorsement of eMart.</span></p>\r\n                            <h3>TRADEMARKS</h3>\r\n                            <p><span>The names of actual companies and products mentioned herein may be the trademarks of their respective owners. The example companies, organizations, products, people and events depicted herein are fictitious. No association with any real company, organization, product, person, or event is intended or should be inferred. All rights not expressly granted herein are reserved.</span></p>\r\n                            <h3>PRIVACY POLICY</h3>\r\n                            <p><span>Please consult the privacy policy of eMart. By accepting these Terms and Conditions, and each time you use the service, you consent to the collection, use and disclosure of information or data recording by eMart, in accordance with the privacy policy without notice or liability to you or any other person.</span></p>\r\n                            <p><span>Customer Service is available 24 hours a day at:</span><span> </span><a href=\"mailto:support@emart.com\"><span> </span><span>support@emart.com</span></a></p>\r\n                            <p class=\"termscopy\"><span>Copyright</span><span> © </span><span>2021</span><span> </span><span>eMart</span><span> </span><span class=\"mobilef\">All Rights Reserved</span><span> </span></p>\r\n                        </div>\r\n                    </div>', 'privacy', '<ul class=\"list-icon\">\r\n							<li> <i class=\"icon fa fa-map-marker\"> </i>542 Fake Street, Cityname 10021 Netheerlends </li>\r\n							<li> <i class=\"icon fa fa-envelope\"> </i> info@example.com</li>\r\n							<li> <i class=\"icon fa fa-phone\"> </i> (800) 060-0730, (800) 060-0730</li>\r\n							<li> <i class=\"icon fa fa-clock\"> </i>Mon-Sat 10:00pm - 7:00pm</li>\r\n						</ul>', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `photo` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL DEFAULT 'slide',
  `storeid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `content`, `status`, `photo`, `date_created`, `type`, `storeid`) VALUES
(37, '', '', 1, './uploads/merchant/70/banner1.jpg', '2021-02-04 00:46:01', 'slider', 70),
(38, '', '', 1, './uploads/merchant/70/banner2.jpg', '2021-02-04 00:46:10', 'slider', 70);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `social` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `userid`, `social`, `link`, `date_added`) VALUES
(12, 36, 'facebook', 'fb.com', '2021-02-04 00:16:43'),
(13, 36, 'twitter', 'twitter.com', '2021-02-04 00:16:50'),
(14, 36, 'instagram', 'insta.com', '2021-02-04 00:17:06'),
(16, 36, 'github', 'github.com', '2021-02-04 00:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `date_creaed` timestamp NULL DEFAULT current_timestamp(),
  `userid` int(11) NOT NULL,
  `subscriptionid` int(255) DEFAULT NULL,
  `last_payment_id` varchar(255) DEFAULT NULL,
  `allow_pickup` int(11) DEFAULT 0,
  `pickup_location` varchar(255) DEFAULT NULL,
  `material_low` int(11) DEFAULT 20,
  `b_address` varchar(255) DEFAULT NULL,
  `b_contact` varchar(255) DEFAULT NULL,
  `b_email` varchar(255) DEFAULT NULL,
  `dti` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `description`, `logo`, `date_creaed`, `userid`, `subscriptionid`, `last_payment_id`, `allow_pickup`, `pickup_location`, `material_low`, `b_address`, `b_contact`, `b_email`, `dti`, `position`) VALUES
(70, 'Jordan Sadiwa', '', NULL, '2021-02-03 08:59:33', 111, 40, 'ch_1IGhE6JmfnsrzK57yzO4CKlz', 1, 'Pili, Boac,Marinduque', 20, '1852 Sandejas Pasay City', '32423432', 'sad@mail.com', '23424', 'Web Developer'),
(71, 'Jordan Sadiwa34534', NULL, NULL, '2021-02-04 03:26:22', 114, 40, NULL, 0, NULL, 20, '1852 Sandejas Pasay City', '234324', 'sad@mail.com', '234324', '32423');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `cost` float NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `duration`, `cost`, `active`, `title`, `caption`, `deleted`) VALUES
(24, 23, 2, 1, '1', '2', 1),
(25, 1, 1, 1, '1', '1', 1),
(26, 1, 1, 1, '1', '1', 1),
(27, 23, 23, 1, 'q', '3', 1),
(28, 234, 242, 1, '4', '2344', 1),
(29, 234, 324, 1, '34', '42', 1),
(30, 3, 600, 1, 'Plan #1', '3 Months', 1),
(31, 1, 800, 1, 'Plan #2', '1 Month', 1),
(32, 6, 500, 1, 'Plan #3', '6 Months', 1),
(33, 12, 450, 0, 'Plan #4', '1 Year', 1),
(34, 7, 550, 0, 'Plan #5', '7 Months', 1),
(35, 3, 100, 1, 'test', '3 months', 0),
(36, 435, 678567, 0, 'dfsa', '45', 0),
(37, 6, 500, 0, 'Plan #2', '6 Months', 0),
(38, 12, 400, 0, 'Plan #3', '1 Year', 0),
(39, 3, 800, 0, 'Plan #1', '3 Months', 0),
(40, 1, 1000, 1, 'Plan #5', '1 Month', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` float NOT NULL,
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `userid`, `date_created`, `total`, `status`) VALUES
(144, 112, '2021-02-03 09:05:25', 280, 'pending'),
(145, 112, '2021-02-03 09:10:16', 108, 'pending'),
(146, 112, '2021-02-03 09:39:30', 340, 'pending'),
(147, 112, '2021-02-03 09:53:37', 280, 'pending'),
(148, 112, '2021-02-03 09:55:09', 280, 'pending'),
(149, 112, '2021-02-03 09:55:26', 280, 'pending'),
(150, 112, '2021-02-03 09:56:44', 216, 'pending'),
(151, 112, '2021-02-04 03:15:09', 220, 'pending'),
(152, 112, '2021-02-04 03:18:08', 220, 'pending'),
(153, 112, '2021-02-04 03:18:54', 220, 'pending'),
(154, 112, '2021-02-04 03:19:21', 220, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'merchant',
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `usertype`, `verified`, `date_created`, `photo`) VALUES
(36, 'admin', 'eed57216df3731106517ccaf5da2122d', 'admin', 0, '2020-10-12 15:56:55', 'uploads/user/20/profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(111, 'store1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 1, '2021-02-03 08:59:33', NULL),
(112, 'client1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2021-02-03 09:03:23', NULL),
(113, 'store2', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2021-02-04 03:25:14', NULL),
(114, 'store3', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2021-02-04 03:26:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `fullname`, `address`, `contact`, `email`, `bday`, `date_created`, `userid`, `photo`) VALUES
(25, 'Jordan Sadiwauser1', '1852 Sandejas Pasay Cityuser1', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2020-12-05 19:12:46', 36, NULL),
(90, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '32432432', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO', '1991-02-21', '2021-02-03 08:59:33', 111, NULL),
(91, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423432', 'sad@mail.com', '1991-02-21', '2021-02-03 09:03:23', 112, NULL),
(92, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '234234324', 'sad@mail.com', '2021-02-16', '2021-02-04 03:25:14', 113, NULL),
(93, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '23423', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO', '2021-03-03', '2021-02-04 03:26:22', 114, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `productid`, `name`, `value`) VALUES
(1, 93, 'Colore', 'Green'),
(2, 93, 'Colore', 'Red'),
(3, 94, 'Delivery', 'Russia, USA, and Europe'),
(4, 94, 'Model#', 'Odsy-1000'),
(5, 94, 'Color', 'Green'),
(6, 94, 'Color', 'Red'),
(7, 95, 'Color', 'Red'),
(8, 95, 'Flavor', 'Chilimansi'),
(9, 95, 'Flavor', 'Spicy'),
(10, 96, 'Unit', 'g'),
(11, 96, 'Color', 'Red'),
(12, 96, 'Color', 'Blue'),
(13, 97, 'Color', 'Green'),
(14, 97, 'Color', 'Red'),
(15, 97, 'Unit', 'g'),
(16, 97, 'Unit', 'kg'),
(17, 98, 'size', 'pc'),
(18, 98, 'size', 'pack'),
(19, 98, 'flavor', 'spicy,chilimansi,original'),
(20, 100, 'Size', 'Medium'),
(21, 100, 'Size', 'Small'),
(22, 100, 'Color', 'Green'),
(23, 100, 'Color', 'Red'),
(24, 101, 'Flavor', 'Spicy'),
(25, 101, 'Size', 'Medium'),
(26, 101, 'Size', 'Small'),
(27, 101, 'Color', 'Green'),
(28, 101, 'Color', 'Red'),
(29, 102, 'Size', 'Medium'),
(30, 102, 'Size', 'Small'),
(31, 102, 'Color', 'Green'),
(32, 102, 'Color', 'Red'),
(33, 103, 'Norma', 'asd'),
(34, 115, 'Flavor', 'spicy'),
(35, 115, 'Size', 'medium'),
(36, 115, 'Size', 'small'),
(37, 115, 'Color', 'green'),
(38, 115, 'Color', 'red'),
(39, 116, 'Flavor', 'Spicy'),
(40, 116, 'Flavor', 'Hot'),
(41, 116, 'Color', 'Green'),
(42, 116, 'Color', 'Red'),
(43, 116, 'Size', 'Medium'),
(44, 116, 'Size', 'Small'),
(45, 117, 'Size', 'Extra Big'),
(46, 117, 'Size', 'Extra Big'),
(47, 117, 'Size', 'Big'),
(48, 126, 'Color', 'Blue'),
(49, 126, 'Color', 'Green'),
(50, 126, 'Color', 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `storeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `address`, `contact`, `date_created`, `storeid`) VALUES
(1, 'Jordan Sadiwa', '1852 Sandejas Pasay City', 2342342, '2020-10-17 11:17:37', 21),
(3, 'test345', '345', 234, '2020-10-17 11:20:20', 21);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userid`, `productid`) VALUES
(11, 112, 118),
(17, 112, 117),
(18, 112, 116),
(19, 112, 120),
(20, 111, 126),
(21, 36, 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_fee`
--
ALTER TABLE `delivery_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productt`
--
ALTER TABLE `productt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `delivery_fee`
--
ALTER TABLE `delivery_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `productt`
--
ALTER TABLE `productt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
