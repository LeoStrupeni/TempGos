<div class="modal fade" id="modal-venta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title" id="TitleModalVenta"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div style="margin:2% 0 0 75%;" class="kt-portlet__head-actions">
        <button class="btn btn-brand btn-elevate btn-icon-sm" type="button" data-toggle="modal" id="crear-cliente">
          <i class="fa fa-plus kt-shape-font-color-1"></i>Agregar Cliente
        </button>
      </div>
      <div class="modal-body">
          <div class="container">
            <div class="form-group col-3">
                <label style="font-size: 1rem;">Cliente</label>
                <div class="input-group">
                  <div class="kt-input-icon kt-input-icon--right">
                    <input type="text" class="form-control" placeholder="Buscar..." id="cliente-buscar">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                      <span><i class="la la-search"></i></span>
                    </span>
                  </div>
                </div>
              </div>
              <form class="kt-form kt-form--label-right" id="">
                @csrf
                <div class="form-row">
                <div class="form-group col-2 mb-2">
                  <label for="">Buscar Producto</label>
                  <div class="kt-input-icon kt-input-icon--right">
                    <input type="text" class="form-control" placeholder="Buscar..." id="producto-buscar">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                      <span><i class="la la-search"></i></span>
                    </span>
                  </div>
                </div>
                  <div class="form-group col-2 mb-2">
                    <label style="font-size: 1rem;">Marca</label>
                    <input type="text" class="form-control" name="descripcion_etapa" id="descripcion_etapa" value="" disabled>
                  </div>
                  <div class="form-group col-2 mb-2">
                    <label style="font-size: 1rem;">Descripción</label>
                    <input type="text" class="form-control" name="descripcion_etapa" id="descripcion_etapa" value="" disabled>
                  </div>
                  <div class="form-group col-2 mb-2">
                    <label style="font-size: 1rem;">Cantidad</label>
                    <input type="text" class="form-control" name="descripcion_etapa" id="descripcion_etapa" value="">
                  </div>
                  <div class="form-group col-1 mb-2">
                    <label style="font-size: 1rem;">Medida</label>
                    <input type="text" class="form-control" name="asesor_asignado" id="asesor_asignado" value="" disabled>
                   <input type="hidden" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id" value="">
                  </div>
                  <div class="form-group col-1 mb-2">
                    <label style="font-size: 1rem;">Costo</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text p-1">$</span>
                      </div>
                      <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_total" value="" disabled>
                    </div>
                  </div>
                  <div class="form-group col-1 mb-2">
                    <label style="font-size: 1rem;">P.venta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text p-1">$</span>
                        </div>
                        <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_MO" id="gos_etapa_MO" value="" disabled>
                    </div>
                  </div>
                  <div class="col-1 align-self-end">
                      <button type="button" id="btn_ItemEtapaOS" class="btn btn-success mb-2" style="height:35.6px;">
                        <i class="fas fa-plus p-0" style="color: white!important;"></i>
                      </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="table-responsive">
              <table class="table table-sm table-hover my-4" id="listaItemsCompra">
                  <thead style="font-size:1vw;" class="thead-light">
                      <tr>
                          <th class="p-2">ID</th>
                          <th class="p-2">Nombre Producto</th>
                          <th class="p-2">Código</th>
                          <th class="p-2 text-nowrap">Marca</th>
                          <th class="p-2">Descrición</th>
                          <th class="p-2">Código SAT</th>
                          <th class="p-2">Cantidad</th>
                          <th class="p-2">Precio venta</th>
                          <th class="p-2">Descuento</th>
                          <th class="p-2">Importe</th>
                          <th style="width:3%;"></th>
                      </tr>
                  </thead>
              </table>
          </div>

          <div style="margin-left:1%;" class="row mt-5">
              <div class="col-8">
                  <form id="OS_Anticipo_form">
                      @csrf
                      <input type="hidden" id="gos_os_id_anticipo" name="gos_os_id_anticipo" value="@if(isset($os)) {{$os->gos_os_id }} @endif">
                      <div class="row">
                          <div class="col-6">
                              <label class="" style="font-size: 1vw;">Fecha de venta</label>
                              <div class="input-group date">
                                  <input type="text" class="form-control kt_datepicker_2" name="fecha_importacion" id="fecha_importacion" readonly>
                                  <div class="input-group-append">
                                      <span class="input-group-text p-0">
                                          <i class="la la-calendar-check-o"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6">
                              <label style="font-size: 1vw;">Forma de Pago</label>
                              <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                                  <option></option>

                              </select>
                          </div>
                      </div>

                      <div class="row" id="mostrarAnticipos" >
                          <div class="col-3">
                              <label style="font-size: 1vw;">Tipo de Pago</label>
                              <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                                  <option></option>

                              </select>
                          </div>
                          <div class="col-3">
                              <label style="font-size: 1vw;">Abono</label>
                              <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
                          </div>
                          <div class="col-3">
                              <label style="font-size: 1vw;">Fecha de abono</label>
                              <input type="text" class="form-control kt_datepicker_2" name="fechaAbono" id="fechaAbono" readonly>
                          </div>
                          <div class="col-1 align-self-end">
                              <button type="button" id="btn-AnticipoOS" class="btn btn-success" style="height:35.6px;">
                                  <i class="fas fa-plus p-0" style="color: white!important;"></i>
                              </button>
                          </div>
                          <div class="col-12 mb-1">
                              <label style="font-size: 1vw;">Observaciones</label>
                              <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
                          </div>
                          <div class="col-12 mb-1">
                              <div class="table-responsive">
                                  <table class="table table-sm table-hover" id="dt-lista-anticipos">
                                      <thead style="font-size:1vw;" class="thead-light">
                                          <tr>
                                              <th class="p-1">ID</th>
                                              <th class="p-1">Tipo</th>
                                              <th class="p-1">Importe</th>
                                              <th class="p-1">Fecha</th>
                                              <th class="p-1">Observaciones</th>
                                              <th class="p-1" style="width:3%;"></th>
                                          </tr>
                                      </thead>
                                  </table>
                              </div>
                          </div>
                          <div class="col-8 offset-2">
                              <div class="form-group row mb-1 border-bottom">
                                  <label class="col-4 col-form-label text-right">SUMA</label>
                                  <input type="text" name="importeAnticipo" id="importeAnticipo" class="col-4 form-control border-0" readonly>
                              </div>
                              <div class="form-group row mb-1 border-bottom">
                                  <label class="col-4 col-form-label text-right">CAMBIO</label>
                                  <input type="text" name="cambioAnticipo" id="cambioAnticipo" class="col-4 form-control border-0" readonly>
                              </div>
                              <div class="form-group row mb-1">
                                  <label class="col-4 col-form-label text-right">POR PAGAR</label>
                                  <input type="text" name="porPagasAnticipo" id="porPagasAnticipo" class="col-4 form-control border-0" readonly>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>

              <div class="col-4 pr-5 align-self-end">
                  <form id="OS_Cierre_form">
                      @csrf
                      <div class="form-group row m-1">
                          <label class="col-4 col-form-label text-right" style="font-size: 1vw;">Importe</label>
                          <div class="col-8">
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" name="importeTotal" id="importeTotal" class="form-control" value="@if(isset($os->importeTotal)) {{$os->importeTotal }} @endif" disabled>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row m-1">
                          <label class="col-4 col-form-label text-right" style="font-size: 1vw;">Descuento</label>
                          <div class="col-8">
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      @if (isset($os) && $os->descuento_tipo == 'PORCIENTO')
                                          <button type="button" class="input-group-text btnCambioPeso" style="display:none;">$</button>
                                          <button type="button" class="input-group-text btnCambioPorciento">%</button>
                                      @else
                                          <button type="button" class="input-group-text btnCambioPeso">$</button>
                                          <button type="button" class="input-group-text btnCambioPorciento" style="display:none;">%</button>
                                      @endif
                                  </div>
                                  <input type="hidden" id="descuento_tipo" name="descuento_tipo" value="@if(isset($os)) {{$os->descuento_tipo }} @else PESOS @endif">
                                  <input type="text" name="descuento" id="descuento" value="@if(isset($os)) {{$os->descuento }} @endif" class="form-control">
                              </div>
                          </div>
                          <small style="font-style: italic;" class="descuento form-text text-danger"></small>
                      </div>
                      <div class="form-group row m-1">
                          <label class="col-4 col-form-label text-right" style="font-size: 1vw;">Sub-Total</label>
                          <div class="col-8">
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" name="subtotal" id="subtotal" class="form-control" value="@if(isset($os)) {{$os->subtotal }} @endif" disabled>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row m-1">
                          <label class="col-4 col-form-label text-right" style="font-size: 1vw;">IVA</label>
                          <div class="col-8">
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">%</span>
                                  </div>
                                  <input type="text" name="iva" id="iva" class="form-control" value="@if(isset($os->iva)) {{$os->iva }} @endif">
                              </div>
                          </div>
                          <small style="font-style: italic;" class="iva form-text text-danger"></small>
                      </div>
                      <div class="form-group row m-1">
                          <label class="col-4 col-form-label text-right" style="font-size: 1vw;">Total</label>
                          <div class="col-8">
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" name="total" id="total" class="form-control" value="@if(isset($os->total)) {{$os->total }} @endif" disabled>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row m-1">
                          <div class="col-6 offset-3">
                              <button type="button" class="btn btn-success w-100" id="btn_guardar_OS">
                                  Guardar
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
