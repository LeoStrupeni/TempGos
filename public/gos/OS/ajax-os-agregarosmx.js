$( document ).ready(function() {
    console.log( "ajax-os-agregarosmx-ready!" );
});
$('#add-item-etapa').click(function() {
$('#add-item-etapa').attr('href','#collapseEtapa');
$('#add-item-paquete').removeAttr('href');
$('#add-item-producto').removeAttr('href');
});
$('#add-item-paquete').click(function() {
$('#add-item-paquete').attr('href','#collapsePaquete');
$('#add-item-etapa').removeAttr('href');

$('#add-item-producto').removeAttr('href');
});
$('#add-item-producto').click(function() {
$('#add-item-producto').removeAttr('href');
$('#add-item-paquete').attr('href','#collapsePaquete');
$('#add-item-producto').attr('href','#collapseProducto');
});


//__________________________________________________________________________DT CLIENTE VEHICULO Begin____________________
$('#dt-clientes-vehiculos').DataTable({
  responsive: true,
  searchDelay: 500,
  processing: true,
  ajax: '/lista-clientes-vehiculos',
  columns: [
  {data: 'nomb_cliente'},
  {data: 'vehiculo'},
  {data: 'economico'},
  {data: 'nro_serie'}, // nro_serie ACA VA EL NUMERO DE SERIE, NO VIENE EN LA VISTA QUE CONSULTA
  {data: 'gos_vehiculo_id',"visible": false,"searchable": false},
  {data: 'gos_cliente_id',"visible": false,"searchable": false},
  {defaultContent:`<button type="button" class="btn btn-success btn-seleccionar">Seleccionar</button>`}
  ],
  language : {'url' : '/gos/Spanish.json'}
});

$('#dt-clientes-vehiculos tbody').on('click', '.btn-seleccionar', function (){
    var table = $('#dt-clientes-vehiculos').DataTable();
    var data = table.row( $(this).parents('tr') ).data();
    var nomb_cliente=data['nomb_cliente'];
    var detallesVehiculo=data['vehiculo'];
    $("#nomb_cliente").val(nomb_cliente);
    $("#detallesVehiculo").val(detallesVehiculo)
    $("#gos_vehiculo_id").val(data['gos_vehiculo_id'])
    $("#gos_cliente_id").val(data['gos_cliente_id'])
    $('#modalbuscarcliente').modal('hide');
    $("#btn-buscarcliente").attr("style","display:none;") ;
    $('#cls-buscarcliente').removeAttr("style");
});
//_________________________________________________________________DT cliene Vehiculo End________________________________
//__________________________________________________________________Anticipos BEGIN____________________________________________
$('#anticipo').change(function() {
  var valor = $(this).val(); //Get value from select element
  if(valor=="si"){ //Compare it and if true
      $('#mostrarAnticipos').removeAttr("style");
  } else {
  $('#mostrarAnticipos').attr("style","display:none;");
  }
});
//__________________________________________________________________Anticipos End____________________________________________

var cadEtapas="";
var cadPaquete="";
var cadProducto="";

function AgregarEtapa(){
  var idetapa=parseInt(document.getElementById('gos_paq_etapa_id').value);
  if (idetapa>0) {

     var serid=parseInt(document.getElementById('gos_paq_servicio_id').value);
       if (isNaN(serid)) serid = "";
     var e = document.getElementById("gos_paq_servicio_id");
     var value = e.options[e.selectedIndex].value;
     var sername = e.options[e.selectedIndex].text;
     var asesor=document.getElementById('asesor_asignado').value
     $('#smallvaletapa').hide();
  var req="";
  $.ajax({
      type: 'get',
      url: '/ordenes-serv/'+idetapa+'/getetapa',
      success: function(data) {
          //console.log(data);
          $('#dt_lista_items_os_body').append('<tr><td>'+data.orden_etapa+'</td><td>'+data.nomb_etapa+'</td><td>'+data.descripcion_etapa+'</td><td>'+sername+'</td><td></td><td>'+asesor+'</td><td>0</td><td>0</td></tr>');
          var EtapasETa=document.getElementById('etapasSerid').value
          var EtapasSer=document.getElementById('etapasCadid').value
          var EtapasETa=EtapasETa+idetapa+",";
          var EtapasSer=EtapasSer+idetapa+",";
         document.getElementById('etapasCadid').value=EtapasETa;
          document.getElementById('etapasSerid').value=EtapasSer;
          CalcTotal();
          document.getElementById("gos_paq_etapa_id").value = 0;
          document.getElementById("gos_paq_servicio_id").value = 0;
          $('#gos_paq_etapa_id').selectpicker('refresh');
          $('#gos_paq_servicio_id').selectpicker('refresh');
      }
  });
    }else{
    $('#smallvaletapa').show();
  }
}

