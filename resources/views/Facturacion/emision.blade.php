@extends( 'Layout' )
@section( 'Content' )

<!-- begin:: Content -->

<div class="kt-portlet kt-portlet--mobile">
@if (session('alert'))
	<div class="alert alert-danger">
	 {{session('alert')}}
	 </div> @endif
	 @if (session('success'))
	<div class="alert alert-success">
	 {{session('success')}}
	 </div> @endif
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Facturación</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-actions ">
        		<div class="d-flex justify-content-end">
				<div class="form-row col-12 col-sm-5">

					</div>
					<div class="form-row col-12 col-sm-5">
						<a href="/gestion-factura/ventaMostrador" class="btn btn-brand btn-elevate btn-icon-sm" style="width:100%; ">

						Venta mostrador
						</a>
					</div>
           			<div class="form-row col-12 col-sm-5">
						<button class="btn btn-brand btn-elevate btn-icon-sm" id="crear-facturacion" style="width:100%; " type="button">

						Complemento de Pago
						</button>
					</div>
        			<div class="form-row col-12 col-sm-5">
						<button class="btn btn-brand btn-elevate btn-icon-sm " id="crear-multiple-facturacion" style="width:100%; " type="button">

						Agregar Pagos Múltiples
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="kt-portlet__body ">

		<div class="kt-widget17 pt-5 mt-3">

			<div class="kt-widget17__stats">
			<div class="col">
        <form id="factura_form" action="" method="post">
				@csrf
					<input type="hidden" id="gos_fac_id" name="gos_fac_id" value="">
					<div class="form-row">

						<div class="form-group col-12 col-sm-2 ">
							<label>Fecha</label>
							<div class="input-group date">
                    			<input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" readonly/>
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
							<small style="font-style: italic;" class="fecha_factura form-text text-danger"></small>
						</div>
						<div class="form-group col-6 col-sm-2">
							<label>Tipo de venta</label>
							<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="tipo_venta" id="tipo_venta">
								<option value=""></option>
								<option value="F"<?php if ($tipoventa =="F" ): ?>selected<?php endif; ?>>Factura</option>
								<option value="NR"<?php if ($tipoventa =="NR" ): ?>selected<?php endif; ?>>Nota de remisión</option>
								<option value="VM"<?php if ($tipoventa =="VM" ): ?>selected<?php endif; ?>>Venta mostrador</option>
							</select>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>
						<div class="form-group col-6 col-sm-2">
							<label>Aseguradora</label>
							<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id" id="gos_aseguradora_id">
								<option value=""></option>
								@foreach($listaAseguradoras as $aseguradora)

								<?php if (isset($aid2)): ?>
									<option  value="{{$aseguradora->gos_aseguradora_id}}"<?php if ($aid2 ==$aseguradora->gos_aseguradora_id ): ?>selected<?php endif; ?>>{{$aseguradora->empresa}}</option>

								<?php else: ?>
									<option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
								<?php endif; ?>
								@endforeach
							</select>
							<small style="font-style: italic;" class="aseguradora form-text text-danger"></small>
						</div>
						<div class="form-group col-12 col-sm-3">
							<label>Estatus de Documentos</label>
							<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="estatus" id="estatus">
								<option value=""></option>
								<option value="PAGADO"<?php if ($estatus =="Pagado" ): ?>selected<?php endif; ?>>Pagado</option>
								<option value="PENDIENTE"<?php if ($estatus =="Pendiente" ): ?>selected<?php endif; ?>>Pendiente</option>
							</select>
							<small style="font-style: italic;" class="estatus form-text text-danger"></small>
						</div>
						<div class="form-group col-2 col-sm-2 pl-1">
								<label>Filtrar</label>
							<button type="submit" class="btn btn-primary btn-block mb-3">Aplicar</button>
						</div>
					</div>
				</form>
			</div>
				<div class="kt-widget17__items pb-5">
					<div class="kt-widget17__item" style="box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.3); background-color: lightskyblue;">
						<span class="kt-widget17__desc" style="text-align:center; color: white;">
							Venta
						</span>
						<span class="kt-widget17__subtitle" style="text-align:center; color: white;">
              {{$VENTA ??''}}
						</span>
					</div>

					<div class="kt-widget17__item" style="box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.3); background-color: lightskyblue;">

						<span class="kt-widget17__desc" style="text-align:center; color: white;">
							Monto Pendiente
						</span>
						<span class="kt-widget17__subtitle" style="text-align:center; color: white;">
                 {{$MONTOPENDIENTE ??''}}
						</span>
					</div>

					<div class="kt-widget17__item" style="box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.3); background-color: lightskyblue;">
						<span class="kt-widget17__desc" style="text-align:center; color: white;">
							Monto Pagado
						</span>
						<span class="kt-widget17__subtitle" style="text-align:center; color: white;">
                   {{$MONTOPAGADO ??''}}
						</span>
					</div>
				</div>

			</div>
	</div>

	<div class="kt-portlet__body p-0">
		<div class="d-flex justify-content-between">

			<div class='container-fluid'>
					<div class ='row'>
						<div class='col col-sm-2'>
							<div class="vertical-menu" style= "padding-top: .25rem">
								<a1 href="javascript:void(0);" class="active">Carpetas</a1>
								<a href="javascript:void(0);"  onclick="carpetatodos();"  class="active" id="headertodos">Todos<span class="badge badge-light">{{$cuentaTodos ??''}}</a>
								<a href="javascript:void(0);" onclick="carpetaFacturas();"  id="headerfacuras">Facturas<span class="badge badge-light">{{$cuentaFacturas ??''}}</a>
								<a href="javascript:void(0);" onclick="carpetasremision();"  id="headerremisiones">Notas de remision<span class="badge badge-light">{{$cuentaNotaR ??''}}</a>
								<a href="javascript:void(0);" onclick="carpetascanceladas();"  id="headercanceladas">Canceladas<span class="badge badge-light">{{$cuentaCanceladas ??''}}</span></a>
								<a href="javascript:void(0);" onclick="carpetasnotacredito()"  id="headernotascredito">Notas de Credito<span class="badge badge-light">{{$cuentaNcredido ??''}}</a>
								<a href="javascript:void(0);" onclick="carpetashistorico()"  id="headerhistorico">Histórico<span class="badge badge-light">{{$cuentaH ??''}}</a>
							</div>
						</div>
						<div class='col col-sm-10'>
							<input type="hidden" id="app_url" name="app_url" url=".."/>
							<!-----------------TODAS----------------------------------------------------------------------------------------------->
							<div class="table-responsive p-1" id="carpeta-todas">
								<table class="table table-sm table-hover" id="OS_DataTable">
									<thead class="thead-light">
										<tr>
											<!-- <th>#ID</th> -->
											<th style="text-align:center;">#Documento</th>
											<th style="text-align:center;">Orden</th>
											<th style="text-align:center; width:13%;">Emisión</th>
											<th style="text-align:center; ">Cliente</th>
											<th>Aseguradora</th>
											<th style=" width: 17%;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
											<th style="text-align:center;">Estatus</th>
											<th style="text-align:center;">Importe</th>
											<th style="text-align:center;">RFC</th>
											<th style="width: 3%;"></th>
										</tr>
									</thead>
									<tbody>
									@foreach($tot as $key => $t)
									<?php if ($t->fecha_historico_rem==null): ?>
										<tr>
											<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
												<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
												 N - {{$t->nota_id}}
												 </td>
											<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a> </td>
											<td style="text-align:center;vertical-align: middle;">
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha generación de nota">
											<i class="fas fa-circle" style="color: #339af0;"></i>
											{{$t->fecha_nota}}
											</p>
											@isset($t->fecha_abono )
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha Abono">
											<i class="fas fa-caret-square-right" style="color: green;"></i>
											{{ $t->fecha_abono ?? ''}}
											</p>
											@endisset
											</td>
											<?php $vhc=explode("|", $t->nomb_cliente);?>
											<td style="text-align:center;vertical-align: middle;">{{$vhc[0]}}<br>{{$vhc[1]}} </td>
											<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
											<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
											<?php $vhc=explode("|", $t->detallesVehiculo);?>
											<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
											<td style="text-align:center;vertical-align: middle;">
												<?php if(isset($t->estatus)): ?>
													<?php if($t->fecha_historico != NULL && $t->estatus == 'PAGADO'): ?>
													{{$t->estatus}}<br>
														Historico - {{$t->nomb_forma_pago}}
													<?php else: ?>
														{{$t->estatus}}<br>
														{{$t->nomb_forma_pago}}
													<?php endif; ?>
												<?php else: ?>
													<?php if($t->fecha_historico != NULL && $t->nomb_forma_pago = 'Contado'): ?>
														Pagado<br>
														Historico - {{$t->nomb_forma_pago}}
													<?php else: ?>
														Pendiente<br>
														{{$t->nomb_forma_pago}}
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<?php $abono = ($t->abono != 0) ? $t->abono: 0;   ?>
											<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->precio,2,".",",")}} <br>P: ${{number_format($t->precio - $abono - $t->totalPago,2,".",",")}} <br>PT: ${{number_format($t->totalPago,2,".",",")}}</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
													<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
														data-toggle="dropdown" aria-expanded="true"> <i
														class="fas fa-list"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
													<?php if($t->estatus!="CANCELADA"){ ?>

														<a class="btn btn-brand btn-elevate btn-icon-sm btn-verde" data-id="{{$t->nota_id}}|{{$t->precio - $abono - $t->totalPago}}" id="modalanticiposbtn" style="width:100%;color:white; " >
														Pago
														</a>
														<?php } ?>
														<a href="/gestion-factura/ver/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
															<i class="la la-eye"></i> Ver
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->ver;
														}

														if ($auth): ?>
														<a  href="/gestion-factura/enviarhistorico/{{$t->nota_id}}" class="dropdown-item ">
															<i class="la la-edit"></i> Mandar a histórico
														</a>
														<a href="/osg/fecha-cancelada/{{$t->nota_id}}" class="dropdown-item ">
															<i class="fas fa-ban"></i> Cancelar
														</a>
														<?php endif ?>
														<a href="/gestion-factura/pdf/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> PDF
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->eliminar;
														}

														if ($auth): ?>
														<a id="borrar-nota" data-id="{{$t->nota_id}}" class="dropdown-item">
															<i class="la la-trash"></i> Eliminar
														</a>
														<?php endif ?>

													</div>
												</span>
											</td>
										</tr>
										<?php endif; ?>
										@endforeach
										@foreach($factura as $key => $t)
										<tr>
											<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
												<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
												F - {{$t->folio}}
											</td>
											<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a></td>
											<td style="text-align:center;vertical-align: middle;">
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha generación de nota">
											<i class="fas fa-circle" style="color: #339af0;"></i>
											{{$t->fecha}}
											</p>
											@isset($t->fecha )
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha Abono">
											<i class="fas fa-caret-square-right" style="color: green;"></i>
											{{ $t->fecha ?? ''}}
											</p>
											@endisset
											</td>
											<?php $vhc=explode("|", $t->nomb_cliente);?>
											<td style="text-align:center;vertical-align: middle;">{{$vhc[0] ??''}}&nbsp{{$vhc[1] ??''}} </td>
											<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
											<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1] ??''}}{{$asg[2] ??''}}<br>{{$asg[3] ??''}}<br>{{$asg[4] ??''}}</td>
											<?php $vhc=explode("|", $t->detallesVehiculo);?>
											<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0] ??''}} ; color: #{{$vhc[0] ??''}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1] ??''}}<br>{{$vhc[2]??''}}<br>{{$vhc[3]??''}}<br>{{$vhc[4] ??''}} </td>
											<td style="text-align:center;vertical-align: middle;">{{$t->estatus}}</td>
											<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->total,2,".",",")}}</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
													<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
														data-toggle="dropdown" aria-expanded="true"> <i
														class="fas fa-list"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
													<?php if($t->estatus!="CANCELADA"){ ?>

														<a href="/gestion-factura/pdf/Factura/{{$t->gos_docventa_id}}" target="_blank" class="dropdown-item ">
															<i class="fas fa-print"></i> PDF
														</a>
														<a href="/gestion-factura/pdf/XML/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->eliminar;
														}

														if ($auth): ?>
														<a href="/cancelar-factura/{{$t->gos_docventa_id}}" class="dropdown-item">
															<i class="fas fa-ban"></i> Cancelar
														</a>
														<?php endif ?>

													<?php } else{ ?>
														<a href="/gestion-factura/pdf/XMLCancelada/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
													<?php } ?>
													</div>
												</span>
											</td>
										</tr>
										@endforeach
										@foreach($rep as $key => $t)
										<tr>
											<td style="text-align:center;vertical-align: middle;">
												REP - {{$t->folio}}
											</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="text-align:center;vertical-align: middle;">
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha generación de nota">
											<i class="fas fa-circle" style="color: #339af0;"></i>
											{{$t->fecha}}
											</p>
											@isset($t->fecha )
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha Abono">
											<i class="fas fa-caret-square-right" style="color: green;"></i>
											{{ $t->fecha ?? ''}}
											</p>
											@endisset
											</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="vertical-align: middle;"></td>
											<td>  </td>
											<td style="text-align:center;vertical-align: middle;">{{$t->estatus}}</td>
											<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->total,2,".",",")}}</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
													<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
														data-toggle="dropdown" aria-expanded="true"> <i
														class="fas fa-list"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="/gestion-factura/pdf/REP/{{$t->gos_docventa_id}}" target="_blank" class="dropdown-item ">
															<i class="fas fa-print"></i> PDF
														</a>
														<a href="/gestion-factura/pdf/REPXML/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->eliminar;
														}

														if ($auth): ?>
														<a href="/cancelar-factura/{{$t->gos_docventa_id}}" class="dropdown-item">
															<i class="fas fa-ban"></i> Cancelar
														</a>
														<?php endif ?>

													</div>
												</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!--------------------------------------------Facturadas--------------------------------------------------------------->
							<div class="table-responsive p-1" id="carpeta-facturas" style="display: none;">
								<table class="table table-sm table-hover" id="OS_DataTable">
									<thead class="thead-light">
										<tr>
											<!-- <th>#ID</th> -->
											<th style="text-align:center;">#Documento</th>
											<th style="text-align:center;">Orden</th>
											<th style="text-align:center; width:13%;">Emisión</th>
											<th style="text-align:center; ">Cliente</th>
											<th>Aseguradora</th>
											<th style=" width: 17%;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
											<th style="text-align:center;">Estatus</th>
											<th style="text-align:center;">Importe</th>
											<th style="text-align:center;">RFC</th>
											<th style="width: 3%;"></th>
										</tr>
									</thead>
									<tbody>
										@foreach($factura as $key => $t)
										<tr>
											<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
												<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
												F - {{$t->folio}}
											</td>
											<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a></td>
											<td style="text-align:center;vertical-align: middle;">
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha generación de nota">
											<i class="fas fa-circle" style="color: #339af0;"></i>
											{{$t->fecha}}
											</p>
											@isset($t->fecha )
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha Abono">
											<i class="fas fa-caret-square-right" style="color: green;"></i>
											{{ $t->fecha ?? ''}}
											</p>
											@endisset
											</td>
											<?php $vhc=explode("|", $t->nomb_cliente);?>
											<td style="text-align:center;vertical-align: middle;">{{$vhc[0] ??''}}&nbsp{{$vhc[1]??''}} </td>
											<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
											<td style="vertical-align: middle;">{{$asg[0] ??''}}<br>{{$asg[1]??''}}{{$asg[2]??''}}<br>{{$asg[3]??''}}<br>{{$asg[4] ?? ''}}</td>
											<?php $vhc=explode("|", $t->detallesVehiculo);?>
											<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]??'' }} ; color: #{{$vhc[0]??''}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]??''}}<br>{{$vhc[2]??''}}<br>{{$vhc[3]??''}}<br>{{$vhc[4]??''}} </td>
											<td style="text-align:center;vertical-align: middle;">{{$t->estatus}}</td>
											<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->total,2,".",",")}}</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
													<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
														data-toggle="dropdown" aria-expanded="true"> <i
														class="fas fa-list"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
													<?php if($t->estatus!="CANCELADA"){ ?>

														<a href="/gestion-factura/pdf/Factura/{{$t->gos_docventa_id}}" target="_blank" class="dropdown-item ">
															<i class="fas fa-print"></i> PDF
														</a>
														<a href="/gestion-factura/pdf/XML/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->eliminar;
														}

														if ($auth): ?>
														<a href="/cancelar-factura/{{$t->gos_docventa_id}}" class="dropdown-item">
															<i class="fas fa-ban"></i> Cancelar
														</a>
														<?php endif ?>

													<?php } else{ ?>
														<a href="/gestion-factura/pdf/XMLCancelada/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
													<?php } ?>
													</div>
												</span>
											</td>
										</tr>
										@endforeach
										@foreach($rep as $key => $t)
										<tr>
											<td style="text-align:center;vertical-align: middle;">
												REP - {{$t->folio}}
											</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="text-align:center;vertical-align: middle;">
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha generación de nota">
											<i class="fas fa-circle" style="color: #339af0;"></i>
											{{$t->fecha}}
											</p>
											@isset($t->fecha )
											<p class="m-0" data-toggle="popover" data-trigger='hover'
											data-placement="top" data-content="Fecha Abono">
											<i class="fas fa-caret-square-right" style="color: green;"></i>
											{{ $t->fecha ?? ''}}
											</p>
											@endisset
											</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="vertical-align: middle;"></td>
											<td>  </td>
											<td style="text-align:center;vertical-align: middle;">{{$t->estatus}}</td>
											<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->total,2,".",",")}}</td>
											<td style="text-align:center;vertical-align: middle;"></td>
											<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
												<span class="dropdown">
													<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
														data-toggle="dropdown" aria-expanded="true"> <i
														class="fas fa-list"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="/gestion-factura/pdf/REP/{{$t->gos_docventa_id}}" target="_blank" class="dropdown-item ">
															<i class="fas fa-print"></i> PDF
														</a>
														<a href="/gestion-factura/pdf/REPXML/{{$t->gos_docventa_id}}" class="dropdown-item ">
															<i class="fas fa-print"></i> XML
														</a>
														<?php

														$auth = Session::get('Facturacion');

														if($auth == null)
														{
															$auth=0;

														}
														else {
															$auth = $auth[0]->eliminar;
														}

														if ($auth): ?>
														<a href="/cancelar-factura/{{$t->gos_docventa_id}}" class="dropdown-item">
															<i class="fas fa-ban"></i> Cancelar
														</a>
														<?php endif ?>

													</div>
												</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						<!----------------------------------------------REMISIONES -------------------------------------------------------------->
						<div class="table-responsive p-1" id="carpeta-notasremison"  style="display: none;">
							<table class="table table-sm table-hover" id="OS_DataTable">
								<thead class="thead-light">
									<tr>
										<!-- <th>#ID</th> -->
										<th style="text-align:center;">#Documento</th>
										<th style="text-align:center;">Orden</th>
										<th style="text-align:center; width:13%;">Emisión</th>
										<th style="text-align:center; ">Cliente</th>
										<th>Aseguradora</th>
										<th style=" width: 17%;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
										<th style="text-align:center;">Estatus</th>
										<th style="text-align:center;">Importe</th>
										<th style="text-align:center;">RFC</th>
										<th style="width: 3%;"></th>
									</tr>
								</thead>
								<tbody>
								@foreach($tot as $key => $t)
								<?php if ($t->fecha_historico_rem==null): ?>
									<tr>
										<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
											<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
											 N - {{$t->nota_id}}
											 </td>
										<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a> </td>
										<td style="text-align:center;vertical-align: middle;">
										<p class="m-0" data-toggle="popover" data-trigger='hover'
										data-placement="top" data-content="Fecha generación de nota">
										<i class="fas fa-circle" style="color: #339af0;"></i>
										{{$t->fecha_nota}}
										</p>
										@isset($t->fecha_abono )
										<p class="m-0" data-toggle="popover" data-trigger='hover'
										data-placement="top" data-content="Fecha Abono">
										<i class="fas fa-caret-square-right" style="color: green;"></i>
										{{ $t->fecha_abono ?? ''}}
										</p>
										@endisset
										</td>
										<?php $vhc=explode("|", $t->nomb_cliente);?>
										<td style="text-align:center;vertical-align: middle;">{{$vhc[0]}}<br>{{$vhc[1]}} </td>
										<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
										<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
										<?php $vhc=explode("|", $t->detallesVehiculo);?>
										<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
										<td style="text-align:center;vertical-align: middle;">
											<?php if(isset($t->estatus)): ?>
												<?php if($t->fecha_historico != NULL && $t->estatus == 'PAGADO'): ?>
												{{$t->estatus}}<br>
													Historico - {{$t->nomb_forma_pago}}
												<?php else: ?>
													{{$t->estatus}}<br>
													{{$t->nomb_forma_pago}}
												<?php endif; ?>
											<?php else: ?>
												<?php if($t->fecha_historico != NULL && $t->nomb_forma_pago = 'Contado'): ?>
													Pagado<br>
													Historico - {{$t->nomb_forma_pago}}
												<?php else: ?>
													Pendiente<br>
													{{$t->nomb_forma_pago}}
												<?php endif; ?>
											<?php endif; ?>
										</td>
										<?php $abono = ($t->abono != 0) ? $t->abono: 0;   ?>
										<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->precio,2,".",",")}} <br>P: ${{number_format($t->precio - $abono - $t->totalPago,2,".",",")}} <br>PT: ${{number_format($t->totalPago,2,".",",")}}</td>
										<td style="text-align:center;vertical-align: middle;"></td>
										<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
											<span class="dropdown">
												<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
													data-toggle="dropdown" aria-expanded="true"> <i
													class="fas fa-list"></i>
												</button>
												<div class="dropdown-menu dropdown-menu-right">
												<?php if($t->estatus!="CANCELADA"){ ?>
													<a class="btn btn-brand btn-elevate btn-icon-sm btn-verde" data-id="{{$t->nota_id}}|{{$t->precio - $abono - $t->totalPago}}" id="modalanticiposbtn" style="width:100%;color:white; " >
													Pago
													</a>
													<?php } ?>
													<a href="/gestion-factura/ver/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
														<i class="la la-eye"></i> Ver
													</a>
													<?php
													$auth = Session::get('Facturacion');
													if($auth == null)
													{$auth=0;}
													else {$auth = $auth[0]->ver;}
													if ($auth): ?>
													<a href="/gestion-factura/enviarhistorico/{{$t->nota_id}}" class="dropdown-item ">
														<i class="la la-edit"></i> Mandar a histórico
													</a>
													<a href="/osg/fecha-cancelada/{{$t->nota_id}}" class="dropdown-item ">
														<i class="fas fa-ban"></i> Cancelar
													</a>
													<?php endif ?>
													<a href="/gestion-factura/pdf/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
														<i class="fas fa-print"></i> PDF
													</a>
													<?php
													$auth = Session::get('Facturacion');
											   if($auth == null){$auth=0;}
													else {$auth = $auth[0]->eliminar;}
											      if ($auth): ?>
													<a id="borrar-nota" data-id="{{$t->nota_id}}" class="dropdown-item">
														<i class="la la-trash"></i> Eliminar
													</a>
													<?php endif ?>

												</div>
											</span>
										</td>
									</tr>
									<?php endif; ?>
									@endforeach
								</tbody>
							</table>
						</div>
            <!-------------------------------------------------CANCELADAS------------------------------------------------------------>
						<div class="table-responsive p-1" id="carpeta-canceladas" style="display: none;">
												<table class="table table-sm table-hover" id="OS_DataTable">
													<thead class="thead-light">
														<tr>
															<!-- <th>#ID</th> -->
															<th style="text-align:center;">#Documento</th>
															<th style="text-align:center;">Orden</th>
															<th style="text-align:center; width:13%;">Emisión</th>
															<th style="text-align:center; ">Cliente</th>
															<th>Aseguradora</th>
															<th style=" width: 17%;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
															<th style="text-align:center;">Estatus</th>
															<th style="text-align:center;">Importe</th>
															<th style="text-align:center;">RFC</th>
															<th style="width: 3%;"></th>
														</tr>
													</thead>
													<tbody>
													@foreach($tot as $key => $t)
													<?php if ($t->estatus=="CANCELADA" && $t->fecha_historico_rem==null): ?>
														<tr>
															<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
																<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
																 N - {{$t->nota_id}}
																 </td>
															<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a> </td>
															<td style="text-align:center;vertical-align: middle;">
															<p class="m-0" data-toggle="popover" data-trigger='hover'
															data-placement="top" data-content="Fecha generación de nota">
															<i class="fas fa-circle" style="color: #339af0;"></i>
															{{$t->fecha_nota}}
															</p>
															@isset($t->fecha_abono )
															<p class="m-0" data-toggle="popover" data-trigger='hover'
															data-placement="top" data-content="Fecha Abono">
															<i class="fas fa-caret-square-right" style="color: green;"></i>
															{{ $t->fecha_abono ?? ''}}
															</p>
															@endisset
															</td>
															<?php $vhc=explode("|", $t->nomb_cliente);?>
															<td style="text-align:center;vertical-align: middle;">{{$vhc[0]}}<br>{{$vhc[1]}} </td>
															<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
															<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
															<?php $vhc=explode("|", $t->detallesVehiculo);?>
															<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
															<td style="text-align:center;vertical-align: middle;">
																<?php if(isset($t->estatus)): ?>
																	<?php if($t->fecha_historico != NULL && $t->estatus == 'PAGADO'): ?>
																	{{$t->estatus}}<br>
																		Historico - {{$t->nomb_forma_pago}}
																	<?php else: ?>
																		{{$t->estatus}}<br>
																		{{$t->nomb_forma_pago}}
																	<?php endif; ?>
																<?php else: ?>
																	<?php if($t->fecha_historico != NULL && $t->nomb_forma_pago = 'Contado'): ?>
																		Pagado<br>
																		Historico - {{$t->nomb_forma_pago}}
																	<?php else: ?>
																		Pendiente<br>
																		{{$t->nomb_forma_pago}}
																	<?php endif; ?>
																<?php endif; ?>
															</td>
															<?php $abono = ($t->abono != 0) ? $t->abono: 0;   ?>
															<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->precio,2,".",",")}} <br>P: ${{number_format($t->precio - $abono - $t->totalPago,2,".",",")}} <br>PT: ${{number_format($t->totalPago,2,".",",")}}</td>
															<td style="text-align:center;vertical-align: middle;"></td>
															<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
																<span class="dropdown">
																	<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
																		data-toggle="dropdown" aria-expanded="true"> <i
																		class="fas fa-list"></i>
																	</button>
																	<div class="dropdown-menu dropdown-menu-right">
																	<?php if($t->estatus!="CANCELADA"){ ?>
																		<a class="btn btn-brand btn-elevate btn-icon-sm btn-verde" data-id="{{$t->nota_id}}|{{$t->precio - $abono - $t->totalPago}}" id="modalanticiposbtn" style="width:100%;color:white; " >
																		Pago
																		</a>
																		<?php } ?>
																		<a href="/gestion-factura/ver/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
																			<i class="la la-eye"></i> Ver
																		</a>
																		<?php
																		$auth = Session::get('Facturacion');
																		if($auth == null)
																		{$auth=0;}
																		else {$auth = $auth[0]->ver;}
																		if ($auth): ?>
																		<a href="/gestion-factura/enviarhistorico/{{$t->nota_id}}"class="dropdown-item ">
																			<i class="la la-edit"></i> Mandar a histórico
																		</a>
																		<a href="/osg/fecha-cancelada/{{$t->nota_id}}" class="dropdown-item ">
																			<i class="fas fa-ban"></i> Cancelar
																		</a>
																		<?php endif ?>
																		<a href="/gestion-factura/pdf/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
																			<i class="fas fa-print"></i> PDF
																		</a>
																		<?php
																		$auth = Session::get('Facturacion');
																		if($auth == null)
																		{$auth=0;}
																		else {$auth = $auth[0]->eliminar;}
																		if ($auth): ?>
																		<a id="borrar-nota" data-id="{{$t->nota_id}}" class="dropdown-item">
																			<i class="la la-trash"></i> Eliminar
																		</a>
																		<?php endif ?>
																	</div>
																</span>
															</td>
														</tr>
															<?php endif; ?>
														@endforeach
														@foreach($factura as $key => $t)
															<?php if ($t->estatus=="CANCELADA"): ?>
														<tr>
															<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
																<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
																F - {{$t->folio}}
															</td>
															<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a></td>
															<td style="text-align:center;vertical-align: middle;">
															<p class="m-0" data-toggle="popover" data-trigger='hover'
															data-placement="top" data-content="Fecha generación de nota">
															<i class="fas fa-circle" style="color: #339af0;"></i>
															{{$t->fecha}}
															</p>
															@isset($t->fecha )
															<p class="m-0" data-toggle="popover" data-trigger='hover'
															data-placement="top" data-content="Fecha Abono">
															<i class="fas fa-caret-square-right" style="color: green;"></i>
															{{ $t->fecha ?? ''}}
															</p>
															@endisset
															</td>
															<?php $vhc=explode("|", $t->nomb_cliente);?>
															<td style="text-align:center;vertical-align: middle;">{{$vhc[0]}}&nbsp{{$vhc[1]}} </td>
															<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
															<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
															<?php $vhc=explode("|", $t->detallesVehiculo);?>
															<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
															<td style="text-align:center;vertical-align: middle;">{{$t->estatus}}</td>
															<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->total,2,".",",")}}</td>
															<td style="text-align:center;vertical-align: middle;"></td>
															<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
																<span class="dropdown">
																	<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
																		data-toggle="dropdown" aria-expanded="true"> <i
																		class="fas fa-list"></i>
																	</button>
																	<div class="dropdown-menu dropdown-menu-right">
																	<?php if($t->estatus!="CANCELADA"){ ?>
																		<a href="/gestion-factura/pdf/Factura/{{$t->gos_docventa_id}}" target="_blank" class="dropdown-item ">
																			<i class="fas fa-print"></i> PDF
																		</a>
																		<a href="/gestion-factura/pdf/XML/{{$t->gos_docventa_id}}" class="dropdown-item ">
																			<i class="fas fa-print"></i> XML
																		</a>
																		<?php
																		$auth = Session::get('Facturacion');
																		if($auth == null)
																		{$auth=0;}
																		else {$auth = $auth[0]->eliminar;}
																		if ($auth): ?>
																		<a href="/cancelar-factura/{{$t->gos_docventa_id}}" class="dropdown-item">
																			<i class="fas fa-ban"></i> Cancelar
																		</a>
																		<?php endif ?>

																	<?php } else{ ?>
																		<a href="/gestion-factura/pdf/XMLCancelada/{{$t->gos_docventa_id}}" class="dropdown-item ">
																			<i class="fas fa-print"></i> XML
																		</a>
																	<?php } ?>
																	</div>
																</span>
															</td>
														</tr>
															<?php endif; ?>
														@endforeach
													</tbody>
												</table>
						      </div>
        <!-----------------------------------------------------HISTORICO---------------------------------------------------------->
					 <div class="table-responsive p-1" id="carpeta-historico" style="display: none;">
										<table class="table table-sm table-hover" id="OS_DataTable">
											<thead class="thead-light">
												<tr>
													<!-- <th>#ID</th> -->
													<th style="text-align:center;">#Documento</th>
													<th style="text-align:center;">Orden</th>
													<th style="text-align:center; width:13%;">Emisión</th>
													<th style="text-align:center; ">Cliente</th>
													<th>Aseguradora</th>
													<th style=" width: 17%;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
													<th style="text-align:center;">Estatus</th>
													<th style="text-align:center;">Importe</th>
													<th style="text-align:center;">RFC</th>
													<th style="width: 3%;"></th>
												</tr>
											</thead>
											<tbody>
											@foreach($tot as $key => $t)
											<?php if ($t->fecha_historico_rem!=null): ?>
												<tr>
													<td style="text-align:center;vertical-align: middle;">	<?php if($t->estatus=="CANCELADA"){ ?>
														<i class="fas fa-ban" style="color:red;"></i> <?php } ?>
														 N - {{$t->nota_id}}
														 </td>
													<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a> </td>
													<td style="text-align:center;vertical-align: middle;">
													<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha generación de nota">
													<i class="fas fa-circle" style="color: #339af0;"></i>
													{{$t->fecha_nota}}
													</p>
													@isset($t->fecha_abono )
													<p class="m-0" data-toggle="popover" data-trigger='hover'
													data-placement="top" data-content="Fecha Abono">
													<i class="fas fa-caret-square-right" style="color: green;"></i>
													{{ $t->fecha_abono ?? ''}}
													</p>
													@endisset
													</td>
													<?php $vhc=explode("|", $t->nomb_cliente);?>
													<td style="text-align:center;vertical-align: middle;">{{$vhc[0]}}<br>{{$vhc[1]}} </td>
													<?php $asg=explode("|", $t->nomb_aseguradora_min);?>
													<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
													<?php $vhc=explode("|", $t->detallesVehiculo);?>
													<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
													<td style="text-align:center;vertical-align: middle;">
														<?php if(isset($t->estatus)): ?>
															<?php if($t->fecha_historico != NULL && $t->estatus == 'PAGADO'): ?>
															{{$t->estatus}}<br>
																Historico - {{$t->nomb_forma_pago}}
															<?php else: ?>
																{{$t->estatus}}<br>
																{{$t->nomb_forma_pago}}
															<?php endif; ?>
														<?php else: ?>
															<?php if($t->fecha_historico != NULL && $t->nomb_forma_pago = 'Contado'): ?>
																Pagado<br>
																Historico - {{$t->nomb_forma_pago}}
															<?php else: ?>
																Pendiente<br>
																{{$t->nomb_forma_pago}}
															<?php endif; ?>
														<?php endif; ?>
													</td>
													<?php $abono = ($t->abono != 0) ? $t->abono: 0;   ?>
													<td style="text-align:center;vertical-align: middle;">T: ${{number_format($t->precio,2,".",",")}} <br>P: ${{number_format($t->precio - $abono - $t->totalPago,2,".",",")}} <br>PT: ${{number_format($t->totalPago,2,".",",")}}</td>
													<td style="text-align:center;vertical-align: middle;"></td>
													<td style="width: 3%; text-align:center;vertical-align: middle;"><span class="dropdown">
														<span class="dropdown">
															<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
																data-toggle="dropdown" aria-expanded="true"> <i
																class="fas fa-list"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="/gestion-factura/ver/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
																	<i class="la la-eye"></i> Ver
																</a>
																<?php
																$auth = Session::get('Facturacion');
																if($auth == null) { $auth=0;}
																else { $auth = $auth[0]->ver;}
																if ($auth): ?>
																<a  href="/gestion-factura/Recuperarhistorico/{{$t->nota_id}}" class="dropdown-item ">
																	<i class="la la-edit"></i> Restablecer
																</a>
																<?php endif ?>
																<a href="/gestion-factura/pdf/NotaRemision/{{$t->nota_id}}" class="dropdown-item ">
																	<i class="fas fa-print"></i> PDF
																</a>
																<?php $auth = Session::get('Facturacion');if($auth == null) {$auth=0; }
																else {
																	$auth = $auth[0]->eliminar;
																}
																if ($auth): ?>
																<a id="borrar-nota" data-id="{{$t->nota_id}}" class="dropdown-item">
																	<i class="la la-trash"></i> Eliminar
																</a>
																<?php endif ?>
															</div>
														</span>
													</td>
												</tr>
												<?php endif; ?>
												@endforeach
											</tbody>
										</table>
									</div>

						</div>
					  </div>

			</div>

		</div>
	</div>

