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
					<input type="hidden" name="gos_cliente_id" id="gos_cliente_id">
					<input type="hidden" name="gos_region_ciudad" id="gos_region_ciudad">
					<input type="hidden" name="gos_fac_region_ciudad" id="gos_fac_region_ciudad">
					<div class="kt-portlet kt-portlet--tabs">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-toolbar">
								<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
									<li class="nav-item">
										<a class="linkModalCliente1 nav-link" data-toggle="tab" href="#clienteDatos" role="tab">Cliente</a>
									</li>
									<li class="nav-item">
										<a class="linkModalCliente2 nav-link" data-toggle="tab" href="#datosFacturacion" role="tab">Datos de facturación</a>
									</li>
									<li class="nav-item">
										<a class="linkModalCliente3 nav-link" data-toggle="tab" href="#clienteconfiguracion" role="tab">Configuración</a>
									</li>
								</ul>
							</div>
						</div>
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
										<div class="form-group col-6">
											<label>Correo electónico <input type="checkbox" id="email_cliente_Check" value="1" onclick="email_cliente.disabled = !this.checked"></label>
											<input type="text" class="form-control" name="email_cliente" id="email_cliente" disabled>
                      						<small style="font-style: italic;" class="email_cliente form-text text-danger"></small>
										</div>
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
											<label>Teléfono</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"> <img src="/img/mexico-flag.png" alt=""></span>
												</div>
												<input type="text" class="form-control" name="telefono_fijo" id="telefono_fijo">
											</div>
											<small style="font-style: italic;" class="telefono_fijo form-text text-danger"></small>
										</div>
										<div class="kt-portlet">
											<div class="kt-portlet__body p-0">
												<div class="accordion accordion-light">
													<div class="card">
														<div class="card-header" id="headingOne">
															<div class="card-title" data-toggle="collapse" data-target="#masDatoscliente" aria-expanded="false" aria-controls="collapseOne">
																<i class="flaticon2-plus"></i> Agregar Más
															</div>
														</div>
														<div id="masDatoscliente" class="collapse" aria-labelledby="headingOne">
															<div class="row mb-2 pl-4"><div class="col-12 h5">Dirección cliente</div></div>
															<div class="form-row">
																<div class="form-group col-6">
																	<label>Calle</label>
																	<input type="text" class="form-control" name="calle_nro" id="calle_nro">
																	<small style="font-style: italic;" class="calle_nro form-text text-danger"></small>
																</div>
																<div class="form-group col-6">
																	<label>Código Postal</label>
																	<input type="text" class="form-control" name="codigo_postal" id="codigo_postal">
																	<small style="font-style: italic;" class="codigo_postal form-text text-danger"></small>
																</div>
																<div class="col-6">
																	<div class="form-group">
																	<label>Estado</label>
																	<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_region_estado_id" id="gos_region_estado_id">
																		<option></option>
																		@if(isset($listaEstados))
																		@foreach($listaEstados as $estado)
																		<option value="{{$estado->gos_region_estado_id}}">{{$estado->nomb_estado}}</option>
																		@endforeach
																		@endif
																	</select>
																	<small style="font-style: italic;" class="gos_region_estado_id form-text text-danger"></small>
																	</div>
																</div>
																<div class="col-6">
																	<div class="form-group">
																	<label>Ciudad</label>
																	<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_region_ciudad_id" id="gos_region_ciudad_id">
																		<option></option>
																
																	</select>
																	<small style="font-style: italic;" class="gos_region_ciudad_id form-text text-danger"></small>
																	</div>
																</div>
																<div class="form-group col-6">
																	<label>Municipio</label>
																	<input type="text" class="form-control" name="cliente_municipio" id="cliente_municipio">
																	<small style="font-style: italic;" class="cliente_municipio form-text text-danger"></small>
																</div>
																<div class="col-6">
																	<div class="form-group">
																	<label>Colonia</label>
														
																	<input type="text" class="form-control" name="cliente_localidad" id="cliente_localidad">

																	<small style="font-style: italic;" class="cliente_localidad form-text text-danger"></small>
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
							<!--DATOS DE FACTURACION-->
								<div class="linkModalCliente2 tab-pane" id="datosFacturacion" role="tabpanel">
									<div class="form-row">
										<div class="form-group col-6">
											<label>Persona Física o Moral</label>
											<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_fac_tipo_persona_id" id="gos_fac_tipo_persona_id">
												<option value="0" selected> Sin tipo</option>
												
											@if(isset($listaTipoPersonas))
												@foreach ($listaTipoPersonas as $tipoPersona)
												<option value="{{$tipoPersona->gos_fac_tipo_persona_id}}"> {{$tipoPersona->tipo_persona}}</option>
												@endforeach
											@endif
											</select>
											<small style="font-style: italic;" class="gos_fac_tipo_persona_id form-text text-danger"></small>
										</div>
										<div class="form-group col-6">
											<label>Razón social</label>
											<input type="text" class="form-control" name="razon_social" id="razon_social">
											<small style="font-style: italic;" class="razon_social form-text text-danger"></small>
										</div>
										<div class="form-group col-6">
											<label>RFC</label>
											<input type="text" class="form-control" name="rfc" id="rfc">
											<small style="font-style: italic;" class="rfc form-text text-danger"></small>
										</div>
										<div class="form-group col-6">
											<label>Correo electónico</label>
											<input type="text" class="form-control" name="email_factura" id="email_factura">
											<small style="font-style: italic;" class="email_factura form-text text-danger"></small>
										</div>
										{{-- acordion --}}
										<div class="kt-portlet">
											<div class="kt-portlet__body p-0">
												<div class="accordion accordion-light">
													<div class="card">
														<div class="card-header" id="headingOne">
															<div class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
																<i class="flaticon2-plus"></i> Agregar Más
															</div>
														</div>
														<div id="collapseOne" class="collapse" aria-labelledby="headingOne">
															<div class="card-body">
																<div class="row mb-2 pl-4"><div class="col-12 h5">Dirección fiscal</div></div>
																<div class="form-row">
																	<div class="form-group col-6">
																		<label>Calle</label>
																		<input type="text" class="form-control" name="calle_nro_fac" id="calle_nro_fac">
																		<small style="font-style: italic;" class="calle_nro_fac form-text text-danger"></small>
																	</div>
																	<div class="form-group col-6">
																		<label>Número exterior</label>
																		<input type="text" class="form-control" name="nro_exterior_fac" id="nro_exterior_fac">
																		<small style="font-style: italic;" class="nro_exterior_fac form-text text-danger"></small>
																	</div>
																	<div class="form-group col-6">
																		<label>Número interior</label>
																		<input type="text" class="form-control" name="nro_interior_fac" id="nro_interior_fac">
																		<small style="font-style: italic;" class="nro_interior_fac form-text text-danger"></small>
																	</div>
																	<div class="form-group col-6">
																		<label>Código Postal</label>
																		<input type="text" class="form-control" name="cp_fac" id="cp_fac">
																		<small style="font-style: italic;" class="cp_fac form-text text-danger"></small>
																	</div>
																	<div class="col-6">
																		<div class="form-group">
																		<label>Estado</label>
																		<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_fac_region_estado_id" id="gos_fac_region_estado_id">
																			<option></option>
																			@if(isset($listaEstados))
																			@foreach($listaEstados as $estado)
																			<option value="{{$estado->gos_region_estado_id}}">{{$estado->nomb_estado}}</option>
																			@endforeach
																			@endif
																		</select>
																		<small style="font-style: italic;" class="gos_fac_region_estado_id form-text text-danger"></small>
																		</div>
																	</div>
																	<div class="col-6">
																		<div class="form-group">
																		<label>Ciudad</label>
																		<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_fac_region_ciudad_id" id="gos_fac_region_ciudad_id">
																			<option></option>
																	
																		</select>
																		<small style="font-style: italic;" class="gos_fac_region_ciudad_id form-text text-danger"></small>
																		</div>
																	</div>
																	<div class="form-group col-6">
																		<label>Municipio</label>
																		<input type="text" class="form-control" name="cliente_fac_municipio" id="cliente_fac_municipio">
																		<small style="font-style: italic;" class="cliente_fac_municipio form-text text-danger"></small>
																	</div>
																	<div class="col-6">
																		<div class="form-group">
																		<label>Colonia</label>
															
																		<input type="text" class="form-control" name="cliente_fac_localidad" id="cliente_fac_localidad">

																		<small style="font-style: italic;" class="cliente_fac_localidad form-text text-danger"></small>
																		</div>
																	</div>
																
																	<div class="form-group col-12">
																		<label>Indicaciones para facturar</label>
																		<textarea class="form-control" name="indicaciones" id="indicaciones" rows="8"></textarea>
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
							<!--CONDICIONES DE CREDITO-->
								<div class="linkModalCliente3 tab-pane" id="clienteconfiguracion" role="tabpanel">
									<div class="clienteswitch">
										<div class="form-group row">
											<label class="col-9 col-form-label">Días de crédito para facturado</label>
											<div class="col-3">
												<span class="kt-switch kt-switch--sm kt-switch--icon">
													<label>
														<input type="checkbox" value="1" id="dias_credito_Check" onclick="dias_credito.disabled = !this.checked">
														<span></span>
													</label>
												</span>
											</div>
											<div class="col-9">
												<input class="form-control form-control-sm" type="text" name="dias_credito" id="dias_credito" disabled>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-9 col-form-label">Monto del crédito</label>
											<div class="col-3">
												<span class="kt-switch kt-switch--sm kt-switch--icon">
													<label>
														<input type="checkbox" value="1" id="monto_maximo_credito_Check" onclick="monto_maximo_credito.disabled = !this.checked">
														<span></span>
													</label>
												</span>
											</div>
											<div class="col-9">
												<input class="form-control form-control-sm" type="text" name="monto_maximo_credito" id="monto_maximo_credito" disabled>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-9 col-form-label">Número de cuenta del cliente</label>
											<div class="col-3">
												<span class="kt-switch kt-switch--sm kt-switch--icon">
													<label>
														<input type="checkbox" value="1" id="nro_cta_cliente_Check" onclick="nro_cta_cliente.disabled = !this.checked">
														<span></span>
													</label>
												</span>
											</div>
											<div class="col-9">
												<input class="form-control form-control-sm" type="text" name="nro_cta_cliente" id="nro_cta_cliente" disabled>
											</div>
										</div>
									</div>
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
