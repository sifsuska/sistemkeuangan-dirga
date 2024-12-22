-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2022 pada 23.18
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashinout`
--

CREATE TABLE `cashinout` (
  `id_cashinout` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pengeluaran','Pemasukkan') NOT NULL,
  `jumlah` double NOT NULL,
  `id_perihal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cashinout`
--

INSERT INTO `cashinout` (`id_cashinout`, `tanggal`, `jenis`, `jumlah`, `id_perihal`) VALUES
(7, '2022-01-03', 'Pemasukkan', 25000000, 39),
(8, '2022-01-03', 'Pengeluaran', 6000000, 40),
(9, '2022-01-04', 'Pemasukkan', 15000000, 41),
(10, '2022-01-04', 'Pengeluaran', 5000000, 42);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `umur` varchar(5) NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `posisi`, `alamat`, `umur`, `kontak`) VALUES
(3, 'Rafi Ananda', 'Sekretaris Desa', 'Jl. Garuda Sakti', '21', '081265910970');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_user`
--

CREATE TABLE `kategori_user` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_user`
--

INSERT INTO `kategori_user` (`id_kategori`, `kategori`) VALUES
(1, 'admin'),
(2, 'manajer'),
(3, 'bendahara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perihal`
--

CREATE TABLE `perihal` (
  `id_perihal` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perihal`
--

INSERT INTO `perihal` (`id_perihal`, `nama`, `keterangan`) VALUES
(1, 'Pendapatan', 'Okww'),
(2, 'Pendapatan', 'Okww'),
(3, 'Pendapatan', 'Okw'),
(4, 'Pendapatan', 'ok'),
(5, 'Pendapatan', 'Oke'),
(6, 'Pendapatan', 'Oke'),
(7, 'Pendapatan', 'Oke'),
(8, 'Pemasukan', 'Oke'),
(9, 'Pemasukan', 'Oke'),
(10, 'Pemasukan', 'Oke'),
(11, 'Pemasukkan', 'Oke boss'),
(12, 'Pemasukkan', 'Oke boss'),
(13, 'Pemasukkan', 'urt'),
(14, 'Pemasukkan', 'ngepet'),
(15, 'Pemasukkan', 'polres'),
(16, 'Pengeluaran', ''),
(17, 'Pengeluaran', ''),
(18, 'Pengeluaran', 'Uji dana'),
(19, 'Pengeluaran', 'Tess'),
(20, 'Pengeluaran', 'Tess'),
(21, 'Pengeluaran', 'Tess'),
(22, 'Pengeluaran', 'Tess'),
(23, 'Pengeluaran', 'Tess'),
(24, 'Pengeluaran', 'Tess'),
(25, 'Pengeluaran', 'Tess'),
(26, 'Pengeluaran', 'Tess'),
(27, 'Pengeluaran', 'Tes Judo'),
(28, 'Pengeluaran', 'proposal'),
(29, 'Pengeluaran', 'Pencetakan Spanduk Pilkades'),
(30, 'Pemasukkan', 'Uang dari Pemerintah pusat'),
(31, 'Pengeluaran', 'Pembelian ATK kantor'),
(32, 'Pemasukkan', 'Uang APBDES'),
(33, 'Pengeluaran', 'Pembelian ATK dan lainnya'),
(34, 'Pemasukkan', 'Dana Desa'),
(35, 'Pengeluaran', 'Sebagai Operasional Kegiatan Pemilihan kepala desa'),
(36, 'Pemasukkan', ''),
(37, 'Pemasukkan', 'Bantuan Keuangan Khusus (BKK)'),
(38, 'Pemasukkan', 'ADD ( Anggaran Dana Desa('),
(39, 'Pemasukkan', 'ADD (Anggaran Dana Desa)'),
(40, 'Pengeluaran', 'Kebutuhan agenda vaksinasi Covid-19'),
(41, 'Pemasukkan', 'BKK (bantuan keuangan Khusus)'),
(42, 'Pengeluaran', 'Operasional pemberbaikian alat alat inventaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_pengguna` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_pengguna`, `email`, `pass`, `id_kategori`) VALUES
(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(2, 'manajer', 'manajer', 'a13fb40490e7d01a1a6ad6da8dab0fd4daff6d0d', 2),
(3, 'Bendahara Desa', 'bendahara', '8cf55b8ae912bbfec560427ce8a2f296bf3ac972', 3),
(5, 'Kepala Desa', 'kades', 'aac73413be9b97fb11f550b6c23f18fba18dfa54', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cashinout`
--
ALTER TABLE `cashinout`
  ADD PRIMARY KEY (`id_cashinout`),
  ADD UNIQUE KEY `id_perihal` (`id_perihal`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kategori_user`
--
ALTER TABLE `kategori_user`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `perihal`
--
ALTER TABLE `perihal`
  ADD PRIMARY KEY (`id_perihal`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cashinout`
--
ALTER TABLE `cashinout`
  MODIFY `id_cashinout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_user`
--
ALTER TABLE `kategori_user`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `perihal`
--
ALTER TABLE `perihal`
  MODIFY `id_perihal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cashinout`
--
ALTER TABLE `cashinout`
  ADD CONSTRAINT `cashinout_ibfk_1` FOREIGN KEY (`id_perihal`) REFERENCES `perihal` (`id_perihal`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_user` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
