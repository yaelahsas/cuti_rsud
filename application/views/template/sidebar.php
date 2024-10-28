<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="#">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
			aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Data</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
			data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Custom Utilities:</h6>
				<a class="collapse-item" href="<?= site_url('Pegawai') ?>">Data Pegawai</a>
				<a class="collapse-item" href="utilities-border.html">Data Pimpinan</a>
				<a class="collapse-item" href="<?= site_url('Jenis_cuti') ?>">Data Jenis Cuti</a>
				<a class="collapse-item" href="utilities-other.html">Data Cuti</a>
				<a class="collapse-item" href="<?= site_url('Users') ?>">Data User</a>
				<a class="collapse-item" href="<?= site_url('Ruangan') ?>">Data Ruangan</a>
				<a class="collapse-item" href="<?= site_url('Jabatan') ?>">Data Jabatan</a>
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Rekap Cuti</span></a>
	</li>


	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>


</ul>
<!-- End of Sidebar -->
