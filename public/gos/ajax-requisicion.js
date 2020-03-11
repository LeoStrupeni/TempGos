$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#dt-requisicion-vehiculos').DataTable({
		responsive: true,
		searchDelay: 500,
		processing: true,
		ajax: '/listaVehiculosRequisicion',
		columns: [
			{data: 'gos_os_id'},
			{data: 'cliente'},
			{data : 'vehiculo', render: function(data, type, row){
				var splited = data.split('|');	
				// data-container="body" data-toggle="kt-tooltip" data-placement="top" title="`+splited[0]+`"
				// splited[0] =  NOMBRE COLOR
				return `<svg height="15" width="15">
					<circle cx="7" cy="7" r="7" stroke="black" stroke-width="1" fill="#`+splited[1]+`"/>
					</svg>`+splited[2]+'<br>'+splited[3]+'<br>'+splited[4]+'<br>'+splited[5];}},
			{data: 'economico'},
			{data: 'nro_serie'},
			{defaultContent:`<button class="btn btn-success btn-seleccionar">Seleccionar</button>`}
		],
		language : {'url' : '/gos/Spanish.json'}
	});

	$('#dt-requisiciones').DataTable({
		dom : "<'row'<'col-sm-3 mt-2'l><'col-sm-8 mt-2'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-requisicion',
		columns : [	{data : 'gos_requisicion_id',name : 'id','visible' : true},
					{data : 'fecha'},
                    {data : 'nomb_proveedor'}, 
					{data : 'responsable'},
					{data : 'nro_orden'},
					{data : 'vehiculo', render: function(data, type, row){
						var splited = data.split('|');	
						return `<svg height="15" width="15">
							<circle cx="7" cy="7" r="7" stroke="black" stroke-width="1" fill="#`+splited[1]+`"/>
							</svg>`+splited[2]+'<br>'+splited[3]+'<br>'+splited[4]+'<br>'+splited[5];}},
					{defaultContent:`<button class="btn btn-success btn-procesar w-50">Procesar</button>`, class : "dt-center"},	
					{data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
    });

	$('.nuevaRequisicion').click(function() {
		$('#RequisicionForm').trigger('reset');
		$('#ItemRequisicionForm').trigger('reset');
		$('#gos_requisicion_id').val('');
		$('#gos_proveedor_id').val('');
		$('#gos_proveedor_id').change();
		$('#fecha_Solicitud').val('');
		$('#gos_vehiculo_detalles').val('');
		$('#gos_vehiculo_id').val('');
		$('#gos_os_id').val('');
		limpiarlistaItems();
		$('#TitleModalRequisicion').html('Nueva Requisicion');
		$('#ModalRequisicion').modal('show');
	});

	$('#btn_ItemRequisicion').click(function() {
        limpiartextRequisicion();
        var regex_numeros = /^([0-9])*$/;
        var $errores = 0

		if($('#gos_proveedor_id').val()==0){$('.gos_proveedor_id').text('Campo obligatorio');$errores++;}
		else{$(this).focus(function(){$('.gos_proveedor_id').text('');
			if($errores > 0){$errores-1;}});}

		if($('#gos_vehiculo_id').val()==0){$('.gos_vehiculo_id').text('Campo obligatorio');$errores++;}
		else{$(this).focus(function(){$('.gos_vehiculo_id').text('');
			if($errores > 0){$errores-1;}});}

		if($('#gos_producto_id').val()==0){$('.gos_producto_id').text('Campo obligatorio');$errores++;}
		else{$(this).focus(function(){$('.gos_producto_id').text('');
			if($errores > 0){$errores-1;}});}

        if($('#cantidad').val().trim() == ''  || !regex_numeros.test($('#cantidad').val())){
			$('.cantidad').text('Campo numerico');$errores++;}
		else{$(this).focus(function(){$('.cantidad').text('');
			if($errores > 0){$errores-1;}});}

        if($errores != 0){
            event.preventDefault();
        } else {
			guardarRequisicion();
			
        }
	});
	
	$('#btnGuardarUsuarioAdmin').click(function() {
		guardarRequisicion();
		$('#ModalRequisicion').modal('hide');
	});

	function guardarRequisicion(){
        var datosForm1=$('#RequisicionForm').serializeArray();
        var datosForm2=$('#ItemRequisicionForm').serializeArray();
        datosForm1=datosForm1.concat(datosForm2);
        $.ajax({contenttype : 'application/json; charset=utf-8',
            data: datosForm1,
            url : app_url+'/gestion-requisicion',
            type : 'POST',
            done : function(response) {console.log(response);},
            error : function(jqXHR,textStatus,errorThrown) {
                if (console && console.log) {
                    console.log('La solicitud a fallado: '+ textStatus);
                    console.log('La solicitud a fallado: '+ errorThrown);
                }
            },
            success : function(data) {
				$('#dt-requisiciones').DataTable().ajax.reload();
				$('#gos_requisicion_id').val(data);
				listaItems(data);
            }
        });
	}    
	
	/* EDITAR Requisicion*/
	$('body').on('click', '.btn-editar-Requisicion', function () {
		var id = $(this).data('id');
		$.get(app_url+'/gestion-requisicion/' + id +'/edit', function (data) {
			limpiartextRequisicion();
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#TitleModalRequisicion').html('Editar Requisicion');
			$('#gos_requisicion_id').val(data.gos_requisicion_id);
			$('#gos_proveedor_id').val(data.gos_proveedor_id);
			$('#gos_proveedor_id').change();
			$('#fecha_Solicitud').val(data.fecha_solicitud);
			$('#gos_vehiculo_detalles').val(data.detalle_vehiculo);
			$('#gos_vehiculo_id').val(data.gos_vehiculo_id);
			$('#gos_os_id').val(data.gos_os_id);
			$('#ItemRequisicionForm').trigger('reset');
			$('#ModalRequisicion').modal('show');
		})
		listaItems(id);
	});


	function limpiarlistaItems(){
		var tabla = $('#dt-itemsRequisicion').DataTable();
		tabla.clear().destroy();
	}

	function listaItems(id){
		var tabla = $('#dt-itemsRequisicion').DataTable();
		tabla.clear().destroy();
		$('#dt-itemsRequisicion').DataTable({
			responsive: true,
			paging: false,
			searching: false,
			ajax : app_url+'/gestion-requisicion-items/' + id,
			columns : [ { data : 'gos_requisicion_item_id',name : 'id','visible' : false },	 //ID
                        { data : 'nomb_producto'},
                        { data : 'codigo'},
                        { data : 'nomb_marca'},
                        { data : 'descripcion'},
                        { data : 'cantidad'},
                        { data : 'nomb_medida'},
						{ data : 'Opciones',name : 'Opciones', orderable : false} 
					],
			//order : [ [ 1, 'asc' ] ],
			language : {'url' : '/gos/Spanish.json'}
		});	
	};

	/* BORRAR Requisicion */
	$('body').on('click','#borrar-Requisicion',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar!!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-requisicion/'+ id,
				success : function(data) {
					$('#dt-requisiciones').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:',data);
				}
			});
		}
	});

	/* BORRAR Requisicion */
	$('body').on('click','#borrarItemRequisicion',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar!!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-requisicion-items/'+ id,
				success : function(data) {
					$('#dt-itemsRequisicion').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:',data);
				}
			});
		}
	});

	function limpiartextRequisicion() {
		$('.gos_proveedor_id').text('');
		$('.gos_vehiculo_id').text('');
		$('.gos_producto_id').text('');
		$('.cantidad').text('');
	}

	/* Tomar Vehiculo seleccionado e insertarlo en el modal padre */
	$('#dt-requisicion-vehiculos tbody').on('click', '.btn-seleccionar', function () {
		var table = $('#dt-requisicion-vehiculos').DataTable();
		var data = table.row($(this).parents('tr')).data();
		var detallesVehiculo=data.detalle_vehiculo;
		$("#gos_vehiculo_detalles").val(detallesVehiculo);
		$("#gos_vehiculo_id").val(data['gos_vehiculo_id']);
		$("#gos_os_id").val(data['gos_os_id']);
		$('#modalbuscarVehiculo').modal('hide');
	});

});



