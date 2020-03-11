@extends('Layout')

@section('Content')
<section id="clientes">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ 'Agregar/Editar usuario técnico' }}</div>
                  <div class="card-body">
                 <form method="POST" action="{{-- {{ isset($tecnico->gos_usuario_tecnico_id) ? route('tecnicos.store') : route('tecnicos.edit') }} --}}" enctype="multipart/form-data">
                          {{csrf_field()}}
                        <div class="form-group">
                          <label for="puesto">Puesto</label>
                            <select name="puesto" class="custom-select">
                              <option value=""></option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </div>
                          <div class="form-group">
                              <label for="parametro">Etapas</label>

                                    <select class="form-control kt-select2" id="kt_select2_3" name="parametro" multiple="multiple">
                                        <option value="PD" selected></option>
                                        <option value="E2">Ejemplo 2</option>
                                        <option value="E3">Ejemplo 3</option>
                                        <option value="E4">Ejemplo 4</option>
                                    </select>
                                </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <div class="form-group">
                               <label for="">Comisión</label>
                               <div class="input-group mb-6 mr-sm-2">
                                 <div class="input-group-prepend">
                                   <div class="input-group-text">%
                                   </div>
                                 </div>
                                 <input type="text" class="form-control" name="pago_materiales" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->monto_comision}} @endif --}}">
                               </div>
                             </div>
                           </div>
                          <div class="col-md-6">
                            <div class="form-group">
                             <label for="">Comisión materiales externos</label>
                             <div class="input-group mb-6 mr-sm-2">
                               <div class="input-group-prepend">
                                 <div class="input-group-text">%
                                 </div>
                               </div>
                               <input type="text" class="form-control" name="pago_materiales" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->pago_materiales}} @endif --}}">
                             </div>
                           </div>
                        </div>
                    </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="Nombres">Nombres(s)</label>
                              <input type="text" name="nombres" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->nombre}} @endif --}}" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="apellidos">Apellidos(s)</label>
                              <input type="text" name="apellidos" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->apellidos}} @endif --}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email">Email(Usuario)</label>
                          <input type="text" name="email" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->email}} @endif --}}" class="form-control">
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="contrasena">Contrasena</label>
                              <input type="text" name="contrasena" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->clave}} @endif --}}" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Repertir contrasena</label>
                              <input type="text" name="" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->clave_validacion}} @endif --}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="sueldo">Sueldo</label>
                          <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">$
                              </div>
                            </div>
                            <input type="text" class="form-control" name="sueldo" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->sueldo}} @endif --}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="">Género</label>
                            <select name="municipio" class="custom-select">
                              <option value=""></option>
                              <option value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->genero}} @endif --}}">masculino</option>
                              <option value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->genero}} @endif --}}">femenino</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="">Almacén</label>
                              <select name="municipio" class="custom-select">
                                <option value=""></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                              </select>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nombres">Teléfono</label>
                                  <input type="text" name="telfono" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->telefono}} @endif --}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="apellidos">Domicilio</label>
                                  <input type="text" name="domicilio" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->domicilio}} @endif --}}" class="form-control">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nombres">Fecha de contratación</label>
                                  <input type="text" name="fecha_contratacion " value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->fecha_contratacion}} @endif --}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                  <input type="text" name="fecha_nacimiento" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->fecha_nacimiento}} @endif --}}" class="form-control">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nombres">Número de seguro social</label>
                                  <input type="text" name="nro_seguro_social" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->nro_seguro_social}} @endif --}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="apellidos">Número de empleado</label>
                                  <input type="text" name="nro_empleado" value="{{-- @if(isset($tecnico->gos_usuario_tecnico_id)) {{$tecnico->nro_empleado}} @endif --}}" class="form-control">
                                </div>
                              </div>
                            </div>

                    <div class="col-md-12">
                      <button style="height:45px" type="submit" class="btn btn-success col-md-12">Guardar</button>
                    </div>
                      </form>
                  </div>
               </div>
             </div>
            </div>

    </section>
@endsection
