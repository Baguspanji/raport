<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin', 'guru');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Kelas',
			'konten' => 'kelas/index',
			'url_tabel'	=> 'kelas/get_kelas',
		);

		$this->load->view('template/index', $data);
	}

	public function get_kelas()
	{
		$list = $this->kelas->get_data(false, null);
		$data = array();
		$role = $this->session->userdata('role');

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="' . base_url() . 'kelas/status/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) $status = '<a href="' . base_url() . 'kelas/status/' . $field->id_kelas . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';

			$add = "";
			$detail = "";
			$edit_detail = "";
			$edit = "";

			$kelas_detail = $this->global->get_byid('tb_kelas_detail', array('kelas_id' => $field->id_kelas));
			if ($kelas_detail == null) {
				if ($role == 'admin') $add = '<a href="' . base_url() . 'kelas/add_detail/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Siswa</a>';
			} else {
				$detail = '<a href="' . base_url() . 'kelas/detail/' . $field->id_kelas . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
				if ($role == 'admin') $edit_detail = '<a href="' . base_url() . 'kelas/edit_detail/' . $field->id_kelas . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit Detail</a>';
			}

			if ($role == 'admin') $edit = '<a href="#" data-toggle="modal" data-target="#kelasEditModal" 
			data-id="' . $field->id_kelas . '" data-kelas="' . $field->nama_kelas . '" data-wali="' . ($field->gelar_dpn != null ? $field->gelar_dpn . ' ' : '') . $field->nama . ($field->gelar_blkg != null ? ', ' . $field->gelar_blkg : '') . '" 
			data-wali_id="' . $field->wali_kelas . '" data-tahun="' . $field->tahun_ajaran . '" data-tahun_id="' . $field->id_tahun . '" 
			class="btn btn-warning btn-sm edit-modal"><i class="fas fa-edit"></i> Edit Kelas</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = ($field->gelar_dpn != null ? $field->gelar_dpn . ' ' : '') . $field->nama . ($field->gelar_blkg != null ? ', ' . $field->gelar_blkg : '');
			$row[] = $field->tahun_ajaran;
			$row[] = $status;
			$row[] = $detail . ' ' . $edit . ' ' . $add . ' ' . $edit_detail;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_data()
	{
		$list = $this->global->get_data('tb_guru', false, null);

		foreach ($list as $field) {
			$output[] = [
				'value' => ($field->gelar_dpn != null ? $field->gelar_dpn . ' ' : '') . $field->nama . ($field->gelar_blkg != null ? ', ' . $field->gelar_blkg : ''),
				'data'  => $field->id_guru,
				'nip'  => $field->nip,
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}
	public function add_tahun()
	{
		$list = $this->global->get_data('tb_tahun', false, null);

		foreach ($list as $field) {
			$output[] = [
				'value' => $field->tahun_ajaran,
				'data'  => $field->id_tahun
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
	}

	public function status()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_kelas', $data, array('id_kelas' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('kelas');
	}

	public function add()
	{
		$post = $this->input->post();
		$data = array(
			'nama_kelas' => $post['nama_kelas'],
			'wali_kelas' => $post['wali_kelas'],
			'tahun_ajaran' => $post['tahun_ajaran'],
		);

		if ($this->global->post_data('tb_kelas', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('kelas');
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $post['id_kelas_edit'];

		$data = array(
			'nama_kelas' => $post['nama_kelas_edit'],
			'wali_kelas' => $post['wali_kelas_edit'],
			'tahun_ajaran' => $post['tahun_ajaran_edit'],
		);

		if ($this->global->put_data('tb_kelas', $data, array('id_kelas' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('kelas');
	}

	public function add_detail()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id == 'add' ? $this->session->userdata('id_kelas') : $id));

		if ($get != null) {

			$random = rand(10, 1000);
			$cart = array(
				'id'      => $random,
				'qty'     => 1,
				'price'   => 1,
				'name'    => 'siswa',
				'nis'	  => $get,
			);

			$this->cart->insert($cart);

			$data = array(
				'title' => 'Detail ' . $kelas['nama_kelas'],
				'konten' => 'kelas/add_detail',
				'url_tabel'	=> 'kelas/get_siswa',
				'url_tabel_2'	=> 'kelas/get_cart',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Detail ' . $kelas['nama_kelas'],
				'konten' => 'kelas/add_detail',
				'url_tabel'	=> 'kelas/get_siswa',
				'url_tabel_2'	=> 'kelas/get_cart',
			);

			$this->cart->destroy();

			$this->session->unset_userdata('id_kelas');
			$this->session->set_userdata('id_kelas', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function rm_cart()
	{
		$rowid = $this->uri->segment(3);
		$edit = $this->uri->segment(4);

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $this->session->userdata('id_kelas')));

		$this->cart->remove($rowid);

		$data = array(
			'title' => 'Detail ' . $kelas['nama_kelas'],
			'konten' => 'kelas/add_detail',
			'url_tabel'	=> 'kelas/get_siswa',
			'url_tabel_2'	=> 'kelas/get_cart',
		);

		if ($edit != null) {
			$data = array(
				'title' => 'Edit Detail ' . $kelas['nama_kelas'],
				'konten' => 'kelas/add_detail',
				'url_tabel'	=> 'kelas/get_siswa/1',
				'url_tabel_2'	=> 'kelas/get_cart/1',
			);
		}

		$this->load->view('template/index', $data);
	}

	public function get_siswa()
	{
		$edit = $this->uri->segment(3);
		$siswa = $this->kelas->get_siswa_detail(true);

		$list = $this->global->get_data('tb_siswa', true, null);
		if ($siswa != null) {
			$PecahStr = array();
			foreach ($siswa as $key) {
				$PecahStr[] = $key->siswa;
			}

			$list = $this->global->get_data_where_not('tb_siswa', 'nis', $PecahStr);
		}

		$data = array();
		$no = 0;
		foreach ($list as $field) {

			$add = '<a href="' . base_url() . 'kelas/add_detail/add/' . $field->nis . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';
			if ($edit != null) $add = '<a href="' . base_url() . 'kelas/edit_detail/add/' . $field->nis . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nis;
			$row[] = $field->nama;
			$row[] = $add;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function get_cart()
	{
		$edit = $this->uri->segment(3);
		$list = $this->cart->contents();
		$data = array();

		$no = 0;
		foreach ($list as $cart) {

			$hapus = '<a href="' . base_url() . 'kelas/rm_cart/' . $cart['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
			if ($edit != null) $hapus = '<a href="' . base_url() . 'kelas/rm_cart/' . $cart['rowid'] . '/1" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

			$field = $this->global->get_byid('tb_siswa', array('nis' => $cart['nis']));

			$no++;
			$row = array();
			$row[] = $hapus;
			$row[] = $no;
			$row[] = $field['nis'];
			$row[] = $field['nama'];
			$row[] = $field['alamat'];
			$row[] = $field['tempat_lahir'] . ', ' . tanggal($field['tanggal_lahir']);

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_cart()
	{
		$list = $this->cart->contents();

		foreach ($list as $field) {
			$arr = array(
				'kelas_id' => $this->session->userdata('id_kelas'),
				'siswa' => $field['nis']
			);
			$data[] = $arr;
		}

		if ($this->global->insert_batch('tb_kelas_detail', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_kelas');

		$this->cart->destroy();
		redirect('kelas');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));

		$data = array(
			'title' => 'Detail ' . $kelas['nama_kelas'],
			'konten' => 'siswa/index',
			'url_tabel'	=> 'kelas/get_detail_kelas/' . $id
		);

		$this->load->view('template/index', $data);
	}

	public function get_detail_kelas()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->kelas->get_id(array('kelas_id' => $id));

		$role = $this->session->userdata('role');

		$data = array();

		$no = 0;
		foreach ($kelas as $field) {

			$list_status = $field['status'] ?? '';
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($list_status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$id_data = $field['id_siswa'] ?? '';
			$detail = '<a href="' . base_url() . 'siswa/detail/' . $id_data . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>';

			$edit = '';
			if ($role == 'admin') $edit = '<a href="' . base_url() . 'siswa/edit/' . $id_data . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$tgl =  $field['tanggal_lahir'] ?? '';
			$tempat = $field['tempat_lahir'] ?? '';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img src="' . base_url() . 'assets/images/siswa/' . $field['image'] . '" class="img-thumbnail" width="200px">';
			$row[] = $field['nis'] ?? '';
			$row[] = $field['nisn'] ?? '';
			$row[] = $field['nama'] ?? '';
			$row[] = $field['alamat'] ?? '';
			$row[] = $tempat . ', ' . tanggal($tgl);
			$row[] = $status;
			$row[] = $detail . ' ' . $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function edit_detail()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id == 'add' ? $this->session->userdata('id_kelas') : $id));

		if ($get != null) {

			$random = rand(10, 1000);
			$cart = array(
				'id'      => $random,
				'qty'     => 1,
				'price'   => 1,
				'name'    => 'siswa',
				'nis'	  => $get,
			);

			$this->cart->insert($cart);

			$data = array(
				'title' => 'Edit Detail ' . $kelas['nama_kelas'],
				'konten' => 'kelas/add_detail',
				'url_tabel'	=> 'kelas/get_siswa/1',
				'url_tabel_2'	=> 'kelas/get_cart/1',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Edit Detail ' . $kelas['nama_kelas'],
				'konten' => 'kelas/add_detail',
				'url_tabel'	=> 'kelas/get_siswa/1',
				'url_tabel_2'	=> 'kelas/get_cart/1',
			);

			$this->cart->destroy();

			$edit_kelas = $this->global->get_id('tb_kelas_detail', array('kelas_id' => $id));

			foreach ($edit_kelas as $row) {
				$random = rand(10, 1000);
				$cart = array(
					'id'      => $random,
					'qty'     => 1,
					'price'   => 1,
					'name'    => 'siswa',
					'nis'	  => $row['siswa'],
				);

				$this->cart->insert($cart);
			}

			$this->session->unset_userdata('id_kelas');
			$this->session->set_userdata('id_kelas', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function edit_cart()
	{
		$list = $this->cart->contents();
		$siswa = '';

		$id = $this->session->userdata('id_kelas');

		foreach ($list as $field) {
			$siswa = array(
				'siswa' => $field['nis'],
				'kelas_id' => $id
			);
			$data[] = $siswa;
		}

		$this->global->del_data('tb_kelas_detail', array('kelas_id' => $id));

		// echo json_encode($data);
		if ($list != null) {
			if ($this->global->insert_batch('tb_kelas_detail', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Detail kelas dihapus!", "warning", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_kelas');

		$this->cart->destroy();
		redirect('kelas');
	}
}
