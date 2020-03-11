{{-- @php
	dd($listaPuertas,$tiposCombustubles,$listaCilindros,$coloresVehiculo,$coloresInterior,
		$listaMunicipios,$listaLocalidades,$listaColonias,$listaEstados,$listaVehiculos);
@endphp --}}

@extends('Layout')

@section('Content')
<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
<link rel="stylesheet" href="../gos/css/circulo_vehiculo.css">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-primary">
				<?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?>
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<?php

					$auth = Session::get('Vehiculos');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="nuevo-vehiculo" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>

	<div class="kt-portlet__body">
		<div class="table-responsive">
			<table class="table   table-sm table-hover " id="vehiculos-DataTable">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Nombre Cliente</th>
						<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
						<th># de Serie</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>





@include('Vehiculos/Modalvehiculo')

@endsection
@section('ScriptporPagina')
	<script src="../gos/ajax-vehiculos.js"></script>
@endsection
