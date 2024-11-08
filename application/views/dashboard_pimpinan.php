<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Cuti List</h6>
			<div class="text-right">
				<?php echo anchor(site_url('cuti/create'), '<i class="fas fa-plus"></i> Create', 'class="btn btn-primary btn-sm"'); ?>
			</div>
		</div>
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-12">
					<div id="message">
						<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>
							<th width="40px">No</th>
							<th>Nama</th>
							<th>Jenis Cuti</th>
							<th>Tanggal Pengajuan</th>
							<th>Tanggal Mulai</th>
							<th>Tanggal Selesai</th>
							<th>Lama Cuti</th>
							<th>Sisa Cuti</th>
							<th>Alasan</th>
							<th>Catatan Pimpinan</th>
							<th width="120px">Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- Data akan dimuat dengan Ajax DataTables -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk Detail Cuti -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailModalLabel">Detail Cuti</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="cutiDetails"></div> <!-- Area untuk menampilkan detail cuti -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="approveCuti()">Setujui</button>
				<button type="button" class="btn btn-danger" onclick="rejectCuti()">Tolak</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
	// Ambil base_url dari CodeIgniter ke dalam JavaScript
	var base_url = "<?= base_url(); ?>";

	function showDetail(cutiId) {
		// Menggunakan base_url di URL Ajax
		$.ajax({
			url: base_url + 'cuti/get_cuti_detail/' + cutiId, // Sesuaikan URL dengan endpoint detail cuti
			type: 'GET',
			success: function(response) {
				// Masukkan data yang diterima ke dalam modal
				$('#cutiDetails').html(response);
				// Tampilkan modal
				$('#detailModal').modal('show');
			},
			error: function() {
				alert('Gagal mengambil detail cuti.');
			}
		});
	}
	// Fungsi untuk menyetujui cuti
	function approveCuti() {
		// Implementasikan logika persetujuan cuti
		alert('Cuti disetujui.');
	}

	// Fungsi untuk menolak cuti
	function rejectCuti() {
		// Implementasikan logika penolakan cuti
		alert('Cuti ditolak.');
	}

	$(document).ready(function() {
		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var t = $("#mytable").dataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('keyup.DT', function(e) {
						if (e.keyCode == 13) {
							api.search(this.value).draw();
						}
					});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "json/",
				"type": "POST"
			},
			columns: [{
					"data": "id",
					"orderable": false
				}, {
					"data": "nama_user"
				}, {
					"data": "nama_jenis_cuti"
				}, {
					"data": "tanggal_pengajuan"
				}, {
					"data": "tanggal_mulai"
				}, {
					"data": "tanggal_selesai"
				}, {
					"data": "lama_cuti"
				}, {
					"data": "sisa_cuti"
				}, {
					"data": "alasan"
				}, {
					"data": "catatan_pimpinan"
				},
				{
					"data": "action",
					"orderable": false,
					"className": "text-center"
				}
			],
			order: [
				[0, 'desc']
			],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// Function to show modal with details
		$('#mytable').on('click', '.btn-detail', function() {
			var cutiId = $(this).data('id'); // Get cuti ID from button data-id attribute

			// Request detail data via AJAX
			$.ajax({
				url: 'cuti/get_cuti_detail/' + cutiId, // Endpoint to fetch cuti details
				type: 'GET',
				success: function(response) {
					// Display response data in modal content area
					$('#cutiDetails').html(response);
					// Show the modal
					$('#detailModal').modal('show');
				},
				error: function() {
					alert('Gagal mengambil detail cuti.');
				}
			});
		});
	});
</script>
