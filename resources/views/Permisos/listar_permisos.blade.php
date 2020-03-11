@extends('Layout')

@section('Content')

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
          			<div class="col-9">
						<select class="form-control" name="selectPermisos">
		 					@foreach ($perfiles as $perfil)
							<option value="{{$perfil->gos_usuario_perfil_id}}">{{$perfil->nomb_perfil}}</option>
		 					@endforeach
		 				 </select>
          			</div>
					<div class="col-3">
             			<button type="submit" class="btn btn-secondary btn-md" >Ver</button>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAgregar">Agregar1</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="kt-portlet__body p-2">
		<div class="table-responsive">
			<table class="table table-sm table-hover" id="dt-permisos-equipo-trabajo">
				<thead class="thead-dark">
					<tr>
						<th>Perfil</th>
						<th>Tipo de Permiso</th>
						<th>agregar</th>
						<th>editar</th>
						<th>ver</th>
						<th>eliminar</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
				<tbody>
        			<?php foreach ($arraypermisos as $array): ?>
	          		<tr>
						<td>
                 		<?php foreach ($perfiles as $prf): ?>
                    		<?php if ($array[0]->gos_usuario_perfil_id==$prf->gos_usuario_perfil_id): ?>
                      		{{$prf->nomb_perfil}}
                    		<?php endif; ?>
                 		<?php endforeach; ?>
						</td>
						<td>{{$array[0]->tipo_permiso}}</td>
						<td> {{$array[0]->agregar}}</td>
						<td> {{$array[0]->editar}}</td>
						<td> {{$array[0]->ver}}</td>
						<td> {{$array[0]->eliminar}}</td>
           			</tr>
        			<?php endforeach; ?>
        		</tbody>
			</table>
		</div>
	</div>
</div>

<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@include('Permisos/ModalAgregar')

@endsection

@section('ScriptporPagina')

@endsection
