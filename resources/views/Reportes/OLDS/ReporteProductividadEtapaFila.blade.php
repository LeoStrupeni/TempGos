<!--begin:: Widgets/Tasks -->

@extends('Layout')
  <title>Reporte de productividad por etapa detalle fila</title>
@section('Content')
{{-- CABECERA --}}

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon2-line-chart"></i>
        </span>
        <h3 class="kt-portlet__head-title">
          Etapas detalle fila seleccionada
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

    <form class="kt-form kt-form--label-right">
			<div class="kt-portlet__body">
				<div class="form-group row">
          <div class="col-lg-1">
						<label class="">Etapa:</label>
 					</div>
          <div class="col-lg-4">
						<label class="">Muestra entregada</label>
 					</div>
          <div class="col-lg-1">
						<label class="">Tiempo:</label>
 					</div>
          <div class="col-lg-2">
						<label class="">15 m</label>
 					</div>
          <div class="col-lg-1">
						<label class="">Terminadas:</label>
 					</div>
          <div class="col-lg-2">
						<label class="">0</label>
 					</div>
			  </div>
      </div>
		</form>

      {{-- <div class="form-row"> --}}
        <div class="form-group col-12 col-md-12">
          <div class="kt-portlet__body">
            <div class="table-responsive">
              <!--begin: Datatable -->
              <table class="table table-sm table-hover datatablaList" style="font-size: 1rem;">
                <thead class="thead-light">
                  <tr style="font-weight: 500;">
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Dias</th>
                    <th>Servicio</th>
                    <th>Tiempo trabajadoe</th>
                    <th>Tiempo real</th>
                    <th>Cliente</th>
                    <th>Tipo de cliente</th>
                    <th>Productos</th>
                    <th>Encargado</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @forelse($listaPresupuestos as $presupuesto)	 --}}
                  <tr>
                    <td>3</td>
                    <td>18-06-2019</td>
                    <td>29</td>
                    <td>Notificación de llegada</td>
                    <td>25 m</td>
                    <td>15 m</td>
                    <td>FERNANDO AGUIRRE</td>
                    <td>Tipo A</td>
                    <td>Mazda</td>
                    <td>No Asignado</td>
                    <td>
                      <div class="kt-widget2__actions">
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
        						</div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!--end: Datatable -->
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>
@endsection