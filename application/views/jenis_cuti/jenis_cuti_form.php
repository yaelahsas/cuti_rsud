<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Jenis Cuti - <?php echo $button ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="nama_jenis_cuti">Nama Jenis Cuti <?php echo form_error('nama_jenis_cuti') ?></label>
					<input type="text" class="form-control" name="nama_jenis_cuti" id="nama_jenis_cuti" placeholder="Nama Jenis Cuti" value="<?php echo $nama_jenis_cuti; ?>" />
				</div>
				<div class="form-group">
					<label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
					<textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
				</div>
				<div class="form-group">
					<label for="durasi">Durasi (hari) <?php echo form_error('durasi') ?></label>
					<input type="number" class="form-control" name="durasi" id="durasi" placeholder="Durasi dalam hari" value="<?php echo $durasi; ?>" min="1" />
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('jenis_cuti') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
