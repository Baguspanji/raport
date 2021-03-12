<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
		</div>
	</div>
	<div class="card-content">
		<div class="card-body">
			<!-- Table with outer spacing -->
			<div class="table-responsive">
				<table class="table table-bordered" id="table" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Kelas</th>
							<th>Wali Kelas</th>
							<th>Tahun Ajaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php foreach ($kelas as $key) : ?>
	<div class="modal fade" id="kelasModal<?= $key->id_kelas ?>" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="kelasModalLabel">Penilaian Siswa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table>
						<tbody>
							<?php foreach ($this->bayar->get_kelas($key->id_kelas) as $row) : ?>
								<tr>
									<th><a href="<?= base_url() . 'bayar/siswa/' . $key->id_kelas . '/' . $row->id_bayar ?>" class="btn btn-outline-info mb-2"> <?= $row->nama_bayar ?></a></th>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
