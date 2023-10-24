-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 12:47 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 12, 2, 'Bakso', 8, 1, 'bakso.jpg'),
(2, 12, 6, 'Rendang', 13, 1, 'rendang.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `deskripsi` varchar(800) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `deskripsi`, `price`, `image`) VALUES
(1, 'Ayam Goreng', 'Fast Food', 'Ayam goreng krispi dengan bumbu khas Indonesia', 11, 'ayam_goreng.jpg'),
(2, 'Bakso', 'Fast Food', 'Bakso kuah dengan mie dan daging sapi', 8, 'bakso.jpg'),
(3, 'Nasi Goreng', 'Fast Food', 'Nasi goreng dengan telur, ayam, dan bumbu pedas', 9, 'nasi_goreng.jpg'),
(4, 'Mie Goreng', 'Fast Food', 'Mie goreng dengan campuran sayuran dan telur', 7, 'mie_goreng.jpg'),
(5, 'Sate Ayam', 'Fast Food', 'Sate ayam dengan saus kacang dan nasi', 9, 'sate_ayam.jpg'),
(6, 'Rendang', 'Hidangan Utama', 'Rendang daging sapi dengan rempah-rempah khas', 13, 'rendang.jpg'),
(7, 'Gado-Gado', 'Hidangan Utama', 'Gado-gado dengan sayuran, tahu, dan lontong', 10, 'gado_gado.jpg'),
(8, 'Nasi Padang', 'Hidangan Utama', 'Nasi dengan berbagai hidangan Padang', 13, 'nasi_padang.jpg'),
(9, 'Soto Ayam', 'Hidangan Utama', 'Soto ayam dengan kuah kuning dan mie', 9, 'soto_ayam.jpg'),
(10, 'Nasi Kuning', 'Hidangan Utama', 'Nasi kuning dengan lauk-pauk beraneka ragam', 10, 'nasi_kuning.jpg'),
(11, 'Es Teh Manis', 'Minuman', 'Es teh manis dengan es batu', 2, 'es_teh_manis.jpg'),
(12, 'Es Jeruk', 'Minuman', 'Es jeruk segar dengan potongan jeruk', 3, 'es_jeruk.jpg'),
(13, 'Kopi Tubruk', 'Minuman', 'Kopi khas Indonesia dengan gula merah', 3, 'kopi_tubruk.jpg'),
(14, 'Es Kelapa Muda', 'Minuman', 'Es kelapa muda segar dengan daging kelapa', 5, 'es_kelapa_muda.jpg'),
(15, 'Cendol', 'Minuman', 'Minuman tradisional dengan santan dan gula merah', 5, 'cendol.jpg'),
(16, 'Klepon', 'Dessert', 'Klepon dengan isian gula merah dan parutan kelapa', 4, 'klepon.jpg'),
(17, 'Es Campur', 'Dessert', 'Es campur dengan berbagai macam bahan', 4, 'es_campur.jpg'),
(18, 'Dadar Gulung', 'Dessert', 'Dadar gulung dengan selai kacang hijau', 3, 'dadargulung.jpg'),
(19, 'Kue Lumpur', 'Dessert', 'Kue lumpur dengan aroma pandan', 3, 'kuelumpur.jpg'),
(20, 'Es Pisang Ijo', 'Dessert', 'Es pisang ijo dengan sirup hijau', 5, 'es_pisang_ijo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'saint', 'saintcs44@gmail.com', '0812924525', '4d4ccdd9e0be83fd5af04353b9166f3cf835c0c5', 'asdad, dasdas, asda, asdas, asda, 123123');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
