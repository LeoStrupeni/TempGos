$(document).ready(function() {

	var app_url = $('#app_url').attr('url');
    $.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
    $("#btnGuardarFechaingreso").click(function(){
        guardar();
    });



	function guardar(){
		$('#btnGuardarFechaingreso').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#fecha-ingreso-form').serialize(),
				url : app_url+'/osg-fecha-ingreso',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarFechaingreso').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
                    $('#fechaingreso').val(data);
					$('#modal-fecha-ingreso').modal('hide');
					$('#btnGuardarFechaingreso').html('Guardar');
					window.location.href="/ordenes-servicio";
                    // $('#dt-ordenes-servicios').DataTable().ajax.reload();
                }
		});
	}
});
