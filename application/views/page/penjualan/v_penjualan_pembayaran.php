<script>
	function popupcaricustomer(){
		var vurl = "<?=base_url('master_popup/caricustomerpembayaran')?>";
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	
	function popupproduk(){
		var id_customer = $("#id_customer").val();
		var vurl = "<?=base_url('master_popup/carikwitansi')?>";
		window.open(vurl+'?idcustomer='+id_customer,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
	$(function() {
		$(".penjualan_pembayaran").click(function(){
			var vurl = $(this).attr("data-url");
			var data2 = $("#form_pembayaran_penjualan").serialize();
			$.ajax({
				type: "POST",
				dataType: "json",
				url : vurl,
				data: data2,
				success: function(response){
					if(response.status=="true"){
						window.location.replace(response.redir,'_blank');
					}else{
						alert(response.status)
					}
				}
			});
		});
		
		$("#jumlah").keyup(function(){
			if($(this).val()!=""){
				var bayar = parseInt($(this).val());
			}else{
				var bayar = 0;
			}
			if($("#debet").val()!=""){
				var debit = parseInt($("#debet").val());
			}else{
				var debit = 0;
			}
			
			var jumlah = bayar+debit;
			$("#total").val(jumlah);
		});
		
		$("#debet").keyup(function(){
			if($("#jumlah").val()!=""){
				var bayar = parseInt($("#jumlah").val());
			}else{
				var bayar = 0;
			}
			if($(this).val()!=""){
				var debit = parseInt($(this).val());
			}else{
				var debit = 0;
			}
			
			var jumlah = bayar+debit;
			$("#total").val(jumlah);
		});
		
		$("#total").click(){
			if($("#jumlah").val()!=""){
				var bayar = parseInt($("#jumlah").val());
			}else{
				var bayar = 0;
			}
			if($("#debit").val()!=""){
				var debit = parseInt($("#debit").val());
			}else{
				var debit = 0;
			}
			
			var jumlah = bayar+debit;
			$("#total").val(jumlah);
		}
	});
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Pembayaran Piutang</h2>
					<div class="side pull-right">
						<button class="penjualan_pembayaran btn btn-primary" data-url="<?=base_url('penjualan_pembayaran/simpan')?>">
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
	<form action="#" id="form_pembayaran_penjualan" method="post">
	<input type="hidden" name="id_piutang" id="id_piutang" value="">
	<input type="hidden" name="key" id="key" value="<?=$this->form_data->key?>">
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
					<div class="col-md-2">Akun Bank</div>
					<div class="col-md-2">
						<div class="input-group">
							<?=form_dropdown('id_akun_bank',$cmbakunbank,$this->form_data->id_akun_bank,'class="form-control" id="id_akun_bank" ')?>
						</div>
					</div>
					<div class="col-md-2">Kode Perkiraan</div>
					<div class="col-md-2">
						<div class="input-group">
							<input type="hidden" name="id_rek" id="id_rek" value="010201">
							<input type="hidden" name="id_rek_lawan" id="id_rek_lawan" value="010401">
							<?=form_input('no_perkiraan','120.00','class="form-control" id="no_perkiraan" readonly')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Kode Customer</div>
					<div class="col-md-3"><?=form_input('kode_customer','','class="form-control" id="kode_customer" readonly')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcaricustomer()">cari</button></div>
					<input type="hidden" name="id_customer" id="id_customer">
					<div class="col-md-2">Nama Customer</div>
					<div class="col-md-4"><?=form_input('nama_customer','','class="form-control" id="nama_customer" readonly="readonly"')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">Memo</div>
					<div class="col-md-10"><?=form_input('memo','','class="form-control" id="memo" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">No. Kwitansi:</div>
					<div class="col-md-3"><?=form_input('no_kwitansi','','class="form-control" id="no_kwitansi" readonly ')?></div>
					<input type="hidden" name="id_kwitansi" id="id_kwitansi">
					<div class="col-md-1"><button type="button" class="cari_produk btn btn-success" onClick="popupproduk()">cari</button></div>
					<div class="col-md-2">Nilai : Rp</div>
					<div class="col-md-4"><?=form_input('subtotal','','class="form-control" id="subtotal" readonly')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-3">Yang Dibayar : Rp</div>
					<div class="col-md-4"><?=form_input('jumlah','','class="form-control" id="jumlah" ')?></div>
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
					<div class="col-md-4">Total Bayar:</div>
					<div class="col-md-7"><?=form_input('total','0','class="form-control" id="total" readonly')?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Biaya Operasional / Transaksi Lain-lain</h4>
			</div>
			
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">Kode Perkiraan</div>
					<div class="col-md-2">
						<div class="input-group">
							<?=form_dropdown('id_perkiraan_hutang',$cmb_perkiraanhutang,'','class="form-control" id="id_perkiraan_hutang" ')?>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Debet</div>
					<div class="col-md-4"><?=form_input('debet','','class="form-control" id="debet" ')?></div>
					<div class="col-md-1">Kredit</div>
					<div class="col-md-4"><?=form_input('kredit','','class="form-control" id="kredit" ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Keterangan:</div>
					<div class="col-md-10"><?=form_input('keterangan','','class="form-control" id="keterangan" ')?></div>
				</div>
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