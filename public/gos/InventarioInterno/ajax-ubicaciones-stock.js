$(document).ready(function() {

var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

  // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#Ubicaciones-stock-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/ubicacionesstock',
		columns : [ { data : 'gos_producto_ubic_stock_id', name : 'id','visible' : false },
					{ data : 'nomb_producto'},
					{ data : 'nomb_ubicacion'},
					{ data : 'concepto'},
				  	{ data : 'fecha'},
					{ data : 'ingreso'},
					{ data : 'egreso'},
					{ data : 'costo'},
					{ data : 'Opciones',
					  name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : app_url+'/gos/Spanish.json'}
    });
// BTN marca
$('#nuevaUbicacionStock').click(function() {
	$('#gos_producto_ubic_stock_id').val('');
	$('#ubicacion-form').trigger("reset");
	$('#titleModalUbicacionStock').html("Nueva Ubicación Stock");
	$('#modal-ubicacion-stock').modal('show');
});

/* GUARDAR ubicacion stock */
$('#btnGuardarUbicacionStock').click(function() {
	var actionType = $('#btnGuardarUbicacionStock').val();
	$('#btnGuardarUbicacionStock').html('Guardando...');
	$.ajax({contenttype : "application/json; charset=utf-8",
			data:  $("#ubicacion-stock-form").serialize(),
				url : app_url+"/ubicacionesstock",
				type : "POST",
				// dataType : "json",
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarUbicacionStock').html('Guardar');
					if (console && console.log) {
						console.log("La solicitud a fallado: "+ textStatus);
						console.log("La solicitud a fallado: "+ errorThrown);
						}
					},
			success : function(data) {
				$('#Ubicaciones-stock-DataTable').DataTable().ajax.reload();
				$('#ubicacion-stock-form').trigger("reset");
				$('#modal-ubicacion-stock').modal('hide');
				$('#btnGuardarUbicacionStock').html('Guardar');
				}
	});
});

/* EDITAR Marca */
$('body').on('click', '.btn-editar-ubicacion-stock', function () {
	var id = $(this).data('id');
$.get(app_url+'/ubicacionesstock/' + id +'/edit', function (data) {
		$('#title-error').hide();
		$('#product_code-error').hide();
		$('#description-error').hide();
		$('#modal-ubicacion-stock').modal('show');
		$('#titleModalUbicacionStock').html("Editar Ubicacion Stock");
		$('#gos_producto_id').val(data.gos_producto_id);
		$('#gos_producto_ubicacion_id').val(data.gos_producto_ubicacion_id);
		$('#concepto').val(data.concepto);
		$('#fecha').val(data.fecha);
		$('#ingreso').val(data.ingreso);
		$('#egreso').val(data.egreso);
		$('#costo').val(data.costo);
	});
});

/* BORRAR marca */
$('body').on('click','#borrar-ubicacion-stock',function() {
	var id = $(this).data('id');
	if (confirm("Esta seguro que desea borrar?")) {
		$.ajax({
			type : "DELETE",
			url : app_url+'/ubicacionesstock/'+ id,
			success : function(data) {
				$('#Ubicaciones-stock-DataTable').DataTable().ajax.reload();
			},
			error : function(data) {
				console.log('Error:', data);
			}
		});
	}
});
});
