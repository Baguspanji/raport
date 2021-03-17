<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Admin_model', 'admin');
	}


	public function index()
	{
		allowed('admin');

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
		$post = $this->input->post();
		if ($post != null) {

			$cekdata = $this->admin->login($post['user'], $post['pass']);

			if ($cekdata == "admin") {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Berhasil Login sebagai Admin", "warning", "las la-exclamation")</script>');
				redirect();
			} elseif ($cekdata == "pass false") {
				$this->session->sess_destroy();
				echo "<script>alert('Login Gagal, Password Salah');document.location.href='" . base_url('auth') . "';</script>";
			} elseif ($cekdata == "nonaktif") {
				$this->session->sess_destroy();
				echo "<script>alert('Login Gagal, akun dinonaktifkan');document.location.href='" . base_url('auth') . "';</script>";
			} else {
				$this->session->sess_destroy();
				echo "<script>alert('Login Gagal, Username tidak ditemukan');document.location.href='" . base_url('admin/login') . "';</script>";
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}
