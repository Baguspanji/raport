-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Des 2021 pada 14.10
-- Versi server: 10.3.32-MariaDB-cll-lve
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aktivisj_raport`
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
(1, 12312312, '2021-06-15', 2, '', '2021-06-15 07:19:50'),
(2, 2133132, '2021-06-15', 2, '', '2021-06-15 07:20:05'),
(3, 12312312, '2021-06-26', 4, '', '2021-06-26 14:49:47'),
(4, 12312312, '2021-07-22', 2, '', '2021-07-22 12:47:23'),
(5, 12312312, '2021-07-24', 1, '', '2021-07-23 22:53:24'),
(6, 12312312, '2021-07-27', 0, '', '2021-07-27 13:22:42'),
(7, 12312312, '2021-08-04', 1, '', '2021-08-04 04:38:19'),
(8, 2133132, '2021-08-04', 0, '', '2021-08-04 04:38:02'),
(9, 12312312, '2021-08-06', 1, '', '2021-08-06 14:11:34');

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
  `sekolah` int(3) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `email`, `nama`, `password`, `role`, `sekolah`, `status`, `create_date`) VALUES
(1, 'admin', 'Admin@sekolah.admin', 'Admin Sekolah', '$2y$11$5fKeVGSkMfBrLgCiWuwqSextwwE0o7UhgoMGMShwEicclK.dyYzP2', 'super admin', 0, 1, '2021-04-16 17:35:11'),
(8, 'sekolahkita', 'sekolahkita@gmail.co', 'Sekolah Kita', '$2y$11$jrmmlm2HfRzJDQC6GnASH.fa7hXKxc/Ur35x7uy.K.AozrC1q2XH.', 'admin', 1, 1, '2021-11-10 02:11:06'),
(9, '3897877', 'Andini@gmail.com', 'Dr. Andini, MH.', '$2y$11$ROIneIBBeEKIzvUtwQE7PeGG27CBJRc9m63ul/oDGmUkulzd3JC4O', 'guru', 1, 1, '2021-06-15 09:05:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `nama_bayar` varchar(100) NOT NULL,
  `tahun_ajaran` int(3) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `sekolah` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nama_bayar`, `tahun_ajaran`, `semester`, `sekolah`, `status`, `create_date`) VALUES
(1, 'SPP Semester Ganjil', 1, 1, 1, 1, '2021-06-15 07:00:02'),
(2, 'LKS Semester Ganjil', 1, 1, 1, 1, '2021-06-15 07:00:51'),
(3, 'Infaq Minggu ke 1', 1, 1, 1, 1, '2021-06-26 14:25:01'),
(4, 'Iuran Peringatan Kem', 1, 1, 1, 1, '2021-07-26 17:44:44');

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
(3, 2, 1, '2021-06-15 07:00:57'),
(4, 1, 1, '2021-06-15 07:01:36'),
(5, 3, 1, '2021-06-26 14:25:25');

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
  `sekolah` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nuptk`, `gelar_dpn`, `gelar_blkg`, `nama`, `alamat`, `jenis_kelamin`, `pangkat`, `gol_ruang`, `tingkat_pend`, `tempat_lahir`, `tanggal_lahir`, `tugas_sebagai`, `tugas_mengajar`, `status_pegawai`, `tmt_sekolah`, `no_sk`, `status`, `sekolah`, `image`, `create_date`) VALUES
(1, 343231, 8908808, 'Hj.', 'SH. MH.', 'Gilang', 'Pandaan Pasuruan', 'Perempuan', 'Guru', 'Golongan I', 'SMP', 'Pasuruan', '2021-03-10', 'Guru', 'Bahasa', 'Tetap', 'Tetap', 78987797, 1, 1, '51f6fb256629fc755b8870c801092942.png', '2021-04-17 18:28:42'),
(2, 12131231, 0, '', '', 'Tegar', 'Sukorejo Pasuruan', '', '', '', '', 'Pasuruan', '2021-03-19', '', '', '', '', 0, 1, 1, 'image.png', '2021-04-16 09:59:53'),
(3, 2131122, 0, '', '', 'Romdlon', 'Kraton Pasuruan', '', '', '', '', 'Pasuruan', '2020-07-12', '', '', '', '', 0, 1, 1, 'image.png', '2021-04-16 09:59:55'),
(4, 2134343535, 345345345, ' ', 'S. Kom', 'Panji Bagus', 'Gondang Wetan Pasuruan', 'Laki-laki', 'Guru', 'Golongan I', 'SMP', 'Pasuruan', '2021-03-02', 'Guru', 'Bahasa', 'Tetap', 'Tetap', 2147483647, 1, 1, 'image.png', '2021-07-26 17:34:38'),
(6, 3897877, 76668, 'Dr.', 'MH.', 'Andini', 'Sukorejo', 'Perempuan', 'Guru', 'Golongan 1', 'SMP', 'Pasuruan', '2021-10-10', 'Guru', 'Matematika', 'Matematika', 'Tetap', 7687786, 1, 1, 'image.png', '2021-04-16 09:59:59');

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
  `sekolah` int(3) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `wali_kelas`, `tahun_ajaran`, `status`, `sekolah`, `create_date`) VALUES
(1, 'VII A', '6', 1, 1, 1, '2021-06-15 22:26:18'),
(2, 'VIII C', '4', 1, 1, 1, '2021-06-19 19:10:02'),
(3, 'kelas IX C', '1', 1, 1, 1, '2021-06-19 19:10:28');

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
(1, 1, 2133132, '2021-06-15 06:42:38'),
(2, 1, 12312312, '2021-06-15 06:42:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nama_nilai` varchar(100) NOT NULL,
  `tahun_ajaran` int(2) NOT NULL,
  `sekolah` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `nama_nilai`, `tahun_ajaran`, `sekolah`, `status`, `create_date`) VALUES
