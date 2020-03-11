@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Reporte de nomina </h3>
        </div>
        <div class="col-4 pt-3">
            <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label px-0 text-right d-none d-sm-block">Periodo</label>
                <div class="col-12 col-sm-9">
                    <input type="text" class="form-control text-center mr-5 px-0" name="rangoFechas" id="rangoFechas" readonly="">
                </div>
            </div>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-actions">
                <a href="{{url('/Nomina')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="fa fa-plus kt-shape-font-color-1"></i>Agregar Pago
                </a>                
            </div>
        </div>       
    </div>
    <div class="kt-portlet__body p-2">
       
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center" id="dt-reporte-nomina">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Usuario</th>
                        <th class="p-2">Observación</th>
                        <th class="p-2">Tipo de pago</th>
                        <th class="p-2">Monto</th>
                        <th class="p-2">Ver</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listaReportesNomina as $key => $nomina)
                    <tr>
                        <td>{{ $nomina->fecha_nomina }}</td>
                        <td>{{ $nomina->nombre }}</td>
                        <td>{{ $nomina->observaciones }}</td>
                        <td>{{ $nomina->tipo_pago }}</td>
                        <td>{{ $nomina->total }}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md btn-mas-detalle" 
                            data-id="{{$nomina->gos_nomina_id.'|'.$nomina->observaciones.'|'.$nomina->tipo_pago.'|'.$nomina->fecha_nomina}}">
                            {{-- "{{$nomina->gos_nomina_id}}|{{$nomina->observaciones}}|{{$nomina->tipo_pago}}|{{$nomina->fecha_nomina}}" --}}
                                <i class="la la-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @include('Reportes/ReporteNominaModal')
</div>

@endsection


@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-nomina.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection
