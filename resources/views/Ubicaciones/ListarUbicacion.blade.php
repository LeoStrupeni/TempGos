@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Ubicaciones
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<?php

					$auth = Session::get('Inventario');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="nuevaUbicacion" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="table-responsive">
        <table class="table table-sm table-hover" id="dt-Ubicaciones">
				<thead class="thead-light">
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
@include('Ubicaciones/modalUbicacion')
@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/InventarioInterno/ajax-ubicaciones.js"></script>
@endsection
