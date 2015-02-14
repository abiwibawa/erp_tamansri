<SCRIPT LANGUAGE="JavaScript">
function sendValue(id_ttd,nama,jabatan){
	window.opener.document.getElementById('id_ttd').value= id_ttd;
	window.opener.document.getElementById('tanda_tangan_surat').value= nama+' ('+jabatan+')';
	//alert(jabatan);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Customer</h4>
			</div>
			<form action="<?=base_url('penjualan_invoice/carisuratjalan')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4"><?=form_input('key',$this->form_data->key,'class="form-control" placeholder="Nomor Surat Jalan"')?></div>
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
						<th>Nama</th>
						<th>Jabatan</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1; foreach($list as $row){ 
					$href = "'".$row->id_ttd."','".$row->nama."','".$row->jabatan."'";?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->jabatan?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>