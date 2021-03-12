<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bayar_model extends CI_Model
{
	public function get_kelas($kelas)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->like('kelas', $kelas);
		return $this->db->get('tb_bayar')->result();
	}

	public function get_bynis($id, $nis)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->where('nis', $nis);
		$this->db->where('bayar_id', $id);
		return $this->db->get('tb_pembayaran')->row_array();
	}

	public function get_siswa($nis, $start_date, $end_date)
	{
		$this->db->join('tb_bayar', 'tb_pembayaran.bayar_id = tb_bayar.id_bayar');
		$this->db->where('nis', $nis);
		$this->db->where('tanggal BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		return $this->db->get('tb_pembayaran')->result();
	}
}
