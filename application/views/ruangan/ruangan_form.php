<div class="container-fluid">
	<!-- Card untuk Form Ruangan -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ruangan <?php echo $button ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Nama Ruangan <?php echo form_error('nama_ruangan') ?></label>
					<input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan" value="<?php echo $nama_ruangan; ?>" />
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('ruangan') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
