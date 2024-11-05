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
							<th>Id User</th>
							<th>Id Jenis Cuti</th>
							<th>Tanggal Pengajuan</th>
							<th>Tanggal Mulai</th>
							<th>Tanggal Selesai</th>
							<th>Lama Cuti</th>
							<th>Sisa Cuti</th>
							<th>Alasan</th>
							<th>Id Persetujuan</th>
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
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
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
					"data": "id_persetujuan"
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
	});
</script>
