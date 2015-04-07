<script>
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
		openwindo.onbeforeunload = function(){
			//alert("asdfasd");
			if(boll){
				var id_order = $("#id_order").val();
				var vurl = "<?=base_url('penjualan_order/get_data_temp')?>";
				panggil(id_order,vurl);
			}
			boll=false;
		}
	}
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Input Order</h2>
				</div>
			</div>
		</div>
	</div>
	<form action="<?=$action_form?>" id="validate" method="post" result="">
	<input type="hidden" name="id_order" id="id_order" value="<?=$this->form_data->id_order?>">
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Order Header</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">No Dokumen</div>
					<div class="col-md-4"><?=form_input('no_dokumen',$this->form_data->no_dokumen,' class="form-control" id="no_dokumen" ')?></div>
					<!--<div class="col-md-1"><button type="button" class="btn btn-success" onclick="popupcaritempdokumen()">cari</button></div>-->
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal',$this->form_data->tanggal,'class="datepicker form-control validate[required]" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kode Customer</div>
					<div class="col-md-4"><?=form_input('kode_customer',$this->form_data->kode_customer,'class="form-control" id="kode_customer" readonly')?></div>
					<!--<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaricustomer()">cari</button></div>-->
					<input type="hidden" name="id_customer" id="id_customer" value="<?=$this->form_data->id_customer?>">
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer',$this->form_data->nama_customer,'class="form-control" id="nama_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Alamat Customer</div>
					<div class="col-md-4"><?=form_input('alamat_customer',$this->form_data->alamat_customer,'class="form-control" id="alamat_customer" readonly="readonly"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">No.Telp Customer</div>
					<div class="col-md-4"><?=form_input('telp_customer',$this->form_data->telp_customer,'class="form-control" id="telp_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Kota Customer</div>
					<div class="col-md-4"><?=form_input('kota_customer',$this->form_data->kota_customer,'class="form-control" id="kota_customer" readonly="readonly"')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Syarat Pembayaran</div>
					<div class="col-md-4"><textarea name="syarat_bayar" id="syarat_bayar" class="form-control"><?=$this->form_data->syarat_bayar?></textarea></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Keterangan</div>
					<div class="col-md-4"><textarea name="keterangan_order" id="keterangan_order" class="form-control"><?=$this->form_data->keterangan?></textarea></div>
				</div>
				<div class="form-row">
					<div class="col-md-12"><button type="submit" class="btn_tambah btn btn-block btn-success">simpan</button></div>
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
					<div class="col-md-7"><?=form_input('subtotal',$this->form_data->subtotal,'class="form-control" id="subtotal" readonly="readonly" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Pengiriman:</div>
					<div class="col-md-7"><?=form_input('biaya_pengiriman',$this->form_data->pengiriman,'class="form-control count validate[required,custom[integer]]" id="pengiriman" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Grand Total:</div>
					<div class="col-md-7"><?=form_input('total_harga',$this->form_data->total_harga,'class="form-control" id="total_harga" readonly="readonly" ')?></div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>