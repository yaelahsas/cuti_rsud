<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users List</h1>
		<?php echo anchor(site_url('users/create'), 'Create', 'class="btn btn-primary"'); ?>
	</div>

	<!-- DataTales Card -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="mytable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="80px">No</th>
							<th>Role</th>
							<th>Username</th>
							<th>Email</th>
							<th>Nama</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="text-center">
				<div id="message">
					<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
				</div>
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
				"url": "users/json",
				"type": "POST"
			},
			columns: [{
					"data": "id",
					"orderable": false
				}, {
					"data": "role"
				}, {
					"data": "username"
				}, {
					"data": "email"
				}, {
					"data": "nama"
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
