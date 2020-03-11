<div class="modal fade" id="modalTOT" role="dialog">
	<div class="modal-dialog modal-m modal-m">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalTOT"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="formTOT">
				@include('Layout/errores')
				@csrf
				<input type="hidden" name="gos_ot_id" id="gos_ot_id">
				<input type="hidden" name="gos_region_ciudad" id="gos_region_ciudad">
				<div class="kt-portlet kt-portlet--tabs">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-toolbar">
							<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
								<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#clienteDatos" role="tab">Otro taller</a>
								</li>
								{{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datosFacturacion" role="tab">Datos de facturacón</a>
								</li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clienteconfiguracion" role="tab">Configuración</a>
								</li> --}}
							</ul>
						</div>
					</div>
					<!--DATOS DEL TOT-->
					<div class="kt-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="clienteDatos" role="tabpanel">
                				<div class="form-group row">
									<div class="col-12">
										<div class="form-group">
											<label style="font-size: 1rem;">Nombre de la Empresa</label>
											<input class="form-control" type="text" name="nomb_ot" id="nomb_ot">
											<small style="font-style: italic;" class="nomb_ot form-text text-danger"></small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label style="font-size: 1rem;">Teléfono</label>
											<div class="input-group mb-2 mr-sm-2">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<img src="/img/mexico-flag.png" alt="">
													</div>
												</div>
											<input type="text" class="form-control" name="telefono" id="telefono">
											</div>
											<small style="font-style: italic;" class="telefono form-text text-danger"></small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label style="font-size: 1rem;">Calle y número</label>
											<input type="text" class="form-control" name="direccion" id="direccion">
											<small style="font-style: italic;" class="direccion form-text text-danger"></small>
										</div>
									</div>
									<div class="form-group col-6">
										<label style="font-size: 1rem;">Código Postal</label>
										<input type="text" class="form-control" name="cp" id="cp">
										<small style="font-style: italic;" class="cp form-text text-danger"></small>
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
										<input type="text" class="form-control" name="ot_municipio" id="ot_municipio">
										<small style="font-style: italic;" class="ot_municipio form-text text-danger"></small>
									</div>
									<div class="col-6">
										<div class="form-group">
										<label>Colonia</label>
							
										<input type="text" class="form-control" name="ot_localidad" id="ot_localidad">

										<small style="font-style: italic;" class="ot_localidad form-text text-danger"></small>
										</div>
									</div>
								</div>
							</div>
						<!--DATOS DE FACTURACION-->
						{{-- <div class="tab-pane" id="datosFacturacion" role="tabpanel">
								<div class="form-group row">
									<label style="font-size: 1rem;" class="col-8 col-form-label">Habilitar facturación por cliente <i class="fas fa-info-circle"></i></label>
									<div class="col-2">
										<span class="kt-switch kt-switch--sm">
											<label><input type="checkbox" name="habilita_facturacion_cliente" id="habilita_facturacion_cliente"><span></span>
											</label>
										</span>
									</div>
								</div>
								<div class="form-group row">
									<label style="font-size: 1rem;" class="col-8 col-form-label">Requiere autorización de valuación <i class="fas fa-info-circle"></i></label>
									<div class="col-2">
										<span class="kt-switch kt-switch--sm">
											<label><input type="checkbox" name="requiere_autorizacion" id="requiere_autorizacion"><span></span></label>
										</span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-6">
										<label style="font-size: 1rem;">Persona Física o Moral</label>
										<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_fac_tipo_persona_id" id="gos_fac_tipo_persona_id" required>
										@if (isset($listadoTiposPersonas))
											@foreach ($listadoTiposPersonas as $tipoPersona)
											<option value="{{$tipoPersona->gos_fac_tipo_persona_id}}"> {{$tipoPersona->tipo_persona}}</option>
											@endforeach
										@endif
										</select>
									</div>
									<div class="form-group col-6">
										<label style="font-size: 1rem;">Razón social</label>
										<input type="text" class="form-control" name="razon_social" id="razon_social">
									</div>
									<div class="form-group col-6">
										<label style="font-size: 1rem;">RFC</label>
										<input type="text" class="form-control" name="rfc" id="rfc">
									</div>
									<div class="form-group col-6">
										<label style="font-size: 1rem;">Correo electónico</label>
										<input type="text" class="form-control" name="email_factura" id="email_factura">
									</div>
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
															<div class="form-row">
																<div class="form-group col-12">
																	<label style="font-size: 1rem;">Indicaciones para facturar</label>
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
							</div> --}}
						<!--CONDICIONES DE CREDITO-->
						{{-- <div class="tab-pane" id="clienteconfiguracion" role="tabpanel">
								<div class="clienteswitch">
									<div class="form-group row">
										<label class="col-9 col-form-label">Días de crédito para facturado</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" value="1" onclick="dias_credito.disabled = !this.checked">
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
													<input type="checkbox" value="1" onclick="monto_maximo_credito.disabled = !this.checked">
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
													<input type="checkbox" value="1" onclick="nro_cta_cliente.disabled = !this.checked">
													<span></span>
												</label>
											</span>
										</div>
										<div class="col-9">
											<input class="form-control form-control-sm" type="text" name="nro_cta_cliente" id="nro_cta_cliente" disabled>
										</div>
									</div>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
				<div class="kt-portlet__foot p-2">
					<button type="button" class="btn btn-success btn btn-block" id="btnGuardarTOT">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>






























{{-- MODAL TOT viejo --}}



{{--
<div class="modal fade" id="modalTOT" role="dialog">
	<div class="modal-dialog modal-xl modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalTOT"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formTOT">
					@csrf
					<input type="hidden" name="gos_ot_id" id="gos_ot_id">
					<div class="form-group row">
						<div class="col-12">
							<div class="form-group">
								<label style="font-size: 1rem;">Nombre de la Empresa</label>
								<input class="form-control" type="text" name="nomb_ot" id="nomb_ot">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Teléfono</label>
								<div class="input-group mb-2 mr-sm-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<img src="/img/mexico-flag.png" alt="">
										</div>
									</div>
									<input type="text" class="form-control" name="telefono" id="telefono">
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Calle y número</label>
								<input type="text" class="form-control" name="direccion" id="direccion">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Colonia</label>
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_region_colonia_id" id="gos_region_colonia_id">
									@foreach($listaColonias as $colonia)
									<option value="{{$colonia->gos_region_colonia_id}}">{{$colonia->nomb_asentamiento}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Codigo Postal</label>
								<input class="form-control" type="text" name="cp" id="cp">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Estado</label>
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="estado" id="estado">
									@isset($listaEstados)
										@foreach($listaEstados as $estado)
										<option value="{{$estado->gos_region_estado_id}}">{{$estado->nomb_estado}}</option>
										@endforeach
									@endisset
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label style="font-size: 1rem;">Municipio</label>
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_region_municipio_id" id="gos_region_municipio_id">
								@isset($listaMunicipios)
									@foreach($listaMunicipios as $municipio)
									<option value="{{$municipio->c_municipio_id}}">{{$municipio->nomb_municipio}}</option>
									@endforeach
								@endisset
								</select>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-success btn btn-block" id="btnGuardarTOT">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div> --}}
