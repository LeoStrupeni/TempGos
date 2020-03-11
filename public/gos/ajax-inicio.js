$(document).ready(function() {

	var app_url = $('#app_url').attr('url');
    $.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });


    $('[data-target]').click(function(){
        var id = $(this).data('id');
        var tipo = $(this).data('tipo');
        var tabla = $('#ordenesActivas-DataTable').DataTable();
        tabla.clear().destroy();
    	$('#exampleModalLongTitle').html(id);
        $('#ordenesActivas-DataTable').DataTable({
            dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
            "iDisplayLength": 25,
            responsive : true,
            processing : true,
            ajax : '/ordenes-servicio-etapas/' +  id +'-'+tipo,
            columns : [	{data : 'gos_os_id',name : 'id', visible:false},
            {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
                        var id = meta.gos_os_id;
                        return '<a href='+app_url+'/orden-servicio-generada/'+ id +'> # '+data+'</a>'
                        }}, // #ORDEN
                        {data : 'fecha_creacion', render: function(data, type, row){
                            data.split('|');
                            var x = data.split('|');
						if(x[0] == 0){ x[0] = 'Fecha Apertura';}
						if(x[1] == "0000-00-00 00:00:00"){ x[1] = 'Fecha Ingreso a reparacion';}
						if(x[2] == "0000-00-00 00:00:00"){ x[2] = 'Fecha promesa';}

						$(function () {
							$('[data-toggle="popover"]').popover();
						  })
						  return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Apertura de la orden"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
							'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Ingreso a reparacion"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
							'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';
                        }}, // FECHA
                    	{data : 'dias'}, // DIAS
                        {data : 'nomb_cliente', render: function(data, type, row){ //cliente
                            return data.split('|').join( '<br>');
                        }
                        },
                        {data : 'nomb_aseguradora_min', render: function(data, type, row){

                            // return data.split('|').join( '<br>');
                            // console.log(data);
                            if(data != ' '){
                                var splited = data.split('|');
                                return splited[0]
                                +'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
                                +'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>'

                                ;
                            }
                            else{
                                return '<br><br><br>Sin Aseguradora<br><br><br><br><br>';
                            }
                            }   
                        }, 
                        // Vehiculo
                        { data: 'detallesVehiculo', render: function(data, type, row){
                            data.split('|').join( '<br>');
                            var color = data.split('|');
                            var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                            return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                        },//Estatus
                        {data : 'nomb_aseguradora', render: function(data, type, row){
                                var splited = data.split('|');
                                if(splited[16] == "Transito"){
                                    return '<i class="fas fa-car-side pl-4"></i>'+'<br>'+'<strong style="color:#27395C; font-weight: 500;">'+splited[16]+'</strong>'
                                }
                                if(splited[16] == "Express"){
                                    return '<i class="fas fa-car pl-4"></i>'+'<br>'+'<strong class="pl-3" style="color:#27395C; font-weight: 500;">'+splited[16]+'</strong>'
                                }
                                if(splited[16] == "Piso"){
                                    return '<i class="fas fa-car pl-4"></i>'+'<br>'+'<strong class="pl-3" style="color:#27395C; font-weight: 500;">'+splited[16]+'</strong>'
                                }
                            }   
                        },  // TIEMPO
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


                            }},
                            {data : 'nombre', render: function(data, type, meta){
                                var turco = meta.gos_os_item_id;
                                var roque = meta.nomb_aseguradora;
                                var fields3 = roque.split('|');                                
                                var fields = data.split('.');
                                var fields2 = data.split(' ');
                                if (fields[0]=="Asig"||fields2[0]=="Asig"){
                                return '<button type="button" id="btntecnico'+turco+'" class="btn btn-primary pt-3 pb-3 pl-4" data-toggle="modal" data-target="#modalAsignarAsesor" value='+fields3[16]+' onclick="myFunction('+turco+')" ><i class="fas fa-hands-helping"></i></button>'
                                }
                                else{return '<i class="fas fa-circle d-none"></i>';}
                            }
                            },
                    ],
                    order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'}
        });
   });
   $("#trigger").click(function(){
    var id = $(this).data('id');
        alert(id);
   });



    // $('#btn-guardar-mensaje').click(function(){
    $('body').on('click', '#btn-guardar-mensaje', function () {
            var email= $("input#os_envio_email").val();
            var value = $("textarea#comentarios").val();
            if(email !== ""){
            window.location.href = "mailto:"+email+'?body='+value ;
            }
        var actionType = $('#btn-guardar-mensaje').val();
        $('#btn-guardar-mensaje').html('Guardando...');
        document.getElementById('btn-guardar-mensaje').style.visibility = "hidden";
		document.getElementById('btn-guardandomensaje-equip').style.display = "inline";
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data: $('#MensajeForm').serialize(),
				url : '/enviar-mensajes',
				type : 'POST',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,textStatus,data) {
					$('#btn-guardar-mensaje').html('Guardar');
					//
					printErrorMsg(textStatus);
					//
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ textStatus);
						}
				},

				success : function(data) {

					$('#dt-clientes').DataTable().ajax.reload();
					$('#MensajeForm').trigger('reset');
					$('#modalMensaje').modal('hide');
					$('#btn-guardar-mensaje').html('Guardar');
				}
        });
    });
    $('body').on('click', '#btn-mensaje-respondido', function () {
        var idms = $('#gos_os_mensaje_id').val();
        $('#btn-mensaje-respondido').html('Guardando...');  
        $( "#btn-mensaje-respondido" ).prop( "disabled", true );
        $.ajax({contenttype : 'application/json; charset=utf-8',
                url : '/marcar-mensaje/'+idms,
                type : 'get',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,textStatus,data) {
                    $('#btn-mensaje-respondido').html('Guardar');
                    //
                    printErrorMsg(textStatus);
                    //
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ textStatus);
                        }
                },

                success : function(data) {
                    // console.log(data);
                    window.location.reload();

                }
        });
    });


    $('body').on('click', '#btn-guardar-mens-cliente', function () {
        // console.log("msn");
        var actionType = $('#btn-guardar-mens-cliente').val();
        $('#btn-guardar-mens-cliente').html('Guardando...');
        $.ajax({contenttype : 'application/json; charset=utf-8',
             data: $('#comentarios-form').serialize(),
             url : '/enviar-mensajes-cliente',
             type : 'POST',
             done : function(response) {console.log(response);},
             error : function(jqXHR,textStatus,textStatus,data) {
                 $('#btn-guardar-mens-cliente').html('Guardar');
                 //
                 printErrorMsg(textStatus);
                 //
                 if (console && console.log) {
                     console.log('La solicitud a fallado: '+ textStatus);
                     console.log('La solicitud a fallado: '+ textStatus);
                     }
             },

             success : function(data) {

                 $('#comentarios-form').trigger('reset');
                 $('#modalComentario').modal('hide');
                 $('#btn-guardar-mens-cliente').html('Guardar');
             }
        });
    });


});
