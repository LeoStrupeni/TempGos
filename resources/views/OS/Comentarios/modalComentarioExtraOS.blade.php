<div class="modal fade" id="modalcomentario" tabindex="0" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar comentario extra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @include('Layout/errores')
                <form action="/osg-comentario-extra" method="post">
                    @csrf
                    <input type="hidden" id="celular_cliente" value="{{$os->celular}}" >
                    <input type="hidden" name="gos_os_id" value="{{$os->gos_os_id}}" >
                    <input type="hidden" name="gos_usuario_id" value="{{$usuario}}">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" rows="5" id="mensaje" name="mensaje"></textarea>
                    </div>
                    <div class="form-groupm text-center">
                        <label for="boton-archivo">
                            <i class="fas fa-camera fa-8x border border-success rounded-circle p-5 text-success"
                            style="border-width: 10px !important;"></i>
                        </label>
                        <input id="boton-archivo" type="file" style="display:none;"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label>Prioridad</label>
                            <select class="form-control" name="Prioridad">
                                <option value="0" selected>Normal</option>
                                <option value="1">Alta</option>
                            </select>
                        </div>
                        <div class="form-group col-4 text-center">
                            <span class="form-text text-muted">Visible Cliente</span>
                            <label class="kt-checkbox kt-checkbox--solid">
                                <input type="checkbox" name="visibleCliente">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Notificar equipo de Trabajo</label>
                        <select name="gos_usuario_envio[]" class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" multiple>
                            @isset($listaAdmin)
                                @foreach ($listaAdmin as $equipo)
                                <option value="{{$equipo->gos_usuario_id}}">
                                    {{$equipo->apellidos}}, {{$equipo->nombre}}
                                </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Notificar por Email  <input type="checkbox"  name="checkmailcomentarioos" ></label>
                        <input type="text" class="form-control" name="os_envio_email" >
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a class="" id="enviar-whatsapp" target="_blank" style="-webkit-text-stroke-width: medium;">
                            <div class="kt-demo-icon kt-font-success">
                                <div class="kt-demo-icon__preview">
                                    <i class="socicon-whatsapp"></i>
                                </div>
                                <div class="">
                                    Enviar Whatsapp
                                </div>
                            </div>
                        </a>
                    </div>
                    <button type="button" id="btnGuardarComentario"class="btn btn-block btn-primary" >Enviar</button>
                    <button type="submit" id="submitbtnGuardarComentario"class="btn btn-block btn-secondary" style="display: none;">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
