@extends( 'Layout' )
@section( 'Content' )

<!-- begin:: Content -->
<link rel="stylesheet" href="../gos/css/menu_vertical.css">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Compras</h3>
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
					<a href="{{route('gestion-compras.create')}}" class="btn btn-brand btn-elevate btn-icon-sm" id="nuevaCompra1" style="width:150px;">
						<i class="fa fa-plus kt-shape-font-color-1" ></i>Agregar
					</a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-1">
    	<div class="d-flex justify-content-between">
			<div class='container-fluid'>
				<div class ='row'>
					<div class='col col-sm-2'>
						<div class="vertical-menu">
							<a1 href="#" class="active">Carpetas</a1>
							<a class="{{$activeTodo ?? ''}}" href="/gestion-compras" >Todos<span class="badge badge-light">{{$cuentaTodos ??''}}</a>
							<a class="{{$activeAdeu ?? ''}}" href="/gestion-comp/Adeudo">Adeudo<span class="badge badge-light">{{$cuentaAdeudo ??''}}</a>
						</div>
					</div>
					<div class='col col-sm-10 p-0'>
						<div class="table-responsive">
							<table class="table table-sm table-hover text-center" id="dt-Compras">
								<thead class="thead-light">
								<tr>
									<th>Fechas</th>
									<th>Proveedor</th>
									<th># de compra</th>
									<th># de requisición</th>
									<th># de factura</th>
									<th># de orden(es)</th>
									<th>Tipo de la compra</th>
									<th>Total de la compra ($)</th>
									<th>Abonado</th>
									<th style="width:3%;"></th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade hide" id="PagoCompra" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 40%;min-width: 40%;">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title">Pago</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-2">
					<form id="pagarCompraForm">
						@csrf
						<div class="form-group row mb-1 align-items-center">
							<label class="col-5 pt-2 pl-4 text-nowrap">Saldo Pendiente</label>
							<div class="col-7">
								<input type="text" class="form-control form-control-sm text-center" id="saldo_PagoCompra" disabled>
							</div>
						</div>
						<small style="font-style: italic;" class="saldo_PagoCompra form-text text-danger text-center"></small>
						<div class="form-group row mb-1 align-items-center">
							<label class="col-5 pt-2 pl-4  text-nowrap"># de Compra</label>
							<div class="col-7">
								<input type="text" class="form-control form-control-sm text-center" name="gos_compra_id" id="gos_compra_id_PagoCompra" readonly>
							</div>
						</div>
						<div class="form-group row mb-1 align-items-center">
							<label class="col-5 pt-2 pl-4 text-nowrap">Tipo de pago compra</label>
							<div class="col-7">
								<select class="custom-select custom-select-sm" name="metodoPago" id="metodoPago">
									@foreach ($listaMetodosPagos as $metodopago)
									<option value="{{$metodopago->gos_metodo_pago_id}}">{{$metodopago->nomb_met_pago}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row mb-1 align-items-center">
							<label class="col-5 pt-2 pl-4  text-nowrap">Importe</label>
							<div class="col-7">
								<input type="text" class="form-control form-control-sm text-center" name="importe" id="importe_PagoCompra">
							</div>
						</div>
						<small style="font-style: italic;" class="importe_PagoCompra form-text text-danger text-center"></small>
						<div class="form-group row mb-1 align-items-center">
							<label class="col-5 pt-2 pl-4  text-nowrap">Fecha</label>
							<div class="col-7">
								<input type="date" class="form-control form-control-sm text-center" name="fecha" id="fecha_PagoCompra">
							</div>
						</div>
						<small style="font-style: italic;" class="fecha_PagoCompra form-text text-danger text-center"></small>
						<button type="button" class="btn btn-success btn-block" id="btn-PagoCompra">Cargar pago</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
</div>

@endsection
@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/ajax-compras.js"></script>
@endsection