function AgregarPaquete(){
  var idpaq=parseInt(document.getElementById('gos_paquete_id').value);

  if (idpaq>0) {
     $('#smallvalpaquete').hide();
  var req="";
  $.ajax({
      type: 'get',
      url: '/ordenes-serv/'+idpaq+'/getpaquete',
      success: function(data) {
          //console.log(data);
          for (var i = 0; i < data.length; i++) {

           if(data[i].asesor==null){data[i].asesor=" ";}
            if(data[i].servicio==null){data[i].servicio=" ";}
           var mat=parseFloat(data[i].precio_materiales);
           var peta=parseFloat(data[i].precio_etapa);
           var total=peta+mat;
           $('#dt_lista_items_os_body').append('<tr><td>'+data[i].orden_etapa+'</td><td>'+data[i].etapa+'</td><td>'+data[i].descetapa+'</td><td>'+data[i].servicio+'</td><td>'+data[i].asesor+'</td><td>'+data[i].precio_etapa+'</td><td>'+data[i].precio_materiales+'</td><td>'+total+'</td></tr>');
           var EtapasPaq=document.getElementById('paquetesCadid').value
           var EtapasPaq=EtapasPaq+data[i].gos_paquete_item_id+",";
           document.getElementById('paquetesCadid').value=EtapasPaq;
             CalcTotal();
             document.getElementById("gos_paquete_id").value = 0;
               $('#gos_paquete_id').selectpicker('refresh');
            }
      }
     });
     }else{
    $('#smallvalpaquete').show();
  }
}

function AgregarProducto(){

  var idprod=parseInt(document.getElementById('gos_producto_id').value);
 if (idprod>0) {
    $('#smallvalprod').hide();
  var Cantidad=parseFloat(document.getElementById('gos_producto_cantidadid').value);
  if (isNaN(Cantidad)) Cantidad = 0;
  var Importe=Cantidad;
    var req="";
    $.ajax({
        type: 'get',
        url: '/ordenes-serv/'+idprod+'/getproducto',
        success: function(data) {
            var Importe=Cantidad*data.venta;
            $('#dt_lista_producto_os_body').append('<tr><td>'+data.gos_producto_id+'</td><td>'+data.nomb_producto+'</td><td>'+data.descripcion+'</td><td>'+data.codigo_sat+'</td><td>'+Cantidad+'</td><td>'+data.venta+'</td><td>0</td><td>'+Importe+'</td></tr>');
              var EtapasCantProd=document.getElementById('productosCantidadCadid').value
            var EtapasProd=document.getElementById('productosCadid').value
            var EtapasProd=EtapasProd+idprod+",";
            var EtapasCantProd=EtapasCantProd+Cantidad+",";
            document.getElementById('productosCadid').value=EtapasProd;
            document.getElementById('productosCantidadCadid').value=EtapasCantProd;
              CalcTotal();
            document.getElementById("gos_producto_id").value = 0;
            $('#gos_producto_id').selectpicker('refresh');
        }
    });
   }
   else{
     $('#smallvalprod').show();
   }

}


function CalcTotal(){
    var Importe=0; var Subtotal=0; var total=0; var Iva=0; var desc=0;
  var tableEta = document.getElementById('dt_lista_items_os_body');
  var tableEtalength = document.getElementById("dt_lista_items_os_body").rows.length;

  var tableProd = document.getElementById('dt_lista_producto_os_body');
  var tableProdlength = document.getElementById("dt_lista_producto_os_body").rows.length;

  for (var i = 0; i < tableEtalength; i++) {
    var rowimp=parseFloat((tableEta.children[i].children[7].innerHTML));
      Importe=Importe+rowimp;
  }
  for (var i = 0; i < tableProdlength; i++) {
    var rowimp=parseFloat((tableProd.children[i].children[7].innerHTML));
      Importe=Importe+rowimp;
  }
  var Descuento = parseFloat(document.getElementById("descuentoedt2").value);
  if (isNaN(Descuento)) Descuento = 0;
  var Iva = parseFloat(document.getElementById("ivaedt2").value);
  if (isNaN(Iva)) Iva = 0;

  if (Descuento > 0) {

        var tipoD =document.getElementById("descuento_tipo").value;
        if (tipoD=="%") {
          Subtotal=Importe;
          Descuento = (Subtotal * Descuento) / 100;
          Subtotal = Subtotal - Descuento;
         }
        if (tipoD=="$") {
              Subtotal = Importe - Descuento;
         }


  }
  else {
    Subtotal=Importe
  }
  Iva = (Subtotal * Iva) / 100;
  total = Subtotal + Iva;
  document.getElementById("importeTotal").value = Importe;
  document.getElementById("subtotal").value = Subtotal;
  document.getElementById("total").value = total;
}

