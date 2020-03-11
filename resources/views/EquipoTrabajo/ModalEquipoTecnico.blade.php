<div class="modal fade" id="modalEquipoTecnico" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalEquipoTecnico"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
                <form role="form" id="UsuarioTecnicoForm" name="UsuarioTecnicoForm">
                    @csrf
                    <input type="hidden" name="gos_usuario_rol_id" value="2">
                    <input type="hidden" name="gos_usuario_id" id="gos_usuario_tecnico_id">
                    <div class="form-group">
                        <label>Puesto</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_usuario_perfil_id" id="gos_usuario_perfil_id_TEC">
                                <option></option>
                            @foreach ($listaPerfiles as $perfil)
                                @if ($perfil->gos_usuario_rol_id == 2)
                                <option value="{{$perfil->gos_usuario_perfil_id}}">{{$perfil->nomb_perfil}}</option>
                                @endif
                            @endforeach
                        </select>
                        <small style="font-style: italic;" class="gos_usuario_perfil_id form-text text-danger"></small>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Servicios</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_paq_servicio_id[]" id="gos_paq_servicio_id_TEC" multiple>
                                <option></option>
                                @foreach ($listaServicios as $servicio)
                                <option value="{{$servicio->gos_paq_servicio_id}}">{{$servicio->nomb_servicio}}</option>
                                @endforeach
                            </select>
                            <small style="font-style: italic;" class="gos_paq_servicio_id form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label>Comisión</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text ComisionPesoTecnico">$</button>
                                    <button type="button" class="input-group-text ComisionPorcientoTecnico d-none">%</button>
                                </div>
                                <input type="hidden" name="tipo_comision" id="tipo_comision_TEC" value="PESOS">
                                <input type="text" name="monto_comision" id="monto_comision_TEC" class="form-control">
                            </div>
                            <small style="font-style: italic;" class="monto_comision form-text text-danger"></small>
                        </div>
                        <div class="col-6 mt-4">
                            <label>Comisión por materiales externos</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text ComisionMaterialesPesoTecnico">$</button>
                                    <button type="button" class="input-group-text ComisionMaterialesPorcientoTecnico d-none">%</button>
                                </div>
                                <input type="hidden" name="tipo_comision_materiales" id="tipo_comision_Materiales_TEC" value="PESOS">
                                <input type="text" name="monto_comision_materiales" id="monto_comision_Materiales_TEC" class="form-control">
                            </div>
                            <small style="font-style: italic;" class="monto_comision_materiales form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nombre(s)</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_TEC">
                            <small style="font-style: italic;" class="nombre form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label>Apellido(s)</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos_TEC">
                            <small style="font-style: italic;" class="apellidos form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email (Usuario)</label>
                        <input type="email" class="form-control" name="email" id="email_TEC">
                        <small style="font-style: italic;" class="email form-text text-danger"></small>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="clave" id="clave_TEC">
                            <small style="font-style: italic;" class="clave form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label>Repetir contraseña</label>
                            <input type="password" class="form-control" name="clave_validacion" id="clave_validacion_TEC">
                            <small style="font-style: italic;" class="clave_validacion form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" name="sueldo" id="sueldo_TEC">
                        </div>
                        <small style="font-style: italic;" class="sueldo form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Genero</label>
                        <select class="form-control" data-live-search="true" data-size="5" name="genero" id="genero_TEC">
                            <option value="MASCULINO">Masculino</option>
                            <option value="FEMENINO">Femenino</option>
                        </select>
                        <small style="font-style: italic;" class="genero form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Almacen</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="almacen" id="almacen_TEC" multiple>
                            <option></option>
                        </select>
                    </div>
                    <div class="kt-portlet ">
                        <div class="kt-portlet__body p-0">
                            <div class="accordion accordion-light">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="card-title" data-toggle="collapse" data-target="#masDatosTecnico" aria-expanded="false" aria-controls="masDatosTecnico">
                                            <i class="flaticon2-plus"></i> Agregar Mas datos
                                        </div>
                                    </div>
                                    <div id="masDatosTecnico" class="collapse" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control" name="telefono" id="telefono_TEC">
                                                    <small style="font-style: italic;" class="telefono form-text text-danger"></small>       
                                                </div>
                                                <div class="col-6">
                                                    <label>Domicilio</label>
                                                    <input type="text" class="form-control" name="domicilio" id="domicilio_TEC">
                                                    <small style="font-style: italic;" class="domicilio form-text text-danger"></small>
                                                </div>

                                                <div class="col-6">
                                                    <label>Fecha de contratación</label>
                                                    <input type="text" class="form-control kt_datepicker_2" name="fecha_contratacion" id="fecha_contratacion_TEC">
                                                </div>
                                                <div class="col-6">
                                                    <label>Fecha nacimiento</label>
                                                    <input type="text" class="form-control kt_datepicker_2" name="fecha_nacimineto" id="fecha_nacimineto_TEC">
                                                </div>
                                                <div class="col-6">
                                                    <label># seguro social</label>
                                                    <input type="text" class="form-control" name="nro_seguro_social" id="nro_seguro_social_TEC">
                                                </div>
                                                <div class="col-6">
                                                    <label>Numero de empleado</label>
                                                    <input type="text" class="form-control" name="nro_empleado" id="nro_empleado_TEC">
                                                    <small style="font-style: italic;" class="nro_empleado form-text text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-block mt-2" id="btnGuardarUsuarioTecnico">Guardar</button>
                </form> 
            </div>
        </div>
    </div>
</div>