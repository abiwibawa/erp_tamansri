<input type="hidden" name="id_perkiraan" value="<?=$this->form_data->id_perkiraan?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			No Perkiraan
		</div>
		<div class="col-md-9">
			<?=form_input('no_perkiraan',$this->form_data->no_perkiraan,'class="validate[required] form-control" placeholder="no perkiraan"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Uraian
		</div>
		<div class="col-md-9">
			<?=form_input('uraian',$this->form_data->uraian,'class="form-control" placeholder="uraian"')?>
		</div>
	</div>
</div>