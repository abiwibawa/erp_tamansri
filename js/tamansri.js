$(".tree_link").click(function(){
	$(".tree_link").removeClass("activeNodeLink");
	$(this).addClass("activeNodeLink");
	var id=$(this).attr("id");
	var mySplit = id.split('-');
	$("#id").val(mySplit[0]);
	console.log(mySplit);
	if(mySplit.length>2){
		$("#kode").val(mySplit[1].replace(" ", ""));
		$("#uraian").val(mySplit[2].replace(" ", ""));
	}else{
		$("#kode").val("");
		$("#uraian").val(mySplit[1].replace(" ", ""));
	}
	
	$(".addmaster").attr("data-id",mySplit[0]);
	$(".editmaster").attr("data-id",mySplit[0]);
});
$(".addmaster").click(function(){
	var vurl=$(this).attr("data-direction");
	var title=$(this).attr("data-original-title");
	var action=$(this).attr("data-href");
	var width=$(this).attr("data-wd");
	var dataid=$(this).attr("data-id");
	if(dataid==""){
		$("#modal_default_2 .modal-dialog").css('width',width);
		$.ajax({
			url: vurl,
			dataType: "html",
			beforeSend: function(){
				$("#modal_default_2 .modal-title").empty();
				$("#modal_default_2 .modal-body").empty();
			},
			success: function(response) {
				$("#modal_default_2 .modal-title").html(title);
				$("#modal_default_2 .modal-body").html(response);
				$("#form_modal ").attr('action',action);
			}
		});
	}else{
		$("#modal_default_2 .modal-dialog").css('width',width);
		var parsing = {id:dataid};
		console.log(parsing);
		$.ajax({
			type: "post",
			url: vurl,
			dataType: "html",
			data:parsing,
			beforeSend: function(){
				$("#modal_default_2 .modal-title").empty();
				$("#modal_default_2 .modal-body").empty();
			},
			success: function(response) {
				$("#modal_default_2 .modal-title").html(title);
				$("#modal_default_2 .modal-body").html(response);
				$("#form_modal ").attr('action',action);
			}
		});
	}
});

$(".editmaster").click(function(){
	var vurl=$(this).attr("data-direction");
	var title=$(this).attr("data-original-title");
	var action=$(this).attr("data-href");
	var width=$(this).attr("data-wd");
	var dataid=$(this).attr("data-id");
	
	$("#modal_default_2 .modal-dialog").css('width',width);
	var parsing = {id:dataid};
	$.ajax({
		type: "post",
		url: vurl,
		dataType: "html",
		data:parsing,
		beforeSend: function(){
			$("#modal_default_2 .modal-title").empty();
			$("#modal_default_2 .modal-body").empty();
		},
		success: function(response) {
			$("#modal_default_2 .modal-title").html(title);
			$("#modal_default_2 .modal-body").html(response);
			$("#form_modal ").attr('action',action);
		}
	});
});

function form_order(e){
	var vurl = $(e).attr("action");
	var data2 = $(e).serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			//alert(response.status);
			$("#subtotal").val(response.subtotal);
			$("#total_harga").val(response.subtotal);
			$("#id_order").val(response.id_order);
			
			$('tbody').html('');
			$('tbody').append(response.vtabel);
			
			$("#kode_barang").val('');
			$("#id_barang").val('');
			$("#nama_barang").val('');
			$("#satuan").val('');
			$("#kuantitas").val('');
			$("#harga").val('');
			$("#keterangan").val('');
			
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				
				hapus_item(durl,id);
			});
		}
	});
}

$("#form_order").on('submit',function(e){
	var vurl = $(this).attr("action");
	var data2 = $(this).serialize();
	
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			//alert(response.status);
			if(response.status=="false"){
				$("#modal_default_9").modal("show");
				$("#modal_default_9 .modal-header .modal-title").html("Peringatan");
				$("#modal_default_9 .modal-body").html(response.msg);
				$("#modal_default_9 .modalcloseok").attr("data-direction",response.redir);
			}else{
				$("#subtotal").val(response.subtotal);
				$("#total_harga").val(response.subtotal);
				$("#id_order").val(response.id_order);
				
				$('tbody').html('');
				$('tbody').append(response.vtabel);
				
				$("#kode_barang").val('');
				$("#id_barang").val('');
				$("#nama_barang").val('');
				$("#satuan").val('');
				$("#kuantitas").val('');
				$("#harga").val('');
				$("#keterangan").val('');
			}
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				
				hapus_item(durl,id);
			});
		}
	});
	return false;
});

$(".modalcloseok").click(function(){
	var vurl = $(this).attr("data-direction");
	window.location.replace(vurl);
});

$(".simpan_order").click(function(){
	var vurl = $(this).attr("data-url");
	var id_order = $("#id_order").val();
	
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: "id_order="+id_order,
		success: function(response){
			window.location.replace(response);
		}
	});
});

$(".simpan_sj").click(function(){
	var vurl = $(this).attr("data-url");
	var data2 = $("#form_suratjalan").serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			window.location.replace(response.redir,'_blank');
		}
	});
});

$(".simpan_kw").click(function(){
	var vurl = $(this).attr("data-url");
	var data2 = $("#form_kw").serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			window.location.replace(response.redir,'_blank');
		}
	});
});

$("#pengiriman").keyup(function(){
	var subtotal = parseInt($("#subtotal").val());
	var pengiriman = parseInt($("#pengiriman").val());
	
	$("#total_harga").val(subtotal+pengiriman);
});

