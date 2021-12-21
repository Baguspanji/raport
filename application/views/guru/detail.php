<div class="row">

	<div class="col-md-4">
		<div class="card">
			<h5 class="card-header">Data Guru</h5>
			<div class="card-body row justify-content-center">
				<img src="<?= base_url() . 'assets/images/guru/' . $guru['image'] ?>" class="img-thumbnail p-5">
			</div>
		</div>

	</div>

	<div class="col-md-8">
		<div class="card">
			<h5 class="card-header">Data Guru</h5>
			<div class="card-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th scope="row" width="200px">Nomor Induk Pegawai</th>
							<td><?= isset($guru['nip']) ? $guru['nip'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">NUPTK Guru</th>
							<td><?= isset($guru['nuptk']) ? $guru['nuptk'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Guru</th>
							<td><?= isset($guru['nama']) ? ($guru['gelar_dpn'] != null ? $guru['gelar_dpn'] . ' ' : '') . $guru['nama'] . ($guru['gelar_blkg'] != null ? ', ' . $guru['gelar_blkg'] : ''): '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Alamat</th>
							<td><?= isset($guru['alamat']) ? $guru['alamat'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Jenis Kelamin</th>
							<td><?= isset($guru['jenis_kelamin']) ? $guru['jenis_kelamin'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Pangkat</th>
							<td><?= isset($guru['pangkat']) ? $guru['pangkat'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Golongan Ruang</th>
							<td><?= isset($guru['gol_ruang']) ? $guru['gol_ruang'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tingkat Pendidikan</th>
							<td><?= isset($guru['tingkat_pend']) ? $guru['tingkat_pend'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tempat Tanggal Lahir</th>
							<td><?= isset($guru['tempat_lahir']) ? $guru['tempat_lahir'] : '-' ?>, <?= isset($guru['tanggal_lahir']) ? tanggal($guru['tanggal_lahir']) : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tugas Sebagai</th>
							<td><?= isset($guru['tugas_sebagai']) ? $guru['tugas_sebagai'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tugas Mengajar</th>
							<td><?= isset($guru['tugas_mengajar']) ? $guru['tugas_mengajar'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Status Pegawai</th>
							<td><?= isset($guru['status_pegawai']) ? $guru['status_pegawai'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">TMT di Sekolah ini</th>
							<td><?= isset($guru['tmt_sekolah']) ? $guru['tmt_sekolah'] : '-' ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">No. SK</th>
							<td><?= isset($guru['no_sk']) ? $guru['no_sk'] : '-' ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<!-- <?php //$this->load->view('guru/rekap') ?> -->
</div>


</div>
