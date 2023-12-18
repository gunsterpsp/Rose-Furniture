-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 09:41 AM
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
-- Table structure for table `tbl_group_code`
--

CREATE TABLE `tbl_group_code` (
  `group_code` int(11) NOT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_group_code`
--

INSERT INTO `tbl_group_code` (`group_code`, `group_name`, `status`) VALUES
(1, 'Admin', 1),
(2, 'User', 1),
(3, 'Courier', 1),
(4, 'Inventory Clerk', 1),
(5, 'Manager', 1);

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
  `refund_status` int(11) DEFAULT 0,
  `date_completed` varchar(100) DEFAULT NULL,
  `rider_refund_id` int(11) DEFAULT NULL,
  `product_mode` int(11) DEFAULT NULL,
  `logistic_id` int(11) DEFAULT 0,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `supplier_id` int(11) DEFAULT NULL,
  `product_status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_name`, `product_price`, `product_quantity`, `product_category`, `product_description`, `product_image`, `supplier_id`, `product_status`) VALUES
(1, '9OS0ngcKiA', 'Falbion 2 seater & 1 Seater Sofa Set', '51995', '295', 'Sofas', '600DS-2 SUMMER BEIGE; OTTER GRAY; MOCCA BROWN; 600DS-3 SAND STONE; 600DS-5 ALMOND BROWN; 600DS-6 LIGHT GRAY; 600DS-7 TITANIUM GRAY; 600DS-5 ALMOND BROWN', '9OS0ngcKiA_sss.jpg', 1, '1'),
(2, 'F0Q8VNIrOC', 'Customizable Rectangular Counter Height Table', '23000', '394', 'Tables', 'Counter height tables make dining more casual and relaxed, and with Canadel you can choose your size for a perfect fit. What shape is your room? How many people would you like to seat? Formal or casual? With over 30 sizes up to 108” in length', 'F0Q8VNIrOC_table.jpg', 1, '1');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `supplier_address` varchar(100) DEFAULT NULL,
  `supplier_contact` varchar(100) DEFAULT NULL,
  `supplier_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`, `supplier_status`) VALUES
(1, 'D&G Appliance', 'Makati City', '09782737232', 1),
(2, 'MegaWorld', 'Manila City', '09323192382', 1),
(3, 'iFurniture Expo', 'Taguig City', '09455668154', 1),
(4, 'Uratext Foam', 'Iligan City', '09251547887', 1),
(5, 'Mandaue Foam', 'Dagupan City', '09556448156', 1),
(6, 'MegaBitz Appliances', 'Tarlac City', '09323195859', 1);

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
  `logistic_id` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `address`, `contact_no`, `username`, `password`, `email`, `group_code`, `logistic_id`, `status`) VALUES
(1, 'Oliver', 'Dela Fuente', 'Obeses St. Pandacan, Manila', '09637710968', 'gunsterpsp', '123', 'gunsterpsp@gmail.com', 1, 0, 1),
(2, 'manager', 'manager', 'Antique', '09238848230', 'manager', '123', 'rosemarie@gmail.com', 5, 0, 1),
(3, 'inventory', 'clerk', 'Makati', '09218832482', 'inv', '123', 'vincent@gmail.com', 4, 0, 1),
(4, 'JNT Express', 'Makati', 'Pasig', '09514420329', 'ronaldo', '123', 'ronaldo@gmail.com', 3, 1, 1),
(5, 'Deserie', 'Salve', 'Muntinlupa City', '09321230054', 'deserie', '123', 'deserie@gmail.com', 2, 0, 1),
(6, 'Oliver', 'Dela Fuente', 'Manila', '09838289302', 'oliver123', '123', 'oliver@gmail.com', 2, 0, 1),
(7, 'Rose Marie', 'Del Valle', 'Makati City', '09323892323', 'rose', '123', 'manager@gmail.com', 2, 0, 1),
(8, 'LBC Express', 'Manila', 'Tondo, Manila', '093727367127', 'aldrin', '1234', 'aldrinsilvestre@gmail.com', 3, 2, 1);

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
-- Indexes for table `tbl_group_code`
--
ALTER TABLE `tbl_group_code`
  ADD PRIMARY KEY (`group_code`);

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
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_group_code`
--
ALTER TABLE `tbl_group_code`
  MODIFY `group_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_logistics_partner`
--
ALTER TABLE `tbl_logistics_partner`
  MODIFY `logistic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_detail_items`
--
ALTER TABLE `tbl_order_detail_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_header_items`
--
ALTER TABLE `tbl_order_header_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_process`
--
ALTER TABLE `tbl_order_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product_comments`
--
ALTER TABLE `tbl_product_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_refund_reason`
--
ALTER TABLE `tbl_refund_reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reply_comment`
--
ALTER TABLE `tbl_reply_comment`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
