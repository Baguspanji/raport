<div class="card">
	<div class="card-header  font-weight-bold mr-auto">
		<!-- JavaScript Validation -->
	</div>
	<div class="card-content">
		<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" novalidate>
			<div class="card-body">
				<div class="form-group">
					<label>Nama User</label>
					<select class="form-control" data-style="btn-default" id="nama" name="nama" required="" data-live-search="true">
						<option value="">Pilih User</option>
					</select>
				</div>
				<div class="form-group">
					<label>Username User</label>
					<input type="text" class="form-control" id="username" name="username" required="" readonly value="<?= isset($data['username']) ? $data['username'] : '' ?>">
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
					<input type="hidden" name="role" value="guru">
					<input type="hidden" name="id_admin" value="<?= isset($data['id_admin']) ? $data['id_admin'] : '' ?>">
					<button class="btn btn-primary"><?= explode(" ", $title)[0] != "Edit" ? "Simpan" : "Update" ?></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>

<script>
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
			serviceUrl: "<?= base_url('user/add_data') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#nama").val(suggestion.value);
				$("#username").val(suggestion.nip);
			}
		});

		$('#nama').on('change', function() {

			var user = $('#nama').val();

			$.get("<?= base_url('/user/add_data') ?>", function(res, status) {
				var data = JSON.parse(res);
				data.forEach(e => {
					if (e.value == user) {
						$("#username").val(e.nip);
					}
				});
			});

		});

		$.get("<?= base_url('/user/add_data') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#nama').append('<option value="' + e.value + '">' + e.value + '</option>');
			});
			$('#nama').selectpicker();
		});

	})
</script>