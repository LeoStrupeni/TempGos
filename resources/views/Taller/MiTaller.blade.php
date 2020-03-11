@extends('Layout' )
@section('Content')

{{-- {{dd(Session::all() )}} --}}


        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Mi Taller</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
              @if (session('notification'))
              <div class="alert alert-success">
               {{session('notification')}}
               </div> @endif

               @if (count($errors)>0)
                 <div class="alert alert-danger">
                   <ul>
                     <?php foreach ($errors->all() as $error): ?>
                       <li>
                         {{ $error }}
                       </li>
                     <?php endforeach; ?>
                   </ul>
                 </div>
              </div>

              @endif
                {{-- comienzo formulario --}}

                    {{-- <input type="hidden" name="gos_taller_id" id="gos_taller_id"> --}}
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet_
                            _head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mi-taller-datos" role="tab">Datos del taller</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datosFacturacion" role="tab">Datos de facturación</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tallerconfiguracion" role="tab">Configuración</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-----------------------DATOS DEL Taller-------------------->
                        <div class="kt-portlet__body">
                            <div class="tab-content">


                                <div class="tab-pane active" id="mi-taller-datos" role="tabpanel">
                                  <form id="taller-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="col-6 p-3">
                                            <div class="row">
                                              <div class="col-3"></div>
                                              <div class="col-6">
                                                <div class="card">
                                                <div class="card-footer">
                                                  <label class="btn btn-primary" role="button" style=" width: 3rem; height: 3rem; position: absolute; "><i class="fa fa-pen" style="margin-top: .5rem"></i>
                                                   <input type="file"  name="taller_lototipo"  accept=".png" onchange="readURL(this);" style=" display: none; " >
                                                  </label>
                                                  <img src="{{$logo ??''}}" alt="" id="blah"  style=" width: 100%;">
                                                  <small>archivo</small>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-3">
                                            </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label class="col-form-label">Nombre del Taller</label>
                                                    <input type="text" class="form-control" name="TallerNomb" value="{{$taller->taller_nomb ??''}}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="col-form-label">Id del Taller</label>
                                                    <input type="text" class="form-control" name="TallerCod" value="{{$taller->codigo_taller ??''}}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Nombre del propietario</label>
                                                    <input type="text" class="form-control" name="NombrePropietario"  value="{{$taller->propietario_nombre ??''}}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Apellido del propietario</label> <input type="text" class="form-control" name="PropietarioApellidos" value="{{$taller->propietario_apellidos ??''}}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Mobil del propietario</label>
                                                    <input type="text" class="form-control" name="CelularPropietario"  value="{{$taller->propietario_tel_movil ??''}}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Telefono del propietario</label>
                                                     <input type="number" class="form-control" name="TelefonoPropietario" value="{{$taller->propietario_tel_fijo ??''}}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="col-form-label">Correo Propietario<i class="fas fa-info-circle"></i></label> <input type="text" class="form-control" name="CorreoPropietario" value="{{$taller->propietario_email ??''}}" >
                                                </div>
                                                <h4>Datos Taller</h4>
                                                <div class="form-group col-12">
                                                    <label class="col-form-label">Correo para respuestas <i class="fas fa-info-circle"></i></label> <input type="text" class="form-control" name="CorreoRespuestas" value="{{$taller->correo_respuestas ??''}}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="col-form-label">Correo para respuestas de refacciones <i class="fas fa-info-circle"></i></label> <input type="text" class="form-control" name="CorreoRef" value="{{$taller->correo_refacciones ??''}}">
                                                </div>
                                            </div>
                                            <div class="form-group  row">
                                                <div data-repeater-list="" class="col-12">
                                                    <div data-repeater-item class="row kt-margin-b-10">
                                                        <div class="col-12">
                                                          <label class="col-form-label">Teléfono principal del taller</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <img src="/img/mexico-flag.png" alt=""></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="TallerTelefonoPrincipal" value="{{$taller->taller_tel_principal ??''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-12 m-3">
                                                  <label class="col-form-label">Horarios de Atención</label>
                                              </div>
                                            </div>
                                             <?php if ($thorarios!=Null): ?>
                                                <?php foreach ($thorarios as $horario): ?>
                                                  <div class="form-group">
                                                      <div class="input-group">
                                                          <div class="row" >
                                                              <div class="form-row col-12">
                                                                  <div class="col-11 col-sm-5">
                                                                      <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="diadesde{{$horario->gos_taller_horarios_id ??''}}" >
                                                                        <option value="Lunes" <?php if ($horario->dia_desde=="Lunes"): ?>selected<?php endif; ?> >Lunes</option>
                                                                        <option value="Martes"  <?php if ($horario->dia_desde=="Martes"): ?>selected<?php endif; ?> >Martes</option>
                                                                        <option value="Miercoles" <?php if ($horario->dia_desde=="Miercoles"): ?>selected<?php endif; ?>  >Miercoles</option>
                                                                        <option value="Jueves" <?php if ($horario->dia_desde=="Jueves"): ?>selected<?php endif; ?> >Jueves</option>
                                                                        <option value="Viernes" <?php if ($horario->dia_desde=="Viernes"): ?>selected<?php endif; ?> >Viernes</option>
                                                                        <option value="Sabado" <?php if ($horario->dia_desde=="Sabado"): ?>selected<?php endif; ?> >Sabado</option>
                                                                        <option value="Domingo" <?php if ($horario->dia_desde=="Domingo"): ?>selected<?php endif; ?> >Domingo</option>
                                                                      </select>
                                                                  </div>
                                                                  <div class="col-11 col-sm-1">
                                                                  <p style="-webkit-text-stroke-width: medium; text-align:center; padding-top: 1rem;">A</p>
                                                                  </div>
                                                                  <div  class="col-11 col-sm-5">
                                                                      <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="diahasa{{$horario->gos_taller_horarios_id ??''}}">
                                                                        <option value="Lunes" <?php if ($horario->dia_hasta=="Lunes"): ?>selected<?php endif; ?> >Lunes</option>
                                                                        <option value="Martes"  <?php if ($horario->dia_hasta=="Martes"): ?>selected<?php endif; ?> >Martes</option>
                                                                        <option value="Miercoles" <?php if ($horario->dia_hasta=="Miercoles"): ?>selected<?php endif; ?>  >Miercoles</option>
                                                                        <option value="Jueves" <?php if ($horario->dia_hasta=="Jueves"): ?>selected<?php endif; ?> >Jueves</option>
                                                                        <option value="Viernes" <?php if ($horario->dia_hasta=="Viernes"): ?>selected<?php endif; ?> >Viernes</option>
                                                                        <option value="Sabado" <?php if ($horario->dia_hasta=="Sabado"): ?>selected<?php endif; ?> >Sabado</option>
                                                                        <option value="Domingo" <?php if ($horario->dia_hasta=="Domingo"): ?>selected<?php endif; ?> >Domingo</option>
                                                                      </select>
                                                                  </div>
                                                              </div>
                                                              <div class="form-row col-12" style="padding-top: 1rem;">
                                                                  <div class="col-11 col-sm-5" > <?php  $horahasta= substr($horario->hora_hasta, -8, 5); $horadesde = substr($horario->hora_desde, -8, 5);  ?>
                                                                      <input type="time"style="padding-top: 1rem;" class="form-control" name="hora_desde{{$horario->gos_taller_horarios_id}}"  value="{{$horadesde ??''}}">
                                                                  </div>
                                                                  <div class="col-11 col-sm-1">
                                                                  <p style="-webkit-text-stroke-width: medium; text-align:center; padding-top: 1rem;">A</p>
                                                                  </div>
                                                                  <div  class="col-11 col-sm-5" >
                                                                      <input type="time" style="padding-top: 1rem;"class="form-control" name="hora_hasta{{$horario->gos_taller_horarios_id}}" value="{{$horahasta ??''}}">
                                                                  </div>
                                                              </div>
                                                               <div class="col-12">
                                                                 <div class="float-right">
                                                                      <a href="/gestion-taller/eliminar/{{$horario->gos_taller_horarios_id}}" role="button" class="btn btn-md btn-danger"><i class="fas fa-trash text-light"></i></a>
                                                                 </div>

                                                               </div>



                                                           <div class="col-11"style=" border-bottom: 2px  solid lightgrey; margin: 1rem;"></div>
                                                          </div>
                                                      </div>

                                                  </div>
                                                <?php endforeach; ?>
                                             <?php endif; ?>
                                               <div class="row" id="Divhorarios"></div>
                                             <div class="row">
                                               <div class="col-8"></div>
                                                <div class="col-4"> <button type="button" class="btn btn-md btn-primary" name="button" onclick="AgregarHoraro();"><i class="fas fa-clock"></i>Agregar</button>
                                                  <input type="hidden" name="lengthhorarios" id="lengthhorarios" value="0">
                                                </div>
                                             </div>
                                        </div>
                                        {{-- columna 2 --}}
                                        <div class="col-6 p-3">
                                            <div class="row">
                                              <div class="form-group col-12">
                                                  <label class="col-form-label">Dirección del Taller</label>
                                                  <input type="text" class="form-control" name="DireccionTaller"  value="{{$taller->taller_direccion ??''}}">
                                              </div>
                                              <div class="form-group col-6">
                                                  <label class="col-form-label">Colonia</label>
                                                  <input type="text" class="form-control" name="Tallercolonia"  value="{{$taller->taller_colonia ??''}}">
                                              </div>
                                              <div class="form-group col-6">
                                                  <label class="col-form-label">Municipio</label>
                                                  <input type="text" class="form-control" name="Tallermunicipio"  value="{{$taller->taller_municipio ??''}}">
                                              </div>

                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Estado</label>
                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5"   name="" disabled>
                                                        <?php foreach ($estados as $estado): ?>
                                                            <option value="{{$estado->gos_region_estado_id ??''}}" <?php if ($estadosel->gos_region_estado_id==$estado->gos_region_estado_id): ?>selected<?php endif; ?> > {{$estado->nomb_estado}}</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12 col-sm-6">
                                                    <label class="col-form-label">Ciudad</label>

                                                    <select class="form-control kt-selectpicker"  data-live-search="true" data-size="5"  name="ciudadtaller" >
                                                      <?php foreach ($ciudades as $ciudad ): ?>
                                                          <option value="{{$ciudad->gos_region_ciudad_id ??''}}" <?php if ($ciudad->gos_region_ciudad_id==$taller->gos_region_ciudad_id): ?>selected  <?php endif; ?>> {{$ciudad->nomb_ciudad}}</option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="col-form-label">Ingresa la ubicación de tu taller (Recomendable)</label>
                                                    <!--The div element for the map -->
                                                    <div style="height:60%; width:95%; background-color:rgb(240,240,240);" id="map"></div>
                                                    <iframe src="{{ $mapa->ubicación ?? '' }}" style="width:100%;border:0;" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                                </div>
                                                <div style="margin-top:-20%;" class="form-group col-12">
                                                    <label class="col-form-label" for="indicaciones">Descripción general</label>
                                                    <textarea class="form-control" name="Descripción_general" id="indicaciones" rows="6">@if(isset($descripcion->descripcion)){{$descripcion->descripcion}}@endif</textarea>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="col-form-label" for="etiquetas">Etiquetas</label>
                                                    <div class="row">
                                                        <div class="form-group col-9 col-sm-7 col-md-3 container-fluid">
                                                            <div class="kt-checkbox-inline">
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="afiliaciones"> Afiliaciones
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="alineaciones"> Alineaciones
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="amortiguadores"> Amortiguadores
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="balanceo"> Balanceo
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="electrico"> Eléctrico
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="mofes"> Mofes
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-9 col-sm-7 col-md-3 container-fluid">
                                                            <div class="kt-checkbox-inline">
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="lavado"> Lavado
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="suspension"> Suspensión
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="transmisiones"> Transmisiones
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="rectificado_torneado"> Rectificado y Torneado
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="refrigeracion_calefaccion"> Refrigeración y calefacción
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="motores"> Reparación de motores
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-9 col-sm-8 col-md-4 container-fluid">
                                                            <div class="kt-checkbox-inline">
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="enderezado_pintura"> Enderezado y Pintura
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="diferencial"> Servicio de diferencial
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="grua"> Servicio de grua
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="frenos_clutch"> Frenos y Clutch
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="mecanica_general"> Mecánica general
                                                                    <span></span>
                                                                </label>
                                                                <label  class="kt-checkbox">
                                                                    <input type="checkbox" name="etiquetas[]" id="etiquetas[]" value="Venta de refacciones"> Venta de refacciones<span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="col-form-label" for="indicaciones">Fotografias del taller</label>








                                                <div id="divPic" class="divPic">

                                                  <div class="card-footer">
                                                    <label class="btn btn-primary" role="button" style=" width: 3rem; height: 3rem; position: absolute; "><i class="fa fa-pen" style="margin-top: .5rem"></i>
                                                      <input type="file"  name="t1"  accept=".png" onchange="tallerPics(this,1);" style=" display: none; " >
                                                    </label>
                                                    <img src="{{$fotos_taller_1}}" alt="" id="pic1"  style=" width: 100%;">
                                                    <small>archivo</small>
                                                  </div>

                                                  <div class="card-footer">
                                                    <label class="btn btn-primary" role="button" style=" width: 3rem; height: 3rem; position: absolute; "><i class="fa fa-pen" style="margin-top: .5rem"></i>
                                                      <input type="file"  name="t2"  accept=".png" onchange="tallerPics(this,2);" style=" display: none; " >
                                                    </label>
                                                    <img src="{{$fotos_taller_2}}" alt="" id="pic2"  style=" width: 100%;">
                                                    <small>archivo</small>
                                                  </div>

                                                  <div class="card-footer">
                                                    <label class="btn btn-primary" role="button" style=" width: 3rem; height: 3rem; position: absolute; "><i class="fa fa-pen" style="margin-top: .5rem"></i>
                                                      <input type="file"  name="t3"  accept=".png" onchange="tallerPics(this,3);" style=" display: none; " >
                                                    </label>
                                                    <img src="{{$fotos_taller_3}}" alt="" id="pic3"  style=" width: 100%;">
                                                    <small>archivo</small>
                                                  </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right" name="button">Guardar Cambios</button>
                                     </form>
                                </div>

                                <!--DATOS DE FACTURACION-->
                                            <div class="tab-pane" id="datosFacturacion" role="tabpanel">
                                                      <form action="/gestion-taller/facturacion" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                      <div class="form-row">
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Razón social</label> <input type="text" class="form-control" name="razon_social" value="{{$factaller->razon_social ??''}}" >
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">RFC</label> <input type="text" class="form-control" name="rfc"value="{{$factaller->rfc ??''}}" >
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Regimen fiscal</label> 
                                                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="regimen_fiscal" id="regimen_fiscal" required>
                                                                <option></option>
                                                                <option value="601" <?php if ($factaller->regimen_fiscal=="601"): ?>selected <?php endif; ?> >601 General de Ley Personas Morales</option>
                                                                <option value="603" <?php if ($factaller->regimen_fiscal=="603"): ?>selected <?php endif; ?> >603 Personas Morales con Fines no Lucrativos</option>
                                                                <option value="605" <?php if ($factaller->regimen_fiscal=="605"): ?>selected <?php endif; ?> >605 Sueldos y Salarios e Ingresos Asimilados a Salarios	</option>
                                                                <option value="606" <?php if ($factaller->regimen_fiscal=="606"): ?>selected <?php endif; ?> >606 Arrendamiento</option>
                                                                <option value="608" <?php if ($factaller->regimen_fiscal=="608"): ?>selected <?php endif; ?> >608 Demás ingresos</option>
                                                                <option value="609" <?php if ($factaller->regimen_fiscal=="609"): ?>selected <?php endif; ?> >609 Consolidación</option>
                                                                <option value="610" <?php if ($factaller->regimen_fiscal=="610"): ?>selected <?php endif; ?> >610 Residentes en el Extranjero sin Establecimiento Permanente en México</option>
                                                                <option value="611" <?php if ($factaller->regimen_fiscal=="611"): ?>selected <?php endif; ?> >611 Ingresos por Dividendos (socios y accionistas)</option>
                                                                <option value="612" <?php if ($factaller->regimen_fiscal=="612"): ?>selected <?php endif; ?> >612 Personas Físicas con Actividades Empresariales y Profesionales</option>
                                                                <option value="614" <?php if ($factaller->regimen_fiscal=="614"): ?>selected <?php endif; ?> >614 Ingresos por intereses</option>
                                                                <option value="616" <?php if ($factaller->regimen_fiscal=="616"): ?>selected <?php endif; ?> >616 Sin obligaciones fiscales</option>
                                                                <option value="620" <?php if ($factaller->regimen_fiscal=="620"): ?>selected <?php endif; ?> >620 Sociedades Cooperativas de Producción que optan por diferir sus ingresos</option>
                                                                <option value="621" <?php if ($factaller->regimen_fiscal=="621"): ?>selected <?php endif; ?> >621 Incorporación Fiscal</option>
                                                                <option value="622" <?php if ($factaller->regimen_fiscal=="622"): ?>selected <?php endif; ?> >622 Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                                                                <option value="623" <?php if ($factaller->regimen_fiscal=="623"): ?>selected <?php endif; ?> >623 Opcional para Grupos de Sociedades</option>
                                                                <option value="624" <?php if ($factaller->regimen_fiscal=="624"): ?>selected <?php endif; ?> >624 Coordinados</option>
                                                                <option value="628" <?php if ($factaller->regimen_fiscal=="628"): ?>selected <?php endif; ?> >628 Hidrocarburos</option>
                                                                <option value="607" <?php if ($factaller->regimen_fiscal=="607"): ?>selected <?php endif; ?> >607 Régimen de Enajenación o Adquisición de Bienes</option>
                                                                <option value="629" <?php if ($factaller->regimen_fiscal=="629"): ?>selected <?php endif; ?> >629 De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales</option>
                                                                <option value="630" <?php if ($factaller->regimen_fiscal=="630"): ?>selected <?php endif; ?> >630 Enajenación de acciones en bolsa de valores</option>
                                                                <option value="615" <?php if ($factaller->regimen_fiscal=="615"): ?>selected <?php endif; ?> >615 Régimen de los ingresos por obtención de premios</option>
                                                            </select>
                                                            <!-- <input type="text" class="form-control" name="regimen_fiscal"value="{{$factaller->regimen_fiscal ??''}}" > -->
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Persona Física o Moral</label>
                                                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_fac_tipo_persona_id" id="gos_fac_tipo_persona_id" required>
                                                                <option value="fisica" <?php if ($factaller->tipo_persona=="fisica"): ?>selected <?php endif; ?> >Fisica</option>
                                                                  <option value="moral" <?php if ($factaller->tipo_persona=="moral"): ?>selected <?php endif; ?> >Moral</option>
                                                                    <option value="otro" <?php if ($factaller->tipo_persona=="otro"): ?>selected <?php endif; ?> >Otro</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label class="col-form-label">Correo electrónico</label>
                                                             <input type="text" class="form-control" name="email_direccion" value="{{$factaller->email_direccion ??''}}" >
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Clave Privada</label>
                                                            <input type="password" class="form-control" name="selloclave" value="{{$factaller->sello_clave ??''}}" >
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Numero Serie de archivo (cer)</label>
                                                            <input type="password" class="form-control" name="sellonumero" value="{{$factaller->sello_numero ??''}}" >
                                                        </div>
                                                        <div class="form-group col-12">
                                                           <div class="row">
                                                             <div class="col">
                                                               <label class="col-form-label">CSD </label>
                                                               <p style="">Archivo de certificado (cer)</p>
                                                               <input type="file" name="sellos_certificado" id="sellos_certificado" value="">
                                                             </div>
                                                             <div class="col">
                                                                 <p style="margin-top:5%">Archivo de llave (key)</p>
                                                                 <input type="file" name="sellos_llave" id="sellos_llave" value="">
                                                             </div>
                                                           </div>

                                                        </div>

                                                        {{-- acordion --}}
                                                        <div class="kt-portlet ">
                                                            <div class="kt-portlet__body">
                                                                <div class="accordion accordion-light">
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingOne">
                                                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="flaticon2-plus"></i> Agregar Dirección Fiscal
                                                                            </div>
                                                                        </div>
                                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                                                            <div class="card-body row">


                                                                                <div class="form-group col-4">
                                                                                    <label class="col-form-label">Número Exterior</label>
                                                                                    <input type="text" class="form-control" name="dir_fiscal_nro_ext" value="{{$factaller->dir_fiscal_nro_ext ??''}}" >
                                                                                </div>

                                                                                <div class="form-group col-4">
                                                                                    <label class="col-form-label">Número interior</label>
                                                                                    <input type="text" class="form-control" name="dir_fiscal_nro_int" value="{{$factaller->dir_fiscal_nro_int ??''}}" >
                                                                                </div>
                                                                                <div class="form-group col-4">
                                                                                    <label class="col-form-label">Código Postal</label>
                                                                                    <input type="text" class="form-control" name="dir_fiscal_cod_postal"value="{{$factaller->dir_fiscal_cod_postal ??''}}" >
                                                                                </div>
                                                                                <div class="form-group col-12">
                                                                                    <label class="col-form-label">Direccion</label>
                                                                                    <input type="text" class="form-control" name="dir_fiscal_direccion" value="{{$factaller->dir_fiscal_direccion ??''}}" >
                                                                                </div>

                                                                                <div class="form-group col-6">
                                                                                    <label class="col-form-label">Colonia</label>
                                                                                       <input type="text" class="form-control" name="Fac_Colonia" value="{{$factaller->dir_fiscal_colonia ??''}}" >
                                                                                </div>

                                                                                <div class="form-group col-6">
                                                                                    <label style="">Municipio</label>
                                                                                    <input type="text" class="form-control" name="Fac_municipio"value="{{$factaller->dir_fiscal_municipio ??''}}" >
                                                                                </div>



                                                                                <div class="form-group col-6">
                                                                                    <label class="col-form-label">Estado</label>
                                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="nomb_estado" id="nomb_estado" disabled>
                                                                                          <?php foreach ($estados as $estado): ?>
                                                                                              <option value="{{$estado->gos_region_estado_id}}"<?php if ($factaCDselected->gos_region_estado_id==$estado->gos_region_estado_id): ?>selected<?php endif; ?> > {{$estado->nomb_estado}}</option>
                                                                                          <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-6">
                                                                                    <label class="col-form-label">Ciudad</label>
                                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_region_ciudad_id" id="gos_region_ciudad_idfac" required>
                                                                                      <?php foreach ($ciudades as $ciudad ): ?>
                                                                                          <option value="{{$ciudad->gos_region_ciudad_id}}" <?php if ($factaller->dir_fiscal_region_ciudad_id==$ciudad->gos_region_ciudad_id): ?>selected<?php endif; ?> > {{$ciudad->nomb_ciudad}}</option>
                                                                                      <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-6">
                                                                                    <label class="col-form-label">Cuenta de Pago</label>
                                                                                    <input type="text" class="form-control" name="cuenta_pago" value="{{$factaller->dir_fiscal_cta_pago}}">
                                                                                </div>

                                                                                <div class="form-group col-6">
                                                                                    <label sclass="col-form-label">Serie (Opcional) <i class="fas fa-info-circle fa-sm" data-toggle='popover' data-trigger='hover'
                                                                                          data-content='Esto es un Popover de informacion para Ganancias'></i>
                                                                                        <input type="checkbox" value="1" onclick="conf_serie.disabled = !this.checked">
                                                                                    </label>
                                                                                    <div class="input-group">
                                                                                        {{-- <div class="input-group-prepend">
                                                                                            <span class="input-group-text">%</span>
                                                                                        </div> --}}
                                                                                        <input class="form-control" type="text" name="conf_serie" id="conf_serie" value="" disabled>
                                                                                    </div>
                                                                                </div>

                                                                                <div  class="form-group col-12">
                                                                                    <label class="col-form-label" for="indicaciones de fac">Indicaciones de Facturacion</label>
                                                                                    <textarea class="form-control" name="Indicacionesfacturacion"  rows="6"> {{$factaller->indiciaciones_fac ??''}}</textarea>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary float-right" name="button">Guardar Cambios</button>
                                                      </form>
                                                </div>
                                                <!--Comienzo configuraciones-->
                                            <div class="tab-pane" id="tallerconfiguracion" role="tabpanel">
                                                      <form id="formtaller" action="/gestion-taller/configuracion" method="post">
                                                        @csrf
                                                            <div class="clienteswitch">
                                                                <div class="form-group row">

                                                                    {{-- acordion --}}
                                                                    <div class="kt-portlet ">
                                                                        <div class="kt-portlet__body">
                                                                            <div class="accordion accordion-light">
                                                                                <div class="card">
                                                                                    <div class="card-header" id="headingOne">
                                                                                        <div id="taller_conf_gen_id" data-id="{{Session::get('usr_Data.gos_taller_id')}}" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                                            <i class="flaticon2-plus"></i> Configuración general
                                                                                        </div>
                                                                                    </div>

                                                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                                                                        <div class="card-body row">
                                                                                            <div class="form-group col-7">
                                                                                                <label class="col-form-label" for="">Zona horaria</label>
                                                                                                <select class="custom-select" name="gos_zona_horaria_id" id="gos_zona_horaria_id">
                                                                                                    <option value="0"> Seleccionar</option>
                                                                                                  @if(isset($zona_horariaTaller ))
                                                                                                      <option value="{{$zona_horariaTaller->gos_zona_horaria_id}}" selected> {{$zona_horariaTaller->nomb_zona}}</option>
                                                                                                  @else
                                                                                                    @foreach ($Listazona_horarias as $zona_horaria)
                                                                                                    <option value="{{$zona_horaria->gos_zona_horaria_id}}"> {{$zona_horaria->nomb_zona}}</option>
                                                                                                    @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                                <div class="form-group col-12">
                                                                                                    <label class="col-form-label">
                                                                                                        Pie de página notas de remisión
                                                                                                        <a href="#"><i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content=""></i></a>
                                                                                                    </label>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="input-group input-group-sm col-10">
                                                                                                            <textarea class="form-control form-control-sm" cols="50" rows="10" id="pie_pag_notas_remision" name="pie_pag_notas_remision" <?php if ($taller_conf_gen->pie_pag_notas_remision!=null): ?> <?php else: ?> disabled<?php endif; ?> > {{$taller_conf_gen->pie_pag_notas_remision ??''}} </textarea>

                                                                                                        </div>
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon col-2">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="pie_pag_notas_remision_check" <?php if ($taller_conf_gen->pie_pag_notas_remision!=null): ?>checked="checked"<?php endif; ?> onclick="pie_pag_notas_remision.disabled = !this.checked"> <span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-12">
                                                                                                    <label class="col-form-label">
                                                                                                        Pie de página compras
                                                                                                        <a href="#"><i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content=""></i></a>
                                                                                                    </label>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="input-group input-group-sm col-10">
                                                                                                            <textarea class="form-control form-control-sm" cols="50" rows="10" name="pie_pagina_compras" id="pie_pagina_compras"  <?php if ($taller_conf_gen->pie_pagina_compras!=null): ?> <?php else: ?> disabled<?php endif; ?>  >{{$taller_conf_gen->pie_pagina_compras ??''}}</textarea>
                                                                                                        </div>
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon col-2">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="pie_pagina_compras_check"  <?php if ($taller_conf_gen->pie_pagina_compras!=null): ?>checked="checked"<?php endif; ?>onclick="pie_pagina_compras.disabled = !this.checked"> <span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-12">
                                                                                                    <label class="col-form-label">
                                                                                                        Pie de página hoja viajera
                                                                                                        <a href="#"><i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."></i></a>
                                                                                                    </label>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="input-group input-group-sm col-10">
                                                                                                            <textarea class="form-control form-control-sm" cols="50" rows="10" name="pie_pagina_hoja_viajera" id="pie_pagina_hoja_viajera"  <?php if ($taller_conf_gen->pie_pagina_hoja_viajera!=null): ?> <?php else: ?> disabled<?php endif; ?>  >{{$taller_conf_gen->pie_pagina_hoja_viajera ??''}}</textarea>
                                                                                                        </div>
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon col-2">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="pie_pagina_hoja_viajera_check"  <?php if ($taller_conf_gen->pie_pagina_hoja_viajera!=null): ?>checked="checked"<?php endif; ?>  onclick="pie_pagina_hoja_viajera.disabled = !this.checked"> <span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-5">
                                                                                                    <label class="col-form-label">IVA</label>
                                                                                                     <input class="form-control"type="number" name="iva" value="{{$taller_conf_gen->iva ??''}}">
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div class="card-header" id="headingTwo">
                                                                                        <div id="taller_conf_os_id" class="card-title" data-toggle="collapse" data-target="#collapseTwo" data-id="{{Session::get('usr_Data.gos_taller_id')}}" aria-expanded="false" aria-controls="collapseTwo">
                                                                                            <i class="flaticon2-plus"></i> Configuración de órdenes
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                                                                        <div class="card-body row">
                                                                                            <div class="form-group col-12">
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <label class="col-form-label">Minimo de fotos <i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Configuración que establece o no a que cada etapa cumpla con el mínimo de fotos para poder ser finalizada."></i></label>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" <?php if ($taller_conf_os->minimo_fotos>0): ?> checked="checked"  <?php endif; ?>name="minimo_fotos" id="minimo_fotos" ><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group col-12">
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <label class="col-form-label">Ocultar Riesgo, Tipo de orden, Daño y Estatus <i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."></i>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox"    <?php if ($taller_conf_os->ocultar_riesgo>0): ?> checked="checked"<?php endif; ?> name="ocultar_riesgo" id="ocultar_riesgo"><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <label class="col-form-label">Ocultar Reporte, Orden Demerito y Deducible <i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."></i>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox"  <?php if ($taller_conf_os->ocultar_orden>0): ?> checked="checked"  <?php endif; ?>name="ocultar_orden" id="ocultar_orden"><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                              <div class="form-group col-12">
                                                                                                  <div class="form-row">
                                                                                                      <div class="col-10">
                                                                                                          <label class="col-form-label">Etapa Simultanea<i class="fas fa-info-circle" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Funcionalidad Para tener una etapa administrativa y una operativa a la vez"></i>
                                                                                                          </label>
                                                                                                      </div>
                                                                                                      <div class="col-2">
                                                                                                          <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                              <label>
                                                                                                                  <input type="checkbox"  <?php if ($taller_conf_os->etapa_simultanea>0): ?> checked="checked"  <?php endif; ?>name="etapa_simultanea" id="etapa_simultanea"><span></span>
                                                                                                              </label>
                                                                                                          </span>
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div class="card-header" id="headingThree">
                                                                                        <div id="taller_conf_admin_id" data-id="{{Session::get('usr_Data.gos_taller_id')}}" class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                            <i class="flaticon2-plus"></i>Configuración administrativa
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                                                                        <div class="card-body row">
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Porcetaje adicional productos</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="number" class="form-control" name="proc_adicional_prod" id="proc_adicional_prod" value="{{$taller_conf_admin->proc_adicional_prod ??''}}" <?php if ($taller_conf_admin->proc_adicional_prod!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="proc_adicional_prod_check" onclick="proc_adicional_prod.disabled = !this.checked" <?php if ($taller_conf_admin->proc_adicional_prod!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Costo adquisición</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="number" class="form-control" name="costo_adq_mini_venta" id="costo_adq_mini_venta" value="{{$taller_conf_admin->costo_adq_mini_venta ??''}}" <?php if ($taller_conf_admin->costo_adq_mini_venta!=null): ?> <?php else: ?> disabled<?php endif; ?> >
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="costo_adq_mini_venta_check" onclick="costo_adq_mini_venta.disabled = !this.checked" <?php if ($taller_conf_admin->costo_adq_mini_venta!=null): ?> checked="checked"  <?php endif; ?> > <span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">IVA preseleccionado</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="number" class="form-control" name="iva_preseleccionado" id="iva_preseleccionado" value="{{$taller_conf_admin->iva_preseleccionado ??''}}" <?php if ($taller_conf_admin->iva_preseleccionado!=null): ?> <?php else: ?> disabled <?php endif; ?> >
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="iva_preseleccionado_check" onclick="iva_preseleccionado.disabled = !this.checked" <?php if ($taller_conf_admin->iva_preseleccionado!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div class="card-header" id="headingFour">
                                                                                        <div id="taller_conf_ase_id" data-id="{{Session::get('usr_Data.gos_taller_id')}}"  class="card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                                            <i class="flaticon2-plus"></i> Configuración aseguradoras
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                                                                                        <div class="card-body row">
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre campo Aseguradora</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_campo_ase" id="nomb_campo_ase" value="{{$taller_conf_ase->nomb_campo_ase ??''}}" <?php if ($taller_conf_ase->nomb_campo_ase!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_campo_ase_check" onclick="nomb_campo_ase.disabled = !this.checked" <?php if ($taller_conf_ase->nomb_campo_ase!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre campo Póliza</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_campo_poliza" id="nomb_campo_poliza" value="{{$taller_conf_ase->nomb_campo_poliza ??''}}" <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_campo_poliza_check" onclick="nomb_campo_poliza.disabled = !this.checked"  <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre campo Siniestro</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_campo_siniestro" id="nomb_campo_siniestro" value="{{$taller_conf_ase->nomb_campo_siniestro ??''}}" <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_campo_siniestro_check" onclick="nomb_campo_siniestro.disabled = !this.checked"  <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre campo Reporte</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_campo_reporte" id="nomb_campo_reporte" value="{{$taller_conf_ase->nomb_campo_reporte ??''}}" <?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_campo_reporte_check" onclick="nomb_campo_reporte.disabled = !this.checked"  <?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div class="card-header" id="headingFive">
                                                                                        <div class="card-title" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                                            <i class="flaticon2-plus"></i> Configuración vehículo
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive">
                                                                                        <div class="card-body row">
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para modulo y campos vehículo</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">

                                                                                                        <input type="text" class="form-control" name="nomb_modulo_camp_vehiculo" id="nomb_modulo_camp_vehiculo" value="{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}" <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" name="checkboxturco" id="nomb_modulo_camp_vehiculo_check" onclick="nomb_modulo_camp_vehiculo.disabled = !this.checked"  <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para marca</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_marca" id="nomb_marca" value="{{$taller_conf_vehiculo->nomb_marca ??''}}" <?php if ($taller_conf_vehiculo->nomb_marca!=null): ?> <?php else: ?> disabled <?php endif; ?>>
                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_marca_check" onclick="nomb_marca.disabled = !this.checked" <?php if ($taller_conf_vehiculo->nomb_marca!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para modelo</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_modelo" id="nomb_modelo" value="{{$taller_conf_vehiculo->nomb_modelo ??''}}" <?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?> <?php else: ?> disabled <?php endif; ?>>

                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_modelo_check" onclick="nomb_modelo.disabled = !this.checked"   <?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para año</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_anio" id="nomb_anio" value="{{$taller_conf_vehiculo->nomb_anio ??''}}" <?php if ($taller_conf_vehiculo->nomb_anio!=null): ?> <?php else: ?> disabled <?php endif; ?>>

                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_anio_check" onclick="nomb_anio.disabled = !this.checked"  <?php if ($taller_conf_vehiculo->nomb_anio!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para color</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_color" id="nomb_color" value="{{$taller_conf_vehiculo->nomb_color ??''}}" <?php if ($taller_conf_vehiculo->nomb_color!=null): ?> <?php else: ?> disabled <?php endif; ?>>

                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_color_check" onclick="nomb_color.disabled = !this.checked"   <?php if ($taller_conf_vehiculo->nomb_color!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para placa</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_placa" id="nomb_placa" value="{{$taller_conf_vehiculo->nomb_placa ??''}}" <?php if ($taller_conf_vehiculo->nomb_placa!=null): ?> <?php else: ?> disabled <?php endif; ?>>

                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_placa_check" onclick="nomb_placa.disabled = !this.checked"   <?php if ($taller_conf_vehiculo->nomb_placa!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-12">
                                                                                                <label class="col-form-label">Nombre para económico</label>
                                                                                                <div class="form-row">
                                                                                                    <div class="col-10">
                                                                                                        <input type="text" class="form-control" name="nomb_economico" id="nomb_economico" value="{{$taller_conf_vehiculo->nomb_economico ??''}}" <?php if ($taller_conf_vehiculo->nomb_economico!=null): ?> <?php else: ?> disabled <?php endif; ?>>

                                                                                                    </div>
                                                                                                    <div class="col-2">
                                                                                                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                                            <label>
                                                                                                                <input type="checkbox" value="1" id="nomb_economico_check" onclick="nomb_economico.disabled = !this.checked"  <?php if ($taller_conf_vehiculo->nomb_economico!=null): ?> checked="checked"  <?php endif; ?>><span></span>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                <div class="form-group col-12">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot">
                                                    {{-- <div class="row align-items-center" style="justify-content: center;">
                                                        <div class="col-lg-10">
                                                            <button class="btn btn-primary" style="margin:0 auto;" type="submit"  id="btn-guardar-prueba">Guardar test</button>
                                                        </div>
                                                    </div> --}}
                                                    <button type="submit" class="btn btn-primary float-right" name="button">Guardar Cambios</button>
                                                </div>

                                                    {{-- <button type="submit" class="btn btn-primary float-right" name="button">Guardar Cambios</button> --}}
                                                      </form>
                                                </div>

                    <!--Fin configuraciones-->
            </div>
        </div>
    </div>

    {{-- {{dd($idtaller = Session::get('usr_Data.gos_taller_id') )}} --}}

    {{-- <div class="kt-portlet__foot">
        <div class="row align-items-center" style="justify-content: center;">
            <div class="col-lg-10">
                <button style="margin:0 auto;" type="button"  id="btn-guardar-Mitaller">Guardar</button>
            </div>
        </div>
    </div> --}}


    {{-- </div> --}}

    {{-- fin formulario --}}
</div>
</div>





<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = {
            lat: -25.344,
            lng: 131.036
        };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 4,
                center: uluru
            });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>

<script>

$("#cargar1").on("click", function(e){
  $('#xd').click();
});



</script>

@endsection
@section('ScriptporPagina')
{{-- <script>
    function myfnt(id,idinput,inputhiden){
        var valor = $("#".concat(idinput)).val();
        var valsplit = valor.split("|");
        var valorh = $("#".concat(inputhiden)).val();
        if($("#".concat(id)).is(":checked")){
            $("#".concat(inputhiden)).val(valsplit[0].concat('|C'));
        }
        else{
            $("#".concat(inputhiden)).val(valsplit[0].concat('|D'));
        }
    }

</script> --}}
<script src="{{env('APP_URL')}}/gos/taller/ajax-taller.js"></script>
@endsection
<script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
