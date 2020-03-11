$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
		// get de listado o index tomado del controller para el
		// Objeto DataTable
	$('#ventas-DataTable').DataTable({
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-ventas',
		columns : [ { data : 'gos_venta_id', name : 'id','visible' : false },
					{ data : 'fecha_venta'},
					{ data : 'nro_venta'},
					{ data : 'nomb_cliente'},
					{ data : 'tipo_pago'},
						{ data : 'total'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {url : '/gos/Spanish.json'}
	});

// VENTA
	$('#crear-nueva-venta').click(function() {
		$('#gos_venta_id').val('');
		$('#ventaForm').trigger('reset');
		$('#TitleModalVenta').html('Vender Producto');
		$('#modal-venta').modal('show');
	});

	//MODAL CLIENTE
		$('#crear-cliente').click(function() {
			$('#gos_cliente_id').val('');
			$('#clienteForm').trigger('reset');
			$('#titleModalCliente').html('Nuevo cliente');
			$('#modalCliente').modal('show');
		});


	//FUNCION GUARDAR
	function guardar(){
		// var actionType = $('#btn-guardar-venta').val();
		$('#btn-guardar-venta').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data: $('#ventaForm').serialize(),
				url : app_url+'/gestion-ventas',
				type : 'POST',
				// dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,textStatus,data) {
					$('#btn-guardar-venta').html('Guardar');
					//
					printErrorMsg(textStatus);
					//
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ textStatus);
						}

						// var errors = data.responseJSON;
						// if ($.isEmptyObject(errors) == false) {
						// 	$.each(errors.errors, function(key, value){
						// 		var ErrorID = '#' + key + 'Error';
						// 		$(ErrorID).removeClass("d-none");
						// 		$(ErrorID).text(value);
						// 	})
						// }
				},

				success : function(data) {
					$('#ventas-DataTable').DataTable().ajax.reload();
					$('#ventaForm').trigger('reset');
					$('#modalVenta').modal('hide');
					$('#btn-guardar-venta').html('Guardar');
				}
		});
}
//imprimir error
	function printErrorMsg (msg) {
        $('#alert1').find("ul").html('');
        $('#alert1').css('display','block');
        $.each( msg, function( key, value ) {
            $('#alert1').find("ul").append('<li>'+value+'</li>');
        });
    }

	/* EDITAR Venta */
	$('body').on('click', '.btn-editar-venta', function () {
		var id = $(this).data('id');
		$.get(app_url+'/gestion-ventas/' + id +'/edit', function (data) {
			// $('#title-error').hide();
			// $('#product_code-error').hide();
			// $('#description-error').hide();
			// $('#titleModalVenta').html('Editar Venta');
			// $('#modalVenta').modal('show');
		  //   //datos del venta
			// $('#gos_venta_id').val(data.gos_venta_id);
			// $('#nombre').val(data.nombre);
			// $('#apellidos').val(data.apellidos);
			// $('#empresa').val(data.empresa);
			// $('#email_venta').val(data.email_venta);
			// $('#celular').val(data.celular);
			// $('#telefono_fijo').val(data.telefono_fijo);
			// $('#telefono_fijo').val(data.telefono_fijo);
			// $('#calle_nro').val(data.calle_nro);
			// $('#codigo_postal').val(data.codigo_postal);
			// $('#gos_region_municipio_id').val(data.gos_region_municipio_id); // SELECT
			// $('#gos_region_municipio_id').change();
			// $('#gos_region_colonia_id').val(data.gos_region_colonia_id); // SELECT
			// $('#gos_region_colonia_id').change();
		  //   //datos de facturacion
			// $('#gos_fac_tipo_persona_id').val(data.gos_fac_tipo_persona_id); // SELECT
			// $('#gos_fac_tipo_persona_id').change();
			// $('#razon_social').val(data.razon_social);
			// $('#rfc').val(data.rfc);
			// $('#email_factura').val(data.email_factura);
			// $('#calle_nro_fac').val(data.calle_nro_fac);
			// $('#nro_exterior_fac').val(data.nro_exterior_fac);
			// $('#nro_interior_fac').val(data.nro_interior_fac);
			// $('#cp_fac').val(data.cp_fac);
			// $('#indicaciones').val(data.indicaciones); //TEXTAREA
			// $('#gos_fac_region_municipio_id').val(data.gos_fac_region_municipio_id);// SELECT
			// $('#gos_fac_region_municipio_id').change();
			// $('#gos_fac_region_colonia_id').val(data.gos_fac_region_colonia_id); // SELECT
			// $('#gos_fac_region_colonia_id').change();
		  //   //condiciones e credito
			// $('#dias_credito').val(data.dias_credito);
			// $('#monto_maximo_credito').val(data.monto_maximo_credito);
			// $('#nro_cta_venta').val(data.nro_cta_venta);
	});
});

	/* BORRAR VENTA */
	$('body').on('click','#borrar-venta',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar?!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-ventas/'+ id,
				success : function(data) {
					$('#ventas-DataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});
});
