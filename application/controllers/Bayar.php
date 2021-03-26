<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bayar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Bayar_model', 'bayar');
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Pembayaran',
			'konten' => 'bayar/index',
			'url_tabel'	=> 'bayar/get_bayar',
		);

		$this->load->view('template/index', $data);
	}

	public function get_bayar()
	{
		$list = $this->global->get_data('tb_bayar');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$tahun_ajaran = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];

			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			if ($field->kelas != '0') {
				$add = '';
				$edit_kelas = '<a href="' . base_url() . 'bayar/edit_kelas/' . $field->id_bayar . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit Kelas</a>';
			} else {
				$add = '<a href="' . base_url() . 'bayar/add_kelas/' . $field->id_bayar . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Kelas</a>';
				$edit_kelas = '';
			}

			$edit = '<a href="#" data-toggle="modal" data-target="#kelasEditModal" 
				data-id="' . $field->id_bayar . '" data-bayar="' . $field->nama_bayar . '" 
				data-tahun="' . $tahun_ajaran . '" data-tahun_id="' . $field->tahun_ajaran . '" 
				class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit Pembayaran</a>';

			$kelas = '';
			if ($field->kelas != '0') {
				$PecahStr = array();
				$PecahStr = explode(",", $field->kelas);
				$detail = $this->global->get_data_where('tb_kelas', 'id_kelas', $PecahStr);

				foreach ($detail as $row) {
					$kelas = $kelas . $row->nama_kelas . ',';
				}

				$kelas = substr(trim(str_replace(",", ", ", $kelas)), 0, -1);
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_bayar;
			$row[] = $tahun_ajaran;
			$row[] = $kelas;
			$row[] = $status;
			$row[] = $edit . ' ' . $add . ' ' . $edit_kelas;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_tahun()
	{
		$list = $this->global->get_data('tb_tahun');

		foreach ($list as $field) {
			$output['suggestions'][] = [
				'value' => $field->tahun_ajaran,
				'data'  => $field->id_tahun
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}

	public function add()
	{
		$post = $this->input->post();
		$data = array(
			'nama_bayar' => $post['nama_bayar'],
			'tahun_ajaran' => $post['tahun_ajaran'],
		);

		if ($this->global->post_data('tb_bayar', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('bayar');
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $post['id_bayar_edit'];

		$data = array(
			'nama_bayar' => $post['nama_bayar_edit'],
			'tahun_ajaran' => $post['tahun_ajaran_edit'],
		);

		if ($this->global->put_data('tb_bayar', $data, array('id_bayar' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('bayar');
	}

	public function add_kelas()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$bayar = $this->global->get_byid('tb_bayar', array('id_bayar' => $id == 'add' ? $this->session->userdata('id_bayar') : $id));

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
				'title' => 'Kelas ' . $bayar['nama_bayar'],
				'konten' => 'bayar/add_kelas',
				'url_tabel'	=> 'bayar/get_kelas',
				'url_tabel_2'	=> 'bayar/get_cart',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Kelas ' . $bayar['nama_bayar'],
				'konten' => 'bayar/add_kelas',
				'url_tabel'	=> 'bayar/get_kelas',
				'url_tabel_2'	=> 'bayar/get_cart',
			);

			$this->cart->destroy();

			$this->session->unset_userdata('id_bayar');
			$this->session->set_userdata('id_bayar', $id);

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
			$add = '<a href="' . base_url() . 'bayar/add_kelas/add/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';
			if ($edit != null) $add = '<a href="' . base_url() . 'bayar/edit_kelas/add/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';

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

			$hapus = '<a href="' . base_url() . 'bayar/rm_cart/' . $cart['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
			if ($edit != null) $hapus = '<a href="' . base_url() . 'bayar/rm_cart/' . $cart['rowid'] . '/1" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

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

		$bayar = $this->global->get_byid('tb_bayar', array('id_bayar' => $this->session->userdata('id_bayar')));

		$this->cart->remove($rowid);

		$data = array(
			'title' => 'Kelas ' . $bayar['nama_bayar'],
			'konten' => 'bayar/add_kelas',
			'url_tabel'	=> 'bayar/get_kelas',
			'url_tabel_2'	=> 'bayar/get_cart',
		);

		if ($edit != null) {
			$data = array(
				'title' => 'Edit Kelas ' . $bayar['nama_bayar'],
				'konten' => 'bayar/add_kelas',
				'url_tabel'	=> 'bayar/get_kelas/1',
				'url_tabel_2'	=> 'bayar/get_cart/1',
			);
		}

		$this->load->view('template/index', $data);
	}

	public function add_cart()
	{
		$id = $this->session->userdata('id_bayar');
		$list = $this->cart->contents();
		$kelas = '';

		foreach ($list as $field) {

			$kelas = $kelas . $field['kelas'] . ',';
		}

		$data = array(
			'kelas' => substr(trim($kelas), 0, -1)
		);

		if ($this->global->put_data('tb_bayar', $data, array('id_bayar' => $id)) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_bayar');

		$this->cart->destroy();
		redirect('bayar');
	}

	public function edit_kelas()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$bayar = $this->global->get_byid('tb_bayar', array('id_bayar' => $id == 'add' ? $this->session->userdata('id_bayar') : $id));

		if ($get != null) {

			$random = rand(10, 1000);
			$cart = array(
				'id'      => $random,
				'qty'     => 1,
				'price'   => 1,
				'name'    => 'kelas',
				'kelas'	  => $get,
			);

			$this->cart->insert($cart);

			$data = array(
				'title' => 'Edit Kelas ' . $bayar['nama_bayar'],
				'konten' => 'bayar/add_kelas',
				'url_tabel'	=> 'bayar/get_kelas/1',
				'url_tabel_2'	=> 'bayar/get_cart/1',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Edit Kelas ' . $bayar['nama_bayar'],
				'konten' => 'bayar/add_kelas',
				'url_tabel'	=> 'bayar/get_kelas/1',
				'url_tabel_2'	=> 'bayar/get_cart/1',
			);

			$this->cart->destroy();

			$edit_bayar = $this->global->get_byid('tb_bayar', array('id_bayar' => $id));

			$PecahStr = array();
			$PecahStr = explode(",", $edit_bayar['kelas']);

			for ($i = 0; $i < count($PecahStr); $i++) {
				$random = rand(10, 1000);
				$cart = array(
					'id'      => $random,
					'qty'     => 1,
					'price'   => 1,
					'name'    => 'kelas',
					'kelas'	  => $PecahStr[$i],
				);

				$this->cart->insert($cart);
			}

			$this->session->unset_userdata('id_bayar');
			$this->session->set_userdata('id_bayar', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function pembayaran()
	{
		$data = array(
			'title' => 'Daftar Pembayaran',
			'konten' => 'bayar/pembayaran',
			'url_tabel'	=> 'bayar/get_pembayaran',
			'kelas'		=> $this->global->get_data('tb_kelas', true)
		);

		$this->load->view('template/index', $data);
	}

	public function get_pembayaran()
	{
		$list = $this->global->get_data('tb_kelas', true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$kelas = $this->global->get_byid('tb_kelas_detail', array('kelas_id' => $field->id_kelas));
			$pembayaran = '';
			if ($kelas != null) $pembayaran = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelasModal' . $field->id_kelas . '"><i class="fa fa-download"></i> Pembayaran Siswa</button>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field->wali_kelas))['nama'];
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];
			$row[] = $pembayaran;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function siswa()
	{
		$id = $this->uri->segment(3) ?? $this->session->userdata('id_kelas');
		$id_bayar = $this->uri->segment(4) ?? $this->session->userdata('id_bayar');

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));
		$bayar = $this->global->get_byid('tb_bayar', array('id_bayar' => $id_bayar));

		$data = array(
			'title' => 'Pembayaran ' . $bayar['nama_bayar'] . ' ' . $kelas['nama_kelas'],
			'konten' => 'siswa/index',
			'url_tabel'	=> 'bayar/get_siswa/' . $id
		);

		$this->session->unset_userdata('id_kelas');
		$this->session->unset_userdata('id_bayar');
		$this->session->set_userdata('id_kelas', $id);
		$this->session->set_userdata('id_bayar', $id_bayar);

		$this->load->view('template/index', $data);
	}


	public function get_siswa()
	{
		$id_kelas = $this->session->userdata('id_kelas');
		$id_bayar = $this->session->userdata('id_bayar');
		$kelas = $this->global->get_byid('tb_kelas_detail', array('kelas_id' => $id_kelas));

		$PecahStr = array();
		$PecahStr = explode(",", $kelas['siswa']);

		$list = $this->global->get_data_where('tb_siswa', 'nis', $PecahStr, true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$bayar = $this->bayar->get_bynis($id_bayar, $field->nis);

			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Lunas</a>';
			if ($bayar == null) $status = '';
			$pembayaran = '<a href="' . base_url() . 'bayar/add_bayar/' . $field->nis . '" class="btn btn-sm btn-info"><i class="fa fa-check"></i> Bayar</a>';
			if ($bayar != null) $pembayaran = '';


			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img src="' . base_url() . 'assets/images/siswa/' . $field->image . '" class="img-thumbnail" width="200px">';
			$row[] = $field->nis;
			$row[] = $field->nisn;
			$row[] = $field->nama;
			$row[] = $field->alamat;
			$row[] = $field->tempat_lahir . ', ' . tanggal($field->tanggal_lahir);
			$row[] = $status;
			$row[] = $pembayaran;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_bayar()
	{
		$data = array(
			'bayar_id' => $this->session->userdata('id_bayar'),
			'nis' => $this->uri->segment(3),
			'tanggal' => date('Y-m-d'),
		);

		if ($this->global->post_data('tb_pembayaran', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('bayar/siswa');
	}
}
