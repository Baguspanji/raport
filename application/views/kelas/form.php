<div class="card">
	<div class="card-header  font-weight-bold mr-auto">
		<!-- JavaScript Validation -->
	</div>
	<div class="card-content">
		<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" novalidate>
			<div class="modal-body">
				<div class="form-group">
					<label for="nama_kelas">Nama Kelas</label>
					<input type="name" class="form-control" id="nama_kelas" name="nama_kelas" require="">
					<div class="invalid-feedback">
						Masukkan Kelas
					</div>
				</div>
				<div class="form-group">
					<label for="wali_kelas">Wali Kelas</label>
					<input type="name" class="form-control" id="wali_kelas" name="wali_kelas" require="">
					<div class="invalid-feedback">
						Masukkan Kelas
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.autocomplete.min.js"></script>

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

	$(document).ready(function() {
		$("#wali_kelas").autocomplete({
			serviceUrl: "<?= base_url('kelas/add_data') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#wali_kelas").val(suggestion.nama);
			}
		});
	})
</script>
