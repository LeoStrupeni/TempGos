<span class="dropdown">
	<a href="javascript:void(0);"
		class="btn btn-sm btn-clean btn-icon btn-icon-md"
		data-toggle="dropdown" aria-expanded="true"> <i
			class="la la-ellipsis-h"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right">


		<?php

		$auth = Session::get('Ordenes');

		if($auth == null)
		{
			$auth=0;

		}
		else {
			$auth = $auth[0]->eliminar;
		}

		if ($auth): ?>
		<a href="{{route('ordenes-servicio.edit',$gos_os_id)}}"

		{{-- href="javascript:void(0);"  --}}
		data-toggle="tooltip" data-id="{{ $gos_os_id }}" data-original-title="Editar" class="dropdown-item btnEditarOS">
			<i class="la la-edit"></i> Editar
		</a>
		<?php endif ?>


		<a href="javascript:void(0);" id="btnFechaIngreso"  data-id="{{ $gos_os_id }}" data-toggle="modal" data-target="#modal-fecha-ingreso" class="delete dropdown-item">
			<i class="la la-calendar "></i> Ingreso Reparación
		</a>
		<a href="javascript:void(0);" id="btnFechaPromesa"  data-id="{{ $gos_os_id }}" data-toggle="modal" data-target="#modal-fecha-promesa" class="delete dropdown-item">
			<i class="la la-calendar "></i> Fecha Promesa
		</a>

		<?php

		$auth = Session::get('Ordenes');

		if($auth == null)
		{
			$auth=0;

		}
		else {
			$auth = $auth[0]->eliminar;
		}

		if ($auth): ?>

		<a href="javascript:void(0);" id="btnborrarOS" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $gos_os_id }}" class="delete dropdown-item">
			<i class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>
		{{--<a class="dropdown-item"data-toggle="modal" class="kt-nav__link"> <span class="kt-nav__link-text" onclick="ReenviarModal();"><i	class="far fa-arrow-alt-circle-up"></i>Reenviar Mensaje</span></a>--}}
		<a href="{{ route('OS_pdf',$gos_os_id) }}" style="color: inherit;" class="dropdown-item">
			<i  class="fas fa-print"></i> Imprimir inventario vehículo</span>
		</a>

	</div>
</span>
