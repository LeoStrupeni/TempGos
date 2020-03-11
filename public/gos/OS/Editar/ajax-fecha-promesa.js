$(document).ready(function() {

	var app_url = $('#app_url').attr('url');
    $.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
    $("#btnGuardarFechaPromesa").click(function(){
       guardar();
    });

	$(function () {
		$('#datetimepicker1').datetimepicker();
	});

	function guardar(){
		$('#btnGuardarFechaPromesa').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#fecha-promesa-form').serialize(),
				url : app_url+'/osg-fecha-promesa',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarFechaPromesa').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
                    $('#fechaPromesa').val(data);
					$('#modal-fecha-promesa').modal('hide');
                    $('#btnGuardarFechaPromesa').html('Guardar');
                }
		});
	}
});
