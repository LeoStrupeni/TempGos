$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#UnidadMedida-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/unidadesMedidas-productos',
		columns : [ { data : 'gos_producto_medida_id',
					  name : 'id','visible' : false },
					{ data : 'nomb_medida'},
					{ data : 'nomen'},
					{ data : 'Opciones',
					  name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
	});

	// BTN familia
	$('#nuevaUnidadMedida').click(function() {
		$('#gos_producto_medida_id').val('');
		$('#unidad-medida-form').trigger("reset");
		$('#titleModalUnidadMedida').html("Nueva unidad medida");
		$('#modalUnidadMedida').modal('show');
	});

	/* GUARDAR familia */
	$('#btnGuardarUnidadMedida').click(function() {
		var actionType = $('#btnGuardarUnidadMedida').val();
		$('#btnGuardarUnidadMedida').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
				data:  $("#unidad-medida-form").serialize(),
					url : app_url+"/unidadesMedidas-productos",
					type : "POST",
					// dataType : "json",
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						$('#btnGuardarUnidadMedida').html('Guardar');
						if (console && console.log) {
							console.log("La solicitud a fallado: "+ textStatus);
							console.log("La solicitud a fallado: "+ errorThrown);
							}
						},
				success : function(data) {
					$('#UnidadMedida-DataTable').DataTable().ajax.reload();
					$('#unidad-medida-form').trigger("reset");
					$('#modalUnidadMedida').modal('hide');
					$('#btnGuardarUnidadMedida').html('Guardar');
					}
		});
	});

	/* EDITAR Familia */
	$('body').on('click', '.btn-editar-unidad-medida', function () {
		var id = $(this).data('id');
	$.get(app_url+'/unidadesMedidas-productos/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#modalUnidadMedida').modal('show');
			$('#titleModalUnidadMedida').html("Editar unidad medida");
			$('#nomb_medida').val(data.nomb_medida);
			$('#nomen').val(data.nomen);
		});
$('#UnidadMedida-DataTable').DataTable().ajax.reload();
	});

	/* BORRAR marca */
	$('body').on('click','#borrar-unidad-medida',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar?")) {
			$.ajax({
				type : "DELETE",
				url : app_url+'/unidadesMedidas-productos/'+ id,
				success : function(data) {
					$('#UnidadMedida-DataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
		$('#UnidadMedida-DataTable').DataTable().ajax.reload();
	});

});