function changedesc(){
  console.log("change desc");
  var tipo =document.getElementById("descuento_tipo").value;
  if (tipo=="%") {
    document.getElementById("descuento_tipo").value="$";
     $('#descpor').hide();
     $('#descpes').show();
   }
  if (tipo=="$") {
    document.getElementById("descuento_tipo").value="%";
    $('#descpor').show();
    $('#descpes').hide();
   }
   CalcTotal();
}

var FlagVal=0;
var CadErrores="";
  var cliker=0;
function validar(){

  var idAse=parseInt(document.getElementById('gos_aseguradora_id').value);
  var cadprod=document.getElementById('productosCadid').value
    var cadpaq=document.getElementById('paquetesCadid').value
    var cadEta=document.getElementById('etapasCadid').value
    var items=cadprod+cadpaq+cadEta;
    if (items=="") {
      CadErrores=CadErrores+"-Inserte Almenos Una Etapa Paquete O Producto\n";
      FlagVal = FlagVal + 1;
    }
  var Cliente=document.getElementById('gos_cliente_id').value
    if (Cliente == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Seleccione Un cliente \n";
         $('#smallcliente').show();
        } else {

             $('#smallcliente').hide();
    }


    var Estatus=document.getElementById('gos_os_estado_exp_id').value
    if (Estatus == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Seleccione Un Estatus\n";
         $('#smallstatus').show();
    } else {

         $('#smallstatus').hide();
    }
    var Fcreacion=document.getElementById('kt_datetimepicker_1').value
    if (Fcreacion == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Inserte Fecha de Creacion\n";
         $('#smallFC').show();
    } else {

         $('#smallFC').hide();
    }
    var FIngreso=document.getElementById('kt_datetimepicker_2').value
    if (FIngreso == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Inserte Fecha de Ingreso\n";
         $('#smallFI').show();
    } else {

         $('#smallFI').hide();
    }
     var Aseguradora=document.getElementById('gos_aseguradora_id').value
    if (Aseguradora == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Seleccione Una Aseguradora \n";
         $('#smallasegurado').show();
    } else {

         $('#smallasegurado').hide();
    }
    var Riesgo=document.getElementById('gos_os_riesgo_id').value
      if (Riesgo == "") {
        FlagVal = FlagVal + 1;
        CadErrores=CadErrores+"-Seleccione Un Riesgo \n";
         $('#smallriesgo').show();
      } else {

          $('#smallriesgo').hide();
    }
  $.ajax({
    type: 'get',
    url: '/ordenes-serv/'+idAse+'/getvalidaciones',
    success: function(data) {

    console.log(data);

    var reporte=document.getElementById('nro_reporte').value
    if(data.reporte_os == 1){
      if (reporte == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Reporte \n";
          $('#smallreporte').show();
      } else {

          $('#smallreporte').hide();
      }
    }
    var TOTt=document.getElementById('gos_ot_id').value
    if(data.tot_os == 1){
      if (TOTt == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un TOT \n";
          $('#smallTOT').show();
      } else {

          $('#smallTOT').hide();
      }
    }
    var nroPol=document.getElementById('nro_poliza').value
    if(data.poliza_os == 1){
      if (nroPol == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Nro de Póliza \n";
          $('#smallNroPol').show();
      } else {

          $('#smallNroPol').hide();
      }
    }
    var siniestro=document.getElementById('nro_siniestro').value
    if(data.siniestro_os == 1){
      if (siniestro == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Nro de Siniestro \n";
          $('#smallsiniestro').show();
      } else {

          $('#smallsiniestro').hide();
      }
    }
    var orden=document.getElementById('nro_orden_interno').value
    if(data.orden_os == 1){
      if (orden == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Nro de Orden \n";
          $('#smallorden').show();
      } else {

          $('#smallorden').hide();
      }
    }
    var demerito=document.getElementById('demerito').value
    if(data.demerito_os == 1){
      if (demerito == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Demérito \n";
          $('#smalldemerito').show();
      } else {

          $('#smalldemerito').hide();
      }
    }
    var deducible=document.getElementById('deducible').value
    if(data.deducible_os == 1){
      if (deducible == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte Un Deducible \n";
          $('#smalldeducible').show();
      } else {

          $('#smalldeducible').hide();
      }
    }
    var condiciones_os=document.getElementById('Cespeciales').value
    if(data.condiciones_os == 1){
      if (condiciones_os == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte una condición especial \n";
          $('#smallcondiciones').show();
      } else {

          $('#smallcondiciones').hide();
      }
    }
    var grua_os=document.getElementById('IGrua').value
    if(data.grua_os == 1){
      if (grua_os == "") {
          FlagVal = FlagVal + 1;
          CadErrores=CadErrores+"-Inserte una Grua \n";
          $('#smallgrua').show();
      } else {

          $('#smallgrua').hide();
      }
    }
    }
});
if (FlagVal==0) {
   $('#btn_guardardando').show();
   $('#btn_guardar_OSjs').hide();
     document.getElementById("btn_guardar_OSsub").click();
     document.getElementById("btn_guardar_OSsub").disabled = true;
}
if (FlagVal>0) {
  swal.fire('UPS..... Olvidaste llenar algunos campos.',CadErrores,'error'
  )
  CadErrores="";
  FlagVal=0;
}

function triguerguardando(){btn_guardardando
  $('#btn_guardardando').show();
  $('#btn_guardar_OSsub').hide();
   $('#btn_guardar_OSjs').hide();
}

}

