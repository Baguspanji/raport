<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Admin_model', 'admin');
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Guru',
			'konten' => 'guru/index',
			'url_tabel'	=> 'guru/get_guru'
		);

		$this->load->view('template/index', $data);
	}

	public function get_guru()
	{
		$list = $this->global->get_data('tb_guru', false, null, $this->session->userdata('sekolah'));
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="' . base_url() . 'guru/status/' . $field->id_guru . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'guru/status/' . $field->id_guru . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$detail = '<a href="' . base_url() . 'guru/detail/' . $field->id_guru . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>';
			$edit = '<a href="' . base_url() . 'guru/edit/' . $field->id_guru . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img src="' . base_url() . 'assets/images/guru/' . $field->image . '" class="img-thumbnail" width="200px">';
			$row[] = $field->nip;
			$row[] = $field->nuptk;
			$row[] = ($field->gelar_dpn != null ? $field->gelar_dpn . ' ' : '') . $field->nama . ($field->gelar_blkg != null ? ', ' . $field->gelar_blkg : '');
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
					'field' => 'nip',
					'label' => 'NIP Guru',
					'rules' => 'required|is_unique[tb_guru.nip]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
				array(
					'field' => 'nuptk',
					'label' => 'NUPTK Guru',
					'rules' => 'required|is_unique[tb_guru.nuptk]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
			);

			$images['upload_path']          = './assets/images/guru/';
			$images['allowed_types']        = 'gif|jpg|png|jpeg';
			$images['max_size']             = 100;

			$this->load->library('upload', $images);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false || !$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors();
				$data = array(
					'title' => 'Tambah Guru',
					'konten' => 'guru/form',
					'url_form'	=> 'guru/add',
					'data'	=> $post,
					'images' => $error
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nip' => $post['nip'],
					'nuptk' => $post['nuptk'],
					'gelar_dpn' => $post['gelar_dpn'],
					'gelar_blkg' => $post['gelar_blkg'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'jenis_kelamin' => $post['jenis_kelamin'],
					'pangkat' => $post['pangkat'],
					'gol_ruang' => $post['gol_ruang'],
					'tingkat_pend' => $post['tingkat_pend'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
					'tugas_sebagai' => $post['tugas_sebagai'],
					'tugas_mengajar' => $post['tugas_mengajar'],
					'status_pegawai' => $post['status_pegawai'],
					'tmt_sekolah' => $post['tmt_sekolah'],
					'no_sk' => $post['no_sk'],
					'sekolah' => $this->session->userdata('sekolah'),
					'image' => $this->upload->data() != null ? $this->upload->data()['file_name'] : 'images.png',
				);

				if ($this->global->post_data('tb_guru', $data) != null) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('guru');
			}
		} else {
			$data = array(
				'title' => 'Tambah Guru',
				'konten' => 'guru/form',
				'url_form'	=> 'guru/add'
			);

			$this->load->view('template/index', $data);
		}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_guru'];
		$guru = $this->global->get_byid('tb_guru', array('id_guru' => $id));

		if ($post) {

			$config = array(
				'field' => 'nama',
				'label' => 'Nama Guru',
				'rules' => 'required',
			);

			if ($post['nip'] != $guru['nip']) {
				$config = array(
					'field' => 'nip',
					'label' => 'NIS Guru',
					'rules' => 'required|is_unique[tb_guru.nip]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			if ($post['nuptk'] != $guru['nuptk']) {
				$config = array(
					'field' => 'nuptk',
					'label' => 'NUPTK Guru',
					'rules' => 'required|is_unique[tb_guru.nuptk]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$images['upload_path']          = './assets/images/guru/';
			$images['allowed_types']        = 'gif|jpg|png|jpeg';
			$images['max_size']             = 100;

			$this->load->library('upload', $images);

			$this->upload->do_upload('image');
			$this->form_validation->set_rules(array($config));

			if ($this->form_validation->run() == false) {
				$error = $this->upload->display_errors();
				$data = array(
					'title' => 'Edit Guru',
					'konten' => 'guru/form',
					'url_form'	=> 'guru/edit',
					'data'	=> $post,
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nip' => $post['nip'],
					'nuptk' => $post['nuptk'],
					'gelar_dpn' => $post['gelar_dpn'],
					'gelar_blkg' => $post['gelar_blkg'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'jenis_kelamin' => $post['jenis_kelamin'],
					'pangkat' => $post['pangkat'],
					'gol_ruang' => $post['gol_ruang'],
					'tingkat_pend' => $post['tingkat_pend'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
					'tugas_sebagai' => $post['tugas_sebagai'],
					'tugas_mengajar' => $post['tugas_mengajar'],
					'status_pegawai' => $post['status_pegawai'],
					'tmt_sekolah' => $post['tmt_sekolah'],
					'no_sk' => $post['no_sk'],
				);

				if ($this->upload->data()['file_name'] != null) $data += array('image' => $this->upload->data()['file_name']);

				if ($this->global->put_data('tb_guru', $data, array('id_guru' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}

				redirect('guru');
			}
		} else {
			$data = array(
				'title' => 'Edit Guru',
				'konten' => 'guru/form',
				'url_form'	=> 'guru/edit',
				'data'	=> $guru
			);

			$this->load->view('template/index', $data);
		}
	}

	public function status()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_guru', array('id_guru' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_guru', $data, array('id_guru' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('guru');
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
						'name'    => 'guru',
						'nip'	  => $sheetData[$i][0],
						'nuptk'	  => $sheetData[$i][1],
						'gelar_dpn' 	  => $sheetData[$i][2],
						'gelar_blkg' 	  => $sheetData[$i][3],
						'nama' 	  => $sheetData[$i][4],
						'alamat'  => $sheetData[$i][5],
						'jk'	  => $sheetData[$i][6],
						'pangkat'	  => $sheetData[$i][7],
						'gol_ruang'	  => $sheetData[$i][8],
						'tingkat_pend'	  => $sheetData[$i][9],
						'tgl'	  => $sheetData[$i][10],
						'tugas_sebagai'	  => $sheetData[$i][11],
						'tugas_mengajar'	  => $sheetData[$i][12],
						'status_pegawai'	  => $sheetData[$i][12],
						'tmt_sekolah'	  => $sheetData[$i][14],
						'no_sk'	  => $sheetData[$i][15],
					);

					$cart[] = $row;
				}

				$this->cart->destroy();
				$this->cart->insert($cart);

				$data = array(
					'title' => 'Import Guru',
					'konten' => 'guru/import',
					'url_tabel'	=> 'guru/get_cart'
				);

				$this->load->view('template/index', $data);
			}
		} else {
			$data = array(
				'title' => 'Import Guru',
				'konten' => 'guru/import',
				'url_tabel'	=> 'guru/get_cart'
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

			$hapus = '<a href="' . base_url() . 'guru/rm_cart/' . $field['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

			$no++;
			$row = array();
			$row[] = $hapus;
			$row[] = $no;
			$row[] = $field['nip'];
			$row[] = $field['nuptk'];
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
				'nip' => $field['nip'],
				'nuptk' => $field['nuptk'],
				'gelar_dpn' => $field['gelar_dpn'],
				'gelar_blkg' => $field['gelar_blkg'],
				'nama' => $field['nama'],
				'alamat' => $field['alamat'],
				'jenis_kelamin' => $field['jk'],
				'pangkat' => $field['pangkat'],
				'gol_ruang' => $field['gol_ruang'],
				'tingkat_pend' => $field['tingkat_pend'],
				'tempat_lahir' => $tgl[0],
				'tanggal_lahir' =>  date('Y-m-d', strtotime($tgl[1])),
				'tugas_sebagai' => $field['tugas_sebagai'],
				'tugas_mengajar' => $field['tugas_mengajar'],
				'status_pegawai' => $field['status_pegawai'],
				'tmt_sekolah' => $field['tmt_sekolah'],
				'no_sk' => $field['no_sk'],
				'sekolah' => $this->session->userdata('sekolah'),
				'image' => 'image.png',
			);

			$data[] = $row;
		}

		if ($this->global->post_data_batch('tb_guru', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}

		$this->cart->destroy();
		redirect('guru');
	}

	public function rm_cart()
	{
		$rowid = $this->uri->segment(3);
		$this->cart->remove($rowid);
		redirect('guru/import');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$guru = $this->global->get_byid('tb_guru', array('id_guru' => $id));

		$data = array(
			'title' => 'Detail Guru',
			'konten' => 'guru/detail',
			'guru'		=> $guru,
			// 'tahun'		=> $this->guru->get_guru_detail($guru['nip'])
		);

		$this->load->view('template/index', $data);
		// echo json_encode($data);
	}
}