<!-----------------------------------------------------------Anticipos------------------------------------------------>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalanticipos">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
       			<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card">
				<div class="card-body">
					<form class="" action="/pagar-nota-remision" method="post">
						@csrf
						<div class="row">
							<div class="col-3 ">
								<label >Tipo de Pago</label>
								<input type="hidden" class="form-control" name="nota_id" id="nota_id" >
								<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id" required>
									<option></option>
									@foreach ($listaMetodosPagos as $metodopago)
									<option value="{{$metodopago->gos_metodo_pago_id}}"
									{{( ($compra->gos_metodo_pago_id ?? '') == $metodopago->gos_metodo_pago_id ? 'selected' : '')}}>
									{{$metodopago->nomb_met_pago}}
									</option>
									@endforeach
								</select>
							</div>
							<div class="col-3 ">
								<label >Monto de pago</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text p-0">$</span>
									</div>
									<input type="number" class="form-control" name="monto_abono" id="monto_abono" required>
								</div>
							</div>
							<div class="col-3 ">
								<label>Monto restante</label>
								<input type="text" class="form-control kt_datepicker_2" name="monto_restante" id="monto_restante" disabled>
							</div>
							<div class="col-3 ">
								<label >Fecha de pago</label>
								<input type="text" class="form-control kt_datepicker_2" name="fecha_abono" id="fecha_abono" required>
							</div>

							<div class="col-12 ">
								<label >Observaciones</label>
								<input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
							</div>
							<div class="col-12 pt-2">
								<button type="submit" id="btn-AnticipoOS" class="btn btn-success btn-block" style="height:35.6px;" >
									<i class="fas fa-plus p-0" style="color: white!important;"></i>
								</button>
							</div>
						</div>
					</form>
      			</div>
    	  	</div>
		</div>
  	</div>
