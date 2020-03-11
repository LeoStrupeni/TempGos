@extends('Layout')
@section('Content')

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Seguimiento de refacciones
        </h3>
      </div>
    </div>

    <form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;" action="" method="Post">
      @csrf
			<div class="kt-portlet__body">
				<div class="form-group row" style="margin-bottom: 0 !important;">
          <div class="col-3">
						 <label class=""><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></label>
            <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2" name="Aseguradora">
              <option value="">Seleccionar</option>
              @foreach($listaAseguradoras as $tipoCliente)
                <option value="{{$tipoCliente->gos_aseguradora_id}}">{{$tipoCliente->empresa}}</option>
              @endforeach
            </select>
 					</div>
          <div class="col-3">
             <label class="">Seleccion de proveedor</label>
           <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2" name="provedor">
             <option value="">Seleccionar</option>
             @foreach($listaSeleccionProveedores as $Proveedor)
               <option value="{{$Proveedor->gos_proveedor_id}}">{{$Proveedor->nomb_proveedor}}</option>
             @endforeach
           </select>
					</div>
          <div class="col-3">
             <label class="">Estatus</label>
           <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2" name="Estatus">
             <option value="">Seleccionar</option>
             <option value="1">Pendiente Autorizacion</option>
             <option value="2">Sin Proovedor</option>
             <option value="3">En Proceso (Todas)</option>
             <option value="4">En Proceso (En Tiempo)</option>
             <option value="5">En Proceso (Fuera Tiempo)</option>
             <option value="6">Rechazado (Pendiente Autorizacion)</option>
             <option value="7">Canceladas</option>
             @foreach($listaSeleccionRefaccionStatus as $refaccionStatus)
              <!-- <option value="{{$refaccionStatus->gos_os_refaccion_estatus_id}}">{{$refaccionStatus->estatus_refaccion}}</option> -->
             @endforeach
           </select>
					</div>
          <div class="col-2">
            <label for="">Orden De Servicio:</label>
            <input type="text" class="form-control" placeholder="Buscar orden" name="Orden">
          </div>
          <div class="col-1">
            <br>
            <button type="submit" class="btn btn-primary m-2">Aplicar</button>
          </div>
			  </div>
        <div class="card">
           <input type="hidden" name="" id="filtroPROV" value="{{$filtroPROV ??''}}">
           <input type="hidden" name="" id="filtroPROVEstatus" value="{{$filtroEST ??''}}">
          {{$cadFILTROS ??''}}
        </div>
      </div>
		</form>
    <div class="kt-portlet__body" style="padding: 0;">
      @include('Reportes.Graficos.seguimientorefacciones')
    </div>
      {{-- <div class="form-row"> --}}

        <div class="form-group col-12 col-md-12">
          <div class="kt-portlet__body">
            <div class="table-responsive">
              <!--begin: Datatable -->
              <table class="table table-sm table-hover dtRefacciones" style="font-size: 1rem; ">
                <thead class="thead-light">
                  <tr style="font-weight: 500;">
                    <th># Orden</th>
                    <th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                    <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
                   <th>Vencidas</th>
                    <th>Desplegar</th>
                  </tr>
                </thead>
                <tbody style="width:100%" >
                  <?php foreach ($os as $Orden): ?>
                    <tr>
                      <td style="width:5%">  <a  style="margin-left: 5px;" href="orden-servicio-generada/{{$Orden->gos_os_id}}" target="_blank"> {{$Orden->nro_orden_interno}}</a> </td>
                      <?php $AsegudarodaDatos=explode("|", $Orden->nomb_aseguradora);?>
                      <td style="width:35%">{{$AsegudarodaDatos[0] ??'' }} <br> {{$AsegudarodaDatos[1] ??'' }}{{$AsegudarodaDatos[2] ??'' }} <br> {{$AsegudarodaDatos[3] ??'' }}  {{$AsegudarodaDatos[4] ??'' }}   </td>
                      <?php $detallesVehiculo=explode("|", $Orden->detallesVehiculo);?>
                      <td style="width:45%">Color: <i class="fas fa-circle"style="color: #{{$detallesVehiculo[0] ??''}}"></i>  <br>{{$detallesVehiculo[1] ??''}}<br> {{$detallesVehiculo[2] ??''}}</td>
                      <?php $refvencount=0; ?>
                      <?php foreach ($refaccionesVencidas as $refVen): ?>
                         <?php if ($refVen->gos_os_id==$Orden->gos_os_id): ?>
                            <?php $refvencount=$refvencount+1 ?>
                         <?php endif; ?>
                      <?php endforeach; ?>
                      <td style="width:10%"> <label class="<?php if ($refvencount>0): ?>text-danger<?php endif; ?>">{{$refvencount}}</label> </td>
                      <td style="width: 5%;"><button type="button" class="btn btn-secondary" onclick="desplegarref({{$Orden->gos_os_id}})"><i class="fas fa-list"></i></button></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <!--end: Datatable -->
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>

