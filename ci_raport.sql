-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Jan 2022 pada 17.00
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_raport`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absen` int(11) NOT NULL,
  `nis_siswa` int(16) NOT NULL,
  `tanggal` date NOT NULL,
  `absen` int(1) NOT NULL DEFAULT 0,
  `keterangan` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absen`, `nis_siswa`, `tanggal`, `absen`, `keterangan`, `create_date`) VALUES
(1, 123456, '2022-01-24', 3, '', '2022-01-24 15:50:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `email`, `nama`, `password`, `role`, `status`, `create_date`) VALUES
(8, 'sekolahkita', 'sekolahkita@gmail.co', 'Sekolah Kita', '$2y$11$jrmmlm2HfRzJDQC6GnASH.fa7hXKxc/Ur35x7uy.K.AozrC1q2XH.', 'admin', 1, '2021-11-10 02:11:06'),
(10, '654321', 'joyo@sekolahkita.com', 'Joyo Subandi, S. Kom', '$2y$11$C1FbX04GYn8uJaIDnfbSbuYbiyOcoUyg9JA689bEPWdi479R4iePK', 'guru', 1, '2022-01-24 15:41:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `nama_bayar` varchar(100) NOT NULL,
  `tahun_ajaran` int(3) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nama_bayar`, `tahun_ajaran`, `semester`, `status`, `create_date`) VALUES
