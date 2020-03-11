<div class="mt-5">
    <div class="row">
        <div class="col-2 m-auto">
            <h5>Comentarios</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-1 m-auto">
            <button type="button" class="btn btn-success btn-elevate-hover btn-circle btn-icon" data-toggle="modal" data-target="#modalcomentario">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    @include('OS/modalComentarioExtraOS')

    <!--begin::Accordion-->
    <div class="accordion accordion-toggle-arrow mt-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title collapsed" data-toggle="collapse" data-target="#listacomentarioEquipo" aria-expanded="false">
                    <i class="flaticon-search"></i> Equipo - @isset($mensajeEquipo) {{$mensajeEquipo->count($mensajeEquipo->id_mensaje)}} @endisset
                </div>

            </div>
            <div id="listacomentarioEquipo" class="collapse">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover datatablaList">
                            <thead class="thead-light">
                                <tr>
                                    <th>Prioridad</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($listaMensajesEquipo)
                                    @foreach($listaMensajesEquipo as $mensaje)
                                    <tr>
                                        <td>{{$mensaje->prioridad}}</td>
                                        <td>{{$mensaje->Fecha}}</td>
                                        <td>{{$mensaje->Nombre}}</td>
                                        <td>{{$mensaje->Imagen}}</td>
                                        <td>{{$mensaje->Comentario}}</td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title collapsed" data-toggle="collapse" data-target="#listacomentarioCliente" aria-expanded="false">
                    <i class="flaticon-search"></i> Cliente - @isset($clientesmensaje) {{$clientesmensaje->count($clientesmensaje->id_mensaje)}} @endisset
                </div>
            </div>
            <div id="listacomentarioCliente" class="collapse">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover datatablaList">
                            <thead class="thead-light">
                                <tr>
                                    <th>Prioridad</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($listaMensajesCliente)
                                    @foreach($listaMensajesCliente as $mensaje)
                                    <tr>
                                        <td>{{$mensaje->prioridad}}</td>
                                        <td>{{$mensaje->Fecha}}</td>
                                        <td>{{$mensaje->Nombre}}</td>
                                        <td>{{$mensaje->Imagen}}</td>
                                        <td>{{$mensaje->Comentario}}</td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
