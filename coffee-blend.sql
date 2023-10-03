-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 08:46 AM
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
-- Database: `coffee-blend`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `date` int(50) NOT NULL,
  `time` int(50) NOT NULL,
  `phone` int(50) NOT NULL,
  `message` text NOT NULL,
  `availibility` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_description` varchar(200) NOT NULL,
  `prod_price` float NOT NULL,
  `prod_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_description`, `prod_price`, `prod_image`) VALUES
(2, 'Coconut Mocha', 'A tropical twist on the mocha, combining espresso, rich cocoa, and coconut milk.\r\n', 5.45, 'menu-2'),
(3, 'Espresso Shot\r\n\r\n\r\n', 'A single, strong shot of pure espresso, perfect for those who crave intense coffee flavour.', 3.25, 'menu-1'),
(4, 'Cappuccino Delight\r\n\r\n', 'A classic Italian favourite, featuring equal parts espresso, steamed milk, and frothy milk foam.\r\n', 4.5, 'menu-3'),
(5, 'Mocha Madness\r\n\r\n\r\n', 'A decadent blend of espresso, rich cocoa, and steamed milk, topped with whipped cream.', 3.5, 'menu-4'),
(6, 'Cold Brew Bliss\r\n\r\n\r\n', 'Smooth and refreshing, this cold brew coffee is brewed for hours and served over ice.', 5.25, 'menu-2'),
(7, 'Vanilla Latte\r\n\r\n\r\n', 'Creamy latte with a hint of sweet vanilla syrup, balanced with espresso and steamed milk.', 4.75, 'menu-1'),
(8, 'Iced Caramel Macchiato\r\n\r\n\r\n', 'A delightful combination of iced milk, espresso, and caramel drizzle.', 5, 'menu-3'),
(9, 'Hazelnut Heaven\r\n\r\n\r\n', 'A nutty twist on a latte, featuring hazelnut syrup, espresso, and frothy milk.', 4.75, 'menu-4'),
(10, 'Pumpkin Spice Latte\r\n\r\n\r\n', 'Fall\'s favourite, with espresso, steamed milk, pumpkin spice syrup, and whipped cream.', 3.5, 'menu-2'),
(11, 'Irish Coffee\r\n\r\n\r\n', 'A classic cocktail made with hot coffee, Irish whiskey, sugar, and topped with whipped cream.', 2.72, 'menu-1'),
(12, 'Cinnamon Roll Coffee\r\n\r\n \r\n', 'A comforting blend of cinnamon-infused coffee, frothy milk, and a sprinkle of cinnamon sugar.', 3.25, 'menu-3'),
(13, 'Coconut Mocha\r\n\r\n\r\n', 'A tropical twist on the mocha, combining espresso, rich cocoa, and coconut milk.', 5.45, 'menu-4');

-- --------------------------------------------------------

--
-- Table structure for table `register_user`
--

CREATE TABLE `register_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_user`
--

INSERT INTO `register_user` (`user_id`, `user_name`, `user_email`, `user_password`, `created_at`) VALUES
(2, 'ubaidzada', 'ubaidzada213@gmail.com', '$2y$10$Ma.1nTsgcZAWmEdJHpYhrOS5w981d0U4PRn0jE0YK9MP5wbQsOEMG', '2023-09-30 14:09:34'),
(3, 'Ammad Zada', 'ammad123@gmail.com', '$2y$10$WsAiAadRkAUqANXI7H4TV.q.YPXQIV4U48h9O1rB82UrcSJY2E8Pq', '2023-10-02 05:19:41'),
(4, 'Hurba', 'hurba12@gmail.com', '$2y$10$gzp4yDl0xWUfUCCU50y2q.WDndgO3MfGcYTKTn3FhnbAG6XU/ATCm', '2023-10-02 06:04:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `register_user`
--
ALTER TABLE `register_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `booking` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
