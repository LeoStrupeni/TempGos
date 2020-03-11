@section('estiloPorPagina')
<link
	href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<link
	href="{{env('APP_URL')}}/gos/datatable-editor/css/editor.dataTables.min.css"
	rel="stylesheet" type="text/css" />
@endsection @extends('Layout') @section('Content')
<!-- <div class="table-responsive">
	<table style="font-size: 12px;" class="table table-sm table-hover"
		id="dt-etapas-os">
		<thead class="thead-light">
			<tr>
				<th>id</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Asesor</th>
				<th>Precio</th>
				<th>Materiales</th>
				<th>Tiempo</th>
				<th>Estado</th>
				<th class="text-center" style="width: 3%;"></th>
			</tr>
		</thead>

	</table>
</div> -->

<!-- <div class="table-responsive"> 
	<table style="font-size: 12px;" class="table table-sm table-hover"
		id="dt-etapas-os-extra">
		<tbody>
			@if(isset($listaEtapas)) @foreach ($listaEtapas as $etapa)
			<tr>
				<td>{{$etapa->nombre}}</td>
				<td>{{$etapa->descripcion}}</td>
				<td>{{$etapa->asesor ?? 'Sin Asignar'}}</td>
				<td>{{$etapa->precio_etapa}}</td>
				<td>{{$etapa->precio_materiales}}</td>
				<td>{{$etapa->tiempo ?? '1'}}</td>
				<td><a data-toggle="modal" data-target="#modal-siguente-etapa"
					class="kt-nav__link"> <label
						class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4"> <input
							type="checkbox"> <span></span>
					</label>
				</a></td>
			</tr>
			@endforeach @endif
		</tbody>
	</table>
</div>
-->

@include('OS/Generada/modalSiguienteEtapa') @endsection
@section('ScriptporPagina')
<!-- YOIS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script
	src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
	src="{{env('APP_URL')}}/gos/datatable-editor/js/dataTables.editor.min.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/ajax-os-generada-etapas.js"></script>
<!-- YOIS -->

@endsection
