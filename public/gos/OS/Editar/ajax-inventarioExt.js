$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	$("#gos_producto_id_externo").on('change',function(){
		var itemProducto=Array.from($("#gos_producto_id_externo").find(':selected')).find(function(item){return $(item).text();});
		fetch(app_url+'/inventario-externo/'+itemProducto.value)
		.then(function(response) {
			return response.json();
		})
		.then(function(data){
			// console.log(data);
			$('#descripcion_producto').attr("value",data.descripcion);
			$('#costo').attr("value",data.Costo);
			
	
		});
	});
	// get de listado o index tomado del controller para el
	// Objeto DataTable
	var id = $("#gos_os_id").val();
	$('#dt-InventarioExt').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/osg-producto-externo/'+id,    //completar URL
		columns : [	{data : 'gos_os_producto_externo_id',name : 'id','visible' : false},
					{data : 'fecha'},
					{data : 'nomb_producto'},
          {data : 'codigo'},
          {data : 'descripcion'},
					{data : 'nombre'},
          {data : 'cantidad'},
          {data : 'precio_venta'},
					{data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});
	$("#btnGuardarInventarioExt").click(function(){
		$("#modal-inventario-ext").modal("hide");
	});
	$("#btn_ItemProducto").click(function(){
		var cantidad = $("#gos_producto_cantidad").val();
		var tecnico = $("#gos_tecnico_id").val();
		if(cantidad >0 && tecnico != ''){
			$.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#producto-externo-form').serialize(),
			url : '	/osg-producto-externo-store',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
				}
			},
			success : function(data) {
				if(data == 0){
					alert("No tienes suficiente inventario");
				}
				else{
					$("#gos_producto_id_externo").val('');
					$("#gos_producto_cantidad").val('');
					$("#gos_tecnico_id").val('');
					$("#gos_producto_id_externo").selectpicker('refresh');
					$("#gos_tecnico_id").selectpicker('refresh');
					$("#costo").val("");
					$("#descripcion_producto").val("");
					$("#precio_venta").val("");
					$('#dt-InventarioExt').DataTable().ajax.reload();
					$('#dt-lista-producto-os').DataTable().ajax.reload();
				}
			}
    	});
		}
		else{ 
			if(cantidad <= 0){
				alert("Cantidad incorrecta");
			} else {
				alert("Debe seleccionar un tecnico");
			}
		}
		
	});
	/* BORRAR ITEM */
$('body').on('click','#btn-borrar-prodExt-os',function() {
    var id = $(this).data('id');
    $.ajax({
        url : app_url+'/osg-producto-externo-delete/'+id, 
        success : function(data) {
            $('#dt-InventarioExt').DataTable().ajax.reload();
        },
        error : function(data) {
            console.log('Error:', data);
        }
    });
});
});
var id = $("#gos_os_id").val();
$("#btnGuardarInventarioExt").click(function(){
	$("#modal-inventario-ext").modal('hide');
	
	window.location.href = '/orden-servicio-generada/'+id;
});

$("#gos_producto_cantidad").keyup(function(){
	var costo = $("#costo").val() ;
	var cantidad = $("#gos_producto_cantidad").val();
	var total = costo*cantidad;
	Ç// console.log(total);
	$("#precio_venta").val(total);
  });