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

}
