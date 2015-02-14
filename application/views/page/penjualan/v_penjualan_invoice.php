<script>
	function popupcarinosuratjalan(){
		var vurl = "<?=base_url('penjualan_invoice/carisuratjalan')?>";
		var openwindo = window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
		
		var boll = true;
		openwindo.onbeforeunload = function(){
			if(boll){
				var id_surat_jalan = $("#id_surat_jalan").val();
				var no_dokumen = $("#no_dokumen").val();
				
				if($("#no_dokumen").val()!=""){
					$("#show_no_invoice").html(" Dengan No Surat Jalan "+no_dokumen);
					$.ajax({
						type: "POST",
						dataType: "json",
						url : "<?=base_url('penjualan_invoice/detailinvoice')?>",
						data: {id_surat_jalan:id_surat_jalan},
						success: function(response){
							$("#subtotal").val(response.subtotal);
							$("#total_harga").val(response.subtotal);
							$("tbody").html("");
							$("tbody").append(response.vtabel);
							//$("#tabel_detail_invoice tbody").html(response.vtabel);
						}
					});
				}else{
					$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
					$(".modal .modal-dialog .modal-body").html("Nomor Surat Jalan Masih Kosong");
					$("#modal_confirm").modal("show"); 
				}
			}
			boll=false;
		}
	}
	
	function popupcaritandatangansurat(){
		var vurl = "<?=base_url('penjualan_invoice/caritandatangansurat')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	
	function romawi(val){
		if(val=='01')
			return 'I';
		else if(val=='02')
			return 'II';
		else if(val=='03')
			return 'III';
		else if(val=='04')
			return 'IV';
		else if(val=='05')
			return 'V';
		else if(val=='06')
			return 'VI';
		else if(val=='07')
			return 'VII';
		else if(val=='08')
			return 'VIII';
		else if(val=='09')
			return 'IX';
		else if(val=='10')
			return 'X';
		else if(val=='11')
			return 'XI';
		else if(val=='12')
			return 'XII';
		else
			return '-';
	}
	

	$(function() {
		$("#show_no_invoice").html("");
		
		$("#tanggal").change(function() {
			if($("#no_surat").val()==""){
				$(this).val("");
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Inputkan No Surat Jalan Dulu!!!");
				$("#modal_confirm").modal("show"); 
			}else{
				var pecah_no_invoice = $("#no_invoice").val().split('/');
				var pecah_tanggal = $(this).val().split('/');
				var no_invoice = pecah_no_invoice[0]+"/"+pecah_no_invoice[1]+"/"+pecah_no_invoice[2];
			
				$("#no_invoice").val(no_invoice+"/"+romawi(pecah_tanggal[0])+"-"+pecah_tanggal[1]+"/"+pecah_tanggal[2]);
			}
		});
		
		
		
		$("#reset").click(function() {
			$("tbody").html("");
			$("#show_no_invoice").html("");
		});
		
		
		$(".simpan_invoice").click(function() {
			if($("#no_dokumen").val()!="" & $("#tanggal").val()!="" & $("#tanda_tangan_surat").val()!=""){
				var nourut = $("#nourut").val();
				var id_ttd = $("#id_ttd").val();
				var no_invoice = $("#no_invoice").val();
				var id_surat_jalan = $("#id_surat_jalan").val();
				var id_order = $("#id_order_invoice").val();
				var tanggal = $("#tanggal").val();
				var id_customer = $("#id_customer").val();
				var subtotal = $("#subtotal").val();
				var ppn = $("#pengiriman").val();
				var total = $("#total_harga").val();
				$.ajax({
					type: "POST",
					dataType: "json",
					url : "<?=base_url('penjualan_invoice/simpan')?>",
					data: {nourut:nourut,id_ttd:id_ttd,no_invoice:no_invoice,id_surat_jalan:id_surat_jalan,id_order:id_order,tanggal:tanggal,id_customer:id_customer,subtotal:subtotal,ppn:ppn,total:total},
					success: function(response){
						if(response.status=='sukses'){
							$("#id_cetak").val(response.id_cetak);

							$(".modal .modal-dialog .modal-header .modal-title").html("Sukses Simpan Invoice");
							$(".modal .modal-dialog .modal-body").html("Invoice Berhasil tersimpan dan laporan bisa dicetak");
							$("#modal_success").modal("show"); 
						}else{
							$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
							$(".modal .modal-dialog .modal-body").html("Gagal menyimpan invoice, data sudah tersimpan ");
							$("#modal_confirm").modal("show"); 
						}
						
						//$.each( response.res, function( key, value ) {
						//  alert( key + ": " + value );
						//});
						
					}
				});
				
			}else if($("#no_dokumen").val()==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Nomor Surat Jalan Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if($("#tanggal").val()==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanggal Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}else if($("#tanda_tangan_surat").val()==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Tanda Tangan Surat Masih Kosong");
				$("#modal_confirm").modal("show"); 
			}
		});
		
		$(".cetak").click(function() {
			var id_cetak=$("#id_cetak").val();
			var id_surat_jalan=$("#id_surat_jalan").val();
			if(id_cetak==''){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Invoice harus di simpan lalu bisa di cetak");
				$("#modal_confirm").modal("show"); 
			}else{
				window.location.replace("<?=base_url('penjualan_invoice/cetak')?>/"+id_cetak+"/"+id_surat_jalan);
			}
				
		});
	});
</script>



<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>INVOICE</h2>
					<div class="side pull-right">
						<button class="simpan_invoice btn btn-primary">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<button class="cetak btn btn-primary">
							<i class="icon-print"></i>&nbsp;&nbsp;print
						</button>
						
						<button type="reset" id="reset" class="clearform btn btn-primary">
							<i class="icon-refresh"></i>&nbsp;&nbsp;clear
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<input type="hidden" name="nourut" id="nourut">
			<input type="hidden" name="id_ttd" id="id_ttd">
			<input type="hidden" name="id_cetak" id="id_cetak">
			<input type="hidden" name="id_surat_jalan" id="id_surat_jalan" value="">
			<input type="hidden" name="id_order" id="id_order_invoice" value="">
			<input type="hidden" name="id_customer" id="id_customer" value="">
			
			<div class="header">
				<h4>Header Invoice</h4>
			</div>
			
			<div class="content controls">
			
				<div class="form-row">
					<div class="col-md-2">No. INVOICE</div>
					<div class="col-md-4"><?=form_input('no_invoice',$this->input->post('no_invoice'),'class="form-control" id="no_invoice" readonly')?></div>
					<div class="col-md-2">No. Order</div>
					<div class="col-md-4"><?=form_input('no_surat',$this->input->post('no_surat'),'class="form-control" id="no_surat" readonly')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">No.Surat Jalan</div>
					<div class="col-md-3"><?=form_input('no_dokumen',$this->input->post('no_dokumen'),' class="form-control" id="no_dokumen" readonly')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcarinosuratjalan()">cari</button></div>
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal',$this->input->post('tanggal'),'class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer',$this->input->post('nama_customer'),'class="form-control" id="nama_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Alamat Customer</div>
					<div class="col-md-4"><?=form_input('alamat_customer',$this->input->post('alamat_customer'),'class="form-control" id="alamat_customer" readonly="readonly"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2">No.Telp Customer</div>
					<div class="col-md-4"><?=form_input('telp_customer',$this->input->post('telp_customer'),'class="form-control" id="telp_customer" readonly="readonly"')?></div>
					
					<div class="col-md-2">Kota Customer</div>
					<div class="col-md-4"><?=form_input('kota_customer',$this->input->post('kota_customer'),'class="form-control" id="kota_customer" readonly="readonly"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-2"></div>
					<div class="col-md-4"></div>
					
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
					<div class="col-md-4">Subtotal:</div>
					<div class="col-md-7"><?=form_input('subtotal','','class="form-control" id="subtotal" readonly="readonly" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Pajak PPN :</div>
					<div class="col-md-7"><?=form_input('pengiriman','0','class="form-control" id="pengiriman"')?></div>
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
					<h4>Detail Invoice dari Surat Jalan <span id="show_no_invoice"></span></h4>
				</div>
				<div class="content">
					<table id="tabel_detail_invoice" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="25%">Nama Barang</th>
							<th width="5%">Jumlah</th>
							<th width="5%">Satuan</th>
							<th width="5%">Harga</th>
							<th width="10%">Total</th>                     
						</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
		</div>
	</div>
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
