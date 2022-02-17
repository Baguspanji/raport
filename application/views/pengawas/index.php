<?php
$role = $this->session->userdata('role');
?>

<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title col-md-8"><?= $title ?></h4>
			<?php if ($role == 'admin') { ?>
				<button data-toggle="modal" data-target="#pengawasModal" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</button>
			<?php } ?>
		</div>
	</div>
	<div class="card-content">
		<div class="card-body">
			<!-- Table with outer spacing -->
			<div class="table-responsive">
				<table class="table table-bordered" id="table" style="width:100%">
					<thead class="text-center">
						<tr>
							<th>No</th>
							<th>Judul</th>
							<th>Keterangan</th>
							<th>Tanggal</th>
							<th>File</th>
							<?php if ($role == 'admin') { ?>
								<th>Status</th>
								<th>Aksi</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="pengawasModal" tabindex="-1" role="dialog" aria-labelledby="pengawasModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="pengawasModalLabel">Tambah Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('pengawas/add/' . $index) ?>" method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_nilai">Judul Laporan</label>
						<input type="name" class="form-control" id="title" name="title" require="">
						<div class="invalid-feedback">
							Masukkan Judul Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">Keterangan Laporan</label>
						<input type="name" class="form-control" id="subject" name="subject" require="">
						<div class="invalid-feedback">
							Masukkan Keterangan Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">File Laporan</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile">
							<label class="custom-file-label" id="custom-file-label" for="customFile">Choose file</label>
						</div>
						<input type="hidden" id="customFile-filename" name="file">
						<div class="invalid-feedback">
							Masukkan File Laporan
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editPengawasModal" tabindex="-1" role="dialog" aria-labelledby="editPengawasModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editPengawasModalLabel">Edit Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('pengawas/edit/' . $index) ?>" method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_nilai">Judul Laporan</label>
						<input type="name" class="form-control" id="edit_title" name="title" require="">
						<div class="invalid-feedback">
							Masukkan Judul Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">Keterangan Laporan</label>
						<input type="name" class="form-control" id="edit_subject" name="subject" require="">
						<div class="invalid-feedback">
							Masukkan Keterangan Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">File Laporan</label>
						<div class="custom-file">
							<input type="file" class="custom-file-inputEdit" id="customFileEdit">
							<label class="custom-file-label" id="custom-file-labelEdit" for="customFileEdit">Choose file</label>
						</div>
						<input type="hidden" id="customFile-filenameEdit" name="file">
						<div class="invalid-feedback">
							Masukkan File Laporan
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id">
					<button type="submit" class="btn btn-warning" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>

<script>
	var simpan = $('#simpan')
	simpan.prop('disabled', true)
	var update = $('#update')
	update.prop('disabled', true)

	$(document).on("click", ".edit-modal", function() {
		var id = $(this).data('id');
		$(".modal-footer #id").val(id);
		var title = $(this).data('title');
		$(".modal-body #edit_title").val(title);
		var subject = $(this).data('subject');
		$(".modal-body #edit_subject").val(subject);
		var file = $(this).data('file');
		$('.modal-body #custom-file-labelEdit').html(file);
		$('.modal-body #customFile-filenameEdit').val(file);
		update.prop('disabled', false)

	});

	$('#customFile').on('change', function(e) {
		var file = e.target.files[0];

		$('#custom-file-label').html(file.name);
		file_upload(file);
	});

	function file_upload(file) {
		var formData = new FormData();
		formData.append("file", file);
		$.ajax({
			type: 'POST',
			url: "<?= base_url('/pengawas/upload_file') ?>",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(res) {
				var data = JSON.parse(res);

				if (data.error != '' && data.error != undefined) {
					notifikasi(data.error, "danger", "fa fa-times")
				} else {
					$('#customFile-filename').val(data.file);
					simpan.prop('disabled', false)
				}
			},
		});
	}

	$('#customFileEdit').on('change', function(e) {
		var file = e.target.files[0];

		$('#custom-file-labelEdit').html(file.name);
		file_uploadEdit(file);
	});

	function file_uploadEdit(file) {
		var formData = new FormData();
		formData.append("file", file);
		$.ajax({
			type: 'POST',
			url: "<?= base_url('/pengawas/upload_file') ?>",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(res) {
				var data = JSON.parse(res);

				if (data.error != '' && data.error != undefined) {
					notifikasi(data.error, "danger", "fa fa-times")
				} else {
					$('#customFile-filenameEdit').val(data.file);
					update.prop('disabled', false)
				}
			},
		});
	}
</script>
