-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 03:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `kategori`, `keterangan`) VALUES
(1, 'Breakfast', 'Menu Sarapan Pagi'),
(2, 'Lunch', ''),
(3, 'Coffee', '');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `idmeja` int(11) NOT NULL,
  `nomorMeja` varchar(20) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `available` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`idmeja`, `nomorMeja`, `kapasitas`, `available`) VALUES
(1, '1', 4, 1),
(2, '2', 4, 1),
(3, '3', 4, 1),
(4, '4', 4, 1),
(5, '5', 6, 1),
(6, '6', 6, 1),
(7, '7', 8, 1),
(8, '8', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `namaMenu` varchar(100) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `idkategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `namaMenu`, `harga`, `foto`, `deskripsi`, `idkategori`) VALUES
(1, 'Bubur Ayam', 15000, 'menu-20210428-fb0854e1ce.jpg', '', 1),
(2, 'Nasi Kuning', 15000, 'menu-20210428-7918279c9a.jpg', '', 1),
(3, 'Kopi Hitam', 10000, 'menu-20210428-87fe013065.jpg', '', 3),
(4, 'Nasi Ayam Penyet', 25000, 'menu-20210428-16972148cf.jpg', '', 2),
(5, 'Nasi Ayam Geprek', 25000, 'menu-20210428-b3fdde097b.jpg', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `nomorbill` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `idmeja` int(11) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `net_amount` int(11) NOT NULL,
  `orderdate` datetime NOT NULL,
  `paidstatus` int(11) NOT NULL,
  `totalpayment` int(11) NOT NULL,
  `sisakembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `nomorbill`, `idpelanggan`, `idmeja`, `gross_amount`, `tax`, `net_amount`, `orderdate`, `paidstatus`, `totalpayment`, `sisakembalian`) VALUES
(1, '202104280001', 2, 1, 70000, 7000, 77000, '2021-03-01 14:33:48', 1, 77000, 0),
(2, '202104280003', 1, 2, 40000, 4000, 44000, '2021-04-28 14:34:24', 1, 45000, 1000),
(3, '202104280003', 2, 1, 1500000, 150000, 1650000, '2021-02-28 18:34:33', 1, 1650000, 0),
(4, '202104280003', 3, 4, 2500000, 250000, 2750000, '2021-01-01 18:37:55', 1, 2750000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderitemsid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderitemsid`, `orderid`, `idmenu`, `qty`, `harga`, `amount`) VALUES
(1, 1, 1, 2, 15000, 30000),
(2, 1, 3, 4, 10000, 40000),
(5, 2, 5, 1, 25000, 25000),
(6, 2, 2, 1, 15000, 15000),
(10, 3, 3, 20, 10000, 200000),
(11, 3, 1, 20, 15000, 300000),
(12, 3, 4, 40, 25000, 1000000),
(14, 4, 4, 100, 25000, 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `noHP` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `noHP`) VALUES
(1, 'Ujang Kenalpot', '081212341234'),
(2, 'Mamang Sutarman', '098712361236'),
(3, 'Suminep', '098712311231');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `fullname`, `role`, `image`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'owner', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`idmeja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD KEY `FK_KategoriMenu` (`idkategori`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `FK_MejaOrder` (`idmeja`),
  ADD KEY `FK_PelangganOrder` (`idpelanggan`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderitemsid`),
  ADD KEY `FK_HeaderOrder` (`orderid`),
  ADD KEY `FK_MenuOrder` (`idmenu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `idmeja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `orderitemsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_KategoriMenu` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_MejaOrder` FOREIGN KEY (`idmeja`) REFERENCES `meja` (`idmeja`),
  ADD CONSTRAINT `FK_PelangganOrder` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_HeaderOrder` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`),
  ADD CONSTRAINT `FK_MenuOrder` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
