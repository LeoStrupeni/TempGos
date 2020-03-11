@extends('Layout')

@section('Content')
<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
<link rel="stylesheet" href="../gos/css/menu_vertical.css">
<div class="kt-portlet kt-portlet--mobile">

    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Encuestas Generadas
        </h3>
      </div>


      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <?php	$auth = Session::get('Clientes');if($auth == null){$auth=0;}else {$auth = $auth[0]->agregar;}if ($auth): ?>
          <a data-toggle="modal" data-target="#ModalDesglosepregunta"><button class="btn btn-brand btn-elevate btn-icon-sm" type="button" id="crear-nueva-os">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar Pregunta
					</button></a>
            <a href="{{ url('/agregarEncuesta') }}" ><button class="btn btn-brand btn-elevate btn-icon-sm" type="button" id="crear-nueva-os">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar Encuesta
					</button></a>
          <?php endif ?>
          </div>
        </div>
      </div>
    </div>

    <form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;" action="" method="Post">
      @csrf
			<div class="kt-portlet__body">

      </div>
		</form>

    <div class="kt-portlet__body p-0">
      <div class="d-flex justify-content-between">
        <div class='container-fluid'>
            <div class ='row'>
              <div class='col col-sm-2'>
              {{--{{$os->nombre}}--}}
                  <div class="vertical-menu" style="padding-top: 0.2rem;">
                    <a1 href="" class="active">Carpetas  </a1>
                    <a  class="active"  onclick="displaydatatable()">Encuestas<span class="badge badge-light">{{$cuentaEncuestas ??''}}</a>
                    <a   onclick=" displaydatatablepre()">Preguntas<span class="badge badge-light">{{$cuentaPreguntas ??''}}</a>

                  </div>
              </div>
              <div class='col col-sm-10'>

                <input type="hidden" id="app_url" name="app_url" url=".."/>
                <div class="table-responsive table-sm p-1 pb-5" id="Encuesta-lista">
                  <table class="table table-sm table-hover nowrap" id="dt-ordenes-encuestas" style="font-size: 1rem;">
                    <thead class="thead-light">
                      <tr style="font-weight: 500;">
                        <th>Nombre</th>
                        <th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                        <th style="width: 3%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($listaEncuesta as $encuesta)
                     <tr>
                     <td>{{$encuesta->nombre_encuesta}}</td>
                     @foreach($listaAseguradora as $aseg)
                      @if($encuesta->gos_aseguradora_id==$aseg->gos_aseguradora_id)
                      <td>{{$aseg->empresa}}</td>
                      @endif
                     @endforeach
                     <td>
                        <span class="dropdown">
                          <a href="javascript:void(0);"
                            class="btn btn-sm btn-clean btn-icon btn-icon-md"
                            data-toggle="dropdown" aria-expanded="true"> <i
                              class="la la-ellipsis-h"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <?php	$auth = Session::get('Clientes');if($auth == null){$auth=0;}	else {$auth = $auth[0]->ver;}	if ($auth): ?>
                            <a id="ver" href="/Encuesta/{{$encuesta->gos_encuesta_id}}" target="blank" data-toggle="tooltip" data-original-title="" data-id="{{$encuesta->gos_encuesta_id}}" class=" dropdown-item">
                              <i class="la la-eye"></i> Ver
                            </a>
                            <?php endif ?>
                            <?php	$auth = Session::get('Clientes');if($auth == null){$auth=0;}	else {$auth = $auth[0]->ver;}	if ($auth): ?>
                            <!-- <a id="editar-enc" href="/gestion-encuestas/{{$encuesta->gos_encuesta_id}}/Editar" target="blank" data-toggle="tooltip" data-original-title="" data-id="{{$encuesta->gos_encuesta_id}}" class=" dropdown-item">
                              <i class="la la-edit"></i> Editar
                            </a> -->
                            <?php endif ?>
                            <?php	$auth = Session::get('Clientes');if($auth == null){$auth=0;}else {$auth = $auth[0]->eliminar;	}if ($auth): ?>
                            <a data-id="{{$encuesta->gos_encuesta_id}}" id="btnborrar-encuesta" data-toggle="tooltip" data-original-title="Delete" data-id="" class="delete dropdown-item">
                              <i class="la la-trash"></i> Borrar
                            </a>
                            <?php endif ?>


                           


                          </div>
                        </span>
                     </td>
                     </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="table-responsive table-sm p-1 pb-5" id="Pregunta-lista" style="display:none">
                  <table class="table table-sm table-hover nowrap" id="dt-ordenes-preguntas" style="font-size: 1rem;">
                    <thead class="thead-light">
                      <tr style="font-weight: 500;">
                        <th>Pregunta</th>

                        <th style="width: 3%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($listaPreguntas as $preguntas)
                     <tr>
                     <td>{{$preguntas->pregunta}}</td>

                     <td>
                        <span class="dropdown">
                          <a href="javascript:void(0);"
                            class="btn btn-sm btn-clean btn-icon btn-icon-md"
                            data-toggle="dropdown" aria-expanded="true"> <i
                              class="fas fa-list"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">




                          <?php  $auth = Session::get('Clientes');if($auth == null){$auth=0;}else {$auth = $auth[0]->ver;}if ($auth): ?>
                            <a id="editar-pregunta" data-id="{{$preguntas->gos_enc_preguntas_id}}" data-original-title="Editar" class="dropdown-item">
                              <i class="la la-edit"></i> Ver
                            </a>
                              <?php endif ?>

                              <?php $auth = Session::get('Clientes');  if($auth == null){$auth=0;}else {$auth = $auth[0]->eliminar;}if ($auth): ?>
                            <a data-id="{{$preguntas->gos_enc_preguntas_id}}" id="btnborrar-preguntas" data-toggle="tooltip" data-original-title="Delete" data-id="" class="delete dropdown-item">
                              <i class="la la-trash"></i> Borrar
                            </a>
                            <?php endif ?>
                          </div>
                        </span>
                     </td>
                     </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>


              </div>
            </div>
        </div>
      </div>

    </div>


