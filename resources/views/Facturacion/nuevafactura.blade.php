@extends( 'Layout' )
@section( 'Content' )

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Nueva Factura</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
		</div>
  </div>

  	<div class="kt-portlet__body ">
					<div class="table-responsive">
									 <!--begin: Datatable -->
							 <table class="table table-sm table-hover datatablaList" id="Colores-DataTable">
							<thead class="thead-light">
								<tr>
									<th style="text-align:center;">Orden</th>
									 <th>Cliente</th>
									 <th>Aseguradora</th>
									 <th>Vehículo</th>
									 <th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($listaOS as $os)
							<tr>
								<td style="text-align:center;">#{{$os->nro_orden_interno}}</td>
								<?php $cl=explode("|", $os->nomb_cliente);?>
								<td> {{$cl[0]}} <br>{{$cl[1]}} <br>{{$cl[2]}}</td>
								<?php $asg=explode("|", $os->nomb_aseguradora_min);?>
								<td>{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
								<?php $vhc=explode("|", $os->detallesVehiculo);?>
								<td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
								<td style="text-align:center;">
								<span class="dropdown">

								<button href="javascript:void(0);"type="button"	class="btn btn-secondary btn-icon"
									data-toggle="dropdown" aria-expanded="true"> <i
									class="fas fa-list"></i>
								</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="gestion-factura/nueva/{{$os->gos_os_id}}" class="dropdown-item ">
											<i class="la la-edit"></i> Factura
										</a>
										
										<a href="gestion-factura/nuevaRemision/{{$os->gos_os_id}}" class="dropdown-item">
											<i class="la la-sticky-note"></i> Nota de remisión
										</a>   
										<a href="gestion-factura/nueva/{{$os->gos_os_id}}" class="dropdown-item">
											<i class="la la-ticket"></i> Ticket de venta
										</a>   
									</div>
								</span>

								</td>
							</tr>
							@endforeach
							</tbody>
						</table>

						<!--end: Datatable -->
					</div>
    </div><!-----------------body------------------->

</div><!-----------------Document------------------->

@endsection
@section('ScriptporPagina')
	<script src="../gos/ajax-facturacion.js"></script>
@endsection
