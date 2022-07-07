-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 03:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blanjoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `harga_ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `harga_ongkir`) VALUES
(1, 'Jakarta', 23000),
(2, 'Surabaya', 12000),
(3, 'Solo', 21000),
(4, 'Jogja', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) DEFAULT NULL,
  `category_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`, `category_image`) VALUES
(26, 'Laptop', 'kategori1656566555.png'),
(27, 'Handphone', 'kategori1656566565.png'),
(28, 'Earphone', 'kategori1656566584.png'),
(29, 'Smartwatch', 'kategori1656566594.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `merk_id` int(11) NOT NULL,
  `merk_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`merk_id`, `merk_name`) VALUES
(3, 'Apple'),
(4, 'Asus'),
(5, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `merk_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `merk_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `date_created`) VALUES
(48, 27, 3, 'Iphone XR', 6700000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI APPLE 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%<br>- Second Inter Face ID OFF<br><br>Kapasitas:</p><ul><li>256GB</li><li>128GB</li><li>64GB</li></ul>', 'produk1656567777.webp', 1, '2022-06-30 05:42:57'),
(49, 27, 3, 'iPhone 13', 19870000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI APPLE 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%<br>- Second Inter Face ID OFF<br><br>Kapasitas:</p><ul><li>256GB</li><li>128GB</li><li>64GB</li></ul>', 'produk1656567811.webp', 1, '2022-06-30 05:43:31'),
(50, 26, 3, 'Macbook Air 2021', 16700000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI APPLE 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%<br>- Second Inter Face ID OFF<br><br>Kapasitas:</p><ul><li>256GB</li><li>128GB</li><li>64GB</li></ul>', 'produk1656567835.jpg', 1, '2022-06-30 05:43:55'),
(51, 26, 4, 'Asus ROG', 25000000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI ASUS1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%</p>', 'produk1656567869.jpg', 1, '2022-06-30 05:44:29'),
(52, 28, 3, 'Airpod Pro 2021', 1500000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI APPLE 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%</p>', 'produk1656567936.jpg', 1, '2022-06-30 05:45:36'),
(53, 27, 5, 'Samsung S22', 16400000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI SAMSUNG 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%<br>- Second Inter Face ID OFF<br><br>Kapasitas:</p><ul><li>256GB</li><li>128GB</li><li>64GB</li></ul>', 'produk1656567991.webp', 1, '2022-06-30 05:46:31'),
(54, 27, 5, 'Samsung M21', 1100000, '<p>Tersedia Varian :<br>- BNIB SEGEL RESMI GARANSI RESMI SAMSUNG 1 TAHUN<br>- SECOND LIKE NEW SECOND FULLSET MULUS 95%<br>- Second Inter Face ID OFF<br><br>Kapasitas:</p><ul><li>64GB</li><li>16GB</li><li>8GB</li></ul>', 'produk1656568041.webp', 1, '2022-06-30 05:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_seller`
--

CREATE TABLE `tb_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `seller_telp` varchar(20) DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `seller_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_seller`
--

INSERT INTO `tb_seller` (`seller_id`, `seller_name`, `username`, `password`, `seller_telp`, `seller_email`, `seller_address`) VALUES
(1, 'Ryan', 'admin', '21232f297a57a5a743894a0e4a801fc3', '087751019186', 'sryan@gmail.com', 'Jl. Pahlawan no.43, Jombang, Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `id_ongkir`, `tanggal_transaksi`, `total_transaksi`) VALUES
(2, 1, 3, '2022-07-04', 14521000),
(3, 2, 3, '2022-07-04', 23421000),
(4, 1, 1, '2022-07-04', 44893000),
(5, 1, 3, '2022-07-04', 1521000),
(6, 3, 2, '2022-07-04', 19882000),
(7, 1, 2, '2022-07-05', 15612000),
(8, 4, 2, '2022-07-05', 4112000),
(9, 4, 1, '2022-07-05', 1123000),
(10, 1, 2, '2022-07-05', 41252000),
(11, 1, 1, '2022-07-05', 16423000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `username`, `password`, `user_email`, `user_address`) VALUES
(1, 'Ryan', 'ryanindrajaya', '202cb962ac59075b964b07152d234b70', 'ryan@example.com', 'Jombang'),
(3, 'Fachrio Indrajaya', 'rioindrjy', 'ac9417d647fb608ebd058179ac87d835', 'rioindrjy@gmail.com', 'Jl. Pahlawan no.43, Jombang, Jawa Timur'),
(4, 'Naila Shakira', 'naila', '202cb962ac59075b964b07152d234b70', 'nailashakira@gmail.com', 'Jl. Grogol no.23');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id_transaksi_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id_transaksi_produk`, `id_transaksi`, `id_product`, `jumlah`) VALUES
(1, 2, 54, 3),
(2, 2, 48, 1),
(3, 2, 52, 3),
(4, 3, 48, 1),
(5, 3, 50, 1),
(6, 4, 51, 1),
(7, 4, 49, 1),
(8, 5, 52, 1),
(9, 6, 49, 1),
(10, 7, 54, 2),
(11, 7, 48, 2),
(12, 8, 54, 1),
(13, 8, 52, 2),
(14, 9, 54, 1),
(15, 10, 49, 2),
(16, 10, 52, 1),
(17, 11, 53, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `merk_id` (`merk_id`);

--
-- Indexes for table `tb_seller`
--
ALTER TABLE `tb_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id_transaksi_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_seller`
--
ALTER TABLE `tb_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id_transaksi_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`merk_id`) REFERENCES `tb_merk` (`merk_id`),
  ADD CONSTRAINT `tb_product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
