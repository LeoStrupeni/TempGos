$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.get('/ReporteOrdenesProcesadasGraf' ,function (data) {
		$("#bar_morris_1").empty();
		$("#bar_morris_2").empty();
		graficos(data);
	});

	$('#dt-OSProcesadas').DataTable({
		dom : "<'row'<'col-sm-3 d-none'l><'col-sm-6 d-none'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-6 d-none'i><'col-sm-6 d-none'p>>",
		responsive : true,
		paging: false,
		order : [ [ 0, 'asc' ] ],
		language : {"url" : "/gos/Spanish.json"}
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

	$("#gos_aseguradora_id,#gos_os_tipo_o_id,#gos_os_tipo_danio_id,#gos_os_estado_exp_id,#rangoFechas").on("change", function() {
		filtrosOSProc();
	});


	function filtrosOSProc(){
		$.ajax({contenttype : 'application/json; charset=utf-8',
			data: $('#formFiltrosGraficos').serializeArray(),
			url : '/FiltrostablaOSProc',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown,data) {
				console.log('Error');
			},
			success : function(data) {
				$("#bar_morris_1").empty();
				$("#bar_morris_2").empty();
				dt_Filtros(data);
				graficos(data);
			}
		});
	}

	function dt_Filtros(datos){
		$('#dt-OSProcesadas').DataTable().clear().destroy();
		$('#dt-OSProcesadas').DataTable({
			dom : "<'row'<'col-sm-3 d-none'l><'col-sm-6 d-none'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-6 d-none'i><'col-sm-6 d-none'p>>",
			responsive : true,
			processing : true,
			paging: false,
			data : datos,
			columns : [
					{ data : 'fechaCreacion',class:"text-nowrap", width:"85px"},
					{ data : 'cantfechaCreacion',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="creacion|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'cantfechaIngreso',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="ingreso|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'cantfechaTerminado',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="terminado|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'cantfechaEntregado',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="entregado|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'cantfechaFacturado',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="facturado|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'cantfechaRemision',render: function(data, type, row){
						return `<a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="remision|`+row['fechaCreacion']+`">`+data+`</a>`;}
					},
					{ data : 'SaldoCredito',render: function(data, type, row){
						return '$ '+parseFloat(data)}
					},
					{ data : 'SaldoContado',render: function(data, type, row){
						return '$ '+parseFloat(data)}
					}],
			order : [ [ 0, 'asc' ] ],
			language : {"url" : "/gos/Spanish.json"},
			footerCallback: function ( row, data, start, end, display ) {
				var api = this.api(), data;
				
				// Remove the formatting to get integer data for summation
				var intVal = function (i) {
					return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
				};
		
				for (let i = 1; i < 7; i++) {
					total = api.column(i).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
					$(api.column(i).footer()).html(total);
				}
				
				for (let i = 7; i < 9; i++) {
					total = api.column(i).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
					$(api.column(i).footer()).html('$ '+ total );
				}
			}
		});
	}

	function graficos(datos){
		Morris.Bar({
			element: 'bar_morris_1',
			horizontal: true,
			data: dataGraf1(datos),
			xkey: 'dia',
			ykeys: ['a', 't', 'e','f','r'],
			labels: ['Abiertas', 'Terminadas', 'Entregadas','Facturadas', 'Remisiones'],
			dataLabels: true,
			hideHover: true,
			resize: true,
			barColors: ['#04F38C','#2E0091','#959398','#D50000','#F4CE11'],
		});

		Morris.Bar({
			element: 'bar_morris_2',
			data: dataGraf2(datos),
			xkey: 'dia',
			ykeys: ['f', 'r','ef','cr'],
			labels: ['facturado', 'Remision', 'Contado', 'Credito'],
			dataLabels: false,
			hideHover: true,
			resize: true,
			barColors: ['#D50000','#F4CE11','#196400','#0000d5']
			//COLORE:ROJO , AMARILLO , VERDE , AZUL
		});

	}

	function dataGraf1(datos) {
		var periodo = 'Desde '+$('#rangoFechas').val().substr(0,10)+' al '+$('#rangoFechas').val().substr(13,10);
		$('#bar_morris_1_title').text(periodo);
		var grafico1 = [];
		var creadas = 0;
		var terminadas = 0;
		var entregadas = 0;
		var facturadas = 0;
		var remision = 0;	
		for (index of datos) {
			creadas=creadas+parseInt(index['cantfechaCreacion']);
			terminadas=terminadas+parseInt(index['cantfechaTerminado']);
			entregadas=entregadas+parseInt(index['cantfechaEntregado']);
			facturadas=facturadas+parseInt(index['cantfechaFacturado']);
			remision=remision+parseInt(index['cantfechaRemision']);
		}
		grafico1.push({
			dia : 'Periodo', 
			a : creadas,
			t : terminadas,
			e : entregadas,
			f : facturadas,
			r : remision
		});
		return grafico1;
	}

	function dataGraf2(datos) {
		var grafico2 = [];
		for (index of datos) {
			grafico2.push({
				dia : index['fechaCreacion'].substr(6,5), 
				f : parseInt(index['SaldoFacturado']),
				r : parseInt(index['SaldoRemision']),
				ef : parseInt(index['SaldoCredito']),
				cr : parseInt(index['SaldoContado'])
			});
		}
		return grafico2;
	}

	$('body').on('click','.btnModalOS',function() {
		var datos = $(this).data('id').split('|');
		var estado = datos[0];
		var fecha = datos[1];
		var aseguradora = $('#gos_aseguradora_id').val();
        var tipoOrden = $('#gos_os_tipo_o_id').val();
        var tipoDanio = $('#gos_os_tipo_danio_id').val();
        var tipoEstado = $('#gos_os_estado_exp_id').val();

		var req ={ Estado:estado, Fecha:fecha, Aseguradora:aseguradora , TipoOrden:tipoOrden, TipoDanio:tipoDanio, TipoEstado:tipoEstado}
		$.ajax({
			data:  req,
			url : '/TablaOSFiltrada',
			type : "POST",
			done : function(response) {console.log(response);},
			success : function(data) {
				tablaOS(data);
				$('#modal_tablaOS').modal('show');
			}
		});
	});

	
	function tablaOS(datos) {
		$('#dt-ordenesFiltradas').DataTable().clear().destroy();
		$('#dt-ordenesFiltradas').DataTable({
			dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
			// iDisplayLength: 25,
			responsive : true,
			processing : true,
			data : datos,
			columns : [	
				{data : 'gos_os_id',name : 'id', visible:false},
				{data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
						var id = meta.gos_os_id;
						return '<a href=/orden-servicio-generada/'+ id +'> # '+data+'</a>';}
				}, // #ORDEN
				{data : 'fecha_creacion', render: function(data, type, row){
						data.split('|');
						var x = data.split('|');
						if(x[0] == 0){ x[0] = 'Fecha Apertura';}
						if(x[1] == "0000-00-00 00:00:00"){ x[1] = 'Fecha Ingreso a reparacion';}
						if(x[2] == "0000-00-00 00:00:00"){ x[2] = 'Fecha promesa';}
						$(function () {$('[data-toggle="popover"]').popover();})
						  return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Apertura de la orden"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
							'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Ingreso a reparacion"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
							'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';}
				}, // FECHA
				{data : 'dias'}, // DIAS
				{data : 'nomb_cliente', render: function(data, type, row){
						return data.split('|').join( '<br>');}
				},		
				{data : 'nomb_aseguradora_min', render: function(data, type, row){
						if(data != ' '){
							var splited = data.split('|');
							return splited[0]
							+'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
							+'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>';
						} else { return '<br><br><br>Sin Aseguradora<br><br><br><br><br>';}}
				}, // CLIENTE
				{data: 'detallesVehiculo', render: function(data, type, row){
						data.split('|').join( '<br>');
						var color = data.split('|');
						var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
						return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
				},
				{data : 'tiempo', render: function(data, type, row){
						if (data == 1){
						return '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
						}
						else{return '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}}
				}, // TIEMPO
				{data : 'asesor'}, // ASESOR
				{data : 'total'}, // TOTAL
				{data : 'porcentaje', render: function(data, type, meta){
					var e = Math.round(data);
					var FT = meta.fecha_terminado;
					var FE = meta.fecha_entregado;
					// return ("$"+data.tbl_pexpenses.cost*data.tbl_pexpenses.quantity);}
					if(data== null){
							return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'0%'+'</div></div>';                                        
						}
					   
						else if(FT!==null && FE==null){
							return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Terminada'+'</div></div>';
														
						}
						else if(FE!==null && FT!==null){
							return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Entregada'+'</div></div>';
														
						}
						else if(data=="100.0000"){
							return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Finalizada'+'</div></div>';
						}
						else{
							return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: '+e+'%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+e+'%</div></div>';
						}
						}
				}],
				order : [ [ 0, 'desc' ] ],
				language : {'url' : '/gos/Spanish.json'}
			});
	}
});

// window.onload=function() {
// 	filtrosOSProc();
// }