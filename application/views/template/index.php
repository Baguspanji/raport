<!doctype html>
<html lang="en">

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= 'Sekolah Admin | ' . $title ?></title>

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

	<link rel="stylesheet" href="<?= base_url() ?>assets/datatable/datatables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/datatable/button/css/buttons.dataTables.min.css">

	<style>
		.autocomplete-suggestions {
			border: 1px solid #999;
			background: #FFF;
			overflow: auto;
		}

		.autocomplete-suggestion {
			padding: 2px 5px;
			white-space: nowrap;
			overflow: hidden;
		}

		.autocomplete-selected {
			background: #F0F0F0;
		}

		.autocomplete-suggestions strong {
			font-weight: normal;
			color: #3399FF;
		}

		.autocomplete-group {
			padding: 2px 5px;
		}

		.autocomplete-group strong {
			display: block;
			border-bottom: 1px solid #000;
		}
	</style>

</head>

<body>

	<?php $this->load->view('template/sidebar') ?>

	<!--Content Start-->
	<div class="content transition">
		<div class="container-fluid dashboard">
			<div class="row">
				<div class="col-md-8">
					<h3><?= $title ?></h3>
				</div>
				<div class="col-md-4">
					<div class="opensource">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-custom">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<?php $this->load->view($konten) ?>

		</div>

	</div>

	<!-- Footer -->
	<div class="footer transition">
		<hr>
		<p>
			&copy; 2021 All Right Reserved by <a href="<?= base_url() ?>" target="_blank">Yudhartha Pasuruan</a>
		</p>
	</div>

	<!-- Loader -->
	<div class="loader">
		<div class="spinner-border text-primary" role="status">
		</div>
	</div>

	<div class="loader-overlay"></div>

	<!-- Library Javascipt-->
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/vendors/bootstrap/js/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/js/script.js"></script>

	<script src="<?= base_url() ?>assets/datatable/datatables.min.js"></script>
	<script src="<?= base_url() ?>assets/datatable/button/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url() ?>assets/datatable/button/js/buttons.print.min.js"></script>
	<script src="<?= base_url() ?>assets/datatable/button/js/buttons.flash.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.autocomplete.min.js"></script>

	<?php if (isset($url_tabel)) : ?>
		<script>
			$(document).ready(function() {
				$('#table').DataTable({
					"language": {
						"lengthMenu": "Tampil _MENU_ data",
						"zeroRecords": "Data tidak ditemukan",
						"info": "Halaman _PAGE_ dari _PAGES_",
						"infoEmpty": "Data tidak tersedia",
						"infoFiltered": "(filtered from _MAX_ total records)",
					},
					"ajax": '<?= base_url($url_tabel) ?>'
				});
			});
		</script>
	<?php endif ?>
	<?php if (isset($url_tabel_2)) : ?>
		<script>
			$(document).ready(function() {
				$('#table-2').DataTable({
					"language": {
						"lengthMenu": "Tampil _MENU_ data",
						"zeroRecords": "Data tidak ditemukan",
						"info": "Halaman _PAGE_ dari _PAGES_",
						"infoEmpty": "Data tidak tersedia",
						"infoFiltered": "(filtered from _MAX_ total records)",
					},
					"ajax": '<?= base_url($url_tabel_2) ?>'
				});
			});
		</script>
	<?php endif ?>
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
	</script>

	<?php echo $this->session->flashdata('notifikasi'); ?>
</body>

</html>
