<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,no_dokumen){
	window.opener.document.getElementById('id_order').value= id;
	window.opener.document.getElementById('no_dokumen').value= no_dokumen;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari No Dokumen</h4>
			</div>
			<form action="<?=base_url('master_popup/caripreorder')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">No Dokumen</div>
					<div class="col-md-4"><?=form_input('key',$this->form_data->key,'class="form-control" placeholder="Cari No Dokumen" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-4"><input type="submit" value="cari" class="btn-block btn"></div>
				</div>
			</div>
			</form>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">No Dokumen</th>
						<th width="5%">&nbsp;</th>
						<th width="5%">&nbsp;</th>
						<th width="5%">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order?>','<?=$row->no_dokumen?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order?>','<?=$row->no_dokumen?>')"><?=$row->no_dokumen?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order?>','<?=$row->no_dokumen?>')">select</a></td>
						<td width="5%">&nbsp;</td>
						<td width="5%">&nbsp;</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>