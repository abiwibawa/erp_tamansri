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
					<h2>Riwayat Kwitansi</h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filters</h2>
			</div>
			<form action="<?=base_url('penjualan_lapkwitansi/filter')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2">
						<?=form_dropdown('filter',array('f4'=>'No Invoice','f1'=>'No Kwitansi','f2'=>'Tanggal','f3'=>'Kode Customer'),$this->form_data->filter,'class="form-control" onChange="changefilter()" id="filter"')?>
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
					
					<div class="col-md-2"  style="display:">
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
				<h4>Daftar Riwayat Kwitans <?=$judullaporan?></h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="5%">No Kwitansi</th>
						<th width="5%">Tanggal</th>
						<th width="5%">Kode / Nama Customer</th>
						<th width="5%">Nilai</th>
						<th width="5%" colspan="3">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($data as $row){ ?>
					<tr>
						<td><?=$row['no']?></td>
						<td><?=$row['no_kwitansi']?></td>
						<td><?=$row['tanggal']?></td>
						<td><?=$row['kode_customer']?></td>
						<td align="right"><?=$row['total']?></td>
						<td align="center">
							<button type="button" class="btn btn-primary tip detil_order" title data-original-title="Lihat Detail Kwitansi" data-id="<?=$row['id_kwitansi']?>" data-url="<?=base_url('penjualan_lapkwitansi/showdetil')?>"><i class="icon-zoom-in"></i>&nbsp;&nbsp;detail</button>
						</td>
						<td align="center">
							<a class="btn btn-danger tip" title data-original-title="Cetak Kwitansi"  href="<?=base_url('penjualan_kwitansi/cetak_surat/'.$row['id_kwitansi'])?>" target="_blank"><i class="icon-print"></i>&nbsp;&nbsp;cetak</a>
						</td>
						<td align="center">
							<button type="button" class="btn btn-success tip edit" title data-original-title="Edit Kwitansi" data-id="<?=$row['id_kwitansi']?>" data-url="<?=base_url('penjualan_lapkwitansi/vedit')?>"><i class="icon-pencil"></i>&nbsp;&nbsp;edit</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
				<?php if(count($data)>0) echo $paginator; ?>
			</div>
		</div>
	</div>
</div>