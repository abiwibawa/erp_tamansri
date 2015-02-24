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
		<th width="25%">Nama Customer</th>
		<th width="20%">Alamat</th>
		<th width="20%">NPWP</th>
		<th width="5%"></th>
	</tr>
</thead>
<tbody>
	<?php 
	$no=1; 
	foreach($list as $row){ 
		$datas=array("id_invoice"=>$row->id_invoice,
					"id_order"=>$row->id_order,
					"id_customer"=>$row->id_customer,
					"id_surat_jalan"=>$row->id_surat_jalan,
					"no_surat_jalan"=>$row->no_surat_jalan,
					"nama"=>$row->nama,
					"alamat"=>$row->alamat,
					"npwp"=>$row->npwp);
		$data='';
		$n=1;
		foreach($datas as $key=>$val){
			if(count($datas)==$n)
				$data=$data." '".$val."'";
			else
				$data=$data." '".$val."',";
			$n++;
		}
		?>
		<tr>
			<td><?=$no?></td>
			<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->nama?></a></td>
			<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->alamat?></a></td>
			<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->npwp?></a></td>
			<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" >select</a></td>
		</tr>
		<?php $no++; 
	} ?>
</tbody>
</table>
