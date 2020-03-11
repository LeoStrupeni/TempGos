<div class="modal fade hide" id="modalProveedor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TitleModalProveedor"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
                <form id="ProveedorForm">
                    @csrf
                    <input type="hidden" name="gos_proveedor_id" id="gos_proveedor_id">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nomb_proveedor" id="nomb_proveedor">
                        <small style="font-style: italic;" class="nomb_proveedor form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Contacto</label>
                        <input type="text" class="form-control" name="contacto" id="contacto">
                        <small style="font-style: italic;" class="contacto form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono">
                        <small style="font-style: italic;" class="telefono form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <small style="font-style: italic;" class="email form-text text-danger"></small>
                    </div>
                    <button type="button" class="btn btn-success btn-block" id="btnGuardarProveedor">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
