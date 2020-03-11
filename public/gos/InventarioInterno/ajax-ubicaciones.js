$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-Ubicaciones').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/ubicaciones',
		columns : [ { data : 'gos_producto_ubicacion_id', name : 'id','visible' : false },
					{ data : 'nomb_ubicacion'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
    });

	// BTN marca
	$('#nuevaUbicacion').click(function() {
		$('.nomb_ubicacion').text('');
		$('#gos_producto_ubicacion_id').val('');
		$('#UbicacionForm').trigger("reset");
		$('#titleModalUbicacion').html("Nueva Ubicación");
		$('#ModalUbicacion').modal('show');
	});

	/* GUARDAR marca */
	$('#btnGuardarUbicacion').click(function() {
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
		var $errores = 0

		if($('#nomb_ubicacion').val().trim() == '' || !regex_alfanumerico.test($('#nomb_ubicacion').val())){
			if($('#nomb_ubicacion').val().trim() == ''){
				$('.nomb_ubicacion').text('Campo obligatorio');
			}else{
				$('.nomb_ubicacion').text('');
				$('.nomb_ubicacion').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_ubicacion').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			$('.nomb_ubicacion').text('');
			guardarUbicacionProducto();
		}

	});

	function guardarUbicacionProducto(){
		$('#btnGuardarUbicacion').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
				data:  $("#UbicacionForm").serialize(),
					url : app_url+"/ubicaciones",
					type : "POST",
					// dataType : "json",
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						$('#btnGuardarUbicacion').html('Guardar');
						if (console && console.log) {
							console.log("La solicitud a fallado: "+ textStatus);
							console.log("La solicitud a fallado: "+ errorThrown);
							}
						},
				success : function(data) {
					$('.nomb_ubicacion').text('');
					$('#dt-Ubicaciones').DataTable().ajax.reload();
					$('#UbicacionForm').trigger("reset");
					$('#ModalUbicacion').modal('hide');
					$('#btnGuardarUbicacion').html('Guardar');
					}
		});
	}

	/* EDITAR Marca */
	$('body').on('click', '.btn-editar-ubicacion', function () {
		var id = $(this).data('id');
	$.get(app_url+'/ubicaciones/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('.nomb_ubicacion').text('');
			$('#ModalUbicacion').modal('show');
			$('#titleModalUbicacion').html("Editar Ubicacion");
			$('#gos_producto_ubicacion_id').val(data.gos_producto_ubicacion_id);
			$('#nomb_ubicacion').val(data.nomb_ubicacion);
		});
	});

	/* BORRAR marca */
	$('body').on('click','#borrar-ubicacion',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar?")) {
			$.ajax({
				type : "DELETE",
				url : app_url+'/ubicaciones/'+ id,
				success : function(data) {
					$('#dt-Ubicaciones').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


});
