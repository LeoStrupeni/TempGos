@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Utilidad por unidad</h3>
        </div>
    </div>
    <div class="kt-portlet__body p-2">
        <form id="formUtilidad">
            <div class="form-group row text-center mb-2 justify-content-md-center">
                <div class="col-3 pr-1">
                    <label>Fechas</label>
                    <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" value="{{$fechaRango}}" readonly/>
                </div>
                <div class="col-2 px-1">
                    <label><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></label>
                    <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="aseguradora" id="aseguradora">
                        <option value="">Todas</option>
                        @foreach($listaAseguradoras as $aseguradora)
                        <option value="{{$aseguradora->empresa}}">{{$aseguradora->empresa}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 px-1">
                    <label>Tipo de orden</label>
                    <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="tipo_orden" id="tipo_orden">
                        <option value="">Todas</option>
                        @foreach($listaSeleccionTipoOrden as $tipoOrden)
                        <option value="{{$tipoOrden->tipo_orden}}">{{$tipoOrden->tipo_orden}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5 pl-1">
                    <label>Buscar</label>
                    <input type="text" class="form-control" name="global_filtro" id="global_filtro">
                </div>
            </div>
        </form>
        <div class="row p-0 mt-2">
            <div class="col-12 mt-4 border-bottom">
                <div id="bar_morris_1"></div>
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-sm table-hover text-center" id="dt-ReporteUtilidad">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2">Fecha</th>
                        <th class="p-2 text-nowrap"># Orden</th>
                        <th class="p-2 text-nowrap"># Factura</th>
                        <th class="p-2">Cliente</th>
                        <th class="p-2"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                        <th class="p-2"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                        <th class="p-2">Venta</th>
                        <th class="p-2">Egreso</th>
                        <th class="p-2">Utilidad</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                 <tbody>
                    @foreach ($listadoTabla as $l)
                    <tr>
                        <td class="p-2 text-nowrap">{{$l->fechaCreacion}}</td>
                        <td class="p-2 text-nowrap">
                            <a href="/orden-servicio-generada/{{$l->gos_os_id}}"> # {{$l->nro_orden_interno}}</a>
                        </td>
                        <td class="p-2 text-nowrap"></td>
                        <td class="p-2 text-nowrap">
                            <?php $cl=explode("|", $l->nomb_cliente);?>
                            {{$cl[0].' '.$cl[1]}}
                        </td>
                        <td class="p-2 text-nowrap">
                            <?php $asg=explode("|", $l->nomb_aseguradora_min); $asglength=count($asg); ?>
                            {{$asg[0]}} <br> {{$asg[1]}} {{$asg[2]}} 
                        </td>
                        <td class="p-2 text-nowrap">
                            <?php $vhc=explode("|", $l->detallesVehiculo);?>
                            <i class="fas fa-circle" style="color: #{{$vhc[0]}};"></i> {{$vhc[1]}}
                            <br>{{$vhc[2]}}
                            </td>
                        <td class="p-2 text-nowrap">$ {{$l->TOTAL}}</td>
                        <td class="p-2 text-nowrap">$ {{$l->EGRESOS}}</td>
                        <td class="p-2 text-nowrap">$ {{$l->UTILIDAD}}</td>
                        <td class="p-2 text-nowrap">
                            <a href="javascript:void(0);" data-id="{{$l->gos_os_id}}" class="btn btn-secondary btn-detalle border-0 p-0"><i class="fas fa-list"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="detalleOs" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;min-width: 70%;">
		<div class="modal-content">
			<div class="modal-header p-1">
				<h6 class="m-0 pt-2 pl-3">Desglose</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-sm" id="dt-detallesOS">
						<thead class="thead-light">
							<tr>
								<th class="p-2 w-50">Nombre</th>
								<th class="p-2">Venta</th>
								<th class="p-2">Mano Obra</th>
                                <th class="p-2">Costo</th>
                                <th class="p-2">Utilidad</th>
							</tr>
                        </thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('ScriptporPagina')

<script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteUtilidad.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>

@endsection
