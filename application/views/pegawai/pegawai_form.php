<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Pegawai <?php echo $button ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="int">Id User <?php echo form_error('id_user') ?></label>
					<input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
				</div>
				
				<!-- Dropdown untuk Jabatan -->
				<div class="form-group">
					<label for="id_jabatan">Jabatan <?php echo form_error('id_jabatan') ?></label>
					<select class="form-control" name="id_jabatan" id="id_jabatan">
						<option value="">-- Pilih Jabatan --</option>
						<?php foreach ($jabatan_list as $jabatan): ?>
							<option value="<?php echo $jabatan->id; ?>" <?php echo ($id_jabatan == $jabatan->id) ? 'selected' : ''; ?>>
								<?php echo $jabatan->nama_jabatan; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				
				<!-- Dropdown untuk Ruangan -->
				<div class="form-group">
					<label for="id_ruangan">Ruangan <?php echo form_error('id_ruangan') ?></label>
					<select class="form-control" name="id_ruangan" id="id_ruangan">
						<option value="">-- Pilih Ruangan --</option>
						<?php foreach ($ruangan_list as $ruangan): ?>
							<option value="<?php echo $ruangan->id; ?>" <?php echo ($id_ruangan == $ruangan->id) ? 'selected' : ''; ?>>
								<?php echo $ruangan->nama_ruangan; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="form-group">
					<label for="varchar">Nip <?php echo form_error('nip') ?></label>
					<input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
				</div>
				
				<div class="form-group">
					<label for="enum">Status Pegawai <?php echo form_error('status_pegawai') ?></label>
					<select class="form-control" name="status_pegawai" id="status_pegawai">
						<option value="aktif" <?php echo ($status_pegawai == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
						<option value="non-aktif" <?php echo ($status_pegawai == 'non-aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
					</select>
				</div>
				
				<div class="form-group">
					<label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
					<textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
				</div>
				
				<div class="form-group">
					<label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
					<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
				</div>
				
				<div class="form-group">
					<label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
					<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
						<option value="L" <?php echo ($jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
						<option value="P" <?php echo ($jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
					</select>
				</div>
				
				<div class="form-group">
					<label for="varchar">Telepon <?php echo form_error('telepon') ?></label>
					<input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon; ?>" />
				</div>
				
				<div class="form-group">
					<label for="varchar">Email <?php echo form_error('email') ?></label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
				</div>
				
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('pegawai') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
