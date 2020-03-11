$(document).ready(function() {
	console.log("ajaxtiempoetaready!");
});



function modaletaenproceso(ideta,cados){
	if (cados=="") {
   alert("sin Datos"); return;
	}
	var tabla = $('#dt-proceso').DataTable();
	tabla.clear().destroy();
  $('#modaletaenproceso').modal('show');
  //___________________________DTLOAD___________________________________________
	$('#dt-proceso').DataTable({
			dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
			"iDisplayLength": 25,
			responsive : true,
			processing : true,
			ajax : '/os-etapas-productividad/' + ideta +'/'+cados ,
			columns : [	{data : 'gos_os_id',name : 'id', visible:false},
			           {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
									var id = meta.gos_os_id
									return '<a href="/orden-servicio-generada/'+ id +'" target="_blank"> # '+data+'</a>';
									}},
									{data : 'fecha_creacion', render: function(data, type, row){
											 var fechas=data.split('|');
											 var html='<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Apertura de la orden"><i class="fas fa-circle" style="color: #339af0;"></i>'+fechas[0]+'</p>'+
											           '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Ingreso a reparacion"><i class="fas fa-caret-square-right" style="color: green;"></i>'+fechas[1]+'</p>'+
																 '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-square" style="color: yellow;"></i>'+fechas[2]+'</p>'+
																 '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Terminado"><i class="fas fa-circle" style="color: #339af0;"></i>'+fechas[3]+'</p>'+
																 '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Entregado"><i class="fas fa-caret-square-left" style="color: red;"></i></i>'+fechas[4]+'</p>';
																 $(function () {
																		 $('[data-toggle="popover"]').popover();
																	 })
											 return html;
									}}, // FECHA
									{data : 'nomb_cliente', render: function(data, type, row){
											return data.split('|').join( '<br>');
									}
									},


									{ data: 'detallesVehiculo', render: function(data, type, row){
											data.split('|').join( '<br>');
											var color = data.split('|');
											return color[1]+' color: <i class="fas fa-circle" style="color:#'+color[0]+' "></i>'+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
									},

									{data : 'tiempo', render: function(data, type, meta){
											var fechaInicio = meta.fecha_inicio_et;
											var tiempom = meta.tiempo_meta_texto;
											var tiempocalc = meta.tiempo_meta_calculado
											if (data == 1){
													return '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-caret-square-right" style=" color: #339af0;">&nbsp </i>'+fechaInicio+'</p>'+
													'<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-caret-square-right" style=" color: orange;">&nbsp </i>'+tiempocalc+'</p>'+
													'<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tiempo Meta"><i class="far fa-clock" style=" color: #000;">&nbsp </i>'+tiempom+'</p>'+
													'<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
											}
											else{return '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-caret-square-right" style=" color: #339af0;">&nbsp </i>'+fechaInicio+'</p>'+
											'<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-caret-square-right" style=" color: orange;">&nbsp </i>'+tiempocalc+'</p>'+
											'<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tiempo Meta"><i class="far fa-clock" style=" color: #000;">&nbsp </i>'+tiempom+'</p>'+
											'<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
									}},
									],
									order : [ [ 0, 'desc' ] ],
					language : {'url' : '/gos/Spanish.json'}
			});
}


function modaletaterminada(ideta,cados){
	if (cados=="") {
   alert("sin Datos"); return;
	}
	var tabla = $('#dt-terminadas').DataTable();
	tabla.clear().destroy();
  $('#modaletaterminada').modal('show');
 //________________________DATA TABLE________________________________________________________
 $('#dt-terminadas').DataTable({
		 dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		 "<'row'<'col-sm-12'tr>>" +
		 "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		 "iDisplayLength": 25,
		 responsive : true,
		 processing : true,
		 ajax : '/os-etapas-productividad/' + ideta +'/'+cados ,
		 columns : [	{data : 'gos_os_id',name : 'id', visible:false},
								{data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
								 var id = meta.gos_os_id
								 return '<a href="/orden-servicio-generada/'+ id +'" target="_blank"> # '+data+'</a>';
								 }},
								 {data : 'fecha_creacion', render: function(data, type, row){
											var fechas=data.split('|');
											var html='<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Apertura de la orden"><i class="fas fa-circle" style="color: #339af0;"></i>'+fechas[0]+'</p>'+
																'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Ingreso a reparacion"><i class="fas fa-caret-square-right" style="color: green;"></i>'+fechas[1]+'</p>'+
																'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-square" style="color: yellow;"></i>'+fechas[2]+'</p>'+
																'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Terminado"><i class="fas fa-circle" style="color: #339af0;"></i>'+fechas[3]+'</p>'+
																'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Entregado"><i class="fas fa-caret-square-left" style="color: red;"></i></i>'+fechas[4]+'</p>';
																$(function () {
																		$('[data-toggle="popover"]').popover();
																	})
											return html;
								 }}, // FECHA
								 {data : 'nomb_cliente', render: function(data, type, row){
										 return data.split('|').join( '<br>');
								 }
								 },


								 { data: 'detallesVehiculo', render: function(data, type, row){
										 data.split('|').join( '<br>');
										 var color = data.split('|');
										 return color[1]+' , color: <i class="fas fa-circle" style="color:#'+color[0]+' "></i>'+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
								 },
								 {data : 'tiempo', render: function(data, type, meta){
										 var fechaInicio = meta.fecha_inicio_et;
										 var tiempom = meta.tiempo_meta_texto;
										 var tiempocalc = meta.tiempo_meta_calculado
										 if (data == 1){
												 return '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-caret-square-right" style=" color: #339af0;">&nbsp </i>'+fechaInicio+'</p>'+
												 '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-caret-square-right" style=" color: orange;">&nbsp </i>'+tiempocalc+'</p>'+
												 '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tiempo Meta"><i class="far fa-clock" style=" color: #000;">&nbsp </i>'+tiempom+'</p>'+
												 '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
										 }
										 else{return '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-caret-square-right" style=" color: #339af0;">&nbsp </i>'+fechaInicio+'</p>'+
										 '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-caret-square-right" style=" color: orange;">&nbsp </i>'+tiempocalc+'</p>'+
										 '<p class="m-0  " data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tiempo Meta"><i class="far fa-clock" style=" color: #000;">&nbsp </i>'+tiempom+'</p>'+
										 '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
								 }
								 },
								 ],
								 order : [ [ 0, 'desc' ] ],
				 language : {'url' : '/gos/Spanish.json'}
		 });
}



//CODIGO OLD ______________________________________
/*$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
    function tiempo(tiempo, fecha){

        Date.prototype.addHours= function(h){
            this.setHours(this.getHours()+h);
            return this;
        }
        var hora_inicio_1 = '08:00:00';
        var hora_fin_1 = '14:00:00';
        var horas_muertas_1 = 1;
        var hora_inicio_2 = '15:00:00';
        var hora_fin_2 = '19:00:00';
        var horas_muertas_2 = 13;
        var fechaTiempo = fecha.substring(11,19);
        var date = new Date(fecha);
        var tiempoDiff = parseInt(fechaTiempo) - parseInt(hora_fin_2);
        tiempo = parseInt(tiempo);
        if(fechaTiempo > hora_fin_2){
            tiempo = tiempo - tiempoDiff;
            date = date.addHours(horas_muertas_2+tiempo);
        }
        else if(fechaTiempo < hora_fin_2){
            date = date.addHours(tiempo);
            var fechaTiempoOld =fechaTiempo;
            fechaTiempo = date.toString().substring(16,25);
            if(fechaTiempo > hora_fin_2){
                if(fechaTiempoOld < hora_fin_1){
                    date = date.addHours(horas_muertas_2+horas_muertas_1);
                }
                else{
                    date = date.addHours(horas_muertas_2);
                }
            }
            else if(fechaTiempo < hora_inicio_1){
                date = date.addHours(horas_muertas_2+horas_muertas_1);
                fechaTiempo = date.toString().substring(16,25);
                if(fechaTiempo > hora_fin_2){
                    if(fechaTiempoOld < hora_fin_1){
                        date = date.addHours(horas_muertas_2+horas_muertas_1);
                    }
                    else{
                        date = date.addHours(horas_muertas_2);
                    }
                }
            }
        }
        else{
            date = date.addHours(tiempo);
        }
        return date = date.getFullYear() + "-" +
        ("0" + (date.getMonth()+1)).slice(-2) + "-" +
        ("0" + date.getDate()).slice(-2) + " " +
        ("0" + date.getHours()).slice(-2) + ":" +
        ("0" + date.getMinutes()).slice(-2) + ":" +
        ("0" + date.getSeconds()).slice(-2);
    }

    $('body').on('click', '#btnOs', function () {
        var id = $(this).data('id');
        var fecha = $("#fecha_filtro").val();
        if(fecha == ""){
            fecha = 0;
        }
        var estatus = $("#estatus_filtro").val();
        if(estatus == ""){
            estatus = 0;
        }
        var dano = $("#tipo_dano_filtro").val();
        if(dano == ""){
            dano = 0;
        }
        var aseguradora = $("#aseguradora_filtro").val();
        if(aseguradora == ""){
            aseguradora = 0;
        }
    var tabla = $('#dt-ordenes-servicios').DataTable();
    tabla.clear().destroy();
    $('#exampleModalLongTitle').html(id);
    $('#dt-ordenes-servicios').DataTable({
        dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
        "iDisplayLength": 25,
        responsive : true,
        processing : true,
        ajax : '/os-etapas-productividad/' + id +'/'+fecha + '/'+estatus+'/'+dano+'/'+aseguradora,
        columns : [	{data : 'gos_os_id',name : 'id', visible:false},
        {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
                    var id = meta.gos_os_id

                    return '<a href="/orden-servicio-generada/'+ id +'"> # '+data+'</a>';
                    }}, // #ORDEN

                    // {data : 'tiempo_meta', render: function(data, type, meta){
                    //     return tiempo(data, meta.fecha_inicio_et);
                    // }
                    // },
                    {data : 'fecha_fin_etapa', render: function(data, type, meta){
                        data.split('|');
                        var x = data.split('|');
                    if(x[0] == 0){ x[0] = 'Fecha Inicio Etapa';}
                    if(x[1] == "0000-00-00 00:00:00"){ x[1] = 'Fecha Cierre Etapa';}
                    if(x[3] == "0000-00-00 00:00:00"){ x[3] = 'Fecha Tiempo Meta';}
                    if(x[2] == "0000-00-00 00:00:00"){ x[2] = 'Fecha promesa';}

                    $(function () {
                        $('[data-toggle="popover"]').popover();
                      })
                      return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
                        '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Fin Etapa"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
                        '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Tiempo Meta"><i class="fas fa-square" style="color: red;"></i>'+ tiempo(meta.tiempo_meta, meta.fecha_inicio_et)+'</p>'+
                        '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';
                    }}, // FECHA

                    {data : 'nomb_cliente', render: function(data, type, row){
                        return data.split('|').join( '<br>');
                    }
                    },


                    { data: 'detallesVehiculo', render: function(data, type, row){
                        data.split('|').join( '<br>');
                        var color = data.split('|');
                        var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                        return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                    },

                    { data: 'fin_etapa', render: function(data, type, row){
                        if (data == 1){
                        return '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
                        }
                        else{return '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
                    }},
                    ],
                    order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'}
        });

        var id =  $(this).data('id');
        $("#gos_cliente_os_id").val(id);
        $('#modal-os-clientes').modal('show');
        });


        $('body').on('click', '#btnProcesada', function () {
            var id = $(this).data('id');
            var fecha = $("#fecha_filtro").val();
            if(fecha == ""){
                fecha = 0;
            }
            var estatus = $("#estatus_filtro").val();
            if(estatus == ""){
                estatus = 0;
            }
            var dano = $("#tipo_dano_filtro").val();
            if(dano == ""){
                dano = 0;
            }
            var aseguradora = $("#aseguradora_filtro").val();
            if(aseguradora == ""){
                aseguradora = 0;
            }
        var tabla = $('#dt-servicios').DataTable();
        tabla.clear().destroy();
        $('#exampleModalLongTitle').html(id);
        $('#dt-servicios').DataTable({
            dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
            "iDisplayLength": 25,
            responsive : true,
            processing : true,
            ajax : '/os-etapas-productividad-act/' + id +'/'+fecha + '/'+estatus+'/'+dano+'/'+aseguradora,
            columns : [	{data : 'gos_os_id',name : 'id', visible:false},
            {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
                        var id = meta.gos_os_id

                        return '<a href="/orden-servicio-generada/'+ id +'"> # '+data+'</a>';
                        }}, // #ORDEN
                        {data : 'fecha_fin_etapa', render: function(data, type, meta){
                            data.split('|');
                            var x = data.split('|');
                        if(x[0] == 0){ x[0] = 'Fecha Inicio Etapa';}
                        if(x[1] == "0000-00-00 00:00:00"){ x[1] = 'Fecha Cierre Etapa';}
                        if(x[3] == "0000-00-00 00:00:00"){ x[3] = 'Fecha Tiempo Meta';}
                        if(x[2] == "0000-00-00 00:00:00"){ x[2] = 'Fecha promesa';}

                        $(function () {
                            $('[data-toggle="popover"]').popover();
                          })
                          return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
                            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
                            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Tiempo Meta"><i class="fas fa-square" style="color: red;"></i>'+ tiempo(meta.tiempo_meta, meta.fecha_inicio_et)+'</p>'+
                            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';
                        }}, // FECHA

                        {data : 'nomb_cliente', render: function(data, type, row){
                            return data.split('|').join( '<br>');
                        }
                        },


                        { data: 'detallesVehiculo', render: function(data, type, row){
                            data.split('|').join( '<br>');
                            var color = data.split('|');
                            var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                            return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                        },

                        { data: 'fin_etapa', render: function(data, type, row){
                            if (data == 1){
                            return '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
                            }
                            else{return '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
                        }},
                        ],
                        order : [ [ 0, 'desc' ] ],
                language : {'url' : '/gos/Spanish.json'}
            });

            var id =  $(this).data('id');
            $("#gos_cliente_os_id").val(id);
            $('#modal-os').modal('show');
            });

});*/
