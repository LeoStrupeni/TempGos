<!--begin:: Widgets/Tasks -->

@extends('Layout')
  <title>Reporte de productividad por etapa</title>
@section('Content')
{{-- CABECERA --}}

  <div class="kt-portlet kt-portlet--mobile" style="margin-bottom: 0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        {{-- <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon2-line-chart"></i>
        </span> --}}
        <h3 class="kt-portlet__head-title">
          Etapas
        </h3>
      </div>

      {{-- MENU DESPLEGABLE PARA EXPORTAR LA INFORMACION EN VARIOS FORMATOS --}}
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <div class="dropdown dropdown-inline">
              <div class="kt-portlet__body"></div>
              <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="la la-download"></i> Exportar
              </button>
              <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(114px, 39px, 0px);">
                <ul class="kt-nav">
                  <li class="kt-nav__section kt-nav__section--first">
                    <span class="kt-nav__section-text">Selecciona una opción</span>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-print"></i>
                      <span class="kt-nav__link-text">Imprimir</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-copy"></i>
                      <span class="kt-nav__link-text">Copiar</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-excel-o"></i>
                      <span class="kt-nav__link-text">Excel</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                      <span class="kt-nav__link-text">PDF</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;">
			<div class="kt-portlet__body">
				<div class="form-group row" style="margin-bottom: 0 !important;">
          <div class="col-2">
            <input type="date" name="date_desde" class="form-control" placeholder="Fecha desde">
          </div>
          <div class="col-2">
            <input type="date" name="date_hasta" class="form-control" placeholder="Fecha hasta">
          </div>
          <div class="col-2">
						{{-- <label class="">Seleccionar</label> --}}
            <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2">
              <option value="">Status</option>
              <option value="">Terminadas</option>
              <option value="Cliente">En Proceso</option>
            </select>
 					</div>
          {{-- <div class="col-2">
           <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2">
             <option value="">Todos</option>
             <option value="Presupuesto">Presupuesto</option>
           </select>
					</div> --}}
          <div class="col-2">
            <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2">
             <option value="">Tipo de daño</option>
             <option value="TipoOrden1">Colision</option>
             <option value="TipoOrden2">Inundación</option>
             <option value="TipoOrden3">Robo</option>
             <option value="TipoOrden3">Incendio</option>
             <option value="TipoOrden3">Granizo</option>
             <option value="TipoOrden3">Mecanica o mantenimiento</option>
           </select>
					</div>
          <div class="col-2">
            <select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="2">
              <option value="">Tipo de cliente</option>
              <option value="TipoCliente1">Compañia</option>
              <option value="TipoCliente2">Aseguradora</option>
            </select>
					</div>
          <div class="col-1">
            <button type="reset" class="btn btn-primary">Aplicar</button>
          </div>
			  </div>
		</form>
  </div>
  <div class="kt-portlet__body" style="padding: 0;">
    @include('Reportes.Graficos.productividadetapas')
  </div>
      {{-- <div class="form-row"> --}}
        <div class="form-group col-12 col-md-12">
          <div class="kt-portlet__body">
            <div class="table-responsive">
              <!--begin: Datatable -->
              <table class="table table-sm table-hover datatablaList" style="font-size: 1rem;">
                <thead class="thead-light">
                  <tr style="font-weight: 500;">
                    <th># Orden</th>
                    <th>Dias de ingreso</th>
                    <th>Etapa</th>
                    <th>Tiempo de la etapa</th>
                    <th>Tiempo en días</th>
                    <th>Cliente</th>
                    <th>Compañia o aseguradora</th>
                    <th>Vehículo</th>
                    <th>Responsable de la etapa</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @forelse($listaPresupuestos as $presupuesto)	 --}}
                  <tr>
                    <td>475</td>
                    <td>10</td>
                    <td>Contacto inicial con prospecto</td>
                    <td>10 m</td>
                    <td>0</td>
                    <td>Juan Carlos Gonzalez</td>
                    <td>Aseguradora</td>
                    <td>NISSAN</td>
                    <td>Guadalupe Gomez</td>
                    <td><div class="kt-widget2__actions">
        							<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
        								<i class="flaticon-more-1"></i>
        							</a>
        						<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
        								<ul class="kt-nav">
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                              <span class="kt-nav__link-text">Reports</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-send"></i>
                              <span class="kt-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                  <span class="kt-nav__link-text">Charts</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                  <span class="kt-nav__link-text">Members</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-settings"></i>
                                <span class="kt-nav__link-text">Settings</span>
                            </a>
                          </li>
                        </ul>
                      </div>
        						</div></td>
                  </tr>
                  <tr>
                    <td>845</td>
                    <td>4</td>
                    <td>Muestra entregada</td>
                    <td>8 m</td>
                    <td>0</td>
                    <td>Gustavo Diaz</td>
                    <td>Compañia</td>
                    <td>NISSAN</td>
                    <td>Guillermo Lerma</td>
                    <td><div class="kt-widget2__actions">
                      <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                        <i class="flaticon-more-1"></i>
                      </a>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                        <ul class="kt-nav">
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                              <span class="kt-nav__link-text">Reports</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-send"></i>
                              <span class="kt-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                  <span class="kt-nav__link-text">Charts</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                  <span class="kt-nav__link-text">Members</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-settings"></i>
                                <span class="kt-nav__link-text">Settings</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div></td>
                  </tr>
                  <tr>
                    <td>475</td>
                    <td>5</td>
                    <td>Cancelado</td>
                    <td>7 m</td>
                    <td>0</td>
                    <td>Raul Lozano</td>
                    <td>Aseguradora</td>
                    <td>NISSAN</td>
                    <td>Hector Martinez</td>
                    <td><div class="kt-widget2__actions">
                      <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                        <i class="flaticon-more-1"></i>
                      </a>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                        <ul class="kt-nav">
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                              <span class="kt-nav__link-text">Reports</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-send"></i>
                              <span class="kt-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                  <span class="kt-nav__link-text">Charts</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                  <span class="kt-nav__link-text">Members</span>
                              </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-settings"></i>
                                <span class="kt-nav__link-text">Settings</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div></td>
                  </tr>
                </tbody>
              </table>
              <!--end: Datatable -->
            </div>
          </div>
        </div>
      </div>
		{{-- </div>
	</div> --}}
@endsection
