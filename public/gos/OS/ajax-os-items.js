
$( document ).ready(function() {
    // console.log( "ajax-os-items!" );

});

var app_url = $('#app_url').attr('url');

var editor;
var checkAnticipo =  $('#anticipo').val();

// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE ETAPA
function MostrarSelectEtapa(){
    var itemEtapa=Array.from($("#gos_paq_etapa_id").find(':selected')).find(function(item){return $(item).text();});
    fetch(app_url+'/gestion-etapas/'+itemEtapa.value)

        .then(function(data){
             $('#descripcion_etapa').attr("value",data.descripcion_etapa);
            $('#asesor_asignado').attr("value",data.asesor_asignado);
            $('#gos_usuario_tecnico_id').attr("value",data.gos_usuario_tecnico_id);
            $('#nomb_etapa').attr("value",data.nomb_etapa);
            $('#gos_paq_etapa_id').attr("value",data.gos_paq_etapa_id);
            $('#comision_asesor').attr("value",data.comision_asesor);
            $('#comision_asesor_tipo').attr("value",data.comision_asesor_tipo);
            $('#tiempo_meta').attr("value",data.tiempo_meta);
            $('#materiales').attr("value",data.materiales);
            $('#destajo').attr("value",data.destajo);
            $('#minimo_fotos').attr("value",data.minimo_fotos);
            $('#genera_valor').attr("value",data.genera_valor);
            $('#complemento').attr("value",data.complemento);
            $('#refacciones').attr("value",data.refacciones);
            $('#link').attr("value",data.link);



        });
};
// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE SERVICIOS
function MostrarSelectServicio(){
    var itemServicio=Array.from($("#gos_paq_servicio_id").find(':selected')).find(function(item){return $(item).text();});
    fetch(app_url+'/gestion-servicios/'+itemServicio.value)

        .then(function(data){
            $('#nomb_servicio').attr("value",data.nomb_servicio);
        });
};


// FUNCION DE EJECUCION AL MODIFICAR EL CAMPO SELECT DE PRODUCTO
function MostrarSelectProducto(){
    var itemProducto=Array.from($("#gos_producto_id").find(':selected')).find(function(item){return $(item).text();});
    fetch(app_url+'/inventario-interno/'+itemProducto.value)

    .then(function(data){
        $("#nomb_producto").val(data.nomb_producto);
        $("#nomb_producto_real").val(data.nomb_producto);
    	$('#codigo_sat').val(data.codigo_sat);
    	$('#descripcionProducto').val(data.descripcion);
    });
};

function limpiarlistaItemsOS(){
    var tabla = $('#dt-lista-items-os').DataTable();
    tabla.clear().destroy();
}



