$( document ).ready(function() {
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

    console.log( "ajax-os-agregarosmx-ready!" );
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
        CalcTotal();
});


//_________________________DTableCLientes_________________________________
$('#anticipo').change(function() {
  var valor = $(this).val(); //Get value from select element
  if(valor=="si"){ //Compare it and if true
    //  $('#modalanticipos').removeAttr("style");
      $('#modalanticipos').modal('show');
  } else {
      $('#modalanticipos').modal('hide');
    //  $('#modalanticipos').attr("style","display:none;");
  }
});



function AgregarEtapa(){
  var osid=document.getElementById('osid').value;
  var etapaid=document.getElementById('gos_paq_etapa_id').value;
  if (etapaid=="") {alert("Seleccione la etapa");}
  else {
        var serid=document.getElementById('gos_paq_servicio_id').value;
        if (serid=="") {serid=0;}
        var total=document.getElementById('gos_etapa_total').value;
        if (total=="") {total=0;}
        var mo=document.getElementById('gos_etapa_MO').value;
        if (mo=="") {mo=0;}
        var urlget='/ordenes-serv/'+osid+'/masetapa/'+etapaid+'/'+serid+'/'+total+'/'+mo;
      window.location.replace(urlget);
  }
}

function AgregarPaquete() {
  var osid=document.getElementById('osid').value;
  var paqid=document.getElementById('gos_paquete_id').value;
  if (paqid=="") {alert("Seleccione la etapa");}
  else {
    var urlget='/ordenes-serv/'+osid+'/maspaq/'+paqid;
      window.location.replace(urlget);
  }

}

function AgregarProducto() {
  var osid=document.getElementById('osid').value;
  var proid=document.getElementById('gos_producto_id').value;
  if (proid=="") {alert("Seleccione el producto");}
  else {
    var cant=document.getElementById('gos_producto_cantidad').value;
    if (cant=="") {cant=0;}
    var precio=document.getElementById('gos_producto_venta').value;
    if (precio=="") {precio=0;}
    var urlget='/ordenes-serv/'+osid+'/masprod/'+proid+'/'+cant+'/'+precio;
      window.location.replace(urlget);
  }
}


function CalcTotal(){
    var Importe=0; var Subtotal=0; var total=0; var Iva=0; var desc=0;
  Importe=parseFloat(document.getElementById("importeTotal").value);
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

function modalasesor(id){
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
 $('#selectecnico').val(0);
 $('#selectecnico').selectpicker('refresh');
  var osid=document.getElementById('osid').value;
    window.location.replace('/ordenes-serv/'+osid+'/editar');
});
