@extends( 'Layout' )
@section( 'Content' )

<!-- begin:: Content -->
<div class="kt-portlet kt-portlet--mobile">
	@if (session('notification'))
					<div class="alert alert-success">
					 {{session('notification')}}
					 </div> @endif

			 @if (count($errors)>0)
				 <div class="alert alert-danger">
					 <ul>
						 <?php foreach ($errors->all() as $error): ?>
							 <li>
								 {{ $error }}
							 </li>
						 <?php endforeach; ?>
					 </ul>
				 </div>

			@endif
	<div class="kt-portlet__head kt-portlet__head--lg row">
		<div class="kt-portlet__head-label col-12 col-lg-3">
            <img src="../img/logoqualitas.png" alt=""  style="width: 15rem;">
            <div></div>
			<h3 class="kt-portlet__head-title" style="margin-left: 10%;">Expedientes Asisgnados</h3>
		</div>
        <div class="col-4"></div>
		<div class="kt-portlet__head-toolbar  col-12 col-xl-4">
			<div class="kt-portlet__head-wrapper">
			  	<div class="kt-portlet__head-actions">
						 <form class="" action="/BandejaQualitas/getReporte" method="post">
							 @csrf
                    <div class="d-flex justify-content-end">
                        <div class="form-group pl-2">
                            <label for=""> Ejercicio:</label>
                            <input class="form-control" name="ejercicio" placeholder="año a 2 digitos" type="number" required>
                        </div>
                        <div class="form-group pl-2">
                            <label for=""> Reporte:</label>
                            <input class="form-control" name="Reporte" placeholder="Numero de Reporte 7 digitos" type="number" required>
                        </div>
                        <div class="form-group pl-2" style="align-self: flex-end;" >
                            <br>
                            <button class="btn btn-brand btn-elevate btn-icon-sm" type="submit">Buscar</button>
                        </div>
                    </div>
							</form>
			   	</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-0">

		<div class='container-fluid ' >
			<div class="container-fluid mt-2">
				<ul class="nav nav-tabs " id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="asignados-tab" data-toggle="tab" href="#asignados" role="tab" aria-controls="asignados" aria-selected="true">Asignados ({{$casignados}})</a>
				  </li>
					<li class="nav-item">
					 <a class="nav-link" id="transito-tab" data-toggle="tab" href="#transito" role="tab" aria-controls="transito" aria-selected="false">Transito ({{$Ctransito}})</a>
				 </li>
				  <li class="nav-item">
				    <a class="nav-link" id="piso-tab" data-toggle="tab" href="#piso" role="tab" aria-controls="piso" aria-selected="false">Piso ({{$Cpiso}})</a>
				  </li>
					<li class="nav-item">
					 <a class="nav-link" id="terminadas-tab" data-toggle="tab" href="#terminadas" role="tab" aria-controls="terminadas" aria-selected="false">Terminadas ({{$Cterm}})</a>
				 </li>
				 <li class="nav-item">
					 <a class="nav-link" id="entregadas-tab" data-toggle="tab" href="#entregadas" role="tab" aria-controls="entregadas" aria-selected="false">Entregadas ({{$Centregadas}})</a>
				 </li>
				 <li class="nav-item">
					 <a class="nav-link" id="facturadas-tab" data-toggle="tab" href="#facturadas" role="tab" aria-controls="facturadas" aria-selected="false">Facturadas ({{$CFactu}})</a>
				 </li>
				 <li class="nav-item">
					 <a class="nav-link" id="perdidapago-tab" data-toggle="tab" href="#perdidapago" role="tab" aria-controls="perdidapago" aria-selected="false">Perdida Total y Pago De Daños ({{$Cperpago}})</a>
				 </li>
				  <li class="nav-item">
 					 <a class="nav-link" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">Historico </a>
 				 </li>

				</ul>
			</div>
			<div class="container-fluid">
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="asignados" role="tabpanel" aria-labelledby="home-tab">
																		<div class="table-responsive table-sm p-1" >
												                <table class="table table-sm table-hover"  id="table" style="font-size: 1rem;">
												                    <thead class="thead-light">
												                        <tr style="font-weight: 500;">
												                            <th style="text-align: center;">#exp</th>
												                            <th style="text-align: center;">Asignacion</th>
												                            <th style="text-align: center;">Reporten</th>
												                            <th style="text-align: center;">Siniestro</th>
												                            <th style="text-align: center;">Marca Tipo</th>
												                            <th style="text-align: center;">Modelo</th>
												                            <th style="text-align: center;">Placas</th>
												                            <th style="text-align: center;">Estatus</th>
												                            <th style="text-align: center;">Codigo Taller</th>
												                            <th style="text-align: center;">Acciones</th>
												                            <th style="text-align: center; display:none;"></th>
												                    </thead>
												                    <tbody>
												                        <?php foreach ($wsreportes as $reporte): ?>
																									<?php if ($reporte->estatus==0): ?>
												                            <tr>
													                            <td style="vertical-align: middle;text-align: center;">{{$reporte->expediente_id}}</td>
													                            <td style="vertical-align: middle;text-align: center;">{{$reporte->created_at}}</td>
													                            <td style="vertical-align: middle;text-align: center;">{{$reporte->num_reporte}}</td>
													                            <td style="vertical-align: middle;text-align: center;">{{$reporte->num_siniestro}}</td>
													                            <td style="vertical-align: middle;text-align: center;">{{$reporte->marca}}-{{$reporte->tipo}}</td>
													                            <td style="vertical-align: middle;text-align: center;" id="modelo{{$reporte->id}}">{{$reporte->modelo}}</td>
													                            <td style="vertical-align: middle;text-align: center;" id="placa{{$reporte->id}}">{{$reporte->placa}}</td>
												                              <td style="vertical-align: middle;text-align: center;">Asignado</td>
												                              <td style="vertical-align: middle;text-align: center;">{{$reporte->clavetaller}}</td>
													                            <td style="width: 5%; text-align: center;"> <?php if ($reporte->estatus==0): ?>
												                                    <a  data-toggle="popover" data-trigger='hover'
												                                        data-placement="top" data-content="Adjudicar" onclick="Adjudicarexpediente({{$reporte->id}})"><i class="fas fa-arrow-alt-circle-up" style="font-size: 1.7rem;"></i></a>  <?php else: ?>
												                                    <a href="/orden-servicio-generada/{{$reporte->gos_os_id}}" data-toggle="popover" data-trigger='hover'
												                                        data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
												                                    <a href="/Presupuestos/Qualitas/{{$reporte->gos_os_id}}" data-toggle="popover" data-trigger='hover'
												                                        data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
												                                        <?php endif; ?>
												                                </td>
												                                <td style="display: none;" id="serie{{$reporte->id}}">{{$reporte->serie}}</td>
													                        </tr>
																											<?php endif; ?>
												                        <?php endforeach; ?>
												                    </tbody>
												                </table>
												            </div>
					</div>
					<div class="tab-pane fade" id="transito" role="tabpanel" aria-labelledby="transito-tab">
														<div class="table-responsive table-sm p-1" >
																<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
																		<thead class="thead-light">
																				<tr style="font-weight: 500;">
																						<th style="text-align: center;">#numero</th>
																						<th style="text-align: center;">Inicio</th>
																						<th style="text-align: center;">Reporte</th>
																						<th style="text-align: center;">Siniestro</th>
																						<th style="text-align: center;">vehiculo</th>
																						<th style="text-align: center;">Placas</th>
																						<th style="text-align: center;">serie</th>
																						<th style="text-align: center;">Estatus</th>
																						<th style="text-align: center;">Acciones</th>

																		</thead>
																		<tbody>
																				<?php foreach ($os as $orden): ?>
																					<?php if ($orden->gos_os_estado_exp_id==2 && $orden->fecha_terminado==null ) : ?>
																						<tr>
																							<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
                              								  <td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																								<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																								<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																								<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																								<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																								<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																									<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																								<td style="vertical-align: middle;text-align: center;">Transito</td>
																								<td style="vertical-align: middle;text-align: center;">
																						    <a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																								data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																						    <a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																								data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																							</td>
																					  </tr>
																							<?php endif; ?>
																				<?php endforeach; ?>
																		</tbody>
																</table>
														</div>

					</div>
				  <div class="tab-pane fade" id="piso" role="tabpanel" aria-labelledby="piso-tab">
													<div class="table-responsive table-sm p-1" >
															<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
																	<thead class="thead-light">
																			<tr style="font-weight: 500;">
																					<th style="text-align: center;">#numero</th>
																					<th style="text-align: center;">Inicio</th>
																					<th style="text-align: center;">Reporte</th>
																					<th style="text-align: center;">Siniestro</th>
																					<th style="text-align: center;">vehiculo</th>
																					<th style="text-align: center;">Placas</th>
																					<th style="text-align: center;">serie</th>
																					<th style="text-align: center;">Estatus</th>
																					<th style="text-align: center;">Acciones</th>

																	</thead>
																	<tbody>
																			<?php foreach ($os as $orden): ?>
																				<?php if ($orden->gos_os_estado_exp_id==1 && $orden->fecha_terminado==null ): ?>
																					<tr>
																						<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																							<td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																							<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																							<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																							<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																							<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																							<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																								<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																							<td style="vertical-align: middle;text-align: center;">Piso</td>
																							<td style="vertical-align: middle;text-align: center;">
																							<a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																							data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																							<a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																							data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																						</td>
																					</tr>
																						<?php endif; ?>
																			<?php endforeach; ?>
																	</tbody>
															</table>
													</div>
						</div>
					<div class="tab-pane fade" id="terminadas" role="tabpanel" aria-labelledby="terminadas-tab">
										<div class="table-responsive table-sm p-1" >
												 <table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
														 <thead class="thead-light">
																 <tr style="font-weight: 500;">
																		 <th style="text-align: center;">#numero</th>
																		 <th style="text-align: center;">Inicio</th>
																		 <th style="text-align: center;">Reporte</th>
																		 <th style="text-align: center;">Siniestro</th>
																		 <th style="text-align: center;">vehiculo</th>
																		 <th style="text-align: center;">Placas</th>
																		 <th style="text-align: center;">serie</th>
																		 <th style="text-align: center;">Estatus</th>
																		 <th style="text-align: center;">Acciones</th>

														 </thead>
														 <tbody>
																 <?php foreach ($os as $orden): ?>
																	 <?php if ($orden->fecha_terminado!=null &&  $orden->fecha_entregado==null  ): ?>
																		 <tr>
																			 <?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																				 <td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																				 <td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																				 <td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																				 <td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																				 <td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																				 <td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																					 <td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																				 <td style="vertical-align: middle;text-align: center;">Piso</td>
																				 <td style="vertical-align: middle;text-align: center;">
																				 <a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				 data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																				 <a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				 data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																			 </td>
																		 </tr>
																			 <?php endif; ?>
																 <?php endforeach; ?>
														 </tbody>
												 </table>
										 </div>

					</div>
					<div class="tab-pane fade" id="entregadas" role="tabpanel" aria-labelledby="entregadas-tab">
										<div class="table-responsive table-sm p-1" >
												<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
														<thead class="thead-light">
																<tr style="font-weight: 500;">
																		<th style="text-align: center;">#numero</th>
																		<th style="text-align: center;">Inicio</th>
																		<th style="text-align: center;">Reporte</th>
																		<th style="text-align: center;">Siniestro</th>
																		<th style="text-align: center;">vehiculo</th>
																		<th style="text-align: center;">Placas</th>
																		<th style="text-align: center;">serie</th>
																		<th style="text-align: center;">Estatus</th>
																		<th style="text-align: center;">Acciones</th>

														</thead>
														<tbody>
																<?php foreach ($os as $orden): ?>
																	<?php if ($orden->fecha_entregado!=null &&  $orden->fecha_facturado==null): ?>
																		<tr>
																			<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																				<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																				<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																					<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																				<td style="vertical-align: middle;text-align: center;">Piso</td>
																				<td style="vertical-align: middle;text-align: center;">
																				<a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																				<a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																			</td>
																		</tr>
																			<?php endif; ?>
																<?php endforeach; ?>
														</tbody>
												</table>
										</div>
					 </div>
					<div class="tab-pane fade" id="facturadas" role="tabpanel" aria-labelledby="facturadas-tab">
										<div class="table-responsive table-sm p-1" >
												<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
														<thead class="thead-light">
																<tr style="font-weight: 500;">
																		<th style="text-align: center;">#numero</th>
																		<th style="text-align: center;">Inicio</th>
																		<th style="text-align: center;">Reporte</th>
																		<th style="text-align: center;">Siniestro</th>
																		<th style="text-align: center;">vehiculo</th>
																		<th style="text-align: center;">Placas</th>
																		<th style="text-align: center;">serie</th>
																		<th style="text-align: center;">Estatus</th>
																		<th style="text-align: center;">Acciones</th>

														</thead>
														<tbody>
																<?php foreach ($os as $orden): ?>
																	<?php if ( $orden->fecha_facturado!=null): ?>
																		<tr>
																			<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																				<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																				<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																				<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																					<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																				<td style="vertical-align: middle;text-align: center;">Piso</td>
																				<td style="vertical-align: middle;text-align: center;">
																				<a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																				<a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																				data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																			</td>
																		</tr>
																			<?php endif; ?>
																<?php endforeach; ?>
														</tbody>
												</table>
										</div>
					 </div>
					<div class="tab-pane fade" id="perdidapago" role="tabpanel" aria-labelledby="perdidapago-tab">
						<div class="table-responsive table-sm p-1" >
								<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
										<thead class="thead-light">
												<tr style="font-weight: 500;">
														<th style="text-align: center;">#numero</th>
														<th style="text-align: center;">Inicio</th>
														<th style="text-align: center;">Reporte</th>
														<th style="text-align: center;">Siniestro</th>
														<th style="text-align: center;">vehiculo</th>
														<th style="text-align: center;">Placas</th>
														<th style="text-align: center;">serie</th>
														<th style="text-align: center;">Estatus</th>
														<th style="text-align: center;">Acciones</th>

										</thead>
										<tbody>
												<?php foreach ($os as $orden): ?>
													<?php if ($orden->gos_os_tipo_o==4 || $orden->gos_os_tipo_o==5 ): ?>
														<?php if ($orden->fecha_terminado==null): ?>
																	<tr>
																		<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																			<td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																			<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																			<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																			<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																			<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																			<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																				<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																			<td style="vertical-align: middle;text-align: center;">Piso</td>
																			<td style="vertical-align: middle;text-align: center;">
																			<a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																			data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																			<a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																			data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																		</td>
																	</tr>
														    <?php endif; ?>
															<?php endif; ?>
												<?php endforeach; ?>
										</tbody>
								</table>
						</div>
					</div>
					<div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
								<div class="table-responsive table-sm p-1" >
										<table class="table table-sm table-hover datatablaList"  id="table" style="font-size: 1rem;">
												<thead class="thead-light">
														<tr style="font-weight: 500;">
																<th style="text-align: center;">#numero</th>
																<th style="text-align: center;">Inicio</th>
																<th style="text-align: center;">Reporte</th>
																<th style="text-align: center;">Siniestro</th>
																<th style="text-align: center;">vehiculo</th>
																<th style="text-align: center;">Placas</th>
																<th style="text-align: center;">serie</th>
																<th style="text-align: center;">Estatus</th>
																<th style="text-align: center;">Acciones</th>
												</thead>
												<tbody>
														<?php foreach ($os as $orden): ?>
															<?php if ( $orden->fecha_historico!=null ) : ?>
																<tr>
																	<?php $detvehi=explode("|",$orden->detallesVehiculo) ?>
																		<td style="vertical-align: middle;text-align: center;">{{$orden->nro_orden_interno}}</td>
																		<td style="vertical-align: middle;text-align: center;">{{$orden->fecha_creacion_os}}</td>
																		<td style="vertical-align: middle;text-align: center;">{{$orden->nro_reporte}}</td>
																		<td style="vertical-align: middle;text-align: center;">{{$orden->nro_siniestro}}</td>
																		<td  style="vertical-align: middle;text-align: center;">{{$detvehi[1]}}</td>
																		<td  style="vertical-align: middle;text-align: center;">{{$detvehi[2]}}</td>
																			<td  style="vertical-align: middle;text-align: center;">{{$detvehi[4]}}</td>
																		<td style="vertical-align: middle;text-align: center;">Transito</td>
																		<td style="vertical-align: middle;text-align: center;">
																		<a href="/orden-servicio-generada/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																		data-placement="top" data-content="Ver Orden" target="_blank"><i class="fas fa-arrow-alt-circle-right" style="font-size: 1.7rem;"></i></a>
																		<a href="/Presupuestos/Qualitas/{{$orden->gos_os_id}}" data-toggle="popover" data-trigger='hover'
																		data-placement="top" data-content="Ver Presupuesto" target="_blank"><i class="fas fa-file-signature" style="font-size: 1.7rem;"></i></a>
																	</td>
																</tr>
																	<?php endif; ?>
														<?php endforeach; ?>
												</tbody>
										</table>
								</div>
					</div>

				</div>
			</div>


		</div>


