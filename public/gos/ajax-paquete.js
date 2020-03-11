$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

    // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-Paquetes').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-paquetes',
		columns : [ { data : 'gos_paquete_id',name : 'id','visible' : false },
					{ data : 'nomb_paquete'},
					{ data : 'descripcion_paquete'},
					{ data : 'precio_paquete'},
					{ data : 'codigo_sat'}, // ESTE CAMPO ES EL TOTAL FALTA DEFINIR QUE DATO ENTRA EN ESTE CAMPO
					{ data : 'Opciones',name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'asc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

	// BTN PAQUETE
	$('#Paquete-Nuevo').click(function() {
		limpiarlistaItems();
		$('#collapseEtapaPaquete').removeClass('show');
		$('#guardarPaqueteParcial').removeAttr('data-target');
		$('#guardarPaqueteParcial').removeAttr('aria-expanded');
		$('#guardarPaqueteParcial').attr('aria-expanded','false');
		$('.nomb_paquete').text('')
		$('.descripcion_paquete').text('')
		$('.precio_paquete').text('');
		$('#gos_paquete_id').val('');
		$('#PaqueteForm').trigger('reset');
		$('#ItemEtapaPAQ_form').trigger('reset');
		$('#gos_paquete_id_item').removeAttr("value");
		$('#titleModalPaquete').html('Nuevo Paquete');
		$('#modalPaquete').modal('show');

	});

	/**
	 * EVENTO PARA GENERAR EL NUMERO DE OS,
	 * Funciona al seleccionar un cliente
	 */
	$('#guardarPaqueteParcial').click(function(){
		var regex_numeros = /^([0-9.])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9 ])*$/;
		var $errores = 0

		if($('#nomb_paquete').val().trim() == ''){
			if($('#nomb_paquete').val().trim() == ''){
				$('.nomb_paquete').text('Campo obligatorio');
			}else{
				$('.nomb_paquete').text('')
				$('.nomb_paquete').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_paquete').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#descripcion_paquete').val().trim() == '' || !regex_alfanumerico.test($('#descripcion_paquete').val())){
			if($('#descripcion_paquete').val().trim() == ''){
				$('.descripcion_paquete').text('Campo obligatorio');
			}else{
				$('.descripcion_paquete').text('')
				$('.descripcion_paquete').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.descripcion_paquete').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			$('#guardarPaqueteParcial').attr('data-target','#collapseEtapaPaquete');
			$('#guardarPaqueteParcial').removeAttr('aria-expanded');
			$('#guardarPaqueteParcial').attr('aria-expanded','true');
			var id=document.getElementById("gos_paquete_id");
			var valorid = id.value;
			if(valorid == ''){
				$.ajax({
					contenttype : 'application/json; charset=utf-8',
					data: $('#PaqueteForm').serialize(),
					url : app_url+'/gestion-paquetes',
					type : "POST",
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						if (console && console.log) {
							console.log('La solicitud a fallado: '+ textStatus);
							console.log('La solicitud a fallado: '+ errorThrown);
							}
						},
					success : function(data) {

						$('#gos_paquete_id').val(data.gos_paquete_id);
						$('#gos_paquete_id_item').val(data.gos_paquete_id);

					}
				});
			}
		}
	});

	/* GUARDAR PAQUETE */
	$('#btnGuardarPaquete').click(function() {
		var actionType = $('#btnGuardarPaquete').val();
		$('#btnGuardarPaquete').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#PaqueteForm').serialize(),
			url : app_url+'/gestion-paquetes',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				$('#btnGuardarPaquete').html('Guardar');
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
				}
			},
			success : function(data) {
				$('#dt-Paquetes').DataTable().ajax.reload();
				$('#collapseEtapaPaquete').removeClass('show');
				limpiarlistaItems();
				$('#PaqueteForm').trigger('reset');
				$('#ItemEtapaPAQ_form').trigger('reset');
				$('.nomb_paquete').text('')
				$('.descripcion_paquete').text('')
				$('.precio_paquete').text('');
				$('#gos_paquete_id_item').removeAttr("value");
				$('#guardarPaqueteParcial').removeAttr('data-target');
				$('#guardarPaqueteParcial').removeAttr('aria-expanded');
				$('#guardarPaqueteParcial').attr('aria-expanded','false');
				$('#modalPaquete').modal('hide');
				$('#btnGuardarPaquete').html('Guardar');

			}
		});
	});

	/* EDITAR PAQUETE */
	$('body').on('click', '.btnEditarPaquete', function () {
		var id = $(this).data('id');
		$('.nomb_paquete').text('')
		$('.descripcion_paquete').text('')
		$('.precio_paquete').text('');
		$('#guardarPaqueteParcial').attr('data-target','#collapseEtapaPaquete');
		$('#guardarPaqueteParcial').removeAttr('aria-expanded');
		$('#guardarPaqueteParcial').attr('aria-expanded','false');
		$('#collapseEtapaPaquete').removeClass('show');
		$.get(app_url+'/gestion-paquetes/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#titleModalPaquete').html('Editar Paquete');
			$('#modalPaquete').modal('show');
			$('#gos_paquete_id').val(data.gos_paquete_id);
			$('#nomb_paquete').val(data.nomb_paquete);
			$('#descripcion_paquete').val(data.descripcion_paquete);
			$('#codigoSat').val(data.codigoSat);
			$('#codigoSat').change();
			$('#precio_paquete').val(data.precio_paquete);
			$('#gos_paquete_id_item').val(data.gos_paquete_id);
			listaItems(data.gos_paquete_id);
		});

	});

	/* BORRAR PAQUETE */
	$('body').on('click','#borrarPaquete',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar!!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-paquetes/'+ id, //URL PARA METODO BORRAR PAQUETE
				success : function(data) {
					$('#dt-Paquetes').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});

/** ACA COMIENZA LA PARTE DE LOS ITEMS DEL PAQUETE */

	function limpiarlistaItems(){
		var tabla = $('#dt-listaItemsPaquete').DataTable();
		tabla.clear().destroy();
	}

	function listaItems(id){

		var tabla = $('#dt-listaItemsPaquete').DataTable();
		tabla.destroy();
		$('#dt-listaItemsPaquete').DataTable({
			"iDisplayLength": 25,
			responsive: true,
			rowReorder: { update: false },
			paging: false,
			searching: false,
			scrollX: true,
			ajax : app_url+'/gestion-paquetes-items/' + id,
			columns : [ { data : 'gos_paquete_item_id',name : 'id','visible' : true },	 //ID
						{ data : 'orden_etapa'}, // Nombre etapa
						{ data : 'nomb_etapa'}, // Nombre etapa
						{ data : 'nomb_servicio'}, // Nombre etapa
						{data : 'asesor',render: function(data, type, meta){
							var id = meta.gos_paquete_item_id;
								if(data==null){data="Sin Asignar";}
						  return '<a href="javascript:void(0);" id="clickEtapa" data-id="'+id+'" style="color: inherit;text-decoration: inherit;">'+data+'</a>'
						}},
						{ defaultContent: 'cantidad',className: "dt-center"},
						{ data : 'precio'}, // Precio Item
						{ data : 'p_descuento'}, // descuento
						{ data : 'p_descuento'}, // descuento
						{ data : 'Opciones',name : 'Opciones', orderable : false} ], // archivo OpcionesItemsDatatable
			order : [ [ 1, 'asc' ] ],
			language : {'url' : '/gos/Spanish.json'}
		});

	tabla.on( 'row-reorder', function ( e, diff, edit ) {
		for(i = 0; i < diff.length; i++){
			id = diff[i].node.cells[0].innerText;
			newPos = diff[i].newPosition + 1;
			$.ajax({
				type : "GET",
				url : app_url+'/orden-paquetes-etapas/'+id+'/'+newPos+'/',

			});
		}
		$('#dt-listaItemsPaquete').DataTable().ajax.reload();
	});

	}
	// FUNCIONO PARA AGREGAR EL ITEM ETAPA
	$('#btn_ItemEtapaPAQ').click(function() {
    var valetapa =parseInt(document.getElementById("gos_paq_etapa_id").value );
		var valasesor=parseInt(document.getElementById("gos_servicio_taller_id").value );
    if (valetapa>0 ) {
			$( "#valselasesorid" ).hide();
 			$( "#valseletapaid" ).hide();

		$.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#ItemEtapaPAQ_form').serialize(),
			url : app_url+'/gestion-paquetes-items',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
				}
			},
			success : function(data) {
				listaItems(data.gos_paquete_id);
				$('#ItemEtapaPAQ_form').trigger('reset');
				$("#gos_paq_servicio_id").val('');
				$("#gos_paq_servicio_id").selectpicker("refresh");
				$("#gos_paq_etapa_id").selectpicker("refresh");
			}
		});}
		else{
       console.log("else");
			$('#valselasesorid').show();
			$('#valseletapaid').show();
		}
	});

	/* BORRAR ITEM */
	$('body').on('click','#borrarItemPAQ',function() {
		var id = $(this).data('id');
		$.ajax({
			type : 'DELETE',
			url : app_url+'/gestion-paquetes-items/'+ id,
			success : function(data) {
				$('#dt-listaItemsPaquete').DataTable().ajax.reload();
			},
			error : function(data) {
				console.log('Error:', data);
			}
		});
	});
	$('body').on('click','#postAsesor',function(){
		var Request = $('#formTecnicoServicios').serialize();
	   console.log(Request);
	   $.ajax({
			   type: 'POST',
			   url: '/etapa-paquete-tecnico',
			   data: Request,
			   success: function(data) {
					   console.log(data);
			   }
	   });
	   $('#modalAsignarAsesor').modal('hide');
	 $('#dt-listaItemsPaquete').DataTable().ajax.reload();
});

	$('body').on('click','#clickEtapa',function() {
		var id = $(this).data('id');

		document.getElementById("OSitemid").value =id;
		$('#modalAsignarAsesor').modal('show');
	});
	// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE SERVICIOS
	function actualizaInfoEtapa(){
	    var gos_paq_etapa_id=Array.from($("#gos_paq_etapa_id").find(':selected')).find(function(item){return $(item).text();});
	    fetch(app_url+'/gestion-etapas/'+gos_paq_etapa_id.value)
	        .then(function(response) {
	            return response.json();
	        })
	        .then(function(data){
	        	console.log(data);
	            $('#nomb_etapa').val(data.nomb_etapa);
                $('#tiempo_meta').val(data.tiempo_meta);
                $('#minimo_fotos').val(data.minimo_fotos);
                $('#genera_valor').val(data.genera_valor);
                $('#complemento').val(data.complemento);
                $('#refacciones').val(data.refacciones);
                $('#comision_asesor').val(data.comision_asesor);
                $('#comision_asesor_tipo').val(data.comision_asesor_tipo);
                $('#link').val(data.link);
                $('#destajo').val(data.destajo);
                $('#materiales').val(data.materiales);
                $('#descripcion_etapa').val(data.descripcion_etapa);
	        });
	};
});
