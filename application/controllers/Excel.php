<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('import');
	}

	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');
		$writer = new Xlsx($spreadsheet);
		$filename = 'name-of-the-generated-file';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output'); // download file
	}
	
	public function import()
	{
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

			$data = array();
			for ($i=0; $i <count($sheetData); $i++) { 
				$row['nis'] = $sheetData[$i][0]; 
				$row['nisn'] = $sheetData[$i][1]; 
				$row['nama'] = $sheetData[$i][2]; 
				$row['alamat'] = $sheetData[$i][3]; 
				$row['ttl'] = $sheetData[$i][4]; 
				$row['jk'] = $sheetData[$i][5]; 
				$row['agama'] = $sheetData[$i][6]; 
				$row['status_keluarga'] = $sheetData[$i][7]; 
				$row['anak_ke'] = $sheetData[$i][8]; 
				$row['telepon'] = $sheetData[$i][9]; 
				$row['sekolah_asal'] = $sheetData[$i][10]; 
				$row['diterima_kelas'] = $sheetData[$i][11]; 
				$row['diterima_tanggal'] = $sheetData[$i][12]; 
				$row['nama_ayah'] = $sheetData[$i][13]; 
				$row['nama_ibu'] = $sheetData[$i][14]; 
				$row['alamat_ortu'] = $sheetData[$i][15]; 
				$row['kerja_ayah'] = $sheetData[$i][16]; 
				$row['kerja_ibu'] = $sheetData[$i][17];
				$row['nama_wali'] = $sheetData[$i][18];
				$row['alamat_wali'] = $sheetData[$i][19];
				$row['kerja_wali'] = $sheetData[$i][20];

				$data[] = $row;
			}

			echo json_encode($data);
		}
	}
}
