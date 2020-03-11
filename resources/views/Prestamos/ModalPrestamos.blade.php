<div class="modal fade" id="modalPrestamo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodalPrestamo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="FormNuevoPrestamo">
                    @csrf
                    <input type="hidden" name="gos_prestamo_id" id="gos_prestamo_id">
                    <div class="form-row">
                        <div class="form-group col-12 mb-1">
                            <label>Usuario</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_usuario_id" id="gos_usuario_id">
                                <option></option>
                                @foreach ($listaEmpleados as $empleado)
                                <option value="{{$empleado->gos_usuario_id}}">{{$empleado->nombre_apellidos}}</option>
                                @endforeach
                            </select>
                            <small style="font-style: italic;" class="gos_usuario_id form-text text-danger"></small>
                        </div>
                        <div class="form-group col-12 mb-1">
                            <label>Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                        </div>
                        <div class="form-group col-6 text-center mb-1">
                            <label>Fecha</label>
                            <div class="input-group date">
                                <input type="text" class="form-control text-center" name="fecha" id="fecha" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6 text-center mb-1">
                            <label>Monto</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-dollar"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control text-center" name="monto" id="monto">
                            </div>
                        </div>
                        <small style="font-style: italic;" class="monto form-text text-danger"></small>
                    </div>
                    <button type="button" class="btn btn-success btn-block" id="btn_guardar_prestamo">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
