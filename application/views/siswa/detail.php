<div class="row">

	<div class="col-md-4">
		<div class="card">
			<h5 class="card-header">Data Siswa</h5>
			<div class="card-body row justify-content-center">
				<img src="<?= base_url() . 'assets/images/siswa/' . $siswa['image'] ?>" class="img-thumbnail p-5">
			</div>
		</div>

	</div>

	<div class="col-md-8">
		<div class="card">
			<h5 class="card-header">Data Siswa</h5>
			<div class="card-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th scope="row" width="200px">Nomor Induk Siswa</th>
							<td><?= isset($siswa['nis']) ? $siswa['nis'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">NISN Siswa</th>
							<td><?= isset($siswa['nisn']) ? $siswa['nisn'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Siswa</th>
							<td><?= isset($siswa['nama']) ? $siswa['nama'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Alamat</th>
							<td><?= isset($siswa['alamat']) ? $siswa['alamat'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tempat Tanggal Lahir</th>
							<td><?= isset($siswa['tempat_lahir']) ? $siswa['tempat_lahir'] : '-' ?>, <?= isset($siswa['tanggal_lahir']) ? tanggal($siswa['tanggal_lahir']) : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Jenis Kelamin</th>
							<td><?= isset($siswa['jenis_kelamin']) ? $siswa['jenis_kelamin'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Agama</th>
							<td><?= isset($siswa['agama']) ? $siswa['agama'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Status Keluarga</th>
							<td><?= isset($siswa['status_keluarga']) ? $siswa['status_keluarga'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Anak Ke</th>
							<td><?= isset($siswa['anak_ke']) ? $siswa['anak_ke'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nomor Telpon</th>
							<td><?= isset($siswa['telepon']) ? $siswa['telepon'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Sekolah Asal</th>
							<td><?= isset($siswa['sekolah_asal']) ? $siswa['sekolah_asal'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Diterima diKelas</th>
							<td><?= isset($siswa['diterima_kelas']) ? $siswa['diterima_kelas'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Diterima diTanggal</th>
							<td><?= isset($siswa['diterima_tanggal']) ? tanggal($siswa['diterima_tanggal']) : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Ayah</th>
							<td><?= isset($siswa['nama_ayah']) ? $siswa['nama_ayah'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Ibu</th>
							<td><?= isset($siswa['nama_ibu']) ? $siswa['nama_ibu'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Alamat Orang Tua</th>
							<td><?= isset($siswa['alamat_orangtua']) ? $siswa['alamat_orangtua'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Pekerjaan Ayah</th>
							<td><?= isset($siswa['kerja_ayah']) ? $siswa['kerja_ayah'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Pekerjaan Ibu</th>
							<td><?= isset($siswa['kerja_ibu']) ? $siswa['kerja_ibu'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Wali</th>
							<td><?= isset($siswa['nama_wali']) ? $siswa['nama_wali'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Alamat Wali</th>
							<td><?= isset($siswa['alamat_wali']) ? $siswa['alamat_wali'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Pekerjaan Wali</th>
							<td><?= isset($siswa['kerja_wali']) ? $siswa['kerja_wali'] : '-' ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<?php $this->load->view('siswa/rekap') ?>
</div>


</div>
