<!--begin:: Widgets/Tasks -->

@extends('Layout')
@section('Content')

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon2-line-chart"></i>
        </span>
        <h3 class="kt-portlet__head-title">
          Tiempo por Etapas
        </h3>
      </div>
    </div>

    <div class="form-group col-12 col-md-12">
      <form method="post" action="ReporteProductividadEtapa">
      @csrf
			<div class="kt-portlet__body">
				<div class="form-group row">
          <div class="col-2">
          <label>Estado</label>
					  <select class="form-control kt-selectpicker" data-live-search="true" name="estado" id="estado" data-col-index="2">
            <option value="0"></option>
            <option value="A">En proceso</option>
            <option value="F">Terminadas</option>
            </select>
 					</div>
          <div class="col-2">
          <label><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th></label>
            <select class="form-control kt-selectpicker" data-live-search="true" name="aseguradora" id="aseguradora" data-col-index="2">
              <option>Todas</option>
              @foreach($listaAseguradora as $aseguradora)
              <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
              @endforeach
            </select>
					</div>
          <div class="col-3">
          <label>Fecha</label>
          <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" readonly/>
          </div>
          <div class="col-2">
          <label>Tipo de daño</label>
            <select class="form-control kt-selectpicker" data-live-search="true" name="tipo_dano" id="tipo_dano" data-col-index="2" >
                <option>Todas</option>

              @foreach($listaDano as $dano)
              <option value="{{$dano->gos_os_tipo_danio_id}}">{{$dano->tipo_danio}}</option>
              @endforeach
           </select>
					</div>
          <div class="col-2">
          <label>Etapa</label>
					  <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="etapa[]" id="etapa"
            data-actions-box="true" data-select-all-text="Todas"  data-deselect-all-text="No aplica" multiple>
            @foreach($listaEtapas as $etapas)
              <option value="{{$etapas->gos_paq_etapa_id}}">{{$etapas->nomb_etapa}}</option>
              @endforeach
            </select>
 					</div>


          <div class="col-1">
          <br>
            <button type="submit" class="btn btn-primary">Aplicar</button>
          </div>
          <label for="">{{$cadfilter ??''}}</label>
			  </div>
		  </form>
    </div>

        <div class="container-fluid">
          <div class="table-responsive">
            <!--begin: Datatable -->
            <table class="table table-sm table-hover " style="font-size: 1rem;">
              <thead class="thead-light">
                <tr style="font-weight: 500;">
                  <th>Etapa</th>
                  <th style="text-align:center;">Tiempo</th>
                  <th style="text-align:center;">En Proceso</th>
                  <th style="text-align:center;">Terminadas</th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach ($listaEtapas as $etapa):  $total=0; $counterPros=0; $counterTerm=0; $temtiempo=0; $ttiempo=0; $PromMin=0; $HRSMIN=""; $cadOSPRos=""; $CadOSterm="";?>
                   <?php foreach ($gos_items as $item){
                    if($etapa->gos_paq_etapa_id==$item->gos_paq_etapa_id){

                     if ($item->estado_etapa=="A") {$counterPros=$counterPros+1;  $cadOSPRos=$cadOSPRos.$item->gos_os_id."|";}
                     if ($item->estado_etapa=="F") {$counterTerm=$counterTerm+1; $CadOSterm=$CadOSterm.$item->gos_os_id."|";
                       $to_time = strtotime($item->fecha_cierre_et);
                       $from_time = strtotime($item->fecha_inicio_et);
                        $temtiempo =round(abs($to_time - $from_time) / 60,2);
                        $ttiempo=$ttiempo+$temtiempo;
                        $total=$total+1;
                     }
                    }
                    if ($total>0) {
                        $PromMin=round($ttiempo/$total);
                        $HRSMIN=date('G \H\r\s\ i \M\i\n', mktime(0, $PromMin));
                    }
                   }?>
                   <?php if ($counterPros>0 or $counterTerm>0): ?>
                     <tr style="font-weight: 500;">
                       <td >{{$etapa->nomb_etapa}}  </td>
                       <td style="text-align:center;"> <?php if ($counterTerm>0): ?> {{$HRSMIN}} <?php else: ?> ND <?php endif; ?> </td>
                       <td style="text-align:center;"><button type="button" class="btn btn-primary btn-sm" onclick="modaletaenproceso({{$etapa->gos_paq_etapa_id}},'{{$cadOSPRos}}')">{{$counterPros}}</button></td>
                       <td style="text-align:center;"><button type="button" class="btn btn-primary btn-sm" onclick="modaletaterminada({{$etapa->gos_paq_etapa_id}},'{{$CadOSterm}}')">{{$counterTerm}}</button></td>
                     </tr>
                     <?php endif; ?>
                 <?php endforeach; ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modaletaenproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Etapas finalizadas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="kt-portlet kt-portlet--mobile">
                    <input type="hidden" name="gos_cliente_os_id" id="gos_cliente_os_id" >
                        <div class="kt-portlet__body">
                            <div class="table-responsive">
                            <input type="hidden" id="app_url" name="app_url" url=".."/>
                                <div class="table-responsive table-sm p-1" >
                                    <table class="table table-sm table-hover nowrap" id="dt-proceso" style="font-size: 1rem;">
                                        <thead class="thead-light">
                                            <tr style="font-weight: 500;">
                                                <th>ID</th>
                                                <th>Orden</th>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                           </div>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
	   </div>

  <div class="modal fade" id="modaletaterminada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ordenes en Proceso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="kt-portlet kt-portlet--mobile">
                    <input type="hidden" name="gos_cliente_os_id" id="gos_cliente_os_id" >
                        <div class="kt-portlet__body">
                            <div class="table-responsive">
                            <input type="hidden" id="app_url" name="app_url" url=".."/>
                                <div class="table-responsive table-sm p-1" >
                                    <table class="table table-sm table-hover nowrap" id="dt-terminadas" style="font-size: 1rem;">
                                        <thead class="thead-light">
                                            <tr style="font-weight: 500;">
                                                <th>ID</th>
                                                <th>Orden</th>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                        </div>
                    </div>

                        </div>

                    </div>
                </div>
            </div>
            </div>
	</div>




  @endsection


@section('ScriptporPagina')
<script>
$(document).ready(function() {
  var tabla = $('#etapas').DataTable({
        responsive : true,
        processing : true,
        paging: false,
    ordering: false
  });



  var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

	$('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		startDate: primerDia,
		endDate: ultimoDia,
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});


	var id = $('#asgid').val();
	var fechainc = $('#fechainc').val();
	var fechafin = $('#fechafin').val();
	console.log(id);
});
$(function(){$('[data-toggle="popover"]').popover()});
</script>
<script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-tiempo-etapas.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>

@endsection
