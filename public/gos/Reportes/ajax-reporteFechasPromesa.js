$(document).ready(function() {

    $.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
    });

   
    $('#dt-fechaPromesa').DataTable({
        dom : "<'row'<'col-6 d-none'f><'col-12 d-flex justify-content-end'B>>" +
		"<'row'<'col-12'tr>>" +
        "<'row'<'col-6'p>>",
        buttons:[ 
			{
                extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel p-0"></i> ',
				titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                title: null,
                autoFilter: true,
                exportOptions : {
                    columns: [ 0, 1, 2, 8, 9, 10, 3, 12, 4, 5, 6 ]
                }
            },

			// {
			// 	extend:    'pdfHtml5',
			// 	text:      '<i class="fas fa-file-pdf p-0"></i> ',
			// 	titleAttr: 'Exportar a PDF',
			// 	className: 'btn btn-danger'
			// },
			{
				extend:    'print',
				text:      '<i class="fa fa-print p-0 text-white"></i> ',
				titleAttr: 'Imprimir',
                className: 'btn btn-danger',
                title: 'Calendario fechas promesa',
                // orientation: 'landscape',
                exportOptions : {
                    columns: [ 0, 7, 8, 9, 10, 3, 12, 13],
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
        paging:false,
        pageLength: 50,
        ajax: '/ReporteCalendario',
        columns: [            
            {data: 'estado','visible' : false},
            {data: 'fecha_creacion_os','visible' : false},
            {data: 'fecha_promesa_os','visible' : false},
            {data: 'empresa','visible' : false},
            {data: 'marcaVehiculo','visible' : false},
            {data: 'modeloVehiculo','visible' : false},
            {data: 'colorVehiculo','visible' : false},

            {data : 'fechas', class:"align-middle text-nowrap px-0", width: "92px", render: function(data, type, row){
                // var splited = data.split('|');
                // var retorno = null;
                data.split('|');
						var x = data.split('|');
                $(function () {
                    $('[data-toggle="popover"]').popover();
                  })
                  if (x[1]==''){return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Ingreso a reparacion"><i class="fas fa-caret-right text-danger"></i>'+x[0]+'</p>';}
                  else {return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Ingreso a reparacion"><i class="fas fa-caret-right text-danger"></i>'+x[0]+'</p>'+
                  '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-right text-warning"></i>'+x[1]+'</p>';} 

                
            }},
            {data: 'dias',class:"align-middle text-center px-0"},
            {data : 'nro_orden_interno', class:"align-middle text-center" , render: function(data, type, meta){
                var id = meta.gos_os_id;
				return '<a href=/orden-servicio-generada/'+ id +'> # '+data+'</a>';
            }}, 
            {data: 'cliente', class:"align-middle text-center px-0", width: "100px"},
            {data : 'TipoCliente', class:"align-middle text-center", render: function(data, type, row){
                var splited = data.split('|');
                return  splited[0]+`<br>`+splited[1]
            }},
            {data: 'etapa_actual', class:"align-middle px-0"},
            {data: 'Vehiculo',class:"align-middle px-0", render: function(data, type, row){
                data.split('|').join( '<br>');
                var splited = data.split('|');
                return `<i class="fas fa-circle" style="color: #`+splited[0]+`;"></i> `+splited[1]+
                `<br>`+splited[2]+`<br>`+splited[3]
            }},            
        ],
        order : [ [ 8, 'asc' ] ],
        language : {'url' : '/gos/Spanish.json'},

    });   
    
    $("#EstadoPromesa").change(function(){
        var table = $('#dt-fechaPromesa').DataTable();
        var valor = $(this).val();
        table.column(0).search(valor).draw();
    });

    $("#aseguradora").change(function(){
        var table = $('#dt-fechaPromesa').DataTable();
        var valor = $(this).val();
        table.column(5).search(valor).draw();
    });

    $("#etapa_Proceso").change(function(){
        var table = $('#dt-fechaPromesa').DataTable();
        var valor = $(this).val();
        table.column(6).search(valor).draw();
    });

    $('#global_filtro').on('keyup',function () {
        var table = $('#dt-fechaPromesa').DataTable();
        table.search(this.value).draw();
    } );

    // $('body').on('click','.imprimirFechaPromesa',function() {
    //     var mywindow = window.open('', 'PRINT');
    //     mywindow.document.write('<html><head>');
    //     mywindow.document.write(`<style>
    //     #dt-fechaPromesa_filter{display:none;}
    //     table{width: 100%!important;}
    //     table, th, td {border: 1px solid black;border-collapse: collapse;}
    //     th{background-color:Midnightblue;
    //         color:white;
    //         font-size:16px;
    //         font-style:normal;
    //         text-align:center;
    //         text-size-adjust:100%;
    //         vertical-align:middle;
    //         white-space:nowrap!important;
    //     }
    //     td{ color:rgb(0, 0, 0);
    //         font-size:16px;
    //         font-style:normal;
    //         text-align:center;
    //         text-size-adjust:100%;
    //         vertical-align:middle;
    //         white-space:normal;
    //     }
    //     </style>`);
    //     mywindow.document.write('</head><body>');
    //     mywindow.document.write(document.getElementById('imprimir-tabla-fecha-Promesas').innerHTML);
    //     mywindow.document.write('</body></html>');
    //     mywindow.document.close(); // necesario para IE >= 10
    //     mywindow.focus(); // necesario para IE >= 10
    //     mywindow.print();
    //     mywindow.close();
    //     return true;
    // });
});

