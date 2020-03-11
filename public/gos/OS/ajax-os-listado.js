$(document).ready(function () {
/**
 * Ajax listado de Ordenes de Servicios
 */
	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

/**
 * Tabla de lista de ordenes de servicio
 */
	var full = window.location.pathname;
	var splited = full.split("/");
	var t = $('#dt-ordenes-servicios').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 50,
		responsive : true,
		processing : true,
		order: false ,
		rowReorder: {
			update: false
		},
		"columnDefs": [
			{ "type": "numeric-comma", targets: 1 }
		],
		language : {"url" : "/gos/Spanish.json"}
	});
	
	$('body').on('click','#entregar',function() {
		var id = $(this).data('id');
		$.get({contenttype : 'application/json; charset=utf-8',
			
				url : app_url+'/osg-fecha-entregar/'+id,
			
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btnGuardarFechaPromesa').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					location.reload();
					window.location.href="/ordenes-servicio";
                }
		});
	});
	$('body').on('click','#btnborrarOS',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('¿Esta seguro que desea borrar la orden? Se eliminara definitivamente')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/ordenes-servicio/'+ id,
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});

	$('body').on('click','#btnborrarOSC',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('Esta seguro que desea borrar la orden?')) {
			$.ajax({
				method : "GET",
				url : '/osg/'+id+'/borraros',
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


	$('body').on('click','#btncancelarOS',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('Esta seguro que desea cancelar la orden?')) {
			$.ajax({
				method : "GET",
				url : '/osg/'+id+'/cancelaros',
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


	$('body').on('click','#btnregresarcancelada',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('Esta seguro que desea restaurar la orden?')) {
			$.ajax({
				method : "GET",
				url : '/osg/'+id+'/regresar-cancelaros',
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});




	$('body').on('click','#btnmandarHisOs',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('Esta seguro que desea mandar a historico la orden?')) {
			$.ajax({
				method : "GET",
				url : '/osg/'+id+'/mandar-his-os',
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});




	$('body').on('click', '#btnFechaIngreso', function () {
		var id = $(this).data('id');
		$("#gos_os_id").val(id);
	});
	$('body').on('click', '#btnFechaPromesa', function () {
		var id = $(this).data('id');
		$("#gos_os_id_fecha").val(id);
	});
	$("#btnGuardarFechaPromesa").click(function(){
		guardarFecha();
	 });
	 function guardarFecha(){
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
						window.location.href="/ordenes-servicio";
					 $('#fechaPromesa').val(data);
					 $('#modal-fecha-promesa').modal('hide');
					 $('#btnGuardarFechaPromesa').html('Guardar');
				 }
		 });
	}
	$('body').on('click','.ligarOS',function() {
		$('#dt-ordenesLigar').DataTable().destroy();
		var lig = $(this).data('id');
		var datos =lig.split('|');
		var id = datos[0];
		var ntoInterno = datos[1];
		$('#nroOs').text('orden # '+ntoInterno);
		$('#nroOsHidden').val(id);
		$('#nroOsInternoHidden').val(ntoInterno);
		$('#dt-ordenesLigar').DataTable({
			dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
			responsive : true,
			processing : true,
			language : {"url" : "/gos/Spanish.json"}
		});
		$.get({contenttype : 'application/json; charset=utf-8',	
				url : '/ordenes-servicio/ligadas/'+id,
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {console.log('Error');},
				success : function(data) {
					var ligadas = '';
					for (const liga of data) {
						$('#btn-ligar-'+liga.gos_os_id_relacion).text('');
						$('#btn-ligar-'+liga.gos_os_id_relacion).text('Ligada');
						$('#btn-ligar-'+liga.gos_os_id_relacion).removeClass('btn-verde');
						$('#btn-ligar-'+liga.gos_os_id_relacion).removeClass('btn-ligar');
						$('#btn-ligar-'+liga.gos_os_id_relacion).addClass('btn-warning');
						ligadas = ligadas+"# "+liga.nro_orden_interno+", ";
					}
					var resp=ligadas.slice(0, ligadas.length-2);
					if(resp.length>0){
						$('#nroOsLigadas').text('Ordenes Ligadas: '+ resp);
					}
					$('#modalLigarOs').modal('show');
                }
		});
	});

	$('body').on('click','.btn-ligar',function() {
		var gos_os_id=$('#nroOsHidden').val();	
		var gos_os_id_nroInterno = $('#nroOsInternoHidden').val();	
		var lig=$(this).data('id');
		var datos =lig.split('|');
		var req={gos_os_id:gos_os_id,gos_os_id_nroInterno:gos_os_id_nroInterno, gos_os_id_ligar:datos[0],nro_orden_interno:datos[1]}

		if(gos_os_id!=datos[0]){
			$.ajax({
				data: req,
				url : '/ordenes-servicio/ligar',
				type : "POST",
				done : function(response) {console.log(response);},
				success : function(data) {
					$('#nroOsLigadas').empty();
					var ligadas = '';
					for (const liga of data) {
						$('#btn-ligar-'+liga.gos_os_id_relacion).text('');
						$('#btn-ligar-'+liga.gos_os_id_relacion).text('Ligada');
						$('#btn-ligar-'+liga.gos_os_id_relacion).removeClass('btn-verde');
						$('#btn-ligar-'+liga.gos_os_id_relacion).removeClass('btn-ligar');
						$('#btn-ligar-'+liga.gos_os_id_relacion).addClass('btn-warning');
						ligadas = ligadas+"# "+liga.nro_orden_interno+", ";
					}
					var resp=ligadas.slice(0, ligadas.length-2);
					if(resp.length>0){
						$('#nroOsLigadas').text('Ordenes Ligadas: '+ resp);
					}
				}
			});
		} else {
			alert('No puede ligar estas Ordenes de Servicios');
		}
        
	});

	$('body').on('click','.btn-cerrar-ligar',function() {
		$('#modalLigarOs').modal('hide');
	});

	var selector = '.vertical-menu a';
    $(selector).on('click', function(){
        $(selector).removeClass('active');
        $(this).addClass('active');
    });
});


function ReenviarModal(){
	// console.log("modalReenviar");
$('#modal-mensaje').modal('show');
}

function tablaosproc(){ 
    $('#Orden-terminada').hide();
	$('#Orden-entregada').hide();
	$('#Orden-historico').hide();
	$('#Orden-canceladas').hide();
	$('#Orden-proceso').show();
	$('#nombreblade').html('Órdenes En Proceso');
	$('#carpetaselec').val('Pro');
}
function tablaosterm(){
	$('#Orden-terminada').show();
	$('#Orden-entregada').hide();
	$('#Orden-historico').hide();
	$('#Orden-canceladas').hide();
	$('#Orden-proceso').hide();
	$('#nombreblade').html('Órdenes Terminadas');
	$('#carpetaselec').val('Ter');

}
function tablaosentr(){ 
    $('#Orden-terminada').hide();
	$('#Orden-entregada').show();
	$('#Orden-historico').hide();
	$('#Orden-canceladas').hide();
	$('#Orden-proceso').hide();
	$('#nombreblade').html('Órdenes Entregadas');
	$('#carpetaselec').val('Ent');

}
function tablaoshist(){ 
    $('#Orden-terminada').hide();
	$('#Orden-entregada').hide();
	$('#Orden-historico').show();
	$('#Orden-canceladas').hide();
	$('#Orden-proceso').hide();
	$('#nombreblade').html('Histórico');
	$('#carpetaselec').val('His');

}
function tablaoscanc(){ 
    $('#Orden-terminada').hide();
	$('#Orden-entregada').hide();
	$('#Orden-historico').hide();
	$('#Orden-canceladas').show();
	$('#Orden-proceso').hide();
	$('#nombreblade').html('Cancelado');
	$('#carpetaselec').val('Can');

}
function tablabus(){ 
    $('#Orden-terminada').hide();
	$('#Orden-entregada').hide();
	$('#Orden-historico').hide();
	$('#Orden-canceladas').hide();
	$('#Orden-proceso').hide();
	$('#busqueda_avanzada').show();

	$('#nombreblade').html('Busqueda avanzada');

}