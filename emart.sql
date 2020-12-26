-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 01:38 AM
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
  `transactionid` int(11) NOT NULL
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
(26, 'Home Appliances', 'parent', 0, 1),
(27, 'Kids & Babies', 'parent', 0, 1),
(28, 'Health & Beauty', 'parent', 0, 1),
(29, 'Automobiles', 'parent', 0, 1),
(30, 'Sports', 'parent', 0, 1),
(32, 'test', 'parent', 0, 1);

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
  `shipping_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `storeid`, `shipping`, `tax`, `productid`, `date_created`, `shipping_details`) VALUES
(2, 37, 5, 12, NULL, '2020-12-19 03:02:27', NULL),
(7, 35, 0, 0, NULL, '2020-12-19 23:37:57', '5 to 7 business days.');

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
(3, 37, 0, 1, 53, '2020-12-22 10:45:22');

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
(74, 'ccb25368f6e0c5f6f3930ff9f9bd6bb7.jpg', 35, '2020-12-19 12:30:56', 38, 0);

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
(31, 23, 'Black Polo', 78, 'Polo', 544, 0, '2020-12-13 06:50:35', 35, 'sadsadsa', 34, 1),
(32, 23, 'Red Polo', 78, 'Polo', 544, 0, '2020-12-13 06:50:55', 35, 'sadsadsa', 34, 1),
(33, 23, 'Blue Polo', 78, 'Polo', 544, 0, '2020-12-13 06:51:03', 35, 'sadsadsa', 34, 1),
(34, 23, 'Gray Sweater', 78, 'Polo', 544, 0, '2020-12-13 06:51:17', 35, 'sadsadsa', 34, 1),
(36, 23, 'test product', 786, 'brand', 34345, 0, '2020-12-19 03:02:55', 37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor ', 45, 1),
(37, 23, 'tst', 345, '46', 4, 0, '2020-12-19 12:30:22', 35, '54645', 453, 1),
(38, 23, '45645', 456, '45', 46, 0, '2020-12-19 12:30:55', 35, '456', 65464, 1);

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
(19, 36, 56, 3, '2020-12-19 03:14:55', 'sadsadsad');

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
(27, 'Banner 1', 'laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen', 1, './uploads/merchant/20/banner1.jpg', '2020-12-10 15:11:13', 'slider'),
(30, '', 'slide2', 1, './uploads/merchant/20/banner3.webp', '2020-12-19 03:11:07', 'slider');

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
(20, 'jorjor', NULL, NULL, '2020-10-12 15:57:01', 36, 30, NULL),
(21, 'cyborg999', NULL, NULL, '2020-10-17 04:48:07', 37, 32, 'ch_1HuBTwJmfnsrzK573SpNZBoV'),
(22, 'User2 Store', NULL, NULL, '2020-11-29 14:50:17', 38, 32, NULL),
(23, 'Jordan Store', NULL, NULL, '2020-12-04 10:33:04', 39, NULL, NULL),
(24, 'Jordan Store', NULL, NULL, '2020-12-04 10:33:07', 40, NULL, NULL),
(25, 'user4', NULL, NULL, '2020-12-04 10:37:00', 41, NULL, NULL),
(26, 'user44', NULL, NULL, '2020-12-04 10:38:20', 42, NULL, NULL),
(27, 'user44', NULL, NULL, '2020-12-04 11:28:42', 43, NULL, NULL),
(28, 'user44', NULL, NULL, '2020-12-04 11:29:25', 44, NULL, NULL),
(29, 'user45', NULL, NULL, '2020-12-04 11:31:04', 45, NULL, NULL),
(30, 'Jojor', NULL, NULL, '2020-12-04 12:48:18', 46, NULL, NULL),
(31, 'User5 Store', NULL, NULL, '2020-12-04 12:52:22', 47, NULL, NULL),
(32, 'eMart', NULL, NULL, '2020-12-13 02:55:20', 48, NULL, NULL),
(33, 'user6store', NULL, NULL, '2020-12-13 02:56:51', 49, NULL, NULL),
(34, 'user7store', NULL, NULL, '2020-12-13 03:15:25', 50, NULL, NULL),
(35, 'Merchant Store', 'test', 'uploads/merchant/35/logo/e5c2e11ebd34bfad91451c5d618f39eb.png', '2020-12-13 06:36:50', 53, NULL, NULL),
(36, 'test stre', NULL, NULL, '2020-12-19 02:08:56', 54, NULL, NULL),
(37, 'Lazada', NULL, NULL, '2020-12-19 02:59:52', 55, NULL, NULL),
(38, 'Shopee', NULL, NULL, '2020-12-24 04:24:08', 58, 36, NULL),
(39, 'store2', 'MRC toda moon', 'uploads/merchant/39/logo/b9fb9d37bdf15a699bc071ce49baea53.jpg', '2020-12-24 12:21:42', 59, 36, NULL);

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
(52, 'client1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2020-12-13 05:44:54', 'uploads/user//profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg'),
(53, 'merchant1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2020-12-13 06:36:49', NULL),
(54, 'test', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2020-12-19 02:08:55', NULL),
(55, 'testuser1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2020-12-19 02:59:52', NULL),
(56, 'customer2', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'client', 0, '2020-12-19 03:03:50', NULL),
(57, 'store1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2020-12-24 04:23:33', NULL),
(58, 'store1', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 0, '2020-12-24 04:24:08', NULL),
(59, 'store2', '5c07f19fdd6ce3b1a588f71d11ee2b23', 'merchant', 1, '2020-12-24 12:21:41', 'uploads/user/39/profile/cb424a2f54ed050e9bde2ba1d7d30120.jpg');

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
(23, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-04 12:48:18', 46, NULL),
(24, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-04 12:52:21', 47, NULL),
(25, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-05 19:12:46', 36, NULL),
(26, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 02:55:20', 48, NULL),
(27, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 02:56:51', 49, NULL),
(28, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 03:15:25', 50, NULL),
(29, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 05:34:25', 51, NULL),
(30, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 05:43:18', 0, NULL),
(31, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 05:44:54', 52, NULL),
(32, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-13 06:36:50', 53, NULL),
(33, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-19 02:08:56', 54, NULL),
(34, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-19 02:59:52', 55, NULL),
(35, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-19 03:03:50', 56, NULL),
(36, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-24 04:23:33', 57, NULL),
(37, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-24 04:24:08', 58, NULL),
(38, 'Jordan Sadiwa', '1852 Sandejas Pasay City', '111', 'sad@mail.com', '0111-11-11', '2020-12-24 12:21:42', 59, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `productt`
--
ALTER TABLE `productt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
