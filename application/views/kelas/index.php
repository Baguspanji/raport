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
							<th>Nama Kelas</th>
							<th>Wali Kelas</th>
							<th>Semester</th>
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
						<label for="sem">Semester</label>
						<input type="name" class="form-control" id="sem" name="sem" require="">
						<input type="hidden" class="form-control" id="semester" name="semester" require="">
						<div class="invalid-feedback">
							Masukkan Semester
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

		$("#wali").autocomplete({
			serviceUrl: "<?= base_url('kelas/add_data') ?>",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#wali").val(suggestion.value);
				$("#wali_kelas").val(suggestion.data);
			}
		});

		var semseter = [
            { value: 'Semester Ganjil', data: '1' },
            { value: 'Semester Genap', data: '2' },
        ];

        // Selector input yang akan menampilkan autocomplete.
        $( "#sem" ).autocomplete({
			lookup: semseter,
			onSelect: function(semseter) {
				$("#sem").val(semseter.value);
				$("#semester").val(semseter.data);
			}
        });
	})
</script>
