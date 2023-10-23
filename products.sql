-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 07:18 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
