<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
	
	public function get_data($status = false, $order = null, $sekolah = null)
	{
		$role = $this->session->userdata('role');
		$username = $this->session->userdata('username');
		
		if ($status) $this->db->where('status', 1);
		if ($order != null) $this->db->order_by($order, 'DESC');

		if ($role == 'guru') $this->db->where('tb_guru.nip', $username);

		if($sekolah != null) $this->db->where('tb_kelas.sekolah', $sekolah);

		$this->db->select('tb_kelas.*, tb_guru.nama, tb_guru.gelar_dpn, tb_guru.gelar_blkg, tb_tahun.tahun_ajaran');
		$this->db->join('tb_guru', 'tb_kelas.wali_kelas = tb_guru.id_guru');
		$this->db->join('tb_tahun', 'tb_kelas.tahun_ajaran = tb_tahun.id_tahun');
		return $this->db->get('tb_kelas')->result();
	}

	public function get_bynis_absen($nis)
	{

		$this->db->where('nis_siswa', $nis);
		$this->db->where('tanggal', date('Y-m-d'));
		return $this->db->get('tb_absensi')->row_array();
	}

	public function get_now($nis)
	{
		$this->db->where('nis_siswa', $nis);
		$this->db->where('tanggal', date('Y-m-d'));
		return $this->db->get('tb_absensi')->row_array();
	}

	public function count_absen($nis, $absen, $start_date, $end_date)
	{
		$this->db->where('nis_siswa', $nis);
		$this->db->where('absen', $absen);
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		return $this->db->get('tb_absensi')->num_rows();
	}
}
