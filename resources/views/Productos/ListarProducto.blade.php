@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Inventario Interno
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
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="btn-Nuevo-InventarioInterno" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-1">
		<div class="table-responsive">
			<!--begin: Datatable -->
      		<table class="table table-sm table-hover" id="dt-inventarioInterno">
				<thead class="thead-light">
					<tr>
						<th class="p-2 text-nowrap">ID</th>
						<th class="p-2 text-nowrap"><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marca<?php endif; ?></th>
						<th class="p-2 text-nowrap">Familia</th>
						<th class="p-2 text-nowrap">Proveedor</th>
						<th class="p-2 text-nowrap">Unidad de medida</th>
						<th class="p-2 text-nowrap">Codigo producto</th>
						<th class="p-2 text-nowrap">Nombre Producto</th>
						<th class="p-2 text-nowrap">Descripcion</th>
						<th class="p-2 text-nowrap">Codigo Sat</th>
						<th class="p-2 text-nowrap">Cantidad disponible</th>
						<th class="p-2 text-nowrap">Venta</th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
@include('Productos/modalProducto')
@include('Productos/modalHistorialVenta')

@endsection
@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/InventarioInterno/ajax-productos.js"></script>
@endsection