function listaItemsOS(id){
    var tabla = $('#dt-lista-items-os').DataTable();
    var tablas = $('#dt-lista-producto-os').DataTable();
    tabla.destroy();
    tablas.destroy();
    if(id == "create"){
        id = 0;
    }
    else{
        $("#btnAbrirInventario").show();
    }
    $('#dt-lista-items-os').DataTable({
        dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
        "iDisplayLength": 25,
            responsive: true,
            rowReorder: { update: false },
            paging: false,
            searching: false,
            ordering: true,
            scrollX: true,
            processing : true,
            ajax : app_url+'/ordenes-servicio-items/' + id,
            columns : [ { data : 'gos_os_item_id',name : 'id','visible' : true },	 //ID
                        { data : 'orden_etapa'},
                        { data : 'nombre'},
                        { data : 'descripcion'},
                        { data : 'servicio'},
                        { data : 'codigo_sat'},
                        {data : 'asesor',render: function(data, type, meta){
                            var id = meta.gos_os_item_id;
                                if(data==null){data="Sin Asignar";}
                          return '<a href="javascript:void(0);" onclick="AsignarAsesorShow('+id+');" style="color: inherit;text-decoration: inherit;">'+data+'</a>'
                        }},
                        { data : 'precio_etapa'},
                        { data : 'precio_materiales'},
                        { data : 'importe', render: function(data,row,meta){
                         var importe=0.00;
                         var etapa=parseFloat( meta.precio_etapa );
                         if (isNaN(etapa)) {etapa=0;}
                         var materiales=parseFloat( meta.precio_materiales );
                         if (isNaN(materiales)) {materiales=0;}
                         importe=etapa+materiales;
                         subtotal=importe+subtotal;
                         importe=importe.toFixed(2);
              					 return importe;
              					}},
                        { data : 'Opciones',name : 'Opciones', orderable : false} ], // archivo OpcionesItemsDatatable
            order : [ [ 1, 'asc' ] ],
            language : {'url' : '/gos/Spanish.json'},
        });
        $('#dt-lista-producto-os').DataTable({
            dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
            "iDisplayLength": 25,
                responsive: true,
                rowReorder: { update: false },
                paging: false,
                searching: false,
                ordering: true,
                scrollX: true,
                processing : true,
              	ajax : app_url+'/ordenes-servicio-producto-items/' + id,
			columns : [ {data : 'gos_producto_id',name : 'id','visible' : false},
					{data : 'nombre'},
					{data : 'descripcion'},
					{data : 'codigo_sat'},
					{data : 'cantidad'},
					{data : 'precio_producto'},
					{data : 'descuento'},
					{data : 'precio_producto_final'},
					{data : 'Opciones',name : 'Opciones',orderable : false} ], // archivo OpcionesItemsDatatable
			order : [ [ 1, 'asc' ] ],
                language : {'url' : '/gos/Spanish.json'},
            });

calctotalInit();

tabla.on( 'row-reorder', function ( e, diff, edit ) {
  for(i = 0; i < diff.length; i++){
  	id = diff[i].node.cells[0].innerText;
  	newPos = diff[i].newPosition + 1;
    $.ajax({
  		type : "GET",
  		url : app_url+'/orden-editar-os-etapas/'+id+'/'+newPos+'/',
      success: function(data){
        console.log(data);
      }
  	});
  }
  $('#dt-lista-items-os').DataTable().ajax.reload();
});
}

function AsignarAsesorShow(id){

    document.getElementById("OSitemid").value =id;
   $('#modalAsignarAsesor').modal('show');
}
$("#postAsesor").click(function(){
    var Request = $('#formTecnicoServicios').serialize();
   console.log(Request);
   $.ajax({
           type: 'POST',
           url: '/orden-servicio-generada/tecnico',
           data: Request,
           success: function(data) {
                   console.log(data);
           }
   });
   $('#modalAsignarAsesor').modal('hide');
 $('#dt-lista-items-os').DataTable().ajax.reload();
 $('#selectecnico').val(0);
 $('#selectecnico').selectpicker('refresh');
});
editor = new $.fn.dataTable.Editor({
    ajax : '/osg-guarda-datos-etapa',
    processing : true,
    table : "#dt-lista-items-os",
    idSrc : 'gos_os_item_id',
    fields : [ {
        label : "Precio:",
        name : "precio_etapa"
    }, {
        label : "Materiales:",
        name : "precio_materiales"
    } ],
    formOptions : {
        bubble : {
            title : 'Editar'
        }
    }
});
editor.on( 'edit', function ( e, json, data ) {
  calctotalInit();

} );
$('#dt-lista-items-os').on('click', 'tbody td', function(e) {
    if ($(this).index() < 9) {
        editor.bubble(this);
    }
});
//funcion para limpiar los 3 formularios de carga de item
function limpiaTresForm()

{
	$('#OS_ItemsEtapas_form').trigger('reset');
    $('#OS_ItemsPaquetes_form').trigger('reset');
    $('#OS_ItemsProductos_form').trigger('reset');
    $('#gos_paq_etapa_id').selectpicker('refresh');
    $('#gos_paq_servicio_id').selectpicker('refresh');
}
function modalcargando(){
// e.preventDefault();
$("#loadMe").modal({
  backdrop: "static", //remove ability to close modal with click
  keyboard: false, //remove option to close with keyboard
  show: true //Display loader!
});
setTimeout(function() {
  $("#loadMe").modal("hide");
}, 4000);

}
// FUNCIONO PARA AGREGAR EL ITEM ETAPA
$('#btn_ItemEtapaOS').click(function() {

  var selvalidation=parseInt(document.getElementById("gos_paq_etapa_id").value);
  if (selvalidation>0) {
      $("#smallvaletapa").hide();
     validacionDatosOS();
  setTimeout(function () {
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#OS_ItemsEtapas_form').serialize(),
        url : app_url+'/ordenes-servicio-items',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
            }
        },
        success : function(data) {

            limpiaTresForm();

            listaItemsOS(data.gos_os_id);
            $("#btnAbrirInventario").show();
        }
    });
  }, 1500);
  }
  else {
      $("#smallvaletapa").show();
  }

});


