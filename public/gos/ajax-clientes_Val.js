$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	// get de listado o index tomado del controller para el
	// Objeto DataTable
 $('#dt-clientes').DataTable({
	dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
	responsive : true,
	processing : true,
	ajax : app_url+'/gestion-clientes',
	columns : [ { data : 'gos_cliente_id', name : 'id','visible' : false },
				{ data : 'nomb_cliente'},
				{ data : 'empresa'},
				{ data : 'cant_autos' , render: function(data,row,meta){
					var id = meta.gos_cliente_id;
					return '<button class="col-2 btn btn-primary  btn-sm" id="btnVehiculos" data-id="'+id+'">'+data+'</button>';
				}},
				{ data : 'cant_os',render: function(data,row, meta){
					var id = meta.gos_cliente_id;
					return '<button class="col-2 btn btn-primary  btn-sm" style="" id="btnOs" data-id="'+id+'">'+data+'</button>';
				}},
				{ data : 'Opciones', name : 'Opciones', orderable : false} ],
	order : [ [ 0, 'desc' ] ],
	language : {url : '/gos/Spanish.json'}
});

$('body').on('click', '#btnVehiculos', function () {
	var id =  $(this).data('id');

	$("#gos_cliente_vehiculo_id").val(id);
	$('#modal-vehiculos-clientes').modal('show');
	var tabla = $('#vehiculos-DataTable').DataTable();
	tabla.clear().destroy();
	$('#vehiculos-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-vehiculos-clientes/'+id,
		columns : [ { data : 'gos_vehiculo_id',
					  name : 'id','visible' : false },
					{ data : 'nombre_cliente'},
					{ data: 'vehiculo', render: function(data, type, row){
						data.split('|').join( '<br>');
						var color = data.split('|');
						var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
						return '<div class="row"><div class="form-row col-12 col-md-2">'+checkbox+'</div>'+''+'<div class="form-row col-12 col-md-10">'+color[1]+'<br>'+color[2]+'<br>'+ color[3]+'</div></div>'}
					},
					{ data : 'nro_serie'},
					{ data : 'Opciones',
					  name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

});
$('body').on('click', '#btnOs', function () {
	var id =  $(this).data('id');
	$("#gos_cliente_os_id").val(id);
	$('#modal-os-clientes').modal('show');
	var tabla = $('#dt-ordenes-servicios').DataTable();
	tabla.clear().destroy();
	$('#dt-ordenes-servicios').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/osg-clientes-os/'+id,
		columns : [	{data : 'nro_orden_interno',name : 'id', render: function(data, type, meta){
					id = meta.gos_os_id;						
					return '<a href='+app_url+'/orden-servicio-generada/'+ id +'> # '+data+'</a>';
					}}, // #ORDEN
					{data : 'fecha_creacion', render: function(data, type, row){						
						return data.split('|').join( '<br>');
					}}, // FECHA
					{data : 'dias'}, // DIAS
					{data : 'nomb_cliente', render: function(data, type, row){						
						return data.split('|').join( '<br>');
					}
					}, // CLIENTE
					{data : 'nomb_aseguradora', render: function(data, type, row){
						var splited = data.split('|');						
						// return data.split('|').join( '<br>');
						return splited[0]
						+'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
						+'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>'
						+'<br>'+splited[5]+'<strong style="color:#27395C; font-weight: 500;">'+splited[6]+'</strong>'
						+'<br>'+splited[7]+'<strong style="color:#27395C; font-weight: 500;">'+splited[8]+'</strong>'
						+'<br>'+splited[9]+'<strong style="color:#27395C; font-weight: 500;">'+splited[10]+'</strong>'
						+'<br>'+splited[11]+'<strong style="color:#27395C; font-weight: 500;">'+splited[12]+'</strong>'
						+'<br>'+splited[13]+'<strong style="color:#27395C; font-weight: 500;">'+splited[14]+'</strong>'
						+'<br>'+splited[15]+'<strong style="color:#27395C; font-weight: 500;">'+splited[16]+'</strong>'
						+'<br>'+splited[17]+'<strong style="color:#27395C; font-weight: 500;">'+splited[18]+'</strong>'
						+'<br>'+splited[19]+'<strong style="color:#27395C; font-weight: 500;">'+splited[20]+'</strong>'
						;

					}
					},// ASEGURADORA
					{ data: 'detallesVehiculo', render: function(data, type, row){
						data.split('|').join( '<br>');
						var color = data.split('|');
						var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
						return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
					},
					{data : 'tiempo'}, // TIEMPO
					{data : 'asesor'}, // ASESOR
					{data : 'total'}, // TOTAL
					{data : 'avance'}, // AVANCE
					{data : 'Opciones',name : 'Opciones',orderable : false}
				],
				order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});
});
$("#gos_fac_region_estado_id").on('change',function(){
	var id = $(this).val();
	$('#gos_fac_region_ciudad_id').empty();
	$.ajax({
		url : app_url+'/gestion-clientes-ciudad/'+id,
		type: 'get',
		dataType: 'json',
		success: function(response){

		  var len = 0;
		  if(response['data'] != null){
			len = response['data'].length;
		  }
		  if(len > 0){
			var optionBlank = '<option></option>';
			$("#gos_fac_region_ciudad_id").append(optionBlank); 
			// Read data and create <option >
			for(var i=0; i<len; i++){

				var id = response['data'][i].gos_region_ciudad_id;
				var name = response['data'][i].nomb_ciudad;

				var option = "<option value='"+id+"'>"+name+"</option>"; 
				$("#gos_fac_region_ciudad_id").append(option); 
				$("#gos_fac_region_ciudad_id").selectpicker("refresh");
			}
		  }

		}
	});
});
$("#gos_region_estado_id").on('change',function(){
	var id = $(this).val();
	$('#gos_region_ciudad_id').empty();
	$.ajax({
		url : app_url+'/gestion-clientes-ciudad/'+id,
		type: 'get',
		dataType: 'json',
		success: function(response){

		  var len = 0;
		  if(response['data'] != null){
			len = response['data'].length;
		  }
		  if(len > 0){
			var optionBlank = '<option></option>';
			$("#gos_region_ciudad_id").append(optionBlank); 
			// Read data and create <option >
			for(var i=0; i<len; i++){

				var id = response['data'][i].gos_region_ciudad_id;
				var name = response['data'][i].nomb_ciudad;

				var option = "<option value='"+id+"'>"+name+"</option>"; 
				$("#gos_region_ciudad_id").append(option); 
				$("#gos_region_ciudad_id").selectpicker("refresh");
			}
		  }

		}
	});
});
// CLIENTE
	$('#crear-cliente').click(function() {
		limpiartextCliente();
		$('#email_cliente').prop('disabled', true);
		$('#clienteForm').trigger('reset');
		$('#gos_cliente_id').val('');
		$('#dias_credito_Check').removeAttr('checked');
		$('#monto_maximo_credito_Check').removeAttr('checked');
		$('#nro_cta_cliente_Check').removeAttr('checked');
		$('#collapseOne').removeClass('show');
		$('#masDatoscliente').removeClass('show');
		$('.linkModalCliente1').addClass('active');
		if ($('.linkModalCliente2').hasClass('active')){$('.linkModalCliente2').removeClass('active');}
		if ($('.linkModalCliente3').hasClass('active')){$('.linkModalCliente3').removeClass('active');}
		$('#clienteForm').trigger('reset');
		$('#titleModalCliente').html('Nuevo cliente');
		$('#modalCliente').modal('show');
		$("#gos_fac_tipo_persona_id").selectpicker("refresh");
		$("#gos_region_ciudad_id").selectpicker("refresh");
		$("#gos_region_estado_id").selectpicker("refresh");
		$("#gos_fac_region_ciudad_id").selectpicker("refresh");
		$("#gos_fac_region_estado_id").selectpicker("refresh");
		$('#monto_maximo_credito_Check').removeAttr('checked');
		$('#nro_cta_cliente_Check').removeAttr('checked');
		$('#dias_credito_Check').removeAttr('checked');

		$('#dias_credito').prop('disabled', true);
		$('#nro_cta_cliente').prop('disabled', true);
		$('#monto_maximo_credito').prop('disabled', true);

			
		
	});
/* GUARDAR CLIENTE */
	// var elFormulario = document.querySelector('#clienteForm');
	// console.log(elFormulario.elements);
	$('#btn-guardar-cliente').click(function(event){
		limpiartextCliente();
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

		if(!regex_numeros.test($('#telefono_fijo').val()) || ($('#telefono_fijo').val().length != 10 && $('#telefono_fijo').val().length > 0)){
			$('.telefono_fijo').text('Campo numerico y de largo 10');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.telefono_fijo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if( !regex_alfanumerico.test($('#calle_nro').val())){
			$('.calle_nro').text('Campo alfanumerico');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.calle_nro').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_numeros.test($('#codigo_postal').val()) ){
			$('.codigo_postal').text('Campo numerico');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.codigo_postal').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#datosFacturacion').hasClass('active') /*|| $('#clienteconfiguracion').hasClass('active')*/){

			if($('#gos_fac_tipo_persona_id').val()==0){
				$('.gos_fac_tipo_persona_id').text('Campo obligatorio');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.gos_fac_tipo_persona_id').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}
	
			if($('#razon_social').val().trim() == '' || !regex_alfanumerico.test($('#razon_social').val())){
				if($('#razon_social').val().trim() == ''){
					$('.razon_social').text('Campo obligatorio');
				}else{
					$('.razon_social').text('');
					$('.razon_social').text('Campo alfanumerico');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.razon_social').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#rfc').val().trim() == '' || !regex_alfanumerico.test($('#rfc').val())){
				if($('#rfc').val().trim() == ''){
					$('.rfc').text('Campo obligatorio');
				}else{
					$('.rfc').text('');
					$('.rfc').text('Campo alfanumerico');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.rfc').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#email_factura').val().trim() == '' || !regex_mail.test($('#email_factura').val())){
				if($('#email_factura').val().trim() == ''){
					$('.email_factura').text('Campo obligatorio');
				}else{
					$('.email_factura').text('');
					$('.email_factura').text('Formato email no valido');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.email_factura').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#calle_nro_fac').val().trim() == '' || !regex_alfanumerico.test($('#calle_nro_fac').val())){
				if($('#calle_nro_fac').val().trim() == ''){
					$('.calle_nro_fac').text('Campo obligatorio');
				}else{
					$('.calle_nro_fac').text('');
					$('.calle_nro_fac').text('Campo alfanumerico');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.calle_nro_fac').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#nro_exterior_fac').val().trim() == '' || !regex_alfanumerico.test($('#nro_exterior_fac').val())){
				if($('#nro_exterior_fac').val().trim() == ''){
					$('.nro_exterior_fac').text('Campo obligatorio');
				}else{
					$('.nro_exterior_fac').text('');
					$('.nro_exterior_fac').text('Campo numerico');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.nro_exterior_fac').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#cp_fac').val().trim() == '' || !regex_numeros.test($('#cp_fac').val())){
				if($('#cp_fac').val().trim() == ''){
					$('.cp_fac').text('Campo obligatorio');
				}else{
					$('.cp_fac').text('');
					$('.cp_fac').text('Campo numerico');
				}
				$errores++;
			} else {
				$(this).focus(function(){
					$('.cp_fac').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

	
			
			if($('#gos_fac_region_estado_id').val()==0){
				$('.gos_fac_region_estado_id').text('Campo obligatorio');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.gos_fac_region_estado_id').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}

			if($('#gos_fac_region_ciudad_id').val()==0){
				$('.gos_fac_region_ciudad_id').text('Campo obligatorio');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.gos_fac_region_ciudad_id').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}
			if($('#cliente_fac_municipio').val()==''){
				$('.cliente_fac_municipio').text('Campo obligatorio');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.cliente_fac_municipio').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}
			if($('#cliente_fac_localidad').val()==''){
				$('.cliente_fac_localidad').text('Campo obligatorio');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.cliente_fac_localidad').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}
			if(!regex_alfanumerico.test($('#nro_interior_fac').val())){
				$('.nro_interior_fac').text('Campo numerico');
				$errores++;
			} else {
				$(this).focus(function(){
					$('.nro_interior_fac').text('');
					if($errores > 0){
						$errores-1;
					}
				});
			}
		}

	

		if($errores != 0){
			event.preventDefault();
		} else {
			guardarCliente();
		}
	});

	//FUNCION GUARDAR
	function guardarCliente(){
		$('#btn-guardar-cliente').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data: $('#clienteForm').serialize(),
				url : app_url+'/gestion-clientes',
				type : 'POST',
				// dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,textStatus,data) {
					$('#btn-guardar-cliente').html('Guardar');
					//
					printErrorMsg(textStatus);
					//
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ textStatus);
						}
				},

				success : function(data) {
					// console.log(data);
					limpiartextCliente();
					$('#dt-clientes').DataTable().ajax.reload();
					$('#clienteForm').trigger('reset');
					$('#modalCliente').modal('hide');
					$('#btn-guardar-cliente').html('Guardar');
				}
		});
}
//imprimir error
	function printErrorMsg (msg) {
        $('#alert1').find("ul").html('');
        $('#alert1').css('display','block');
        $.each( msg, function( key, value ) {
            $('#alert1').find("ul").append('<li>'+value+'</li>');
        });
    }

	/* EDITAR Cliente */
	$('body').on('click', '.btn-editar-cliente', function () {
		var id = $(this).data('id');
		limpiartextCliente();
		$('#email_cliente').prop('disabled', true);
		$('#clienteForm').trigger('reset');
		$('#collapseOne').removeClass('show');
		$('#masDatoscliente').removeClass('show');
		$.get(app_url+'/gestion-clientes/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#titleModalCliente').html('Editar Cliente');
			$('.linkModalCliente1').addClass('active');
			if ($('.linkModalCliente2').hasClass('active')){$('.linkModalCliente2').removeClass('active');}
			if ($('.linkModalCliente3').hasClass('active')){$('.linkModalCliente3').removeClass('active');}
			$('#modalCliente').modal('show');
		    //datos del cliente
			$('#gos_cliente_id').val(data.gos_cliente_id);
			$('#nombre').val(data.nombre);
			$('#apellidos').val(data.apellidos);
			$('#empresa').val(data.empresa);
			$('#email_cliente').val(data.email_cliente);
			if(data.email_cliente != null){
				$('#email_cliente_Check').attr('checked');
				$('#email_cliente').prop('disabled', false);
			}
			$('#celular').val(data.celular);
			$('#telefono_fijo').val(data.telefono_fijo);
			$('#telefono_fijo').val(data.telefono_fijo);
			$('#calle_nro').val(data.calle_nro);
			$('#codigo_postal').val(data.codigo_postal);
			$('#gos_region_estado_id').val(data.gos_region_estado_id); // SELECT
			$('#gos_region_estado_id').change();
			$('#gos_region_ciudad').val(data.gos_region_ciudad_id); // SELECT
			$('#gos_fac_region_ciudad').val(data.gos_fac_region_ciudad_id); // SELECT
			$('#gos_region_ciudad_id').val(data.gos_region_ciudad_id); // SELECT
			$('#gos_region_ciudad_id').change();


			$('#cliente_municipio').val(data.cliente_municipio);
			$('#cliente_localidad').val(data.cliente_localidad);
			//datos de facturacion
			var idselect=document.getElementById("bs-select-3");
			$(idselect).val(data.gos_fac_tipo_persona_id); // SELECT
			$(idselect).change();
			$('#razon_social').val(data.razon_social);
			$('#rfc').val(data.rfc);
			$('#email_factura').val(data.email_factura);
			$('#calle_nro_fac').val(data.calle_nro_fac);
			$('#nro_exterior_fac').val(data.nro_exterior_fac);
			$('#nro_interior_fac').val(data.nro_interior_fac);
			$('#cp_fac').val(data.cp_fac);
			$('#indicaciones').val(data.indicaciones); //TEXTAREA
			$('#cliente_fac_municipio').val(data.cliente_fac_municipio);// SELECT
			$('#cliente_fac_localidad').val(data.cliente_fac_localidad); // SELECT
			$('#gos_fac_region_estado_id').val(data.gos_fac_region_estado_id); // SELECT
			$('#gos_fac_region_estado_id').change();
		    //condiciones e credito
			$('#dias_credito').val(data.dias_credito);
			$('#monto_maximo_credito').val(data.monto_maximo_credito);
			$('#nro_cta_cliente').val(data.nro_cta_cliente);
			if(data.dias_credito == null){
				$('#dias_credito_Check').removeAttr('checked');
				$('#dias_credito').prop('disabled', true);
			}
			else {
				$('#dias_credito_Check').attr('checked','checked');
				$('#dias_credito').removeAttr('disabled');
			}

			if(data.monto_maximo_credito == null){
				$('#monto_maximo_credito_Check').removeAttr('checked');
				$('#monto_maximo_credito').prop('disabled', true);
			}
			else {
				$('#monto_maximo_credito_Check').attr('checked','checked');
				$('#monto_maximo_credito').removeAttr('disabled');
			}
			if(data.nro_cta_cliente == null){
				$('#nro_cta_cliente_Check').removeAttr('checked');
				$('#nro_cta_cliente').prop('disabled', true);
			}
			else {
				$('#nro_cta_cliente_Check').attr('checked','checked');
				$('#nro_cta_cliente').removeAttr('disabled');
			}
		});

		setTimeout(function(){     
			
			
			var fac_ciudad = $('#gos_fac_region_ciudad').val(); 
			var ciudad = $('#gos_region_ciudad').val(); 
			$('#gos_fac_region_ciudad_id').val(fac_ciudad); 
			$('#gos_fac_region_ciudad_id').change(); 
			$('#gos_region_ciudad_id').val(ciudad); 
			$('#gos_region_ciudad_id').change(); 
		}, 4000);
	});

	/* BORRAR CLIENTE */
	$('body').on('click','#borrar-cliente',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar?!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-clientes/'+ id,
				success : function(data) {
					$('#dt-clientes').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});

	function limpiartextCliente(){
		
		$('.nombre').text('');
		$('.apellidos').text('');
		$('.empresa').text('');
		$('.email_cliente').text('');
		$('.celular').text('');
		$('.telefono_fijo').text('');
		$('.calle_nro').text('');
		$('.codigo_postal').text('');
		$('.gos_fac_tipo_persona_id').text('');
		$('.razon_social').text('');
		$('.rfc').text('');
		$('.email_factura').text('');
		$('.calle_nro_fac').text('');
		$('.nro_exterior_fac').text('');
		$('.nro_interior_fac').text('');
		$('.cp_fac').text('');
		$('.gos_fac_region_ciudad_id').text('');
		$('.gos_fac_region_estado_id').text('');
	}		
});
