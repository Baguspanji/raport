<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model
{

	public function get_data($table){
		return $this->db->get($table)->result();
	}

	public function post_data($table, $data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function put_data($table, $data, $where)
	{   $this->db->where($where);
		$this->db->update($table, $data);
		return true;
	}

	public function get_byid($table, $where){
		return $this->db->get_where($table, $where)->row_array();
	}

}
