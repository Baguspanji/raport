<?php $role = $this->session->userdata('role'); ?>
<style>
	.theme-switch {
		position: relative;
		display: inline-block;
		width: 40px;
		height: 24px;
	}

	.theme-switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 16px;
		width: 16px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked+.slider {
		background-color: #2196F3;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(16px);
		-ms-transform: translateX(16px);
		transform: translateX(16px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>

<!--Topbar -->
<div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="las la-bars"></i>
		</button>
	</div>
	<div class="menu">

		<ul>

			<li>
				<div class="theme-switch-wrapper">
					<label class="theme-switch" for="checkbox">
						<input type="checkbox" id="checkbox" title="Dark Or White" />
						<div class="slider round"></div>
					</label>
				</div>
			</li>

			<!-- <li>
                <a href="notifications.html" class="transition">
                    <i class="las la-bell"></i>
                    <span class="badge badge-danger notif">5</span>
                </a>
            </li> -->

			<li>
				<div class="dropdown">
					<div class="dropdown-toggle" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="<?= base_url() ?>assets/images/avatar/avatar-2.png" alt="Profile">
					</div>
					<div class="dropdown-menu" aria-labelledby="dropdownProfile">

						<a class="dropdown-item" href="<?= base_url() ?>admin/user">
							<i class="las la-user mr-2"></i> <?= $this->session->userdata('nama') ?>
						</a>

						<!-- <a class="dropdown-item" href="activity-log.html">
                            <i class="las la-list-alt mr-2"></i> Activity Log
                        </a> -->

						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url() ?>admin/logout">
							<i class="las la-sign-out-alt mr-2"></i> Keluar
						</a>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>

<!--Sidebar-->
<div class="sidebar transition overlay-scrollbars">
	<div class="logo">
		<h2 style="font-weight: 700;" class="mb-0">Sekolah<span style="font-weight: 500;">Admin</span></h2>
	</div>

	<div class="sidebar-items">
		<div class="accordion" id="sidebar-items">
			<ul>

				<p class="menu">Sekolah</p>

				<li>
					<a href="<?= base_url() ?>" class="items">
						<i class="fa fa-tachometer-alt"></i>
						<span>Dashoard</span>
					</a>
				</li>

				<?php if ($role == 'super admin') : ?>

					<p class="menu">Konfigurasi Sekolah</p>

					<li>
						<a href="<?= base_url() ?>sekolah" class="items">
							<i class="fas la-stream"></i>
							<span>Sekolah</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>admin/list" class="items">
							<i class="fas la-user"></i>
							<span>Admin Auth</span>
						</a>
					</li>

				<?php elseif ($role == 'admin') : ?>
					<p class="menu">Data Sekolah</p>

					<li>
						<a href="<?= base_url() ?>siswa" class="items">
							<i class="fas la-user-friends"></i>
							<span>Siswa</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>guru" class="items">
							<i class="fas la-user-graduate"></i>
							<span>Guru</span>
						</a>
					</li>

					<!-- <li>
					<a href="<?= base_url() ?>pekerja" class="items">
						<i class="fas la-running"></i>
						<span>Pekerja</span>
					</a>
				</li> -->

					<p class="menu">Input Sekolah</p>

					<li>
						<a href="<?= base_url() ?>absensi" class="items">
							<i class="fas la-chalkboard"></i>
							<span>Absensi</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>nilai/penilaian" class="items">
							<i class="fas la-download"></i>
							<span>Penilaian</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>bayar/pembayaran" class="items">
							<i class="fas la-dollar-sign"></i>
							<span>Pembayaran</span>
						</a>
					</li>

					<p class="menu">Konfigurasi Sekolah</p>

					<li>
						<a href="<?= base_url() ?>kelas" class="items">
							<i class="fas la-chart-line"></i>
							<span>Kelas</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>nilai" class="items">
							<i class="fas la-download"></i>
							<span>Nilai</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>bayar" class="items">
							<i class="fas la-dollar-sign"></i>
							<span>Bayar</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>tahun" class="items">
							<i class="fas la-calendar"></i>
							<span>Tahun Ajaran</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>pelajaran" class="items">
							<i class="fas la-clock"></i>
							<span>Pelajaran</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>user" class="items">
							<i class="fas la-user"></i>
							<span>Guru Auth</span>
						</a>
					</li>

				<?php elseif ($role == 'guru') : ?>

					<p class="menu">Input Sekolah</p>

					<li>
						<a href="<?= base_url() ?>absensi" class="items">
							<i class="fas la-chalkboard"></i>
							<span>Absensi</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>nilai/penilaian" class="items">
							<i class="fas la-download"></i>
							<span>Penilaian</span>
						</a>
					</li>

					<li>
						<a href="<?= base_url() ?>kelas" class="items">
							<i class="fas la-chart-line"></i>
							<span>Kelas</span>
						</a>
					</li>

				<?php endif ?>

				<!-- <p class="menu">Menu Aplikas</p>

				<li id="headingThree">
					<a href="onclick();" class="submenu-items" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
						<i class="fas la-folder"></i>
						<span>Dokumentasi</span>
						<i class="fas la-angle-right"></i>
					</a>
				</li>
				<div id="collapsefour" class="collapse submenu" aria-labelledby="headingThree" data-parent="#sidebar-items">
					<ul>

						<li>
							<a href="signin.html">Login</a>
						</li>

						<li>
							<a href="signup.html">Register</a>
						</li>

						<li>
							<a href="forgot.html">Forgot Password</a>
						</li>

					</ul>
				</div> -->

			</ul>
		</div>
	</div>
</div>

<div class="sidebar-overlay"></div>
