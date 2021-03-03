<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
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
			'title' => 'Daftar Tahun Ajaran',
			'konten' => 'tahun/index',
			'url_tabel'	=> 'tahun/get_tahun',
		);

		$this->load->view('template/index', $data);
	}

	public function get_tahun()
	{
		$list = $this->global->get_data('tb_tahun');
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$edit = '<a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->tahun_ajaran;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = array(
			'tahun_ajaran' => $post['tahun_ajaran'],
		);

		if ($this->global->post_data('tb_tahun', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('tahun');
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_kelas'];
		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));

		if ($post) {

			$config = array(
				'field' => 'wali_kelas',
				'label' => 'Nama Guru',
				'rules' => 'required',
			);

			if ($post['nama_kelas'] != $kelas['nama_kelas']) {
				$config = array(
					'field' => 'nama_kelas',
					'label' => 'Nama Kelas',
					'rules' => 'required|is_unique[tb_kelas.nama_kelas]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$this->form_validation->set_rules(array($config));


			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Edit Kelas',
					'konten' => 'kelas/form',
					'url_form'	=> 'kelas/edit',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nama_kelas' => $post['nama_kelas'],
					'wali_kelas' => $post['wali_kelas'],
				);

				if ($this->global->put_data('tb_kelas', $data, array('id_kelas' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('kelas');
			}
		} else {
			$data = array(
				'title' => 'Edit Kelas',
				'konten' => 'kelas/form',
				'url_form'	=> 'kelas/edit',
				'data'	=> $kelas
			);

			$this->load->view('template/index', $data);
		}
	}
}