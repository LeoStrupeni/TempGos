<div class="modal fade" id="modal-ubicacion-stock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="titleModalUbicacionStock"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                @include('Layout/errores')
                <form id="ubicacion-stock-form">
                  {{csrf_field()}}
                <div class="form-row">
                    <div class="form-group col-6">
                        <label style="font-size: 0.8vw;">Producto</label>
                        <select class="form-control" name="gos_producto_id" id="gos_producto_id"required>
                            @isset($listaProductos)
                                @foreach ($listaProductos as $producto)
                                <option value="{{$producto->gos_producto_id}}">{{$producto->nomb_producto}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label style="font-size: 0.8vw;">Ubicacion</label>
                        <select class="form-control" name="gos_producto_ubicacion_id" id="gos_producto_ubicacion_id" required>
                            @isset($listaUbicaciones)
                                @foreach ($listaUbicaciones as $ubicacion)
                                <option value="{{$ubicacion->gos_producto_ubicacion_id}}">{{$ubicacion->nomb_ubicacion}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label style="font-size: 0.8vw;">Concepto</label>
                        <input type="text" class="form-control" name="concepto" id="concepto" value="">
                    </div>
                    <div class="form-group col-6">
                        <label style="font-size: 0.8vw;">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="">
                    </div>
                    <div class="form-group col-4">
                        <label style="font-size: 0.8vw;">Ingreso</label>
                        <input type="number" min="0" class="form-control" name="ingreso" id="ingreso" value="">
                    </div>
                    <div class="form-group col-4">
                        <label style="font-size: 0.8vw;">Egreso</label>
                        <input type="number" min="0" class="form-control" name="egreso" id="egreso" value="">
                    </div>
                    <div class="form-group col-4">
                        <label style="font-size: 0.8vw;">Costo</label>
                        <input type="number" min="0" class="form-control" name="costo" id="costo" value="">
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-block" id="btnGuardarUbicacionStock">Guardar</button>
                <input type="hidden" id="app_url" name="app_url" url=".." />
            </form>
        </div>
        </div>
    </div>
    </div>
