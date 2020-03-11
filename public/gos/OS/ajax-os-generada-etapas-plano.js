$(document).ready(function() {
	var app_url = $('#app_url').attr('url');
	var gos_os_id =  document.getElementById('gos_os_id').value;
	var editor;
	$(".tipo_1").hide();
	$(".tipo_2").hide();
	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#checketasimultanea').change(function() {
		if(this.checked) {
			$('#etasimultanea').prop('disabled',false)
		}
		else{
			$('#etasimultanea').prop('disabled',true)
		}
		$('#etasimultanea').selectpicker("refresh");
		console.log(this.checked)

	});
	$.get(app_url+'/osg-siguiente-etapa-f/'+gos_os_id, function(data){

			if(data == 0){
				$("#btnGuardarfinalizarEtapa").hide();

			}
			else{
				$("#btnGuardarfinalizarEtapa").show();
			}

			$("#gos_etapa_id").selectpicker("refresh");
			//$('#dt-etapas-os').DataTable().ajax.reload();
			$('#modal-siguente-etapa').modal('hide');
			$('#btnGuardarSiguienteEtapa').html('Guardar');

	});

	$('#dt-lista-producto-os').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
			responsive: true,
			rowReorder: { update: false },
			paging: false,
			searching: false,
			ordering: true,
			scrollX: true,
			processing : true,
			ajax : app_url+'/ordenes-servicio-producto-items/' + gos_os_id,
			columns : [ {data : 'gos_producto_id',name : 'id','visible' : false},
					{data : 'nombre'},
					{data : 'descripcion'},
					{data : 'codigo_sat'},
					{data : 'cantidad'},
					{data : 'precio_producto'},
					{data : 'descuento'},
					{data : 'precio_producto_final'},
					{data : 'Opciones',name : 'Opciones',orderable : false} ], // archivo OpcionesItemsDatatable
			order : [ [ 1, 'asc' ] ],
			language : {'url' : '/gos/Spanish.json'},
		});
editor = new $.fn.dataTable.Editor({
		ajax : '/osg-guarda-datos-etapa',
		processing : true,
		table : "#dt-etapas-os",
		idSrc : 'gos_os_item_id',
		fields : [ {
			label : "Precio:",
			name : "precio_etapa"
		}, {
			label : "Materiales:",
			name : "precio_materiales"
		} ],
		formOptions : {
			bubble : {
				title : 'Editar'
			}
		}
	});
	// $('#dt-etapas-os').on('click', 'tbody td', function(e) {
	// 	if ($(this).index() < 7) {
	// 		editor.bubble(this);
	// 	}
	// });


	$('body').on('click', '#whatsapp', function () {

		var nombre = $("#nombre").val();
		var marca_vehiculo = $("#marca_vehiculo").val();
		// var marca_vehiculo  =$("#marca_vehiculo").val();
		var modelo_vehiculo = $("#modelo_vehiculo_n").val();
		var taller_tel_principal =$("#taller_tel_principal").val();
		var celular = $("#celular").val();
		var fecha = $("#kt_datetimepicker_2").val();
		var mensaje = "https://api.whatsapp.com/send?phone=52"+
					celular+"&text=Hola " +nombre+ ", le informamos que su "+
					marca_vehiculo + " " +  modelo_vehiculo +" está listo. Fecha de entrega:"+
					fecha + ". Dudas al "+taller_tel_principal+" . Gracias por elegirnos.&source=&data=";
					window.open(mensaje, '_blank');

	});
	$('body').on('click', '#whatsappEtapa', function () {

		var nombre = $("#nombre").val();
		var marca_vehiculo = $("#marca_vehiculo").val();
		// var marca_vehiculo  =$("#marca_vehiculo").val();
		var modelo_vehiculo = $("#modelo_vehiculo_n").val();
		var taller_tel_principal =$("#taller_tel_principal").val();
		var celular = $("#celular").val();
		var fecha = $("#kt_datetimepicker_2").val();
		var mensaje_id = $("#gos_mensaje_id").val();
		if(mensaje_id != null){
			$.get({
				url : app_url+'/obtener-mensaje/'+mensaje_id,
				success: function(data){
					var mensaje ="https://api.whatsapp.com/send?phone=52"+
					celular+"&text="+data;
					window.open(mensaje, '_blank');

				}

			})
		}

	});

	$('body').on('click', '#btnGuardarfinalizarEtapa', function () {
		$('#modal-finalizar-etapa').modal('show');

	});

	$("#btnFinalizar").click(function(){

		$.ajax({contenttype : 'application/json; charset=utf-8',
			data: $('#finalizar-etapa-form').serialize(),
			url : '/finalizar-etapas/',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,textStatus,data) {
				$('#btn-guardar-mensaje').html('Guardar');
				//
				printErrorMsg(textStatus);
				//
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ textStatus);
					}
			},
			success : function(data) {
				var id= $("#gos_os_id").val();

				window.location.href = '/ordenes-servicio';
				$('#dt-clientes').DataTable().ajax.reload();
				$('#finalizar-etapa-form').trigger('reset');
				$('#modal-finalizar-etapa').modal('hide');
				$('#btn-guardar-mensaje').html('Guardar');
			}
		});
	});
	$('body').on('click','#checka',function() {

		var id = $(this).data("id");
		var orden = $(this).data("orden");
		var estado = $(this).data("estado");
		var orden1 = orden +1;
		$("#gos_os_item").val(id);
		$('#gos_mensaje_id').empty();
		var tecnico = $("#tecnicoimp"+orden1).val();
		var nombreeta = $("#nombreinph"+orden).val();
		var asignacion = nombreeta.split(".");
		var asignacions = nombreeta.split(" ");

		if((asignacion[0] == "Asig" || asignacions[0] == "Asig") && estado == "A"){
			if( tecnico == "Sin Técnico" ){
				alert("No se puede finalizar una etapa sin asignar tecnico");
			}
			else{
				$('#modal-siguente-etapa').modal('show');
			}	
		}
		else{
			$('#modal-siguente-etapa').modal('show');
		}

		$.ajax({
			url : app_url+'/obtener-tipo-etapas/'+id,
			type: 'get',
			dataType: 'json',
			success: function(response){
				var tipo = response['data'][0].tipo;
				if(tipo == 1){
					$(".tipo_1").prop('disabled',false);
					$(".tipo_2").prop('disabled',true);
					$(".tipo_2").hide();
					$(".tipo_1").show();
					if($(".tipo_1 option").length>0){
						$(".tipo_2").hide();
						$(".tipo_1").show();
						$(".tipo_1").prop('disabled',false);
					$(".tipo_2").prop('disabled',true);
					}
					else{
						$(".tipo_2").show();
						$(".tipo_1").hide();

					$(".tipo_1").prop('disabled',true);
					$(".tipo_2").prop('disabled',false);
					}
				}else{
					$(".tipo_1").prop('disabled',true);
					$(".tipo_2").prop('disabled',false);
					$(".tipo_1").hide();
					$(".tipo_2").show();
				}
				$(".tipo_1").selectpicker("refresh");
				$(".tipo_2").selectpicker("refresh");
			}
		});
		$.ajax({
			url : app_url+'/obtener-mensaje-etapas/'+id,
			type: 'get',
			dataType: 'json',
			success: function(response){
				var optionBlank = '';

			  var len = 0;
			  if(response['data'] != null){
				len = response['data'].length;

			  }
			  if(len > 0){
				if(len == 1){
					len = 1;
				}
				else{
					var optionBlank = '<option value="0"></option>';
					$("#gos_mensaje_id").append(optionBlank);
				}
				// Read data and create <option >
				for(var i=0; i<len; i++){

				  	var id = response['data'][i].gos_paq_etapa_mensaje_id;
					var name = response['data'][i].mensaje_nomb;

				  	var option = "<option value='"+id+"'>"+name+"</option>";
					$("#gos_mensaje_id").append(option);
					$("#gos_mensaje_id").selectpicker("refresh");
				}
			  }

			}
		});
		$.get({
			url : app_url+'/obtener-fecha-activa/'+id,
			success: function(data){

				$("#kt_datetimepicker_5").val(data.fecha_inicio);
				if(data.fecha_fin != "0000-00-00 00:00:00"){

					$("#kt_datetimepicker_3").val(data.fecha_fin);
				}
				else {
					var today = new Date();
					var dd = String(today.getDate()).padStart(2, '0');
					var min = String(today.getMinutes()).padStart(2, '0');
					var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
					var yyyy = today.getFullYear();

					today = yyyy + '-' + mm + '-' + dd+' '+ today.getHours()+':'+min+':'+today.getSeconds();
					$("#kt_datetimepicker_3").val(today);

				}
			}

		});
		$.get({
			url : app_url+'/obtener-pedida-pago/'+id,
			success: function(data){

				if (data[0].pagodanios==1 || data[0].perdidatotal==1 ) {
					if (data[1].estado_etapa=="A") {
						console.log(data);
           $('#checkperdidapago').show();
           document.getElementById("perdidapagoactiveitem").value=data[1].gos_os_item_id;
					  document.getElementById("perdidapagoactiveitem2").value=data[1].gos_os_item_id;
					}
				}
				else{
         $('#checkperdidapago').hide();
				}
			}
		});
  	});
	$("#btnGuardarSiguienteEtapa").click(function(){
		guardar();
	});
	function guardar(){
	var perdidapago=document.getElementById("perdidaTotal");

	if (perdidapago.checked == true){
    showPerdidaTotal();
	}
   else {


		var mensaje = $("#gos_mensaje_id").val();
		var checkBox = document.getElementById("desactivar_etapa");
		if (checkBox.checked == true){
			$('#btnGuardarSiguienteEtapa').html('Guardando...');
			$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#siguiente-etapa-form').serialize(),
				url : app_url+'/osg-desactivar-etapa',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarSiguienteEtapa').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {

					location.reload();
					$("#gos_etapa_id").selectpicker("refresh");
					//$('#dt-etapas-os').DataTable().ajax.reload();
					$('#modal-siguente-etapa').modal('hide');
					$('#btnGuardarSiguienteEtapa').html('Guardar');
				}
			});
		}
		else{
			if(mensaje == 0){
				alert("Favor de seleccionar un mensaje");
			}else{


				$('#btnGuardarSiguienteEtapa').html('Guardando...');
				$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#siguiente-etapa-form').serialize(),
				url : app_url+'/osg-siguiente-etapa',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarSiguienteEtapa').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					console.log(data);
					if(data == 0){
						$("#btnGuardarfinalizarEtapa").hide();
						$('#modal-siguente-etapa').modal('hide');

						location.reload();
					}
					else if(data == 2){
						alert("No tienes el mínimo de fotos requeridas para la etapa");
					}
					else{
						$("#btnGuardarfinalizarEtapa").show();
						location.reload();

						$("#gos_etapa_id").selectpicker("refresh");
						//$('#dt-etapas-os').DataTable().ajax.reload();
						$('#modal-siguente-etapa').modal('hide');
					}
					$('#btnGuardarSiguienteEtapa').html('Guardar');


				}
			});
			}
		}
	}
 }


});