</div>
<!-------------------------------------------------------------------------------------------------MODALES----------------------------------------------------------------->


<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="adjudicar-orden">
		<div class="modal-dialog ">
				<div class="modal-content">
						<div class="modal-header">
								<h5 class="modal-title">Adjudicar Órden</h5>
						</div>
								<div class="modal-body">
										<form id="" action="/AsignadasQualitas/Agregar" method="post">
												@csrf
												<input type="hidden" name="wereportid" id="wsreporteid">
																<div class="tab-content">
																		 <!--DATOS DEL CLIENTE-->
																		<div class=" tab-pane active " id="adjudicarDatos" role="tabpanel">
																				<h5 class="mb-4">Datos Contratante</h5>
																				<div style="border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%;" class="form-row">
																						<div class="form-group col-6">
																								<label>Nombre(s)</label>
																								<input type="text" class="form-control" name="nombre-contratante" id="nombre-contratante" required>
																								<small style="font-style: italic;" class="nombre form-text text-danger"></small>
																						</div>
																						<div class="form-group col-6">
																								<label>Apellidos</label>
																								<input type="text" class="form-control" name="apellidos-contratante" id="apellidos-contratante" required>
																								<small style="font-style: italic;" class="apellidos form-text text-danger"></small>
																						</div>
																						<div class="form-group col-4">
																								<label>Pasar datos de contratante a cliente</label>
																						</div>
																						<div class="form-group col-6">
																								<span class="kt-switch kt-switch--sm kt-switch--icon">
																										<label>
																												<input type="checkbox"  value="0" id="pasar-datos-check" onclick="cambiocheck()">
																												<span></span>
																										</label>
																								</span>
																				 </div>
																				</div>
																				<h5 class="mb-4 mt-3">Datos Cliente</h5>
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
																				</div>
																				<div class="form-row">
																						<div class="form-group col-6">
																								<label>Celular</label>
																								<div class="input-group">
																										<div class="input-group-prepend">
																												<span class="input-group-text"> <img src="/img/mexico-flag.png" alt=""></span>
																										</div>
																										<input type="text" class="form-control" name="celular" id="celular" required>
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
																										<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_marca_id" id="gos_vehiculo_marca_id" required>
																											<option value=""></option>
																												<?php foreach ($listaMarcas as $marca): ?>
																													 <option value="{{$marca->gos_vehiculo_marca_id}}" >{{$marca->marca_vehiculo}}</option>
																												<?php endforeach; ?>
																										</select>
																								</div>
																								<small style="font-style: italic;" class="gos_vehiculo_marca_id form-text text-danger"></small>
																						</div>
																						<div class="form-group col-6">
																								<label style="font-size: 1rem;">Modelo</label>
																								<div class="input-group">
																										<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_modelo_id" id="gos_vehiculo_modelo_id" required>
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
																<div class="kt-portlet__foot p-2">
																	<button type="submit" class="btn btn-success btn-block" id="btn-guardar-cliente">Guardar</button>
														</div>
										</form>
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
				</div>
		</div>
</div>


@endsection

@section('ScriptporPagina')
<script>$(function(){$('[data-toggle="popover"]').popover()}); </script>

<script src="{{env('APP_URL')}}/gos/ajax-bandejaqualitas.js"></script>
@endsection
