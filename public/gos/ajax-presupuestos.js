$(document).ready(function () {
	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

/**
 * LISTADO DE CLIENTES VEHICULOS
 */
/**
 $('#PresupuestosDataTable').DataTable({
	dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
	"<'row'<'col-sm-12'tr>>" +
	"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
	"iDisplayLength": 25,
   responsive : true,
   processing : true,
   ajax : window.location.href,     //agregar URL
   columns : [ { data : 'gos_pres_id',
           name : 'id','visible' : false },
         { data : 'fecha'},
				 { data : 'gos_pres_id'},
				 { data : 'gos_cliente_id', render: function(data, type, row){
					  data.split('|');
						 var cl = data.split('|');
						 return '<label>'+cl[0]+'</label>'+'<br><label>'+cl[1]+'</label>';
				 }
			 },
				 { data: 'gos_vehiculo_id', render: function(data, type, row){
					 data.split('|').join( '<br>');
					 var color = data.split('|');
					 var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
					 return '<div class="row"><div class="form-row col-12 col-md-2">'+checkbox+'</div>'+''+'<div class="form-row col-12 col-md-10">'+color[1]+'<br>'+color[2]+'<br>'+ color[3]+'</div></div>'}
				 },
				 { data : 'total'},
				 { data : 'gos_pres_os_id',render: function(data, type, row){
					           if(data!=0){var p ='<label>'+data+'<label>'}
										 if(data==null){var p="<label>NA<label>"}
					 return p
				 },'visible' : false  },
				 { data : 'gos_pres_id' ,render: function(data, type, meta){
					                 var status = meta.gos_pres_os_id;
                          var html='ND';
													if(status>0){html='<button type="button" data-toggle="tooltip" data-placement="top" title="Unir"  class="btn btn-primary btn-sm" onclick="Unirmodal('+data+')"><i class="fas fa-paste"></i></button>';}
													else{ html=  '<button style="margin-left: 2px;" type="button" data-toggle="tooltip" data-placement="top" title="Procesar"class="btn btn-primary btn-sm" onclick="Procesarmodal('+data+')"><i class="fas fa-cog"></i></button> ';}
					 return html;
				 }},
         { data : 'Opciones',
           name : 'Opciones', orderable : false} ],
   order : [ [ 0, 'desc' ] ],
   language : {"url" : '/gos/Spanish.json'}
   });
**/



$('#dt-OS-Presupuestos').DataTable({
 			dom : "<'row'<'col-sm-3 d-none'l><'col-sm-12'f>>" +
 			"<'row'<'col-sm-12'tr>>" +
			 "<'row'<'col-sm-8 col-md-6 d-none'i><'col-sm-8 col-md-6'p>>",
			 "iDisplayLength": 25,
 			responsive : true,
 			processing : true,
 			paging: false,
 			ordering: false,
 			ajax : '/ordenes-servicio',
 			columns : [	{data : 'gos_os_id',name : 'id', render: function(data, type, row){
 											return '<div> # '+data+'</div>';}
 									},
 									{data: 'detallesVehiculo', render: function(data, type, row){
 											data.split('|').join( '<br>');
 											var color = data.split('|');
 											var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
 											return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]}
 									},
 									{data : 'nomb_cliente', render: function(data, type, row){
 											return data.split('|').join( '<br>');}
 									},
 									{data : 'gos_os_id',render: function(data, type, row){
				 					 return '<button type="button" data-toggle="tooltip" data-placement="top" title="Unir"  class="btn btn-primary btn-sm" onclick="UnirPost('+data+')">Unir</button>'
				 				 }}
 							],
 							order : [ [ 0, 'desc' ] ],
 			language : {'url' : '/gos/Spanish.json'}
 });
	 // BTN presupuesto
	 $('#crear-nuevo-presupuesto').click(function() {
		window.location.href="/Presupuestos/Agregar";
	});

	$('#agregar-cliente').click(function() {

		$('#gos_pres_id').val('');
		$('#presupuesto-form').trigger("reset");
		$('#titleModalCliente').html('Nuevo cliente');
		$('#modalCliente').modal('show');
	});


				$('#dt-clientes-vehiculos').DataTable({
					dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
					"<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
					"iDisplayLength": 25,
					responsive: true,
					searchDelay: 500,
					processing: true,
					//ajax: '/lista-clientes-vehiculos',
					ajax: '/ListarPresupuestos/datatable/clientes',
					columns: [
					{data: 'gos_os_id'},
					{data: 'nomb_cliente',render: function(data, type, row){
						data.split('|').join( '<br>');
						var x = data.split('|');
						return x[0]+' '+x[1];
					}
				  },
					{data: 'detallesVehiculo',render: function(data, type, row){
							data.split('|').join( '<br>');
							var color = data.split('|');
							var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
							return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
						},
					{data: 'nomb_aseguradora_min',render: function(data, type, row){
						data.split('|').join( '<br>');
						var x = data.split('|');
						return x[0];
					}},
					{data: 'nro_poliza'},
					{data: 'nro_reporte'},
					{data: 'nro_siniestro'},
					{data: 'gos_vehiculo_id',"visible": false,"searchable": false},
					{data: 'gos_cliente_id',"visible": false,"searchable": false},
					{defaultContent:`<button class="btn btn-success btn-seleccionar btn-sm">Seleccionar</button>`}
					],
					language : {'url' : '/gos/Spanish.json'}
				});


			/**
			 * Evento clic donde tomar los datos
			 */
				$('#dt-clientes-vehiculos tbody').on('click', '.btn-seleccionar', function () {
					//
					var table = $('#dt-clientes-vehiculos').DataTable();
					var data = table.row( $(this).parents('tr') ).data();
					//
					var nomb_cliente=data['nomb_cliente'];
					var detallesVehiculo=data['detallesVehiculo'];
					var nro_poliza=data['nro_reporte'];
					var nro_siniestro=data['nro_siniestro'];

					// Actualizar datos;
					$("#nomb_cliente").val(nomb_cliente);
					//datos del vehiculo
					$("#detallesVehiculo").val(detallesVehiculo);
					$("#nro_poliza").val(nro_poliza);
					$("#nro_siniestro").val(nro_siniestro);
					//ids
					//Capturar valores ocultos
					//alert( "ID Cliente: "+data['gos_cliente_id']);
					//Pasar valores ocultos
					$("#gos_os_id").val(data['gos_os_id'])
					$("#gos_vehiculo_id").val(data['gos_vehiculo_id'])
					$("#gos_cliente_id").val(data['gos_cliente_id'])
					// cerrar modal
					$('#modalbuscarcliente').modal('hide');
				});


/**
 * Evento clic donde tomar los datos
 */
	$('#clientes_vehiculos_DataTable tbody').on('click', '.btn-seleccionar', function () {
		//
		var table = $('#clientes_vehiculos_DataTable').DataTable();
		var data = table.row( $(this).parents('tr') ).data();
		//
		var nomb_cliente=data['nomb_cliente'];
		var detallesVehiculo=data['vehiculo'];
		// Actualizar datos;
		$("#nomb_cliente").val(nomb_cliente);
		//datos del vehiculo
		$("#detallesVehiculo").val(detallesVehiculo)
		//ids
		//Capturar valores ocultos
		//alert( "ID Cliente: "+data['gos_cliente_id']);
		//Pasar valores ocultos

		$("#gos_vehiculo_id").val(data['gos_vehiculo_id'])
		$("#gos_cliente_id").val(data['gos_cliente_id'])
		// cerrar modal
		$('#modalbuscarcliente').modal('hide');
	});

	/**
	 * Funcion para cambio del boton "Buscar Cliente"
	 */
		$("#btn-buscarcliente").click(function(){
			$(this).attr("style","display:none;") ;
			$('#cls-buscarcliente').removeAttr("style");
		});

//FUNCION PARA GUARDAR Presupuesto





/* CIERRE PRESUPUESTOS ----------------------------------------------*/

	/** CODIGO PARA CAMBIO DE BOTON DESCUENTO DE PESOS A PORCIENTO **/
	$(".btnCambioPeso").click(function(){
		$(this).attr("style","display:none;");
		$('.btnCambioPorciento').removeAttr("style");
		$('#descuento_tipo').attr("value","PORCIENTO");
	});

	$(".btnCambioPorciento").click(function(){
		$(this).attr("style","display:none;");
		$('.btnCambioPeso').removeAttr("style");
		$('#descuento_tipo').attr("value","PESO");
	});

	/** CODIGO CARGAR DESCUENTO EN BASE DE DATOS **/
	$('#presupuesto-descuento').change(function(){
		var presupuesto_ID=document.getElementById("gos_pres_id");
		var valorid = presupuesto_ID.value;
		if (valorid==''){
			alert("Para cargar un descuento debe primero completar los datos de la Orden de Servicio!!!")
		}
		else {
			var datosForm=$('#formCierrePresupuesto').serializeArray();
			console.log(datosForm); // UNA VEZ QUE FUNCIONE BORRAR ESTA LINEA
			$.ajax({
			type:"POST",
			url:"/gestion-presupuestos",//DESCUENTO
			data: datosForm,
			success:function(r){
				if (r==1) {
				alert('agregado con exito');
				}
				else {
				alert('error en insertar datos');
				}
			}
			});
		return false;
		}
	});



	/** FUNCIONES PRECARGADAS EN EL ARCHIVO JS ---- REVISAR USO */
	$(function () {
		$("#importe, #descuento").keyup(function () {
			$("#subtotal").val(+$("#importe").val() - +$("#descuento").val());
		});
	});

	$(function () {
		$("#subtotal, #iva").keyup(function () {
			$("#total").val(+$("#subtotal").val() - (+$("#iva").val()/100)*(+$("#subtotal").val()));
		});
	});



	/* BTN GUARDAR ------------------------------------------*/
	$('#btn_guardar_presupuesto').click(function(){
		var datosForm1=$('#presupuesto_form').serializeArray();
		var datosForm6=$('#presupuesto_Cierre_form').serializeArray();
		datosForm1=datosForm1.concat(datosForm5);
		datosForm1=datosForm1.concat(datosForm6);
		$('#btn_guardar_presupuesto').html('Guardando...');
		$.ajax({
			data : datosForm1,
			url : "", //URL PARA GUARDAR INFORMACION GRAL DE LA OS
			type : "POST",
			dataType : 'json',
			success : function(data) {
				$('#modalGuardar').modal('hide');
				$('#btn_guardar_presupuesto').html('Guardar');
			},
			error : function(data) {
				alert('Error:',data);
				$('#btn_guardar_presupuesto').html('Guardar');
			}
		});
	});

	$('#modal-presupuesto').on('hidden', function () {

	});
//________________________________________________________________ALBERTO______________________________

$("#gos_vehiculo_marca_id").on('change',function(){
	var id = $(this).val();
		console.log(id);
	$('#gos_vehiculo_modelo_id').empty();
	$.ajax({
		url : '/gestion-vehiculos-modelo/'+id,

		type: 'get',
		dataType: 'json',
		success: function(response){

			var len = 0;
			if(response['data'] != null){
			len = response['data'].length;
			}
			if(len > 0){
			var optionBlank = '<option></option>';
			$("#gos_vehiculo_modelo_id").append(optionBlank);
			// Read data and create <option >
			for(var i=0; i<len; i++){

					var id = response['data'][i].gos_vehiculo_modelo_id;
				var name = response['data'][i].modelo_vehiculo;

					var option = "<option value='"+id+"'>"+name+"</option>";
				$("#gos_vehiculo_modelo_id").append(option);
				$("#gos_vehiculo_modelo_id").selectpicker("refresh");
			}
			}

		}
	});
});
$('#btn-guardar-cliente').click(function(event){
	var regex_mail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
	var regex_letras = /^[A-Za-zÀ-ÖØ-öø-ÿ.!#$%&'*+/=?^_ ?^`{|}~-]*$/;
	var regex_numeros = /^([0-9])*$/;
	var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;
	 var $errores = 0

	if($('#nombre').val().trim() == ''  || !regex_letras.test($('#nombre').val())){
		if($('#nombre').val().trim() == ''){
			$('.nombre').text('El campo es obligatorio');
		}else{
			$('.nombre').text('');
			$('.nombre').text('El campo acepta solo letras');
		}
		$errores++;
	} else {
		$('.nombre').text('');
		if($errores > 0){
			$errores-1;
		}
	}

	if($('#apellidos').val().trim() == ''   || !regex_letras.test($('#apellidos').val())){
		if($('#apellidos').val().trim() == ''){
			$('.apellidos').text('El campo es obligatorio');
		}else{
			$('.apellidos').text('');
			$('.apellidos').text('El campo acepta solo letras');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.apellidos').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if(!regex_mail.test($('#email_cliente').val()) && !$('#email_cliente').attr('disabled')){
		if($('#email_cliente').val().trim() == ''){
			$('.email_cliente').text('El campo es obligatorio');
		}else{
			$('.email_cliente').text('Formato email no valido');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.email_cliente').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}

	if($('#celular').val().trim() == '' || !regex_numeros.test($('#celular').val())  || $('#celular').val().length != 10){
		if($('#celular').val().trim() == ''){
			$('.celular').text('Campo obligatorio');
		}else{
			$('.celular').text('');
			$('.celular').text('Campo numerico y de largo 10');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.celular').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}

	if($('#anio_vehiculo').val().trim() == '' || !regex_numeros.test($('#anio_vehiculo').val())){
		if($('#anio_vehiculo').val().trim() == ''){
			$('.anio_vehiculo').text('Campo obligatorio');
		}else{
			$('.anio_vehiculo').text('');
			$('.anio_vehiculo').text('Campo numerico');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.anio_vehiculo').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($('#placa').val().trim() == '' || !regex_alfanumerico.test($('#placa').val())){
		if($('#placa').val().trim() == ''){
			$('.placa').text('Campo obligatorio');
		}else{
			$('.placa').text('');
			$('.placa').text('Campo alfanumerico');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.placa').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($('#color_vehiculo').val() == '' ){
			$('.color_vehiculo').text('Campo obligatorio');
		$errores++;
	} else {
		$(this).focus(function(){
			$('.color_vehiculo').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($('#gos_vehiculo_marca_id').val() == 0 ){
		$('.gos_vehiculo_marca_id').text('Campo obligatorio');
		$errores++;
	} else {
		$(this).focus(function(){
			$('.gos_vehiculo_marca_id').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($('#gos_vehiculo_modelo_id').val() == 0 ){
		$('.gos_vehiculo_modelo_id').text('Campo obligatorio');
		$errores++;
		} else {
		$(this).focus(function(){
			$('.gos_vehiculo_modelo_id').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($('#nro_serie').val().trim() == '' || !regex_alfanumerico.test($('#nro_serie').val())){
		if($('#nro_serie').val().trim() == ''){
			$('.nro_serie').text('Campo obligatorio');
		}else{
			$('.nro_serie').text('');
			$('.nro_serie').text('Campo alfanumerico');
		}
		$errores++;
	} else {
		$(this).focus(function(){
			$('.nro_serie').text('');
			if($errores > 0){
				$errores-1;
			}
		});
	}
	if($errores != 0){
		event.preventDefault();
	} else {
		guardar();
	}
	});

	function guardar(){
	$('#btn-guardar-cliente').html('Guardando...');
	cliente = $("#nombre").val();
	apellidos = $("#apellidos").val();
	marca = $( "#gos_vehiculo_marca_id option:selected" ).text();
	modelo = $( "#gos_vehiculo_modelo_id option:selected" ).text();
	placa = $('#placa').val();
	anio_vehiculo = $('#anio_vehiculo').val();
	concatenaVehiculo = marca + ' ' + modelo + ' ' + anio_vehiculo + ', P:' +placa;
	var nomb_cliente=cliente+' '+ apellidos;
	$("#nomb_cliente").val(nomb_cliente);
	$("#detallesVehiculo").val(concatenaVehiculo)
	$("#btn-buscarcliente").attr("style","display:none;") ;
	$('#cls-buscarcliente').removeAttr("style");
		 $.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#clienteForm').serialize(),
			url : '/os-clientes-vehiculo',
			type : 'POST',
			//dataType : 'json',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				$('#btn-guardar-vehiculo').html('Guardar');
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
					}
				},
			success : function(data) {
				$('#clienteForm').trigger('reset');
				$('#modalCliente').modal('hide');
				$('#btn-guardar-cliente').html('Guardar');
									$('.nombre').text('');
									$('.apellidos').text('');
									$('.email_cliente').text('');
				$('.celular').text('');
				$("#gos_vehiculo_id").val(data.gos_vehiculo_id);
				$("#gos_cliente_id").val(data.gos_cliente_id);
								$("#gos_vehiculo_marca_id").selectpicker("refresh");
									$("#gos_vehiculo_modelo_id").selectpicker("refresh");
									$("#color_vehiculo").selectpicker("refresh");
									$("#tipo_combustible").selectpicker("refresh");
									$("#vehiculo_cilindros").selectpicker("refresh");
									$("#nro_puertas").selectpicker("refresh");
									$("#color_interior").selectpicker("refresh");
				$('.placa').text('');
				$('.gos_cliente_id').text('');
				$('.color_vehiculo').text('');
				$('.gos_vehiculo_marca_id').text('');
				$('.gos_vehiculo_modelo_id').text('');
				$('.nro_serie').text('');
				$('.anio_vehiculo').text('');
									$('#dt-clientes-vehiculos').DataTable().ajax.reload();
			}
	});
}
});

var unir=0; var procesar=0;
function Unirmodal($idunir){
unir=$idunir;
$('#modal-presupuesto-unir').modal('show');
}
function  Procesarmodal($idprocesar){
procesar=$idprocesar;
$('#modal-presupuesto-procesar').modal('show');
}

 function UnirPost(){
			$.ajax({
						 type: 'get',
						 url: '/Presupuestos/'+unir+'/Unir/',
						 data: unir,
						 success: function(data) {
							 	  var res = data.split(":");
								alert(data);
							  window.open('/orden-servicio-generada/'+res[1], '_blank');
						 }
				 });
				   unir=0;
				   $("#modal-presupuesto-unir").modal('hide');
		  }

function ProcesarPost(){
	console.log(procesar);
	$.ajax({
			type: 'GET',
			url: '/Presupuestos/'+procesar+'/Procesar',
			success: function(data) {
			  var res = data.split(":");
			// console.log(res[1]);
			 alert(data);
			  window.open('/orden-servicio-generada/'+res[1], '_blank');
			}
	});
			procesar=0;
			$("#modal-presupuesto-procesar").modal('hide');

}
