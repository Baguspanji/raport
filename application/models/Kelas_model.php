<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
	public function get_data($status = false, $order = null, $sekolah = null)
	{
		$role = $this->session->userdata('role');
		$username = $this->session->userdata('username');

		if ($status) $this->db->where('status', 1);
		if ($sekolah != null) $this->db->where('tb_kelas.sekolah', $sekolah);
		if ($order != null) $this->db->order_by($order, 'DESC');

		if ($role == 'guru') $this->db->where('tb_guru.nip', $username);

		$this->db->select('tb_kelas.id_kelas, tb_kelas.nama_kelas, tb_kelas.wali_kelas, tb_kelas.tahun_ajaran AS id_tahun, 
			tb_kelas.status, tb_guru.nama, tb_guru.gelar_dpn, tb_guru.gelar_blkg, tb_tahun.tahun_ajaran');
		$this->db->join('tb_guru', 'tb_kelas.wali_kelas = tb_guru.id_guru');
		$this->db->join('tb_tahun', 'tb_kelas.tahun_ajaran = tb_tahun.id_tahun');
		return $this->db->get('tb_kelas')->result();
	}

	public function get_siswa_detail($status = false)
	{

		if ($status) $this->db->where('status', 1);

		$this->db->select('tb_kelas_detail.*');
		$this->db->join('tb_kelas', 'tb_kelas_detail.kelas_id = tb_kelas.id_kelas');
		return $this->db->get('tb_kelas_detail')->result();
	}

	public function get_id($where)
	{
		$this->db->where($where);
		$this->db->join('tb_siswa', 'tb_kelas_detail.siswa = tb_siswa.nis');
		return $this->db->get('tb_kelas_detail')->result_array();
	}
}
