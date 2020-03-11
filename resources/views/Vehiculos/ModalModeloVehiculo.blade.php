<div class="modal fade" id="modalModeloVehiculo" role="dialog">
	<div class="modal-dialog modal-m modal-m">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModalModeloVehiculo">Editar <?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelos<?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
              	<form class="form-horizontal" id="ModeloVehiculoform">
                    @csrf
                    <input type="hidden" name="gos_vehiculo_modelo_id" id="gos_vehiculo_modelo_id">
                    <div class="form-group">
                        <label style="font-size:1rem;"><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_marca_id" id="gos_vehiculo_marca_id" required>
                            <option value="0" selected>Sin Marca</option>
                        @isset($listaMarcasVehiculos)
                            @foreach ($listaMarcasVehiculos as $marca)
                            <option value="{{$marca->gos_vehiculo_marca_id}}">{{$marca->marca_vehiculo}}</option>
                            @endforeach
                        @endisset
                        </select>

                        <small style="font-style: italic;" class="gos_vehiculo_marca_id form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label style="font-size:1rem;"><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelos<?php endif; ?></label>
                        <input type="text" class="form-control" name="modelo_vehiculo" id="modelo_vehiculo">
                        <small style="font-style: italic;" class="modelo_vehiculo form-text text-danger"></small>

                    </div>
                    <button type="button" class="btn btn-success btn-block" id="btnGuardarModeloVehiculo">Guardar</button>
                    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
                </form>
            </div>
        </div>
    </div>
</div>
