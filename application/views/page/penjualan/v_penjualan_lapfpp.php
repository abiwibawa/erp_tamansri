<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h4>Riwayat Faktur Pajak</h4>
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
					<div class="col-md-4"><?=form_dropdown('filter',array('f1'=>'No Faktur','f2'=>'Tanggal Surat','f3'=>'Kode Customer'),'','class="form-control"')?></div>
				</div>
				
				<div class="form-row" id="fresult">
				</div>
			</div>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Riwayat Faktur Pajak</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">Tanggal</th>
						<th width="5%">No. Faktur</th>
						<th width="5%">Kode Customer</th>
						<th width="5%">Nilai</th>
						<th width="5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>