-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 09:49 PM
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
  `return_status` varchar(255) DEFAULT 'For Review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'parent',
  `deleted` int(11) NOT NULL,
  `isactive` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `type`, `deleted`, `isactive`) VALUES
(23, 'Men\'s Clothing', 'parent', 0, 1),
(24, 'Women\'s Clothing', 'parent', 0, 1),
(25, 'Electronics', 'parent', 0, 1),
(26, 'Home Appliances', 'parent', 0, 0),
(27, 'Kids & Babies', 'parent', 0, 0),
(28, 'Health & Beauty', 'parent', 0, 0),
(29, 'Automobiles', 'parent', 0, 0),
(30, 'Sports', 'parent', 0, 1),
(33, 'Baby Care', 'parent', 0, 1),
(34, 'Beauty & Hygiene', 'parent', 0, 1),
(35, 'Food Grain', 'parent', 0, 1),
(36, 'Fruits & Vegetables', 'parent', 0, 1),
(40, 'bago', 'parent', 0, 1);

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
(7, 50, 'Boac', 20, '2021-01-24 09:14:02');

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
(11, 49, 30, 12, NULL, '2021-01-05 11:53:23', NULL, NULL, 122);

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
(8, 50, 1, 0, 70, '2021-01-03 00:56:54');

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
(128, 'e260b9bc6e950293d73b0775d3548998.jpg', 50, '2021-01-26 20:38:03', 69, 1);

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
  `payment_for` varchar(255) DEFAULT 'ecommerce'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `amount`, `currency`, `payment_status`, `captured_at`, `userid`, `payment_for`) VALUES
