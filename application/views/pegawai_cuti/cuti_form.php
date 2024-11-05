<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Cuti <?php echo $button; ?></h6>
		</div>
		<div class="card-body">
			<form action="<?php echo $action; ?>" method="post">

				<!-- Dropdown Jenis Cuti -->
				<div class="form-group">
					<label for="id_jenis_cuti">Jenis Cuti <?php echo form_error('id_jenis_cuti'); ?></label>
					<select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
						<option value="">Pilih Jenis Cuti</option>
						<?php foreach ($jenis_cuti_list as $jenis_cuti): ?>
							<option value="<?php echo $jenis_cuti->id; ?>">
								<?php echo $jenis_cuti->nama_jenis_cuti; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Pimpinan yang tidak bisa diubah -->
				<div class="form-group">
					<label for="pimpinan1">Pimpinan 1</label>
					<input type="text" class="form-control" value="<?php echo $pimpinan1->nama; ?>" readonly>
					<input type="hidden" name="pimpinan1_id" id="pimpinan1_id" value="<?php echo $pimpinan1->id; ?>">
				</div>
				<div class="form-group">
					<label for="pimpinan2">Pimpinan 2</label>
					<input type="text" class="form-control" value="<?php echo $pimpinan2->nama; ?>" readonly>
					<input type="hidden" name="pimpinan2_id" id="pimpinan2_id" value="<?php echo $pimpinan2->id; ?>">
				</div>
				<div class="form-group">
					<label for="pimpinan3">Pimpinan 3</label>
					<input type="text" class="form-control" value="<?php echo $pimpinan3->nama; ?>" readonly>
					<input type="hidden" name="pimpinan3_id" id="pimpinan3_id" value="<?php echo $pimpinan3->id; ?>">
				</div>


				<!-- Input Tanggal Mulai -->
				<div class="form-group">
					<label for="tanggal_mulai">Tanggal Mulai <?php echo form_error('tanggal_mulai'); ?></label>
					<input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required onchange="calculateDays()">
				</div>

				<!-- Input Tanggal Selesai -->
				<div class="form-group">
					<label for="tanggal_selesai">Tanggal Selesai <?php echo form_error('tanggal_selesai'); ?></label>
					<input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required onchange="calculateDays()">
				</div>

				<!-- Display Lama Cuti -->
				<div class="form-group">
					<label for="lama_cuti">Lama Cuti (Hari)</label>
					<input type="text" class="form-control" name="lama_cuti" id="lama_cuti" readonly>
				</div>

				<!-- Input Alasan -->
				<div class="form-group">
					<label for="alasan">Alasan <?php echo form_error('alasan'); ?></label>
					<textarea class="form-control" rows="3" name="alasan" id="alasan" placeholder="Masukkan alasan cuti" required></textarea>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="btn btn-primary"><?php echo $button; ?></button>
				<a href="<?php echo site_url('pegawai_cuti'); ?>" class="btn btn-secondary">Batal</a>
			</form>
		</div>
	</div>
</div>

<script>
	function calculateDays() {
		const start = document.getElementById('tanggal_mulai').value;
		const end = document.getElementById('tanggal_selesai').value;

		if (start && end) {
			const startDate = new Date(start);
			const endDate = new Date(end);
			const diffTime = Math.abs(endDate - startDate);
			const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Menambah 1 agar hari termasuk tanggal mulai

			document.getElementById('lama_cuti').value = diffDays;
		} else {
			document.getElementById('lama_cuti').value = '';
		}
	}
</script>
