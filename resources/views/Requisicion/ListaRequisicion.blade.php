@extends('Layout')

@section('estiloPorPagina')
@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Requisiciones</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<?php

					$auth = Session::get('Compras');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
                    <button class="btn btn-brand btn-elevate btn-icon-sm nuevaRequisicion" style="width:150px;" type="button">
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
					<div class='col'>
						<div class="table-responsive">
							<table class="table table-sm table-hover" id="dt-requisiciones">
								<thead class="thead-light">
									<tr>
										<th># Requisición</th>
										<th>Fecha</th>
										<th>Proveedor</th>
										<th>Responsable</th>
										<th># Orden</th>
										<th>Vehiculo</th>
                                        <th class="text-center">Pasar a Compra</th>
                                        <th></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('Requisicion/ModalRequisicion')
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@endsection

@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/ajax-requisicion.js"></script>
@endsection
