<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
	<!-- Main Content -->
	<div id="content">
		<!-- Topbar -->
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Other topbar items (User Profile, Notifications) -->

				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name = $this->session->userdata('user')->nama; ?></span>
						<img  src="<?= base_url('assets/sb-admin-2/img/' . "undraw_profile.svg");?>" class="img-profile rounded-circle">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="userDropdown">
		
					
						<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" >
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>

		</nav>
		<!-- End of Topbar -->
