<script>
	function popupcarisuplier(){
		var vurl = "<?=base_url('pembelian_pemesanan/carisuplier')?>";
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
	
	function tampil(){
		var id_order = $("#id_order").val();
		//alert("afASF");
		var vurl = "<?=base_url('penjualan_order/get_data_temp')?>";
		panggil(id_order,vurl);
	}
	
	function popupcaritandatangansurat(){
		var vurl = "<?=base_url('penjualan_invoice/caritandatangansurat')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	$(function() {
		$.ajax({
			type: "POST",
			dataType: "json",
			url : "<?=base_url('pembelian_pemesanan/listorderdetailedit')?>",
			success: function(response){
				$("#total_harga").val(response.subtotal);
				$("tbody").html("");
				$("tbody").append(response.vtabel);
			}
		});
		
		$("#btn_tambah_pembelian").click(function(){
			
			var id_suplier=$("#id_suplier").val();
			var id_ttd=$("#id_ttd").val();
			var tanggalpemesanan=$("#tanggalpemesanan").val();
			var tanggalpengiriman=$("#tanggalpengiriman").val();
			var syarat_pembayaran=$("#syarat_pembayaran").val();
			var keterangan=$("#keterangan").val();
			
			
			if(id_suplier==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Suplier Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if(tanggalpemesanan==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanggal Pemesanan Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if(tanggalpengiriman==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanggal Pengiriman Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else{
				if($("#id_pemesanan_h").val()==""){
					$.ajax({
						type: "POST",
						dataType: "html",
						url : "<?=base_url('pembelian_pemesanan/simpan')?>",
						data: {id_suplier:id_suplier,id_ttd:id_ttd,tanggalpemesanan:tanggalpemesanan,tanggalpengiriman:tanggalpengiriman,syarat_pembayaran:syarat_pembayaran,keterangan:keterangan,id_pemesanan_h:$("#id_pemesanan_h").val()},
						success: function(response){
							$("#id_pemesanan_h").val(response);
							
							var id_pemesanan_h=response;
							var id_barang=$("#id_barang").val();
							var satuan=$("#satuan").val();
							var kuantitas=$("#kuantitas").val();
							var harga=$("#harga").val();
							
							$.ajax({
								type: "POST",
								dataType: "json",
								url : "<?=base_url('pembelian_pemesanan/update_tambah_produk')?>",
								data: {id_suplier:id_suplier,id_ttd:id_ttd,tanggalpemesanan:tanggalpemesanan,tanggalpengiriman:tanggalpengiriman,syarat_pembayaran:syarat_pembayaran,keterangan:keterangan,id_pemesanan_h:id_pemesanan_h,id_barang:id_barang,satuan:satuan,kuantitas:kuantitas,harga:harga},
								success: function(response){
									$("#subtotal").val(response.subtotal);
									$("#total_harga").val(response.subtotal);
									$("tbody").html("");
									$("tbody").append(response.vtabel);
								}
							});
							
						}
					});
				}else{
					var id_pemesanan_h=$("#id_pemesanan_h").val();
					var id_barang=$("#id_barang").val();
					var satuan=$("#satuan").val();
					var kuantitas=$("#kuantitas").val();
					var harga=$("#harga").val();
					
					$.ajax({
						type: "POST",
						dataType: "json",
						url : "<?=base_url('pembelian_pemesanan/update_tambah_produk')?>",
						data: {id_suplier:id_suplier,id_ttd:id_ttd,tanggalpemesanan:tanggalpemesanan,tanggalpengiriman:tanggalpengiriman,syarat_pembayaran:syarat_pembayaran,keterangan:keterangan,id_pemesanan_h:id_pemesanan_h,id_barang:id_barang,satuan:satuan,kuantitas:kuantitas,harga:harga},
						success: function(response){
							$("#total_harga").val(response.subtotal);
							$("tbody").html("");
							$("tbody").append(response.vtabel);
						}
					});
				}
			}
			
		});
		
		
		
		
		$(".btn_simpan_pembelian").click(function(){
			
			var id_suplier=$("#id_suplier").val();
			var id_ttd=$("#id_ttd").val();
			var tanggalpemesanan=$("#tanggalpemesanan").val();
			var tanggalpengiriman=$("#tanggalpengiriman").val();
			var syarat_pembayaran=$("#syarat_pembayaran").val();
			var keterangan=$("#keterangan").val();
			
			
			if(id_suplier==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Suplier Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if(tanggalpemesanan==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanggal Pemesanan Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if(tanggalpengiriman==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanggal Pengiriman Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else{
				if($("#id_pemesanan_h").val()==""){
					$.ajax({
						type: "POST",
						dataType: "html",
						url : "<?=base_url('pembelian_pemesanan/simpan')?>",
						data: {id_suplier:id_suplier,id_ttd:id_ttd,tanggalpemesanan:tanggalpemesanan,tanggalpengiriman:tanggalpengiriman,syarat_pembayaran:syarat_pembayaran,keterangan:keterangan,id_pemesanan_h:$("#id_pemesanan_h").val()},
						success: function(response){
							$("#id_pemesanan_h").val(response);
							$(".modal .modal-dialog .modal-header .modal-title").html("Sukses Simpan Laporan Barang");
							$(".modal .modal-dialog .modal-body").html("Input pemesanan barang berhasil tersimpan dan laporan bisa dicetak");
							$("#modal_success").modal("show"); 
						}
					});
				}else{
					var id_pemesanan_h=$("#id_pemesanan_h").val();
					var id_barang=$("#id_barang").val();
					var satuan=$("#satuan").val();
					var kuantitas=$("#kuantitas").val();
					var harga=$("#harga").val();
					
					$.ajax({
						type: "POST",
						dataType: "json",
						url : "<?=base_url('pembelian_pemesanan/update')?>",
						data: {id_suplier:id_suplier,id_ttd:id_ttd,tanggalpemesanan:tanggalpemesanan,tanggalpengiriman:tanggalpengiriman,syarat_pembayaran:syarat_pembayaran,keterangan:keterangan,id_pemesanan_h:id_pemesanan_h,id_barang:id_barang,satuan:satuan,kuantitas:kuantitas,harga:harga},
						success: function(response){
							$(".modal .modal-dialog .modal-header .modal-title").html("Sukses Simpan Laporan Barang");
							$(".modal .modal-dialog .modal-body").html("Input pemesanan barang berhasil tersimpan dan laporan bisa dicetak");
							$("#modal_success").modal("show"); 
						}
					});
				}
			}
			
		});
		
		
		
		
		
		
		$(".cetak").click(function() {
			var id_pemesanan_h=$("#id_pemesanan_h").val();
			if(id_pemesanan_h==''){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Input pemesanan barang harus di simpan lalu bisa di cetak");
				$("#modal_confirm").modal("show"); 
			}else{
				window.location.replace("<?=base_url('pembelian_pemesanan/cetak')?>/"+id_pemesanan_h);
			}
				
		});
			
	});
	
	$(document).ajaxComplete(function () {
		$(".hapus_tambah_barang").click(function(){
			var id_pemesanan_h=$("#id_pemesanan_h").val();
			var id_pemesanan_d=$(this).attr("id_pemesanan_d");
			$.ajax({
				type: "POST",
				dataType: "json",
				url : "<?=base_url('pembelian_pemesanan/hapus_tambah_barang')?>",
				data: {id_pemesanan_h:id_pemesanan_h,id_pemesanan_d:id_pemesanan_d},
				success: function(response){
					$("#total_harga").val(response.subtotal);
					$("tbody").html("");
					$("tbody").append(response.vtabel);
				}
			});
		});
	});
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Input Order</h2>
					<div class="side pull-right">
						<button class="btn_simpan_pembelian btn btn-primary">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<button class="cetak btn btn-primary">
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
	<input type="hidden" name="id_pemesanan_h" id="id_pemesanan_h">
	<input type="hidden" name="id_ttd" id="id_ttd">
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Input Pemesanan Barang</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">Kode suplier</div>
					<div class="col-md-3"><?=form_input('kode_suplier','','onclick="popupcarisuplier()" class="form-control" id="kode_suplier" readonly')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcarisuplier()">cari</button></div>
					<input type="hidden" name="id_suplier" id="id_suplier">
					<div class="col-md-2">Tanggal Pemesanan</div>
					<div class="col-md-4"> 
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggalpemesanan','','class="datepicker form-control" id="tanggalpemesanan" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Nama Suplier</div>
					<div class="col-md-4"><?=form_input('nama_suplier','','class="form-control" id="nama_suplier" readonly="readonly"')?></div>
					
					<div class="col-md-2">Tanggal Pengiriman</div>
					<div class="col-md-4"> 
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggalpengiriman','','class="datepicker form-control" id="tanggalpengiriman" ')?>
						</div>
					</div>
					
				</div>
				<div class="form-row">
					<div class="col-md-2">No.Telp Suplier</div>
					<div class="col-md-4"><?=form_input('telp_suplier','','class="form-control" id="telp_suplier" readonly="readonly"')?></div>
						
					<div class="col-md-2">Syarat Pembayaran</div>
					<div class="col-md-4"><textarea name="syarat_pembayaran" id="syarat_pembayaran" class="form-control"></textarea></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kota Suplier</div>
					<div class="col-md-4"><?=form_input('kota_suplier','','class="form-control" id="kota_suplier" readonly="readonly"')?></div>
					
					<div class="col-md-2">Keterangan</div>
					<div class="col-md-4"><textarea name="keterangan" id="keterangan" class="form-control"></textarea></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Alamat Suplier</div>
					<div class="col-md-4"><?=form_input('alamat_suplier','','class="form-control" id="alamat_suplier" readonly="readonly"')?></div>
					
					<div class="col-md-2">Tanda Tangan Surat</div>
					<div class="col-md-3"><?=form_input('tanda_tangan_surat',$this->input->post('tanda_tangan_surat'),' class="form-control" id="tanda_tangan_surat" readonly')?></div>
					<div class="col-md-1"><button type="button" class="btn btn-success" onclick="popupcaritandatangansurat()">cari</button></div>
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
					<div class="col-md-4"><?=form_input('kode_barang','','class="form-control" id="kode_barang" readonly ')?></div>
					<input type="hidden" name="id_barang" id="id_barang">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Nama Barang:</div>
					<div class="col-md-4"><?=form_input('nama_barang','','class="form-control" id="nama_barang" readonly')?></div>
					<div class="col-md-1">Satuan:</div>
					<div class="col-md-4"><?=form_input('satuan','','class="form-control" id="satuan" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Qty:</div>
					<div class="col-md-4"><?=form_input('kuantitas','','class="form-control" id="kuantitas" ')?></div>
					<div class="col-md-1">Harga:</div>
					<div class="col-md-4"><?=form_input('harga','','class="form-control" id="harga" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Keterangan:</div>
					<div class="col-md-9"><?=form_input('keterangan','','class="form-control" id="keterangan" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-12"><button type="button" id="btn_tambah_pembelian" class=" btn btn-block btn-success">tambahkan</button></div>
				</div>
			</div>
			<div class="content">
			<input type="hidden" id="no_tambah_barang">
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
				<tbody class="div_tambah_barang">
				
				</tbody>
				</table>
			</div>
		</div>
	</div>
	</form>
</div>


<div class="modal modal-danger" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body clearfix">
			</div>
			<div class="modal-footer">                
				<button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-success" id="modal_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body clearfix">
			</div>
			<div class="modal-footer">                
				<button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>