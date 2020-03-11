@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class='container-fluid'>
  <div class="kt-portlet__head kt-portlet__head--lg">


            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">Editar Presupuesto Qualitas</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
			        <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                  <img src="../img/logoqualitas.png" alt=""  style="width: 150px; height:75px;">
                </div>
              </div>
  </div>
  </div>
      <div class="kt-portlet__body">
         <div class="container-fluid">
           <form class="kt-form kt-form--label-right" id="ItemsPresupuestos_form">
             {{ csrf_field() }}
           <input type="hidden" id="idos" value="{{$OS->gos_os_id}}">
          <div class="row">
            <div class="col-6 col-md-3">
              <label for="">Cliente</label>
              <?php $cliente=explode("|",$OS->nomb_cliente);  ?>
              <label class="form-control">{{$cliente[0] ??''}} {{$cliente[1] ??''}}</label>
            </div>
            <div class="col-6 col-md-3">
              <label for="">Vehiculo</label>
              <?php $vehiculo=explode("|",$OS->detallesVehiculo);  ?>
              <label class="form-control">{{$vehiculo[1] ??''}}</label>
            </div>
            <div class="col-6 col-md-3">
              <label for="">Reporte</label>
              <label class="form-control">{{$OS->nro_reporte ??''}}</label>
            </div>
            <div class="col-6 col-md-3">
              <label for="">Siniestro</label>
              <label class="form-control">{{$OS->nro_siniestro ??''}}</label>
            </div>
            <!--<div class="col-6 col-md-2">
              <label for="">Valuacion</label>
              <select class="form-control" name="valuacion" id="valuacion">
                <option value="V0">v0</option>
                <option value="V1">v1</option>
                <option value="V2">v2</option>
                <option value="V3">v3</option>
                <option value="V4">v4</option>
              </select>
            </div>-->
          </div>
         </div>

              <div class="mb-3 border-top">    <!---------------------------------------Agregar ITems-------------------------------------------->
                   <div class="m-3">
                      <h4>Desglose:</h4>
                   </div>

                    <div class="form-row">
                      <div class="row col-12 col-md-12">
                        <div class="col-12 col-sm-8 col-lg-3 col-xl-3 mt-4 mb-2">
                          <label>Descripción</label>
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

                        <div class=" col-6 col-sm-6 col-lg-4 col-xl-2 mt-4 mb-2">
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
                        <div class=" col-6 col-sm-6 col-lg-4 col-xl-2 mt-4 mb-2">
                          <label >Sección</label>
                          <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_seccion_id" id="gos_seccion_id" onchange="">
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
                  </form>
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
                       <?php if ($itempres!=null): ?>
                        <?php foreach ($itempres as $item): ?>
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
                       <?php endif; ?>
                      </tbody>
                    </table>
                     <label  id="errorespresupuestositms" style="display: none; color:red;">Agregar Item</label>
                  </div>
              </div>

            <div class='container-fluid'> <!----------------------------------------cierre------------------------------------------>

                    <div class="row border-top">
                        <div class="col-9">
                          <div class="row mb-3">
                            <div class="col-8 col-sm-4 col-md-2">
                              <label class="m-2">MO Laminado:</label>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                  <input type="text" name="manolm" id="molaminado" class="form-control" disabled>
                              </div>
                            </div>
                            <div class="col-8 col-sm-4 col-md-2">
                              <label class="m-2">MO Mecanica:</label>
                             <div class="input-group input-group-sm">
                               <div class="input-group-prepend">
                                   <span class="input-group-text">$</span>
                               </div>
                                 <input type="text" name="manoobrapintura" id="momecanica" class="form-control" disabled>
                             </div>
                            </div>
                              <div class="col-8 col-sm-4 col-md-2">
                                <label class="m-2">MO TOT:</label>
                                <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                    <input type="text" name="manoobrapintura" id="motot" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-8 col-sm-4 col-md-2">
                                <label class="m-2">MO Pintura:</label>
                                <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                    <input type="text" name="precipintura" id="PPintura" class="form-control" value="{{$totalpin ??''}}"disabled>
                                </div>
                              </div>
                              <div class="col-8 col-sm-4 col-md-2">
                                  <label class="m-2">MO Refacciones:</label>
                                <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                    <input type="text" name="" id="manoobraref" class="form-control" value=""disabled>
                                </div>
                              </div>
                              </div>

                          <div class="row mb-3">
                              <div class="col-8  col-sm-4 col-md-2">
                                 <button type="button" class="btn btn-primary  w-100" onclick="WsValuacion({{$OS->gos_os_id}});" ><i class="fas fa-file-import"></i>Enviar Valuacion</button>
                              </div>

                              <div class="col-8  col-sm-4 col-md-2">
                                <button type="button" class="btn btn-secondary  w-100" onclick="displmodalfotos()"><i class="fas fa-camera"></i>Fotos Valuacion</button>
                              </div>
                              <div class="col-8  col-sm-4 col-md-2">
                                 <a href="Presupuestos/{{$pres->gos_pres_id}}/Imprimir/HV" target="_blank" type="button" class=" btn btn-outline-secondary w-100" id="" style="margin-bottom: 1rem;" ><i class="fas fa-car"></i>Hoja Viajera</a>
                              </div>
                              <div class="col-8  col-sm-4 col-md-2">
                                <a  href="Presupuestos/{{$pres->gos_pres_id}}/Imprimir/HV" target="_blank" type="button" class=" btn btn-outline-secondary w-100" id=""  style="margin-bottom: 1rem;" ><i class="fas fa-print"></i>Imprimir</a>
                              </div>
                          </div>
                        </div>


                    <div class="col-3">
                           <div class="form-group mt-3">
                             <form id="presupuesto-cierre-form">
                                       <div class="row  col-sm-12">
                                           <label class="col-4  col-form-label text-right">Sub-Total</label>
                                           <div class="col-8 ">
                                               <div class="input-group input-group-sm">
                                                   <div class="input-group-prepend">
                                                       <span class="input-group-text">$</span>
                                                   </div>
                                                   <input type="text" name="SubTotal2" id="subtotal2" class="form-control" value="" disabled>
                                                   <input type="hidden" name="SubTotal" id="subtotal" class="form-control" value="" >
                                               </div>
                                           </div>
                                       </div>
                                       <div class="row  col-sm-12">
                                           <label class="col-4  col-form-label text-right">Descuento</label>
                                           <div class="col-8">
                                               <div class="input-group input-group-sm">
                                                   <div class="input-group-prepend">
                                                       <!--<button type="button" class="input-group-text btnCambioPeso">$</button>-->
                                                       <button type="button" class="input-group-text btnCambioPorciento"  >%</button>
                                                   </div>
                                                   <input type="hidden" id="descuento-tipo" name="descuentotipo" value="porcentaje">
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
                                               <button type="button" class="btn btn-success w-100" id="editarpresqualitas">
                                                   Guardar
                                               </button>
                                           </div>
                                       </div>
                               </form>

                            </div>
                         </div>
                    </div>
              </div>
      </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalfotosqlts">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header"><h5>Fotos Internas(valuacion)</h5></div>
    <form class="" action="" method="post" enctype="multipart/form-data">
      @csrf
    <div class="modal-body">
      <div class="container">
      <div class="row" id="img-os-internas">
             @foreach ($listaImgInternas as $key => $imgInt)
                <div class='col-4 col-sm-3 col-md-2 text-center mb-2' id="imginterna_{{$imgInt->gos_os_imagen_interna_id}}">
            
                    <a class="popup-link-img" href='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'>
                        <img src='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'
                        style='border-radius:50%; height: 100px; width: 100px;'>
                    </a>
                </div>
            @endforeach
      </div>
      </div>

         <input type="hidden" id="tipofileqlt" name="tipofileqlt" value="">
           <input type="hidden" id="carpetaqlts" name="carpetaqlts" value="">
         <input class="form-control"  id="inputenviarfiles" type="file" name="archivosQlt[]" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Subir Imagenes</button>
      </div>
     </form>
    </div>
  </div>
</div>
@endsection
@section('ScriptporPagina')
  <script src="../gos/js/jsitemspresupuesto.js"></script>
	<script src="../gos/ajax-presupuestos.js"></script>
	<script src="../gos/ajax-presupuesto-items.js"></script>
    <script src="../gos/Presupuestos/ajax-presupueso-qualitas.js"></script>
  <script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
@endsection
