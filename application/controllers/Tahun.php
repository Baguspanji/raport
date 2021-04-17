<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
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
			'title' => 'Daftar Tahun Ajaran',
			'konten' => 'tahun/index',
			'url_tabel'	=> 'tahun/get_tahun',
		);

		$this->load->view('template/index', $data);
	}

	public function get_tahun()
	{
		$list = $this->global->get_data('tb_tahun', false, null, $this->session->userdata('sekolah'));
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$edit = '<a href="#" data-toggle="modal" data-target="#tahunEditModal" 
				data-id="' . $field->id_tahun . '" data-tahun="' . $field->tahun_ajaran . '" 
				data-ganjildr="' . $field->ganjil_dari . '" data-ganjilsmp="' . $field->ganjil_sampai . '" 
				data-genapdr="' . $field->genap_dari . '" data-genapsmp="' . $field->genap_sampai . '" 
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit Tahun</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->tahun_ajaran;
			$row[] = tanggal($field->ganjil_dari) . ' - ' . tanggal($field->ganjil_sampai);
			$row[] = tanggal($field->genap_dari) . ' - ' . tanggal($field->genap_sampai);
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
			'ganjil_dari' => $post['ganjil_dari'],
			'ganjil_sampai' => $post['ganjil_sampai'],
			'genap_dari' => $post['genap_dari'],
			'genap_sampai' => $post['genap_sampai'],
			'sekolah' => $this->session->userdata('sekolah'),
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
		$id = $post['id_tahun_edit'];


		$data = array(
			'tahun_ajaran' => $post['tahun_ajaran_edit'],
			'ganjil_dari' => $post['ganjil_dari_edit'],
			'ganjil_sampai' => $post['ganjil_sampai_edit'],
			'genap_dari' => $post['genap_dari_edit'],
			'genap_sampai' => $post['genap_sampai_edit'],
		);

		if ($this->global->put_data('tb_tahun', $data, array('id_tahun' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('tahun');
	}
}
