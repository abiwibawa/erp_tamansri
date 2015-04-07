<script src="<?=base_url()?>js/jquery.monthpicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*
	$("table.sortable").dataTable({"iDisplayLength": 5, "aLengthMenu": [5,10,25,50,100], "sPaginationType": "full_numbers", "aoColumns": [ { "bSortable": false }, null, null, null, null]});
	*/
	$('#myTable').DataTable({"iDisplayLength": 10, "aLengthMenu": [5,10,25,50], "sPaginationType": "full_numbers",});
	
	$("#filter").change(function(){
		var filter = $("#filter").val();
		if (filter=="b.tanggal") {
			alert(filter);
		}else{

		};
	});

	$(".detil-barang").click(function(){
		var bulan = $(this).attr("data-bulan");
		var tahun = $(this).attr("data-tahun");
		var vurl = $(this).attr("data-url");
		var title = $(this).attr("data-title");
		/*$("#modal_default_3").modal("show");
		$("#modal_default_3 .modal-header .modal-title").html(title);
		$("#modal_default_3 .modal-body").html(tahun);*/
		//alert(bulan);
		$.ajax({
			type: "POST",
			dataType: "json",
			url : vurl,
			data: "bulan="+bulan+"&tahun="+tahun,
			success: function(response){
				$("#modal_default_3").modal("show");
				$("#modal_default_3 .modal-header .modal-title").html(title);
				$("#modal_default_3 .modal-body").html(response.vtabel);
			}
		});
	});

});
</script>

<?php
	$isi_cmb = array(
				''=>'--Semua--',
				'b.tanggal' => 'Tanggal Penerimaan',
				'f.nama' => 'Nama Suplier',
				'd.jenis_barang' => 'Jenis Barang'
			);
?>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2><?=$header?></h2>
					<div class="side pull-right">
					</div>
				</div>
			</div>
		</div>
	</div>
<form action="<?=$url?>" method="POST">
	<div class="col-md-8">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filter</h2>
			</div>
			<div class="content controls">
				<div class="form-row">
                    <!-- <div class="col-md-3">
                    	<div class="input-group">
	                        <div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
	                        <input type="text" class="datepicker form-control" name="tanggal" value="<?=$this->form_data->tanggal?>" />
	                    </div>
                    </div> -->
                    <div class="col-md-3">
                    	<?=form_dropdown('tahun',$cmb_tahun,$this->form_data->cmb_tahun,'class="form-control" ')?>
                    </div>
                    <div class="col-md-3">
                    	<?=form_dropdown('bulan',$cmb_bulan,$this->form_data->cmb_bulan,'class="form-control" ')?>
                    </div><!-- 
                    <div class="col-md-3">
                    	<?=form_dropdown('jenis',$cmb_jenis_barang,$this->form_data->cmb_jenis,'class="form-control" ')?>
                    </div>
                    <div class="col-md-3">
                    	<?=form_dropdown('suplier',$cmb_suplier,$this->form_data->cmb_suplier,'class="form-control" ')?>
                    </div> -->
                    <div class="col-md-3">
                    	<button type="submit" class="btn btn-success">Proses</button>
                    </div>
                </div>
			</div>
		</div>
	</div>
</form>
	<div class="col-md-8">
		<div class="block block-fill-white">
			<div class="header">
				<h2><?=$header_title?></h2>
			</div>
			<div class="content">
				<table id="myTable" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr> 
                        	<th>No</th>   
                        	<th>Bulan</th>
                            <th>Total</th>
                            <th></th>                             
                        </tr>
                    </thead>
                    <?php
                    $no = 1; 
                    foreach ($data as $row) {
                    	# code...
                    ?>
                    	<!-- <tr>
                    		<td><?=$no?></td>
                    		<td><?=$row->nama?></td>
                    		<td><?=$row->kode_jenis_barang." - ".$row->jenis_barang?></td>
                    		<td><?=$row->tanggal?></td>
                    		<td><?=$row->total?></td>
                    	</tr> -->
                    	<!-- <tr>
                    		<td><?=$no?></td>
                    		<td><?=$row->suplier?></td>
                    		<td><?=$row->tanggal?></td>
                    		<td><?=$row->nama_barang?></td>
                    		<td><?=$row->nama?></td>
                    		<td><?=$row->kuantitas?></td>
                    	</tr> -->
                    	<tr>
                    		<td><?=$no?></td>
                    		<td><?=$row->bulan." - ".$row->tahun?></td>
                    		<td><?=$row->total?></td>
                    		<td><a href="#modal_default_3" data-toggle="" class="detil-barang btn btn-info tip icon-search" title="Detail" data-tahun="<?=$row->tahun?>" data-bulan="<?=$row->bulan?>" data-url="<?=base_url()?>pembelian_penerimaan_barang_stock/detil" data-wd="900px" data-title="<?=$row->bulan." - ".$row->tahun?>">&nbsp;Detail</a></td>
                    	</tr>
                    <?php $no++; } ?>
                    <tbody>
                    </tbody>	
                </table>
			</div>
		</div>
	</div>
</div>