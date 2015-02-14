<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
		* {
			padding: 0;
			margin: 0;
			-webkit-box-sizing: border-box;
			   -moz-box-sizing: border-box;
			        box-sizing: border-box;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
	
		body {
			/*background-color: #eee;*/
		}

		h1 {
			font-size: 2.5rem;
			font-family: Edwardian Script ITC;
		}

		h5 {
			font-size: 0.7rem;
			line-height: 1.6;
		}

		.wrapper {
			position: relative;
			width: 960px;
			margin: 0 auto;
			padding: 10px;
			background-color: #fff;
		}

		.atas {
			position: relative;
			width: 100%;
			font-weight: bold;
		}

		.atas > img {
			position: absolute;
			top: 10px;
			left: 10px;
		}

		.atas > .kop-surat {
			position: relative;
			width: 480px;
			left: 120px;
			font-family: 'Arial';
		}

		.tanggal-order,
		.nama-alamat-kota,
		.surat-jalan-no,
		.tengah,
		.bawah {
			font-family: 'Cambria';
		}

		.tanggal-order {
			position: relative;
			margin-top: 30px;
			margin-left: 15px;
		}

		.invisibletable {
			border: none;
			line-height: 1.5;
		}

			.invisibletable tr td:first-child {
				padding-right: 25px;
			}

			.invisibletable tr td:nth-child(2) {
				padding-right: 15px;
			}

		.nama-alamat-kota {
			position: absolute;
			right: 30px;
			top: 65px;
		}

		.surat-jalan-no {
			position: relative;
			margin-top: 30px;
		}

			.surat-jalan-no > h2 {
				position: relative;
				left: 100px;
				font-size: 2rem;
			}

			.surat-jalan-no > p {
				position: absolute;
				right: 100px;
				top: 10px;
				width: 300px;
				border-bottom: 1px dotted #111;
			}

		.tengah {
			margin-top: 20px;
		}

			.tengah > table {
				width: 100%;
				font-size: 1.2rem;
			}

			.tengah > table tr th,
			.tengah > table tr td {
				padding: 8px 0;
				border: 2px solid #222;
			}

			.tengah > table tr th:nth-child(2) {
				width: 45%;
			}

			.tengah > table tr th:nth-child(4) {
				width: 10%;
			}

			.tengah > table tr td {
				height: 10px;
			}
		.trtengah:nth-last-child(6) {
			border-bottom: 0px solid #222;
		}

		.trtengah td {
			border-left: 0px solid #222;
			border-right: 0px solid #222;
		}

		.bawah {
			margin-top: 25px;
		}

			.bawah > table {
				width: 100%;
				font-size: 0.9rem;
			}

			.bawah > table tr th,
			.bawah > table tr td {
				padding: 2px 0;
				border: 2px solid #222;
			}

			.bawah > table tr th:nth-child(2),
			.bawah > table tr th:nth-child(3) {
				width: 175px;
			}

			.bawah > table tr th:nth-child(4) {
				width: 200px;
			}

			.bawah > table tr th:nth-child(5) {
				width: 230px;
			}

			.bawah > table tr:nth-child(2) td {
				padding: 5px 0;
			}

			.bawah > table tr:nth-child(3) td {
				text-align: center;
			}

			.table-pojok-kanan-bawah {
				margin: 10px 10px 0 10px;
				width: 90%;
			}

			.table-pojok-kanan-bawah:nth-child(2) {
				margin-bottom: 0;
				margin-top: 50px;
			}

			.table-pojok-kanan-bawah tr td {
				border: none !important;
			}

			.table-pojok-kanan-bawah tr td:first-child {
				width: 40%;
			}

	</style>
</head>
<body>
	<section class="wrapper">
		<div class="atas"> <!-- BAGIAN ATAS -->
			<img src="<?=base_url()?>img/ts-logo.jpg"/>
			<div class="kop-surat">
				<h1>PT. Taman Sriwedari</h1>
				<h5>OFFICE : JL. SERSAN KKO USMAN NO. 27.DS. DANDANGAN</h5>
				<h5>KEC. KOTA, KOTA KEDIRI - JAWA TIMUR</h5>
				<h5>PHONE  : (0354) 686358  FAX. (0354) 690690</h5>
				<h5>EMAIL  : marketing@tamansriwedari.com</h5>
			</div>
			<div class="tanggal-order">
				<table class="invisibletable">
					<tr>
						<td>TANGGAL</td><td>:</td><td> <?=$header['tanggal']?></td>
					</tr>
					<tr>
						<td>NO. ORDER</td><td>:</td><td> <?=$header['no_dokumen']?></td>
					</tr>
				</table>
			</div>
			<div class="nama-alamat-kota">
				<table class="invisibletable">
					<tr>
						<td>NAMA CUSTOMER</td><td>:</td><td> <?=$header['nama']?></td>
					</tr>
					<tr>
						<td>ALAMAT</td><td>:</td><td> <?=$header['alamat']?></td>
					</tr>
					<tr>
						<td></td><td>:</td><td>..................................................</td>
					</tr>
					<tr>
						<td>KOTA</td><td>:</td><td> <?=$header['kota']?></td>
					</tr>
					<tr>
						<td>TELP</td><td>:</td><td> <?=$header['telpon']?></td>
					</tr>
				</table>
			</div>
			<div class="surat-jalan-no">
				<h2>SURAT JALAN</h2>
				<p>No. : <?=$header['no_surat_jalan']?></p>
			</div>
		</div>
		<div class="tengah"> <!-- TABEL BAGIAN TENGAH --> 
			<table>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Satuan</th>
					<th>Keterangan</th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Sesuai PO No : <?=$header['no_surat_jalan']?></td>
				</tr>
				<?php $no=1; foreach($detail as $row){ ?>
				<tr class="trtengah">
					<td align="center"><?=$no?></td>
					<td><?=$row['nama_barang']?></td>
					<td><?=$row['kuantitas']?></td>
					<td><?=$row['satuan']?></td>
					<td><?=$row['keterangan']?></td>
				</tr>
				<?php $no++; }
				/* while($no<=37){
					echo "<tr class='trtengah'><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					$no++;
				} */
				?>
			</table>
		</div>
		<div class="bawah"> <!-- TABEL BAGIAN BAWAH -->
			<table>
				<tr>
					<th>Yang Menerima</th>
					<th>Pengemudi</th>
					<th>Yang Menyerahkan</th>
					<th>Cek Satpam Penerima</th>
					<th>Cek Satpam PT. Taman Sriwedari</th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<table class="table-pojok-kanan-bawah">
							<tr>
								<td>Masuk</td>
								<td>:........................WIB</td>
							</tr>
							<tr>
								<td>Keluar</td>
								<td>:........................WIB</td>
							</tr>
						</table>
						<table class="table-pojok-kanan-bawah">
							<tr>
								<td>Nama</td>
								<td>:....................................</td>
							</tr>
						</table>
					</td>
					<td>
						<table class="table-pojok-kanan-bawah">
							<tr>
								<td>Masuk</td>
								<td>:........................WIB</td>
							</tr>
							<tr>
								<td>Keluar</td>
								<td>:........................WIB</td>
							</tr>
						</table>
						<table class="table-pojok-kanan-bawah">
							<tr>
								<td>Nama</td>
								<td>:.....................................</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><?=$header['supir']?></td>
					<td><?=$header['pengirim']?></td>
					<td>Petugas</td>
					<td>Petugas</td>
				</tr>
			</table>
		</div>
	</section>

</body>
</html>