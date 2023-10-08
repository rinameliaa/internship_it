-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2023 at 09:35 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuibird`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_departemen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
('01', 'IT'),
('02', 'Finance'),
('03', 'Logistic'),
('04', 'Purchasing'),
('05', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_pendidikan` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_departemen` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_level_grade` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `id_pendidikan`, `id_departemen`, `id_level_grade`, `status`, `username`, `password`) VALUES
('1696590866', '3517196009890001', 'Yuliani', 'Jombang', '1989-09-20', '06', '05', '01', '1', 'yuli', 'RU1XQU9iWXE4NHZxYkEzVDU4d2tJUT09'),
('1696590877', '3517196009890002', 'Hendrawan', 'Jombang', '1989-09-20', '06', '02', '03', '1', 'hendra', 'RU1XQU9iWXE4NHZxYkEzVDU4d2tJUT09');

-- --------------------------------------------------------

--
-- Table structure for table `level_grade`
--

CREATE TABLE `level_grade` (
  `id_level_grade` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_level` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `akses_tambah` int NOT NULL,
  `akses_update` int NOT NULL,
  `akses_hapus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `level_grade`
--

INSERT INTO `level_grade` (`id_level_grade`, `nama_level`, `akses_tambah`, `akses_update`, `akses_hapus`) VALUES
('01', 'Level 1', 1, 1, 1),
('02', 'Level 2', 0, 0, 0),
('03', 'Level 3', 0, 0, 0),
('04', 'Level 4', 0, 0, 0),
('05', 'Level 5', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pendidikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `nama_pendidikan`) VALUES
('01', 'Tidak/Belum Sekolah'),
('02', 'Belum Tamat SD/Sederajat'),
('03', 'Tamat SD/Sederajat'),
('04', 'SLTP/Sederajat'),
('05', 'SLTA/Sederajat'),
('06', 'Diploma I/II'),
('07', 'Akademi/Diploma III/Sarjana Muda'),
('08', 'Diploma IV/Strata I'),
('09', 'Strata II'),
('10', 'Strata III');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`) USING BTREE;

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`) USING BTREE,
  ADD KEY `id_pendidikan` (`id_pendidikan`) USING BTREE,
  ADD KEY `id_departemen` (`id_departemen`) USING BTREE,
  ADD KEY `id_level_grade` (`id_level_grade`) USING BTREE;

--
-- Indexes for table `level_grade`
--
ALTER TABLE `level_grade`
  ADD PRIMARY KEY (`id_level_grade`) USING BTREE;

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id_pendidikan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_3` FOREIGN KEY (`id_level_grade`) REFERENCES `level_grade` (`id_level_grade`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
