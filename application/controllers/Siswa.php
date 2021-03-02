<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Siswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->library('cart');
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

			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-dager"><i class="fa fa-times"></i> Non-Aktif</a>';
			}
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';

			$detail = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'siswa/edit/' . $field->id_siswa . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nis;
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

	public function import()
	{
		if (isset($_FILES['upload_file'])) {
			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
				$arr_file = explode('.', $_FILES['upload_file']['name']);
				$extension = end($arr_file);
				if ('csv' == $extension) {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();

				$cart = array();
				for ($i = 0; $i < count($sheetData); $i++) {
					$random = rand(10, 1000);
					$row = array(
						'id'      => $random,
						'qty'     => 1,
						'price'   => 1,
						'name'    => 'siswa',
						'nis'	  => $sheetData[$i][0],
						'nama' 	  => $sheetData[$i][1],
						'jk'	  => $sheetData[$i][2],
						'alamat'  => $sheetData[$i][3],
						'kelas'	  => $sheetData[$i][4],
						'tgl'	  => $sheetData[$i][5],
					);

					$cart[] = $row;
				}

				$this->cart->destroy();
				$this->cart->insert($cart);

				$data = array(
					'title' => 'Import Siswa',
					'konten' => 'siswa/import',
					'url_tabel'	=> 'siswa/get_cart'
				);

				$this->load->view('template/index', $data);
			}
		} else {
			$data = array(
				'title' => 'Import Siswa',
				'konten' => 'siswa/import',
				'url_tabel'	=> 'siswa/get_cart'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function get_cart()
	{
		$list = $this->cart->contents();
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$hapus = '<a href="' . base_url() . 'siswa/rm_cart/' . $field['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

			$no++;
			$row = array();
			$row[] = $hapus;
			$row[] = $no;
			$row[] = $field['nis'];
			$row[] = $field['nama'];
			$row[] = $field['alamat'];
			$row[] = $field['tgl'];

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_cart()
	{
		$list = $this->cart->contents();
		$data = array();

		foreach ($list as $field) {

			$tgl = explode(", ", $field['tgl']);
			$row = array(
				'nis' => $field['nis'],
				'nama' => $field['nama'],
				'alamat' => $field['alamat'],
				'tempat_lahir' => $tgl[0],
				'tanggal_lahir' =>  date('Y-m-d', strtotime($tgl[1])),
			);

			$data[] = $row;
		}

		if ($this->global->post_data_batch('tb_siswa', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}

		$this->cart->destroy();
		redirect('siswa');
	}

	public function rm_cart()
	{
		$rowid = $this->uri->segment(3);
		$this->cart->remove($rowid);
		redirect('siswa/import');
	}
}
