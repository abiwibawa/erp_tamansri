function base_url(ext) {
	var ret_url = '',
	url = window.location.href,
	base = url.substring(0, url.indexOf('/', 14));
	if (base.indexOf(window.location.protocol + '//localhost') != -1 || is_ip4(base.replace(window.location.protocol + '//', ''))) {
		var pathname = window.location.pathname,
		index1 = url.indexOf(pathname),
		index2 = url.indexOf("/", index1 + 1),
		base_local_url = url.substr(0, index2);
		ret_url = base_local_url + "/";
	} else {
		ret_url = base + "/";
	};
	if (ext !== undefined && ext !== '') {
		ret_url += ext;
	};
	return ret_url;
};
function is_ip4(s) {
	var match = s.match(/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/);
	return match !== null && match[1] <= 255 && match[2] <= 255 && match[3] <= 255 && match[4] <= 255;
};
var changeInput = function (elementName) {
	if ($("[name='" + elementName + "']").length > 0) {
		$("[name='" + elementName + "']").on("focus", function () {
			if (!$(this).val() && $(this).parent().find("label.error")) {
				$(this).parent().find("label.error").remove();
			}
		});
	};
}, setDataAjx = function ($uri) {
	$.ajax({
		url : $uri,
		dataType : "json",
		success : function (response) {
			if (response) {
				clearTable();
				$.each(response, function (id, v) {
					createTable(v);
				});
			};
		},
		error : function (c, t) {
			alert(t);
		}
	});
}, deleteItem = function ($type, thisItem, keyf, keys, keyt, keyft) {
	var parentElement = $(thisItem).closest("tr");
	$.ajax({
		url : base_url("ta_" + $type + "/delete"),
		data : {
			first : keyf,
			second : keys,
			third : keyt,
			four : keyft
		},
		dataType : "json",
		success : function (response) {
			if (response) {
				parentElement.remove();
			};
		},
		error : function (c, t) {
			alert(t);
		}
	});
}, clearTable = function () {
	if ($("#tabelbody").length > 0) {
		$("#tabelbody").empty();
	};
}, createTable = function (setData) {
	if ($("#tabelbody").length > 0) {
		var setTable = "";
		$.each(setData, function (indx, vale) {
			setTable = setTable + "<td>" + vale + "</td>";
		});
		setTable = "<tr>" + setTable + "</tr>";
		$("#tabelbody").append(setTable);
	}
}, evenSubmit = function (elementForm) {
	var setData = elementForm.serializeArray(),
	uri = elementForm.attr("action");
	$.ajax({
		type : "post",
		url : uri,
		data : setData,
		dataType : "json",
		success : function (response) {
			createTable(response);
		},
		error : function (c, t) {
			alert(t);
		}
	});
}, evenSubmitNext = function (elementForm) {
	var setData = elementForm.serializeArray(),
	uri = elementForm.attr("action");
	$.ajax({
		type : "post",
		url : uri,
		data : setData,
		dataType : "json",
		success : function (response) {
			window.location = (base_url(response));
		},
		error : function (c, t) {
			alert(t);
		}
	});
}, filledAuto = function () {
	if ($("[data-filled]").length > 0) {
		var ParentElement = $("[data-filled]");
		ParentElement.each(function () {
			$(this).on("keyup", function () {
				var AllValueResult = 0;
				ParentElement.each(function () {
					if (!isNaN($(this).val()) && $(this).val().length > 0) {
						AllValueResult = parseInt(AllValueResult) + parseInt($(this).val());
					}
				});
				var thisNumric = (!isNaN($(this).val()) && $(this).val().length > 0),
				fillElement = $($(this).attr("data-filled"));
				if (thisNumric) {
					fillElement.val(AllValueResult);
				}
			});
		});
	};
}, evenForm = function (elementForm) {
	var elForm = (elementForm) ? elementForm : $("[id^='form-']");
	if (elForm.length > 0) {
		var dataForm = elForm.serializeArray(),
		counter = 0,
		rulesDefault = {},
		mssgesDefault = {},
		textEr = " harus di isi!!",
		textErNumber = " harus Angka";
		for (property in dataForm) {
			var attr = $("[name='" + dataForm[counter].name + "']"),
			names = dataForm[counter].name.replace("_", " ").replace("kd", "kode "),
			status = (attr.hasClass("unform")) ? false : true,
			numeric = (attr.hasClass("number")) ? true : false;
			rulesDefault[dataForm[counter].name] = {
				required : status,
				number : numeric
			};
			mssgesDefault[dataForm[counter].name] = {
				required : names + textEr,
				number : names + textErNumber
			};
			counter++;
		};
		filledAuto();
		elForm.each(function () {
			$(this).validate({
				rules : rulesDefault,
				messages : mssgesDefault,
				submitHandler : function (form) {
					if ($(form).attr("result")) {
						if($(form).attr("result") === "none"){
							evenSubmit($(form));
						}else{
							$(form).submit();
						}
					} else {
						evenSubmitNext($(form));
					}
				}
			});
		});
	};
}, correctData = function (span) {
	if ($(".correction").length > 0) {
		$(".correction").on("click", function () {
			var status = ($($(this).attr("data-next")).length > 0 && $($(this).attr("data-next") + span).length > 0) ? true : false;
			if (status) {
				$($(this).attr("data-next") + span).val($($(this).attr("data-next")).val());
			};
		});
	};
},priority=function(){
	if($(".prioritas").length>0){
		$(".prioritas").on("click",function(){
			var text=$(this).parent().next().html(),
					idSend=$(this).attr("data-id");
			$("#name_text").html(text);
			$("#idSend").val(idSend);
			$.ajax({
				type : "post",
				url:base_url("usulan_musrenbang/prioritas"),
				data :{data_send:idSend},
				dataType : "json",
				success : function (response) {
					$("#prioritas").html(response.selected);
					$("#prioritas").val(response.id);
				},
				error : function (c, t) {
					alert(t);
				}
			});
			
		});
	};
},fnChecker=function(){
	if($(".checker").length>0){
		$(".checker").on("change",function(){
			var $e=$(this),name=$e.attr("name"),status=(name==="checkall")?true:false;
			if(status){
				var allcheck=($(".checker:not([name='checkall'])").length>0)?$(".checker:not([name=checkall])"):false,status_check=false;
				if(allcheck&&$e.is(":checked")){
					status_check=true;
					$(".checker_nav").show();
				}else if(allcheck&&!$e.is(":checked")){
					status_check=false;
					$(".checker_nav").hide();
				};				
				allcheck.prop("checked", status_check);
			}else{
				if($e.is(":checked")){
					$(".checker_nav").show();
				}else if(!$(".checker:checked").length>0){
					$(".checker_nav").hide();
				};
			};
		});
	};
	if($(".dispell_check").length>0){
		$(".dispell_check").on("click",function(){
			$(".checker:checked").closest("tr").attr('class', 'red-color');
			var list_check=$(".checker:checked:not([name='checkall'])").slice(),
					list_array={};
			$.each(list_check,function(x,y){
				list_array[x]={check:"'"+y.value+"'"};
			});
			alert(list_array);
		});
	};
};
evenForm(false);
correctData("_koreksi");
priority();
fnChecker();