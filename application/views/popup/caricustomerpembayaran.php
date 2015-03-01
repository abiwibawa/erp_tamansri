<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,nama,kode){
	window.opener.document.getElementById('id_customer').value= id;
	window.opener.document.getElementById('kode_customer').value= kode;
	window.opener.document.getElementById('nama_customer').value= nama;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Customer</h4>
			</div>
			<form action="<?=base_url('master_popup/caricustomerpembayaran')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2"><?=form_dropdown('filter',array('kode'=>'Kode Customer','nama'=>'Nama'),$this->form_data->filter,'class="form-control"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-4"><?=form_input('key',$this->form_data->key,'class="form-control"')?></div>
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
						<th width="5%">Kode Customer</th>
						<th width="25%">Nama Customer</th>
						<th width="5%">Inisial</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_customer?>','<?=$row->nama?>','<?=$row->kode_customer?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_customer?>','<?=$row->nama?>','<?=$row->kode_customer?>')"><?=$row->kode_customer?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_customer?>','<?=$row->nama?>','<?=$row->kode_customer?>')"><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_customer?>','<?=$row->nama?>','<?=$row->kode_customer?>')"><?=$row->inisial?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_customer?>','<?=$row->nama?>','<?=$row->kode_customer?>')">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>