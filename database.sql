-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 09:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notulen`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(16) NOT NULL,
  `id_instansi` int(10) NOT NULL,
  `nama_divsi` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `id_instansi`, `nama_divsi`) VALUES
(1, 12, 'HRD'),
(2, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id_instansi` int(15) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `informasi` text NOT NULL,
  `fax` varchar(30) NOT NULL,
  `npwp` varchar(40) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `favicon` varchar(40) NOT NULL,
  `keterangan_situs` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `alamat_lengkap`, `telp`, `informasi`, `fax`, `npwp`, `logo`, `favicon`, `keterangan_situs`) VALUES
(97, '[removed][removed]', 'Jl.Talang ', '081273328123', 'Sistem informasi arsip ini adalah : untuk mempermudah dalam pengarsipan setiap bentuk dokumen dalam suatu instansi organinsasi , yang sewaktu - waktu dapat di lihat kembali data dokumen yang terarsipkan sebelumnya', '081273328123', '923042-882-302-', '1575454144logo.JPG', '1575454144logo1.JPG', 'fghjkl');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nama` varchar(59) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `level` enum('user','admin','','') NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_create` date NOT NULL,
  `log` datetime DEFAULT NULL,
  `id_divisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `nama`, `email`, `foto`, `level`, `active`, `date_create`, `log`, `id_divisi`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'administrator', 'admin@admin.com', 'foto1575381572.JPG', 'admin', 'Y', '0000-00-00', '2019-12-03 14:59:32', '1\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(5) NOT NULL,
  `id_parent` int(5) NOT NULL DEFAULT '0',
  `nama_menu` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `urutan` int(3) NOT NULL,
  `position` enum('Bottom','Top','','') NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_parent`, `nama_menu`, `icon`, `link`, `aktif`, `urutan`, `position`, `level`) VALUES
(18, 0, 'Divisi', 'icon-directions  fa-fw', 'Divisi', 'Ya', 5, 'Bottom', 'admin.user'),
(14, 0, 'Login', 'icon-user-following  fa-fw', 'Login', 'Ya', 3, 'Bottom', 'admin.user'),
(15, 0, 'Notulen Detail', 'icon-energy  fa-fw', 'Notulen_detail', 'Ya', 4, 'Bottom', 'admin.user'),
(13, 0, 'Notulen', 'icon-list fa-fw', 'Notulen', 'Ya', 2, 'Bottom', 'admin.user'),
(12, 0, 'Instansi', 'icon-wrench  fa-fw', 'Instansi', 'Ya', 1, 'Bottom', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `notulen`
--

CREATE TABLE `notulen` (
  `id_notulen` int(15) NOT NULL,
  `agenda` text NOT NULL,
  `id_create` int(15) NOT NULL,
  `start_time` varchar(15) NOT NULL,
  `end_time` varchar(15) NOT NULL,
  `place` varchar(15) NOT NULL,
  `participan` varchar(15) NOT NULL,
  `date_create` date DEFAULT NULL,
  `absensi` varchar(50) NOT NULL,
  `tdd_pimpinan` varchar(60) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `no_revisi` varchar(50) NOT NULL,
  `notulis` varchar(100) NOT NULL,
  `pimpinan_rapat` varchar(100) NOT NULL,
  `jenis_rapat` varchar(100) NOT NULL,
  `no_agenda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notulen`
--

INSERT INTO `notulen` (`id_notulen`, `agenda`, `id_create`, `start_time`, `end_time`, `place`, `participan`, `date_create`, `absensi`, `tdd_pimpinan`, `no_dokumen`, `no_revisi`, `notulis`, `pimpinan_rapat`, `jenis_rapat`, `no_agenda`) VALUES
(5, 'asdad', 1, '02:02', '14:02', 'asd', 'asdasd,adada,ad', '2019-12-04', 'absensi_1575472419.png', 'absensi_15754724191.png', '34242', '23424', '2423432', '4324', '2432', 'awds'),
(6, 'asdad', 1, '02:02', '14:02', 'asd', 'asdasd,adada,ad', '2019-12-04', 'absensi_1575472478.png', 'absensi_15754724781.png', '34242', '23424', '2423432', '4324', '2432', 'awds');

-- --------------------------------------------------------

--
-- Table structure for table `notulen_detail`
--

CREATE TABLE `notulen_detail` (
  `id_not_detail` int(15) NOT NULL,
  `id_notulen` int(15) NOT NULL,
  `issue` text NOT NULL,
  `PIC` varchar(50) NOT NULL,
  `due_dete` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `division` varchar(70) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notulen_detail`
--

INSERT INTO `notulen_detail` (`id_not_detail`, `id_notulen`, `issue`, `PIC`, `due_dete`, `status`, `remarks`, `division`, `date_created`) VALUES
(7, 4, 'sjfansfkasfnasklfmaslkfmasklfamkslfmalkfs', 'moko,proxy', '2019-12-03', 'Y', 'bn', 'assa', '2019-12-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `notulen`
--
ALTER TABLE `notulen`
  ADD PRIMARY KEY (`id_notulen`);

--
-- Indexes for table `notulen_detail`
--
ALTER TABLE `notulen_detail`
  ADD PRIMARY KEY (`id_not_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notulen`
--
ALTER TABLE `notulen`
  MODIFY `id_notulen` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notulen_detail`
--
ALTER TABLE `notulen_detail`
  MODIFY `id_not_detail` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
