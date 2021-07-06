-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 08:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `no_induk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id`, `username`, `nama_admin`, `no_induk`) VALUES
(1, 'admin', 'ADMIN', '111'),
(2, 'admin3', 'MINA', '112'),
(3, 'admin2', 'ADMIN2', '113');

-- --------------------------------------------------------

--
-- Table structure for table `tambah_kelas`
--

CREATE TABLE `tambah_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambah_kelas`
--

INSERT INTO `tambah_kelas` (`id`, `kelas`) VALUES
(1, 'X RPL 1'),
(2, 'XI RPL 1'),
(3, 'XII RPL 1'),
(4, 'X MM 1'),
(5, 'X TKJ 1'),
(6, 'XI RPL 2');

-- --------------------------------------------------------

--
-- Table structure for table `tambah_siswa`
--

CREATE TABLE `tambah_siswa` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `kelas_siswa` varchar(100) NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambah_siswa`
--

INSERT INTO `tambah_siswa` (`id`, `username`, `nama_siswa`, `nis`, `kelas_siswa`, `kelamin`, `alamat`, `tempat_lahir`, `tanggal_lahir`) VALUES
(2, 'fauzi', 'FAUZI ADITYA PRATAMA', '192010007', 'XI RPL 1', 'L', 'puri cendana blok f 11 no 0', 'CILACAP', '2004-01-03'),
(5, 'bayu', 'AGIS BAYU RAGA', '192010001', 'XI RPL 1', 'L', 'bekasi', 'BEKASI', '2004-01-02'),
(8, 'putri', 'AMALIA PUTRI CANTIKA', '192010009', 'X MM 1', 'P', 'puri cendana blok f 11 no 9', 'BEKASI', '2013-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `datetime_masuk` varchar(100) NOT NULL,
  `datetime_keluar` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id`, `username`, `datetime_masuk`, `datetime_keluar`, `status`) VALUES
(1, 'FAUZI', '4 11/3/2021 15:27:16', '5 12/3/2021 20:48:48', 'Terlambat'),
(2, 'FAUZI', '5 12/3/2021 20:48:46', '5 12/3/2021 20:48:48', 'Terlambat'),
(4, 'BAYU', '2 23/3/2021 14:34:20', '', 'Tepat Waktu'),
(5, 'FAUZI', '2 23/3/2021 14:35:53', '', 'Tepat Waktu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan_absen`
--

CREATE TABLE `tb_pengaturan_absen` (
  `id` int(11) NOT NULL,
  `jam_masuk_awal` varchar(100) NOT NULL,
  `jam_masuk_akhir` varchar(100) NOT NULL,
  `jam_pulang_awal` varchar(100) NOT NULL,
  `jam_pulang_akhir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengaturan_absen`
--

INSERT INTO `tb_pengaturan_absen` (`id`, `jam_masuk_awal`, `jam_masuk_akhir`, `jam_pulang_awal`, `jam_pulang_akhir`) VALUES
(1, '7', '15', '15', '24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(3, 'admin2', 'admin2', 'admin'),
(4, 'admin3', 'admin', 'admin'),
(5, 'fauzi', 'fauzi', 'user'),
(8, 'bayu', 'bayu', 'user'),
(10, 'putri', 'putri', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tambah_kelas`
--
ALTER TABLE `tambah_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tambah_siswa`
--
ALTER TABLE `tambah_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengaturan_absen`
--
ALTER TABLE `tb_pengaturan_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tambah_kelas`
--
ALTER TABLE `tambah_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tambah_siswa`
--
ALTER TABLE `tambah_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pengaturan_absen`
--
ALTER TABLE `tb_pengaturan_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
