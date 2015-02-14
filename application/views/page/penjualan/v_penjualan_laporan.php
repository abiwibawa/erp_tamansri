<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h4>Laporan Penjualan</h4>
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
					<div class="col-md-2">Tanggal Awal</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="datepicker form-control" id="tanggal1" ')?>
						</div>
					</div>
					<div class="col-md-2">Tanggal Akhir</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="datepicker form-control" id="tanggal2" ')?>
						</div>
					</div>
				</div>
				
				<div class="form-row" id="fresult">
				</div>
			</div>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4></h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped ">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">Tanggal</th>
						<th width="5%">No. Order</th>
						<th width="5%">Sub Total</th>
						<th width="5%">Pajak</th>
						<th width="5%">Total Penjualan</th>
						<th width="5%">Pembayaran</th>
						<th width="5%">Saldo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>