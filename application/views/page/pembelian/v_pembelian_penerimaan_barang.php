<script type='text/javascript' src='<?=base_url()?>js/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='<?=base_url()?>js/plugins/noty/layouts/topCenter.js'></script>
<script type='text/javascript' src='<?=base_url()?>js/plugins/noty/layouts/topLeft.js'></script>
<script type='text/javascript' src='<?=base_url()?>js/plugins/noty/layouts/topRight.js'></script>    
<script type='text/javascript' src='<?=base_url()?>js/plugins/noty/themes/default.js'></script>
<script type='text/javascript' src='<?=base_url()?>js/plugins/jquery/jquery-ui-timepicker-addon.js'></script>
<script type="text/javascript">
$(document).ready(function(){

/*function popupcaribarang(){
	if($("#id_pemesanan_h").val()==""){
		noty({text: '<b>Harap Isi Data Pemesanan Barang Terlebih Dahulu.</b>', type: 'error',timeout:2000});
	}else{
		var vurl = "http://localhost/erp_tamansri/master_popup/cari_barang?id_pemesanan="+$("#id_pemesanan_h").val();
		//var vurl = "http://localhost/erp_tamansri/index.php?c=master_popup&m=cari_barang&id_pemesanan="+$("#id_pemesanan").val();
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
}*/

$("#btn_cari_barang").click(function(){
	//alert('asdfasfd');
	if($("#id_pemesanan_h").val()==""){
		noty({text: '<b>Harap Isi Data Pemesanan Barang Terlebih Dahulu.</b>', type: 'error',timeout:2000});
	}else{
		var vurl = "http://localhost/erp_tamansri/master_popup/cari_barang?id_pemesanan="+$("#id_pemesanan_h").val()+"&id_suplier="+$("#id_suplier").val();
		//var vurl = "http://localhost/erp_tamansri/index.php?c=master_popup&m=cari_barang&id_pemesanan="+$("#id_pemesanan").val();
		window.open(vurl,'popuppage','width=700,toolbar=0,resizable=1,scrollbars=yes,height=500,top=100,left=100,address=0');
	}
});

	$(".tambah_penerimaan").click(function(){
		var vurl = "<?=base_url('pembelian_penerimaan_barang/simpan')?>";
		var id_pemesanan_h = $("input[name=id_pemesanan_h]").val();
		var no_surat_jalan = $("input[name=surat_jalan]").val();
		var nopol = $("input[name=nopol_kendaraan]").val();
		var jam = $("input[name=jam]").val();
		var id_pemesanan_d = $("input[name=id_pemesanan_d]").val();
		var id_barang = $("input[name=id_barang]").val();
		var kuantias_barang = $("input[name=kuantitas_barang]").val();
		var keterangan = $("input[name=keterangan]").val();
		//alert(nopol);
		var parsing = {id_pemesanan_h:id_pemesanan_h, no_surat_jalan:no_surat_jalan, nopol:nopol, jam:jam, id_pemesanan_d:id_pemesanan_d, id_barang:id_barang, kuantitas_barang:kuantias_barang, keterangan:keterangan};
		$.ajax({
			type: "POST",
			dataType: "json",
			url : vurl,
			data: parsing,
			success: function(response){
				//alert(response.vtabel);
				$("#tabel .block .content").html(response.vtabel);
				//$("#tabel .block .header").html(response.dokumen);
				$(".js").html(response.js);
			}
		});
	});
	
})
</script>
<?php
$atts = array(
              'width'      => '800',
              'height'     => '500',
			  'top'		   => '100',
			  'left'       => '100',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0',
			  'class'      => 'btn btn-success icon-search'
            );
