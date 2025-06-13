-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 09:03 PM
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
-- Database: `toko_baju_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `stock`) VALUES
(1, 'PUMA x HARRY POTTER Palermo Sneakers', 'Add some magic to your look with PUMA x HARRY POTTER. This new collab is a mashup of Quidditch™ and football aesthetics...', 1800000.00, 'assets/img/featured/puma1.avif', 15),
(2, 'PUMA x HARRY POTTER T7 Track Pants', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 899000.00, 'assets/img/featured/puma2.avif', 20),
(3, 'PUMA x HARRY POTTER Relaxed Hoodie', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 1299000.00, 'assets/img/featured/puma3.avif', 12),
(4, 'PUMA x HARRY POTTER Relaxed Jersey', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 1299000.00, 'assets/img/featured/puma4.avif', 18),
(5, 'Roma 68 Revival Sneakers', 'Born in 1968, the PUMA Roma was originally created to celebrate the Italian Euro Cup win – and become a sport-turned-street sensation overnight. Today, over 50 years later, the Roma is back with its signature sleek look and gum rubber sole. This version features a synthetic upper and a leather Formstrip with stitching details.', 1200000.00, 'assets/img/featured/puma68.avif', 20),
(6, 'Nike Vomero 18', 'Maximum cushioning in the Vomero provides a comfortable ride for everyday runs. Most cushioned ride has lightweight ZoomX foam stacked on top of responsive ReactX foam in the midsole. Plus, a redesigned traction pattern offers a smooth heel-to-toe transition.', 2249000.00, 'assets/img/featured/vomero.avif', 15);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
