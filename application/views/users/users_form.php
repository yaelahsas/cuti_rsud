<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Users <?php echo $button ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="id_role">Role <?php echo form_error('id_role') ?></label>
					<select class="form-control" name="id_role" id="id_role">
						<option value="">-- Pilih Role --</option>
						<?php foreach ($roles as $role) : ?>
							<option value="<?php echo $role->id; ?>" <?php echo ($role->id == $id_role) ? 'selected' : ''; ?>>
								<?php echo $role->nama_role; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="username">Username <?php echo form_error('username') ?></label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
				</div>
				<div class="form-group">
					<label for="email">Email <?php echo form_error('email') ?></label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
				</div>
				<div class="form-group">
					<label for="password">Password <?php echo form_error('password') ?></label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
				</div>
				<div class="form-group">
					<label for="nama">Nama <?php echo form_error('nama') ?></label>
					<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('users') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
