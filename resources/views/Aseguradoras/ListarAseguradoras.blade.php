@extends( 'Layout' )@section( 'Content' )

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title"> <?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></h3>
			
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
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="Aseguradora-Nuevo" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<table class="table table-sm table-hover" id="aseguradorasDataTable">
				<thead class="thead-light">
					<tr>
						<th>ID</th>
						<th>Empresa</th>
						<th># Ordenes generadas</th>
                        <th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@include ('Aseguradoras/modalAseguradora')

@endsection

@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/ajax-aseguradoras_Val.js"></script>
@endsection
