<div class="modal fade hide" id="HistorialVenta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalHistorialVenta">Historial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row m-0 p-0 justify-content-center">
                    <div class="col-12">
                        <h5 class="text-center border-bottom">Ultima Compra</h5>
                    </div>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-8">
                        <div class="form-row mt-3 text-center">
                            <div class="form-group col-4 px-1 mb-2">
                                <label>Fecha</label>
                                <input type="text" class="form-control text-center" id="UC_Fecha">
                            </div>
                            <div class="form-group col-4 px-1 mb-2">
                                <label>Proveedor</label>
                                <input type="text" class="form-control text-center" id="UC_Proveedor">
                            </div>
                            <div class="form-group col-4 px-1 mb-2">
                                <label>Total</label>
                                <input type="text" class="form-control text-center" id="UC_Total">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-8 table-responsive">
                        <table class="table table-sm table-hover text-center m-0" id="dt-itemsCompra">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="p-1">Nombre</th>
                                    <th class="p-1">Cantidad</th>
                                    <th class="p-1">Costo</th>
                                    <th class="p-1">Venta</th>
                                    <th class="p-1 text-nowrap">Cantidad disponible</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center" id="dt-Os">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-1">Orden</th>
                                <th class="p-1 text-nowrap">Cantidad Producto</th>
                                <th class="p-1">Fecha Os</th>
                                <th class="p-1 text-nowrap">Precio Unitario</th>
                                <th class="p-1 text-nowrap">Total</th>
                                <th class="p-1">Aseguradora</th>
                                <th class="p-1">Cliente</th>
                                <th class="p-1">Vehiculo</th>
                                <th class="p-1">Avance</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>