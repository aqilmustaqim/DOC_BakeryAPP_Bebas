-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 07:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakeryapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kas_keluar`
--

CREATE TABLE `kas_keluar` (
  `id` int(11) UNSIGNED NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `nominal` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kas_keluar`
--

INSERT INTO `kas_keluar` (`id`, `keterangan`, `tanggal`, `nominal`) VALUES
(1, 'Gas LPG', '2022-03-26', 20000),
(2, 'Listrik', '2022-03-30', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Roti'),
(2, 'Snacks'),
(3, 'Cakes'),
(4, 'Cookies'),
(5, 'Pudding'),
(6, 'Pastry');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-03-11-033604', 'App\\Database\\Migrations\\Users', 'default', 'App', 1646970031, 1),
(2, '2022-03-11-041531', 'App\\Database\\Migrations\\UserRole', 'default', 'App', 1646972284, 2),
(3, '2022-03-11-042314', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1646972645, 3),
(4, '2022-03-11-044151', 'App\\Database\\Migrations\\Satuan', 'default', 'App', 1646977105, 4),
(5, '2022-03-11-054946', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1646977924, 5),
(6, '2022-03-11-055115', 'App\\Database\\Migrations\\Penjualan', 'default', 'App', 1646977925, 5),
(7, '2022-03-11-055345', 'App\\Database\\Migrations\\TempPenjualan', 'default', 'App', 1646978070, 6),
(8, '2022-03-11-055521', 'App\\Database\\Migrations\\PenjualanDetail', 'default', 'App', 1646978154, 7),
(9, '2022-03-11-060044', 'App\\Database\\Migrations\\KasKeluar', 'default', 'App', 1646978488, 8);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `invoice` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_uang` int(128) NOT NULL,
  `pelanggan` varchar(128) NOT NULL,
  `sisa_uang` int(128) NOT NULL,
  `total` int(128) NOT NULL,
  `kasir` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `invoice`, `tanggal`, `jumlah_uang`, `pelanggan`, `sisa_uang`, `total`, `kasir`) VALUES
(1, 'TRX26032200001', '2022-03-26', 50000, 'Umum', 30000, 20000, 'Aqil Mustaqim'),
(2, 'TRX30032200001', '2022-03-30', 70000, 'Apes', 4000, 66000, 'Aqil Mustaqim'),
(3, 'TRX30032200002', '2022-03-30', 50000, 'Umum', 30000, 20000, 'Aqil Mustaqim');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `invoice` varchar(128) NOT NULL,
  `kode_produk` varchar(128) NOT NULL,
  `harga_beli` int(128) NOT NULL,
  `harga_jual` int(128) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `invoice`, `kode_produk`, `harga_beli`, `harga_jual`, `jumlah`, `subtotal`) VALUES
(1, 'TRX26032200001', 'rpc', 3000, 10000, 2, 20000),
(2, 'TRX30032200001', 'n', 15000, 30000, 2, 60000),
(3, 'TRX30032200001', 'sb', 500, 2000, 3, 6000),
(4, 'TRX30032200002', 'rs', 3500, 7000, 2, 14000),
(5, 'TRX30032200002', 'sb', 500, 2000, 3, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(128) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `satuan_produk` int(128) NOT NULL,
  `kategori_produk` int(128) NOT NULL,
  `stok_produk` int(128) NOT NULL,
  `modal_produk` int(128) NOT NULL,
  `harga_produk` int(128) NOT NULL,
  `foto_produk` varchar(128) NOT NULL,
  `keterangan_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `satuan_produk`, `kategori_produk`, `stok_produk`, `modal_produk`, `harga_produk`, `foto_produk`, `keterangan_produk`) VALUES
