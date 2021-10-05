-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2021 at 08:45 AM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1554775_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(5) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_produk`, `jumlah`, `created_at`, `created_by`) VALUES
(1, 2, 3, '2020-11-21 03:23:45', 3),
(2, 2, 1, '2020-11-21 05:49:34', 1),
(3, 3, 5, '2020-11-21 06:00:33', 1),
(4, 2, 5, '2021-01-28 16:08:00', 1),
(5, 3, 1, '2021-01-28 16:08:18', 1),
(6, 3, 1, '2021-01-28 16:23:09', 1),
(7, 2, 1, '2021-01-28 16:23:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(5) NOT NULL,
  `id_suplier` int(3) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `total` int(7) NOT NULL,
  `pembayaran` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_suplier`, `id_produk`, `jumlah`, `keterangan`, `total`, `pembayaran`, `created_at`, `created_by`) VALUES
(2, 1, 2, 12, '-', 0, 0, '2020-11-21 03:17:02', 1),
(3, 1, 2, 1, 'deskripsi', 0, 0, '2020-11-21 05:50:24', 1),
(4, 1, 2, 30, '-', 400000, 1, '2021-08-06 22:52:06', 1),
(5, 1, 4, 200, '-', 400000, 2, '2021-08-07 00:32:18', 1),
(6, 1, 5, 300, '-', 800000, 2, '2021-08-07 01:53:09', 1),
(7, 1, 6, 24, '-', 2000, 2, '2021-08-07 02:14:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(6) NOT NULL,
  `id_transaksi` int(5) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `jumlah` tinyint(3) NOT NULL,
  `harga` int(7) NOT NULL,
  `subtotal` int(7) NOT NULL,
  `tipe` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_produk`, `jumlah`, `harga`, `subtotal`, `tipe`) VALUES
(1, 1, 4, 1, 15000, 15000, 2),
(2, 1, 6, 1, 7500, 7500, 2),
(5, 2, 4, 100, 45000, 45000, 1),
(7, 3, 6, 1, 7500, 7500, 2),
(10, 5, 4, 1, 14500, 14500, 2),
(11, 5, 6, 1, 7250, 7250, 2),
(12, 6, 4, 1, 14500, 14500, 2),
(13, 6, 6, 1, 7250, 7250, 2),
(14, 7, 4, 2, 14500, 29000, 2),
(15, 7, 6, 1, 7250, 7250, 2),
(16, 8, 4, 1, 2000, 2000, 2),
(17, 8, 6, 6, 7000, 42000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(2, 'Botol'),
(3, 'Parfum');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_telp`) VALUES
(2, 'Pelanggan Ludfi', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(2) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `deskripsi` varchar(180) NOT NULL,
  `kurs` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama`, `logo`, `deskripsi`, `kurs`) VALUES
(1, 'GreenParfum', '83UMN.jpeg', '-', 14000);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(4) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_toko` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `level`, `status`, `id_toko`) VALUES
(1, 'Mochamad Ludfi', 'ludfyrahman', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1, 0),
(3, 'Zainul', 'zainul', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 0),
(4, 'rubi', 'rubi', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 1),
(6, 'kebonsari', 'kebonsari', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 2),
(7, 'adelia', 'adelia', '25d55ad283aa400af464c76d713c07ad', 2, 1, 3),
(8, 'Faridatul', 'faridatul', '25d55ad283aa400af464c76d713c07ad', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(4) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `100gr` double DEFAULT 0,
  `500gr` double DEFAULT 0,
  `kg` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `stok`, `id_kategori`, `deskripsi`, `100gr`, `500gr`, `kg`) VALUES
