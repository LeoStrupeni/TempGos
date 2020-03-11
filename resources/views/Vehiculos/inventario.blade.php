@extends('Layout')
<title>Inventario</title>
@section('Content')
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Inventario de Recepcion
        </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      <form class="" action="{{--route('ordenServicioController.guardaInventario')--}}" method="post">
        @csrf
      <!--begin::Accordion-->
           <div class="accordion" id="accordionExample1">
                {{-- Interiores --}}
                <div class="card">
                   <div class="card-header" id="headingOne1">
                     <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                       Interiores
                     </div>
                   </div>
                   <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                  						<table class="table table-striped">
                						  	<tbody>
                                  <tr>
                                      <td></td>
                                      <td>Comentario</td>
                                      <td>Si</td>
                                      <td>No</td>
                                  </tr>
                                  {{-- @foreach ($interiores as $interior)  --}}
                						    	<tr>
                							      	<td>{{ $interior->nombre ?? '' }}</td>
                                      <td><input type="text" class="form-control col-8" name="" value=""> </td>
                                      <td><label class="kt-radio">
                                        <input type="radio" name="radio" value="1"><span></span></label>
                                      </td>
                                      <td><label class="kt-radio">
                                        <input type="radio" name="radio" value="0"><span></span></label>
                                      </td>
                						    	</tr>
                                 {{-- @endforeach --}}
                						  	</tbody>
                						</table>
                     </div>
                </div>
                {{-- Motor --}}
                <div class="card">
                    <div class="card-header" id="headingTwo1">
                      <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                        Motor
                      </div>
                    </div>
                    <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample1">
                      <table class="table table-striped">
                         <tbody>
                           <tr>
                               <td></td>
                               <td>Comentario</td>
                               <td>Si</td>
                               <td>No</td>
                           </tr>
                           {{-- @foreach ($motores as $motor)  --}}
                           <tr>
                               <td>{{ $motor->nombre ?? '' }}</td>
                               <td><input type="text" class="form-control col-8" name="" value=""> </td>
                               <td><label class="kt-radio">
                                 <input type="radio" name="radio" value="1"><span></span></label>
                               </td>
                               <td><label class="kt-radio">
                                 <input type="radio" name="radio" value="0"><span></span></label>
                               </td>
                           </tr>
                          {{-- @endforeach --}}
                         </tbody>
                     </table>
                    </div>
                  </div>
                {{-- Exteriores --}}
				      	<div class="card">
        						<div class="card-header" id="headingThree1">
        							<div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseThree1" aria-expanded="false" aria-controls="collapseThree1">
        								Exteriores
        							</div>
        						</div>
        						<div id="collapseThree1" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample1">
                      <div class="card-body">
                        <table class="table table-striped">
                           <tbody>
                             <tr>
                                 <td></td>
                                 <td>Comentario</td>
                                 <td>Si</td>
                                 <td>No</td>
                             </tr>
                             {{-- @foreach ($exteriores as $exterior)  --}}
                             <tr>
                                 <td>{{ $exterior->nombre ?? '' }}</td>
                                 <td><input type="text" class="form-control col-8" name="" value=""> </td>
                                 <td><label class="kt-radio">
                                   <input type="radio" name="radio" value="1"><span></span></label>
                                 </td>
                                 <td><label class="kt-radio">
                                   <input type="radio" name="radio" value="0"><span></span></label>
                                 </td>
                             </tr>
                            {{-- @endforeach --}}
                           </tbody>
                       </table>
        						</div>
				    	    </div>
                {{-- Cajuela --}}
                <div class="card">
                      <div class="card-header" id="headingFour1">
                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseFour1" aria-expanded="false" aria-controls="collapseFour1">
                          Cajuela
                        </div>
                      </div>
                      <div id="collapseFour1" class="collapse" aria-labelledby="headingFour1" data-parent="#accordionExample1">
                        <table class="table table-striped">
                           <tbody>
                             <tr>
                                 <td></td>
                                 <td>Comentario</td>
                                 <td>Si</td>
                                 <td>No</td>
                             </tr>
                             {{-- @foreach ($cajuelas as $cajuela)  --}}
                             <tr>
                                 <td>{{ $cajuela->nombre ?? '' }}</td>
                                 <td><input type="text" class="form-control col-8" name="" value=""> </td>
                                 <td><label class="kt-radio">
                                   <input type="radio" name="radio" value="1"><span></span></label>
                                 </td>
                                 <td><label class="kt-radio">
                                   <input type="radio" name="radio" value="0"><span></span></label>
                                 </td>
                             </tr>
                            {{-- @endforeach --}}
                           </tbody>
                       </table>
                      </div>
                  </div>
                {{-- Medidor de gasolina --}}
                <div class="card">
              				<div class="card-header" id="headingFive1">
              					<div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseFive1" aria-expanded="false" aria-controls="collapseFive1">
              						Medidor de gasolina
              					</div>
              				</div>
              				<div id="collapseFive1" class="collapse" aria-labelledby="headingFive1" data-parent="#accordionExample1">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-3">
                              <label for="">Tanque de gasolina</label>
                               <select name="medidor" value="" class="custom-select" required>
                                 <option value="" selected>Seleccionar</option>
                               {{-- @foreach ($medidores as $medidor)
                              <option value="{{$medidor->dato}}"> {{$medidor->dato}}</option>
                              @endforeach --}}
                             </select>
                           </div>
                          <div class="col-6" style="margin:0 auto">
                            <img style="width:100%" src="{{ $medidor_de_gasolina->imagen ?? '' }}" alt="Medidor">
                          </div>
                        </div>
                        </div>
              				</div>
    				     </div>
                {{-- Condiciones de carroceria --}}
                <div class="card">
                      <div class="card-header" id="headingSix1">
                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseSix1" aria-expanded="false" aria-controls="collapseSix1">
                          Condiciones de carroceria
                        </div>
                      </div>
                      <div id="collapseSix1" class="collapse" aria-labelledby="headingSix1" data-parent="#accordionExample1">
                        <div class="card-body">
                          <div class="kt-portlet">
                              <div class="kt-portlet__body">
                                  <ul class="nav nav-pills nav-fill" role="tablist">
                                    {{-- Select --}}
                                      <li class="nav-item">
                                      <select class="custom-select" name="modelo_vehiculo">
                                        <option value="" selected>Seleccionar Vehiculo</option>
                                        {{-- @foreach ($vehiculos as $vehiculo)
                                        <option name="{{$vehiculo->modelo_vehiculo}}" value="" selected>{{$vehiculo->modelo_vehiculo}}</option>
                                        @endforeach --}}
                                      </select>
                                      </li>
                                      {{-- golpes --}}
                                      <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_1">Golpes</a>
                                      </li>
                                      {{-- Roto o rallado --}}
                                      <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2">Roto o Estrellado</a>
                                      </li>
                                      {{-- Rayones --}}
                                      <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_3">Rayones</a>
                                      </li>
                                  </ul>

                                  <div class="tab-content">
                                      <div class="tab-pane" id="kt_tabs_5_1" role="tabpanel">
                                         <img src="https://st3.depositphotos.com/9491408/12765/v/950/depositphotos_127658006-stock-illustration-vector-pickup-truck-on-white.jpg" alt="">
                                      </div>
                                      <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
                                          <img src="https://previews.123rf.com/images/yurischmidt/yurischmidt1704/yurischmidt170400016/76356945-vectores-de-plantilla-de-vectores-carro-de-entrega-aislado-en-blanco-la-capacidad-de-cambiar-f%C3%A1cilment.jpg" alt="">
                                      </div>
                                      <div class="tab-pane active" id="kt_tabs_5_3" role="tabpanel">
                                        <img src="https://previews.123rf.com/images/yurischmidt/yurischmidt1704/yurischmidt170400006/76184848-plantilla-cami%C3%B3n-campo-a-trav%C3%A9s-vector-aislados-coche-en-blanco-todas-las-capas-y-grupos-bien-organizados.jpg" alt="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                 </div>
                {{-- Comentarios --}}
                <div class="card">
                      <div class="card-header" id="headingSeven1">
                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseSeven1" aria-expanded="false" aria-controls="collapseSeven1">
                          Comentarios
                        </div>
                      </div>
                      <div id="collapseSeven1" class="collapse" aria-labelledby="headingSeven1" data-parent="#accordionExample1">
                        <div class="card-body">
                            <strong><label for="">Comentario</label></strong><br>
                            <textarea name="comentario_general_inventario" rows="3" style="width:100%" placeholder="Escribir comentario"></textarea>
                          </div>
                      </div>
                 </div>
                {{-- Firma del Cliente --}}
                <div class="card">
                      <div class="card-header" id="headingEight1">
                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseEight1" aria-expanded="false" aria-controls="collapseEight1">
                          Firma del Cliente
                        </div>
                      </div>
                      <div id="collapseEight1" class="collapse" aria-labelledby="headingEight1" data-parent="#accordionExample1">
                           <div class="card-body">
                                <div class="" style="text-align:center">
                                  <button class="btn btn-primary" id="clear">Limpiar</button>
                                </div>
                                <div class="wrapper">
                                 <canvas id="signature-pad" class="signature-pad" width="500" height="300" name="firma_cliente"></canvas>
                                </div>
                          </div>
                      </div>
                 </div>
                {{-- Firma del Encargado --}}
                <div class="card">
                      <div class="card-header" id="headingNine1">
                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#collapseNine1" aria-expanded="false" aria-controls="collapseNine1">
                          Firma del Encargado
                        </div>
                      </div>
                      <div id="collapseNine1" class="collapse" aria-labelledby="headingNine1" data-parent="#accordionExample1">
                        <div class="card-body">
                             <div class="" style="text-align:center">
                               <button class="btn btn-primary" id="clear2">Limpiar</button>
                             </div>
                             <div class="wrapper">
                              <canvas id="signature-pad2" class="signature-pad" width="500" height="300" name="firma_encargado"></canvas>
                             </div>
                       </div>
                      </div>
                 </div>
           </div>
      <!--end::Accordion-->
      <button class="btn btn-success col-12 bottonEnviar" type="submit" name="button">Listo</button>
    </form>
    </div>
  </div>
  <!--end::Portlet-->

@endsection
