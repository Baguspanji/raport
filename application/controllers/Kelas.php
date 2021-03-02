<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
			'title' => 'Daftar Kelas',
			'konten' => 'kelas/index',
			'url_tabel'	=> 'kelas/get_kelas',
		);

		$this->load->view('template/index', $data);
	}

	public function get_kelas()
	{
		$list = $this->global->get_data('tb_kelas');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) $status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';


			$semester = 'Genap';
			if ($field->semester == 1) $semester = 'Ganjil';


			$add = '<a href="' . base_url() . 'kelas/add_detail/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Siswa</a>';
			if ($this->global->get_byid('tb_detail_kelas', array('kelas_id' => $field->id_kelas)) != null) $add = "";

			$detail = '<a href="' . base_url() . 'kelas/detail/' . $field->id_kelas . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field->wali_kelas))['nama'];
			$row[] = $semester;
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];
			$row[] = $status;
			$row[] = $detail . ' ' . $edit . ' ' . $add;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_data()
	{
		$list = $this->global->get_data('tb_guru');

		foreach ($list as $field) {
			$output['suggestions'][] = [
				'value' => $field->nama,
				'data'  => $field->id_guru
			];
		}

		if (!empty($output)) {
			echo json_encode($output);
		}
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
			'nama_kelas' => $post['nama_kelas'],
			'wali_kelas' => $post['wali_kelas'],
			'semester' => $post['semester'],
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
				'id_siswa'	  => $get,
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

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $this->session->userdata('id_kelas')));

		$this->cart->remove($rowid);

		$data = array(
			'title' => 'Detail ' . $kelas['nama_kelas'],
			'konten' => 'kelas/add_detail',
			'url_tabel'	=> 'kelas/get_siswa',
			'url_tabel_2'	=> 'kelas/get_cart',
		);

		$this->load->view('template/index', $data);
	}

	public function get_siswa()
	{
		$list = $this->global->get_data('tb_siswa', true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$add = '<a href="' . base_url() . 'kelas/add_detail/add/' . $field->id_siswa . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';

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
		$list = $this->cart->contents();
		$data = array();

		$no = 0;
		foreach ($list as $cart) {

			$hapus = '<a href="' . base_url() . 'kelas/rm_cart/' . $cart['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

			$field = $this->global->get_byid('tb_siswa', array('id_siswa' => $cart['id_siswa']));

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
		$siswa = '';

		foreach ($list as $field) {

			$siswa = $siswa . $field['id_siswa'] . ',';
		}

		$data = array(
			'kelas_id' => $this->session->userdata('id_kelas'),
			'siswa' => substr(trim($siswa), 0, -1)
		);

		if ($this->global->post_data('tb_detail_kelas', $data) != null) {
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

		$data = array(
			'title' => 'Detail Kelas',
			'konten' => 'siswa/index',
			'url_tabel'	=> 'kelas/get_detail_kelas/' . $id
		);

		$this->load->view('template/index', $data);
	}

	public function get_detail_kelas()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_detail_kelas', array('kelas_id' => $id));

		$list = $this->global->get_data_where('tb_siswa', 'id_siswa', array($kelas['siswa']));
		$data = array();

		$no = 0;
		$PecahStr = explode(",", $kelas['siswa']);

		for ($i = 0; $i < count($PecahStr); $i++) {
			$field = $this->global->get_byid('tb_siswa', array('id_siswa' => $PecahStr[$i]));


			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field['status'] == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$detail = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'siswa/edit/' . $field['id_siswa'] . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field['nis'];
			$row[] = $field['nama'];
			$row[] = $field['alamat'];
			$row[] = $field['tempat_lahir'] . ', ' . tanggal($field['tanggal_lahir']);
			$row[] = $status;
			$row[] = $detail . ' ' . $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}
}
