<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
	<!-- Main Content -->
	<div id="content">
		<!-- Topbar -->
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">


				<!-- Nav Item - Alerts -->
				<?php
				// Panggil fungsi getNotification
				$notif_data = $this->fungsi->getNotification();
				$notif_count = $notif_data['notif_count'];
				$pending_cuti = $notif_data['pending_cuti'];
				?>

				<li class="nav-item dropdown no-arrow mx-1">
					<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-bell fa-fw"></i>
						<!-- Counter - Alerts -->
						<span class="badge badge-danger badge-counter"><?= $notif_count > 0 ? $notif_count : ''; ?></span>
					</a>
					<!-- Dropdown - Alerts -->
					<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">
							Alerts Center
						</h6>
						<?php if ($notif_count > 0): ?>
							<?php foreach ($pending_cuti as $approval): ?>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="mr-3">
										<div class="icon-circle bg-primary">
											<i class="fas fa-file-alt text-white"></i>
										</div>
									</div>
									<div>
									<div class="small text-gray-500"><?= date('j F Y', strtotime($approval->cuti_pengajuan)); ?></div>
										<span class="font-weight-bold"><?= $approval->nama_user; ?> mengajukan cuti</span>
									</div>
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi baru</a>
						<?php endif; ?>
					</div>
				</li>



				<!-- Other topbar items (User Profile, Notifications) -->

				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name = $this->session->userdata('user')->nama; ?></span>
						<img src="<?= base_url('assets/sb-admin-2/img/' . "undraw_profile.svg"); ?>" class="img-profile rounded-circle">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="userDropdown">


						<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>

		</nav>
		<!-- End of Topbar -->
