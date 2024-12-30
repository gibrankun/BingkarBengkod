-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2024 pada 14.22
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `status_periksa` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status_periksa`) VALUES
(1, 7, 1, 'pusing', 1, '1'),
(2, 7, 10, 'cenut cenut', 1, '1'),
(3, 7, 10, 'sesak', 2, '1'),
(4, 23, 10, 'berdebar', 3, '1'),
(5, 5, 10, 'keringat dingin', 4, '0'),
(6, 5, 10, 'tertusuk', 5, '1'),
(7, 24, 15, 'sakit sesak nafas', 1, '1'),
(8, 25, 16, 'kandungan jedag jedug', 1, '1'),
(9, 26, 15, 'sesak nafas', 2, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `id_periksa` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(2, 5, 1),
(3, 6, 2),
(4, 7, 2),
(5, 4, 1),
(6, 4, 2),
(7, 8, 1),
(10, 9, 2),
(13, 10, 3),
(16, 11, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `id_poli` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('dokter') NOT NULL DEFAULT 'dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `password`, `role`) VALUES
(2, 'Edho', 'Jl. Pasuruhan', '081263871267', 1, 'a9ea96e1d699281472715bfdb86a06ad', 'dokter'),
(3, 'Richard', 'Jl. Arteri', '081276387121', 4, '$2y$10$0hGgee0rdhcEOWQp5YfZlOJ00MEmAsMxsJde52Wa9/2JuSJE8wR5W', 'dokter'),
(18, 'Ambalabu', 'Jl. Maluku', '0812536812312', 5, '$2y$10$FeNYdueK1/aYiLO6QGPb6uuzNIjx3zsziHJ7ZijMo2E7dQgvorD6u', 'dokter'),
(23, 'aflaa', 'Jl. Karangturi Hehe', '081263712673121', 6, '$2y$10$D3KkvZP3CehTrSfAJYfK3.wkZBDWG0F6CUYY8VfNW5qRFgya6P6..', 'dokter'),
(24, 'saddam', 'Jl. Sendangmulyo', '08126371362', 3, '$2y$10$frz1ACSBAvxgxVHG0e4R4OgUpD.TgTIIIxxt9CqcyPHIpE8uGeSXi', 'dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` char(1) DEFAULT '2',
  `aktif` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `aktif`) VALUES
