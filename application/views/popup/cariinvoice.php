<SCRIPT LANGUAGE="JavaScript">
function sendValue(idinv,idcust,noinv,nodok,total){
	window.opener.document.getElementById('id_invoice').value= idinv;
	window.opener.document.getElementById('no_invoice').value= noinv;
	window.opener.document.getElementById('no_order').value= nodok;
	window.opener.document.getElementById('subtotal').value= total;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari No Invoice</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="10%">No Invoice</th>
						<th width="10%">No Dokumen PO</th>
						<th width="10%">Nama Customer</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ 
					$val = "'".$row->id_invoice."','".$row->id_customer."','".$row->no_invoice."','".$row->no_dokumen."','".$row->total."'";
					?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$val?>)"><?=$row->no_invoice?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$val?>)"><?=$row->no_dokumen?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$val?>)"><?=$row->nama?></a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>