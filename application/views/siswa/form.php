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
					<label>Nomor Induk Siswa</label>
					<input type="number" class="form-control" name="nis" required="" value="<?= isset($data['nis']) ? $data['nis'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan NIS
					</div>
					<span class="text-danger"><?= form_error('nis') ?></span>
				</div>
				<div class="form-group">
					<label>NISN Siswa</label>
					<input type="number" class="form-control" name="nisn" required="" value="<?= isset($data['nisn']) ? $data['nisn'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan NISN
					</div>
					<span class="text-danger"><?= form_error('nisn') ?></span>
				</div>
				<div class="form-group">
					<label>Nama Siswa</label>
					<input type="text" class="form-control" name="nama" required="" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Nama
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Siswa</label>
					<input type="text" class="form-control" name="alamat" required="" value="<?= isset($data['alamat']) ? $data['alamat'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Kelas
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label>Tempat Tanggal Lahir Siswa</label>
						<input type="text" class="form-control" name="tempat_lahir" required="" value="<?= isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Tempat Lahir
						</div>
					</div>
					<div class="form-group col-md-6">
						<label>Tempat Tanggal Lahir Siswa</label>
						<input type="date" class="form-control" name="tanggal_lahir" required="" value="<?= isset($data['tanggal_lahir']) ? $data['tanggal_lahir'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Tanggal Lahir
						</div>
					</div>
				</div>
				<div>
					<div class="form-group mt-2">
						<label>Jenis Kelamin Siswa</label>
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
				<div>
					<div class="form-group mt-4">
						<label>Agama Siswa</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="agama" id="islam" value="Islam" <?= isset($data['agama']) && $data['agama'] == "Islam" ? "checked" : '' ?>>
						<label class="form-check-label" for="islam">Islam</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="agama" id="kristen" value="Kristen" <?= isset($data['agama']) && $data['agama'] == "Kristen" ? "checked" : '' ?>>
						<label class="form-check-label" for="kristen">Kristen</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="agama" id="hindu" value="Hindu" <?= isset($data['agama']) && $data['agama'] == "Hindu" ? "checked" : '' ?>>
						<label class="form-check-label" for="hindu">Hindu</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="agama" id="budha" value="Budha" <?= isset($data['agama']) && $data['agama'] == "Budha" ? "checked" : '' ?>>
						<label class="form-check-label" for="budha">Budha</label>
					</div>
				</div>
				<div>
					<div class="form-group mt-4">
						<label>Status Keluarga Siswa</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status_keluarga" id="kandung" value="Anak Kandung" <?= isset($data['status_keluarga']) && $data['status_keluarga'] == "Anak Kandung" ? "checked" : '' ?>>
						<label class="form-check-label" for="kandung">Anak Kandung</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status_keluarga" id="angkat" value="Anak Angkat" <?= isset($data['status_keluarga']) && $data['status_keluarga'] == "Anak Angkat" ? "checked" : '' ?>>
						<label class="form-check-label" for="angkat">Anak Angkat</label>
					</div>
				</div>
				<div class="form-group mt-4">
					<label>Anak Ke</label>
					<input type="number" class="form-control" name="anak_ke" required="" value="<?= isset($data['anak_ke']) ? $data['anak_ke'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Anak ke
					</div>
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="number" class="form-control" name="telepon" required="" value="<?= isset($data['telepon']) ? $data['telepon'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Telepon
					</div>
				</div>
				<div class="form-group">
					<label>Sekolah Asal Siswa</label>
					<input type="text" class="form-control" name="sekolah_asal" required="" value="<?= isset($data['sekolah_asal']) ? $data['sekolah_asal'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Sekolah Asal Siswa
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label>Diterima diKelas</label>
						<input type="text" class="form-control" name="diterima_kelas" required="" value="<?= isset($data['diterima_kelas']) ? $data['diterima_kelas'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Diterima diKelas
						</div>
					</div>
					<div class="form-group col-md-6">
						<label>Diterima Tanggal</label>
						<input type="date" class="form-control" name="diterima_tanggal" required="" value="<?= isset($data['diterima_tanggal']) ? $data['diterima_tanggal'] : '' ?>">
						<div class="invalid-feedback">
							Masukkan Diterima Tanggal
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<input type="text" class="form-control" name="nama_ayah" required="" value="<?= isset($data['nama_ayah']) ? $data['nama_ayah'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Nama Ayah
					</div>
				</div>
				<div class="form-group">
					<label>Nama Ibu</label>
					<input type="text" class="form-control" name="nama_ibu" required="" value="<?= isset($data['nama_ibu']) ? $data['nama_ibu'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Nama Ibu
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Orang Tua</label>
					<input type="text" class="form-control" name="alamat_orangtua" required="" value="<?= isset($data['alamat_orangtua']) ? $data['alamat_orangtua'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Alamat Orang Tua
					</div>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ayah</label>
					<input type="text" class="form-control" name="kerja_ayah" required="" value="<?= isset($data['kerja_ayah']) ? $data['kerja_ayah'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Pekerjaan Ayah
					</div>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ibu</label>
					<input type="text" class="form-control" name="kerja_ibu" required="" value="<?= isset($data['kerja_ibu']) ? $data['kerja_ibu'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Pekerjaan Ibu
					</div>
				</div>
				<div class="form-group">
					<label>Nama Wali</label>
					<input type="text" class="form-control" name="nama_wali" required="" value="<?= isset($data['nama_wali']) ? $data['nama_wali'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Nama Wali
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Wali</label>
					<input type="text" class="form-control" name="alamat_wali" required="" value="<?= isset($data['alamat_wali']) ? $data['alamat_wali'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Alamat Wali
					</div>
				</div>
				<div class="form-group">
					<label>Pekerjaan Wali</label>
					<input type="text" class="form-control" name="kerja_wali" required="" value="<?= isset($data['kerja_wali']) ? $data['kerja_wali'] : '' ?>">
					<div class="invalid-feedback">
						Masukkan Pekerjaan Wali
					</div>
				</div>
				<div class="form-group">
					<label>Foto Siswa</label>
					<div class="input-group">
						<label class="btn btn-outline-primary">
							Upload Foto Siswa
							<input type="file" class="account-settings-fileinput" id="imgInp1" name="image">
						</label> &nbsp;
						<input type="text" class="ml-2 form-control" readonly>
					</div>
					<img id='img-upload-1' class="mt-4" src="<?= (isset($data['image']) && $data['image'] != '') ? base_url('assets/images/siswa/' . $data['image']) : '' ?>" />
					<div class="invalid-feedback">
						Masukkan Foto
					</div>
					<span class="text-danger"><?= isset($images) ? $images : '' ?></span>
				</div>
				<div class="card-footer mt-2 text-right">
					<input type="hidden" name="id_siswa" value="<?= isset($data['id_siswa']) ? $data['id_siswa'] : '' ?>">
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
