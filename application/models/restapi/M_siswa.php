<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_siswa extends CI_Model
{

	public function login($data)
	{
		$username = $data['username'];
		$password = $data['password'];
		$token    = $data['token'];

		$rt = array(
			'status'        => false,
			'username'    => '',
			'nama'  => '',
			'telepone'  => ''
		);

		$hasil = $this->db->get_where('tb_siswa',  array('nis' => $username));

		if ($hasil->num_rows() > 0) {
			$this->db->set('token', $token);
			$this->db->where('nis', $username);
			$this->db->update('tb_siswa');
			$ro = $hasil->row();
			if ($ro->password == null) {
				if ($ro->nis == $password) {
					$nama               = $ro->nama;
					$rt['status']       = true;
					$rt['username']     = $ro->nis;
					$rt['nama']         = $nama;
					$rt['alamat']         = $ro->alamat;
					$rt['tempat_lahir']         = $ro->tempat_lahir;
					$rt['tanggal_lahir']         = $ro->tanggal_lahir;
					$rt['image']         = $ro->image;
				}
			} elseif (password_verify($password, $ro->password)) {
				$nama               = $ro->nama;
				$rt['status']       = true;
				$rt['username']     = $ro->nis;
				$rt['nama']         = $nama;
				$rt['nama']         = $nama;
				$rt['alamat']         = $ro->alamat;
				$rt['tempat_lahir']         = $ro->tempat_lahir;
				$rt['tanggal_lahir']         = $ro->tanggal_lahir;
				$rt['image']         = $ro->image;
			}
		}
		return $rt;
	}

	public function update_pass($data)
	{
		$username = $data['username'];
		$password = $data['password'];

		return $this->db->set('password', $this->makeHash($password))
			->where('nis', $username)
			->update('tb_siswa');
	}

	public function get_semester($data)
	{
		$nis = $data['username'];

		return $this->db->select('k.*, t.*')
			->where('kd.siswa', $nis)
			->join('tb_kelas_detail AS kd', 'k.id_kelas = kd.kelas_id')
			->join('tb_tahun AS t', 't.id_tahun = k.tahun_ajaran')
			->get('tb_kelas AS k')->result();
	}

	public function get_absen($data)
	{
		$nis = $data['username'];
		$start_date = $data['tgl_awal'];
		$end_date = $data['tgl_akhir'];

		$alpha = $this->count_absen($nis, 2, $start_date, $end_date);
		$izin = $this->count_absen($nis, 3, $start_date, $end_date);
		$sakit = $this->count_absen($nis, 4, $start_date, $end_date);

		return array(
			'alpha' => $alpha,
			'izin' => $izin,
			'sakit' => $sakit,
		);
	}

	public function count_absen($nis, $absen, $start_date, $end_date)
	{
		$this->db->where('nis_siswa', $nis);
		$this->db->where('absen', $absen);
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		return $this->db->get('tb_absensi')->num_rows();
	}

	public function get_bayar($data)
	{
		$nis = $data['username'];
		$start_date = $data['tgl_awal'];
		$end_date = $data['tgl_akhir'];
		$kelas = $data['id_kelas'];
		$semester = $data['semester'];

		return $this->get_kelas_bayar($nis, $kelas, $start_date, $end_date, $semester);
	}

	public function get_kelas_bayar($nis, $id_kelas, $start_date, $end_date, $semester)
	{
		$this->db->where('kelas', $id_kelas);
		$this->db->where('semester', $semester);
		$this->db->join('tb_bayar_detail', 'tb_bayar.id_bayar = tb_bayar_detail.bayar_id');
		$list = $this->db->get('tb_bayar')->result();

		$res = array();
		foreach ($list as $key) {
			$bayar['bayar'] = $key->nama_bayar;
			$bayar['status'] = $this->get_pembayaran($nis, $key->id_bayar, $start_date, $end_date) != null ? 1 : 0;

			$res[] = $bayar;
		}

		return $res;
	}

	public function get_pembayaran($nis, $id_bayar, $start_date, $end_date)
	{
		$this->db->join('tb_bayar', 'tb_pembayaran.bayar_id = tb_bayar.id_bayar');
		$this->db->where('nis', $nis);
		$this->db->where('id_bayar', $id_bayar);
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		return $this->db->get('tb_pembayaran')->row_array();
	}

	public function get_nilai($data)
	{
		$nis = $data['username'];
		$start_date = $data['tgl_awal'];
		$end_date = $data['tgl_akhir'];
		$kelas = $data['id_kelas'];

		return $this->get_pelajaran($nis, $kelas, $start_date, $end_date);
	}

	public function get_pelajaran($nis, $id_kelas, $start_date, $end_date)
	{
		$this->db->where('kelas', $id_kelas);
		$this->db->join('tb_pelajaran_detail', 'tb_pelajaran.id_pelajaran = tb_pelajaran_detail.pelajaran_id');
		$list = $this->db->get('tb_pelajaran')->result();

		$res = array();
		foreach ($list as $key) {
			$pelajaran['pelajaran'] = $key->nama_pelajaran;
			$pelajaran['nilai_minim'] = $this->get_bypelajaran($id_kelas)['nilai_minim'];
			$pelajaran['jenis'] = $this->get_kelas_pelajaran($nis, $id_kelas, $key->id_pelajaran, $start_date, $end_date);
			$res[] = $pelajaran;
		}

		return $res;
	}

	public function get_kelas_pelajaran($nis, $id_kelas, $id_pelajaran, $start_date, $end_date)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->where('kelas', $id_kelas);
		$this->db->join('tb_nilai_detail', 'tb_nilai.id_nilai = tb_nilai_detail.nilai_id');
		$list = $this->db->get('tb_nilai')->result();

		$res = array();
		foreach ($list as $key) {
			$nilai['jenis'] = $key->nama_nilai;
			// $nilai['nilai_minim'] = $this->get_bypelajaran($id_kelas)['nilai_minim'];
			$nilai['nilai_rata'] = $this->get_nilai_siswa_average($nis, $id_kelas, $key->id_nilai, $id_pelajaran, $start_date, $end_date);
			$nilai['nilai'] = $this->get_nilai_siswa($nis, $id_kelas, $key->id_nilai, $id_pelajaran, $start_date, $end_date);
			$res[] = $nilai;
		}

		return $res;
	}

	public function get_nilai_siswa_average($nis, $id_kelas, $nilai, $pelajaran, $start_date = null, $end_date = null)
	{
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		$this->db->where('nis', $nis);
		$this->db->where('nilai_id', $nilai);
		$this->db->where('pelajaran_id', $pelajaran);
		$list = $this->db->get('tb_penilaian')->result();

		$hasil = 0;
		$count = 0;
		foreach ($list as $key) {
			$hasil = $hasil + $key->nilai;
			$count++;
		}

		return $hasil != 0 ? $hasil / $count : 0;
	}

	public function get_nilai_siswa($nis, $id_kelas, $nilai, $pelajaran, $start_date = null, $end_date = null)
	{
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		$this->db->where('nis', $nis);
		$this->db->where('nilai_id', $nilai);
		$this->db->where('pelajaran_id', $pelajaran);
		$list = $this->db->get('tb_penilaian')->result();

		$res = array();
		foreach ($list as $key) {
			$hasil['nilai'] = $key->nilai;
			// $hasil['nilai_minim'] = $this->get_bypelajaran($id_kelas)['nilai_minim'];
			$res[] = $hasil;
		}

		return $res;
	}

	public function get_bypelajaran($kelas)
	{
		$this->db->where('kelas', $kelas);
		$this->db->join('tb_pelajaran_detail', 'tb_pelajaran.id_pelajaran = tb_pelajaran_detail.pelajaran_id');
		return $this->db->get('tb_pelajaran')->row_array();
	}

	// ======================= Auth ==========================
	// =======================================================

	function makeHash($string)
	{
		$options = array('cost' => 11);
		$hash    = password_hash($string, PASSWORD_BCRYPT, $options);
		return $hash;
	}
}
