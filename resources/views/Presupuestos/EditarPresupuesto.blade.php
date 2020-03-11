@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class='container-fluid'>
  <div class="kt-portlet__head kt-portlet__head--lg">
   <div class="kt-portlet__head-label">
    <h3 class="kt-portlet__head-title">Editar Presupuesto: {{$pres->gos_pres_id  ?? '' }}</h3>
    </div>
  </div>

        <div class='container-fluid'  >
          <form class="" action="EditarPres"  id="EditarPres" method="post">
            @csrf
<!----------------------------------------------------Cliente cont----------------------------------------------------------------->
            <div class="container m-2">
              <input type="hidden" id="gos_pres_id" name="gos_pres_id" value="{{$pres->gos_pres_id}}">
              <input type="hidden" id="gos_vehiculo_id" name="gos_vehiculo_id" value="{{$pres->gos_vehiculo_id ??''}}">
              <input type="hidden" id="gos_cliente_id_edit" name="gos_cliente_id_edit" value="{{$cliente->gos_cliente_id ??''}}">
              <div class="row col-lg-12 col-sm-12">
                  <div class="col-12 col-md-3 col-lg-3 col-sm-6"  id="cls-buscarcliente">
                      <label >Cliente</label>
                      <div class="input-group">
                          <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" value="{{$cliente->nombre}}" readonly>
                          <div class="input-group-append">
                              <button type="button" class="btn btn-primary p-0"
                               data-toggle="modal" data-target="#modalbuscarcliente">
                                  <i class="fas fa-search kt-shape-font-color-1 p-0"></i>
                              </button>
                          </div>

                      </div>
                      <small  id="errorespresupuestoscliente" style="display: none; color:red;">Insertar Cliente</small>
                  </div>

                  <div class="col-12 col-md-3 col-lg-3 col-sm-6">
                      <label ><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></label>
                      <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="{{$nomvehi ??''}}"disabled>
                        <small  id="errorespresupuestosvehi" style="display: none; color:red;">Insertar vehiculo</small>
                  </div>
                  <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                      <label ># <?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?>{{$taller_conf_ase->nomb_campo_reporte ??''}}<?php else: ?>Reporte<?php endif; ?></label>
                      <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="{{$pres->nro_poliza}}">
                        <small  id="errorespresupuestospol" style="display: none; color:red;">Insertar Reporte</small>

                  </div>
                  <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                      <label  ># <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?>{{$taller_conf_ase->nomb_campo_siniestro ??''}}<?php else: ?>Siniestro<?php endif; ?></label>
                      <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="{{$pres->nro_siniestro}}">
                        <small  id="errorespresupuestossin" style="display: none; color:red;">Insertar Siniestro</small>

                  </div>
                  <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                      <label >Kilometraje</label>
                      <input type="text" class="form-control" name="kilometraje" id="kilometraje" required value="{{$pres->kilometraje}}">
                        <small  id="errorespresupuestoskm" style="display: none; color:red;">Insertar kilometraje</small>
                  </div>
            </div></div>
