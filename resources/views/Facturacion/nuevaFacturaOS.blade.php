@extends( 'Layout' )
@section( 'Content' )

<title>Orden de servicio</title>
 
<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">			
 
    <div class="kt-portlet__head-label">
   
      <h3 class="kt-portlet__head-title" id="TitleOrden">Nueva Factura</h3>
    </div>
  </div>
  <div class="kt-portlet__body p-1">
  @if (session('alert'))
        <div class="alert alert-danger">
            {{session('alert')}}
        </div> 

    @endif
    <form class="" id="form-submit" action="/gestion-factura/agregar/NuevaFactura" method="post">
        @csrf
            <div class="container-fluid m-2"><!---------------------CLIENTES BEGIN---------------------->
                <div class="row">
                    <div class="col">
                            <div class="form-row">
                                <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                                    <label >Cliente</label>
                                    <input type="hidden" class="form-control" id="gos_os_id" name="gos_os_id" value="@if(isset($os)) {{$os[0]->gos_os_id }} @endif">
                                    <input type="hidden" class="form-control" id="gos_vehiculo_id" name="gos_vehiculo_id" value="@if(isset($os)) {{$os[0]->gos_vehiculo_id }} @endif">
                                    <input type="hidden" class="form-control" id="gos_aseguradora_id" name="gos_aseguradora_id" value="@if(isset($os)) {{$os[0]->gos_aseguradora_id }} @endif">
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
            <div class="container-fluid m-2"><!-----------------------------Agregar ITems------------------------------------>
                    <div class="border-top">
                        <ul class="nav nav-pills my-4">
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white"  href="#collapseEtapa" data-toggle="tab" role="tab" id="add-item-etapa"> 
                                    <i class="fas fa-plus"></i>Agregar
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="collapseEtapa" role="tabpanel">
                                <div class="form-row">
                                    <div class="form-group col-6 col-sm-4 col-md-2">
                                        <label>Concepto</label>
                                        <input id="item-new" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-6 col-sm-4 col-md-2">
                                        <label>Precio</label>
                                        <input id="precio-new" value="" class="form-control">
                                    </div>
                                    
                                    <div class="form-group col-1 align-self-end">
                                        <button type="button" id="add-item" class="btn btn-success" style="height:40px;" onclick = "addItem()">
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
                                <th>Etapa</th>
                                <th>Código SAT</th>
                                <th>Unidad de medida</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Importe</th>
                                <th style="width:3%;"></th>
                            </tr>
                        </thead>
                        <tbody id="dt_lista_items_os_body">
                            @foreach($osProducto as $ff => $producto)
                            <tr>
                                <td style="text-align:center;"><input  value="{{$producto->nombre}}" name="con[]" class="form-control"></td>
                                <!-- <td style="text-align:center;"><input  value="" name="sat[]" class="form-control"></td> -->
                                <td style="text-align:center;">
                                   
                                    <select class="form-control input-sm" name="sat[]" id="sat">
                                        <option></option>
                                    @foreach($codigoSat as $key => $sat)
                                            <option value="{{$sat->gos_docventa_codigo_sat_id}}" <?php if ($sat->gos_docventa_codigo_sat_id==$producto->codigo_sat): ?>selected  <?php endif; ?>>{{$sat->descripcion}}</option>

                                        
                                            @endforeach
                                        </select>

                                </td>
                                <!-- <td style="text-align:center;"><input  value="" name="uni[]" class="form-control"></td> -->
                                <td style="text-align:center;">
                                <select class="form-control input-sm" name="uni[]" id="uni" >
                                            <option></option>
                                            <option value="E48">Unidad de servicio</option>
                                            <option value="H87">Pieza</option>
                                            <option value="LTR">Litro</option>
                                            <option value="GLL">Galon</option>
                                            <option value="XKI">Juego de piezas</option>
                                            <option value="MTR">Metro</option>
                                            <option value="KGM">Kilogramo</option>
                                            <option value="GRM">Gramo</option>
                                            <option value="PR">Par</option>
                                            <option value="XBJ">Cubeta</option>
                                            <option value="MLT">Mililitro</option>
                                            <option value="XVN">Vehiculo</option>
                                    </select>
                                </td>
                                <?php 
                                    $totalEtapa = 0;
                                    if($producto->precio_producto>0){
                                        $totalEtapa += $producto->precio_producto;
                                    }
                                    if($producto->precio_etapa>0){
                                        $totalEtapa += $producto->precio_etapa;

                                    }
                                    if($producto->cantidad == 0){
                                        $qty = 1;
                                    }
                                    else{
                                        $qty = $producto->cantidad;

                                    }

                                ?>
                                <td style="text-align:center;"><input id="efe_{{$ff}}" name="efe[]" value="{{ $totalEtapa}}" class="form-control"  onkeyup="myFunction({{$ff}})"></td>
                                <td style="text-align:center;"><input id="ban_{{$ff}}" name="ban[]"value="{{$qty}}" class="form-control"  onkeyup="myFunction({{$ff}})"></td>
                                <td style="text-align:center;"><input id="des_{{$ff}}" name="des[]" value="" class="form-control" onkeyup="myFunction({{$ff}})"></td>
                                <td style="text-align:center;" id="tab_{{$ff}}">{{$totalEtapa*$qty}}</td>
                                <td style="text-align:center;"><button onclick = "deleteRowEditar(this)" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td>
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
                        <select class="custom-select" name="gos_forma_pago_id" id="gos_forma_pago_id" required>
                        <option></option>
                            <option value="1">Contado</option>
                            <option value="2">Credito</option>
                        </select>
                    </div> 
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label >Uso de CFDI</label>
                        <select class="form-control input-sm" name="uso_cfdi" required>
                            <option></option>
                            <option value="G01">Adquisición de mercancias</option>
                            <option value="G02">Devoluciones, descuentos o bonificaciones</option>
                            <option value="G03">Gastos en general</option>
                            <option value="I01">Construcciones</option>
                            <option value="I02">Mobilario y equipo de oficina por inversiones</option>
                            <option value="I03">Equipo de transporte</option>
                            <option value="I04">Equipo de computo y accesorios</option>
                            <option value="I05">Dados, troqueles, moldes, matrices y herramental</option>
                            <option value="I06">Comunicaciones telefónicas</option>
                            <option value="I07">Comunicaciones satelitales</option>
                            <option value="I08">Otra maquinaria y equipo</option>
                            <option value="D01">Honorarios médicos, dentales y gastos hospitalarios.</option>
                            <option value="D02">Gastos médicos por incapacidad o discapacidad</option>
                            <option value="D03">Gastos funerales.</option>
                            <option value="D04">Donativos.</option>
                            <option value="D05">Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).</option>
                            <option value="D06">Aportaciones voluntarias al SAR.</option>
                            <option value="D07">Primas por seguros de gastos médicos.</option>
                            <option value="D08">Gastos de transportación escolar obligatoria.</option>
                            <option value="D09">Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.</option>
                            <option value="D10">Pagos por servicios educativos (colegiaturas)</option>
                            <option value="P01">Por definir</option>
                        </select>
                    </div>
                  
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="" >Método de Pago</label>
                        <select class="custom-select" name="metodo_pago" id="metodo_pago" required>
                        <option></option>
                            <option value="PUE">Pago en una sola exhibición</option>
                            <option value="PPD">Pago en parcialidades o diferido</option>
                        </select>
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label >Fecha de Factura</label>
                        <input type="text" class="form-control" name="fecha_nota" id="fecha_nota" value="<?php echo date("Y-m-d H:i:s")?>" readonly>
                    </div>
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="text-nowrap">Tipo de pago</label>
                    <select class="custom-select" name="gos_metodo_pago_id" id="gos_metodo_pago_id" required>
                        <option value="01">Efectivo</option>
                        <option value="02">Cheque nominativo</option>
                        <option value="03">Transferencia electrónica de fondos</option>
                        <option value="04">Tarjeta de crédito</option>
                        <option value="05">Monedero electrónico</option>
                        <option value="06">Dinero electrónico</option>
                        <option value="08">Vales de despensa</option>
                        <option value="12">Dación en pago</option>
                        <option value="13">Pago por subrogación</option>
                        <option value="14">Pago por consignación</option>
                        <option value="15">Condonación</option>
                        <option value="17">Compensación</option>
                        <option value="23">Novación</option>
                        <option value="24">Confusión</option>
                        <option value="25">Remisión de deuda</option>
                        <option value="26">Prescripción o caducidad</option>
                        <option value="27">A satisfacción del acreedor</option>
                        <option value="28">Tarjeta de débito</option>
                        <option value="29">Tarjeta de servicios</option>
                        <option value="30">Aplicación de anticipos</option>
                        <option value="31">Intermediario pagos</option>
                        <option value="99">Por definir</option>
               
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
                                <label class="col-4 col-form-label text-right" >IVA</label>
                                <div class="col-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input type="text" name="iva" id="ivaedt2" class="form-control" value="16" disabled>


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
                                        <button type="submit" id="guardar" class="btn btn-success w-100" >Guardar</button>
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
<script>
    // $("#guardar").click(function (e) {
    //     var answer = confirm('Are you sure that you want to do this?');
    //     if (!answer) {
    //         e.preventDefault();
    //     }
    //     else{
    //         $("#form-submit").submit();
    //     }
    // });
 $("#sat").on('change',function(){
     var value = $(this).val();
    if(value == "78181500" || value == "78181501" || value == "78181503" || value == "78181505" || value == "78181506" || value == "78181509" ){
        $("#uni").val("E48");
    }
    else{
        $("#uni").val("");
    }
 });
 $("#gos_forma_pago_id").on('change',function(){
        var pago = $(this).val();
        if(pago == 2){
            $(".credito").show();
        }else{
            $(".credito").hide();
        }
    });
    $(document).ready(function(){
        CalcTotal();
    });
    function myFunction(key){
        var efe = $("#efe_"+key).val();
        var ban = $("#ban_"+key).val();
        var des = $("#des_"+key).val();
        var tot = $("#tot_"+key).val();
        if(!efe.includes(".")){
            efe = (efe+".00");
        }
        var final = (efe*ban)-des;
        console.log(final);
        console.log(key);

        $("#dt-lista-items-os #tab_"+key).text(final);    
        CalcTotal();
    }
    function deleteRowEditar(rowid) {
        var row = rowid.parentNode.parentNode;
        row.parentNode.removeChild(row);
        
    }
   function addItem(){
        var item =  $("#item-new").val();
        var precio = $("#precio-new").val();
        var rand =Math.floor(Math.random() * (+400 - +600)) + +600; 
       $('#dt-lista-items-os').append('<tr><td style="text-align:center;"><input value="'+item+'" class="form-control"></td>'+
       '<td style="text-align:center;"><input id="efe_'+rand+'" value="'+precio+'" class="form-control"></td>'+
       '<td style="text-align:center;"><input id="ban_'+rand+'" value="" class="form-control"></td>'+
       '<td style="text-align:center;"><input id="des_'+rand+'" value="" class="form-control"></td>'+
       '<td style="text-align:center;"></td>'+
       '<td style="text-align:center;"><button onclick = "deleteRowEditar(this)" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td>'+

        '</tr>');
   }

function CalcTotal(){
    var Importe=0; var Subtotal=0; var total=0; var Iva=0; var desc=0;
    var tableEta = $('#dt-lista-items-os');
    var tableEtalength = document.getElementById("dt-lista-items-os").rows.length;
    for (var i =1 ; i < tableEtalength; i++) {
        var rowimp=parseFloat((tableEta[0].rows[i].cells[6].innerText));
        Importe=Importe+rowimp;
    }
  var Descuento = parseFloat(document.getElementById("descuentoedt2").value);
  if (isNaN(Descuento)) Descuento = 0;
  var Iva = parseFloat(document.getElementById("ivaedt2").value);
  if (isNaN(Iva)) Iva = 0;

  if (Descuento > 0) {
          Subtotal=Importe;
          Descuento = (Subtotal * Descuento) / 100;
          Subtotal = Subtotal - Descuento;

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

</script>
@endsection