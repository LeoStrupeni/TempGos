<!--begin:: Widgets/Tasks -->

@extends('Layout')
@section('Content')
{{-- CABECERA --}}

          @if (session('notification'))
      <div class="alert alert-success">
          {{session('notification')}}
        </div> 
          @endif
          @if (count($errors)>0)
          <div class="alert alert-danger">
            <ul>
              <?php foreach ($errors->all() as $error): ?>
                <li>
                  {{ $error }}
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        </div>

       @endif
  <div class="kt-portlet kt-portlet--mobile" style="margin-bottom: 0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        {{-- <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon2-line-chart"></i>
        </span> --}}
        <h3 class="kt-portlet__head-title">
          Encuesta de servicios
        </h3>
      </div>



      {{-- MENU DESPLEGABLE PARA EXPORTAR LA INFORMACION EN VARIOS FORMATOS --}}
      {{--<div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <div class="dropdown dropdown-inline">
              <div class="kt-portlet__body"></div>
              <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="la la-download"></i> Exportar
              </button>
              <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(114px, 39px, 0px);">
                <ul class="kt-nav">
                  <li class="kt-nav__section kt-nav__section--first">
                    <span class="kt-nav__section-text">Selecciona una opción</span>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-print"></i>
                      <span class="kt-nav__link-text">Imprimir</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-copy"></i>
                      <span class="kt-nav__link-text">Copiar</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-excel-o"></i>
                      <span class="kt-nav__link-text">Excel</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                      <span class="kt-nav__link-text">PDF</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>--}}
    </div>

      <!-- <div id="chart">
       <h5 id="encSi"class="kt-portlet__head-title"> </h5>
        <label id="encNi"class="kt-portlet__head-title"> </label>
       <div id="myfirstchart" style="height: 250px;"></div>
      </div> -->


    <div class="kt-portlet__body p-2">
        <form id="formFiltrosGraficos" method="post">
            @csrf
            <div class="form-group row text-center mb-2">
            @isset($aid2)
              <input type="hidden" id="asgid" value="{{$aid2 ?? ''}}">
              <input type="date" hidden id="fechainc" value="{{$start ?? ''}}">
              <input type="date" hidden id="fechafin" value="{{$end ?? ''}}">
            @endisset
                <div class="col-4 ">
                    <label><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></label>
                    <select class="form-control kt-selectpicker" data-live-search="true" name="gos_aseguradora_id" id="gos_aseguradora_id">
                          <option value=""></option>
                        @foreach($listaAseguradoras as $aseguradora)

                          <?php if (isset($aid2)): ?>
                                <option  value="{{$aseguradora->gos_aseguradora_id}}"<?php if ($aid2 ==$aseguradora->gos_aseguradora_id ): ?>selected<?php endif; ?>>{{$aseguradora->empresa}}</option>
                                  
                          <?php else: ?>
                              <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                          <?php endif; ?>
                        @endforeach
                    </select>
                </div>

                <div class="col-4 col-sm-4 pl-1">
                    <label>Fechas</label>
                    <input type='text' class="form-control text-center" name="rangoFechas" id="rangoFechas" readonly/>

                </div>
                <div class="col-4 col-sm-4 pl-1">
                    <label>Filtrar</label>
                  <button type="submit" class="btn btn-primary btn-block mb-3">Aplicar</button>
                </div>

            </div>

        </form>
        <div class="row p-0">
          @isset($aid2)
            @foreach($encuesta_item as $item)
            <div class="col-6 col-md-2 mt-2 border-bottom" id="chart_{{$item->gos_encuesta_pregunta_id}}">
                <div class="text-center" id="bar_morris_1_title_{{$item->gos_encuesta_pregunta_id}}"></div>
                <div id="bar_morris_{{$item->gos_encuesta_pregunta_id}}"></div>
                <div class="d-flex justify-content-center">
                <strong for="" id="nomb_pregunta_{{$item->gos_encuesta_pregunta_id}}"></strong>
                </div>
            </div>
            @endforeach
          @endisset
            <div class="col-6 col-md-2 mt-2 border-bottom" id="chartrespuesta">
                <div class="text-center" id="bar_morris_title_chartrespuesta"></div>
                <div id="bar_morris_chartrespuesta"></div>
                <div class="d-flex justify-content-center">
                <strong for="" id="repuestaenc">Encuestas</strong>
                </div>
            </div>
            <!-- <div class="col-12 col-md-4 mt-4 border-bottom">
                <div id="bar_morris_2"></div>
            </div> -->
        </div>
       
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center datatablaList" id="dt-RepEncuesta">
                <thead class="thead-light">
                    <tr>
                      <th class="p-2"># Orden</th>
                      <th class="p-2">Fecha</th>

                      <th class="p-2"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                      <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                      <th class="p-2"></th>
                    </tr>
                </thead>
                @isset($encuesta)
                <tbody>
                @foreach($encuesta as  $enc)
                  <tr>
                    <td><a href="/orden-servicio-generada/{{$enc->gos_os_id}}">#{{$enc->nro_orden_interno}}</a></td>
                    <td>{{$enc->fecha_encuesta}} </td>

                    <?php $asg=explode("|", $enc->nomb_aseguradora_min);?>
                    <td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
                    <?php $vhc=explode("|", $enc->detallesVehiculo);?>
                    <td> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
                    <td style="vertical-align: middle;">
                      <div class="d-flex justify-content-center">
                      
                        <a  href="/Orden-entregada/pdf/encuesta/{{$enc->gos_os_id}}"  target="_blank" data-toggle="popover" data-trigger='hover'
                          data-placement="top" data-content="Encuesta: #{{$enc->gos_os_encuesta_id}}" id="easteregg">
                          <button  type="button"  value="" class="btn btn-primary btn-icon"
                            aria-expanded="true"> <i class="fas fa-file-pdf"></i> 
                            <!-- nota de remision -->
                          </button>
                        </a>
                      </div>

										</td>
                  </tr>
                  @endforeach
                </tbody>
                @endisset
            </table>
        </div>
    </div>
  </div>

@endsection
@section('ScriptporPagina')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/egg.js/1.0/egg.min.js"></script>
    {{-- <script src = "https://www.gstatic.com/charts/loader.js"></script> --}}
    <script>$(function(){$('[data-toggle="popover"]').popover()}); </script>
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteEncuesta.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection
