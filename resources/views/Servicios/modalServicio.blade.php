<div class="modal fade" id="modalServicio" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalServicio"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                    @include('Layout/errores')
                <form id="servicioForm">
                    @csrf                    
                    <input type="hidden" name="gos_paq_servicio_id" id="gos_paq_servicio_id">
                    <div class="form-group row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Nombre del servicio</label>
                                <input type="text" class="form-control" name="nomb_servicio" id="nomb_servicio" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Descripción del servicio</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Técnico</label>
                                <select class="form-control" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id" required>
                            
                            <option value="0" selected> Sin Tecnico</option>
                            @isset($listaUsuariosTecnicos)
                            @foreach ($listaUsuariosTecnicos as $usuarioTecnico)
                            <option value="{{$usuarioTecnico->gos_usuario_tecnico_id}}">{{$usuarioTecnico->apellidos}}, {{$usuarioTecnico->nombre}}</option>
                            @endforeach
                            @endisset
                            </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" id="btnGuardarServicio" class="btn btn-success btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
