<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
	public function get_siswa_detail($status = false){

		if ($status) $this->db->where('status', 1);

		$this->db->select('tb_kelas_detail.*');
		$this->db->join('tb_kelas', 'tb_kelas_detail.kelas_id = tb_kelas.id_kelas');
		return $this->db->get('tb_kelas_detail')->result();
	}

}
