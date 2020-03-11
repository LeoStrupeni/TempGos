<div class="modal fade" id="modalMensaje" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalMensaje"></h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                    @include('Layout/errores')
                <form id="MensajeForm">
                    @csrf              
                    <?php $auth = Session::get('Ordenes');
                    if($auth == null)
                    {
                    $auth=0;
                    }
                    else {
                    $auth = $auth[0]->eliminar;
                    }
                    if ($auth): ?>      
                    <div class="d-flex justify-content-center form-group">
                    <button id="btn-mensaje-respondido" name="btn-mensaje-respondido"  type="button" class="btn btn-success btn-block">Marcar como respondido </button>
                    </div>
                    <?php endif ?>
                    
                    <div class="form-group row" id ='m_mensaje' style="text-align:left;">
                              
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
