<div class="modal fade" id="modalMarcaVehiculo" role="dialog">
    <div class="modal-dialog modal-s modal-s">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModalMarcaVehiculo">Editar <?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
                <form id="marcaVehiculoForm">
                    @csrf
                    <input type="hidden" name="gos_vehiculo_marca_id" id="gos_vehiculo_marca_id">
                    <div class="form-group">
                        <label style="font-size: 1rem;"><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></label>
                        <input type="text" class="form-control" name="marca_vehiculo" id="marca_vehiculo">
                        <small style="font-style: italic;" class="marca_vehiculo form-text text-danger"></small>

                    </div>
                    <button type="button" class="btn btn-success btn-block" id="btnGuardarMarcaVehiculo">Guardar</button>
                    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
                </form>
            </div>
        </div>
    </div>
</div>
