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
    <form class="" action="/gestion-factura/agregar/NotaRemision" method="post">
        @csrf
            <div class="container-fluid m-2"><!---------------------CLIENTES BEGIN---------------------->
                <div class="row">
                    <div class="col">
                            <div class="form-row">
                                <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                                    <label >Cliente</label>
                                    <input type="hidden" class="form-control" id="gos_os_id" name="gos_os_id" value="@if(isset($os)) {{$os[0]->gos_os_id }} @endif">
                                    <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" value="@if(isset($os)) {{$os[0]->nomb_cliente }} @endif" disabled>
                                
                                </div>
                                <div class="form-group col-6 col-md-3  mb-3">
                                    <label >Vehículo</label>
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="@if(isset($os)) {{$os[0]->detallesVehiculo }} @endif" disabled>
                                </div>

                                <div class="form-group col-6 col-md-2  mb-3">
                                    <label >Asegurado</label>          
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="@if(isset($os)) {{$os[0]->empresa }} @endif" disabled>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label >TOT</label>
                                    <input type="text" class="form-control" id="tot" name="tot" value="@if(isset($os)) {{$os[0]->detallesVehiculo }} @endif" disabled>
                                <small style="font-style: italic; display: none;" id="smallTOT" class=" form-text text-danger">Campo obligatorio</small>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label ># Póliza</label>
                                    <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="@if(isset($os)) {{$os[0]->nro_poliza }} @endif" disabled>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label  class="text-truncate"># Siniestro</label>
                                    <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="@if(isset($os)) {{$os[0]->nro_siniestro }} @endif" disabled>
                                </div>
                                <div style="text-align: -webkit-center;" class="form-group col-6 col-md-2  mb-3">
                                    <label  style="text-align: center;">Riesgo</label>
                                    <input type="text" class="form-control" name="nomb_riesgo" id="nomb_riesgo" value="@if(isset($os)) {{$os[0]->nomb_riesgo }} @endif" disabled>

                                
                                </div>
                            </div>
                        <!-- COMIENZO SEGUNDA FILA  -->
                            <div class="form-row">
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  pl-2 mb-0">
                                    <label >Reporte</label>
                                    <input type="text" class="form-control" name="nro_reporte" id="nro_reporte" value="@if(isset($os)) {{$os[0]->nro_reporte }} @endif" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  mb-0">
                                    <label >Orden</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="@if(isset($os)) {{$os[0]->nro_orden }} @endif" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-3 col-lg-2  mb-0">
                                    <label >Tipo de Orden</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="@if(isset($os)) {{$os[0]->tipo_orden }} @endif" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2 mb-0">
                                    <label >Daño</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="@if(isset($os)) {{$os[0]->tipo_danio }} @endif" disabled>
                    
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Estatus</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="@if(isset($os)) {{$os[0]->estado_expediente }} @endif" disabled>
                    
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Demérito</label>
                                    <input type="text" class="form-control" name="demerito" id="demerito" value="@if(isset($os)) {{$os[0]->demerito }} @endif" disabled>
                
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Deducible</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="@if(isset($os)) {{$os[0]->deducible }} @endif" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2  mb-0">
                                    <label style="text-align: center;">Condiciones especiales</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="@if(isset($os)) {{$os[0]->con_especiales }} @endif" disabled>
        
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Ingreso Grúa</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="@if(isset($os)) {{$os[0]->ing_grua }} @endif" disabled>
            
                                </div>
                            </div>
                    </div>
                </div><!---------------------CLIENTES END---------------------->
            </div>
            
            <div class="container-fluid m-2"><!-----------------------DataTables -------------------------------------------->
                <div class="table-responsive table-sm p-1">
                    <table class="table table-sm table-hover my-4" id="dt-lista-items-os" style="font-size: 1rem;">
                        <thead class="thead-light">
                            <tr style="font-weight: 500;">
                                <th>Etapa</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody id="dt_lista_items_os_body">
                            @foreach($nota as $key => $producto)
                            <tr>
                                <td style="text-align:center;">{{$producto->concepto}}</td>
                                <td style="text-align:center;">{{$producto->precio}}</td>
                                <td style="text-align:center;">{{$producto->cantidad}}</td>
                                <td style="text-align:center;">{{$producto->descuento}}</td>
                                <td style="text-align:center;">{{$producto->precio-$producto->descuento}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid m-2">
                <div class="row">
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="" >Forma de Pago</label>
                        <input type="text" class="form-control" value="{{$nota[0]->nomb_forma_pago}}" disabled>

                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label >Fecha de Nota</label>
                        <input type="text" class="form-control" value="{{$nota[0]->fecha_nota}}" disabled>
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="text-nowrap">Tipo de pago</label>
                        <input type="text" class="form-control" value="{{$nota[0]->nomb_met_pago}}" disabled>
                    </div>
                   
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 credito" >
                        <label >Fecha de Abono</label>
                        <input type="date" class="form-control" value="{{$nota[0]->fecha_abono}}" disabled>
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 credito" >
                        <label >Abono</label>
                        <input type="text" class="form-control" value="{{$nota[0]->abono}}" disabled>
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
                                        <input type="text" name="descuentoe" id="descuentoedt2" value="0" class="form-control" disabled>
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
                                        <input type="text" name="subtotal" id="subtotal" class="form-control" value="" disabled>
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
                                        <input type="text" name="total" id="total" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row  col-sm-12 ">
                                <div class="col-8 col-md-8 offset-sm-12 offset-4">
                                        <a href="/gestion-facturas"  class="btn btn-success w-100" >Regresar</a>
                                </div>
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
<script  >
    $(document).ready(function(){
        CalcTotal();
    });
   
 
function CalcTotal(){
    var Importe=0; var Subtotal=0; var total=0; var Iva=0; var desc=0;
    var tableEta = $('#dt-lista-items-os');
    var tableEtalength = document.getElementById("dt-lista-items-os").rows.length;
    for (var i =1 ; i < tableEtalength; i++) {
        var rowimp=parseFloat((tableEta[0].rows[i].cells[4].innerText));
        Importe=Importe+rowimp;
    }
  var Descuento = parseFloat(document.getElementById("descuentoedt2").value);
  if (isNaN(Descuento)) Descuento = 0;
  if (Descuento > 0) {
          Subtotal=Importe;
          Descuento = (Subtotal * Descuento) / 100;
          Subtotal = Subtotal - Descuento;

  }
  else {
    Subtotal=Importe
  }
 
  total = Subtotal;
  document.getElementById("importeTotal").value = Importe;
  document.getElementById("subtotal").value = Subtotal;
  document.getElementById("total").value = total;
}

</script>
@endsection