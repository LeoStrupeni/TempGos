$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});

	// get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-proveedores').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 25,
		responsive : true,
		processing : true,
		ajax : '/gestion-proveedores',
		columns : [	{data : 'gos_proveedor_id',name : 'id', visible:false},
					{data : 'nomb_proveedor', render: function(data, type, row){
						var splited = data.split('|');
						return '<a href="" onclick="comprasProveedor('+splited[1]+');" data-toggle="modal">'+splited[0]+'</a>';
						// #modalCompraProveedor
						}},
					{data : 'contacto'},
                    {data : 'telefono'},
                    {data : 'email'},
					{data : 'saldo_pdte', visible:false},
					{data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});

/* Clic Agregar */
	$('#NuevoProveedor').click(function() {
		limpiartextProveedor();
		$('#gos_proveedor_id').val('');
		$('#ProveedorForm').trigger('reset');
		$('#TitleModalProveedor').html('Nuevo proveedor');
		$('#modalProveedor').modal('show');
	});

//BTN GUARDAR
	$('#btnGuardarProveedor').click(function(event){

		var regex_mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
        var regex_numeros = /^([0-9.])*$/;
        var regex_letras = /^([a-z A-Z ])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;

		var $errores = 0

		if($('#nomb_proveedor').val().trim() == ''  ){
			if($('#nomb_proveedor').val().trim() == ''){
				$('.nomb_proveedor').text('Campo obligatorio');
			}else{
				$('.nomb_proveedor').text('');
				$('.nomb_proveedor').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_proveedor').text('');
				if($errores > 0){
					$errores-1;
				}
			});
        }

        if($('#contacto').val().trim() == '' || !regex_letras.test($('#contacto').val())){
			if($('#contacto').val().trim() == ''){
				$('.contacto').text('Campo obligatorio');
			}else{
				$('.contacto').text('');
				$('.contacto').text('El campo acepta solo letras');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.contacto').text('');
				if($errores > 0){
					$errores-1;
				}
			});
        }

		if($('#telefono').val().trim() == '' || !regex_numeros.test($('#telefono').val()) || ($('#telefono').val().length != 10)){
            if($('#telefono').val().trim() == ''){
				$('.telefono').text('Campo obligatorio');
			}else{
				$('.telefono').text('');
				$('.telefono').text('Campo numerico y de largo 10');
            }
            $errores++;
		} else {
			$(this).focus(function(){
				$('.telefono').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

        if($('#email').val().trim() == '' ){
			if($('#email').val().trim() == ''){
				$('.email').text('Campo obligatorio');
			}else{
				$('.email').text('');
				$('.email').text('Formato email no valido');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.email').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}


		if($errores != 0){
			event.preventDefault();
		} else {
			guardarProveedor();
		}
	});

	//FUNCION GUARDAR
	function guardarProveedor(){
		$('#btnGuardarProveedor').html('Guardando...');
		$.ajax({
            contenttype : 'application/json; charset=utf-8',
            data: $('#ProveedorForm').serialize(),
            url : app_url+'/gestion-proveedores',
            type : 'POST',
            done : function(response) {console.log(response);},
            error : function(jqXHR,textStatus,errorThrown,data) {
                $('#btnGuardarProveedor').html('Guardar');
                if (console && console.log) {
                    console.log('La solicitud a fallado: '+ textStatus);
                    console.log('La solicitud a fallado: '+ errorThrown);
                }
            },
            success : function(data) {
				limpiartextProveedor();
				$('#gos_proveedor_id').val('');
                $('#ProveedorForm').trigger('reset');
                $('#TitleModalProveedor').html('Nuevo proveedor');
                $('#modalProveedor').modal('hide');
                $('#dt-proveedores').DataTable().ajax.reload();
                $('#btnGuardarProveedor').html('Guardar');
            }
        });
	};

	// BTN EDITAR
	$('body').on('click', '.btnEditarProveedor', function () {
		var id = $(this).data('id');
		limpiartextProveedor();
		$.get(app_url+'/gestion-proveedores/' + id + '/edit',
			function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#TitleModalProveedor').html('Editar Proveedor');
            $('#ProveedorForm').trigger('reset');
            $('#modalProveedor').modal('show');
			$('#gos_proveedor_id').val(data.gos_proveedor_id);
			$('#nomb_proveedor').val(data.nomb_proveedor);
			$('#contacto').val(data.contacto);
			$('#telefono').val(data.telefono);
			$('#email').val(data.email);
		});
	});

	function limpiartextProveedor(){
        $('.nomb_proveedor').text('');
        $('.contacto').text('');
        $('.telefono').text('');
        $('.email').text('');
	}

	/* BORRAR */
	$('body').on('click','#borrarProveedor',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar!!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-proveedores/'+ id,
				success : function(data) {
						$('#dt-proveedores').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:',data);
				}
			});
		}
	});

	$('body').on('click','#abonarCompra',function() {
        $('.saldo_PagoCompra').text('');
        $('.importe_PagoCompra').text('');
        $('.fecha_PagoCompra').text('');
        $('#pagarCompraForm').trigger('reset');
		var datos = $(this).data('id');
		var corte = datos.split('|');
		var id=corte[0];
		var metodo=corte[1];
        $.get('pagosPorCompra/'+id ,function (data) {
            $('#gos_compra_id_PagoCompra').val(id);
			$('#saldo_PagoCompra').val(parseFloat(data.TotalCompra)-parseFloat(data.TotalPagado));
			$('#metodoPago').val(metodo);
			$('#metodoPago').change();
            $('#PagoCompra').modal('show');
        });
    });

    $('#btn-PagoCompra').click(function() {
        $('.saldo_PagoCompra').text('');
        $('.importe_PagoCompra').text('');
        $('.fecha_PagoCompra').text('');
        var regex_numeros = /^([0-9.])*$/;
        if($('#saldo_PagoCompra').val() == 0){
            $('.saldo_PagoCompra').text('El Saldo Pendiente es 0');
        } else if ($('#importe_PagoCompra').val().trim() == '' || !regex_numeros.test($('#importe_PagoCompra').val())){
            $('.importe_PagoCompra').text('Campo Numerico');
        } else if($('#fecha_PagoCompra').val().trim() == ''){
            $('.fecha_PagoCompra').text('Campo obligatorio');
        } else if($('#saldo_PagoCompra').val()-$('#importe_PagoCompra').val() < 0){
            $('.importe_PagoCompra').text('El importe ingresado es Mayor al saldo');
        } else {
            $('#btn-PagoCompra').html('Registrando ...');
			var datosForm1=$('#pagarCompraForm').serializeArray();
            $.ajax({contenttype : 'application/json; charset=utf-8',
                data: datosForm1,
                url : app_url+'/registro-pago-compra',
                type : 'POST',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    $('#btn-PagoCompra').html('Cargar pago');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                    }
                },
                success : function(data) {
					$('#btn-PagoCompra').html('Cargar pago');
					$('#dt-proveedores').DataTable().ajax.reload();
					$('#dt-ComprasProveedor').DataTable().ajax.reload();
					$('#PagoCompra').modal('hide');
					$('#modalCompraProveedor').modal('show');
                }
            });
        }
	});

	$('body').on('click','#verCompra',function() {
        var id = $(this).data('id');
        $.get('/gestion-compras/'+id ,function (data) {
			cargatablaItemsCompras(data.gos_compra_id);
			$('#verFactura').val(data.nro_factura);
			$('#verTipoCompra').val(data.tipo_compra);
			$('#verProveedor').val(data.nomb_proveedor);
			$('#verFechaCompra').val(data.fecha_compra);
			$('#verFormaPago').val(data.nomb_forma_pago);
			$('#verFechaPago').val(data.fecha_pago);
			$('#verMetodoPago').val(data.nomb_met_pago);
			$('#verDescuento').val(data.descuento);
			$('#verIva').val(data.iva);
			$('#verTotal').val(data.total);
			$('#DetalleCompra').modal('show');
        });
	});

	function cargatablaItemsCompras(id){
		var tabla = $('#dt-itemsComprasVer').DataTable();
		tabla.clear().destroy();
		$('#dt-itemsComprasVer').DataTable({
			responsive: true,
			paging: false,
			searching: false,
			ordering: false,
			ajax : app_url+'/gestion-compras-items/' + id,
			columns : [ { data : 'nomb_producto'},
						{ data : 'nomb_marca'},
						{ data : 'descripcion'},
						{ data : 'cantidad',class:'dt-center'},
						{ data : 'nomb_medida',class:'dt-center'},
						{ data : 'costo',class:'dt-center'},
						{ data : 'precio_venta',class:'dt-center'}],
			language : {'url' : '/gos/Spanish.json'}
		});
	}
});



