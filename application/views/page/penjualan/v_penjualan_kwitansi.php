<script>
	function popupproduk(){
		var id_customer = $("#id_customer").val();
		var vurl = "<?=base_url('master_popup/cariinv')?>";
		var openwindow = window.open(vurl+'?id_customer='+id_customer,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupcarisupir(){
		var vurl = "<?=base_url('master_popup/carittd')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupcaripo(){
		var vurl = "<?=base_url('master_popup/caricustomer_inv')?>";
		var openwindo = window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function tampil(){
		var id_order = $("#id_order").val();
		var vurl = "<?=base_url('penjualan_sj/get_data_order')?>";
		panggil(id_order,vurl);
	}
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Kwitansi Penjualan</h2>
					<div class="side pull-right">
						<button class="simpan_kw btn btn-primary" data-url="<?=base_url('penjualan_kwitansi/aprove_order')?>">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<button class="clearform btn btn-primary">
							<i class="icon-print"></i>&nbsp;&nbsp;print
						</button>
						
						<button class="clearform btn btn-primary">
							<i class="icon-refresh"></i>&nbsp;&nbsp;clear
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form action="<?=$action_form?>" id="form_kw" method="post">
	<input type="hidden" name="id_temp" id="id_temp" value="<?=$this->form_data->id_temp?>">
	<input type="hidden" name="id_customer" id="id_customer" value="">
	<input type="hidden" name="id_kwitansi" id="id_kwitansi" value="">
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Header Kwitansi</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">No. Kwitansi</div>
					<div class="col-md-4"><?=form_input('no_surat','','class="form-control" readonly')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kode Customer</div>
					<div class="col-md-3"><?=form_input('kode_customer','',' class="form-control" id="kode_customer" readonly ')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaripo()">cari</button></div>
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer','','class="form-control" id="nama_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Alamat Customer</div>
					<div class="col-md-4"><?=form_input('alamat_customer','','class="form-control" id="alamat_customer" readonly="readonly"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">No.Telp Customer</div>
					<div class="col-md-4"><?=form_input('telp_customer','','class="form-control" id="telp_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Kota Customer</div>
					<div class="col-md-4"><?=form_input('kota_customer','','class="form-control" id="kota_customer" readonly="readonly"')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Penanda Tangan</div>
					<div class="col-md-3"><?=form_input('ttd','','class="form-control" id="ttd" readonly')?></div>
					<input type="hidden" name="id_ttd" value="" id="id_ttd">
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcarisupir()">cari</button></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Jumlah Uang</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-12"><?=form_input('total','','class="form-control" id="total" readonly')?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Detail Kwitansi</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">No Invoice:</div>
					<div class="col-md-2"><?=form_input('no_invoice','','class="form-control" id="no_invoice" readonly ')?></div>
					<input type="hidden" name="id_invoice" id="id_invoice">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
					<div class="col-md-1">No Order:</div>
					<div class="col-md-2"><?=form_input('no_order','','class="form-control" id="no_order" readonly')?></div>
					<div class="col-md-1">Nilai:</div>
					<div class="col-md-2"><?=form_input('subtotal','','class="form-control" id="subtotal" readonly')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-12"><button type="submit" class="btn btn-block btn-success">tambahkan</button></div>
				</div>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="20%">No Invoice</th>
						<th width="10%">Jumlah</th>
						<th width="5%">Aksi</th>                              
					</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
		</div>
	</div>
	</form>
</div>