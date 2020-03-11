
<div class="modal fade" id="modal-fecha-ingreso" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar fecha de ingreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="fecha-ingreso-form">
                  @csrf
                  <div class="kt-portlet__body p-0">
                      <div class="form-group">
                          <label style="font-size: 1rem;">Fecha de ingreso</label>
                          <input type="hidden" name="gos_os_id" id="gos_os_id" >
                          <div class="input-group date" >
                                <input type="text" class="form-control" placeholder="Selecciona fecha y hora" name="fecha_entrega" id="kt_datetimepicker_2" value="<?= date("Y-m-d h:i:s")?>" />
                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="la la-calendar glyphicon-th"></span>
                                    </div>                                    
                                </span>
                            </div>
                      </div>
                      <button type="button" class="btn btn-success btn-block" id="btnGuardarFechaingreso">Guardar</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
