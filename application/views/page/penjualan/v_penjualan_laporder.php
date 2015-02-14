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
					<h2>Riwayat Order</h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filters</h2>
			</div>
			<form action="<?=base_url('penjualan_laporder/filter')?>" method="post">
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2">
						<?=form_dropdown('filter',array('f1'=>'No Dokumen Order','f2'=>'Tanggal Order','f3'=>'Kode Customer'),$this->form_data->filter,'class="form-control" onChange="changefilter()" id="filter"')?>
					</div>
					<div class="col-md-2 c1"  <?php if( $this->form_data->filter == "f1" || $this->form_data->filter == "f3" || $this->form_data->filter == "") echo "style=\"display:\""; else echo "style=\"display:none\"";?>>
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
				<h4>Daftar Riwayat Order <?=$judullaporan?></h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr align="center" style="text-align:center">
						<th width="5%">No</th>
						<th width="5%">Tanggal Order</th>
						<th width="10%">No Dokumen</th>
						<th width="5%">Kode Customer</th>
						<th width="5%" colspan="2">Aksi</th>                              
					</tr>
				</thead>
				<tbody>
				<?php foreach($data as $row){ ?>
					<tr>
						<td><?=$row['nomor']?></td>
						<td><?=$row['tanggal']?></td>
						<td><?=$row['no_dokumen']?></td>
						<td><?=$row['kode_customer']?></td>
						<td align="center">
							<button type="button" class="btn btn-primary tip detil_order" title data-original-title="Lihat Detail Order" data-id="<?=$row['id_order']?>" data-url="<?=base_url('penjualan_laporder/showdetil')?>"><i class="icon-zoom-in"></i>&nbsp;&nbsp;detail</button>
						</td>
						<td align="center">
						<?php if($row['status_sj']==0) { ?>
							<button type="button" class="btn btn-success tip edit" title data-original-title="Edit Order" data-id="<?=$row['id_order']?>" data-url="<?=base_url('penjualan_laporder/vedit')?>"><i class="icon-pencil"></i>&nbsp;&nbsp;edit</button>
						<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>