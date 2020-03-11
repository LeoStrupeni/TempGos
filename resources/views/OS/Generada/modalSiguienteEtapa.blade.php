<div class="modal fade" id="modal-siguente-etapa" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalSiguienteEtapa">Siguiente etapa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                @include('Layout/errores')
                <form id="siguiente-etapa-form">
                    @csrf
                    <div class="form-group col-12 p-0 mb-3">
                        <label>Tiempo de inicio</label>
                        <div class="input-group date" >
                            <input type="text" class="form-control" placeholder="Selecciona fecha y hora" name="tiempo_inicio"  id="kt_datetimepicker_5" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="la la-calendar glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                        <input type="hidden" class="form-control" name="gos_os_item" id="gos_os_item" value="">
                    <div class="form-group col-12 p-0 mb-3">
                        <label>Tiempo final</label>
                        <div class="input-group date" >
                            <input type="text" class="form-control" placeholder="Selecciona fecha y hora" name="tiempo_final" id="kt_datetimepicker_3" value="<?= date("Y-m-d H:i") ?>"/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="la la-calendar glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12 p-0 mb-3">
                        <label>Etapa siguente</label>
                        <select class="form-control kt-selectpicker tipo_1" style="display:none;" data-live-search="true" data-size="5" name="gos_etapa_id" id="gos_etapa_id">
                            @if(isset($listaEtapas))
          					        @foreach ($listaEtapas as $etapa)
                            <option value="{{$etapa->gos_os_item_id}}">{{$etapa->nombre}}</option>
          					        @endforeach @endif
                        </select>
                        <select class="form-control kt-selectpicker tipo_2" style="display:none;" data-live-search="true" data-size="5" name="gos_etapa_id" id="gos_etapa_id">
                            @if(isset($listaEtapasS))
          					        @foreach ($listaEtapasS as $etapa)
                            <option value="{{$etapa->gos_os_item_id}}">{{$etapa->nombre}}</option>
          					        @endforeach @endif
                        </select>
                    </div>
                    <div class="form-group col-12 p-0 mb-3">
                        <label>Mensaje para el cliente <i class="fas fa-info-circle"></i></label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_mensaje_id" id="gos_mensaje_id">
                            <option></option>
                            {{-- @foreach ($listaMensajes as $mensaje)
                            <option value="{{$mensaje->gos_mensaje_id}}">{{$mensaje->mensaje}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                   <?php if ($conf_taller_os->etapa_simultanea==1): ?>
                     <div class="form-group col-12 col-12 p-0 mb-3">
                       <div class=" row">
                           <label class="col-8 col-form-label">Etapa Simultanea</label>
                           <div class="col-4">
                               <input style="font-size:20px;margin-top:15%;" type="checkbox" name="checketasimultanea" id="checketasimultanea">
                               <span></span>
                           </div>
                       </div>
                         <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="etasimultanea" id="etasimultanea" disabled>
                           <option></option>
                             @if(isset($listaEtapasS))
                               @foreach ($listaEtapasS as $etapa)
                              <option value="{{$etapa->gos_os_item_id}}">{{$etapa->nombre}}</option>
                               @endforeach @endif
                         </select>
                     </div>
                   <?php endif; ?>
                    <div class="row d-flex justify-content-center">
                                <a class="" id="whatsappEtapa"  style="-webkit-text-stroke-width: medium;">
                                    <div class="kt-demo-icon kt-font-success">
                                        <div class="kt-demo-icon__preview">
                                            <i class="socicon-whatsapp"></i>
                                        </div>
                                        <div class="">
                                            Enviar Whatsapp
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <div style="margin-left:2%; display: none; " class="form-group row" id="checkperdidapago">
                        <label class="col-8 col-form-label">Pérdida total o Pago de Daños</label>
                        <div class="col-4">
                            <input style="font-size:20px;margin-top:15%;" type="checkbox" name="perdidaTotal" id="perdidaTotal" >
                            <span></span>
                        </div>
                    </div>
                    <div style="margin-top:-10%; margin-left:2%" class="form-group row">
                        <label class="col-8 col-form-label">Desactivar etapa</label>
                        <div class="col-4">
                            <input style="font-size:20px;margin-top:15%;" type="checkbox" name="desactivar_etapa" id="desactivar_etapa" data-toggle="modal" data-target="#perdida_total_mensaje">
                            <span></span>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" id="btnGuardarSiguienteEtapa" class="btn btn-success btn-block mt-4">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="ModalPerdidatotal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enviar Vehiculo A Perdida Total</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="hideperdidatodal();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <label>Esta Seguro Que Desea Enviar El Vehiculo A Pago De Daños O Perdida Total ?</label>
        </div>
        <div class="row">
           <div class="col-6">
               <form  action="/osg-pagodaños" method="post">
                 @csrf
                 <input type="hidden" name="OSID" value="{{$os->gos_os_id}}">
                 <input type="hidden" name="Ativeitemidpago" id="perdidapagoactiveitem"value="{{$os->gos_os_id}}">
                 <button type="submit"  class="btn btn-block btn-warning"><i class="fas fa-exclamation-triangle"></i>Confirmar Pago de daños</button>
               </form>
           </div>
           <div class="col-6">
               <form  action="/osg-perdidatal" method="post">
                  @csrf
                 <input type="hidden" name="OSID" value="{{$os->gos_os_id}}">
                  <input type="hidden" name="Ativeitemidperdida" id="perdidapagoactiveitem2"value="{{$os->gos_os_id}}">
                 <button type="submit"  class="btn btn-block btn-danger"><i class="fas fa-exclamation-triangle"></i>Confirmar Perdida Total</button>
                </form>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideperdidatodal();">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="ModalPagoDaños">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enviar Vehiculo Pago de Daños</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="hidePagoDaños();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidePagoDaños();">Close</button>
      </div>
    </div>
  </div>
</div>
