<script>
	$("#show_no_invoice").html("");
	function popupcarinosuratjalan(){
		var vurl = "<?=base_url('penjualan_fp/carisuratjalan')?>";
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
						url : "<?=base_url('penjualan_fp/detailitem')?>",
						data: {id_surat_jalan:id_surat_jalan},
						success: function(response){
							$("#subtotal").val(response.subtotal);
							$("#total_harga").val(response.subtotal);
							$("#dasar_pajak").val(response.subtotal);
							$("#ppn").val(response.subtotal/10);
							$("tbody").html("");
							$("tbody").append(response.vtabel);
							//$("#tabel_detail_invoice tbody").html(response.vtabel);
						}
					});
				}else{
					$("#show_no_invoice").html("");
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
	
	$(function() {
		
		var id_surat_jalan = $("#id_surat_jalan").val();
		var no_dokumen = $("#no_dokumen").val();
		
		if($("#no_dokumen").val()!=""){
			$("#show_no_invoice").html(" Dengan No Surat Jalan "+no_dokumen);
			$.ajax({
				type: "POST",
				dataType: "json",
				url : "<?=base_url('penjualan_fp/detailitem')?>",
				data: {id_surat_jalan:id_surat_jalan},
				success: function(response){
					$("tbody").html("");
					$("tbody").append(response.vtabel);
					//$("#tabel_detail_invoice tbody").html(response.vtabel);
				}
			});
		}
		
		
		$(".simpan_fp").click(function() {
			if($("#kode_transaksi").val()!="" & $("#tanggal").val()!="" & $("#tanda_tangan_surat").val()!=""){
				var kode_transaksi = $("#kode_transaksi").val();
				var id_no_faktur = $("#id_no_faktur").val();
				var id_no_faktur_lama = $("#id_no_faktur_lama").val();
				var no_faktur = $("#no_faktur").val();
				var tanggal = $("#tanggal").val();
				var id_faktur_pajak = $("#id_faktur_pajak").val();
				var id_surat_jalan_lama = $("#id_surat_jalan_lama").val();
				var id_surat_jalan = $("#id_surat_jalan").val();
				var id_order = $("#id_order").val();
				var id_invoice = $("#id_invoice").val();
				var id_customer = $("#id_customer").val();
				var subtotal = $("#subtotal").val();
				var potongan = $("#potongan").val();
				var uang_muka = $("#uang_muka").val();
				var dasar_pajak = $("#dasar_pajak").val();
				var ppn = $("#ppn").val();
				var id_ttd = $("#id_ttd").val();
				
				
				$.ajax({
					type: "POST",
					dataType: "json",
					url : "<?=base_url('penjualan_fp/update')?>",
					data: {kode_transaksi:kode_transaksi,id_no_faktur_lama:id_no_faktur_lama,id_no_faktur:id_no_faktur,no_faktur:no_faktur,tanggal:tanggal,id_faktur_pajak:id_faktur_pajak,id_surat_jalan_lama:id_surat_jalan_lama,id_surat_jalan:id_surat_jalan,id_order:id_order,id_invoice:id_invoice,id_customer:id_customer,subtotal:subtotal,potongan:potongan,uang_muka:uang_muka,dasar_pajak:dasar_pajak,ppn:ppn,id_ttd:id_ttd},
					success: function(response){
						if(response.status=='sukses'){
							$("#id_cetak").val(response.id_cetak);//sama dengan id_faktur_pajak

							$(".modal .modal-dialog .modal-header .modal-title").html("Sukses Update Faktur Pajak");
							$(".modal .modal-dialog .modal-body").html("Faktur Pajak Berhasil terupdate dan laporan bisa dicetak");
							$("#modal_success").modal("show"); 
						}else{
							$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
							$(".modal .modal-dialog .modal-body").html("Gagal update faktur pajak, data sudah tersimpan ");
							$("#modal_confirm").modal("show"); 
						}
						
						
					}
				});
				
			}else if($("#kode_transaksi").val()==""){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Kode Transaksi Masih Kosong");
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
			if(id_cetak==''){
				$(".modal .modal-dialog .modal-header .modal-title").html("Terjadi Kesalahan");
				$(".modal .modal-dialog .modal-body").html("Faktur Pajak harus di simpan lalu bisa di cetak");
				$("#modal_confirm").modal("show"); 
			}else{
				window.location.replace("<?=base_url('penjualan_fp/cetak')?>/"+id_cetak);
			}
				
		});
		
	});
</script>
<div class="row">             
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Faktur Pajak</h2>
					<div class="side pull-right">
						<button class="simpan_fp btn btn-primary">
							<i class="icon-save"></i>&nbsp;&nbsp;update
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
	<form action="<?=$action_form?>" id="form_order" method="post">
	<input type="hidden" name="id_cetak" id="id_cetak" value="<?=$data->id_faktur_pajak?>">
	<input type="hidden" name="id_faktur_pajak" id="id_faktur_pajak" value="<?=$data->id_faktur_pajak?>">
	<input type="hidden" name="id_ttd" id="id_ttd" value="<?=$data->id_ttd?>">
	<input type="hidden" name="id_customer" id="id_customer" value="<?=$data->id_customer?>">
	<input type="hidden" name="id_surat_jalan_lama" id="id_surat_jalan_lama" value="<?=$data->id_surat_jalan?>">
	<input type="hidden" name="id_surat_jalan" id="id_surat_jalan" value="<?=$data->id_surat_jalan?>">
	<input type="hidden" name="id_order" id="id_order" value="<?=$data->id_order?>">
	<input type="hidden" name="id_invoice" id="id_invoice" value="<?=$data->id_invoice?>">
	<input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?=$perusahaan->id_perusahaan?>">
	<input type="hidden" name="id_no_faktur_lama" id="id_no_faktur_lama" value="<?=$data->id_no_faktur?>">
	<input type="hidden" name="id_no_faktur" id="id_no_faktur" value="<?=$data->id_no_faktur?>">
	
	<div class="col-md-8">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Header</h4>
			</div>				
			<div class="content controls">				
				<div class="form-row">
					<div class="col-md-2">Kode Transaksi</div>
					<div class="col-md-1"><?=form_input('kode_transaksi',$data->kode_transaksi,'id="kode_transaksi" class="form-control" ')?></div>
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-2">Tanggal</div>
					<div class="col-md-3">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal',$data->tanggal_indo,'class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">No. Faktur</div>
					<div class="col-md-4"><?=form_input('no_faktur',$data->no_faktur,'id="no_faktur" class="form-control" readonly')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">No.Surat Jalan</div>
					<div class="col-md-3"><?=form_input('no_dokumen',$no_surat_jalan,' class="form-control" id="no_dokumen" readonly')?></div>
					<div class="col-md-1"><button type="button" id="btn_cari_custom" class="btn btn-success" onclick="popupcarinosuratjalan()">cari</button></div>
					
					<div class="col-md-2">Tanda Tangan Surat</div>
					<div class="col-md-3"><?=form_input('tanda_tangan_surat',$tanda_tangan_surat,' class="form-control" id="tanda_tangan_surat" readonly')?></div>
					<div class="col-md-1"><button type="button" class="btn btn-success" onclick="popupcaritandatangansurat()">cari</button></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-2">&nbsp;</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-6">Pengusaha Kena Pajak :</div>
					<div class="col-md-6">Pembeli Barang / Penerima Jasa Kena Pajak :</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-1">Nama</div>
					<div class="col-md-5"><?=form_input('nama_perusahaan',$perusahaan->nama,'class="form-control" id="nama_perusahaan" readonly')?></div>
					
					<div class="col-md-1">Nama</div>
					<div class="col-md-5"><?=form_input('nama',$nama_customer,'class="form-control" id="nama" readonly ')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">Alamat</div>
					<div class="col-md-5"><textarea name="alamat_perusahaan" id="alamat_perusahaan" readonly><?=$perusahaan->nama?></textarea></div>
					
					<div class="col-md-1">Alamat</div>
					<div class="col-md-5"><textarea id="alamat" readonly><?=$alamat_customer?></textarea></div>
				</div>
				<div class="form-row">
					<div class="col-md-1">N.P.W.P</div>
					<div class="col-md-5"><?=form_input('npwp_perusahaan',$perusahaan->npwp,'class="form-control" id="npwp_perusahaan" readonly ')?></div>
					
					<div class="col-md-1">N.P.W.P</div>
					<div class="col-md-5"><?=form_input('npwp',$npwp,'class="form-control" id="npwp" readonly ')?></div>
				</div>								
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Biaya</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4">Jumlah Harga Jual:</div>
					<div class="col-md-7"><?=form_input('subtotal',$data->subtotal,'class="form-control" id="subtotal" readonly="readonly" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Dikurangi Potongan Harga:</div>
					<div class="col-md-7"><?=form_input('potongan',$data->potongan,'class="form-control" id="potongan" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Dikurangi Uang Muka:</div>
					<div class="col-md-7"><?=form_input('uang_muka',$data->uang_muka,'class="form-control" id="uang_muka" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">Dasar Pengenaan Pajak:</div>
					<div class="col-md-7"><?=form_input('dasar_pajak',$data->dasar_pajak,'class="form-control" id="dasar_pajak" ')?></div>
				</div>
				
				<div class="form-row">
					<div class="col-md-4">10% X Dasar Pengenaan Pajak :</div>
					<div class="col-md-7"><?=form_input('ppn',$data->ppn,'class="form-control" id="ppn" readonly="readonly" ')?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Detail Item</h4>
			</div>
			<div class="content">
			<div id="show_no_invoice"></div>
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="5px">No</th>
						<th width="">Nama Barang Kena Pajak/Jasa Kena Pajak</th>
						<th width="200px">Harga Jual/Penggantian Uang Muka/Termijin<br>(Rp)</th>                  
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
