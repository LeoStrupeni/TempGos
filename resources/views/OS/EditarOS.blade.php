
@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title" id="TitleOrden">Orden de servicio</h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-actions">

      </div>
    </div>
  </div>
  <div class="kt-portlet__body p-1">

<!------------------------------------------------------------CLIENT section BGN----------------------------------------------------------------------->
 <div class="conainer-fluid p-3">
   <input type="hidden" name="clienteid" id="osid" value="{{$os->gos_os_id??''}}">
   <form id="allform" action="" method="post">
       @csrf
       <div class="form-row">

               <div class="form-group col-4 col-md-2  pl-2 mb-3" id="cls-buscarcliente">
                   <label >Cliente</label>
                   <div class="input-group">
                       <input type="text" class="form-control" id="nomb_cliente" name="" value= "{{$os->nomb_cliente ??''}} " readonly>
                       <input type="hidden" name="clienteid" id="gos_cliente_id" value="0">
                       <input type="hidden" name="vehiculoid" id="gos_vehiculo_id" value="0">
                       <div class="input-group-append">
                           <button type="button" class="btn btn-primary p-0"
                           data-toggle="modal" data-target="#modalbuscarcliente">
                               <i class="fas fa-pen kt-shape-font-color-1 p-0"></i>
                           </button>
                       </div>
                   </div>
                   <small style="font-style: italic;" class="nomb_cliente form-text text-danger"></small>
               </div>

           <div class="form-group col-6 col-md-3  mb-3">
               <label ><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></label>
               <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" value="@if(isset($os)) {{$os->detallesVehiculo }} @endif" disabled>
           </div>

           <div class="form-group col-6 col-md-2  mb-3">
               <label >Aseguradora</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id" id="gos_aseguradora_id">
                   <option></option>

                     @foreach ($listaAseguradoras as $aseguradora)
                     <option value="{{$aseguradora->gos_aseguradora_id}}" <?php if ($aseguradora->gos_aseguradora_id==$os->gos_aseguradora_id): ?>selected<?php endif; ?>>{{$aseguradora->empresa}}</option>
                     @endforeach
               </select>
               <small style="font-style: italic;" class="gos_aseguradora_id form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-1  mb-3">
               <label >TOT</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_ot_id" id="gos_ot_id">
                   <option></option>
                   @foreach ($listaTot as $totS)
                   <option value="{{$totS->gos_ot_id}}"<?php if ($totS->gos_ot_id==$os->gos_ot_id): ?>selected<?php endif; ?>>{{$totS->nomb_ot}}</option>
                   @endforeach
               </select>
               <small style="font-style: italic;" class="gos_ot_id form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-1  mb-3">
               <label ># <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?>{{$taller_conf_ase->nomb_campo_poliza ??''}}<?php else: ?>Poliza<?php endif; ?></label>
               <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="@if(isset($os)) {{$os->nro_poliza }} @endif">
               <small style="font-style: italic;" class="nro_poliza form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-1  mb-3">
               <label  class="text-truncate"># Siniestro</label>
               <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="@if(isset($os)) {{$os->nro_siniestro }} @endif">
               <small style="font-style: italic;" class="nro_siniestro form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-2  mb-3">
               <label >Riesgo</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_riesgo_id" id="gos_os_riesgo_id">
                   <option></option>
                   @foreach ($listaRiesgos as $riesgoS)
                   <option value="{{$riesgoS->gos_os_riesgo_id}}" <?php if ($riesgoS->gos_os_riesgo_id==$os->gos_os_riesgo_id): ?>selected<?php endif; ?>> {{$riesgoS->nomb_riesgo}}</option>
                   @endforeach
               </select>
               <small style="font-style: italic;" class="gos_os_riesgo_id form-text text-danger"></small>
           </div>
       </div>
   <!-- COMIENZO SEGUNDA FILA  -->
       <div class="form-row">
           <div class="form-group col-4 col-md-1  pl-2 mb-0">
               <label ><?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?>{{$taller_conf_ase->nomb_campo_reporte ??''}}<?php else: ?>Reporte<?php endif; ?></label>
               <input type="text" class="form-control" name="nro_reporte" id="nro_reporte" value="@if(isset($os)) {{$os->nro_reporte }} @endif">
               <small style="font-style: italic;" class="nro_reporte form-text text-danger"></small>
           </div>
           <div class="form-group col-4 col-md-1  mb-0">
               <label >Orden</label>
               <input type="text" class="form-control" name="nro_orden" id="nro_orden_interno" value="{{$os->nro_orden ??''}}">
               <input type="hidden" class="form-control" name="nro_orden_interno" value="@if(isset($os)) {{$os->nro_orden_interno }} @endif">
               <small style="font-style: italic;" class="nro_orden_interno form-text text-danger"></small>
           </div>
           <div class="form-group col-4 col-md-2  mb-0">
               <label >Tipo de Orden</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_o_id" id="gos_os_tipo_o_id">
                   @foreach ($listaTipoOrden as $tipoOrdenS)
                   <option value="{{$tipoOrdenS->gos_os_tipo_o_id}}" <?php if ($tipoOrdenS->gos_os_tipo_o_id==$os->gos_os_tipo_o_id): ?>selected<?php endif; ?>>{{$tipoOrdenS->tipo_orden}}</option>
                   @endforeach
               </select>
               <small style="font-style: italic;" class="gos_os_tipo_o_id form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-2 ">
               <label >Daño</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_danio_id" id="gos_os_tipo_danio_id">
                   @foreach ($listaDanios as $danioS)
                   <option value="{{$danioS->gos_os_tipo_danio_id}}" <?php if ($danioS->gos_os_tipo_danio_id==$os->gos_os_tipo_danio_id): ?>selected<?php endif; ?>>{{$danioS->tipo_danio}}</option>
                   @endforeach
               </select>
               <small style="font-style: italic;" class="gos_os_tipo_danio_id form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-2  mb-0">
               <label >Estatus</label>
               <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_estado_exp_id" id="gos_os_estado_exp_id">
                   <option></option>
                   @foreach ($listaEstadosExp as $estadoExp)
                   <option value="{{$estadoExp->gos_os_estado_exp_id}}" <?php if ($estadoExp->gos_os_estado_exp_id==$os->gos_os_estado_exp_id): ?>selected<?php endif; ?> >{{$estadoExp->estado_expediente}}</option>
                   @endforeach
               </select>
               <small style="font-style: italic;" class="gos_os_estado_exp_id form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-2  mb-0">
               <label >Demérito</label>
               <input type="text" class="form-control" name="demerito" id="demerito" value="@if(isset($os)) {{$os->demerito }} @endif">
               <small style="font-style: italic;" class="demerito form-text text-danger"></small>
           </div>
           <div class="form-group col-6 col-md-2  mb-0">
               <label >Deducible</label>
               <input type="text" class="form-control" name="deducible" id="deducible" value="@if(isset($os)) {{$os->deducible }} @endif">
               <small style="font-style: italic;" class="deducible form-text text-danger"></small>
           </div>
       </div>

 </div>
