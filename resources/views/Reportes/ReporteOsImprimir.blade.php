@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile" {{-- style="margin-botton:0 !important;" --}}>
    <div class="kt-portlet__head" style="height: 30px;">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="flaticon2-poll-symbol"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Ordenes
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar pr-5">
            <form>
                <div class="form-group row mb-0" style="width:150px;">
                    <select class="form-control kt-selectpicker" id="estado">
                        <option value="">Todas</option>
                        <option value="enProceso">En Proceso</option>
                        <option value="terminada">Terminadas</option>
                        <option value="entregada">Entregadas</option>
                        <option value="historico">Historico</option>
                        <option value="cancelada">Canceladas</option>
                    </select>
                </div>	
            </form>
		</div>
    </div>
    <div class="kt-portlet__body p-2">
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center" id="dt-EtapasTecnicos">
                <thead class="thead-light">
                    <tr>
                        <th class="d-none">FiltroCarpeta</th>
                        <th class="d-none">Carpeta</th>
                        <th class="d-none">Fecha Creacion</th>
                        <th class="d-none">Fecha Entrada</th>
                        <th class="d-none">Fecha Promesa</th>
                        <th class="d-none">Estado Promesa</th>
                        <th class="d-none">Fecha Terminado</th>{{-- 5 --}}
                        <th class="d-none">Fecha Entregado</th>
                        <th class="d-none">Fecha Facturado</th>
                        <th class="d-none"># Orden</th>
                        <th class="d-none">Ordenes Ligadas</th>
                        <th class="d-none">Porcentaje</th>{{-- 10 --}}
                        <th class="d-none">Etapa Activa</th>
                        <th class="d-none">Tipo de Orden</th>
                        <th class="d-none">Estatus</th>
                        <th class="d-none">Tipo de daño</th>
                        <th class="d-none">Riesgo</th>{{-- 15 --}}
                        <th class="d-none">Aseguradora</th>
                        <th class="d-none">Reporte</th>
                        <th class="d-none">Póliza</th>
                        <th class="d-none">#orden</th>
                        <th class="d-none">Demérito</th>{{-- 20 --}}
                        <th class="d-none">Deducible</th>
                        <th class="d-none">Cliente</th>
                        <th class="d-none">Marca</th>
                        <th class="d-none">Modelo</th>
                        <th class="d-none">Año</th>{{-- 25 --}}
                        <th class="d-none">Placa</th>
                        <th class="d-none">Color</th>
                        <th class="d-none">Número Económico</th>
                        <th class="d-none">Número de Serie</th>
                        <th class="d-none">Asesor</th>{{-- 30 --}}
                        <th class="d-none">Total</th>
                        <th class="d-none">Fecha Pago</th>
                        <th class="d-none">Pagos</th>{{-- 33 --}}
                        <th class="p-1">Orden</th>
                        <th class="p-1">Fecha</th>
                        <th class="p-1">Días</th>
                        <th class="p-1">Cliente</th>
                        <th class="p-1">Aseguradora</th>
                        <th class="p-1">Vehiculo</th>
                        <th class="p-1 text-nowrap text-center">Estatus de Fecha <br> Promesa</th>
                        <th class="p-1">Asesor</th>
                        <th class="p-1">Total</th>
                        <th class="p-1">Avance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($OSProceso as  $os)
                    <tr>
                        <td class="d-none">{{$os->Carpeta}}</td>
                        <td class="d-none">@if($os->Carpeta == "enProceso"){{'En Proceso'}}
                                            @elseif($os->Carpeta == "terminada"){{'Terminadas'}}
                                            @elseif($os->Carpeta == "entregada"){{'Entregadas'}}
                                            @elseif($os->Carpeta == "historico"){{'Historico'}}
                                            @else {{'Canceladas'}} @endif
                        </td>
                        <td class="d-none">{{$os->fecha_creacion_os}}</td>
                        <td class="d-none">{{$os->fecha_ingreso_v_os}}</td>
                        <td class="d-none">{{$os->fecha_promesa_os}}</td>
                        <td class="d-none">{{$os->EstadoFechaPromesa}}</td>
                        <td class="d-none">{{$os->fecha_terminado}}</td>
                        <td class="d-none">{{$os->fecha_entregado}}</td>
                        <td class="d-none">{{$os->fecha_facturado}}</td>
                        <td class="d-none">{{'#'.$os->nro_orden_interno}}</td>
                        <td class="d-none"><?php foreach($osLigadas as $osl):?>
                                <?php if($osl->gos_os_id == $os->gos_os_id):?>#<?=$osl->nro_orden_interno?> &nbsp <?php endif;?>
                            <?php endforeach;?>
                        </td>
                        <td class="d-none">{{number_format($os->porcentaje, 2)}}</td>
                        <td class="d-none">{{$os->nomb_etapa}}</td>
                        <td class="d-none">{{$os->tipo_orden}}</td>
                        <td class="d-none">{{$os->estado_expediente}}</td>
                        <td class="d-none">{{$os->tipo_danio}}</td>
                        <td class="d-none">{{$os->nomb_riesgo}}</td>
                        <td class="d-none">{{$os->empresa}}</td>
                        <td class="d-none">{{$os->nro_reporte}}</td>
                        <td class="d-none">{{$os->nro_poliza}}</td>
                        <td class="d-none">{{$os->nro_orden}}</td>
                        <td class="d-none">{{$os->demerito}}</td>
                        <td class="d-none">{{$os->deducible}}</td>
                        <td class="d-none">{{$os->nombre_cliente}}</td>
                        <td class="d-none">{{$os->MarcaVehiculo}}</td>
                        <td class="d-none">{{$os->ModeloVehiculo}}</td>
                        <td class="d-none">{{$os->anio_vehiculo}}</td>
                        <td class="d-none">{{$os->placa}}</td>
                        <td class="d-none">{{$os->colorVehiculo}}</td>
                        <td class="d-none">{{$os->economico}}</td>
                        <td class="d-none">{{$os->nro_serie}}</td>
                        <td class="d-none">{{$os->asesor}}</td>
                        <td class="d-none">{{number_format($os->Total, 2)}}</td>
                        <td class="d-none">{{$os->fecha_pago}}</td>
                        <td class="d-none">{{$os->Pagos}}</td>

                        <td style="text-align:center;vertical-align: middle;">{{'#'.$os->nro_orden_interno}}</td>
                        <td class="text-nowrap text-left" style="vertical-align: middle;">
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                            data-placement="top" data-content="Apertura de la orden">
                            <i class="fas fa-circle" style="color: #339af0;"></i>
                            {{$os->fecha_creacion_os}}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Ingreso a reparacion">
                                <i class="fas fa-caret-square-right" style="color: green;"></i>
                                {{($os->fecha_ingreso_v_os == 0) ? 'Fecha reparacion':$os->fecha_ingreso_v_os }}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Fecha promesa">
                                <i class="fas fa-square" style="color: yellow;"></i> {{
                                ($os->fecha_promesa_os == 0) ? 'Fecha promesa':$os->fecha_promesa_os }}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Fecha terminado">
                                <i class="fas fa-circle" style="color: #339af0;"></i> {{
                                $os->fecha_terminado ?? 'Fecha terminado' }}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Fecha entregado">
                                <i class="fas fa-caret-square-left" style="color: red;"></i> {{
                                $os->fecha_entregado ?? 'Fecha entregado' }}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Fecha facturado">
                                <i class="fas fa-circle" style="color: #339af0;"></i> {{
                                $os->fecha_facturado ?? 'Fecha facturado' }}
                            </p>
                            <p class="m-0" data-toggle="popover" data-trigger='hover'
                                data-placement="top" data-content="Fecha de pago">
                                <i class="fas fa-circle" style="color: #339af0;"></i> {{
                                $os->fecha_pago ?? 'Fecha pago' }}
                            </p>
                        </td>
                        <td style="text-align:center;vertical-align: middle;"> {{$os->dias}} </td>
                        <td style="text-align:center;vertical-align: middle;">{{$os->nombre_cliente}}</td>
                        <?php $asg=explode("|", $os->nomb_aseguradora); $asglength=count($asg); ?>
                        <td class="text-left" style="vertical-align: middle;">
                            <strong style="color: #27395C; font-weight: 500;">{{$asg[0]??''}}</strong>
                            <br>{{$asg[1] ??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[2]??''}}</strong>
                            <br>{{$asg[3]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[4]??''}}</strong>
                            <br>{{$asg[5]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[6]??''}}</strong>
                            <br>{{$asg[7]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[8]??''}}</strong>
                            <br>{{$asg[9]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[10]??''}}</strong>
                            <br>{{$asg[11]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[12]??''}}</strong>
                            <br>{{$asg[13]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[14]??''}}</strong>
                            <br>{{$asg[15]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[16]??''}}</strong>
                            <br>{{$asg[17]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[18]??''}}</strong>
                            <br>{{$asg[19]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[20]??''}}</strong>
                        </td>
                        <?php $vhc=explode("|", $os->detallesVehiculo);?>
                        <td class="text-left text-nowrap pl-2" style="vertical-align: middle;"> <i class="fas fa-circle"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} <br>
                            <div class="Ordenesligadas">
                                OL:
                                <?php foreach($osLigadas as $osl):?>
                                    <?php if($osl->gos_os_id == $os->gos_os_id):?>#<?=$osl->nro_orden_interno?> &nbsp <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </td>
                        @if ($os->EstadoFechaPromesa == 'Sin Fecha')
                            <td class="text-center" style="vertical-align: middle;">Sin Fecha</td>
                        @elseif($os->EstadoFechaPromesa == 'Rojo')
                            <td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:red;"></i> Etapa</td>
                        @elseif($os->EstadoFechaPromesa == 'Amarillo')
                            <td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:yellow;"></i> Etapa</td>	
                        @else
                            <td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:green;"></i> Etapa</td>
                        @endif
                        <td style="text-align:center;vertical-align: middle;">{{$os->asesor}}</td>
                        <td style="text-align:center;vertical-align: middle;">{{number_format($os->Total, 2)}}</td>
                       
                        <?php $e= round($os->porcentaje); ?>
                        @if ($os->Carpeta == "terminada")
                            <td style="vertical-align: middle;">
                                <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Terminada</div></div>
                            </td>
                        @elseif($os->Carpeta == "entregada")
                            <td style="vertical-align: middle;">
                                <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Entregada</div></div>
                            </td>
                        @elseif($os->Carpeta == "cancelada")
                            <td style="vertical-align: middle;">
                                <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Cancelada</div></div>
                            </td>
                        @else
                            <?php if ($e== null): ?>
                                <td style="vertical-align: middle;">
                                    <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div></div>
                                </td>
                            <?php elseif($e== 100.0000): ?>
                                <td style="vertical-align: middle;">
                                    <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Finalizada</div></div>
                                </td>
                            <?php else: ?>
                                <td style="vertical-align: middle;">
                                    <div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: {{$e}}%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$e}}%</div></div>
                                </td>
                            <?php endif; ?>
                        @endif
					</tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-imprimirOs.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection