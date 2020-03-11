@section('estiloPorPagina')
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
<link href="{{env('APP_URL')}}/gos/datatable-editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@extends('Layout')

<title>Orden de servicio</title>

@section('Content')
<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title" id="TitleOrden">Agregar Orden de servicio</h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-actions">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCliente">
          Agregar Cliente
        </button>
      </div>
    </div>
  </div>
  <div class="kt-portlet__body p-1">

    @if (session('notification'))
    <div class="alert alert-success">
     {{session('notification')}}
     </div> @endif

     @if (count($errors)>0)
       <div class="alert alert-danger">
         <ul>
           <?php foreach ($errors->all() as $error): ?>
             <li>
               {{ $error }}
             </li>
           <?php endforeach; ?>
         </ul>
       </div>

    @endif


    <form class="" action="/ordenes-serv/Agregar" method="post">
        @csrf
     <div class="container-fluid m-2"><!---------------------CLIENTES BEGIN---------------------->


       <div class="row">
        <div class="col">
                <input type="hidden" id="gos_vehiculo_id" name="gos_vehiculo_id" value="@if(isset($os)) {{$os->gos_vehiculo_id }} @endif">
                <input type="hidden" id="gos_cliente_id" name="gos_cliente_id" value="@if(isset($os)) {{$os->gos_cliente_id }} @endif">
                <div class="form-row">
                    @if(isset($os->gos_os_id))
                        <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                            <label >Cliente</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" value="@if(isset($os)) {{$os->nomb_cliente }} @endif" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary p-0"
                                    data-toggle="modal" data-target="#modalbuscarcliente">
                                        <i class="fas fa-pen kt-shape-font-color-1 p-0"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="form-group col-12 col-md-2 " style="top:24px;" id="btn-buscarcliente">
                            <button type="button" class="btn btn-primary w-100 text-truncate" data-toggle="modal"
                              data-target="#modalbuscarcliente">
                                Buscar cliente
                            </button>
                           <small style="font-style: italic; display: none;" id="smallcliente" class=" form-text text-danger">Campo obligatorio</small>
                        </div>

                        <div class="form-group col-12 col-md-2  pl-2 mb-3" style="display:none;" id="cls-buscarcliente">
                            <label >Cliente</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary p-0"
                                    data-toggle="modal" data-target="#modalbuscarcliente">
                                        <i class="fas fa-pen kt-shape-font-color-1 p-0"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    @endif

                    <div class="form-group col-6 col-md-3  mb-3">
                        <label ><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></label>
                        <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="@if(isset($os)) {{$os->detallesVehiculo }} @endif" disabled>
                    </div>

                    <div class="form-group col-6 col-md-2  mb-3">
                        <label >Asegurado</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id" id="gos_aseguradora_id">
                            <option></option>
                            @foreach ($listaAseguradoras as $aseguradoraS)
                            <option value="{{$aseguradoraS->gos_aseguradora_id}}" {{$aseguradoraS->gos_aseguradora_id == $aseguradora ?'selected' : ''}}>
                                {{$aseguradoraS->empresa}}</option>
                            @endforeach
                        </select>
                        <small style="font-style: italic; display: none;" id="smallasegurado" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                    <div class="form-group col-6 col-md-1  mb-3">
                        <label >TOT</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_ot_id" id="gos_ot_id">
                            <option></option>
                            @foreach ($listaTot as $totS)
                            <option value="{{$totS->gos_ot_id}}" {{$totS->gos_ot_id == $tot ?'selected' : ''}}>
                                {{$totS->nomb_ot}}</option>
                            @endforeach
                        </select>
                       <small style="font-style: italic; display: none;" id="smallTOT" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                    <div class="form-group col-6 col-md-1  mb-3">
                        <label ># <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?>{{$taller_conf_ase->nomb_campo_poliza ??''}}<?php else: ?>Poliza<?php endif; ?></label>
                        <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="@if(isset($os)) {{$os->nro_poliza }} @endif">
                        <small style="font-style: italic; display: none;" id="smallNroPol" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                    <div class="form-group col-6 col-md-1  mb-3">
                        <label  class="text-truncate"># <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?>{{$taller_conf_ase->nomb_campo_siniestro ??''}}<?php else: ?>Siniestro<?php endif; ?></label>
                        <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="@if(isset($os)) {{$os->nro_siniestro }} @endif">
                        <small style="font-style: italic; display: none;" id="smallsiniestro" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
                    <div style="text-align: -webkit-center;" class="form-group col-6 col-md-2  mb-3">
                        <label  style="text-align: center;">Riesgo</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_riesgo_id" id="gos_os_riesgo_id">
                            <option></option>
                            @foreach ($listaRiesgos as $riesgoS)
                            <option value="{{$riesgoS->gos_os_riesgo_id}}" {{$riesgoS->gos_os_riesgo_id== $riesgo ?'selected' : ''}}>
                                {{$riesgoS->nomb_riesgo}}</option>
                            @endforeach
                        </select>
                     <small style="font-style: italic; display: none;" id="smallriesgo" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                </div>
            <!-- COMIENZO SEGUNDA FILA  -->
                <div class="form-row">
                    <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  pl-2 mb-0">
                        <label ><?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?>{{$taller_conf_ase->nomb_campo_reporte ??''}}<?php else: ?>Reporte<?php endif; ?></label>
                        <input type="text" class="form-control" name="nro_reporte" id="nro_reporte" value="@if(isset($os)) {{$os->nro_reporte }} @endif">
                         <small style="font-style: italic; display: none;" id="smallreporte" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                    <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  mb-0">
                        <label >Orden</label>
                        <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="">
                        <small style="font-style: italic; display: none;" id="smallorden" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-4 col-md-3 col-lg-2  mb-0">
                        <label >Tipo de Orden</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_o_id" id="gos_os_tipo_o_id">
                            @foreach ($listaTipoOrden as $tipoOrdenS)
                            <option value="{{$tipoOrdenS->gos_os_tipo_o_id}}" {{$tipoOrdenS->gos_os_tipo_o_id== $orden ?'selected' : ''}}>
                                {{$tipoOrdenS->tipo_orden}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2 mb-0">
                        <label >Daño</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_danio_id" id="gos_os_tipo_danio_id">
                            @foreach ($listaDanios as $danioS)
                            <option value="{{$danioS->gos_os_tipo_danio_id}}"  {{$danioS->gos_os_tipo_danio_id== $danio ?'selected' : ''}}>
                                {{$danioS->tipo_danio}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                        <label >Estatus</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_estado_exp_id" id="gos_os_estado_exp_id">
                            <option></option>
                            @foreach ($listaEstadosExp as $estadoExp)
                            <option value="{{$estadoExp->gos_os_estado_exp_id}}"  {{$estadoExp->gos_os_estado_exp_id== $estado ?'selected' : ''}}>
                                {{$estadoExp->estado_expediente}}</option>
                            @endforeach
                        </select>
                      <small style="font-style: italic; display: none;" id="smallstatus" class=" form-text text-danger">Campo obligatorio</small>
                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                        <label >Demérito</label>
                        <input type="text" class="form-control" name="demerito" id="demerito" value="@if(isset($os)) {{$os->demerito }} @endif">
                        <small style="font-style: italic; display: none;" id="smalldemerito" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                        <label >Deducible</label>
                        <input type="text" class="form-control" name="deducible" id="deducible" value="@if(isset($os)) {{$os->deducible }} @endif">
                        <small style="font-style: italic; display: none;" id="smalldeducible" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2  mb-0">
                        <label style="text-align: center;">Condiciones especiales</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" id="Cespeciales" name="Cespeciales" >
                        <option ></option>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                        <small style="font-style: italic; display: none;" id="smallcondiciones" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
                    <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                        <label >Ingreso Grúa</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" id="IGrua" name="IGrua" >
                            <option ></option>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                        <small style="font-style: italic; display: none;" id="smallgrua" class=" form-text text-danger">Campo obligatorio</small>

                    </div>
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
                      <div class="form-group col-6 col-sm-4 col-md-3">
                        <label>Descripción</label>
                        <input type="text" class="form-control" name="descripcion_etapa" id="descripcion_etapa" value="" disabled>
                      </div>
                      <div class="form-group col-6 col-sm-4 col-md-2">
                        <label>Asesor</label>
                        <input type="text" class="form-control" name="asesor_asignado" id="asesor_asignado" value="" disabled>
                       <input type="hidden" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id" value="">
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

                      <div class="form-group col-6 col-sm-2">
                        <label>Descipcion</label>
                        <div class="input-group">
                          <input type="text" class="form-control pl-1 pr-0" name="gos_paquete_desc" id="gos_paquete_desc_id" value="" disabled>
                        </div>
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
                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_producto_id" id="gos_producto_id" onchange="MostrarSelectProducto();">
                            <option value="0"></option>
                            @foreach ($listaProductos as $producto)
                            <option value="{{$producto->gos_producto_id}}">{{$producto->codigo}}</option>
                            @endforeach
                        </select>
                      <small style="font-style: italic; display: none;" id="smallvalprod" class=" form-text text-danger">Campo obligatorio</small>
                      </div>
                      <div class="form-group col-6 col-sm-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nomb_producto_real" id="nomb_producto_real" value="" disabled>
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
          <small id="smalltableoscreate" class="form-text text-danger"></small>
      </div>
      <div class="table-responsive table-sm p-1">
      <table class="table table-sm table-hover my-4" id="dt-lista-producto-os" style="font-size: 1rem;">
      					<thead class="thead-light">
      						<tr style="font-weight: 500;">
      							<th>ID</th>
      							<th>Producto</th>
      							<th>Descripción</th>
      							<th>Código SAT</th>
      							<th>Cantidad</th>
      							<th>Precio</th>
      							<th>Descuento</th>
      							<th>Importe</th>
      							<th style="width:3%;"></th>
      						</tr>
      					</thead>
      					<tbody id="dt_lista_producto_os_body">

      					</tbody>
      				</table>
            <small id="smalltableoscreate" class="form-text text-danger"></small>
        </div>
    </div>

     <div class="container-fluid m-2"><!---------------------------------Cierre-------------------------------------->
             <div class="row mt-5">
                 <div class="col-12">

                         {{-- ID DE OS --}}
                         <input type="hidden" id="gos_os_id_anticipo" name="gos_os_id_anticipo" value="@if(isset($os)){{$os->gos_os_id }}@endif">

                         <div class="row">
                             <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                                 <label class="" >Creación de orden</label>
                                 <div class="input-group date">
                                     <input type="text" class="form-control"  id="kt_datetimepicker_1" name="fecha_creacion_os"   value="{{$hoy ??'' }} "  readonly = "readonly">
                                     <div class="input-group-append">
                                         <span class="input-group-text p-0">
                                             <i class="la la-calendar-check-o"></i>
                                         </span>
                                     </div>
                                 </div>
                                 <small style="font-style: italic; display: none;" id="smallFC" class=" form-text text-danger">Campo obligatorio</small>
                             </div>
                             <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                                 <label >Ingreso del vehículo</label>
                                 <div class="input-group date">
                                     <input type="text" class="form-control" id="kt_datetimepicker_2"   value="{{$hoy ??''}}" name="fecha_ingreso_v_os"  readonly = "readonly">
                                     <div class="input-group-append">
                                         <span class="input-group-text p-0">
                                             <i class="la la-calendar-check-o"></i>
                                         </span>
                                     </div>
                                 </div>
                                 <small style="font-style: italic; display: none;" id="smallFI" class=" form-text text-danger">Campo obligatorio</small>
                             </div>
                             <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                                 <label >Fecha de Promesa</label>
                                 <div class="input-group date">
                                     <input type="text" class="form-control" id="kt_datetimepicker_2"  value="" name="fecha_promesa" id="fecha_promesa" readonly>
                                     <div class="input-group-append">
                                         <span class="input-group-text p-0">
                                             <i class="la la-calendar-check-o"></i>
                                         </span>
                                     </div>
                                 </div>
                                  <small style="font-style: italic; display: none;" id="smallFP" class=" form-text text-danger">Campo obligatorio</small>
                             </div>
                             <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                                 <label >Anticipo</label>
                                 <select id="anticipo" class="custom-select"   value="@if(isset($os)) {{$os->Anticipo }} @endif" name="tipoAnticipo" id="tipoAnticipo " >
                                     <option value="no" @isset($checkAnticipo){{'no'== $checkAnticipo ?'selected' : ''}}@endisset>No</option>
                                     <option value="si" @isset($checkAnticipo){{'si'== $checkAnticipo ?'selected' : ''}}@endisset>Si</option>
                                 </select>
                             </div>
                         </div>

                         <div class="row" id="mostrarAnticipos" style="display: none;">
                             <div class="col-3">
                                 <label >Tipo de Pago</label>
                                 <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                                     <option></option>
                                     @foreach ($listaMetodos as $metodoPago)
                                     <option value="{{$metodoPago->gos_metodo_pago_id}}">{{$metodoPago->nomb_met_pago}}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="col-3">
                                 <label >Monto de anticipo</label>
                                 <div class="input-group">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text p-0">$</span>
                                     </div>
                                     <input type="number" class="form-control" name="monto_abono" id="monto_abono">
                                 </div>
                             </div>
                             <div class="col-3">
                                 <label >Fecha de abono</label>
                                 <input type="text" class="form-control kt_datepicker_2" name="fecha_abono" id="fecha_abono" readonly>
                             </div>
                             <div class="col-1 align-self-end">

                             </div>
                             <div class="col-12 mb-1">
                                 <label >Observaciones</label>
                                 <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
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
                                          <input type="text" name="importeTotal" id="importeTotal" class="form-control" value="@if(isset($os->importeTotal)) {{$os->importeTotal }} @endif" disabled>
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12">
                                  <label class="col-4 col-form-label text-right" >Descuento</label>
                                  <div class="col-8">
                                      <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">

                                                  <button type="button" class="input-group-text btnCambioPeso" style="display:none;" id="descpes"  onclick="changedesc();">$</button>
                                                  <button type="button" class="input-group-text btnCambioPorciento" id="descpor" onclick="changedesc();">%</button>

                                          </div>
                                          <input type="hidden" id="descuento_tipo" name="descuento_tipo" value="%" >
                                          <input type="text" name="descuentoe" id="descuentoedt2" value="0" class="form-control" onchange="CalcTotal();">
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
                                          <input type="text" name="subtotal" id="subtotal" class="form-control" value="@if(isset($os)) {{$os->subtotal }} @endif" readonly>
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
                                          <input type="text" name="total" id="total" class="form-control" value="@if(isset($os->total)) {{$os->total }} @endif" disabled>
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12 ">
                                  <div class="col-8 col-md-8 offset-sm-12 offset-4">
                                      <button type="button" class="btn btn-success w-100" id="btn_guardar_OSjs" onclick="validar();">Guardar</button>
                                      <button type="submit" style="display: none;" class="btn btn-success w-100" id="btn_guardar_OSsub" onclick="triguerguardando();">Guardar</button>
                                      <button type="button"  style="display: none;"  class="btn btn-success w-100" id="btn_guardardando" onclick="validar();" disabled>Guardardando...</button>
                                  </div>
                              </div>
                             </div>
                    </div>






     </div>

      </form>
    <!--------------------------------------------Modales.--------------------------->

    @include('OS/Clientes/ModalClienteVehiculos')
    @include('OS/Clientes/ModalClientesVehiculosNuevo')
    @include('OS/EditarOrden_Desglose/ModalGuardar')

    </div>
    </div>

    @endsection

    @section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/datatable-editor/js/dataTables.editor.min.js"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-os-cliente-vehiculo.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-os-agregarosmx.js"></script>
    @endsection
