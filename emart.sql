-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 06:36 AM
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
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `productid`, `price`, `quantity`, `shipping`, `tax`, `date_created`, `delivery_date`, `transactionid`, `storeid`, `status`) VALUES
(51, 66, 45, 90, 1, 0, 12, '2021-01-30 11:31:24', '2021-01-03', 62, 45, 'delivered'),
(52, 66, 45, 90, 1, 0, 12, '2019-01-30 11:37:31', '2021-01-03', 63, 45, 'delivered'),
(53, 66, 45, 90, 1, 0, 12, '2021-11-30 11:38:12', NULL, 64, 45, 'delivered'),
(54, 66, 45, 90, 1, 0, 12, '2021-01-10 11:31:24', '2021-03-03', 62, 45, 'delivered'),
(55, 65, 44, 67, 1, 0, 12, '2021-01-02 02:20:19', NULL, 65, 45, 'cancelled');

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
(47, 62, 66, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '', 90, 10.8, 100.8, 0, '2020-12-30 11:31:24'),
(48, 63, 66, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '', 90, 10.8, 100.8, 0, '2020-12-30 11:37:31'),
(49, 64, 66, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '', 90, 10.8, 100.8, 0, '2020-12-30 11:38:12'),
(50, 65, 65, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '', 67, 8.04, 75.04, 0, '2021-01-02 02:20:18');

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
(26, 'Home Appliances', 'parent', 0, 1),
(27, 'Kids & Babies', 'parent', 0, 1),
(28, 'Health & Beauty', 'parent', 0, 1),
(29, 'Automobiles', 'parent', 0, 1),
(30, 'Sports', 'parent', 0, 1),
(32, 'test', 'parent', 0, 1);

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
  `shipping_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `storeid`, `shipping`, `tax`, `productid`, `date_created`, `shipping_details`, `shipping_day`) VALUES
(2, 37, 5, 12, NULL, '2020-12-19 03:02:27', NULL, NULL),
(7, 35, 0, 0, NULL, '2020-12-19 23:37:57', '5 to 7 business days.', NULL),
(8, 44, 0, 0, NULL, '2020-12-26 01:15:52', '<blockquote><ul><li>5 to 7 working days</li></ul></blockquote>', NULL),
(9, 45, 0, 12, NULL, '2020-12-27 22:27:05', '2 to 3 business days.', 4);

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
(6, 45, 1, 0, 65, '2020-12-28 22:56:02');

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
(90, 'd0e4a7a2a23264bbc60fc45f2f07dc14.webp', 45, '2020-12-29 20:39:10', 45, 1);

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
(55, 'COD', 100.80, 'PHP', 'Pending', '2020-12-30 20:31:23', 66, 'ecommerce'),
(56, 'ch_1I42zbJmfnsrzK57di1BCKRF', 100.80, 'PHP', 'Captured', '2020-12-30 20:37:31', 66, 'ecommerce'),
(57, 'ch_1I430HJmfnsrzK57ySN9cTBM', 100.80, 'PHP', 'Captured', '2020-12-30 20:38:12', 66, 'ecommerce'),
(58, 'COD', 75.04, 'PHP', 'Pending', '2021-01-02 11:20:18', 65, 'ecommerce');

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
(22, 66, 45, 1, 90, '2020-12-30 10:22:01', NULL, 45, 12, 59);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `batchnumber` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_produced` date NOT NULL,
  `storeid` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `productid`, `batchnumber`, `quantity`, `date_produced`, `storeid`, `date_created`) VALUES
