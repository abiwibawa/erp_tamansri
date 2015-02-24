<SCRIPT LANGUAGE="JavaScript">
function sendValue(nourut,id_surat_jalan,no_dokumen,id_order,id_customer,nama,no_invoice,no_surat_jalan,telpon,kota_customer,alamat_customer){
	window.opener.document.getElementById('nourut').value= nourut;
	window.opener.document.getElementById('id_surat_jalan').value= id_surat_jalan;
	window.opener.document.getElementById('no_surat').value= no_dokumen;
	window.opener.document.getElementById('id_order_invoice').value= id_order;
	window.opener.document.getElementById('id_customer').value= id_customer;
	//window.opener.document.getElementById('kode_customer').value= kode_customer;
	window.opener.document.getElementById('no_invoice').value= no_invoice;
	window.opener.document.getElementById('nama_customer').value= nama;
	window.opener.document.getElementById('no_dokumen').value= no_surat_jalan;
	window.opener.document.getElementById('telp_customer').value= telpon;
	window.opener.document.getElementById('kota_customer').value= kota_customer;
	window.opener.document.getElementById('alamat_customer').value= alamat_customer;
	//alert(id_order);
	window.close();
}
$(function() {
	$('#form_cari').on("submit",function(e) {
		e.preventDefault();
		$.ajax({
				type: "POST",
				dataType: "html",
				url : "<?= base_url('penjualan_invoice/carisuratjalanreload') ?>",
				data : $(this).serializeArray(),
				success: function(response){
					$(".isi_table").html(response);
				}
		});
		
	});
});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="header">
				<h4>Cari Customer</h4>
			</div>
			<form id="form_cari" action="<?=base_url('')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-4"><?=form_input('key',$this->form_data->key,'class="form-control" placeholder="Nomor Surat Jalan"')?></div>
				</div>
				<div class="form-row">
					<div class="col-md-4"><input type="submit" value="cari" class="btn-block btn"></div>
				</div>
			</div>
			</form>
			<div class="content isi_table">
				<?php $this->load->view('popup/carisuratjalantable')?>
			</div>
	</div>
</div>