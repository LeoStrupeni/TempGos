<div class="modal fade" id="ModalUbicacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalUbicacion">Nueva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
                <form id="UbicacionForm">
                    @csrf
                    <input type="hidden" name="gos_producto_ubicacion_id" id="gos_producto_ubicacion_id">
                    <div class="kt-portlet__body p-0 ">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nomb_ubicacion" id="nomb_ubicacion" value="">
                            <small style="font-style: italic;" class="nomb_ubicacion form-text text-danger"></small>
                        </div>
                        <button type="button" class="btn btn-success btn-block" id="btnGuardarUbicacion">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
