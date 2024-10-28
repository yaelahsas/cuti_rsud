<div class="container-fluid">
	<div class="row" style="margin-bottom: 10px">
		<div class="col-md-4">
			<h2 style="margin-top:0px">Pegawai List</h2>
		</div>
		<div class="col-md-4 text-center">
			<div style="margin-top: 4px" id="message">
			</div>
		</div>
		<div class="col-md-4 text-right">
			<?php echo anchor(site_url('pegawai/create'), 'Create', 'class="btn btn-primary"'); ?>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="mytable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<thead>
								<tr>
									<th width="80px">No</th>
									<th>Nama User</th> <!-- Menampilkan nama user -->
									<th>Jabatan</th> <!-- Menampilkan nama jabatan -->
									<th>Ruangan</th> <!-- Menampilkan nama ruangan -->
									<th>NIP</th>
									<th>Status Pegawai</th>
									<th>Alamat</th>
									<th>Tanggal Lahir</th>
									<th>Jenis Kelamin</th>
									<th>Telepon</th>
									<th>Email</th>
									<th width="200px">Action</th>
								</tr>
							</thead>

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
				"url": "pegawai/json",
				"type": "POST"
			},
			columns: [{
					"data": "id",
					"orderable": false
				},
				{
					"data": "user_name", // Menggunakan kolom user_name dari hasil join
				
				},
				{
					"data": "nama_jabatan", // Menggunakan kolom nama_jabatan dari hasil join
					
				},
				{
					"data": "nama_ruangan", // Menggunakan kolom nama_ruangan dari hasil join
					
				},
				{
					"data": "nip",
					
				},
				{
					"data": "status_pegawai",
			
				},
				{
					"data": "alamat",
					
				},
				{
					"data": "tanggal_lahir",
					
				},
				{
					"data": "jenis_kelamin",
					
				},
				{
					"data": "telepon",
					
				},
				{
					"data": "email",
					
				},
				{
					"data": "action",
					"orderable": false,
					"className": "text-center",
					"title": "Action"
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
