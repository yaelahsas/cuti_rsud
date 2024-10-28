<title>Login</title>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('template/header');
?>
	<title>Login</title>

<body class="bg-gradient-primary">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block">
								<img src="<?php echo base_url('assets/sb-admin-2/img/') . "rsud.png" ?>" width="250" height="300" style="margin: 11%;">
							</div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									</div>
									<div class="col-md-16 text-center">
										<div style="margin-top: 4px" id="message">
											<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
										</div>
									</div>
									<form class="user" method="post" action="<?php echo site_url('auth/process'); ?>">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address..." required>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
										</div>
										<button type="submit"  class="btn btn-primary btn-user btn-block">
											Login
										</button>
										<hr>
									</form>
									<div class="text-center">
										<a class="small" href="<?php echo site_url('auth/register'); ?>">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url('assets/sb-admin-2/vendor/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/sb-admin-2/js/sb-admin-2.min.js'); ?>"></script>
</body>

</html>
