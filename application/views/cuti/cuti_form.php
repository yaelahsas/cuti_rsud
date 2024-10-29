<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Cuti <?php echo $button ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">

				<!-- Dropdown User -->
				<div class="form-group">
					<label for="id_user">User <?php echo form_error('id_user') ?></label>
					<select name="id_user" id="id_user" class="form-control">
						<option value="">Pilih User</option>
						<?php foreach ($user_list as $user): ?>
							<option value="<?php echo $user->id; ?>" <?php echo $id_user == $user->id ? 'selected' : ''; ?>>
								<?php echo $user->username; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Dropdown Jenis Cuti -->
				<div class="form-group">
					<label for="id_jenis_cuti">Jenis Cuti <?php echo form_error('id_jenis_cuti') ?></label>
					<select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
						<option value="">Pilih Jenis Cuti</option>
						<?php foreach ($jenis_cuti_list as $jenis_cuti): ?>
							<option value="<?php echo $jenis_cuti->id; ?>" <?php echo $id_jenis_cuti == $jenis_cuti->id ? 'selected' : ''; ?>>
								<?php echo $jenis_cuti->nama_jenis_cuti; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="tanggal_pengajuan">Tanggal Pengajuan <?php echo form_error('tanggal_pengajuan') ?></label>
					<input type="date" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" placeholder="Tanggal Pengajuan" value="<?php echo $tanggal_pengajuan; ?>" />
				</div>
				<div class="form-group">
					<label for="tanggal_mulai">Tanggal Mulai <?php echo form_error('tanggal_mulai') ?></label>
					<input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai" value="<?php echo $tanggal_mulai; ?>" />
				</div>
				<div class="form-group">
					<label for="tanggal_selesai">Tanggal Selesai <?php echo form_error('tanggal_selesai') ?></label>
					<input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai" value="<?php echo $tanggal_selesai; ?>" />
				</div>
				<div class="form-group">
					<label for="lama_cuti">Lama Cuti <?php echo form_error('lama_cuti') ?></label>
					<input type="number" class="form-control" name="lama_cuti" id="lama_cuti" placeholder="Lama Cuti" value="<?php echo $lama_cuti; ?>" />
				</div>
				<div class="form-group">
					<label for="sisa_cuti">Sisa Cuti <?php echo form_error('sisa_cuti') ?></label>
					<input type="number" class="form-control" name="sisa_cuti" id="sisa_cuti" placeholder="Sisa Cuti" value="<?php echo $sisa_cuti; ?>" />
				</div>
				<div class="form-group">
					<label for="alasan">Alasan <?php echo form_error('alasan') ?></label>
					<textarea class="form-control" rows="3" name="alasan" id="alasan" placeholder="Alasan"><?php echo $alasan; ?></textarea>
				</div>
				<div class="form-group">
					<label for="id_persetujuan">Id Persetujuan <?php echo form_error('id_persetujuan') ?></label>
					<input type="text" class="form-control" name="id_persetujuan" id="id_persetujuan" placeholder="Id Persetujuan" value="<?php echo $id_persetujuan; ?>" />
				</div>
				<div class="form-group">
					<label for="catatan_pimpinan">Catatan Pimpinan <?php echo form_error('catatan_pimpinan') ?></label>
					<textarea class="form-control" rows="3" name="catatan_pimpinan" id="catatan_pimpinan" placeholder="Catatan Pimpinan"><?php echo $catatan_pimpinan; ?></textarea>
				</div>

				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('cuti') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
