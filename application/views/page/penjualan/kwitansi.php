<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kuitansi</title>
	<style>
		* {
			padding: 0;
			margin: 0;
			-webkit-box-sizing: border-box;
			   -moz-box-sizing: border-box;
			        box-sizing: border-box;
		}
		
		.container {
			position: relative;
			width: 24cm;
			height: 14cm;
			margin: 20px auto;
			border: 3px solid #2587A7;
		}

		header {
			position: relative;
			font-family: serif;
			width: 100%;
			height: 90px;
			border-bottom: 2px solid #2587A7;
		}

			.ataskiri {
				position: absolute;
				left: 10px;
				top: 5px;
			}

			.ataskiri h1 {
				font-size: 2.5rem;
				font-family: Edwardian Script ITC;
			}

			.ataskiri h4 {
				font-weight: 400;
				font-size: small;
			}

			.ataskanan {
				position: absolute;
				right: 130px;
				top: 10px;
			}

			.ataskanan h1 {
				font-size: 2.6rem;
				font-weight: 400;
			}

			.ataskanan p {
				font-weight: 800;
			}

		section {
			position: relative;
			font-family: sans-serif;
			width: 100%;
			margin-top: 2px;
			border-top: 2px solid #2587A7;
			padding: 30px;
		}

			.tabelpertama {
				position: relative;
				width: 100%;
				font-size: 1.1rem;
				padding-right: 10px;
				border-spacing: 5px;
			}

				.tabelpertama td {
					padding: 3px;
				}

				.tabelpertama td:first-child {
					width: 200px;
				}

				.tabelpertama td:nth-child(2) {
					width: 30px;	
				}

				.wtf {
					background-color: #eee;
				}

			.bawahnyatabelpertama {
				position: relative;
				left: 245px;
				font-size: 0.9rem;
			}

				.bawahnyatabelpertama td {
					padding: 2px;
				}

				.bawahnyatabelpertama td:first-child {
					width: 150px;
				}

			.jumlah {
				position: relative;
				margin-top: 25px;
				width: 350px;
			}

				.jumlah span {
					margin-left: 5px;
					font-size: 1rem;
				}

				.kotakjumlah {
					position: absolute;
					width: 240px;
					top: -20px;
					right: 0;
					padding: 10px;
					border: 2px solid #333;
					font-size: 1.2rem;
					-webkit-transform: skew(-35deg);
					   -moz-transform: skew(-35deg);
					     -o-transform: skew(-35deg);
				}

				.kotakjumlah > table {
					width: 100%;
					padding-left: 10px;
					padding-right: 10px;
					-webkit-transform: skew(35deg);
					   -moz-transform: skew(35deg);
					     -o-transform: skew(35deg);
				}

				.kotakjumlah > table td:first-child {
					width: 50px;
				}

				.kotakjumlah > table td:nth-child(2) {
					width: 160px;
					padding-right: 10px;
					text-align: right;
				}

			.bawahkiri {
				margin-top: 30px;
				padding-left: 5px;
			}

				.bawahkiri p {
					padding: 1px;
				}

				.bawahkiri p:first-child {
					text-decoration: underline;
					font-size: 0.8rem;
				}

				.bawahkiri p:nth-child(2) {
					font-size: 0.8rem;
				}

				.bawahkiri p:nth-child(3) {
					font-size: 0.9rem;
				}

				.bawahkiri p:last-child {
					font-size: 0.9rem;
				}

			.bawahkanan {
				position: absolute;
				right: 160px;
				bottom: 20px;
				font-size: 0.9rem;
			}

				.bawahkanan p:first-child {
					padding-bottom: 3px;
				}

				.bawahkanan p:nth-child(3) {
					font-size: 1.1rem;
					text-decoration: underline;
					padding-top: 70px;
					padding-bottom: 3px;
				}
	</style>
</head>
<body>
<div class="container">
	<header>
		<div class="ataskiri">
			<h1>PT. Taman Sriwedari</h1>
			<h4>JL. SERSAN KKO USMAN NO. 27.DS. DANDANGAN, KEC GAMPENG, KAB KEDIRI</h4>
		</div>
		<div class="ataskanan">
			<h1>KWITANSI</h1>
			<p>Nomor : <?=$header['no_kwitansi']?></p>
		</div>
	</header>

	<section>
		<table class="tabelpertama">
			<tr>
				<td>Sudah Terima Dari</td>
				<td>:</td>
				<td><?=$header['nm_customer']?></td>
			</tr>
			<tr>
				<td>Banyaknya Uang</td>
				<td>:</td>
				<td class="wtf"><?=$header['terbilang']?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="wtf">&nbsp;</td>
			</tr>
			<tr>
				<td>Untuk Pembayaran</td>
				<td>:</td>
				<td>Sesuai Invoice No.</td>
			</tr>
		</table>
		<table class="bawahnyatabelpertama">
		<?php foreach($detail as $row){?>
			<tr>
				<td></td>
				<td>:</td>
				<td><?=$row['no_invoice']?></td>
			</tr>
		<?php } ?>
		</table>
		<div class="jumlah">
			<span>JUMLAH</span>
			<div class="kotakjumlah">
				<table>
					<tr>
						<td>Rp.</td>
						<td><?=$header['total']?></td>
						<td>,-</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="bawahkiri">
			<p>Pembayaran Harap di transfer ke,</p>
			<p>BANK BCA - Cab-Kediri</p>
			<p>A/c No. 033-000988-8</p>
			<p>A/n PT. Taman Sriwedari</p>
		</div>
		<div class="bawahkanan">
			<p>Kediri, <?=$header['tanggal']?></p>
			<p>Hormat Kami</p>
			<p><?=$header['nama_ttd']?></p>
			<p><?=$header['jabatan_ttd']?></p>
		</div>
	</section>
</div>

</body>
</html>