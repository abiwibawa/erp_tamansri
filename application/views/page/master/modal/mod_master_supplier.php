<input type="hidden" name="id_suplier" value="<?=$this->form_data->id_suplier?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Kode
		</div>
		<div class="col-md-9">
			<?=form_input('kode_suplier',$this->form_data->kode_suplier,'class="validate[required] form-control" placeholder="Kode"')?>
		</div>
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
			Kota
		</div>
		<div class="col-md-9">
			<?=form_input('kota',$this->form_data->kota,'class="form-control" placeholder="Kota"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Kode Pos
		</div>
		<div class="col-md-9">
			<?=form_input('kodepos',$this->form_data->kodepos,'class="form-control" placeholder="Kode Pos"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Telp
		</div>
		<div class="col-md-9">
			<?=form_input('telpon',$this->form_data->telpon,'class="form-control" placeholder="Telp"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Fax
		</div>
		<div class="col-md-9">
			<?=form_input('fax',$this->form_data->fax,'class="form-control" placeholder="Fax"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Email
		</div>
		<div class="col-md-9">
			<?=form_input('email',$this->form_data->email,'class="form-control" placeholder="Email"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Bank
		</div>
		<div class="col-md-9">
			<?=form_input('bank',$this->form_data->bank,'class="form-control" placeholder="Bank"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			No. Rekening
		</div>
		<div class="col-md-9">
			<?=form_input('account_bank',$this->form_data->account_bank,'class="form-control" placeholder="No. Rekening"')?>
		</div>
	</div>
</div>