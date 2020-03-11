$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

	$('#fecha_vencimiento').datepicker({
		buttonClasses: ' btn',
		autoclose: true,
		locale: {
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});

    $('body').on('click','.btndetalles',function() {
        var gos_proveedor_id = $(this).data('id');
        if($('.table-'+gos_proveedor_id).hasClass('d-none')){
            $('.table-'+gos_proveedor_id).removeClass('d-none');
        } else {
            $('.table-'+gos_proveedor_id).addClass('d-none');
        }   
    });

    $('body').on('click','.btn-mas-detalle',function() {
        var id = $(this).data('id');
        $.get('/gestion-compras/'+id ,function (data) {
            cargatablaItemsCompras(data.gos_compra_id);
            cargatablaPagosCompras(data.gos_compra_id);
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
        });
    });
    
    function cargatablaItemsCompras(id){
		var tabla = $('#dt-itemsComprasVer').DataTable();
		tabla.clear().destroy();
		$('#dt-itemsComprasVer').DataTable({
            dom :   "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6 d-none'i>>",
			responsive: true,
			paging: false,
			searching: false,
			ordering: false,
			ajax : '/gestion-compras-items/' + id,
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
    

    function cargatablaPagosCompras(id){
		var tabla = $('#dt-pagosRegistrados').DataTable();
		tabla.clear().destroy();
		$('#dt-pagosRegistrados').DataTable({
            dom :   "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6 d-none'i>>",
			responsive: true,
			paging: false,
			searching: false,
			ordering: false,
			ajax : '/RegistroPagosCompra/' + id,
			columns : [ 
                        { data : 'fecha',class:'dt-center p-1'},
						{ data : 'numero_documento',class:'dt-center p-1'},
                        { data : 'importe',class:'dt-center p-1'}
                      ], 
            order : [ [ 0, 'asc' ] ],
            language : {'url' : '/gos/Spanish.json'},
            footerCallback: function ( row, data, start, end, display ) {
                $('#DetalleCompra').modal('show');
            }
		});
    }

});

