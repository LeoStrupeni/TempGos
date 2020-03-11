<div class="modal fade" id="ModalAseguradora" role="dialog">
	<div class="modal-dialog modal-m modal-m">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="TitleModalAseguradora">Editar <?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
	      	<form class="form-horizontal" id="aseguradoraForm">
				@include('Layout/errores')
	     		@csrf
				<input type="hidden" name="gos_aseguradora_id" id="gos_aseguradora_id">
				<input type="hidden" name="gos_fac_region_ciudad" id="gos_fac_region_ciudad">
				<div class="kt-portlet kt-portlet--tabs">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-toolbar">
							<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
								<li class="nav-item">
									<a class="linkModalAseg1 nav-link" data-toggle="tab" href="#AseguradoraDatos" role="tab"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></a>
								</li>
								<li class="nav-item">
									<a class="linkModalAseg2 nav-link" data-toggle="tab" href="#datosFacturacion" role="tab">Datos de facturación</a>
								</li>
								<li class="nav-item">
									<a class="linkModalAseg3 nav-link" data-toggle="tab" href="#AseguradoraConfiguracion" role="tab">Configuración</a>
								</li>
								<li class="nav-item">
									<a class="linkModalAseg4 nav-link" data-toggle="tab" href="#AseguradoraConfiguracionOS" role="tab">OS</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="tab-content">
							<!--DATOS DE LA ASEGURADORA-->
							<div class="linkModalAseg1 tab-pane active" id="AseguradoraDatos" role="tabpanel">
                				<div class="form-group row">
    								<div class="col-6">
    									<div class="form-group">
											<label>Empresa, compañía de seguros o persona fisica</label>
											<input type="text" class="form-control" name="empresa" id="empresa" required>
											<small style="font-style: italic;" class="empresa form-text text-danger"></small>
										</div>
    								</div>
    								<div class="col-6">
    									<div class="form-group">
											<label> <br> Contacto </label>
											<input type="text" class="form-control" name="contacto" id="contacto" required>
											<small  style="font-style: italic;" class="contacto form-text text-danger"></small>
    									</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label>Telefono fijo del enlace</label>
											<input class="form-control" type="text" name="telefono_fijo" id="telefono_fijo">
											<small  style="font-style: italic;" class="telefono_fijo form-text text-danger"></small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label>Celular del enlace</label>
											<input type="celular" class="form-control" name="celular" id="celular">
											<small  style="font-style: italic;" class="celular form-text text-danger"></small>
										</div>

									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Email del enlace</label>
											<input class="form-control" type="email" name="email_enlace" id="email_enlace">
										  	<small style="font-style: italic;" class="email_enlace form-text text-danger"></small>
										</div>
									</div>
								</div>
							</div>
						<!--DATOS DE FACTURACION-->
							<div class="linkModalAseg2 tab-pane" id="datosFacturacion" role="tabpanel">							
								<div class="form-group row">
									<label style="font-size: 1rem;" class="col-8 col-form-label">Habilitar facturación por cliente <i class="fas fa-info-circle"></i></label>
									<div class="col-2">
										<span class="kt-switch kt-switch--sm">
											<label>
												<input type="checkbox" name="habilita_facturacion_cliente" id="habilita_facturacion_cliente">
												<span></span>
											</label>
										</span>
									</div>
								</div>
								<div class="form-group row">
									<label style="font-size: 1rem;" class="col-8 col-form-label">Requiere autorización de valuación <i class="fas fa-info-circle"></i></label>
									<div class="col-2">
										<span class="kt-switch kt-switch--sm">
											<label>
												<input type="checkbox" name="requiere_autorizacion" id="requiere_autorizacion">
												<span></span>
											</label>
										</span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-6">
										<label>Persona Física o Moral</label>
										<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_fac_tipo_persona_id" id="gos_fac_tipo_persona_id" required>
											<option value="0" selected> </option>
										@if (isset($listaTipoPersonas))
											<option value="default">Seleccionar</option>
											@foreach ($listaTipoPersonas as $tipoPersona)
											<option value="{{$tipoPersona->gos_fac_tipo_persona_id}}"> {{$tipoPersona->tipo_persona}}</option>
											@endforeach
										@endif
										</select>
										 <small  style="font-style: italic;" class="gos_fac_tipo_persona_id form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Razón social</label>
										<input type="text" class="form-control" name="razon_social" id="razon_social">
											<small  style="font-style: italic;" class="razon_social form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>RFC</label>
										<input type="text" class="form-control" name="rfc" id="rfc">
											<small  style="font-style: italic;" class="rfc form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Correo electónico</label>
										<input type="text" class="form-control" name="email_factura" id="email_factura">
											<small  style="font-style: italic;" class="email_factura form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Calle</label>
										<input type="text" class="form-control" name="calle_nro_fac" id="calle_nro_fac">
										<small  style="font-style: italic;" class="calle_nro_fac form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Número exterior</label>
										<input type="text" class="form-control" name="nro_exterior_fac" id="nro_exterior_fac">
										<small  style="font-style: italic;" class="nro_exterior_fac form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Número interior</label>
										<input type="text" class="form-control" name="nro_interior_fac" id="nro_interior_fac">
										<small  style="font-style: italic;" class="nro_interior_fac form-text text-danger"></small>
									</div>
									<div class="form-group col-6">
										<label>Código Postal</label>
										<input type="text" class="form-control" name="cp_fac" id="cp_fac">
										<small  style="font-style: italic;" class="cp_fac form-text text-danger"></small>
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
										<input type="text" class="form-control" name="ase_fac_municipio" id="ase_fac_municipio">
										<small style="font-style: italic;" class="ase_fac_municipio form-text text-danger"></small>
									</div>
									<div class="col-6">
										<div class="form-group">
										<label>Colonia</label>
							
										<input type="text" class="form-control" name="ase_fac_localidad" id="ase_fac_localidad">

										<small style="font-style: italic;" class="ase_fac_localidad form-text text-danger"></small>
										</div>
									</div>
									<div class="form-group col-12">
										<label>Indicaciones para facturar</label>
										<textarea class="form-control" name="indicaciones" id="indicaciones" rows="8"></textarea>
									</div>
								</div>
							</div>
						<!--CONDICIONES DE CREDITO-->
							<div class="linkModalAseg3 tab-pane" id="AseguradoraConfiguracion" role="tabpanel">
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
										<small style="font-style: italic;" class="dias_credito form-text text-danger"></small>
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


							<div class="linkModalAseg4 tab-pane" id="AseguradoraConfiguracionOS" role="tabpanel">
								<div class="clienteswitch">
									<div class="form-group row">
										<label class="col-9 col-form-label">TOT</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="tot_os" id="tot_os" >
													<span></span>
												</label>
											</span>
										</div>
										<small style="font-style: italic;" class="dias_credito form-text text-danger"></small>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Póliza</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="poliza_os" id="poliza_os" >
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Siniestro</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="siniestro_os" id="siniestro_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
								
									<div class="form-group row">
										<label class="col-9 col-form-label">Reporte</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="reporte_os" id="reporte_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Orden</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="orden_os" id="orden_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Demérito</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="demerito_os" id="demerito_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Deducible</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="deducible_os" id="deducible_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Condiciones Especiales</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="condiciones_os" id="condiciones_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Ingreso Grúa</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="grua_os" id="grua_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-9 col-form-label">Habilitar Encuestas de Servicio</label>
										<div class="col-3">
											<span class="kt-switch kt-switch--sm kt-switch--icon">
												<label>
													<input type="checkbox" name="encuesta_os" id="encuesta_os">
													<span></span>
												</label>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__foot p-2">
					<button type="button" class="btn btn-success btn-block" id="btnGuardarAseguradora">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
