@extends('Layout')

@section('Content')

<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-primary">
				Equipo de Trabajo
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-actions">
				<?php

				$auth = Session::get('edt');

				if($auth == null)
				{
					$auth=0;

				}
				else {
					$auth = $auth[0]->agregar;
				}

				if ($auth): ?>
				<button class="btn btn-brand btn-elevate btn-icon-sm nuevoUsuarioAdm" style="width:150px;" type="button">
					<i class="fa fa-plus kt-shape-font-color-1"></i>Administrativo
				</button>
				<button class="btn btn-brand btn-elevate btn-icon-sm nuevoUsuarioTecnico" style="width:150px;" type="button">
					<i class="fa fa-plus kt-shape-font-color-1"></i>Tecnico
				</button>
				
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-2">
		<div class="table-responsive">
			<table class="table table-sm table-hover" id="dt-equipo-trabajo">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Perfil</th>
						<th>Puesto</th>
						<th>Fecha</th>
						<th>Nombre</th>
						<th>Numero de empleado</th>
						<th>Numero de seguro social</th>
						<th>Email</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@include('EquipoTrabajo/ModalEquipoAdm')
@include('EquipoTrabajo/ModalEquipoTecnico')

@endsection

@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/EquipoTrabajo/ajax-equipo-trabajo.js"></script>
	<script src="{{env('APP_URL')}}/gos/EquipoTrabajo/ajax-usuario-admin.js"></script>
	<script src="{{env('APP_URL')}}/gos/EquipoTrabajo/ajax-usuario-tecnico.js"></script>
@endsection

{{-- @if ($empleado->nomb_rol == 'Adminstrador') {{action('Gos\UsuariosAdminController@edit',$empleado->gos_usuario_admin_id)}} @else {{action('Gos\UsuariosTecnicosController@edit',$empleado->gos_usuario_tecnico_id)}} @endif
@if ($empleado->nomb_rol == 'Adminstrador') {{action('Gos\UsuariosAdminController@destroy',$empleado->gos_usuario_admin_id)}} @else {{action('Gos\UsuariosTecnicosController@destroy',$empleado->gos_usuario_tecnico_id)}} @endif --}}
