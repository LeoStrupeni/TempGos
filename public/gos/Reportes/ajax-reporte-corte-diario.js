$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
	
	$('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		startDate: primerDia,
		endDate: ultimoDia,
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});
   
    $("#movimiento").change(function(){
        var table = $('#dt-CorteDiario').DataTable();
		var valor = $(this).val();

		var todos = '<option value="">Todos</option>';
		var administrativo = '<option value="Compra Administrativa">Compra administrativa</option>';
		var almacen = '<option value="Compra Almacén">Compra almacen</option>';
		var consumible = '<option value="Compra Consumibles">Insumos</option>';
		var nomina = '<option value="Pago Nomina">Pago nomina</option>';
		var facturas = '<option value="Facturas">Facturas</option>';
		var remision = '<option value="Notas de Remision">Notas de remision</option>';
		var venta = '<option value="Tickets de Venta">Tickets de Venta</option>';
		var anticipo = '<option value="Anticipo">Anticipo</option>';

		if(valor == ''){
			$('#tipo').empty();
			console.log(todos+administrativo+almacen+consumible+nomina+facturas+remision+venta+anticipo)
			$('#tipo').append(todos+administrativo+almacen+consumible+nomina+facturas+remision+venta+anticipo);
		} else if (valor == 'Egreso'){
			$('#tipo').empty();
			$('#tipo').append(todos+administrativo+almacen+consumible+nomina);
		} else if (valor == 'Ingreso'){
			$('#tipo').empty();
			$('#tipo').append(todos+facturas+remision+venta+anticipo);
		}

        table.column(2).search(valor).draw();
	});

	$("#tipo").change(function(){
        var table = $('#dt-CorteDiario').DataTable();
		var valor = $(this).val();
        table.column(0).search(valor).draw();
	});
	
	$('#global_filtro').on('keyup',function () {
        var table = $('#dt-CorteDiario').DataTable();
        table.search(this.value).draw();
    } );

    $('body').on('click','.btnModalCompra',function() {
        var id = $(this).data('id');
        $.get('/gestion-compras/'+id ,function (data) {
			// console.log(data);
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

});

/* TOMAR VALORES DE LOS FILTROS */
function filtrosCorteDiario() {
	$.ajax({contenttype : 'application/json; charset=utf-8',
		data: $('#FormCorteDiario').serializeArray(),
		url : '/FiltrostablaCorteDiario',
		type : 'POST',
		done : function(response) {console.log(response);},
		error : function(jqXHR,textStatus,errorThrown,data) {
			if (console && console.log) {
				console.log('La solicitud a fallado: '+ textStatus);
				console.log('La solicitud a fallado: '+ errorThrown);
			}
		},
		success : function(data) {
			DatatableFiltrosCorteDiario(data);
		}
	});
}

function DatatableFiltrosCorteDiario(datos){
	$('#dt-CorteDiario').DataTable().clear().destroy();

	$('#dt-CorteDiario').DataTable({
		dom : "<'row'<'col-sm-6 d-none'l><'col-sm-6 d-none'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-6'i><'col-sm-6'p>>",
		responsive : true,
        processing : true,
        pageLength: 50,
		data: datos,
		columns : [
                    { data : 'documento', 'visible' : false, render: function(data, type, meta){ 
						var tipo = meta.Tipo;
						if (data == 'Compra'){
							return data +' '+tipo;
						} else if (data == 'Pago nomina'){
							return data;
						} else {
							return data;
						}
					}},
                    { data : 'Fecha',class:"text-nowrap", width:"85px"},
                    { data : 'movimiento',class:"text-nowrap"},
                    { data : 'documento',class:"text-nowrap"},
                    { data : 'nrodocumento',class:"text-nowrap"},
                    { data : 'Concepto',class:"text-nowrap",render: function(data, type, meta){
						var id = meta.nro_orden_interno;
						var tipoP = meta.movimiento;						
						var splited = data.split('|');
						console.log(splited[0]);
                        if(splited[0]=='Compra'){
                            return `Compra `+splited[2]+` nro <a href="javascript:void(0);" class="btn btn-link p-0 btnModalCompra" data-id="`+splited[1]+`">`+splited[1]+`</a>`;
                        } else if (splited[0]=='Anticipo'){
                            return splited[2]+` Os `+id;
						} else if (splited[0]=='Nota Remisión'){
                            return  ` Nota Remisión - `+id;
						} else if(splited[0]=='Nomina') {
							if(splited[2] == 'Sueldo')
								return splited[1]+' ('+splited[2]+'s)';
							else 
								return splited[1]+' ('+splited[2]+')';
						} else if(splited[0]=='Prestamo') {
								return splited[2]+' ('+splited[1]+')';
						} else {
                            return '';
                        }}
                    },
                    { data : 'tipopago',class:"text-nowrap"},
                    { data : 'cliente_proveedor',class:"text-nowrap"},
                    { data : 'aseguradora',class:"text-nowrap"},
                    { data : 'nroOS',class:"text-nowrap", render: function(data, type, meta){
                        var id = meta.nro_orden_interno;
                        if (data == 0 || id == 0){return ''}
                        else{return '<a href=/orden-servicio-generada/'+ data +'> # '+id+'</a>' }
                        }
                    },				
                    { data : 'Ingreso',class:"text-nowrap", render: function(data, type, row){
                        return '$ '+data}
                    },
                    { data : 'Egreso',class:"text-nowrap", render: function(data, type, row){						
                        return '$ '+data}
                    },
                    { data : 'Saldo', 'visible' : false,class:"text-nowrap", render: function(data, type, row){						
                        return '$ '+data}
                    } //HAY que REVISAR la PARTE DE SALDO, PORQUE DEBERIA PARTIR DE UN SALDO INICIAL y LUEGO IR SUMANDO Y RESTADO
                ],
		order : [ [ 1, 'asc' ] ],
        language : {"url" : "/gos/Spanish.json"},
		footerCallback: function ( row, data, start, end, display ) {
			var api = this.api();
			
             // Remove the formatting to get integer data for summation
            var intVal = function (i) {
				return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };

            total10 = api.column(10).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
            $(api.column(10).footer()).html('$ '+ total10.toFixed(2) );
            total11 = api.column(11).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
            $(api.column(11).footer()).html('$ '+ total11.toFixed(2) );

            var regex_numeros = /^([0-9])*$/;

            if(!regex_numeros.test($('#SaldoInicialDiario').val())){
                $('.SaldoInicialDiario').text('Debe ingresar solo numeros');
                total = api.column(12).data().reduce(function (a, b) {return (intVal(a) + intVal(b));},0);
                $(api.column(12).footer()).html('$ '+ total.toFixed(2));    
            }else{
                total = api.column(12).data().reduce(function (a, b) {return (intVal(a) + intVal(b));},0);
				saldo = parseFloat(total)+parseFloat($('#SaldoInicialDiario').val());
                $(api.column(12).footer()).html('$ '+ saldo.toFixed(2));
            }
        }
	});
}