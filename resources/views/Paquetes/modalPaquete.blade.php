<div class="modal fade" id="modalPaquete" role="dialog">
    <div class="modal-dialog modal-xl modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalPaquete"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-1">
            @include('Layout/errores')
                <form id="PaqueteForm">
                    @csrf
                    <input type="hidden" name="gos_paquete_id" id="gos_paquete_id">
                    <div class="form-group row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 pr-1">
                            <label>Nombre del paquete</label>
                            <input type="text" class="form-control" name="nomb_paquete" id="nomb_paquete">
                            <small style="font-style: italic;" class="nomb_paquete form-text text-danger"></small>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                            <label>Descripcion</label>
                            <input type="text" class="form-control" name="descripcion_paquete" id="descripcion_paquete">
                            <small style="font-style: italic;" class="descripcion_paquete form-text text-danger"></small>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                            <label>Codigo SAT</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="codigoSat" id="codigoSat">
                                <option value="0.00">Sin codigo</option>
                                @isset($listaCodigosSat)
                                    @foreach ($listaCodigosSat as $codigoSat)
                                    <option value="{{$codigoSat->CodigoSat_ID}}">{{$codigoSat->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <small style="font-style: italic;" class="codigoSat form-text text-danger"></small>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 pl-0">
                            <label>P. Venta</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-1">$</span>
                                </div>
                                <input type="text" class="form-control" name="precio_paquete" id="precio_paquete">
                            </div>
                            <small style="font-style: italic;" class="precio_paquete form-text text-danger"></small>
                        </div>
                    </div>
                    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
                </form>
                    <div>
                        <button id="guardarPaqueteParcial" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseEtapaPaquete">
                            {{-- data-target="#collapseEtapaPaquete"  --}}
                            <i class="fas fa-plus"></i>Etapa
                        </button>
                    </div>
                    <div class="collapse" id="collapseEtapaPaquete">
                        <div class="card card-body p-1">

                            <form id="ItemEtapaPAQ_form">
                                <input type="hidden" name="gos_paquete_id_item" id="gos_paquete_id_item">
                                <input type="hidden" name="nomb_etapa" id="nomb_etapa">
                                <input type="hidden" name="tiempo_meta" id="tiempo_meta">
                                <input type="hidden" name="minimo_fotos" id="minimo_fotos">
                                <input type="hidden" name="genera_valor" id="genera_valor">
                                <input type="hidden" name="complemento" id="complemento">
                                <input type="hidden" name="refacciones" id="refacciones">
                                <input type="hidden" name="comision_asesor" id="comision_asesor">
                                <input type="hidden" name="comision_asesor_tipo" id="comision_asesor_tipo">
                                <input type="hidden" name="materiales" id="materiales">
                                <input type="hidden" name="destajo" id="destajo">
                                <input type="hidden" name="link" id="link">
                                <input type="hidden" name="descripcion_etapa" id="descripcion_etapa">
                                <div class="form-row">
                                    <div class="form-group col-4 col-sm-3 mt-4 mb-2 px-1">
                                        <label>Etapa</label>
                                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paq_etapa_id" id="gos_paq_etapa_id" >
                                            <option value="0">Sin Etapa</option>
                                            @foreach ($listadoEtapas as $etapa)
                                            <option value="{{$etapa->gos_paq_etapa_id}}">{{$etapa->nomb_etapa}}</option>
                                            @endforeach
                                        </select>
                                          <small style="font-style: italic; display: none;" id="valseletapaid"class=" form-text text-danger">Campo obligatorio</small>
                                    </div>
                                    <div class="form-group col-4 col-sm-2 mt-4 mb-2">
                                        <label>Servicio</label>
                                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paq_servicio_id" id="gos_servicio_taller_id">
                                            <option value="0">Sin Servicio</option>
                                            @foreach ($listadoServicios as $servicio)
                                            <option value="{{$servicio->gos_paq_servicio_id}}">{{$servicio->nomb_servicio}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-4 col-sm-2 mt-4 mb-2">
                                        <label>Asesor</label>
                                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_usuario_asesor_id" id="gos_usuario_asesor_id">
                                            <option></option>
                                            @foreach ($listadoAsesores as $asesor)
                                            <option value="{{$asesor->gos_usuario_id}}">{{$asesor->apellidos}}, {{$asesor->nombre}}</option>
                                            @endforeach
                                        </select>
                                          <small style="font-style: italic; display: none;"  id="valselasesorid" class=" form-text text-danger">Campo Obligatorio</small>
                                    </div>
                                    <div class="form-group col-4 col-sm-2 mt-4 mb-2">
                                        <label>Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text p-1">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="precio_etapa" id="precio_etapa">
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-2 mt-4 mb-2">
                                        <label>M. O.</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text p-1">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="precio_mo" id="precio_mo">
                                        </div>
                                    </div>
                                    <div class="col-1 align-self-end p-0">
                                        <button type="button" id="btn_ItemEtapaPAQ" class="btn btn-success mb-2" style="height:40px;">
                                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="table-responsive table-sm p-1">
                        <table class="table table-sm table-hover my-4" id="dt-listaItemsPaquete" style="font-size: 1rem;">
                            <thead class="thead-light">
                                <tr style="font-weight: 500;">
                                    <th>ID</th>
                                    <th>Orden</th>
                                    <th>Etapa</th>
                                    <th>Servicio</th>
                                    <th>Asesor</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Importe</th>
                                    <th style="width:3%;"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" class="btn btn-success btn-block" id="btnGuardarPaquete">Guardar</button>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>

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
                              <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->nombre_apellidos}}</option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                </select>
              </div>

            </div>

           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="postAsesor" >Guardar</button>
        </div>
      </div>
    </div>
  </div>
