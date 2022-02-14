<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->library('cart');
	}

	public function indexPSG()
	{
		$data = array(
			'title' => 'Daftar Penilaian Sejawat/Guru',
			'konten' => 'pengawas/indexPSG',
			'url_tabel'	=> 'pengawas/get_PSG',
		);

		$this->load->view('template/index', $data);
	}

	public function get_PSG()
	{
		$list = $this->global->get_data_where('tb_laporan_penilaian', 'tipe_laporan', 1);
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$edit = '<a href="#" data-toggle="modal" data-target="#editPengawasModal" 
				data-id="' . $field->id_laporan_penilaian . '" data-title="' . $field->title . '" 
				data-subject="' . $field->subject . '" data-file="' . $field->file . '" 
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit</a>';

			$status = '<a href="' . base_url() . 'pengawas/statusPSG/' . $field->id_laporan_penilaian . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'pengawas/statusPSG/' . $field->id_laporan_penilaian . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$file = '<a href="' . base_url() . 'assets/file/laporan/' . $field->file . '" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i></a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->title;
			$row[] = $field->subject;
			$row[] = tanggal($field->create_date);
			$row[] = $file;
			$row[] = $status;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function addPSG()
	{
		allowed('admin');
		$post = $this->input->post();

		$images['upload_path']          = './assets/file/laporan/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx|doc|xlsx|xls';
		$images['max_size']             = 2000;

		$this->load->library('upload', $images);
		$this->upload->do_upload('file');

		$data = array(
			'title' => $post['title'],
			'subject' => $post['subject'],
			'tipe_laporan' => 1,
			'file' => $this->upload->data() != null ? $this->upload->data()['file_name'] : '',
		);

		if ($this->global->post_data('tb_laporan_penilaian', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSG');
	}

	public function editPSG()
	{
		allowed('admin');
		$post = $this->input->post();

		$images['upload_path']          = './assets/file/laporan/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx|doc|xlsx|xls';
		$images['max_size']             = 2000;

		$this->load->library('upload', $images);
		$this->upload->do_upload('file');

		if ($this->upload->data() == null) {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
			);
		} else {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
				'file' => $this->upload->data()['file_name'],
			);
		}

		if ($this->global->put_data('tb_laporan_penilaian', $data, ['id_laporan_penilaian' => $post['id']]) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSG');
	}

	public function statusPSG()
	{
		allowed('admin');
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_laporan_penilaian', array('id_laporan_penilaian' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_laporan_penilaian', $data, array('id_laporan_penilaian' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSG');
	}

	public function indexPSiswa()
	{
		$data = array(
			'title' => 'Daftar Penilaian Siswa',
			'konten' => 'pengawas/indexPSiswa',
			'url_tabel'	=> 'pengawas/get_PSiswa',
		);

		$this->load->view('template/index', $data);
	}

	public function get_PSiswa()
	{
		$list = $this->global->get_data_where('tb_laporan_penilaian', 'tipe_laporan', 2);
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$edit = '<a href="#" data-toggle="modal" data-target="#editPengawasModal" 
				data-id="' . $field->id_laporan_penilaian . '" data-title="' . $field->title . '" 
				data-subject="' . $field->subject . '" data-file="' . $field->file . '" 
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit</a>';

			$status = '<a href="' . base_url() . 'pengawas/statusPSiswa/' . $field->id_laporan_penilaian . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'pengawas/statusPSiswa/' . $field->id_laporan_penilaian . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$file = '<a href="' . base_url() . 'assets/file/laporan/' . $field->file . '" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i></a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->title;
			$row[] = $field->subject;
			$row[] = tanggal($field->create_date);
			$row[] = $file;
			$row[] = $status;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function addPSiswa()
	{
		allowed('admin');
		$post = $this->input->post();

		$images['upload_path']          = './assets/file/laporan/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx|doc|xlsx|xls';
		$images['max_size']             = 2000;

		$this->load->library('upload', $images);
		$this->upload->do_upload('file');

		$data = array(
			'title' => $post['title'],
			'subject' => $post['subject'],
			'tipe_laporan' => 2,
			'file' => $this->upload->data() != null ? $this->upload->data()['file_name'] : '',
		);

		if ($this->global->post_data('tb_laporan_penilaian', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSiswa');
	}

	public function editPSiswa()
	{
		allowed('admin');
		$post = $this->input->post();

		$images['upload_path']          = './assets/file/laporan/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx|doc|xlsx|xls';
		$images['max_size']             = 2000;

		$this->load->library('upload', $images);
		$this->upload->do_upload('file');

		if ($this->upload->data() == null) {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
			);
		} else {
			$data = array(
				'title' => $post['title'],
				'subject' => $post['subject'],
				'file' => $this->upload->data()['file_name'],
			);
		}

		if ($this->global->put_data('tb_laporan_penilaian', $data, ['id_laporan_penilaian' => $post['id']]) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSiswa');
	}

	public function statusPSiswa()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_laporan_penilaian', array('id_laporan_penilaian' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_laporan_penilaian', $data, array('id_laporan_penilaian' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('pengawas/indexPSiswa');
	}
}
