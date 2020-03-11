<div class="modal fade  bd-example-modal-xl" id="modalbuscarcliente" tabindex="-1"
	role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="" id="exampleModalLabel">Búsqueda de Cliente/Vehículo </h6>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">
					@include('Layout/errores')
				<div class="table-responsive">
					<table class="table table-hover table-sm" id="dt-clientes-vehiculos">
						<thead class="thead-light">
							<tr>
								<th class="h6 kt-font-bold p-2">Orden</th>
								<th class="h6 kt-font-bold p-2">Cliente</th>
								<th class="h6 kt-font-bold p-2">Vehiculo</th>
								<th class="h6 kt-font-bold p-2">Aseguradora</th>
								<th class="h6 kt-font-bold p-2">#Poliza</th>
								<th class="h6 kt-font-bold p-2">#Reporte</th>
								<th class="h6 kt-font-bold p-2">#Siniestro</th>
								<th class="h6 kt-font-bold p-2">gos_vehiculo_id</th>
								<th class="h6 kt-font-bold p-2">gos_cliente_id</th>
								<th class="h6 kt-font-bold p-2">Seleccionar</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
