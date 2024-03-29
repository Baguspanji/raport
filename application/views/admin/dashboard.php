<?php
$role = $this->session->userdata('role');
?>

<?php if ($role == 'pengawas') { ?>
	<div class="row">
		<div class="col-md-6 col-lg-12">
			<div class="card">
				<div class="card-body">
					<h3>Profile SMK Leader Al-Yasini</h3>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="row">

		<div class="col-md-6 col-lg-12">
			<div class="card border-primary">
				<div class="card-body">
					<div class="row">
						<div class="col-4 d-flex align-items-center">
							<i class="las la-inbox icon-home bg-primary text-light"></i>
						</div>
						<div class="col-8">
							<p>Total Siswa</p>
							<h5><?= $siswa ?></h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-primary">
					<a href="<?= base_url() ?>siswa" class="text-link text-white d-flex justify-content-between">Lihat Siswa <i class="fas fa-arrow-right fa-lg"></i></a>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-12">
			<div class="card border-success">
				<div class="card-body">
					<div class="row">
						<div class="col-4 d-flex align-items-center">
							<i class="las la-clipboard-list icon-home bg-success text-light"></i>
						</div>
						<div class="col-8">
							<p>Total guru</p>
							<h5><?= $guru ?></h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-success">
					<a href="<?= base_url() ?>guru" class="text-link text-white d-flex justify-content-between">Lihat Guru <i class="fas fa-arrow-right fa-lg"></i></a>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-12">
			<div class="card border-info">
				<div class="card-body">
					<div class="row">
						<div class="col-4 d-flex align-items-center">
							<i class="las la-chart-bar  icon-home bg-info text-light"></i>
						</div>
						<div class="col-8">
							<p>Total Kelas</p>
							<h5><?= $kelas ?></h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-info">
					<a href="<?= base_url() ?>kelas" class="text-link text-white d-flex justify-content-between">Lihat Lembaga <i class="fas fa-arrow-right fa-lg"></i></a>
				</div>
			</div>
		</div>

		<!-- <div class="col-md-6 col-lg-12">
        <div class="card border-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <i class="las la-id-card  icon-home bg-warning text-light"></i>
                    </div>
                    <div class="col-8">
                        <p>Total Tenaga Kerja</p>
                        <h5><?= $pekerja ?></h5>
                    </div>
                </div>
            </div>
        </div> -->

	</div>


	<!-- <div class="col-md-12">
        <div class="card border-dark">
            <h5 class="card-header">Illustrations</h5>
            <div class="card-body row justify-content-center">
                <img src="<?= base_url() ?>assets/images/admin.svg" class="img-fluid p-5">
                <p class="mb-4">Add some quality, svg illustrations to your project courtesy of <a
                        href="https://undraw.co" target="_blank">unDraw</a>, a constantly updated collection
                    of beautiful
                    svg images that you can use completely free and without attribution!</p>

                <a href="https://undraw.co" target="_blank">Browse Illustrations on unDraw →</a>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Projects</h5>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-6 mt-4">
                        Server Migration
                    </div>
                    <div class="col-6 mt-4 text-right">
                        20%
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row mt-4 mb-1">
                    <div class="col-6">
                        Sales Tracking
                    </div>
                    <div class="col-6 text-right">
                        40%
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row mt-4 mb-1">
                    <div class="col-6">
                        Customer Database
                    </div>
                    <div class="col-6 text-right">
                        60%
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row mt-4 mb-1">
                    <div class="col-6">
                        Payout Details
                    </div>
                    <div class="col-6 text-right">
                        80%
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row mt-4 mb-1">
                    <div class="col-6">
                        Account Setup
                    </div>
                    <div class="col-6 text-right">
                        Complete!
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div> -->
	<!-- </div> -->
<?php } ?>
