<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
			<?php if ($this->session->userdata('role') == 'admin') {
				echo '<button data-toggle="modal" data-target="#kelasModal" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</button>';
			} ?>
		</div>
	</div>
	<div class="card-content">
		<div class="card-body">
			<!-- Table with outer spacing -->
			<div class="table-responsive">
				<table class="table table-bordered" id="table" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Kelas</th>
							<th>Wali Kelas</th>
							<th>Tahun Ajaran</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kelasModalLabel">Tambah Kelas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('kelas/add') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kelas">Nama Kelas</label>
						<input type="name" class="form-control" id="nama_kelas" name="nama_kelas" require="">
						<div class="invalid-feedback">
							Masukkan Kelas
						</div>
					</div>
					<div class="form-group">
						<label>Wali Kelas</label>
						<select class="form-control" data-style="btn-default" id="wali_kelas" name="wali_kelas" required="" data-live-search="true">
							<option value="">Pilih Wali Kelas</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<select class="form-control" data-style="btn-default" id="tahun_ajaran" name="tahun_ajaran" required="" data-live-search="true">
							<option value="">Pilih Tahun Ajaran</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="kelasEditModal" tabindex="-1" role="dialog" aria-labelledby="kelasEditModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kelasEditModalLabel">Edit Kelas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('kelas/edit') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kelas_edit">Nama Kelas</label>
						<input type="name" class="form-control" id="nama_kelas_edit" name="nama_kelas_edit" require="">
						<div class="invalid-feedback">
							Masukkan Kelas
						</div>
					</div>
					<div class="form-group">
						<label>Wali Kelas</label>
						<select class="form-control" data-style="btn-default" id="wali_kelas_edit" name="wali_kelas_edit" required="" data-live-search="true">
							<option value="">Pilih Wali Kelas</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<select class="form-control" data-style="btn-default" id="tahun_ajaran_edit" name="tahun_ajaran_edit" required="" data-live-search="true">
							<option value="">Pilih Tahun Ajaran</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_kelas_edit" id="id_kelas_edit">
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.autocomplete.min.js"></script>

<script>
	$(document).ready(function() {
		$.get("<?= base_url('/kelas/add_data') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#wali_kelas').append('<option value="' + e.data + '">' + e.value + '</option>');
			});
			$('#wali_kelas').selectpicker();
		});

		$.get("<?= base_url('/kelas/add_tahun') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#tahun_ajaran').append('<option value="' + e.data + '">' + e.value + '</option>');
			});
			$('#tahun_ajaran').selectpicker();
		});

	})

	$(document).on("click", ".edit-modal", function() {
		var id_kelas = $(this).data('id');
		$(".modal-footer #id_kelas_edit").val(id_kelas);
		var nama_kelas = $(this).data('kelas');
		$(".modal-body #nama_kelas_edit").val(nama_kelas);

		var wali_kelas_id = $(this).data('wali_id');

		$.get("<?= base_url('/kelas/add_data') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				if (e.data == wali_kelas_id) {
					$('#wali_kelas_edit').append('<option value="' + e.data + '" selected>' + e.value + '</option>');
				} else {
					$('#wali_kelas_edit').append('<option value="' + e.data + '">' + e.value + '</option>');
				}
			});
			$('#wali_kelas_edit').selectpicker();
		});

		var tahun_id = $(this).data('tahun_id');

		$.get("<?= base_url('/kelas/add_tahun') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				if (e.data == tahun_id) {
					$('#tahun_ajaran_edit').append('<option value="' + e.data + '" selected>' + e.value + '</option>');
				} else {
					$('#tahun_ajaran_edit').append('<option value="' + e.data + '">' + e.value + '</option>');
				}
			});
			$('#tahun_ajaran_edit').selectpicker();
		});
	});
</script>