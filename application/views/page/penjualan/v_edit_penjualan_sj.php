<script>
	function popupproduk(){
		var id_order = $("#id_order").val();
		var vurl = "<?=base_url('master_popup/cariproduk_order')?>";
		var openwindow = window.open(vurl+'?id_order='+id_order,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
		var boll = true;
		openwindow.onbeforeunload = function(){
			if(boll){
				var id_order_det = $("#id_order_det").val();
				var vurl = "<?=base_url('penjualan_sj/hitungsisa')?>";
				hitungsisa(id_order_det,vurl);
			}
			boll = false;
		}
	}
	
	function popupcaripo(){
		var vurl = "<?=base_url('master_popup/caripreorder')?>";
		var openwindo = window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
		var boll = true;
		openwindo.onbeforeunload = function(){
			//alert("asdfasd");
			if(boll){
				var id_order = $("#id_order").val();
				var vurl = "<?=base_url('penjualan_sj/get_data_order')?>";
				panggil(id_order,vurl);
				//$("#tanggal").focus();
			}
			boll=false;
		}
	}
	
	function popupcarisupir(){
		var vurl = "<?=base_url('master_popup/carisupir')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupcaripengirim(){
		var vurl = "<?=base_url('master_popup/caripengirim')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	$(document ).ready(function() {
		var id_order = $("#id_surat_jalan").val();
		var vurl = "<?=base_url('penjualan_sj/get_item_order')?>";
		
		var parsing = {id_order:id_order};
		console.log(parsing);
		$.ajax({
				type: "POST",
				dataType: "json",
				url : vurl,
				data: parsing,
				success: function(response){
					$('tbody').html('');
					$('tbody').append(response.vtabel);
					
					$(".hapus_item").click(function(){
						var durl = $(this).attr("direction");
						var id = $(this).attr("id");
						
						hapus_item(durl,id);
					});
				}
			});
	});
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Surat Jalan</h2>
					<div class="side pull-right">
						<button type="button" class="simpan_sj btn btn-primary" data-url="<?=base_url('penjualan_sj/aprove_order')?>">
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
	<form action="<?=$action_form?>" id="form_suratjalan" method="post">
	<input type="hidden" name="id_order" id="id_order" value="<?=$this->form_data->id_order?>">
	<input type="hidden" name="id_surat_jalan" id="id_surat_jalan" value="<?=$this->form_data->id_surat_jalan?>">
	<input type="hidden" name="id_temp" id="id_temp" value="">
	<input type="hidden" name="id_customer" id="id_customer" value="<?=$this->form_data->id_customer?>">
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Header Surat Jalan</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">No. Suat</div>
					<div class="col-md-4"><?=form_input('no_surat',$this->form_data->no_surat_jalan,'class="form-control" readonly')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">No Order</div>
					<div class="col-md-4"><?=form_input('no_dokumen',$this->form_data->no_dokumen,' class="form-control" id="no_dokumen" readonly')?></div>
					<!--<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaripo()">cari</button></div>-->
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal',$this->form_data->tanggal,'class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer',$this->form_data->nama,'class="form-control" id="nama_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Alamat Customer</div>
					<div class="col-md-4"><?=form_input('alamat_customer',$this->form_data->alamat,'class="form-control" id="alamat_customer" readonly="readonly"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">No.Telp Customer</div>
					<div class="col-md-4"><?=form_input('telp_customer',$this->form_data->telpon,'class="form-control" id="telp_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Kota Customer</div>
					<div class="col-md-4"><?=form_input('kota_customer',$this->form_data->kota,'class="form-control" id="kota_customer" readonly="readonly"')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Pengemudi</div>
					<div class="col-md-3"><?=form_input('pengemudi',$this->form_data->supir,'class="form-control" id="pengemudi" readonly')?></div>
					<input type="hidden" name="id_supir" value="<?=$this->form_data->id_supir?>" id="id_supir">
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcarisupir()">cari</button></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Pengirim</div>
					<div class="col-md-3"><?=form_input('pengirim',$this->form_data->pengirim,'class="form-control" id="pengirim" readonly')?></div>
					<input type="hidden" name="id_pengirim" value="<?=$this->form_data->id_pengirim?>" id="id_pengirim">
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaripengirim()">cari</button></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Detail Surat Jalan</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Kode Barang:</div>
					<div class="col-md-4"><?=form_input('kode_barang','','class="form-control" id="kode_barang" readonly ')?></div>
					<input type="hidden" name="id_barang" id="id_barang">
					<input type="hidden" name="id_order_det" id="id_order_det">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Nama Barang:</div>
					<div class="col-md-3"><?=form_input('nama_barang','','class="form-control" id="nama_barang" readonly')?></div>
					<div class="col-md-1">Satuan:</div>
					<div class="col-md-3"><?=form_input('satuan','','class="form-control" id="satuan" readonly')?></div>
					<div class="col-md-1">Harga:</div>
					<div class="col-md-3"><?=form_input('harga','','class="form-control" id="harga" readonly')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">Jumlah yg di Kirim:</div>
					<div class="col-md-2"><?=form_input('kuantitas','','class="form-control" id="kuantitas" ')?></div>
					<div class="col-md-2">Sisa yg blm di kirim:</div>
					<div class="col-md-2"><?=form_input('saldo','','class="form-control" id="saldo" readonly')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Keterangan:</div>
					<div class="col-md-10"><?=form_input('keterangan','','class="form-control" id="keterangan" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-12"><button type="submit" class="btn_tambah_sj btn btn-block btn-success">tambahkan</button></div>
				</div>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="25%">Nama Barang</th>
						<th width="5%">Jumlah</th>
						<th width="5%">Satuan</th>
						<th width="10%">Keterangan</th>
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