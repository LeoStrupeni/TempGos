@extends('Layout')

@section('Content')
<div class="container-fluid">
	@if (session('notification'))
	<div class="alert alert-success">
		{{session('notification')}}
	</div>
	@endif
	@if (count($errors)>0)
	<div class="alert alert-danger">
		<ul>
		<?php foreach ($errors->all() as $error): ?>
			<li>{{ $error }}</li>
		<?php endforeach; ?>
		</ul>
	</div>
	@endif
</div>
<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-primary">
				Permisos
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<form action="/permisos_post" method="post">
				@csrf
				<div class="row">
					<div class="col-3">
						<!-- voy a dejar este boton comentado por si algo falla -->
						<!--
						 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAgregar">Agregar</button>
						-->
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="kt-portlet__body p-2">
		<div class="table-responsive ">
			<table class="table table-sm table-hover datatablaList" id="dt-permisos-equipo-trabajo">
				<thead>
					<tr>
						<th>Perfil</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
				<tbody>
          		@foreach ($perfiles as $perfil)
              		<tr>
						<td> {{$perfil->nomb_perfil}}</td>
						<td class="text-center" style="width:3%;">
							<span class="dropdown">
								<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
									<i class="la la-ellipsis-h"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
								<?php if (Session::get('usr_Data.gos_usuario_perfil_id') == 51): ?>
									<a href="/permisos/editar/{{$perfil->gos_usuario_perfil_id}}/perfil" data-toggle="tooltip" data-id="{{$perfil->gos_usuario_perfil_id}}" data-original-title="Editar" class="dropdown-item btnEditarPermiso">
										<i class="la la-edit"></i> Editar
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
	</div>
</div>

<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@include('Permisos/modalAgregar')

@endsection

@section('ScriptporPagina')

@endsection
