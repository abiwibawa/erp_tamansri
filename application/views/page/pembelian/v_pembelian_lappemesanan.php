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
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="5%">Nama</th>
						<th width="5%">Kode Suplier</th>
						<th width="5%">Tanggal Pemesanan</th>
						<th width="5%">Tanggal Pengiriman</th>
						<th width="5%" colspan="3">Aksi</th>                              
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
							<a class="btn btn-danger tip" title data-original-title="Cetak Laporan Pemesanan"  href="<?=base_url('pembelian_pemesanan/cetak/'.$row['id_pemesanan_h'])?>" target="_blank"><i class="icon-print"></i>&nbsp;&nbsp;cetak</a>
						</td>
					</tr>
				<?php $no++;} ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>