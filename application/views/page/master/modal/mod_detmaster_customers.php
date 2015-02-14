<input type="hidden" name="id_customer" value="<?=$this->form_data->id_customer?>">
<div class="controls">
	<div class="form-row">
		<div class="col-md-3">
			Kode Customer
		</div>
		<div class="col-md-9">
			<?=form_input('kode_customer',$this->form_data->kode_customer,'class="validate[required] form-control" placeholder="Kode Customer"')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Nama
		</div>
		<div class="col-md-9">
			<?=form_input('nama',$this->form_data->nama,'class="validate[required] form-control" placeholder="Nama Customer" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Inisial
		</div>
		<div class="col-md-9">
			<?=form_input('inisial',$this->form_data->inisial,'class="form-control" placeholder="Inisial Customer" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Alamat
		</div>
		<div class="col-md-9">
			<?=form_input('alamat',$this->form_data->alamat,'class="form-control" placeholder="Alamat Customer" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Kota
		</div>
		<div class="col-md-9">
			<?=form_input('kota',$this->form_data->kota,'class="form-control" placeholder="Kota Customer" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Kode Pos
		</div>
		<div class="col-md-9">
			<?=form_input('kodepos',$this->form_data->kodepos,'class="form-control" placeholder="Kode Pos" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Telp
		</div>
		<div class="col-md-9">
			<?=form_input('telpon',$this->form_data->telpon,'class="form-control" placeholder="Telp" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			Email
		</div>
		<div class="col-md-9">
			<?=form_input('email',$this->form_data->email,'class="form-control" placeholder="Email" readonly')?>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-3">
			NPWP
		</div>
		<div class="col-md-9">
			<?=form_input('npwp',$this->form_data->npwp,'class="form-control" placeholder="NPWP" readonly')?>
		</div>
	</div>
</div>