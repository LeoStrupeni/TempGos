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
            <h3 class="kt-portlet__head-title">V S M</h3>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle mt-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-file-download"></i></button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item " href="/ReporteVSM/PDF/{{$Ase}}/{{$fini}}/{{$ffin}}" target="_blank"><i class="fa fa-print p-0 text-danger"></i>PDF</a>
              <a class="dropdown-item " href="/ReporteVSM/XLS/{{$Ase}}/{{$fini}}/{{$ffin}}" target="_blank" ><i class="fas fa-file-excel p-0 text-success"></i>XSL</a>
            </div>
          </div>

    </div>
    <div class="kt-portlet__body p-2">

        <form action="" method="post">
          @csrf
            <div class="form-group row text-center mb-2 justify-content-md-center">
              <div class="col-4 px-1">
                  <label>Aseguradora</label>
                  <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="aseguradora" id="aseguradora">
                      <option value="">Todas</option>
                      @foreach($listaAseguradoras as $aseguradora)
                      <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-4 col-sm-3 pl-1">
                  <label>Fechas</label>
                  <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" readonly/>
              </div>
              <div class="col-1 pr-2" style="margin-left: -1rem;">
                <br>
                  <button type="submit" class="btn btn-md btn-block btn-primary m-2" style="padding-left: 5px;">Aplicar</button>
              </div>


            </div>
        </form>

        <div class="form-group row text-center mb-2 justify-content-md-center">
          <div class="col-3 px-1">
            <label>Aseguradora :{{$cadAse}}</label>
          </div>
          <div class="col-4 pr-1">
                  <label>Fechas: {{$cadfiltros}}</label>
            </div>
        </div>
        <div class="row p-0 mt-2 d-flex justify-content-center">
          <div class="col-1 col-md-1"></div>
          <div class="col-4 col-md-4">
            <div class="table-responsive mt-2">
                <table class="table table-sm table-hover table-bordered" id="">
                  <thead class="thead-light">
                      <tr>
                          <th class="p-2">Proceso</th>
                          <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $totalPros=0; $totalMano=0; $genval2=0; $NOgenval2=0;?>
                    <?php foreach ($etapas as $eta):  $counter=0;  ?>
                        <?php foreach ($osItems as $item ){
                          $totalMano=$totalMano+$item->precio_mo;
                          if ($item->gos_paq_etapa_id==$eta->gos_paq_etapa_id) {
                            $counter=$counter+1; $totalPros=$totalPros+1;
                             $totalMano=$totalMano+$item->precio_etapa;
                            if ($item->genera_valor>0){$genval2=$genval2+1;}
                            else {$NOgenval2=$NOgenval2+1;}
                          }
                       }?>
                       <tr>
                         <?php if ($counter>0): ?>
                           <?php $prom=0; $prom=round($counter/$days_between,2) ?>
                            <td>{{$eta->nomb_etapa}}</td><td>{{$prom}} </td>
                         <?php endif; ?>
                       </tr>
                    <?php endforeach; ?>
                  </tbody>
                   <tr style="border-top: solid gray 2px;">
                     <?php $prompros=0; $prompros=round($totalPros/$days_between,2) ?>
                     <td>Total En Proceso</td><td> {{$prompros}}</td>
                   </tr>
                </table>
           </div>
          </div>
          <div class="col-4 col-md-3">
            <div class="table-responsive mt-2">
                <table class="table table-sm table-hover " id="">
                  <thead class="thead-light ">
                      <tr>
                          <th class="p-2">Concepto </th>
                          <th class="p-2">Total</th>
                      </tr>

                  </thead>
                  <tbody>
                        <tr>
                          <?php $entregados=round(($entregados) , 2) ?>
                          <td>Terminados</td><td>{{$terminados ??''}}</td>
                       </tr>
                       <tr>
                         <?php $entregados=round(($entregados) , 2) ?>
                         <td>Pago O Perdida</td><td>{{$perpago ??''}}</td>
                      </tr>
                        <tr>
                          <?php $entregados=round(($entregados) , 2) ?>
                          <td>Entregados</td><td>{{$entregados ??''}}</td>
                       </tr>
                         <tr>
                           <td>Dias Naturales</td><td>{{$days_between??''}}</td>
                        </tr>
                          <tr>
                            <?php  $PROMDDENTREGAS=round(($PROMDDENTREGAS) , 2) ?>
                            <td>Promedio Diario De Entregas</td><td>{{$PROMDDENTREGAS ??''}}</td>
                         </tr>
                           <tr>
                             <?php $tciclo=0; if ($PROMDDENTREGAS>0) { $tciclo=round($prompros/$PROMDDENTREGAS,2);}?>
                             <td>Tiempo De Ciclo</td><td>{{$tciclo}}</td>
                          </tr>
                            <tr>
                               <?php if($Tos>0){$promDhoras=($totalMano/$Tos)/160 ;   $promDhoras=round($promDhoras,2);}  ?>
                              <td>Promedio De Horas</td><td>{{$promDhoras ??''}} </td>
                           </tr>
                           <tr>
                             <?php $TouchT=0;  if ($tciclo>0) { $TouchT=round(($promDhoras/$tciclo) , 2);}  ?>
                             <td>Tiempo De Trabajo Sobre El Auto</td><td>{{$TouchT ??''}}</td>
                          </tr>
                          <tr>

                         </tr>

                  </tbody>
                </table>
                <table class="table  table-sm   table-hover text-center">
                  <thead class="thead-light">
                    <tr>
                      <th class="p-2"></th>
                      <th class="p-2"></th>
                      <th class="p-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($totalPros>0) {$genvalpor=round(($genval2/$totalPros)*100 , 2);$NOgenvalpor=round(($NOgenval2/$totalPros)*100 , 2);} ?>
                    <tr>
                      <td>Agregando Valor</td>
                      <td>{{$genval2}}</td>
                      <td>{{$genvalpor}}%</td>
                    </tr>
                    <tr>
                      <td>No Agregando Valor</td>
                      <td>{{$NOgenval2}}</td>

                      <td>{{$NOgenvalpor}}%</td>
                    </tr>
                  </tbody>
                </table>
           </div>
          </div>
          <div class="col-1 col-md-2"></div>
        </div>

        <div class="row p-0 m-2">
          <div class="table-responsive mt-2">
           <table  class="table table-sm table-hover" >
            <tbody>
              <tr>
              <?php $totalPros=0; ?>
              <?php foreach ($etapas as $eta):  $counter=0; ?>
                  <?php foreach ($osItems as $item ): ?>
                   <?php
                          if ($item->gos_paq_etapa_id==$eta->gos_paq_etapa_id) {
                            $counter=$counter+1; $totalPros=$totalPros+1;
                          }
                     ?>
                  <?php endforeach; ?>
                   <?php if ($counter>0): ?>
                      <td>
                        <div class="card text-center" style=" width:15rem; height: 15rem;">
                         <div class="card-header"  style="height: 5rem;">
                         {{$eta->nomb_etapa}}
                        </div>
                        <div class="card-body">
                          <div class="border mt-2">
                            <?php if ($eta->genera_valor<1||$eta->genera_valor==null ): ?>
                              <div class="float-right">
                              <i style="color: red; font-size: 2rem;" class=" la la-exclamation-triangle" ></i>
                              </div>
                            <?php endif; ?>
                            <?php if ($eta->genera_valor>0): ?>
                                <div class="float-right">
                                <i class="kt-menu__link-icon la la-plus-square "  style="color: green;  font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                               <?php $prom=0; $prom=round($counter/$days_between,2) ?>

                            <label style="padding-left: 1.6rem;"> {{$prom}} </label>
                          </div>
                          <div class="border  mt-2">
                            <?php $dias=0; if ($PROMDDENTREGAS>0) { $dias=round($prom/$PROMDDENTREGAS,2);} ?>
                           {{$dias}}
                          </div>
                          <div class="border  mt-2">
                               {{$prom}}
                          </div>
                        </div>
                        </div>
                      </td>
                   <?php endif; ?>
              <?php endforeach; ?>
                </tr>
            </tbody>

          </table>
         </div>
        </div>

    </div>
</div>



@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteVSM.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>

@endsection
