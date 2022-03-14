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
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
						<textarea rows="2" class="form-control" id="subject" name="subject"></textarea>
						<div class="invalid-feedback">
							Masukkan Keterangan Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">File Laporan</label>
						<div class="row" id="files">
							<div class="col-11 mx-2" id="file">
								<div class="custom-file" style="margin-top: 14px;">
									<input type="file" class="custom-file-input" id="customFile">
									<label class="custom-file-label" id="custom-file-label" for="customFile">Choose file</label>
								</div>
								<div class="invalid-feedback">
									Masukkan File Laporan
								</div>
							</div>
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
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
						<textarea rows="2" class="form-control" id="edit_subject" name="subject"></textarea>
						<div class="invalid-feedback">
							Masukkan Keterangan Laporan
						</div>
					</div>
					<div class="form-group">
						<label for="nama_nilai">File Laporan</label>
						<div class="row" id="files">
							<div class="col-11 mx-2" id="fileEdit">
								<div class="custom-file" style="margin-top: 14px;">
									<input type="file" class="custom-file-input" id="customFileEdit">
									<label class="custom-file-label" id="custom-file-label" for="customFile">Choose file</label>
								</div>
								<div class="invalid-feedback">
									Masukkan File Laporan
								</div>
							</div>
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

<div class="modal fade" id="showPengawasModal" tabindex="-1" role="dialog" aria-labelledby="showPengawasModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="showPengawasModalLabel">Show Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="nama_nilai">File Laporan</label>
					<div class="row" id="files">
						<div class="col-12" id="fileShow">
						</div>
					</div>
				</div>
			</div>
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
		$('#files .file').remove()

		$.ajax({
			type: 'GET',
			url: "<?= base_url('/pengawas/get_edit/' . $index . '/') ?>" + id,
			cache: false,
			processData: false,
			contentType: false,
			success: function(res) {
				var data = JSON.parse(res);

				if (data.error != '' && data.error != undefined) {
					notifikasi(data.error, "danger", "fa fa-times")
				} else {
					$(".modal-footer #id").val(id);
					$(".modal-body #edit_title").val(data.data.title);
					$(".modal-body #edit_subject").val(data.data.subject);

					data.data.file.forEach(e => editFile(e));

					console.log(data);
					update.prop('disabled', false)
				}
			},
		});
	});

	var id = 0;

	function addFile(name) {
		var item = `
					<div class="col-4 file  mb-2" id="file-${id}">
						<div class="custom-file">
							<div class="btn-group" role="group" aria-label="First group">
							<form action="<?= base_url() . 'assets/file/laporan/' ?>${name}" target="_blank">
								<button type="submit" class="btn btn-primary">${name}</button>
							</form>
								<button type="button" class="btn btn-danger" onClick="removeItem(${id})"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<input type="hidden" id="customFile-filename" value="${name}" name="file[]">
					</div>`;

		$(item).insertBefore('#file');
		id++;
	}

	function editFile(name) {
		var item = `
					<div class="col-4 file mb-2" id="file-${id}">
						<div class="custom-file">
							<div class="btn-group" role="group" aria-label="First group">
							<form action="<?= base_url() . 'assets/file/laporan/' ?>${name}" target="_blank">
								<button type="submit" class="btn btn-primary">${name}</button>
							</form>
								<button type="button" class="btn btn-danger" onClick="removeItem(${id})"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<input type="hidden" id="customFile-filename" value="${name}" name="file[]">
					</div>`;

		$(item).insertBefore('#fileEdit');
		id++;
	}
	
	function showFile(name) {
		var item = `
					<div class="col-4 file mb-2" id="file-${id}">
						<div class="custom-file">
							<div class="btn-group" role="group" aria-label="First group">
							<form action="<?= base_url() . 'assets/file/laporan/' ?>${name}" target="_blank">
								<button type="submit" class="btn btn-primary">${name}</button>
							</form>
							</div>
						</div>
						<input type="hidden" id="customFile-filename" value="${name}" name="file[]">
					</div>`;

		$(item).insertBefore('#fileShow');
		id++;
	}

	function removeItem(id) {
		$('#file-' + id).remove();
	}

	$('#customFile').on('change', function(e) {
		var file = e.target.files[0];

		// $('#custom-file-label').html(file.name);
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
					addFile(data.file)
					// $('#customFile-filename').val(data.file);
					simpan.prop('disabled', false)
				}
			},
		});
	}

	$('#customFileEdit').on('change', function(e) {
		var file = e.target.files[0];

		// $('#custom-file-labelEdit').html(file.name);
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
					editFile(data.file)
					// $('#customFile-filenameEdit').val(data.file);
					update.prop('disabled', false)
				}
			},
		});
	}

	$(document).on("click", ".show-modal", function() {
		var id = $(this).data('id');
		$('#files .file').remove()

		$.ajax({
			type: 'GET',
			url: "<?= base_url('/pengawas/get_edit/' . $index . '/') ?>" + id,
			cache: false,
			processData: false,
			contentType: false,
			success: function(res) {
				var data = JSON.parse(res);

				if (data.error != '' && data.error != undefined) {
					notifikasi(data.error, "danger", "fa fa-times")
				} else {
					data.data.file.forEach(e => showFile(e));
					console.log(data)

					console.log(data);
					update.prop('disabled', false)
				}
			},
		});
	});
</script>
