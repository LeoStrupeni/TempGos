@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				<?php if ($taller_conf_vehiculo->nomb_color!=null): ?>{{$taller_conf_vehiculo->nomb_color ??''}}<?php else: ?>Colores<?php endif; ?> <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?>
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">

					<?php

					$auth = Session::get('Vehiculos');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="agregarColoresVehiculo" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		@if (session('notification'))
		<div class="alert alert-info fade in">
		 {{session('notification')}}
		 </div> @endif

		 @if (count($errors)>0)
			 <div class="alert alert-danger fade in">
				 <ul>
					 <?php foreach ($errors->all() as $error): ?>
						 <li>
							 {{ $error }}
						 </li>
					 <?php endforeach; ?>
				 </ul>
			 </div>
		</div>
		@endif

		<div class="table-responsive">
            <!--begin: Datatable -->
        <table class="table table-sm table-hover datatablaList" id="Colores-DataTable">
				<thead class="thead-light">
					<tr>
						<th style="width:50%;"><?php if ($taller_conf_vehiculo->nomb_color!=null): ?>{{$taller_conf_vehiculo->nomb_color ??''}}<?php else: ?>Color<?php endif; ?></th>
            <th class="text-center" ></th>
            <th class="text-center" style="width:3%;"></th>
					</tr>
				</thead>
				<tbody>
				 <?php if ($colores!=NULL): ?>
           <?php foreach ($colores as $clr): ?>
						 <tr>
							 <td style="width:50%;"> {{$clr->nomb_color}} </td>
							 <td class="text-center">
                 <div class="circle-tile-heading" style="background-color:#{{$clr->codigohex}}"></div>
								 </td>
							     <td class="text-center" style="width:3%;">
								  <?php if ($clr->gos_taller_id!=0): ?>
								 <span class="dropdown">
									 <a href="javascript:void(0);"
										 class="btn btn-sm btn-clean btn-icon btn-icon-md"
										 data-toggle="dropdown" aria-expanded="true"> <i
										 class="fas fa-edit"></i>
									 </a>
									 <div class="dropdown-menu dropdown-menu-right">
											 <a href="/vehiculos-color/{{$clr->codigohex}}/eliminar" id="borrarColorVehiculo" data-toggle="tooltip" class="delete dropdown-item">
												 <i class="la la-trash"></i> Borrar
											 </a>
									 </div>
								 </span>
								 <?php else: ?>

								 <?php endif; ?>
							 </td>
						 </tr>
               <?php endforeach; ?>
				 <?php endif; ?>
				</tbody>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
<style>.circle-tile-heading {
    border: 1px solid black;
    border-radius: 100%;
	color: black;
    height: 2rem;
	width: 2rem;
}</style>

<!------------------------------------------------modal colores vehiculobegin --------------------------------------------------->
<link rel="stylesheet" href="gos/css/pick-a-color-1.2.3.min.css">

<div class="modal fade" id="modalColorVehiculo" role="dialog">
    <div class="modal-dialog modal-s modal-s">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #27395c;">
              <h5 class="modal-title" style=" color:white;">Nuevo Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="colorVehiculoForm" action="" method="post">
                    @csrf
                        <div class="form-group">
                            <label style="font-size: 1rem;">Nombre color</label>
                            <input type="text" class="form-control" name="nomb_color" id="nomb_color">
                            <small style="font-style: italic;" class="nomb_color form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 1rem;">Color</label>
                            <input type="text" class="form-control pick-a-color" name="codigohex" id="codigohex">
                            <small style="font-style: italic;" class="codigohex form-text text-danger"></small>
                        </div>
                    <button type="button" class="btn btn-success btn-block" id="btnGuardarColorVehiculo">Guardar</button>
										<button type="submit"  style="display: none" class="btn btn-success btn-block" id="btnGuardarColorVehiculosubmit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="gos/js/tinycolor-0.9.15.min.js"></script>
<script src="gos/js/pick-a-color-1.2.3.min.js"></script>
<script>
$(".pick-a-color").pickAColor();

</script>
<style>
    @media screen and (max-width: 991px){
    .pick-a-color-markup .color-menu {
     left: 0px;
    }
    }

</style>
<!------------------------------------------------modal colores --------------------------------------------------->

@endsection
@section('ScriptporPagina')
<script src="../gos/ajax-vehiculo-colores.js"></script>
@endsection
