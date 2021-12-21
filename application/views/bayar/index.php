<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
			<button data-toggle="modal" data-target="#kelasModal" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</button>
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
							<th>Nama Pembayaran</th>
							<th>Tahun Ajaran</th>
							<th>Semester</th>
							<th>Kelas</th>
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
				<h5 class="modal-title" id="kelasModalLabel">Tambah Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('bayar/add') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_bayar">Nama Pembayaran</label>
						<input type="name" class="form-control" id="nama_bayar" name="nama_bayar" require="">
						<div class="invalid-feedback">
							Masukkan Nama Pembayaran
						</div>
					</div>
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<select class="form-control" data-style="btn-default" id="tahun_ajaran" name="tahun_ajaran" required="" data-live-search="true">
							<option value="">Pilih Tahun Ajaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Semester</label>
						<select class="form-control" data-style="btn-default" id="set_semester" name="set_semester" required="">
							<option value="">Pilih Semester</option>
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
			<form class="needs-validation" action="<?= base_url('bayar/edit') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_bayar_edit">Nama Pembayaran</label>
						<input type="name" class="form-control" id="nama_bayar_edit" name="nama_bayar_edit" require="">
						<div class="invalid-feedback">
							Masukkan Nama Pembayaran
						</div>
					</div>
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<select class="form-control" data-style="btn-default" id="tahun_ajaran_edit" name="tahun_ajaran_edit" required="" data-live-search="true">
							<option value="">Pilih Tahun Ajaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Semester</label>
						<select class="form-control" data-style="btn-default" id="set_semester_edit" name="set_semester_edit" required="">
							<option value="">Pilih Semester</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_bayar_edit" id="id_bayar_edit">
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
		$.get("<?= base_url('/bayar/add_tahun') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#tahun_ajaran').append('<option value="' + e.data + '">' + e.value + '</option>');
			});
			$('#tahun_ajaran').selectpicker();
		});
		
		$.get("<?= base_url('/bayar/add_semester') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#set_semester').append('<option value="' + e.data + '">' + e.value + '</option>');
			});
			$('#set_semester').selectpicker();
		});

	})

	$(document).on("click", ".edit-modal", function() {
		var id_bayar = $(this).data('id');
		$(".modal-footer #id_bayar_edit").val(id_bayar);
		var nama_bayar = $(this).data('bayar');
		$(".modal-body #nama_bayar_edit").val(nama_bayar);

		var tahun_id = $(this).data('tahun_id');

		$.get("<?= base_url('/bayar/add_tahun') ?>", function(res, status) {
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
		
		var semester_id = $(this).data('semester_id');

		$.get("<?= base_url('/bayar/add_semester') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				if (e.data == semester_id) {
					$('#set_semester_edit').append('<option value="' + e.data + '" selected>' + e.value + '</option>');
				} else {
					$('#set_semester_edit').append('<option value="' + e.data + '">' + e.value + '</option>');
				}
			});
			$('#set_semester_edit').selectpicker();
		});
	});
</script>