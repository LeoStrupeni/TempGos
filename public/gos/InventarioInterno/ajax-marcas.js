$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-Marcas-Producto').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/marcas-productos',
		columns : [ { data : 'gos_producto_marca_id', name : 'id','visible' : false },
					{ data : 'nomb_marca'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
    });

	// BTN marca
	$('#nuevaMarcaProducto').click(function() {
		$('#gos_producto_marca_id').val('');
		$('#marcaProductoForm').trigger("reset");
		$('#titleModalMarcaProducto').html("Nueva Marca");
		$('#modalMarcaProducto').modal('show');
	});

	/* GUARDAR marca */
	$('#btnGuardarMarcaProducto').click(function() {
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
		var $errores = 0

		if($('#nomb_marca').val().trim() == '' || !regex_alfanumerico.test($('#nomb_marca').val())){
			if($('#nomb_marca').val().trim() == ''){
				$('.nomb_marca').text('Campo obligatorio');
			}else{
				$('.nomb_marca').text('');
				$('.nomb_marca').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_marca').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			guardarMarcaProducto();
		}
	});


	function guardarMarcaProducto(){
		$('#btnGuardarMarcaProducto').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
				data:  $("#MarcaProductoForm").serialize(),
				url : app_url+"/marcas-productos",
				type : "POST",
				// dataType : "json",
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarMarcaProducto').html('Guardar');
					if (console && console.log) {
						console.log("La solicitud a fallado: "+ textStatus);
						console.log("La solicitud a fallado: "+ errorThrown);
						}
					},
				success : function(data) {
					$('#dt-Marcas-Producto').DataTable().ajax.reload();
					$('#MarcaProductoForm').trigger("reset");
					$('#modalMarcaProducto').modal('hide');
					$('#btnGuardarMarcaProducto').html('Guardar');
					$('.nomb_marca').text('');
				}
		});
	}

	/* EDITAR Marca */
	$('body').on('click', '.btn-editar-marca', function () {
		var id = $(this).data('id');
	$.get(app_url+'/marcas-productos/' + id +'/edit', function (data) {
			$('.nomb_marca').text('');
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#modalMarcaProducto').modal('show');
			// $('#titleModalMarcaProducto').html("Editar Marca");
			$('#gos_producto_marca_id').val(data.gos_producto_marca_id);
			$('#nomb_marca').val(data.nomb_marca);
		});
	});

	/* BORRAR marca */
	$('body').on('click','#borrar-marca-producto',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar?")) {
			$.ajax({
				type : "DELETE",
				url : app_url+'/marcas-productos/'+ id,
				success : function(data) {
					$('#dt-Marcas-Producto').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


});
