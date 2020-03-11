$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-Familias').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/familias',
		columns : [ { data : 'gos_producto_familia_id', name : 'id','visible' : false },
					{ data : 'nomb_familia'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
    });

	// BTN familia
	$('#nuevaFamilia').click(function() {
		$('.nomb_familia').text('');
		$('#gos_producto_familia_id').val('');
		$('#familia-form').trigger("reset");
		$('#titleModalFamilia').html("Nueva Familia");
		$('#modalFamilia').modal('show');
	});

	/* GUARDAR familia */
	$('#btnGuardarFamilia').click(function() {
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
		var $errores = 0

		if($('#nomb_familia').val().trim() == '' || !regex_alfanumerico.test($('#nomb_familia').val())){
			if($('#nomb_familia').val().trim() == ''){
				$('.nomb_familia').text('Campo obligatorio');
			}else{
				$('.nomb_familia').text('');
				$('.nomb_familia').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_familia').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			guardarFamilia();
		}
	});

//FUNCION GUARDAR
	function guardarFamilia(){
		$('#btnGuardarFamilia').html('Guardando...');
		$.ajax({
			contenttype : "application/json; charset=utf-8",
			data:  $("#familia-form").serialize(),
			url : app_url+"/familias",
			type : "POST",
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				$('#btnGuardarFamilia').html('Guardar');
				if (console && console.log) {
					console.log("La solicitud a fallado: "+ textStatus);
					console.log("La solicitud a fallado: "+ errorThrown);
					}
			},
			success : function(data) {
				$('.nomb_familia').text('');
				$('#dt-Familias').DataTable().ajax.reload();
				$('#familia-form').trigger("reset");
				$('#modalFamilia').modal('hide');
				$('#btnGuardarFamilia').html('Guardar');
			}
		});	
	};

	/* EDITAR Familia */
	$('body').on('click', '.btn-editar-familia', function () {
		var id = $(this).data('id');
		$.get(app_url+'/familias/' + id +'/edit', function (data) {
			$('.nomb_familia').text('');
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#modalFamilia').modal('show');
			$('#titleModalFamilia').html("Editar Familia");
			$('#gos_producto_familia_id').val(data.gos_producto_familia_id);
			$('#nomb_familia').val(data.nomb_familia);
		});
	});

	/* BORRAR marca */
	$('body').on('click','#borrar-familia',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar?")) {
			$.ajax({
				type : "DELETE",
				url : app_url+'/familias/'+ id,
				success : function(data) {
					$('#dt-Familias').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


});
