<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header pr-5 pl-5 mt-2">
				<div class="row justify-content-between">
					<h4 class="card-title col-md-8"><?= $title ?> Sekolah ADMIN</h4>
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
									<th>Nis</th>
									<th>Nama Siswa</th>
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
	</div>

	<div class="col-md-8">
		<div class="card">
			<div class="card-header pr-5 pl-5 mt-2">
				<div class="row justify-content-between">
					<h4 class="card-title col-md-8"><?= $title ?> Sekolah ADMIN</h4>
					<div>
						<?php if (explode(" ", $title)[0] != "Edit") {
							echo '<a href="' . base_url() . 'kelas/add_cart" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah ke Kelas</a>';
						} else {
							echo '<a href="' . base_url() . 'kelas/edit_cart" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Update Kelas</a>';
						} ?>
					</div>
				</div>
			</div>
			<div class="card-content">
				<div class="card-body">
					<!-- Table with outer spacing -->
					<div class="table-responsive">
						<table class="table table-bordered" id="table-2" style="width:100%">
							<thead>
								<tr>
									<th>Aksi</th>
									<th>No</th>
									<th>Nis</th>
									<th>Nama Siswa</th>
									<th>Alamat</th>
									<th>Tempat Tanggal Lahir</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
