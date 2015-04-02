<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pesanan Barang</title>
	<style>
		*, *:before, *:after {
			padding: 0;
			margin: 0;
			-webkit-box-sizing: border-box;
			   -moz-box-sizing: border-box;
			        box-sizing: border-box;
		}

		.container {
			position: relative;
			width: 800px;
			margin: 30px auto;
			border: 2px solid #111;
		}

		section {
			position: relative;
			width: 100%;
			font-family: sans-serif;
		}

		.header {
			padding-bottom: 15px;
			margin-bottom: 5px;
			height: 330px;
		}

			.logo {
				margin-top: 15px;
				margin-left: 15px;
			}

				.logo img {
					float: left;
					margin-right: 15px;
				}

				.logo h1 {
					font-size: 1.4rem;
					margin-right: 15px;
				}

				.logo p {
					font-size: 0.9rem;
					line-height: 1rem;
				}

			.kepadayth {
				width: 260px;
				position: absolute;
				right: 20px;
				text-align: center;
				margin-top: 15px
			}

				.kepadayth p {
					line-height: 1.4;
				}

				.kepadayth p:nth-child(2) {
					font-size: 0.9rem;
					padding: 10px;
				}

				.kepadayth p:first-child {
					border-bottom: 2px dotted #111;
				}
/*
				.kepadayth p:nth-child(3), .kepadayth p:nth-child(4) {
					width: 100%;
					display: block;
					border-bottom: 2px solid #111;
					text-align: left;
				}

				.kepadayth p:last-child {
					width: 60%;
					margin-left: 40%;
					border-bottom: 2px double #111;
					margin-bottom: 5px;
					text-align: left;
				}*/

			.judulheader {
				width: 100%;
				position: absolute;
				top: 220px;
				text-align: center;
				margin-top: 20px;
			}

				.judulheader h1 {
					display: inline;
					border-bottom: 2px solid #111;
				}

				.judulheader p {
					margin-top: 7px;
					<!-- margin-right: 260px;-->
				}

			.header > p {
				position: absolute;
				bottom: 5px;
				left: 20px;
				font-size: 0.9rem;
			}

		.tabel {
			padding: 2px;
		}

			.tabel table {
				width: 100%;
				border-collapse: collapse;
			}

			.tabel table th, .tabel table td {
				font-weight: 400;
				border: 1px solid #111;
			}

			.tabel table tbody tr:first-child th:first-child {
				width: 35px;
			}

			.tabel table th:nth-child(3), .tabel table th:nth-child(4) {
				width: 100px;
			}

			.tabel table tr:nth-child(2) th:first-child {
				width: 100px;
			}

			.tabel table > tbody tr:nth-child(3) td {
				padding: 5px;
				height: 300px;
				vertical-align: baseline;
			}

			.tabel table > tbody tr:nth-child(4) td {
				padding: 5px;
			}

			.tabel table > tbody tr:nth-child(4) td:first-child {
				text-align: right;
				font-size: 0.95rem;
				font-weight: 600;
			}

		.footer {
			
		}

			.footer > table {
				margin: 10px;
				font-size: 0.9rem;
			}

			.footer > table td {
				height: 1.4rem;
			}

			.footer > table td:first-child {
				width: 140px;
			}

			.footer > table td:last-child p {
				vertical-align: baseline;
				border-bottom: 2px dotted #111;
				width: 300px;
				line-height: 1.4rem;
				margin: 0 5px;
			}

			.catatankiribawah {
				width: 400px;
				font-size: 0.8rem;
				margin: 10px;
				margin-top: 150px;
			}

				.catatankiribawah p:first-child {
					border-bottom: 1px solid #111;
					display: inline-block;
				}

			.tandatangan {
				position: absolute;
				right: 30px;
				bottom: 10px;
				text-align: center;
				height: 120px;
			}

				.tandatangan p:first-child {
					font-size: 0.9rem;
				}

				.tandatangan .kurung {
					position: absolute;
					bottom: 0;
					margin: auto;
					left: 0;
					right: 0;
				}

				.tandatangan .kurung span+p {
					display: inline;
				}

				.tandatangan .kurung span:first-child {
					position: relative;
					left: -90px;
				}

				.tandatangan .kurung span:last-child {
					position: relative;
					right: -90px;
				}

				.tandatangan .kurung p {
					position: absolute;
					display: block;
					margin: auto;
					left: 0;
					right: 0;
				}
	</style>
