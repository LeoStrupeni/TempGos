$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#dt-equipo-trabajo').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-equipo-trabajo',
		columns : [ { data : 'gos_usuario_id', name : 'id','visible' : false },	
					{ data : 'nomb_rol',className: "dt-center"},
					{ data : 'perfil',className: "dt-center"},
					{ data : 'fecha_contratacion',className: "dt-center"},
					{ data : 'nombre_apellidos'},
					{ data : 'nro_empleado',className: "dt-center"},
					{ data : 'nro_seguro_social',className: "dt-center"},
					{ data : 'email'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});

});