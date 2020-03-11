{{-- Modal Edicion Etapa --}}
<div class="modal fade" id="modalEtapa" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalEtapa"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- @include('Layout/errores') --}}
                <form id="etapaForm" >
                    @csrf
                    <input type="hidden" name="gos_paq_etapa_id" id="gos_paq_etapa_id">
                    <input type="hidden" name="gos_etapa_asesor_id" id="gos_etapa_asesor_id">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Etapas</label>
                                <input type="text" id="nomb_etapa" name="nomb_etapa" class="form-control">
                                <small style="font-style: italic;" class="nomb_etapa form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcion_etapa" name="descripcion_etapa" class="form-control">
                                <small style="font-style: italic;" class="descripcion_etapa form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Comisión</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text btnCambioPesoComision">$</button>
                                        <button type="button" class="input-group-text btnCambioPorcientoComision d-none">%</button>
                                    </div>
                                    <input type="hidden" id="comision_asesor_tipo" name="comision_asesor_tipo" value="PORCIENTO">
                                    <input type="text"name="comision_asesor" id="comision_asesor" class="form-control">
                                </div>
                                <small style="font-style: italic;" class="comision_asesor form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Asesor</label>
                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id">
                                    <option></option>
                                    @foreach ($listaAsesores as $asesor)
                                    <option value="{{$asesor->gos_usuario_id}}">{{$asesor->nombre_apellidos}}</option>
                                    @endforeach
                                </select>
                                <small style="font-style: italic;" class="gos_usuario_tecnico_id_error form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tiempo Meta</label>
                                <input type="text" id="tiempo_meta" name="tiempo_meta" class="form-control">
                                <small style="font-style: italic;" class="tiempo_meta form-text text-danger"></small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mínimo de Fotos</label>
                                <input type="text" id="minimo_fotos" name="minimo_fotos" class="form-control">
                                <small style="font-style: italic;" class="minimo_fotos form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body p-0">
                            <div class="accordion accordion-light">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#MensajesWS" aria-expanded="false">
                                            <i class="flaticon2-plus"></i> Agregar Mensaje de Whatsapp
                                        </div>
                                    </div>
                                    <div id="MensajesWS" class="collapse">
                                        <div class="card-body">
                                            {{-- @include('Etapas/mensajesWS') --}}
                                            <input type="hidden" name="gos_paq_etapa_mensaje_id_1" id="gos_paq_etapa_mensaje_id_1">
                                            <div class="form-group">
                                                <label>Titulo del Mensaje (Opcion 1)</label>
                                                <input type="text" class="form-control" name="mensaje_nomb_1" id="mensaje_nomb_1">
                                            </div>
                                            <div class="form-group">
                                                <label>Mensaje de Whatsapp 1 <i class="fas fa-info-circle fa-sm"></i></label>
                                                <textarea class="form-control" rows="3" name="mensaje_cuerpo_1" id="mensaje_cuerpo_1"></textarea>
                                            </div>
                                            <input type="hidden" name="gos_paq_etapa_mensaje_id_2" id="gos_paq_etapa_mensaje_id_2">
                                            <div class="form-group">
                                                <label>Titulo del Mensaje (Opcion 2)</label>
                                                <input type="text" class="form-control" name="mensaje_nomb_2" id="mensaje_nomb_2">
                                            </div>
                                            <div class="form-group">
                                                <label>Mensaje de Whatsapp 2 <i class="fas fa-info-circle fa-sm"></i></label>
                                                <textarea class="form-control" rows="3" name="mensaje_cuerpo_2" id="mensaje_cuerpo_2"></textarea>
                                            </div>
                                            <input type="hidden" name="gos_paq_etapa_mensaje_id_3" id="gos_paq_etapa_mensaje_id_3">
                                            <div class="form-group">
                                                <label>Titulo del Mensaje (Opcion 3)</label>
                                                <input type="text" class="form-control" name="mensaje_nomb_3" id="mensaje_nomb_3">
                                            </div>
                                            <div class="form-group">
                                                <label>Mensaje de Whatsapp 3 <i class="fas fa-info-circle fa-sm"></i></label>
                                                <textarea class="form-control" rows="3" name="mensaje_cuerpo_3" id="mensaje_cuerpo_3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#calculos_tiempos" aria-expanded="false">
                                            <i class="flaticon2-plus"></i>Cálculo de Tiempo
                                        </div>
                                    </div>
                                    <div id="calculos_tiempos" class="collapse">
                                        <div class="card-body">
                                            {{-- @include('Etapas/calculotiempo') --}}
                                            {{-- @include('Etapas/CalculoTiempoEditado') --}}
                                            @include('Etapas/calc_tiempo_html')

                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#etapas_relacionadas" aria-expanded="false">
                                            <i class="flaticon2-plus"></i> Agregar más Datos
                                        </div>
                                    </div>
                                    <div id="etapas_relacionadas" class="collapse">
                                      <div class="card-body">
                                            <div class="form-group row">
                                                  <label  class="col-8 col-form-label">Perdida Total<i class="fas fa-info-circle"></i></label>
                                                  <div class="col-4">
                                                      <span class="kt-switch kt-switch--sm">
                                                          <label>
                                                              <input type="checkbox" name="checkperdida" id="chekperdida"> <span></span>
                                                          </label>
                                                      </span>
                                                  </div>
                                                <div class="col-11">
                                                       <select id="perdida_total_id" name="perdida_total_id[]"class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" multiple>
                                                        @foreach ($listaEtapasPerdidasTotales as $perdidaTotal)
                                                        <option value="{{$perdidaTotal->gos_paq_etapa_id}}">{{$perdidaTotal->nomb_etapa}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                              <label  class="col-8 col-form-label">Etapas Ligadas <i class="fas fa-info-circle"></i></label>
                                              <div class="col-4">
                                                  <span class="kt-switch kt-switch--sm">
                                                      <label>
                                                          <input type="checkbox" name="chekligada" id="chekligada"> <span></span>
                                                      </label>
                                                  </span>
                                              </div>
                                                <div class="col-11">
                                                  <select id="etapa_ligada_id" name="etapa_ligada_id[]"  class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" multiple>
                                                        @foreach ($listaEtapasLigadas as $etapaLigada)
                                                        <option value="{{$etapaLigada->gos_paq_etapa_id}}">{{$etapaLigada->nomb_etapa}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                              <label  class="col-8 col-form-label"> Pago de Daños <i class="fas fa-info-circle"></i></label>
                                              <div class="col-4">
                                                  <span class="kt-switch kt-switch--sm">
                                                      <label>
                                                          <input type="checkbox" name="checkpao" id="checkpao"> <span></span>
                                                      </label>
                                                  </span>
                                              </div>
                                                <div class="col-11">
                                                         <select id="etapa_danio_id" name="etapa_danio_id[]"  class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" multiple>
                                                        @foreach ($listaEtapasDanios as $etapaDanio)
                                                        <option value="{{$etapaDanio->gos_paq_etapa_id}}">{{$etapaDanio->nomb_etapa}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-8 col-form-label">Genera valor a Cliente <i class="fas fa-info-circle"></i> </label>
                                                <div class="col-4">
                                                    <span class="kt-switch kt-switch--sm">
                                                        <label>
                                                            <input type="checkbox" name="genera_valor" id="genera_valor"> <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-8 col-form-label">Complementos <i class="fas fa-info-circle"></i></label>
                                                <div class="col-4">
                                                    <span class="kt-switch kt-switch--sm">
                                                        <label>
                                                            <input type="checkbox" name="complemento" id="complemento"><span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-8 col-form-label">Materiales <i class="fas fa-info-circle"></i></label>
                                                <div class="col-4">
                                                    <span class="kt-switch kt-switch--sm">
                                                        <label>
                                                            <input type="checkbox"name="materiales" id="materiales"><span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-8 col-form-label">Refacciones <i class="fas fa-info-circle"></i></label>
                                                <div class="col-4">
                                                    <span class="kt-switch kt-switch--sm">
                                                        <label>
                                                            <input type="checkbox"	name="refacciones" id="refacciones"><span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-last">
                                                <label>Agregar Link</label>
                                                <textarea class="form-control" rows="3" name="link" id="link"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-brand btn-block" id="guardarEtapa">Guardar</button>
                    {{-- <button class="btn" type="button" id="btnGuardarEtapa">Guardar</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
    {{-- Fin Modal Edicion Etapa --}}
