@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class='container-fluid'>
  <div class="kt-portlet__head kt-portlet__head--lg">
   <div class="kt-portlet__head-label">
    <h3 class="kt-portlet__head-title">Ver Presupuesto: {{$pres->gos_pres_id  ?? '' }}</h3>
    </div>
  </div>

            <div class='container-fluid'  >
              <div class="container m-3" for="clientes">
                 <div class="row">
                    <div class="col-md-3">
                      <label for="" >Cliente:</label> <br>
                      <label for="" class="form-control">{{$cliente->nombre ??''}}&nbsp{{$cliente->apellidos ??''}}</label>
                    </div>
                    <div class="col-md-3">
                      <label for="">Vehiculo</label> <br>
                      <label for="" class="form-control">{{$nomvehi ??''}}</label>
                    </div>
                    <div class="col-md-2">
                      <label for="">#Reporte</label> <br>
                      <label for="" class="form-control">{{$pres->nro_poliza ??''}}</label>
                    </div>
                    <div class="col-md-2">
                      <label for="">#Siniestro</label> <br>
                      <label for="" class="form-control">{{$pres->nro_siniestro ??''}}</label>
                    </div>
                    <div class="col-md-2">
                      <label for="">Kilometraje</label> <br>
                      <label for=""class="form-control">{{$pres->kilometraje ??''}}</label>
                    </div>
                 </div>
              </div>

              <div class="table-responsive table-bordered table-striped  p-1">
                <table class="table table-hover" id="dt-lista-items-presupuesto">
                  <thead  class="thead-light">
                    <tr>
                      <th class="p-2">id</th>
                      <th class="p-2">Descripcion</th>
                      <th class="p-2">#Parte</th>
                      <th class="p-2">Observaciones</th>
                      <th class="p-2">#NM</th>
                      <th class="p-2">Servicio</th>
                      <th class="p-2">Pintura</th>
                      <th class="p-2">Refacción</th>
                      <th class="p-2">total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($items as $item): ?>
                    <tr>
                      <td>{{$item->gos_pres_item_id}}</td>
                      <td>{{$item->gos_pres_concepto_id}} <?php foreach ($listaConceptos as $concepto): ?>
                        <?php if ($concepto->gos_pres_concepto_id==$item->gos_pres_concepto_id): ?>
                                             {{$concepto->nomb_concepto}}
                        <?php endif; ?>
                      <?php endforeach; ?></td>
                      <td>{{$item->nro_parte}}</td>
                      <td>{{$item->observaciones}}</td>
                      <td>{{$item->gos_pres_servicio_id }}{{$item->gos_servicio_taller_id}}
                          <?php if ($item->precio_pintura>0): ?>P<?php endif; ?><?php if ($item->precio_refacciones>0): ?>R<?php endif; ?>
                      </td>
                      <td>{{$item->precio_servicio}}</td>
                      <td>{{$item->precio_pintura}}</td>
                      <td>{{$item->precio_refacciones}}</td>
                      <td>{{$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones}}</td>

                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

                    <div class="form-group " >
                      <div class="row">


                     <div class="col-8 col-md-6 col-sm-12">
                                    <div class="form-group  col-lg-6 col-md-11 col-sm-12">
                                        <label class="">Fecha de cotizacion</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="fecha_cotizacion" id="kt_datetimepicker_2" value="{{$pres->fecha ?? ''}}" disabled>
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
                                <textarea name="comentarios" class="form-control"rows="8" cols="40" disabled>{{$pres->gos_pres_comentarios ?? '' }}</textarea>
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
                                              <input type="text" name="" id="manoobra" class="form-control" value="{{$molaminado??''}}" disabled>
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
                                              <input type="text" name="" id="manoobrapintura" class="form-control" value="{{$momecanica??''}}" disabled>
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
                                              <input type="text" name="" id="manoobrapintura" class="form-control" value="{{$motot??''}}" disabled>
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
                                              <input type="text" name="manoobraref" id="PPintura" class="form-control" value="{{$totalpin ??''}}"disabled>
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
                                              <input type="text" name="manoobraref" id="manoobraref" class="form-control" value="{{$TotalREf ??''}}"disabled>
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
                                            <input type="text" name="SubTotal2" id="subtotal2" class="form-control" value="{{$subtotal}}" disabled>
                                            <input type="hidden" name="SubTotal" id="subtotal" class="form-control" value="" >
                                        </div>
                                    </div>
                                </div><?php if ($descuento>0): ?>
                                  <div class="row  col-sm-12">
                                      <label class="col-4  col-form-label text-right">Descuento</label>
                                      <div class="col-8">
                                          <div class="input-group input-group-sm">
                                              <div class="input-group-prepend">
                                                  <!--<button type="button" class="input-group-text btnCambioPeso">$</button>-->
                                                  <button type="button" class="input-group-text btnCambioPorciento">%</button>
                                              </div>
                                              <input type="text" name="Descuento" id="descuento" class="form-control" disabled  value="{{$descuento ??''}}">
                                          </div>
                                      </div>
                                  </div>
                                <?php endif; ?>

                                <div class="row  col-sm-12">
                                    <label class="col-4 col-form-label text-right">IVA</label>
                                    <div class="col-8">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" name="Iva" id="iva" class="form-control"  disabled  value="{{$iva ??''}}">
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
                                            <input type="text" name="Total2" id="totalFinal2" class="form-control" value="{{$total }}" disabled>

                                        </div>
                                    </div>
                                </div>
                              </div>

                    </div>
                </div>
          </div>
      </div>
</div>
@endsection
@section('ScriptporPagina')
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
@endsection
