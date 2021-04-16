<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Absensi_model', 'absensi');
		$this->load->model('Siswa_model', 'siswa');
		$this->load->model('Bayar_model', 'bayar');
		$this->load->model('Nilai_model', 'nilai');
		$this->load->library('cart');
	}

	public function index()
	{
		allowed('admin');
		$data = array(
			'title' => 'Daftar Sekolah',
			'konten' => 'sekolah/index',
			'url_tabel'	=> 'sekolah/get_sekolah'
		);

		$this->load->view('template/index', $data);
	}

	public function get_sekolah()
	{
		allowed('admin');
		$list = $this->global->get_data('tb_sekolah');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$edit = '<a href="' . base_url() . 'sekolah/edit/' . $field->id_sekolah . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';
			$detail = '<a href="' . base_url() . 'sekolah/detail/' . $field->id_sekolah . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_sekolah;
			$row[] = $field->alamat;
			$row[] = $status;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add()
	{
		allowed('admin');
		$post = $this->input->post();
		if ($post) {

			$data = array(
				'nama_sekolah' => $post['nama_sekolah'],
				'alamat' => $post['alamat'],
			);

			if ($this->global->post_data('tb_sekolah', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('sekolah');
		} else {
			$data = array(
				'title' => 'Tambah Sekolah',
				'konten' => 'sekolah/form',
				'url_form'	=> 'sekolah/add'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		allowed('admin');
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_sekolah'];
		$sekolah = $this->global->get_byid('tb_sekolah', array('id_sekolah' => $id));

		if ($post) {

			$data = array(
				'nama_sekolah' => $post['nama_sekolah'],
				'alamat' => $post['alamat'],
			);

			if ($this->global->put_data('tb_sekolah', $data, array('id_sekolah' => $id))) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('sekolah');
		} else {
			$data = array(
				'title' => 'Edit Sekolah',
				'konten' => 'sekolah/form',
				'url_form'	=> 'sekolah/edit',
				'data'	=> $sekolah
			);

			$this->load->view('template/index', $data);
		}
	}
}
