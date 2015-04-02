<SCRIPT LANGUAGE="JavaScript">
function sendValue(id,kode,nama,qty){
	window.opener.document.getElementById('id_barang').value= id;
	window.opener.document.getElementById('kd_barang').value= kode;
	window.opener.document.getElementById('nama_barang').value= nama;
	window.opener.document.getElementById('kuantitas_barang').value= qty;
	window.opener.document.getElementById('qty_barang').value= qty;
	//alert(kode);
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block block-white">
			<div class="header">
				<h4>Cari Barang Pemesanan</h4>
			</div>
			
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped-row table-striped">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">Kode barang</th>
						<th width="10%">Nama Barang</th>
						<th width="10%">Kuantitas</th>
						<th width="1%">&nbsp </th>
					</tr>
				</thead>
				<tbody>
				
					<?php $no=1; foreach($list as $row){  ?>
					<tr>
						<td><a style="text-decoration:none;" href="" ><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" ><?=$row->kode_barang?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->nama_barang?></a></td>
						<td><a style="text-decoration:none;" ><?=$row->kuantitas-$row->total?></a></td>
						<td><a style="text-decoration:none;" class="btn btn-success btn-clean" href="" 
						onClick="sendValue('<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>','<?=$row->kuantitas-$row->total?>')">
						select
						</a></td>
					</tr>
					<?php $no++; } ?>
				
				</tbody>
				</table>
			</div>
	</div>
</div>