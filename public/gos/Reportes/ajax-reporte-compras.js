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
        locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta",
        "customRangeLabel": "Custom","daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
        "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",
        "Octubre","Noviembre","Diciembre"],"firstDay": 1
        }
	});
	
    $("#proveedor").change(function(){
        var table = $('#dt-reporteCompras').DataTable();
        var valor = $(this).val();
        table.column(1).search(valor).draw();
	});

	$("#formaPago").change(function(){
        var table = $('#dt-reporteCompras').DataTable();
        var valor = $(this).val();
        table.column(3).search(valor).draw();
	});

	$("#estadopago").change(function(){
        var table = $('#dt-reporteCompras').DataTable();
        var valor = $(this).val();
        table.column(2).search(valor).draw();
	});

	$("#compraTipo").change(function(){
        var table = $('#dt-reporteCompras').DataTable();
        var valor = $(this).val();
        table.column(4).search(valor).draw();
	});


});

/* TOMAR VALORES DE LOS FILTROS */
function filtrosReporteCompras() {
	$.ajax({contenttype : 'application/json; charset=utf-8',
		data: $('#FormReporteCompras').serializeArray(),
		url : '/FiltrosReporteCompras',
		type : 'POST',
		done : function(response) {console.log(response);},
		error : function(jqXHR,textStatus,errorThrown,data) {
			if (console && console.log) {
				console.log('La solicitud a fallado: '+ textStatus);
				console.log('La solicitud a fallado: '+ errorThrown);
			}
		},
		success : function(data) {
			DatatableFiltrosReporteCompras(data);
		}
	});
}

function DatatableFiltrosReporteCompras(datos){
	$('#dt-reporteCompras').DataTable().clear().destroy();
    $('#dt-reporteCompras').DataTable({
		dom : "<'row'<'col-sm-3 d-none'l><'col-sm-6 d-none'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-6'i><'col-sm-6'p>>",
		responsive : true,
        processing : true,
        pageLength: 50,
		data: datos,
		columns : [
                    { data : 'fecha_compra',class:"text-nowrap", width:"85px"},
                    { data : 'nomb_proveedor',class:"text-nowrap"},
                    { data : 'estado',class:"text-nowrap"},
                    { data : 'nomb_forma_pago',class:"text-nowrap"},
                    { data : 'tipo_compra',class:"text-nowrap"},
					{ data : 'total',class:"text-nowrap", render: function(data, type, row){
						retorno = null;
						if (data == null) {retorno='0.00';} else {retorno=data;}
                        return '$ '+ retorno}
                    },
                    { data : 'Saldo',class:"text-nowrap", render: function(data, type, row){						
						retorno = null;
						if (data == null) {retorno='0.00';} else {retorno=data;}
                        return '$ '+ retorno}
                    }
                ],
		order : [ [ 1, 'asc' ] ],
        language : {"url" : "/gos/Spanish.json"},
		footerCallback: function ( row, data, start, end, display ) {
			var api = this.api();

            var intVal = function (i) {
				return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };

            total5 = api.column(5).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
            $(api.column(5).footer()).html('$ '+ total5 );
            total6 = api.column(6).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
            $(api.column(6).footer()).html('$ '+ total6 );

        }
	});
	
	window.onload=function() {
		filtrosReporteCompras();
	}
}