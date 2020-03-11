@extends('Layout')
{{-- @extends('Layout/Layout_Test2') --}}

@section('Content')

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<nav class="navbar navbar-light bg-light">
					<div class="text-left">
						<h2>Facturas</h2>
					</div>
					<div class="text-right">
						<div class="btn-group">
							<a href="{{-- {{ route('FacturasController.create') }} --}}" class="btn btn-info">Nueva</a>
						</div>
					</div>
				</nav>
				
				{{-- FILTROS DE PRODUCTOS --}}
				<nav class="navbar navbar-dark bg-dark" style="height: 55px;">
					<div class="col-4">
						<form action="{{-- {{route('FacturasController.edit')}} --}}" method="GET">
							<div class="form-group">
								<div class="input-group w-100">
									<input type="text" name="searchFact" class="form-control" placeholder="Search..." aria-label="Search...">
									<div class="input-group-append">
										<button class="btn btn-secondary btn-hover-brand" type="submit">
											<i class="fas fa-redo-alt"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-4">
						<form action="{{-- {{route('FacturasController.edit')}} --}}" method="GET">
							<div class="form-group">
								<div class="input-group w-100">
									<select class="custom-select" name="estadoFact" aria-label="Estado Facturas">
										<option value="">All</option>
										<option value="1">Pending</option>
										<option value="2">Delivered</option>
										<option value="3">Canceled</option>
										<option value="4">Success</option>
										<option value="5">Info</option>
										<option value="6">Danger</option>
									</select>
									<div class="input-group-append">
										<button class="btn btn-secondary btn-hover-brand" type="submit">
											<i class="fas fa-redo-alt"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-4">
						<form action="{{-- {{route('FacturasController.edit')}} --}}" method="GET">
							<div class="form-group">
								<div class="input-group w-100">
									<select class="custom-select" name="tipoFact" aria-label="Tipo Facturas">
											<option value="">All</option>
											<option value="1">Online</option>
											<option value="2">Retail</option>
											<option value="3">Direct</option>
									</select>
									<div class="input-group-append">
										<button class="btn btn-secondary btn-hover-brand" type="submit">
											<i class="fas fa-redo-alt"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</nav>

				<div class="row my-2">
					<div class="col-3">
						<div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-brand">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title text-center">
										Facturas Emitidas
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body text-center">
									<h2>1001</h2>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-brand">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title text-center">
										Monto Facturado
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body text-center">
									<h2>$ 1,299,100.00</h2>
							</div>
						</div>
					</div>
					<div class="col-3">
						<div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-success">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title text-center">
										Pagos Recibidos
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body text-center">
									<h2>$ 1,000,100.00</h2>
							</div>
						</div>
					</div>
					<div class="col-3">
						<div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-warning">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title text-center">
										Monto Pendiente
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body text-center">
									<h2>$ 299,000.00</h2>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col">
						<div class="table-container table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<th># Factura</th>
									<th># Orden Servicio</th>
									<th>Emision</th>
									<th>Cliente</th>
									<th>Aseguradora</th>
									<th>Vehiculo</th>
									<th>Forma</th>
									<th>Importe</th>
									<th>RFC</th>
								</thead>
								<tbody>
									@include('Facturacion/Ejemplos')
								</tbody>
							</table>
						</div>
						<div class="row text-center mx-auto mt-1">
							<div class="col-md-6 offset-5">
							{{-- {{$variable->links()}} --}}
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection
@section('ScriptporPagina')
	<script src="../gos/ajax-facturacion.js"></script>
@endsection
