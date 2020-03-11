<div class="modal fade" id="kt_modal_7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 116rem;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar servicios/MO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
              <ul class="nav nav-pills my-4">
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-Paquete" href="#collapsePaquete"  style="display: none">
                    <i class="fas fa-plus"></i>Paquete/MO
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-Servicio" href="#collapseServicio"  style="display: none">
                    <i class="fas fa-plus"></i>Servicio/MO
                  </a>
                </li>
              </ul>

            <input id="gos_os_id_serv" type="hidden" value="{{isset($os)? $os->gos_os_id:0 }}"/>
              <div class="tab-content">
                 <div class="tab-pane" id="collapsePaquete" role="tabpanel">
                  <form class="kt-form kt-form--label-right" id="paquete_form">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-3 mb-2">
                        <label style="font-size: 1rem;">Paquete</label>
                        <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="gos_paq_etapa_id" id="gos_paq_etapa_id" onchange="MostrarSelectPaquete();">
                          <option value=0></option>
                             <?php if ($listaPaquetes!=null): ?>
                               <?php foreach ($listaPaquetes as $paquete): ?>
                                       <option value="{{$paquete->gos_paquete_id}}">{{$paquete->nomb_paquete}}</option>
                               <?php endforeach; ?>
                             <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group col-3 mb-2">
                        <label style="font-size: 1rem;">Descripción</label>
                        <input type="text" class="form-control" name="descripcion_paquete" id="descripcion_paquete" value="" disabled>
                      </div>
                      <div class="form-group col-3 mb-2">
                        <label style="font-size: 1rem;">Cantidad</label>
                        <input type="text" class="form-control" name="gos_paquete_cantidad" id="gos_paquete_cantidad" value="" disabled>
                      </div>
                      <div class="form-group col-2 mb-2">
                        <label style="font-size: 1rem;">P.venta</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text p-1">$</span>
                          </div>
                          <input type="text" class="form-control pl-1 pr-0" name="gos_paquete_venta" id="gos_paquete_venta" value="">
                        </div>
                      </div>
                      <div class="col-1 align-self-end">
                          <button type="button" id="btn_ItemItemPaquete" class="btn btn-success mb-2" style="height:35.6px;">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                      </div>

                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="collapseServicio" role="tabpanel">
                  <form class="kt-form kt-form--label-right" id="servicio_form">
                    @csrf

                    <div class="form-row">
                      <div class="form-group col-3 mb-2">Servicio</label>
                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_servicio_id" id="gos_servicio_id" onchange="MostrarSelectServicio(this);">
                          <option value=0></option>
                             <?php if ($listaServicios!=null): ?>
                               <?php foreach ($listaServicios as $servicio): ?>
                                       <option value="{{$servicio->gos_paq_servicio_id}}">{{$servicio->nomb_servicio}}</option>
                               <?php endforeach; ?>
                             <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group col-3 mb-2">Etapa</label>
                        <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_Etapa_id" id="gos_Etapa_id" onchange="MostrarSelectServicio(this);">
                          <option value=0></option>
                             <?php if ($listaServicios!=null): ?>
                               <?php foreach ($listaServicios as $servicio): ?>
                                       <option value="{{$servicio->gos_paq_servicio_id}}">{{$servicio->nomb_servicio}}</option>
                               <?php endforeach; ?>
                             <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group col-3 mb-2">
                        <label style="font-size: 1rem;">Descripción</label>
                        <input type="text" class="form-control" name="descripcion_servicio" id="descripcion_servicio"  value="">
                      </div>
                      <div class="form-group col-1 mb-1">
                        <label style="font-size: 1rem;">Cantidad</label>
                        <input type="number" class="form-control pl-1 pr-0" name="gos_servicio_cantidad" id="gos_servicio_cantidad" value="">
                      </div>
                      <div class="form-group col-1 mb-1">
                        <label style="font-size: 1rem;">P.Venta.</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text p-1">$</span>
                          </div>
                          <input type="number" class="form-control pl-1 pr-0" name="gos_servicio_venta" id="gos_servicio_venta" value="">
                        </div>
                      </div>
                      <div class="col-1 mb-2 align-self-end">
                          <button type="button" id="btn_ItemServicio" class="btn btn-success" style="height:35.6px;" onclick="AgregarServicio();">
                            <i class="fas fa-plus p-0" style="color: white!important;"></i>
                          </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

            <form id="formtableServicios">
              <div class="table-responsive table-sm p-1">
                <table class="table table-sm table-hover" id="dt-Servicios">
                  <thead class="thead-light">
                    <tr >
                      <th class="p-2">ID</th>
                      <th class="p-2">Nombre</th>
                      <th class="p-2">Descripcion</th>
                      <th class="p-2 text-nowrap">Código SAT</th>
                      <th class="p-2">Técnico</th>
                      <th class="p-2">Etapa</th>
                      <th class="p-2" style="width:5%;">M.O</th>
                      <th class="p-2" style="width:5%;">Descuento</th>
                      <th class="p-2"style="width:5%;">Precio</th>
                      <th class="p-2"style="width:3%;">Fin</th>
                      <th style="width:3%;"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </form>
            <button style="width:30%; margin: 2% auto;" type="button" class="btn btn-success btn-block" id="btnGuardarServicios" onclick="GuardarServicio();">Guardar</button>
          </div>
        </div>
      </div>
  </div>


  <div class="modal fade" id="modalAsignarAsesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tecnico Original:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form" id="formTecnicoServicios">
            <input type="text" hidden id="Sinput" name="PorcCant" value="%">
            <input type="text" hidden id="OSitemid" name="OSitemid"value="">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="">Tecnico</label>
                <select class="form-control kt-selectpicker" data-size="6" data-live-search="true"  name="Tecnico" id="selectecnico" onchange="getParamsTec(this.value)">
                  <option value="0"></option>
                    <?php if ($listaTecnicos!=null): ?>
                      <?php foreach ($listaTecnicos as $tecnico): ?>
                              <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->nombre_apellidos}} | {{$tecnico->perfil}}</option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 mb-4">
                <label id="lbltec">Porcentaje</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="input-group-text" id="btntec" name="porcentaje"onclick="tecnicopc()">%</button>
                  </div>
                  <input type="number" min="0"  name="inputPoP" id="inputPoPid" class="form-control" >
                </div>
              </div>
              <div class="col-md-2 mb-2" style="display :none" id="swctec">
                <label for="">Cantidad</label>
                 <input type="number" min="0" step="any" class="form-control" name="Cantidad" id="Cantidadid"value="" >
              </div>
            </div>

           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="postAsesor();">Guardar</button>
        </div>
      </div>
    </div>
  </div>
