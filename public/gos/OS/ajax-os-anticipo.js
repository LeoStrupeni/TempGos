$(document).ready(function() {

    var app_url = $('#app_url').attr('url');
   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   var checkAnticipo =  $('#anticipo').val();
   var id_OS = $('#gos_os_id').val();
   if(checkAnticipo=="si"){ //Compare it and if true
    $('#mostrarAnticipos').removeAttr("style");
        if (id_OS != ''){
            listadoAnticiposOS(id_OS);
        }
    } else {
    $('#mostrarAnticipos').attr("style","display:none;");
    }
/** CODIGO PARA MOSTRAR LISTADO DE ANTICIPOS **/
	$('#anticipo').change(function() {
        var id_OS = $('#gos_os_id').val();
		var valor = $(this).val(); //Get value from select element
		if(valor=="si"){ //Compare it and if true
        $('#mostrarAnticipos').removeAttr("style");
            if (id_OS != ''){
                listadoAnticiposOS(id_OS);
            }
		} else {
		$('#mostrarAnticipos').attr("style","display:none;");
		}
	});

/** FUNCION LISTA DE ANTICIPOS POR OS */
    function listadoAnticiposOS(id_OS) {
        var tabla = $('#dt-lista-anticipos').DataTable();
            tabla.clear().destroy();
        console.log(id_OS);
        $('#dt-lista-anticipos').DataTable({
            paging: false,
            searching: false,
            ordering: false,
			responsive : true,
			processing : true,
			ajax : app_url+"/gestion-anticipos/"+id_OS,
            columns : [	{data : 'gos_os_anticipo_id',name : 'id','visible' : false},
                        {data : 'nomb_forma_pago'},
                        {data : 'monto_abono'},
                        {data : 'fecha_abono'},
                        {data : 'observaciones'},
                        {data : 'Opciones',name : 'Opciones',orderable : false}
                        ],
            order : [ [ 0, 'desc' ] ],
            language : {'url' : app_url+'/gos/Spanish.json'}
        });
    }

/** CODIGO PARA MOSTRAR AGREGAR ANTICIPOS A LA BASE **/
    $('#btn-AnticipoOS').click(function(){
        var OS_ID=document.getElementById("gos_os_id"); 
        var valorid = OS_ID.value;
        if (valorid==''){
            alert("Para Agregar un anticipo debe primero completar los datos de la Orden de Servicio!!!")
        } 
        else {
            console.log($('#OS_Anticipo_form').serializeArray());
            $.ajax({contenttype : 'application/json; charset=utf-8',
                data:  $('#OS_Anticipo_form').serialize(),
                url : app_url+'/gestion-anticipos',
                type : 'POST',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                    }
                },
                success : function(data) {
                	 //listadoAnticiposOS(id_OS);
                    $('#dt-lista-anticipos').DataTable().ajax.reload();
                    $('#OS_Anticipo_form').trigger('reset');
                    calctotalInit();
                }
		    });
        return false;
        }    
    });

    $('body').on('click', '.btnEditarAnticipo', function () {
		var id = $(this).data('id');
		$.get(app_url+'/gestion-anticipos/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#modalAnticipo').modal('show');
            $('#gos_os_anticipo_id').val(data.gos_os_anticipo_id);
            $('#gos_os_id_anticipo').val(data.gos_os_id);
            $('#gos_metodo_pago_id').val(data.gos_forma_pago_id);
            $('#gos_metodo_pago_id').change();
			$('#monto_abono').val(data.impporte);
			$('#fecha_abono').val(data.fecha);
			$('#observacionesAnticipo').val(data.observaciones);
		});
    });
    
    $('#btn-EditarAnticipoOS').click(function(){
        $('#btn-EditarAnticipoOS').html('Guardando...');
        $.ajax({contenttype : 'application/json; charset=utf-8',
			data:  $('#OS_Anticipo_Modalform').serialize(),
			url : app_url+'/gestion-anticipos',
			type : 'POST',
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
                $('#btn-EditarAnticipoOS').html('Editar');
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ errorThrown);
				}
			},
			success : function(data) {                
                $('#dt-lista-anticipos').DataTable().ajax.reload();
                $('#OS_Anticipo_Modalform').trigger('reset');
                $('#btn-EditarAnticipoOS').html('Editar');
                $('#modalAnticipo').modal('hide');
			}
        });
    });

    /* BORRAR ANTICIPO */
    $('body').on('click','#borrarAnticipo',function() {
        var id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : app_url+'/gestion-anticipos/'+ id,
                success : function(data) {
                    $('#dt-lista-anticipos').DataTable().ajax.reload();
                    calctotalInit();

                },
                error : function(data) {
                    console.log('Error:',data);
                }
            });
        }
    });

});