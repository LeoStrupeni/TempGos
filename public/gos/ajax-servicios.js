$(document).ready(function() {

	var app_url = $('#app_url').attr('url');
	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr(
					'content')
		}
	});
// get de listado o index tomado del controller para el
// Objeto DataTable
	var table = $('#serviciosDataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive: true,
		rowReorder: { update: false },
		// ordering: false,
		processing : true,
		ajax : '/gestion-servicios',
		columns : [
			{data : 'gos_paq_servicio_id',name : 'id','visible' : true},
			{data : 'orden_servicio'},
			{data : 'nomb_servicio'},
			{data : 'descripcion'},
			{data : 'precio'},
			{data : 'Opciones',name : 'Opciones',orderable : false}
			],
		order : [ [ 1, 'asc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});
	table.on( 'row-reorder', function ( e, diff, edit ) {
		for(i = 0; i < diff.length; i++){
			id = diff[i].node.cells[0].innerText;
			newPos = diff[i].newPosition + 1;
			console.log(newPos);
			$.ajax({
				type : "GET",
				url : '/orden-servicio/'+id+'/'+newPos+'/',
				
			});
		}
		$('#serviciosDataTable').DataTable().ajax.reload();
	});
	// BTN NUEVO SERVICIO
	$('#nuevoServicio').click(function() {
		$('#gos_servicio_id').val('');
		$('#servicioForm').trigger('reset');
		$('#titleModalServicio').html('Nuevo servicio');
		$('#modalServicio').modal('show');
	});

	$('#btnGuardarServicio').click(function() {
		var actionType = $('#btnGuardarServicio').val();
		$('#btnGuardarServicio').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data : $('#servicioForm').serialize(),
				url : 'gestion-servicios',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,textStatus,data) {
					$('#btnGuardarServicio').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ textStatus);
						}
				},
				success : function(data) {
					$('#serviciosDataTable').DataTable().ajax.reload();
					$('#servicioForm').trigger('reset');
					$('#modalServicio').modal('hide');
					$('#btnGuardarServicio').html('Guardar');
				}
		});
	});

	// BTN EDITAR SERVICIO
	$('body').on('click', '.btnEditarServicio', function () {
		var id = $(this).data('id');
		$.get('gestion-servicios/' + id + '/edit',
			function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#titleModalServicio').html('Editar servicio');
			$('#modalServicio').modal('show');

			$('#gos_paq_servicio_id').val(data.gos_paq_servicio_id);
			$('#nomb_servicio').val(data.nomb_servicio);
			$('#descripcion').val(data.descripcion);
			$('#gos_usuario_tecnico_id').val(data.gos_usuario_tecnico_id); //SELECT USUARIOS TECNICOS
			$('#gos_usuario_tecnico_id').change();
			$('#precio').val(data.precio);
		})
	});

	/* BORRAR SERVICIO */
	$('body').on('click','#borrarServicio',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar?')) {
			$.ajax({
				type : 'DELETE',
				url : 'gestion-servicios/'+ id,
				success : function(data) {
					$('#serviciosDataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:',data);
				}
			});
		}
	});

});
