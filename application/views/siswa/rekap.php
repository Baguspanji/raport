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
							<table>
								<tbody>
									<?php foreach ($this->nilai->get_pelajaran($key->id_kelas) as $row) : ?>
										<tr>
											<th><button type="button" class="open-Dialog btn btn-outline-success mb-2" data-toggle="modal" data-target="#nilaiGanjilModal-<?= $row->id_pelajaran . '-' . $key->id_kelas ?>"> <?= $row->nama_pelajaran ?></button></th>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php foreach ($this->nilai->get_pelajaran($key->id_kelas) as $row) : ?>
		<div class="modal fade" id="nilaiGanjilModal-<?= $row->id_pelajaran . '-' . $key->id_kelas ?>" tabindex="-1" role="dialog" aria-labelledby="nilaiGanjilModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="nilaiGanjilModalLabel">Nilai <?= $row->nama_pelajaran ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<?php foreach ($this->nilai->get_kelas($key->id_kelas) as $list) : ?>
										<tr>
											<th scope="row" width="200px"><?= $list->nama_nilai ?></th>
											<?php foreach ($this->nilai->get_nilai_siswa($siswa['nis'], $list->id_nilai, $row->id_pelajaran, $key->ganjil_dari, $key->ganjil_sampai) as $keys) {
												if ($keys->nilai <= $this->nilai->get_bypelajaran($key->id_kelas)['nilai_minim']) {
													echo '<td><button type="button" class="btn btn-sm btn-danger">' . $keys->nilai . '</button></td>';
												} else {
													echo '<td><button type="button" class="btn btn-sm btn-success">' . $keys->nilai . '</button></td>';
												}
											} ?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>

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
									<?php foreach ($this->bayar->get_kelas($key->id_kelas, 1) as $list) : ?>
										<tr>
											<th scope="row" width="200px"><?= $list->nama_bayar ?></th>
											<td> <?= $this->bayar->get_siswa($siswa['nis'], $list->id_bayar, $key->ganjil_dari, $key->ganjil_sampai, 1) != null ? '<a class="btn btn-success btn-sm"><i class="fas fa-check text-light"></i></a>' : '<a class="btn btn-danger btn-sm"><i class="fas fa-times text-light"></i></a>' ?>

											</td>
										</tr>
									<?php endforeach ?>
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
							<table>
								<tbody>
									<?php foreach ($this->nilai->get_pelajaran($key->id_kelas) as $row) : ?>
										<tr>
											<th><button type="button" class="open-Dialog btn btn-outline-success mb-2" data-toggle="modal" data-target="#nilaiGenapModal-<?= $row->id_pelajaran . '-' . $key->id_kelas ?>"> <?= $row->nama_pelajaran ?></button></th>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php foreach ($this->nilai->get_pelajaran($key->id_kelas) as $row) : ?>
		<div class="modal fade" id="nilaiGenapModal-<?= $row->id_pelajaran . '-' . $key->id_kelas ?>" tabindex="-1" role="dialog" aria-labelledby="nilaiGenapModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="nilaiGenapModalLabel">Nilai <?= $row->nama_pelajaran ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<?php foreach ($this->nilai->get_kelas($key->id_kelas) as $list) : ?>
										<tr>
											<th scope="row" width="200px"><?= $list->nama_nilai ?></th>
											<?php foreach ($this->nilai->get_nilai_siswa($siswa['nis'], $list->id_nilai, $row->id_pelajaran, $key->genap_dari, $key->genap_sampai) as $keys) {
												if ($keys->nilai <= $this->nilai->get_bypelajaran($key->id_kelas)['nilai_minim']) {
													echo '<td><button type="button" class="btn btn-sm btn-danger">' . $keys->nilai . '</button></td>';
												} else {
													echo '<td><button type="button" class="btn btn-sm btn-success">' . $keys->nilai . '</button></td>';
												}
											} ?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>

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
									<?php foreach ($this->bayar->get_kelas($key->id_kelas, 2) as $list) : ?>
										<tr>
											<th scope="row" width="200px"><?= $list->nama_bayar ?></th>
											<td> <?= $this->bayar->get_siswa($siswa['nis'], $list->id_bayar, $key->genap_dari, $key->genap_sampai, 2) != null ? '<a class="btn btn-success btn-sm"><i class="fas fa-check text-light"></i></a>' : '<a class="btn btn-danger btn-sm"><i class="fas fa-times text-light"></i></a>' ?>

											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endforeach ?>
