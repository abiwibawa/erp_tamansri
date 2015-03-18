<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,kode,nama,telp,alamat,kota){
	window.opener.document.getElementById('id_suplier').value= id;
	window.opener.document.getElementById('kode_suplier').value= kode;
	window.opener.document.getElementById('nama_suplier').value= nama;
	window.opener.document.getElementById('alamat_suplier').value= alamat;
	window.opener.document.getElementById('telp_suplier').value= telp;
	window.opener.document.getElementById('kota_suplier').value= kota;
	//alert(Nama);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Suplier</h4>
			</div>
			<form action="<?=base_url('pembelian_pemesanan/carisuplier')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2"><?=form_dropdown('filter',array('kode'=>'Kode suplier','nama'=>'Nama'),$this->form_data->filter,'class="form-control"')?></div>
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
						<th width="5%">Kode Suplier</th>
						<th width="25%">Nama Suplier</th>
						<th width="10%">Kota</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($list as $row){ ?>
					<?php $href = "'".$row->id_suplier."','".$row->kode_suplier."','".$row->nama."','".$row->telpon."','".$row->alamat."','".$row->kota."'";?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_suplier?>','<?=$row->kode_suplier?>','<?=$row->nama?>','<?=$row->telpon?>','<?=$row->alamat?>','<?=$row->kota?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_suplier?>','<?=$row->kode_suplier?>','<?=$row->nama?>','<?=$row->telpon?>','<?=$row->alamat?>','<?=$row->kota?>')"><?=$row->kode_suplier?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_suplier?>','<?=$row->kode_suplier?>','<?=$row->nama?>','<?=$row->telpon?>','<?=$row->alamat?>','<?=$row->kota?>')"><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_suplier?>','<?=$row->kode_suplier?>','<?=$row->nama?>','<?=$row->telpon?>','<?=$row->alamat?>','<?=$row->kota?>')"><?=$row->kota?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_suplier?>','<?=$row->kode_suplier?>','<?=$row->nama?>','<?=$row->telpon?>','<?=$row->alamat?>','<?=$row->kota?>')">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>