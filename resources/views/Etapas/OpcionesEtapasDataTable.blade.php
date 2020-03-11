<span class="dropdown">

	<a href="javascript:void(0);"
		class="btn btn-sm btn-clean btn-icon btn-icon-md"
		data-toggle="dropdown" aria-expanded="true"> <i
			class="la la-ellipsis-h"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right">

		<?php

		$auth = Session::get('Paquetes');

		if($auth == null)
		{
			$auth=0;

		}
		else {
			$auth = $auth[0]->editar;
		}

		if ($auth): ?>
		<a href="javascript:void(0);" data-toggle="tooltip" data-id="{{ $gos_paq_etapa_id }}" data-original-title="Editar" class="dropdown-item btn-editar-Etapa">
			<i class="la la-edit"></i> Editar
		</a>
		<?php endif ?>

		<?php

		$auth = Session::get('Paquetes');

		if($auth == null)
		{
			$auth=0;

		}
		else {
			$auth = $auth[0]->eliminar;
		}

		if ($auth): ?>

		<a href="javascript:void(0);" id="borrar-etapa" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $gos_paq_etapa_id }}" class="delete dropdown-item">
			<i class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>

	</div>

</span>
