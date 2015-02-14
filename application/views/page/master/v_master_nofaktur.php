<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>List No Faktur Pajak</h2>
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
		<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Form No Faktur</h4>
			</div>
			<div class="content controls">
			<form action="<?=base_url('master_nofaktur/simpan')?>" id="form-nofaktur" method="post">
				<div class="form-row">
					<div class="col-md-2"><?=form_input('kode_status','','class="form-control" placeholder="Kode Status" ')?></div>
					<div class="col-md-2"><?=form_input('tahun','',' class="form-control" id="tahun" placeholder="Tahun" ')?></div>
					<div class="col-md-2"><?=form_input('no_seri_awal','','class="form-control" id="no_seri_awal" placeholder="No Seri Awal"')?></div>
					<div class="col-md-2"><?=form_input('range','','class="form-control" id="range" placeholder="Range" ')?></div>
					<div class="col-md-2"><button type="submit" class="btn_tambah_sj btn btn-block btn-success">tambah</button></div>
				</div>
			</form>
			</div>
		</div>
	</div>
		<div class="block block-fill-white">
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="10%">Kode Status</th>
						<th width="25%">Tahun</th>
						<th width="25%">No Seri</th>
						<th width="5%">Status</th>                                    
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($data_nofaktur as $row):
						$style="";
						if($row['status']=="1"){
							$style="style=\"color: red;font-weight: bold;\"";
						}
					?>
					<tr <?=$style?>>
						<td><?=$no?></td>
						<td><?=$row['kode_status']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['no_seri']?></td>
						<td><?=$row['status']?></td>
					</tr>
					<?php $no++; endforeach;?>
				</tbody>
				</table>
			</div>
		</div>              
	</div>
</div>