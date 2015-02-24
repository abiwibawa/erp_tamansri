<script>
		$(document ).ready(function() {
			$("#div_input_f1").show();
			$("#div_input_f2").hide();
			$("#div_input_f3").hide();
			$("#filter").change(function(){
				$("#div_input_f1").hide();
				$("#div_input_f2").hide();
				$("#div_input_f3").hide();
				$("#div_input_f4").hide();
				
				if($(this).val()=='f1')
					$("#div_input_f1").show();
				else if($(this).val()=='f2')
					$("#div_input_f2").show();
				else if($(this).val()=='f3')
					$("#div_input_f3").show();
				else if($(this).val()=='f4')
					$("#div_input_f4").show();
			});
			
			$("tbody").html("");

			$("#btn_submit").click(function(){
				if($("#filter").val()=='f1')
					var key = $("#input_f1").val();
				else if($("#filter").val()=='f2')
					var key = $("#input_f2_1").val()+'|'+$("#input_f2_2").val();
				else if($("#filter").val()=='f3')
					var key = $("#input_f3").val();
				else if($("#filter").val()=='f4')
					var key = $("#input_f4").val();
				
				$.ajax({
					type: "POST",
					dataType: "json",
					url : "<?=base_url('penjualan_lapfp/daftarriwayatfakturpajak')?>",
					data: {filter:$("#filter").val(),key:key},
					success: function(response){
						$("tbody").html("");
						$("tbody").append(response.vtabel);
					}
				});
			});
		});
</script>
<div class="row">                
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h4>Riwayat Faktur Pajak</h4>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="block block-fill-white">
			<div class="header">
				<h2>Filters</h2>
			</div>				
			<div class="content controls">
				<div class="col-md-12">
					<div class="col-md-1">Filter</div>
					<div class="col-md-2"><?=form_dropdown('filter',array('f1'=>'No Faktur','f2'=>'Tanggal Surat','f3'=>'Kode Customer'),'','id="filter" class="form-control"')?></div>
					<div class="col-md-3" id="div_input_f1"><input type="text" name="input_f1" id="input_f1" class="form-control" placeholder="Masukkan No Faktur"></div>
					<div class="col-md-5" id="div_input_f2">
															<div class="col-md-6"><div class="input-group"><div class="input-group-addon"><span class="icon-calendar-empty"></span></div><input type="text" name="input_f2" id="input_f2_1" class="datepicker form-control" placeholder="Tanggal Surat Mulai"></div></div>
															<div class="col-md-6"><div class="input-group"><div class="input-group-addon"><span class="icon-calendar-empty"></span></div><input type="text" name="input_f2" id="input_f2_2" class="datepicker form-control" placeholder="Tanggal Surat Akhir"></div></div>
					</div>
					<div class="col-md-3" id="div_input_f3"><input type="text" name="input_f3" id="input_f3" class="form-control" placeholder="Masukkan Kode Customer"></div>
					<div class="col-md-2"><button type="button" id="btn_submit" class="btn btn-success">Tampilkan</button></div>
				</div>
			</div>
		</div>
	</div>
          
	<div class="col-md-12">
		<div class="block block-fill-white">
			<div class="header">
				<h4>Riwayat Faktur Pajak</h4>
			</div>
			<div class="content">
				<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="5%">Tanggal</th>
						<th width="5%">No. Faktur</th>
						<th width="5%">Kode Customer</th>
						<th width="5%">Nilai</th>
						<th width="5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>