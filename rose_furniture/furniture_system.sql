-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 12:35 AM
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
-- Database: `furniture_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_items`
--

CREATE TABLE `tbl_cart_items` (
  `cart_id` int(11) NOT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart_items`
--

INSERT INTO `tbl_cart_items` (`cart_id`, `product_code`, `product_name`, `price`, `quantity`, `payment_method`, `user_id`, `status`) VALUES
(7, 'YMww5D6SN7', 'Uratex Soft Chairs', '2500', '1', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Sofas', 1),
(2, 'Tables', 1),
(3, 'Chairs', 1),
(4, 'Beds', 1),
(5, 'Desks', 1),
(6, 'Mattreses', 1),
(7, 'Dressers', 1),
(8, 'Ottomans', 1),
(9, 'Dining Tables', 1),
(10, 'Dining Chairs', 1),
(11, 'Sectional Sofas', 1),
(12, 'TV Stands', 1),
(13, 'Bookcases', 1),
(14, 'Futons', 1),
(15, 'Bunk Beds', 1),
(16, 'Coffee Tables', 1),
(17, 'Stools', 1),
(18, 'End Tables', 1),
(19, 'Nightstands', 1),
(20, 'Mini-Bars', 1),
(21, 'Mini Kitchen Islands', 1),
(22, 'Mudroom Lockers', 1),
(23, 'Storage Benches', 1),
(24, 'Toy Organizers', 1),
(25, 'Hall Trees', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logistics_partner`
--

CREATE TABLE `tbl_logistics_partner` (
  `logistic_id` int(11) NOT NULL,
  `logistic_name` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logistics_partner`
--

INSERT INTO `tbl_logistics_partner` (`logistic_id`, `logistic_name`, `status`) VALUES
(1, 'J&T Express', 1),
(2, 'LBC Express Padala', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_text` varchar(100) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `detail_code` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notification_id`, `notification_text`, `sender_id`, `receiver_id`, `detail_code`, `date`, `status`) VALUES
(1, 'You have a new for approval order with a tracking no : a8909f53fd4c0197635c', 2, 1, 'a8909f53fd4c0197635c', '2023-11-02 03:38:56', 0),
(2, 'You have a new for approval order with a tracking no : 2c62438d0ca6316f070f', 2, 1, '2c62438d0ca6316f070f', '2023-11-02 03:38:56', 0),
(3, 'You have a new for approval order with a tracking no : ce8b6935eb13465dc32f', 2, 1, 'ce8b6935eb13465dc32f', '2023-11-02 03:38:56', 0),
(4, 'You have a new for approval order with a tracking no : 8ddb1b6b54ec0722a6aa', 2, 1, '8ddb1b6b54ec0722a6aa', '2023-11-02 03:38:56', 0),
(5, 'You have a new for approval order with a tracking no : 67d0284058e0b471cb37', 2, 1, '67d0284058e0b471cb37', '2023-11-02 03:38:56', 0),
(6, 'Your order has been approve with a tracking no : 67d0284058e0b471cb37', 1, 2, '67d0284058e0b471cb37', '2023-11-02 03:39:24', 0),
(7, 'Your order no. 67d0284058e0b471cb37 is Preparing to ship', 1, 2, '67d0284058e0b471cb37', '2023-11-02 03:39:51', 0),
(8, 'Your order has been approve with a tracking no : 8ddb1b6b54ec0722a6aa', 1, 2, '8ddb1b6b54ec0722a6aa', '2023-11-02 03:48:58', 0),
(9, 'Your order no. 8ddb1b6b54ec0722a6aa is Preparing to ship', 1, 2, '8ddb1b6b54ec0722a6aa', '2023-11-02 03:49:10', 0),
(10, 'You have a new for a confirmation Order No. 67d0284058e0b471cb37', 1, 3, '67d0284058e0b471cb37', '2023-11-02 03:49:56', 0),
(11, 'Rider De Guzman has confirm the order 67d0284058e0b471cb37', 3, 1, '67d0284058e0b471cb37', '2023-11-02 03:54:47', 0),
(12, 'Your order has been delivered with a tracking no. : 67d0284058e0b471cb37', 3, 2, '67d0284058e0b471cb37', '2023-11-02 03:58:42', 0),
(13, 'You have a new for a confirmation Order No. 8ddb1b6b54ec0722a6aa', 1, 3, '8ddb1b6b54ec0722a6aa', '2023-11-02 04:00:35', 0),
(14, 'Rider De Guzman has confirm the order 8ddb1b6b54ec0722a6aa', 3, 1, '8ddb1b6b54ec0722a6aa', '2023-11-02 04:01:28', 1),
(15, 'Your order has been delivered with a tracking no. : 8ddb1b6b54ec0722a6aa', 3, 2, '8ddb1b6b54ec0722a6aa', '2023-11-02 04:02:19', 0),
(16, 'Your order has been approve with a tracking no : ce8b6935eb13465dc32f', 1, 2, 'ce8b6935eb13465dc32f', '2023-11-02 04:32:27', 0),
(17, 'Your order has been approve with a tracking no : 2c62438d0ca6316f070f', 1, 2, '2c62438d0ca6316f070f', '2023-11-02 04:32:33', 0),
(18, 'Your order has been approve with a tracking no : a8909f53fd4c0197635c', 1, 2, 'a8909f53fd4c0197635c', '2023-11-02 04:32:35', 0),
(19, 'Your order no. ce8b6935eb13465dc32f is Preparing to ship', 1, 2, 'ce8b6935eb13465dc32f', '2023-11-02 04:32:41', 0),
(20, 'Your order no. 2c62438d0ca6316f070f is Preparing to ship', 1, 2, '2c62438d0ca6316f070f', '2023-11-02 04:33:28', 0),
(21, 'Your order no. a8909f53fd4c0197635c is Preparing to ship', 1, 2, 'a8909f53fd4c0197635c', '2023-11-02 04:33:34', 0),
(22, 'You have a new for a confirmation Order No. ce8b6935eb13465dc32f', 1, 3, 'ce8b6935eb13465dc32f', '2023-11-02 04:36:35', 0),
(23, 'You have a new for a confirmation Order No. 2c62438d0ca6316f070f', 1, 3, '2c62438d0ca6316f070f', '2023-11-02 04:36:40', 0),
(24, 'You have a new for a confirmation Order No. a8909f53fd4c0197635c', 1, 3, 'a8909f53fd4c0197635c', '2023-11-02 04:36:44', 0),
(25, 'Rider De Guzman has confirm the order ce8b6935eb13465dc32f', 3, 1, 'ce8b6935eb13465dc32f', '2023-11-02 04:41:21', 1),
(26, 'Your order with a tracking no ce8b6935eb13465dc32f will be deliver by Rider De Guzman', 3, 2, 'ce8b6935eb13465dc32f', '2023-11-02 04:41:21', 0),
(27, 'Your order has been delivered with a tracking no. : ce8b6935eb13465dc32f', 3, 2, 'ce8b6935eb13465dc32f', '2023-11-02 04:42:12', 0),
(28, 'Rider De Guzman has confirm the order 2c62438d0ca6316f070f', 3, 1, '2c62438d0ca6316f070f', '2023-11-02 04:44:29', 1),
(29, 'Your order with a tracking no 2c62438d0ca6316f070f will be deliver by Rider De Guzman', 3, 2, '2c62438d0ca6316f070f', '2023-11-02 04:44:29', 0),
(30, 'Your order has been delivered with a tracking no. : 2c62438d0ca6316f070f', 3, 2, '2c62438d0ca6316f070f', '2023-11-02 04:46:24', 0),
(31, 'You have a new for approval order with a tracking no : f63aec394e85c99696be', 2, 1, 'f63aec394e85c99696be', '2023-11-02 04:50:49', 0),
(32, 'Order has been cancelled with a tracking no : f63aec394e85c99696be', 2, 1, 'f63aec394e85c99696be', '2023-11-02 04:51:00', 1),
(33, 'You have a for refund Order No. 67d0284058e0b471cb37', 2, 1, '67d0284058e0b471cb37', '2023-11-02 07:29:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail_items`
--

CREATE TABLE `tbl_order_detail_items` (
  `order_id` int(11) NOT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `detail_code` varchar(100) DEFAULT NULL,
  `date_cancelled` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1,
  `to_pay` int(11) DEFAULT 1,
  `to_ship` int(11) DEFAULT 0,
  `to_pickup` int(11) DEFAULT 0,
  `in_transit` int(11) DEFAULT 0,
  `to_deliver` int(11) DEFAULT 0,
  `cart_id` int(11) DEFAULT NULL,
  `to_complete` int(11) DEFAULT 0,
  `group_code` int(11) DEFAULT NULL,
  `rider_id` varchar(100) DEFAULT NULL,
  `refund_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_detail_items`
--

INSERT INTO `tbl_order_detail_items` (`order_id`, `product_code`, `product_name`, `price`, `quantity`, `payment_method`, `user_id`, `detail_code`, `date_cancelled`, `status`, `to_pay`, `to_ship`, `to_pickup`, `in_transit`, `to_deliver`, `cart_id`, `to_complete`, `group_code`, `rider_id`, `refund_status`) VALUES
(1, 'SyWAdWmHgO', 'Wooden Table', '1500', '3', 'Cash On Deliery', 2, 'a8909f53fd4c0197635c', '2023-11-02 03:38:56', 1, 2, 2, 2, 2, 1, 1, 0, 3, '3', 1),
(2, 'GMBSFfZvnH', 'awee', '321', '5', 'Cash On Deliery', 2, '2c62438d0ca6316f070f', '2023-11-02 03:38:56', 1, 2, 2, 2, 2, 2, 2, 2, 3, '3', 1),
(3, 'JAclu0ceXD', 'eeee', '111', '2', 'Cash On Deliery', 2, 'ce8b6935eb13465dc32f', '2023-11-02 03:38:56', 1, 2, 2, 2, 2, 2, 3, 2, 3, '3', 1),
(4, 'iEpotGo6Na', 'awe', '111', '2', 'Cash On Deliery', 2, '8ddb1b6b54ec0722a6aa', '2023-11-02 03:38:56', 1, 2, 2, 2, 2, 2, 4, 2, 3, '3', 1),
(5, 'YMww5D6SN7', 'Uratex Soft Chairs', '2500', '5', 'Cash On Deliery', 2, '67d0284058e0b471cb37', '2023-11-02 03:38:56', 1, 2, 2, 2, 2, 2, 5, 2, 3, '3', 2),
(6, 'JAclu0ceXD', 'eeee', '111', '1', 'Cash On Deliery', 2, 'f63aec394e85c99696be', '2023-11-02 04:50:49', 0, 1, 0, 0, 0, 0, 6, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_header_items`
--

CREATE TABLE `tbl_order_header_items` (
  `order_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `total_price` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `header_code` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `cart_id` int(11) DEFAULT NULL,
  `group_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_header_items`
--

INSERT INTO `tbl_order_header_items` (`order_id`, `full_name`, `address`, `contact_no`, `payment_method`, `total_price`, `remarks`, `header_code`, `user_id`, `status`, `cart_id`, `group_code`) VALUES
(1, 'test test', 'test', 'test', 'Cash On Deliery', '25500', '', '', 2, 1, NULL, NULL),
(2, 'test test', 'test', 'test', 'Cash On Deliery', '111', '', '', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_process`
--

CREATE TABLE `tbl_order_process` (
  `id` int(11) NOT NULL,
  `order_text` varchar(100) NOT NULL,
  `order_remarks` varchar(100) DEFAULT NULL,
  `last_departure` varchar(10) DEFAULT NULL,
  `detail_code` varchar(100) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `proof_image` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `rider_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_process`
--

INSERT INTO `tbl_order_process` (`id`, `order_text`, `order_remarks`, `last_departure`, `detail_code`, `cart_id`, `date`, `proof_image`, `status`, `rider_status`) VALUES
(1, 'Order Placed', NULL, NULL, 'a8909f53fd4c0197635c', 1, '2023-11-02 03:38:56', NULL, 1, 0),
(2, 'Order Placed', NULL, NULL, '2c62438d0ca6316f070f', 2, '2023-11-02 03:38:56', NULL, 1, 0),
(3, 'Order Placed', NULL, NULL, 'ce8b6935eb13465dc32f', 3, '2023-11-02 03:38:56', NULL, 1, 0),
(4, 'Order Placed', NULL, NULL, '8ddb1b6b54ec0722a6aa', 4, '2023-11-02 03:38:56', NULL, 1, 0),
(5, 'Order Placed', NULL, NULL, '67d0284058e0b471cb37', 5, '2023-11-02 03:38:56', NULL, 1, 0),
(6, 'Preparing To Ship', NULL, NULL, '67d0284058e0b471cb37', 5, '2023-11-02 03:39:24', NULL, 1, 0),
(7, 'Picked up', 'J&T Express', NULL, NULL, 5, '2023-11-02 03:39:51', NULL, 0, 0),
(8, 'Arrived', 'Makati', '', NULL, 5, '2023-11-02 03:40:47', NULL, 0, 0),
(9, 'Departed', 'Manila', '1', NULL, 5, '2023-11-02 03:41:03', NULL, 0, 0),
(10, 'Preparing To Ship', NULL, NULL, '8ddb1b6b54ec0722a6aa', 4, '2023-11-02 03:48:58', NULL, 1, 0),
(11, 'Picked up', 'J&T Express', NULL, NULL, 4, '2023-11-02 03:49:10', NULL, 0, 0),
(12, 'Arrived', 'AWe', '', NULL, 4, '2023-11-02 03:49:21', NULL, 0, 0),
(13, 'Departed', '3123', '1', NULL, 4, '2023-11-02 03:49:28', NULL, 0, 0),
(14, 'In Transit', 'Rider De Guzman', NULL, NULL, 5, '2023-11-02 03:49:56', NULL, 0, 1),
(15, 'Delivered', '12500', NULL, NULL, 5, '2023-11-02 03:58:42', 'CSY372jwUI_OIP-removebg-preview.png', 1, 3),
(16, 'In Transit', 'Rider De Guzman', NULL, NULL, 4, '2023-11-02 04:00:35', NULL, 0, 1),
(17, 'Delivered', '222', NULL, NULL, 4, '2023-11-02 04:02:19', 'RQiAs9ruhI_barong-removebg-preview.png', 1, 3),
(18, 'Preparing To Ship', NULL, NULL, 'ce8b6935eb13465dc32f', 3, '2023-11-02 04:32:27', NULL, 1, 0),
(19, 'Preparing To Ship', NULL, NULL, '2c62438d0ca6316f070f', 2, '2023-11-02 04:32:33', NULL, 1, 0),
(20, 'Preparing To Ship', NULL, NULL, 'a8909f53fd4c0197635c', 1, '2023-11-02 04:32:35', NULL, 1, 0),
(21, 'Picked up', 'J&T Express', NULL, NULL, 3, '2023-11-02 04:32:41', NULL, 0, 0),
(22, 'Picked up', 'J&T Express', NULL, NULL, 2, '2023-11-02 04:33:28', NULL, 0, 0),
(23, 'Picked up', 'J&T Express', NULL, NULL, 1, '2023-11-02 04:33:34', NULL, 0, 0),
(24, 'Arrived', '123', '', NULL, 3, '2023-11-02 04:33:41', NULL, 0, 0),
(25, 'Departed', '3123', '1', NULL, 3, '2023-11-02 04:35:53', NULL, 0, 0),
(26, 'Arrived', '3123', '', NULL, 2, '2023-11-02 04:36:06', NULL, 0, 0),
(27, 'Arrived', '3123123', '', NULL, 1, '2023-11-02 04:36:13', NULL, 0, 0),
(28, 'Departed', '3123', '1', NULL, 1, '2023-11-02 04:36:19', NULL, 0, 0),
(29, 'Departed', '3123', '1', NULL, 2, '2023-11-02 04:36:25', NULL, 0, 0),
(30, 'In Transit', 'Rider De Guzman', NULL, NULL, 3, '2023-11-02 04:36:35', NULL, 0, 1),
(31, 'In Transit', 'Rider De Guzman', NULL, NULL, 2, '2023-11-02 04:36:40', NULL, 0, 1),
(32, 'In Transit', 'Rider De Guzman', NULL, NULL, 1, '2023-11-02 04:36:44', NULL, 1, 0),
(33, 'Delivered', '222', NULL, NULL, 3, '2023-11-02 04:42:12', 'YoVdawWEQ9_slacks-removebg-preview.png', 1, 3),
(34, 'Delivered', '1605', NULL, NULL, 2, '2023-11-02 04:46:24', '3qnPvASq6J_barong-removebg-preview.png', 1, 3),
(35, 'Order Placed', NULL, NULL, 'f63aec394e85c99696be', 6, '2023-11-02 04:50:49', NULL, 1, 0),
(36, 'Cancelled', NULL, NULL, NULL, 6, '2023-11-02 04:51:00', NULL, 1, 0),
(37, 'Refund', 'Request of refund by Rose Marie Del Valle', NULL, '67d0284058e0b471cb37', 5, '2023-11-02 07:29:02', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` varchar(100) DEFAULT NULL,
  `product_quantity` varchar(100) DEFAULT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `product_description` varchar(1000) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `product_status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_name`, `product_price`, `product_quantity`, `product_category`, `product_description`, `product_image`, `product_status`) VALUES
(1, 'YMww5D6SN7', 'Uratex Soft Chairs', '2500', '2', 'Chairs', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, ea? Consequatur aliquam, mollitia rem similique obcaecati soluta eligendi recusandae ipsa perferendis voluptatem quo autem explicabo. Soluta perferendis laudantium necessitatibus nostrum?', 'YMww5D6SN7_charis.jpg', '1'),
(2, 'iEpotGo6Na', 'awe', '111', '228', 'Beds', 'eawe', 'iEpotGo6Na_120272980_3452245564873933_2474444473554821646_n.jpg', '1'),
(3, 'GMBSFfZvnH', 'awee', '321', '236', 'TV Stands', 'ewewae', 'GMBSFfZvnH_120272980_3452245564873933_2474444473554821646_n.jpg', '1'),
(4, 'SyWAdWmHgO', 'Wooden Table', '1500', '200', 'Tables', 'dasdasd', 'SyWAdWmHgO_wooden table.jpg', '1'),
(5, 'JAclu0ceXD', 'eeee', '111', '216', 'Futons', 'test', 'JAclu0ceXD_OIP-removebg-preview.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_comments`
--

CREATE TABLE `tbl_product_comments` (
  `comment_id` int(11) NOT NULL,
  `comment_text` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_comments`
--

INSERT INTO `tbl_product_comments` (`comment_id`, `comment_text`, `user_id`, `product_id`, `stars`, `date`, `status`) VALUES
(1, 'meow', 2, 1, 5, '2023-10-29 11:51:49', 1),
(2, 'bobocap', 5, 1, 3, '2023-10-29 11:53:24', 1),
(3, 'dasdasd', 1, 1, 3, '2023-10-29 12:39:34', 1),
(4, 'panget', 2, 3, 5, '2023-10-29 13:05:50', 1),
(5, 'maganda ung table', 6, 4, 3, '2023-10-29 22:33:17', 1),
(6, 'talaga ba', 2, 4, 5, '2023-11-01 00:16:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_refund_reason`
--

CREATE TABLE `tbl_refund_reason` (
  `reason_id` int(11) NOT NULL,
  `refund_text` varchar(100) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `detail_code` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_refund_reason`
--

INSERT INTO `tbl_refund_reason` (`reason_id`, `refund_text`, `cart_id`, `detail_code`, `date`, `status`) VALUES
(1, 'aweawe', 5, '67d0284058e0b471cb37', '2023-11-02 07:29:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reply_comment`
--

CREATE TABLE `tbl_reply_comment` (
  `reply_id` int(11) NOT NULL,
  `reply_text` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reply_comment`
--

INSERT INTO `tbl_reply_comment` (`reply_id`, `reply_text`, `user_id`, `comment_id`, `date`, `status`) VALUES
(1, 'dasd', 1, 1, '2023-10-29 11:52:20', 1),
(2, 'bobocap', 1, 2, '2023-10-29 11:53:40', 1),
(3, 'bobocapeeee', 2, 2, '2023-10-29 11:54:19', 1),
(4, 'agugugugugugu', 1, 2, '2023-10-29 12:57:44', 1),
(5, 'Thank You!', 1, 5, '2023-10-29 22:53:48', 1),
(6, 'Sa uulitin', 6, 5, '2023-10-29 22:54:23', 1),
(7, 'haha', 2, 5, '2023-11-01 00:13:14', 1),
(8, 'wewe', 2, 5, '2023-11-01 00:16:40', 1),
(9, 'ndi ko alam e', 2, 5, '2023-11-01 00:38:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `group_code` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `address`, `contact_no`, `username`, `password`, `email`, `group_code`, `status`) VALUES
(1, 'Oliver', 'Dela Fuente', '1920 Obeses St. Pandacan, Manila', '09637710968', 'gunsterpsp', '123', 'gunsterpsp@gmail.com', 1, 1),
(2, 'Rose Marie', 'Del Valle', 'test', 'test', 'rose', '111', 'test@gmail.com', 2, 1),
(3, 'Rider', 'De Guzman', 'Makati', '09238238292', 'rider', '123', 'rider@gmail.com', 3, 1),
(4, 'Rider', 'Almika', 'Pasig', '312312312', 'rider2', '123', 'rider2@gmail.com', 3, 1),
(5, 'bobocap', 'bobocap', 'bobocap', '13201293123', 'bobocap', '123', 'bobocap@gmail.com', 2, 1),
(6, 'Oliver', 'Dela Fuente', 'Manila', '09838289302', 'oliver123', '123123', 'oliver@gmail.com', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart_items`
--
ALTER TABLE `tbl_cart_items`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_logistics_partner`
--
ALTER TABLE `tbl_logistics_partner`
  ADD PRIMARY KEY (`logistic_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tbl_order_detail_items`
--
ALTER TABLE `tbl_order_detail_items`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_header_items`
--
ALTER TABLE `tbl_order_header_items`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_process`
--
ALTER TABLE `tbl_order_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_comments`
--
ALTER TABLE `tbl_product_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_refund_reason`
--
ALTER TABLE `tbl_refund_reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `tbl_reply_comment`
--
ALTER TABLE `tbl_reply_comment`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart_items`
--
ALTER TABLE `tbl_cart_items`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_logistics_partner`
--
ALTER TABLE `tbl_logistics_partner`
  MODIFY `logistic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order_detail_items`
--
ALTER TABLE `tbl_order_detail_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order_header_items`
--
ALTER TABLE `tbl_order_header_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order_process`
--
ALTER TABLE `tbl_order_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_product_comments`
--
ALTER TABLE `tbl_product_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_refund_reason`
--
ALTER TABLE `tbl_refund_reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_reply_comment`
--
ALTER TABLE `tbl_reply_comment`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
