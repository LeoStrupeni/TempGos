<div class="modal fade hide" id="modalNomina" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h6 class="modal-title" id="titleModalNomina">Detalles</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <div class="form-row">
                    <div class="form-group col-3 mb-1">
                        <label>Fecha nomina</label>
                        <div class="input-group date">
                            <input type="text" class="form-control text-center" id="m_fecha_nomina" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text p-0">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3 mb-1">
                        <label>Tipo de pago</label>
                        <input type="text" class="form-control" id="m_tipo_pago">
                    </div>
                    <div class="form-group col-6 mb-1">
                    <label>Observaciones</label>
                        <input type="text" class="form-control" id="m_observaciones">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center" id="dt-detalleNomina">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-2 text-nowrap">Nombre</th>
                                <th class="p-2 text-nowrap">Sueldo</th>
                                <th class="p-2 text-nowrap">Banco</th>
                                <th class="p-2 text-nowrap">Efectivo</th>
                                <th class="p-2 text-nowrap">Total</th>
                                <th class="p-2 text-nowrap">Pago Prestamo</th>
                                <th class="p-2 text-nowrap">Prestado</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>