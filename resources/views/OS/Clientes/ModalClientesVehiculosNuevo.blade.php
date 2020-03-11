<div class="modal fade" id="modalCliente" role="dialog">
 	<div class="modal-dialog modal-m modal-l" role="document">
    	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalCliente"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
      		<div class="modal-body">

      		@include('Layout/errores')

				<form id="clienteForm">
					@csrf

                    <input type="hidden" name="gos_modelo" id="gos_modelo">
					<div class="kt-portlet kt-portlet--tabs">

						<div class="kt-portlet__body">
							<div class="tab-content">
							<!--DATOS DEL CLIENTE-->
								<div class="linkModalCliente1 tab-pane active" id="clienteDatos" role="tabpanel">
									<div class="form-row">
										<div class="form-group col-6">
											<label>Nombre(s)</label>
											<input type="text" class="form-control" name="nombre" id="nombre" required>
											<small style="font-style: italic;" class="nombre form-text text-danger"></small>
										</div>
										<div class="form-group col-6">
											<label>Apellidos</label>
											<input type="text" class="form-control" name="apellidos" id="apellidos">
                      						<small style="font-style: italic;" class="apellidos form-text text-danger"></small>
										</div>
                                        <div class="form-group col-6">
											<label>Empresa</label>
											<input type="text" class="form-control" name="empresa" id="empresa">
                      						<small style="font-style: italic;" class="empresa form-text text-danger"></small>
										</div>
    								</div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
											<label>Celular</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"> <img src="/img/mexico-flag.png" alt=""></span>
												</div>
												<input type="text" class="form-control" name="celular" id="celular">
											</div>
											<small style="font-style: italic;" class="celular form-text text-danger"></small>
										</div>
                                        <div class="form-group col-6">
											<label>Correo electónico <input type="checkbox" id="email_cliente_Check" value="1" onclick="email_cliente.disabled = !this.checked"></label>
											<input type="text" class="form-control" name="email_cliente" id="email_cliente" disabled>
                      						<small style="font-style: italic;" class="email_cliente form-text text-danger"></small>
										</div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Marca</label>
                                            <div class="input-group">
                                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_marca_id" id="gos_vehiculo_marca_id">
                                                    <option value="0"></option>
                                                    @if(isset($listaMarcas))
                                                    @foreach ($listaMarcas as $marca)
                                                    <option value="{{$marca->gos_vehiculo_marca_id}}">{{$marca->marca_vehiculo}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                            <small style="font-style: italic;" class="gos_vehiculo_marca_id form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Modelo</label>
                                            <div class="input-group">
                                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_modelo_id" id="gos_vehiculo_modelo_id">

                                                </select>
                                            </div>
                                            <small style="font-style: italic;" class="gos_vehiculo_modelo_id form-text text-danger"></small>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Año</label>
                                            <input type="text" class="form-control" name="anio_vehiculo" id="anio_vehiculo">

											<small style="font-style: italic;" class="anio_vehiculo form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Color</label>
                                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="color_vehiculo" id="color_vehiculo">
                                                <option></option>
                                                @if(isset($coloresVehiculo))
                                                @foreach ($coloresVehiculo as $color)
                                                <option value="{{$color->codigohex}}">{{$color->nomb_color}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small style="font-style: italic;" class="color_vehiculo form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;"># de Placa</label>
                                            <input type="text" class="form-control" name="placa" id="placa">
                                            <small style="font-style: italic;" class="placa form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;"># Económico</label>
                                            <input type="text" class="form-control" name="economico" id="economico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 1rem;"># de Serie</label>
                                        <input type="text" class="form-control" name="nro_serie" id="nro_serie">
                                        <small style="font-style: italic;" class="nro_serie form-text text-danger"></small>
                                    </div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot p-2">
						<button type="button" class="btn btn-success btn-block" id="btn-guardar-cliente">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->
