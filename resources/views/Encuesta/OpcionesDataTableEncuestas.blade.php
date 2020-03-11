<span class="dropdown">
	<a href="javascript:void(0);"
		class="btn btn-sm btn-clean btn-icon btn-icon-md"
		data-toggle="dropdown" aria-expanded="true"> <i
			class="la la-ellipsis-h"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right">

		<a href=""

		{{-- href="javascript:void(0);"  --}}
		data-toggle="tooltip" data-id="" data-original-title="Editar" class="dropdown-item">
			<i class="la la-edit"></i> Editar
		</a>
		<?php if (Session::get('usr_Data.gos_usuario_perfil_id') == 51): ?>
		<a href="javascript:void(0);" id="btnborrar" data-toggle="tooltip" data-original-title="Delete" data-id="" class="delete dropdown-item">
			<i class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>
        <a href="javascript:void(0);" id="ver" data-toggle="tooltip" data-original-title="Delete" data-id="" class="delete dropdown-item">
			<i class="la la-trash"></i> ver
		</a>


	</div>
</span>
