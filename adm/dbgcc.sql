-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 09:32 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgcc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(5) NOT NULL,
  `nama_bulan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` varchar(10) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `passwd` varchar(6) NOT NULL,
  `id_role` varchar(2) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama_karyawan`, `unit`, `email`, `contact`, `username`, `passwd`, `id_role`, `img`) VALUES
('GARUDA0001', 'M Iriansyah Putra Pratama', 'JKTMX-1', 'pace@gmail.com', '6282248080870', 'pace', 'pace', '1', 'pace.jpg'),
('GARUDA0002', 'Thufail Erlangga', 'JKTMX-2', 'erlangga@gmail.com', '6281344303816', 'angga', 'angga', '2', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id_kontrak` int(5) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id_kontrak`, `type`) VALUES
(1, 'Apps'),
(2, 'Network'),
(3, 'Server');

-- --------------------------------------------------------

--
-- Table structure for table `master_vendor`
--

CREATE TABLE `master_vendor` (
  `id_vendor` varchar(10) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `email_vendor` varchar(40) NOT NULL,
  `alamat_vendor` varchar(150) NOT NULL,
  `contact_vendor` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `passwd` varchar(6) NOT NULL,
  `id_role` varchar(2) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_vendor`
--

INSERT INTO `master_vendor` (`id_vendor`, `nama_perusahaan`, `email_vendor`, `alamat_vendor`, `contact_vendor`, `username`, `passwd`, `id_role`, `img`) VALUES
('VENDOR0001', 'Beritagar.id', 'redaksi@beritagar.com', 'Jln. Jatibaru, Tanah Abang Jakarta', '6288999989899', 'beritagar', 'tagar', '3', 'beritagar.png'),
('VENDOR0002', 'KASKUS INDONESIA', 'hrd@kaskus.com', 'Jln. Duren Sawit, Jakarta', '6283040506070', 'kaskus', 'kaskus', '3', 'LOGO-KASKUS.jpg'),
('VENDOR0003', 'Microsoft Indonesia', 'about@microsoft.com', 'Jln. Cempaka Putih, Jakarta', '6281112131415', 'microsoft', 'micro', '3', 'microsoft.png'),
('VENDOR0004', 'Indonesia Comnet Plus', 'lel@iconplus.com', 'Jln. Hayam Wuruk Jakarta Pusat', '6282021222324', 'iconplus', 'plus', '3', 'iconplus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(10) NOT NULL,
  `subjek` varchar(30) DEFAULT NULL,
  `isi` text,
  `jawaban` text,
  `nip` varchar(10) DEFAULT NULL,
  `id_vendor` varchar(10) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `subjek`, `isi`, `jawaban`, `nip`, `id_vendor`, `created_at`) VALUES
(1, 'Gagal Upload', 'kenapa pada saat ngupload materi ada error ya, makasih', '', 'GARUDA0001', NULL, '2018-02-28'),
(2, 'Chart error', 'pak. kenapa pas upload chart, malah error dan nggak muncul. mohon bantuannya.. ', 'oke.. siap.. segera dicek ya mas... (y)', NULL, 'VENDOR0001', '2018-02-28'),
(4, 'Email', 'Mas, saya belom dapat email masuk.. kenapa ya mas ??', 'sudah masuk mas.. coba dicek mas.. ', NULL, 'VENDOR0003', '2018-03-02'),
(7, 'Gagal Download', 'mas, kenapa masih gagal download ya ??', 'coba dicek lagi mas.. sdh bisa kok. makasih..', 'GARUDA0001', NULL, '2018-03-02'),
(9, 'Error Export', 'Mas, kenapa ketika saya export ke PDF, malah error ya muncul query error..', 'coba dicek mas.. sekarang sdh masuk itu.. makasih', 'GARUDA0002', NULL, '2018-03-03'),
(10, 'Grafik', 'mas.. grafik saya nggak jalan.. ada error tah ??', 'alkknglkse', NULL, 'VENDOR0001', '2018-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `report_vendor`
--

CREATE TABLE `report_vendor` (
  `id_report` int(10) NOT NULL,
  `id_vendor` varchar(10) NOT NULL,
  `id_kontrak` int(5) NOT NULL,
  `id_varkontrak` int(5) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `id_bulan` int(5) NOT NULL,
  `link_report` text NOT NULL,
  `sla` int(5) NOT NULL,
  `performance` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_vendor`
--

INSERT INTO `report_vendor` (`id_report`, `id_vendor`, `id_kontrak`, `id_varkontrak`, `tahun`, `id_bulan`, `link_report`, `sla`, `performance`) VALUES
(18, 'VENDOR0001', 1, 5, '2018', 1, 'http://localhost/garudaind/index.php?tampil=report_vendor#', 98, '78.00'),
(19, 'VENDOR0001', 1, 5, '2018', 2, 'http://localhost/garudaind/index.php?tampil=report_vendor#', 98, '89.00'),
(20, 'VENDOR0001', 1, 5, '2018', 3, 'http://localhost/garudaind/?tampil=report_vendor#', 98, '76.86'),
(21, 'VENDOR0002', 2, 6, '2018', 1, 'http://localhost/garudaind/index.php?tampil=report_vendor#', 78, '76.00'),
(22, 'VENDOR0002', 2, 6, '2018', 2, 'http://localhost/garudaind/index.php?tampil=report_vendor#', 78, '73.00');

-- --------------------------------------------------------

--
-- Table structure for table `role_login`
--

CREATE TABLE `role_login` (
  `id_role` varchar(2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='role login apps';

--
-- Dumping data for table `role_login`
--

INSERT INTO `role_login` (`id_role`, `status`) VALUES
('1', 'admin'),
('2', 'super user'),
('3', 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `varian_kontrak`
--

CREATE TABLE `varian_kontrak` (
  `id_varkontrak` int(5) NOT NULL,
  `type_varian` varchar(30) NOT NULL,
  `id_kontrak` int(5) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `bulan_mulai` int(5) NOT NULL,
  `bulan_selesai` int(5) NOT NULL,
  `sla` int(5) NOT NULL,
  `id_vendor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `varian_kontrak`
--

INSERT INTO `varian_kontrak` (`id_varkontrak`, `type_varian`, `id_kontrak`, `tahun`, `bulan_mulai`, `bulan_selesai`, `sla`, `id_vendor`) VALUES
(5, 'HC Online', 1, '2018', 1, 3, 98, 'VENDOR0001'),
(6, 'Wifi ID Unlimited', 2, '2018', 5, 11, 78, 'VENDOR0002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id_kontrak`);

--
-- Indexes for table `master_vendor`
--
ALTER TABLE `master_vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `report_vendor`
--
ALTER TABLE `report_vendor`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `role_login`
--
ALTER TABLE `role_login`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `varian_kontrak`
--
ALTER TABLE `varian_kontrak`
  ADD PRIMARY KEY (`id_varkontrak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report_vendor`
--
ALTER TABLE `report_vendor`
  MODIFY `id_report` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `varian_kontrak`
--
ALTER TABLE `varian_kontrak`
  MODIFY `id_varkontrak` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
