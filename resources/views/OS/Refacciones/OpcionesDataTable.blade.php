
<span class="dropdown">

<a href="javascript:void(0);"
	class="btn btn-sm btn-clean btn-icon btn-icon-md"
	data-toggle="dropdown" aria-expanded="true"> <i
		class="la la-ellipsis-h"></i>
</a>
	<div class="dropdown-menu dropdown-menu-right">

		<a href="javascript:void(0);" data-toggle="tooltip" data-id="{{ $gos_os_refaccion_id }}" data-original-title="Editar" class="dropdown-item btnEditarReporte"onclick="editarref({{ $gos_os_refaccion_id }});">
			<i class="la la-edit"></i> Editar
		</a>

		<a href="javascript:void(0);" id="borrarReporte" data-toggle="tooltip" data-original-title="Borrar" data-id="{{ $gos_os_refaccion_id }}" class="delete dropdown-item" onclick="borrarref({{ $gos_os_refaccion_id }});">
			<i class="la la-trash"></i> Borrar
		</a>
		<a href="javascript:void(0);" id="borrarReporte" data-toggle="tooltip" data-original-title="Cancelar" data-id="{{ $gos_os_refaccion_id }}" class="delete dropdown-item" onclick="Rechazarref({{ $gos_os_refaccion_id }});">
	  <i class="fas fa-backspace"></i>Rechazado
		<a href="javascript:void(0);" id="borrarReporte" data-toggle="tooltip" data-original-title="Cancelar" data-id="{{ $gos_os_refaccion_id }}" class="delete dropdown-item" onclick="Cancelarref({{ $gos_os_refaccion_id }});">
	  <i class="fas fa-ban"></i>Cancelar
		</a>
	</div>
</span>
