$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  //   get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#ModelosVehiculosDataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/vehiculos-modelos',
		columns : [ { data : 'gos_vehiculo_modelo_id', name : 'id','visible' : false },
					{ data : 'modelo_vehiculo'},
					{ data : 'marca_vehiculo'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : "/gos/Spanish.json"}
    });

	// BTN Modelo
	$('#NuevoModeloVehiculo').click(function() {
		$('#gos_vehiculo_modelo_id').val('');
		$('#ModeloVehiculoform').trigger("reset");
		$('#titleModalModeloVehiculo').html("Nuevo Modelo");
		$('#modalModeloVehiculo').modal('show');
	});

	/* GUARDAR modelo */
	$('#btnGuardarModeloVehiculo').click(function() {
		var $errores = 0
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
		if($('#modelo_vehiculo').val() == '' ){
			$('.modelo_vehiculo').text('Campo obligatorio');
			$errores++;
			} else {
			$(this).focus(function(){
				$('.modelo_vehiculo').text('');
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
		var actionType = $('#btnGuardarModeloVehiculo').val();
		console.log($('#ModeloVehiculoform').serializeArray())
		$('#btnGuardarModeloVehiculo').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
				data:  $("#ModeloVehiculoform").serialize(),
					url : app_url+'/vehiculos-modelos',
					type : "POST",
					// dataType : "json",
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						$('#btnGuardarModeloVehiculo').html('Guardar');
						if (console && console.log) {
							console.log("La solicitud a fallado: "+ textStatus);
							console.log("La solicitud a fallado: "+ errorThrown);
							}
						},
				success : function(data) {
					$('#ModelosVehiculosDataTable').DataTable().ajax.reload();
					$('#ModeloVehiculoform').trigger("reset");
					$('#modalModeloVehiculo').modal('hide');
					$('#btnGuardarModeloVehiculo').html('Guardar');
					}
		});
	}
	/* EDITAR Modelo */
	$('body').on('click', '.btnEditarModeloVehiculo', function () {
		var id = $(this).data('id');
		$.get(app_url+'/vehiculos-modelos/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			// $('#titleModalModeloVehiculo').html("Editar Modelo");
			$('#modalModeloVehiculo').modal('show');

			$('#gos_vehiculo_modelo_id').val(data.gos_vehiculo_modelo_id);
			$('#gos_vehiculo_marca_id').val(data.gos_vehiculo_marca_id);
			$('#gos_vehiculo_marca_id').change();
			$('#modelo_vehiculo').val(data.modelo_vehiculo);
		});
	});

	/* BORRAR Modelo */
	$('body').on('click','#borrarModeloVehiculo',function() {
		var id = $(this).data('id');
		console.log(id);
		console.log(app_url+'/vehiculos-modelos/'+ id);
		
		if (confirm("Esta seguro que desea borrar!!")) {
			$.ajax({
				type : "DELETE",
				url :app_url+'/vehiculos-modelos/'+ id,
				success : function(data) {
					$('#ModelosVehiculosDataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});
});
