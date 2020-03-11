<!DOCTYPE html>

<html lang="es">

	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>Pro Order</title>
		<meta name="description" content="Sistema GOS">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />


		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="{{env('APP_URL')}}/assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
		<!--end:: Vendor Plugins -->
		<link href="{{env('APP_URL')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin:: Vendor Plugins for custom pages -->
		@yield('estiloPorPagina')
	

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
        <link href="{{env('APP_URL')}}/assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		
		<!--end::Layout Skins -->
		
		{{-- Estilos generales --}}
		<link rel="stylesheet" href="/gos/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="/gos/css/rowReorder.bootstrap4.min.css">
		<link rel="stylesheet" href="../gos/css/menu_vertical.css">
	</head>
	<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">
	<!-- begin:: Page -->
	@include('Layout/headerMobile')
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			@include('Layout/aside')
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"	id="kt_wrapper">
				<!-- begin:: Header -->
				@include('Layout/header')
				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor py-2" id="kt_content">
					<!-- begin:: Content -->
					<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid px-2">
						<!-- begin:: Content -->
						<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
						<link rel="stylesheet" href="../gos/css/menu_vertical.css">
						<link rel="stylesheet" href="../gos/css/circulo_vehiculo.css">
						<div class="kt-portlet kt-portlet--mobile">
													@if (session('alert'))
								<div class="alert alert-danger">
								{{session('alert')}}
								</div> @endif
							<div class="kt-portlet__head kt-portlet__head--lg">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title" id="nombreblade">Órdenes Terminadas</h3>
								</div>
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										<div class="kt-portlet__head-actions">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Busqueda Avanzada</button>
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
										
										<div class ="row">
											<div class="col col-sm-12 col-md-2">
												<div class="vertical-menu">
													<a1 href="" class="active">Carpetas  </a1>
													
													<a href="/listaros">En Proceso<span class="badge badge-light">{{$cuentaProces ??''}}</a>
													<a class="active" href="/listarter">Terminadas<span class="badge badge-light">{{$cuentaTerminadas ??''}}</a>
													<a href="/listarent">Entregadas<span class="badge badge-light">{{$cuentaEntregadas ??''}}</span></a>
													<a href="/listarhis">Histórico<span class="badge badge-light">{{$cuentahistorico}}</a>
													<a href="/listarcan">Canceladas<span class="badge badge-light">{{$cuentaCanceladas ??''}}</span></a>
												</div>
											</div>
											<div class="col col-sm-12 col-md-10">
												<form action="/listarter-search" method="POST">
													@CSRF
													<div class="input-group mb-1 mt-2 col-sm-12 col-md-5">
														
														<input type="text" class="form-control" placeholder="<?php if (isset($search)): ?>{{$search}} <?php else: ?>Qué quieres encontrar? <?php endif; ?>" name="buscadorOS" id="buscadorOS">
														<div class="input-group-append">
															<button class="btn btn-brand" type="submit">Buscar</button>
														</div>
													</div>
												</form>
												<input type="hidden" id="app_url" name="app_url" url=".."/>

												<div class="table-responsive table-sm p-1" id="Orden-terminada">
													<table class="table table-sm table-hover  nowrap" id="" style="font-size: 1rem;">
														<thead class="thead-light">
															<tr style="font-weight: 500;">
																<th style="display:none">ID</th>
																<th>Orden</th>
																<th>Fecha</th>
																<th>Días</th>
																<th>Cliente</th>
																<th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
																<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
																<th class="text-nowrap text-center">Estatus de Fecha <br> Promesa</th>
																<th>Asesor</th>
																<th>Total</th>
																<th>Avance</th>
																<th style="width: 3%;"></th>
															</tr>
														</thead>
														<tbody>
															@foreach($osterminada as  $o)
																<tr>
																	<!--ID  -->
																	<td style="display:none">{{$o->gos_os_id}}</td>
																	<!--Orden  -->
																	<td style="text-align:center;vertical-align: middle;">
																		<a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
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
																			<i class="fas fa-circle" style="color: #339af0;"></i> 
																			{{$o->fecha_terminado ?? 'Fecha terminado' }}
																		</p>
																		<p class="m-0" data-toggle="popover" data-trigger='hover'
																			data-placement="top" data-content="Fecha entregado">
																			<i class="fas fa-caret-square-left" style="color: red;"></i> 
																			{{$o->fecha_entregado ?? 'Fecha entregado' }}
																		</p>
																		<p class="m-0" data-toggle="popover" data-trigger='hover'
																			data-placement="top" data-content="Fecha facturado">
																			<i class="fas fa-circle" style="color: #339af0;"></i> 
																			{{$o->fecha_facturado ?? 'Fecha facturado' }}
																		</p>
																		<p class="m-0" data-toggle="popover" data-trigger='hover'
																			data-placement="top" data-content="Fecha de pago">
																			<i class="fas fa-circle" style="color: #339af0;"></i> 
																			{{$o->fecha_pago ?? 'Fecha pago' }}
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
																		{{$asg[0]??''}}
																		<br>{{$asg[1] ??''}}{{$asg[2]??''}}
																		<br>{{$asg[3]??''}}{{$asg[4]??''}}
																		<br>{{$asg[5]??''}}{{$asg[6]??''}}
																		<br>{{$asg[7]??''}}{{$asg[8]??''}}
																		<br>{{$asg[9]??''}}{{$asg[10]??''}}
																		<br>{{$asg[11]??''}}{{$asg[12]??''}}
																		<br>{{$asg[13]??''}}{{$asg[14]??''}}
																		<br>{{$asg[15]??''}}{{$asg[16]??''}}
																		<br>{{$asg[17]??''}}{{$asg[18]??''}}
																		<br>{{$asg[19]??''}}{{$asg[20]??''}}
																	</td>
																	<!--vehiculo  -->
																	<?php $vhc=explode("|", $o->detallesVehiculo);?>
																	<td style="vertical-align: middle;"> <i class="fas fa-circle ml-5"style="color: #{{$vhc[0]}};"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} <br>
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
																		<td class="text-center" style="vertical-align: middle;">Sin Fecha</td>
																	@elseif($o->EstadoFechaPromesa == 'Rojo')
																		<td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:red;"></i> Etapa</td>
																	@elseif($o->EstadoFechaPromesa == 'Amarillo')
																		<td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:yellow;"></i> Etapa</td>	
																	@else
																		<td class="text-center" style="vertical-align: middle;"><i class="fas fa-circle" style="color:green;"></i> Etapa</td>
																	@endif

																	<!--Asesor  -->
																	<td style="text-align:center;vertical-align: middle;">{{$o->asesor}}</td>
																	<!--Total  -->
																	<td style="text-align:center;vertical-align: middle;">
																		<?php $tots= $o->tots;  $numberAsString = number_format($tots, 1);?>
																		{{$numberAsString}}
																	</td>
																	<!--Avance  -->
																	<?php  $id= $o->gos_os_id; ?>
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
																	<!--Opciones -->
																	<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
																		<span class="dropdown">
																			<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
																				<i class="la la-ellipsis-h"></i>
																			</a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<?php $e= round($o->porcentaje); $id= $o->gos_os_id;  $url = $_SERVER['REQUEST_URI'];  $splited=explode("/", $url);  ?>
																				
																					<?php $auth = Session::get('Ordenes');
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
																					<?php if ($auth): ?>
																							<a href="javascript:void(0);" id="btncancelarOS"  data-id="{{ $id }}"  class="delete dropdown-item">
																								<i class="fas fa-ban"></i> Cancelar
																							</a>
																						<?php endif ?>
																					<a href="/OS/{{ $id }}/pdf/"  class="dropdown-item">
																						<i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
																					</a>
																			</div>
																		</span>
																	</td>
																	

																</tr>
															@endforeach
														</tbody>
													</table>
													{!!$pagter!!} Mostrando {{$conteoProc}} registros de un total de {{$totalProc}} registros
												
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- end:: Content -->
							@include('Clientes/modalCliente')
							@include('OS/FechaIngreso')
							@include('OS/FechaPromesaOpciones')
							<!-----------------------------------------Modal ligar Os-------------------------------------------------------------------------------------------------------->
							<div class="modal fade" id="modalLigarOs" tabindex="-1"
								role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;min-width: 70%;">
									<div class="modal-content">
										<div class="modal-header p-1">
											<h4 class="m-1 pt-2 pl-3">Busqueda de Cliente/Vehiculo</h4>
											<h6 class="pt-3 pl-5" id="nroOsLigadas"></h6>
											<h6 class="pt-3 pl-5" id="nroOs"></h6>
											<input type="hidden" id="nroOsHidden">
											<input type="hidden" id="nroOsInternoHidden">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="table-responsive table-sm p-1">
												<table class="table table-sm table-hover nowrap" id="dt-ordenesLigar">
													<thead class="thead-light">
														<tr>
															<th>Orden</th>
															<th>Cliente</th>
															<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
															<th># Económico</th>
															<th># Serie</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														@foreach($osterminada as $key => $o)
														<tr>
															<td style="text-align:center;vertical-align: middle;">
																<a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
															</td>
															<?php $cl=explode("|", $o->nomb_cliente);?>
															<td style="vertical-align: middle;"> {{$cl[0]}} <br>{{$cl[1]}} <br>{{$cl[2]}}</td>
															<?php $vhc=explode("|", $o->detallesVehiculo);?>
															<td style="vertical-align: middle;">
																<i class="fas fa-circle" style="background-color:#{{$vhc[0]}}; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i>
																{{$vhc[1]}}
																<br>
																<div class="pl-4"> {{$vhc[2]}} </div>
																
															</td>
															<?php $eco=substr($vhc[3],12,50)?>
															<td style="vertical-align: middle;">{{$eco}}</td>
															<?php $ser=substr($vhc[4],8,50)?>
															<td style="vertical-align: middle;">{{$ser}}</td>
															<td>
																<a href="javascript:void(0);" data-id="{{$o->gos_os_id.'|'.$o->nro_orden_interno}}" class="btn btn-verde btn-ligar text-nowrap mt-2" id="btn-ligar-{{$o->gos_os_id}}" style="text-align:center;color:white;width:100px;">Ligar orden
																</a>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>    
										</div>
										<div class="modal-footer">
											<a href="javascript:void(0);" class="btn btn-warning btn-block text-white btn-cerrar-ligar">Guardar</a>
										</div>
									</div>
								</div>
							</div>


							

							<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-body">
										<div class="form-group">
											<select class="form-control kt-selectpicker" name="filtrobuscadorOS" id="filtrobuscadorOS">
												<option value="" disabled selected hidden> <?php if (isset($filtro)): ?>{{$filtro}} <?php else: ?>Selecciona filtro... <?php endif; ?></option>
													<?php if (isset($filtro)): ?>
													<option value="{{$filtro}}"  selected > {{$filtro}}</option>
													<?php endif; ?>
												<option value="#Orden">#Orden</option>
												<option value="Fecha">Fecha</option>
												<option value="Cliente">Cliente</option>
												<option value="Aseguradora">Aseguradora</option>
												<option value="Vehiculo">Vehículo</option>
												<option value="Asesor">Asesor</option>

											</select>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="<?php if (isset($search)): ?>{{$search}} <?php else: ?>Qué quieres encontrar? <?php endif; ?>" name="buscadoravan" id="buscadoravan">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary btn-block" >Buscar</button>
									</div>
								</div>
							</div>
							</div>

					
						</div>
						<!-- begin:: Footer -->
						<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop"	id="kt_footer">
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
		.kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__link .kt-menu__link-text {
    	color: #9899ac;
		}
		.kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__heading .kt-menu__link-bullet.kt-menu__link-bullet--dot > span, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__link .kt-menu__link-bullet.kt-menu__link-bullet--dot > span {
			background-color: #5c5e81;
		}
		.kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__link .kt-menu__link-text {
			color: #ffffff;
		}
		i.kt-menu__link-icon.fa.fa-flag-checkered {
			color: white;
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
	<!-- end::Global Config -->
	<!--begin::Global Theme Bundle(used by all pages) -->
	<!--begin:: Vendor Plugins -->
	<script src="{{env('APP_URL')}}/assets/plugins/general/jquery/dist/jquery.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/popper.js/dist/umd/popper.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/js-cookie/src/js.cookie.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js"></script>



	<!--end:: Vendor Plugins -->
	<script src="{{env('APP_URL')}}/assets/js/scripts.bundle.js"></script>
	<!--begin:: Vendor Plugins for custom pages -->

	<script src="{{env('APP_URL')}}/assets/js/pages/crud/forms/widgets/form-repeater.js"></script>
	<script src="{{env('APP_URL')}}/assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>
	<script src="{{env('APP_URL')}}/gos/js/datatables/jquery.dataTables.min.js"></script>
	<script src="{{env('APP_URL')}}/gos/js/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="{{env('APP_URL')}}/gos/js/datatables/dataTables.rowReorder.min.js"></script>
	<script src="{{env('APP_URL')}}/gos/js/datatables/datatables.js"></script>

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