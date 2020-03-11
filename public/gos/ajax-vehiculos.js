$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
		// get de listado o index tomado del controller para el
		// Objeto DataTable
	$('#vehiculos-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-vehiculos',
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

	$("#gos_vehiculo_marca_id").on('change',function(){
		var id = $(this).val();
		$('#gos_vehiculo_modelo_id').empty();
		$.ajax({
			url : app_url+'/gestion-vehiculos-modelo/'+id,
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
	$('#nuevo-vehiculo').click(function() {
		$('#gos_vehiculo_id').val('');
		$('#vehiculo-form').trigger('reset');
		$('#title-Modalvehiculo').html('Nuevo Vehiculo');
		$('#modal-vehiculo').modal('show');
		$("#gos_cliente_id").selectpicker("refresh");
		$("#gos_vehiculo_marca_id").selectpicker("refresh");
		$("#gos_vehiculo_modelo_id").selectpicker("refresh");
		$("#color_vehiculo").selectpicker("refresh");
		$("#tipo_combustible").selectpicker("refresh");
		$("#vehiculo_cilindros").selectpicker("refresh");
		$("#nro_puertas").selectpicker("refresh");
		$("#color_interior").selectpicker("refresh");

	});

	/* GUARDAR */
	$('#btn-guardar-vehiculo').click(function() {
		var actionType = $('#btn-guardar-vehiculo').val();
		var regex_numeros = /^([0-9])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9 ])*$/;
		var regex_letras = /^[A-Za-zÀ-ÖØ-öø-ÿ.!#$%&'*+/=?^_ ]*$/;
		var $errores = 0

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
		if($('#placa').val().trim() == '' ){
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
		if($('#gos_cliente_id').val() == 0 ){
			$('.gos_cliente_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_cliente_id').text('');
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
		$('#btn-guardar-vehiculo').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#vehiculo-form').serialize(),
				url : app_url+'/gestion-vehiculos',
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
					$('#vehiculos-DataTable').DataTable().ajax.reload();
					$('#vehiculo-form').trigger('reset');
					$('#modal-vehiculo').modal('hide');
					$('#btn-guardar-vehiculo').html('Guardar');

					$('.placa').text('');
					$('.gos_cliente_id').text('');
					$('.color_vehiculo').text('');
					$('.gos_vehiculo_marca_id').text('');
					$('.gos_vehiculo_modelo_id').text('');
					$('.nro_serie').text('');
					$('.anio_vehiculo').text('');

				}
		});
	}
	/* EDITAR */
	$('body').on('click', '.btn-editar-vehiculo', function () {
		var id = $(this).data('id');
		$.get('gestion-vehiculos/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#title-Modalvehiculo').html('Editar Vehiculo');
			$('#modal-vehiculo').modal('show');
			//
			$('#gos_vehiculo_id').val(data.gos_vehiculo_id); // NO ES SELECT, ES UN CAMPO OCULTO
			$('#gos_cliente_id').val(data.gos_cliente_id); // SELECT
			$('#gos_cliente_id').change();
			$('#gos_vehiculo_marca_id').val(data.gos_vehiculo_marca_id); // SELECT
			$('#gos_vehiculo_marca_id').change();
			$('#gos_modelo').val(data.gos_vehiculo_modelo_id); // SELECT
			$('#anio_vehiculo').val(data.anio_vehiculo);
			$('#color_vehiculo').val(data.color_vehiculo); // SELECT
			$('#color_vehiculo').change();
			$('#placa').val(data.placa);
			$('#economico').val(data.economico);
			$('#nro_serie').val(data.nro_serie);
			$('#tipo_combustible').val(data.tipo_combustible); //SELECT
			$('#tipo_combustible').change();
			$('#vehiculo_cilindros').val(data.vehiculo_cilindros); //SELECT
			$('#vehiculo_cilindros').change();
			$('#cilindraje').val(data.cilindraje);
			$('#nro_motor').val(data.nro_motor);
			$('#observaciones').val(data.observaciones);
			$('#anexo').val(data.anexo);
			$('#nro_puertas').val(data.nro_puertas); //SELECT
			$('#nro_puertas').change();
			$('#pasajeros').val(data.pasajeros);
			$('#color_interior').val(data.color_interior); //SELECT
			$('#color_interior').change();
			$('#procedencia').val(data.procedencia);
			$('#aduana').val(data.aduana);
			$('#fecha_importacion').val(data.fecha_importacion);

		})

        setTimeout(function(){     
			var value = $("#gos_modelo").val();
			$('#gos_vehiculo_modelo_id').val(value); // SELECT
			$('#gos_vehiculo_modelo_id').change(); 
		}, 2000);
	});

	/* BORRAR */
	$('body').on('click','#borrar-vehiculo',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('Esta seguro que desea borrar?')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-vehiculos/'+ id,
				success : function(data) {
					$('#vehiculos-DataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});

});
