-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2024 at 02:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adress`
--

CREATE TABLE `adress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`id`, `user_id`, `firstname`, `lastname`, `address`, `postal`, `city`, `country`, `phone`) VALUES
(5, 8, 'asdas', 'dasda', 'asdasd', 'sda', 'sdasd', 'AW', 'dsadasd'),
(6, 8, 'Mar', 'Mar', 'Mar', 'Mar', 'Mar', 'AZ', 'Mar');

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `description`, `price`) VALUES
(1, 'Hmad', 'Hmad ida sta7anut', 22);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Gamging PC', 'Gamging PC'),
(2, 'CPU', 'CPU'),
(4, 'GPU', 'GPU'),
(5, 'Accessories', 'Computer-Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240718131032', '2024-07-18 15:15:35', 24),
('DoctrineMigrations\\Version20240718133359', '2024-07-18 15:40:34', 5),
('DoctrineMigrations\\Version20240722153059', '2024-07-22 17:46:39', 10),
('DoctrineMigrations\\Version20240722173422', '2024-07-22 19:34:32', 31),
('DoctrineMigrations\\Version20240724161728', '2024-07-24 18:21:20', 11),
('DoctrineMigrations\\Version20240724165637', '2024-07-24 18:57:34', 52),
('DoctrineMigrations\\Version20240731140934', '2024-07-31 16:11:50', 11),
('DoctrineMigrations\\Version20240805115145', '2024-08-05 13:55:11', 46),
('DoctrineMigrations\\Version20240805115941', '2024-08-05 14:00:31', 7),
('DoctrineMigrations\\Version20240814134116', '2024-08-14 15:42:14', 74);

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `context` longtext NOT NULL,
  `button_title` varchar(255) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `illustration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `title`, `context`, `button_title`, `button_link`, `illustration`) VALUES
(1, 'Gaming Pc', 'Check out our new gaming pc', 'Check out our new built pc\'s!', '#', '2024-08-11-56c19a1f46f52116e7aca1c63e637983bf9c57d2.jpg'),
(2, 'New Gamging CPUs', 'Check out our new CPUs', '-15% on all CPUs', '#', '2024-08-11-cbf1a5ad76a1a7f5f881e018fea06a5bc06c5880.jpg'),
(3, 'Gaming Gpu\'s', 'Check out our new GPU\'s', '-15% on all GPUs', '#', '2024-08-11-7c3bb32720b618a0dd148eb26a2636521bab69b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `state` int(11) NOT NULL,
  `carrier` varchar(255) NOT NULL,
  `carrier_price` double NOT NULL,
  `delivery` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `stripe_session_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `created_at`, `state`, `carrier`, `carrier_price`, `delivery`, `user_id`, `stripe_session_id`) VALUES
(1, '2024-07-26 17:15:26', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(2, '2024-07-26 17:32:08', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(3, '2024-07-26 17:52:49', 1, 'Hmad', 22, 'Mar Mar<br>Mar<br>MarMar<br>AZ<br>Mar<br>', 8, NULL),
(4, '2024-07-28 19:45:02', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(5, '2024-07-28 20:09:07', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(6, '2024-07-28 20:20:44', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(7, '2024-07-31 14:51:56', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(8, '2024-07-31 14:57:31', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(9, '2024-07-31 15:08:19', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(10, '2024-07-31 15:13:16', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(11, '2024-07-31 15:18:12', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(12, '2024-07-31 15:22:43', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(13, '2024-07-31 15:30:39', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(14, '2024-07-31 15:32:37', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(15, '2024-07-31 15:35:43', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(16, '2024-07-31 15:37:05', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(17, '2024-07-31 15:43:55', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(18, '2024-07-31 15:44:32', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(19, '2024-07-31 15:45:59', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(20, '2024-07-31 15:46:16', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(21, '2024-07-31 15:48:16', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(22, '2024-07-31 16:15:44', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1sS0g4YLUVB1wKJHAZjzFk025GGu8dETTtIX7PaLAzVliQ1MgRmVloUR7'),
(23, '2024-07-31 16:18:44', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(24, '2024-07-31 17:10:11', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1eaqaOFc5GrJe7Cv0x7hJDecV7NA5rzq8HAjmlMe0urAfrbFCQp9qFT95'),
(25, '2024-07-31 17:25:05', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1jeYzzz3GyVoE2vaVyf6SR3jo5QIcTgEIj4BI5gKddPBNrKcKnqu1GaBG'),
(26, '2024-07-31 17:29:44', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1BUNiCL3x4OapZpiS40ZhzokKcUd9QhME5CyskloWHmKkwhHjmeYEDk2J'),
(27, '2024-07-31 17:34:51', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1PIh3Agms14A3JKmJKmkIVTXevsh4u75X7XyEq6coV1zPSbmn6Z1yYLwq'),
(28, '2024-07-31 17:38:05', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1bHQLvAroOpPQ5w12LmEtOv0mvmyxvtHAdieFLyCzbS72618dSYuXYipM'),
(29, '2024-07-31 17:39:21', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1zGUerzS1VdE3I3aM8DFaNKXPvFIbG5HpizllanmdsJ7eqRYlOxO5bx1R'),
(30, '2024-07-31 17:41:49', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1bDZ2s6z8L8KbtgaKPBgB8WHgiKBmXmRDqgwz3R9Swp44CLeEWbm2Zzna'),
(31, '2024-07-31 17:45:28', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1DJtjtzyKwArbdDUVwqkLHUM7yLsxmZy69a1ogHUKddSWnjWouU5ZmFht'),
(32, '2024-07-31 17:48:51', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b17rXCvJl4g0TsPLGndYTF7a9HoN11EisIpKxnBr4kllWuky6IpMUQOCYi'),
(33, '2024-07-31 17:53:59', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1Bh79yS3Xu58ToKya9pCyRa3dEs71Sw1fXaRbcgI7d7zwhN9gyhxm8p84'),
(34, '2024-07-31 18:04:49', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1C9k1BefkXzPFqsU4a8OlOnW6e7kw7PLyKDdlveXSTFMzqxYjzteIVmnJ'),
(35, '2024-07-31 18:51:35', 4, 'Hmad', 22, 'Mar Mar<br>Mar<br>MarMar<br>AZ<br>Mar<br>', 8, 'cs_test_b1SOGcebuWoRLuBIMy5RBGci7rW1kQkLXOBWCzn4KOJRy8lM0ZivmQYgBt'),
(36, '2024-08-04 17:06:05', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(37, '2024-08-05 17:03:59', 2, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1qWQUl0p4icPfSgzj2RLeoGMwl5eDkQjRtGzNtiPlCJtTp1ZQj5vA8ptP'),
(38, '2024-08-05 17:10:40', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1JI3AleRK5k897km6jjmkECIr7CsGYiiNxfl2X0tiVOsMyxGyiuIwQDr2'),
(39, '2024-08-06 21:52:51', 2, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1X01goQtSA27dcOdx8JjWCzopHw9Kgd6j5Xv1lGPPIY8lLVatKgNsWeyE'),
(40, '2024-08-09 16:06:59', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(41, '2024-08-09 16:07:30', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(42, '2024-08-09 16:08:04', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(43, '2024-08-09 16:09:11', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(44, '2024-08-09 16:09:19', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(45, '2024-08-09 16:09:25', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(46, '2024-08-09 16:09:30', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(47, '2024-08-09 16:10:16', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(48, '2024-08-09 16:10:23', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(49, '2024-08-09 16:10:28', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(50, '2024-08-09 16:10:33', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(51, '2024-08-09 16:10:38', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(52, '2024-08-09 16:10:46', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(53, '2024-08-09 16:10:53', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(54, '2024-08-09 16:16:06', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(55, '2024-08-09 16:16:53', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(56, '2024-08-09 16:17:19', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, NULL),
(57, '2024-08-09 16:18:46', 1, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b10NnEXI1aOFV90LMYrRxUXZ6a2O1wAHjQNNcsSbOZ3DqRgYhkRRu3nxpd'),
(58, '2024-08-13 18:12:55', 5, 'Hmad', 22, 'asdas dasda<br>asdasd<br>sdasdasd<br>AW<br>dsadasd<br>', 8, 'cs_test_b1ZMST1LEqLUZsPpDsRXM2BSxEaMM1nxZWVqpssyIIXPD9VlUEKWSrmnSZ');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `my_order_id` int(11) DEFAULT NULL,
  `product` varchar(255) NOT NULL,
  `prodcut_illustration` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_tva` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `my_order_id`, `product`, `prodcut_illustration`, `product_quantity`, `product_price`, `product_tva`) VALUES
(1, 1, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(2, 2, 'ddd', 'x.jpg', 3, 22.11, 5.5),
(3, 3, 'ddd', 'x.jpg', 3, 22.11, 5.5),
(4, 4, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(5, 5, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(6, 6, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(7, 7, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(8, 8, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(9, 9, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(10, 9, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(11, 10, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(12, 10, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(13, 11, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(14, 11, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(15, 12, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(16, 12, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(17, 13, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(18, 13, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(19, 14, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(20, 14, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(21, 15, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(22, 15, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(23, 16, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(24, 16, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(25, 17, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(26, 17, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(27, 18, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(28, 18, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(29, 19, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(30, 19, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(31, 20, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(32, 20, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(33, 21, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(34, 21, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(35, 22, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(36, 22, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(37, 23, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(38, 23, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(39, 24, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(40, 24, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(41, 25, 'ddd', 'x.jpg', 2, 22.11, 5.5),
(42, 25, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(43, 26, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(44, 26, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(45, 27, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(46, 28, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(47, 29, 'ddd', 'x.jpg', 1, 22.11, 5.5),
(48, 30, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 1, 76, 5.5),
(49, 31, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(50, 32, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(51, 33, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 2, 76, 5.5),
(52, 34, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 3, 76, 5.5),
(53, 35, 'Php for legends', '2024-07-26-07aca46f0cf7628f7e7942901e00bcf6a3ac859b.png', 4, 76, 5.5),
(54, 37, 'ddd', 'x.jpg', 1, 22.11, 5),
(55, 38, 'ddd', 'x.jpg', 1, 22.11, 5),
(56, 39, 'Abidass #1', '2024-08-02-d434e0a9d8d16380878eb9b552fb0a5b54c2e38e.jpg', 1, 76, 10),
(57, 40, 'ddd', 'x.jpg', 1, 22.11, 5),
(58, 41, 'ddd', 'x.jpg', 1, 22.11, 5),
(59, 42, 'ddd', 'x.jpg', 1, 22.11, 5),
(60, 43, 'ddd', 'x.jpg', 1, 22.11, 5),
(61, 44, 'ddd', 'x.jpg', 1, 22.11, 5),
(62, 45, 'ddd', 'x.jpg', 1, 22.11, 5),
(63, 46, 'ddd', 'x.jpg', 1, 22.11, 5),
(64, 47, 'ddd', 'x.jpg', 1, 22.11, 5),
(65, 48, 'ddd', 'x.jpg', 1, 22.11, 5),
(66, 49, 'ddd', 'x.jpg', 1, 22.11, 5),
(67, 50, 'ddd', 'x.jpg', 1, 22.11, 5),
(68, 51, 'ddd', 'x.jpg', 1, 22.11, 5),
(69, 52, 'ddd', 'x.jpg', 1, 22.11, 5),
(70, 53, 'ddd', 'x.jpg', 1, 22.11, 5),
(71, 54, 'ddd', 'x.jpg', 1, 22.11, 5),
(72, 55, 'ddd', 'x.jpg', 1, 22.11, 5),
(73, 56, 'ddd', 'x.jpg', 1, 22.11, 5),
(74, 57, 'ddd', 'x.jpg', 1, 22.11, 5),
(75, 58, 'Ryzen 5 5500G', '2024-08-12-cbf1a5ad76a1a7f5f881e018fea06a5bc06c5880.jpg', 3, 22.11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `illustration` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `tva` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `slug`, `description`, `illustration`, `price`, `tva`) VALUES
(3, 2, 'Ryzen 5 5500G', 'Ryzen 5 5500G', '<div>Ryzen 5 5500G</div>', '2024-08-12-cbf1a5ad76a1a7f5f881e018fea06a5bc06c5880.jpg', 22.11, 5),
(6, 1, 'Ryzen 5 3500G', 'Ryzen 5 5500G', '<div>Ryzen 5 5500G</div>', '2024-08-12-cbf1a5ad76a1a7f5f881e018fea06a5bc06c5880.jpg', 76, 10),
(7, 1, 'Ryzen 3 3100', 'Ryzen 3 3100', '<div>Ryzen 3 3100</div>', '2024-08-12-cbf1a5ad76a1a7f5f881e018fea06a5bc06c5880.jpg', 226, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(6, 'sad@gmail.cp,', '{\"1\":\"ROLE_USER\"}', 'marwanesk2001', 'SAD', 'ASD'),
(7, 'marwane@gmail.com', '[]', '$2y$13$doJ/EDa30JDL9l/oGSm2lONuij5Ek.V2Ok3bW6t3QA8MHu0toBCKa', 'asdasd', 'asdasd'),
(8, 'marwane2@gmail.com', '{\"1\":\"ROLE_USER\",\"2\":\"ROLE_ADMIN\"}', '$2y$13$uV7KKD2MKbML6m3fd2R4jOsiTb0PQA2Lr3B0Su0GQRRaGnvrvBrB.', 'marwane2@gmail.com', 'marwane2@gmail.com'),
(11, 'marwane22@gmail.com', '[]', '$2y$13$MN8eZB2pK2h7WXCUf4EuTOmG4j9nT0Q0NhjJ1FTdt9C59PjFViLIO', 'marwane22@gmail.com', 'marwane22@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`user_id`, `product_id`) VALUES
(8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5CECC7BEA76ED395` (`user_id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F46BFCDF877` (`my_order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `IDX_8B471AA7A76ED395` (`user_id`),
  ADD KEY `IDX_8B471AA74584665A` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adress`
--
ALTER TABLE `adress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `FK_5CECC7BEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F46BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `FK_8B471AA74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8B471AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
