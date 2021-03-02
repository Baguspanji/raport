<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
			'title' => 'Daftar Siswa',
			'konten' => 'siswa/index',
			'url_tabel'	=> 'siswa/get_siswa'
		);

		$this->load->view('template/index', $data);
	}

	public function get_siswa()
	{
		$list = $this->global->get_data('tb_siswa');
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$detail = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'siswa/edit/' . $field->id_siswa . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nis;
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
					'field' => 'nis',
					'label' => 'NIS Siswa',
					'rules' => 'required|is_unique[tb_siswa.nis]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Tambah Siswa',
					'konten' => 'siswa/form',
					'url_form'	=> 'siswa/add',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nis' => $post['nis'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->post_data('tb_siswa', $data) != null) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('siswa');
			}
		} else {
			$data = array(
				'title' => 'Tambah Siswa',
				'konten' => 'siswa/form',
				'url_form'	=> 'siswa/add'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_siswa'];
		$siswa = $this->global->get_byid('tb_siswa', array('id_siswa' => $id));

		if ($post) {

			$config = array(
				'field' => 'nama',
				'label' => 'Nama Siswa',
				'rules' => 'required',
			);

			if ($post['nis'] != $siswa['nis']) {
				$config = array(
					'field' => 'nis',
					'label' => 'NIS Siswa',
					'rules' => 'required|is_unique[tb_siswa.nis]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$this->form_validation->set_rules(array($config));


			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Edit Siswa',
					'konten' => 'siswa/form',
					'url_form'	=> 'siswa/edit',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nis' => $post['nis'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->put_data('tb_siswa', $data, array('id_siswa' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('siswa');
			}
		} else {
			$data = array(
				'title' => 'Edit Siswa',
				'konten' => 'siswa/form',
				'url_form'	=> 'siswa/edit',
				'data'	=> $siswa
			);

			$this->load->view('template/index', $data);
		}
	}
}
