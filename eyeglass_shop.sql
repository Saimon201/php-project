-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2026 at 12:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyeglass_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `payment_slip` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `address`, `phone`, `payment_slip`, `quantity`, `price`, `image`, `created_at`, `status`) VALUES
(33, 'Kyaw Zawl Hein', 'Yangon', '+95 9681049950', 'payment_slip.jpg', 1, 45000, '1790760361_11.jpg', '2026-10-02 09:41:41', 'Done'),
(34, 'Kyaw Zawl Hein', 'Yangon', '+95 9681049950', 'payment_slip.jpg', 1, 56000, '1790825125_5.jpg', '2026-10-02 09:41:41', 'Pending'),
(35, 'Htet Aung', 'Yangon, Bahan', '+959 251039085', 'payment_slip.jpg', 1, 39000, '1790825345_7.jpg', '2026-10-02 09:50:35', 'Done'),
(36, 'Chit Lin Ko', 'Yangon', '+959 897032207', 'payment_slip.jpg', 2, 52000, '1790825004_8.jpg', '2026-10-02 09:53:33', 'Pending'),
(37, 'Chit Lin Ko', 'Yangon', '+959 897032207', 'payment_slip.jpg', 1, 48000, '1790825197_4.jpg', '2026-10-02 09:53:33', 'Pending'),
(38, 'Chit Lin Ko', 'Yangon', '+959 897032207', 'payment_slip.jpg', 1, 56000, '1790825063_10.jpg', '2026-10-02 09:53:33', 'Pending'),
(39, 'Ko Phone', 'Pyay', '+959 253592919', 'payment_slip.jpg', 1, 78000, '1790825403_12.jpg', '2026-10-02 10:02:02', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `bestseller` tinyint(1) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `price`, `stock`, `bestseller`, `image`, `created_at`) VALUES
(30, 'clearglass', 45000.00, 8, 0, '1790760361_11.jpg', '2026-09-30 09:26:01'),
(31, 'sunglass', 45000.00, 0, 1, '1790824915_6.jpg', '2026-10-01 03:21:55'),
(34, 'bluelight', 52000.00, 7, 1, '1790825004_8.jpg', '2026-10-01 03:23:24'),
(35, 'bluelight', 43000.00, 18, 0, '1790825039_9.jpg', '2026-10-01 03:23:59'),
(36, 'bluelight', 56000.00, 11, 1, '1790825063_10.jpg', '2026-10-01 03:24:23'),
(37, 'sunglass', 56000.00, 5, 1, '1790825125_5.jpg', '2026-10-01 03:25:25'),
(38, 'sunglass', 48000.00, 11, 1, '1790825197_4.jpg', '2026-10-01 03:26:37'),
(40, 'bluelight', 39000.00, 15, 1, '1790825345_7.jpg', '2026-10-01 03:29:05'),
(41, 'clearglass', 78000.00, 12, 1, '1790825403_12.jpg', '2026-10-01 03:30:03'),
(42, 'clearglass', 54000.00, 13, 0, '1790825429_13.jpg', '2026-10-01 03:30:29'),
(44, 'clearglass', 78000.00, 3, 1, '1790825499_14.jpg', '2026-10-01 03:31:39'),
(45, 'clearglass', 66000.00, 10, 1, '1790825547_15.jpg', '2026-10-01 03:32:27'),
(46, 'clearglass', 70000.00, 12, 0, '1790825598_16.jpg', '2026-10-01 03:33:18'),
(47, 'clearglass', 50000.00, 16, 0, '1790825624_17.jpg', '2026-10-01 03:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(13, 'Kyaw Zawl Hein', 'kyawzawlhein@gmail.com', '$2y$10$UKCcQENmCWPlqVMoxaaP/.mmfDVkCtm1P4QNdMGHy6wJ2HZTuao0y', 'user', '2026-10-02 09:35:02'),
(16, 'Htet Aung', 'htetaung@gmail.com', '$2y$10$aAmji1zGQ6BU0bfFSNuQzOS6q/B5nnaJeLtZE4A3SW7tq24TYhvr2', 'user', '2026-10-02 09:47:42'),
(17, 'Chit Lin Ko', 'chitlinko@gmail.com', '$2y$10$IWbO2imlWHtryj8vieL37.DupMlFLsoKXJZs6ODDuSj5bXepDCE6K', 'user', '2026-10-02 09:51:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
