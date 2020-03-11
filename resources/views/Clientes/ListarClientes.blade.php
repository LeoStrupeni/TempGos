{{-- @php
	dd($this);
@endphp --}}

@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Clientes</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">

					<?php

					$auth = Session::get('Clientes');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="crear-cliente" style="width:150px;" type="button"><i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
						<?php endif ?>

					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="table-responsive">
			<!--begin: Datatable -->
			<table class="table table-sm table-hover " id="dt-clientes">
				<thead class="thead-light">
					<tr>
						<th>ID</th>
						<th>Clientes</th>
						<th>Empresa</th>
						<th>Autos</th>
						<th>Ordenes</th>
						<th class="text-center" style="width: 3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
@include('Clientes/modalCliente')
@include('Clientes/ModalOS')
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@include('Clientes/ModalVehiculos')

@endsection
@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/ajax-clientes_Val.js"></script>
@endsection
