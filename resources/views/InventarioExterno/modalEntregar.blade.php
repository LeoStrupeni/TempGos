<div class="modal fade hide" id="EntregarPE" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title" id="titleModalEntregarPE"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <form id="formEntregarPE" class="mb-2">
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-4 pt-2 pl-4 text-right">Tecnico</label>
                        <div class="col-8">
                            <select class="form-control kt-selectpicker text-center" data-live-search="true" data-size="5" 
                                name="gos_usuario_id" id="gos_usuario_id_EPE">
								<option></option>
								@foreach ($listaUsuarios as $usuario)
								<option value="{{$usuario->gos_usuario_id}}"> {{$usuario->nomb_rol.' | '.$usuario->nombre_apellidos}} </option>
								@endforeach
                            </select>
                            <small style="font-style: italic;" class="gos_usuario_id_EPE form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-4 pt-2 pl-4 text-right">Producto</label>
                        <div class="col-8">
                            <input class="form-control text-center" type="text" id="Producto_EPE" disabled>
                            <input type="hidden" name="gos_producto_id" id="gos_producto_id_EPE">
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-4 pt-2 pl-4 text-right">Descripcion</label>
                        <div class="col-8">
                            <input class="form-control text-center" type="text" id="descripcion_EPE" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-1 align-items-center">
                        <label class="col-4 pt-2 pl-4 text-right">Cantidad</label>
                        <div class="col-8">
                            <input class="form-control text-center" type="text" name="cantidad" id="cantidad_EPE">
                            <small style="font-style: italic;" class="cantidad_EPE form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-success w-25" id="btn-entregar-producto">Cargar</button>        
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center m-0" id="dt-ProductosEntregados">
                        <thead class="thead-dark">
                            <tr>
                                <th class="p-1">Empleado</th>
                                <th class="p-1">Cantidad</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>