<div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Abonar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="FormNuevoPago">
                    @csrf
                    <input type="hidden" name="gos_prestamo_id" id="gos_prestamo_idPago">
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">Empleado</label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm text-center" id="NombreEmpleado" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">Fecha</label>
                        <div class="col-9">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control text-center" id="fechaPrestamo" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">Monto</label>
                        <div class="col-9">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-dollar"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control text-center" id="montoPrestamo" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">Saldo</label>
                        <div class="col-9">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-dollar"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control text-center" id="SaldoPendiente" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">fecha</label>
                        <div class="col-9">
                            <div class="input-group input-group-sm date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control text-center" id="fechaPago" name="fechaPago" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-3 pt-2 pl-4 text-nowrap">Pago</label>
                        <div class="col-9">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-dollar"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control text-center" id="importePago" name="importePago">
                            </div>
                        </div>
                    </div>
                    
                    <small style="font-style: italic;" class="importePago form-text text-danger text-center my-2"></small>

                    <button type="button" class="btn btn-sm btn-success btn-block mt-2" id="btn_guardar_pago">
                    Guardar
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</div>
