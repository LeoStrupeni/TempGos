$(document).ready(function() {
    $('#crear-cliente').click(function() {

        $('#titleModalCliente').html('Nuevo cliente');
        $('#modalCliente').modal('show');
        
    });

    var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    $('#fecha_comision').daterangepicker({
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
    });

    $('#fecha_nomina').datepicker({
		buttonClasses: ' btn',
		autoclose: true,
		locale: {
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
    });
    
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
   
    $("#dt-reporte-nomina").DataTable({
        dom : "<'row'<'col-6'f><'col-6 d-flex justify-content-end'B>>" +
		"<'row'<'col-12'tr>>" +
		"<'row'<'col-6'i><'col-6'p>>",
		responsive : true,
        processing : true,
        pageLength: 50,
		order : [ [ 0, 'asc' ] ],
        language : {"url" : "/gos/Spanish.json"},
        buttons:[ 
			{
                extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel p-0"></i> ',
				titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                title: null,
                autoFilter: true,
                // exportOptions : {
                //     columns: [ 0, 1, 2, 8, 9, 10, 3, 12, 4, 5, 6 ]
                // }
            },  
            {
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf p-0 text-white"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-warning'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print p-0 text-white"></i> ',
				titleAttr: 'Imprimir',
                className: 'btn btn-danger',
                title: 'Calendario fechas promesa',
                exportOptions : {
                    //columns: [ 0, 7, 8, 9, 10, 3, 12, 13],
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
    });
    
    	/* BORRAR ITEM */
	$('body').on('click','.btn-mas-detalle',function() {
        $('#m_fecha_nomina').val('');
        $('#m_tipo_pago').val('');
        $('#m_observaciones').val('');

        var dataid = $(this).data('id');
        var datos = dataid.split('|');

        var gos_nomina_id = datos[0];
        var observaciones = datos[1];
        var tipo_pago = datos[2];
        var fecha_nomina = datos[3];

        $('#dt-detalleNomina').DataTable().clear().destroy();
        $('#dt-detalleNomina').DataTable({
            dom : "<'row'<'col-6'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'col-6'i><'col-6 d-flex justify-content-end'B>>",
            responsive: true,
            paging: false,
            searching: false,
            ordering: false,
            ajax : '/verNomina/' + gos_nomina_id,
            columns : [ { data : 'nombre',class:'dt-center'},
                        { data : 'monto_Sueldo',class:'dt-center'},
                        { data : 'monto_Banco',class:'dt-center'},
                        { data : 'monto_Efectivo',class:'dt-center'},
                        { data : 'monto_Total',class:'dt-center'},
                        { data : 'Prestado',class:'dt-center' },
                        { data : 'monto_Prestamo',class:'dt-center'}
                ],
            order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'},
            buttons:[ 
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fas fa-file-excel p-0"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    title: null,
                    autoFilter: true,
                    // exportOptions : {
                    //     columns: [ 0, 1, 2, 8, 9, 10, 3, 12, 4, 5, 6 ]
                    // }
                },  
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fas fa-file-pdf p-0 text-white"></i> ',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-warning'
                },
                {
                    extend:    'print',
                    text:      '<i class="fa fa-print p-0 text-white"></i> ',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-danger',
                    title: 'Calendario fechas promesa',
                    exportOptions : {
                        //columns: [ 0, 7, 8, 9, 10, 3, 12, 13],
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
        });
        $('#m_fecha_nomina').val(fecha_nomina);
        $('#m_tipo_pago').val(tipo_pago);
        $('#m_observaciones').val(observaciones);
        $('#modalNomina').modal('show');
    });
    
    $('body').on('click','.btndetalles',function() {
        var gos_usuario_id = $(this).data('id');
        if($('.table-'+gos_usuario_id).hasClass('d-none')){
            $('.table-'+gos_usuario_id).removeClass('d-none');
        } else {
            $('.table-'+gos_usuario_id).addClass('d-none');
        }   
    });
    

    // $('#dt-listadoNomina').DataTable({
    //     dom :   "<'row'<'col-6'p><'col-6 d-flex justify-content-end'B>>" +
    //             "<'row'<'col-12'tr>>",
    //     responsive: true,
    //     pageLength: 25,
    //     buttons:[ 
	// 		{
    //             extend:    'excelHtml5',
	// 			text:      '<i class="fas fa-file-excel p-0"></i> ',
	// 			titleAttr: 'Exportar a Excel',
    //             className: 'btn btn-success',
    //             title: null,
    //             autoFilter: true
    //         },  
    //         {
	// 			extend:    'pdfHtml5',
	// 			text:      '<i class="fas fa-file-pdf p-0 text-white"></i> ',
	// 			titleAttr: 'Exportar a PDF',
	// 			className: 'btn btn-warning'
	// 		},
	// 		{
	// 			extend:    'print',
	// 			text:      '<i class="fa fa-print p-0 text-white"></i> ',
	// 			titleAttr: 'Imprimir',
    //             className: 'btn btn-danger',
    //             title: 'Calendario fechas promesa',
    //             exportOptions : {
    //                 stripHtml: false
    //             },
    //             customize: function (win) {
    //                 $(win.document.body).find('table').css({
    //                     'font-family': '"Trebuchet MS", Arial, Helvetica, sans-serif',
    //                     'border-collapse': 'collapse',
    //                     'border': '1px solid #ddd', 
    //                     'width': '100%',
    //                     'text-align': 'center'
    //                 });
    //                 $(win.document.body).find('th').css({
    //                     'background-color': '#27395c',
    //                     'border': '1px solid #ddd',
    //                     'text-align': 'center'
    //                 });
    //                 $(win.document.body).find('td').css({
    //                     'border': '1px solid #ddd',
    //                     'text-align': 'center'
    //                 });
    //             }
    //         },
    //     ],
    //     language : {"url" : "/gos/Spanish.json"}
    // });

 
});

function myFunction(key){
    var efe = $("#efe_"+key).val();
    var tot = $("#tot_"+key).val();
    if(!efe.includes(".")){
        efe = (efe+".00");
    }
    var final = tot-(efe+0)
    $("#ban_"+key).val(final);
}

function prestamo(key){
    var cobrar = isNaN(parseFloat($("#cobr_"+key).val())) ? 0 : parseFloat($("#cobr_"+key).val());
    var prestar = isNaN(parseFloat($("#pres_"+key).val())) ? 0 : parseFloat($("#pres_"+key).val());
    var total = parseFloat($("#totalOculto_"+key).val());
    var final = (total + prestar) - cobrar;
    $("#tot_"+key).val(final.toFixed(2));
}


function cargarON(id){

    if($('#'+id).val()=='off'){
        $('#'+id).removeAttr('value');
        $('#'+id).attr('value','on');
    } else {
        $('#'+id).removeAttr('value');
        $('#'+id).attr('value','off');
    }
    
}