$('#btn_ItemPaqueteOS').click(function() {

  var selvalidation=parseInt(document.getElementById("gos_paquete_id").value);
  if (selvalidation>0) {

  $("#smallvalpaquete").hide();


  validacionDatosOS();

  setTimeout(function () {
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#OS_ItemsPaquetes_form').serialize(),
        url : app_url+'/ordenes-servicio-items',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
            }
        },
        success : function(data) {
              limpiaTresForm();
              listaItemsOS(data.gos_os_id);
              $("#btnAbrirInventario").show();
        }
    });
  }, 1000);
  }
  else {
      $("#smallvalpaquete").show();
  }
});

// FUNCIONO PARA AGREGAR EL ITEM PRODUCTO
$('#btn_ItemProductoOS').click(function() {

  var selvalidation=parseInt(document.getElementById("gos_producto_id").value);
  if (selvalidation>0) {

    $("#smallvalprod").hide();
   validacionDatosOS();

  setTimeout(function () {
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#OS_ItemsProductos_form').serializeArray(),
        url : app_url+'/ordenes-servicio-items',
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
            calctotalInit();
            $("#btnAbrirInventario").show();
        }
    });
    }, 1000);
  }
  else {
      $("#smallvalprod").show();
  }
});

$('#dt-etapas-os').on('click', 'tbody td', function(e) {
    if ($(this).index() < 6) {
        editor.bubble(this);
    }
});

/* BORRAR ITEM */
$('body').on('click','#btn-borrar-item-os',function() {
    var id = $(this).data('id');
    $.ajax({
        type : 'DELETE',
        url : app_url+'/ordenes-servicio-items/'+ id,
        success : function(data) {
            $('#dt-lista-items-os').DataTable().ajax.reload();
            $('#dt-lista-producto-os').DataTable().ajax.reload();
            $('#dt-Servicios').DataTable().ajax.reload();
        },
        error : function(data) {
            console.log('Error:', data);
        }
    });
});

function calctotalInit(){
  setTimeout(function () {
        var subtotal=0; var imp=0; var total=0;var anticipo =0;
        var iva=parseFloat(document.getElementById('iva_taller').value);
          if (isNaN(iva)) Subtotal = 0;
        var descuento=parseFloat(document.getElementById('descuentoedt2').value);
          if (isNaN(descuento)) Subtotal = 0;
          var tableAnticipo = document.getElementById('dt-lista-anticipos');
          var tableAnticipolength = document.getElementById("dt-lista-anticipos").rows.length;
          for (var e = 0; e < tableAnticipolength -1 ; e++) {
            var ImporteAnticipo=parseFloat((tableAnticipo.children[1].children[e].children[1].innerHTML));
            anticipo=anticipo+ImporteAnticipo;
            console.log(anticipo);
          }
          var table = document.getElementById('dt_lista_items_os_body');
        var tablelength = document.getElementById("dt_lista_items_os_body").rows.length;
        for (var i = 0; i < tablelength; i++) {
          var Importe=parseFloat((table.children[i].children[9].innerHTML));
          subtotal=subtotal+Importe;
        }
        if (descuento > 0) {
            descuento = (subtotal * descuento) / 100;
            subtotal2 = subtotal - descuento;
        }
        else {subtotal2=subtotal;}
        iva = (subtotal2 * iva) / 100;
        var total = subtotal2 + iva  ;
        subtotal=subtotal.toFixed(2);
        subtotal2=subtotal2.toFixed(2) ;
        $("#importeAnticipo").val(anticipo);
        $("#porPagasAnticipo").val(total-anticipo);

        total=total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        document.getElementById('importeTotal').value=subtotal;
        document.getElementById('subtotal').value=subtotal2;
        document.getElementById('total').value=total;
     }, 2500);
}