<!----------------------------------------------------ITEMS cont----------------------------------------------------------------->
            <div class="container-fluid">
               <div class="container">
                 <ul style="margin:3%;" class="nav nav-pills mt-4">
                   <li class="nav-item">


                     <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapsePresupuesto" role="tab" id="add-item-presupuesto">
                       <i class="fas fa-plus"></i>Presupuesto
                     </a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapsePaquete" role="tab" id="add-item-paquete">
                       <i class="fas fa-plus"></i>Paquete
                     </a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapseProducto" role="tab" id="add-item-producto">
                       <i class="fas fa-plus"></i>Producto
                     </a>
                   </li>
                 </ul>

                 <div class="tab-content">
                   <div class="tab-pane" id="collapsePresupuesto" role="tabpanel">
                       <div class="form-row">
                        <div class="row col-12 col-md-12">
                          <div class="col-12 col-sm-8 col-lg-3 col-xl-3 mt-4 mb-2">
                            <label >Descripción</label>
                              <div class="input-group">
                                <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="" id="descripcion">
                                  @isset($listaConceptos)
                                  <option value="0">Agregar</option>
                                    @foreach ($listaConceptos as $concepto)
                                    <option value="{{$concepto->gos_pres_concepto_id}}"> {{$concepto->nomb_concepto}}</option>
                                    @endforeach
                                  @else
                                    <option value="0">Agregar</option>
                                  @endisset
                                </select>
                                <div class="input-group-append">
                                  <button class="btn btn-brand p-1" type="button"name="button" onclick="getselect();">
                                    <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                  </button>
                                </div>
                              </div>
                          </div>
                          <div class="col-6 col-sm-6 col-lg-4 col-xl-2 mt-4 mb-2">
                            <label >Tipo Servicio</label>
                            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_pres_servicio_id" id="gos_pres_servicio_id">
                              @isset($listaServicios)
                                @foreach ($listaServicios as $servicio)
                                <option value="{{$servicio->gos_servicio_taller_id}}"> {{$servicio->nomb_servicio}}</option>
                                @endforeach
                              @else
                                <option value="C">Cambio</option>
                                <option value="R">Reparación</option>
                                <option value="D">D/M</option>
                              @endisset
                            </select>
                          </div>
                          <div class="col-6 col-sm-6 col-lg-4 col-xl-2 mt-4 mb-2">
                            <label >Sección</label>
                            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_seccion_id" id="gos_seccion_id" >
                              @isset($listaSeccion)
                                @foreach ($listaSeccion as $seccion)
                                <option value="{{$seccion->gos_seccion_taller_id}}"> {{$seccion->nomb_seccion}}</option>
                                @endforeach
                              @else
                                <option value="L">Laminado</option>
                                <option value="M">Mecánica</option>
                                <option value="T">Tot</option>
                              @endisset
                            </select>
                          </div>


                         {{-- <div class=" col-2 mt-4 mb-2">
                           <label >Asesor</label>
                           <input type="text" class="form-control" name="gos_etapa_asesor_id" id="gos_etapa_asesor_id"
                           disabled>
                         </div> --}}

                          <div class="col-4 col-sm-3 col-lg-3 col-xl-1 mt-4 mb-2">
                            <label >Servicio</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text p-1">$</span>
                              </div>
                              <input type="text" class="form-control" name="precio_servicio" id="precio_servicio" value="0" min="0">
                            </div>
                          </div>
                          <div class="col-4 col-sm-3 col-lg-4 col-xl-1 mt-4 mb-2">
                            <label >Pintura</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-1">$</span>
                                </div>
                                <input type="text" class="form-control" name="precio_pintura" id="precio_pintura" value="0" min="0">
                            </div>
                          </div>
                          <div class="col-4 col-sm-3 col-lg-3 col-xl-1 mt-4 mb-2">
                            <label >Refaccion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-1">$</span>
                                </div>
                                <input type="text" class="form-control" name="precio_refacciones" id="precio_refacciones" value="0" min="0">
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 col-md-1 align-self-end">
                              <button type="button" id="btn-ItemPresupuestoEditar" class="btn btn-block btn-success mb-2" style="height:40px;">
                                <i class="fas fa-plus p-0" style="color: white!important;"></i>
                              </button>
                          </div>
                        </div>
                       </div>
                    </div>
                 </div>
                 </div>
            <div class="container-fluid"> <!---------------------------TABLE ITEMS-------------------------------->
          <div class="table-responsive table-bordered table-striped  p-1">
            <table class="table table-sm table-hover" id="dt-lista-items-presupuesto">
              <thead  class="thead-light">
                <tr>

                  <th class="p-2">Descripcion</th>
                  <th class="p-2">#Parte</th>
                  <th class="p-2">Observaciones</th>
                  <th class="p-2">#NM</th>
                  <th class="p-2">Servicio</th>
                  <th class="p-2">Pintura</th>
                  <th class="p-2">Refacción</th>
                  <th class="p-2">total</th>
                  <th style="width:3%;"></th>
                </tr>
              </thead>
              <tbody id="tbody_itemprod">
                     <?php foreach ($items as $item): ?>
                      <tr>
                        <td style="display: none;">{{$item->gos_pres_item_id}}</td>
                        <td style="display: none;">{{$item->gos_pres_concepto_id}}</td>
                        <td><?php foreach ($listaConceptos as $concepto): ?>
                        <?php if ($item->gos_pres_concepto_id==$concepto->gos_pres_concepto_id): ?>
                         {{$concepto->nomb_concepto}}
                        <?php endif; ?>
                        <?php endforeach; ?></td>
                        <td><input class="form-control" type="text" value="{{$item->nro_parte}}"></td>
                        <td><input class="form-control" type="text" value="{{$item->observaciones}}"></td>
                        <td>{{$item->gos_pres_servicio_id}}{{$item->gos_servicio_taller_id}}<?php if ($item->precio_pintura>0): ?>P<?php endif; ?><?php if ($item->precio_refacciones>0): ?>R<?php endif; ?>
                        </td>
                        <td>{{$item->precio_servicio}}</td>
                        <td>{{$item->precio_pintura}}</td>
                        <td>{{$item->precio_refacciones}}</td>
                        <td >{{$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones}}</td>
                        <td><button onclick = "deleteRowEditar(this)" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td>
                      </tr>
                     <?php endforeach; ?>

              </tbody>

            </table>
             <label  id="errorespresupuestositms" style="display: none; color:red;">Agregar Item</label>
          </div>
        </div>
            </div>
