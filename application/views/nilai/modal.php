<div class="modal fade" id="nilaiModal" tabindex="-1" role="dialog" aria-labelledby="nilaiModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="nilaiModalLabel">Tambah Nilai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url() ?>nilai/add_nilai" method="post">
					<input type="hidden" class="form-control" name="nis" id="nis" value="">
					<input type="hidden" class="form-control" name="nilai_id" id="nilai" value="">
					<input type="hidden" class="form-control" name="pelajaran_id" id="pelajaran" value="">
					<div class="form-group">
						<label for="nilai" class="col-form-label">Nilai</label>
						<input type="text" class="form-control" name="nilai">
					</div>
					<button type="submit" class="btn btn-primary float-right">Simpan</button>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>
<script>
	$(document).on("click", ".open-Dialog", function() {
		var nis = $(this).data('nis');
		var nilai = $(this).data('nilai');
		var pelajaran = $(this).data('pelajaran');
		$(".modal-body #nis").val(nis);
		$(".modal-body #nilai").val(nilai);
		$(".modal-body #pelajaran").val(pelajaran);
	});
</script>
