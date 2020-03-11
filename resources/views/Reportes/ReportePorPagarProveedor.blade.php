@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">Proveedores</h3>
            </div>
        </div>
        <div class="kt-portlet__body p-2">
            <form action="/ReportePorPagarProveedores" method="post">
                @csrf
                <div class="form-group row text-center mb-2 justify-content-md-center">
                    <div class="col-3 p-0 pr-1">
                        <label>Proveedores</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="proveedor[]" id="proveedor[]" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" multiple>
                            @foreach($proveedores as $proveedor)
                            <option value="{{$proveedor->gos_proveedor_id}}"
                                @if (isset($provFiltros))
                                <?php foreach ($provFiltros as $prov){if($prov==$proveedor->gos_proveedor_id){echo 'selected';}}?>
                                @else
                                selected
                                @endif>{{$proveedor->nombreProveedor}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 p-0">
                        <label>Fecha vencimiento</label>
                        <div class="input-group date">
                            <input type="text" class="form-control text-center" readonly id="fecha_vencimiento" name="fecha_vencimiento" value="{{$fecha_vencimiento}}"/>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success p-1" id="btn-consultar">
                                    <i class="la la-search text-white pl-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-hover text-center" id="dt-proveedores">
                    <thead class="thead-light">
                        <tr>
                            <th class="p-2" colspan="2">Nombre del Proveedor</th>
                            <th class="p-2">Contacto</th>
                            <th class="p-2">Teléfono</th>
                            <th class="p-2" colspan="2">Email</th>
                            <th class="p-2">Saldo pendiente</th>
                            <th class="p-2">Total pendiente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listaProveedores as $proveedor)
                        <tr>
                            <td class="p-1 align-middle" colspan="2">
                                <?php $prov=explode("|", $proveedor->nomb_proveedor);?>  
                                <a class="btn btndetalles text-primary p-1" data-id="{{$prov[1]}}">{{$prov[0]}}</a>                              
                            </td>
                            <td class="p-1 align-middle">{{$proveedor->contacto}}</td>
                            <td class="p-1 align-middle">{{$proveedor->telefono}}</td>
                            <td class="p-1 align-middle" colspan="2">{{$proveedor->email}}</td>
                            <td class="p-1 align-middle">{{$proveedor->saldo_pdte}}</td>
                            <td class="p-1 align-middle">{{$proveedor->total_pdte}}</td>
                        </tr>
                            <tr class="d-none table-{{$prov[1]}}">
                                <td style="background-color: #AAAAAA;"></td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Fecha</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Vencimiento</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Estado</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Forma de pago</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Tipo de Compra</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Saldo</td>
                                <td class="font-weight-bold text-nowrap text-white p-1" style="background-color: #AAAAAA;">Total Compra</td>
                            </tr>
                            @foreach ($listaCompras as $compra)
                                @if ($prov[1] == $compra->gos_proveedor_id)
                                <tr class="d-none table-{{$prov[1]}}">
                                    <td style="background-color: #DCDCDC; width:3%;">
                                        <a href="javascript:void(0);" class="btn btn-clean btn-icon btn-mas-detalle" 
                                        style="height: 1.5rem;width: 1.5rem;" data-id="{{$compra->gos_compra_id}}">
                                            <i class="la la-plus-circle"></i>
                                        </a>
                                    </td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->fecha_compra}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->fecha_pago}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->estado}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->nomb_forma_pago}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->tipo_compra}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->Saldo}}</td>
                                    <td class="text-nowrap p-1" style="background-color: #DCDCDC;">{{$compra->total}}</td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="DetalleCompra" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Detalles Compra</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-3 px-1 mb-2 text-center">
                                <label class="text-nowrap"># factura</label>
                                <input class="form-control text-center" type="text" id="verFactura" readonly>
                            </div>
                            <div class="form-group col-3 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Tipo de compra</label>
                                <input class="form-control text-center" type="text" id="verTipoCompra" readonly>
                            </div>
                            <div class="form-group col-3 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Proveedor</label>
                                <input class="form-control text-center" type="text" id="verProveedor" readonly>
                            </div>
                            <div class="form-group col-3 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Fecha de compra</label>
                                <input class="form-control text-center" type="text" id="verFechaCompra" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Forma de pago</label>
                                <input class="form-control text-center" type="text" id="verFormaPago" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Fecha de pago</label>
                                <input class="form-control text-center" type="text" id="verFechaPago" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Tipo de pago</label>
                                <input class="form-control text-center" type="text" id="verMetodoPago" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Descuento</label>
                                <input class="form-control text-center" type="text" id="verDescuento" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Iva</label>
                                <input class="form-control text-center" type="text" id="verIva" readonly>
                            </div>
                            <div class="form-group col-2 pr-1 mb-2 text-center">
                                <label class="text-nowrap">Total</label>
                                <input class="form-control text-center" type="text" id="verTotal" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover " id="dt-itemsComprasVer">
                            <thead class="thead-light">
                                <tr>
                                    <th class="p-2 text-center">Nombre</th>
                                    <th class="p-2 text-center">Marca</th>
                                    <th class="p-2 text-center">Descripción</th>
                                    <th class="p-2 text-center">Cantidad</th>
                                    <th class="p-2 text-center">Medida</th>
                                    <th class="p-2 text-center">Costo</th>
                                    <th class="p-2 text-center">Precio venta</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-hover text-center" id="dt-pagosRegistrados">
                            <thead class="thead-light">
                                <tr>
                                    <th class="p-1">Fecha</th>
                                    <th class="p-1"># de documento</th>
                                    <th class="p-1">Importe</th>
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
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-porPagarProveedor.js"></script> 
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
@endsection