<!---------------------------------------------------------------Modal----------------------------------------------------------------------------------->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="ModalDesgloseRef">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Desglose De Refacciones</h5>
           <a target="_blank" class="btn btn-primary btn-md" id="irordenmodal">Ir A la Orden</a>
     </div>
     <div class="modal-body">

       <div class="table-responsive p-1">
         <div class="table-responsive p-1 " style="margin-top: 10px;">
             <table class="table table-sm table-hover" id="dt-Refacciones">
                 <thead class="thead-light">
                     <tr style="width:100%;">
                         <th >ID</th>
                         <th >Nombre</th>
                         <th  ># Parte</th>
                         <th  >Observaciones</th>
                         <th >Proveedor</th>
                         <th  style="width:40%;">Fechas</th>
                         <th >Estatus</th>
                         <th >Ubicación</th>
                         <th style="width:3%;" class="p-2">Recibido</th>
                         <th style="width:3%;"class="p-2">Entregado</th>
                         <th style="width:3%;" class="p-2">Portal</th>
                         <th style="width:3%;"></th>
                     </tr>
                 </thead>
             </table>
         </div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
    </div>
  </div>
</div>

<div class="modal "  id="modalrefaccionesProvedor" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content border">
      <div class="modal-header  " style="background-color:#27395c; ">
        <h5 class="modal-title" style="color: white;">Asignar Provedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light" >
       <div class="row">
          <div class="col-6">
            <label for="">Provedor:</label>
            <select class="form-control" name="" id="selectprovedorrefac">
               <option value="0">Asignar Provedor</option>
               <?php if ($listaSeleccionProveedores!=NULL): ?>
                 <?php foreach ($listaSeleccionProveedores as $provedor): ?>
                    <option value="{{$provedor->gos_proveedor_id}}">{{$provedor->nomb_proveedor}}</option>
                 <?php endforeach; ?>
               <?php endif; ?>
            </select>
          </div>
          <div class="col-6">
            <label for="">Fecha Promesa</label>
            <input type="date" class="form-control" name="" value="" id="refaprovfp">
          </div>
       </div>

      </div>
      <div class="modal-footer bg-light">
         <button type="button" class="btn btn-primary" onclick="AsignarProvRefac();">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal border"  id="modalrefaccionesCancelar" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content border">
      <div class="modal-header " style="background-color:#27395c; ">
        <h5 class="modal-title" style="color: white;">Motivo de Cancelacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light">
        <input type="hidden" name="" value="" id="refaccionidcancelar">
        <select class="form-control" name="" id="motivocancelacionid">
          <option value="0">seleccionar Tipo</option>
          <?php if ($estatusrefaccionescanceladas!=NULL): ?>
            <?php foreach ($estatusrefaccionescanceladas as $cancelado): ?>
              <option value="{{$cancelado->gos_os_refaccion_estatus_id}}">{{$cancelado->estatus_refaccion }}</option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="modal-footer bg-light">
         <button type="button" class="btn btn-primary" onclick="cancelarRefPost();">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('ScriptporPagina')
    <script src="/gos/Reportes/ajax-reporte-refacciones.js"></script>

@endsection