/**
 * Compras por Proveedor
 */
function limpiardtComprasProveedor(){
    var tabla = $('#dt-ComprasProveedor').DataTable();
    tabla.clear().destroy();
}

function comprasProveedor(id){
    limpiardtComprasProveedor();
    $('#modalCompraProveedor').modal('show');
    $('#dt-ComprasProveedor').DataTable({
        dom : "<'row'<'col-sm-4'l><'col-sm-8'f>>" +
            "<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"iDisplayLength": 25,
        responsive : true,
        processing : true,
        ajax : '/gestion-proveedores/'+id,
        columns : [	{data : 'Fechas', render: function(data, type, row){
                        var splited = data.split('|');
                        return  `<p class="my-1 tooltip-test" title="Fecha compra"> Fc: `+splited[0]+`</p>
                                 <p class="my-1 tooltip-test" title="Vencimiento"> V: `+splited[1]+`</p>
                                 <p class="my-1 tooltip-test" title="Fecha pago"> Fp: `+splited[2]+`</p>`
                    }},
                    {data : 'nomb_proveedor'},
                    {data : 'gos_compra_id',name : 'id'},
                    {data : 'nro_Requisicion'}, // # de requisición, no esta calculado en vista
                    {data : 'nro_factura'},
                    {data : 'gos_os_id'},
                    {data : 'nomb_forma_pago'},
                    {data : 'total'},
                    {data : 'Abonado'}, // Abonado, no esta calculado en vista
                    {data : 'Opciones',name : 'Opciones',orderable : false}
                    ],
        order : [ [ 0, 'desc' ] ],
        language : {'url' : '/gos/Spanish.json'}
	});
}
