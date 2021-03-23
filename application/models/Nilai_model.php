<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
	public function get_data($status = false, $order = null)
	{
		$role = $this->session->userdata('role');
		$username = $this->session->userdata('username');
		
		if ($status) $this->db->where('status', 1);
		if ($order != null) $this->db->order_by($order, 'DESC');

		if ($role == 'guru') $this->db->where('tb_guru.nip', $username);

		$this->db->select('tb_kelas.*, tb_guru.nama, tb_guru.gelar_dpn, tb_guru.gelar_blkg, tb_tahun.tahun_ajaran');
		$this->db->join('tb_guru', 'tb_kelas.wali_kelas = tb_guru.id_guru');
		$this->db->join('tb_tahun', 'tb_kelas.tahun_ajaran = tb_tahun.id_tahun');
		return $this->db->get('tb_kelas')->result();
	}
	public function get_kelas($kelas)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->like('kelas', $kelas);
		return $this->db->get('tb_nilai')->result();
	}

	public function get_pelajaran($kelas)
	{
		$this->db->like('kelas', $kelas);
		return $this->db->get('tb_pelajaran')->result();
	}

	public function get_bypelajaran($kelas)
	{
		$this->db->where('kelas', $kelas);
		return $this->db->get('tb_pelajaran')->row_array();
	}

	public function get_nilai_siswa($nis, $nilai, $pelajaran, $start_date = null, $end_date = null)
	{
		if ($start_date != null && $end_date != null) $this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		$this->db->where('nis', $nis);
		$this->db->where('nilai_id', $nilai);
		$this->db->where('pelajaran_id', $pelajaran);
		return $this->db->get('tb_penilaian')->result();
	}
	
	public function get_kelas_detail($kelas)
	{
		$this->db->join('tb_tahun', 'tb_kelas.tahun_ajaran = tb_tahun.id_tahun');
		$this->db->where('id_kelas', $kelas);
		return $this->db->get('tb_kelas')->row_array();
	}
}