<!----------------------------------------------------cierre cont----------------------------------------------------------------->
            <div class="container-fluid">
              <div class="form-group " >
                  <div class="row">
                  <div class="col-8 col-md-6 col-sm-12">
                                  <div class="form-group  col-lg-6 col-md-11 col-sm-12">
                                      <label class="">Fecha de cotizacion</label>
                                      <div class="input-group date">
                                          <input type="text" class="form-control" name="fecha_cotizacion" id="kt_datetimepicker_2" value="{{$pres->fecha??''}}">
                                          <div class="input-group-append">
                                              <span class="input-group-text p-0">
                                                  <i class="la la-calendar-check-o"></i>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                    <small  id="errorespresupuestosdt" style="display: none; color:red;">Insertar kilometraje</small>
                                         <div class="form">
                                           <label for="">Comentarios</label>
                                           <textarea name="comentarios"  rows="8" cols="80">{{$pres->gos_pres_comentarios ?? '' }}</textarea>
                                         </div>
                                 </div>
                  <div class="col-4 col-md-4 " style="padding-bottom: 10; margin-top: 4rem; margin-left: 10rem;">
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">M.O. Laminado</label>
                                     <div class="col-8">
                                        <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                            <input type="text" name="manoobra" id="molaminado" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">M.O. Mecanica</label>
                                     <div class="col-8">
                                        <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                            <input type="text" name="manoobrapintura" id="momecanica" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">M.O. ToT</label>
                                     <div class="col-8">
                                        <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                            <input type="text" name="manoobrapintura" id="motot" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">Pintura</label>
                                     <div class="col-8">
                                        <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                            <input type="text" name="precipintura" id="PPintura" class="form-control" value="{{$totalpin ??''}}"disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">Refacciones</label>
                                     <div class="col-8">
                                        <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                            <input type="text" name="" id="manoobraref" class="form-control" value=""disabled>
                                        </div>
                                    </div>
                                </div>
                              <div class="row  col-sm-12">
                                  <label class="col-4  col-form-label text-right">Sub-Total</label>
                                  <div class="col-8 ">
                                      <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                          <input type="text" name="SubTotal2" id="subtotal2" class="form-control" value="{{$subtotal ??''}}" disabled>
                                          <input type="hidden" name="SubTotal" id="subtotal" class="form-control" value="{{$subtotal ??''}}" >
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12">
                                  <label class="col-4  col-form-label text-right">Descuento</label>
                                  <div class="col-8">
                                      <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                          <button type="button" class="input-group-text btnCambioPeso" style="display:none;" id="descpes"  onclick="changedesc();">$</button>
                                          <button type="button" class="input-group-text btnCambioPorciento" id="descpor" onclick="changedesc();">%</button>
                                          </div>
                                           <input type="hidden" id="desctipe" name="descuento_tipo" value="%" >
                                          <input type="text" name="Descuento" id="descuento" class="form-control" onchange="CalcTotal()">
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12">
                                  <label class="col-4 col-form-label text-right">IVA</label>
                                  <div class="col-8">
                                      <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">%</span>
                                          </div>
                                          <input type="text" name="Iva" id="iva" class="form-control" onchange="CalcTotal()" value="16">
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12">
                                  <label class="col-4 col-form-label text-right">Total</label>
                                  <div class="col-8">
                                      <div class="input-group input-group-sm">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                          </div>
                                          <input type="text" name="Total2" id="totalFinal2" class="form-control" disabled>
                                          <input type="hidden" name="Total" id="totalFinal" class="form-control" >
                                      </div>
                                  </div>
                              </div>
                              <div class="row  col-sm-12">
                                  <div class="col-8 offset-4 col-md-8 offset-sm-12 offset-md-4">
                                      <button type="button" class="btn btn-success w-100" id="btneditar_presupuesto">
                                        Editar
                                      </button>
                                  </div>
                              </div>
                        </div>
                  </div>
              </div>
            </div>

            </form>
            <div class="">
                  @include('Presupuestos/EditarPrs_Desglose/ModalClienteVehiculos')
            </div>
      </div>
</div>
@endsection
@section('ScriptporPagina')
  <script src="../gos/js/jsitemspresupuesto.js"></script>
	<script src="../gos/ajax-presupuestos.js"></script>
	<script src="../gos/ajax-presupuesto-items.js"></script>
  <script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
@endsection
