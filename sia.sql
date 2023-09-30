-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2022 pada 14.51
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(12) NOT NULL,
  `id_akses` int(12) DEFAULT NULL,
  `pertemuan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_akses`, `pertemuan`, `tanggal`) VALUES
(12, 7, '1', '2022-12-16'),
(13, 7, '2', '2022-12-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Susilo', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_absensi`
--

CREATE TABLE `akses_absensi` (
  `id_akses` int(12) NOT NULL,
  `id_mapel` int(12) DEFAULT NULL,
  `id_guru` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses_absensi`
--

INSERT INTO `akses_absensi` (`id_akses`, `id_mapel`, `id_guru`) VALUES
(7, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_datakelas` int(12) NOT NULL,
  `kode_kelas` varchar(10) DEFAULT NULL,
  `id_siswa` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id_datakelas`, `kode_kelas`, `id_siswa`) VALUES
(1, '111A', 2),
(5, '111A', 3),
(8, '222B', 3),
(13, '222B', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_absensi`
--

CREATE TABLE `detail_absensi` (
  `id_detail` int(12) NOT NULL,
  `id_absensi` int(12) DEFAULT NULL,
  `id_siswa` int(12) DEFAULT NULL,
  `keterangan` enum('Hadir','Sakit','Izin','Alpha') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_absensi`
--

INSERT INTO `detail_absensi` (`id_detail`, `id_absensi`, `id_siswa`, `keterangan`) VALUES
(9, 12, 2, 'Sakit'),
(10, 12, 3, 'Hadir'),
(11, 13, 2, 'Hadir'),
(12, 13, 3, 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(12) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(14) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `jenkel`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telp`, `password`, `foto`) VALUES
(1, '123123123', 'asd', 'Laki-laki', 'Islam', 'Lampung', '2022-12-13', 'qwe', '929380', '202cb962ac59075b964b07152d234b70', '63976bfa69a17_3a1bde6797ff0a2e3b5d7306dbeb0caf.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `id_wali` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`, `tahun_ajaran`, `id_wali`) VALUES
('111A', '1A', '2021/2022', 2),
('222A', '2A', '2022', 2),
('222B', '2B', '2021/2022', 2),
('333B', '3B', '2021/2022', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` int(12) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `jadwal_hari` varchar(12) NOT NULL,
  `jadwal_mulai` time NOT NULL,
  `jadwal_selesai` time NOT NULL,
  `kkm` int(4) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `kode_mapel`, `nama_mapel`, `jadwal_hari`, `jadwal_mulai`, `jadwal_selesai`, `kkm`, `kode_kelas`) VALUES
(2, 'Mat2', 'Matematika', 'Kamis', '12:10:00', '14:30:00', 60, '111A '),
(3, 'Mat2A', 'Matematika', 'Kamis', '10:10:00', '12:10:00', 65, '222B '),
(4, 'Mat3B', 'Matematika', 'Sabtu', '10:20:00', '11:50:00', 60, '333B ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(12) NOT NULL,
  `id_siswa` int(12) DEFAULT NULL,
  `id_mapel` int(12) NOT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `nilai_tugas` float DEFAULT NULL,
  `nilai_uts` float DEFAULT NULL,
  `nilai_uas` float DEFAULT NULL,
  `total_nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `id_mapel`, `semester`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `total_nilai`) VALUES
(3, 2, 2, 'genap', 80, 80, 80, 80),
(4, 3, 2, 'genap', 100, 100, 100, 100),
(5, 3, 3, 'ganjil', 100, 80, 80, 86.6667),
(6, 3, 3, 'genap', 80, 80, 80, 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(12) NOT NULL,
  `gambar` text NOT NULL,
  `judul` varchar(100) NOT NULL,
  `subjudul` text NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text NOT NULL,
  `status` enum('tampil','draft') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `gambar`, `judul`, `subjudul`, `tanggal`, `keterangan`, `status`) VALUES
(2, '62bc824355519_a.jpeg', 'Holywings tutup cuk', 'Saat-saat kembalinya itachi uciha di konoha', '2022-06-29', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.', 'draft'),
(3, '62bc85d60ea07_Capture.PNG', 'Vijay terduga menghamili seorang wanita', 'Saat-saat kembalinya itachi uciha di konoha', '2022-06-30', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.\r\n\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.\r\n\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt explicabo minima error, voluptatibus quisquam, repudiandae laudantium ratione voluptate ipsam dolore dicta blanditiis provident rerum? Asperiores laborum debitis corrupti nemo eligendi.', 'tampil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(12) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(14) NOT NULL,
  `angkatan` varchar(12) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `nis`, `password`, `jenkel`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telp`, `angkatan`, `foto`) VALUES
(2, 'firdaus ardiansyah saleh , S.Kom., M.Kom.', '242424', '202cb962ac59075b964b07152d234b70', 'Laki-laki', 'Islam', 'Sleman', '2002-01-10', 'Gamping Kidul Ambarketawang', '082256781212', '2020', '62c191803144a_a.jpeg'),
(3, 'vijay', '9999', '202cb962ac59075b964b07152d234b70', 'Laki-laki', 'Islam', 'Lampung', '2008-08-06', 'Gondomanan', '08123801238', '2019', '62b99a65085f3_61bc996a0c668.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wali` int(12) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(14) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_wali`, `nip`, `nama`, `jenkel`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telp`, `password`, `foto`) VALUES
(2, '112233', 'kuciing', 'Laki-laki', 'Islam', 'Sleman', '1990-01-01', 'Gamping kidul', '089922221111', '202cb962ac59075b964b07152d234b70', '62c191101e8ce_61bc996a0c668.jpg'),
(3, '1122', 'Parto', 'Laki-laki', 'Islam', 'Sleman', '1990-10-10', 'asdwwqe qweseqw seqwe', '089292761234', '202cb962ac59075b964b07152d234b70', '62c1a36b13771_a.jpeg'),
(4, '123', 'Testing', 'Laki-laki', 'Islam', 'Testing', '1991-01-01', 'Testing aja', '111', '202cb962ac59075b964b07152d234b70', '62dad2d17d429_CathlinOfeliaNasywa.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `akses_absensi`
--
ALTER TABLE `akses_absensi`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_datakelas`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_absensi` (`id_absensi`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `id_guru` (`id_wali`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akses_absensi`
--
ALTER TABLE `akses_absensi`
  MODIFY `id_akses` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_datakelas` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  MODIFY `id_detail` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mapel` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wali` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `akses_absensi` (`id_akses`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `akses_absensi`
--
ALTER TABLE `akses_absensi`
  ADD CONSTRAINT `akses_absensi_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`),
  ADD CONSTRAINT `akses_absensi_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD CONSTRAINT `data_kelas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `data_kelas_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`);

--
-- Ketidakleluasaan untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  ADD CONSTRAINT `detail_absensi_ibfk_3` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_absensi_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_wali`) REFERENCES `wali_kelas` (`id_wali`);

--
-- Ketidakleluasaan untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `mata_pelajaran_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`),
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
