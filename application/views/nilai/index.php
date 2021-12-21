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
							<th>Nama Nilai</th>
							<th>Tahun ajaran</th>
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
				<h5 class="modal-title" id="kelasModalLabel">Tambah Nilai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('nilai/add') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_nilai">Nama Nilai</label>
						<input type="name" class="form-control" id="nama_nilai" name="nama_nilai" require="">
						<div class="invalid-feedback">
							Masukkan Nama Nilai
						</div>
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
			<form class="needs-validation" action="<?= base_url('nilai/edit') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_nilai_edit">Nama Nilai</label>
						<input type="name" class="form-control" id="nama_nilai_edit" name="nama_nilai_edit" require="">
						<div class="invalid-feedback">
							Masukkan Nama Nilai
						</div>
					</div>
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<select class="form-control" data-style="btn-default" id="tahun_ajaran_edit" name="tahun_ajaran_edit" required="" data-live-search="true">
							<option value="">Pilih Tahun Ajaran</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_nilai_edit" id="id_nilai_edit">
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
		$.get("<?= base_url('/nilai/add_tahun') ?>", function(res, status) {
			var data = JSON.parse(res);
			data.forEach(e => {
				$('#tahun_ajaran').append('<option value="' + e.data + '">' + e.value + '</option>');
			});
			$('#tahun_ajaran').selectpicker();
		});
	})

	$(document).on("click", ".edit-modal", function() {
		var id_nilai = $(this).data('id');
		$(".modal-footer #id_nilai_edit").val(id_nilai);
		var nama_nilai = $(this).data('nilai');
		$(".modal-body #nama_nilai_edit").val(nama_nilai);

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