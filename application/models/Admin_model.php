<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	function login($user, $pass)
	{
		$query = $this->db->get_where('tb_admin', array('username' => $user));
		$data = $query->row_array();
		if ($query != null) {
			$hash = $data['password'];
			if ($data['aktif'] == false) {
				return "nonaktif";
			} elseif (password_verify($pass, $hash)) {
				$this->session->set_userdata(
					array(
						'role'     => $data['role'],
						'id_admin' => $data['id_admin'],
						'nama'     => $data['nama'],
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
}
