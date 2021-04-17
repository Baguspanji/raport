<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Mata Pelajaran',
			'konten' => 'pelajaran/index',
			'url_tabel'	=> 'pelajaran/get_pelajaran',
		);

		$this->load->view('template/index', $data);
	}

	public function get_pelajaran()
	{
		$list = $this->global->get_data('tb_pelajaran', false, null, $this->session->userdata('sekolah'));
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$pelajaran_detail = $this->global->get_id('tb_pelajaran_detail', array('pelajaran_id' => $field->id_pelajaran));

			$edit = '<a href="#" data-toggle="modal" data-target="#pelajaranEditModal" 
				data-id="' . $field->id_pelajaran . '" data-pelajaran="' . $field->nama_pelajaran . '" 
				data-nilai="' . $field->nilai_minim . '"
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit Pelajaran</a>';

			if ($pelajaran_detail != null) {
				$add = '';
				$edit_kelas = '<a href="' . base_url() . 'pelajaran/edit_kelas/' . $field->id_pelajaran . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit Kelas</a>';
			} else {
				$add = '<a href="' . base_url() . 'pelajaran/add_kelas/' . $field->id_pelajaran . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Kelas</a>';
				$edit_kelas = '';
			}

			$kelas = '';
			if ($pelajaran_detail != null) {
				$PecahStr = array();

				foreach ($pelajaran_detail as $key) {
					$PecahStr[] = $key['kelas'];
				}

				$detail = $this->global->get_data_where('tb_kelas', 'id_kelas', $PecahStr);

				foreach ($detail as $row) {
					$kelas = $kelas . $row->nama_kelas . ',';
				}

				$kelas = substr(trim(str_replace(",", ", ", $kelas)), 0, -1);
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_pelajaran;
			$row[] = $kelas;
			$row[] = $field->nilai_minim;
			$row[] = $edit . ' ' . $add . ' ' . $edit_kelas;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = array(
			'nama_pelajaran' => $post['nama_pelajaran'],
			'nilai_minim' => $post['nilai_minim'],
			'sekolah' => $this->session->userdata('sekolah'),
		);

		if ($this->global->post_data('tb_pelajaran', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pelajaran');
	}

	public function add_data()
	{
		$list = $this->global->get_data('tb_kelas');

		foreach ($list as $field) {
			$output['suggestions'][] = [
				'value' => $field->nama_kelas,
				'data'  => $field->id_kelas
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $post['id_pelajaran_edit'];

		$data = array(
			'nama_pelajaran' => $post['nama_pelajaran_edit'],
			'nilai_minim' => $post['nilai_minim_edit'],
		);

		if ($this->global->put_data('tb_pelajaran', $data, array('id_pelajaran' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('pelajaran');
	}

	public function add_kelas()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$pelajaran = $this->global->get_byid('tb_pelajaran', array('id_pelajaran' => $id == 'add' ? $this->session->userdata('id_pelajaran') : $id));

		if ($get != null) {

			$random = rand(10, 1000);
			$cart = array(
				'id'      => $random,
				'qty'     => 1,
				'price'   => 1,
				'name'    => 'siswa',
				'kelas'	  => $get,
			);

			$this->cart->insert($cart);

			$data = array(
				'title' => 'Kelas ' . $pelajaran['nama_pelajaran'],
				'konten' => 'pelajaran/add_kelas',
				'url_tabel'	=> 'pelajaran/get_kelas',
				'url_tabel_2'	=> 'pelajaran/get_cart',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Kelas ' . $pelajaran['nama_pelajaran'],
				'konten' => 'pelajaran/add_kelas',
				'url_tabel'	=> 'pelajaran/get_kelas',
				'url_tabel_2'	=> 'pelajaran/get_cart',
			);

			$this->cart->destroy();

			$this->session->unset_userdata('id_pelajaran');
			$this->session->set_userdata('id_pelajaran', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function get_kelas()
	{
		$list = $this->global->get_data('tb_kelas', true);
		$edit = $this->uri->segment(3);

		$data = array();
		$no = 0;
		foreach ($list as $field) {
			$add = '<a href="' . base_url() . 'pelajaran/add_kelas/add/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';
			if ($edit != null) $add = '<a href="' . base_url() . 'pelajaran/edit_kelas/add/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field->wali_kelas))['nama'];
			$row[] = $add;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function get_cart()
	{
		$list = $this->cart->contents();
		$data = array();
		$edit = $this->uri->segment(3);

		$no = 0;
		foreach ($list as $cart) {

			$hapus = '<a href="' . base_url() . 'pelajaran/rm_cart/' . $cart['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
			if ($edit != null) $hapus = '<a href="' . base_url() . 'pelajaran/rm_cart/' . $cart['rowid'] . '/1" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

			$field = $this->global->get_byid('tb_kelas', array('id_kelas' => $cart['kelas']));

			$no++;
			$row = array();
			$row[] = $hapus;
			$row[] = $no;
			$row[] = $field['nama_kelas'];
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field['wali_kelas']))['nama'];
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field['tahun_ajaran']))['tahun_ajaran'];

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function rm_cart()
	{
		$rowid = $this->uri->segment(3);
		$edit = $this->uri->segment(4);

		$pelajaran = $this->global->get_byid('tb_pelajaran', array('id_pelajaran' => $this->session->userdata('id_pelajaran')));

		$this->cart->remove($rowid);

		$data = array(
			'title' => 'Kelas ' . $pelajaran['nama_pelajaran'],
			'konten' => 'pelajaran/add_kelas',
			'url_tabel'	=> 'pelajaran/get_kelas',
			'url_tabel_2'	=> 'pelajaran/get_cart',
		);

		if ($edit != null) {
			$data = array(
				'title' => 'Edit Kelas ' . $pelajaran['nama_pelajaran'],
				'konten' => 'pelajaran/add_kelas',
				'url_tabel'	=> 'pelajaran/get_kelas/1',
				'url_tabel_2'	=> 'pelajaran/get_cart/1',
			);
		}

		$this->load->view('template/index', $data);
	}

	public function add_cart()
	{
		$id = $this->session->userdata('id_pelajaran');
		$list = $this->cart->contents();

		foreach ($list as $field) {
			$kelas = array(
				'kelas' => $field['kelas'],
				'pelajaran_id' => $id
			);
			$data[] = $kelas;
		}

		if ($this->global->insert_batch('tb_pelajaran_detail', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_pelajaran');

		$this->cart->destroy();
		redirect('pelajaran');
	}

	public function edit_kelas()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$pelajaran = $this->global->get_byid('tb_pelajaran', array('id_pelajaran' => $id == 'add' ? $this->session->userdata('id_pelajaran') : $id));

		if ($get != null) {

			$random = rand(10, 1000);
			$cart = array(
				'id'      => $random,
				'qty'     => 1,
				'price'   => 1,
				'name'    => 'siswa',
				'kelas'	  => $get,
			);

			$this->cart->insert($cart);

			$data = array(
				'title' => 'Edit Kelas ' . $pelajaran['nama_pelajaran'],
				'konten' => 'pelajaran/add_kelas',
				'url_tabel'	=> 'pelajaran/get_kelas/1',
				'url_tabel_2'	=> 'pelajaran/get_cart/1',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Edit Kelas ' . $pelajaran['nama_pelajaran'],
				'konten' => 'pelajaran/add_kelas',
				'url_tabel'	=> 'pelajaran/get_kelas/1',
				'url_tabel_2'	=> 'pelajaran/get_cart/1',
			);

			$this->cart->destroy();

			$edit_pelajaran = $this->global->get_id('tb_pelajaran_detail', array('pelajaran_id' => $id));

			foreach ($edit_pelajaran as $row) {
				$random = rand(10, 1000);
				$cart = array(
					'id'      => $random,
					'qty'     => 1,
					'price'   => 1,
					'name'    => 'kelas',
					'kelas'	  => $row['kelas'],
				);

				$this->cart->insert($cart);
			}

			$this->session->unset_userdata('id_pelajaran');
			$this->session->set_userdata('id_pelajaran', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function edit_cart()
	{
		$list = $this->cart->contents();
		$kelas = '';

		$id = $this->session->userdata('id_pelajaran');

		foreach ($list as $field) {
			$kelas = array(
				'kelas' => $field['kelas'],
				'pelajaran_id' => $id
			);
			$data[] = $kelas;
		}

		$this->global->del_data('tb_pelajaran_detail', array('pelajaran_id' => $id));

		if ($list != null) {
			if ($this->global->insert_batch('tb_pelajaran_detail', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Detail pelajaran dihapus!", "warning", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_pelajaran');

		$this->cart->destroy();
		redirect('pelajaran');
		// echo json_encode($list);
	}
}
