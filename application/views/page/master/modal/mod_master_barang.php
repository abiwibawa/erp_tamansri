<input type="hidden" name="id_barang" value="<?=$this->form_data->id_barang?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Jenis Barang
		</div>
		<div class="col-md-9">
			<?=form_dropdown('id_jenis_barang',$cmbjenisbarang,$this->form_data->id_jenis_barang,'class="form-control"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Kode Barang
		</div>
		<div class="col-md-9">
			<?=form_input('kode',$this->form_data->kode,'class="validate[required] form-control" placeholder="Kode Barang"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Nama Barang
		</div>
		<div class="col-md-9">
			<?=form_input('nama',$this->form_data->nama,'class="form-control" placeholder="Nama Barang"')?>
		</div>
	</div>                   
</div>