(63, 'ch_1I5Hx7JmfnsrzK572OVG6CZg', 3000.00, 'PHP', 'Captured', '2021-01-03 06:48:02', 70, 'subscription'),
(64, 'ch_1I5IYZJmfnsrzK57d09qyGCI', 450.00, 'PHP', 'Captured', '2021-01-03 07:26:45', 71, 'ecommerce'),
(65, 'ch_1I5JN6JmfnsrzK57FhKt1Rtl', 4800.00, 'PHP', 'Captured', '2021-01-03 08:18:53', 72, 'subscription'),
(66, 'COD', 390.00, 'PHP', 'Pending', '2021-01-03 08:47:03', 71, 'ecommerce'),
(67, 'ch_1I5PPUJmfnsrzK57o79m4UnY', 250.00, 'PHP', 'Captured', '2021-01-03 14:45:47', 73, 'ecommerce'),
(68, 'ch_1I5PRRJmfnsrzK578VIQZ6DZ', 3000.00, 'PHP', 'Captured', '2021-01-03 14:47:48', 74, 'subscription'),
(69, 'COD', 413.60, 'PHP', 'Pending', '2021-01-05 13:55:44', 71, 'ecommerce'),
(70, 'COD', 194.48, 'PHP', 'Pending', '2021-01-21 11:13:33', 71, 'ecommerce'),
(71, 'COD', 310.00, 'PHP', 'Pending', '2021-01-21 11:32:11', 71, 'ecommerce'),
(72, 'COD', 310.00, 'PHP', 'Pending', '2021-01-21 12:02:14', 71, 'ecommerce'),
(73, 'COD', 250.84, 'PHP', 'Pending', '2021-01-25 04:59:01', 71, 'ecommerce'),
(74, 'COD', 33.44, 'PHP', 'Pending', '2021-01-25 05:00:56', 71, 'ecommerce'),
(75, 'COD', 200.44, 'PHP', 'Pending', '2021-01-25 22:43:50', 71, 'ecommerce'),
(76, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:15:41', 71, 'ecommerce'),
(77, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:30:04', 71, 'ecommerce'),
(78, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:30:20', 71, 'ecommerce'),
(79, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:32:18', 71, 'ecommerce'),
(80, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:34:31', 71, 'ecommerce'),
(81, 'COD', 36.80, 'PHP', 'Pending', '2021-01-27 01:35:29', 71, 'ecommerce'),
(82, 'ch_1IDukyJmfnsrzK578C9wVnaf', 244.00, 'PHP', 'Captured', '2021-01-27 01:51:09', 71, 'ecommerce'),
(83, 'COD', 154.40, 'PHP', 'Pending', '2021-01-27 05:41:46', 71, 'ecommerce');

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
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `deducted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `userid`) VALUES
(1, './uploads/logo/logo.png', 36);

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
(36, '', '234234', 1, './uploads/merchant/49/ingredients.jpg', '2021-01-21 03:58:55', 'slider', 49);

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
  `material_low` int(11) DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `description`, `logo`, `date_creaed`, `userid`, `subscriptionid`, `last_payment_id`, `allow_pickup`, `pickup_location`, `material_low`) VALUES
(49, 'MerryMart', '<p>MerryMart Consumer Corp. (“MM”) is an emerging consumer focused retail company principally engaged in the operation of retail stores in the supermarket and household essentials category. MM through its subsidiary, MerryMart Grocery Centers Inc. (“MMGC”', 'uploads/merchant/49/logo/97e994858d56148a6d6c30b275e77bf7.png', '2021-01-02 21:46:35', 70, 37, 'ch_1I5Hx7JmfnsrzK572OVG6CZg', 1, 'Pili, Boac, Marinduque', 20),
(50, 'Pure Gold', '<p>Puregold Price Club, Inc. (“Puregold” or “the Company”) was incorporated on September 8, 1998 and opened its first Puregold hypermarket store in Mandaluyong City in December of the same year. In 2001, it began its expansion by building 2 additional hyp', 'uploads/merchant/50/logo/de42dd6728605d39be5e5dde12452c0b.jpg', '2021-01-02 23:18:27', 72, 38, 'ch_1I5JN6JmfnsrzK57FhKt1Rtl', 1, 'Tabi', 201),
(51, 'lazada', NULL, NULL, '2021-01-03 05:46:49', 74, 37, 'ch_1I5PRRJmfnsrzK578VIQZ6DZ', 0, NULL, 20);

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
(67, 71, '2021-01-02 22:26:46', 450, 'pending'),
(68, 71, '2021-01-02 23:47:03', 390, 'pending'),
(69, 70, '2021-01-02 23:49:56', 250, 'pos'),
(70, 70, '2021-01-02 23:50:18', 250, 'pos'),
(71, 70, '2021-01-02 23:51:53', 250, 'pos'),
(72, 70, '2021-01-02 23:52:46', 250, 'pos'),
(73, 70, '2021-01-02 23:53:10', 250, 'pos'),
(74, 70, '2021-01-02 23:54:01', 250, 'pos'),
(75, 70, '2021-01-02 23:54:16', 250, 'pos'),
(76, 70, '2021-01-02 23:54:38', 250, 'pos'),
(77, 70, '2021-01-02 23:54:42', 500, 'pos'),
(78, 70, '2021-01-02 23:57:07', 250, 'pos'),
(79, 73, '2021-01-03 05:45:47', 250, 'pending'),
(80, 72, '2021-01-03 05:54:04', 750, 'pos'),
(81, 71, '2021-01-05 04:55:44', 280, 'pending'),
(82, 71, '2021-01-21 02:13:34', 129, 'pending'),
(83, 71, '2021-01-21 02:32:12', 250, 'pending'),
(84, 71, '2021-01-21 03:02:14', 250, 'pending'),
(85, 71, '2021-01-24 19:59:01', 157, 'pending'),
(86, 71, '2021-01-24 20:00:56', 12, 'pending'),
(87, 71, '2021-01-25 13:43:50', 112, 'pending'),
(88, 71, '2021-01-26 16:15:42', 15, 'pending'),
(89, 71, '2021-01-26 16:30:04', 15, 'pending'),
(90, 71, '2021-01-26 16:30:20', 15, 'pending'),
(91, 71, '2021-01-26 16:32:18', 15, 'pending'),
(92, 71, '2021-01-26 16:34:31', 15, 'pending'),
(93, 71, '2021-01-26 16:35:29', 15, 'pending'),
(94, 71, '2021-01-26 16:51:09', 200, 'pending'),
(95, 71, '2021-01-26 20:41:46', 120, 'pending');

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
(70, 'store1', '3dbe00a167653a1aaee01d93e77e730e', 'merchant', 1, '2021-01-02 21:46:35', 'uploads/user/49/profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(71, 'client1', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-02 22:24:19', 'uploads/user//profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(72, 'store2', '3dbe00a167653a1aaee01d93e77e730e', 'merchant', 1, '2021-01-02 23:18:27', 'uploads/user/50/profile/079e667b0c7f01c37a21c1e736b4a6e0.png'),
(73, 'user2', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-03 05:44:11', 'uploads/user//profile/4cc4b036737170bd9eb963d24f549a31.png'),
(74, 'store3', '3dbe00a167653a1aaee01d93e77e730e', 'merchant', 1, '2021-01-03 05:46:49', NULL),
(75, 'test', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-08 04:39:08', NULL),
(76, 'test', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-08 04:39:14', NULL),
(77, 'test', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-08 04:39:43', NULL),
(78, 'test', '3dbe00a167653a1aaee01d93e77e730e', 'client', 0, '2021-01-08 04:43:22', NULL),
(79, 'loki999', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2021-01-08 04:44:42', NULL),
(80, 'lok999', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2021-01-08 04:45:54', NULL);

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
(49, 'Jordan Sadiwauser1', '1852 Sandejas Pasay Cityuser1', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2021-01-02 21:46:35', 70, NULL),
(50, 'Jordan Sadiwauser1test2', 'Pili,Boac,Marinqueu', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2021-01-02 22:24:19', 71, NULL),
(51, 'Jordan Sadiwauser1test', '1852 Sandejas Pasay Cityuser1test', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2021-01-02 23:18:27', 72, NULL),
(52, 'Update Fullname', 'Updated address', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2021-01-03 05:44:11', 73, NULL),
(53, 'Jordan Sadiwauser1', '1852 Sandejas Pasay Cityuser1', '11123', 'JORDAN-E14NWI096B87359TFWN@TEST.INFO1user1', '1111-12-11', '2021-01-03 05:46:49', 74, NULL),
(54, NULL, NULL, NULL, NULL, NULL, '2021-01-08 04:39:09', 75, NULL),
(55, NULL, NULL, NULL, NULL, NULL, '2021-01-08 04:39:15', 76, NULL),
(56, NULL, NULL, NULL, NULL, NULL, '2021-01-08 04:39:43', 77, NULL),
(57, NULL, NULL, NULL, NULL, NULL, '2021-01-08 04:43:23', 78, NULL),
(58, NULL, NULL, NULL, NULL, NULL, '2021-01-08 04:44:42', 79, NULL),
(59, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11', 'sad@mail.com', '0111-11-11', '2021-01-08 04:45:55', 80, NULL);

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `delivery_fee`
--
ALTER TABLE `delivery_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `productt`
--
ALTER TABLE `productt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
