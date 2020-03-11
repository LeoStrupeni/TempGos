@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				<?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?> <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?>
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
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="nuevaMarcaVehiculo" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="table-responsive">
            <!--begin: Datatable -->
            <table class="table table-sm table-hover" id="Marcas-DataTable">
				<thead class="thead-light">
					<tr>
						<th>ID</th>
            			<th><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></th>
						<th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
@include ('Vehiculos/ModalMarcaVehiculo')
@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/ajax-vehiculo-marcas.js"></script>
@endsection
