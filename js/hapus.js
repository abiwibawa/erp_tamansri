function hapus_item(url,arrID){
	var mySplit = arrID.split('.');
	var data = {};
	for(var i=0;i<mySplit.length;i++){
        data[i] = mySplit[i];
    }
	$.ajax({
		type: "POST",
		dataType: "json",
		url : url,
		data: data,
		success: function(response){
			//alert(response.total);
			$("#subtotal").val(response.subtotal);
			$("#total_harga").val(response.subtotal);
			$("#total").val(response.total);
			$('tbody').html('');
			$('tbody').append(response.vtabel);
			
			$(".hapus_item").click(function(){
				var vurl = $(this).attr("direction");
				var id = $(this).attr("id");
				//alert(vurl);
				hapus_item(vurl,id);
			});
		}
	});
}

$(".hapus_item").click(function(){
	var vurl = $(this).attr("direction");
	var id = $(this).attr("id");
	//alert(vurl);
	hapus_item(vurl,id);
});