/*** METODO PARA ACTUALIZAR CARGA PROVEEDORES */
function getselectProveedor() {
	var regex_mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
	var regex_numeros = /^([0-9.])*$/;
	var regex_letras = /^([a-zA-Z ])*$/;
	var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;

	var $errores = 0

	/** EVALUACION DE CAMPOS */
		if($('#nomb_proveedor').val().trim() == '' || !regex_alfanumerico.test($('#nomb_proveedor').val())){
			if($('#nomb_proveedor').val().trim() == ''){$('.nomb_proveedor').text('Campo obligatorio');}
			else{$('.nomb_proveedor').text('');$('.nomb_proveedor').text('Campo alfanumerico');}
			$errores++;}
		else{$(this).focus(function(){$('.nomb_proveedor').text('');if($errores > 0){$errores-1;}});}

		if($('#contacto').val().trim() == '' || !regex_letras.test($('#contacto').val())){
			if($('#contacto').val().trim() == ''){$('.contacto').text('Campo obligatorio');}
			else{$('.contacto').text('');$('.contacto').text('El campo acepta solo letras');}
			$errores++;}
		else{$(this).focus(function(){$('.contacto').text('');if($errores > 0){$errores-1;}});}

		if($('#telefono').val().trim() == '' || !regex_numeros.test($('#telefono').val()) || ($('#telefono').val().length != 10)){
			if($('#telefono').val().trim() == ''){$('.telefono').text('Campo obligatorio');}
			else{$('.telefono').text('');$('.telefono').text('Campo numerico y de largo 10');}
			$errores++;}
		else{$(this).focus(function(){$('.telefono').text('');if($errores > 0){$errores-1;}});}

		if($('#email').val().trim() == '' || !regex_mail.test($('#email').val())){
			if($('#email').val().trim() == ''){$('.email').text('Campo obligatorio');}
			else{$('.email').text('');$('.email').text('Formato email no valido');}
			$errores++;}
		else{$(this).focus(function(){$('.email').text('');if($errores > 0){$errores-1;}});}

	/** EVALUACION DE ERRORES Y GUARDADO */
	if($errores != 0){event.preventDefault();}
	else {
		$('#btn-guardadoRapidoProveedor').html('Guardando...');
		var name=$('#nomb_proveedor').val();
		$.ajax({
			type: 'POST',
			url: '/ProveedorCargaRapida',
			data: $('#ProveedorFormRapido').serializeArray(),
			success: function(data) {
				$('#ProveedorRapido').modal('hide');
				$('#btn-guardadoRapidoProveedor').html('Guardar');
				$('#gos_proveedor_id').append('<option value="'+data+'" selected>'+name+'</option>');
				$('#gos_proveedor_id').selectpicker('refresh');
			}
		});
		$('#ModalRequisicion').modal('show');
	}	
}

// FUNCION PARA TRAER DATOS DE PRODUCTO
function MostrarProductoRequisicion(){
	var itemProducto=Array.from($("#gos_producto_id").find(':selected')).find(function(item){return $(item).text();});
	fetch('/inventario-interno/'+itemProducto.value)
	.then(function(response) {
		return response.json();
	})
	.then(function(data){
		$('#nomb_marca').val(data.nomb_marca);
		$('#descripcion').val(data.descripcion);
		$('#nomb_medida').val(data.nomb_medida);     
	});
};
