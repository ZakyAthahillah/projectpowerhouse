-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2023 pada 03.05
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `total` varchar(100) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_transaksi`, `tanggal`, `kode_barang`, `nama_barang`, `jumlah`, `satuan`, `catatan`, `total`, `id_pegawai`, `id_users`) VALUES
(121, 'WBM-BK-1689591989-5629', '2023-07-17', 'CV-B-002', 'MOTOR INDUCTOR 350KW 4P 1500RPM FRAME', '1', 'UNIT', 'Done', '0', 54, 27),
(122, 'WBM-BK-1689592004-7164', '2023-07-17', 'CV-B-006', 'MOTOR INDUCTOR 132KW 4P 1500RPM FRAME 315M', '1', 'UNIT', 'Done', '0', 56, 27),
(124, 'WBM-BK-1689593404-6154', '2023-07-17', 'CV-B-007', 'MOTOR INDUCTOR 90KW 4P 1500RPM', '1', 'UNIT', 'Done', '1', 55, 27),
(125, 'WBM-BK-1689593415-1155', '2023-07-17', 'CV-C-003', 'INPUT COUPLING SH80S', '1', 'UNIT', 'Done', '1', 46, 27),
(126, 'WBM-BK-1689593425-6092', '2023-07-17', 'CV-B-003', 'MOTOR INDUCTOR 75KW 4P 1500RPM FRAME 280S', '1', 'UNIT', 'Done', '2', 53, 27);

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah-new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `catatan` varchar(200) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_transaksi`, `tanggal`, `kode_barang`, `nama_barang`, `jumlah`, `satuan`, `catatan`, `id_supplier`, `id_users`) VALUES
(73, 'WBM-BM-1689593521-9456', '2023-07-17', 'CV-B-007', 'MOTOR INDUCTOR 90KW 4P 1500RPM', '2', 'UNIT', 'Done', 15, 27),
(74, 'WBM-BM-1689593533-5575', '2023-07-17', 'CV-B-004', 'MOTOR INDUCTOR 160KW 4P 1500RPM FRAME 315S', '1', 'UNIT', 'Done', 14, 27),
(75, 'WBM-BM-1689593547-4288', '2023-07-17', 'CV-B-005', 'MOTOR INDUCTOR 37KW 4P 1500RPM FRAME 225S', '2', 'UNIT', 'Done', 14, 27),
(76, 'WBM-BM-1689593560-5140', '2023-07-17', 'CV-B-004', 'MOTOR INDUCTOR 160KW 4P 1500RPM FRAME 315S', '2', 'UNIT', 'Done', 14, 27),
(77, 'WBM-BM-1689593570-8871', '2023-07-17', 'CV-B-001', 'MOTOR INDUCTOR 250KW 4P 1500RPM FRAME 355M', '1', 'UNIT', 'Done', 12, 27);

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah+new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barge`
--

CREATE TABLE `barge` (
  `id_barge` int(11) NOT NULL,
  `nama_barge` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barge`
--