<!------------------------------------------------------------CLIENT section END----------------------------------------------------------------------->

<!-----------------------------------------------------------ETAPA PAQUETES PRODUCTOS BGN------------------------------------->
<div class="container-fluid p-3">
  <div class="border-top"><!---------------------------Begin Items--------------------------------------->
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


          <div class="form-row">
            <div class="form-group col-6 col-sm-4 col-md-2">
              <label>Etapa</label>
              <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="" id="gos_paq_etapa_id" onchange="MostrarSelectEtapa();">
                <option></option>
                @foreach ($listaEtapas as $etapa)
                <option value="{{$etapa->gos_paq_etapa_id}}"> {{$etapa->nomb_etapa}}</option>
                @endforeach
              </select>
            <small style="font-style: italic; display: none;" id="smallvaletapa" class=" form-text text-danger">Campo obligatorio</small>
            </div>
            <div class="form-group col-6 col-sm-4 col-md-2">
              <label>Servicio</label>
              <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="" id="gos_paq_servicio_id" onchange="MostrarSelectServicio();">
                <option></option>
                @foreach ($listaServicios as $servicio)
                <option value="{{$servicio->gos_paq_servicio_id}}"> {{$servicio->nomb_servicio}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-sm-4 col-md-3">
              <label>Descripción</label>
              <input type="text" class="form-control" name="" id="descripcion_etapa" value="" disabled>
            </div>
            <div class="form-group col-6 col-sm-4 col-md-2">
              <label>Asesor</label>
              <input type="text" class="form-control" name="" id="asesor_asignado" value="" disabled>
             <input type="hidden" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id" value="">
            </div>
            <div class="form-group col-5 col-sm-4 col-md-1">
              <label>Total</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text p-1">$</span>
                </div>
                <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_total" id="gos_etapa_total" value="">
              </div>
            </div>
            <div class="form-group col-5 col-sm-3 col-md-1">
              <label>M. O.</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text p-1">$</span>
                  </div>
                  <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_MO" id="gos_etapa_MO" value="">
              </div>
            </div>
            <div class="form-group col-1 align-self-end">
                <button type="button" id="btn_ItemEtapaOS" class="btn btn-success" style="height:40px;" onclick="AgregarEtapa();">
                  <i class="fas fa-plus p-0" style="color: white!important;"></i>
                </button>
            </div>

          </div>
      </div>
      <div class="tab-pane" id="collapsePaquete" role="tabpanel">
          <div class="form-row">
            <div class="form-group col-6 col-sm-3">
              <label>Paquete</label>
              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="" id="gos_paquete_id">
                <option></option>
                @foreach ($listaPaquetes as $paquete)
                <option value="{{$paquete->gos_paquete_id}}">{{$paquete->nomb_paquete}}</option>
                @endforeach
              </select>
              <small style="font-style: italic; display: none;" id="smallvalpaquete" class=" form-text text-danger">Campo obligatorio</small>
            </div>
            <div class="form-group col-6 col-sm-3">
              <label>Descripción</label>
              <input type="text" class="form-control" name="" id="descripcion_paquete" disabled>
            </div>
            <div class="form-group col-1 col-sm-1 align-self-end">
                <button type="button" id="btn_ItemPaqueteOS" class="btn btn-success" style="height:40px;" onclick="AgregarPaquete();">
                  <i class="fas fa-plus p-0" style="color: white!important;"></i>
                </button>
            </div>
          </div>
      </div>
      <div class="tab-pane " id="collapseProducto" role="tabpanel">
          <div class="form-row">
            <div class="form-group col-6 col-sm-3">
              <label>Código</label>
              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="" id="gos_producto_id" onchange="MostrarSelectProducto();">
                  <option></option>
                  @foreach ($listaProductos as $producto)
                  <option value="{{$producto->gos_producto_id}}">{{$producto->codigo}}</option>
                  @endforeach
              </select>
            <small style="font-style: italic; display: none;" id="smallvalprod" class=" form-text text-danger">Campo obligatorio</small>
            </div>
            <div class="form-group col-6 col-sm-3">
              <label>Nombre</label>
              <input type="text" class="form-control" name="" id="nomb_producto_real" value="" disabled>
            </div>
            <div class="form-group col-5 col-sm-2">
              <label>Cantidad</label>
              <input type="text" class="form-control pl-1 pr-0" id="gos_producto_cantidad"  value="1">
            </div>
            <div class="form-group col-5 col-sm-2">
              <label>P.Venta.</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text p-1">$</span>
                </div>
                <input type="text" class="form-control pl-1 pr-0" id="gos_producto_venta">
              </div>
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
<!-----------------------------------------------------------ETAPA PAQUETES PRODUCTOS END------------------------------------->


<!-----------------------------------------------------------TABLES BGN------------------------------------->
<div class="container-fluid p-3">
      <div class="table-responsive table-sm p-1">
          <table class="table table-hover my-4 " id="dt-lista-items-os" style="font-size: 1rem;">
              <thead class="thead-light">
                  <tr style="font-weight: 500;">

                      <th>Orden</th>
                      <th>Etapa</th>
                      <th>Descripción</th>
                      <th>Servicio</th>
                      <th>Código SAT</th>
                      <th>Asesor</th>
                      <th>Precio</th>
                      <th>Materiales</th>
                      <th>Importe</th>
                      <th>Estado</th>
                      <th style="width:3%;"></th>
                  </tr>
              </thead>
              <tbody id="dt_lista_items_os_body">
               <?php $totalitems=0; foreach ($ositems as $ositem):  ?>
                 <?php if ($ositem->gos_producto_id==0 ||$ositem->gos_producto_id==null): ?>
                <tr>

                  <td> <input style="width: 3rem;" type="text" class="form-control" name="orden[{{$ositem->gos_os_item_id}}]" value="{{$ositem->orden_etapa}}"></td>
                  <td>{{$ositem->nombre}}</td>
                  <td>{{$ositem->descripcion}}</td>
                  <td>{{$ositem->servicio}}</td>
                  <td>{{$ositem->codigo_sat}}</td>
                  <td><a  href="javascript:void(0);" style="text-decoration: none; color: #212529;" onclick="modalasesor({{$ositem->gos_os_item_id}})">{{$ositem->asesor}}</a></td>
                  <?php
                        $materiales=floatval ( $ositem->precio_materiales );
                        $importe=$ositem->precio_etapa+$materiales;
                        $totalitems=$totalitems+$importe?>
                  <td><input style="width: 10rem;" type="number" class="form-control" name="precioeta[{{$ositem->gos_os_item_id}}]" value="{{$ositem->precio_etapa}}"></td>
                  <td><input style="width: 10rem;" type="text" class="form-control" name="preciomat[{{$ositem->gos_os_item_id}}]" value="{{$materiales}}" disabled></td>
                  <td><input style="width: 10rem;" type="text" class="form-control"  value="{{$importe}}" disabled></td>
                  <td   <?php if ($ositem->estado_etapa=='A'): ?> style="color: blue;  text-align: center; font-size: 1rem;  font-weight: bold;" <?php else: ?> style=" text-align: center; font-size: 1rem;  font-weight: 800;" <?php endif; ?>>
                    <?php $etiestado="Pendiente";  if($ositem->estado_etapa=='A'){$etiestado="Activa" ;}  if($ositem->estado_etapa=='F'){$etiestado="Finalizada" ;} ?>
                   {{$etiestado}}
                  </td>
                  <td>
                    <span class="dropdown"> <a href="javascript:void(0);"class="btn btn-sm btn-clean btn-icon btn-icon-md"data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                       <div class="dropdown-menu dropdown-menu-right">
                         <a href="/ordenes-serv/{{$os->gos_os_id}}/{{$ositem->gos_os_item_id}}/editarorden/0" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"> <i class="fas fa-arrow-up"></i>Subir
                         </a>
                         <a href="/ordenes-serv/{{$os->gos_os_id}}/{{$ositem->gos_os_item_id}}/editarorden/1" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"> <i class="fas fa-arrow-down"></i> Bajar
                         </a>
                         <a href="/ordenes-serv/{{$ositem->gos_os_item_id}}/editar/eliminaritem" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"> <i class="la la-trash"></i> Borrar
                         </a>
                          <?php if ($ositem->estado_etapa=='A'): ?>
                            <a href="/ordenes-serv/{{$ositem->gos_os_item_id}}/estadoeta/0" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"> <i class="fas fa-stop-circle"></i>Desactivar
                            </a>
                            <?php endif; ?>
                            <?php if ($ositem->estado_etapa=='NA'): ?>
                             <a href="/ordenes-serv/{{$ositem->gos_os_item_id}}/estadoeta/1" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"><i class="fas fa-check-circle"></i>Activar
                             </a>
                           <?php endif; ?>
                       </div>
                     </span>
                 </td>
                </tr>
                <?php endif; ?>
               <?php endforeach; ?>
              </tbody>
          </table>
          <small id="smalltableoscreate" class="form-text text-danger"></small>
      </div>

    <div class="table-responsive table-sm p-1">
    <table class="table table-sm table-hover my-4" id="dt-lista-producto-os" style="font-size: 1rem;">
    					<thead class="thead-light">
    						<tr style="font-weight: 500;">

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
    					<tbody id="dt_lista_items_os_body">
                <?php foreach ($ositems as $ositem): ?>
                  <?php if ($ositem->gos_producto_id>0): ?>
                    <tr>

                      <td>{{$ositem->nombre}}</td>
                      <td>{{$ositem->descripcion}}</td>
                      <td>{{$ositem->codigo_sat}}</td>
                      <td>{{$ositem->cantidad}}</td>
                      <?php
                            $cantidad=floatval ( $ositem->cantidad );
                            $precio=$ositem->precio_etapa+$ositem->precio_servicio+$ositem->precio_mo;
                            $importe=$precio*$cantidad*(1-($ositem->descuento/100));
                            $totalitems=$totalitems+$importe;  ?>
                      <td>{{$precio}}</td>
                      <td>{{$ositem->descuento}}</td>
                      <td>{{$importe}}</td>
                      <td>
                        <span class="dropdown"> <a href="javascript:void(0);"class="btn btn-sm btn-clean btn-icon btn-icon-md"data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                           <div class="dropdown-menu dropdown-menu-right">
                             <a href="/ordenes-serv/{{$ositem->gos_os_item_id}}/editar/eliminaritem" id="borrarPresupuesto"data-toggle="tooltip" data-original-title="Delete"class="delete dropdown-item"> <i class="la la-trash"></i> Borrar
                             </a>
                           </div>
                         </span>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
    					</tbody>
    				</table>
          <small id="smalltableoscreate" class="form-text text-danger"></small>
      </div>
    </div>
<!-----------------------------------------------------------TABLES END------------------------------------->


<!-----------------------------------------------------------CIERRE BGN--------------------------------------------->
<div class="container-fluid p-3">
  <div class="row mt-5">
      <div class="col-12">
              <div class="row">
                  <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                      <label class="" >Creación de orden</label>
                      <div class="input-group date">
                          <input type="text" class="form-control"  id="kt_datetimepicker_2" name="fecha_creacion_os"   value="@if(isset($os)) {{$os->fecha_creacion_os }} @endif"  readonly = "readonly">
                          <div class="input-group-append">
                              <span class="input-group-text p-0">
                                  <i class="la la-calendar-check-o"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                      <label >Ingreso del <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>vehiculo<?php endif; ?></label>
                      <div class="input-group date">
                          <input type="text" class="form-control" id="kt_datetimepicker_2"   value="@if(isset($os)) {{0 != $os->fecha_ingreso_v_os ? $os->fecha_ingreso_v_os : '' }} @endif" name="fecha_ingreso_v_os"  readonly = "readonly">
                          <div class="input-group-append">
                              <span class="input-group-text p-0">
                                  <i class="la la-calendar-check-o"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                      <label >Fecha de Promesa</label>
                      <div class="input-group date">
                          <input type="text" class="form-control" id="kt_datetimepicker_2" value="@if(isset($os)) {{ 0 != $os->fecha_promesa_os ? $os->fecha_promesa_os : ''  }} @endif"  name="fecha_promesa" id="fecha_promesa" >
                          <div class="input-group-append">
                              <span class="input-group-text p-0">
                                  <i class="la la-calendar-check-o"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                      <label >Anticipo</label>
                      <select id="anticipo" class="custom-select"   value="@if(isset($os)) {{$os->Anticipo }} @endif" name="tipoAnticipo" id="tipoAnticipo " >
                          <option value="no" @isset($checkAnticipo){{'no'== $checkAnticipo ?'selected' : ''}}@endisset>No</option>
                          <option value="si" @isset($checkAnticipo){{'si'== $checkAnticipo ?'selected' : ''}}@endisset>Si</option>
                      </select>
                  </div>
              </div>
              <div class="container m-3">

              </div>



      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-2 col-md-6 col-lg-7">

          </div>
          <div class="col-10 col-md-6  col-lg-5" >
            <div class=" row  col-sm-12 ">
                <label class="col-4 col-form-label text-right" >Importe</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="importeTotal" id="importeTotal" class="form-control" value="{{$totalitems}}" disabled>
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
                <small style="font-style: italic;" class="descuento form-text text-danger"></small>
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

                        <input type="text" name="iva" id="ivaedt2" class="form-control" <?php if ( $os->iva > 0): ?> value="{{$os->iva ??'' }}" <?php else: ?> value="16" <?php endif; ?> />
                    </div>
                </div>
                <small style="font-style: italic;" class="iva form-text text-danger"></small>
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
                    <button type="submit" class="btn btn-success w-100" id="btn_guardar_OS">
                        Guardar
                    </button>
                </div>
            </div>
          </div>
        </div>
          </form>
      </div>
  </div>
</div>
<!-----------------------------------------------------------CIERRE END--------------------------------------------->
<!-----------------------------------------------------------Anticipos------------------------------------------------>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalanticipos">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Anticipos</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
      <div class="card">
       <div class="card-body">
         <form class="" action="/ordenes-serv/{{$os->gos_os_id}}/agregarAnticipo" method="post">
           @csrf
         <div class="row">
         <div class="col-3 m-3">
             <label >Tipo de Pago</label>
             <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id" required>
                 <option></option>
                 @foreach ($listaMetodos as $metodoPago)
                 <option value="{{$metodoPago->gos_metodo_pago_id}}">{{$metodoPago->nomb_met_pago}}</option>
                 @endforeach
             </select>
         </div>
         <div class="col-3 m-3">
             <label >Monto de anticipo</label>
             <div class="input-group">
                 <div class="input-group-prepend">
                     <span class="input-group-text p-0">$</span>
                 </div>
                 <input type="number" class="form-control" name="monto_abono" id="monto_abono" required>
             </div>
         </div>
         <div class="col-3 m-3">
             <label >Fecha de abono</label>
             <input type="text" class="form-control kt_datepicker_2" name="fecha_abono" id="fecha_abono" readonly>
         </div>
         <div class="col-1 m-3 align-self-end">
             <button type="submit" id="btn-AnticipoOS" class="btn btn-success" style="height:35.6px;" >
                 <i class="fas fa-plus p-0" style="color: white!important;"></i>
             </button>
         </div>
         <div class="col-12 m-3">
             <label >Observaciones</label>
             <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
         </div>
         <div class="col-12 m-2">
             <div class="table-responsive">
                 <table class="table table-sm table-hover" id="dt-lista-anticipos">
                     <thead class="thead-light">
                         <tr>
                             <th class="p-1">Forma De Pago</th>
                             <th class="p-1">Importe</th>
                             <th class="p-1">Fecha</th>
                             <th class="p-1">Observaciones</th>
                             <th class="p-1" style="width:3%;"></th>
                         </tr>
                     </thead>
                     <tbody>

                       <?php  $totalant=0;  foreach ($anticipos as $ant): $totalant=$totalant+$ant->monto_abono;  ?>
                          <tr>
                            <td>{{$ant->gos_forma_pago_id}}</td>
                            <td>{{$ant->monto_abono}}</td>
                            <td>{{$ant->fecha_abono}}</td>
                            <td>{{$ant->observaciones}}</td>
                          </tr>
                       <?php endforeach; ?>
                     </tbody>
              </table>
             </div>
         </div>
             <div class="col-5 offset-7">
                 <div class="form-group row mb-1 ">
                     <label class="col-4 col-form-label text-right">SUMA</label>
                     <input type="text" name="importeAnticipo" id="importeAnticipo" class="col-4 form-control " value="{{$totalant}}" readonly>
                 </div>
               <div class="form-group row mb-1 ">
                   <label class="col-4 col-form-label text-right">CAMBIO</label>
                   <input type="text" name="cambioAnticipo" id="cambioAnticipo" class="col-4 form-control" readonly>
               </div>
               <div class="form-group row mb-1">
                   <label class="col-4 col-form-label text-right">POR PAGAR</label>
                   <input type="text" name="porPagasAnticipo" id="porPagasAnticipo" class="col-4 form-control " readonly>
               </div>
           </div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------------------------Anticipos END---------------------------------------------------------------------------->

<!----------------------------------------------------------------------------MODAL ASIGNAR TECNICO----------------------------------------------------------------->

<!-----------------------------------------------------------------------------MODAL TECNICO------------------------------------------------------------------------->
  </div>
</div>

@include('OS/Clientes/ModalClienteVehiculos')

<div class="modal fade" id="modalAsignarAsesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tecnico Original:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form" id="formTecnicoServicios">
            <input type="hidden"  id="OSitemid" name="OSitemid"value="">
            <div class="form-row">
              <div class="col-md-12">
                <label for="">Tecnico</label>
                <select class="form-control kt-selectpicker" data-size="6" data-live-search="true"  name="Tecnico" id="selectecnico" >
                  <option value="0"></option>
                    <?php if ($listadoAsesores!=null): ?>
                      <?php foreach ($listadoAsesores as $tecnico): ?>
                              <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->nombre_apellidos}} | {{$tecnico->perfil}}</option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="postAsesor" >Guardar</button>
        </div>
      </div>
    </div>
    </form>
  </div>

@endsection

@section('ScriptporPagina')

<script src="{{env('APP_URL')}}/gos/OS/ajax-os-editarmx.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

@endsection
