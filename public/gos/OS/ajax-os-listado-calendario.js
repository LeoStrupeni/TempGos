$(document).ready(function () {
    /**
     * Ajax listado de Ordenes de Servicios
     */
        var app_url = $('#app_url').attr('url');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    /**
     * Tabla de lista de ordenes de servicio
     */
    
        // $('#dt-ordenes-servicios').DataTable({
        //     dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
        //     "<'row'<'col-sm-12'tr>>" +
        //     "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
        //     responsive : true,
        //     processing : true,
        //     ajax : app_url+'/ordenes-servicio-calendario/',
        //     columns : [	{data : 'gos_os_id',name : 'id', render: function(data, type, row){						
        //                 return '<a href='+app_url+'/orden-servicio-generada/'+ data +'> # '+data+'</a>';
        //                 }}, // #ORDEN
        //                 {data : 'fecha_creacion', render: function(data, type, row){						
        //                     return data.split('|').join( '<br>');
        //                 }}, // FECHA
        //                 {data : 'dias'}, // DIAS
        //                 {data : 'nomb_cliente', render: function(data, type, row){						
        //                     return data.split('|').join( '<br>');
        //                 }
        //                 }, // CLIENTE
        //                 {data : 'nomb_aseguradora', render: function(data, type, row){
        //                     var splited = data.split('|');						
        //                     // return data.split('|').join( '<br>');
        //                     return splited[0]
        //                     +'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
        //                     +'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>'
        //                     +'<br>'+splited[5]+'<strong style="color:#27395C; font-weight: 500;">'+splited[6]+'</strong>'
        //                     +'<br>'+splited[7]+'<strong style="color:#27395C; font-weight: 500;">'+splited[8]+'</strong>'
        //                     +'<br>'+splited[9]+'<strong style="color:#27395C; font-weight: 500;">'+splited[10]+'</strong>'
        //                     +'<br>'+splited[11]+'<strong style="color:#27395C; font-weight: 500;">'+splited[12]+'</strong>'
        //                     +'<br>'+splited[13]+'<strong style="color:#27395C; font-weight: 500;">'+splited[14]+'</strong>'
        //                     +'<br>'+splited[15]+'<strong style="color:#27395C; font-weight: 500;">'+splited[16]+'</strong>'
        //                     +'<br>'+splited[17]+'<strong style="color:#27395C; font-weight: 500;">'+splited[18]+'</strong>'
        //                     +'<br>'+splited[19]+'<strong style="color:#27395C; font-weight: 500;">'+splited[20]+'</strong>'
        //                     ;
    
        //                 }
        //                 },// ASEGURADORA
        //                 { data: 'detallesVehiculo', render: function(data, type, row){
        //                     data.split('|').join( '<br>');
        //                     var color = data.split('|');
        //                     var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
        //                     return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]}
        //                 },
        //                 {data : 'tiempo'}, // TIEMPO
        //                 {data : 'asesor'}, // ASESOR
        //                 {data : 'total'}, // TOTAL
        //                 {data : 'avance'}, // AVANCE
        //                 {data : 'Opciones',name : 'Opciones',orderable : false}
        //             ],
        //             order : [ [ 0, 'desc' ] ],
        //     language : {'url' : '/gos/Spanish.json'}
        // });
        
    });
    