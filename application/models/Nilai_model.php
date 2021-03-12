<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
	public function get_kelas($kelas)
	{
		// $this->db->select('tb_nilai.*');
		$this->db->like('kelas', $kelas);
		return $this->db->get('tb_nilai')->result();
	}

}
