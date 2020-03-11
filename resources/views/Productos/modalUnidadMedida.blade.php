<div class="modal fade" id="modalUnidadMedida" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModalUnidadMedida"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @include('Layout/errores')
                <form id="unidad-medida-form">
                    {{csrf_field()}}


                            <div class="kt-portlet__body p-0">
                                <div class="form-group">
                                      <label>Nombre</label>
                                    <input type="text" class="form-control mt-4" name="nomb_medida" id="nomb_medida"
                                    value="">
                                </div>
                                <div class="form-group">
                                      <label>Nomenclatura</label>
                                      <input type="text" class="form-control mt-4" name="nomen" id="nomen"
                                      value="">
                                </div>
                                <button style="margin-top:5%;" type="button" class="btn btn-success btn-block" id="btnGuardarUnidadMedida">Guardar</button>
                                <input type="hidden" id="app_url" name="app_url" url=".." />
                            </div>
                    </form>
             </div>
            </div>
        </div>
    </div>
