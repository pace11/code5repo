-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2018 at 04:58 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codefive`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `last_login`) VALUES
(1, 'pace', '5ba1c4ecf208b1757df653813416a886', '2018-10-07 14:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `id_reg` varchar(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `tipe` varchar(30) NOT NULL,
  `desc_ta` text NOT NULL,
  `desc_metode` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`id_reg`, `nama`, `email`, `no_hp`, `tipe`, `desc_ta`, `desc_metode`, `updated_at`, `deleted_at`) VALUES
('CODEREG0001', 'Muhammad Iriansyah Putra Pratama', 'ryanjoker87@gmail.com', '452525252525', 'Mobile Apps (Android)', 'adadad', 'adadad', NULL, NULL),
('CODEREG0002', 'miaw', 'frayhands@gmail.com', '081385691235', 'Mobile Apps (Android)', 'aplikasi ngewe online', 'woman on top', NULL, NULL),
('CODEREG0003', 'Muhammad Iriansyah Putra Pratama', 'ryanjoker87@gmail.com', '082248080870', 'Desktop Apps(VB.net,C#)', 'Chatbot Untuk menjawab pertanyan seputar KRSan', 'Cosine Similarity dan Naive Bayes', NULL, NULL),
('CODEREG0004', 'Muhammad Iriansyah Putra Pratama', 'ryanjoker87@gmail.com', '082248080870', 'Embeeded Apps (Alat)', 'adada', 'adad', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`id_reg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
