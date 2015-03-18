<script>
$(document).ready(function(){
	$("#filter").change(function(){
		var filter = $("#filter").val();
		//alert(filter);
		if(filter=="no_surat_pemesanan"){
			$("#surat_pemesanan").show();
			$("#surat_jalan").hide();
			$("#tanggal").hide();
			$("#kode_suplier").hide();
			$("#nama_suplier").hide();
		}else if(filter=="no_surat_jalan"){
			$("#surat_pemesanan").hide();
			$("#surat_jalan").show();
			$("#tanggal").hide();
			$("#kode_suplier").hide();
			$("#nama_suplier").hide();
		}else if(filter=="tgl_masuk"){
			$("#surat_pemesanan").hide();
			$("#surat_jalan").hide();
			$("#tanggal").show();
			$("#kode_suplier").hide();
			$("#nama_suplier").hide();
		}else if(filter=="kode_suplier"){
			$("#surat_pemesanan").hide();
			$("#surat_jalan").hide();
			$("#tanggal").hide();
			$("#kode_suplier").show();
			$("#nama_suplier").hide();
		}else if(filter=="nama_suplier"){
			$("#surat_pemesanan").hide();
			$("#surat_jalan").hide();
			$("#tanggal").hide();
			$("#kode_suplier").hide();
			$("#nama_suplier").show();
		}else{
			$("#surat_pemesanan").hide();
			$("#surat_jalan").hide();
			$("#tanggal").hide();
			$("#kode_suplier").hide();
			$("#nama_suplier").hide();
		}
	})
})

function popup_carisuplier(){
	var vurl = "http://localhost/erp_tamansri/master_popup/carisuplier";
	window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
}
</script>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Lap. Penerimaan Barang</h2>
					<div class="side pull-right">
					<!--
						<button class="simpan_order btn btn-primary" data-url="<?=base_url('')?>">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<button class="clearform btn btn-primary">
							<i class="icon-refresh"></i>&nbsp;&nbsp;clear
						</button>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-8">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filter</h2>
			</div>
			<form id="validate" method="POST" action="<?=base_url('pembelian_lappenerimaan_barang/filter')?>">
			<?php
				$isi_cmb = array(
							''=>'--Silahkan Pilih Terlebih Dahulu--',
							'b.no_surat' => 'No. Surat Pemesanan',
							'd.no_surat_jalan' => 'No. Surat Jalan',
							'd.tanggal' => 'Tanggal Masuk',
							'e.kode_suplier' => 'Kode Suplier',
							'e.nama' => 'Nama Suplier'
						);
			?>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-4">
						<?=form_dropdown('filter',$isi_cmb,$this->form_data->cmb,'class="form-control validate[required]" id="filter" ')?>
					</div>
					<div class="col-md-4">
						<?=form_input('value',$this->form_data->value,'class="form-control validate[required]" id="" ')?>
					</div>
					<div class="col-md-2"><button type="submit" class="btn_tambah btn btn-block btn-success">proses</button></div>
				</div>	
			</div>
			</form>
		</div>
	</div>
	<!--
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header"><h2>Filter</h2></div>
			<div class="content controls">
				<div class="col-md-2"><?=form_input('nama_suplier','','class="form-control" id="" placeholder="No Surat Pemesanan"')?></div>
				<div class="col-md-2"><?=form_input('nama_suplier','','class="form-control" id="" placeholder="No Surat Jalan"')?></div>
				<div class="col-md-2"><?=form_input('nama_suplier','','class="form-control" id="" placeholder="Tanggal Masuk"')?></div>
				<div class="col-md-2"><?=form_input('nama_suplier','','class="form-control" id="" placeholder="Kode Suplier"')?></div>
				<div class="col-md-2"><?=form_input('nama_suplier','','class="form-control" id="" placeholder="Nama Suplier"')?></div>
				<div class="col-md-2">
					<button type="submit" class="btn_tambah btn btn-block btn-info">Filter</button>
				</div>
			</div>
		</div>
	</div>
	-->
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Detail Pemesanan Barang</h2>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th width="10%">No Surat</th>
						<th width="10%">No Surat Jalan</th>
						<th width="10%">Tgl Penerimaan</th>
						<th width="10%">&nbsp;</th> 
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				foreach($list as $row){
				?>
					<tr>
						<td width="1%"><?=$no?></td>
						<td width="10%"><?=$row->no_surat?></td>
						<td width="10%"><?=$row->no_surat_jalan?></td>
						<td width="10%"><?=$row->tanggal?></td>
						<td width="10%" align="center">
						<a href="#modal_default_3" data-toggle="modal" class="detil_penerimaan btn btn-info tip icon-search" title="Detail" data-id="<?=$row->no_surat_jalan?>" data-url="<?=base_url('pembelian_lappenerimaan_barang/detail_modal')?>" data-wd="700px" data-title="Detail Penerimaan NO Surat Jalan <?=$row->no_surat_jalan?>">&nbsp;</a>
						<?=anchor(base_url("pembelian_lappenerimaan_barang/edit/".$row->no_surat),'&nbsp;','data-toggle="modal" class="btn btn-warning tip icon-pencil" title="Edit"');?>
						<?=anchor(base_url("pembelian_lappenerimaan_barang/delete/".$row->no_surat),'&nbsp;','data-toggle="modal" class="btn btn-danger tip icon-trash" title="Hapus"');?>
						</td>                              
					</tr>
				<?php
				$no++; }
				?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>