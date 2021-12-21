<div class="card">
	<div class="card-header pr-5 pl-5 mt-2">
		<div class="row justify-content-between">
			<h4 class="card-title"><?= $title ?> Sekolah ADMIN</h4>
			<button data-toggle="modal" data-target="#tahunModal" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah Data</button>
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
							<th>Tahun Ajaran</th>
							<th>Semester Ganjil</th>
							<th>Semester Genap</th>
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

<div class="modal fade" id="tahunModal" tabindex="-1" role="dialog" aria-labelledby="tahunModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tahunModalLabel">Tambah Tahun Ajaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('tahun/add') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="tahun_ajaran">Tahun Ajaran</label>
						<input type="name" class="form-control" id="tahun_ajaran" name="tahun_ajaran" require="">
						<div class="invalid-feedback">
							Masukkan Tahun
						</div>
					</div>
					<div class="form-group">
						<label for="tahun_ajaran">Tahun Ajaran Ganjil</label>
						<div class="row justify-content-around">
							<input type="date" class="form-control col-5" id="ganjil_dari" name="ganjil_dari" require="">
							<input type="date" class="form-control col-5" id="ganjil_sampai" name="ganjil_sampai" require="">
						</div>
						<div class="invalid-feedback">
							Masukkan Tahun
						</div>
					</div>
					<div class="form-group">
						<label for="tahun_ajaran">Tahun Ajaran Genap</label>
						<div class="row justify-content-around">
							<input type="date" class="form-control col-5" id="genap_dari" name="genap_dari" require="">
							<input type="date" class="form-control col-5" id="genap_sampai" name="genap_sampai" require="">
						</div>
						<div class="invalid-feedback">
							Masukkan Tahun
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

<div class="modal fade" id="tahunEditModal" tabindex="-1" role="dialog" aria-labelledby="tahunEditModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tahunEditModalLabel">Edit Tahun Ajaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="needs-validation" action="<?= base_url('tahun/edit') ?>" method="post" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="tahun_ajaran_edit">Tahun Ajaran</label>
						<input type="name" class="form-control" id="tahun_ajaran_edit" name="tahun_ajaran_edit" require="">
						<div class="invalid-feedback">
							Masukkan Tahun
						</div>
					</div>
					<div class="form-group">
						<label for="tahun_ajaran">Tahun Ajaran Ganjil</label>
						<div class="row justify-content-around">
							<input type="date" class="form-control col-5" id="ganjil_dari_edit" name="ganjil_dari_edit" require="">
							<input type="date" class="form-control col-5" id="ganjil_sampai_edit" name="ganjil_sampai_edit" require="">
						</div>
						<div class="invalid-feedback">
							Masukkan Tahun
						</div>
					</div>
					<div class="form-group">
						<label for="tahun_ajaran">Tahun Ajaran Genap</label>
						<div class="row justify-content-around">
							<input type="date" class="form-control col-5" id="genap_dari_edit" name="genap_dari_edit" require="">
							<input type="date" class="form-control col-5" id="genap_sampai_edit" name="genap_sampai_edit" require="">
						</div>
						<div class="invalid-feedback">
							Masukkan Tahun
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_tahun_edit" id="id_tahun_edit">
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
		var id_tahun = $(this).data('id');
		$(".modal-footer #id_tahun_edit").val(id_tahun);
		var nama_nilai = $(this).data('nilai');
		$(".modal-body #nama_nilai_edit").val(nama_nilai);
		var tahun = $(this).data('tahun');
		$(".modal-body #tahun_ajaran_edit").val(tahun);
		var ganjil_dari = $(this).data('ganjildr');
		$(".modal-body #ganjil_dari_edit").val(ganjil_dari);
		var ganjil_sampai = $(this).data('ganjilsmp');
		$(".modal-body #ganjil_sampai_edit").val(ganjil_sampai);
		var genap_dari = $(this).data('genapdr');
		$(".modal-body #genap_dari_edit").val(genap_dari);
		var genap_sampai = $(this).data('genapsmp');
		$(".modal-body #genap_sampai_edit").val(genap_sampai);
	});
</script>
