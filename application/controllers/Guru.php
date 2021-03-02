<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Guru',
			'konten' => 'guru/index',
			'url_tabel'	=> 'guru/get_guru'
		);

		$this->load->view('template/index', $data);
	}

	public function get_guru()
	{
		$list = $this->global->get_data('tb_guru');
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$detail = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'guru/edit/' . $field->id_guru . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nig;
			$row[] = $field->nama;
			$row[] = $field->alamat;
			$row[] = $field->tempat_lahir . ', ' . tanggal($field->tanggal_lahir);
			$row[] = $detail . ' ' . $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add()
	{
		$post = $this->input->post();
		if ($post) {

			$config = array(
				array(
					'field' => 'nig',
					'label' => 'NIG Guru',
					'rules' => 'required|is_unique[tb_guru.nig]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Tambah Guru',
					'konten' => 'guru/form',
					'url_form'	=> 'guru/add',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nig' => $post['nig'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->post_data('tb_guru', $data) != null) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('guru');
			}
		} else {
			$data = array(
				'title' => 'Tambah Guru',
				'konten' => 'guru/form',
				'url_form'	=> 'guru/add'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_guru'];
		$guru = $this->global->get_byid('tb_guru', array('id_guru' => $id));

		if ($post) {

			$config = array(
				'field' => 'nama',
				'label' => 'Nama Guru',
				'rules' => 'required',
			);

			if ($post['nig'] != $guru['nig']) {
				$config = array(
					'field' => 'nig',
					'label' => 'NIS Guru',
					'rules' => 'required|is_unique[tb_guru.nig]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$this->form_validation->set_rules(array($config));


			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Edit Guru',
					'konten' => 'guru/form',
					'url_form'	=> 'guru/edit',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nig' => $post['nig'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->put_data('tb_guru', $data, array('id_guru' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('guru');
			}
		} else {
			$data = array(
				'title' => 'Edit Guru',
				'konten' => 'guru/form',
				'url_form'	=> 'guru/edit',
				'data'	=> $guru
			);

			$this->load->view('template/index', $data);
		}
	}
}