function cacltotal() {
  var subtotal2=0; var total=0;
  var subtotal2=parseFloat(document.getElementById('importeTotal').value);
  if (isNaN(subtotal2)) subtotal2 = 0;
  console.log(subtotal2);
  var iva=parseFloat(document.getElementById('iva_taller').value);
  if (isNaN(iva)) iva = 0;
  var descuento=parseFloat(document.getElementById('descuentoedt2').value);
  if (isNaN(descuento)) descuento = 0;
  var desctip=document.getElementById('descuento_tipo').value
    console.log(desctip);
  if (desctip=="PESOS"){
      subtotal2=subtotal2-descuento;
        subtotal2=subtotal2
      document.getElementById('subtotal').value=subtotal2;
  }
  else{
    if (descuento => 0) {
        descuento = (subtotal2 * descuento) / 100;
        subtotal2 = subtotal2 - descuento;
          subtotal2=subtotal2
        document.getElementById('subtotal').value=subtotal2;
    }
  }
  iva = (subtotal2 * iva) / 100;
  total = subtotal2 + iva;
  subtotal2=subtotal2.toFixed(2);
  iva=iva.toFixed(2);
  document.getElementById('ivaedt2').value=iva;
  document.getElementById('subtotal').value=subtotal2;
  total=total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  document.getElementById('total').value=total;

}

  function validacionDatosOS(){


    //var regex_letras = /^([a-zA-Z ])*$/;
    var regex_numeros = /^([0-9.])*$/;
    var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;
    var $errores = 0

    if($('#nomb_cliente').val().trim() == ''){
      $('.nomb_cliente').text('Campo obligatorio');
      $errores++;
    } else {
      $('.nomb_cliente').text('');
      if($errores > 0){$errores-1;}
    };

    if($('#gos_aseguradora_id').val().trim() == ''){
      $('.gos_aseguradora_id').text('Campo obligatorio');
      $errores++;
    } else {
      $('.gos_aseguradora_id').text('');
      if($errores > 0){$errores-1;}
    };
    if($('#gos_os_riesgo_id').val().trim() == ''){
      $('.gos_os_riesgo_id').text('Campo obligatorio');
      $errores++;
    } else {
      $('.gos_os_riesgo_id').text('');
      if($errores > 0){$errores-1;}
    };

    if($('#nro_reporte').val().trim() == '' || !regex_alfanumerico.test($('#nro_reporte').val())){
      if($('#nro_reporte').val().trim() == ''){
        $('.nro_reporte').text('Campo obligatorio');
      }else{
        $('.nro_reporte').text('');
        $('.nro_reporte').text('Campo alfanumerico');
      }
      $errores++;
    } else {
      $(this).focus(function(){
        $('.nro_reporte').text('');
        if($errores > 0){$errores-1;}
      });
    }
    if($('#gos_os_tipo_o_id').val().trim() == ''){
      $('.gos_os_tipo_o_id').text('Campo obligatorio');
      $errores++;
    } else {
      $('.gos_os_tipo_o_id').text('');
      if($errores > 0){$errores-1;}
    };

    if($('#gos_os_tipo_danio_id').val().trim() == ''){
      $('.gos_os_tipo_danio_id').text('Campo obligatorio');
      $errores++;
    } else {
      $('.gos_os_tipo_danio_id').text('');
      if($errores > 0){$errores-1;}
    };

    if($('#gos_os_estado_exp_id').val().trim() == ''){
      $('.gos_os_estado_exp_id').text('Campo obligatorio');
      $errores++;
    } else {
      $('.gos_os_estado_exp_id').text('');
      if($errores > 0){$errores-1;}
    };

    // if(!regex_numeros.test($('#descuento').val()) && $('#descuento').val().length > 0){
    // 	$('.descuento').text('Campo numerico');
    // 	$errores++;
    // } else {
    // 	$('.descuento').text('');
    // 	if($errores > 0){$errores-1;}
    // };

    // if(!regex_numeros.test($('#iva').val()) && $('#iva').val().length > 0){
    // 	$('.iva').text('Campo numerico');
    // 	$errores++;
    // } else {
    // 	$('.iva').text('');
    // 	if($errores > 0){$errores-1;}
    // };
    $('#add-item-etapa').removeAttr('href');
    $('#add-item-paquete').removeAttr('href');
    $('#add-item-producto').removeAttr('href');
    if($errores != 0){
      event.preventDefault();
    } else {

      guardarOS();
      $('#add-item-etapa').removeAttr('href');
      $('#add-item-paquete').removeAttr('href');
      $('#add-item-producto').removeAttr('href');
      $('#add-item-etapa').attr('href','#collapseEtapa');
      $('#add-item-paquete').attr('href','#collapsePaquete');
      $('#add-item-producto').attr('href','#collapseProducto');
    }
  };

  function guardarOS(){
    calctotalInit();
    var id=document.getElementById('gos_os_id');
    var valorid = id.value;
    if(valorid == ''){
      var datosForm1=$('#OS_Cliente_form').serializeArray();
      var datosForm6=$('#OS_Cierre_form').serializeArray();
      var datosForm5=$('#OS_Anticipo_form').serializeArray();
      datosForm1=datosForm1.concat(datosForm5);
      datosForm1=datosForm1.concat(datosForm6);
      $.ajax({
        contenttype : 'application/json; charset=utf-8',
        data: datosForm1,
        url : app_url+'/ordenes-servicio',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
          if (console && console.log) {
            console.log('La solicitud a fallado: '+ textStatus);
            console.log('La solicitud a fallado: '+ errorThrown);
            }
          },
        success : function(data) {
          $('#gos_os_id').val(data.gos_os_id);
          $('#gos_os_id_EtapaItem').val(data.gos_os_id);
          $('#gos_os_id_PaqueteItem').val(data.gos_os_id);
          $('#gos_os_id_ProductoItem').val(data.gos_os_id);
          $('#gos_os_id_anticipo').val(data.gos_os_id);

          generaInventario();

          $('.nomb_cliente').text('');
          $('.gos_aseguradora_id').text('');
          $('.gos_ot_id').text('');
          $('.nro_poliza').text('');
          $('.nro_siniestro').text('');
          $('.gos_os_riesgo_id').text('');
          $('.nro_reporte').text('');
          $('.nro_orden_interno').text('');
          $('.gos_os_tipo_o_id').text('');
          $('.gos_os_tipo_danio_id').text('');
          $('.gos_os_estado_exp_id').text('');
          $('.demerito').text('');
          $('.deducible').text('');
        }
      });
    }
    else{
      var datosForm1=$('#OS_Cliente_form').serializeArray();
      var datosForm6=$('#OS_Cierre_form').serializeArray();
      var datosForm5=$('#OS_Anticipo_form').serializeArray();
      datosForm1=datosForm1.concat(datosForm5);
      datosForm1=datosForm1.concat(datosForm6);
      $.ajax({
        contenttype : 'application/json; charset=utf-8',
        data: datosForm1,
        url : app_url+'/ordenes-servicio',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
          if (console && console.log) {
            console.log('La solicitud a fallado: '+ textStatus);
            console.log('La solicitud a fallado: '+ errorThrown);
            }
          },
        success : function(data) {


          $('.nomb_cliente').text('');
          $('.gos_aseguradora_id').text('');
          $('.gos_ot_id').text('');
          $('.nro_poliza').text('');
          $('.nro_siniestro').text('');
          $('.gos_os_riesgo_id').text('');
          $('.nro_reporte').text('');
          $('.nro_orden_interno').text('');
          $('.gos_os_tipo_o_id').text('');
          $('.gos_os_tipo_danio_id').text('');
          $('.gos_os_estado_exp_id').text('');
          $('.demerito').text('');
          $('.deducible').text('');
        }
      });
    }
  };

  function generaInventario() {
		if($('#gos_vehiculo_inventario_id').val()==''){
			$.ajax({
				data: $('#OS_Cliente_form').serializeArray(),
				url : app_url+'/generarIdInventario',
				type : "POST",
				done : function(response) {console.log(response);},
				success : function(data) {
					$('#gos_vehiculo_inventario_id').val(data.gos_vehiculo_inventario_id);
				}
			});
		}
	}
