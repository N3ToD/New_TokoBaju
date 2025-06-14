-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 07:16 AM
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `address`, `phone`, `total_amount`, `order_date`, `status`) VALUES
(1, 1, 'Muhammad Naufal Rizqullah', 'jl.manggis 1 Rt/rw 12/05 no.45A', '085967194310', 9000000.00, '2025-06-14 03:39:37', 'Pending'),
(2, 1, 'Muhammad Naufal Rizqullah', 'jl.manggis 1 Rt/rw 12/05 no.45A', '085967194310', 5400000.00, '2025-06-14 03:39:50', 'Pending'),
(3, 1, 'Muhammad Naufal Rizqullah', 'jl.manggis 1 Rt/rw 12/05 no.45A', '085967194310', 12600000.00, '2025-06-14 04:56:24', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`) VALUES
(1, 1, 1, 'PUMA x HARRY POTTER Palermo Sneakers', 1800000.00, 5),
(2, 2, 1, 'PUMA x HARRY POTTER Palermo Sneakers', 1800000.00, 3),
(3, 3, 1, 'PUMA x HARRY POTTER Palermo Sneakers', 1800000.00, 7);

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
  `stock` int(11) NOT NULL DEFAULT 10,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `stock`, `category`) VALUES
(1, 'PUMA x HARRY POTTER Palermo Sneakers', 'Add some magic to your look with PUMA x HARRY POTTER. This new collab is a mashup of Quidditch™ and football aesthetics...', 1800000.00, 'assets/img/featured/puma1.avif', 18, 'Shoes'),
(2, 'PUMA x HARRY POTTER T7 Track Pants', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 899000.00, 'assets/img/featured/puma2.avif', 20, 'Pants'),
(3, 'PUMA x HARRY POTTER Relaxed Hoodie', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 1299000.00, 'assets/img/featured/puma3.avif', 12, 'Clothes'),
(4, 'PUMA x HARRY POTTER Relaxed Jersey', 'This new collab is a mashup of Quidditch™ and football aesthetics, reinterpreting Gryffindor™ and Slytherin™ team uniforms with classic streetwear and terrace cues. Football shirts, T7 track suits, and other essentials feature Hogwarts™-inspired details and a Golden Snitch™ embroidered on each piece. Rounded off with classic kicks like Palermo and Easy Rider, this collection is serving spellbinding style, whether you live in the Muggle™ world or the wizarding world.', 1299000.00, 'assets/img/featured/puma4.avif', 18, 'Clothes'),
(5, 'Roma 68 Revival Sneakers', 'Born in 1968, the PUMA Roma was originally created to celebrate the Italian Euro Cup win – and become a sport-turned-street sensation overnight. Today, over 50 years later, the Roma is back with its signature sleek look and gum rubber sole. This version features a synthetic upper and a leather Formstrip with stitching details.', 1200000.00, 'assets/img/featured/puma68.avif', 20, 'Shoes'),
(6, 'Nike Vomero 18', 'Maximum cushioning in the Vomero provides a comfortable ride for everyday runs. Most cushioned ride has lightweight ZoomX foam stacked on top of responsive ReactX foam in the midsole. Plus, a redesigned traction pattern offers a smooth heel-to-toe transition.', 2249000.00, 'assets/img/featured/vomero.avif', 15, 'Shoes'),
(7, 'Aerostreet Heritage Low Natural', 'Menggunakan technologi baru Shoes Injection Mould bahan sole dicairkan dengan tekanan tinggi menyatu sempurna dengan bahan kain dari sepatu tanpa menggunakan proses lem.', 179000.00, 'category/produk/sepatu/aerostreetHeri.jpg', 10, 'Shoes'),
(8, 'Aerostreet Austin', 'Menggunakan technologi baru Shoes Injection Mould bahan sole dicairkan dengan tekanan tinggi menyatu sempurna dengan bahan kain dari sepatu tanpa menggunakan proses lem.', 199000.00, 'category/produk/sepatu/AerostreetAustin.jpg', 10, 'Shoes'),
(9, 'Aerostreet Hoops High', 'Menggunakan technologi baru Shoes Injection Mould bahan sole dicairkan dengan tekanan tinggi menyatu sempurna dengan bahan kain dari sepatu tanpa menggunakan proses lem.', 185000.00, 'category/produk/sepatu/AerostreetHoopsHigh.jpg', 10, 'Shoes'),
(10, 'Adidas Adizero Boston 12', 'Sepatu Adizero Boston 12 didesain untuk lari jarak menengah hingga jarak jauh. Sepatu ini menghadirkan nuansa kompetisi lari dalam latihan dengan sensasi propulsif yang berasal dari serat kaca yang dipadukan ENERGYRODS 2.0, yang membatasi hilangnya energi di bagian bawah kaki. Sepatu ini memiliki desain yang cepat, tetapi tidak mengorbankan daya tahannya — bagian midsole memadukan bantalan Lightstrike Pro ultra-ringan dengan LIGHTSTRIKE 2.0 dari material EVA yang awet.', 1855000.00, 'category/produk/sepatu/AdizeroBoston12.jpg', 10, 'Shoes'),
(11, 'Adidas Gazelle', 'Once a training shoe, now a timeless icon, these adidas Gazelle shoes let you walk in the footsteps of history. This pair honours the beloved version from 1991 with a soft and supple suede upper and recognisable rubber outsole. Eye-catching colours lend modern style and pair well with casual outfits or sporty attire.', 1350000.00, 'category/produk/sepatu/Gazelle.jpg', 10, 'Shoes'),
(12, 'Adidas Adicolor Classics T-Shirt', 'Get a casual look with this adidas Adicolor Classics Trefoil logo tee. With a loose fit and boxy shape this tee sports an embroidered Trefoil logo on the front plus a flat rubber print Trefoil logo on the back. Made from soft single jersey cotton this is an essential you can throw on with your favourite jeans or shorts for an effortless everyday look.', 635000.00, 'category/produk/baju/adidasclassic.jpg', 10, 'Clothes'),
(13, 'Adidas Adi Performance Polo Shirt', 'Feel the energy flow as you move in this polo shirt from adidas. Designed for yoga, it has a lightweight yet cosy feel. A colourful graphic on the back speaks to your passion for mindfulness.', 405000.00, 'category/produk/baju/adiperrform.jpg', 10, 'Clothes'),
(14, 'Puma Dealer Golf Pants', 'Keep you playing your best. From drive and lay-up to approach, putt, flop and draw, they\'ll get you into the swing.', 1600000.00, 'category/produk/celana/Dealergolf.avif', 10, 'Pants'),
(15, 'PUMA Flex Trend Woven Pants', 'Dress for performance and look the part with these woven pants. Featuring a tunneled waistband with drawcord for a personalised fit and dryCELL technology to keep you dry.', 905000.00, 'category/produk/celana/PUMATrendWoven.avif', 10, 'Pants'),
(16, 'Adidas Yoga Training Hoodie', 'Feel the energy flow as you move in this hooded sweatshirt from adidas. Designed for yoga, it has a lightweight yet cosy feel. A colourful graphic on the back speaks to your passion for mindfulness.', 880000.00, 'category/produk/baju/adidashoodie.jpg', 10, 'Clothes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'naufal', 'naufalrizqullah@gmail.com', '$2y$10$/ACD5Yz6JD4w.ribJ1pcYeprt9q.Q9EjbtMnEVNWaknYkYCJlnyIG', '2025-06-14 02:28:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
