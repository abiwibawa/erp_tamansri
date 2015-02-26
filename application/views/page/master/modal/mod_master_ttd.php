<input type="hidden" name="id_ttd" value="<?=$this->form_data->id_ttd?>">
<div class="controls">
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
			Jabatan
		</div>
		<div class="col-md-9">
			<?=form_input('jabatan',$this->form_data->jabatan,'class="form-control" placeholder="jabatan"')?>
		</div>
	</div>
</div>