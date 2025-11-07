-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 03:41 AM
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
-- Database: `axis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `region`, `province`, `city`, `barangay`, `postal`, `street`) VALUES
(1, 3, NULL, 'bulacan', 'malolos', 'mojon', '3000', 'casa isabelo'),
(2, 1, NULL, 'test', 'test', 'test', 'test', '1'),
(3, 6, NULL, 'test', 'test', 'test', '3000', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` enum('S','M','L','XL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `address_id` int(11) NOT NULL,
  `status` enum('pending','to_ship','delivered','cancelled') NOT NULL,
  `payment_status` enum('pending','under review','approved','rejected') NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `payment_reference` int(100) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `address_id`, `status`, `payment_status`, `payment_proof`, `payment_reference`, `created_at`) VALUES
(1, 3, 2124240.96, 1, 'cancelled', 'pending', '', 0, '2025-11-04'),
(2, 3, 21599.02, 1, 'cancelled', 'pending', '', 0, '2025-11-05'),
(3, 3, 108604.26, 1, 'cancelled', 'pending', '1762387491_tshirt P.jpg', 0, '2025-11-06'),
(4, 3, 2054185.00, 1, 'to_ship', 'approved', '1762389691_tsinelas na pekpek.jpeg', 123343, '2025-11-06'),
(5, 3, 679884.72, 1, 'cancelled', 'rejected', '1762396419_paa_ni_goten.png', 434245, '2025-11-06'),
(6, 6, 645601.00, 3, 'to_ship', 'approved', '1762396506_paa_ni_goten.png', 345242, '2025-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `size` varchar(5) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `price`) VALUES
(1, 1, '12', '0', 48456.94),
(2, 1, '13', '0', 21599.02),
(3, 1, '4', '0', 2054185),
(4, 2, '13', 'L', 21599.02),
(5, 3, '14', 'L', 49488.32),
(6, 3, '26', 'S', 59115.94),
(7, 4, '4', 'L', 2054185),
(8, 5, '3', 'XL', 645601),
(9, 5, '23', 'M', 34283.72),
(10, 6, '3', 'L', 645601);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `category` enum('men','women') DEFAULT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  `extra_large` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `small`, `medium`, `large`, `extra_large`, `image`) VALUES
(3, 'carhartt x stussy detroit jacket', 645601, '', 1, 1, 0, 0, 'CARHARTT_X_STUSSY_DETROIT_JACKET.png'),
(4, 'chrome hearts cow print pony hair leather bomber jacket', 2054185, '', 0, 1, 1, 1, 'CHROME_HEARTS_COW_PRINT_PONY_HAIR_LEATHER_BOMBER_JACKET.png'),
(5, 'north face fall 1987 gore dryloft summit parka black', 52821, '', 1, 0, 2, 1, 'NORTH_FACE_VINTAGE_FALL_1997_GORE_DRYLOFT_SUMMIT_PARKA_BLACK.png'),
(6, 'nwt polo ralph lauren tokyo stadium jacket', 102709, '', 0, 1, 1, 3, 'NWT_POLO_RALPH_LAUREN_TOKYO_STADIUM_JACKET.png'),
(7, 'TSINELAS NI LENG', 3250, '', 22, 21, 30, 5, 'tsinelas_ni_leng.png'),
(8, 'nirambo ni dey', 320, '', 32, 27, 18, 100, 'rambo.png'),
(9, 'ekek slippers ni goten', 666.29, '', 7, 7, 6, 5, 'tsinelas na pekpek.jpeg'),
(11, 'stussy 8 ball hoodie', 5810.61, '', 2, 1, 4, 3, 'STUSSY_8_BALL_HOODIE_BLACK.png'),
(12, 'supreme new york yankees track jacket', 48456.94, 'men', 0, 1, 1, 1, 'SUPREME_NEW_YORK_YANKEES_TRACK_JACKET.png'),
(13, 'supreme bounty hunter ma-1 jacket', 21599.02, 'men', 1, 0, 0, 1, 'SUPREME_x_BOUNTY_HUNTER__MA_1_JACKET.png'),
(14, 'nike x ohtani kanji jersey 2025', 49488.32, '', 4, 2, 0, 0, 'Y-removebg-preview.png'),
(15, 'chrome hearts horseshoe floral cross zip up hoodie', 106960.51, 'men', 1, 1, 3, 1, 'W-removebg-preview.png'),
(16, 'adidas x bad bunny x mercedes-f1 racing jacket', 80601.97, '', 2, 2, 1, 4, 'U-removebg-preview.png'),
(17, 'supreme mm6 maison margiela zipup hoodie', 103144.69, '', 3, 1, 0, 1, 'T-removebg-preview.png'),
(18, 'sp5der p*nk hoodie', 89466.42, '', 1, 1, 1, 1, 'R-removebg-preview.png'),
(19, 'cactus jack skeleton graffiti full zipup hoodie', 15850.35, 'men', 3, 2, 5, 2, 'Q-removebg-preview.png'),
(20, 'supreme y\'s yohji yamamoto leather jacket', 116235.9, 'men', 1, 1, 0, 2, 'I-removebg-preview.png'),
(21, 'fc barcelona x travis scott limited edition', 53128.03, 'men', 1, 0, 1, 1, 'E-removebg-preview.png'),
(22, 'the north face nuptse short jacket', 29704.73, 'women', 3, 1, 4, 3, '1-removebg-preview.png'),
(23, 'balenciaga oversized logo hoodie', 34283.72, 'women', 5, 1, 0, 3, '2-removebg-preview.png'),
(24, 'skims x tnf 2000 retro nuptse jacket', 43911.34, 'women', 0, 0, 7, 0, '3-removebg-preview.png'),
(25, 'louis vuitton flocked lv t-shirt', 111715.62, 'women', 2, 1, 0, 3, '4-removebg-preview.png'),
(26, 'bottega veneta asymmetrical v-neck sweater dress', 59115.94, 'women', 2, 1, 1, 0, '5-removebg-preview.png'),
(27, 'gucci geo printed fur coat', 281549.18, 'women', 1, 3, 1, 4, '6-removebg-preview.png'),
(28, 'prada embellished knitted virgin wool t-shirt', 149697.75, 'women', 1, 1, 0, 0, '7-removebg-preview.png'),
(29, 'bape x sanrio baby milo full zip hoodie', 50662.42, 'women', 1, 1, 1, 1, '8-removebg-preview.png'),
(30, 'miu miu denim cropped jacket', 144062.07, 'women', 0, 1, 1, 2, '9-removebg-preview.png'),
(31, 'jordan x cactus jack leather jacket', 29293.8, 'women', 0, 2, 0, 1, '10-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` enum('offline','online') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `firstname`, `lastname`, `contact`, `role`, `status`) VALUES
(1, 'admin@example.com', 'admin', '$2y$10$laLl9npxbp34up4MWvUrmOmRekFI3w8pTZk5Yu2zsh5w560mIXDyS', 'admin', '1', '09111111111', 'admin', 'offline'),
(2, 'aundrei@example.com', 'aundrei123', '$2y$10$c6o3s9f87aTOqPG7KMFA6OjdpqfpnEhFWYZq5YA9LTGYmBZE80hsu', 'Aundrei', 'Magaling', NULL, 'user', 'offline'),
(3, 'kendrick@zion.com', 'aklo', '$2y$10$5In1hbgI17k8WjTeyjIITOZNGZYnL1UaArGwoRXAt1N9sV55SiZDm', 'Kendrick Zion', 'Oliveros', '09123123213', 'user', 'offline'),
(4, 'dsa@gasm.com', 'mmmmmmsa', '$2y$10$peaN7NZ2L5gkPDd8RQGh5ewyDABF2CWmftX1vpfxUcea/PF4Kkn1y', 'dan', 'haha', NULL, 'user', 'offline'),
(5, 'asdasd@asd.com', 'fsa', '$2y$10$FP2xls0T7AKtXeKn.EMouuaAOTqFxMyU3EFzaTIppC.HBMEBnStE2', '123', 'jayjay', NULL, 'user', 'offline'),
(6, 'test@test.com', 'kord', '$2y$10$y6Vnu.NwGurEwZ5VI9QFh.dMQ79Ks1ptAUEUIMxTufBZfjX6gWjwW', 'testing', 'test', NULL, 'user', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