(1, 3, 'Senin', '15:00:00', '18:00:00', '2', '2'),
(9, 3, 'Jumat', '08:00:00', '11:00:00', '2', '2'),
(10, 3, 'Selasa', '14:00:00', '16:00:00', '2', '1'),
(11, 3, 'Rabu', '09:00:00', '12:00:00', '2', '2'),
(12, 18, 'Senin', '08:00:00', '10:00:00', '2', '1'),
(13, 2, 'Senin', '09:00:00', '12:00:00', '2', '1'),
(14, 23, 'Senin', '14:30:00', '15:45:00', '2', 'N'),
(15, 23, 'Selasa', '16:00:00', '17:00:00', '2', 'N'),
(16, 24, 'Senin', '15:30:00', '17:45:00', '2', '1'),
(17, 24, 'Senin', '08:30:00', '12:00:00', '2', 'N'),
(18, 23, 'Kamis', '20:55:00', '21:59:00', '2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'Atorvastatin', 'kaplet', 120000),
(2, 'Simvastatin', 'kaplet', 150000),
(3, 'Cardiomed', 'kaplet', 170000),
(4, 'Latipress Eye Drops', 'botol', 220000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `no_rm` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pasien') NOT NULL DEFAULT 'pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `password`, `role`) VALUES
(2, 'zulfikar', 'Jl. Sabang', '337126378126', '081212637812', '082412-001', '139c4e89cdbedaf144d05ca54a12a57b', 'pasien'),
(5, 'mason', 'Jl. Kamarov', '33781923789', '086127836871', '082412-002', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(6, 'eden', 'Jl. Jambu', '33721632138', '081263767182', '082412-003', '8da921cd43229e30e830b28a76757826', 'pasien'),
(7, 'raghil', 'Jl. Mandiri', '3374110989070001', '08621637312', '082412-004', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(18, 'silvia', 'Jl. Nissan', '3374023109990005', '081263712673', '202412-003', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(19, 'rahayu', 'Jl. Demak', '3374052902270001', '0812673612783', '202412-004', 'b8aab85cb5b70a866972a694a27b7ed6', 'pasien'),
(20, 'faizin', 'Jl. Mranggen', '3374050813040001', '081267312673', '202412-005', '7d77e825b80cff62a72e680c1c81424f', 'pasien'),
(21, 'fariz', 'Jl. Pamularsih', '337110809660002', '081263761273', '202412-006', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(22, 'nunung', 'Jl. Tembalang', '335667766588865', '08126376172367', '202412-007', '7239ea2b5dc943f61f3c0a0276c20974', 'pasien'),
(23, 'robby', 'Jl. Sendangmulyo', '3374012306020001', '08512635621312', '202412-008', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(24, 'gibran', 'Jl. Klipang', '33740423020002', '081256357126', '202412-009', 'e77d7674b9048d96055a1b72c7152f13', 'pasien'),
(25, 'febby', 'Jl. Majapahit', '337401239012', '08123467151211', '202412-010', '2d6aa5bb974c5bc78cee7066d8e8395e', 'pasien'),
(26, 'raka', 'Jl. Frambozen', '337421033330002', '081526317898', '202412-011', 'e5b2a975d9b73165bcc8b5e63ce488ff', 'pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `id_daftar_poli` int(11) NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(4, 1, '2024-12-25 00:00:00', 'tidur banyak', 420000),
(5, 2, '2024-12-25 20:11:00', 'istirahat', 270000),
(6, 4, '2024-12-26 01:47:00', 'perbanyak minum', 300000),
(7, 3, '2024-12-25 01:53:00', 'tes', 300000),
(8, 6, '2024-12-25 06:57:00', 'diminum tiap hari', 270000),
(9, 7, '2024-12-26 14:45:00', 'sudah mendingan', 300000),
(10, 8, '2024-12-27 15:00:00', 'bayi anteng cik', 320000),
(11, 9, '2024-12-23 16:30:00', 'obat dikonsumsi 3x sehari sesuai dosis', 320000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Jantung', 'Menangani keluhan pada masalah jantung'),
(3, 'Kandungan', 'Menangani masalah seputar kandungan'),
(4, 'Mata', 'Menangani masalah penyakit mata'),
(5, 'Penyakit Dalam', 'Menangani masalah seputar penyakit dalam'),
(6, 'Penyakit Pernafasan', 'Menangani masalah seputar penyakit pernafasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'pei3', '$2y$10$CY0QT3ojDPs6bK/pAWXPGOw1ikzcWI//0sT84aH/fEQtNFs8LoMRC', 'admin'),
(2, 'pei', '$2y$10$3r9YUb8AZUlmeopnqwmxiO4bMFn.VSFyGij2W1uEwEqVMFYiATvuK', 'admin'),
(3, 'acenk', '$2y$10$HoDUf4J2xd//6mOJMHlQLuNBZP2ISa/hfCSJOLmmY7plXohgiHBw.', 'admin'),
(4, 'afel', '$2y$10$5rM7J.2eTefmYKijZIdDY.T3kOmZtRfLhmNjolVTxUOD9lElTeBCO', 'admin'),
(5, 'afla', '$2y$10$pvvkkvxsfP5GskSl3tpVjOUGNgOUJi25xXowmvNyJ/JJnYl8Nlgx6', 'admin'),
(6, 'alei', '$2y$10$1rkbq1I2UuFUNOGcGKJCJ.WnQGWTSplK2gHzsGSpxUvxNPioc35Lu', 'admin'),
(7, 'alfi', '$2y$10$YLG.5EWGcmU10AOPRpo8Iujq9VphpV.jmZ0ByqfxtHqC13sPoN3FO', 'admin'),
(8, 'pai', '$2y$10$Y28IQYAIBOhHBsedewe2m.vtpzVewwtmHdQjnc9Ej/2rbW.o6umZW', 'admin'),
(9, 'alfred', '$2y$10$SfU8ld7.cyBRmIVKdvpUK.sSD7rRzlOrzW7AM/EQ5G9bxEdpt5WTa', 'admin'),
(10, 'rafi', '$2y$10$GM1kqOl2diLqmTsFGvl75eOY/JV3DF/R.Do28woV44O44/xi.Bp96', 'admin'),
(11, 'albert', '$2y$10$Rhaj0lK6XR4bl9KHvjyXSuycC/RY4LHx7c0B7vyHP9mZzf0xzippe', 'admin'),
(12, 'cuenk', '$2y$10$JfFunYldq.ne9YgaBGxZjegsQK46jCv.WKhcBI7UxnCCHDj0vhaN2', 'admin'),
(13, 'ss', '$2y$10$5l5BEbcf.pexfUKO5U9GguVlFvQ3Lmdzr9gmZfoukSfBUpQ2zIxXO', 'admin'),
(14, 'mzrafi1708@gmail.com', '$2y$10$jjQ49X6jf//I/gz9RlRg8u.hgwRT2S6FyDHGB91FCuqQuX66wL7uC', 'admin'),
(15, 'agil', '$2y$10$SYOcLvLwadDZ.6G6ICxErO.M9QwW71BHhWOsFncTum9kzonSPZbeq', 'admin'),
(16, 'zaidan', '$2y$10$jSemjEbjYzqyw7zHOST0o.q.7HmznwavHyVPYQhVLRvukRoevY8S6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`),
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Ketidakleluasaan untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
