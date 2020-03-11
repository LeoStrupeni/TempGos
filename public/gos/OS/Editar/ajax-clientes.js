$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	var id = $("#gos_os_id").val();
	// Objeto DataTable
	$('body').on('click','#btn-borrarmensaje-clien',function() {
		var id = $(this).data('id');
		console.log(id);
		if (confirm('¿Esta seguro que desea borrar el mensaje? Se eliminara definitivamente')) {
			$.ajax({
				type : 'get',
				url : app_url+'/osg-mensaje/'+ id +'/borrar',
				success : function(data) {
					// $('#dt-ordenes-servicios').DataTable().ajax.reload();
					
					console.log(data);
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});
	$('#dt-ClienteEdicionRapida').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		// responsive : true,
		// processing : true,
		// ajax : '/osg-mensaje-cliente/'+id,    //completar URL
		// columns : [	{data : 'gos_os_id',name : 'id','visible' : false},
		// 			{data : 'prioridad', render: function(data, type, row){
		// 				//console.log(data);
		// 				if (data == 1){
		// 				return 'Alta';
		// 				}
		// 				else{return 'Normal';}
		// 			}},
		// 			{data : 'fecha'},
		// 			{data : 'nombre'},
		// 			{data : 'cuerpo'},
		// 			{data : 'Opciones',name : 'Opciones',orderable : false}
		// 			],
		// order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});
});
