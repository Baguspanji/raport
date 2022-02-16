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
		allowed('admin', 'guru', 'pengawas');

		$data = array(
			'title' => 'Dashboard',
			'konten' => 'admin/dashboard',
			'siswa'		=> $this->global->count_data('tb_siswa', array('status' => 1)),
			'guru'		=> $this->global->count_data('tb_guru', array('status' => 1)),
			'kelas'		=> $this->global->count_data('tb_kelas', array('status' => 1)),
			'pekerja'		=> 2,
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
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Berhasil Login sebagai Admin Sekolah", "success", "las la-exclamation")</script>');
				redirect();
			} elseif ($cekdata == "pengawas") {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Berhasil Login sebagai Pengawas", "success", "las la-exclamation")</script>');
				redirect();
			} elseif ($cekdata == "guru") {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Berhasil Login sebagai Guru", "success", "las la-exclamation")</script>');
				redirect();
			} elseif ($cekdata == "pass false") {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Login Gagal, Password Salah", "danger", "las la-exclamation")</script>');
				redirect('admin/login');
			} elseif ($cekdata == "nonaktif") {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Login Gagal, akun dinonaktifkan", "danger", "las la-exclamation")</script>');
				redirect('admin/login');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Login Gagal, Username tidak ditemukan", "danger", "las la-exclamation")</script>');
				redirect('admin/login');
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

	public function add_data()
	{
		$list = $this->global->get_data('tb_sekolah');

		foreach ($list as $field) {
			$output['suggestions'][] = [
				'value' => $field->nama_sekolah,
				'data'  => $field->id_sekolah
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}


	public function user()
	{
		allowed('admin', 'guru');

		$user = $this->admin->get_detail();
		$post = $this->input->post();

		if ($post) {
			$config = array(
				'field' => 'password',
				'label' => 'Password Guru',
				'rules' => 'required|min_length[5]',
			);

			$this->form_validation->set_rules(array($config));

			if ($this->form_validation->run() == false || $post['password'] != $post['re-password']) {
				$data = array(
					'title' => 'Detail User ' . $user['nama'],
					'konten' => 'admin/auth',
					'url_form'	=> 'admin/user',
					'data'	=> $user,
					'error' => $post['password'] != $post['re-password'] ? 'Sandi yang anda masukkan tidak sama' : ''
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'password' => $this->admin->makeHash($post['password']),
				);

				if ($this->global->put_data('tb_admin', $data, array('id_admin' => $post['id_admin']))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}

				redirect();

				echo json_encode($data);
			}
		} else {
			$data = array(
				'title' => 'Detail User ' . $user['nama'],
				'konten' => 'admin/auth',
				'url_form'	=> 'admin/user',
				'data' => $user
			);

			$this->load->view('template/index', $data);
		}
	}
}
