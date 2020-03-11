@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Ordenes Procesadas</h3>
        </div>

        {{-- {{dd($selectGrafico2)}} --}}
        {{-- @foreach($selectGrafico2 as $item)
            <option value="{{$item->item}}">{{$item->item}},{{$item->total}}</option>
        @endforeach --}}
        {{-- {{dd($selectGrafico1)}} --}}
        {{-- @foreach($selectGrafico1 as $item)
            <option value="{{$item->gos_fac_tipo_persona_id}}">{{$item->estado}},{{$item->cantidad}}</option>
        @endforeach --}}
        {{-- MENU DESPLEGABLE PARA EXPORTAR LA INFORMACION EN VARIOS FORMATOS --}}
        {{-- <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
                <div class="dropdown dropdown-inline">
                <div class="kt-portlet__body"></div>
                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-download"></i> Exportar
                </button>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(114px, 39px, 0px);">
                    <ul class="kt-nav">
                    <li class="kt-nav__section kt-nav__section--first">
                        <span class="kt-nav__section-text">Selecciona una opción</span>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-print"></i>
                        <span class="kt-nav__link-text">Imprimir</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-copy"></i>
                        <span class="kt-nav__link-text">Copiar</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-file-excel-o"></i>
                        <span class="kt-nav__link-text">Excel</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                        <span class="kt-nav__link-text">PDF</span>
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div> --}}
    </div>
    <div class="kt-portlet__body p-2">
        <form id="formFiltrosGraficos">
            <div class="form-group row text-center mb-2">
                <div class="col-4 col-sm-2 pl-2">
                    <label><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="gos_aseguradora_id" id="gos_aseguradora_id">
                        <option value="">Todas</option>
                        @foreach($listaAseguradoras as $aseguradora)
                            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-sm-2 px-1">
                    <label>Tipo de orden</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="gos_os_tipo_o_id" id="gos_os_tipo_o_id">
                        <option value="">Todos</option>
                        @foreach($listaSeleccionTipoOrden as $tipoOrden)
                            <option value="{{$tipoOrden->gos_os_tipo_o_id}}" >{{$tipoOrden->tipo_orden}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-sm-2 px-1">
                    <label>Tipo de daño</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="gos_os_tipo_danio_id" id="gos_os_tipo_danio_id">
                        <option value="">Todos</option>
                        @foreach($listaSeleccionTipoDanio as $tipoDanio)
                        <option value="{{$tipoDanio->gos_os_tipo_danio_id}}">{{$tipoDanio->tipo_danio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-sm-2 px-1">
                    <label>Estatus</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="gos_os_estado_exp_id" id="gos_os_estado_exp_id">
                        <option value="">Todos</option>
                        @foreach($listaSeleccionEstadoExpOs as $estadoOs)
                        <option value="{{$estadoOs->gos_os_estado_exp_id}}">{{$estadoOs->estado_expediente}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-sm-3 pl-1">
                    <label>Fechas</label>
                    <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" value="{{$fechaRango}}" readonly/>
                </div>
            </div>
        </form>
        
        <div class="row p-0">
            <div class="col-12 col-md-7 mt-4 border-bottom">
                <div class="text-center" id="bar_morris_1_title"></div>
                <div id="bar_morris_1"></div>
            </div>
            <div class="col-12 col-md-5 mt-4 border-bottom">
                <div id="bar_morris_2"></div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-hover text-center" id="dt-OSProcesadas">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Creadas</th>
                        <th class="p-2">Ingresadas</th>
                        <th class="p-2">Terminadas</th>
                        <th class="p-2">Entregadas</th>
                        <th class="p-2">Facturadas</th>
                        <th class="p-2">Remision</th>
                        <th class="p-2">Crédito</th>
                        <th class="p-2">Contado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listadoTabla as $l)
                    <tr>
                        <td class="text-nowrap">{{$l->fechaCreacion}}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="creacion|{{$l->fechaCreacion}}">{{$l->cantfechaCreacion}}</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="ingreso|{{$l->fechaCreacion}}">{{$l->cantfechaIngreso}}</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="terminado|{{$l->fechaCreacion}}">{{$l->cantfechaTerminado}}</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="entregado|{{$l->fechaCreacion}}">{{$l->cantfechaEntregado}}</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="facturado|{{$l->fechaCreacion}}">{{$l->cantfechaFacturado}}</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnModalOS" data-id="remision|{{$l->fechaCreacion}}">{{$l->cantfechaRemision}}</a>
                        </td>
                        <td>
                            $ {{round($l->SaldoCredito,2)}}
                        </td>
                        <td>
                            $ {{round($l->SaldoContado,2)}}
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
                <tfoot>
                    <?php
                    $totalCreacion = 0;$totalIngreso = 0;$totalTerminado = 0;$totalEntregado = 0;$totalFacturado = 0;$totalRemision = 0;$totalCredito = 0;$totalContado = 0;
                    foreach ($listadoTabla as $l) {
                        $totalCreacion = $totalCreacion + $l->cantfechaCreacion;
                        $totalIngreso = $totalIngreso + $l->cantfechaIngreso;
                        $totalTerminado = $totalTerminado + $l->cantfechaTerminado;
                        $totalEntregado = $totalEntregado + $l->cantfechaEntregado;
                        $totalFacturado = $totalFacturado + $l->cantfechaFacturado;
                        $totalRemision = $totalRemision + $l->cantfechaRemision;
                        $totalCredito = $totalCredito + $l->SaldoCredito;
                        $totalContado = $totalContado + $l->SaldoContado;
                    }
                    ?>
                    <tr>
                        <th class="p-2">Totales</th>
                        <th class="p-2">{{$totalCreacion}}</th>
                        <th class="p-2">{{$totalIngreso}}</th>
                        <th class="p-2">{{$totalTerminado}}</th>
                        <th class="p-2">{{$totalEntregado}}</th>
                        <th class="p-2">{{$totalFacturado}}</th>
                        <th class="p-2">{{$totalRemision}}</th>
                        <th class="p-2">$ {{round($totalCredito,2)}}</th>
                        <th class="p-2">$ {{round($totalContado,2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_tablaOS">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 90%;min-width: 90%;">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="dt-ordenesFiltradas">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Orden</th>
                                <th>Fecha</th>
                                <th>Días</th>
                                <th>Cliente</th>
                                <th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                                <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Marcas<?php endif; ?></th>
                                <th>Tiempo</th>
                                <th>Asesor</th>
                                <th>Total</th>
                                <th>Avance</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('ScriptporPagina')
    {{-- <script src = "https://www.gstatic.com/charts/loader.js"></script> --}}
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteOSProcesadas.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection
