-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 06:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` enum('active','inactive','trash') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_loggedin_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `profile_picture`, `uname`, `email`, `password`, `type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `last_loggedin_at`) VALUES
(1, 'Ideate', 'Programmers', '1_75_1696224274.jpg', 'ideateprogrammers', 'ideateprogrammers@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'superadmin', 'active', 0, 1, '2015-01-21 08:13:24', '2023-10-02 10:54:34', '2023-10-30 10:21:53'),
(9, 'admin', 'admin', '0_88_1695894284.png', 'joe_biden', 'admin@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'admin', 'active', 1, 0, '2023-09-28 15:14:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `icon` varchar(70) NOT NULL,
  `status` enum('active','inactive','trash') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(3) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'TV & Audios ', 'flaticon-computer', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(2, 'Smartphones ', 'flaticon-smartphone', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(3, 'Desk & Laptop ', 'flaticon-laptop', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(4, 'Game Console ', 'flaticon-gamepad-1', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(5, 'Watches ', 'flaticon-computer-1', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(6, 'Accessories ', 'flaticon-keyboard', 'active', '2023-09-25 14:16:51', 0, '2023-09-25 14:16:51', 0),
(7, 'Home Audio & Theater', 'ion-ios-home', 'active', '2023-09-25 14:35:31', 0, '2023-09-25 14:35:31', 0),
(8, 'Camera, Photo & Video', 'ion-android-camera', 'active', '2023-09-25 14:35:31', 0, '2023-09-25 14:35:31', 0),
(9, 'Cell Phones & Accessories', 'icon-phone', 'active', '2023-09-25 14:35:31', 0, '2023-09-28 17:36:35', 1),
(10, 'Headphones', 'ion-headphone', 'active', '2023-09-25 14:35:31', 0, '2023-09-25 14:35:31', 0),
(11, 'Bluetooth & Wireless Speakers', 'ion-bluetooth', 'active', '2023-09-25 14:35:31', 0, '2023-09-28 16:47:10', 1),
(12, 'Monitors', 'ion-ios-monitor', 'active', '2023-09-25 14:35:31', 0, '2023-09-28 16:46:56', 1),
(13, 'Home Appliances', 'icon-home', 'active', '2023-09-25 14:35:31', 0, '2023-09-28 16:52:12', 1),
(14, 'Office Supplies', 'icon-support', 'active', '2023-09-25 14:35:31', 0, '2023-09-28 16:54:32', 1),
(15, 'Computers & Tablets', 'flaticon-computer', 'active', '2023-09-25 14:38:27', 0, '2023-10-27 18:48:10', 1),
(34, 'Cash', 'frev', 'trash', '2023-10-09 10:47:47', 4, '2023-10-26 11:32:36', 1),
(35, 'Card', 'cdfdv', 'trash', '2023-10-09 10:50:04', 0, '2023-10-26 11:32:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ideate_sessions`
--

CREATE TABLE `ideate_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ideate_sessions`
--

INSERT INTO `ideate_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('igavh6v6jd8n9uu6vjqitmnpgosd6pkj', '::1', 1698642826, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639383634323832363b7365737341646d696e5573657249647c733a313a2231223b7365737341646d696e55736572466e616d657c733a363a22496465617465223b7365737341646d696e557365724c6e616d657c733a31313a2250726f6772616d6d657273223b7365737341646d696e50726f66696c65506963747572657c733a31393a22315f37355f313639363232343237342e6a7067223b7365737341646d696e55736572556e616d657c733a31373a2269646561746570726f6772616d6d657273223b7365737341646d696e55736572456d61696c7c733a32373a2269646561746570726f6772616d6d65727340676d61696c2e636f6d223b7365737341646d696e55736572547970657c733a31303a22737570657261646d696e223b7365737341646d696e557365724372656174656441747c733a31393a22323031352d30312d32312030383a31333a3234223b7365737341646d696e557365725570646174656441747c733a31393a22323032332d31302d30322031303a35343a3334223b7365737341646d696e557365724c6173744c6f67676564496e41747c733a31393a22323032332d31302d32382031303a31393a3533223b),
('ipbbkvn4h5rhcumvpj0irbb74gn2mmj8', '::1', 1698642488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639383634323438383b7365737341646d696e5573657249647c733a313a2231223b7365737341646d696e55736572466e616d657c733a363a22496465617465223b7365737341646d696e557365724c6e616d657c733a31313a2250726f6772616d6d657273223b7365737341646d696e50726f66696c65506963747572657c733a31393a22315f37355f313639363232343237342e6a7067223b7365737341646d696e55736572556e616d657c733a31373a2269646561746570726f6772616d6d657273223b7365737341646d696e55736572456d61696c7c733a32373a2269646561746570726f6772616d6d65727340676d61696c2e636f6d223b7365737341646d696e55736572547970657c733a31303a22737570657261646d696e223b7365737341646d696e557365724372656174656441747c733a31393a22323031352d30312d32312030383a31333a3234223b7365737341646d696e557365725570646174656441747c733a31393a22323032332d31302d30322031303a35343a3334223b7365737341646d696e557365724c6173744c6f67676564496e41747c733a31393a22323032332d31302d32382031303a31393a3533223b),
('j4gl72nrics2fn47lkefina16efeifer', '::1', 1698643029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639383634323832363b7365737341646d696e5573657249647c733a313a2231223b7365737341646d696e55736572466e616d657c733a363a22496465617465223b7365737341646d696e557365724c6e616d657c733a31313a2250726f6772616d6d657273223b7365737341646d696e50726f66696c65506963747572657c733a31393a22315f37355f313639363232343237342e6a7067223b7365737341646d696e55736572556e616d657c733a31373a2269646561746570726f6772616d6d657273223b7365737341646d696e55736572456d61696c7c733a32373a2269646561746570726f6772616d6d65727340676d61696c2e636f6d223b7365737341646d696e55736572547970657c733a31303a22737570657261646d696e223b7365737341646d696e557365724372656174656441747c733a31393a22323031352d30312d32312030383a31333a3234223b7365737341646d696e557365725570646174656441747c733a31393a22323032332d31302d30322031303a35343a3334223b7365737341646d696e557365724c6173744c6f67676564496e41747c733a31393a22323032332d31302d32382031303a31393a3533223b),
('sc8veqi3qr5oeo4dedfua5j432k3iv7e', '::1', 1698663056, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639383636333034313b);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grand_total_price` int(11) NOT NULL,
  `payment_status` enum('pending','paid','refunded') NOT NULL,
  `billing_type` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `status` enum('pending','confirm','in_shpping','cancelled','delivered') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `confirmed_at` datetime NOT NULL,
  `confirmed_by` int(11) NOT NULL,
  `product_user_type` enum('admin','user') NOT NULL,
  `shipping_at` datetime NOT NULL,
  `cancelled_at` datetime NOT NULL,
  `cancelled_by` int(11) NOT NULL,
  `delivered_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `grand_total_price`, `payment_status`, `billing_type`, `address`, `status`, `created_at`, `updated_at`, `updated_by`, `confirmed_at`, `confirmed_by`, `product_user_type`, `shipping_at`, `cancelled_at`, `cancelled_by`, `delivered_at`) VALUES
(1, 29, 0, 'pending', 'COD', 'india ,rajkot ,gujrat ,india ,123123', 'cancelled', '2023-10-27 17:27:03', '2023-10-27 17:33:36', 1, '0000-00-00 00:00:00', 0, 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 29, '0000-00-00 00:00:00'),
(2, 29, 2550, 'pending', 'COD', 'Near Mahadev Mandir ,rajkot ,gujrat ,india ,363001', 'pending', '2023-10-27 18:41:22', '2023-10-27 19:22:11', 1, '0000-00-00 00:00:00', 0, 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('active','trash') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `product_id`, `price`, `qty`, `total_price`, `status`) VALUES
(1, 1, 5, 250, 3, 750, 'trash'),
(2, 1, 2, 250, 3, 750, 'trash'),
(3, 1, 41, 33, 6, 198, 'trash'),
(4, 1, 12, 450, 1, 450, 'trash'),
(5, 2, 6, 500, 1, 500, 'active'),
(6, 2, 5, 250, 7, 1750, 'active'),
(7, 2, 4, 300, 1, 300, 'active'),
(8, 2, 3, 20, 10, 200, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `browser_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(30) NOT NULL,
  `template` varchar(50) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `sub_heading` varchar(255) NOT NULL,
  `primary_image` varchar(50) NOT NULL,
  `page_content` text NOT NULL,
  `secondary_page_content` text NOT NULL,
  `display_order` int(11) NOT NULL,
  `status` enum('active','trash') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `browser_title`, `meta_keywords`, `meta_description`, `slug`, `template`, `heading`, `sub_heading`, `primary_image`, `page_content`, `secondary_page_content`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'keyword1, keyword2, keyword3', 'Add your meta description here.', 'home', 'home', 'Home', '', '', '', '', 1, 'active', 1, 1, '2015-03-08 20:01:03', '2023-09-26 12:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive','trash') NOT NULL,
  `availability` int(11) NOT NULL,
  `functionality` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `img`, `description`, `status`, `availability`, `functionality`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Mp3 Sumergible Deportivo Slim Con 8GB', 6, 350, '0_83_1696229582.jpg\r\n', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB<<>>Hard Drive: Flash memory solid state<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 34, 'onsale', '2023-10-02 12:23:02', 1, '2023-10-17 11:49:04', 1),
(2, 'Reloj Inteligente Smart Watch M26 Touch Bluetooh 										Touch Bluetooh', 2, 250, '0_50_1696230130.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 22, 'special,onsale', '2023-10-02 12:32:10', 1, '2023-10-17 11:49:37', 1),
(3, 'Teclado Inalambrico Bluetooth Con Air Mouse', 3, 20, '3_23_1696323210.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB<<>>Hard Drive: Flash memory solid state<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 103, 'featured,special', '2023-10-02 12:36:18', 1, '2023-10-17 11:50:29', 1),
(4, 'Laptop Alienware 15 i7 Perfect For Playing Game', 4, 300, '4_32_1696321645.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB<<>>Hard Drive: Flash memory solid state<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 69, 'featured,special', '2023-10-02 12:39:36', 1, '2023-10-17 11:51:17', 1),
(5, 'Mp3 Sumergible Deportivo Slim Con 8GB', 5, 250, '5_3_1696318751.jpg', 'Processor: 2.5 GHz None<<>>Hard Drive: Flash memory solid state<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 56, 'featured,onsale', '2023-10-02 12:45:25', 1, '2023-10-17 11:58:03', 1),
(6, 'Reloj Inteligente Smart Phone', 2, 500, '6_74_1696319575.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB', 'active', 67, 'featured', '2023-10-02 12:47:45', 1, '2023-10-17 11:55:52', 1),
(7, 'Teclado Inalambrico Bluetooth Con  Air Headphones', 8, 150, '7_2_1696327561.jpg', 'Processor: 2.5 GHz None<<>>Hard Drive: Flash memory solid state<<>>Graphics : Intel HD Graphics 520 Integrated', 'active', 34, 'special,onsale', '2023-10-02 12:50:17', 1, '2023-10-17 11:54:57', 1),
(8, 'Funda Para Ebook 7&quot; 128GB full HD', 8, 760, '0_71_1696231447.jpg', 'The Funda Para Ebook 7&quot; 128GB Full HD offers optimal protection and storage for your 7-inch e-reader. With its durable material, it shields your device from scratches and impacts, ensuring its longevity. Additionally, the ample 128GB storage capacity enables you to store a vast library of high-definition e-books, providing a seamless reading experience wherever you go.', 'active', 332, 'special', '2023-10-02 12:54:07', 1, '2023-10-04 11:34:59', 1),
(9, 'Funda Para Smart Watch Model007', 11, 3232, '0_88_1696234158.jpg', 'Screen: 1920 x 1080 pixels<<>>RAM: 8 GB', 'active', 167, 'special', '2023-10-02 13:39:18', 1, '2023-10-17 11:55:23', 1),
(10, 'Relog Intelligent Smart Tv m004', 12, 450, '0_26_1696237726.jpg', 'Screen: 1920 x 1080 pixels<<>>Wireless Convenience<<>>Processor: 2.5 GHz None', 'active', 59, 'special', '2023-10-02 14:38:46', 1, '2023-10-19 12:04:09', 1),
(11, 'Teclado Inalambrico Bluetooth Con Air', 13, 99, '0_3_1696237827.jpg', 'Teclado Inalámbrico Bluetooth Con Air ofrece una experiencia de escritura sin cables con su conexión Bluetooth estable. Equipado con tecnología Air, permite un control preciso y sin esfuerzo de dispositivos compatibles. Su diseño compacto y retroiluminación ajustable lo convierten en un compañero versátil y elegante para trabajos y entretenimiento en cualquier lugar.', 'active', 76, 'onsale', '2023-10-02 14:40:27', 1, '2023-10-04 11:35:16', 1),
(12, 'Funda Para Smart Tv m9001', 14, 450, '0_39_1696237965.jpg', 'Funda Para Smart TV M9001 proporciona protección premium y estilo para tu televisor inteligente. Hecha de materiales duraderos y resistentes al agua, esta funda protege contra polvo, arañazos y daños accidentales. Su diseño elegante y compatible con diferentes tamaños de TV lo convierte en un accesorio esencial para mantener tu dispositivo seguro y con un aspecto impecable.', 'active', 63, 'special', '2023-10-02 14:42:45', 1, '2023-10-03 16:12:28', 1),
(13, 'Reloj Inteligente Smart Tablet M26', 15, 149, '0_94_1696238174.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB<<>>Hard Drive: Flash memory solid state', 'active', 22, 'featured,onsale', '2023-10-02 14:46:14', 1, '2023-10-17 11:52:03', 1),
(27, 'Mp3 Sumergible Deportivo Slim Con 8GB', 1, 234, '0_28_1696240045.jpg', 'Screen: 1920 x 1080 pixels<<>>Processor: 2.5 GHz None<<>>RAM: 8 GB', 'active', 43, 'special', '2023-10-02 15:17:25', 1, '2023-10-17 11:52:53', 1),
(30, 'Sumergibil new m23 Classic Wireless Bluetooth', 7, 34, '30_1_1696320041.jpg', 'fdevdsvcvsddccs , vsddccf , cdwcscsd , cdscscs , vsddccs', 'active', 33, 'special', '2023-10-02 15:24:24', 1, '2023-10-04 11:34:08', 1),
(41, 'Figma Short Head Jack m34', 10, 33, '41_36_1696837557.jpg', 'Wireless Convenience<<>>Compact Design<<>>Universal Compatibility<<>>High-Quality Sound', 'active', 132, 'featured', '2023-10-09 08:45:11', 0, '2023-10-09 15:31:10', 1),
(42, 'Gala Wire Free Headphone Jack', 4, 55, '42_52_1696837573.jpg', 'Wireless Convenience<<>>Compact Design<<>>Universal Compatibility<<>>High-Quality Sound<<>>Durable Construction', 'active', 23, 'special', '2023-10-09 08:45:11', 0, '2023-10-09 15:32:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'Ideate CMS'),
(2, 'site_tagline', ''),
(3, 'site_logo', '1_45_1695963866.png'),
(4, 'site_admin_email', 'ideateprogrammers@gmail.com'),
(5, 'site_info_sender', '1'),
(6, 'site_outgoing_email', 'noreply@ideatewebsolutions.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `fname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `recovery_key` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('active','inactive','trash') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `last_loggedin_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `recovery_key`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `last_loggedin_at`) VALUES
(28, 'test', 'seeker', 'Raj943@gmail.com', '9687411172', 'f5bb0c8de146c67b44babbf4e6584cc0', '', 'trash', '2023-10-02 12:14:06', '2023-10-03 15:49:27', 1, 1, NULL),
(29, 'Vatsal', 'Gandhi', 'Vatsal@gmail.com', '9687411172', 'e900b3649b424d668cdfb51c975658cb', '962674706', 'trash', '2023-10-03 16:14:22', '2023-10-28 10:22:21', 1, 1, '2023-10-27 10:14:23'),
(30, 'Vatsal', 'Gandhi', 'Vatsal@gmail.com', '9687411172', 'f5bb0c8de146c67b44babbf4e6584cc0', '', 'active', '2023-10-28 10:22:42', '0000-00-00 00:00:00', 1, 0, '2023-10-28 10:22:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ideate_sessions`
--
ALTER TABLE `ideate_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
