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

						<!-- <a class="dropdown-item" href="profile.html">
                            <i class="las la-user mr-2"></i> My Profile
                        </a>

                        <a class="dropdown-item" href="activity-log.html">
                            <i class="las la-list-alt mr-2"></i> Activity Log
                        </a> -->

						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="signin.html">
							<i class="las la-sign-out-alt mr-2"></i> Log Out
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


				<p class="menu">Data Sekolah</p>

				<li>
					<a href="<?= base_url() ?>siswa" class="items">
						<i class="fas la-user"></i>
						<span>Siswa</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>guru" class="items">
						<i class="fas la-user"></i>
						<span>Guru</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>pekerja" class="items">
						<i class="fas la-user"></i>
						<span>Pekerja</span>
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
					<a href="<?= base_url() ?>tahun" class="items">
						<i class="fas la-calendar"></i>
						<span>Tahun</span>
					</a>
				</li>

				<p class="menu">Menu Aplikas</p>

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
				</div>

			</ul>
		</div>
	</div>
</div>

<div class="sidebar-overlay"></div>
