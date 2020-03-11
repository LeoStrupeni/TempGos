@extends( 'Layout' )@section( 'Content' )

<!-- begin:: Content -->

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Etapas</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<?php

				$auth = Session::get('Paquetes');

				if($auth == null)
				{
					$auth=0;

				}
				else {
					$auth = $auth[0]->agregar;
				}

				if ($auth): ?>
				<a href="/gestion-etap/agregar" class="btn btn-brand btn-elevate btn-icon-sm" type="button">
					<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
				</a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="table-responsive">
			<table class="table table-hover " id="dt-Etapas" style="font-size: 1rem;">
				<thead class="thead-light">
					<tr style="font-weight: 500;">
						<th >ID</th>
						<th>Orden</th>
						<th>Nombre Etapa</th>
						<th>Descripción</th>
						<th>Tiempo Meta</th>
						<th>Mínimo de Fotos</th>
						<th class="text-center" style="width: 3%;"></th>
					</tr>
					<tbody>
						<?php foreach ($listaEtapas as $etapa): ?>
            <tr>
            	<td >{{$etapa->gos_paq_etapa_id}}</td>
							<td>{{$etapa->orden_etapa}}</td>
							<td>{{$etapa->nomb_etapa}}</td>
							<td>{{$etapa->descripcion_etapa}}</td>
							<td>{{$etapa->tiempo_meta}}</td>
							<td>{{$etapa->minimo_fotos}}</td>
							<td>
								<span class="dropdown">
 							 	<a href="javascript:void(0);"
 							 		class="btn btn-sm btn-clean btn-icon btn-icon-md"
 							 		data-toggle="dropdown" aria-expanded="true"> <i
 							 			class="la la-ellipsis-h"></i>
 							 	</a>
 							 	<div class="dropdown-menu dropdown-menu-right">
									<a href="/gestion-etap/{{{$etapa->gos_paq_etapa_id}}}/editar"  class="dropdown-item ">
 							 			<i class="la la-edit"></i> Editar
 							 		</a>
 							 		</a>
 							 		<?php if (Session::get('usr_Data.gos_usuario_perfil_id') == 51): ?>
 							 		<a href="/gestion-etap/{{{$etapa->gos_paq_etapa_id}}}/eliminar"  class=" dropdown-item">
 							 			<i class="la la-trash"></i> Borrar
 							 		</a>
 							 		<?php endif ?>
 							 	</div>
 							 </span>
							</td>
            </tr>
						<?php endforeach; ?>
					</tbody>
				</thead>
			</table>
		</div>
		<!--end: Datatable Ajax-->
	</div>
</div>

@include('Etapas/ModalEtapa')
@endsection
@section('ScriptporPagina')
	<script src="/gos/ajax-etapas.js"></script>
@endsection
