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
			top: 190px;
		}

		.surat-jalan-no {
			position: relative;
			margin-top: 30px;
		}

			.surat-jalan-no > h2 {
				align: center;
				font-size: 2rem;
				width: 140px;
				border-style: solid;
				border-top: 1px  #111;
				border-right: 1px  #111;
				border-left: 1px  #111;
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
			}

			.tengah > table tr th {
				border: 2px solid #222;				
			}

			.tengah > table tr th:nth-child(2) {
				width: 45%;
			}

			.tengah > table tr th:nth-child(4) {
				width: 10%;
			}

			.tengah tr:first-child td {			
			}

			.trtengah:nth-last-child(6) {
				border-bottom: 2px solid #222;
			}

			.trtengah td {
				border-left: 2px solid #222;
				border-right: 2px solid #222;
			}

			.tengah > table tr:nth-last-child(3) td:last-child,
			.tengah > table tr:nth-last-child(4) td:last-child,
			.tengah > table tr:nth-last-child(5) td:last-child {
				border: 2px solid #222;
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
			
			.ttd_bawah {
				right: 30px;
				top: 190px;
			}
	</style>
</head>
<body>
	<section class="wrapper">
		<div class="atas"> <!-- BAGIAN ATAS -->
			<img src="<?=base_url()?>img/ts-logo.jpg"/>
			<div class="kop-surat">
				<h1>PT. Taman Sriwedari</h1>
				<h5>JL. Sersab Kko Usman No. 27, Dangdangan, Kota, kediri</h5>
			</div>
			
			<div class="surat-jalan-no" align="center">
				<h2>INVOICE</h2>
				<p>NO : <?=$data->no_invoice?></p>
			</div>
			
			<div class="tanggal-order">
				<table class="invisibletable">
					<tr>
						<td>Customer</td><td></td><td></td>
					</tr><tr>
						<td>Nama</td><td>:</td><td> <?=$data->nama?></td>
					</tr>
					<tr>
						<td>Alamat</td><td>:</td><td> <?=$data->alamat?></td>
					</tr>
					<tr>
						<td>Kota</td><td>:</td><td> <?=$data->kota?></td>
					</tr>
					<tr>
						<td>Telepon</td><td>:</td><td> <?=$data->telpon?></td>
					</tr>
				</table>
			</div>
			<div class="nama-alamat-kota">
				<table class="invisibletable">
					<tr>
						<td>Tanggal</td><td>:</td><td> <?=$this->penjualan_invoice_m->RubahTanggal($data->tanggal_invoice)?></td>
					</tr>
					<tr>
						<td>No. Order</td><td>:</td><td> <?=$data->no_dokumen?></td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="tengah"> <!-- TABEL BAGIAN TENGAH --> 
			<table>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Satuan</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Total</th>
				</tr>
				<?php 
				$no=1;
				foreach($detailinvoice as $row){
					echo "<tr class='trtengah'>";
						echo "<td> ".$no."</td>";
						echo "<td>".$row->nama_barang."</td>";
						echo "<td>".$row->satuan."</td>";
						echo "<td>".$row->kuantitas."</td>";
						echo "<td>".$this->penjualan_invoice_m->Rupiah($row->harga)."</td>";
						echo "<td>".$this->penjualan_invoice_m->Rupiah($row->kuantitas*$row->harga)."</td>";
					echo "</tr>";
				$no++;
				} 
				while($no<=37){
					echo "<tr class='trtengah'><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					$no++;
				}
				?>
				<tr>
					<td colspan="3" style="border:none"></td>
					<td colspan="2" style="border:none">Sub Total</td>
					<td><?=$this->penjualan_invoice_m->Rupiah($data->subtotal)?></td>
				</tr>
				<tr>
					<td colspan="3" style="border:none"></td>
					<td colspan="2" style="border:none">Pajak PPN 10%</td>
					<td><?=$this->penjualan_invoice_m->Rupiah($data->ppn)?></td>
				</tr>
				<tr>
					<td colspan="3" style="border:none"></td>
					<td colspan="2" style="border:none">Total</td>
					<td><?=$this->penjualan_invoice_m->Rupiah($data->total)?></td>
				</tr>
				<tr>
					<td colspan="6" style="border:none"><br><br></td>
				</tr>
				<tr>
					<td colspan="4" style="border:none"></td>
					<td colspan="2" style="border:none">
							Hormat Kami,<br>
							PT. Taman Sriwedari<br>
							<br><br><br>
							<u><?=$data->nama?></u><br>
							<?=$data->jabatan?><br>
						</table>
					</td>
				</tr>
			</table>
		</div>	
	</section>

</body>
</html>