</div>

<!------------------------------------------------------------------------Anticipos END---------------------------------------------------------------------------->

<!----------------------------------- modal facturacion------------------------------------------------>
	<div class="modal fade" id="modalFacturacion" role="dialog">
	 	<div class="modal-dialog modal-m modal-l" role="document">
	    	<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="titleModalFacturacion"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
	      		<div class="modal-body">

					<form id="facturacionForm">
						@csrf
						<input type="hidden" name="gos_lic_facturacion_id" id="gos_lic_facturacion_id">
						<div class="kt-portlet kt-portlet--tabs">

							<div class="kt-portlet__body">
								<div class="tab-content">
								<!--DATOS DEL facturacion-->
									<div class="tab-pane active" id="facturacionDatos" role="tabpanel">
										<div class="form-row">
	                                    <div class="form-group col-12">
												<label style="font-size: 1rem;">Importe a pagar</label>
												<input type="text" class="form-control" name="importe" id="importe"/>
	                      	                <small style="font-style: italic;" class="importe form-text text-danger"></small>
											</div>
											<div class="form-group col-12">
												<label style="font-size: 1rem;">Por pagar </label>
	                                            <input type="text" class="form-control" name="pagar" id="pagar"/>
	                      	                    <small style="font-style: italic;" class="pagar form-text text-danger"></small>
											</div>
	                                        <div class="form-group col-12">
												<label style="font-size: 1rem;">Forma de pago </label>
												<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="forma_pago" id="forma_pago">

	                                                <option value="0"></option>
	                                                <option value="1">Efectivo</option>
	                                            </select>
	                    	                    <small style="font-style: italic;" class="forma_pago form-text text-danger"></small>
											</div>
											<div class="form-group col-12">
	                                            <label style="font-size: 1rem;">Fecha de pago </label>
	                                        	<div class="input-group date">
													<input type="text" class="form-control kt_datepicker_2" name="fecha_pago" id="fecha_pago" readonly="">
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar-check-o"></i>
														</span>
													</div>
												</div>
	                      	                   <small style="font-style: italic;" class="fecha_pago form-text text-danger"></small>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__foot p-2">
							<button type="button" class="btn btn-success btn-block" id="btn-guardar-facturacion">Guardar</button>
						</div>
						<input type="hidden" id="app_url" name="app_url" url=".." />
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal-->
<!---------------------------------------------------------------------------Facturacion Multiple---------------------------------------------------------->

