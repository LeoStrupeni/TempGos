$(document).ready(function() {
	var app_url = $('#app_url').attr('url');
	var gos_os_id =  document.getElementById('gos_os_id').value;
	var editor;
	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.get(app_url+'/osg-siguiente-etapa-f/'+gos_os_id, function(data){

			if(data == 0){
				$("#btnGuardarfinalizarEtapa").hide();

			}
			else{
				$("#btnGuardarfinalizarEtapa").show();
			}
			// console.log(data);
			$("#gos_etapa_id").selectpicker("refresh");
			//$('#dt-etapas-os').DataTable().ajax.reload();
			$('#modal-siguente-etapa').modal('hide');
			$('#btnGuardarSiguienteEtapa').html('Guardar');

	});
	$('#dt-etapas-os').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ordering: false,
        searching: false,
		paging: false,
		ajax : '/osg-muestra-lista-etapas/' + gos_os_id,
		columnDefs: [
			{ "width": "50px", "targets": 5 },
			{ "width": "50px", "targets": 7 }
        ],
        fixedColumns: true,
		columns : [ {data : 'gos_os_item_id',name : 'id','visible' : false},
			{data : 'nombre'},
			{data : 'orden_etapa','visible' : false},
			{data : 'descripcion'},
			{data : 'asesor'},
			{data : 'importe_solicitado', render: function(data){
				return '<div  style="text-align-last: center;" class="mr-3">'+data+'</div>';}
			},
			{data : 'precio_etapa', render: function(data){
				return '<div  style="text-align-last: center;" class="mr-3">'+data+'</div>';}
			},
			{data : 'precio_mo', render: function(data){
				return '<div  style="text-align-last: center;" class="mr-3">'+data+'</div>';}
			},
			{data : 'precio_materiales',name:'precio_materiales', render: function(data){
				return '<div  style="text-align-last: center;" class="mr-3">'+data+'</div>';}
			},
			{data : 'tiempo_meta_texto', render: function(data){
				return '<div  style="text-align-last: center;" class="mr-3">'+data+'</div>';}
			},
			{data : 'estado_etapa', render: function(data){
				if(data=="A"){
					return '<div  style="color: #5d78ff; -webkit-text-stroke-width: medium; font-size:1.25rem; text-align-last: center;">'+data+'</div>';

				}
				else if(data=="F"){
					return '<div  style="color: #32b89d; -webkit-text-stroke-width: medium; font-size:1.25rem; text-align-last: center;">'+data+'</div>';
				}
				else{
					return '<div  style="-webkit-text-stroke-width: medium; font-size:1.25rem; text-align-last: center;">'+data+'</div>';
				}
			}
			},

			{data : 'tiempo_meta_checkbox', render: function(data){
				data.split('|').join( '<br>');
				var color = data.split('|');
				if(color[2]=="A"){
					return '<div style="text-align-last: center;"><a data-toggle="modal" id="checka" data-target="#modal-siguente-etapa" data-id="'+color[1]+'" class="kt-nav__link">'+
					'<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">'+
					'<input type="checkbox"> <span ></span></label></a></div>';

				}
				else if(color[2]=="F"){
					return '<div style="text-align-last: center;"><a data-toggle="modal" id="checka" data-target="#modal-siguente-etapa" data-id="'+color[1]+'" class="kt-nav__link">'+
					'<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">'+
					'<input type="checkbox"  checked="checked" > <span ></span></label></a></div>';
				}
				else{
					return '<div style="text-align-last: center;"><a  class="kt-nav__link">'+
					'<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">'+
					'<input type="checkbox" disabled> <span border: 1px solid #ebedf2;></span></label></a></div>';
				}
			}
			},

			{data : 'Opciones',name : 'Opciones',orderable : false} ],
		order : [ [ 2, 'asc' ] ],
	language : {url : '/gos/Spanish.json'}

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
	$('#dt-etapas-os').on('click', 'tbody td', function(e) {
		if ($(this).index() < 7) {
			editor.bubble(this);
		}
	});


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
					console.log(data);
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
		$("#gos_os_item").val(id);
		$('#gos_mensaje_id').empty();
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
				console.log(data);
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
				console.log(data);
				if (data[0].pagodanios==1 || data[0].perdidatotal==1 ) {
					if (data[1].estado_etapa=="A") {
           $('#checkperdidapago').show();
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
	console.log(perdidapago);
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
					// console.log(data);

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
