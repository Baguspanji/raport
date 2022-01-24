<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
			'title' => 'Daftar Siswa',
			'konten' => 'siswa/index',
			'url_tabel'	=> 'siswa/get_siswa'
		);

		$this->load->view('template/index', $data);
	}

	public function get_siswa()
	{
		allowed('admin');
		$list = $this->global->get_data('tb_siswa', false, null);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="' . base_url() . 'siswa/status/' . $field->id_siswa . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'siswa/status/' . $field->id_siswa . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$edit = '<a href="' . base_url() . 'siswa/edit/' . $field->id_siswa . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';
			$detail = '<a href="' . base_url() . 'siswa/detail/' . $field->id_siswa . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>';

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
			$row[] = $detail . ' ' . $edit;

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

			$config = array(
				array(
					'field' => 'nis',
					'label' => 'Nomor Induk Siswa',
					'rules' => 'required|is_unique[tb_siswa.nis]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
				array(
					'field' => 'nisn',
					'label' => 'NISN Siswa',
					'rules' => 'required|is_unique[tb_siswa.nisn]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				),
			);

			$images['upload_path']          = './assets/images/siswa/';
			$images['allowed_types']        = 'gif|jpg|png|jpeg';
			$images['max_size']             = 100;

			$this->load->library('upload', $images);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == false || !$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors();
				$data = array(
					'title' => 'Tambah Siswa',
					'konten' => 'siswa/form',
					'url_form'	=> 'siswa/add',
					'data'	=> $post,
					'images' => $error
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nis' => $post['nis'],
					'nisn' => $post['nisn'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
					'jenis_kelamin' => $post['jenis_kelamin'],
					'agama' => $post['agama'],
					'status_keluarga' => $post['status_keluarga'],
					'anak_ke' => $post['anak_ke'],
					'telepon' => $post['telepon'],
					'sekolah_asal' => $post['sekolah_asal'],
					'diterima_kelas' => $post['diterima_kelas'],
					'diterima_tanggal' => $post['diterima_tanggal'],
					'nama_ayah' => $post['nama_ayah'],
					'nama_ibu' => $post['nama_ibu'],
					'alamat_orangtua' => $post['alamat_orangtua'],
					'kerja_ayah' => $post['kerja_ayah'],
					'kerja_ibu' => $post['kerja_ibu'],
					'nama_wali' => $post['nama_wali'],
					'alamat_wali' => $post['alamat_wali'],
					'kerja_wali' => $post['kerja_wali'],
					'image' => $this->upload->data() != null ? $this->upload->data()['file_name'] : 'images.png',
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
		allowed('admin');
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

			if ($post['nisn'] != $siswa['nisn']) {
				$config = array(
					'field' => 'nisn',
					'label' => 'NISN Siswa',
					'rules' => 'required|is_unique[tb_siswa.nisn]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					]
				);
			}

			$images['upload_path']          = './assets/images/siswa/';
			$images['allowed_types']        = 'gif|jpg|png|jpeg';
			$images['max_size']             = 100;

			$this->load->library('upload', $images);

			$this->upload->do_upload('image');
			$this->form_validation->set_rules(array($config));

			if ($this->form_validation->run() == false) {
				$error = $this->upload->display_errors();
				$data = array(
					'title' => 'Edit Siswa',
					'konten' => 'siswa/form',
					'url_form'	=> 'siswa/edit',
					'data'	=> $post,
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nis' => $post['nis'],
					'nisn' => $post['nisn'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
					'jenis_kelamin' => $post['jenis_kelamin'],
					'agama' => $post['agama'],
					'status_keluarga' => $post['status_keluarga'],
					'anak_ke' => $post['anak_ke'],
					'telepon' => $post['telepon'],
					'sekolah_asal' => $post['sekolah_asal'],
					'diterima_kelas' => $post['diterima_kelas'],
					'diterima_tanggal' => $post['diterima_tanggal'],
					'nama_ayah' => $post['nama_ayah'],
					'nama_ibu' => $post['nama_ibu'],
					'alamat_orangtua' => $post['alamat_orangtua'],
					'kerja_ayah' => $post['kerja_ayah'],
					'kerja_ibu' => $post['kerja_ibu'],
					'nama_wali' => $post['nama_wali'],
					'alamat_wali' => $post['alamat_wali'],
					'kerja_wali' => $post['kerja_wali'],
				);

				if ($this->upload->data()['file_name'] != null) $data += array('image' => $this->upload->data()['file_name']);

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

	public function status()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_siswa', array('id_siswa' => $id));

		$status = 0;
		if ($kelas['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_siswa', $data, array('id_siswa' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('siswa');
	}

	public function import()
	{
		allowed('admin');
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
						'nisn' 	  => $sheetData[$i][1],
						'nama'	  => $sheetData[$i][2],
						'alamat'  => $sheetData[$i][3],
						'tgl'	  => $sheetData[$i][4],
						'jk'	  => $sheetData[$i][5],
						'agama'	  => $sheetData[$i][6],
						'status_keluarga'	  => $sheetData[$i][7],
						'anak_ke'	  => $sheetData[$i][8],
						'telepon'	  => $sheetData[$i][9],
						'sekolah_asal'	  => $sheetData[$i][10],
						'diterima_kelas'	  => $sheetData[$i][11],
						'diterima_tanggal'	  => $sheetData[$i][12],
						'nama_ayah'	  => $sheetData[$i][13],
						'nama_ibu'	  => $sheetData[$i][14],
						'alamat_orangtua'	  => $sheetData[$i][15],
						'kerja_ayah'	  => $sheetData[$i][16],
						'kerja_ibu'	  => $sheetData[$i][17],
						'nama_wali'	  => $sheetData[$i][18],
						'alamat_wali'	  => $sheetData[$i][19],
						'kerja_wali'	  => $sheetData[$i][20],
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
		allowed('admin');
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
			$row[] = $field['nisn'];
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
		allowed('admin');
		$list = $this->cart->contents();
		$data = array();

		foreach ($list as $field) {

			$tgl = explode(", ", $field['tgl']);
			$row = array(
				'nis' => $field['nis'],
				'nisn' => $field['nisn'],
				'nama' => $field['nama'],
				'alamat' => $field['alamat'],
				'tempat_lahir' => $tgl[0],
				'tanggal_lahir' =>  date('Y-m-d', strtotime($tgl[1])),
				'jenis_kelamin' => $field['jk'],
				'agama' => $field['agama'],
				'status_keluarga' => $field['status_keluarga'],
				'anak_ke' => $field['anak_ke'],
				'telepon' => $field['telepon'],
				'sekolah_asal' => $field['sekolah_asal'],
				'diterima_kelas' => $field['diterima_kelas'],
				'diterima_tanggal' => date('Y-m-d', strtotime($field['diterima_tanggal'])),
				'nama_ayah' => $field['nama_ayah'],
				'nama_ibu' => $field['nama_ibu'],
				'alamat_orangtua' => $field['alamat_orangtua'],
				'kerja_ayah' => $field['kerja_ayah'],
				'kerja_ibu' => $field['kerja_ibu'],
				'nama_wali' => $field['nama_wali'],
				'alamat_wali' => $field['alamat_wali'],
				'kerja_wali' => $field['kerja_wali'],
				'image' => 'images.png',
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
		allowed('admin');
		$rowid = $this->uri->segment(3);
		$this->cart->remove($rowid);
		redirect('siswa/import');
	}

	public function detail()
	{
		allowed('admin', 'guru');
		$id = $this->uri->segment(3);
		$siswa = $this->global->get_byid('tb_siswa', array('id_siswa' => $id));

		$data = array(
			'title' => 'Detail Siswa',
			'konten' => 'siswa/detail',
			'siswa'		=> $siswa,
			'tahun'		=> $this->siswa->get_siswa_detail($siswa['nis'])
		);

		$this->load->view('template/index', $data);
		// echo json_encode($data);
	}
}