(1, 'Nilai Tugas 1', 1, 1, 1, '2021-06-26 14:34:40'),
(2, 'Ulangan Harian', 1, 1, 1, '2021-06-15 06:43:19'),
(3, 'Ujian Akhir Semester', 1, 1, 1, '2021-07-26 17:41:15');

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
(2, 2, 1, '2021-06-15 06:43:28'),
(3, 1, 1, '2021-07-23 22:59:01'),
(4, 1, 3, '2021-07-23 22:59:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelajaran`
--

CREATE TABLE `tb_pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_pelajaran` varchar(20) NOT NULL,
  `nilai_minim` int(2) NOT NULL,
  `sekolah` int(3) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelajaran`
--

INSERT INTO `tb_pelajaran` (`id_pelajaran`, `nama_pelajaran`, `nilai_minim`, `sekolah`, `create_date`) VALUES
(1, 'Bahasa Indonesia', 63, 1, '2021-08-04 05:26:14'),
(2, 'Matematika', 80, 1, '2021-06-15 07:17:02');

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
(1, 1, 1, '2021-06-15 07:16:56'),
(2, 2, 1, '2021-06-15 07:17:08');

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
(1, 2, 2133132, '2021-06-15', 0),
(2, 2, 12312312, '2021-06-15', 0),
(3, 1, 12312312, '2021-07-27', 0),
(4, 1, 2133132, '2021-07-27', 0),
(6, 3, 2133132, '2021-07-27', 0);

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
(1, 1, 1, 12312312, 70, '2021-06-15'),
(2, 1, 1, 12312312, 90, '2021-06-15'),
(3, 1, 1, 2133132, 55, '2021-06-15'),
(5, 1, 1, 2133132, 70, '2021-06-15'),
(6, 1, 1, 2133132, 90, '2021-06-15'),
(7, 1, 2, 12312312, 60, '2021-06-26'),
(8, 1, 2, 12312312, 90, '2021-06-26'),
(9, 2, 1, 12312312, 89, '2021-07-27'),
(10, 2, 1, 2133132, 90, '2021-07-27'),
(11, 2, 2, 12312312, 70, '2021-08-04'),
(12, 2, 1, 12312312, 78, '2021-08-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat`, `status`, `create_date`) VALUES
(1, 'Sekolah Kita', 'Ngabar Kraton Pasuruan', 1, '2021-11-10 02:08:39');

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
  `sekolah` int(3) NOT NULL,
  `token` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nisn`, `password`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_keluarga`, `anak_ke`, `telepon`, `sekolah_asal`, `diterima_kelas`, `diterima_tanggal`, `nama_ayah`, `nama_ibu`, `alamat_orangtua`, `kerja_ayah`, `kerja_ibu`, `nama_wali`, `alamat_wali`, `kerja_wali`, `image`, `status`, `sekolah`, `token`, `create_date`) VALUES
