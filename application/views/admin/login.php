<!doctype html>
<html lang="en">

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Sekolah Admin | Login Admin </title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/bootstrap/css/bootstrap.css">
	<!-- Style CSS (White)-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/White.css">
	<!-- Style CSS (Dark)-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/Dark.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/fontawesome/css/all.css">
	<!-- Icon LineAwesome CSS-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/lineawesome/css/line-awesome.min.css">

</head>

<body>

	<div class="auth-dark">
		<div class="theme-switch-wrapper">
			<label class="theme-switch" for="checkbox">
				<input type="checkbox" id="checkbox" title="Dark Or White" />
				<div class="slider round"></div>
			</label>
		</div>
	</div>

	<div class="container">
		<div class="row vh-100 d-flex justify-content-center align-items-center auth">
			<div class="col-md-7 col-lg-5">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-5">Masuk Sekolah Admin</h3>
						<form action="<?= base_url() ?>admin/login" method="post">
							<div class="form-group">
								<input type="text" name="user" class="form-control" placeholder="Username">
							</div>
							<div class="form-group">
								<div class="input-group" id="show_hide_password">
									<input type="password" class="form-control" name="pass" placeholder="Username">
									<div class="input-group-addon">
										<a href="#" class="btn btn-default ml-2 mt-1"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
									</div>
								</div>
								<span class="text-danger"><?= isset($error) ? $error : '' ?></span>
							</div>
							<div class="form-group my-4">
								<button type="submit" class="btn btn-primary btn-rounded px-5">Masuk</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Library Javascipt-->
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/js/script.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>

	<script>
		function notifikasi(pesan, tipe, ico = '') {
			$.notify({
				// options
				icon: ico,
				message: pesan,
			}, {
				// settings
				type: tipe,
				z_index: 9999
			});
		}

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
	});
	</script>

	<?php echo $this->session->flashdata('notifikasi'); ?>
</body>

</html>
