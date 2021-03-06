<div class="card">
	<div class="card-header  font-weight-bold mr-auto">
		<!-- JavaScript Validation -->
	</div>
	<div class="card-content">
		<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" novalidate>
			<div class="card-body">
				<div class="form-group">
					<label>NIP Pekerja</label>
					<input type="number" class="form-control" name="nip" required="" value="<?= isset($data['nip']) ? $data['nip']: '' ?>">
					<div class="invalid-feedback">
						Masukkan NIP
					</div>
					<span class="text-danger"><?= form_error('nip') ?></span>
				</div>
				<div class="form-group">
					<label>Nama Pekerja</label>
					<input type="text" class="form-control" name="nama" required="" value="<?= isset($data['nama']) ? $data['nama']: '' ?>">
					<div class="invalid-feedback">
						Masukkan Nama
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Pekerja</label>
					<input type="text" class="form-control" name="alamat" required="" value="<?= isset($data['alamat']) ? $data['alamat']: '' ?>">
					<div class="invalid-feedback">
						Masukkan Kelas
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label>Tempat Tanggal Lahir Pekerja</label>
						<input type="text" class="form-control" name="tempat_lahir" required="" value="<?= isset($data['tempat_lahir']) ? $data['tempat_lahir']: '' ?>">
						<div class="invalid-feedback">
							Masukkan Tempat Lahir
						</div>
					</div>
					<div class="form-group col-md-3">
						<label>Tempat Tanggal Lahir Pekerja</label>
						<input type="date" class="form-control" name="tanggal_lahir" required="" value="<?= isset($data['tanggal_lahir']) ? $data['tanggal_lahir']: '' ?>">
						<div class="invalid-feedback">
							Masukkan Tanggal Lahir
						</div>
					</div>
				</div>
				<div class="card-footer mt-2 text-right">
					<input type="hidden" name="id_pekerja" value="<?= isset($data['id_pekerja']) ? $data['id_pekerja']: '' ?>">
					<button class="btn btn-primary"><?= explode(" ", $title)[0] != "Edit" ? "Simpan" : "Update" ?></button>
				</div>
			</div>
		</form>
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
