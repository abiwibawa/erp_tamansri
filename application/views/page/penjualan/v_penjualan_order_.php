<script>
	function popupcaricustomer(){
		var vurl = "<?=base_url('master_popup/caricustomer')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	function popupproduk(){
		var vurl = "<?=base_url('master_popup/cariproduk')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	function tampil(){
		var id_order = $("#id_order").val();
		//alert("afASF");
		var vurl = "<?=base_url('penjualan_order/get_data_temp')?>";
		panggil(id_order,vurl);
	}
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Input Order</h2>
					<div class="side pull-right">
						<button class="simpan_order btn btn-primary" data-url="<?=base_url('penjualan_order_/aprove_order')?>">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<button class="clearform btn btn-primary">
							<i class="icon-refresh"></i>&nbsp;&nbsp;clear
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form action="<?=$action_form?>" id="validate" method="post" result="po">
	<input type="hidden" name="id_order" id="id_order" value="">
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Order Header</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">No Dokumen</div>
					<div class="col-md-3"><?=form_input('no_dokumen','',' class="validate[required] form-control required" id="no_dokumen" ')?></div>
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="validate[required] datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kode Customer</div>
					<div class="col-md-4"><?=form_input('kode_customer','','class="validate[required] form-control" id="kode_customer" ')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaricustomer()">cari</button></div>
					<input type="hidden" name="id_customer" id="id_customer">
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
					<div class="col-md-2">Syarat Pembayaran</div>
					<div class="col-md-4"><textarea name="syarat_bayar" id="syarat_bayar" class="form-control"></textarea></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Keterangan</div>
					<div class="col-md-4"><textarea name="keterangan" id="keterangan" class="form-control"></textarea></div>
				</div>
			</div>
		</div>
	</div>
         
	<div class="col-md-3">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Biaya</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4">Subtotal:</div>
					<div class="col-md-7"><?=form_input('subtotal','','class="form-control" id="subtotal" readonly="readonly" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Pengiriman:</div>
					<div class="col-md-7"><?=form_input('pengiriman','0','class="form-control" id="pengiriman" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Grand Total:</div>
					<div class="col-md-7"><?=form_input('total_harga','','class="form-control" id="total_harga" readonly="readonly" ')?></div>
				</div>
			</div>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Order Detail</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Kode Barang:</div>
					<div class="col-md-4"><?=form_input('kode_barang','','class="validate[required] form-control" id="kode_barang" readonly ')?></div>
					<input type="hidden" name="id_barang" id="id_barang">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Nama Barang:</div>
					<div class="col-md-4"><?=form_input('nama_barang','','class="form-control" id="nama_barang" readonly')?></div>
					<div class="col-md-1">Satuan:</div>
					<div class="col-md-4"><?=form_input('satuan','','class="validate[required] form-control" id="satuan" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Qty:</div>
					<div class="col-md-4"><?=form_input('kuantitas','','class="validate[required,custom[number]] form-control" id="kuantitas" ')?></div>
					<div class="col-md-1">Harga:</div>
					<div class="col-md-4"><?=form_input('harga','','class="validate[required,custom[number]] form-control" id="harga" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">Keterangan:</div>
					<div class="col-md-10"><?=form_input('ketbarang','','class="validate[required] form-control" id="ketbarang" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-12"><button type="submit" class="btn_tambah btn btn-block btn-success">tambahkan</button></div>
				</div>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="25%">Kode / Nama Barang</th>
						<th width="5%">Qty</th>
						<th width="5%">Satuan</th>
						<th width="10%">Harga</th>
						<th width="10%">Total</th>
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
<script>
$(document).ready(function(){
	function popupcaricustomer(){
		var vurl = "<?=base_url('master_popup/caricustomer')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupproduk(){
		var vurl = "<?=base_url('master_popup/cariproduk')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupcaritempdokumen(){
		var vurl = "<?=base_url('master_popup/caritempdokumen')?>";
		var openwindo = window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
		var boll = true;
		/* openwindo.onbeforeunload = function(){
			//alert("asdfasd");
			if(boll){
				var id_order = $("#id_order").val();
				//alert(id_order);
				var vurl = "<?=base_url('penjualan_order/get_data_temp')?>";
				panggil(id_order,vurl);
			}
			boll=false;
		} */
	}
});
</script>