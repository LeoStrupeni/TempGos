<span class="dropdown">
	<a href="javascript:void(0);"
		class="btn btn-sm btn-clean btn-icon btn-icon-md"
		data-toggle="dropdown" aria-expanded="true"> <i
			class="la la-ellipsis-h"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0);" 
            data-id="{{ $gos_usuario_id.'|'.$Nombre }}" 
            data-original-title="Ver" 
            id="btn-ver"
            class="dropdown-item">
            <i class="la la-search-plus"></i> Ver Historial
        </a>
        <a href="javascript:void(0);" 
            data-id="{{ $gos_prestamo_id }}" 
            data-original-title="Pagar" 
            id="btn-abonar"
            class="dropdown-item">
            <i class="la la-dollar"></i> Abonar
        </a>
        <a href="javascript:void(0);" 
            data-id="{{ $gos_prestamo_id }}" 
            data-original-title="Editar" 
            id="btn-editar"
            class="dropdown-item">
			<i class="la la-edit"></i> Editar
		</a>
        <a href="javascript:void(0);" 
            id="btn-borrar" 
            data-original-title="Delete" 
            data-id="{{ $gos_prestamo_id }}" 
            class="delete dropdown-item">
			<i class="la la-trash"></i> Borrar
		</a>
	</div>
</span>
