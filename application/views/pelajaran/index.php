<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
			<button data-toggle="modal" data-target="#pelajaranModal" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</button>
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
							<th>Mata Pelajaran</th>
							<th>Kelas</th>
							<th>Nilai Minim</th>
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

<div class="modal fade" id="pelajaranModal" tabindex="-1" role="dialog" aria-labelledby="pelajaranModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="pelajaranModalLabel">Tambah Mata Pelajaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('pelajaran/add') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_pelajaran">Mata Pelajaran</label>
						<input type="name" class="form-control" id="nama_pelajaran" name="nama_pelajaran" require="">
						<div class="invalid-feedback">
							Masukkan Mata Pelajaran
						</div>
					</div>
					<div class="form-group">
						<label for="nilai_minim">Nilai Minim</label>
						<input type="number" class="form-control" id="nilai_minim" name="nilai_minim" require="">
						<div class="invalid-feedback">
							Masukkan Nilai Minim
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="pelajaranEditModal" tabindex="-1" role="dialog" aria-labelledby="pelajaranEditModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="pelajaranEditModalLabel">Tambah Mata Pelajaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('pelajaran/edit') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_pelajaran_edit">Mata Pelajaran</label>
						<input type="name" class="form-control" id="nama_pelajaran_edit" name="nama_pelajaran_edit" require="">
						<div class="invalid-feedback">
							Masukkan Mata Pelajaran
						</div>
					</div>
					<div class="form-group">
						<label for="nilai_minim_edit">Nilai Minim</label>
						<input type="number" class="form-control" id="nilai_minim_edit" name="nilai_minim_edit" require="">
						<div class="invalid-feedback">
							Masukkan Nilai Minim
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_pelajaran_edit" id="id_pelajaran_edit">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.autocomplete.min.js"></script>

<script>
	$(document).on("click", ".edit-modal", function() {
		var id_pelajaran = $(this).data('id');
		$(".modal-footer #id_pelajaran_edit").val(id_pelajaran);
		var nama_pelajaran = $(this).data('pelajaran');
		$(".modal-body #nama_pelajaran_edit").val(nama_pelajaran);
		var nilai = $(this).data('nilai');
		$(".modal-body #nilai_minim_edit").val(nilai);
	});
</script>