$(".detil_order").click(function(){
	var id_order = $(this).attr("data-id");
	var vurl = $(this).attr("data-url");
	//alert(vurl);
	var parsing = {id_order:id_order};
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: parsing,
		success: function(response){
			//alert(response.vtabel);
			$("#modal_default_3").modal("show");
			$("#modal_default_3 .modal-header .modal-title").html("Detail Order : "+response.no_dokumen);
			$("#modal_default_3 .modal-body").html(response.vtabel);
		}
	});
});

$(".edit").click(function(){
	var vurl = $(this).attr("data-url");
	var id_order = $(this).attr("data-id");
	var parsing = {id_order:id_order};
	//alert(vurl);
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: parsing,
		success: function(response){
			window.location.replace(response.redir);
		}
	});
});

$("#form_suratjalan").on('submit',function(e){
	var vurl = $(this).attr("action");
	var data2 = $(this).serialize();
	//alert(data2);
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			if(response.status=="false"){
				$("#modal_default_9").modal("show");
				$("#modal_default_9 .modal-header .modal-title").html("Peringatan");
				$("#modal_default_9 .modal-body").html(response.msg);
				$("#modal_default_9 .modalcloseok").attr("data-direction",response.redir);
			}else{
				$("#subtotal").val(response.subtotal);
				$("#total_harga").val(response.subtotal);
				$("#id_surat_jalan").val(response.id_surat_jalan);
				
				$('tbody').html('');
				$('tbody').append(response.vtabel);
				
				$("#kode_barang").val('');
				$("#id_barang").val('');
				$("#nama_barang").val('');
				$("#satuan").val('');
				$("#kuantitas").val('');
				$("#harga").val('');
				$("#saldo").val('');
				$("#keterangan").val('');
			}
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				
				hapus_item(durl,id);
			});
		}
	});
	return false;
});

$("#form_kw").on('submit',function(e){
	var vurl = $(this).attr("action");
	var data2 = $(this).serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		beforeSend: function(){
			//alert(data2);
		},
		success: function(response){
			//alert(response);
			if(response.status=="false"){
				$("#modal_default_9").modal("show");
				$("#modal_default_9 .modal-header .modal-title").html("Peringatan");
				$("#modal_default_9 .modal-body").html(response.msg);
				$("#modal_default_9 .modalcloseok").attr("data-direction",response.redir);
			}else{
				//alert(response);
				$("#total").val(response.total);
				$("#id_kwitansi").val(response.id_kwitansi);
				$("#terbilang").val(response.terbilang);
				
				$('tbody').html('');
				$('tbody').append(response.vtabel);
				
				$("#no_invoice").val('');
				$("#id_invoice").val('');
				$("#no_order").val('');
				$("#subtotal").val('');
			}
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				
				hapus_item(durl,id);
			});
		}
	});
	return false;
});

$("#form_pembayaran").on('submit',function(e){
	var vurl = $(this).attr("action");
	var data2 = $(this).serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		beforeSend: function(){
			//alert(data2);
		},
		success: function(response){
			//alert(response);
			if(response.status=="false"){
				$("#modal_default_10").modal("show");
				$("#modal_default_10 .modal-header .modal-title").html("Peringatan");
				$("#modal_default_10 .modal-body").html(response.msg);
				$("#modal_default_10 .modalcloseok").attr("data-direction",response.redir);
			}else{
				//alert(response);
				$("#total").val(response.total);
				$("#id_piutang").val(response.id_piutang);
				$("#terbilang").val(response.terbilang);
				$("#no_kwitansi").val('');
				$("#id_kwitansi").val('');
				$("#subtotal").val('');
				$('tbody').html('');
				$('tbody').append(response.vtabel);
			}
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				
				hapus_item(durl,id);
			});
		}
	});
	return false;
});

function panggil(id_order,vurl){
	//alert("asdfafsd");
	var data2 = {id_order:id_order};
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: data2,
		success: function(response){
			$("#subtotal").val(response.subtotal);
			//$("#pengiriman").val(response.pengiriman);
			$("#total_harga").val(response.subtotal);
			$("#id_order").val(response.id_order);
			$("#tanggal").val(response.tanggal);
			$("#kode_customer").val(response.kode_customer);
			$("#id_customer").val(response.id_customer);
			$("#nama_customer").val(response.nama_customer);
			$("#alamat_customer").val(response.alamat_customer);
			$("#telp_customer").val(response.telp_customer);
			$("#kota_customer").val(response.kota_customer);
			$("#syarat_bayar").val(response.syarat_bayar);
			$("#keterangan_order").val(response.keterangan_order);
			$("#id_surat_jalan").val(response.id_surat_jalan);
			$("#id_temp").val(response.id_temp);
			
			$('tbody').html('');
			$('tbody').append(response.vtabel);
			
			$(".hapus_item").click(function(){
				var durl = $(this).attr("direction");
				var id = $(this).attr("id");
				//alert(id);
				hapus_item(durl,id);
			});
		}
	});
}

function hitungsisa(id_order_det,vurl){
	$.ajax({
		type: "POST",
		dataType: "json",
		url : vurl,
		data: {id_order_det:id_order_det},
		beforeSend :function(){
			$("#saldo").val('');
		},
		success: function(response){
			$("#saldo").val(response.sisa);
		}
	});
}