<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Master Tanda Tangan</h2>
					<div class="side pull-right">
						<a href="#modal_default_2" data-toggle="modal" class="addmaster btn btn-primary" data-direction="<?=base_url('master_ttd/addmodal')?>" data-wd="700px" data-original-title="Tambah Tanda Tangan" data-href="<?=base_url('master_ttd/tambah')?>">
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
						<th width="25%">Nama</th>
						<th width="10%">Jabatan</th>
						<th width="10%">Aksi</th>                              
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($data_master as $row):?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->nama?></td>
						<td><?=$row->jabatan?></td>
						<td><a href="#modal_default_2" data-toggle="modal" class="editmaster btn btn-primary" data-direction="<?=base_url('master_ttd/editmodal')?>" data-wd="700px" data-original-title="Edit Tanda Tangan" data-href="<?=base_url('master_ttd/update')?>" data-id="<?=$row->id_ttd?>"><i class="icon-pencil"></i>&nbsp;&nbsp;edit</a>
						
						<a href="#modal_default_3" data-toggle="modal" class="detailmaster btn btn-primary" data-direction="<?=base_url('master_ttd/viewdet')?>" data-wd="700px" data-original-title="Detail Supir" data-href="<?=base_url('master_ttd/update')?>" data-id="<?=$row->id_ttd?>"><i class="icon-search"></i>&nbsp;&nbsp;detail</a></td>
					</tr>
					<?php $no++; endforeach;?>
				</tbody>
				</table>
			</div>
		</div>              
	</div>
</div>