<script>
function changefilter(){
	var filter = $("#filter").val();
	if(filter == "f1"){
		$(".c1").css("display","");
		$(".c2").css("display","none");
	}
	
	if(filter == "f3"){
		$(".c1").css("display","");
		$(".c2").css("display","none");
	}
	
	if(filter == "f4"){
		$(".c1").css("display","");
		$(".c2").css("display","none");
	}
	
	if(filter == "f2"){
		$(".c1").css("display","none");
		$(".c2").css("display","");
	}
}
$(function() { 
	$(".detil_laporan_pembelian").click(function(){
		var id_pemesanan_h = $(this).attr("id_pemesanan_h");
		$.ajax({
			type: "POST",
			dataType: "json",
			url : "<?=base_url('pembelian_lappemesanan/listdetail')?>",
			data: {id_pemesanan_h:id_pemesanan_h},
			success: function(response){
				$("#modal_default_3").modal("show");
				$("#modal_default_3 .modal-header .modal-title").html("Detail Laporan Pemesanan : "+response.no_pemesanan);
				$("#modal_default_3 .modal-body").html(response.vtabel);
			}
		});
	});

	$(".edit").click(function(){
		$("#id_pemesanan_h").val($(this).attr("id_pemesanan_h"));
		$("#form_edit").submit();
	});
	
});
</script>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Laporan pemesanan</h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filters</h2>
			</div>
			<form action="<?=base_url('pembelian_lappemesanan')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-3">
						<?=form_dropdown('filter',array('f4'=>'Nama','f1'=>'Kode Suplier','f2'=>'Tanggal Pemesanan'),$this->form_data->filter,'class="form-control" onChange="changefilter()" id="filter"')?>
					</div>
					<div class="col-md-2 c1"  <?php if( $this->form_data->filter == "f1" || $this->form_data->filter == "f3" || $this->form_data->filter == "f4" || $this->form_data->filter == "") echo "style=\"display:\""; else echo "style=\"display:none\"";?>>
						<?=form_input('key',$this->form_data->key,'class="form-control"')?>
					</div>
					
					<div class="col-md-2 c2"  <?php if( $this->form_data->filter == "f2") echo "style=\"display:\""; else echo "style=\"display:none\"";?>>
						<div class="input-group">
								<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
								<?=form_input('tanggal1',$this->form_data->tanggal1,'class="datepicker form-control" id="tanggal1" ')?>
						</div>
					</div>
					
					<div class="col-md-2 c2"  <?php if( $this->form_data->filter == "f2") echo "style=\"display:\""; else echo "style=\"display:none\"";?>>
						<div class="input-group">
								<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
								<?=form_input('tanggal2',$this->form_data->tanggal2,'class="datepicker form-control" id="tanggal2" ')?>
						</div>
					</div>
					
					<div c"col-lass=md-2"  style="display:">
						<button type="submit" class="btn btn-success"><i class="icon-search"></i>&nbsp;cari</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Daftar Laporan Pemesanan</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped ">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="20%">Nama</th>
						<th width="15%">Kode Suplier</th>
						<th width="10%">Tanggal Pemesanan</th>
						<th width="10%">Tanggal Pengiriman</th>
						<th width="3%" colspan="3"><div align="center">Aksi</div></th>                              
					</tr>
				</thead>
				<tbody>
				<?php $no=1;foreach($data as $row){?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['nama']?></td>
						<td><?=$row['kode_suplier']?></td>
						<td><?=$row['tanggal_pemesanan']?></td>
						<td><?=$row['tanggal_pengiriman']?></td>
						<td align="center">
							<button type="button" class="btn btn-primary tip detil_laporan_pembelian" title data-original-title="Lihat Detail Laporan Pemesanan" id_pemesanan_h="<?=$row['id_pemesanan_h']?>"><i class="icon-zoom-in"></i>&nbsp;&nbsp;detail</button>
						</td>
						<td align="center">
							<a class="btn btn-danger tip" title data-original-title="Cetak Laporan Pemesanan"  href="<?=base_url('pembelian_pemesanan/cetak/'.$row['id_pemesanan_h'])?>" target="_blank"><i class="icon-print"></i>&nbsp;&nbsp;cetak</a>
						</td>
						<td align="center">
							<button class="btn btn-success tip edit" title data-original-title="Edit Laporan Pemesanan" id_pemesanan_h="<?=$row['id_pemesanan_h']?>"><i class="icon-pencil"></i>&nbsp;&nbsp;edit</button>
						</td>					
					</tr>
				<?php $no++;} ?>
				</tbody>
				</table>
			</div>
		</div>
		
		<form id="form_edit" method="POST" action="<?=base_url('pembelian_pemesanan/edit')?>">
			<input type="hidden" name="id_pemesanan_h" id="id_pemesanan_h">
		</form>
	</div>
</div>