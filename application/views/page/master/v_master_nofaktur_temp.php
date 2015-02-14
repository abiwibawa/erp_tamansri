<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Preview Faktur Pajak</h2>
				</div>
			</div>
		</div>
		<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Hasil preview hasil no faktur pajak sebelum disimpan</h4>
			</div>
			<div class="content controls">
				<div class="form-row">
					<div class="col-md-2"><a href="<?=base_url('master_nofaktur/proses')?>" class="btn btn-success">Simpan</a></div>
					<div class="col-md-2"><a href="<?=base_url('master_nofaktur/cancel')?>" class="btn btn-danger">Cancel</a></div>
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