(6, 11, '23', 24, '2020-01-01', 21, '2020-11-06 11:14:26'),
(7, 11, '23', 23, '2020-01-22', 21, '2020-11-06 11:25:54'),
(8, 11, '23', 23, '2020-02-21', 21, '2020-11-06 11:27:24'),
(9, 12, '23', 23, '2020-02-21', 21, '2020-11-06 11:27:40'),
(10, 11, '23', 23, '2020-01-21', 21, '2020-11-06 11:27:47'),
(11, 12, '23', 23, '2020-01-21', 21, '2020-11-06 11:28:12'),
(12, 11, '23', 23, '2021-01-21', 21, '2020-11-06 13:09:40'),
(13, 12, '23', 23, '2021-01-21', 21, '2020-11-06 13:09:56'),
(14, 11, '23', 100, '2020-11-11', 21, '2020-11-06 15:15:46'),
(15, 11, '23', 120, '2020-12-11', 21, '2020-11-06 15:23:35'),
(16, 12, '23', 120, '2020-12-11', 21, '2020-11-06 15:23:38'),
(17, 12, '23', 120, '2020-11-11', 21, '2020-11-06 15:23:46'),
(18, 11, '23', 420, '2020-11-11', 21, '2020-11-06 15:23:57');

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
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productt`
--

INSERT INTO `productt` (`id`, `categoryid`, `name`, `price`, `brand`, `quantity`, `rating`, `date_added`, `storeid`, `description`, `cost`, `active`) VALUES
(43, 30, 'Fresho Tomato - Local, Organically Grown, 500 g', 78, 'Vegetables', 0, 0, '2020-12-29 20:34:18', 45, 'asdsad', 45, 1),
(44, 23, 'Fresho Orange - Nagpur, Regular (End Of Season), 1 kg (Approx. 6 - 7 pcs)', 67, 'Storename', 12, 0, '2020-12-29 20:36:45', 45, '<p>Freshly picked directly from Nagpur farms, Fresho Nagpur oranges are sweet and bursting with juice. These are simple to peel and section. Treat your taste buds with this mouth-watering fruit that is sweet and has a distinctive flavour.</p>', 43, 1),
(45, 23, 'Fresho Papaya - Organically Grown, 1 pc', 90, 'Store', 99, 0, '2020-12-29 20:39:10', 45, '\nPapayas are large and pear shaped with green to butter yellow skin colour when ripe. The flesh is pale orange with numerous small, black, sticky seeds at the center. They have a musky taste and buttery consistency. We selectively pick organically grown p', 54, 1);

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
(30, 44, 65, 0, '2021-01-02 02:12:50', 'asd');

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
  `type` varchar(255) NOT NULL DEFAULT 'slide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `content`, `status`, `photo`, `date_created`, `type`) VALUES
(31, '', '', 1, './uploads/merchant//b1.webp', '2020-12-29 20:39:53', 'slider'),
(32, '', '', 1, './uploads/merchant//b2.webp', '2020-12-29 20:40:01', 'slider'),
(33, '', '', 1, './uploads/merchant//b3.webp', '2020-12-29 20:40:10', 'slider');

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
  `last_payment_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `description`, `logo`, `date_creaed`, `userid`, `subscriptionid`, `last_payment_id`) VALUES
(44, 'Store1', NULL, NULL, '2020-12-26 01:05:53', 64, 35, 'ch_1I2RErJmfnsrzK57KpEjnXHm'),
(45, 'Store 2', '', 'uploads/merchant/45/logo/b9fb9d37bdf15a699bc071ce49baea53.jpg', '2020-12-26 05:37:22', 66, 35, 'ch_1I2VTUJmfnsrzK57jFHcVVAn');

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
(36, 435, 678567, 1, 'dfsa', '45', 0);

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
(62, 66, '2020-12-30 11:31:24', 90, 'pending'),
(63, 66, '2020-12-30 11:37:31', 90, 'pending'),
(64, 66, '2020-12-30 11:38:12', 90, 'pending'),
(65, 65, '2021-01-02 02:20:18', 67, 'pending');

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
(64, 'store1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 1, '2020-12-26 01:05:52', 'uploads/user/44/profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(65, 'client1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2020-12-26 03:55:03', 'uploads/user//profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(66, 'store2', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 1, '2020-12-26 05:37:22', NULL);

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
(25, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '1111-11-11', '2020-12-05 19:12:46', 36, NULL),
(43, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '1111-11-11', '2020-12-26 01:05:53', 64, NULL),
(44, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '1111-11-11', '2020-12-26 03:55:03', 65, NULL),
(45, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '11111', 'sad@mail.com', '1111-11-11', '2020-12-26 05:37:22', 66, NULL);

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
-- Indexes for table `fees`
--
ALTER TABLE `fees`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `productt`
--
ALTER TABLE `productt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
