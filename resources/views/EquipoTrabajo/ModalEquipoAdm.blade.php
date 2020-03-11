<div class="modal fade" id="ModalEquipoAdm" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalEquipoAdm"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @include('Layout/errores')
                <form role="form" id="UsuarioAdmForm" name="UsuarioAdmForm">
                    @csrf
                    <input type="hidden" name="gos_usuario_rol_id" value="1">
                    <input type="hidden" name="gos_usuario_id" id="gos_usuario_admin_id">
                    <div class="form-group">
                        <label>Puesto</label>
                          <!-- <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_usuario_perfil_id" id="gos_usuario_perfil_id_ADM">
                                  <option></option>
                              @foreach ($listaPerfiles as $perfil)
                                  @if ($perfil->gos_usuario_rol_id == 1)
                                  <option value="{{$perfil->gos_usuario_perfil_id}}">{{$perfil->nomb_perfil}}</option>
                                  @endif
                              @endforeach
                          </select> -->

                        <div class="input-group">
                            <select class="form-control kt-selectpicker" title="Selecciona o ingresa un Perfil " data-size="6" data-live-search="true" id="gos_usuario_perfil_id_ADM" name="gos_usuario_perfil_id">

                            <option value="0">Agregar</option>
                            @foreach ($listaPerfiles as $perfil)
                                @if ($perfil->gos_usuario_rol_id == 1)
                                <option value="{{$perfil->gos_usuario_perfil_id}}">{{$perfil->nomb_perfil}}</option>
                                @endif
                            @endforeach


                            <!-- <input type="hidden" value="" id="pregunta_id_nueva" name="pregunta_id_nueva" > -->
                            </select>





                        <small style="font-style: italic;" class="gos_usuario_perfil_id form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Seguimiento empresa o aseguradora</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_seguimiento_id[]" id="gos_aseguradora_seguimiento_id_ADM"
                        data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" multiple>
                            @foreach ($listaAseguradora as $aseguradora)
                            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                            @endforeach
                        </select>
                        <small style="font-style: italic;" class="gos_aseguradora_seguimiento_id form-text text-danger"></small>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nombre(s)</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_ADM">
                            <small style="font-style: italic;" class="nombre form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label>Apellido(s)</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos_ADM">
                            <small style="font-style: italic;" class="apellidos form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email (Usuario)</label>
                        <input type="email" class="form-control" name="email" id="email_ADM">
                        <small style="font-style: italic;" class="email form-text text-danger"></small>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="clave" id="clave_ADM">
                            <small style="font-style: italic;" class="clave form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label>Repetir contraseña</label>
                            <input type="password" class="form-control" name="clave_validacion" id="clave_validacion_ADM">
                            <small style="font-style: italic;" class="clave_validacion form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" name="sueldo" id="sueldo_ADM">
                        </div>
                        <small style="font-style: italic;" class="sueldo form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Pagar comision sobre compañias</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_comision_id[]" id="gos_aseguradora_comision_id_ADM"
                        data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" multiple>
                            @foreach ($listaAseguradora as $aseguradora)
                            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                            @endforeach
                        </select>
                        <small style="font-style: italic;" class="gos_aseguradora_comision_id form-text text-danger"></small>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Comisión</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text ComisionPesoAdm">$</button>
                                    <button type="button" class="input-group-text ComisionPorcientoAdm d-none">%</button>
                                </div>
                                <input type="hidden" name="comision_tipo" id="comision_tipo_ADM" value="PESOS">
                                <input type="text" name="monto_comision" id="monto_comision_ADM" class="form-control">
                            </div>
                            <small style="font-style: italic;" class="form-text text-danger" id="monto_comision_mjs_ADM"></small>
                        </div>
                        <div class="col-6">
                            <label>M.O o Total de orden</label>
                            <select class="form-control kt-selectpicker" name="gos_usuario_segmenta_comi_id" id="gos_usuario_segmenta_comi_id">
                                <option></option>
                                @foreach ($listaSegmentacion as $segmentacion)
                                    <option value="{{$segmentacion->gos_usuario_segmenta_comi_id}}">{{$segmentacion->nomb_segmentacion}}</option>
                                @endforeach
                            </select>
                            <small style="font-style: italic;" class="form-text text-danger" id="gos_usuario_segmenta_comi_id_ADM"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Genero</label>
                        <select class="form-control kt-selectpicker" name="genero" id="genero_ADM">
                            <option value="MASCULINO">Masculino</option>
                            <option value="FEMENINO">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Almacen</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="almacen" id="almacen_ADM" multiple>
                            <option></option>
                        </select>
                        <small style="font-style: italic;" class="almacen form-text text-danger"></small>
                    </div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body p-0">
                            <div class="accordion accordion-light">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="card-title" data-toggle="collapse" data-target="#masDatosAdm" aria-expanded="false" aria-controls="masDatosAdm">
                                            <i class="flaticon2-plus"></i> Agregar Mas datos
                                        </div>
                                    </div>
                                    <div id="masDatosAdm" class="collapse" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-6 mt-4">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control" name="telefono" id="telefono_ADM">
                                                    <small style="font-style: italic;" class="telefono form-text text-danger"></small>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <label>Domicilio</label>
                                                    <input type="text" class="form-control" name="domicilio" id="domicilio_ADM">
                                                    <small style="font-style: italic;" class="domicilio form-text text-danger"></small>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <label>Fecha de contratación</label>
                                                    <input type="text" class="form-control kt_datepicker_2" name="fecha_contratacion" id="fecha_contratacion_ADM">
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <label>Fecha nacimiento</label>
                                                    <input type="text" class="form-control kt_datepicker_2" name="fecha_nacimineto" id="fecha_nacimineto_ADM">
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <label># seguro social</label>
                                                    <input type="text" class="form-control" name="nro_seguro_social" id="nro_seguro_social_ADM">
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <label>Numero de empleado</label>
                                                    <input type="text" class="form-control" name="nro_empleado" id="nro_empleado_ADM">
                                                    <small style="font-style: italic;" class="nro_empleado form-text text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-block mt-2" id="btnGuardarUsuarioAdmin">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
