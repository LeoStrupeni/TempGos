<div class="modal fade" id="modal-inventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 116rem;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    @include('Layout/errores')
                    <form class="kt-form kt-form--label-right" id="inventarioInterno_form">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-6 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Nombre</label>
                          <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_producto_id" id="gos_producto_id" >
                            <option></option>
                            @foreach ($listaProductos as $producto)
                            <option value="{{$producto->gos_producto_id}}">
                               @if($producto->codigo == 'compra unica')
                              {{ strtoupper(str_pad($producto->nomb_producto,20)).', '.str_pad(strtolower(ucfirst($producto->descripcion)),20).' ('.intval($producto->cantidad).')'}}
                               @else
                              {{ strtoupper(str_pad($producto->nomb_producto,20)).', '.str_pad(strtolower(ucfirst($producto->codigo)),20).' ('.intval($producto->cantidad).')'}}
                               @endif
                            </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 col-lg-3 mb-2">
                          <label style="font-size: 1rem;">Descripción</label>
                          <input type="text" class="form-control" name="descripcion" id="descripcion" disabled>
                          <input type="hidden" class="form-control" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}} ">
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">P.Venta.</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text p-1">$</span>
                            </div>
                            <input type="text" class="form-control pl-1 pr-0" name="precio_materiales" id="precio_materiales" >
                            <input type="hidden" class="form-control pl-1 pr-0" name="codigo_sat" id="codigo_sat" >
                          </div>
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Descuento</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text p-1">$</span>
                            </div>
                            <input type="text" class="form-control pl-1 pr-0" name="descuento" id="descuento" value="">
                          </div>
                        </div>
                        <div class="form-group col-3 col-lg-2 mb-2">
                          <label style="font-size: 1rem;">Cantidad</label>
                          <input type="text" class="form-control pl-1 pr-0" name="cantidad" id="cantidad" value="">
                        </div>
                        <div class="col-1 mb-2 align-self-end">
                            <button type="button" id="btn_ItemPaqueteOS" class="btn btn-success">
                              <i class="fas fa-plus p-0" style="color: white!important;"></i>
                            </button>
                        </div>
                      </div>
                    </form>
            </div>
            <div class="modal-footer">
                <div class="table-responsive p-1">
                    <table class="table table-sm table-hover" id="dt-InventarioInt" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Código SAT</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Importe</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
              <button style="width:30%; margin: 2% auto;" type="button" class="btn btn-success btn-block" id="btnGuardarInventarioInt">Guardar</button>
        </div>
    </div>
</div>
