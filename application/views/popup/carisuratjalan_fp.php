<SCRIPT LANGUAGE="JavaScript">
$(function() {
	$(".pilih").click(function() {
		window.opener.document.getElementById('no_dokumen').value=$(this).attr("no_surat_jalan");
		window.opener.document.getElementById('nama').value=$(this).attr("nama");
		window.opener.document.getElementById('alamat').value=$(this).attr("alamat");
		window.opener.document.getElementById('npwp').value=$(this).attr("npwp");
		window.close();
	});
});

function sendValue(id_invoice,id_order,id_customer,id_surat_jalan,no_surat_jalan,nama,alamat,npwp){
	window.opener.document.getElementById('id_invoice').value=id_invoice;
	window.opener.document.getElementById('id_order').value=id_order;
	window.opener.document.getElementById('id_customer').value=id_customer;
	window.opener.document.getElementById('id_surat_jalan').value=id_surat_jalan;
	window.opener.document.getElementById('no_dokumen').value=no_surat_jalan;
	window.opener.document.getElementById('nama').value=nama;
	window.opener.document.getElementById('alamat').value=alamat;
	window.opener.document.getElementById('npwp').value=npwp;
	window.close();
}
$(function() {
	$('#form_cari').on("submit",function(e) {
		e.preventDefault();
		$.ajax({
				type: "POST",
				dataType: "html",
				url : "<?= base_url('penjualan_fp/carisuratjalanreload') ?>",
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
			<form id="form_cari" action="<?=base_url('penjualan_fp/carisuratjalan')?>" method="post">
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
				<?php $this->load->view('popup/carisuratjalan_fptable')?>
			</div>
	</div>
</div>