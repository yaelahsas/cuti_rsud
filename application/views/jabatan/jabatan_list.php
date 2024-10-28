<div class="container-fluid">
	<div class="row" style="margin-bottom: 10px">
		<div class="col-md-4">
			<h2 style="margin-top:0px">Jabatan List</h2>
		</div>
		<div class="col-md-4 text-center">
			<div style="margin-top: 4px" id="message">
			
			</div>
		</div>
		<div class="col-md-4 text-right">
			<?php echo anchor(site_url('jabatan/create'), 'Create', 'class="btn btn-primary"'); ?>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="mytable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="80px">No</th>
							<th>Nama Jabatan</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 

$this->load->view('template/footer');
?>
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
				"url": "jabatan/json",
				"type": "POST"
			},
			columns: [{
					"data": "id",
					"orderable": false
				}, {
					"data": "nama_jabatan"
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
</body>

</html>
