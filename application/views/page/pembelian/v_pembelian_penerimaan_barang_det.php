<?=form_open('pembelian_penerimaan_barang/simpan');?>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Input Penerimaan Barang</h2>
					<div class="side pull-right">
					
						<button class="simpan_order btn btn-primary">
							<i class="icon-save"></i>&nbsp;&nbsp;simpan
						</button>
						
						<a class="btn btn-primary" href="<?=base_url('pembelian_penerimaan_barang/')?>">
							<i class="icon-refresh"></i>&nbsp;&nbsp;batal
						</a>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Data Penerimaan Barang</h2>
			</div>
			<div class="content controls">
			<?=form_hidden('id_pemesanan');?>
				<div class="form-row">
					<div class="col-md-4">No Surat Jalan</div>
					<div class="col-md-6"><?=form_input('no_surat_jalan','','class="form-control"');?></div>
					<div class="col-md-2"></div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Nopol Kendaraan</div>
					<div class="col-md-6"><?=form_input('nopol_kendaraan','','class="form-control"');?></div>
					<div class="col-md-2"></div>
				</div>
				<div class="form-row">
					<div class="col-md-4">Tangal Diterima</div>
					<div class="col-md-6">
						<div class="input-group">
							<div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
							<?=form_input('tanggal','','class="datepicker form-control" id="tanggal" ')?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Detail Pemesanan Barang</h2>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="25%">Nama Barang</th>
						<th width="5%">Qty Pesan</th>
						<th width="5%">Qty Diterima</th>
						<th width="5%">Satuan</th>
						<th width="10%">Keterangan</th>                    
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="5%">1</td>
						<td width="25%">Kertas</td>
						<td width="5%"><?=form_input('qty_terima','1','id="qty_terima" readonly');?></td>
						<td width="5%"><?=form_input('qty_terima','','id="qty_terima"');?></td>
						<td width="10%">lbr</td>
						<td width="10%">ok</td>            
					</tr>
					<tr>
						<td width="5%">1</td>
						<td width="25%">Kertas</td>
						<td width="5%"><?=form_input('qty_terima','1','id="qty_terima" readonly');?></td>
						<td width="5%"><?=form_input('qty_terima','','id="qty_terima"');?></td>
						<td width="10%">lbr</td>
						<td width="10%">ok</td>            
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?=form_close();?>