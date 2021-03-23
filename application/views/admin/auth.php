<div class="card overflow-hidden">
	<div class="row no-gutters row-bordered row-border-light">
		<div class="col-md-3 pt-0">
			<div class="list-group list-group-flush account-settings-links">
				<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="tab-content">
				<div class="tab-pane fade active show" id="account-general">
					<h4 class="mt-4 ml-4 text-left">Informasi User</h4>

					<div class="card-body">
						<div class="card-body">
							<div class="form-group">
								<label>Username Guru</label>
								<input type="text" class="form-control" name="username" required="" readonly value="<?= isset($data['username']) ? $data['username'] : '' ?>">
								<div class="invalid-feedback">
									Masukkan Username
								</div>
								<span class="text-danger"><?= form_error('username') ?></span>
							</div>
							<div class="form-group">
								<label>Email Guru</label>
								<input type="email" class="form-control" name="email" required="" readonly value="<?= isset($data['email']) ? $data['email'] : '' ?>">
								<div class="invalid-feedback">
									Masukkan Email
								</div>
								<span class="text-danger"><?= form_error('email') ?></span>
							</div>
							<div class="form-group">
								<label>Nama Guru</label>
								<input type="text" class="form-control" name="nama" required="" readonly value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
								<div class="invalid-feedback">
									Masukkan Email
								</div>
								<span class="text-danger"><?= form_error('email') ?></span>
							</div>
						</div>

					</div>
				</div>

				<div class="tab-pane fade" id="account-change-password">
					<h4 class="mt-4 ml-4 text-left">Ubah Password</h4>

					<div class="card-body pb-2">

						<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" novalidate>
							<div class="card-body">
								<div class="form-group">
									<label>Password user</label>
									<div class="input-group" id="show_hide_password">
										<input type="password" class="form-control" name="password" required="">
										<div class="input-group-addon">
											<a href="#" class="btn btn-default ml-2 mt-1"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
										</div>
										<div class="invalid-feedback">
											Masukkan Password user
										</div>
									</div>
									<span class="text-danger"><?= isset($error) ? $error : '' ?></span>
									<span class="text-danger"><?= form_error('password') ?></span>
								</div>
								<div class="form-group">
									<label>Ulang Password user</label>
									<div class="input-group" id="show_hide_re_password">
										<input type="password" class="form-control" name="re-password" required="">
										<div class="input-group-addon">
											<a href="#" class="btn btn-default ml-2 mt-1"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
										</div>
										<div class="invalid-feedback">
											Masukkan Ulang Password user
										</div>
									</div>
									<span class="text-danger"><?= isset($error) ? $error : '' ?></span>
									<span class="text-danger"><?= form_error('password') ?></span>
								</div>
								<div class="card-footer mt-4 text-right">
									<input type="hidden" name="id_admin" value="<?= isset($data['id_admin']) ? $data['id_admin'] : '' ?>">
									<button class="btn btn-primary">Update</button>
								</div>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
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
</script>
