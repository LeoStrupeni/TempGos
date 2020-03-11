$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});

	// get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-EdicionRapida').DataTable({
		responsive : true,
		processing : true,
		ajax : app_url+'/',   //completar URL
		columns : [	{data : 'gos_OS_id',name : 'id','visible' : false},
		{data : 'nomb_etapa'},
		{data : 'descripcion_etapa'},
    {data : 'servicio'},
    {data : 'asesor_asignado'},
		{data : 'precio_servicio'}, //precio solicitado
    {data : 'precio_materiales'}, //precio autorizado
    {data : 'materiales'},
    {data : 'tiempo_meta'},
    {defaultContent:`<input type="checkbox" class="form-check-input" id="finalizar_etapa">`}
			],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});

/* Clic Agregar */
	// $('#NuevoProveedor').click(function() {
	// 	limpiartextProveedor();
	// 	$('#gos_proveedor_id').val('');
	// 	$('#ProveedorForm').trigger('reset');
	// 	$('#TitleModalProveedor').html('Nuevo proveedor');
	// 	$('#modalProveedor').modal('show');
	// });


	// //FUNCION GUARDAR
	// function guardarProveedor(){
	// 	$('#btnGuardarProveedor').html('Guardando...');
	// 	$.ajax({
  //           contenttype : 'application/json; charset=utf-8',
  //           data: $('#ProveedorForm').serialize(),
  //           url : app_url+'/gestion-proveedores',
  //           type : 'POST',
  //           done : function(response) {console.log(response);},
  //           error : function(jqXHR,textStatus,errorThrown,data) {
  //               $('#btnGuardarProveedor').html('Guardar');
  //               if (console && console.log) {
  //                   console.log('La solicitud a fallado: '+ textStatus);
  //                   console.log('La solicitud a fallado: '+ errorThrown);
  //               }
  //           },
  //           success : function(data) {
	// 			limpiartextProveedor();
	// 			$('#gos_proveedor_id').val('');
  //               $('#ProveedorForm').trigger('reset');
  //               $('#TitleModalProveedor').html('Nuevo proveedor');
  //               $('#modalProveedor').modal('hide');
  //               $('#dt-proveedores').DataTable().ajax.reload();
  //               $('#btnGuardarProveedor').html('Guardar');
  //           }
  //       });
	// };

	// BTN EDITAR
	// $('body').on('click', '.btnEditarProveedor', function () {
	// 	var id = $(this).data('id');
	// 	limpiartextProveedor();
	// 	$.get(app_url+'/gestion-proveedores/' + id + '/edit',
	// 		function (data) {
	// 		$('#title-error').hide();
	// 		$('#product_code-error').hide();
	// 		$('#description-error').hide();
	// 		$('#TitleModalProveedor').html('Editar Proveedor');
  //           $('#ProveedorForm').trigger('reset');
  //           $('#modalProveedor').modal('show');
	// 		$('#gos_proveedor_id').val(data.gos_proveedor_id);
	// 		$('#nomb_proveedor').val(data.nomb_proveedor);
	// 		$('#contacto').val(data.contacto);
	// 		$('#telefono').val(data.telefono);
	// 		$('#email').val(data.email);
	// 	});
	// });

//TABLA SERVICIOS
// $('#dt-ServiciosEdicionRapida').DataTable({
//   responsive : true,
//   processing : true,
//   ajax : app_url+'/',   //completar URL
//   columns : [	{data : 'gos_OS_id',name : 'id','visible' : false},
//   {data : 'nomb_etapa'},
//   {data : 'descripcion_etapa'},
//   {data : 'servicio'},
//   {data : 'asesor_asignado'},
//   {data : 'precio_servicio'}, //precio solicitado
//   {data : 'precio_materiales'}, //precio autorizado
//   {data : 'materiales'},
//   {data : 'tiempo_meta'},
//   { data : 'Opciones',
//     name : 'Opciones', orderable : false} ],
//     order : [ [ 0, 'desc' ] ],
//     language : {"url" : app_url+'/gos/Spanish.json'}
// });
/* Clic Agregar */
/* Clic Agregar */
	$('#NuevoProveedor').click(function() {
		$('#gos_servicio_id').val('');
		$('#servicioForm').trigger('reset');
		$('#titleModalServicio').html('Siguiente etapa');
		$('#modal-siguente-etapa').modal('show');
	});


	//CAMBIAN EL COLOR DEL BTN Y VUELVE LOS OTROS DOS AL ESTILO INICIL
	$("#add-item-ajustes").click(function(){
	if ($(this).hasClass('nav-link primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-internas').removeAttr("style");
	    $('#add-item-archivos').removeAttr("style");
			$('#add-item-clientes').removeAttr("style");
	    }
	});

	$("#add-item-clientes").click(function(){
	if ($(this).hasClass('btn-primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-internas').removeAttr("style");
	    $('#add-item-archivos').removeAttr("style");
			$('#add-item-ajustes').removeAttr("style");
	    }
	});

	$("#add-item-internas").click(function(){
	if ($(this).hasClass('btn-primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-archivos').removeAttr("style");
	    $('#add-item-clientes').removeAttr("style");
			$('#add-item-ajustes').removeAttr("style");
	    }
	});

	$("#add-item-archivos").click(function(){
	if ($(this).hasClass('btn-primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-clientes').removeAttr("style");
	    $('#add-item-internas').removeAttr("style");
			$('#add-item-ajustes').removeAttr("style");
	    }
	});

	//Modal SERVICIOS CAMBIAN EL COLOR DEL BTN Y VUELVE LOS OTROS DOS AL ESTILO INICIL
	$("#add-item-Paquete").click(function(){
	if ($(this).hasClass('nav-link primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-servicio').removeAttr("style");
	    }
	});

	$("#add-item-servicio").click(function(){
	if ($(this).hasClass('btn-primary')){
	    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
	    $('#add-item-paquete').removeAttr("style");
	    }
	});











});
