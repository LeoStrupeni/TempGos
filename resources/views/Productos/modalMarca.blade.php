<div class="modal fade" id="modalMarcaProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalMarcaProducto">Editar <?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                @include('Layout/errores')
                
                <form id="MarcaProductoForm">
                    @csrf
                    <input type="hidden" name="gos_producto_marca_id" id="gos_producto_marca_id">
                    <div class="kt-portlet__body p-0">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nomb_marca" id="nomb_marca" value="">
                            <small style="font-style: italic;" class="nomb_marca form-text text-danger"></small>
                        </div>
                        <div class="kt-form__actions text-center">
                          <button type="button" class="btn btn-success btn-block" id="btnGuardarMarcaProducto">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
