-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2019 at 06:55 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gage`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_piutang`
--

CREATE TABLE `detail_piutang` (
  `id` int(11) NOT NULL,
  `id_produksi` varchar(100) NOT NULL,
  `cicilan_ke` varchar(100) NOT NULL,
  `nominal` decimal(15,0) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_piutang`
--

INSERT INTO `detail_piutang` (`id`, `id_produksi`, `cicilan_ke`, `nominal`, `pembayaran`, `tanggal`) VALUES
(2, '1905030002', 'DP', '1600000', 'Tunai', '2019-05-03'),
(3, '1905030003', 'DP', '500000', 'BCA Pak Benk', '2019-05-03'),
(4, '1905030003', '1', '500000', 'BCA Pak Benk', '2019-05-03'),
(6, '1905030003', '2', '300000', 'Tunai', '2019-05-03'),
(7, '1905030003', '3', '200000', 'BCA Joko', '2019-05-03'),
(9, '1905030005', 'DP', '67500', 'Tunai', '2019-05-03'),
(10, '1905030006', 'DP', '50000', 'Tunai', '2019-05-03'),
(11, '1905030006', '1', '305000', 'BCA Pak Benk', '2019-05-03'),
(12, '1905030007', 'DP', '200000', 'BCA Joko', '2019-05-03'),
(13, '1905030007', '1', '1180000', 'BCA Pak Benk', '2019-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi`
--

CREATE TABLE `detail_produksi` (
  `id` int(11) NOT NULL,
  `id_produksi` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_jenis` varchar(100) NOT NULL,
  `bahan` varchar(100) NOT NULL,
  `panjang` decimal(15,2) NOT NULL,
  `lebar` decimal(15,2) NOT NULL,
  `jumlah` decimal(15,0) NOT NULL,
  `harga` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi`
--

INSERT INTO `detail_produksi` (`id`, `id_produksi`, `deskripsi`, `id_jenis`, `bahan`, `panjang`, `lebar`, `jumlah`, `harga`) VALUES
(2, '1905030002', 'Kaos Jokowi', '3', 'katun', '1.00', '1.00', '40', '40000'),
(3, '1905030003', 'Kaos Prabowo', '3', 'katun', '1.00', '1.00', '50', '30000'),
(5, '1905030005', 'MMT Ramadhan', '1', '300', '3.00', '1.50', '1', '15000'),
(6, '1905030006', 'MMT 1', '1', '280', '3.50', '1.00', '2', '15000'),
(7, '1905030006', 'MMT 2', '1', '300', '4.00', '1.50', '2', '20000'),
(8, '1905030007', 'Kaos UNS Press', '3', 'katun', '1.00', '1.00', '30', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `id_jenis` varchar(11) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `id_jenis`, `jenis`) VALUES
(1, '1', 'OUTDOOR'),
(2, '2', 'OFFSET'),
(3, '3', 'MERCHANDISE'),
(4, '4', 'A3'),
(5, '5', 'INDOOR');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `norek` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `saldo` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `nama`, `email`, `alamat`, `phone`, `norek`, `logo`, `judul`, `saldo`) VALUES
(1, 'Gage Design', 'gagedesignsolo@gmail.com', 'Jln. Monginsidi III/6, Margorejo, Solo', '(0271) 654038', 'BCA : Bambang Nugroho No Rek. 015 318 899', 'logo.png', 'Aplikasi Keuangan', '30000000');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `cv` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `cp` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `broker` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_pelanggan`, `nama`, `cv`, `alamat`, `cp`, `status`, `broker`) VALUES
(1, 'GG0001', '0', 'Piposoft', '', '089673333318', 0, 'Non Broker'),
(2, 'GG0002', 'Afif Nuruddin', 'Piposoft', 'Suruh Kayuapak', '089673333318', 1, 'Broker'),
(3, 'GG0003', 'Nuruddin', 'WIBU', 'Kayuapak', '09080', 0, ''),
(4, '', '', '', '', '', 0, ''),
(5, 'GG0005', 'Basuki', 'UNS', '', '089673333318', 1, 'Non Broker'),
(6, 'GG0006', 'Paijo', '', '', '089673333318', 1, 'Non Broker');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `gramatur` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_sup` varchar(100) NOT NULL,
  `qty` decimal(15,0) NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `jenis`, `tanggal`, `gramatur`, `keterangan`, `id_sup`, `qty`, `harga`, `pembayaran`) VALUES
