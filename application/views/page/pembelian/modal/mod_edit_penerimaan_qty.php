<input type="hidden" name="id_penerimaan_d" value="<?=$this->form_data->id_penerimaan_d?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Nama Barang
		</div>
		<div class="col-md-9">
			<?=form_input('nama_barang',$this->form_data->nama_barang,'class="form-control" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Kuantitas
		</div>
		<div class="col-md-9">
			<?=form_input('qty',$this->form_data->kuantitas,'class="form-control" placeholder="Kuantias"')?>
		</div>
	</div>                   
</div>