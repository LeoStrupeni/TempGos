<div class="modal fade" id="modal-inventario-ext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 116rem;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Productos externos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    @include('Layout/errores')
                    <form class="kt-form kt-form--label-right" id="producto-externo-form">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-6 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Nombre</label>
                          <input type="hidden" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}}">

                          <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_producto_id" id="gos_producto_id_externo" >
                            <option></option>
                            @isset($listaProductosExternos)
                            @foreach ($listaProductosExternos as $producto)
                            <option value="{{$producto->gos_producto_id}}">{{$producto->nomb_producto}}</option>
                            @endforeach
                            @endisset
                          </select>
                        </div>
                        <div class="form-group col-6 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Descripción</label>
                          <input type="text" class="form-control" name="descripcion_producto" id="descripcion_producto">
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Técnico</label>
                          <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_tecnico_id" id="gos_tecnico_id" >
                            <option></option>
                            @isset($listaTecnicos)
                            @foreach ($listaTecnicos as $tecnico)
                            <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->apellidos}}, {{$tecnico->nombre}}</option>
                            @endforeach
                            @endisset
                          </select>
                        </div>
                        <div class="form-group col-2 col-lg-1 mb-1">
                          <label style="font-size: 1rem;">Cantidad</label>
                          <input type="text" class="form-control pl-1 pr-0" name="gos_producto_cantidad" id="gos_producto_cantidad" value="">
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Costo</label>
                          <input type="text" class="form-control pl-1 pr-0" name="costo" id="costo" value="">
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">P. Venta</label>
                          <input type="text" class="form-control pl-1 pr-0" name="precio_venta" id="precio_venta" value="">
                        </div>
                        <div class="col-1 mb-2 align-self-end">
                            <button type="button" id="btn_ItemProducto" class="btn btn-success">
                              <i class="fas fa-plus p-0" style="color: white!important;"></i>
                            </button>
                        </div>
                      </div>
                    </form>
            </div>
            <div class="modal-footer">
                <div class="table-responsive p-1">
                    <table class="table table-sm table-hover" id="dt-InventarioExt" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><span>Fecha</span></th>
                                <th><span>Nombre</span></th>
                                <th><span><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marca<?php endif; ?></span></th>
                                <th><span>Descripción</span></th>
                                <th><span>Técnico</span></th>
                                <th><span>Cantidad</span></th>
                                <th><span>Importe</span></th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <button style="width:30%; margin: 2% auto;" type="button" class="btn btn-success btn-block" id="btnGuardarInventarioExt">Guardar</button>
        </div>
    </div>
</div>