<link rel="stylesheet" href="css/pick-a-color-1.2.3.min.css">
<div class="modal fade" id="modalFacturacionMultiple" role="dialog">
 	<div class="modal-dialog modal-m modal-l" role="document">
    	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalFacturacionMultiple"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
      		<div class="modal-body">

				<form id="facturacionMultipleForm" action="/pagos-multiples" method="post">
					@csrf
					<div class="kt-portlet kt-portlet--tabs">

						<div class="kt-portlet__body">
							<div class="tab-content">
							<!--DATOS DEL mensaje-->
								<div class="tab-pane active" id="mensajeDatos" role="tabpanel">
									<div class="form-row">
                                    <div class="form-group col-12">
											<label style="font-size: 1rem;">Monto</label>
											<input type="text" class="form-control" name="cantidad" id="cantidad" required/>
                      	               	 	<small style="font-style: italic;" class="cantidad form-text text-danger"></small>
										</div>
										<div class="form-group col-12">
                                            <label style="font-size: 1rem;">Fecha de pago </label>
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker_2" name="fecha" id="fecha" readonly="" required>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar-check-o"></i>
													</span>
												</div>
											</div>
                      	                   <small style="font-style: italic;" class="fecha form-text text-danger"></small>
										</div>
										<div class="form-group col-12">
											<select class="custom-select" name="gos_metodo_pago_id" id="gos_metodo_pago_id" required>
												<option value="01">Efectivo</option>
												<option value="02">Cheque nominativo</option>
												<option value="03">Transferencia electrónica de fondos</option>
												<option value="04">Tarjeta de crédito</option>
												<option value="05">Monedero electrónico</option>
												<option value="06">Dinero electrónico</option>
												<option value="08">Vales de despensa</option>
												<option value="12">Dación en pago</option>
												<option value="13">Pago por subrogación</option>
												<option value="14">Pago por consignación</option>
												<option value="15">Condonación</option>
												<option value="17">Compensación</option>
												<option value="23">Novación</option>
												<option value="24">Confusión</option>
												<option value="25">Remisión de deuda</option>
												<option value="26">Prescripción o caducidad</option>
												<option value="27">A satisfacción del acreedor</option>
												<option value="28">Tarjeta de débito</option>
												<option value="29">Tarjeta de servicios</option>
												<option value="30">Aplicación de anticipos</option>
												<option value="31">Intermediario pagos</option>
												<option value="99">Por definir</option>
											</select>
										</div>
                                        <div class="form-group col-12">
                                            <label style="font-size: 1rem;">Observaciones </label>

                                            <textarea type="date" class="form-control" name="observaciones" id="observaciones"></textarea>
                      	                   <small style="font-style: italic;" class="observaciones form-text text-danger"></small>
										</div>
                                        <div class="table-responsive p-1">
                                        <table class="table table-sm table-hover" id="dt-facturacion-multiple">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th></th>
                                                    <th>#Orden</th>
                                                    <th>#Factura</th>
                                                    <th>Total</th>
                                                    <th style="width: 3%;"></th>
                                                </tr>
                                            </thead>
											<tbody>
											<?php $total = 0?>
											@foreach($factura as $key => $t)
											<?php if($t->estatus == "PENDIENTE"){?>
												<?php if($t->metodo_pago == "PPD"){?>
											<tr>
												<td style="text-align:center;vertical-align: middle;"><input type="checkbox" value="{{$t->gos_docventa_id}}" name="ordenes[]"></td>
												<td style="text-align:center;vertical-align: middle;"><a href="orden-servicio-generada/{{$t->gos_os_id}}">#{{$t->nro_orden_interno}}</a></td>
												<td style="text-align:center;vertical-align: middle;">F - {{$t->folio}}</td>
												<td style="text-align:center;vertical-align: middle;">{{$t->total}}</td>
											</tr>
											<?php $total += $t->total;  } }  ?>
										@endforeach</tbody>
                                        </table>
                                    </div>
									<label>{{$total}}</label>

									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="kt-portlet__foot p-2">
						<button type="submit" class="btn btn-success btn-block" id="btn-guardar-facturacion-multiple">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('ScriptporPagina')
<script>$(function(){$('[data-toggle="popover"]').popover()}); </script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
	<script src="../gos/ajax-facturacion.js"></script>
	<script>

	$('body').on('click','#modalanticiposbtn',function() {
		var id=$(this).data("id");
		$('#modalanticipos').modal('show');
		splitted = id.split('|');
		$(".modal-title").text("Pago N - "+splitted[0]);
		$("#nota_id").val(splitted[0]);
		$("#monto_restante").val(splitted[1]);
		$("input").attr({
			"max" : splitted[1],
			"min" : 1
		});

	});



	$('body').on('click','#borrar-nota',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar?!')) {
			$.ajax({
				url : '/gestion-factura/delete/NotaRemision/'+ id,
				success : function(data) {
					location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});
	</script>
@endsection
