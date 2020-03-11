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
			$auth = $auth[0]->eliminar;
		}

		if ($auth): ?>
		<a href="javascript:void(0);" id="borrarColorVehiculo" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $codigohex }}" class="delete dropdown-item">
			<i class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>
	</div>
</span>
