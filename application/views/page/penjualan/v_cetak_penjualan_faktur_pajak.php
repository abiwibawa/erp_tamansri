<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
		/* http://meyerweb.com/eric/tools/css/reset/ 
		   v2.0 | 20110126
		   License: none (public domain)
		*/

		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed, 
		figure, figcaption, footer, header, hgroup, 
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,
		q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		/* CSS STARTS HERE */
		body {
			font-family: sans-serif;
		}
		section {
			position: relative;
			width: 210mm;
			/*min-height: 297mm;*/
			width: 960px;
			margin: 0 auto;
			padding-top: 100px;
		}

		.kotak-pojok-kanan-atas {
			position: absolute;
			top: 10px;
			right: 0px;
			width: 400px;
			border: 2px solid #eee;
			padding: 5px 15px;
			text-align: center;
			font-family: serif;
		}
		
		section > h1 {
			font-weight: bold;
			font-size: 1.5rem;
			text-transform: uppercase;
			text-align: center;
		}

		.main-box {
			position: relative;
			width: 100%;
			border: 4px solid #111;
			padding-bottom: 30px;
		}

		.alohomora {
			padding: 13px 0 0 6px;
			font-size: 1.1rem;
			font-weight: bold;
			border-bottom: 2px solid #ddd;
			border-top: 2px solid #ddd;
		}

		table {
			width: 100%;
		}

			.tabletops td {
				padding: 6px;
				font-size: 0.9rem;
			}

			.tabletops td:first-child {
				font-weight: bold;
				width: 250px;
			}

			.tabletops td:nth-child(2) {
				font-weight: bold;
				width: 6px;
			}

			.tabletops.tops {
				margin-bottom: 20px;
			}

			.tabletops.tops td {
				padding: 3px 6px 2px 6px;
			}

			.tabletops.tops td:last-child {
				font-family: serif;
				font-size: 1rem;
			}

		.tablemiddle th, .tablemiddle td {
			padding: 10px 5px;
			border: 2px solid #ddd;
		}

			.tablemiddle th {
				vertical-align: middle;
			}

			.tablemiddle th:first-child, .tablemiddle td:first-child {
				width: 50px;
			}

			.tablemiddle th:last-child, .tablemiddle td:last-child {
				width: 200px;
			}

			.fill {
				height: 422px;
			}

			.bawahnya-fill {
				font-family: serif;
			}

				.bawahnya-fill td:first-child {
					padding: 5px 5px 2px 60px;
				}

			.fill td:last-child, .bawahnya-fill td:last-child {
				text-align: right;
				font-family: sans-serif;
			}

		section h2 {
			margin: 20px 0 0 10px;
			font-size: 1.2rem;
		}

		.tablebottom {
			width: 450px;
			margin-top: 20px;
		}

			.tablebottom th, .tablebottom td {
				border: 2px solid #ddd;
				padding: 5px;
			}

			.tablebottom th, .tablebottom td:first-child {
				text-align: center;
			}

			.tablebottom td:first-child {
				width: 120px;
			}

			.tablebottom td:nth-child(2) {
				width: 140px;
			}

			.tablebottomfill {
				font-family: serif;
				font-size: 0.9rem;
				line-height: 1.3;
			}

		.tanda-tangan {
			position: absolute;
			right: 75px;
			bottom: 50px;
			width: 200px;
			text-align: center;
		}

			.tanda-tangan p:first-child {
				margin-bottom: 100px;
			}

		.tulisan-paling-bawah {
			margin-top: 7px;
			font-family: serif;
			margin-bottom: 30px;
			font-size: 0.9rem;
		}

		@page {
        size: A4;
        margin: 0;
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .section {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

	</style>
</head>
<body>
	<?php
	$header_cetak=array(
				"1"=>"Untuk Pembeli BKP/Penerima JKP Sebagai Bukti Pajak Masukan",
				"2"=>"Untuk Pengusaha kena Pajak yang menerbitkan Faktur Pajak Standar sbg bukti keluaran",
				"3"=>"Untuk Kantor Pelayanan dlm hal Penyerahan barang kena Pajak atau jasa kena Pajak dilakukan kepada pemungut Pajak Pertambahan Nilai",
				);
	for($a=1;$a<=3;$a++){?>
	<section>
		<div class="kotak-pojok-kanan-atas">
			Lembar ke-<?=$a?> : <?=$header_cetak[$a]?> 
		</div>
		<h1>Faktur Pajak</h1>
		<div class="main-box">
			<!-- BAGIAN ATAS -->
			<table class="tabletops">
				<tr>
					<td>Kode dan Nomor Seri Faktur Pajak</td>
					<td>:</td>
					<td><?=$data->kode_transaksi.".".$data->no_faktur?></td>
				</tr>
			</table>
			<div class="alohomora">Pengusaha Kena Pajak :</div>
			<table class="tabletops tops">
				<tr>
					<td>N a m a</td>
					<td>:</td>
					<td><?=$perusahaan->nama?></td>
				</tr>
				<tr>
					<td>A l a m a t</td>
					<td>:</td>
					<td><?=$perusahaan->alamat?></td>
				</tr>
				<tr>
					<td>N.P.W.P.</td>
					<td>:</td>
					<td><?=$perusahaan->npwp?></td>
				</tr>
			</table>
			<div class="alohomora">Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak :</div>
			<table class="tabletops tops">
				<tr>
					<td>N a m a</td>
					<td>:</td>
					<td><?=$data->nama?></td>
				</tr>
				<tr>
					<td>A l a m a t</td>
					<td>:</td>
					<td><?=$data->alamat?></td>
				</tr>
				<tr>
					<td>N.P.W.P.</td>
					<td>:</td>
					<td><?=$data->npwp?></td>
				</tr>
			</table>

			<!-- TABEL TENGAH -->
			<table class="tablemiddle">
				<thead>
					<tr>
						<th>No. Urut</th>
						<th>Nama Barang Kena Pajak / Jasa Kena Pajak</th>
						<th>Harga Jual/Penggantian Uang Muka/Termijn *)<br/>(Rp.)</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no=1;
						echo "<tr class='fill'><td>";
						foreach($detailfakturpajak as $row){
							echo $no."<br>";
							$no++;
						};
						echo "</td><td>";
						foreach($detailfakturpajak as $row){
							echo $row->nama_barang." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->kuantitas." ".$row->satuan." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @ ".$row->harga."<br>";
						}
						echo "</td><td>";
						foreach($detailfakturpajak as $row){
							echo $this->gp_m->Rupiah($row->kuantitas*$row->harga)."<br>";
						};
						echo "</td></tr>";
				
				?>
					<tr class="bawahnya-fill">
						<td colspan="2">Jumlah Harga Jual / Pengganti / Uang Muka / Termijn )*</td>
						<td><?=$this->gp_m->Rupiah($data->subtotal)?></td>
					</tr>
					<tr class="bawahnya-fill">
						<td colspan="2">Dikurangi Potongan Harga</td>
						<td><?=$this->gp_m->Rupiah($data->potongan)?></td>
					</tr>
					<tr class="bawahnya-fill">
						<td colspan="2">Dikurangi Uang Muka Yang Diterima</td>
						<td><?=$this->gp_m->Rupiah($data->uang_muka)?></td>
					</tr>
					<tr class="bawahnya-fill">
						<td colspan="2">Dasar Pengenaan Pajak</td>
						<td><?=$this->gp_m->Rupiah($data->dasar_pajak)?></td>
					</tr>
					<tr class="bawahnya-fill">
						<td colspan="2">PPN = 10% x Dasar Pengenaan Pajak</td>
						<td><?=$this->gp_m->Rupiah($data->dasar_pajak/10) ?></td>
					</tr>
				</tbody>
			</table>

			<!-- BAGIAN BAWAH -->
			<h2>Pajak Penjualan Atas Barang Mewah</h2>
			<table class="tablebottom">
				<tr>
					<th>Tarif</th>
					<th>DPP</th>
					<th>PPn BM</th>
				</tr>
				<tr class="tablebottomfill">
					<td>......................%<br/>......................%<br/>......................%<br/>......................%</td>
					<td>Rp. .........................<br/>Rp. .........................<br/>Rp. .........................<br/>Rp. .........................</td>
					<td>Rp. .........................<br/>Rp. .........................<br/>Rp. .........................<br/>Rp. .........................</td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align: center;">TOTAL</td>
					<td>Rp. .........................</td>
				</tr>
			</table>
			<div class="tanda-tangan">
				<p>Kediri, <?= $this->gp_m->RubahTanggal($data->tanggal_indo)?></p><p>Nama : Drs. Suwanto</p>
			</div>
		</div>
		<p class="tulisan-paling-bawah">*) Coret yang tidak perlu</p>
	</section>
	<?php } ?>
</body>
</html>