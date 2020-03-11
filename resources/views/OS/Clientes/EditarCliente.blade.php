<div class="row"><!---------------------CLIENTES BEGIN---------------------->
    <div class="col">
        <form id="OS_Cliente_form">
            @csrf
            <input type="hidden" id="gos_os_id" name="gos_os_id" value="@if(isset($os)) {{$os->gos_os_id }} @endif">
            <input type="hidden" id="gos_vehiculo_id" name="gos_vehiculo_id" value="@if(isset($os)) {{$os->gos_vehiculo_id }} @endif">
            <input type="hidden" id="gos_cliente_id" name="gos_cliente_id" value="@if(isset($os)) {{$os->gos_cliente_id }} @endif">
            <input type="hidden" id="gos_usuario_id" name="gos_usuario_id" value="{{$usuario}}">

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
                        <small style="font-style: italic;" class="nomb_cliente form-text text-danger"></small>
                    </div>
                @else
                    <div class="form-group col-12 col-md-2 " style="top:24px;" id="btn-buscarcliente">
                        <button type="button" class="btn btn-primary w-100 text-truncate" data-toggle="modal"
                          data-target="#modalbuscarcliente">
                            Buscar cliente
                        </button>
                        <small style="font-style: italic;" class="nomb_cliente form-text text-danger"></small>
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
                        <small style="font-style: italic;" class="nomb_cliente form-text text-danger"></small>
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
                    <small style="font-style: italic;" class="gos_aseguradora_id form-text text-danger"></small>
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
                    <small style="font-style: italic;" class="gos_ot_id form-text text-danger"></small>
                </div>
                <div class="form-group col-6 col-md-1  mb-3">
                    <label ># <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?>{{$taller_conf_ase->nomb_campo_poliza ??''}}<?php else: ?>Poliza<?php endif; ?></label>
                    <input type="text" class="form-control" name="nro_poliza" id="nro_poliza" value="@if(isset($os)) {{$os->nro_poliza }} @endif">
                    <small style="font-style: italic;" class="nro_poliza form-text text-danger"></small>
                </div>
                <div class="form-group col-6 col-md-1  mb-3">
                    <label  class="text-truncate"># <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?>{{$taller_conf_ase->nomb_campo_siniestro ??''}}<?php else: ?>Siniestro<?php endif; ?></label>
                    <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro" value="@if(isset($os)) {{$os->nro_siniestro }} @endif">
                    <small style="font-style: italic;" class="nro_siniestro form-text text-danger"></small>
                </div>
                <div class="form-group col-6 col-md-2  mb-3">
                    <label >Riesgo</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_riesgo_id" id="gos_os_riesgo_id">
                        <option></option>
                        @foreach ($listaRiesgos as $riesgoS)
                        <option value="{{$riesgoS->gos_os_riesgo_id}}" {{$riesgoS->gos_os_riesgo_id== $riesgo ?'selected' : ''}}>
                            {{$riesgoS->nomb_riesgo}}</option>
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
                        <option value="{{$tipoOrdenS->gos_os_tipo_o_id}}" {{$tipoOrdenS->gos_os_tipo_o_id== $orden ?'selected' : ''}}>
                            {{$tipoOrdenS->tipo_orden}}</option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="gos_os_tipo_o_id form-text text-danger"></small>
                </div>
                <div class="form-group col-6 col-md-2 ">
                    <label >Daño</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_tipo_danio_id" id="gos_os_tipo_danio_id">
                        @foreach ($listaDanios as $danioS)
                        <option value="{{$danioS->gos_os_tipo_danio_id}}"  {{$danioS->gos_os_tipo_danio_id== $danio ?'selected' : ''}}>
                            {{$danioS->tipo_danio}}</option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="gos_os_tipo_danio_id form-text text-danger"></small>
                </div>
                <div class="form-group col-6 col-md-2  mb-0">
                    <label >Estatus</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_os_estado_exp_id" id="gos_os_estado_exp_id">
                        <option></option>
                        @foreach ($listaEstadosExp as $estadoExp)
                        <option value="{{$estadoExp->gos_os_estado_exp_id}}"  {{$estadoExp->gos_os_estado_exp_id== $estado ?'selected' : ''}}>
                            {{$estadoExp->estado_expediente}}</option>
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
        </form>
    </div>
</div><!---------------------CLIENTES END---------------------->
