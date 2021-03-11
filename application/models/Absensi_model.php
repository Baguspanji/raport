<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
	public function get_bynis_absen($nis){
		
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
		$this->db->where('tanggal BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		return $this->db->get('tb_absensi')->num_rows();
	}
}
