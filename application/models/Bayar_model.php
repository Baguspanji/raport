<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bayar_model extends CI_Model
{
	public function get_kelas($kelas, $semester = null)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->where('kelas', $kelas);
		if($semester != null)$this->db->where('semester', $semester);
		$this->db->join('tb_bayar_detail', 'tb_bayar.id_bayar = tb_bayar_detail.bayar_id');
		return $this->db->get('tb_bayar')->result();
	}

	public function get_bynis($id, $nis)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->where('nis', $nis);
		$this->db->where('bayar_id', $id);
		return $this->db->get('tb_pembayaran')->row_array();
	}

	public function get_siswa($nis, $id_bayar, $start_date, $end_date, $semester)
	{
		$this->db->join('tb_bayar', 'tb_pembayaran.bayar_id = tb_bayar.id_bayar');
		$this->db->where('nis', $nis);
		$this->db->where('id_bayar', $id_bayar);
		$this->db->where('semester', $semester);
		$this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
		return $this->db->get('tb_pembayaran')->row_array();
	}
}
