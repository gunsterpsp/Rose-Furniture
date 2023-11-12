-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 05:27 PM
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
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_detail_items`
--

INSERT INTO `tbl_order_detail_items` (`order_id`, `product_code`, `product_name`, `price`, `quantity`, `payment_method`, `user_id`, `detail_code`, `date_cancelled`, `status`, `to_pay`, `to_ship`, `to_pickup`, `in_transit`, `to_deliver`, `cart_id`, `to_complete`, `group_code`, `rider_id`, `refund_status`, `date_completed`, `rider_refund_id`, `date_created`) VALUES
(1, 'rfHTqRxIkf', 'Whitfield Leather Ottoman', '5999', '1', 'Cash On Delivery', 2, '687d9de084043f1f3cc4', '2023-11-09 23:02:38', 1, 2, 2, 1, 0, 0, 1, 0, NULL, NULL, 0, NULL, NULL, '2023-11-09 15:07:08'),
(2, 'YQGw2OH0CE', 'Monarch Rectangular Dining Set', '6449', '1', 'Cash On Delivery', 2, '26be269e7766d2ac8df5', '2023-11-09 23:03:32', 1, 2, 1, 0, 0, 0, 2, 0, NULL, NULL, 0, NULL, NULL, '2023-11-09 15:07:08'),
(3, 'P9DGVbTZKo', 'Passages Vintage Dressers', '5699', '2', 'Cash On Delivery', 2, '009bbda272e02b59015c', '2023-11-09 23:04:15', 1, 2, 1, 0, 0, 0, 3, 0, NULL, NULL, 0, NULL, NULL, '2023-11-09 15:07:08'),
(4, 'wF4HSy89iy', 'Adjustable Advanced Italian Sofas', '10999', '3', 'Cash On Delivery', 2, '892a661acdb3e9da1764', '2023-11-12 02:41:56', 1, 2, 1, 0, 0, 0, 5, 0, NULL, NULL, 0, NULL, NULL, '2023-11-11 18:41:56'),
(5, '5rvYkjRRmI', 'Pendelton 47 Media Console', '2299', '4', 'Cash On Delivery', 2, '64eb6c4846ea4fb59d67', '2023-11-12 02:41:56', 1, 2, 1, 0, 0, 0, 4, 0, NULL, NULL, 0, NULL, NULL, '2023-11-11 18:41:56'),
(6, 'P9DGVbTZKo', 'Passages Vintage Dressers', '5699', '2', 'Cash On Delivery', 2, 'a64267b594cacb565470', '2023-11-12 02:42:50', 1, 2, 1, 0, 0, 0, 7, 0, NULL, NULL, 0, NULL, NULL, '2023-11-11 18:42:50'),
(7, 'rfHTqRxIkf', 'Whitfield Leather Ottoman', '5999', '1', 'Cash On Delivery', 2, '5580e5cfa3863dd64347', '2023-11-12 03:36:28', 1, 2, 1, 0, 0, 0, 6, 0, NULL, NULL, 0, NULL, NULL, '2023-11-11 19:36:28'),
(8, '6NLze6PL8V', 'Wooden Kitchen Table', '1999', '4', 'Cash On Delivery', 2, 'e5cb6b7673b41a9a8a78', '2023-11-12 03:41:21', 1, 2, 1, 0, 0, 0, 10, 0, NULL, NULL, 0, NULL, NULL, '2023-11-11 19:41:21'),
(9, 'LC1KVkpc52', 'Geoffrey Alexander Chair', '999', '4', 'Cash On Delivery', 2, 'ad4ed87cafdcc2d897dc', '2023-11-12 03:41:21', 1, 2, 2, 2, 2, 2, 11, 2, 3, '3', 1, '2023-11-12 21:59:00', NULL, '2023-11-11 19:41:21'),
(10, 'P9DGVbTZKo', 'Passages Vintage Dressers', '5699', '2', 'Cash On Delivery', 2, '0c31ba2814697ce7e3fc', '2023-11-12 03:41:21', 1, 2, 2, 2, 2, 2, 8, 2, 3, '3', 7, '2023-11-12 04:02:32', 4, '2023-11-11 19:41:21'),
(11, '5rvYkjRRmI', 'Pendelton 47 Media Console', '2299', '3', 'Cash On Delivery', 2, '49050b8ba1b791c1c614', '2023-11-12 03:43:00', 1, 2, 2, 2, 2, 2, 9, 2, 3, '3', 7, '2023-11-12 04:00:52', 4, '2023-11-11 19:43:00');

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
  `product_status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_name`, `product_price`, `product_quantity`, `product_category`, `product_description`, `product_image`, `product_status`) VALUES
(1, '6NLze6PL8V', 'Wooden Kitchen Table', '1999', '546', 'Tables', 'Everlasting quality made with nara tree', '6NLze6PL8V_table.jpeg', '1'),
(2, 'xLkqKxNfQ0', 'Silver Sofa Set', '3999', '1000', 'Sofas', 'Cotton sofa set with pillows', 'xLkqKxNfQ0_sofa.jpg', '1'),
(3, 'LC1KVkpc52', 'Geoffrey Alexander Chair', '999', '688', 'Chairs', 'Width (side to side): 32\" W\r\nDepth (front to back): 34.5\" D\r\nHeight (bottom to top): 33\" H\r\nSeat Width: 23\"\r\nSeat Depth: 22\"\r\nSeat Height: 18\"\r\nArm Height: 24\"', 'LC1KVkpc52_chairs.jpg', '1'),
(4, 'cJzVTZybiy', 'Hillsdale Metal Bed', '7999', '152', 'Beds', 'Width (side to side): 60\" W\r\nDepth (front to back): 83.5\" D\r\nHeight (bottom to top): 52\" H', 'cJzVTZybiy_OIP.jpg', '1'),
(5, 'bX1IhdEm1X', 'Barnwood Computer Desk', '2499', '545', 'Desks', 'The \"Diana\" Barnwood corner desk with twin framed drawers. Main section measures 80″W x 24″D and return section is 56″W x 24″D, giving it an overall dimension of 80″ x 80″. The 1-1/2″ top sits on steel legs and an industrial welded framework. All of the drawer boxes are dovetailed solid wood and feature soft-close Blum undermount slides for the smoothest action. The legs are 3″ x 3″ welded steel with an antique blackened finish. Adjustable leg levelers included.', 'bX1IhdEm1X_OIP (1).jpg', '1'),
(6, 'NTXq2ol16K', 'Serta Luxe Chamblee 12.5\"', '2769', '323', 'Mattreses', 'Height : 13.5 Inches\r\nLength : 75 Inches\r\nWeight : 59 Pounds\r\nWidth : 54 Inches', 'NTXq2ol16K_OIP (2).jpg', '1'),
(7, 'P9DGVbTZKo', 'Passages Vintage Dressers', '5699', '4426', 'Dressers', 'Dresser : 66\"W x 18\"D x 40.5\"H - 155lbs.\r\nTop Drawer Dimensions : 25\"W x 12.4\"D x 4.5\"H\r\nMiddle 3 Drawer Dimensions : 13\"W x 12.4\"D x 7\"H\r\nLeg Height : 2.24\"\r\nOptional Mirror : 46\"W x 3.8\"D x 40\"H - 21lbs.', 'P9DGVbTZKo_ren-b921-70-2_ren20231.jpg', '1'),
(8, 'rfHTqRxIkf', 'Whitfield Leather Ottoman', '5999', '1228', 'Ottomans', 'Brand: Thomasville\r\nCondition: Fair\r\nItem ID: 77066\r\nDimensions: 30\" W x 18\" H x 24\" D', 'rfHTqRxIkf_OIP (3).jpg', '1'),
(9, 'YQGw2OH0CE', 'Monarch Rectangular Dining Set', '6449', '438', 'Dining Tables', 'Table, Drop Leaf Down: 48-1/4\"W x 36\"D x 30-1/4\"H\r\nTable, Drop Leaf Up: 66\"W x 36\"D x 30-1/4\"H\r\nChair: 20-3/4\"W x 17-3/4\"D x 38\"H', 'YQGw2OH0CE_home_styles_hs-5020-308-s3.jpg', '1'),
(10, 'wF4HSy89iy', 'Adjustable Advanced Italian Sofas', '10999', '273', 'Sectional', 'Width: 88\"\nDepth: 43\"\nHeight: 26\"', 'wF4HSy89iy_OIP (4).jpg', '1'),
(11, '5rvYkjRRmI', 'Pendelton 47 Media Console', '2295', '600', 'TV Stands', 'Overall\n26\' H X 47\' W X 15\' D\nOverall Product Weight\n85 lb', 'w0gAspKvn0_OIP (5).jpg', '1');

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
(1, 'Oliver', 'Dela Fuente', 'Obeses St. Pandacan, Manila', '09637710968', 'gunsterpsp', '123', 'gunsterpsp@gmail.com', 1, 1),
(2, 'Rose Marie', 'Del Valle', 'Antique', '09238848230', 'rose', '123', 'rosemarie@gmail.com', 2, 1),
(3, 'Vincent', 'De Guzman', 'Makati', '09218832482', 'vincent', '123', 'vincent@gmail.com', 3, 1),
(4, 'Ronaldo', 'Santiago', 'Pasig', '09514420329', 'ronaldo', '123', 'ronaldo@gmail.com', 3, 1),
(5, 'Deserie', 'Salve', 'bobocap', '09321230054', 'deserie', '123', 'deserie@gmail.com', 2, 1),
(6, 'Oliver', 'Dela Fuente', 'Manila', '09838289302', 'oliver123', '123', 'oliver@gmail.com', 2, 1);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_detail_items`
--
ALTER TABLE `tbl_order_detail_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
