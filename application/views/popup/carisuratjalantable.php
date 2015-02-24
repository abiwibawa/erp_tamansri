<script>
$(function() {
	$(".sortables").dataTable({
		"iDisplayLength": 5,
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
	});
});
</script>
<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortables">
	<thead>
		<tr>
			<th width="2%">No</th>
			<th width="30%">No Surat Jalan</th>
			<th width="25%">Nama Customer</th>
			<th width="20%">Kode Customer</th>
			<th width="5%"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($list as $row){ 
		$pecah_no_invoice=explode('/',$row->no_surat_jalan);
		$nourut=$this->penjualan_invoice_m->ceknoinv();
		$no_invoice=$nourut.'/'.$pecah_no_invoice[1].'/INV';
		$href = "'".$nourut."','".$row->id_surat_jalan."','".$row->no_dokumen."','".$row->id_order."','".$row->id_customer."','".$row->nama."','".$no_invoice."','".$row->no_surat_jalan."','".$row->telpon."','".$row->kota."','".$row->alamat."'";?>
		<tr>
			<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$no?></a></td>
			<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->no_surat_jalan?></a></td>
			<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->nama?></a></td>
			<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->kode_customer?></a></td>
			<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)">select</a></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>