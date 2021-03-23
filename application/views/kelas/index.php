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
						<label for="wali">Wali Kelas</label>
						<input type="name" class="form-control" id="wali" name="wali" require="">
						<input type="hidden" class="form-control" id="wali_kelas" name="wali_kelas" require="">
						<div class="invalid-feedback">
							Masukkan Kelas
						</div>
					</div>
					<div class="form-group">
						<label for="sem">Tahun Ajaran</label>
						<input type="name" class="form-control" id="tahun" name="tahun" require="">
						<input type="hidden" class="form-control" id="tahun_ajaran" name="tahun_ajaran" require="">
						<div class="invalid-feedback">
							Masukkan Tahun Ajaran
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
						<label for="nama_kelas_e">Nama Kelas</label>
						<input type="name" class="form-control" id="nama_kelas_e" name="nama_kelas_e" require="">
						<div class="invalid-feedback">
							Masukkan Kelas
						</div>
					</div>
					<div class="form-group">
						<label for="wali_e">Wali_e Kelas</label>
						<input type="name" class="form-control" id="wali_e" name="wali_e" require="">
						<input type="hidden" class="form-control" id="wali_kelas_e" name="wali_kelas_e" require="">
						<div class="invalid-feedback">
							Masukkan Kelas
						</div>
					</div>
				</div>
				<div class="modal-footer">
				<input type="hidden" name="id_kelas" id="id_kelas_e">
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
		$("#wali").autocomplete({
			serviceUrl: "<?= base_url('kelas/add_data') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#wali").val(suggestion.value);
				$("#wali_kelas").val(suggestion.data);
			}
		});

		$("#tahun").autocomplete({
			serviceUrl: "<?= base_url('kelas/add_tahun') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#tahun").val(suggestion.value);
				$("#tahun_ajaran").val(suggestion.data);
			}
		});
	})
</script>
