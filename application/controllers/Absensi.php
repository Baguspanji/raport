<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		allowed('admin');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Absensi_model', 'absensi');
	}

	public function index()
	{
		$data = array(
			'title' => 'Daftar Absensi',
			'konten' => 'absensi/index',
			'url_tabel'	=> 'absensi/get_absensi'
		);

		$this->load->view('template/index', $data);
	}

	public function get_absensi()
	{
		$list = $this->global->get_data('tb_kelas', true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			$absen = '<a href="' . base_url() . 'absensi/absen/' . $field->id_kelas . '" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> Absen hari ini</a>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_kelas;
			$row[] = $this->global->get_byid('tb_guru', array('id_guru' => $field->wali_kelas))['nama'];
			$row[] = $this->global->get_byid('tb_tahun', array('id_tahun' => $field->tahun_ajaran))['tahun_ajaran'];
			$row[] = $absen;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function absen()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_kelas', array('id_kelas' => $id));

		$data = array(
			'title' => 'Absensi ' . $kelas['nama_kelas'],
			'konten' => 'siswa/index',
			'url_tabel'	=> 'absensi/get_absen/' . $id
		);

		$this->session->unset_userdata('id_kelas');
		$this->session->set_userdata('id_kelas', $id);

		$this->load->view('template/index', $data);
	}

	public function get_absen()
	{
		$id = $this->uri->segment(3);
		$kelas = $this->global->get_byid('tb_kelas_detail', array('kelas_id' => $id));

		$PecahStr = array();
		$PecahStr = explode(",", $kelas['siswa']);

		$list = $this->global->get_data_where('tb_siswa', 'nis', $PecahStr, true);
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$absensi = $this->absensi->get_bynis_absen($field->nis);

			$status = '';
			$alpa = '';
			$izin = '';
			$sakit = '';
			$absen = '<a href="' . base_url() . 'absensi/add/' . $field->nis . '" class="btn btn-sm btn-info"><i class="fa fa-check"></i> absen</a>';
			if (isset($absensi)) {
				if ($absensi['absen'] == 0) $status = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Masuk</a>';
				if ($absensi['absen'] == 1) $status = '<a href="#" class="btn btn-sm btn-success"><i class="fa fa-check-square"></i> Pulang</a>';
				if ($absensi['absen'] == 2) $status = '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Alpa</a>';
				if ($absensi['absen'] == 3) $status = '<a href="#" class="btn btn-sm btn-dark"><i class="fa fa-envelope"></i> Izin</a>';
				if ($absensi['absen'] == 4) $status = '<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-pills"></i> Sakit</a>';
				$absen = '<a href="' . base_url() . 'absensi/add/' . $field->nis . '/' . $absensi['id_absen'] . '" class="btn btn-sm btn-info"><i class="fa fa-check"></i> absen</a>';
				$alpa = '<a href="' . base_url() . 'absensi/add/' . $field->nis . '/' . $absensi['id_absen'] . '/2" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> alpa</a>';
				$izin = '<a href="' . base_url() . 'absensi/add/' . $field->nis . '/' . $absensi['id_absen'] . '/3" class="btn btn-sm btn-dark"><i class="fa fa-envelope"></i> izin</a>';
				$sakit = '<a href="' . base_url() . 'absensi/add/' . $field->nis . '/' . $absensi['id_absen'] . '/4" class="btn btn-sm btn-primary"><i class="fa fa-pills"></i> sakit</a>';
			}


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
			$row[] = $absen .' '. $alpa.' '. $izin.' '. $sakit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function add()
	{
		$nis = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$abs = $this->uri->segment(5);

		$hadir = 1;
		if($abs != null)$hadir = $abs;

		if ($id != null) {
			$data = array(
				'nis_siswa' => $nis,
				'tanggal' => date('Y-m-d'),
				'absen' => $hadir,
			);

			$absensi = $this->global->put_data('tb_absensi', $data, array('id_absen' => $id));
		} else {
			$data = array(
				'nis_siswa' => $nis,
				'tanggal' => date('Y-m-d'),
			);

			$absensi = $this->global->post_data('tb_absensi', $data);
		}

		if ($absensi != null) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
		}
		redirect('absensi/absen/' . $this->session->userdata('id_kelas'));
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $this->uri->segment(3) != null ? $this->uri->segment(3) : $post['id_pekerja'];
		$pekerja = $this->global->get_byid('tb_pekerja', array('id_pekerja' => $id));

		if ($post) {

			$config = array(
				'field' => 'nama',
				'label' => 'Nama Guru',
				'rules' => 'required',
			);

			if ($post['nip'] != $pekerja['nip']) {
				$config = array(
					'field' => 'nip',
					'label' => 'NIP Pekerja',
					'rules' => 'required|is_unique[tb_pekerja.nip]',
					"errors" => [
						'is_unique' => '%s sudah terdaftar.',
					],
				);
			}

			$this->form_validation->set_rules(array($config));


			if ($this->form_validation->run() == false) {
				$data = array(
					'title' => 'Edit Pekerja',
					'konten' => 'pekerja/form',
					'url_form'	=> 'pekerja/edit',
					'data'	=> $post
				);

				$this->load->view('template/index', $data);
			} else {

				$data = array(
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'alamat' => $post['alamat'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tanggal_lahir' => $post['tanggal_lahir'],
				);

				if ($this->global->put_data('tb_pekerja', $data, array('id_pekerja' => $id))) {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
				}
				redirect('pekerja');
			}
		} else {
			$data = array(
				'title' => 'Edit Pekerja',
				'konten' => 'pekerja/form',
				'url_form'	=> 'pekerja/edit',
				'data'	=> $pekerja
			);

			$this->load->view('template/index', $data);
		}
	}
}
