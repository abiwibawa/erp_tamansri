<SCRIPT LANGUAGE="JavaScript">
function sendValue(id_order_det,id_barang,kode,nama,harga,satuan){
	window.opener.document.getElementById('id_order_det').value= id_order_det;
	window.opener.document.getElementById('id_barang').value= id_barang;
	window.opener.document.getElementById('kode_barang').value= kode;
	window.opener.document.getElementById('nama_barang').value= nama;
	window.opener.document.getElementById('harga').value= harga;
	window.opener.document.getElementById('satuan').value= satuan;
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
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order_det?>','<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>','<?=$row->harga?>','<?=$row->satuan?>')"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order_det?>','<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>','<?=$row->harga?>','<?=$row->satuan?>')"><?=$row->kode_barang?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order_det?>','<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>','<?=$row->harga?>','<?=$row->satuan?>')"><?=$row->nama_barang?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue('<?=$row->id_order_det?>','<?=$row->id_barang?>','<?=$row->kode_barang?>','<?=$row->nama_barang?>','<?=$row->harga?>','<?=$row->satuan?>')">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>