<SCRIPT LANGUAGE="JavaScript">
function sendValue(nourut,id_surat_jalan,no_dokumen,id_order,id_customer,nama,no_invoice,no_surat_jalan,telpon,kota_customer,alamat_customer){
	window.opener.document.getElementById('nourut').value= nourut;
	window.opener.document.getElementById('id_surat_jalan').value= id_surat_jalan;
	window.opener.document.getElementById('no_surat').value= no_dokumen;
	window.opener.document.getElementById('id_order_invoice').value= id_order;
	window.opener.document.getElementById('id_customer').value= id_customer;
	//window.opener.document.getElementById('kode_customer').value= kode_customer;
	window.opener.document.getElementById('no_invoice').value= no_invoice;
	window.opener.document.getElementById('nama_customer').value= nama;
	window.opener.document.getElementById('no_dokumen').value= no_surat_jalan;
	window.opener.document.getElementById('telp_customer').value= telpon;
	window.opener.document.getElementById('kota_customer').value= kota_customer;
	window.opener.document.getElementById('alamat_customer').value= alamat_customer;
	//alert(id_order);
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
						<th width="30%">No Surat Jalan</th>
						<th width="25%">Nama Customer</th>
						<th width="20%">Kode Customer</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1; foreach($list as $row){ 
					$pecah_no_invoice=explode('/',$row->no_surat_jalan);
					$nourut=$this->penjualan_invoice_m->ceknoinv();
					$no_invoice=$nourut.'/'.$pecah_no_invoice[1].'/INV';
					$href = "'".$nourut."','".$row->id_surat_jalan."','".$row->no_dokumen."','".$row->id_order."','".$row->id_customer."','".$row->nama."','".$no_invoice."','".$row->no_surat_jalan."','".$row->telpon."','".$row->kota."','".$row->alamat."'";?>
					<tr>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$no?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->no_surat_jalan?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->nama?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)"><?=$row->kode_customer?></a></td>
						<td><a style="text-decoration:none;" href="" onClick="sendValue(<?=$href?>)">select</a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
			</div>
	</div>
</div>