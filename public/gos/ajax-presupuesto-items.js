
//CAMBIAN EL COLOR DEL BTN Y VUELVE LOS OTROS DOS AL ESTILO INICIL
$("#add-item-presupuesto").click(function(){
if ($(this).hasClass('btn-primary')){
    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
    $('#add-item-paquete').removeAttr("style");
    $('#add-item-producto').removeAttr("style");
    }
});

$("#add-item-paquete").click(function(){
if ($(this).hasClass('btn-primary')){
    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
    $('#add-item-presupuesto').removeAttr("style");
    $('#add-item-producto').removeAttr("style");
    }
});

$("#add-item-producto").click(function(){
if ($(this).hasClass('btn-primary')){
    $(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
    $('#add-item-presupuesto').removeAttr("style");
    $('#add-item-paquete').removeAttr("style");
    }
});


// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE SERVICIOS
function MostrarSelectServicio(){
    var itemServicio=Array.from($("#gos_paq_servicio_id").find(':selected')).find(function(item){return $(item).text();});
    fetch(app_url+'/gestion-servicios/'+itemServicio.value)
        .then(function(response) {
            return response.json();
        })
        .then(function(data){
            $('#nomb_servicio').attr("value",data.nomb_servicio);
        });
};


// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE PRODUCTO
function MostrarSelectProducto(){
    var itemProducto=Array.from($("#gos_producto_id").find(':selected')).find(function(item){return $(item).text();});
    fetch(app_url+'/inventario-interno/'+itemProducto.value)
    .then(function(response) {
        return response.json();
    })
    .then(function(data){
        $('#nomb_producto').attr("value",data.nomb_producto);
        $('#descripcionProducto').attr("value",data.descripcion);
        $('#codigo_sat').attr("value",data.codigo_sat);

    });
};

function limpiarlistaItemspresupuesto(){
    var tabla = $('#dt-lista-items-presupuesto').DataTable();
    tabla.clear().destroy();
}

function listaItemspresupuesto(id){
    var tabla = $('#dt-lista-items-presupuesto').DataTable();
    tabla.destroy();




  $('#dt-lista-items-presupuesto').DataTable({
    "iDisplayLength": 25,
      responsive: true,
      rowReorder: { update: false },
      paging: false,
      searching: false,
      ordering: false,
      scrollX: true,
      ajax : app_url+'/presupuestos-items/' + id,       //completar URL
      columns : [ { data : 'gos_pres_id',name : 'id','visible' : false },	 //ID
                  { data : 'descripcion'},
                  { data : 'nro_parte'},
                  { data : 'observaciones'},
                  { data : 'servicio'},
                  { data : 'pintura'},
                  { data : 'refaccion'},
                  { data : 'Opciones',name : 'Opciones', orderable : false} ], // archivo OpcionesItemsDatatable
      order : [ [ 0, 'desc' ] ],
      language : {'url' : '/gos/Spanish.json'}
  });


}


//funcion para limpiar los 3 formularios de carga de item
function limpiaTresForm()
{
	// $('#ItemsPresupuestos_form').trigger('reset');
    $('#ItemsPaquetes_form').trigger('reset');
    $('#ItemsProductos_form').trigger('reset');

}
// FUNCIONO PARA AGREGAR EL ITEM presupuesto


$('#btn-ItemPaquete').click(function() {
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#ItemsPresupuestos_form').serialize(),
        url : app_url+'/presupuestos-items',   //completar URL
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
            }
        },
        success : function(data) {
            listaItemsPR(data.gos_pres_id);
            limpiaTresForm();

        }
    });
});

// FUNCIONO PARA AGREGAR EL ITEM PAQUETE
$('#btn_ItemPaquete').click(function() {
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#ItemsPaquetes_form').serialize(),
        url : app_url+'/presupuestos-items',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
            }
        },
        success : function(data) {
            listaItemsOS(data.gos_os_id);

            limpiaTresForm();
          
        }
    });
});

// FUNCIONO PARA AGREGAR EL ITEM PRODUCTO
$('#btn_ItemProducto').click(function() {

    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#ItemsProductos_form').serialize(),
        url : app_url+'/presupuestos-items',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
            }
        },
        success : function(data) {

            listaItemsPR(data.gos_pres_id);
            limpiaTresForm();
           /* $('#OS_ItemsEtapas_form').trigger('reset');
            $('#OS_ItemsPaquetes_form').trigger('reset');
            $('#OS_ItemsProductos_form').trigger('reset');
            $('#gos_os_id_EtapaItem').clear();
            $('#nomb_etapa').clear();
            $('#nomb_servicio').clear();
            $('#gos_paq_etapa_id').clear();
            $('#gos_paq_servicio_id').clear();
            $('#descripcion_etapa').clear();
            $('#asesor_asignado').clear();
            $('#gos_etapa_total').clear();
            $('#gos_etapa_MO').clear();
            $('#gos_os_id_PaqueteItem').clear();
            $('#gos_paquete_id').clear();
            $('#descripcion_paquete').clear();
            $('#gos_paquete_cantidad').clear();
            $('#gos_paquete_venta').clear();
            $('#gos_os_id_ProductoItem').clear();
            $('#descripcionProducto').clear();
            $('#codigo_sat').clear();
            $('#gos_producto_id').clear();
            $('#nomb_producto').clear();
            $('#gos_producto_cantidad').clear();
            $('#gos_producto_venta').clear();*/
        }
    });
});

/* BORRAR ITEM */
$('body').on('click','#borrarItemPresupuesto',function() {
    var id = $(this).data('id');
    $.ajax({
        type : 'DELETE',
        url : app_url+'/presupuestos-items/'+ id,
        success : function(data) {
            $('#dt-lista-items-presupuesto').DataTable().ajax.reload();
        },
        error : function(data) {
            console.log('Error:', data);
        }
    });
});
