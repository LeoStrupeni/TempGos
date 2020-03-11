<div class="modal fade" id="ModalRequisicion" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TitleModalRequisicion"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-1">
                <form id="RequisicionForm">
                    @csrf
                    <input type="hidden" name="gos_requisicion_id" id="gos_requisicion_id">
                    <div class="form-row">
                        <div class="form-group col-4 px-1 mb-2">
                            <label>Proveedor</label>
                            <div class="input-group">
                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_proveedor_id" id="gos_proveedor_id">
                                    <option></option>
                                    @foreach ($listaProveedores as $proveedor)
                                    <option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nomb_proveedor}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-brand" type="button" data-toggle="modal" data-target="#ProveedorRapido">
                                        <i class="fas fa-plus p-0" style="color: white!important;"></i>
                                    </button>
                                </div>
                            </div>
                            <small style="font-style: italic;" class="gos_proveedor_id form-text text-danger"></small>
                        </div>
                        <div class="form-group col-3 pl-1 mb-2">
                            <label>Fecha de solicitud</label>
                            <input type="text" class="form-control kt_datetimepicker_1" name="fecha_Solicitud" id="fecha_Solicitud">                            
                        </div>
                        <div class="form-group col-5 pl-1 mb-2">
                            <label >Vehiculo</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-brand" data-toggle="modal" data-target="#modalbuscarVehiculo">
                                        <i class="fas fa-search p-0" style="color: white!important;"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" id="gos_vehiculo_detalles" name="gos_vehiculo_detalles" readonly>
                                <input type="hidden" id="gos_vehiculo_id" name="gos_vehiculo_id">
                                <input type="hidden" id="gos_os_id" name="gos_os_id">
                            </div>
                            <small style="font-style: italic;" class="gos_vehiculo_id form-text text-danger"></small>
                        </div>
                    </div>
                </form>
                <form id="ItemRequisicionForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-2 px-1 mb-2">
                            <label class="text-nowrap">Producto</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_producto_id" id="gos_producto_id" onchange="MostrarProductoRequisicion();">
                                <option selected></option>
                                @foreach ($listaProductos as $producto)
                                <option value="{{$producto->gos_producto_id}}">{{$producto->nomb_producto}}</option>
                                @endforeach
                            </select>
                            <small style="font-style: italic;" class="gos_producto_id form-text text-danger"></small>
                        </div>
                        <div class="form-group col-2 pl-1 mb-2">
                            <label class="text-nowrap">Marca</label>
                            <input type="text" class="form-control" name="nomb_marca" id="nomb_marca" style="background-color: #f7f8fa;" readonly>
                        </div>
                        <div class="form-group col-3 pl-1 mb-2">
                            <label class="text-nowrap">Descripcion</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" style="background-color: #f7f8fa;" readonly>
                        </div>
                        <div class="form-group col-2 pl-1 mb-2">
                            <label class="text-nowrap">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad" id="cantidad">
                            <small style="font-style: italic;" class="cantidad form-text text-danger"></small>
                        </div>
                        <div class="form-group col-2 pl-1 mb-2">
                            <label class="text-nowrap">Medida</label>
                            <input type="text" class="form-control" name="nomb_medida" id="nomb_medida" style="background-color: #f7f8fa;" readonly>
                        </div>
                        <button type="button" id="btn_ItemRequisicion" class="btn btn-brand h-50" style="margin-top:25px;">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                        </button>                
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="dt-itemsRequisicion">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-2">ID</th>
                                <th class="p-2">Nombre</th>
                                <th class="p-2">Codigo</th>
                                <th class="p-2">Marca</th>
                                <th class="p-2">Descripción</th>
                                <th class="p-2">Cantidad</th>
                                <th class="p-2">Medida</th>
                                <th style="width:3%;"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-2 offset-10">
                    <button type="button" class="btn btn-brand btn-block mt-2" id="btnGuardarUsuarioAdmin">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL AGREGADO RAPIDO PROVEEDOR --}}

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

{{-- MODAL SELECCION VEHICULO --}}

<div class="modal fade" id="modalbuscarVehiculo" tabindex="-1"
	role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%;min-width: 80%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Búsqueda Vehículo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-sm" id="dt-requisicion-vehiculos">
						<thead class="thead-light">
							<tr>
                                <th># Orden</th>
								<th>Cliente</th>
								<th>Vehiculo</th>
								<th># Economico</th>
								<th># Serie</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>