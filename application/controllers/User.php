<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
			'title' => 'Daftar Guru',
			'konten' => 'user/index',
			'url_tabel'	=> 'user/get_user'
		);

		$this->load->view('template/index', $data);
	}

	public function get_user()
	{
		$list = $this->global->get_data_where('tb_admin', 'role', array('guru'), true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$role = '<a href="#" class="btn btn-sm btn-info"><i class="fa fa-user"></i> ' . ucfirst($field->role) . '</a>';

			$edit = '<a href="' . base_url() . 'admin/edit/' . $field->id_admin . '" class="btn btn-sm btn-warning disabled"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->username;
			$row[] = $field->email;
			$row[] = $field->nama;
			$row[] = $role;
			$row[] = $status;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_data()
	{
		$list = $this->global->get_data('tb_guru');

		foreach ($list as $field) {
			$output['suggestions'][] = [
				'value' => ($field->gelar_dpn != null ? $field->gelar_dpn . ' ' : '') . $field->nama . ($field->gelar_blkg != null ? ', ' . $field->gelar_blkg : ''),
				'data'  => $field->id_guru,
				'nip'  => $field->nip,
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}

	public function add()
	{
		allowed('admin');

		$post = $this->input->post();

		if ($post) {

			$config = array(
				array(
					'field' => 'username',
					'label' => 'Username Guru',
					'rules' => 'required|is_unique[tb_admin.username]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				),
				array(
					'field' => 'email',
					'label' => 'Email Guru',
					'rules' => 'required|is_unique[tb_admin.email]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Tambah User ',
					'konten' => 'user/form',
					'url_form'	=> 'user/add',
					'data'	=> $post,
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'username' => $post['username'],
					'email' => $post['email'],
					'nama' => $post['nama'],
					'password' => $this->admin->makeHash($post['username']),
					'role' => $post['role'],
				);

				if ($this->global->post_data('tb_admin', $data) != null) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}

				redirect('user');

				echo json_encode($data);
			}
		} else {
			$data = array(
				'title' => 'Tambah User ',
				'konten' => 'user/form',
				'url_form'	=> 'user/add',
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		allowed('admin');

		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_guru'];
		$guru = $this->global->get_byid('tb_guru', array('id_guru' => $id));
		$admin = $this->global->get_byid('tb_admin', array('id_admin' => $id));

		if ($post) {

			$config = array(
				'field' => 'password',
				'label' => 'Password Guru',
				'rules' => 'required',
			);

			if ($post['username'] != $admin['username']) {
				$config = array(
					'field' => 'username',
					'label' => 'Username Guru',
					'rules' => 'required|is_unique[tb_admin.username]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			if ($post['email'] != $admin['email']) {
				$config = array(
					'field' => 'email',
					'label' => 'Email Guru',
					'rules' => 'required|is_unique[tb_admin.email]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$this->form_validation->set_rules(array($config));

			if ($this->form_validation->run() == false || $post['password'] != $post['re-password']) {
				$data = array(
					'title' => 'Auth Guru ' . ($guru['gelar_dpn'] != null ? $guru['gelar_dpn'] . ' ' : '') . $guru['nama'] . ($guru['gelar_blkg'] != null ? ', ' . $guru['gelar_blkg'] . ' ' : ''),
					'konten' => 'guru/auth',
					'url_form'	=> 'guru/auth',
					'data'	=> $post,
					'error' => $post['password'] != $post['re-password'] ? 'Sandi yang anda masukkan tidak sama' : ''
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'username' => $post['username'],
					'email' => $post['email'],
					'nama' => ($guru['gelar_dpn'] != null ? $guru['gelar_dpn'] . ' ' : '') . $guru['nama'] . ($guru['gelar_blkg'] != null ? ', ' . $guru['gelar_blkg'] . ' ' : ''),
					'password' => $this->admin->makeHash($post['password']),
					'role' => 'guru'
				);

				if ($this->global->put_data('tb_admin', $data, array('id_admin' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}

				redirect('guru');

				echo json_encode($data);
			}
		} else {
			$data = array(
				'title' => 'Auth Guru ' . ($guru['gelar_dpn'] != null ? $guru['gelar_dpn'] . ' ' : '') . $guru['nama'] . ($guru['gelar_blkg'] != null ? ', ' . $guru['gelar_blkg'] . ' ' : ''),
				'konten' => 'admin/form',
				'url_form'	=> 'admin/edit',
				'data'	=> $admin
			);

			$this->load->view('template/index', $data);
		}
	}
}