(1, 'LKS Semester Ganjil', 1, 2, 1, '2022-01-24 15:59:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar_detail`
--

CREATE TABLE `tb_bayar_detail` (
  `id_bayar_detail` int(11) NOT NULL,
  `bayar_id` int(11) NOT NULL,
  `kelas` int(14) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bayar_detail`
--

INSERT INTO `tb_bayar_detail` (`id_bayar_detail`, `bayar_id`, `kelas`, `create_date`) VALUES
(1, 1, 1, '2022-01-24 15:39:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` int(14) NOT NULL,
  `nuptk` int(14) NOT NULL,
  `gelar_dpn` varchar(10) NOT NULL,
  `gelar_blkg` varchar(10) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `pangkat` varchar(10) NOT NULL,
  `gol_ruang` varchar(10) NOT NULL,
  `tingkat_pend` varchar(10) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tugas_sebagai` varchar(10) NOT NULL,
  `tugas_mengajar` varchar(10) NOT NULL,
  `status_pegawai` varchar(10) NOT NULL,
  `tmt_sekolah` varchar(10) NOT NULL,
  `no_sk` int(14) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `image` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nuptk`, `gelar_dpn`, `gelar_blkg`, `nama`, `alamat`, `jenis_kelamin`, `pangkat`, `gol_ruang`, `tingkat_pend`, `tempat_lahir`, `tanggal_lahir`, `tugas_sebagai`, `tugas_mengajar`, `status_pegawai`, `tmt_sekolah`, `no_sk`, `status`, `image`, `create_date`) VALUES
(1, 654321, 654321, '', 'S. Kom', 'Joyo Subandi', 'Purwosari Pasuruan', 'Laki-laki', 'Guru', 'Golongan I', 'SMP', 'Pasuruan', '1994-03-16', 'Guru', 'Bahasa', 'Tetap', 'Tetap', 12345678, 1, '7-Fasilitas-Sekolah-Kejuruan-Agar-Siswa-Siap-di-Era-Industri-4_0-11.jpg', '2022-01-24 15:37:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `wali_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` int(2) NOT NULL,
  `status` int(1) DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `wali_kelas`, `tahun_ajaran`, `status`, `create_date`) VALUES
(1, 'Kelas X KPR', '1', 1, 1, '2022-01-24 15:41:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas_detail`
--

CREATE TABLE `tb_kelas_detail` (
  `id_detail_kelas` int(11) NOT NULL,
  `kelas_id` int(3) NOT NULL,
  `siswa` int(14) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas_detail`
--

INSERT INTO `tb_kelas_detail` (`id_detail_kelas`, `kelas_id`, `siswa`, `create_date`) VALUES
(1, 1, 123456, '2022-01-24 15:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nama_nilai` varchar(100) NOT NULL,
  `tahun_ajaran` int(2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `nama_nilai`, `tahun_ajaran`, `status`, `create_date`) VALUES
(1, 'Nilai Tugas', 1, 1, '2022-01-24 15:38:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_detail`
--

CREATE TABLE `tb_nilai_detail` (
  `id_nilai_detail` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai_detail`
--

INSERT INTO `tb_nilai_detail` (`id_nilai_detail`, `nilai_id`, `kelas`, `create_date`) VALUES
(1, 1, 1, '2022-01-24 15:38:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelajaran`
--

CREATE TABLE `tb_pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_pelajaran` varchar(20) NOT NULL,
  `nilai_minim` int(2) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelajaran`
--

INSERT INTO `tb_pelajaran` (`id_pelajaran`, `nama_pelajaran`, `nilai_minim`, `create_date`) VALUES
(1, 'SIMDIK', 75, '2022-01-24 15:38:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelajaran_detail`
--

CREATE TABLE `tb_pelajaran_detail` (
  `id_pelajaran_detail` int(11) NOT NULL,
  `pelajaran_id` int(11) NOT NULL,
  `kelas` int(14) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelajaran_detail`
--

INSERT INTO `tb_pelajaran_detail` (`id_pelajaran_detail`, `pelajaran_id`, `kelas`, `create_date`) VALUES
(1, 1, 1, '2022-01-24 15:38:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `bayar_id` int(3) NOT NULL,
  `nis` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `bayar_id`, `nis`, `tanggal`, `status`) VALUES
(1, 1, 123456, '2022-01-24', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nilai_id` int(3) NOT NULL,
  `pelajaran_id` int(3) NOT NULL,
  `nis` int(20) NOT NULL,
  `nilai` int(3) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `nilai_id`, `pelajaran_id`, `nis`, `nilai`, `tanggal`) VALUES
(1, 1, 1, 123456, 70, '2022-01-24'),
(2, 1, 1, 123456, 90, '2022-01-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(14) NOT NULL,
  `nisn` int(14) NOT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(32) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(12) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `status_keluarga` varchar(14) DEFAULT NULL,
  `anak_ke` int(1) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `sekolah_asal` varchar(14) DEFAULT NULL,
  `diterima_kelas` varchar(5) DEFAULT NULL,
  `diterima_tanggal` date DEFAULT NULL,
  `nama_ayah` varchar(32) DEFAULT NULL,
  `nama_ibu` varchar(32) DEFAULT NULL,
  `alamat_orangtua` varchar(52) DEFAULT NULL,
  `kerja_ayah` varchar(12) DEFAULT NULL,
  `kerja_ibu` varchar(12) DEFAULT NULL,
  `nama_wali` varchar(22) DEFAULT NULL,
  `alamat_wali` varchar(32) DEFAULT NULL,
  `kerja_wali` varchar(12) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `token` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nisn`, `password`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_keluarga`, `anak_ke`, `telepon`, `sekolah_asal`, `diterima_kelas`, `diterima_tanggal`, `nama_ayah`, `nama_ibu`, `alamat_orangtua`, `kerja_ayah`, `kerja_ibu`, `nama_wali`, `alamat_wali`, `kerja_wali`, `image`, `status`, `token`, `create_date`) VALUES
(1, 123456, 123456, NULL, 'Dina Ramadhani', 'Purwosari Pasuruan', 'Pasuruan', '2003-02-12', 'Perempuan', 'Islam', 'Anak Kandung', 2, '085788788788', 'SDN Tutur 1', 'VII', '2021-03-24', 'Sudarmaji', 'Nanik', 'Purwosari Pasuruan', 'Swasta', 'IRT', '-', '-', '-', '7-Fasilitas-Sekolah-Kejuruan-Agar-Siswa-Siap-di-Era-Industri-4_0-1.jpg', 1, '', '2022-01-24 15:27:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_syarat`
--

CREATE TABLE `tb_syarat` (
  `id_syarat` int(11) NOT NULL,
  `ketentuan` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_syarat`
--

INSERT INTO `tb_syarat` (`id_syarat`, `ketentuan`, `create_date`) VALUES
(1, 'Aplikasi ini merupakan milik Cv. Jonjava Tecnology. Kami membuat aplikasi berdasarkan permasalahan yang di hadapi publik.', '2021-06-23 08:27:59'),
(2, 'Pengunduhan dan/atau penggunaan Aplikasi ini bebas biaya. Koneksi kepada jaringan internet diperlukan untuk dapat menggunakan Layanan ini. Segala biaya yang timbul atas koneksi perangkat mobile anda dengan jaringan internet sepenuhnya ditanggung oleh anda.', '2021-06-23 08:29:07'),
(3, 'Aplikasi memerlukan izin untuk mengaksesnya, dengan mendaftarkan diri anda ke pihak yang bertanggung jawab anda akan dapat mengakses aplikasi ini.', '2021-06-23 08:30:16'),
(4, 'Segala data yang tampil pada aplikasi adalah data yang telah di setujui oleh beberapa pihak.', '2021-06-23 08:31:12'),
(5, 'Segala data yang tampil pada aplikasi berasal dari situs https://sekolah.aktivisjalanan.com', '2021-06-23 10:07:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tahun`
--

CREATE TABLE `tb_tahun` (
  `id_tahun` int(11) NOT NULL,
  `tahun_ajaran` varchar(12) NOT NULL,
  `ganjil_dari` date NOT NULL,
  `ganjil_sampai` date NOT NULL,
  `genap_dari` date NOT NULL,
  `genap_sampai` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tahun`
--

INSERT INTO `tb_tahun` (`id_tahun`, `tahun_ajaran`, `ganjil_dari`, `ganjil_sampai`, `genap_dari`, `genap_sampai`, `create_date`) VALUES
(1, '2021-2022', '2021-04-07', '2021-12-08', '2022-01-04', '2022-03-30', '2022-01-24 15:35:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `tb_bayar_detail`
--
ALTER TABLE `tb_bayar_detail`
  ADD PRIMARY KEY (`id_bayar_detail`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip_is_unique` (`nip`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_kelas_detail`
--
ALTER TABLE `tb_kelas_detail`
  ADD PRIMARY KEY (`id_detail_kelas`);

--
-- Indeks untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `tb_nilai_detail`
--
ALTER TABLE `tb_nilai_detail`
  ADD PRIMARY KEY (`id_nilai_detail`);

--
-- Indeks untuk tabel `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indeks untuk tabel `tb_pelajaran_detail`
--
ALTER TABLE `tb_pelajaran_detail`
  ADD PRIMARY KEY (`id_pelajaran_detail`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis_is_unique` (`nis`) USING BTREE,
  ADD UNIQUE KEY `nisn_is_unique` (`nisn`);

--
-- Indeks untuk tabel `tb_syarat`
--
ALTER TABLE `tb_syarat`
  ADD PRIMARY KEY (`id_syarat`);

--
-- Indeks untuk tabel `tb_tahun`
--
ALTER TABLE `tb_tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar_detail`
--
ALTER TABLE `tb_bayar_detail`
  MODIFY `id_bayar_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas_detail`
--
ALTER TABLE `tb_kelas_detail`
  MODIFY `id_detail_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai_detail`
--
ALTER TABLE `tb_nilai_detail`
  MODIFY `id_nilai_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelajaran_detail`
--
ALTER TABLE `tb_pelajaran_detail`
  MODIFY `id_pelajaran_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_syarat`
--
ALTER TABLE `tb_syarat`
  MODIFY `id_syarat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tahun`
--
ALTER TABLE `tb_tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