(4, 'Aigner Black', 0.21428, 90, 3, '-', 3, 5, 10),
(5, 'Melati', 2, 300, 3, '-', 0, 0, 0),
(6, 'Botol 20ml', 0.5, 5, 2, '-', 0, 0, 0),
(9, 'Clinique', 0.17857, 0, 3, '-', 0, 0, 0),
(10, 'Avenue', 0.1428571, 0, 3, '-', 0, 0, 0),
(11, 'Aqua Digio', 0.1428571, 0, 3, '-', 0, 0, 0),
(12, 'Axe Black', 0.1428571, 0, 3, '-', 0, 0, 0),
(13, 'Adidas', 0.1428571, 0, 3, '-', 0, 0, 0),
(14, 'Aqua Bulgari', 0.21428, 0, 3, '-', 0, 0, 0),
(15, 'Eternitify Men', 0.1428571, 0, 3, '-', 0, 0, 0),
(16, 'Silver Ar-rehab', 0.17857, 0, 3, '', 0, 0, 0),
(17, 'Aigner in leather', 0.28571, 0, 3, '-', 0, 0, 0),
(18, 'Aigner Blue', 0.17857, 0, 3, '-', 0, 0, 0),
(19, 'Axe Coklat', 0.1428571, 0, 3, '-', 0, 0, 0),
(20, 'Dunhill blue', 0.1428571, 0, 3, '', 0, 0, 0),
(21, 'Coach Men platinum 13g', 0.1428571, 0, 3, '-', 0, 0, 0),
(22, 'Cristian Ronaldo  126', 0.17857, 0, 3, '-', 0, 0, 0),
(23, 'Cool water 166', 0.17857, 0, 3, '-', 0, 0, 0),
(24, 'Cappucino', 0.1428571, 0, 3, '-', 0, 0, 0),
(25, 'Custo Barcelona', 0.1428571, 0, 3, '-', 0, 0, 0),
(26, 'Jeruk Limau', 0.1428571, 0, 3, '-', 0, 0, 0),
(27, 'Cool water women ', 0.1428571, 0, 3, '-', 0, 0, 0),
(28, 'D & G light Blue ', 0.17857, 0, 3, '-', 0, 0, 0),
(29, 'Cartier Declaration ', 0.28571, 0, 3, '', 0, 0, 0),
(30, 'Davidof Champion', 0.1428571, 0, 3, '-', 0, 0, 0),
(31, 'Davidoff cool summer', 0.1428571, 0, 3, '-', 0, 0, 0),
(32, 'Drakkar Noir', 0.17857, 0, 3, '-', 0, 0, 0),
(33, 'Dunhill Red', 0.1428571, 0, 3, '-', 0, 0, 0),
(34, 'LifeBuoy', 0.1428571, 0, 3, '-', 0, 0, 0),
(35, 'Dunhill london', 0.1428571, 0, 3, '-', 0, 0, 0),
(36, 'Lacoste Essential', 0.17857, 0, 3, '-', 0, 0, 0),
(37, 'Lux White', 0.1428571, 0, 3, '-', 0, 0, 0),
(38, '212 Men C. Herrera', 0.28571, 0, 3, '-', 0, 0, 0),
(39, 'Lacoste Sport', 0.17857, 0, 3, '-', 0, 0, 0),
(40, 'Polo Sport', 0.1428571, 0, 3, '-', 0, 0, 0),
(41, 'Mont Black Individual', 0.21428, 0, 3, '-', 0, 0, 0),
(42, 'Mont Black star walker', 0.1428571, 0, 3, '-', 0, 0, 0),
(43, 'Polo Black', 0.28571, 0, 3, '-', 0, 0, 0),
(44, 'paul smith', 0.1428571, 0, 3, '-', 0, 0, 0),
(45, 'butterfly', 0.21428, 0, 3, '-', 0, 0, 0),
(46, 'burberry sport', 0.17857, 0, 3, '-', 0, 0, 0),
(47, 'Jaguar Vission', 0.21428, 0, 3, '-', 0, 0, 0),
(48, 'Justin Bieber', 0.1428571, 0, 3, '-', 0, 0, 0),
(49, 'Malaikat Subuh', 0.1428571, 0, 3, '-', 0, 0, 0),
(50, 'Jaguar Blue', 0.17857, 0, 3, '', 0, 0, 0),
(51, 'Kasturi Putih', 0.17857, 0, 3, '', 0, 0, 0),
(52, 'Ken20 Batang', 0.1428571, 0, 3, '-', 0, 0, 0),
(53, 'Ken20 Bali', 0.1428571, 0, 3, '-', 0, 0, 0),
(54, 'Ken20 Flower', 0.1428571, 0, 3, '-', 0, 0, 0),
(55, 'Baccarat ', 0.21428, 0, 3, '-', 0, 0, 0),
(56, 'Black opium', 0.1428571, 0, 3, '-', 0, 0, 0),
(57, 'Charly White', 0.1428571, 0, 3, '-', 0, 0, 0),
(58, 'white musk body shop', 0.1428571, 0, 3, '-', 0, 0, 0),
(59, 'versace versus', 0.17857, 0, 3, '-', 0, 0, 0),
(60, 'Smokky rose body shop', 0.1428571, 0, 3, '-', 0, 0, 0),
(61, 'Spalding', 0.1428571, 0, 3, '-', 0, 0, 0),
(62, 'Antonio Benderas', 0.1428571, 0, 3, '-', 0, 0, 0),
(63, 'Bul Omnia Amesthiste', 0.1428571, 0, 3, '-', 0, 0, 0),
(64, 'Bul Omnia Crystal', 0.1428571, 0, 3, '-', 0, 0, 0),
(65, 'Bulgari Aqua Marine', 0.17857, 0, 3, '', 0, 0, 0),
(66, 'Seribu Bunga', 0.21428, 0, 3, '-', 0, 0, 0),
(67, 'Bulgari Extreme', 0.17857, 0, 3, '-', 0, 0, 0),
(68, 'Hugo Orange Men', 0.1428571, 0, 3, '', 0, 0, 0),
(69, 'Hugo Boss Ice', 0.25, 0, 3, '', 0, 0, 0),
(70, 'Hugo Boss Bottle', 0.21428, 0, 3, '-', 0, 0, 0),
(71, 'Hugo Emergize', 0.1428571, 0, 3, '-', 0, 0, 0),
(72, 'Hugo Orange Woman', 0.1428571, 0, 3, '', 0, 0, 0),
(73, 'Bakhoor 2000 Bunga', 0.1428571, 0, 3, '', 0, 0, 0),
(74, 'Black xs ', 0.28571, 0, 3, '', 0, 0, 0),
(75, 'Avril Forbidden', 0.1428571, 0, 3, '', 0, 0, 0),
(76, 'Bombshell V.Secret', 0.1428571, 0, 3, '', 0, 0, 0),
(77, 'Fantacy', 0.17857, 0, 3, '', 0, 0, 0),
(78, 'Escoba Sexy', 0.1428571, 0, 3, '', 0, 0, 0),
(79, 'D&G sisi', 0.1428571, 0, 3, '', 0, 0, 0),
(80, 'Paris Hilton Sirene', 0.1428571, 0, 3, '', 0, 0, 0),
(81, 'Paris Hilton', 0.1428571, 0, 3, '', 0, 0, 0),
(82, 'Scarlet', 0.17857, 0, 3, '', 0, 0, 0),
(83, 'Love Sarah', 0.1428571, 0, 3, '', 0, 0, 0),
(84, 'Paris Hilon Passport', 0.1428571, 0, 3, '', 0, 0, 0),
(85, 'Allure Homme Sport', 0.21428, 0, 3, '', 0, 0, 0),
(86, 'Paris Hilton Heirres', 0.1428571, 0, 3, '', 0, 0, 0),
(87, 'Angel Heart', 0.1428571, 0, 3, '', 0, 0, 0),
(88, 'Jio Still', 0.1428571, 0, 3, '', 0, 0, 0),
(89, 'Bubble Gum', 0.1428571, 0, 3, '', 0, 0, 0),
(90, 'Escada Moon Sparkle', 0.1428571, 0, 3, '', 0, 0, 0),
(91, 'Scandalous V. Secret ', 0.1428571, 0, 3, '', 0, 0, 0),
(92, 'Jio Platinum', 0.1428571, 0, 3, '', 0, 0, 0),
(93, 'Selena Gomez', 0.1428571, 0, 3, '', 0, 0, 0),
(94, 'Taylor Swift', 0.1428571, 0, 3, '', 0, 0, 0),
(95, 'Vanilla Body Shop', 0.1428571, 0, 3, '\r\n', 0, 0, 0),
(96, 'RomanWish', 0.1428571, 0, 3, '', 0, 0, 0),
(97, 'Vanilla Lace', 0.1428571, 0, 3, '', 0, 0, 0),
(98, 'Aigner To Feminine', 0.1428571, 0, 3, '', 0, 0, 0),
(99, 'Amor Syahrini', 0.1428571, 0, 3, '', 0, 0, 0),
(100, 'Miss Dior', 0.1428571, 0, 3, '', 0, 0, 0),
(101, 'Katty Perry Meow', 0.28571, 0, 3, '-', 0, 0, 0),
(102, 'Harajuku Love', 0.1428571, 0, 3, '', 0, 0, 0),
(103, 'Beyonce Heart', 0.1428571, 0, 3, '', 0, 0, 0),
(104, 'V.S Charm', 0.1428571, 0, 3, '', 0, 0, 0),
(105, 'Issey Miyake', 0.1428571, 0, 3, '', 0, 0, 0),
(106, 'Ellie Saab', 0.1428571, 0, 3, '', 0, 0, 0),
(107, 'Viva La Juicy ', 0.28571, 0, 3, '-', 0, 0, 0),
(108, 'Terre Hermes', 0.28571, 0, 3, '', 0, 0, 0),
(109, 'CK-one Calvin Clein', 0.1428571, 0, 3, '', 0, 0, 0),
(110, 'Angel Honey', 0.21428, 0, 3, '', 0, 0, 0),
(111, 'Anna S.Dream', 0.1428571, 0, 3, '', 0, 0, 0),
(112, 'Anna Gul Secret Wish', 0.17857, 0, 3, '', 0, 0, 0),
(113, 'Anna Sui Flight Fancy ', 0.21428, 0, 3, '', 0, 0, 0),
(114, 'Safron Dil Ironi', 0.28571, 0, 3, '', 0, 0, 0),
(115, 'Fancy Bouquet Cobra', 0.35714, 0, 3, '', 0, 0, 0),
(116, 'Hajar Aswad ', 0.28571, 0, 3, '', 0, 0, 0),
(117, 'Cendana Keraton', 0.21428, 0, 3, '', 0, 0, 0),
(118, 'Passion Fruit', 0.1428571, 0, 3, '', 0, 0, 0),
(119, 'Melati Keraton', 0.17857, 0, 3, '', 0, 0, 0),
(120, 'Casablanca', 0.1428571, 0, 3, '', 0, 0, 0),
(121, 'Sakey', 0.1428571, 0, 3, '', 0, 0, 0),
(122, 'Estee', 0.1428571, 0, 3, '', 0, 0, 0),
(123, 'Musk Putih', 0.28571, 0, 3, '', 0, 0, 0),
(124, 'Musk Oil', 0.1428571, 0, 3, '', 0, 0, 0),
(125, 'Musk Hitam', 0.28571, 0, 3, '', 0, 0, 0),
(126, 'Ro.4', 0.1428571, 0, 2, '', 0, 0, 0),
(127, 'Ro.5', 0.1428571, 0, 2, '', 0, 0, 0),
(128, 'Ro.7', 0.1428571, 0, 2, '', 0, 0, 0),
(129, 'Ro.8', 0.1428571, 0, 2, '', 0, 0, 0),
(130, 'Ro.13', 0.1428571, 0, 2, '', 0, 0, 0),
(131, 'Px3', 0.42857, 0, 2, '', 0, 0, 0),
(132, 'Fs17', 0.35714, 0, 2, '', 0, 0, 0),
(133, 'Px 145', 0.42857, 0, 2, '', 0, 0, 0),
(134, 'Top 20', 0.5, 0, 2, '', 0, 0, 0),
(135, 'PX 100', 0.42857, 0, 2, '', 0, 0, 0),
(136, 'px 16', 0.5, 0, 2, '', 0, 0, 0),
(137, 'px 82', 0.42857, 0, 2, '', 0, 0, 0),
(138, 'px 84', 0.42857, 0, 2, '', 0, 0, 0),
(139, 'px 32', 0.42857, 0, 2, '', 0, 0, 0),
(140, 'px 75', 0.42857, 0, 2, '', 0, 0, 0),
(141, 'px 130', 0.5, 0, 2, '', 0, 0, 0),
(142, 'S 142', 0.42857, 0, 2, '', 0, 0, 0),
(143, 'Cs 20', 0.5, 0, 2, '', 0, 0, 0),
(144, 'PX 144', 0.5, 0, 2, '', 0, 0, 0),
(145, 'S. 0123', 0.5, 0, 2, '', 0, 0, 0),
(146, 'px 118', 0.42857, 0, 2, '', 0, 0, 0),
(147, 'dot 60', 0.5, 0, 2, '', 0, 0, 0),
(148, 'px 141', 0.42857, 0, 2, '', 0, 0, 0),
(149, 'p x 9', 0.5, 0, 2, '', 0, 0, 0),
(150, 'px 112', 0.5, 0, 2, '', 0, 0, 0),
(151, 'px 143', 0.5714, 0, 2, '', 0, 0, 0),
(152, 'S 14', 0.35714, 0, 2, '', 0, 0, 0),
(153, 'px 87', 0.5, 0, 2, '', 0, 0, 0),
(154, 'csw 20', 0.42857, 0, 2, '', 0, 0, 0),
(155, 'px 98', 0.42857, 0, 2, '', 0, 0, 0),
(156, 'px 14', 0.5, 0, 2, '', 0, 0, 0),
(157, 'S Apel', 0.42857, 0, 2, '-', 0, 0, 0),
(158, 'px9', 0.5, 0, 2, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stok_toko`
--

CREATE TABLE `stok_toko` (
  `id` int(5) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `id_toko` int(3) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_toko`
--

INSERT INTO `stok_toko` (`id`, `id_produk`, `id_toko`, `jumlah`, `created_at`, `created_by`) VALUES
(2, 4, 1, 4, '2020-11-21 03:17:02', 1),
(6, 6, 1, 1, '2021-08-07 02:17:46', 0),
(7, 4, 2, 4, '2021-09-23 03:13:33', 0),
(8, 6, 2, 1, '2021-09-23 09:38:27', 1),
(9, 4, 3, 182, '2021-09-24 10:04:02', 1),
(10, 6, 3, 1, '2021-09-24 10:04:12', 1),
(11, 9, 3, 104, '2021-09-24 21:26:50', 1),
(12, 10, 3, 167, '2021-09-24 21:27:09', 1),
(13, 11, 3, 107, '2021-09-24 21:27:40', 1),
(14, 12, 3, 128, '2021-09-24 21:27:55', 1),
(15, 13, 3, 154, '2021-09-25 00:28:44', 1),
(16, 14, 3, 136, '2021-09-25 00:29:11', 1),
(17, 15, 3, 137, '2021-09-25 00:29:27', 1),
(18, 16, 3, 121, '2021-09-25 00:29:38', 1),
(19, 17, 3, 106, '2021-09-25 00:29:58', 1),
(20, 18, 3, 108, '2021-09-25 00:33:51', 1),
(21, 19, 3, 160, '2021-09-25 00:34:09', 1),
(22, 20, 3, 109, '2021-09-25 00:34:25', 1),
(23, 21, 3, 139, '2021-09-25 00:34:44', 1),
(24, 22, 3, 126, '2021-09-25 00:34:57', 1),
(25, 23, 3, 166, '2021-09-25 00:35:17', 1),
(26, 24, 3, 0, '2021-09-25 00:35:36', 1),
(27, 25, 3, 124, '2021-09-25 00:35:51', 1),
(28, 26, 3, 100, '2021-09-25 00:36:02', 1),
(29, 27, 3, 169, '2021-09-25 00:36:13', 1),
(30, 28, 3, 118, '2021-09-25 00:36:28', 1),
(31, 29, 3, 178, '2021-09-25 00:36:41', 1),
(32, 30, 3, 145, '2021-09-25 00:36:54', 1),
(33, 31, 3, 120, '2021-09-25 00:38:55', 1),
(34, 32, 3, 120, '2021-09-25 00:39:08', 1),
(35, 33, 3, 98, '2021-09-25 00:39:21', 1),
(36, 34, 3, 174, '2021-09-25 00:39:33', 1),
(37, 35, 3, 147, '2021-09-25 00:39:46', 1),
(38, 36, 3, 185, '2021-09-25 00:40:00', 1),
(39, 37, 3, 131, '2021-09-25 00:41:11', 1),
(40, 38, 3, 152, '2021-09-25 00:41:24', 1),
(41, 39, 3, 103, '2021-09-25 00:41:38', 1),
(42, 40, 3, 135, '2021-09-25 00:41:46', 1),
(43, 41, 3, 109, '2021-09-25 00:41:54', 1),
(44, 42, 3, 139, '2021-09-25 00:42:03', 1),
(45, 43, 3, 181, '2021-09-25 00:42:22', 1),
(46, 44, 3, 0, '2021-09-25 00:43:46', 1),
(47, 45, 3, 121, '2021-09-25 00:43:59', 1),
(48, 46, 3, 194, '2021-09-25 00:44:25', 1),
(49, 47, 3, 185, '2021-09-25 00:44:41', 1),
(50, 48, 3, 125, '2021-09-25 00:44:52', 1),
(51, 49, 3, 100, '2021-09-25 00:45:13', 1),
(52, 50, 3, 111, '2021-09-25 00:45:27', 1),
(53, 51, 3, 173, '2021-09-25 00:45:55', 1),
(54, 52, 3, 158, '2021-09-25 00:46:12', 1),
(55, 53, 3, 129, '2021-09-25 00:46:22', 1),
(56, 54, 3, 163, '2021-09-25 00:46:30', 1),
(57, 55, 3, 152, '2021-09-25 00:46:40', 1),
(58, 56, 3, 162, '2021-09-25 00:46:49', 1),
(59, 57, 3, 167, '2021-09-25 00:47:02', 1),
(60, 58, 3, 103, '2021-09-25 00:47:13', 1),
(61, 59, 3, 175, '2021-09-25 00:47:38', 1),
(62, 60, 3, 134, '2021-09-25 00:47:51', 1),
(63, 61, 3, 119, '2021-09-25 00:48:00', 1),
(64, 62, 3, 149, '2021-09-25 00:48:21', 1),
(65, 63, 3, 136, '2021-09-25 00:48:38', 1),
(66, 64, 3, 134, '2021-09-25 00:48:47', 1),
(67, 65, 3, 170, '2021-09-25 00:49:00', 1),
(68, 66, 3, 185, '2021-09-25 00:49:11', 1),
(69, 67, 3, 175, '2021-09-25 00:49:31', 1),
(70, 68, 3, 123, '2021-09-25 00:49:47', 1),
(71, 69, 3, 160, '2021-09-25 00:50:00', 1),
(72, 70, 3, 104, '2021-09-25 00:50:17', 1),
(73, 71, 3, 125, '2021-09-25 00:50:26', 1),
(74, 72, 3, 140, '2021-09-25 00:50:39', 1),
(75, 73, 3, 176, '2021-09-25 00:50:48', 1),
(76, 74, 3, 114, '2021-09-25 00:51:02', 1),
(77, 75, 3, 162, '2021-09-25 00:51:20', 1),
(78, 76, 3, 97, '2021-09-25 00:51:31', 1),
(79, 77, 3, 118, '2021-09-25 00:51:51', 1),
(80, 78, 3, 115, '2021-09-25 00:52:05', 1),
(81, 79, 3, 99, '2021-09-25 00:52:20', 1),
(82, 80, 3, 177, '2021-09-25 00:52:32', 1),
(83, 81, 3, 0, '2021-09-25 00:52:45', 1),
(84, 82, 3, 158, '2021-09-25 00:52:57', 1),
(85, 83, 3, 159, '2021-09-25 00:53:15', 1),
(86, 84, 3, 184, '2021-09-25 00:53:40', 1),
(87, 85, 3, 120, '2021-09-25 00:53:52', 1),
(88, 86, 3, 124, '2021-09-25 00:54:35', 1),
(89, 87, 3, 116, '2021-09-25 00:54:56', 1),
(90, 88, 3, 162, '2021-09-25 00:55:12', 1),
(91, 89, 3, 112, '2021-09-25 00:55:23', 1),
(92, 90, 3, 160, '2021-09-25 00:55:36', 1),
(93, 91, 3, 120, '2021-09-25 00:55:46', 1),
(94, 92, 3, 151, '2021-09-25 00:55:57', 1),
(95, 93, 3, 194, '2021-09-25 00:56:23', 1),
(96, 94, 3, 111, '2021-09-25 00:56:37', 1),
(97, 95, 3, 138, '2021-09-25 00:56:56', 1),
(98, 96, 3, 113, '2021-09-25 00:57:09', 1),
(99, 97, 3, 0, '2021-09-25 00:57:18', 1),
(100, 98, 3, 120, '2021-09-25 00:57:29', 1),
(101, 99, 3, 0, '2021-09-25 00:57:38', 1),
(102, 100, 3, 162, '2021-09-25 00:57:46', 1),
(103, 101, 3, 155, '2021-09-25 00:58:00', 1),
(104, 102, 3, 162, '2021-09-25 00:58:11', 1),
(105, 103, 3, 122, '2021-09-25 00:58:20', 1),
(106, 104, 3, 121, '2021-09-25 00:58:30', 1),
(107, 105, 3, 161, '2021-09-25 01:00:12', 1),
(108, 106, 3, 172, '2021-09-25 01:00:23', 1),
(109, 107, 3, 111, '2021-09-25 01:00:34', 1),
(110, 108, 3, 170, '2021-09-25 01:00:46', 1),
(111, 109, 3, 106, '2021-09-25 01:00:59', 1),
(112, 110, 3, 118, '2021-09-25 01:01:12', 1),
(113, 111, 3, 168, '2021-09-25 01:01:23', 1),
(114, 112, 3, 140, '2021-09-25 01:01:38', 1),
(115, 113, 3, 131, '2021-09-25 01:02:56', 1),
(116, 114, 3, 63, '2021-09-25 01:03:10', 1),
(117, 115, 3, 84, '2021-09-25 01:03:25', 1),
(118, 116, 3, 72, '2021-09-25 01:03:33', 1),
(119, 117, 3, 42, '2021-09-25 01:03:42', 1),
(120, 118, 3, 114, '2021-09-25 01:03:56', 1),
(121, 119, 3, 86, '2021-09-25 01:04:31', 1),
(122, 120, 3, 51, '2021-09-25 01:04:42', 1),
(123, 121, 3, 125, '2021-09-25 01:04:53', 1),
(124, 122, 3, 130, '2021-09-25 01:05:05', 1),
(125, 123, 3, 85, '2021-09-25 01:05:16', 1),
(126, 124, 3, 116, '2021-09-25 01:05:26', 1),
(127, 125, 3, 111, '2021-09-25 01:06:05', 1),
(128, 126, 3, 0, '2021-09-25 01:25:38', 1),
(129, 127, 3, 17, '2021-09-25 01:26:22', 1),
(130, 128, 3, 17, '2021-09-25 01:26:36', 1),
(131, 129, 3, 8, '2021-09-25 01:26:46', 1),
(132, 130, 3, 0, '2021-09-25 01:26:55', 1),
(133, 131, 3, 9, '2021-09-25 01:27:05', 1),
(134, 132, 3, 9, '2021-09-25 01:27:14', 1),
(135, 133, 3, 7, '2021-09-25 01:27:29', 1),
(136, 134, 3, 19, '2021-09-25 01:27:43', 1),
(137, 135, 3, 8, '2021-09-25 01:27:54', 1),
(138, 136, 3, 14, '2021-09-25 01:28:24', 1),
(139, 137, 3, 14, '2021-09-25 01:28:53', 1),
(140, 138, 3, 8, '2021-09-25 01:29:04', 1),
(141, 139, 3, 14, '2021-09-25 01:29:30', 1),
(142, 140, 3, 5, '2021-09-25 01:29:41', 1),
(143, 141, 3, 1, '2021-09-25 01:29:53', 1),
(144, 142, 3, 11, '2021-09-25 01:31:14', 1),
(145, 143, 3, 13, '2021-09-25 01:35:46', 1),
(146, 144, 3, 10, '2021-09-25 01:36:01', 1),
(147, 145, 3, 3, '2021-09-25 01:36:51', 1),
(148, 146, 3, 7, '2021-09-25 01:37:01', 1),
(149, 147, 3, 8, '2021-09-25 01:37:15', 1),
(150, 148, 3, 7, '2021-09-25 01:37:28', 1),
(151, 158, 3, 11, '2021-09-25 01:42:40', 1),
(152, 150, 3, 13, '2021-09-25 01:42:53', 1),
(153, 151, 3, 4, '2021-09-25 01:43:05', 1),
(154, 152, 3, 12, '2021-09-25 01:43:20', 1),
(155, 153, 3, 7, '2021-09-25 01:43:54', 1),
(156, 154, 3, 16, '2021-09-25 01:44:07', 1),
(157, 155, 3, 1, '2021-09-25 01:44:14', 1),
(158, 156, 3, 12, '2021-09-25 01:44:45', 1),
(159, 157, 3, 1, '2021-09-25 01:44:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'Suplier1', 'jalan raya indomarco', '082331759738');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tipe` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama`, `alamat`, `no_telp`, `tipe`) VALUES
(1, 'Green Parfum Jawa', 'Jl. Jawa No.14-12, Tegal Boto Lor, Sumbersari', '082331759738', 2),
(2, 'Green Parfum Kebonsari', '-', '-', 1),
(3, 'Green parfum Jenggawah', '-', '-', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `id_pengguna` int(4) NOT NULL,
  `id_toko` int(3) NOT NULL,
  `id_pelanggan` int(3) DEFAULT NULL,
  `total_transaksi` int(6) NOT NULL,
  `pembayaran` tinyint(1) NOT NULL,
  `bayar` int(7) NOT NULL,
  `kembalian` int(7) NOT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pengguna`, `id_toko`, `id_pelanggan`, `total_transaksi`, `pembayaran`, `bayar`, `kembalian`, `tanggal_transaksi`) VALUES
(1, 4, 1, 0, 22500, 2, 25000, 2500, '2021-09-23 03:45:13'),
(2, 6, 2, 2, 45000, 2, 45000, 0, '2021-09-23 05:31:38'),
(3, 4, 1, 0, 7500, 2, 8000, 500, '2021-09-23 07:19:04'),
(4, 6, 2, 0, 37500, 2, 38000, 500, '2021-09-23 09:40:16'),
(5, 4, 1, 0, 21750, 2, 22000, 250, '2021-09-24 09:39:51'),
(6, 4, 1, 0, 21750, 2, 50000, 28250, '2021-09-24 09:41:50'),
(7, 4, 1, 0, 36250, 2, 40000, 3750, '2021-09-24 09:43:48'),
(8, 8, 3, 0, 44000, 2, 45000, 1000, '2021-09-24 10:06:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_toko`
--
ALTER TABLE `stok_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `stok_toko`
--
ALTER TABLE `stok_toko`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
