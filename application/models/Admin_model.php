<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	function login($user, $pass)
	{
		$data = $this->db->get_where('tb_admin', array('username' => $user))->row_array();
		if ($data != null) {
			$hash = $data['password'];
			if ($data['status'] == 0) {
				return "nonaktif";
			} elseif (password_verify($pass, $hash)) {
				$this->session->set_userdata(
					array(
						'role'     => $data['role'],
						'id_admin' => $data['id_admin'],
						'nama'     => $data['nama'],
						'username' => $data['username'],
					)
				);
				return $data['role'];
			} else {
				return "pass false";
			}
		}
	}

	function makeHash($string)
	{
		$options = array('cost' => 11);
		$hash    = password_hash($string, PASSWORD_BCRYPT, $options);
		return $hash;
	}

	public function get_detail()
	{
		$username = $this->session->userdata('username');

		$this->db->where('username', $username);
		return $this->db->get('tb_admin')->row_array();
	}
}
