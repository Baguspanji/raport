<style>
	.btn-file {
		position: relative;
		overflow: hidden;
	}

	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	#img-upload-1 {
		width: 300px;
	}
</style>

<div class="card">
	<div class="card-header  font-weight-bold mr-auto">
		<!-- JavaScript Validation -->
	</div>
	<div class="card-content">
		<form class="needs-validation" action="<?= base_url($url_form) ?>" method="post" enctype="multipart/form-data" novalidate>
			<div class="card-body">
				<div class="form-group">
					<label>NIP Guru</label>
					<input type="number" class="form-control" name="nip" required="" value="<?= isset($data['nip']) ? $data['nip'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan NIP
					</div>
					<span class="text-danger"><?= form_error('nip') ?></span>
				</div>
				<div class="form-group">
					<label>NUPTK Guru</label>
					<input type="number" class="form-control" name="nuptk" required="" value="<?= isset($data['nuptk']) ? $data['nuptk'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan NUPTK
					</div>
					<span class="text-danger"><?= form_error('nuptk') ?></span>
				</div>
				<div class="row">
					<div class="form-group col-md-2">
						<label>Gelar Depan</label>
						<input type="text" class="form-control" name="gelar_dpn" required="" value="<?= isset($data['gelar_dpn']) ? $data['gelar_dpn'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Gelar Depan
						</div>
					</div>
					<div class="form-group col-md-8 text-left">
						<label>Nama Guru</label>
						<input type="text" class="form-control" name="nama" required="" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Nama
						</div>
					</div>
					<div class="form-group col-md-2">
						<label>Gelar Belakang</label>
						<input type="text" class="form-control" name="gelar_blkg" required="" value="<?= isset($data['gelar_blkg']) ? $data['gelar_blkg'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Gelar Belakang
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Guru</label>
					<input type="text" class="form-control" name="alamat" required="" value="<?= isset($data['alamat']) ? $data['alamat'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Alamat
					</div>
				</div>
				<div>
					<div class="form-group mt-2">
						<label>Jenis Kelamin Guru</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki" <?= isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == "Laki-laki" ? "checked" : '' ?>>
						<label class="form-check-label" for="laki">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?= isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == "Perempuan" ? "checked" : '' ?>>
						<label class="form-check-label" for="perempuan">Perempuan</label>
					</div>
				</div>
				<div class="form-group mt-4">
					<label>Pangkat Guru</label>
					<input type="text" class="form-control" name="pangkat" required="" value="<?= isset($data['pangkat']) ? $data['pangkat'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Pangkat
					</div>
				</div>
				<div class="form-group">
					<label>Golongan Ruang</label>
					<input type="text" class="form-control" name="gol_ruang" required="" value="<?= isset($data['gol_ruang']) ? $data['gol_ruang'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Golongan Ruang
					</div>
				</div>
				<div class="form-group">
					<label>Tingkat Pendidikan</label>
					<input type="text" class="form-control" name="tingkat_pend" required="" value="<?= isset($data['tingkat_pend']) ? $data['tingkat_pend'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Tingkat Pendidikan
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label>Tempat Tanggal Lahir Guru</label>
						<input type="text" class="form-control" name="tempat_lahir" required="" value="<?= isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Tempat Lahir
						</div>
					</div>
					<div class="form-group col-md-6">
						<label>Tempat Tanggal Lahir Guru</label>
						<input type="date" class="form-control" name="tanggal_lahir" required="" value="<?= isset($data['tanggal_lahir']) ? $data['tanggal_lahir'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Tanggal Lahir
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Tugas Sebagai</label>
					<input type="text" class="form-control" name="tugas_sebagai" required="" value="<?= isset($data['tugas_sebagai']) ? $data['tugas_sebagai'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Tugas Sebagai
					</div>
				</div>
				<div class="form-group">
					<label>Tugas Mengajar</label>
					<input type="text" class="form-control" name="tugas_mengajar" required="" value="<?= isset($data['tugas_mengajar']) ? $data['tugas_mengajar'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Tugas Mengajar
					</div>
				</div>
				<div class="form-group">
					<label>Status Pegawai</label>
					<input type="text" class="form-control" name="status_pegawai" required="" value="<?= isset($data['status_pegawai']) ? $data['status_pegawai'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Status Pegawai
					</div>
				</div>
				<div class="form-group">
					<label>TMT di Sekolah ini</label>
					<input type="text" class="form-control" name="tmt_sekolah" required="" value="<?= isset($data['tmt_sekolah']) ? $data['tmt_sekolah'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan TMT di Sekolah ini
					</div>
				</div>
				<div class="form-group">
					<label>No. SK</label>
					<input type="number" class="form-control" name="no_sk" required="" value="<?= isset($data['no_sk']) ? $data['no_sk'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan No. SK
					</div>
				</div>
				<div class="form-group">
					<label>Foto Guru</label>
					<div class="input-group">
						<label class="btn btn-outline-primary">
							Upload Foto Guru
							<input type="file" class="account-settings-fileinput" id="imgInp1" name="image">
						</label> &nbsp;
						<input type="text" class="ml-2 form-control" readonly>
					</div>
					<img id='img-upload-1' class="mt-4" src="<?= (isset($data['image']) && $data['image'] != '') ? base_url('assets/images/guru/' . $data['image']) : '' ?>" />
					<div class="invalid-feedback">
						Masukkan Foto
					</div>
					<span class="text-danger"><?= isset($images) ? $images : '' ?></span>
				</div>
				<div class="card-footer mt-2 text-right">
					<input type="hidden" name="id_guru" value="<?= isset($data['id_guru']) ? $data['id_guru'] : '' ?>">
					<button class="btn btn-primary"><?= explode(" ", $title)[0] != "Edit" ? "Simpan" : "Update" ?></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendors/bootstrap/js/jquery.min.js"></script>

<script>
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();

	function readURL(input, pic) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				if (pic == 1) {
					$('#img-upload-1').attr('src', e.target.result);
				}
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp1").change(function() {
		readURL(this, 1);
	});
</script>
