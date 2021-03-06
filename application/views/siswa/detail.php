<div class="row">

	<div class="col-md-4">
		<div class="card">
			<h5 class="card-header">Data Siswa</h5>
			<div class="card-body row justify-content-center">
				<img src="<?= base_url() ?>assets/images/user.svg" class="img-fluid p-5">
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
							<th scope="row" width="200px">NIS Siswa</th>
							<td><?= $siswa['nis'] ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Nama Siswa</th>
							<td><?= $siswa['nama'] ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Alamat</th>
							<td><?= $siswa['alamat'] ?></td>
						</tr>
						<tr>
							<th scope="row" width="200px">Tempat Tanggal Lahir</th>
							<td><?= $siswa['tempat_lahir'] . ', ' . $siswa['tanggal_lahir'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center">
				<h3>Absensi</h3>
			</div>
			<div class="card-body">
				<div class="row justify-content-around">
					<div class="col-3 d-flex align-items-center">
						<i class="las la-calendar icon-home bg-dark text-light"></i>
					</div>
					<div class="col-2 text-center" style="color: red;">
						<p>Apla</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 2) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: orange;">
						<p>Izin</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 3) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: blue;">
						<p>Sakit</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 4) ?? 0 ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="col-md-6 col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4 d-flex align-items-center">
						<i class="las la-clipboard-list icon-home bg-success text-light"></i>
					</div>
					<div class="col-8">
						<p>Total guru</p>
						<h5>10</h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4 d-flex align-items-center">
						<i class="las la-chart-bar  icon-home bg-info text-light"></i>
					</div>
					<div class="col-8">
						<p>Total Kelas</p>
						<h5>10</h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4 d-flex align-items-center">
						<i class="las la-id-card  icon-home bg-warning text-light"></i>
					</div>
					<div class="col-8">
						<p>Total Pekerja</p>
						<h5>10</h5>
					</div>
				</div>
			</div>
		</div>

	</div> -->

</div>
