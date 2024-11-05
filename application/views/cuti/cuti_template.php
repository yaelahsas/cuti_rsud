<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PENGAJUAN CUTI</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@page {
			margin: 2;
			size: 8.5in 13in;
		}

		body {
			margin: 0px;
			/* Margin untuk isi konten */
			padding: 0 !important;
			font-family: 'Times New Roman', Times, serif, 'DejaVu Sans';
			font-size: 12px;
			border: 2px solid #000;
		}

		.atas {
			margin-left: 247.5pt;
		}

		.atas p .custom-br {
			margin-left: 20px;
			display: block;
		}

		h1 {
			font-size: 14pt;
			font-weight: bold;
			text-align: center;
			text-justify: inter-word;
		}

		.jos {
			text-indent: 50px;
			text-align: justify;
		}

		.signature-container {
			clear: both;
			/* Mencegah elemen bersebelahan dengan tanda tangan */
		}

		.left {
			float: left;
			/* Mengatur elemen di sebelah kiri */
			width: 50%;
			/* Menggunakan setengah lebar container */
		}

		.right {
			float: right;
			/* Mengatur elemen di sebelah kanan */
			width: 50%;
			/* Menggunakan setengah lebar container */
		}

		.signature-name {
			border-bottom: 1px solid #000;
			/* Garis bawah hitam dengan lebar 1px */
			display: inline;
			/* Membuat garis berada di bawah nama */
		}

		table {
			width: 95%;
			margin: 10px auto;
			/* Fix: Remove space between 10 and px */
			border-collapse: collapse;
			border-spacing: 0;
			/* Menetapkan jarak antar sel menjadi 0 */
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		td {
			padding-left: 5px;
			text-align: left;
		}

		/* Custom width for each cell */
		td.cell1 {
			width: 45%;
		}

		td.jenis {
			width: 5%;
		}

		td.selama {
			width: 10%;
		}

		td.cell2 {
			width: 30%;
		}

		td.cell3 {
			width: 15%;
		}

		td.cell4 {
			width: 40%;

		}

		td.aw {
			height: 5%;
			/* Fix: Correct the value */
		}

		tr.alamat {
			height: 1% !important;
		}

		td.ttd {
			text-align: center;
		}

		td.catatan {
			border-left-width: 0 !important;
			border-bottom-width: 0 !important;
			border-left-style: none !important;
			border-bottom-style: none !important;
		}
	</style>
</head>

<body>
	<div class="container">

		<div class="atas">
			<p> Banyuwangi, 22 Desember 2023
			<p>Kepada
				<br>Yth. Direktur RSUD Genteng
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;di - <?= "\n" ?>
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>BANYUWANGI</u>
			</p>

		</div>

		<h3 style="text-align: center;"><strong>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</strong> </h3>

		<table border="1" id="myTable">
			<tr>
				<td colspan="4">I. DATA PEGAWAI</td>
			</tr>
			<tr>
				<td class="cell3">Nama</td>
				<td class="cell1">Dhimas Panji Sastra</td>
				<td>NIP</td>
				<td>123456789101112</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>Staff IT</td>
				<td>Masa Kerja</td>
				<td>1 thn 10 bln</td>
			</tr>
			<tr>
				<td colspan="1" class="cell3">Unit Kerja</td>
				<td colspan="3">RSUD Genteng</td>
			</tr>
		</table>
		<table border="1" id="myTable">
			<tr>
				<td colspan="4">II. JENIS CUTI YANG DIAMBIL **</td>
			</tr>
			<tr>
				<td class="cell4">1. Cuti Tahunan</td>
				<td class="jenis">
					<div style="font-family: DejaVu Sans, sans-serif; text-align:center;">✔</div>
				</td>
				<td class="cell4">2. Cuti Besar</td>
				<td class="jenis"></td>
			</tr>
			<tr>
				<td class="cell4">3. Cuti Sakit</td>
				<td class="jenis"></td>
				<td class="cell4">4. Cuti Melahirkan</td>
				<td class="jenis"></td>
			</tr>
			<tr>
				<td class="cell4">5. Cuti Karena Alasan Penting</td>
				<td class="jenis"></td>
				<td class="cell4">6. Cuti di Luar Tanggungan Negara</td>
				<td class="jenis">

				</td>
			</tr>
		</table>

		<table border="1">
			<tr>
				<td>III. ALASAN CUTI</td>
			</tr>
			<tr>
				<td>
					<br>
					<br>
				</td>
			</tr>
		</table>


		<table border="1">
			<tr>
				<td colspan="6">IV. LAMANYA CUTI</td>
			</tr>
			<tr>
				<td class="selama">
					Selama
				</td>
				<td>
					10 Hari/<s>Bulan/Tahun</s>*
				</td>
				<td>
					Mulai Tanggal
				</td>
				<td>
					22 Desember 2023
				</td>
				<td class="jenis">
					s/d
				</td>
				<td>
					02 Januari 2024
				</td>
			</tr>
		</table>

		<table border="1">
			<tr>
				<td colspan="5">V. CATATAN CUTI ***</td>
			</tr>
			<tr>
				<td colspan="3">
					1. CUTI TAHUNAN
				</td>
				<td>
					2. CUTI BESAR
				</td>
				<td class="jenis">

				</td>


			</tr>
			<tr>
				<td class="selama">
					Tahun
				</td>
				<td class="selama">
					Sisa
				</td>
				<td class="selama">
					Keterangan
				</td>
				<td>
					3. CUTI SAKIT
				</td>
				<td class="jenis">

				</td>

			</tr>
			<tr>
				<td class="selama">
					N-2
				</td>
				<td class="selama">
					-
				</td>
				<td class="selama">
					2020
				</td>
				<td>
					4. CUTI MELAHIRKAN
				</td>
				<td class="jenis">

				</td>

			</tr>
			<tr>
				<td class="selama">
					N-1
				</td>
				<td class="selama">
					-
				</td>
				<td class="selama">
					2022
				</td>
				<td>
					5. CUTI KARENA ALASAN PENTING
				</td>
				<td class="jenis">

				</td>

			</tr>
			<tr>
				<td class="selama">
					N
				</td>
				<td class="selama">
					-
				</td>
				<td class="selama">
					2023
				</td>
				<td>
					6. CUTI DI LUAR TANGGUNGAN NEGARA
				</td>
				<td class="jenis">

				</td>

			</tr>
		</table>

		<table border="1">
			<tr>
				<td colspan="3">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
			</tr>
			<tr>
				<td class="ttd">
					Alamat Lengkap
				</td>
				<td class="ttd">
					Telpon
				</td>
				<td class="ttd" rowspan="2">
					Hormat Saya,
					<br />
					<br />
					<br>
					<br />
					<br />
					<u>Dhimas Panji Sastra, A.md</u>
					<br>123456789101212
				</td>

			</tr>
			<tr>
				<td class="ttd">
					Jember
				</td>
				<td class="ttd">
					083853399847
				</td>


			</tr>
		</table>

		<table border="1">
			<tr>
				<td colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG **</td>
			</tr>
			<tr>
				<td>
					DISETUJUI
				</td>
				<td>
					PERUBAHAN ****
				</td>
				<td>
					DITANGGUHKAN ****
				</td>
				<td>
					TIDAK DISETUJUI ****
				</td>

			</tr>
			<tr>
				<td>
					<div style="font-family: DejaVu Sans, sans-serif; text-align:center;">✔</div>
				</td>
				<td>

				</td>
				<td>

				</td>
				<td>

				</td>

			</tr>
			<tr>
				<td colspan="2">
					Kepala Ruang BERSALIN
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<u>INDAH WAHYUNINGSIH, A.Md.Keb</u>
					<br />
					NIP. 198104262002122004
				</td>
				<td>
					Kepala Subbag/ Seksi
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<u>KN TJATUR W., S.Kep.Ns
					</u>
					<br />
					NIP. 198104262002122004
				</td>
				<td>
					Kepala Bidang Pelayanan
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<u>dr. RUDI HARTAWAN</u>
					<br />
					NIP. 198104262002122004
				</td>


			</tr>
		</table>
		<table border="1">
			<tr>
				<td colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</td>
			</tr>
			<tr>
				<td class="cell3" style="text-align: center;">
					DISETUJUI
				</td>
				<td style="width: 19%; text-align:center">
					PERUBAHAN ****
				</td>
				<td style="width: 20%;text-align:center;">
					DITANGGUHKAN ****
				</td>
				<td>
					TIDAK DISETUJUI ****

				</td>

			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>


			</tr>
			<tr>
				<td style="border-left: none; padding-top:10px;" colspan="3">
					<strong><u>Catatan :</u></strong>
					<br>*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coret yang tidakperlu
					<br>
					**&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilih salah satu dengan memberi tanda centang
					<br>
					***&nbsp;&nbsp;&nbsp;Diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti
					<br>****&nbsp;Diberi tanda centang dan alasanya
					<br>N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;Cuti tahun berjalan
					<br>N-1&nbsp;&nbsp;= Sisa cuti 1 tahun sebelumnya
					<br>N-2&nbsp;&nbsp;= Sisa cuti 2 tahun sebelumnya
				</td>
				<td>
					DIREKTUR
					<br>RSUD GENTENG
					<br>KABUPATEN BANYUWANGI
					<br />
					<br />
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>

					<br />
					<u>dr. Hj. SITI ASIYAH ANGGRAENI, MMRS., FISQua</u>
					<br>Pembina Tk. I
					<br>NIP. 197105052002122004 I
				</td>
			</tr>
		</table>
	</div>

	<!-- Bootstrap JS dan jQuery (jika diperlukan) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