?>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Input Penerimaan Barang</h2>
					<div class="side pull-right">
					
						<button class="simpan_penerimaan btn btn-primary" data-url="<?=base_url('pembelian_lappenerimaan_barang')?>">
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
	<div class="col-md-6">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Data Pemesanan Barang</h2>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4">No Surat Pemesanan</div>
					<div class="col-md-6"><?=form_input('surat_pemesanan',$this->form_data->surat_pemesanan,'class="form-control" id="no_surat" readonly');?></div>
					<div class="col-md-2">
					<!-- <button type="button" id="btn_cari_custom" class="btn btn-success icon-search" onclick="popupcaricustomer()">&nbsp; cari</button>-->
					<?=anchor_popup(base_url('master_popup/carisuratpemesanan'),'&nbsp; cari',$atts);?>
					</div>
					<input type="hidden" name="id_pemesanan_h" id="id_pemesanan_h" value="<?=$this->form_data->id_pemesanan_h?>">
					<input type="hidden" name="id_pemesanan_d" id="id_pemesanan_d" value="<?=$this->form_data->id_pemesanan_d?>">
					<input type="hidden" name="id_suplier" id="id_suplier" value="<?=$this->form_data->id_pemesanan_d?>">
				</div>
				<div class="form-row">
					<div class="col-md-4">Kode Suplier</div>
					<div class="col-md-6">
							<?=form_input('kode_suplier',$this->form_data->id_suplier,'class="form-control" id="kd_suplier" readonly')?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Nama Suplier</div>
					<div class="col-md-6">
							<?=form_input('nama_suplier',$this->form_data->nama_suplier,'class="form-control" id="nama_suplier" readonly')?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Alamat Suplier</div>
					<div class="col-md-6">
							<?=form_input('alamat_suplier',$this->form_data->alamat_suplier,'class="form-control" id="alamat_suplier" readonly')?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Telp Suplier</div>
					<div class="col-md-6">
							<?=form_input('telp',$this->form_data->telp_suplier,'class="form-control" id="telp" readonly')?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="block block-fill-white">
			<div class="header">
				<h2></h2>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4">Surat Jalan</div>
					<div class="col-md-6">
							<?=form_input('surat_jalan',$this->form_data->surat_jalan,'class="form-control " ')?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Nopol Kendaraan</div>
					<div class="col-md-6">
							<?=form_input('nopol_kendaraan',$this->form_data->nopol_kendaraan,'class="validate[required] form-control" id=""')?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Jam Penerimaan</div>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-time"></span></div>
							<?=form_input('jam',$this->form_data->jam,'class="timepicker form-control" ')?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header"><h2>Detail Pemesanan Barang</h2></div>
			<div class="content">
				<div class="form-row">
					<div class="col-md-1">Kode Barang</div>
					<div class="col-md-1">
							<?=form_input('kd_barang','','class="form-control" id="kd_barang" readonly ')?>
							<input type="hidden" name="id_barang" id="id_barang">
					</div>
					<div class="col-md-1">
							<button type="button" id="btn_cari_barang" class="btn btn-success icon-search" onclick="">&nbsp; cari</button>
					</div>
					<div class="col-md-1">Nama Barang</div>
					<div class="col-md-2">
							<?=form_input('nama_barang','','class="form-control" id="nama_barang"')?>
					</div>
					<div class="col-md-1">Kuantitas</div>
					<div class="col-md-1">
							<?=form_input('kuantitas_barang','','class="form-control validate[required,qty[kuantitas_barang]]" id="qty_barang" onkeyup=""')?>
					</div>
					<div class="col-md-1">
							<?=form_input('','','class="form-control" id="kuantitas_barang" readonly ')?>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="form-row">
					<div class="col-md-1">
							Keterangan
					</div>
					<div class="col-md-8">
							<?=form_input('keterangan','-','class=" form-control" ')?>
					</div>
					<div class="col-md-1">
							<button id="btn_cari_custom" class="tambah_penerimaan btn btn-success" onclick="">Tambah</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	<div class="col-md-12" id="tabel">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Detail Pemesanan Barang</h2>
			</div>
			<div class="content detail-pemesanan">
				
			</div>
		</div>
	</div>
	<div class="js" ></div>
</div>