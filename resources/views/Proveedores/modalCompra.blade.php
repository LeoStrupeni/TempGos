<div class="modal fade hide" id="DetalleCompra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%;min-width: 80%;">
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
            </div>
        </div>
    </div>
</div>