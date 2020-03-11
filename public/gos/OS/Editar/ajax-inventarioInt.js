$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	$("#gos_producto_id").on('change',function(){
		var itemProducto=Array.from($("#gos_producto_id").find(':selected')).find(function(item){return $(item).text();});
		fetch(app_url+'/inventario-interno/'+itemProducto.value)
		.then(function(response) {
			return response.json();
		})
		.then(function(data){
			$('#nomb_producto').attr("value",data.nomb_producto);
			$('#descripcion').attr("value",data.descripcion);
			$('#precio_materiales').attr("value",data.venta);
			$('#codigo_sat').attr("value",data.codigo_sat);
			
	
		});
	});
	// get de listado o index tomado del controller para el
	// Objeto DataTable
	var id = $("#gos_os_id").val();
	$('#dt-InventarioInt').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : '/osg-inventario-interno/'+id,    //completar URL
		columns : [	{data : 'gos_producto_id',name : 'id','visible' : false},
					{data : 'nombre'},
					{data : 'descripcion'},
					{data : 'codigo_sat'},
					{data : 'cantidad'},
					{data : 'precio_producto'},
					{data : 'descuento'},
					{data : 'precio_producto_final'},
					{data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});
	$("#btn_ItemPaqueteOS").click(function(){
		var cantidad = $("#cantidad").val();
		if(cantidad >0){
			$.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#inventarioInterno_form').serialize(),
			url : '/osg-agregar-inventario-interno/',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
				}
			},
			success : function(data) {
				// console.log(data);
				if(data == 0){
					alert("No tienes suficiente inventario");
				}
				else{
					$('#dt-InventarioInt').DataTable().ajax.reload();
					$('#dt-lista-producto-os').DataTable().ajax.reload();
				}
			}
    	});
		}
		else{
			alert("Cantidad incorrecta");
		}
	
	});

	/* BORRAR ITEM */
	$('body').on('click','#btn-borrar-item-os',function() {
		var id = $(this).data('id');
		$.ajax({
			type : 'DELETE',
			url : app_url+'/ordenes-servicio-items/'+ id,
			success : function(data) {
				// console.log(data);
				$('#dt-InventarioInt').DataTable().ajax.reload();
			},
			error : function(data) {
				console.log('Error:', data);
			}
		});
	});
	
});
var id = $("#gos_os_id").val();
$("#btnGuardarInventarioInt").click(function(){
	$("#modal-inventario").modal('hide');
	
	window.location.href = '/orden-servicio-generada/'+id;
});