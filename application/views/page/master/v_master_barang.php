<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Master Barang</h2>
					<div class="side pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">export</button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							  <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
							  <li><a href="#"><i class="icon-th"></i> Excel</a></li>
							  <li><a href="#"><i class="icon-file-alt"></i> PDF</a></li>
							  <li><a href="#"><i class="icon-print"></i> Print</a></li>
							</ul>
						</div>
						<a href="#modal_default_2" data-toggle="modal" class="addmaster btn btn-primary" data-direction="<?=base_url('master_barang/addmodal')?>" data-wd="700px" data-original-title="Tambah Jenis Barang" data-href="<?=base_url('master_barang/tambah')?>">
							<i class="icon-plus-sign-alt"></i>&nbsp;&nbsp;tambah
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="block block-fill-white">
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="10%">Kode Barang</th>
						<th width="25%">Jenis Barang</th>
						<th width="25%">Nama Barang</th>
						<th width="5%">Aksi</th>                                    
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($data_master as $row):?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->kode_barang?></td>
						<td><?=$row->kode_jenis_barang?>-<?=$row->nama_jenis_barang?></td>
						<td><?=$row->nama_barang?></td>
						<td><a href="#modal_default_2" data-toggle="modal" class="editmaster btn btn-primary" data-direction="<?=base_url('master_barang/editmodal')?>" data-wd="700px" data-original-title="Edit Jenis Barang" data-href="<?=base_url('master_barang/update')?>" data-id="<?=$row->id_barang?>"><i class="icon-pencil"></i>&nbsp;&nbsp;edit</a></td>
					</tr>
					<?php $no++; endforeach;?>
				</tbody>
				</table>
			</div>
		</div>              
	</div>
</div>