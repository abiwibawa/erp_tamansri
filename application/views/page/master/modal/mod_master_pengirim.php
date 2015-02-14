<input type="hidden" name="id_pengirim" value="<?=$this->form_data->id_pengirim?>">
<div class="controls">
	<div class="form-row">
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Nama
		</div>
		<div class="col-md-9">
			<?=form_input('nama',$this->form_data->nama,'class="validate[required] form-control" placeholder="Nama"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Alamat
		</div>
		<div class="col-md-9">
			<?=form_input('alamat',$this->form_data->alamat,'class="form-control" placeholder="Alamat"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Telp
		</div>
		<div class="col-md-9">
			<?=form_input('notelp',$this->form_data->notelp,'class="form-control" placeholder="Telp"')?>
		</div>
	</div>
</div>