</head>
<body>
	<div class="container">
		<section class="header">
			<div class="logo">
				<img src="<?=base_url()?>img/ts-logo.jpg">
				<h1>PT. TAMAN SRIWEDARI</h1>
				<p>KEDIRI - INDONESIA</p>
			</div>
			<div class="kepadayth">
				<p>&nbsp;</p>
			</div>
			<div class="judulheader">
				<h1>LAPORAN PENERIMAAN BARANG</h1>
				<p>No. <?=$this->createnosurat->convertnosurat($this->uri->segment("3"),'SPN')?></p></p>
			</div>
			<p>Telah di terima dari <?=$nama_suplier?> dengan kendaraan No. Pol <?=$no_pol?> pada jam <?=$jam?> WIB barang - barang sebgai berikut : </p>
		</section>
		<section class="tabel">
			<table>
				<tr>
					<th rowspan=2>No.</th>
					<th rowspan=2>NAMA BARANG</th>
					<th rowspan=2>KUANTITAS</th>
					<th rowspan=2>SATUAN</th>
					<th rowspan=2>KETERANGAN.</th>
				</tr>
				<tr>
				</tr>
				<tr>
					<td>
					<?php 
					$no=1;
					foreach($listBarang as $val){
						echo $no."<br>";
						$no++;
					}
					?></td>
					<td>
					<?php 
					foreach($listBarang as $val){
						echo $val->nama_barang."<br>";
					}
					?>
					</td>
					<td>
					<?php 
					foreach($listBarang as $val){
						echo $val->kuantitas."<br>";
					}
					?>
					</td>
					<td>
					<?php 
					foreach($listBarang as $val){
						$satuan = $this->db->get_where('pembelian_pemesanan_d',array('id_barang'=>$val->id_barang))->row();
						echo $satuan->satuan."<br>";
					}
					?>
					</td>
					<td>
					<?php 
					foreach($listBarang as $val){
						echo $val->keterangan."<br>";
					}
					?>
					</td>
				</tr>
			</table>
		</section>
		<section class="footer">
			<table style="width: auto">
			<th>
				<p>Deterima,</p>
				<h4>jtafkajskld</h4>
				<div class="kurung">
					<span>(</span>
					<p>asdf</p>
					<span>)</span>
				</div>
			</th>
			<th>
				<p>Deterima,</p>
				<h4>jtafkajskld</h4>
				<div class="kurung">
					<span>(</span>
					<p>asdf</p>
					<span>)</span>
				</div>
			</th>
			<th>
				<p>Deterima,</p>
				<h4>jtafkajskld</h4>
				<div class="kurung">
					<span>(</span>
					<p>asdf</p>
					<span>)</span>
				</div>
			</th>
			<th>
				<p>Deterima,</p>
				<h4>jtafkajskld</h4>
				<div class="kurung">
					<span>(</span>
					<p>asdf</p>
					<span>)</span>
				</div>
			</th>
		</table>
			<div class="catatankiribawah">
				<p>Catatan :</p>
				<p>Laporan penerimaan barang ini, harus dilampiri dengan copy surat jalan dari supplier</p>
			</div>
			<div class="tandatangan">
				<p>Deterima,</p>
				<h4>jtafkajskld</h4>
				<div class="kurung">
					<span>(</span>
					<p>asdf</p>
					<span>)</span>
				</div>

			</div>
		</section>
	</div>
</body>
</html>