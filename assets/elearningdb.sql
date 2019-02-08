-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Feb 2019 pada 03.37
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearningdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `kode_pertanyaan` varchar(10) NOT NULL,
  `kode_jawaban` varchar(10) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `hasil_status` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`kode_pertanyaan`, `kode_jawaban`, `nik`, `hasil_status`) VALUES
('T01.1', 'T01.1.B', '10316', 'F'),
('T01.1', 'T01.1.A', '7357', 'F'),
('T01.2', 'T01.2.A', '10316', 'F'),
('T01.2', 'T01.2.A', '7357', 'F'),
('T01.3', 'T01.3.a', '10316', 'F'),
('T01.3', 'T01.3.a', '7357', 'F'),
('T01.4', 'T01.4.A', '10316', 'F'),
('T01.5', 'T01.5.A', '10316', 'F'),
('T01.6', 'T01.6.B', '10316', 'F'),
('T01.7', 'T01.7.A', '10316', 'F'),
('T01.8', 'T01.8.A', '10316', 'F');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(10) NOT NULL,
  `kode_materi` varchar(10) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `durasi_test` varchar(10) NOT NULL,
  `nilai_min_lv1` int(11) NOT NULL,
  `nilai_min_lv2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `kode_materi`, `tanggal_mulai`, `tanggal_selesai`, `durasi_test`, `nilai_min_lv1`, `nilai_min_lv2`) VALUES
('JD.0001', 'T01', '2019-01-17', '2019-01-25', '1', 70, 65);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `kode_jawaban` varchar(10) NOT NULL,
  `kode_pertanyaan` varchar(10) NOT NULL,
  `abjad_jawaban` char(5) NOT NULL,
  `text_jawaban` varchar(200) NOT NULL,
  `point_jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`kode_jawaban`, `kode_pertanyaan`, `abjad_jawaban`, `text_jawaban`, `point_jawaban`) VALUES
('H0203.01.A', 'H0203.01', 'A', 'Kerja Praktek', 30),
('H0203.01.B', 'H0203.01', 'B', 'Kerja Keras', 0),
('H0203.02.A', 'H0203.02', 'A', 'Untuk Mengetahui Rahasia Perusahaan', 0),
('H0203.02.B', 'H0203.02', 'B', 'Mendapat pengalaman bekerja sebelum lulus sekolah', 30),
('H0203.03.A', 'H0203.03', 'A', 'Patuh Terhadap Aturan', 30),
('H0203.03.B', 'H0203.03', 'B', 'Berbuat Sesuai Kemauan Sendiri', 0),
('T01.1.A', 'T01.1', 'A', 'Benar', 0),
('T01.1.B', 'T01.1', 'B', 'Salah', 10),
('T01.2.A', 'T01.2', 'A', 'Benar', 10),
('T01.2.b', 'T01.2', 'B', 'Salah', 0),
('T01.3.a', 'T01.3', 'A', 'Benar', 10),
('T01.3.B', 'T01.3', 'B', 'Salah', 0),
('T01.4.A', 'T01.4', 'A', 'Benar', 10),
('T01.4.B', 'T01.4', 'B', 'Salah', 0),
('T01.5.A', 'T01.5', 'A', 'Benar', 10),
('T01.5.B', 'T01.5', 'B', 'Salah', 0),
('T01.6.a', 'T01.6', 'A', 'Benar', 0),
('T01.6.B', 'T01.6', 'B', 'Salah', 10),
('T01.7.A', 'T01.7', 'A', 'Benar', 10),
('T01.7.B', 'T01.7', 'B', 'Salah', 0),
('T01.8.A', 'T01.8', 'A', 'Benar', 10),
('T01.8.B', 'T01.8', 'B', 'Salah', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `dinas` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `subdit` varchar(30) NOT NULL,
  `direktorat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `email`, `password`, `golongan`, `jabatan`, `dinas`, `divisi`, `subdit`, `direktorat`) VALUES
('10316', 'Edjie Djauhari', 'edjie.djauhari@krakatausteel.com', '11111', 'B', 'Manager', '-', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('10344', 'Chatim Pramono', 'chatim.pramono@krakatausteel.com', '11111', 'C', 'Sr. Specialist', 'Human Capital Development', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('14140', 'Atika R.D', 'kioselimut@gmail.com', '11111', 'E', 'Officer', 'Knowledge Management', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('14307', 'A. Rizky D.', 'atika.damayanti@mitra.krakatausteel.com', '11111', 'E', 'Officer', 'Knowledge Management', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('5960', 'Oma Romansyah', 'oma.romansyah@krakatausteel.com', 'oma5960', 'C', 'Superintendent', 'Knowledge Management', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('7357', 'Suwiyardi', 'suwiyardi@krakatausteel.com', '11111', 'C', 'Superintendent', 'Dev. Learning & Adm.', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('7646', 'Arsudin', 'arsudin@krakatausteel.com', '11111', 'C', 'Superintendent', 'Training Management', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('8251', 'Dede Amir Hamzah', 'dedea.hamzah@krakatausteel.com', '11111', 'C', 'Superintendent', 'Human Capital Measurement', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM'),
('90141', 'Satwika Budi Santosa', 'satwikab.santosa@mitra.krakatausteel.com', '11111', 'E', 'Officer', 'Rolling Operation', 'HSM#2', 'Rolling Mill', 'Produksi & Teknologi'),
('91307', 'Administrator', 'admin@ks.com', 'admin', 'E', 'Officer', 'Knowledge Management', 'Human Capital Development & Learning Center', 'Human Capital Management', 'SDM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `kode_materi` varchar(10) NOT NULL,
  `judul_materi` varchar(100) NOT NULL,
  `file_materi` varchar(50) NOT NULL,
  `deskripsi_materi` varchar(200) NOT NULL,
  `tanggal_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`kode_materi`, `judul_materi`, `file_materi`, `deskripsi_materi`, `tanggal_upload`) VALUES
