@extends('Layout')

@section('Content')

  <div class="kt-portlet">
              <div id="NavListVehiculo" class="kt-portlet__head navbar navbar-expand-lg navbar-light">
                  <a class="navbar-brand" href="/OS/enProceso">Ordenes</a>
                  <a  href="{{ url('OS/editarOrdenes') }}"> <button class="btn btn-primary" type="button" name="button" >Agregar Orden</button> </a>
                <form class="" id="espaciosAbajo" >
                    <div class="kt-input-icon kt-input-icon--right">
                      <input type="text" class="form-control" placeholder="" id="generalSearch">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
                </form>
                <i class="la la-bars"></i>
            </div>
  			<div class="kt-portlet__body">
  				<div class="row">
  					<div class="col-lg-3">
  						<div class="kt-section">
  							<div class="kt-section__content kt-section__content--border kt-section__content--fit">
  								<ul class="kt-nav nav nav-pills nav-fill" role="tablist">
                    <li class="kt-nav__item">
                      <a data-toggle="tab" href="#kt_tabs_1" class="kt-nav__link">
                        <span class="kt-nav__link-text">En proceso</span>
                        <span class="kt-nav__link-badge">
                          <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0{{--$ordenes->numeroEnProceso--}}</span>
                        </span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a data-toggle="tab" href="#kt_tabs_2" class="kt-nav__link">
                        <span class="kt-nav__link-text">Terminados</span>
                        <span class="kt-nav__link-badge">
                          <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0{{--$ordenes->numeroTerminados--}}</span>
                        </span>
                      </a>
                    </li>
  									<li class="kt-nav__item">
  										<a data-toggle="tab" href="#kt_tabs_3" class="kt-nav__link">
  											<span class="kt-nav__link-text">Entregadas</span>
  											<span class="kt-nav__link-badge">
  												<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0{{--$ordenes->numeroEntregados--}}</span>
  											</span>
  										</a>
  									</li>
                    <li class="kt-nav__item">
                      <a data-toggle="tab" href="#kt_tabs_4" class="kt-nav__link">
                        <span class="kt-nav__link-text">Por cobrar</span>
                        <span class="kt-nav__link-badge">
                          <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0{{--$ordenes->numeroPorCobrar--}}</span>
                        </span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a data-toggle="tab" href="#kt_tabs_5" class="kt-nav__link">
                        <span class="kt-nav__link-text">Historico</span>
                        <span class="kt-nav__link-badge">
                          <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0{{--$ordenes->numeroHistorico--}}</span>
                        </span>
                      </a>
                    </li>
  								</ul>
  							</div>
  						</div>
  					</div>
            <div class="col-lg-9">
              <div class="tab-content table-responsive">
                  <div class="tab-pane active" id="kt_tabs_1" role="tabpanel">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Orden</th>
                          <th>Fecha</th>
                          <th>Dias</th>
                          <th>Cliente</th>
                          <th>Aseguradoras</th>
                          <th>Vehiculo</th>
                          <th>Asesor</th>
                          <th>Total</th>
                          <th>Avance</th>
                          <th></th>
                          </tr>
                        </thead>
                      <tbody>
                      {{-- @foreach ($ordenes as $orden)
                      <tr>
                      <td style="color:ligthblue;border-left:1px solid ligthblue">{{ $orden->gos_os_id }}</td>
                      <td>{{ $orden->fecha_id }}</td>
                      <td>{{ $orden->dias }}</td>
                      <td style="color:ligthblue">{{ $orden->gos_cliente_id }}</td>
                      <td>{{ $orden->gos_aseguradora_id }}</td>
                      <td>{{ $orden->gos_vehiculo_id }}</td>
                      <td><button type="submit" class="btn btn-warning" name="button"></button>{{ $orden->asesor }}</td>
                      <td>${{ $orden->total }}</td>
                      <td>{{ $orden->avance }}</td>
                      <td><i class="la la-bars"></i></td>
                      </tr>
                      @endforeach --}}
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="kt_tabs_2" role="tabpanel">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Orden</th>
                          <th>Fecha</th>
                          <th>Dias</th>
                          <th>Cliente</th>
                          <th>Aseguradoras</th>
                          <th>Vehiculo</th>
                          <th>Asesor</th>
                          <th>Total</th>
                          <th>Entregar</th>
                          <th></th>
                          </tr>
                        </thead>
                      <tbody>
                      {{-- @foreach ($ordenes as $orden)
                      <tr>
                      <td style="color:ligthblue;border-left:1px solid ligthblue">{{ $orden->gos_os_id }}</td>
                      <td>{{ $orden->fecha_id }}</td>
                      <td>{{ $orden->dias }}</td>
                      <td style="color:ligthblue">{{ $orden->gos_cliente_id }}</td>
                      <td>{{ $orden->gos_aseguradora_id }}</td>
                      <td>{{ $orden->gos_vehiculo_id }}</td>
                      <td>${{ $orden->total }}</td>
                      <td><button type="submit" class="btn btn-warning" name="button">Entregar</button></td>
                      <td><i class="la la-bars"></i></td>
                      </tr>
                      @endforeach --}}
                      </tbody>
                    </table>                  </div>
                  <div class="tab-pane" id="kt_tabs_3" role="tabpanel">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Orden</th>
                          <th>Fecha</th>
                          {{-- <th>Dias</th> --}}
                          <th>Cliente</th>
                          <th>Aseguradoras</th>
                          <th>Vehiculo</th>
                          <th>Asesor</th>
                          <th>Total</th>
                          <th>Avance</th>
                          <th></th>
                          </tr>
                        </thead>
                      <tbody>
                      {{-- @foreach ($ordenes as $orden)
                      <tr>
                      <td>{{ $orden->gos_os_id }}</td>
                      <td>{{ $orden->fecha_id }}</td>
                      <td>{{-- $orden->dias }}</td>
                      <td>{{ $orden->gos_cliente_id }}</td>
                      <td>{{ $orden->gos_aseguradora_id }}</td>
                      <td>{{ $orden->gos_vehiculo_id }}</td>
                      <td>{{ $orden->total }}</td>
                      <td>{{ $orden->avance }}</td>
                      <td><i class="la la-bars"></i></td>
                      </tr>
                      @endforeach --}}
                      </tbody>
                    </table>                  </div>
                  <div class="tab-pane" id="kt_tabs_4" role="tabpanel">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Orden</th>
                          <th>Fecha</th>
                          <th>Dias</th>
                          <th>Cliente</th>
                          <th>Aseguradoras</th>
                          <th>Vehiculo</th>
                          <th>Asesor</th>
                          <th>Total</th>
                          <th>Avance</th>
                          <th></th>
                          </tr>
                        </thead>
                      <tbody>
                      {{-- @foreach ($ordenes as $orden)
                      <tr>
                      <td>{{ $orden->gos_os_id }}</td>
                      <td>{{ $orden->fecha_id }}</td>
                      <td>{{ $orden->dias }}</td>
                      <td>{{ $orden->gos_cliente_id }}</td>
                      <td>{{ $orden->gos_aseguradora_id }}</td>
                      <td>{{ $orden->gos_vehiculo_id }}</td>
                      <td>{{ $orden->total }}</td>
                      <td>{{ $orden->avance }}</td>
                      <td><i class="la la-bars"></i></td>
                      </tr>
                      @endforeach --}}
                      </tbody>
                    </table>                  </div>
                  <div class="tab-pane" id="kt_tabs_5" role="tabpanel">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Orden</th>
                          <th>Fecha</th>
                          <th>Dias</th>
                          <th>Cliente</th>
                          <th>Aseguradoras</th>
                          <th>Vehiculo</th>
                          <th>Asesor</th>
                          <th>Total</th>
                          <th>Avance</th>
                          <th></th>
                          </tr>
                        </thead>
                      <tbody>
                      {{-- @foreach ($ordenes as $orden)
                      <tr>
                      <td>{{ $orden->gos_os_id }}</td>
                      <td>{{ $orden->fecha_id }}</td>
                      <td>{{ $orden->dias }}</td>
                      <td>{{ $orden->gos_cliente_id }}</td>
                      <td>{{ $orden->gos_aseguradora_id }}</td>
                      <td>{{ $orden->gos_vehiculo_id }}</td>
                      <td>{{ $orden->total }}</td>
                      <td>{{ $orden->avance }}</td>
                      <td><i class="la la-bars"></i></td>
                      </tr>
                      @endforeach --}}
                      </tbody>
                    </table>                  </div>

                  <!--end::Section-->
                </div>
  					</div>
  				</div>
  			</div>
  		</div>

@endsection
