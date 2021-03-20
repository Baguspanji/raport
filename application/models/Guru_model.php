<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru_model extends CI_Model
{
	public function get_guru_detail($nis)
	{
		// $this->db->select('tb_tahun.*');
		$this->db->join('tb_kelas', 'tb_kelas_detail.kelas_id = tb_kelas.id_kelas');
		$this->db->join('tb_tahun', 'tb_kelas.tahun_ajaran = tb_tahun.id_tahun');
		$this->db->like('guru', $nis);
		$this->db->order_by('ganjil_dari', 'ASC');
		return $this->db->get('tb_kelas_detail')->result();
	}

}
