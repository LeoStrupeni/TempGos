@extends('Layout')
@section('Content')

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Refacciones OS: <small>{{$os->gos_os_id}}</small>
        </h3>

      </div>
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <div class="container-fluid">
              <div class="float-right">
                <a  class="btn btn-outline-secondary "  href="mailto:
                   ?subject=Cotizacion De Refacciones {{$taller->taller_nomb ??''}} .&amp; &amp;body=Listado de Refacciones a Cotizar:%0AVehiculo:{{$os->marca_vehiculo}}-{{$os->modelo_vehiculo}}-{{$os->anio_vehiculo}}%0A%0ANombre Parte Observaciones%0A<?php foreach ($refacciones as $refa): ?>- {{$refa->nombre}}  {{$refa->nro_parte}}  {{$refa->observaciones}} %0A<?php endforeach; ?>%0A
                   ">
                  <i class="fas fa-envelope kt-shape-font-color-1"></i>
                    Mail
                 </a>
                <a href="/orden-servicio-gen/{{$os->gos_os_id}}/imprimirrefacciones" target="_blank" type="button"  class="btn btn-outline-secondary " >
                  <i class="-square"></i>
                      <i class="fas fa-print kt-shape-font-color-1"></i>
                    Imprimir
                </a>
                <button type="button" id="btn_Refaccion" class="btn btn-success  btn-md"  onclick="atorizarallrefac({{$os->gos_os_id}});">
                  Autorizar
                </button>
                <button type="button" id="btn_Refaccionentregar" class="btn btn-success btn-md"  onclick="entregarallrefac({{$os->gos_os_id}});">
                  Entregar
                </button>
                <button type="button" id="btn_Refaccionportal" class="btn btn-success btn-md"  onclick="portalallrefac({{$os->gos_os_id}});">
                  Portal
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body" >
     <!---------------------------------------------------Form begin--------------------------------------------------------------------------------------------------------------------------------------->

    <div class="container-fluid">
      <form class="kt-form kt-form--label-right m-3" id="refaccioness_form">
        @csrf
        <input type="hidden" name="gos_os_refaccion_id" id="gos_os_refaccion_id" value="0">
        <input type="hidden" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}}">
         <div class="form-row m-3" >
          <div class="col-6 col-md-4 col-lg-2">
            <label style="font-size: 1rem;">Nombre</label>
            <div class="input-group" id="selnombreref">
              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="Nombre" id="nomb_refaccion">
                @isset($listaConceptos)
                  <option value="0"></option>
                  @foreach ($listaConceptos as $concepto)
                  <option value="{{$concepto->gos_pres_concepto_id}}"> {{$concepto->nomb_concepto}}</option>
                  @endforeach
                  <option value="0"></option>
                @else
                  <option value="0"></option>
                @endisset
              </select>
                        <div class="input-group-append">
                          <button class="btn btn-brand p-1" type="button"name="button" onclick="getselectrefaciones();">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                        </div>
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2 ">
            <label style="font-size: 1rem;">Proveedor</label>
            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="proveedor" id="proveedor" onchange="MostrarSelectProveedor(this);">
                  <option value="0"></option>
                 @foreach ($listaProveedor as $proveedor)
                <option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nomb_proveedor ?? ''}}</option>
                @endforeach
            </select>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <label style="font-size: 1rem;">Email</label>
            <input type="email" class="form-control" name="proveedor_email" id="proveedor_email" value="" disabled>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
              <label >Fechas Solicitud</label>
                <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" value="{{$fechahoy}}">

          </div>
          <div class="col-6 col-md-4 col-lg-2">
              <label >Fecha Promesa</label>
                <input type="date" class="form-control" name="fecha_promesa" id="fecha_promesa"  value="">

          </div>
          <div class="col-2 col-md-1 ">
               <br>
              <button type="button" id="btn_Refaccion" class="btn btn-success m-2" onclick="Agregaritem();">
                <i class="fas fa-plus p-0"></i>
              </button>
        </div>
        <div class="col-2 col-md-1">

        </div>
      </form>
    </div>
   <!---------------------------------------------------Form end---------------------------------------------------------------------------------------------------------------------------------------->

  <!-------------------------------------------------------------------------------table------------------------------------------------------------------------------------------------------------------->
     <div class="container-fluid">
       <form class=""method="post" id="dtreffrom">
       <div class="table-responsive p-1 " style="margin-top: 10px;">
           <table class="table table-sm table-hover" id="dt-Refacciones">
               <thead class="thead-light">
                   <tr style="width:100%;">
                       <th>ID</th>
                       <th>Nombre</th>
                       <th># Parte</th>
                       <th >Observaciones</th>
                       <th>Proveedor</th>
                       <th>Fechas</th>
                       <th >Estatus</th>
                       <th >Ubicación</th>
                       <th style="width:3%;" >Recibido</th>
                       <th style="width:3%;">Entregado</th>
                       <th style="width:3%;" >Portal</th>
                       <th style="width:3%;"></th>
                   </tr>
               </thead>
               <tbody>
               </tbody>
           </table>
       </div>
       <button style="width:30%; margin: 0 auto;" type="button" class="btn btn-success btn-block" id="btnGuardarRefaccion" onclick="GuardarRefacciones();">Guardar</button>
     </form>
     </div>
  <!-------------------------------------------------------------------------------table------------------------------------------------------------------------------------------------------------------->


   <!--------------------------------------------------------------------------------Comentarios------------------------------------------------------------------------------------------------------------->
       <div style="margin:2% 0;"class="mt-5">
      <div class="row d-flex justify-content-center mt-2">
        <h5>Comentarios</h5>
      </div>
      <div class="row d-flex justify-content-center">
          <button type="button"  class="btn btn-success  m-2" onclick="displaycomentariosrefacciones();">
            <i class="fas fa-plus kt-shape-font-color-1"></i>
            Añadir Comentario
          </button>
          <button type="button"  class="btn btn-success  m-2" onclick="displaycomentariosrefaccioneshistorial();">
            <i class="fas fa-comments kt-shape-font-color-1"></i>
            historial Comentarios
          </button>
      </div>
    </div>
                   <!---------------------------------dropdown1--------------------------------------->
                   <div class="container-fluid  mt-3" id="dropdown-comentarios" style="display: none;">
                       <div class="card">
                         <div class="card-header bg-primary text-light" >
                         Comentarios
                         </div>
                         <div class="card-body">
                          <form class="" action="/orden-servicio-gen/{{$os->gos_os_id}}/refacciones/guardarcomentario" method="post">
                            @csrf

                           <div class="row ">
                             <div class="col-6 col-md-3">
                               <label for="">Proveedor</label>
                               <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="cmprovedor[]" id="cmprovedor" multiple onchange="changeproveedormensaje(this);">
                                       @foreach ($listaprovconrefac as $proveedor)
                                       <option value="{{$proveedor->gos_proveedor_id}}">{{$proveedor->nomb_proveedor ?? ''}}</option>
                                       @endforeach
                               </select>
                             </div>
                             <div class="col-6  col-md-3">
                              <label for="">Equipo De Trabajo</label>
                              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="cmequipotrabajo[]" id="cmetrabajo" multiple>
                                <?php foreach ($equipodetrabajo as $usr): ?>
                                <option value="{{$usr->gos_usuario_id}}">{{$usr->nombre_apellidos}}</option>
                                <?php endforeach; ?>
                              </select>
                             </div>
                             <div class="col-6 col-md-3">
                               <label for="">Estatus</label>
                               <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="cmestatusrefa" id="cmeestatus" onchange="changeestatusmensaje();">
                               <option value="0"></option>
                               <option value="1">En Proceso</option>
                               <option value="2">Autorizadas</option>
                               <option value="3">Por Entregar</option>
                               <option value="4">Vencidas</option>
                               <option value="5">Recibidas</option>
                               </select>
                             </div>
                             <div class="col-6  col-md-3">
                               <label for="">Correo Externo</label>
                               <input type="text" class="form-control"  name="cmcorreoexterno" value="" placeholder="direccion , direccion , direccion ">
                             </div>
                           </div>
                           <div class="container-fluid">
                             <div class="row">
                               <div class="col-9">
                                 <label for="">comentarios:</label>
                                <textarea name="cmobservaciones" style="width: 100%; height: 10rem;">  </textarea>
                                <button type="submit" class="btn btn-block btn-info" >Guardar</button>
                               </div>
                               <div class="col-3">
                                 <br>
                                <div class="card">
                                 <div class="card-header">Piezas</div>
                                 <div class="card-body" id="appendpiezasrefacciones">
                                 </div>
                                </div>
                               </div>
                             </div>

                           </div>
                           </form>
                         </div>
                       </div>
                     </div>
                   <!---------------------------------dropdown2--------------------------------------->
                   <div class="container-fluid" id="ddownhismensajes"  style="display: none;">
                     <div class="card mt-3">
                      <div class="card">
                          <div class="card-header bg-dark text-light">Historial</div>
                           <div class="card-body">
                             <table class="table table-sm table-hover dataTable no-footer"  role="grid" >
                                  <tr>
                                    <th>Nombre</th><th>Fecha</th><th>Comentario</th>

                               <?php foreach ($comentariosrefaccion as $comen): ?>

                                    </tr>
                                    <?php $nombre="ND"; $mail="no";
                                      foreach ($equipodetrabajo as $usr) {
                                        if ($usr->gos_usuario_id==$comen->gos_usuario_id){$nombre=$usr->nombre_apellidos;}
                                      }
                                     ?>
                                    <tr>
                                    <td style="width: 12rem;">{{$nombre}}</td>
                                    <td style="width: 12rem;">{{$comen->fecha}}</td>
                                    <td >{{$comen->cuerpo}}</td>
                                    </tr>


                               <?php endforeach; ?>
                             </table>
                          </div>
                        </div>
                      </div>
                    </div>
   <!--------------------------------------------------------------------------------Comentarios------------------------------------------------------------------------------------------------------------->


    <!-------------------------------------------------------------------------------------MODALES----------------------------------------------------------------------------------------------------------->

    <div class="modal "  id="modalrefaccionesProvedor" tabindex="-1" role="dialog">
      <div class="modal-dialog " role="document">
        <div class="modal-content border">
          <div class="modal-header  " style="background-color:#27395c; ">
            <h5 class="modal-title" style="color: white;">Asignar Provedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-light" >
           <div class="row" id="asignarporvrefdiv">
              <div class="col-6">
                <label for="">Provedor:</label>
                <select class="form-control" name="" id="selectprovedorrefac">
                   <option value="0">Asignar Provedor</option>
                   <?php if ($listaProveedor!=NULL): ?>
                     <?php foreach ($listaProveedor as $provedor): ?>
                        <option value="{{$provedor->gos_proveedor_id}}">{{$provedor->nomb_proveedor}}</option>
                     <?php endforeach; ?>
                   <?php endif; ?>
                </select>

              </div>
              <div class="col-6">
                <label for="">Fecha Promesa</label>
                <input type="date" class="form-control" name="" value="" id="refaprovfp">
              </div>
              <div class="col-4 offset-8">
                <button type="button" name="button" class="btn btn-outline-info btn-sm mt-3" onclick="dropdwnagregarprovref(1)">Agregar Provedor</button>
              </div>
           </div>

           <div class="container border p-3 mt-2" id="dropdwnaddprovref" style="display: none;">
            <form class="" action="index.html" method="post" id="formnuevoprovasignar">
              <input type="hidden" name="gos_os_refaccion_id2" id="gos_os_refaccion_id2" value="0">
              <div class="form-row ">
                <div class="form-group col-md-6">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" id="nombreprov" name="nombreprov" >
                </div>
                <div class="form-group col-md-6">
                  <label for="">Contacto</label>
                  <input type="text" class="form-control" id="contactoprov" name="contactoprov" >
                </div>
                <div class="form-group col-md-6">
                  <label for="">Telefono</label>
                  <input type="number" class="form-control" id="telprov"  name="telprov" >
                </div>
                <div class="form-group col-md-6">
                  <label for="">Email</label>
                  <input type="email" class="form-control" id="mailprov"  name="mailprov" >
                </div>
                <div class="form-group col-md-12">
                  <label for="">Fecha Promesa</label>
                  <input type="date" class="form-control" id="fpprov" name="fpprov" >
                </div>
                <div class="form-group col-md-6">
                   <button type="button" class="btn btn-primary btn-block" onclick="AgregarProvyasignarref()">Agregar Y Asignar</button>
                </div>
                <div class="form-group col-md-6">
                   <button type="button" class="btn btn-secondary btn-block"  onclick="dropdwnagregarprovref(0)">Ocultar</button>
                </div>
              </div>
            </form>
           </div>
          </div>
          <div class="modal-footer bg-light">
             <button type="button" class="btn btn-primary" id="btnsaveprovref" onclick="AsignarProvRefac();">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal border"  id="modalrefaccionesCancelar" tabindex="-1" role="dialog">
      <div class="modal-dialog " role="document">
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
                  <option value="{{$cancelado->gos_os_refaccion_estatus_id}}">{{$cancelado->estatus_refaccion}}</option>
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

    <!-------------------------------------------------------------------------------------MODALES----------------------------------------------------------------------------------------------------------->
    </div>
    </div>
@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-refacciones.js"></script>
@endsection
