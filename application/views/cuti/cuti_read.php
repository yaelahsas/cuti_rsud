<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Cuti Read</h2>
        <table class="table">
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Id Jenis Cuti</td><td><?php echo $id_jenis_cuti; ?></td></tr>
	    <tr><td>Tanggal Pengajuan</td><td><?php echo $tanggal_pengajuan; ?></td></tr>
	    <tr><td>Tanggal Mulai</td><td><?php echo $tanggal_mulai; ?></td></tr>
	    <tr><td>Tanggal Selesai</td><td><?php echo $tanggal_selesai; ?></td></tr>
	    <tr><td>Lama Cuti</td><td><?php echo $lama_cuti; ?></td></tr>
	    <tr><td>Sisa Cuti</td><td><?php echo $sisa_cuti; ?></td></tr>
	    <tr><td>Alasan</td><td><?php echo $alasan; ?></td></tr>
	    <tr><td>Id Persetujuan</td><td><?php echo $id_persetujuan; ?></td></tr>
	    <tr><td>Catatan Pimpinan</td><td><?php echo $catatan_pimpinan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('cuti') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>