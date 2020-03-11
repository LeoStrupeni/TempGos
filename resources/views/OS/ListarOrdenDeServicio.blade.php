@include('Layout/head')

<!-- begin::Body -->
<body
	class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">
	<!-- begin:: Page -->

	@include('Layout/headerMobile')

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div
			class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			@include('Layout/aside')

			<div
				class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"
				id="kt_wrapper">

				<!-- begin:: Header -->
				@include('Layout/header')
				<!-- end:: Header -->

				<div
					class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor py-2"
					id="kt_content">
					<!-- begin:: Content -->
					<div
						class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid px-2">

<!-- begin:: Content -->
<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
<link rel="stylesheet" href="../gos/css/menu_vertical.css">
<link rel="stylesheet" href="../gos/css/circulo_vehiculo.css">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">{{$name ?? 'Órdenes'}}</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<?php

					$auth = Session::get('Ordenes');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<a href="{{ url('ordenes-serv/Agregar')}}"><button class="btn btn-brand btn-elevate btn-icon-sm" type="button" id="crear-nueva-os">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button></a>
					<?php endif ?>

				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-0">
		<div class="d-flex justify-content-between">
		<div class='container-fluid'>
				<div class ='row'>
					<div class='col col-sm-2'>
					{{--{{$os->nombre}}--}}
							<div class="vertical-menu">
								<a1 href="" class="active">Carpetas  </a1>
								<a class="{{$activePro ?? ''}}" href="/ordenes-serv/Proceso">En Proceso<span class="badge badge-light">{{$cuentaProces ??''}}</a>
								<a class="{{$activeTer ?? ''}}" href="/ordenes-serv/Teminadas">Terminadas<span class="badge badge-light">{{$cuentaTerminadas ??''}}</a>
								<a class="{{$activeEnt ?? ''}}" href="/ordenes-serv/Entregadas">Entregadas<span class="badge badge-light">{{$cuentaEntregadas ??''}}</span></a>
								<a class="{{$activeHis ?? ''}}" href="/ordenes-serv/historico">Histórico<span class="badge badge-light">{{$cuentahistorico}}</a>
								<a class="{{$activeCan ?? ''}}" href="/ordenes-serv/canceladas">Canceladas<span class="badge badge-light">{{$cuentaCanceladas ??''}}</span></a>

							</div>
					</div>
					<div class='col col-sm-10'>

						<input type="hidden" id="app_url" name="app_url" url=".."/>
						<div class="table-responsive table-sm p-1" >
							<table class="table table-sm table-hover  nowrap" id="dt-ordenes-servicios" style="font-size: 1rem;">
								<thead class="thead-light">
									<tr style="font-weight: 500;">
										<th style="display:none">ID</th>
										<th>Orden</th>
										<th>Fecha</th>
										<th>Días</th>
										<th>Cliente</th>
										<th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
										<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
										<th>Tiempo a fecha promesa</th>
										<th>Asesor</th>
										<th>Total</th>
										<th>Avance</th>
										<th style="width: 3%;"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($os as  $o)
										<tr>
											<!--ID  -->
											<td style="display:none">{{$o->gos_os_id}}</td>
											<!--Orden  -->
											<td style="text-align:center;vertical-align: middle;">
												<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
												<?php if (isset($splited[2]) == true ): ?>
													<?php if ($splited[2] == "canceladas"): ?>
														<?php if ($o->fecha_cancelado != NULL ): ?>
															<a><i class="fas fa-ban text-warning" style="font-size: large;"></i> #{{$o->nro_orden_interno}}</a>
														<?php endif; ?>
													<?php elseif($splited[2] == "historico"): ?>
														<?php if ($o->fecha_historico != NULL && $o->fecha_facturado==null ): ?>
															<a href='/orden-servicio-generada/{{$o->gos_os_id}}'><i class="fas fa-ban text-warning" style="font-size: large;" ></i> #{{$o->nro_orden_interno}}</a>
														<?php else: ?>	
															<a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
														<?php endif; ?>
													<?php else: ?>
													<a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
													<?php endif; ?>
												<?php else: ?>
													<a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
												<?php endif; ?>
											</td>
											<!--fechas  -->
											<td style="vertical-align: middle;">
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Apertura de la orden">
													<i class="fas fa-circle" style="color: #339af0;"></i>
													{{$o->fecha_creacion_os}}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Ingreso a reparacion">
													<i class="fas fa-caret-square-right" style="color: green;"></i>
													{{($o->fecha_ingreso_v_os == 0) ? 'Fecha reparacion':$o->fecha_ingreso_v_os }}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha promesa">
													<i class="fas fa-square" style="color: yellow;"></i> {{
													($o->fecha_promesa_os == 0) ? 'Fecha promesa':$o->fecha_promesa_os }}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha terminado">
													<i class="fas fa-circle" style="color: #339af0;"></i> {{
													$o->fecha_terminado ?? 'Fecha terminado' }}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha entregado">
													<i class="fas fa-caret-square-left" style="color: red;"></i> {{
													$o->fecha_entregado ?? 'Fecha entregado' }}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha facturado">
													<i class="fas fa-circle" style="color: #339af0;"></i> {{
													$o->fecha_facturado ?? 'Fecha facturado' }}
												</p>
												<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha de pago">
													<i class="fas fa-circle" style="color: #339af0;"></i> {{
													$o->fecha_pago ?? 'Fecha pago' }}
												</p>
											</td>
											<!--Dias  -->
											<td style="text-align:center;vertical-align: middle;"> {{$o->dias}} </td>
											<!--cliente  -->
											<?php $cl=explode("|", $o->nomb_cliente);?>
								      		<td style="vertical-align: middle;"> {{$cl[0]}} <br>{{$cl[1]}} <br>{{$cl[2]}}</td>
											<!--Aseguradora  -->
											<?php $asg=explode("|", $o->nomb_aseguradora); $asglength=count($asg); ?>
											<td style="vertical-align: middle;">
												<strong style="color: #27395C; font-weight: 500;">{{$asg[0]??''}}</strong>
												<br>{{$asg[1] ??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[2]??''}}</strong>
												<br>{{$asg[3]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[4]??''}}</strong>
												<br>{{$asg[5]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[6]??''}}</strong>
												<br>{{$asg[7]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[8]??''}}</strong>
												<br>{{$asg[9]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[10]??''}}</strong>
												<br>{{$asg[11]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[12]??''}}</strong>
												<br>{{$asg[13]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[14]??''}}</strong>
												<br>{{$asg[15]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[16]??''}}</strong>
												<br>{{$asg[17]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[18]??''}}</strong>
												<br>{{$asg[19]??''}}<strong style="color:#27395C; font-weight: 500;">{{$asg[20]??''}}</strong>
											</td>
											<!--vehiculo  -->
											<?php $vhc=explode("|", $o->detallesVehiculo);?>
											<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} <br>
												<div class="Ordenesligadas" id="OSLigada_{{$o->gos_os_id}}">
													OL:
													<?php foreach($osLigadas as $osl):?>
														<?php if($osl->gos_os_id == $o->gos_os_id):?>
															<a href='/orden-servicio-generada/<?=$osl->gos_os_id_relacion?>'> # <?=$osl->nro_orden_interno?> &nbsp</a>
														<?php endif;?>
													<?php endforeach;?>
												</div>
											</td>
											<!--tiempo  -->

											@if ($o->EstadoFechaPromesa == 'Sin Fecha')
												<td style="vertical-align: middle;">Sin Fecha</td>
											@elseif($o->EstadoFechaPromesa == 'Rojo')
												<td style="vertical-align: middle;"><i class="fas fa-circle" style="color:red;"></i> Etapa</td>
											@elseif($o->EstadoFechaPromesa == 'Amarillo')
												<td style="vertical-align: middle;"><i class="fas fa-circle" style="color:yellow;"></i> Etapa</td>	
											@else
												<td style="vertical-align: middle;"><i class="fas fa-circle" style="color:green;"></i> Etapa</td>
											@endif

											<!--Asesor  -->
											<td style="text-align:center;vertical-align: middle;">{{$o->asesor}}</td>
											<!--Total  -->
											<td style="text-align:center;vertical-align: middle;">
												<?php $tots= $o->tots;  $numberAsString = number_format($tots, 1);?>
												{{$numberAsString}}
											</td>
											<!--Avance  -->
											<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
											<?php if ($splited[1]== "ordenes-servicio"): ?>
												<?php if ($e== null): ?>
													<td style="vertical-align: middle;">
													<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div></div>
													</td>
													<?php elseif($e== 100.0000): ?>
													<td style="vertical-align: middle;">
													<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Finalizada</div></div>
													</td>
													<?php else: ?>
													<td style="vertical-align: middle;">
													<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: {{$e}}%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$e}}%</div></div>
													</td>
												<?php endif; ?>

												<?php else: ?>
												<?php if ($splited[2] == "Teminadas"): ?>
													<td style="vertical-align: middle;">

														<?php if ($o->encuesta_os==1): ?>
															<?php if ($o->gos_encuesta_id!=null): ?>
															<div class="form-group"><a id="encuesta-cliente" href="/Orden-terminada/{{$id}}/Encuesta" class="btn btn-warning btn-elevate btn-icon-sm" data-id="{{$id}}">Encuesta</a></div>
															<?php else: ?>
																<div class="form-group"><div class="form-group"><a id="entregar" style="color:white;" class="btn btn-brand btn-elevate btn-icon-sm" data-id="{{$id}}">Entregar</a></div>
															<?php endif; ?>
														<?php else: ?>
															<div class="form-group"><div class="form-group"><a id="entregar" style="color:white;" class="btn btn-brand btn-elevate btn-icon-sm" data-id="{{$id}}">Entregar</a></div>
														<?php endif; ?>
														
													</td>
													<?php elseif($splited[2] == "Entregadas"): ?>
													<td style="vertical-align: middle;">
														<div class="d-flex justify-content-center"><span class="dropdown">
														<button href="javascript:void(0);"type="button" value="Hola" class="btn btn-secondary btn-icon"
															data-toggle="dropdown" aria-expanded="true"> <i class="fas fa-list"></i>
														</button>
														<div class="dropdown-menu dropdown-menu-right">
														<?php $id=$o->gos_os_id; $idtaller=Session::get('taller_id');
															$asegfac = DB::select( DB::raw('SELECT *  FROM  gos_os go
															LEFT JOIN gos_ase_fac gaf ON go.gos_aseguradora_id = gaf.relacion_id
															WHERE  gos_taller_id='.$idtaller.' AND gos_os_id='.$id.' AND fecha_terminado IS NOT NULL AND fecha_entregado IS NOT NULL'));
															$clientefac = DB::select( DB::raw('SELECT *  FROM  gos_os go
															LEFT JOIN gos_cliente_factura gcf ON go.gos_cliente_id = gcf.relacion_id
															WHERE  gos_taller_id='.$idtaller.' AND gos_os_id='.$id.' AND fecha_terminado IS NOT NULL AND fecha_entregado IS NOT NULL'));
															$idcli=$o->gos_cliente_id;
															$idaseg=$o->gos_aseguradora_id;
															
														?>
														
															<a  
															<?php if ($asegfac[0]->habilita_facturacion_cliente==0): ?>

																<?php if ($asegfac[0]->rfc!=null): ?>
																	href="/gestion-factura/nuevaFactura/{{$id}}" 
																	<?php else: ?>
																	href="/editar-aseguradora/{{$idaseg}}/{{$id}}"
																<?php endif; ?> 
															<?php else: ?> 
																<?php if ($clientefac[0]->rfc!=null): ?>
																	href="/gestion-factura/nuevaFactura/{{$id}}" 
																	<?php else: ?>
																	href="/editar-cliente/{{$idcli}}/{{$id}}"
																<?php endif; ?> 

															<?php endif; ?>  
															class="dropdown-item ">
																<i class="la la-newspaper-o"></i> Factura
															</a>
															<a href="gestion-factura/nuevaRemision/{{$id}}" class="dropdown-item">
																<i class="la la-sticky-note-o"></i> Nota de remisión
															</a></div></span></div>
													</td>
													<?php elseif($splited[2] == "historico"): ?>
													<td style="vertical-align: middle;">
														<div class="d-flex justify-content-center">
															<?php $id=$o->gos_os_id; $idtaller=Session::get('taller_id');
															
																$pdffacnota = DB::select( DB::raw('SELECT * FROM  gos_os AS go
																LEFT JOIN (SELECT gos_nota_remision_id, gos_os_id as osidnota FROM gos_nota_remision  ) as gnr ON  gnr.osidnota = go.gos_os_id	
																LEFT JOIN (SELECT gos_docventa_id, gos_os_id as osidfac FROM gos_docventa  ) as gd ON  gd.osidfac = go.gos_os_id
																WHERE  gos_taller_id='.$idtaller.' AND gos_os_id='.$id.' AND (fecha_facturado IS NOT NULL OR fecha_historico IS NOT NULL OR fecha_cancelado IS NOT NULL ) 
																GROUP BY go.gos_os_id'));
																$notaID=$pdffacnota[0]->gos_nota_remision_id;
																$facID=$pdffacnota[0]->gos_docventa_id;
															?>
															<?php if ($notaID!=null): ?>
															<a  href="/gestion-factura/pdf/NotaRemision/{{$notaID}}"  target="_blank" data-toggle="popover" data-trigger='hover'
																data-placement="top" data-content="Nota de Remisón: #{{$notaID}}">
																<button  type="button" value="" class="btn btn-primary btn-icon"
																	aria-expanded="true"> <i class="fas fa-file-pdf"></i> 
																	
																	
																	<!-- nota de remision -->
																</button>
															</a>
															<?php elseif ($facID!=null): ?>
																<a  href="/gestion-factura/pdf/Factura/{{$facID}}" target="_blank" data-toggle="popover" data-trigger='hover'
																data-placement="top" data-content="Nota de Remisón: #{{$facID}}">
																<button type="button" value="" class="btn btn-primary btn-icon"
																	aria-expanded="true"> <i class="fas fa-file-pdf "></i>
																	
																	<!-- factura -->
																</button>
															</a>
															<?php else: ?>
																<i class="fas fa-times fa-2x text-danger"></i>
															<?php endif; ?>
															
														</div>

													</td>
													<?php else: ?>
														<?php if ($e== null): ?>
															<td style="vertical-align: middle;">
															<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div></div>
															</td>
															<?php elseif($o->fecha_terminado!==null && $o->fecha_entregado==null): ?>
															<td style="vertical-align: middle;">
															<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Terminada</div></div>
															</td>
															<?php elseif($o->fecha_entregado!==null && $o->fecha_terminado!==null): ?>
															<td style="vertical-align: middle;">
															<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Entregada</div></div>
															</td>
															<?php elseif($e== 100.0000): ?>
															<td style="vertical-align: middle;">
															<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Finalizada</div></div>
															</td>
															<?php else: ?>
															<td style="vertical-align: middle;">
															<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: {{$e}}%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$e}}%</div></div>
															</td>
														<?php endif; ?>

												<?php endif; ?>

											<?php endif; ?>

											<!--Opciones -->
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
												  <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
													<i class="la la-ellipsis-h"></i>
												  </a>
												  <div class="dropdown-menu dropdown-menu-right">
													<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
													<?php if ($splited[1]== "ordenes-servicio"): ?>
											  
														<a href="javascript:void(0);" id="btnFechaIngreso"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-ingreso" class="delete dropdown-item">
														  <i class="la la-calendar "></i> Ingreso Reparación
														</a>
														<a href="javascript:void(0);" id="btnFechaPromesa"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-promesa" class="delete dropdown-item">
														  <i class="la la-calendar "></i> Fecha Promesa
														</a>
											  
														<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS">
														  <i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
														</a>
													<?php else: ?>
														<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
														<?php if ($splited[2] == "Teminadas"): ?>
															<?php $id= $o->gos_os_id;
															$auth = Session::get('Ordenes');
															if($auth == null){$auth=0;}
															else {$auth = $auth[0]->eliminar;}
															if ($auth): ?>
															<a href="/ordenes-serv/{{ $id }}/editar"
															{{-- href="javascript:void(0);"  --}}
															data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Editar" class="dropdown-item btnEditarOS">
																<i class="la la-edit"></i> Editar
															</a>
															<?php endif ?>
															<a href="/osg/{{ $id }}/terminadas-a-proceso" id="btnBorrarFecha"  data-id="{{ $id }}"  class="delete dropdown-item">
															<i class="fas fa-undo-alt"></i> Restaurar orden de servicio
															</a>
															<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS">
															<i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
															</a>
															<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
																<i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
															</a>
														<?php elseif($splited[2] == "Entregadas"): ?>
															<?php $id= $o->gos_os_id;
															$auth = Session::get('Ordenes');
															if($auth == null){$auth=0;}
															else {$auth = $auth[0]->eliminar;}
															if ($auth): ?>
															<a href="/ordenes-serv/{{ $id }}/editar"
															{{-- href="javascript:void(0);"  --}}
															data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Editar" class="dropdown-item btnEditarOS">
															<i class="la la-edit"></i> Editar
															</a>
															<?php endif ?>
															<a href="javascript:void(0);" id="btnFechaIngreso"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-ingreso" class="delete dropdown-item" style="display: none">
															<i class="la la-calendar "></i> Ingreso Reparación
															</a>
															<a href="javascript:void(0);" id="btnFechaPromesa"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-promesa" class="delete dropdown-item" style="display: none">
															<i class="la la-calendar "></i> Fecha Promesa
															</a>
															<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS">
															<i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
															</a>
															<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
																<i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
															</a>
														<?php elseif($splited[2] == "historico"): ?>
															{{-- <a href="javascript:void(0);" id="btncancelarOS" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete dropdown-item">
																<i class="fas fa-ban"></i> Cancelar
															</a> --}}
															<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS" style="display: none">
															<i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
															</a>
												
															<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
															<i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
															</a>
														<?php elseif($splited[2] == "canceladas"): ?>
															<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS" style="display: none">
															<i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
															</a>
															<?php
															$auth = Session::get('Ordenes');
															if($auth == null)
															{
															$auth=0;
															}
															else {
															$auth = $auth[0]->eliminar;
															}
															if ($auth): ?>
																<a href="javascript:void(0);" id="btnregresarcancelada"  data-id="{{ $id }}"  class="delete dropdown-item">
																	<i class="fas fa-undo-alt"></i> Restaurar orden cancelada
																</a>
																<a href="javascript:void(0);" id="btnmandarHisOs"  data-id="{{ $id }}"  class="delete dropdown-item">
																	<i class="flaticon-folder-1"></i> Mandar a historico
																</a>
															<?php endif; ?>
														<?php else: ?>
															<?php $id= $o->gos_os_id;
															$auth = Session::get('Ordenes');
															if($auth == null){$auth=0;}
															else {$auth = $auth[0]->eliminar;}
															if ($auth): ?>
															<a href="/ordenes-serv/{{ $id }}/editar"
															{{-- href="javascript:void(0);"  --}}
															data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Editar" class="dropdown-item btnEditarOS">
																<i class="la la-edit"></i> Editar
															</a>
															<?php endif ?>
															<a href="javascript:void(0);" id="btnFechaIngreso"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-ingreso" class="delete dropdown-item">
																<i class="la la-calendar "></i> Ingreso Reparación
															</a>
															<a href="javascript:void(0);" id="btnFechaPromesa"  data-id="{{ $id }}" data-toggle="modal" data-target="#modal-fecha-promesa" class="delete dropdown-item">
																<i class="la la-calendar "></i> Fecha Promesa
															</a>
															<a href="javascript:void(0);" data-id="{{ $id.'|'.$o->nro_orden_interno}}" class="dropdown-item ligarOS">
																<i class="la la-arrow-circle-o-down"></i> Ligar orden</span>
															</a>
														<?php endif; ?>
													<?php endif; ?>
													<?php if (isset($splited[2]) == true ): ?>
														<?php if ($splited[2] != "canceladas" && $splited[2] != "historico" ): ?>
															<?php
															$auth = Session::get('Ordenes');
															if($auth == null)
															{
															$auth=0;
															}
															else {
															$auth = $auth[0]->eliminar;
															}
															if ($auth): ?>
																<a href="javascript:void(0);" id="btncancelarOS"  data-id="{{ $id }}"  class="delete dropdown-item">
																	<i class="fas fa-ban"></i> Cancelar
																</a>
															<?php endif ?>
															<?php else: ?>
																<?php
																$auth = Session::get('Ordenes');
																if($auth == null)
																{
																$auth=0;
																}
																else {
																$auth = $auth[0]->eliminar;
																}
																if ($auth): ?>
																	<a href="javascript:void(0);" id="btnborrarOS" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete dropdown-item">
																		<i class="la la-trash"></i> Borrar
																	</a>
																<?php endif ?>
														<?php endif ?>
													<?php endif ?>
													<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
													<?php if (isset($splited[2]) == true ): ?>
													  <?php if ($splited[2] == "Proceso"): ?>
														<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
														  <i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
														</a>
													<?php elseif($splited[2] == "canceladas"): ?>
													<?php else: ?>
																{{--<a class="dropdown-item"data-toggle="modal" class="kt-nav__link"> <span class="kt-nav__link-text" onclick="ReenviarModal();"><i	class="far fa-arrow-alt-circle-up"></i>Reenviar Mensaje</span></a>--}}
																<?php if ($o->id2!== null): ?>
																<a href="/Orden-entregada/pdf/encuesta/{{$o->id2}}"  class="dropdown-item">
																	<i  class="la la-clipboard"></i> Encuesta</span>
																</a>
																<?php endif ?>

													  <?php endif ?>
											  
													<?php else: ?>
														<?php
														$auth = Session::get('Ordenes');
														if($auth == null)
														{
														$auth=0;
														}
														else {
														$auth = $auth[0]->eliminar;
														}
														if ($auth): ?>
															<a href="javascript:void(0);" id="btncancelarOS"  data-id="{{ $id }}"  class="delete dropdown-item">
																<i class="fas fa-ban"></i> Cancelar
																</a>
														<?php endif ?>
														{{--<a class="dropdown-item"data-toggle="modal" class="kt-nav__link"> <span class="kt-nav__link-text" onclick="ReenviarModal();"><i	class="far fa-arrow-alt-circle-up"></i>Reenviar Mensaje</span></a>--}}
														  
														<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
														  <i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
														</a>
														<?php $id= $o->gos_os_id;
														  $auth = Session::get('Ordenes');
														  if($auth == null){$auth=0;}
														  else {$auth = $auth[0]->eliminar;}
														  if ($auth): ?>
														  <a href="/ordenes-serv/{{ $id }}/editar"
														  {{-- href="javascript:void(0);"  --}}
														  data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Editar" class="dropdown-item btnEditarOS" style="order: 1;">
															<i class="la la-edit"></i> Editar
														  </a>
														<?php endif ?>
													<?php endif ?>
											  
												</span>
											  </td>
											  

										</tr>
									@endforeach
								</tbody>
							</table>
						</div>

						


					</div>
				</div>
		</div>
	</div>
</div>
@include('Clientes/modalCliente')
@include('OS/FechaIngreso')
@include('OS/FechaPromesaOpciones')
@include('OS/Ligar/ModalLigarOs')
</div>
					<!-- end:: Content -->

				</div>
				<!-- begin:: Footer -->
				<div
					class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop"
					id="kt_footer">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-footer__copyright">
							2020&nbsp;&copy;&nbsp;<a href="" target="_blank" class="kt-link">Sistema
								de Gestión de Ordenes de Servicios de Taller</a>
						</div>
						<div class="kt-footer__menu">
							<a href="" target="_blank" class="kt-footer__menu-link kt-link">Acerca
								de</a> <a href="" target="_blank"
								class="kt-footer__menu-link kt-link">Contacto</a>
						</div>
					</div>
				</div>
				<!-- end:: Footer -->
			</div>
		</div>
	</div>

	<!-- end:: Page -->
<style>
	.circle-tile-heading {
	border: 1px solid black;
    border-radius: 100%;
	color: black;
	height: 18px;
	width: 18px;
	position: absolute;
	/* float:center; */
  	left: 46%;
	margin-top: 20px;
    transition: all 0.3s ease-in-out 0s;
	}
	@media screen and (max-width: 1450px) {
		.circle-tile-heading{

		position: relative;
		top: -20px;
		margin-top: 0px;
		margin-left: 0px;
		}
	}
	@media screen and (min-width: 1000px) {
		.circle-tile-heading{

		position: relative;
		left: 25%;
		top: -30px;
		}
	}
	@media  screen and (min-width: 800px) {
		.circle-tile-heading{

		position: relative;
		left: 25%;
		top: -30px;
			margin-top: 20px;
		}
	}
</style>
<script>
	var ocultar = document.querySelectorAll('.Ordenesligadas');
	for (const iterator of ocultar) {
		if(iterator.innerText == 'OL:'){
			var id = iterator.id;
			var mod = document.getElementById(id);
			mod.classList.add('d-none');
		}
	}
</script>


<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<script>
var KTAppOptions = {"colors": {"state": {"brand": "#5d78ff","dark": "#282a3c","light": "#ffffff","primary": "#5867dd","success": "#34bfa3","info": "#36a3f7","warning": "#ffb822","danger": "#fd3995"},"base": {"label": ["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape": ["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<!--begin:: Vendor Plugins -->
<script src="{{env('APP_URL')}}/assets/plugins/general/jquery/dist/jquery.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/popper.js/dist/umd/popper.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/js-cookie/src/js.cookie.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/moment/min/moment.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/sticky-js/dist/sticky.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/wnumb/wNumb.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/jquery-form/dist/jquery.form.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js"></script>

<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="{{env('APP_URL')}}/assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/select2/dist/js/select2.full.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/typeahead.js/dist/typeahead.bundle.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/handlebars/dist/handlebars.js"></script>

<script src="{{env('APP_URL')}}/assets/plugins/general/owl.carousel/dist/owl.carousel.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/autosize/dist/autosize.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/clipboard/dist/clipboard.min.js"></script>

<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/raphael/raphael.js"></script>
<script src="{{env('APP_URL')}}/gos/morris.js/morris.js"></script>


<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/lib.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/jquery.input.js"></script>
<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/repeater.js"></script>

<!--end:: Vendor Plugins -->
<script src="{{env('APP_URL')}}/assets/js/scripts.bundle.js"></script>

<!--begin:: Vendor Plugins for custom pages -->

<script src="{{env('APP_URL')}}/assets/js/pages/crud/forms/widgets/form-repeater.js"></script>
<script src="{{env('APP_URL')}}/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
<script src="{{env('APP_URL')}}/assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>
<script src="{{env('APP_URL')}}/gos/js/DatePicker.js"></script>
<script src="{{env('APP_URL')}}/gos/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{env('APP_URL')}}/gos/js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{env('APP_URL')}}/gos/js/datatables/dataTables.rowReorder.min.js"></script>
<script src="{{env('APP_URL')}}/gos/js/datatables/datatables.js"></script>

<script src="{{env('APP_URL')}}/gos/datatable-btn/JSZip-2.5.0/jszip.min.js"></script>
<script src="{{env('APP_URL')}}/gos/datatable-btn/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
<script src="{{env('APP_URL')}}/gos/datatable-btn/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script src="{{env('APP_URL')}}/gos/datatable-btn/Buttons-1.6.1/js/buttons.print.min.js"></script>

<script src="{{env('APP_URL')}}/gos/ajax-inicio.js"></script>
<script src="{{env('APP_URL')}}/gos/js/comunicacioncliente.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url : '/gestion-taller/consultar/1',
    type : "get",
    done : function(response) {console.log(response);},
      success : function(data) {
        var nmcv = data.taller_conf_vehiculo.nomb_modulo_camp_vehiculo;
        var nmarca = data.taller_conf_vehiculo.nomb_marca;
        var nmodelo = data.taller_conf_vehiculo.nomb_modelo;
        var ncolor = data.taller_conf_vehiculo.nomb_color;


        if(nmcv!=null){
          document.getElementById("idvehiculo").innerHTML = nmcv;
          document.getElementById("idvehiculo1").innerHTML ="Ver ".concat(nmcv);
        }
        if(nmarca!=null){
          document.getElementById("idmarcas").innerHTML ="Ver ".concat(nmarca);
        }
        if(nmodelo!=null){
          document.getElementById("idmodelos").innerHTML ="Ver ".concat(nmodelo);
        }
        if(ncolor!=null){
          document.getElementById("idcolores").innerHTML ="Ver ".concat(ncolor);
        }
      }
  });
});
</script>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<script>$(function(){$('[data-toggle="popover"]').popover()}); </script>
	<script src="{{env('APP_URL')}}/gos/OS/ajax-os-listado.js"></script>
	<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-fecha-ingreso.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>




	</body>

<!-- end::Body -->
</html>