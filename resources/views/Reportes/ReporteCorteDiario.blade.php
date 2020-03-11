@extends('Layout')

@section('Content')
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Corte diario</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
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
        </div>
    </div>
    <div class="kt-portlet__body p-2">
        <form id='FormCorteDiario'>
            <div class="form-group row text-center mb-2 justify-content-md-center">
                <div class="col-3 pl-3 pr-0">
                    <label>Fechas</label>
                    <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" onchange="filtrosCorteDiario();" readonly/>
                </div>
                <div class="col-2 px-1">
                    <label>Tipo de Movimiento</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="movimiento" id="movimiento">
                        <option value="Ingreso">Ingresos</option>
                        <option value="Egreso">Egresos</option>
                        <option selected value="">Todos</option>
                    </select>
                </div>
                <div class="col-2 px-1">
                    <label>Tipo de corte</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="">Todos</option>
                        <option value="Compra Administrativa">Compra administrativa</option>
                        <option value="Compra Almacén">Compra almacen</option>
                        <option value="Compra Consumibles">Insumos</option>
                        <option value="Pago Nomina">Pago nomina</option>
                        <option value="Facturas">Facturas</option>
                        <option value="Notas de Remision">Notas de remision</option>
                        <option value="Tickets de Venta">Tickets de Venta</option>
                        <option value="Anticipo">Anticipo</option>
                    </select>
                </div>
                <div class="col-4 px-1">
                    <label>Buscar</label>
                    <input type="text" class="form-control" id="global_filtro">
                </div>
                {{-- <div class="col-1 pl-1">
                    <label>Saldo</label>
                    <input type="text" class="form-control text-center p-0" id="SaldoInicialDiario" onchange="filtrosCorteDiario();" value="100000">
                </div> --}}
            </div>
        </form>
        <div class="table-responsive mt-4">
            <table class="table table-sm table-hover text-center" id="dt-CorteDiario">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2">Tipo</th>
                        <th class="p-2 text-nowrap">Fecha</th>
                        <th class="p-2 text-nowrap">Movimiento</th>
                        <th class="p-2 text-nowrap">Documento</th>
                        <th class="p-2 text-nowrap"># Documento</th>
                        <th class="p-2 text-nowrap">Concepto</th>
                        <th class="p-2 text-nowrap">Tipo de Pago</th>
                        <th class="p-2 text-nowrap">Cliente/Proveedor</th>
                        <th class="p-2 text-nowrap">Aseguradora</th>
                        <th class="p-2 text-nowrap"># OS</th>
                        <th class="p-2 text-nowrap">Ingreso</th>
                        <th class="p-2 text-nowrap">Egreso</th>
                        <th class="p-2 text-nowrap">Saldo</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="p-2 text-nowrap"></th>
                        <th class="p-2 text-right" colspan="9">Totales</th>
                        <th class="p-2 text-nowrap"></th>
                        <th class="p-2 text-nowrap"></th>
                        <th class="p-2 text-nowrap"></th>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>
</div>

@include('Proveedores/modalCompra')
@endsection
    
@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-corte-diario.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection