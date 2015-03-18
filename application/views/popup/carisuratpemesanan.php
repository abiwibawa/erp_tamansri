<SCRIPT LANGUAGE="JavaScript">
function sendValue(id_pemesanan_h,id_pemesanan_d,no_surat,kode_suplier,id_suplier,nama,alamat,telepon){
	window.opener.document.getElementById('id_pemesanan_h').value= id_pemesanan_h;
	window.opener.document.getElementById('id_pemesanan_d').value= id_pemesanan_d;
	window.opener.document.getElementById('no_surat').value= no_surat;
	window.opener.document.getElementById('kd_suplier').value= kode_suplier;
	window.opener.document.getElementById('id_suplier').value= id_suplier;
	window.opener.document.getElementById('alamat_suplier').value= alamat;
	window.opener.document.getElementById('nama_suplier').value= nama;
	window.opener.document.getElementById('telp').value= telepon;
	//alert(id_suplier);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block block-white">
			<div class="header">
				<h4>Cari No Surat Pemesanan</h4>
			</div>
			
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped-row table-striped">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">No Surat</th>
						<th width="10%">Kode Suplier</th>
						<th width="10%">Nama</th>
						<th width="10%">Alamat</th>
						<th width="5%">Telepon</th>
						<th width="1%">&nbsp </th>
					</tr>
				</thead>
				<tbody>
				
					<?php $no=1; foreach($list as $row){ ?>
					<tr>
						<td><a style="text-decoration:none;" href="" ><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" ><?=$row->no_surat?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->kode_suplier?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->alamat?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->telpon?></a></td>
						<td><a style="text-decoration:none;" class="btn btn-success btn-clean" href="" 
						onClick="sendValue('<?=$row->id_pemesanan_h?>','<?=$row->id_pemesanan_d?>','<?=$row->no_surat?>','<?=$row->kode_suplier?>','<?=$row->id_suplier?>','<?=$row->nama?>','<?=$row->alamat?>','<?=$row->telpon?>')">
						select
						</a></td>
					</tr>
					<?php $no++; } ?>
					
				</tbody>
				</table>
			</div>
	</div>
</div>