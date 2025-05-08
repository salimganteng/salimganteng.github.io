-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2025 pada 17.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `nama_barang` varchar(255) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `nama_pembeli` varchar(225) NOT NULL,
  `brand` varchar(225) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`nama_barang`, `alamat`, `ukuran`, `stok`, `nama_pembeli`, `brand`, `id`) VALUES
('kai 3', 'tlgs', 42, 2, 'trez', 'anta', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambah_barang`
--

CREATE TABLE `tambah_barang` (
  `image` varchar(225) NOT NULL,
  `brand` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `stok` int(20) NOT NULL,
  `harga` varchar(225) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tambah_barang`
--

INSERT INTO `tambah_barang` (`image`, `brand`, `name`, `stok`, `harga`, `id`) VALUES
('adidas1.jpg', 'adidas', 'samba', 24, '20', 26),
('adidas2.jpg', 'adidas', 'kuwait', 20, '30', 27),
('nike1.jpg', 'nike', 'zero', 50, '45', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_pelanggan`, `nama`, `email`, `password`, `role`) VALUES
('AM1111', 'admin', 'admin@gmail.com', 'admin123', 'admin'),
('PA9667', 'Salim', 'salim@gmail.com', 'salim123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tambah_barang`
--
ALTER TABLE `tambah_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tambah_barang`
--
ALTER TABLE `tambah_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
