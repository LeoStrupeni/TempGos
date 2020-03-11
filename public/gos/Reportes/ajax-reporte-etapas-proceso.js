$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });


    $('body').on('click', '#btnOs', function () {
        console.log(Request);
        var id = $(this).data('id');
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
        ajax : '/ordenes-servicio-etapas/' +  id,
        columns : [	{data : 'gos_os_id',name : 'id', visible:false},
        {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
                    var id = meta.gos_os_id;
                    return '<a href=/orden-servicio-generada/'+ id +'> # '+data+'</a>';
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
                    {data : 'nomb_cliente', render: function(data, type, row){
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

                    }, // CLIENTE
                    
                    { data: 'detallesVehiculo', render: function(data, type, row){
                        data.split('|').join( '<br>');
                        var color = data.split('|');
                        var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                        return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                    },
                    {data : 'tiempo', render: function(data, type, row){
                        console.log(data);
                        if (data == 1){
                        return '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
                        }
                        else{return '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
                    }
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
                        
                        
                        }},
                    ],
                    order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'}
        });

        var id =  $(this).data('id');
        $("#gos_cliente_os_id").val(id);
        $('#modal-os-clientes').modal('show');
        });


    
});