<div class="row mt-5">
    <div class="col-4 offset-8">
        <form id="compras_Cierre_form">
            @csrf
            <div class="row col-12">
                <label class="col-4 col-form-label text-right text-nowrap">Sub-Total</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);" onchange="cambiosCalculosFinales();">
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <label class="col-4 col-form-label text-right text-nowrap" style="border-color: ">Descuento</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text btnCambioPeso"
                                style={{(($compra->descuento_tipo ?? '') == 'PORCIENTO' ? 'display:none;' : '')}}>$
                            </button>
                            <button type="button" class="input-group-text btnCambioPorciento" 
                                style={{(($compra->descuento_tipo ?? '') == 'PORCIENTO' ? '' : 'display:none;')}}>%
                            </button>
                        </div>
                        <input type="hidden" id="descuento_tipo" name="descuento_tipo" value={{$compra->descuento_tipo ?? 'PESOS'}}>
                        <input type="text" name="descuento" id="descuento" class="form-control" onchange="cambiosCalculosFinales();" value={{$compra->descuento ?? 0}}>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <label class="col-4 col-form-label text-right text-nowrap">IVA</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                        </div>
                        <input type="text" name="iva" id="iva" class="form-control" onchange="cambiosCalculosFinales();" value={{$compra->iva ?? 0}}>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <label class="col-4 col-form-label text-right text-nowrap">Total</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="total" id="total" class="form-control" value="0" disabled>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-8 offset-4">
                    <button style="margin-bottom: 1rem;" class="btn btn-success w-100" data-toggle="modal" data-target="#modalbuscarOS-compras" id="btn-guardar-compra" type="button">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
