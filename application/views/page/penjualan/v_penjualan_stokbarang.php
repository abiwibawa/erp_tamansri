<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h4>Stok Barang</h4>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filters</h2>
			</div>				
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2">Filter</div>
					<div class="col-md-4"><?=form_dropdown('filter',array('f1'=>'Kode Barang','f2'=>'Nama Barang'),'','class="form-control"')?></div>
				</div>
				
				<div class="form-row" id="fresult">
				</div>
			</div>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Mutasi Stok Barang</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="2%" >No</th>
						<th width="5%" >Kode Barang</th>
						<th width="5%" >Stok Awal</th>
						<th width="5%">Brg. Keluar</th>
						<th width="5%">Brg. Kembali</th>
						<th width="5%">Stok Akhir</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($data as $row){?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->kode_barang?>/<?=$row->nama_barang?></td>
						<td><?=$row->awal?></td>
						<td><?=$row->keluar?></td>
						<td>0</td>
						<td><?=$row->sisa?></td>
					</tr>
					<?php $no++; }?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>