('H0203', 'WI Pemagangan', 'WI_Pemagangan.doc', 'WI Pemagangan', '2018-11-26 02:49:30'),
('T01', 'Sistem Manajemen Krakatau Steel', 'SMKS.pdf', 'Sistem Manajemen Krakatau Steel', '2019-01-17 09:23:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `kode_pertanyaan` varchar(10) NOT NULL,
  `kode_materi` varchar(10) NOT NULL,
  `nomor_soal` int(11) NOT NULL,
  `text_pertanyaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`kode_pertanyaan`, `kode_materi`, `nomor_soal`, `text_pertanyaan`) VALUES
('H0203.01', 'H0203', 1, 'Pengertian Magang'),
('H0203.02', 'H0203', 2, 'Mengapa Harus Magang'),
('H0203.03', 'H0203', 3, 'Bagaimana Sikap Saat Magang'),
('T01.1', 'T01', 1, 'SMKS Merupakan bentuk Sistem Manajemen yang baku dan khas namun tidak  merefleksikan budaya perusahaan'),
('T01.2', 'T01', 2, 'SMKS merupakan panduan umum bagi seluruh jajaran manajemen dan karyawan dalam menjalankan rutinitas kegiatan perusahaan'),
('T01.3', 'T01', 3, 'SMK3 adalah Sistem Manajemen yang berkaitan dengan Keselamatan dan Kesehatan Kerja dan terpisah dari sistem manajemen krakatau steel (SMKS)'),
('T01.4', 'T01', 4, 'Sistem Manajemen Krakatau Steel (SMKS) merupakan bagian yang tidak terpisahkan dengan implementasi good corporate governance (GCG)'),
('T01.5', 'T01', 5, 'Manual SMKS adalah kumpulan kebijakan perusahaan dan gambaran pemenuhan kriteria sistem manajemen yang diterapkan di PT KS'),
('T01.6', 'T01', 6, 'Manajemen Risiko tidak termasuk bagian terintegrasi dalam sistem manajemen krakatau steel'),
('T01.7', 'T01', 7, 'Fungsi R&D dalam Peta Proses Bisnis PTKS adalah berkaitan dengan Perancangan, Proses, Produk, Konservasi Energi'),
('T01.8', 'T01', 8, 'Audit adalah suatu proses yang sistematis, independen, dan terdokumentasi untuk menemukan bukti-bukti dan mengevaluasinya secara objektif untuk menentukan tingkat pemenuhan kriteria dari suatu sistem ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `nik` varchar(10) NOT NULL,
  `kode_jadwal` varchar(10) NOT NULL,
  `nilai_pre` int(11) NOT NULL,
  `nilai_post` int(11) NOT NULL,
  `status_test` varchar(10) NOT NULL,
  `status_hasil` varchar(10) NOT NULL,
  `tanggal_test` date NOT NULL,
  `waktu_undang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`nik`, `kode_jadwal`, `nilai_pre`, `nilai_post`, `status_test`, `status_hasil`, `tanggal_test`, `waktu_undang`) VALUES
('14307', 'JD.0001', 0, 0, 'ST.0001', 'ST.0005', '0000-00-00', '2019-02-01 10:15:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_test`
--

CREATE TABLE `status_test` (
  `kode_status_test` varchar(10) NOT NULL,
  `nama_status_test` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_test`
--

INSERT INTO `status_test` (`kode_status_test`, `nama_status_test`) VALUES
('ST.0001', 'Belum Test'),
('ST.0002', 'Pre Test'),
('ST.0003', 'Selesai'),
('ST.0004', 'Lulus'),
('ST.0005', 'Tidak Lulus');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`kode_pertanyaan`,`nik`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`kode_pertanyaan`,`abjad_jawaban`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`kode_materi`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`kode_materi`,`nomor_soal`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`nik`,`kode_jadwal`),
  ADD KEY `peserta_ibfk_1` (`status_hasil`),
  ADD KEY `status_test` (`status_test`);

--
-- Indeks untuk tabel `status_test`
--
ALTER TABLE `status_test`
  ADD PRIMARY KEY (`kode_status_test`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`status_hasil`) REFERENCES `status_test` (`kode_status_test`),
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`status_test`) REFERENCES `status_test` (`kode_status_test`),
  ADD CONSTRAINT `peserta_ibfk_3` FOREIGN KEY (`nik`) REFERENCES `karyawan` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
