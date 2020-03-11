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
    
    $('body').on('click','.btnModalOs',function() {
        var datos = $(this).data('id');
        $('#dt-ordenes').DataTable().clear().destroy();
		$('#dt-ordenes').DataTable({
			dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			responsive : true,
			processing : true,
			ajax: '/ReporteOrdenesTecnicosOS/'+datos,
			columns : [
                {data : 'nro_orden_interno',render: function(data, type,meta){
                    var id = meta.gos_os_id;
                    if (data == null){
                        return '';}
                    else{
                        return '<a href=/orden-servicio-generada/'+ id +'> # '+data+'</a>';}
                    }
                    
                },
                {data : 'FechaCreacionOS'},
                {data : 'nomb_cliente', render: function(data, type, meta){
                    var id = meta.nro_orden_interno;
                    if (id == null){
                        return '';}
                    else{var x = data.split('|');
                        return x[0]+'<br>'+x[1];}
                    }
                },
                {data : 'nomb_aseguradora_min', render: function(data, type, meta){
                    var id = meta.nro_orden_interno;
                    if (id == null){
                        return '';}
                    else{
                        if(data != ' '){
                            var splited = data.split('|');
                            return splited[0]
                            +'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
                            +'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>';
                        } else { return '<br><br><br>Sin Aseguradora<br><br><br><br><br>';}}
                    }
                },
                {data: 'detallesVehiculo', render: function(data, type, meta){
                    var id = meta.nro_orden_interno;
                    if (id == null){
                        return '';}
                    else{
                        data.split('|').join( '<br>');
                        var color = data.split('|');
                        var circle = '<i class="fas fa-circle" style="background-color:#'+color[0]+';color: #'+color[0]+';font-size: medium;border: 1px solid black;border-radius: 100%;"></i>';
                        return circle+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                    }
                },
                {data : 'Saldo' },
                {data : 'porcentaje', render: function(data, type, meta){
					var e = Math.round(data);
					var FT = meta.fecha_terminado;
                    var FE = meta.fecha_entregado;
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
			order : [ [ 0, 'asc' ] ],
			language : {"url" : "/gos/Spanish.json"}			
		});
		$('#ModalOrdenes').modal('show');
    });

    $('#dt-EtapasTecnicos').DataTable({
        dom : "<'row'<'col-sm-3 d-none'l><'col-sm-6 d-none'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        responsive : true,
        processing : true,
        pageLength : 50,
        order : [ [ 1, 'asc' ] ],
        language : {"url" : "/gos/Spanish.json"}
    });

    $("#usuario").change(function(){
        var table = $('#dt-EtapasTecnicos').DataTable();
        var valor = $(this).val();
        table.column(0).search(valor).draw();
    });
    
    $('#rangoFechas').change(function() {
        $('#dt-EtapasTecnicos').DataTable().clear().destroy();
        var datos = $('#rangoFechas').val();
        var splited = datos.split(' - ');
        var fechaA = splited[0].split('/');
        var fechaI = fechaA[2]+'-'+fechaA[0]+'-'+fechaA[1]
        var fechaB = splited[1].split('/');
        var fechaF = fechaB[2]+'-'+fechaB[0]+'-'+fechaB[1]

        var fechas = fechaI+'-'+ fechaF

        $('#dt-EtapasTecnicos').DataTable({
            dom : "<'row'<'col-sm-3 d-none'l><'col-sm-6 d-none'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            responsive : true,
            processing : true,
            pageLength : 50,
            ajax: '/FiltrostablaTecnicosOS/'+fechas,
            columns : [
                {data : 'gos_usuario_id','visible' : false},
                {data : 'nombre'},
                {data : 'asignadas',class : 'p-2 text-nowrap', width: '15%',
                    render: function(data, type,meta){
                    var gos_usuario_id = meta.gos_usuario_id;
                    return `<a href="javascript:void(0);" class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                        data-id="Asignada|`+gos_usuario_id+`">`+data+`</a>`;}
                },
                {data : 'terminadas',class : 'p-2 text-nowrap', width: '15%',
                    render: function(data, type,meta){
                    var gos_usuario_id = meta.gos_usuario_id;
                    return `<a href="javascript:void(0);" class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                        data-id="Terminadas|`+gos_usuario_id+`">`+data+`</a>`;}
                },
                {data : 'pagadas',class : 'p-2 text-nowrap', width: '15%',
                    render: function(data, type,meta){
                    var gos_usuario_id = meta.gos_usuario_id;
                    return `<a href="javascript:void(0);" class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                        data-id="Pagadas|`+gos_usuario_id+`">`+data+`</a>`;}
                },
                {data : 'pendientesPago',class : 'p-2 text-nowrap', width: '15%',
                    render: function(data, type,meta){
                    var gos_usuario_id = meta.gos_usuario_id;
                    return `<a href="javascript:void(0);" class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                        data-id="Pendientes|`+gos_usuario_id+`">`+data+`</a>`;}
                }],
            order : [ [ 1, 'asc' ] ],
            language : {"url" : "/gos/Spanish.json"}			
        });
        $("#usuario").val('');
        $("#usuario").change();
    });
});