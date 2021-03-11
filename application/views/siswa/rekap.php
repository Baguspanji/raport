<?php foreach ($tahun as $key) : ?>

	<div class="col-md-12">
		<h3 class="text-danger"><?= $key->nama_kelas ?></h3>
		<h4 class="text-info">Ganjil</h4>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-dark">
				<h3>Absensi</h3>
			</div>
			<div class="card-body">
				<div class="row justify-content-around">
					<div class="col-3 d-flex align-items-center">
						<i class="las la-calendar icon-home bg-dark text-light"></i>
					</div>
					<div class="col-2 text-center" style="color: red;">
						<p>Apla</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 2, $key->ganjil_dari, $key->ganjil_sampai) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: orange;">
						<p>Izin</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 3, $key->ganjil_dari, $key->ganjil_sampai) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: blue;">
						<p>Sakit</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 4, $key->ganjil_dari, $key->ganjil_sampai) ?? 0 ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-success">
				<h3>Nilai</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2 d-flex align-items-start">
						<i class="las la-clipboard-list icon-home bg-success text-light"></i>
					</div>
					<div class="col-10">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th scope="row" width="200px">Nilai Tugas</th>
										<td>20</td>
									</tr>
									<tr>
										<th scope="row" width="200px">Ulangan Harian</th>
										<td>20</td>
										<td>20</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-warning">
				<h3>Pembayaran</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2 d-flex align-items-start">
						<i class="las la-dollar-sign  icon-home bg-warning text-light"></i>
					</div>
					<div class="col-10">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th scope="row" width="200px">SPP</th>
										<td><a class="btn btn-success btn-sm"><i class="fas fa-check text-light"></i></a></td>
									</tr>
									<tr>
										<th scope="row" width="200px">LKS Semester</th>
										<td><a class="btn btn-danger btn-sm"><i class="fas fa-times text-light"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<h4 class="text-info">Genap</h4>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-dark">
				<h3>Absensi</h3>
			</div>
			<div class="card-body">
				<div class="row justify-content-around">
					<div class="col-3 d-flex align-items-center">
						<i class="las la-calendar icon-home bg-dark text-light"></i>
					</div>
					<div class="col-2 text-center" style="color: red;">
						<p>Apla</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 2, $key->genap_dari, $key->genap_sampai) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: orange;">
						<p>Izin</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 3, $key->genap_dari, $key->genap_sampai) ?? 0 ?></h5>
					</div>
					<div class="col-2 text-center" style="color: blue;">
						<p>Sakit</p>
						<h5><?= $this->absensi->count_absen($siswa['nis'], 4, $key->genap_dari, $key->genap_sampai) ?? 0 ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-success">
				<h3>Nilai</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2 d-flex align-items-start">
						<i class="las la-clipboard-list icon-home bg-success text-light"></i>
					</div>
					<div class="col-10">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th scope="row" width="200px">Nilai Tugas</th>
										<td>20</td>
									</tr>
									<tr>
										<th scope="row" width="200px">Ulangan Harian</th>
										<td>20</td>
										<td>20</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-4">
		<div class="card">
			<div class="card-header text-center text-warning">
				<h3>Pembayaran</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2 d-flex align-items-start">
						<i class="las la-dollar-sign  icon-home bg-warning text-light"></i>
					</div>
					<div class="col-10">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th scope="row" width="200px">SPP</th>
										<td><a class="btn btn-success btn-sm"><i class="fas fa-check text-light"></i></a></td>
									</tr>
									<tr>
										<th scope="row" width="200px">LKS Semester</th>
										<td><a class="btn btn-danger btn-sm"><i class="fas fa-times text-light"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endforeach ?>
