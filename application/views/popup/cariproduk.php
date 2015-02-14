<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,kode,nama){
	window.opener.document.getElementById('id_barang').value= id;
	window.opener.document.getElementById('kode_barang').value= kode;
	window.opener.document.getElementById('nama_barang').value= nama;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Produk</h4>
			</div>
			<form action="<?=base_url('master_popup/cariproduk')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2"><?=form_dropdown('filter',array('kode'=>'Kode Produk','nama'=>'Nama'),$this->form_data->filter,'class="form-control"')?></div>
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
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">Kode Barang</th>
						<th width="25%">Nama Barang</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>')"><?=$row->kode_barang?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>')"><?=$row->nama_barang?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>')">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>