<div class="row">
    <div class="col">
        <form id="compras_form">
            @csrf
            <input type="hidden" name="gos_compra_id" id="gos_compra_id" value={{$compra->gos_compra_id ?? ''}}>
            <input type="hidden" name="gos_os_id" id="gos_os_id" value={{$compra->gos_os_id ?? ''}}>
            <input type="hidden" id="gos_os_nro_Interno" value={{$nroInterno->nro_orden_interno ?? ''}}>
            <div class="form-row">
                <div class="form-group col-3 col-lg-1 px-1 mb-3 text-center">
                    <label class="text-nowrap"># factura</label>
                    <input type="text" class="form-control" id="nro_factura" name="nro_factura" value={{$compra->nro_factura ?? ''}}>
                    <small style="font-style: italic;" class="nro_factura form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Tipo de compra</label>
                    <select class="custom-select" name="gos_compra_tipo_id" id="gos_compra_tipo_id">
                        <option></option>
                        @foreach ($listaTiposCompra as $tipoCompra)
                        <option value="{{$tipoCompra->gos_compra_tipo_id}}" 
                            {{(($compra->gos_compra_tipo_id ?? '' ) == $tipoCompra->gos_compra_tipo_id ? 'selected' : '')}}>
                            {{$tipoCompra->tipo_compra}}
                        </option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="tipo_compra form-text text-danger"></small>
                </div>
                <div class="form-group col-3 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Proveedor</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-brand px-1" type="button" onclick="cargaRapidaProv();">
                                <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                            </button>
                        </div>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_proveedor_id" id="gos_proveedor_id_compras">
                            <option></option>
                            @foreach ($listaProveedores as $proveedor)
                            <option value="{{$proveedor->gos_proveedor_id}}"
                                {{( ($compra->gos_proveedor_id ?? '') == $proveedor->gos_proveedor_id ? 'selected' : '')}}>
                                {{$proveedor->nomb_proveedor}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <small style="font-style: italic;" class="gos_proveedor_id form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Fecha de compra</label>
                    <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" value={{$compra->fecha_compra ?? ''}}>
                    <small style="font-style: italic;" class="fecha form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Forma de pago</label>
                    <select class="custom-select" name="gos_forma_pago_id" id="gos_forma_pago_id">
                        <option></option>
                        @foreach ($listaFormasPagos as $formapago)
                        <option value="{{$formapago->gos_forma_pago_id}}"
                            {{( ($compra->gos_forma_pago_id ?? '') == $formapago->gos_forma_pago_id ? 'selected' : '')}}>
                            {{$formapago->nomb_forma_pago}}
                        </option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="gos_forma_pago_id form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center" id="f_pago"
                style={{( ($compra->gos_forma_pago_id ?? '') == '2' ? '' : 'display:none;')}}>
                    <label class="text-nowrap">Fecha de pago</label>
                    <input type="date" class="form-control" name="fecha_pago" id="fecha_pago" value={{$compra->fecha_pago ?? ''}}>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Tipo de pago</label>
                    <select class="custom-select" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                        <option></option>
                        @foreach ($listaMetodosPagos as $metodopago)
                        <option value="{{$metodopago->gos_metodo_pago_id}}"
                            {{( ($compra->gos_metodo_pago_id ?? '') == $metodopago->gos_metodo_pago_id ? 'selected' : '')}}>
                            {{$metodopago->nomb_met_pago}}
                        </option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="tipo_pago form-text text-danger"></small>
                </div>
            </div>
        </form>
        <form id="ItemCompra_form">
            @csrf
            <input type="hidden" name="gos_producto_marca_id" id="gos_producto_marca_id">
            <input type="hidden" name="nomb_producto" id="nomb_producto">
            <div class="form-row">
                <div class="form-group col-4 col-lg-3 px-1 mb-3 text-center remove" id="ProductosInternos">
                    <label class="text-nowrap">Producto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-brand p-1" type="button" onclick="modalProductoCompra();">
                            <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                            </button>
                        </div>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_id" id="gos_producto_id_compra" onchange="MostrarSelectProducto();">
                            <option></option>
                            <option value="CP">Compra unica</option>
                            @foreach ($listaProductos as $producto)
                            <option value="{{$producto->gos_producto_id}}">{{$producto->nomb_producto}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small style="font-style: italic;" class="gos_producto_id form-text text-danger"></small>
                </div>

                <div class="form-group col-4 col-lg-3 px-1 mb-3 text-center remove d-none" id="ProductosExternos">
                    <label class="text-nowrap">Producto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-brand p-1" type="button" onclick="modalProductoExtCompra();">
                            <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                            </button>
                        </div>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_id_ext" id="gos_producto_id_ext" onchange="MostrarSelectExtProducto();">
                            <option></option>
                            {{-- <option value="CP">Compra unica</option> --}}
                            @foreach ($listaInvExterno as $producto)
                            <option value="{{$producto->gos_producto_id}}">{{$producto->nomb_producto}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small style="font-style: italic;" class="gos_producto_id_ext form-text text-danger"></small>
                </div>

                <div class="form-group col-2 col-lg-1 pl-1 mb-3 text-center remove">
                    <label class="text-nowrap">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" id="cantidad" required>
                    <small style="font-style: italic;" class="cantidad form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" style="background-color: #f7f8fa;" readonly>
                    <small style="font-style: italic;" class="descripcion form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-1 pl-1 mb-3 text-center remove">
                    <label class="text-nowrap">Marca</label>
                    <input type="text" class="form-control" name="nomb_marca" id="nomb_marca" style="background-color: #f7f8fa;" readonly>
                    <small style="font-style: italic;" class="nomb_marca form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-1 pl-1 mb-3 text-center remove">
                    <label class="text-nowrap">Medida</label>
                    <input type="text" class="form-control" name="nomb_medida" id="nomb_medida" style="background-color: #f7f8fa;" readonly>
                    <select name="gos_producto_medida_id" id="gos_producto_medida_id" class="form-control d-none">
                        @foreach ($listaMedidas as $medida)
                        <option value="{{$medida->gos_producto_medida_id}}"> {{$medida->nomb_medida}} ({{$medida->nomen}})</option>
                        @endforeach
                    </select>
                    <small style="font-style: italic;" class="nomb_medida form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-1 pl-1 mb-3 text-center">
                    <label class="text-nowrap">Costo</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text p-1">$</span></div>
                        <input type="text" class="form-control" name="costo" id="costo">
                    </div>
                    <small style="font-style: italic;" class="costo form-text text-danger"></small>
                </div>
                <div class="form-group col-3 col-lg-2 pl-1 mb-3 text-center remove">
                    <label class="text-nowrap">P. de Venta</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text p-1">$</span></div>
                        <input type="text" class="form-control" name="venta" id="venta" required>                        
                    </div>
                    <small style="font-style: italic;" class="venta form-text text-danger"></small>
                </div>
                <button type="button" id="btn_ItemCompra" class="btn btn-success h-50" style="margin-top:25px;">
                    <i class="fas fa-plus p-0" style="color: white!important;"></i>
                </button>                
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-sm table-hover " id="dt-itemsCompras">
        <thead class="thead-light">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2 text-center">Nombre</th>
                <th class="p-2 text-center">Marca</th>
                <th class="p-2 text-center">Descripción</th>
                <th class="p-2 text-center">Cantidad</th>
                <th class="p-2 text-center">Medida</th>
                <th class="p-2 text-center">Costo</th>
                <th class="p-2 text-center">Precio venta</th>
                <th style="width:3%;"></th>
            </tr>
        </thead>
    </table>
</div>


<div class="modal fade hide" id="ProveedorRapido" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 30%;min-width: 30%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ProveedorFormRapido">
                    @csrf
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
                    <button type="button" class="btn btn-success btn-block" id="btn-guardadoRapidoProveedor" onclick="getselectProveedor();">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalInventarioInterno" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modalInventarioInterno"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<div class="kt-portlet">
					<div class="kt-portlet__body p-2">
                        <form id="inventarioInterno-formCompras">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Proveedor</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_proveedor_id" id="gos_proveedor_id_PRO">
                                        <option></option>
                                        @foreach ($listaProveedores as $proveedor)
                                        <option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nomb_proveedor}}</option>
                                        @endforeach
                                    </select>
                                    <small style="font-style: italic;" class="gos_proveedor_id_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-6">
                                    <label>Código</label>
                                    <input type="text" class="form-control" name="codigo" id="codigo_PRO" value="">
                                    <small style="font-style: italic;" class="codigo_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-4">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nomb_producto" id="nomb_producto_PRO" value="">
                                    <small style="font-style: italic;" class="nomb_producto_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-8">
                                    <label>Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion_PRO" value="">
                                    <small style="font-style: italic;" class="descripcion_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-4">
                                    <label>Cantidad</label>
                                    <input type="text" class="form-control" name="cantidad" id="cantidad_PRO" value="">
                                    <small style="font-style: italic;" class="cantidad_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-4">
                                    <label>Medida</label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_medida_id" id="gos_producto_medida_id_PRO">
                                        <option></option>
                                        @foreach ($listaMedidas as $medida)
                                        <option value="{{$medida->gos_producto_medida_id}}"> {{$medida->nomb_medida}} ({{$medida->nomen}})</option>
                                        @endforeach
                                    </select>
                                    <small style="font-style: italic;" class="gos_producto_medida_id_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-4">
                                    <label>Marca</label>
                                    <div class="input-group">
                                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_marca_id" id="gos_producto_marca_id_PRO">
                                            <option></option>
                                            @foreach ($listaMarcas as $marca)
                                            <option value="{{$marca->gos_producto_marca_id}}"> {{$marca->nomb_marca}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-brand p-1" type="button"name="button" onclick="getselectMarcaCompra();">
                                                <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small style="font-style: italic;" class="gos_producto_marca_id_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-6">
                                    <label>Familia</label>
                                    <div class="input-group">
                                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_familia_id" id="gos_producto_familia_id_PRO">
                                            <option></option>
                                            @foreach ($listaFamilias as $familia)
                                            <option value="{{$familia->gos_producto_familia_id}}">{{$familia->nomb_familia}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-brand p-1" type="button"name="button" onclick="getselectFamiliaCompra();">
                                                <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small style="font-style: italic;" class="gos_producto_familia_id_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-6">
                                    <label>Código productos SAT</label>
                                    <input type="text" class="form-control" name="codigo_sat" value="">
                                </div>
                                <div class="form-group col-4">
                                    <label>Costo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control" name="costo" id="costo_PRO">
                                    </div>
                                    <small style="font-style: italic;" class="costo_PRO form-text text-danger"></small>
                                </div>
                                <div class="form-group col-4">
                                    <label>% de Ganancia <i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover' data-content=''></i>
                                        <input type="checkbox" value="1" onclick="ganancia.disabled = !this.checked">
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                        <input type="text" class="form-control" name="ganancia" id="ganancia_PRO" disabled value="" >
                                    </div>
                                    <small style="font-style: italic;" class="ganancia_PRO form-text text-danger"></small>
                                </div>
                                <input type="hidden" name="gananciaok" id="gananciaok_PRO" value="">
                                <div class="form-group col-4">
                                    <label>P. Venta</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control" name="venta" id="venta_PRO" value="">
                                    </div>
                                    <small style="font-style: italic;" class="venta_PRO form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="kt-portlet">
                                <div class="kt-portlet__body p-0">
                                    <div class="accordion accordion-light">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <i class="flaticon2-plus"></i> Agregar Mas datos
                                                </div>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-6">
                                                            <label>Cantidad mínima (Opcional)
                                                                <i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover' data-content=''></i>
                                                                <input type="checkbox" value="1" name="cant_minima_CHEK">
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="cant_minima" id="cant_minima_PRO" value="">
                                                            </div>
                                                            <small style="font-style: italic;" class="cant_minima_PRO form-text text-danger"></small>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Ubicación en almacén (Opcional)</label>
                                                            <div class="input-group">
                                                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_ubicacion_id" id="gos_producto_ubicacion_id_PRO">
                                                                    <option></option>
                                                                    @foreach ($listaUbicaciones as $ubicacion)
                                                                    <option value="{{$ubicacion->gos_producto_ubicacion_id}}">{{$ubicacion->nomb_ubicacion}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-brand p-1" type="button"name="button" onclick="getselectUbicacionCompra();">
                                                                        <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-block" onclick="validacionesproductos();">Guardar</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalInventarioExterno" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modalInventarioExterno"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form id="inventarioExterno-form">
					@csrf
					<div class="form-row">
						<div class="form-group col-6">
							<label>Proveedor</label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_proveedor_id" id="gos_proveedor_id_EXT">
									<option></option>
									@foreach ($listaProveedores as $proveedor)
									<option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nomb_proveedor}}</option>
									@endforeach
                                </select>
							</div>
							<small style="font-style: italic;" class="gos_proveedor_id_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Código</label>
							<input type="text" class="form-control" name="codigo" id="codigo_EXT" value="">
							<small style="font-style: italic;" class="codigo_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Nombre</label>
							<input type="text" class="form-control" name="nomb_producto" id="nomb_producto_EXT" value="">
							<small style="font-style: italic;" class="nomb_producto_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-8">
							<label>Descripción</label>
							<input type="text" class="form-control" name="descripcion" id="descripcion_EXT" value="">
							<small style="font-style: italic;" class="descripcion_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Cantidad</label>
							<input type="text" class="form-control" name="cantidad" id="cantidad_EXT" value="">
							<small style="font-style: italic;" class="cantidad_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Medida</label>
							<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_medida_id" id="gos_producto_medida_id_EXT">
								<option></option>
								@foreach ($listaMedidas as $medida)
								<option value="{{$medida->gos_producto_medida_id}}"> {{$medida->nomb_medida}} ({{$medida->nomen}})</option>
								@endforeach
							</select>
							<small style="font-style: italic;" class="gos_producto_medida_id_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Marca</label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_marca_id" id="gos_producto_marca_id_EXT">
									<option></option>
									@foreach ($listaMarcas as $marca)
									<option value="{{$marca->gos_producto_marca_id}}"> {{$marca->nomb_marca}}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-brand p-1" type="button"name="button" onclick="getselectMarcaCompraExt();">
										<i class="fas fa-plus p-0" style="color: white!important;"></i>
									</button>
								</div>
							</div>
							<small style="font-style: italic;" class="gos_producto_marca_id_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Familia</label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_familia_id" id="gos_producto_familia_id_EXT">
									<option></option>
									@foreach ($listaFamilias as $familia)
									<option value="{{$familia->gos_producto_familia_id}}">{{$familia->nomb_familia}}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-brand p-1" type="button"name="button" onclick="getselectFamiliaCompraExt();">
										<i class="fas fa-plus p-0" style="color: white!important;"></i>
									</button>
								</div>
							</div>
							<small style="font-style: italic;" class="gos_producto_familia_id_EXT form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Código productos SAT</label>
							<input type="text" class="form-control" name="codigo_sat" value="">
						</div>
						<div class="form-group col-4">
							<label>Costo</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">$</span></div>
								<input type="text" class="form-control" name="costo" id="costo_EXT" value="">
								<small style="font-style: italic;" class="costo_EXT form-text text-danger"></small>
							</div>
						</div>
						<div class="form-group col-4">
							<label>% de Ganancia <i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover' data-content=''></i>
								<input type="checkbox" value="1" onclick="ganancia.disabled = !this.checked">
							</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">%</span></div>
								<input type="text" class="form-control" name="ganancia" id="ganancia_EXT" value="" disabled>
							</div>
							<small style="font-style: italic;" class="ganancia_EXT form-text text-danger"></small>
						</div>
						<input type="hidden" name="gananciaok" id="gananciaok_EXT" value="">
						<div class="form-group col-4">
							<label>P. Venta</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">$</span></div>
								<input type="text" class="form-control" name="venta" id="venta_EXT" value="">
							</div>
							<small style="font-style: italic;" class="venta_EXT form-text text-danger"></small>
						</div>
					</div>
					<div class="kt-portlet ">
						<div class="kt-portlet__body p-0">
							<div class="accordion accordion-light">
								<div class="card">
									<div class="card-header" id="headingOne">
										<div class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
											<i class="flaticon2-plus"></i> Agregar Mas datos
										</div>
									</div>
									<div id="collapseOne" class="collapse" aria-labelledby="headingOne">
										<div class="card-body">
											<div class="form-row">
												<div class="form-group col-6">
													<label>Cantidad mínima (Opcional)
														<i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover' data-content=''></i>
														<input type="checkbox" value="1" name="cant_minima_CHEK">
													</label>
													<div class="input-group">
														<input type="text" class="form-control" name="cant_minima" id="c" value="">
													</div>
													<small style="font-style: italic;" class="cant_minima_EXT form-text text-danger"></small>
												</div>
												<div class="form-group col-6">
													<label>Ubicación en almacén (Opcional)</label>
													<input type="text" class="form-control" name="ubicacion" id="ubicacion_EXT" value="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-success btn-block" onclick="validacionesproductosExt();">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>