-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 04:57 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblsiswa`
--

CREATE TABLE `tblsiswa` (
  `no` int(3) NOT NULL,
  `nis` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` varchar(20) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsiswa`
--

INSERT INTO `tblsiswa` (`no`, `nis`, `nama`, `jk`, `alamat`, `no_hp`) VALUES
(6, 1, 'Hendi ', 'perempuan', 'kk', '08888'),
(10, 66, 'as', 'perempuan', 'kk', '099');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `nis_2` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  MODIFY `no` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
