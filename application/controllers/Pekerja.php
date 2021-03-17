<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Pekerja',
			'konten' => 'pekerja/index',
			'url_tabel'	=> 'pekerja/get_pekerja'
		);

		$this->load->view('template/index', $data);
	}

	public function get_pekerja()
	{
		$list = $this->global->get_data('tb_pekerja');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$detail = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'pekerja/edit/' . $field->id_pekerja . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nip;
			$row[] = $field->nama;
			$row[] = $field->alamat;
			$row[] = $field->tempat_lahir . ', ' . tanggal($field->tanggal_lahir);
			$row[] = $status;
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
					'field' => 'nip',
					'label' => 'NIP Pekerja',
					'rules' => 'required|is_unique[tb_pekerja.nip]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Tambah Pekerja',
					'konten' => 'pekerja/form',
					'url_form'	=> 'pekerja/add',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->post_data('tb_pekerja', $data) != null) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('pekerja');
			}
		} else {
			$data = array(
				'title' => 'Tambah Pekerja',
				'konten' => 'pekerja/form',
				'url_form'	=> 'pekerja/add'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_pekerja'];
		$pekerja = $this->global->get_byid('tb_pekerja', array('id_pekerja' => $id));

		if ($post) {

			$config = array(
				'field' => 'nama',
				'label' => 'Nama Guru',
				'rules' => 'required',
			);

			if ($post['nip'] != $pekerja['nip']) {
				$config = array(
					'field' => 'nip',
					'label' => 'NIP Pekerja',
					'rules' => 'required|is_unique[tb_pekerja.nip]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				);
			}

			$this->form_validation->set_rules(array($config));


			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Edit Pekerja',
					'konten' => 'pekerja/form',
					'url_form'	=> 'pekerja/edit',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->put_data('tb_pekerja', $data, array('id_pekerja' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('pekerja');
			}
		} else {
			$data = array(
				'title' => 'Edit Pekerja',
				'konten' => 'pekerja/form',
				'url_form'	=> 'pekerja/edit',
				'data'	=> $pekerja
			);

			$this->load->view('template/index', $data);
		}
	}
}
