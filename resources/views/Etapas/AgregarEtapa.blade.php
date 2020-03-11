@extends( 'Layout' )@section( 'Content' )

               <div class="row">

                 <div class="col-1 col-md-3 col-lg-4"></div>
                 <div class="col-10 col-md-6 col-lg-4">
                   <div class="card">

                     <div class="card-header" style="background-color: rgb(39, 57, 92); color: white;">
                      Agregar Etapa
                     </div>

                     <div class="card-body">
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
												@endif
                       <form id="etapaForm" action="" method="post" >
                           @csrf

                           <div class="form-group row">
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Etapa</label>
                                       <input type="text" id="nomb_etapa" name="nomb_etapa" class="form-control" value="">
                                       <small style="font-style: italic;" class="nomb_etapa form-text text-danger"></small>
                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Descripción</label>
                                       <input type="text" id="descripcion_etapa" name="descripcion_etapa" class="form-control" value="">
                                       <small style="font-style: italic;" class="descripcion_etapa form-text text-danger"></small>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Comisión</label>
                                       <div class="input-group">
                                           <div class="input-group-prepend">
                                               <button type="button" class="input-group-text" onclick="comisiontipo();" id="btncomtipo">$</button>
                                           </div>
                                           <input type="hidden" id="comision_asesor_tipo" name="comision_asesor_tipo" value="PESOS">
                                           <input type="text"name="comision_asesor" id="comision_asesor" class="form-control"  value="">
                                       </div>
                                       <small style="font-style: italic;" class="comision_asesor form-text text-danger"></small>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Asesor</label>
                                       <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id">
                                           <option></option>
                                           @foreach ($listaAsesores as $asesor)
                                           <option value="{{$asesor->gos_usuario_id}}"  >{{$asesor->nombre_apellidos}}</option>
                                           @endforeach
                                       </select>
                                       <small style="font-style: italic;" class="gos_usuario_tecnico_id_error form-text text-danger"></small>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Tiempo Meta</label>
                                       <input type="text" id="tiempo_meta" name="tiempo_meta" class="form-control" value="">
                                       <small style="font-style: italic;" class="tiempo_meta form-text text-danger"></small>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Mínimo de Fotos</label>
                                       <input type="text" id="minimo_fotos" name="minimo_fotos" class="form-control" value="">
                                       <small style="font-style: italic;" class="minimo_fotos form-text text-danger"></small>
                                   </div>
                               </div>
                               <div class="col-md-8">
                                   <div class="form-group">
                                       <label>Código SAT</label>
                                  
                                    <select class="form-control input-sm" name="codigo_sat" id="sat">
                                        <option></option>
                                            @foreach($codigoSat as $key => $sat)
                                            <option value="{{$sat->gos_docventa_codigo_sat_id}}" >{{$sat->descripcion}}</option>
                                            @endforeach
                                        </select>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                   <label>Tipo</label>
                                   <select class="form-control input-sm" name="tipo">
                                   <option></option>
                                        <option value="1">Administrativa</option>
                                        <option value="2">Operativa</option>
                                           
                                        </select>
                                   </div>
                               </div>
                           </div>
                           <div class="kt-portlet">
                               <div class="kt-portlet__body p-0">
                                   <div class="accordion accordion-light">
                                       <div class="card">
                                           <div class="card-header">
                                               <div class="card-title" data-toggle="collapse" data-target="#MensajesWS" aria-expanded="false">
                                                   <i class="flaticon2-plus"> </i> Agregar Mensaje de Whatsapp
                                               </div>
                                           </div>
                                           <div id="MensajesWS" class="collapse">
                                               <div class="card-body" id="MensajesWSBody">

                                           </div>
                                           <input type="hidden" name="MensajesWSlength" id="MensajesWSlength" value="0">
                                            <button type="button" name="button" class="btn btn-info btn-block mb-3 mt-3" onclick="agregarws();"><i class="fas fa-plus p-0"></i>Agregar Mensaje </button>
                                          </div>
                                        </div>
                                       <div class="card" id="CalculoTiempobody">
                                           <div class="card-header">
                                               <div class="card-title" data-toggle="collapse" data-target="#calculos_tiempos" aria-expanded="false">
                                                   <i class="flaticon2-plus"></i>Cálculo de Tiempo
                                               </div>
                                           </div>
                                           <div id="calculos_tiempos" class="collapse">
                                               <div class="card-body" id="calculos_tiemposbody">
                                                 <div class="row">
                                                 <div class="col-md-5">
                                                     <div class="kt-form__group--inline">
                                                         <div class="form-group">
                                                             <label>Aseguradora</label>
                                                             <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" id="calculotiemposel" name="" required>
                                                                     <option>Seleccione ...</option>
                                                                 @isset($listaAseguradoras)
                                                                     @foreach ($listaAseguradoras as $aseguradora)
                                                                     <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                                                                     @endforeach
                                                                 @endisset
                                                             </select>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-5">
                                                     <div class="form-group">
                                                         <label class="kt-label m-label--single">Monto</label>
                                                         <div class="input-group">
                                                             <input type="text" id="monto" name="monto" class="form-control" >
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-2">
                                                   <br>
                                                    <input type="hidden" id="CaculoTiempolength" name="caltiempolen" value="0">
                                                   <button type="button" class="btn btn-primary mt-2" onclick="addcalculiTiempo();"><i class="fas fa-plus p-0"></i></button>
                                                 </div>

                                                 </div>

                                               </div>
                                           </div>
                                       </div>

                                       <div class="card">
                                           <div class="card-header">
                                               <div class="card-title" data-toggle="collapse" data-target="#etapas_relacionadas" aria-expanded="false">
                                                   <i class="flaticon2-plus"></i> Agregar más Datos
                                               </div>
                                           </div>
                                           <div id="etapas_relacionadas" class="collapse">
                                             <div class="card-body">
                                                     <div class="container border mb-2" id="containerperdida">
                                                       <div class="form-group row">
                                                             <label  class="col-8 col-form-label">Perdida Total<i class="fas fa-info-circle"></i></label>
                                                             <div class="col-4">
                                                                 <span class="kt-switch kt-switch--sm">
                                                                     <label>
                                                                         <input type="checkbox" name="checkperdida" id="chekperdida"  > <span></span>
                                                                     </label>
                                                                 </span>
                                                             </div>
                                                           <div class="col-10">
                                                                  <select id="perdida_total_id" name="perdida_total_id" class="form-control kt-selectpicker"  data-live-search="true" >
                                                                   @foreach ($listaEtapasPerdidasTotales as $perdidaTotal)
                                                                   <option value="{{$perdidaTotal->gos_paq_etapa_id}}">{{$perdidaTotal->nomb_etapa}}</option>
                                                                   @endforeach
                                                               </select>
                                                           </div>
                                                           <div class="col-2">
                                                              <input type="hidden" name="perdidalength" id="perdidalength" value="0">
                                                              <button type="button" class="btn btn-primary" onclick="addperdidat();"><i class="fas fa-plus p-0"></i></button>
                                                           </div>
                                                       </div>
                                                      <div class="" id="listaperdidatotal">

                                                      </div>
                                                     </div>
                                                   <div class="container border mb-2" id="containerLigadas">
                                                   <div class="form-group row">
                                                     <label  class="col-8 col-form-label">Etapas Ligadas <i class="fas fa-info-circle"></i></label>
                                                     <div class="col-4">
                                                         <span class="kt-switch kt-switch--sm">
                                                             <label>
                                                                 <input type="checkbox" name="chekligada" id="chekligada"> <span></span>
                                                             </label>
                                                         </span>
                                                     </div>
                                                       <div class="col-10">
                                                         <select id="etapa_ligada_id" name=""  class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" >
                                                               @foreach ($listaEtapasLigadas as $etapaLigada)
                                                               <option value="{{$etapaLigada->gos_paq_etapa_id}}">{{$etapaLigada->nomb_etapa}}</option>
                                                               @endforeach
                                                           </select>
                                                       </div>
                                                       <div class="col-2">
                                                           <input type="hidden" name="ligadalen" id="ligadalen" value="0">
                                                          <button type="button" class="btn btn-primary " onclick="addetapalig();"><i class="fas fa-plus p-0"></i></button>
                                                       </div>
                                                   </div>
                                                   <div class="" id="listaetaligadas">



                                                   </div>

                                                   </div>

                                                   <div class="container border mb-2" id="containerdaños">
                                                   <div class="form-group row">
                                                     <label  class="col-8 col-form-label"> Pago de Daños <i class="fas fa-info-circle"></i></label>
                                                     <div class="col-4">
                                                         <span class="kt-switch kt-switch--sm">
                                                             <label>
                                                                 <input type="checkbox" name="checkpago" id="checkpago" > <span></span>
                                                             </label>
                                                         </span>
                                                     </div>
                                                       <div class="col-10">
                                                                <select id="etapa_danio_id" name="etapa_danio_id"  class="form-control kt-selectpicker" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" data-live-search="true" >
                                                               @foreach ($listaEtapasDanios as $etapaDanio)
                                                               <option value="{{$etapaDanio->gos_paq_etapa_id}}">{{$etapaDanio->nomb_etapa}}</option>
                                                               @endforeach
                                                           </select>
                                                       </div>
                                                       <div class="col-2">
                                                         <input type="hidden" name="pagolen" id="pagolen" value="0">
                                                          <button type="button" class="btn btn-primary "  onclick="addpagodaños();"><i class="fas fa-plus p-0"></i></button>
                                                       </div>
                                                   </div>
                                                   <div class="" id=listapagodaños>

                                                   </div>
                                                   </div>
                                                   <div class="form-group row">
                                                       <label class="col-8 col-form-label">Genera valor a Cliente <i class="fas fa-info-circle"></i> </label>
                                                       <div class="col-4">
                                                           <span class="kt-switch kt-switch--sm">
                                                               <label>
                                                                   <input type="checkbox" name="genera_valor" id="genera_valor"> <span></span>
                                                               </label>
                                                           </span>
                                                       </div>
                                                   </div>
                                                   <div class="form-group row">
                                                       <label class="col-8 col-form-label">Complementos <i class="fas fa-info-circle"></i></label>
                                                       <div class="col-4">
                                                           <span class="kt-switch kt-switch--sm">
                                                               <label>
                                                                   <input type="checkbox" name="complemento" id="complemento" ><span></span>
                                                               </label>
                                                           </span>
                                                       </div>
                                                   </div>
                                                   <div class="form-group row">
                                                       <label class="col-8 col-form-label">Materiales <i class="fas fa-info-circle"></i></label>
                                                       <div class="col-4">
                                                           <span class="kt-switch kt-switch--sm">
                                                               <label>
                                                                   <input type="checkbox"name="materiales" id="materiales"><span></span>
                                                               </label>
                                                           </span>
                                                       </div>
                                                   </div>
                                                   <div class="form-group row">
                                                       <label class="col-8 col-form-label">Refacciones <i class="fas fa-info-circle"></i></label>
                                                       <div class="col-4">
                                                           <span class="kt-switch kt-switch--sm">
                                                               <label>
                                                                   <input type="checkbox"	name="refacciones" id="refacciones" ><span></span>
                                                               </label>
                                                           </span>
                                                       </div>
                                                   </div>
                                                   <div class="form-group form-group-last">
                                                       <label>Agregar Link</label>
                                                       <textarea class="form-control" rows="3" name="link" id="link"></textarea>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                           </div>
                            <button type="button" class="btn btn-brand btn-block" id="saveetapa" style="display:none" onclick="GuardarEtapaVal();">Guardar</button>
                           <button type="submit" class="btn btn-brand btn-block" id="saveetapasubmit">Guardar</button>
                       </form>
                     </div>
                   </div>

                 </div>
                 <div class="col-1 col-md-3 col-lg-4"></div>
               </div>




@endsection
@section('ScriptporPagina')
	<script src="/gos/ajax-etapas.js"></script>
@endsection
