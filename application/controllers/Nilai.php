<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Nilai_model', 'nilai');
		$this->load->model('Absensi_model', 'absensi');
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Nilai',
			'konten' => 'nilai/index',
			'url_tabel'	=> 'nilai/get_nilai',
		);

		$this->load->view('template/index', $data);
	}

	public function get_nilai()
	{
		$list = $this->global->get_data('tb_nilai');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</a>';
			if ($field->status == 0) {
				$status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Non-Aktif</a>';
			}

			$add = '<a href="' . base_url() . 'nilai/add_kelas/' . $field->id_nilai . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Kelas</a>';
			if ($field->kelas != null) $add = '';

			$edit = '<a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';

			$kelas = '';
			if ($field->kelas != null) {
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
			$row[] = $field->nama_nilai;
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];
			$row[] = $kelas;
			$row[] = $status;
			$row[] = $edit . ' ' . $add;

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
			'nama_nilai' => $post['nama_nilai'],
			'tahun_ajaran' => $post['tahun_ajaran'],
		);

		if ($this->global->post_data('tb_nilai', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('nilai');
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

	public function add_kelas()
	{
		$id = $this->uri->segment(3);
		$get = $this->uri->segment(4);

		$nilai = $this->global->get_byid('tb_nilai', array('id_nilai' => $id == 'add' ? $this->session->userdata('id_nilai') : $id));

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
				'title' => 'Kelas ' . $nilai['nama_nilai'],
				'konten' => 'nilai/add_kelas',
				'url_tabel'	=> 'nilai/get_kelas',
				'url_tabel_2'	=> 'nilai/get_cart',
			);

			$this->load->view('template/index', $data);
		} else {

			$data = array(
				'title' => 'Kelas ' . $nilai['nama_nilai'],
				'konten' => 'nilai/add_kelas',
				'url_tabel'	=> 'nilai/get_kelas',
				'url_tabel_2'	=> 'nilai/get_cart',
			);

			$this->cart->destroy();

			$this->session->unset_userdata('id_nilai');
			$this->session->set_userdata('id_nilai', $id);

			$this->load->view('template/index', $data);
		}
	}

	public function get_kelas()
	{
		$list = $this->global->get_data('tb_kelas', true);

		$data = array();
		$no = 0;
		foreach ($list as $field) {
			$add = '<a href="' . base_url() . 'nilai/add_kelas/add/' . $field->id_kelas . '" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>';

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

		$no = 0;
		foreach ($list as $cart) {

			$hapus = '<a href="' . base_url() . 'nilai/rm_cart/' . $cart['rowid'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

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

		$nilai = $this->global->get_byid('tb_nilai', array('id_nilai' => $this->session->userdata('id_nilai')));

		$this->cart->remove($rowid);

		$data = array(
			'title' => 'Kelas ' . $nilai['nama_nilai'],
			'konten' => 'nilai/add_kelas',
			'url_tabel'	=> 'nilai/get_kelas',
			'url_tabel_2'	=> 'nilai/get_cart',
		);

		$this->load->view('template/index', $data);
	}

	public function add_cart()
	{
		$id = $this->session->userdata('id_nilai');
		$list = $this->cart->contents();
		$kelas = '';

		foreach ($list as $field) {

			$kelas = $kelas . $field['kelas'] . ',';
		}

		$data = array(
			'kelas' => substr(trim($kelas), 0, -1)
		);

		if ($this->global->put_data('tb_nilai', $data, array('id_nilai' => $id)) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		$this->session->unset_userdata('id_nilai');

		$this->cart->destroy();
		redirect('nilai');
		// echo json_encode($data);
	}

	public function penilaian()
	{
		$data = array(
			'title' => 'Daftar Penilaian',
			'konten' => 'nilai/penilaian',
			'url_tabel'	=> 'nilai/get_penilaian',
		);

		$this->load->view('template/index', $data);
	}

	public function get_penilaian()
	{
		$list = $this->global->get_data('tb_kelas', true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$penilaian = '';
			foreach ($this->nilai->get_pelajaran($field->id_kelas) as $key) {
				$penilaian .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelasModal-' . $field->id_kelas . '-' . $key->id_pelajaran . '"><i class="fa fa-download"></i> ' . $key->nama_pelajaran . '</button> ';
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field->wali_kelas))['nama'];
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];
			$row[] = $penilaian;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function siswa()
	{
		$id = $this->uri->segment(3) ?? $this->session->userdata('id_kelas');
		$nilai = $this->uri->segment(4) ?? $this->session->userdata('id_nilai');
		$pelajaran = $this->uri->segment(5) ?? $this->session->userdata('id_pelajaran');

		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));
		$nama_nilai = $this->global->get_byid('tb_nilai', array('id_nilai' => $nilai));
		$mapel = $this->global->get_byid('tb_pelajaran', array('id_pelajaran' => $pelajaran));

		$data = array(
			'title' => 'Penilaian ' . $nama_nilai['nama_nilai'] . ' ' . $mapel['nama_pelajaran'] . ' ' . $kelas['nama_kelas'],
			'konten' => 'siswa/index',
			'url_tabel'	=> 'nilai/get_siswa/' . $id,
			'modal' => 'nilai/modal'
		);

		$this->session->unset_userdata('id_kelas');
		$this->session->unset_userdata('id_nilai');
		$this->session->unset_userdata('id_pelajaran');
		$this->session->set_userdata('id_kelas', $id);
		$this->session->set_userdata('id_nilai', $nilai);
		$this->session->set_userdata('id_pelajaran', $pelajaran);

		$this->load->view('template/index', $data);
	}


	public function get_siswa()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_kelas_detail', array('kelas_id' => $id));
		
		$PecahStr = array();
		$PecahStr = explode(",", $kelas['siswa']);
		
		$list = $this->global->get_data_where('tb_siswa', 'nis', $PecahStr, true);
		$data = array();
		
		$id_kelas = $this->session->userdata('id_kelas');
		$id_nilai = $this->session->userdata('id_nilai');
		$id_pelajaran = $this->session->userdata('id_pelajaran');
		
		$no = 0;
		foreach ($list as $field) {
			$tahun = $this->nilai->get_kelas_detail($id_kelas);

			$ganjil = '';
			$genap = '';
			foreach ($this->nilai->get_nilai_siswa($field->nis, $id_nilai, $id_pelajaran, $tahun['ganjil_dari'], $tahun['ganjil_sampai']) as $key) {
				if ($key->nilai <= $this->nilai->get_bypelajaran($id_kelas)['nilai_minim']) {
					$ganjil .= '<button type="button" class="btn btn-sm btn-danger">' . $key->nilai . '</button>';
				} else {
					$ganjil .= '<button type="button" class="btn btn-sm btn-success">' . $key->nilai . '</button>';
				}
			}
			foreach ($this->nilai->get_nilai_siswa($field->nis, $id_nilai, $id_pelajaran, $tahun['genap_dari'], $tahun['genap_sampai']) as $key) {
				if ($key->nilai <= $this->nilai->get_bypelajaran($id_kelas)['nilai_minim']) {
					$genap .= '<button type="button" class="btn btn-sm btn-danger">' . $key->nilai . '</button>';
				} else {
					$genap .= '<button type="button" class="btn btn-sm btn-success">' . $key->nilai . '</button>';
				}
			}


			$nilai = '<button type="button" class="open-Dialog btn btn-primary" data-toggle="modal" data-target="#nilaiModal" 
				data-nis="' . $field->nis . '" data-nilai="' . $id_nilai . '" data-pelajaran="' . $id_pelajaran . '"><i class="fa fa-plus"></i> Nilai</button>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img src="' . base_url() . 'assets/images/siswa/' . $field->image . '" class="img-thumbnail" width="200px">';
			$row[] = $field->nis;
			$row[] = $field->nisn;
			$row[] = $field->nama;
			$row[] = $field->alamat;
			$row[] = $field->tempat_lahir . ', ' . tanggal($field->tanggal_lahir);
			$row[] = $ganjil;
			$row[] = $genap;
			$row[] = $nilai;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add_nilai()
	{
		$post = $this->input->post();
		$data = array(
			'nis' => $post['nis'],
			'nilai_id' => $post['nilai_id'],
			'pelajaran_id' => $post['pelajaran_id'],
			'nilai' => $post['nilai'],
			'tanggal' => date('Y-m-d'),
		);

		if ($this->global->post_data('tb_penilaian', $data) != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('nilai/siswa');
	}
}
