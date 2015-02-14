<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,nama){
	window.opener.document.getElementById('id_supir').value= id;
	window.opener.document.getElementById('pengemudi').value= nama;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Pengemudi</h4>
			</div>
			<form action="<?=base_url('master_popup/carisupir')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Nama</div>
					<div class="col-md-4"><?=form_input('key',$this->form_data->key,'class="form-control" placeholder="Cari Nama Pengemudi" ')?></div>
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
						<th width="5%">Nama</th>
						<th width="5%"></th>
						<th width="5%"></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_supir?>','<?=$row->nama?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_supir?>','<?=$row->nama?>')"><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_supir?>','<?=$row->nama?>')">select</a></td>
						<td></td>
						<td></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>