@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Ordenes por Tecnicos</h3>
        </div>
    </div>
    <div class="kt-portlet__body p-2">
        <form id="filtrosEtapas">
            <div class="form-group row text-center mb-2 justify-content-center">
                <div class="col-4 col-sm-3 px-1">
                    <label>Tecnico</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="usuario" id="usuario">
                        <option value="">Todos</option>
                        @foreach($listaTecnicos as $tecnico)
                            <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-sm-3 px-1">
                    <label>Fechas</label>
                    <div class="input-group mb-3">
                        <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" readonly value="@isset($fechaRango) {{$fechaRango}} @endisset"/>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center" id="dt-EtapasTecnicos">
                <thead class="thead-light">
                    <tr>
                        <th class="d-none">id_Tec</th>
                        <th class="p-2 text-nowrap">Tecnico</th>
                        <th class="p-2 text-nowrap">Asignadas</th>
                        <th class="p-2 text-nowrap">Terminadas</th>
                        <th class="p-2 text-nowrap">Pagadas</th>
                        <th class="p-2 text-nowrap">Pendientes Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fecha1 = date("Y-m-d", strtotime(substr($fechaRango,0,10)));
                        $fecha2 = date("Y-m-d", strtotime(substr($fechaRango,14,10)));
                    @endphp
                    @foreach ($listaAsignadas as $tecnico)
                        <tr>
                            <td class="d-none">{{$tecnico->gos_usuario_id}}</td>
                            <td class="p-2 text-nowrap">{{$tecnico->nombre}}</td>
                            <td class="p-2 text-nowrap" style="width:15%!important;">
                                <a href="javascript:void(0);" 
                                    class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                                    data-id="{{'Asignada|'.$tecnico->gos_usuario_id.'|'.$fecha1.'|'.$fecha2}}"> {{$tecnico->asignadas}}
                                </a>
                            </td>
                            <td class="p-2 text-nowrap" style="width:15%!important;">
                                <a href="javascript:void(0);" 
                                    class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                                    data-id="{{'Terminadas|'.$tecnico->gos_usuario_id.'|'.$fecha1.'|'.$fecha2}}"> {{$tecnico->terminadas}}
                                </a>
                            </td>
                            <td class="p-2 text-nowrap" style="width:15%!important;">
                                <a href="javascript:void(0);" 
                                    class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                                    data-id="{{'Pagadas|'.$tecnico->gos_usuario_id.'|'.$fecha1.'|'.$fecha2}}"> {{$tecnico->pagadas}}
                                </a>
                            </td>
                            <td class="p-2 text-nowrap" style="width:15%!important;">
                                <a href="javascript:void(0);" 
                                    class="btn btn-primary py-0 px-1 w-25 btnModalOs text-center"
                                    data-id="{{'Pendientes|'.$tecnico->gos_usuario_id.'|'.$fecha1.'|'.$fecha2}}"> {{$tecnico->pendientesPago}}
                                </a>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade hide" id="ModalOrdenes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h6 class="modal-title" id="titleModalOrdenes">Ordenes</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="dt-ordenes">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-2 text-nowrap text-center">Orden</th>
                                <th class="p-2 text-nowrap text-center">Fecha</th>
                                <th class="p-2 text-nowrap text-center">Cliente</th>
                                <th class="p-2 text-nowrap text-center">
                                    {{($taller_conf_ase->nomb_campo_ase!=null) ? $taller_conf_ase->nomb_campo_ase : 'Aseguradora' }}                                   
                                </th>
                                <th class="p-2 text-nowrap text-center">
                                    {{($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null) ? $taller_conf_vehiculo->nomb_modulo_camp_vehiculo : 'Vehiculo' }}
                                </th>
                                <th class="p-2 text-nowrap text-center">Saldo</th>
                                <th class="p-2 text-nowrap text-center">Avance</th>
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
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteOSTecnicos.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection
