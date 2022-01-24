<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model
{

	public function get_data($table, $status = false, $order = null) {
		if($status)	$this->db->where('status', 1);
		if($order != null) $this->db->order_by($order, 'DESC');
		return $this->db->get($table)->result();
	}

	public function get_data_where($table, $where, $in, $status = false){
		if($status)$this->db->where('status', 1);

		$this->db->where_in($where, $in);		
		return $this->db->get($table)->result();
	}

	public function get_data_where_not($table, $where, $in){
		$this->db->where_not_in($where, $in);		
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
	
	public function insert_batch($table, $data){
		$this->db->insert_batch($table, $data);
		return $this->db->insert_id();
	}

	public function post_data_batch($table, $data)
	{
		$this->db->replace_batch($table, $data);
		return $this->db->insert_id();
	}

	public function get_id($table, $where)
	{
		return $this->db->get_where($table, $where)->result_array();
	}

	public function get_byid($table, $where)
	{
		return $this->db->get_where($table, $where)->row_array();
	}

	public function count_data($table, $where)
	{
		$this->db->where($where);
		return $this->db->get($table)->num_rows();
	}

	public function del_data($table, $where)
	{
		return $this->db->delete($table, $where);
	}

}
