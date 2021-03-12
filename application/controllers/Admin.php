<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
	}


	public function index()
	{
		// allowed('admin');

		$data = array(
			'title' => 'Dashboard',
			'konten' => 'admin/dashboard',
			'siswa'		=> $this->global->count_data('tb_siswa', array('status' => 1)),
			'guru'		=> $this->global->count_data('tb_guru', array('status' => 1)),
			'kelas'		=> $this->global->count_data('tb_kelas', array('status' => 1)),
			'pekerja'		=> $this->global->count_data('tb_pekerja', array('status' => 1)),
		);

		$this->load->view('template/index', $data);
		// echo json_encode($data);
	}

	public function login()
	{
		$data = array(
			'title' => 'Dashboard',
			'konten' => 'admin/login',
		);

		$this->load->view('template/index', $data);
		// echo json_encode($data);
	}
}
