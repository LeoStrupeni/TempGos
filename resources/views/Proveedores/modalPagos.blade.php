<div class="modal fade hide" id="PagoCompra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 40%;min-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Pago</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <form id="pagarCompraForm">
                    @csrf
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap">Saldo Pendiente</label>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm text-center" id="saldo_PagoCompra" disabled>
                        </div>
                    </div>
                    <small style="font-style: italic;" class="saldo_PagoCompra form-text text-danger text-center"></small>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap"># de Compra</label>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm text-center" name="gos_compra_id" id="gos_compra_id_PagoCompra" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap">Tipo de pago compra</label>
                        <div class="col-7">
                            <select class="custom-select custom-select-sm" name="metodoPago" id="metodoPago">
                                @foreach ($listaMetodosPagos as $metodopago)
                                <option value="{{$metodopago->gos_metodo_pago_id}}">{{$metodopago->nomb_met_pago}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap">Importe</label>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm text-center" name="importe" id="importe_PagoCompra">
                        </div>
                    </div>
                    <small style="font-style: italic;" class="importe_PagoCompra form-text text-danger text-center"></small>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap">Fecha</label>
                        <div class="col-7">
                            <input type="date" class="form-control form-control-sm text-center" name="fecha" id="fecha_PagoCompra">
                        </div>
                    </div>
                    <small style="font-style: italic;" class="fecha_PagoCompra form-text text-danger text-center"></small>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-5 pt-2 pl-4 text-nowrap"># de documento</label>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm text-center" name="numero_documento" id="numero_documento">
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-block" id="btn-PagoCompra">Cargar pago</button>
                </form>
            </div>
        </div>
    </div>
</div>