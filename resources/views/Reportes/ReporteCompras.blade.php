
@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">Compras</h3>
            </div>
        </div>
        <div class="kt-portlet__body p-2">
            <form id='FormReporteCompras'>
                <div class="form-group row text-center mb-2 justify-content-md-center">
                    <div class="col-6 col-md-3 pr-1">
                        <label>Proveedor</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" name="proveedor" id="proveedor">
                            <option value="">Todos</option>
                            @foreach($listadoProveedores as $proveedor)
                                <option value="{{$proveedor->nombreProveedor}}">{{$proveedor->nombreProveedor}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3 px-1">
                        <label>Fechas</label>
                        <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" onchange="filtrosReporteCompras();" readonly/>
                    </div>
                    <div class="col-4 col-md-2 px-1">
                        <label>Forma de pago</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" name="formaPago" id="formaPago">
                            <option value="">Todas</option>
                            @foreach($listadoFormasPago as $formaPago)
                                <option value="{{$formaPago->nomb_forma_pago}}">{{$formaPago->nomb_forma_pago}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-md-2 px-1">
                        <label>Estado de pago</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" name="estadopago" id="estadopago">
                            <option value="">Todas</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="col-4 col-md-2 pl-1">
                        <label>Tipo de compra</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" name="compraTipo" id="compraTipo">
                            <option value="">Todas</option>
                            @foreach($listadoTipoCompra as $tipoCompra)
                                <option value="{{$tipoCompra->tipo_compra}}">{{$tipoCompra->tipo_compra}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            
            <div class="row p-0">
                <div class="col-12 col-md-8 mt-4">
                    <div id="bar_morris_compra"></div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover text-center" id="dt-reporteCompras">
                    <thead class="thead-light">
                        <tr>
                            <th class="p-2 text-nowrap">Fecha</th>
                            <th class="p-2 text-nowrap">Proveedor</th>
                            <th class="p-2 text-nowrap">Estado</th>
                            <th class="p-2 text-nowrap">Forma de pago</th>
                            <th class="p-2 text-nowrap">Tipo de Compra</th>
                            <th class="p-2 text-nowrap">Importe</th>
                            <th class="p-2 text-nowrap">Saldo</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="p-2 text-right" colspan="5">Totales</th>
                            <th class="p-2"></th>
                            <th class="p-2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-compras.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection