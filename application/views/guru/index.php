<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
			<div>
				<a href="<?= base_url() ?>guru/import" class="btn btn-google btn-sm"><i class="fas fa-paper-plane"></i> Import Data</a>
				<a href="<?= base_url() ?>guru/add" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</a>
			</div>
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
							<th>Nig</th>
							<th>Nama Guru</th>
							<th>Alamat</th>
							<th>Tempat Tanggal Lahir</th>
							<th>Status</th>
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
