<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin', 'pengawas');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->library('cart');
	}

	private function index($tipe = 1)
	{
		$index = 'indexPSG';

		switch ($tipe) {
			case 1:
				$index = 'indexPSG';
				break;
			case 2:
				$index = 'indexPSiswa';
				break;
			case 3:
				$index = 'indexPOrangTua';
				break;
			case 4:
				$index = 'indexPDudi';
				break;
			case 5:
				$index = 'indexRPS';
				break;
			case 6:
				$index = 'indexPSN';
				break;
			case 7:
				$index = 'indexPE';
				break;
			case 8:
				$index = 'indexKS';
				break;
			case 9:
				$index = 'indexSIM';
				break;
			case 10:
				$index = 'indexPPW';
				break;
			case 11:
				$index = 'indexPPK';
				break;
			case 12:
				$index = 'indexEPPK';
				break;
			case 13:
				$index = 'indexPSupervisi';
				break;
			case 14:
				$index = 'indexSTL';
				break;
			case 15:
				$index = 'indexEHS';
				break;
			case 16:
				$index = 'indexPKB';
				break;
			case 17:
				$index = 'indexKP';
				break;

			default:
				$index = 'indexPSG';
				break;
		}

		return $index;
	}

	public function indexPSG()
	{
		$index =  1;
		$data = array(
			'title' => 'Daftar Penilaian Sejawat/Guru',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}

	public function indexPSiswa()
	{
		$index =  2;
		$data = array(
			'title' => 'Daftar Penilaian Siswa',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPOrangTua()
	{
		$index =  3;
		$data = array(
			'title' => 'Daftar Penilaian Orang Tua',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}

	public function indexPDudi()
	{
		$index =  4;
		$data = array(
			'title' => 'Daftar Penilaian Dudi',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexRPS()
	{
		$index =  5;
		$data = array(
			'title' => 'Daftar Rencana Program Sekolah',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPSN()
	{
		$index =  6;
		$data = array(
			'title' => 'Daftar Pengelolaan Standart Nasional Sekolah',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPE()
	{
		$index =  7;
		$data = array(
			'title' => 'Daftar Pengawasan dan Evaluasi',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexKS()
	{
		$index =  8;
		$data = array(
			'title' => 'Daftar Kepemimpinan Sekolah',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexSIM()
	{
		$index =  9;
		$data = array(
			'title' => 'Daftar Informasi Manajemen Sekolah',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPPW()
	{
		$index =  10;
		$data = array(
			'title' => 'Daftar Perencanaan Program Kewirausahaan',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPPK()
	{
		$index =  11;
		$data = array(
			'title' => 'Daftar Pelaksanaan Program Kewirausahaan',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexEPPK()
	{
		$index =  12;
		$data = array(
			'title' => 'Daftar Evaluasi Pelaksanaan Program Kewirausahaan',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPSupervisi()
	{
		$index =  13;
		$data = array(
			'title' => 'Daftar Program Supervisi',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexSTL()
	{
		$index =  14;
		$data = array(
			'title' => 'Daftar Supervisi dan Tindak Lanjut',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexEHS()
	{
		$index =  15;
		$data = array(
			'title' => 'Daftar Evaluasi Hasil Supervisi',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexPKB()
	{
		$index =  16;
		$data = array(
			'title' => 'Daftar PKB',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}
	
	public function indexKP()
	{
		$index =  17;
		$data = array(
			'title' => 'Daftar Keg. Penunjang',
			'konten' => 'pengawas/index',
			'url_tabel'	=> 'pengawas/get_data/' . $index,
			'index' => $index,
		);

		$this->load->view('template/index', $data);
	}

	public function get_data($tipe = 1)
	{
		$role = $this->session->userdata('role');
		$list = $this->global->get_data_where('tb_laporan_penilaian', 'tipe_laporan', $tipe);
		if ($role == 'pengawas') {
			$list = $this->global->get_data_where('tb_laporan_penilaian', 'tipe_laporan', $tipe, true);
		}
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$edit = '<a href="#" data-toggle="modal" data-target="#editPengawasModal" 
				data-id="' . $field->id_laporan_penilaian . '" data-title="' . $field->title . '" 
				data-subject="' . $field->subject . '" data-file="' . $field->file . '" 
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit</a>';

			$status = '<a href="' . base_url() . 'pengawas/status/' . $field->id_laporan_penilaian . '/' . $tipe . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'pengawas/status/' . $field->id_laporan_penilaian . '/' . $tipe . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$file = '<a href="' . base_url() . 'assets/file/laporan/' . $field->file . '" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i> lihat File</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->title;
			$row[] = $field->subject;
			$row[] = tanggal($field->create_date);
			$row[] = $file;
			if ($role == 'admin') {
				$row[] = $status;
				$row[] = $edit;
			}

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add($tipe = 1)
	{
		$post = $this->input->post();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('file', 'File', 'required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data gagal ditambahkan, cek kembali form", "danger", "fa fa-times") </script>');
			redirect('pengawas/' . $this->index($tipe));
		} else {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
				'tipe_laporan' => $tipe,
				'file' => $post['file'],
			);

			if ($this->global->post_data('tb_laporan_penilaian', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('pengawas/' . $this->index($tipe));
		}
	}

	public function edit($tipe = 1)
	{
		$post = $this->input->post();

		$post = $this->input->post();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('file', 'File', 'required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data gagal ditambahkan, cek kembali form", "danger", "fa fa-times") </script>');
			redirect('pengawas/' . $this->index($tipe));
		} else {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
				'file' => $post['file'],
			);
		}

		if ($this->global->put_data('tb_laporan_penilaian', $data, ['id_laporan_penilaian' => $post['id']]) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/' . $this->index($tipe));
	}

	public function status($id, $tipe = 1)
	{
		$kelas = $this->global->get_byid('tb_laporan_penilaian', array('id_laporan_penilaian' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_laporan_penilaian', $data, array('id_laporan_penilaian' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/' . $this->index($tipe));
	}

	// =================== Upload File =================== //
	public function upload_file()
	{
		$post = $this->input->post();

		$images['upload_path']          = './assets/file/laporan/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx|doc|xlsx|xls';
		$images['max_size']             = 2000;

		$this->load->library('upload', $images);
		$this->upload->do_upload('file');

		echo json_encode([
			'file' => $this->upload->data() != null ? $this->upload->data()['file_name'] : '',
			'error' => $this->upload->display_errors(),
		]);
	}
}
