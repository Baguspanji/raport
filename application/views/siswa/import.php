<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header  font-weight-bold mr-auto">
				<!-- JavaScript Validation -->
			</div>
			<div class="card-content">
				<div class="card-body">
					<?php echo form_open_multipart('siswa/import', array('name' => 'spreadsheet')); ?>
					<div class="form-group">
						<label>Data Siswa</label>
						<input type="file" class="form-control p-2" name="upload_file" required="">
						<div class="invalid-feedback">
							Masukkan NIS
						</div>
						<span class="text-danger"><?= form_error('nis') ?></span>
					</div>
					<div class="card-footer mt-2 text-right">
						<button type="submit" class="btn btn-primary">Import</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="card">
			<div class="card-header pr-5 pl-5 mt-2">
				<div class="row justify-content-between">
					<h4 class="card-title col-md-8"><?= $title ?> Sekolah ADMIN</h4>
					<div>
						<a href="<?= base_url() ?>siswa/add_cart" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</a>
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
									<th>Aksi</th>
									<th>No</th>
									<th>Nis</th>
									<th>NISN</th>
									<th>Nama Siswa</th>
									<th>Alamat</th>
									<th>Tempat Tanggal Lahir</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>
