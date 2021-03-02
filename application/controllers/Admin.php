<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'konten' => 'admin/dashboard'
		);

		$this->load->view('template/index', $data);
	}
}
