<SCRIPT LANGUAGE="JavaScript">
$(function() {
	$(".pilih").click(function() {
		window.opener.document.getElementById('no_dokumen').value=$(this).attr("no_surat_jalan");
		window.opener.document.getElementById('nama').value=$(this).attr("nama");
		window.opener.document.getElementById('alamat').value=$(this).attr("alamat");
		window.opener.document.getElementById('npwp').value=$(this).attr("npwp");
		window.close();
	});
});

function sendValue(id_invoice,id_order,id_customer,id_surat_jalan,no_surat_jalan,nama,alamat,npwp){
	window.opener.document.getElementById('id_invoice').value=id_invoice;
	window.opener.document.getElementById('id_order').value=id_order;
	window.opener.document.getElementById('id_customer').value=id_customer;
	window.opener.document.getElementById('id_surat_jalan').value=id_surat_jalan;
	window.opener.document.getElementById('no_dokumen').value=no_surat_jalan;
	window.opener.document.getElementById('nama').value=nama;
	window.opener.document.getElementById('alamat').value=alamat;
	window.opener.document.getElementById('npwp').value=npwp;
	window.close();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Customer</h4>
			</div>
			<form action="<?=base_url('penjualan_fp/carisuratjalan')?>" method="post">
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
						<th width="25%">Nama Customer</th>
						<th width="20%">Alamat</th>
						<th width="20%">NPWP</th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1; 
					foreach($list as $row){ 
						$datas=array("id_invoice"=>$row->id_invoice,
									"id_order"=>$row->id_order,
									"id_customer"=>$row->id_customer,
									"id_surat_jalan"=>$row->id_surat_jalan,
									"no_surat_jalan"=>$row->no_surat_jalan,
									"nama"=>$row->nama,
									"alamat"=>$row->alamat,
									"npwp"=>$row->npwp);
						$data='';
						$n=1;
						foreach($datas as $key=>$val){
							if(count($datas)==$n)
								$data=$data." '".$val."'";
							else
								$data=$data." '".$val."',";
							$n++;
						}
						?>
						<tr>
							<td><?=$no?></td>
							<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->nama?></a></td>
							<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->alamat?></a></td>
							<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" ><?=$row->npwp?></a></td>
							<td><a style="text-decoration:none;" onClick="sendValue(<?=$data?>)" >select</a></td>
						</tr>
						<?php $no++; 
					} ?>
				</tbody>
				</table>
			</div>
	</div>
</div>