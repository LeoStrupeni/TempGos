$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#dt-permisos-equipo-trabajo').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
        "iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-permisos-equipo-trabajo',
		columns : [ { data : 'gos_usuario_id', name : 'id','visible' : false },
					{ data : 'tipo_usuario'},
					{ data : 'descripcion',className: "dt-center"},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
    });

    // BTN
    $('#nuevoPermiso').click(function() {
        $('#PermisoForm').trigger('reset');
        $('#titleModalPermiso').html('Nuevo Permiso');
        $('#modalPermisos').modal('show');
    });

		/* EDITAR PERMISO USUARIO */
    $('body').on('click', '.btnEditarPermiso', function () {
        var id = $(this).data('id');
        $.get(app_url+'/gestion-permisos-equipo-trabajo/' + id +'/edit', function (data) {


        });
    });

    /* BORRAR PERMISO USUARIO */
    $('body').on('click','#borrarPermiso',function() {
        var id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : app_url+'/gestion-permisos-equipo-trabajo/'+ id,
                success : function(data) {
                    $('#dt-permisos-equipo-trabajo').DataTable().ajax.reload();
                },
                error : function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    function limpiartextPermisoUsuario() {

    }




});
