<span class="dropdown">

	<a href="javascript:void(0);"
		class="btn btn-sm btn-clean btn-icon btn-icon-md"
		data-toggle="dropdown" aria-expanded="true"> <i
			class="la la-ellipsis-h"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right">


		<?php

		$auth = Session::get('Vehiculos');

		if($auth == null)
		{
			$auth=0;

		}
		else {
			$auth = $auth[0]->editar;
		}

		if ($auth): ?>
		<a
			data-toggle="modal"
			data-target="#modal-vehiculo"
			data-id="{{$gos_vehiculo_id}}"
			data-original-title="Editar"
			class="dropdown-item btn-editar-vehiculo"
			href="javascript:void(0);"><i class="la la-edit"></i> Editar</a>
	<?php endif ?>




	<?php

	$auth = Session::get('Vehiculos');

	if($auth == null)
	{
		$auth=0;

	}
	else {
		$auth = $auth[0]->eliminar;
	}

	if ($auth): ?>

		<a id="borrar-vehiculo"
			data-toggle="tooltip" data-original-title="Delete"
			data-id="{{$gos_vehiculo_id}}" class="delete dropdown-item"
			href="javascript:void(0);"><i class="la la-trash"></i> Borrar</a>
			<?php endif ?>
	</div>

</span>
