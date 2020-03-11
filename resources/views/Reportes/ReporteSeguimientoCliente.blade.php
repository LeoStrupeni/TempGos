@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')

<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Mensajes</h3>
        </div>
    </div>
    <div class="kt-portlet__body p-2">
        <form action="/ReporteSeguimientoAlCliente" method="POST" id="formFiltrosMjs">
            @csrf
            <div class="form-row justify-content-center text-center">
                <div class="form-group col-12 col-md-4 mb-1">
                    <label>Fecha</label>
                    <div class="input-group mb-3">
                        <input type='text' class="form-control text-center px-1" name="rangoFechas" id="rangoFechas" value="{{$fechaRango}}" readonly/>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success p-1">
                                <i class="la la-search text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 col-md-4 mb-1">
                    <label>Buscar</label>
                    <input type="text" class="form-control" id="global_filtro">
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center" id="dt-reporte-mensajes">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2">Orden</th>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Cliente</th>
                        <th class="p-2">Auto</th>
                        <th class="p-2">Mensajes</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listadoMensajes as $mensaje)
                    <tr>
                        <td class="align-middle">
                            <a href='/orden-servicio-generada/{{$mensaje->gos_os_id}}'> # {{$mensaje->nro_orden_interno}}</a>
                        </td>
                        <td class="align-middle ">{{ $mensaje->fecha_creacion_os }}</td>
                        <?php $cliente=explode("|", $mensaje->nomb_cliente);?>
                        <td class="align-middle">{{ $cliente[0].' '.$cliente[1] }}</td>
                        
                        <?php $vhc=explode("|", $mensaje->detallesVehiculo);?>
                        <td class="align-middle text-left pl-5">
                            <div class="row m-0 p-0">
                                <div class="col-1 text-center align-self-center m-0 p-0">
                                    <i class="fas fa-circle" style="background-color:#{{$vhc[0]}};color:#{{$vhc[0]}};font-size: medium; border: 1px solid black;border-radius: 100%;"></i>
                                </div>
                                <div class="col-11 m-0 p-0 pl-2">
                                    {{$vhc[1]}}
                                    <br>
                                    {{$vhc[2]}}
                                </div>    
                            </div>                           
                        </td>
                        <td class="align-middle">
                            <a href="javascript:void(0);" class="btn btn-link py-0 px-2 btnListaMensajes" data-id="{{ $mensaje->gos_os_id.'|#'.$mensaje->nro_orden_interno }}">{{ $mensaje->cantidad }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade hide" id="modalSeguimientoCliente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h6 class="modal-title" id="titlemodalSeguimientoCliente"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <div class="table-responsive">
                    <table style="font-size: 12px;"
                        class="table table-sm table-hover" id="dt-MensajesCliente">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Prioridad</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Comentario</th>
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
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-seg-cliente.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection

