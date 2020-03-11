<div class="modal fade" id="modalbuscarOS-compras" tabindex="-1"
	role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;min-width: 70%;">
		<div class="modal-content">
			<div class="modal-header p-1">
				<h6 class="m-0 pt-2 pl-3">Unir compra con orden</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 d-none" id="mjs-unido-oculto-Os">
						<p class="text-danger mb-2 text-center font-italic">Compra unida a la Orden de Servicio <a class="text-danger font-italic" id="vinculoOs"></a></p>
					</div>
					<div class="col-12 d-none" id="mjs-unido-oculto-Adm">
						<p class="text-danger mb-2 text-center font-italic">No puede unir una compra administrativa a una Orden de servicio</p>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-sm" id="dt-OS-compras">
						<thead class="thead-light">
							<tr>
								<th class="p-2 text-center" width="10%">Orden</th>
								<th class="p-2 text-center" width="50%">Vehículo</th>
								<th class="p-2 text-center" width="30%">Cliente</th>
								<th class="p-2 text-center" width="10%">Unir</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($listadoOSProceso as $os)
							<tr>
								<td class="p-2 text-center">{{'# '.$os->nro_orden_interno}}</td>
								<td>
									@php $vehiculo = explode('|', $os->detallesVehiculo);@endphp
									<i class="fas fa-circle" style="color: #"{{$vehiculo[0].';'}}></i>{{' '.$vehiculo[1]}}<br>{{$vehiculo[2]}}<br>{{$vehiculo[3]}}
								</td>
								<td>
									@php $nombre = explode('|', $os->nomb_cliente); @endphp
									{{$nombre[0]}}<br>{{$nombre[1]}}<br>{{$nombre[2]}}
								</td>
								<td>
									<a href="javascript:void(0);" data-id="{{$os->gos_os_id}}" class="btn btn-success btn-unir">Unir
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="{{route( 'gestion-compras.index')}}" class="btn btn-success btn-block">Listo</a>
			</div>
		</div>
	</div>
</div>