(5, 123131232, 123, '$2y$11$KRlLbT1K6UH3GDe3UKzTfe7tWn7QBUExMQYh9e7yd6.oQVZhiuZle', 'Riziq Hendra', 'Sukorejo Pasuruan', 'Pasuruan', '2021-03-02', 'Laki-laki', 'Islam', 'Anak Kandung', 2, '898008', '-', '-', '2021-03-01', '-', '-', '-', '-', '-', '-', '-', '-', '51f6fb256629fc755b8870c8010929422.png', 1, 1, '', '2021-05-04 16:45:20'),
(56, 23422443, 1242, NULL, 'Fajar', 'Tosari Pasuruan', 'Pasuruan', '2021-03-10', NULL, '', '', 0, '', '0', '', '0000-00-00', '', '', '', '', '', '0', '0', '0', 'images.png', 1, 1, '', '2021-05-04 09:24:11'),
(57, 12312312, 12312312, '$2y$11$d4moPEiPTRMxdLaNXHABjOk5aQknJUlBz9ir/3wBbxnnI1JKKDXIW', 'Vivi Salsabila', 'Tutur Pasuruan', 'Pasuruan', '2019-02-06', 'Perempuan', 'Islam', 'Anak Kandung', 2, '98098908', 'SDN Tutur', 'VII', '2021-03-03', 'Sudarmaji', 'Nanik', 'Tutur Pasuruan', 'PNS', 'Wiraswasta', '-', '-', '-', 'images.png', 1, 1, '', '2021-08-11 13:29:17'),
(65, 2133132, 231314, '$2y$11$zHVxk7iKQPeX8yT75fMVZuFUos9Wgv9CABFhGopg8R5vbnHBx2rPG', 'Sandi Anugrah', 'Gondang Wetan', 'Pasuruan', '1999-06-19', 'Laki-laki', 'Islam', 'Anak Kandung', 2, '867545', 'SD Tutur', 'VII', '2021-03-13', 'Sumandi', 'Sumiyati', 'Tosari Pasuruan', 'Wirausaha', 'Wirausaha', '-', '-', '-', 'user-male1.png', 1, 1, '', '2021-10-26 12:08:04'),
(67, 2131122, 345355, NULL, 'Romdlon', 'Tosari', 'Pasuruan', '1999-06-19', 'Perempuan', 'Islam', 'Anak Angkat', 3, '8786876', 'SD Purwosari', 'VII', '2020-05-17', 'Sumandi', 'Sumiyati', 'Tosari Pasuruan', 'Wirausaha', 'Wirausaha', '-', '-', '-', 'user.png', 1, 1, '', '2021-06-03 14:54:56'),
(68, 231234545, 232435453, NULL, 'Izza Nasikhah', 'Ngembal Pasuruan', 'Pasuruan', '2021-04-06', 'Perempuan', 'Islam', 'Anak Kandung', 2, '231231321312', 'SDN Tutur 1', 'VII', '2021-04-15', 'Sudarmaji', 'Nanik', 'Tutur Pasuruan', 'PNS', 'Wiraswasta', '-', '-', '-', '51f6fb256629fc755b8870c8010929421.png', 1, 1, '', '2021-05-04 09:24:11');

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
  `sekolah` int(3) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tahun`
--

INSERT INTO `tb_tahun` (`id_tahun`, `tahun_ajaran`, `ganjil_dari`, `ganjil_sampai`, `genap_dari`, `genap_sampai`, `sekolah`, `create_date`) VALUES
(1, '2021-2022', '2021-05-15', '2021-12-24', '2021-01-02', '2021-05-07', 1, '2021-06-15 06:41:07');

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
-- Indeks untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

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
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar_detail`
--
ALTER TABLE `tb_bayar_detail`
  MODIFY `id_bayar_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas_detail`
--
ALTER TABLE `tb_kelas_detail`
  MODIFY `id_detail_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai_detail`
--
ALTER TABLE `tb_nilai_detail`
  MODIFY `id_nilai_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pelajaran_detail`
--
ALTER TABLE `tb_pelajaran_detail`
  MODIFY `id_pelajaran_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
