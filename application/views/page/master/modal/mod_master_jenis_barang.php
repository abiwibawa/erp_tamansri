<input type="hidden" name="id_jenis_barang" value="<?=$this->form_data->id_jenis_barang?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Kode Jenis Barang
		</div>
		<div class="col-md-9">
			<?=form_input('kode',$this->form_data->kode,'class="validate[required] form-control" placeholder="Kode Jenis Barang"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Nama Jenis Barang
		</div>
		<div class="col-md-9">
			<?=form_input('nama',$this->form_data->nama,'class="form-control" placeholder="Nama Jenis Barang"')?>
		</div>
	</div>                   
</div>