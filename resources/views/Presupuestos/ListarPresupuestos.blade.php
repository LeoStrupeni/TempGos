@extends('Layout')
@section('Content')

<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
<link rel="stylesheet" href="../gos/css/menu_vertical.css">
<link rel="stylesheet" href="../gos/css/circulo_vehiculo.css">

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Presupuestos</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
        		<div class="kt-portlet__head-actions">
							<?php

							$auth = Session::get('Presupuestos');

							if($auth == null)
							{
								$auth=0;

							}
							else {
								$auth = $auth[0]->agregar;
							}

							if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" type="button"  style="width:150px;" id="crear-nuevo-presupuesto">
					<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
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
							<div class="vertical-menu">
								<a1 href="" class="active">Carpetas</a1>
								<a href="/ListarPresupuestos" >Todos<span class="badge badge-light">{{$todos ??''}}</a>
								<a href="/ListarPresupuestos/0/carpeta">Pendientes<span class="badge badge-light">{{$prendientes ??''}}</a>
								<a href="/ListarPresupuestos/1/carpeta">Unidas<span class="badge badge-light">{{$unidos ??''}}</a>
								<a href="/ListarPresupuestos/2/carpeta">Procesados<span class="badge badge-light">{{$procesados ??''}}</span></a>

							</div>
					</div>
					<div class='col col-sm-10'>
						<div class="table-responsive table-sm  p-1">
									<!--begin: Datatable -->
							<table class="table table-sm table-hover datatablaList" id="PresupuestosDataTable" style="font-size: 1rem;">
								<thead class="thead-light">
									<tr style="font-weight: 500;">

										<th>Fecha</th>
										<th>Cotizacion</th>
										<th>Cliente</th>
										<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
										<th>Total</th>

										<th>Acciones</th>
										<th class="text-center" style="width: 3%;"></th>
									</tr>
								</thead>

								<tbody>

									@foreach($gos_v_press as $p)
									<tr>
											<td>{{$p->fecha}}</td>
											<td>{{$p->gos_pres_id}}</td>


										<td>
											<?php  $cliente = explode("|",$p->gos_cliente_id); 	?>
											<div class="">
													<label>{{$cliente[0]}}</label>
											</div>
											<div class="">
												<label>{{$cliente[1]}}</label>
											</div>
								  	</td>



										<td>
												<?php $vehiculo = explode("|",$p->gos_vehiculo_id) ?>
                           <label for="">color: <i class="fas fa-circle icon-2x" style="color: #{{$vehiculo[0]}}; font-size: 1.5rem;"></i> </label> <br>
													    <label for="">  {{$vehiculo[1]}}</label> <br>
															   <label for="">{{$vehiculo[2]}}</label> <br>
																 <label for="">{{$vehiculo[3]}}</label>




			             	</td>


											<td>{{$p->total}}</td>


											<td>
												<?php if ($p->gos_pres_estatus > 0): ?>
													<button type="button" data-toggle="tooltip" data-placement="top" title="Unir"  class="btn btn-primary btn-sm" onclick="Unirmodal({{ $p->gos_pres_id }})"><i class="fas fa-paste"></i></button>

												<?php else: ?>
													<button style="margin-left: 2px;" type="button" data-toggle="tooltip" data-placement="top" title="Procesar"class="btn btn-primary btn-sm" onclick="Procesarmodal('+data+')"><i class="fas fa-cog"></i></button>
												<?php endif; ?>

											</td>



											<td>
												<span class="dropdown"> <a href="javascript:void(0);"
													class="btn btn-sm btn-clean btn-icon btn-icon-md"
													data-toggle="dropdown" aria-expanded="true"> <i
														class="la la-ellipsis-h"></i>
												</a>
													<div class="dropdown-menu dropdown-menu-right">

														<a href="/Presupuestos/{{ $p->gos_pres_id }}/Imprimir" target="_blank" data-toggle="tooltip"
															data-id="{{ $p->gos_pres_id }}" data-original-title="Editar"
															class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-print"></i>
															Imprimir
														</a>
														<a href="/Presupuestos/{{ $p->gos_pres_id }}/Imprimir/HV" target="_blank" data-toggle="tooltip"
															data-id="{{ $p->gos_pres_id }}" data-original-title="Editar"
															class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-car"></i>
															Hoja Viajera
														</a>
														<a href="/Presupuestos/{{ $p->gos_pres_id }}/Ver" data-toggle="tooltip"
															data-id="{{ $p->gos_pres_id }}" data-original-title="Editar"
															class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-eye"></i>
														  Ver
														</a>

														<?php $auth = Session::get('Presupuestos'); if($auth == null){$auth=0;	}else {	$auth = $auth[0]->editar;}if ($auth): ?>
														<a href="/Presupuestos/{{ $p->gos_pres_id }}/Editar" data-toggle="tooltip"
															data-id="{{ $p->gos_pres_id }}" data-original-title="Editar"
															class="dropdown-item btnEditarPresupuesto"> <i class="la la-edit"></i>
															Editar
														</a>
														<?php endif ?>


														<?php	$auth = Session::get('Presupuestos');if($auth == null)	{$auth=0;}	else {$auth = $auth[0]->eliminar;}if ($auth): ?>
												    <a href="/Presupuestos/{{ $p->gos_pres_id }}/Borrar" id="borrarPresupuesto"
															data-toggle="tooltip" data-original-title="Delete"
															data-id="{{ $p->gos_pres_id }}" class="delete dropdown-item"> <i
															class="la la-trash"></i> Borrar
														</a>
														<?php endif ?>
													</div>
												</span>
											</td>




									</tr>

									@endforeach
								</tbody>
							</table>
							<!--end: Datatable -->
						</div>
					</div>
				</div>
			</div>
  		</div>
    </div>
</div>



  {{-- Modals --}}
  <div class="modal fade" id="modal-presupuesto-unir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titleModalPresupuestoUnir"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
						<div class="form-group">
							<label for="recipient-name" class="form-control-label">Unir Orden de Servicio</label><br><br>
            <button type="button" data-toggle="tooltip" data-placement="top" title="Procesar"  class="btn btn-primary btn-block" onclick="UnirPost();">Unir</button>
						</div>

          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-block" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
  </div>

	<div class="modal fade" id="modal-presupuesto-procesar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
					<div class="modal-body">
						<div class="form-group">
							<label for="recipient-name" class="form-control-label">Procesar Orden de Servicio</label><br><br>
            <button type="button" data-toggle="tooltip" data-placement="top" title="Procesar"  class="btn btn-primary btn-block" onclick="ProcesarPost();">Procesar</button>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-block" data-dismiss="modal">Cerrar</button>
					</div>
			</div>
		</div>
	</div>



@endsection

@section('ScriptporPagina')
	<script src="../gos/ajax-presupuestos.js"></script>
	<script src="../gos/ajax-presupuesto-items.js"></script>
@endsection
