<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title col-md-8"><?= $title ?> Sekolah ADMIN</h4>
			<div>
				<?php if (explode(" ", $title)[0] == "Daftar") : ?>
					<a href="<?= base_url() ?>sekolah/add" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</a>
				<?php endif ?>
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
							<th>Nama Sekolah</th>
							<th>Alamat Sekolah</th>
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