(1, 'rpc', 'Roti Pisang Coklat', 1, 1, 1, 3000, 10000, '1648304188_bba4784a485df038da2f.jpg', 'Roti Pisang Ini Enak'),
(2, 'rs', 'Roti Sosis', 1, 1, 1, 3500, 7000, '1648626690_de5b38cda32a5fb09414.jpg', 'Roti Sosis Enak'),
(3, 'rk', 'Roti Keju', 1, 1, 1, 3500, 7000, '1648626732_19aabb8b1f0e274b9084.jpg', 'Roti Keju Enak'),
(4, 'kaj', 'Kroket Ayam Jamur', 1, 2, 1, 500, 3000, '1648626832_98414e61735eb3ed9efa.jpg', ''),
(5, 'ko', 'Kroket Oven', 1, 2, 1, 500, 3000, '1648626870_1352dc7f22ce0a9cbaf8.jpg', ''),
(6, 'rc', 'Rainbow Cakes', 1, 3, 1, 2000, 4000, '1648626937_0b24f0d6b8ec62be5a52.jpg', ''),
(7, 'dc', 'Domino Cake', 1, 3, 1, 2000, 4000, '1648626969_02dde1c53ab9f904362b.jpg', ''),
(8, 'n', 'Nastar', 1, 4, 1, 15000, 30000, '1648627007_65b783a429cc2219f396.jpg', ''),
(9, 'c', 'Chocolate ', 1, 4, 1, 15000, 30000, '1648627067_7fba0bfc7951d96fb2f2.jpg', ''),
(10, 'bp', 'Black Forest Puding', 1, 5, 1, 7500, 15000, '1648627106_490ffcaadde089539f0e.jpg', ''),
(11, 'kp', 'Kiddy Puding', 1, 5, 1, 7500, 15000, '1648627130_b4f4b4755997225adf38.jpg', ''),
(12, 'sc', 'Soes Coklat', 1, 6, 1, 500, 2000, '1648627168_fd87ae7014edcae89be0.jpg', ''),
(13, 'sb', 'Soes Buah', 1, 6, 1, 500, 2000, '1648627190_79fcf9b66c398cd93b18.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(1, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `temp_penjualan`
--

CREATE TABLE `temp_penjualan` (
  `id` int(11) NOT NULL,
  `invoice` varchar(128) NOT NULL,
  `kode_produk` varchar(128) NOT NULL,
  `harga_beli` int(128) NOT NULL,
  `harga_jual` int(128) NOT NULL,
  `jumlah` int(128) NOT NULL,
  `subtotal` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hint` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `hint`, `foto`, `role_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Aqil Mustaqim', 'admin', 'aqilmustaqim28@gmail.com', '$2y$10$0YT.kKyzf7bAu0A6hf2xSO/wvSlVMsn1eFBF8vwvcpdIrSFU8KePK', '', 'default.png', 1, 1, '2022-03-12 02:59:00', '2022-03-12 02:59:00'),
(2, 'Fajar Indrawan', 'fajar', 'fajar@gmail.com', '$2y$10$tyizgtlVWtDev1PVPK198u0J35QlwfDfDq2okaN3Sz1k/g77Lw5W.', '', 'default.png', 2, 1, '2022-03-26 09:17:00', '2022-03-26 09:17:00'),
(3, 'Fiqri Baihaqi', 'fiqri', 'fiqri@gmail.com', '$2y$10$vb1jXRu4CvJRner28Au8o.vHGVdBMAjFwIYETcWHLG1gDaY3WkHOW', '', 'default.png', 2, 1, '2022-03-26 09:17:21', '2022-03-26 09:17:21'),
(4, 'Ersan Alvinetino', 'alvin', 'alvin@gmail.com', '$2y$10$JoOZTtSLSpzVmm7oJiFBJuoZrtEbxGMJq71x8ak48K9EcxNZy8oJO', '', 'default.png', 2, 1, '2022-03-26 09:17:41', '2022-03-26 09:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`),
  ADD KEY `satuan_produk` (`satuan_produk`,`kategori_produk`),
  ADD KEY `kategori_produk` (`kategori_produk`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`satuan_produk`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
