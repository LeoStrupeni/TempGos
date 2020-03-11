<div class="modal fade" id="modalInventarioExterno" role="dialog">
    <div class="modal-dialog modal-xl modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modalInventarioExterno"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form id="inventarioExterno-form">
					@csrf
					<input type="hidden" name="gos_producto_id" id="gos_producto_id" value="">
					<input type="hidden" name="gos_producto_ubic_stock_id" id="gos_producto_ubic_stock_id" value="">
					<div class="form-row">
						<div class="form-group col-6">
							<label>Proveedor</label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_proveedor_id" id="gos_proveedor_id">
									<option></option>
									@foreach ($listaProveedores as $proveedor)
									<option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nombreProveedor}}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-brand p-1" type="button" data-toggle="modal" data-target="#ProveedorRapido">
										<i class="fas fa-plus p-0" style="color: white!important;"></i>
									</button>
								</div>
							</div>
							<small style="font-style: italic;" class="gos_proveedor_id form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Código</label>
							<input type="text" class="form-control" name="codigo" id="codigo" value="">
							<small style="font-style: italic;" class="codigo form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Nombre</label>
							<input type="text" class="form-control" name="nomb_producto" id="nomb_producto" value="">
							<small style="font-style: italic;" class="nomb_producto form-text text-danger"></small>
						</div>
						<div class="form-group col-8">
							<label>Descripción</label>
							<input type="text" class="form-control" name="descripcion" id="descripcion" value="">
							<small style="font-style: italic;" class="descripcion form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Cantidad</label>
							<input type="text" class="form-control" name="cantidad" id="cantidad" value="">
							<small style="font-style: italic;" class="cantidad form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Medida</label>
							<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_medida_id" id="gos_producto_medida_id">
								<option></option>
								@foreach ($listaMedidas as $medida)
								<option value="{{$medida->gos_producto_medida_id}}"> {{$medida->nomb_medida}} ({{$medida->nomen}})</option>
								@endforeach
							</select>
							<small style="font-style: italic;" class="gos_producto_medida_id form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marca<?php endif; ?></label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_marca_id" id="gos_producto_marca_id">
									<option></option>
									@foreach ($listaMarcas as $marca)
									<option value="{{$marca->gos_producto_marca_id}}"> {{$marca->nomb_marca}}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-brand p-1" type="button"name="button" onclick="getselectMarca();">
										<i class="fas fa-plus p-0" style="color: white!important;"></i>
									</button>
								</div>
							</div>
							<small style="font-style: italic;" class="gos_producto_marca_id form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Familia</label>
							<div class="input-group">
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_familia_id" id="gos_producto_familia_id">
									<option></option>
									@foreach ($listaFamilias as $familia)
									<option value="{{$familia->gos_producto_familia_id}}">{{$familia->nomb_familia}}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-brand p-1" type="button"name="button" onclick="getselectFamilia();">
										<i class="fas fa-plus p-0" style="color: white!important;"></i>
									</button>
								</div>
							</div>
							<small style="font-style: italic;" class="gos_producto_familia_id form-text text-danger"></small>
						</div>
						<div class="form-group col-6">
							<label>Código productos SAT</label>
							<input type="text" class="form-control" name="codigo_sat" id="codigo_sat" value="">
							<small style="font-style: italic;" class="codigo_sat form-text text-danger"></small>
						</div>
						<div class="form-group col-4">
							<label>Costo</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">$</span></div>
								<input type="text" class="form-control" name="costo" id="costo" value="">
								<small style="font-style: italic;" class="costo form-text text-danger"></small>
							</div>
						</div>
						<div class="form-group col-4">
							<label>% de Ganancia <i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover' data-content=''></i>
								<input type="checkbox" value="1" onclick="ganancia.disabled = !this.checked">
							</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">%</span></div>
								<input type="text" class="form-control" name="ganancia" id="ganancia" value="" disabled>
							</div>
							<small style="font-style: italic;" class="ganancia form-text text-danger"></small>
						</div>
						<input type="hidden" name="gananciaok" id="gananciaok" value="">
						<div class="form-group col-4">
							<label>P. Venta</label>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">$</span></div>
								<input type="text" class="form-control" name="venta" id="venta" value="">
							</div>
							<small style="font-style: italic;" class="venta form-text text-danger"></small>
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
														<input type="text" class="form-control" name="cant_minima" id="cant_minima" value="">
													</div>
													<small style="font-style: italic;" class="cant_minima form-text text-danger"></small>
												</div>
												<div class="form-group col-6">
													<label>Ubicación en almacén (Opcional)</label>
													<input type="text" class="form-control" name="ubicacion" id="ubicacion" value="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-success btn-block" id="btn-guardar-producto">Guardar</button>
				</form>
			</div>
		</div>
	</div>
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