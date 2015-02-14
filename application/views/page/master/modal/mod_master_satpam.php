<input type="hidden" name="id_satpam" value="<?=$this->form_data->id_satpam?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Kode Satpam
		</div>
		<div class="col-md-9">
			<?=form_input('kode_satpam',$this->form_data->kode_satpam,'class="validate[required] form-control" placeholder="Kode Satpam"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Nama
		</div>
		<div class="col-md-9">
			<?=form_input('nama',$this->form_data->nama,'class="validate[required] form-control" placeholder="Nama Satpam"')?>
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
			Kota
		</div>
		<div class="col-md-9">
			<?=form_input('kota',$this->form_data->kota,'class="form-control" placeholder="Kota"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Telp
		</div>
		<div class="col-md-9">
			<?=form_input('telp',$this->form_data->telp,'class="form-control" placeholder="Telp"')?>
		</div>
	</div>
</div>