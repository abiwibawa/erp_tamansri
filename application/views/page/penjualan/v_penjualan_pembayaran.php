<script>
	function popupcaricustomer(){
		var vurl = "<?=base_url('master_popup/caricustomer')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupproduk(){
		var vurl = "<?=base_url('master_popup/cariproduk')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Pembayaran Piutang</h2>
					<div class="side pull-right">
						<button class="simpan_order btn btn-primary" data-url="<?=base_url('penjualan_order/aprove_order')?>">
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
	<form action="<?=$action_form?>" id="form_order" method="post">
	<input type="hidden" name="id_order" id="id_order" value="">
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Header Pembayaran</h4>
			</div>				
			<div class="content controls">				
				<div class="form-row">
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kode Customer</div>
					<div class="col-md-3"><?=form_input('kode_customer','','class="form-control" id="kode_customer" ')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaricustomer()">cari</button></div>
					<input type="hidden" name="id_customer" id="id_customer">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer','','class="form-control" id="nama_customer" readonly="readonly"')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Jenis Pembayaran</div>
					<div class="col-md-4"><?=form_dropdown('jenis_bayar',array('1'=>'Giro','2'=>'Cek','3'=>'Tunai Transfer'),'','class="form-control" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Bank Asal</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
					
					<div class="col-md-2">Bank Tujuan</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Rekening Asal</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
					
					<div class="col-md-2">Rekening Tujuan</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Bank Giro</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
					
					<div class="col-md-2">No Giro</div>
					<div class="col-md-4"><?=form_input('bank_asal','','class="form-control" ')?></div>
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
					<div class="col-md-4">Tagihan:</div>
					<div class="col-md-7"><?=form_input('subtotal','','class="form-control" id="subtotal" readonly="readonly" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Yang di Bayar:</div>
					<div class="col-md-7"><?=form_input('pengiriman','0','class="form-control" id="pengiriman" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Sisa Tagihan:</div>
					<div class="col-md-7"><?=form_input('total_harga','','class="form-control" id="total_harga" readonly="readonly" ')?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Detail Pembayaran</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">No. Invoice:</div>
					<div class="col-md-4"><?=form_input('kode_barang','','class="form-control" id="kode_barang" readonly ')?></div>
					<input type="hidden" name="id_barang" id="id_barang">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
					<div class="col-md-1">Nilai : Rp</div>
					<div class="col-md-4"><?=form_input('nama_barang','','class="form-control" id="nama_barang" readonly')?></div>
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
						<th width="25%">No Invoice</th>
						<th width="5%">Nilai</th>
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