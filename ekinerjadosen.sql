-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 06:43 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekinerjadosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(2) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password`, `username`) VALUES
(1, 'Admin', '$2y$10$vkdp33vuTXxLV8sVk2txve1cZB2kwouJEvJRWIW3EXM7l4hz9/XtK', 'admin'),
(5, 'Test', '$2y$10$VOxylDvG0S3uBJQNdjiZWe5DC/tih0zm9hfka5QNC/OevDVu03eY.', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_penelitian`
--

CREATE TABLE `anggota_penelitian` (
  `id_ap` int(5) NOT NULL,
  `id_pen` int(5) NOT NULL,
  `nidn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_penelitian`
--

INSERT INTO `anggota_penelitian` (`id_ap`, `id_pen`, `nidn`) VALUES
(242, 176, '0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `buku_ajar`
--

CREATE TABLE `buku_ajar` (
  `id_buku_ajar` int(5) NOT NULL,
  `nidn_buku_ajar` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `judul_buku_ajar` text NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `jumlah_halaman` int(4) NOT NULL,
  `penerbit` tinytext NOT NULL,
  `keterangan_invalid` text DEFAULT NULL,
  `tahun_buku_ajar` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` varchar(10) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `jekel` varchar(1) NOT NULL,
  `gelar` varchar(25) DEFAULT NULL,
  `jabatan_akademik` varchar(25) DEFAULT NULL,
  `program_studi` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama_dosen`, `nip`, `jekel`, `gelar`, `jabatan_akademik`, `program_studi`, `password`) VALUES
('0000000001', 'Shaf', '001', 'L', 'Dr.', 'Rektor', 'Informatika', '$2y$10$I7azPSOoGm6rLILJh3osq.pH1muKgBNHDCcexGAJA5Ooss4Cbb5tu');

-- --------------------------------------------------------

--
-- Table structure for table `hki`
--

CREATE TABLE `hki` (
  `id_hki` int(5) NOT NULL,
  `nidn_hki` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `judul_hki` text NOT NULL,
  `jenis_hki` varchar(50) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `status_hki` varchar(50) NOT NULL,
  `no_hki` varchar(20) NOT NULL,
  `kd_sts_berkas_hki` int(1) NOT NULL,
  `keterangan_invalid` text DEFAULT NULL,
  `tahun_hki` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(5) NOT NULL,
  `judul_jurnal` text NOT NULL,
  `nama_jurnal` text NOT NULL,
  `nama_personil` varchar(225) NOT NULL,
  `issn` varchar(9) NOT NULL,
  `volume` varchar(5) NOT NULL,
  `nomor1` varchar(5) NOT NULL,
  `halaman_awal` int(5) NOT NULL,
  `halaman_akhir` int(5) NOT NULL,
  `url` text NOT NULL,
  `tahun_jurnal` year(4) NOT NULL,
  `tingkat` varchar(13) NOT NULL,
  `status_akreditasi` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemakalah`
--

CREATE TABLE `pemakalah` (
  `id_pemakalah` int(5) NOT NULL,
  `nidn_pem` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `status_pemakalah` varchar(30) NOT NULL,
  `judul_makalah` text NOT NULL,
  `nama_forum` text NOT NULL,
  `institusi_penyelenggara` tinytext NOT NULL,
  `tgl_mulai_pelaksanaan` date NOT NULL,
  `tgl_akhir_pelaksanaan` date NOT NULL,
  `tempat_pelaksanaan` tinytext NOT NULL,
  `kd_sts_berkas_makalah` int(1) NOT NULL,
  `keterangan_invalid` text DEFAULT NULL,
  `tahun_pemakalah` year(4) NOT NULL,
  `tingkat` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id_penelitian` int(5) NOT NULL,
  `nidn_ketua` varchar(10) NOT NULL,
  `nama_ketua` varchar(100) DEFAULT NULL,
  `nama_anggota` varchar(225) DEFAULT NULL,
  `judul_penelitian` text NOT NULL,
  `nama_skema` varchar(100) NOT NULL,
  `jumlah_dana` int(10) NOT NULL,
  `tahun_penelitian` year(4) NOT NULL,
  `bidang_penelitian` varchar(100) DEFAULT NULL,
  `bidang_penelitian_lain` varchar(100) DEFAULT NULL,
  `tujuan_sosial_ekonomi` varchar(100) DEFAULT NULL,
  `tujuan_sosial_ekonomi_lain` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `nidn_ketua`, `nama_ketua`, `nama_anggota`, `judul_penelitian`, `nama_skema`, `jumlah_dana`, `tahun_penelitian`, `bidang_penelitian`, `bidang_penelitian_lain`, `tujuan_sosial_ekonomi`, `tujuan_sosial_ekonomi_lain`) VALUES
(176, '0000000001', NULL, NULL, 'Test', 'Penelitian Dasar', 23431231, 2022, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  ADD PRIMARY KEY (`id_ap`),
  ADD KEY `id_penelitian` (`id_pen`),
  ADD KEY `nidn_agt` (`nidn`) USING BTREE;

--
-- Indexes for table `buku_ajar`
--
ALTER TABLE `buku_ajar`
  ADD PRIMARY KEY (`id_buku_ajar`),
  ADD KEY `nidn_buku_ajar` (`nidn_buku_ajar`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `hki`
--
ALTER TABLE `hki`
  ADD PRIMARY KEY (`id_hki`),
  ADD KEY `nidn_hki` (`nidn_hki`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `pemakalah`
--
ALTER TABLE `pemakalah`
  ADD PRIMARY KEY (`id_pemakalah`),
  ADD KEY `nidn_pem` (`nidn_pem`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id_penelitian`),
  ADD KEY `nidn` (`nidn_ketua`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  MODIFY `id_ap` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `buku_ajar`
--
ALTER TABLE `buku_ajar`
  MODIFY `id_buku_ajar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hki`
--
ALTER TABLE `hki`
  MODIFY `id_hki` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `pemakalah`
--
ALTER TABLE `pemakalah`
  MODIFY `id_pemakalah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  ADD CONSTRAINT `anggota_penelitian_ibfk_1` FOREIGN KEY (`id_pen`) REFERENCES `penelitian` (`id_penelitian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku_ajar`
--
ALTER TABLE `buku_ajar`
  ADD CONSTRAINT `buku_ajar_ibfk_1` FOREIGN KEY (`nidn_buku_ajar`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hki`
--
ALTER TABLE `hki`
  ADD CONSTRAINT `hki_ibfk_1` FOREIGN KEY (`nidn_hki`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemakalah`
--
ALTER TABLE `pemakalah`
  ADD CONSTRAINT `pemakalah_ibfk_1` FOREIGN KEY (`nidn_pem`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_ibfk_1` FOREIGN KEY (`nidn_ketua`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
