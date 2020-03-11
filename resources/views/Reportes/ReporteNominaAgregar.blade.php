@section('estiloPorPagina')

@endsection
@extends('Layout')
@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Reporte de nomina </h3>
        </div> 
    </div>
    <div class="kt-portlet__body p-2">
        <form action="/Nomina" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-3">
                    <label>Perfil</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="nomb_perfil[]" id="nomb_perfil[]" 
                    data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" multiple>
                        @foreach($listadoPerfiles as $perfil)
                        <option value="{{$perfil->nomb_perfil}}" 
                            @if (isset($perfilFiltros))
                                <?php foreach ($perfilFiltros as $per){
                                    if($per==$perfil->nomb_perfil){echo 'selected';}
                                }?>
                            @else
                                selected
                            @endif>{{$perfil->nomb_perfil}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label>Fecha de comisiones</label>
                    <div class="input-group mb-3">
                        <input type='text' class="form-control text-center px-1" name="fecha_comision" id="fecha_comision" readonly value="@isset($fechaComision) {{$fechaComision}} @endisset"/>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success p-1" id="btn-guardar-cliente">
                                <i class="la la-search text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/ReporteNomina/Agregar" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-3">
                    <label>Fecha nomina</label>
                    <div class="input-group date">
                        <input type="text" class="form-control text-center" name="fecha_nomina" id="fecha_nomina" value="{{$fechaPagoNomina}}" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text p-0">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label>Tipo de pago</label>
                    <input type="text" class="form-control" name="tipo_pago" id="tipo_pago">
                </div>
                <div class="form-group col-6">
                <label>Observaciones</label>
                    <input type="text" class="form-control" name="observaciones" id="observaciones">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover text-center" id="dt-listadoNomina">
                    <thead class="thead-light">
                        <tr>
                            <th class="d-none">Id</th>
                            <th class="p-2">Perfil</th>
                            <th class="p-2">Nombre</th>
                            <th class="p-2">Sueldo</th>
                            <th class="p-2">Servicios</th>
                            <th class="p-2">Comisión</th>
                            <th class="p-2">Materiales</th>
                            <th class="p-2">Desc. Material</th>
                            <th class="p-2">Banco</th>
                            <th class="p-2">Efectivo</th>
                            <th class="p-2">Total</th>
                            <th class="p-2 text-center"><input name="select_all" value="1" type="checkbox"></th>
                            <th class="p-2">Saldo Prestamo</th>
                            <th class="p-2">Cobrar</th>
                            <th class="p-2">Prestar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listadoNomina as $key => $empleado)
                        {{-- @if (
                            ($empleado->nomb_rol == 'Administrativo' &&
                                $empleado->PrestamoPendiente+$empleado->Total+$empleado->SueldoPendiente > 0) ||
                             $empleado->nomb_rol <> 'Administrativo'
                            ) --}}
                        <tr>
                            <td class="d-none"><input type="hidden" name="gos_usuario_id[]" value="{{$empleado->gos_usuario_id}}"/></td>
                            <td class="align-middle text-nowrap">{{$empleado->rol}}</td>
                            <td class="align-middle text-nowrap">
                                <a class="btn btndetalles text-primary" data-id="{{$empleado->gos_usuario_id}}">{{$empleado->nombre}}</a>
                            </td>
                            <td class="align-middle"> {{$empleado->SueldoPendiente}}
                                <input type="hidden" name="sueldo[]" value="{{$empleado->SueldoPendiente}}">
                            </td>
                            <td class="align-middle"> {{$empleado->Servicios}}</td>
                            <td class="align-middle"> {{$empleado->Comision}}</td>
                            <td class="align-middle"> {{$empleado->materiales}}</td>
                            <td class="align-middle"> {{$empleado->desc_materiales}}</td>
                            <td> <input class="form-control form-control-sm text-right p-1 pr-2" name="ban[]" id="ban_{{$key}}" value="0"/></td>
                            <td> <input class="form-control form-control-sm text-right p-1 pr-2" name="efe[]" id="efe_{{$key}}" value="0" onkeyup="myFunction({{$key}})"/></td>
                            <td> <input class="form-control form-control-sm text-right p-1 pr-2" name="tot[]" id="tot_{{$key}}" value="{{$empleado->Total+$empleado->SueldoPendiente}}" readonly/>
                                 <input type="hidden" id="totalOculto_{{$key}}" value="{{$empleado->Total+$empleado->SueldoPendiente}}">
                            </td>
                            <td class="pt-3">   <input type="checkbox" class="check" onclick="cargarON({{$empleado->gos_usuario_id}});">
                                                <input type="hidden" class="checkok" id="{{$empleado->gos_usuario_id}}" value="off" name="cargar[]">
                            </td>
                            <td class="align-middle text-right"> {{$empleado->PrestamoPendiente}}</td>
                            <td> <input class="form-control form-control-sm text-right p-1 pr-2" name="cobrar[]" id="cobr_{{$key}}" value="0" onkeyup="prestamo({{$key}})"/></td> 
                            <td> <input class="form-control form-control-sm text-right p-1 pr-2" name="prestar[]" id="pres_{{$key}}" value="0" onkeyup="prestamo({{$key}})"/></td>
                        </tr>
                                <tr class="d-none table-{{$empleado->gos_usuario_id}}">
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1"></td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1 pl-5 text-left" colspan="2">Orden</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1">Servicios</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1">Comisión</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1">Materiales</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1">Desc. Material</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1" colspan="3">Aseguradora</td>
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1" colspan="4">Vehiculo</td>
                                </tr>
                            @foreach ($listadoOS as $os)
                                @if ($os->gos_usuario_asesor_id == $empleado->gos_usuario_id)
                                <tr class="d-none table-{{$empleado->gos_usuario_id}}">
                                    <td class="font-weight-bold bg-secondary text-nowrap p-1"></td>
                                    <td class="bg-secondary text-nowrap p-1 text-left" colspan="2">
                                        @if (isset($os->nro_orden_interno))
                                            <a class="pl-5" href='/orden-servicio-generada/{{$os->gos_os_id}}'> #{{$os->nro_orden_interno}}</a>        
                                        @else
                                            Borrada
                                        @endif
                                    </td>
                                    <td class="bg-secondary text-nowrap p-1">{{$os->servicios}}</td>
                                    <td class="bg-secondary text-nowrap p-1">{{$os->comision}}</td>
                                    <td class="bg-secondary text-nowrap p-1">{{$os->materiales}}</td>
                                    <td class="bg-secondary text-nowrap p-1">{{$os->desc_materiales}}</td>
                                    <?php isset($os->nomb_aseguradora_min) ? $asg=explode("|", $os->nomb_aseguradora_min) : $asg=0 ;?>
                                    <td class="bg-secondary text-nowrap p-1" colspan="3">{{$asg==0 ? '' : $asg[0]}}</td>
                                    <?php isset($os->detallesVehiculo) ? $vhc=explode("|", $os->detallesVehiculo) : $vhc=0;?>
                                    <td class="bg-secondary text-nowrap p-1" colspan="4">
                                        @if ($vhc<>0)
                                        <i class="fas fa-circle" style="background-color:#{{$vhc[0]}};color:#{{$vhc[0]}};font-size: medium; border: 1px solid black;border-radius: 100%;"></i>
                                        {{$vhc[1]}}<br>{{$vhc[2]}}                                            
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        {{-- @endif --}}
                    @endforeach
                    </tbody>
                    <tfoot>
                        <?php $sueldos=0;$servicios=0;$comision=0;$materiales=0;$descMat=0;$total=0;$prestamo=0;
                        foreach ($listadoNomina as $key => $empleado) {
                            $sueldos = $sueldos+$empleado->SueldoPendiente;
                            $servicios = $servicios+$empleado->Servicios;
                            $comision = $comision+$empleado->Comision;
                            $materiales = $materiales+$empleado->materiales;
                            $descMat = $descMat+$empleado->desc_materiales;
                            $total = $total+$empleado->Total+$empleado->SueldoPendiente;
                            $prestamo = $prestamo+$empleado->PrestamoPendiente;
                        }?>
                        <tr>
                            <td class="d-none text-white" style="background-color: #27395c;"></td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;" colspan="2">Totales</td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;"><?=$sueldos?></td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;"><?=$servicios?></td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;"><?=$comision?></td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;"><?=$materiales?></td>
                            <td class="p-2 font-weight-bold text-white" style="background-color: #27395c;"><?=$descMat?></td>
                            <td class="p-2" style="background-color: #27395c;"></td>
                            <td class="p-2" style="background-color: #27395c;"></td>
                            <td class="p-2 font-weight-bold text-right text-white" style="background-color: #27395c;"><?=$total?></td>
                            <td class="p-2" style="background-color: #27395c;"></td>
                            <td class="p-2 font-weight-bold text-right text-white" style="background-color: #27395c;"><?=$prestamo?></td>
                            <td class="p-2" style="background-color: #27395c;"></td>
                            <td class="p-2" style="background-color: #27395c;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="submit" class="btn btn-success btn-block">Guardar</button>
        </form>
    </div>
</div>
@endsection

@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-nomina.js"></script>
    <script>
        var dataTable = document.getElementById('dt-listadoNomina');
        var checkItAll = dataTable.querySelector('input[name="select_all"]');
        var inputs = dataTable.querySelectorAll('tbody>tr>td>input[class="check"]');
        var checks = dataTable.querySelectorAll('tbody>tr>td>input[class="checkok"]');
        
        checkItAll.addEventListener('change', function() {
            if (checkItAll.checked) {
                inputs.forEach(function(input) {
                    input.checked = true;
                });
                checks.forEach(function(check) {
                    check.setAttribute('value','on');
                });
            } else {
                inputs.forEach(function(input) {
                    input.checked = false;
                });
                checks.forEach(function(check) {
                    check.setAttribute('value','off');
                });
            }
        });
    </script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
@endsection
