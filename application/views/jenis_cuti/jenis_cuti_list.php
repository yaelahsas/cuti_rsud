<div class="container-fluid">
	<div class="row" style="margin-bottom: 10px">
		<div class="col-md-4">
			<h2 style="margin-top:0px">Daftar Jenis Cuti</h2>
		</div>
		<div class="col-md-4 text-center">
			<div style="margin-top: 4px" id="message">
				<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
			</div>
		</div>
		<div class="col-md-4 text-right">
			<?php echo anchor(site_url('jenis_cuti/create'), 'Tambah Jenis Cuti', 'class="btn btn-primary"'); ?>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>
							<th width="80px">No</th>
							<th>Nama Jenis Cuti</th>
							<th>Keterangan</th>
							<th>Durasi</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
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
				"url": "jenis_cuti/json",
				"type": "POST"
			},
			columns: [{
					"data": "id",
					"orderable": false
				}, {
					"data": "nama_jenis_cuti"
				}, {
					"data": "keterangan"
				}, {
					"data": "durasi"
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