<!---------------------------------------------------------------Modal----------------------------------------------------------------------------------->
<form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;" id="form-guardar-respuesta"  method="Post">
@csrf
  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="ModalDesglosepregunta">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Agregar Pregunta</h5>
        </div>
        <div class="modal-body">

            <div class="form-group">
              <label >Pregunta</label>
              <div class="input-group">
                  <select class="form-control kt-selectpicker" title="Selecciona o ingresa una pregunta" data-size="6" data-live-search="true" id="pregunta" name="pregunta">
                  @isset($listaPreguntas)
                  <option value="0">Agregar</option>
                      @foreach ($listaPreguntas as $pregunta)
                      <option value="{{$pregunta->gos_enc_preguntas_id}}"> {{$pregunta->pregunta}}</option>
                      @endforeach
                  @else
                      <option value="0">Agregar</option>
                  @endisset
                  <input type="hidden" value="" id="pregunta_id_nueva" name="pregunta_id_nueva" >
                  </select>
                  <div class="input-group-append">
                      <button class="btn btn-brand p-1" type="button"name="button" onclick="getselect();">
                          <i class="fas fa-plus p-0" style="color: white!important;"></i>
                      </button>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <label >Tipo de Respuesta</label>
              <select class="form-control  kt-selectpicker " title="Seleccionar tipo" data-size="6" data-live-search="true" data-col-index="2" id="respuesta" name="tipo_respuesta" onchange="displayresp(this.value)">
                  <option value="1">Si, No</option>
                  <option value="2">Opcion Multiple</option>
              </select>
            </div>

            <div class="row col-12" id="btn_crear_pregunta">
              <button type="button" class="btn btn-success w-100" id="btn-guardar-respuestas" onclick="guardaresp();">Agregar</button>
            </div>

            <div class="" id="mult_resp" style='display:none;'>
              <div class="d-flex justify-content-center">
                  <button class="add_form_field mb-5 btn btn-primary">Agrega nueva opción &nbsp;
                      <span style="font-size:16px; font-weight:bold;">+</span>
                  </button>
              </div>

              <div class="form-group">


                  <div class="form-group">
                    <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 1" name="respuesta[]" id="">
                    </div>

                  </div>
                  <div class="form-group">
                    <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 2" name="respuesta[]" id="">
                    </div>
                  </div>

                  <div class="form-group" id='sel1' style='display:none;'>
                    <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 3" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel2' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 4" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel3' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 5" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel4' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 6" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel5' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 7" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel6' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 8" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel7' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 9" name="respuesta[]" id="">
                    </div>
                  </div>
                  <div class="form-group" id='sel8' style='display:none;'>
                  <div class="col-12">
                      <input class="form-control" type="text" placeholder="Opción 10" name="respuesta[]" id="">
                    </div>
                  </div>

                   <div class="row col-12" id="btn_crear_pregunta">
                    <button type="button" class="btn btn-success w-100" id="btn-guardar-respuestas" onclick="guardaresp();">Agregar</button>
                  </div>
              </div>
            </div>





        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</form>
    @csrf

<!---------------------------------------------------------------Modal editar----------------------------------------------------------------------------------->
<form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;" id="editarpreguntaform" action="/gestion-preguntas/actualizar" method="POST">
    @csrf
  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEditarpregunta">

      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Ver Pregunta</h5>
          </div>

          <div class="modal-body">
              <input type="hidden" class="form-control" id="gos_enc_preguntas_id" name="gos_enc_preguntas_id" value="" >
              <!-- <input type="text" class="form-control" id="pregunta" name="pregunta" value="">  -->
              <div class="form-group">
                <label >Pregunta</label>
                  <input type="text" class="form-control" id="pregunta_editar" name="pregunta_editar" disabled value="">
              </div>



              <div class="row col-12" id="btn_crear_pregunta" style='display:none;'>
                <button type="submit" class="btn btn-success w-100" id="btn_guardar_encuesta">Crear</button>
              </div>

              <div class="justify-content-center" id="input_fields_wrap" >
              <label >Respuestas</label>
                <!-- <div class="d-flex justify-content-center">
                    <button class="add_field_button mb-5 btn btn-primary">Agrega nueva opción &nbsp;
                        <span style="font-size:16px; font-weight:bold;">+</span>
                    </button>
                </div> -->

                <div id="opciones-respuestas" class="form-group">





                </div>
                <!-- <div class="row col-12" id="btn_crear_pregunta">
                  <button type="submit" class="btn btn-success w-100" id="btn_editar_encuesta">Crear</button>
                </div>  -->
              </div>





          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
  </div>
</form>
    @csrf







@endsection
@section('ScriptporPagina')
  <script src="../gos/ajax-encuestas.js"></script>

@endsection
