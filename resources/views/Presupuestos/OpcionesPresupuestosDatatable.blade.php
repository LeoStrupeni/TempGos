<span class="dropdown"> <a href="javascript:void(0);"
	class="btn btn-sm btn-clean btn-icon btn-icon-md"
	data-toggle="dropdown" aria-expanded="true"> <i
		class="la la-ellipsis-h"></i>
</a>
	<div class="dropdown-menu dropdown-menu-right">

		<a href="/Presupuestos/{{ $gos_pres_id }}/Imprimir" target="_blank" data-toggle="tooltip"
			data-id="{{ $gos_pres_id }}" data-original-title="Editar"
			class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-print"></i>
			Imprimir
		</a>
		<a href="/Presupuestos/{{ $gos_pres_id }}/Imprimir/HV" target="_blank" data-toggle="tooltip"
			data-id="{{ $gos_pres_id }}" data-original-title="Editar"
			class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-car"></i>
			Hoja Viajera
		</a>
		<a href="/Presupuestos/{{ $gos_pres_id }}/Ver" data-toggle="tooltip"
			data-id="{{ $gos_pres_id }}" data-original-title="Editar"
			class="dropdown-item btnEditarPresupuesto"> <i class="fas fa-eye"></i>
		  Ver
		</a>

		<?php $auth = Session::get('Presupuestos'); if($auth == null){$auth=0;	}else {	$auth = $auth[0]->editar;}if ($auth): ?>
		<a href="/Presupuestos/{{ $gos_pres_id }}/Editar" data-toggle="tooltip"
			data-id="{{ $gos_pres_id }}" data-original-title="Editar"
			class="dropdown-item btnEditarPresupuesto"> <i class="la la-edit"></i>
			Editar
		</a>
		<?php endif ?>


		<?php	$auth = Session::get('Presupuestos');if($auth == null)	{$auth=0;}	else {$auth = $auth[0]->eliminar;}if ($auth): ?>
    <a href="/Presupuestos/{{ $gos_pres_id }}/Borrar" id="borrarPresupuesto"
			data-toggle="tooltip" data-original-title="Delete"
			data-id="{{ $gos_pres_id }}" class="delete dropdown-item"> <i
			class="la la-trash"></i> Borrar
		</a>
		<?php endif ?>
	</div>

</span>