(1, 'DIGITAL', '2019-05-03', '340', '3.2mx80m @5800', '1', '5', '150000', 'BCA Pak Benk'),
(2, 'DIGITAL', '2019-05-02', '280', '-', '8', '3', '100000', 'Tunai'),
(3, 'OFFSET', '2019-05-03', 'B. Gosend Bendera', '-', '-', '3', '220000', 'BCA Pak Benk'),
(4, 'PRIVE', '2019-05-03', '', 'Beli rokok 76', '-', '1', '15000', 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id` int(11) NOT NULL,
  `id_produksi` varchar(100) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `total_tagihan` decimal(15,0) NOT NULL,
  `sisa_tagihan` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id`, `id_produksi`, `id_pelanggan`, `total_tagihan`, `sisa_tagihan`) VALUES
(2, '1905030002', 'GG0006', '1600000', '0'),
(3, '1905030003', 'GG0005', '1500000', '0'),
(5, '1905030005', 'GG0002', '67500', '0'),
(6, '1905030006', 'GG0002', '355000', '0'),
(7, '1905030007', 'GG0002', '1380000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id` int(11) NOT NULL,
  `id_produksi` varchar(100) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `biaya_design` decimal(15,0) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `diskon` decimal(15,2) NOT NULL,
  `total_tagihan` decimal(15,0) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `bayar` decimal(15,0) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id`, `id_produksi`, `id_pelanggan`, `pic`, `biaya_design`, `tanggal`, `username`, `diskon`, `total_tagihan`, `pembayaran`, `bayar`, `keterangan`, `status`) VALUES
(1, '1905030001', 'GG0002', 'Andi', '0', '2019-05-03', 'admin', '0.00', '236250', 'BCA Joko', '200000', 'UTANG', '1'),
(2, '1905030002', 'GG0006', 'Andi', '0', '2019-05-03', 'admin', '0.00', '1600000', 'Tunai', '1600000', 'LUNAS', ''),
(3, '1905030003', 'GG0005', 'Andi', '0', '2019-05-03', 'admin', '0.00', '1500000', 'BCA Pak Benk', '500000', 'UTANG', ''),
(4, '1905030004', 'GG0002', 'Andi', '0', '2019-05-03', 'admin', '0.00', '67500', 'Tunai', '70000', 'LUNAS', '1'),
(5, '1905030005', 'GG0002', 'Andi', '0', '2019-05-03', 'admin', '0.00', '67500', 'Tunai', '70000', 'LUNAS', ''),
(6, '1905030006', 'GG0002', 'Andi', '10000', '2019-05-03', 'admin', '0.00', '355000', 'Tunai', '50000', 'UTANG', ''),
(7, '1905030007', 'GG0002', 'Andi', '0', '2019-05-03', 'admin', '8.00', '1380000', 'BCA Joko', '200000', 'UTANG', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_sup` int(11) NOT NULL,
  `sup` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_sup`, `sup`, `jenis`, `status`) VALUES
(1, 'GRAFERA', 'DIGITAL', 1),
(2, 'BAI', 'DIGITAL', 1),
(3, 'WARNA J', 'DIGITAL', 1),
(4, 'COLOR INK', 'DIGITAL', 1),
(5, 'Apip', 'DIGITAL', 0),
(6, 'JIMMI', 'DIGITAL', 1),
(7, 'PAPERKU', 'DIGITAL', 1),
(8, 'DITO', 'DIGITAL', 1),
(9, 'MAESTRO', 'DIGITAL', 1),
(10, 'POLYFLEX', 'MERCHANDISE', 0),
(11, 'FLOK', 'MERCHANDISE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `password`, `level`, `last_login`) VALUES
(1, 'admin', 'Bambang', '$2y$05$5YkxCpx/xPqfrTSDVhgqWe7vKVlzW3b38jjjNiawHiVikrMvy683O', 'Admin', '0000-00-00 00:00:00'),
(4, 'tiara', 'Mutiara', '$2y$05$ZPRgdKKvxbZteSqnFMrzS.ki/u4rr9QD2ZKynJ2pyLYzwai9iaZrO', 'Front Office', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_sup`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_sup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