function sweetalert(){
  swal.fire('Olvidaste llenar algunos campos.',
  '',
  'error'
  )
}

//____________________________________QUALITAS___________________0
function AgregarPaqueteQualitas(){
var idpaq=parseInt(document.getElementById('gos_paquete_id').value);

  if (idpaq>0) {
     $('#smallvalpaquete').hide();
  var req="";
  $.ajax({
      type: 'get',
      url: '/ordenes-serv/'+idpaq+'/getpaquete',
      success: function(data) {
          //console.log(data);
          for (var i = 0; i < data.length; i++) {

           if(data[i].asesor==null){data[i].asesor=" ";}
            if(data[i].servicio==null){data[i].servicio=" ";}
           var mat=parseFloat(data[i].precio_materiales);
           var peta=parseFloat(data[i].precio_etapa);
           var total=peta+mat;
           $('#dt_lista_items_os_body').append('<tr><td>'+data[i].orden_etapa+'</td><td>'+data[i].etapa+'</td><td>'+data[i].descetapa+'</td><td>'+data[i].servicio+'</td><td>'+data[i].asesor+'</td><td>'+data[i].precio_etapa+'</td><td>'+data[i].precio_materiales+'</td><td>'+total+'</td></tr>');
           var EtapasPaq=document.getElementById('paquetesCadid').value
           var EtapasPaq=EtapasPaq+data[i].gos_paquete_item_id+",";
           document.getElementById('paquetesCadid').value=EtapasPaq;

             document.getElementById("gos_paquete_id").value = 0;
               $('#gos_paquete_id').selectpicker('refresh');
            }
      }
     });
     }else{
    $('#smallvalpaquete').show();
  }
}

function valqualitas(){
  var FlagVal=0; var CadErrores="";
  var cadpaq=document.getElementById('paquetesCadid').value
  if (cadpaq=="") {
    CadErrores=CadErrores+"-Inserte Un Paquete\n";
    FlagVal = FlagVal + 1;
  }
  var Estatus=document.getElementById('gos_os_estado_exp_id').value
  if (Estatus == "") {
      FlagVal = FlagVal + 1;
      CadErrores=CadErrores+"-Seleccione Un Estatus\n";
       $('#smallstatus').show();
  } else {

       $('#smallstatus').hide();
  }

  if (FlagVal>0) {
    swal.fire('UPS..... Olvidaste llenar algunos campos.',CadErrores,'error'
    )
    CadErrores="";
    FlagVal=0;
  }else {
    $('#guardandobtn').show();
    $('#gardarval').hide();
      document.getElementById("guardarOS").click();
      document.getElementById("guardarOS").disabled = true;
  }

 }
