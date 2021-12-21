<div class="card">
	<div class="card-header  font-weight-bold mr-auto">
		<!-- JavaScript Validation -->
	</div>
	<div class="card-content">
		<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" novalidate>
			<div class="card-body">
				<div class="form-group">
					<label for="nama">Nama User</label>
					<input type="name" class="form-control" id="nama" name="nama" require="">
					<input type="hidden" class="form-control" id="sekolah" name="sekolah" require="">
					<div class="invalid-feedback">
						Masukkan Kelas
					</div>
				</div>
				<div class="form-group">
					<label>Username User</label>
					<input type="text" class="form-control" id="username" name="username" required="" value="<?= isset($data['username']) ? $data['username'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Username
					</div>
					<span class="text-danger"><?= form_error('username') ?></span>
				</div>
				<div class="form-group">
					<label>Email User</label>
					<input type="email" class="form-control" name="email" required="" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Email
					</div>
					<span class="text-danger"><?= form_error('email') ?></span>
				</div>
				<!-- <div>
					<div class="form-group mt-4">
						<label>Role User</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="role" id="guru" value="guru" <?= isset($data['role']) && $data['role'] == "Guru" ? "checked" : '' ?>>
						<label class="form-check-label" for="kandung">Guru</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="role" id="admin" value="admin" <?= isset($data['role']) && $data['role'] == "admin" ? "checked" : '' ?>>
						<label class="form-check-label" for="angkat">Admin</label>
					</div>
				</div> -->
				<div class="card-footer mt-4 text-right">
					<input type="hidden" name="role" value="admin">
					<input type="hidden" name="id_admin" value="<?= isset($data['id_admin']) ? $data['id_admin'] : '' ?>">
					<button class="btn btn-primary"><?= explode(" ", $title)[0] != "Edit" ? "Simpan" : "Update" ?></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>

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
		$("#show_hide_password a").on('click', function(event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("fa-eye-slash");
				$('#show_hide_password i').removeClass("fa-eye");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("fa-eye-slash");
				$('#show_hide_password i').addClass("fa-eye");
			}
		});
		$("#show_hide_re_password a").on('click', function(event) {
			event.preventDefault();
			if ($('#show_hide_re_password input').attr("type") == "text") {
				$('#show_hide_re_password input').attr('type', 'password');
				$('#show_hide_re_password i').addClass("fa-eye-slash");
				$('#show_hide_re_password i').removeClass("fa-eye");
			} else if ($('#show_hide_re_password input').attr("type") == "password") {
				$('#show_hide_re_password input').attr('type', 'text');
				$('#show_hide_re_password i').removeClass("fa-eye-slash");
				$('#show_hide_re_password i').addClass("fa-eye");
			}
		});
	});

	$(document).ready(function() {
		$("#nama").autocomplete({
			serviceUrl: "<?= base_url('admin/add_data') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#nama").val(suggestion.value);
				$("#sekolah	").val(suggestion.data);
			}
		});
	})
</script>
