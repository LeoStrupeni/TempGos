
<div class="modal fade" id="modal-fecha-promesa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar fecha de promesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="fecha-promesa-form">
                  @csrf
                  <div class="kt-portlet__body p-0">
                      <div class="form-group">
                          <label style="font-size: 1rem;">Fecha de promesa</label>                         
                            <div class="input-group date" id="kt_datetimepicker_2">
                                <input type="text" class="form-control" placeholder="Selecciona fecha y hora" name="fechaPromesa" id="fechaPromesa" readonly/>
                                <span class="input-group-addon">
                                    <div class="input-group-text">
                                        <span class="la la-calendar glyphicon-th"></span>
                                    </div>                                    
                                </span>
                            </div>
                          
                          <input type="hidden" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}}">
                      </div>
                      <button type="button" class="btn btn-success btn-block" id="btnGuardarFechaPromesa">Guardar</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
