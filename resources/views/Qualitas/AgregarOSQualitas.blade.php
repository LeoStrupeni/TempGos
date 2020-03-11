@section('estiloPorPagina')
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
<link href="{{env('APP_URL')}}/gos/datatable-editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@extends('Layout')
@section('Content')
<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label col-12 col-lg-4">
        <img src="../img/logoqualitas.png" alt=""  style="width: 15rem;">
        <div></div>
        <h3 class="kt-portlet__head-title" style="margin-left: 10%;" id="">Agregar Orden de servicio </h3>
    </div>

  </div>
  <div class="kt-portlet__body p-1">
    <form class="" action="/AsignadasQualitas/Agregar/FinalizarOS" method="post">
        @csrf
        <input type="hidden" name="OSID" value="{{$OS->gos_os_id}}">
            <div class="container-fluid m-2"><!---------------------CLIENTES BEGIN---------------------->
                <div class="row">
                    <div class="col">
                            <div class="form-row">
                                <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                                    <label >Cliente</label>
                                    <input type="hidden" class="form-control" id="gos_os_id" name="gos_os_id" value="">
                                    <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" value="{{$VOS->nomb_cliente}}" disabled>
                                </div>
                                <div class="form-group col-6 col-md-3  mb-3">
                                  <?php $detvehi=explode("|",$VOS->detallesVehiculo) ?>
                                    <label >Vehículo</label>
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="{{$detvehi[1]}}" disabled>
                                </div>

                                <div class="form-group col-6 col-md-2  mb-3">
                                  <?php $dtsAseg=explode("|",$VOS->nomb_aseguradora) ?>
                                    <label >Aseguradora</label>
                                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="{{$dtsAseg[0] ??''}}" disabled>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label >TOT</label>
                                    <input type="text" class="form-control" id="tot" name="tot" value="" disabled>
                                <small style="font-style: italic; display: none;" id="smallTOT" class=" form-text text-danger">Campo obligatorio</small>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label ># Póliza</label>
                                    <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="{{$dtsAseg[6] ??''}}" disabled>
                                </div>
                                <div class="form-group col-6 col-md-1  mb-3">
                                    <label  class="text-truncate"># Siniestro</label>
                                    <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="{{$dtsAseg[4] ??''}}" >
                                </div>
                                <div style="text-align: -webkit-center;" class="form-group col-6 col-md-2  mb-3">
                                    <label  style="text-align: center;">Riesgo</label>
                                    <input type="text" class="form-control" name="nomb_riesgo" id="nomb_riesgo" value="{{$dtsAseg[10] ??''}} " disabled>
                                </div>
                            </div>
                            <!-- COMIENZO SEGUNDA FILA  -->
                            <div class="form-row">
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  pl-2 mb-0">
                                    <label >Reporte</label>
                                    <input type="text" class="form-control" name="nro_reporte" id="nro_reporte" value="{{$dtsAseg[2]??''}}" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-2 col-lg-1  mb-0">
                                    <label >Orden</label>
                                    <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="" >
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-4 col-md-3 col-lg-2  mb-0">
                                    <label >Tipo de Orden</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_o_id" id="gos_os_tipo_o_id">
                                      <?php foreach ($listaTipoOrden as $TO): ?>
                                         <option value="{{$TO->gos_os_tipo_o_id}}">{{$TO->tipo_orden}}</option>
                                      <?php endforeach; ?>
                                    </select>

                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2 mb-0">
                                    <label >Daño</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_danio_id" id="gos_os_tipo_danio_id">
                                      <?php foreach ($listaDanios as $dan): ?>
                                        <option value="{{$dan->gos_os_tipo_danio_id}}">{{$dan->tipo_danio}}</option>
                                      <?php endforeach; ?>
                                    </select>

                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Estatus</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_estado_exp_id" id="gos_os_estado_exp_id">

                                      <?php foreach ($listaEstadosExp as $exp): ?>
                                         <option value="{{$exp->gos_os_estado_exp_id}}">{{$exp->estado_expediente}}</option>
                                      <?php endforeach; ?>
                                    </select>
                                <small style="font-style: italic; display: none;" id="smallstatus" class=" form-text text-danger">Campo obligatorio</small>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Demérito</label>
                                    <input type="text" class="form-control" name="demerito" id="demerito" value="" disabled>

                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-1  mb-0">
                                    <label >Deducible</label>
                                    <input type="text" class="form-control" name="deducible" id="deducible" value="" disabled>
                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-3 col-lg-2  mb-0">
                                    <label style="text-align: center;">Condiciones especiales</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="condesp" >
                                        <option value="0" selected>No</option>
                                        <option value="1">Si</option>
                                    </select>

                                </div>
                                <div style="align-self: flex-end;" class="form-group col-6 col-md-2 col-lg-1  mb-0">
                                    <label >Ingreso Grúa</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="IGrua" >
                                        <option value="0" selected>No</option>
                                        <option value="1">Si</option>
                                    </select>

                                </div>
                            </div>
                    </div>
                </div><!---------------------CLIENTES END---------------------->
            </div>
            <div class="container-fluid m-2"><!-----------------------------Agregar ITems------------------------------------>
                    <div class="border-top">
                        <ul class="nav nav-pills my-4">
                        <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white"  href="#collapsePaquete" data-toggle="tab" role="tab" id="add-item-paquete">
                                    <i class="fas fa-plus"></i>Paquete
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="collapsePaquete" role="tabpanel">
                                <div class="form-row">
                                    <div class="form-group col-6 col-sm-3">
                                        <label>Paquete</label>
                                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paquete_id" id="gos_paquete_id">
                                         <?php foreach ($listaPaquetes as $paq): ?>
                                           <option value="{{$paq->gos_paquete_id}}">{{$paq->nomb_paquete}}</option>
                                         <?php endforeach; ?>
                                        </select>
                                        <small style="font-style: italic; display: none;" id="smallvalpaquete" class=" form-text text-danger">Campo obligatorio</small>
                                    </div>
                                    <div class="form-group col-6 col-sm-2">
                                        <label>Descipcion</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control pl-1 pr-0" name="gos_paquete_desc" id="gos_paquete_desc_id" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-1 align-self-end">
                                        <button type="button" id="add-item" class="btn btn-success" style="height:40px;" onclick = "AgregarPaqueteQualitas();">
                                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                        </button>
                                        <input type="hidden" name="paquetesCadid"  id="paquetesCadid" value="">
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
            <div class="col-12">

                {{-- ID DE OS --}}
                <input type="hidden" id="gos_os_id_anticipo" name="gos_os_id_anticipo" value="@if(isset($os)){{$os->gos_os_id }}@endif">

                <div class="row">
                    <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                        <label class="" >Creación de orden</label>
                        <div class="input-group date">
                            <input type="text" class="form-control"  id="kt_datetimepicker_1" name="fecha_creacion_os"   value="{{$hoy??''}}"  readonly = "readonly">
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
                            <input type="text" class="form-control" id="kt_datetimepicker_2"   value="{{$hoy??''}}"  name="fecha_ingreso_v_os"  readonly = "readonly">
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
                            <input type="text" class="form-control" id="kt_datetimepicker_3"  value=""  name="fecha_promesa" id="fecha_promesa" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text p-0">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                        <small style="font-style: italic; display: none;" id="smallFP" class=" form-text text-danger">Campo obligatorio</small>
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
                                         <button type="button" id="gardarval"  class="btn btn-success w-100"  onclick="valqualitas();">Guardar</button>
                                          <button style="display:none;" type="button" id="guardandobtn"  class="btn btn-info w-100"  onclick="valqualitas();">Guardando...</button>
                                        <button  style="display:none;" type="submit" id="guardarOS" class="btn btn-success w-100" >Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>

    <!--------------------------------------------Modales.--------------------------->


</div>

    @endsection

    @section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/datatable-editor/js/dataTables.editor.min.js"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-os-cliente-vehiculo.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-os-agregarosmx.js"></script>

    @endsection
