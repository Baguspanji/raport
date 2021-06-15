<?php
if (!defined("BASEPATH")) exit("no direct script access allowed");


require APPPATH . '/libraries/API_Controller.php';
require_once APPPATH . '/libraries/JWT.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class Siswa extends API_Controller
{

	private $secret = 'this is key secret';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('restapi/M_siswa', 'siswa');
	}

	public function login()
	{
		header("Access-Control-Allow-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		$output = $this->siswa->login($data);

		if ($output['status'] == false) {
			$message = "Username atau Password salah";

			return $this->api_return(
				[
					'status'    => false,
					'data'      => array(
						'id_token' => '',
						'username' => $output['username'],
						'nama' => $output['nama']
					),
					'message'   => $message
				],
				200
			);
		}

		$payload['username']  = $output['username'];

		return $this->api_return(
			[
				'status'    => true,
				'data'      => array(
					'jwt_token' => JWT::encode($payload, $this->secret),
					'username' => $output['username'],
					'nama' => $output['nama'],
					'alamat' => $output['alamat'],
					'tempat_lahir' => $output['tempat_lahir'],
					'tanggal_lahir' => $output['tanggal_lahir'],
					'image' => $output['image'],
				),
				'message'   => "Berhasil login"
			],
			200
		);
	}

	public function ubah_pass()
	{
		header("Access-Control-Allowed-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		if ($this->protected_method($data['username'])) {
			$output = $this->siswa->update_pass($data);

			if ($output) {
				return $this->api_return(
					[
						'status'    => true,
						'data'      => $output,
						'message'   => "Berhasil diubah"
					],
					200
				);
			}else {
				return $this->api_return(
					[
						'status'    => false,
						'data'      => $output,
						'message'   => "Gagal diubah"
					],
					200
				);
			}
		}
	}

	public function semester()
	{
		header("Access-Control-Allowed-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		if ($this->protected_method($data['username'])) {
			$output = $this->siswa->get_semester($data);

			if ($output != null) {
				return $this->api_return(
					[
						'status'    => true,
						'data'      => $output,
						'message'   => "Berhasil"
					],
					200
				);
			}else {
				return $this->api_return(
					[
						'status'    => false,
						'data'      => $output,
						'message'   => "Gagal"
					],
					200
				);
			}
		}
	}

	public function absen()
	{
		header("Access-Control-Allowed-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		if ($this->protected_method($data['username'])) {
			$output = $this->siswa->get_absen($data);

			if ($output != null) {
				return $this->api_return(
					[
						'status'    => true,
						'data'      => $output,
						'message'   => "Berhasil"
					],
					200
				);
			}else {
				return $this->api_return(
					[
						'status'    => false,
						'data'      => $output,
						'message'   => "Gagal"
					],
					200
				);
			}
		}
	}

	public function bayar()
	{
		header("Access-Control-Allowed-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		if ($this->protected_method($data['username'])) {
			$output = $this->siswa->get_bayar($data);

			if ($output != null) {
				return $this->api_return(
					[
						'status'    => true,
						'data'      => $output,
						'message'   => "Berhasil"
					],
					200
				);
			}else {
				return $this->api_return(
					[
						'status'    => false,
						'data'      => $output,
						'message'   => "Gagal"
					],
					200
				);
			}
		}
	}

	public function nilai()
	{
		header("Access-Control-Allowed-Origin: *");
		$this->_apiConfig([
			'methods' => ['POST'],
		]);

		$data = json_decode(file_get_contents('php://input'), true);

		if ($this->protected_method($data['username'])) {
			$output = $this->siswa->get_nilai($data);

			if ($output != null) {
				return $this->api_return(
					[
						'status'    => true,
						'data'      => $output,
						'message'   => "Berhasil"
					],
					200
				);
			}else {
				return $this->api_return(
					[
						'status'    => false,
						'data'      => $output,
						'message'   => "Gagal"
					],
					200
				);
			}
		}
	}


	// ====================== JWT Config ==========================
	// ============================================================

	public function response($data, $status = 200)
	{
		$this->output
			->set_content_type('application/json')
			->set_status_header($status)
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();

		exit;
	}

	public function check_token()
	{
		$jwt = $this->input->get_request_header('Authorization');

		try {
			$decoded = JWT::decode($jwt, $this->secret, array('HS256'));
			return $decoded->username;
		} catch (\Exception $e) {
			return $this->api_return(
				[
					'status' => false,
					'data'  => array('username' => ''),
					'message' => 'Gagal, error token'
				],
				401
			);
		}
	}

	public function protected_method($id)
	{
		if ($id_from_token = $this->check_token()) {
			if ($id_from_token == $id) {
				return true;
			} else {
				return $this->response([
					'status' => false,
					'data'  => array('username' => ''),
					'message' => 'User yang login berbeda'
				], 403);
			}
		}
	}
}
