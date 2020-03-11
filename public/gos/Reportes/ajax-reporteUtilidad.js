$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
	
	$('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});

	$.get('/ReporteUtilidadUnidadGraf' ,function (data) {
		$("#bar_morris_1").empty();
		grafico(data);
	});

	$('#dt-ReporteUtilidad').DataTable({
        dom : "<'row'<'col-6 d-none'f>>" +
		"<'row'<'col-12'tr>>" +
        "<'row'<'col-6'B><'col-6'p>>",
        buttons:[ 
			{   extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel p-0"></i> ',
				titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                title: null,
                autoFilter: true,
				exportOptions : {columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]}},
			{   extend:    'print',
				text:      '<i class="fa fa-print p-0 text-white"></i> ',
				titleAttr: 'Imprimir',
                className: 'btn btn-danger',
                title: 'Reporte Utilidad',
                exportOptions : {columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ],
                    			 stripHtml: false},
                customize: function (win) {
                    $(win.document.body).find('table').css({
                        'font-family': '"Trebuchet MS", Arial, Helvetica, sans-serif',
                        'border-collapse': 'collapse',
                        'border': '1px solid #ddd', 
                        'width': '100%',
                        'text-align': 'center'
                    });
                    $(win.document.body).find('th').css({
                        'background-color': '#27395c',
                        'border': '1px solid #ddd',
                        'text-align': 'center'
                    });
                    $(win.document.body).find('td').css({
                        'border': '1px solid #ddd',
                        'text-align': 'center'
                    });}},
		],
        responsive: true,
        pageLength: 50,
        // ajax: '/ReporteUtilidadUnidad',
        order : [ [ 3, 'asc' ] ],
        language : {'url' : '/gos/Spanish.json'}
    });   

	function grafico(datos){
		Morris.Bar({
			element: 'bar_morris_1',
			data: dataGraf1(datos),
			xkey: 'tipo',
			ykeys: ['cantidad'],
			labels: ['Tipo'],
			// dataLabels: false,
			hideHover: true,
			resize: true,
			barColors: function (row, series, type) {
					 if(row.label == 'Venta')		{return '#01DFD7';}
				else if(row.label == 'Producto')	{return '#FA5882';}
				else if(row.label == 'Producto Ext'){return '#B40431';}
				else if(row.label == 'Nomina')		{return '#A4A4A4';}
				else								{return '#29088A';}
			},
		});
	}
		

	function dataGraf1(datos) {
		var grafico1 = [];
		var venta = 0;
		var producto = 0;
		var externo = 0;
		var nomina = 0;
		var utilidad = 0;

		for (index of datos) {
			venta=venta+parseInt(index['TOTAL']);
			producto=producto+parseInt(index['INVENTARIO']);
			externo=externo+parseInt(index['EXTERNOS']);
			nomina=nomina+parseInt(index['MANOOBRA']);
			utilidad=utilidad+parseInt(index['UTILIDAD']);
		}

		grafico1.push({
			tipo : 'Venta', 
			cantidad : venta,
		});
		grafico1.push({
			tipo : 'Producto', 
			cantidad : producto,
		});
		grafico1.push({
			tipo : 'Producto Ext', 
			cantidad : externo,
		});
		grafico1.push({
			tipo : 'Nomina', 
			cantidad : nomina,
		});
		grafico1.push({
			tipo : 'Utilidad', 
			cantidad : utilidad,
		});

		return grafico1;
	}

	$("#rangoFechas,#aseguradora,#tipo_orden,#global_filtro").on("change", function() { // ,#item
		filtrosUtilidad();
	});

	

	function filtrosUtilidad(){
		$.ajax({contenttype : 'application/json; charset=utf-8',
			data: $('#formUtilidad').serializeArray(),
			url : '/FiltrosUtilidad',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown,data) {
				console.log('Error');
			},
			success : function(data) {
				dt_Filtros(data);
			}
		});
	}

	function dt_Filtros(datos){
		$('#dt-ReporteUtilidad').DataTable().clear().destroy();

		$('#dt-ReporteUtilidad').DataTable({
			dom : "<'row'<'col-6 d-none'f>>" +
			"<'row'<'col-12'tr>>" +
			"<'row'<'col-6'B><'col-6'p>>",
			buttons:[ 
				{
					extend:    'excelHtml5',
					text:      '<i class="fas fa-file-excel p-0"></i> ',
					titleAttr: 'Exportar a Excel',
					className: 'btn btn-success',
					title: null,
					autoFilter: true,
					exportOptions : {columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]}
				},
				{
					extend:    'print',
					text:      '<i class="fa fa-print p-0 text-white"></i> ',
					titleAttr: 'Imprimir',
					className: 'btn btn-danger',
					title: 'Reporte Utilidad',
					exportOptions : {
						columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ],
						stripHtml: false
					},
					customize: function (win) {
						$(win.document.body).find('table').css({
							'font-family': '"Trebuchet MS", Arial, Helvetica, sans-serif',
							'border-collapse': 'collapse',
							'border': '1px solid #ddd', 
							'width': '100%',
							'text-align': 'center'
						});
						$(win.document.body).find('th').css({
							'background-color': '#27395c',
							'border': '1px solid #ddd',
							'text-align': 'center'
						});
						$(win.document.body).find('td').css({
							'border': '1px solid #ddd',
							'text-align': 'center'
						});
					}
				},
			],
			responsive: true,
			processing: true,
			pageLength: 50,
			data : datos,
			columns: [
				{data: 'fechaCreacion', class:"align-middle text-nowrap px-0", width: "92px"},
				{data : 'nro_orden_interno', class:"align-middle text-center" , render: function(data, type, meta){
					var id = meta.gos_os_id;
					return '<a href=/orden-servicio-generada/'+ id +'> # '+data+'</a>';
				}}, 
				{defaultContent: ""}, //nro Factura
				{data: 'nomb_cliente', class:"align-middle text-left", render: function(data, type, row){
					var splited = data.split('|');
					return  splited[0]+`, `+splited[1]}
				},
				{data: 'nomb_aseguradora_min', class:"align-middle text-left", render: function(data, type, row){
					var splited = data.split('|');
					return  splited[0]+`<br>`+splited[1]+' '+splited[2]}
				},
				{data: 'detallesVehiculo',class:"align-middle text-left", render: function(data, type, row){
					data.split('|').join( '<br>');
					var splited = data.split('|');
					return `<i class="fas fa-circle" style="color: #`+splited[0]+`;"></i> `+splited[1]+
					`<br>`+splited[2];
				}},
				{ data : 'TOTAL',class:"text-nowrap", render: function(data, type, row){
					return '$ '+data}
				},
				{ data : 'EGRESOS',class:"text-nowrap", render: function(data, type, row){
					return '$ '+data}
				},
				{ data : 'UTILIDAD',class:"text-nowrap", render: function(data, type, row){
					return '$ '+data}
				},
				{ data : 'gos_os_id', orderable : false, render: function(data, type, row){
					return `<a href="javascript:void(0);" data-id="`+data+`" class="btn btn-secondary btn-detalle border-0 p-0"><i class="fas fa-list"></i></a>`;}
				}
			],
			order : [ [ 3, 'asc' ] ],
			language : {'url' : '/gos/Spanish.json'},
			footerCallback: function ( row, data, start, end, display ) {
				$("#bar_morris_1").empty();
				grafico(data);
			},
		});   
	}

	$('body').on('click','.btn-detalle',function() {
		$('#dt-detallesOS').DataTable().clear().destroy();
		var id = $(this).data('id');
		$.get('/detallesOs/'+id ,function (data) {
			$('#dt-detallesOS').DataTable({
				dom : "<'row'<'col-12'tr>>",
				responsive: true,
				processing: true,
				searching: false,
				paging: false,
				ordering: false,
				data: data,
				columns: [
					{data: 'Descripcion', class:"text-nowrap px-0 w-50",},
					{data: 'Venta', class:"align-middle text-center text-nowrap px-0", width: "100px"},
					{data: 'Mo', class:"align-middle text-center text-nowrap px-0", width: "100px"},
					{data: 'CostoTotal', class:"align-middle text-center text-nowrap px-0", width: "100px"},
					{data: 'Utilidad', class:"align-middle text-center text-nowrap px-0", width: "100px"}
				],
				language : {'url' : '/gos/Spanish.json'}
			});
			$('#detalleOs').modal('show');
		});
	});
	
	


	

});