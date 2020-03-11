$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

	var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    $('#dt-reporte-mensajes').DataTable({
		dom : "<'row'<'col-sm-6 d-none'l><'col-sm-6 d-none'f>>" +
		"<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-6 d-flex justify-content-start'B><'col-sm-6'p>>",
        pageLength: 20,
        buttons:[ 
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel p-0"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                title: null,
                autoFilter: true,
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
                exportOptions : {stripHtml: false},
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
        language : {'url' : '/gos/Spanish.json'}
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

    $('#global_filtro').on('keyup',function () {
        var table = $('#dt-reporte-mensajes').DataTable();
        table.search(this.value).draw();
    } );
    
    $('body').on('click','.btnListaMensajes',function() {
        var datos = $(this).data('id');
        var splited = datos.split('|');
        var id = splited[0];
        $('#dt-MensajesCliente').DataTable().clear().destroy();
        $('#dt-MensajesCliente').DataTable({
            dom : "<'row'<'col-4'l><'col-6'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'col-6'i><'col-6'p>>",
            responsive : true,
            processing : true,
            ajax : '/ReporteSeguimientoMjs/'+id,    //completar URL
            columns : [	{data : 'gos_os_id',name : 'id','visible' : false},
                        {data : 'prioridad', render: function(data, type, row){
                            if (data == 1){
                            return 'Alta';
                            }
                            else{return 'Normal';}
                        }},
                        {data : 'fecha'},
                        {data : 'nombre'},
                        {data : 'cuerpo'}
                        ],
            order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'},
            footerCallback: function ( row, data, start, end, display ) {
                $('#titlemodalSeguimientoCliente').text('Lista mensajes orden servicio: '+splited[1]);
                $('#modalSeguimientoCliente').modal('show');
            }
        });    
    });
    
    
    
});