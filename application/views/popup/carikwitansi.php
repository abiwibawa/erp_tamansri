<SCRIPT LANGUAGE="JavaScript">
function sendValue(id_kwitansi,nilai,no_kwitansi){
	window.opener.document.getElementById('id_kwitansi').value= id_kwitansi;
	window.opener.document.getElementById('subtotal').value= nilai;
	window.opener.document.getElementById('no_kwitansi').value= no_kwitansi;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Kwitansi</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="25%">No Kwitansi</th>
						<th width="5%">Total</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_kwitansi?>','<?=$row->total?>','<?=$row->no_kwitansi?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_kwitansi?>','<?=$row->total?>','<?=$row->no_kwitansi?>')"><?=$row->no_kwitansi?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_kwitansi?>','<?=$row->total?>','<?=$row->no_kwitansi?>')"><?=$row->total?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_kwitansi?>','<?=$row->total?>','<?=$row->no_kwitansi?>')">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>