$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#Marcas-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/vehiculos-marcas',
		columns : [ { data : 'gos_vehiculo_marca_id',
					  name : 'id','visible' : false },
					{ data : 'marca_vehiculo'},
					{ data : 'Opciones',
					  name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
    });

	// BTN marca
	$('#nuevaMarcaVehiculo').click(function() {
		$('#gos_vehiculo_marca_id').val('');
		$('#marcaVehiculoForm').trigger("reset");
		$('#titleModalMarcaVehiculo').html("Nueva Marca");
		$('#modalMarcaVehiculo').modal('show');
	});

	/* GUARDAR marca */
	$('#btnGuardarMarcaVehiculo').click(function() {
		var $errores = 0
		if($('#marca_vehiculo').val() == '' ){
			$('.marca_vehiculo').text('Campo obligatorio');
			$errores++;
			} else {
			$(this).focus(function(){
				$('.marca_vehiculo').text('');
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

		var actionType = $('#btnGuardarMarcaVehiculo').val();
		$('#btnGuardarMarcaVehiculo').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
				data:  $("#marcaVehiculoForm").serialize(),
					url : app_url+"/vehiculos-marcas",
					type : "POST",
					// dataType : "json",
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						$('#btnGuardarMarcaVehiculo').html('Guardar');
						if (console && console.log) {
							console.log("La solicitud a fallado: "+ textStatus);
							console.log("La solicitud a fallado: "+ errorThrown);
							}
						},
				success : function(data) {
					$('#Marcas-DataTable').DataTable().ajax.reload();
					$('#marcaVehiculoForm').trigger("reset");
					$('#modalMarcaVehiculo').modal('hide');
					$('#btnGuardarMarcaVehiculo').html('Guardar');
					}
		});
	}
	/* EDITAR Marca */
	$('body').on('click', '.btnEditarMarcaVehiculo', function () {
		var id = $(this).data('id');
	$.get(app_url+'/vehiculos-marcas/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#modalMarcaVehiculo').modal('show');
			// $('#titleModalMarcaVehiculo').html("Editar Marca");
			$('#gos_vehiculo_marca_id').val(data.gos_vehiculo_marca_id);
			$('#marca_vehiculo').val(data.marca_vehiculo);
		});
	});

	/* BORRAR marca */
	$('body').on('click','#borrarMarcaVehiculo',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar?")) {
			$.ajax({
				type : "DELETE",
				url : app_url+'/vehiculos-marcas/'+ id,
				success : function(data) {
					$('#Marcas-DataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


});
