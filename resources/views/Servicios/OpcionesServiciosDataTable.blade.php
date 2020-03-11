<span class="dropdown"> <a href="javascript:void(0);"
	class="btn btn-sm btn-clean btn-icon btn-icon-md"
	data-toggle="dropdown" aria-expanded="true"> <i
		class="la la-ellipsis-h"></i>
</a>
	<div class="dropdown-menu dropdown-menu-right">
		<a href="javascript:void(0);" data-toggle="tooltip"
			data-id="{{ $gos_paq_servicio_id }}" data-original-title="Editar"
			class="dropdown-item btnEditarServicio"> <i class="la la-edit"></i>
			Editar
		</a>
		<?php if (Session::get('usr_Data.gos_usuario_perfil_id') == 51): ?>
		 <a href="javascript:void(0);" id="borrarServicio"
			data-toggle="tooltip" data-original-title="Delete"
			data-id="{{ $gos_paq_servicio_id }}" class="delete dropdown-item"> <i
			class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>
	</div>
</span>
