@extends( 'Layout' )
@section( 'Content' )

<title>Orden de servicio</title>

<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title" id="TitleOrden">Nota de Remisión</h3>
    </div>
  </div>
  <div class="kt-portlet__body p-1">
    <form class="" id="form-nuevanota" action="" method="post">
        @csrf
            <div class="container-fluid m-2"><!---------------------CLIENTES BEGIN---------------------->
                <div class="row">
                    <div class="col">
                            <div class="form-row">
                                <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                                    <label >Cliente</label>
                                    <input type="hidden" class="form-control" id="gos_os_id" name="gos_os_id" value="">
                                    <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" value="">
                                
                                </div>
                                <div class="form-group col-6 col-md-3  mb-3">
                                    <label >Vehículo</label>
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="">
                                </div>
                                    <!-- 
                                <div class="form-group col-6 col-md-2  mb-3">
                                    <label >Asegurado</label>          
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="">
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label >TOT</label>
                                    <input type="text" class="form-control" id="tot" name="tot" value="">
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label ># Póliza</label>
                                    <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="">
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label  class="text-truncate"># Siniestro</label>
                                    <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="">
                                </div>
                                <div style="text-align: -webkit-center;" class="form-group col-6 col-md-2  mb-3">
                                    <label  style="text-align: center;">Riesgo</label>
                                    <input type="text" class="form-control" name="nomb_riesgo" id="nomb_riesgo" value="">

                                
                                </div> -->
                            </div>
                        <!-- COMIENZO SEGUNDA FILA  -->
                            <!-- <div class="form-row">
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  pl-2 mb-0">
                                    <label >Reporte</label>
                                    <input type="text" class="form-control" name="nro_reporte" id="nro_reporte" value="">
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  mb-0">
                                    <label >Orden</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="">
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-3 col-lg-2  mb-0">
                                    <label >Tipo de Orden</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="">
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2 mb-0">
                                    <label >Daño</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="">
                    
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Estatus</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="">
                    
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Demérito</label>
                                    <input type="text" class="form-control" name="demerito" id="demerito" value="">
                
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Deducible</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="">
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2  mb-0">
                                    <label style="text-align: center;">Condiciones especiales</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="">
        
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Ingreso Grúa</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="">
            
                                </div> -->
                            </div>
                    </div>
                </div><!---------------------CLIENTES END---------------------->
            </div>
            <div class="container-fluid m-2"><!-----------------------------Agregar ITems------------------------------------>
            <div class="border-top">
              <ul class="nav nav-pills my-4">
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-etapa"> {{-- href="#collapseEtapa" --}}
                    <i class="fas fa-plus"></i>Etapa
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-paquete"> {{-- href="#collapsePaquete" --}}
                    <i class="fas fa-plus"></i>Paquete
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-producto"> {{-- href="#collapseProducto" --}}
                    <i class="fas fa-plus"></i>Producto
                  </a>
                </li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane" id="collapseEtapa" role="tabpanel">
                  <input type="hidden" name="Etapas"  id="etapasCadid"value="">
                  <input type="hidden" name="EtapasSer"  id="etapasSerid"value="">
                    <div class="form-row">
                      <div class="form-group col-6 col-sm-4 col-md-2">
                        <label>Etapa</label>
                        <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="gos_paq_etapa_id" id="gos_paq_etapa_id" >
                          <option value="0"></option>
                          @foreach ($listaEtapas as $etapa)
                          <option value="{{$etapa->gos_paq_etapa_id}}"> {{$etapa->nomb_etapa}}</option>
                          @endforeach
                        </select>
                      <small style="font-style: italic; display: none;" id="smallvaletapa" class=" form-text text-danger">Campo obligatorio</small>
                      </div>
                      <div class="form-group col-6 col-sm-4 col-md-2">
                        <label>Servicio</label>
                        <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="gos_paq_servicio_id" id="gos_paq_servicio_id" >
                            <option value="0"></option>
                          @foreach ($listaServicios as $servicio)
                          <option value="{{$servicio->gos_paq_servicio_id}}"> {{$servicio->nomb_servicio}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-1 align-self-end">
                          <button type="button" id="btn_ItemEtapaOS" class="btn btn-success" style="height:40px;" onclick="AgregarEtapa();">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                      </div>
                    </div>
                </div>
                <div class="tab-pane" id="collapsePaquete" role="tabpanel">
                    <input type="hidden" name="Paquetes"  id="paquetesCadid"value="">
                    <div class="form-row">
                      <div class="form-group col-6 col-sm-3">
                        <label>Paquete</label>
                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paquete_id" id="gos_paquete_id">
                            <option value="0"></option>
                          @foreach ($listaPaquetes as $paquete)
                          <option value="{{$paquete->gos_paquete_id}}">{{$paquete->nomb_paquete}}</option>
                          @endforeach
                        </select>
                        <small style="font-style: italic; display: none;" id="smallvalpaquete" class=" form-text text-danger">Campo obligatorio</small>
                      </div>
                      <div class="form-group col-1 col-sm-1 align-self-end">
                          <button type="button" id="btn_ItemPaqueteOS" class="btn btn-success" style="height:40px;" onclick="AgregarPaquete();">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                      </div>
                    </div>
                </div>
                <div class="tab-pane " id="collapseProducto" role="tabpanel">
                    <input type="hidden" name="Productos" id="productosCadid" value="">
                    <input type="hidden" name="ProductosCant" id="productosCantidadCadid" value="">
                    <div class="form-row">
                      <div class="form-group col-6 col-sm-3">
                        <label>Código</label>
                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_producto_id" id="gos_producto_id" >
                            <option value="0"></option>
                            @foreach ($listaProductos as $producto)
                            <option value="{{$producto->gos_producto_id}}">{{$producto->codigo}}</option>
                            @endforeach
                        </select>
                      <small style="font-style: italic; display: none;" id="smallvalprod" class=" form-text text-danger">Campo obligatorio</small>
                      </div>
                      <div class="form-group col-5 col-sm-2">
                        <label>Cantidad</label>
                        <input type="text" class="form-control pl-1 pr-0" name="gos_producto_cantidad" id="gos_producto_cantidadid"  value="1">
                      </div>

                      <div class="form-group col-1 align-self-end">
                          <button type="button" id="btn_ItemProductoOS" class="btn btn-success" style="height:40px;" onclick="AgregarProducto();">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
     </div>
            <div class="container-fluid m-2"><!-----------------------DataTables -------------------------------------------->
                <div class="table-responsive table-sm p-1">
                    <table class="table table-sm table-hover my-4" id="dt-lista-items-os" style="font-size: 1rem;">
                        <thead class="thead-light">
                            <tr style="font-weight: 500;">
                            <th>ID</th>

                            <th>Etapa</th>
                            <th>Descripción</th>
                            <th>Servicio</th>

                            <th>Asesor</th>
                            <th>Precio</th>
                            <th>Materiales</th>
                            <th>Importe</th>
                            <th style="width:3%;"></th>
                            </tr>
                        </thead>
                        <tbody id="dt_lista_items_os_body">
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid m-2">
                <div class="row">
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="" >Forma de Pago</label>
                        <select class="custom-select" name="gos_forma_pago_id" id="gos_forma_pago_id" required>
                        <option></option>
                            <option value="1">Contado</option>
                            <option value="2">Credito</option>
                        </select>
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label >Fecha de Nota</label>
                        <input type="text" class="form-control" name="fecha_nota" id="fecha_nota" value="<?=  date("Y-m-d H:i:s")?>" readonly>
               
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="text-nowrap">Tipo de pago</label>
                    <select class="custom-select" name="gos_metodo_pago_id" id="gos_metodo_pago_id" required>
                        <option></option>
                     
                    </select>
                    </div>
                   
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 credito" style="display:none;">
                        <label >Fecha de Abono</label>
                        <input type="date" class="form-control" name="fecha_abono" id="fecha_abono" >
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 credito" style="display:none;">
                        <label >Abono</label>
                        <input type="text" class="form-control" name="abono" id="abono" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                    <div class=" form-row col-md-4 float-right">
                            <div class=" row  col-sm-12 ">
                                <label class="col-4 col-form-label text-right" >Importe</label>
                                <div class="col-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="importeTotal" id="importeTotal" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row  col-sm-12">
                                <label class="col-4 col-form-label text-right" >Descuento</label>
                                <div class="col-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text btnCambioPorciento" id="descpor" >%</button>

                                        </div>
                                        <input type="hidden" id="descuento_tipo" name="descuento_tipo" value="%" >
                                        <input type="text" name="descuentoe" id="descuentoedt2" value="0" class="form-control" onkeyup="CalcTotal()">
                                    </div>
                                </div>

                            </div>
                            <div class="row  col-sm-12">
                                <label class="col-4 col-form-label text-right" >Sub-Total</label>
                                <div class="col-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="subtotal" id="subtotal" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row  col-sm-12">
                                <label class="col-4 col-form-label text-right" >Total</label>
                                <div class="col-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="total" id="total" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row  col-sm-12 ">
                                <div class="col-8 col-md-8 offset-sm-12 offset-4">
                                        <button type="button"  id="finalizarnota" class="btn btn-success w-100" >Guardar</button>
                                </div>
                                <input type="hidden" name="desglose" id="desglose" value="">
                            </div>
                    </div>
                    </div>
            </div>
        </div>
    </form>
  </div>
    

</div>

@endsection

@section('ScriptporPagina')
<script>
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
            $('#dt_lista_items_os_body').append('<tr><td>'+data.gos_producto_id+'</td><td>'+data.nomb_producto+'</td><td>'+data.descripcion+'</td><td>'+data.codigo_sat+'</td><td>'+Cantidad+'</td><td>'+data.venta+'</td><td>0</td><td>'+Importe+'</td></tr>');
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


// function CalcTotal(){
//     var Importe=0; var Subtotal=0; var total=0; var Iva=0; var desc=0;
//   var tableEta = document.getElementById('dt_lista_items_os_body');
//   var tableEtalength = document.getElementById("dt_lista_items_os_body").rows.length;

//   var tableProd = document.getElementById('dt_lista_producto_os_body');
//   var tableProdlength = document.getElementById("dt_lista_producto_os_body").rows.length;

//   for (var i = 0; i < tableEtalength; i++) {
//     var rowimp=parseFloat((tableEta.children[i].children[7].innerHTML));
//       Importe=Importe+rowimp;
//   }
//   for (var i = 0; i < tableProdlength; i++) {
//     var rowimp=parseFloat((tableProd.children[i].children[7].innerHTML));
//       Importe=Importe+rowimp;
//   }
//   var Descuento = parseFloat(document.getElementById("descuentoedt2").value);
//   if (isNaN(Descuento)) Descuento = 0;
//   var Iva = parseFloat(document.getElementById("ivaedt2").value);
//   if (isNaN(Iva)) Iva = 0;

//   if (Descuento > 0) {

//         var tipoD =document.getElementById("descuento_tipo").value;
//         if (tipoD=="%") {
//           Subtotal=Importe;
//           Descuento = (Subtotal * Descuento) / 100;
//           Subtotal = Subtotal - Descuento;
//          }
//         if (tipoD=="$") {
//               Subtotal = Importe - Descuento;
//          }


//   }
//   else {
//     Subtotal=Importe
//   }
//   Iva = (Subtotal * Iva) / 100;
//   total = Subtotal + Iva;
//   document.getElementById("importeTotal").value = Importe;
//   document.getElementById("subtotal").value = Subtotal;
//   document.getElementById("total").value = total;
// }

</script>
@endsection