INSERT INTO `barge` (`id_barge`, `nama_barge`, `status`) VALUES
(1, 'TERANG 3003', '<span class=\"badge badge-success\">Baik</span>'),
(3, 'MBS 273', '<span class=\"badge badge-success\">Baik</span>'),
(4, 'DSR 39', '<span class=\"badge badge-success\">Baik</span>'),
(5, 'DANNY 79', '<span class=\"badge badge-warning\">Maintenance</span>'),
(7, 'BULESKO 1', '<span class=\"badge badge-success\">Baik</span>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blending`
--

CREATE TABLE `blending` (
  `id_blending` int(11) NOT NULL,
  `kode_sbp` varchar(25) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `plan` varchar(100) NOT NULL,
  `bcrush` varchar(100) NOT NULL,
  `ycrush` varchar(100) NOT NULL,
  `gcrush` varchar(100) NOT NULL,
  `catatan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `blending`
--

INSERT INTO `blending` (`id_blending`, `kode_sbp`, `tanggal`, `start`, `finish`, `plan`, `bcrush`, `ycrush`, `gcrush`, `catatan`) VALUES
(3, '060523', '2023-06-23', '2023-07-16', '2023-07-16', '131231', '1232', '1212', '2313', 'Done'),
(4, '060523', '2023-06-22', '2023-07-16', '2023-07-16', '2000', '1000', '500', '500', 'Done'),
(5, '060523', '2023-07-11', '2023-07-16', '2023-07-16', '2000', '1500', '500', '1000', 'Done'),
(8, '120723', '2023-07-17', '2023-07-16', '2023-07-16', '2000', '1232', '123', '2313', 'Done'),
(9, '120723', '2023-07-22', '2023-07-22', '2023-07-25', '2000', '1232', '123', '1000', 'Done');

-- --------------------------------------------------------

--
-- Struktur dari tabel `crushingicf`
--

CREATE TABLE `crushingicf` (
  `id_crushing` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `id_rcicf` int(11) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `crushingicf`
--

INSERT INTO `crushingicf` (`id_crushing`, `tanggal`, `start`, `finish`, `id_rcicf`, `jumlah`, `id_users`, `catatan`) VALUES
(21, '2023-06-15', '23:18:00', '00:18:00', 11, '313.5', 29, 'Done'),
(22, '2023-06-20', '23:44:00', '00:44:00', 12, '313.5', 27, 'Done'),
(24, '2023-07-17', '19:42:00', '21:42:00', 6, '400', 27, 'Done'),
(26, '2023-07-13', '19:42:00', '20:42:00', 6, '200.54', 27, 'Done');

-- --------------------------------------------------------

--
-- Struktur dari tabel `crushingjty`
--

CREATE TABLE `crushingjty` (
  `id_crushing` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `id_rcjty` int(11) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `crushingjty`
--

INSERT INTO `crushingjty` (`id_crushing`, `tanggal`, `start`, `finish`, `id_rcjty`, `jumlah`, `id_users`, `catatan`) VALUES
(14, '2023-06-01', '13:09:00', '23:28:14', 2, '450', 27, 'Done'),
(22, '2023-06-02', '22:28:00', '23:28:00', 1, '543', 29, 'Done'),
(23, '2023-06-20', '23:43:00', '00:43:00', 9, '313.5', 27, 'Done'),
(25, '2023-07-05', '20:24:00', '21:24:00', 1, '200', 27, 'Done'),
(26, '2023-07-06', '20:27:00', '21:27:00', 2, '200', 29, 'Done');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokmuatan`
--

CREATE TABLE `dokmuatan` (
  `id_dokmuatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `id_dumptruck` int(11) NOT NULL,
  `tdepart` time NOT NULL,
  `ltool` varchar(100) NOT NULL,
  `seam` varchar(100) NOT NULL,
  `wb` time NOT NULL,
  `hopper` time NOT NULL,
  `loading` varchar(100) NOT NULL,
  `dumping` varchar(100) NOT NULL,
  `tonnes1` varchar(100) NOT NULL,
  `tonnes2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokmuatan`
--

INSERT INTO `dokmuatan` (`id_dokmuatan`, `tanggal`, `shift`, `nomor`, `company`, `id_dumptruck`, `tdepart`, `ltool`, `seam`, `wb`, `hopper`, `loading`, `dumping`, `tonnes1`, `tonnes2`) VALUES
(2, '2023-07-28', 'Night', '123334', 'PT. KAI', 1, '19:14:30', 'Conveyor', 'Blue Crush', '19:14:27', '19:14:33', 'ICF', 'JETTY', '12500', '12500'),
(3, '2023-07-22', 'Day', '127755', 'PT. KAI', 6, '20:03:00', 'Conveyor', 'Yellow Crush', '21:03:00', '22:03:00', 'ICF', 'JETTY', '124500', '124600');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dumptruck`
--

CREATE TABLE `dumptruck` (
  `id_dumptruck` int(11) NOT NULL,
  `nama_dumptruck` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dumptruck`
--

INSERT INTO `dumptruck` (`id_dumptruck`, `nama_dumptruck`, `status`) VALUES
(1, 'SDT 01', '<span class=\"badge badge-success\">Baik</span>'),
(3, 'SDT 02', '<span class=\"badge badge-warning\">Maintenance</span>'),
(6, 'SDT 03', '<span class=\"badge badge-success\">Baik</span>'),
(7, 'SDT 04', '<span class=\"badge badge-warning\">Maintenance</span>'),
(8, 'SDT 05', '<span class=\"badge badge-success\">Baik</span>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `kode_barang`, `nama_barang`, `jumlah`, `id_lokasi`, `id_satuan`, `id_jenis`) VALUES
(201, 'CV-B-001', 'MOTOR INDUCTOR 250KW 4P 1500RPM FRAME 355M', '3', 6, 5, 14),
(202, 'CV-B-002', 'MOTOR INDUCTOR 350KW 4P 1500RPM FRAME', '1', 9, 5, 14),
(203, 'CV-B-003', 'MOTOR INDUCTOR 75KW 4P 1500RPM FRAME 280S', '1', 8, 5, 14),
(204, 'CV-B-004', 'MOTOR INDUCTOR 160KW 4P 1500RPM FRAME 315S', '5', 7, 5, 14),
(205, 'CV-B-005', 'MOTOR INDUCTOR 37KW 4P 1500RPM FRAME 225S', '3', 9, 5, 14),
(206, 'CV-B-006', 'MOTOR INDUCTOR 132KW 4P 1500RPM FRAME 315M', '0', 9, 5, 14),
(207, 'CV-B-007', 'MOTOR INDUCTOR 90KW 4P 1500RPM', '3', 9, 5, 14),
(209, 'CV-C-001', 'INPUT COUPLING SH100S', '0', 7, 12, 13),
(210, 'CV-C-003', 'INPUT COUPLING SH80S', '1', 8, 5, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `jenis_barang`) VALUES
(10, 'CONVEYOR BELT'),
(11, 'ROLLER'),
(12, 'GEARBOX'),
(13, 'INPUT COUPLING'),
(14, 'MOTOR INDUCTOR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loading`
--

CREATE TABLE `loading` (
  `id_loading` int(11) NOT NULL,
  `kode_sbp` varchar(25) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `id_rcjty` int(11) NOT NULL,
  `id_barge` int(11) NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `catatan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `loading`
--

INSERT INTO `loading` (`id_loading`, `kode_sbp`, `tanggal`, `id_rcjty`, `id_barge`, `start`, `finish`, `jumlah`, `id_users`, `catatan`) VALUES
(19, '060523', '2023-06-09', 2, 1, '20:59:00', '20:59:00', '4300', 27, 'Done'),
(24, '230523', '2023-07-16', 2, 3, '21:46:00', '22:46:00', '200.34', 29, 'Done'),
(39, '230523', '2023-07-11', 1, 3, '19:39:00', '19:40:00', '200', 41, 'Done'),
(40, '230523', '2023-07-17', 4, 4, '20:54:00', '20:55:00', '200', 27, 'Done'),
(41, '060523', '2023-07-17', 1, 3, '20:55:00', '21:55:00', '200', 27, 'Done'),
(42, '170723', '2023-07-18', 9, 5, '20:56:00', '22:56:00', '200', 27, 'Done'),
(43, '120723', '2023-07-17', 3, 1, '20:56:00', '21:56:00', '1500', 27, 'Done'),
(44, '060723', '2023-07-07', 2, 1, '20:57:00', '23:57:00', '143', 27, 'Done');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lokasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `lokasi`) VALUES
(6, 'GUDANG BESAR'),
(7, 'WAREHOUSE'),
(8, 'OFFICE WORKSHOP PANTAI'),
(9, 'WORKSHOP PANTAI'),
(10, 'POWERHOUSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operatorht`
--

CREATE TABLE `operatorht` (
  `id_optht` int(11) NOT NULL,
  `nama_optht` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `operatorht`
--

INSERT INTO `operatorht` (`id_optht`, `nama_optht`) VALUES
(1, 'M. Syaiful'),
(2, 'Karim'),
(4, 'Hendra Pratama'),
(5, 'Irfan Maulana'),
(6, 'Dwi Kurniawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `bagian` varchar(200) NOT NULL,
  `telepon` int(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `bagian`, `telepon`, `alamat`, `foto`) VALUES
(40, '7958126755552030', 'Rudy', 'Foreman Mechanical', 2147483647, 'BANJARMASIN', 'bayan.png'),
(41, '7958126755552030', 'M. Ruhi', 'Operator Control Room', 2147483647, 'BANJARBARU', 'bayan.png'),
(42, '7958126755552030', 'Hermansyah', 'Helper Mechanical', 2147483647, 'BANJARBARU', 'bayan.png'),
(43, '7958126755552030', 'Amat', 'Operator Control Room', 2147483647, 'BANJARMASIN', 'bayan.png'),
(44, '7958126755552030', 'M. Faisal', 'Foreman Electrical', 2147483647, 'BANJARBARU', 'bayan.png'),
(45, '7958126755552030', 'Abdul Hamid', 'Helper Mechanical', 2147483647, 'BANJARMASIN', 'bayan.png'),
(46, '7958126755552030', 'Bana', 'Operator Control Room', 2147483647, 'BANJARBARU', 'bayan.png'),
(47, '7958126755552030', 'Mahyuddin', 'Assistant Foreman Electrical', 2147483647, 'BANJARBARU', 'bayan.png'),
(48, '7958126755552030', 'Alfian', 'Helper Mechanical', 2147483647, 'BANJARMASIN', 'bayan.png'),
(49, '7958126755552030', 'Hendra', 'Operator Control Room', 2147483647, 'BANJARBARU', 'bayan.png'),
(50, '7958126755552030', 'Burhan Hadi', 'Foreman Control Room', 2147483647, 'BANJARMASIN', 'bayan.png'),
(51, '7958126755552030', 'M. Syaripani', 'Helper Mechanical', 2147483647, 'BANJARBARU', 'bayan.png'),
(52, '7958126755552030', 'Said', 'Helper Electrical', 2147483647, 'BANJARBARU', 'bayan.png'),
(53, '7958126755552030', 'Wahyudi', 'Operator Control Room', 2147483647, 'BANJARMASIN', 'bayan.png'),
(54, '7958126755552030', 'Daryanto', 'Helper Electrical', 2147483647, 'BANJARBARU', 'bayan.png'),
(55, '7958126755552030', 'Mahdi', 'Helper Mechanical', 2147483647, 'BANJARMASIN', 'bayan.png'),
(56, '7958126755552030', 'Noor Ilham', 'Foreman Electrical', 2147483647, 'BANJARBARU', 'bayan.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `laporan` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `tanggal`, `nama`, `posisi`, `laporan`) VALUES
(9, '0000-00-00', '', '', ''),
(10, '2023-06-16', 'saya saya', 'manajer', 'tolong reset pw saya\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po`
--

CREATE TABLE `po` (
  `id` int(11) NOT NULL,
  `kode_po` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) CHARACTER SET latin1 NOT NULL,
  `jumlah_po` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `po`
--

INSERT INTO `po` (`id`, `kode_po`, `tanggal`, `kode_barang`, `jumlah_po`, `status`) VALUES
(52, 'PRO-12345', '2023-06-08', 'CV-B-001', '2', 'P-O telah di proses oleh warehouse'),
(53, 'PRO-12345', '2023-06-08', 'CV-B-002', '2', 'P-O telah di proses oleh warehouse'),
(54, 'PRO-12345', '2023-06-08', 'CV-B-003', '2', 'P-O telah di proses oleh warehouse'),
(55, 'PRO-12345', '2023-06-08', 'CV-B-004', '2', 'P-O telah di proses oleh warehouse'),
(56, 'PRO-12345', '2023-06-08', 'CV-B-005', '2', 'P-O telah di proses oleh warehouse'),
(57, 'PRO-12346', '2023-06-02', 'CV-B-001', '2', 'P-O akan diproses oleh warehouse'),
(58, 'PRO-12346', '2023-06-02', 'CV-B-004', '2', 'P-O akan diproses oleh warehouse'),
(59, 'PRO-12346', '2023-06-02', 'CV-B-007', '2', 'P-O akan diproses oleh warehouse'),
(60, 'PRO-12346', '2023-06-02', 'CV-C-001', '2', 'P-O akan diproses oleh warehouse'),
(61, 'PRO-12346', '2023-06-02', 'CV-B-007', '2', 'P-O akan diproses oleh warehouse'),
(68, 'PRO-12347', '2023-06-01', 'CV-B-001', '2', 'P-O telah di proses oleh warehouse'),
(69, 'PRO-12347', '2023-06-01', 'CV-B-007', '3', 'P-O telah di proses oleh warehouse'),
(70, 'PRO-12347', '2023-06-01', 'CV-C-001', '5', 'P-O telah di proses oleh warehouse'),
(71, 'PRO-12347', '2023-06-01', 'CV-C-003', '1', 'P-O telah di proses oleh warehouse'),
(72, 'PRO-12347', '2023-06-01', 'CV-C-003', '1', 'P-O telah di proses oleh warehouse'),
(74, 'PRO-12340', '2023-05-10', 'CV-B-001', '1', 'P-O akan diproses oleh warehouse'),
(75, 'PRO-12340', '2023-05-10', 'CV-C-003', '1', 'P-O akan diproses oleh warehouse'),
(76, 'PRO-12340', '2023-05-10', 'CV-C-001', '2', 'P-O akan diproses oleh warehouse'),
(77, 'PRO-12340', '2023-05-10', 'CV-B-007', '7', 'P-O akan diproses oleh warehouse'),
(78, 'PRO-12340', '2023-05-10', 'CV-B-006', '3', 'P-O akan diproses oleh warehouse'),
(79, 'PRO-12340', '2023-05-10', 'CV-C-003', '1', 'P-O akan diproses oleh warehouse');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(5, 'UNIT'),
(8, 'PACK'),
(12, 'PCS'),
(13, 'LITER'),
(14, 'METER'),
(15, 'ROLL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sbp`
--

CREATE TABLE `sbp` (
  `kode_sbp` varchar(25) CHARACTER SET latin1 NOT NULL,
  `nama_sbp` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tittle` varchar(250) CHARACTER SET latin1 NOT NULL,
  `size` int(11) NOT NULL,
  `ekstensi` varchar(25) CHARACTER SET latin1 NOT NULL,
  `berkas` varchar(2000) CHARACTER SET latin1 NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sbp`
--

INSERT INTO `sbp` (`kode_sbp`, `nama_sbp`, `tittle`, `size`, `ekstensi`, `berkas`, `status`) VALUES
('060523', 'SBP-06/05/2023', 'Shipment Blending Plan.pdf', 262292, 'pdf', 'file/Shipment Blending Plan.pdf', 'Upload Baru'),
('060723', 'SBP-06/07/2023', 'Shipment Blending Plan.pdf', 262292, 'pdf', 'file/Shipment Blending Plan.pdf', 'Upload Baru'),
('120723', 'SBP-12/07/2023', 'Shipment Blending Plan.pdf', 262292, 'pdf', 'file/Shipment Blending Plan.pdf', 'Selesai'),
('170723', 'SBP-17/07/2023', 'Shipment Blending Plan.pdf', 262292, 'pdf', 'file/Shipment Blending Plan.pdf', 'Sedang Dalam Proses'),
('230523', 'SBP-23/05/2023', 'Shipment Blending Plan.pdf', 262292, 'pdf', 'file/Shipment Blending Plan.pdf', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scicf`
--

CREATE TABLE `scicf` (
  `id_rcicf` int(11) NOT NULL,
  `nama_rcicf` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `stok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `scicf`
--

INSERT INTO `scicf` (`id_rcicf`, `nama_rcicf`, `warna`, `stok`) VALUES
(6, 'RC 1', 'HIJAU', '5845.54'),
(7, 'RC 2', 'BIRU', '4800'),
(8, 'RC 3', 'KUNING', '25000'),
(11, 'RC 4', 'BIRU', '1313.5'),
(12, 'RC 5', 'BIRU', '11063.05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scjty`
--

CREATE TABLE `scjty` (
  `id_rcjty` int(11) NOT NULL,
  `nama_rcjty` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `stok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `scjty`
--

INSERT INTO `scjty` (`id_rcjty`, `nama_rcjty`, `warna`, `stok`) VALUES
(1, 'RC 1', 'HIJAU', '5150'),
(2, 'RC 2', 'BIRU', '1409.66'),
(3, 'RC 3', 'BIRU', '3950'),
(4, 'RC 4', 'BIRU', '246.5'),
(5, 'RC 5', 'KUNING', '1163.95'),
(9, 'RC 7', 'KUNING', '1113.5'),
(10, 'RC 8', 'BIRU', '1200'),
(11, 'RC 9', 'BIRU', '1000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(100) NOT NULL,
  `kode_supplier` varchar(100) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `alamat`, `telepon`) VALUES
(11, 'SUP-1222001', 'PT. CAHAYA MANDIRI', 'BANJARMASIN', '082123456789'),
(12, 'SUP-1222002', 'PT. SEJAHTERA BERSAMA', 'BANJARMASIN', '081123414253'),
(14, 'SUP-1222003', 'PT. CIPTA JAYA', 'BANJARBARU', '087919956762'),
(15, 'SUP-1222004', 'PT. NIAGAMAS ', 'BANDUNG', '083186003096'),
(16, 'SUP-1222005', 'PT. SARANA TEKNIK', 'JAKARTA', '085744576041');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer`
--

CREATE TABLE `transfer` (
  `id_transfer` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `id_rcjty` int(11) NOT NULL,
  `id_rcicf` int(11) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `id_dumptruck` int(11) NOT NULL,
  `id_optht` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `tanggal`, `start`, `finish`, `id_rcjty`, `id_rcicf`, `jumlah`, `id_dumptruck`, `id_optht`, `id_users`, `catatan`) VALUES
(13, '2023-06-09', '21:49:00', '22:49:00', 1, 6, '100', 3, 2, 29, 'Selesai'),
(14, '2023-06-20', '23:44:00', '00:44:00', 5, 12, '1250.45', 3, 2, 27, 'Selesai'),
(25, '2023-07-07', '22:09:00', '02:00:00', 1, 7, '200', 3, 2, 27, 'Selesai'),
(27, '2023-07-03', '22:41:00', '00:00:00', 2, 7, '200', 3, 2, 27, 'Dalam Proses'),
(28, '2023-07-05', '12:52:00', '15:09:00', 2, 6, '200', 3, 1, 27, 'Selesai'),
(31, '2023-07-31', '13:56:00', '15:06:00', 10, 6, '200', 3, 2, 27, 'Selesai'),
(33, '2023-07-16', '17:38:00', '18:00:00', 1, 6, '450', 3, 1, 27, 'Selesai'),
(35, '2023-07-17', '20:40:00', '00:00:00', 4, 7, '', 8, 2, 27, 'Dalam Proses'),
(36, '2023-07-10', '17:42:00', '00:00:00', 9, 7, '', 3, 1, 27, 'Dalam Proses'),
(37, '2023-07-06', '22:30:00', '23:32:00', 3, 6, '450', 6, 1, 27, 'Selesai'),
(38, '2023-07-31', '23:15:00', '00:15:00', 1, 6, '300', 1, 2, 27, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'member',
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nama`, `username`, `password`, `level`, `foto`) VALUES
(27, 'Admin', 'admin', '7cedf449b316781d5c02aa4436d12a1c', 'admin', 'bayan.png'),
(29, 'Pegawai', 'pegawai', '8d2445a6ba14a40b0c0efe40b226ae60', 'pegawai', 'bayan.png'),
(38, 'Warehouse', 'warehouse', '628760d25b659e6f42047f65ac327d01', 'warehouse', 'bayan.png'),
(41, 'Quality Control', 'qc', 'aa1ff5aca73c0819e285e22c9b921691', 'qc', 'bayan.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `barge`
--
ALTER TABLE `barge`
  ADD PRIMARY KEY (`id_barge`);

--
-- Indeks untuk tabel `blending`
--
ALTER TABLE `blending`
  ADD PRIMARY KEY (`id_blending`),
  ADD KEY `kode_sbp` (`kode_sbp`);

--
-- Indeks untuk tabel `crushingicf`
--
ALTER TABLE `crushingicf`
  ADD PRIMARY KEY (`id_crushing`),
  ADD KEY `id_rc` (`id_rcicf`),
  ADD KEY `id_rcicf` (`id_rcicf`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `crushingjty`
--
ALTER TABLE `crushingjty`
  ADD PRIMARY KEY (`id_crushing`),
  ADD KEY `id_rc` (`id_rcjty`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `dokmuatan`
--
ALTER TABLE `dokmuatan`
  ADD PRIMARY KEY (`id_dokmuatan`),
  ADD KEY `id_dumptruck` (`id_dumptruck`);

--
-- Indeks untuk tabel `dumptruck`
--
ALTER TABLE `dumptruck`
  ADD PRIMARY KEY (`id_dumptruck`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `loading`
--
ALTER TABLE `loading`
  ADD PRIMARY KEY (`id_loading`),
  ADD KEY `id_barge` (`id_barge`),
  ADD KEY `id_rcjty` (`id_rcjty`),
  ADD KEY `kode_sbp` (`kode_sbp`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `operatorht`
--
ALTER TABLE `operatorht`
  ADD PRIMARY KEY (`id_optht`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `sbp`
--
ALTER TABLE `sbp`
  ADD PRIMARY KEY (`kode_sbp`);

--
-- Indeks untuk tabel `scicf`
--
ALTER TABLE `scicf`
  ADD PRIMARY KEY (`id_rcicf`);

--
-- Indeks untuk tabel `scjty`
--
ALTER TABLE `scjty`
  ADD PRIMARY KEY (`id_rcjty`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`),
  ADD KEY `id_rc` (`id_rcjty`),
  ADD KEY `id_rcicf` (`id_rcicf`),
  ADD KEY `id_haultruck` (`id_dumptruck`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_optht` (`id_optht`),
  ADD KEY `id_dumptruck` (`id_dumptruck`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `barge`
--
ALTER TABLE `barge`
  MODIFY `id_barge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `blending`
--
ALTER TABLE `blending`
  MODIFY `id_blending` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `crushingicf`
--
ALTER TABLE `crushingicf`
  MODIFY `id_crushing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `crushingjty`
--
ALTER TABLE `crushingjty`
  MODIFY `id_crushing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `dokmuatan`
--
ALTER TABLE `dokmuatan`
  MODIFY `id_dokmuatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `dumptruck`
--
ALTER TABLE `dumptruck`
  MODIFY `id_dumptruck` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `loading`
--
ALTER TABLE `loading`
  MODIFY `id_loading` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `operatorht`
--
ALTER TABLE `operatorht`
  MODIFY `id_optht` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `po`
--
ALTER TABLE `po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `scicf`
--
ALTER TABLE `scicf`
  MODIFY `id_rcicf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `scjty`
--
ALTER TABLE `scjty`
  MODIFY `id_rcjty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `gudang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `gudang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `blending`
--
ALTER TABLE `blending`
  ADD CONSTRAINT `blending_ibfk_1` FOREIGN KEY (`kode_sbp`) REFERENCES `sbp` (`kode_sbp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `crushingicf`
--
ALTER TABLE `crushingicf`
  ADD CONSTRAINT `crushingicf_ibfk_1` FOREIGN KEY (`id_rcicf`) REFERENCES `scicf` (`id_rcicf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crushingicf_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `crushingjty`
--
ALTER TABLE `crushingjty`
  ADD CONSTRAINT `crushingjty_ibfk_1` FOREIGN KEY (`id_rcjty`) REFERENCES `scjty` (`id_rcjty`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crushingjty_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokmuatan`
--
ALTER TABLE `dokmuatan`
  ADD CONSTRAINT `dokmuatan_ibfk_1` FOREIGN KEY (`id_dumptruck`) REFERENCES `dumptruck` (`id_dumptruck`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD CONSTRAINT `gudang_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gudang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gudang_ibfk_3` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_barang` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `loading`
--
ALTER TABLE `loading`
  ADD CONSTRAINT `loading_ibfk_1` FOREIGN KEY (`id_barge`) REFERENCES `barge` (`id_barge`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loading_ibfk_2` FOREIGN KEY (`kode_sbp`) REFERENCES `sbp` (`kode_sbp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loading_ibfk_3` FOREIGN KEY (`id_rcjty`) REFERENCES `scjty` (`id_rcjty`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loading_ibfk_4` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `po`
--
ALTER TABLE `po`
  ADD CONSTRAINT `po_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `gudang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`id_rcjty`) REFERENCES `scjty` (`id_rcjty`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`id_rcicf`) REFERENCES `scicf` (`id_rcicf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_3` FOREIGN KEY (`id_dumptruck`) REFERENCES `dumptruck` (`id_dumptruck`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_4` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_5` FOREIGN KEY (`id_optht`) REFERENCES `operatorht` (`id_optht`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