function showPerdidaTotal(){
$('#ModalPerdidatotal').show();
}
function hideperdidatodal(){
	$('#ModalPerdidatotal').hide();
	$('#perdida_total').prop('checked', false);
}
function displaymodaledit(iditem){
	var idinput = 'preetapint'+iditem;
	var ida = 'clickprecio'+iditem;
	var idbutton = 'btnsaveprecio'+iditem;
	var precioinput = 'precioEinput'+iditem;
	var preciomatinput = 'precioMATinput'+iditem;
	var x = document.getElementsByName("precioEinput");
	for (i = 0; i < x.length; i++){
		
		var itemid= x[i].id;
		var id = itemid.split('t')
		var ida1 = 'clickprecio'+id[1];

		document.getElementById(ida1).style.display = "none";
		document.getElementById(itemid).style.display = "inline";
	}
	var y = document.getElementsByName("precioMATinput");
	for (i = 0; i < y.length; i++){
		
		var itemid= y[i].id;
		var id = itemid.split('t')
		var ida1 = 'clickpreciomaterial'+id[1];

		document.getElementById(ida1).style.display = "none";
		document.getElementById(itemid).style.display = "inline";
	}
	document.getElementById('buttonguardarprecio').style.display = "inline";
	$("#"+precioinput).focus();
	
}
function displaymodaleditmat(iditem){
	var idinput = 'preetapint'+iditem;
	var ida = 'clickprecio'+iditem;
	var idbutton = 'btnsaveprecio'+iditem;
	var precioinput = 'precioEinput'+iditem;
	var preciomatinput = 'precioMATinput'+iditem;
	var x = document.getElementsByName("precioEinput");
	for (i = 0; i < x.length; i++){
		
		var itemid= x[i].id;
		var id = itemid.split('t')
		var ida1 = 'clickprecio'+id[1];

		document.getElementById(ida1).style.display = "none";
		document.getElementById(itemid).style.display = "inline";
	}
	var y = document.getElementsByName("precioMATinput");
	for (i = 0; i < y.length; i++){
		
		var itemid= y[i].id;
		var id = itemid.split('t')
		var ida1 = 'clickpreciomaterial'+id[1];

		document.getElementById(ida1).style.display = "none";
		document.getElementById(itemid).style.display = "inline";
	}
	document.getElementById('buttonguardarprecio').style.display = "inline";
	$("#"+preciomatinput).focus();
	
}
function cambioprecio(iditem){
	var precioinput = 'precioEinput'+iditem;
	var valor = $('#'+precioinput).val();
	var idinput = 'preetapint'+iditem;
	$('#'+idinput).val(valor);
}
function cambiopreciomat(iditem){
	var preciomatinput = 'precioMATinput'+iditem;
	var valormat = $('#'+preciomatinput).val();
	var idinputmat = 'premateint'+iditem;
	$('#'+idinputmat).val(valormat);
}


