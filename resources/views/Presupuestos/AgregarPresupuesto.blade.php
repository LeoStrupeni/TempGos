@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class='container-fluid'>
  <div class="kt-portlet__head kt-portlet__head--lg">


            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">Nuevo Presupuesto</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
			        <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <button  type="button" class="btn btn-primary float-right" data-toggle="modal" id="agregar-cliente" data-target="#modalCliente">
                      Agregar Cliente
                    </button>
                </div>
              </div>
  </div>
  </div>

      <div class="kt-portlet__body">
             <small class="" id="errorespresupuestos" style="display: none;">
                Errores:
             </small>
              <!-- @include('Layout/errores') -->
              <div class="">
                @include('Presupuestos/EditarPrs_Desglose/EditarCliente')
              </div>
              <div class="">
                  @include('Presupuestos/EditarPrs_Desglose/EditarItems')

              </div>
              <div class="">
                @include('Presupuestos/EditarPrs_Desglose/ModalClienteVehiculos')
                @include('OS/Clientes/ModalClientesVehiculosNuevo')
              </div>
            </div>
            <div class='container-fluid'  >

                    <div class="form-group " >
                      <form id="presupuesto-cierre-form">
                    <div class="col-12 col-md-6 col-sm-12">
                                    <div class="form-group  col-lg-6 col-md-11 col-sm-12">
                                        <label class="">Fecha de cotizacion</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="fecha_cotizacion" id="kt_datetimepicker_2" readonly  placeholder="Selecciona fecha y hora" value="{{$hoy}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text p-0">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                      <small  id="errorespresupuestosdt" style="display: none; color:red;">Insertar kilometraje</small>
                        </div>
                    <div class="col-md-4 offset-md-8" style="padding-bottom: 10;">
                      <div class="row  col-sm-12">
                        <label class="col-4  col-form-label text-right">M.O. Laminado</label>
                         <div class="col-8">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                              </div>
                                <input type="text" name="manoobra" id="molaminado" class="form-control" disabled>
                            </div>
                        </div>
                      </div>
                      <div class="row  col-sm-12">
                        <label class="col-4  col-form-label text-right ">M.O. Mecanica:</label>
                         <div class="col-8">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                              </div>
                                <input type="text" name="manoobrapintura" id="momecanica" class="form-control" disabled>
                            </div>
                        </div>
                      </div>
                      <div class="row  col-sm-12">
                          <label class="col-4  col-form-label text-right">M.O. ToT</label>
                           <div class="col-8">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                  <input type="text" name="manoobrapintura" id="motot" class="form-control" disabled>
                              </div>
                          </div>
                      </div>
                      <div class="row  col-sm-12">
                          <label class="col-4  col-form-label text-right">Pintura</label>
                           <div class="col-8">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                  <input type="text" name="precipintura" id="PPintura" class="form-control" value="{{$totalpin ??''}}"disabled>
                              </div>
                          </div>
                      </div>
                      <div class="row  col-sm-12">
                          <label class="col-4  col-form-label text-right">Refacciones</label>
                           <div class="col-8">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                  <input type="text" name="" id="manoobraref" class="form-control" value=""disabled>
                              </div>
                          </div>
                      </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">Sub-Total</label>
                                    <div class="col-8 ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" name="SubTotal2" id="subtotal2" class="form-control" value="" disabled>
                                            <input type="hidden" name="SubTotal" id="subtotal" class="form-control" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4  col-form-label text-right">Descuento</label>
                                    <div class="col-8">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                            <button type="button" class="input-group-text btnCambioPeso" style="display:none;" id="descpes"  onclick="changedesc();">$</button>
                                            <button type="button" class="input-group-text btnCambioPorciento" id="descpor" onclick="changedesc();">%</button>
                                            </div>
                                             <input type="hidden" id="desctipe" name="descuento_tipo" value="%" >
                                            <input type="text" name="Descuento" id="descuento" class="form-control" onchange="CalcTotal()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4 col-form-label text-right">IVA</label>
                                    <div class="col-8">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" name="Iva" id="iva" class="form-control" onchange="CalcTotal()" value="16">
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <label class="col-4 col-form-label text-right">Total</label>
                                    <div class="col-8">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" name="Total2" id="totalFinal2" class="form-control" disabled>
                                            <input type="hidden" name="Total" id="totalFinal" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row  col-sm-12">
                                    <div class="col-8 offset-4 col-md-8 offset-sm-12 offset-md-4">
                                        <button type="button" class="btn btn-success w-100" id="btnguardar_presupuesto">
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

@endsection
@section('ScriptporPagina')
  <script src="../gos/js/jsitemspresupuesto.js"></script>
	<script src="../gos/ajax-presupuestos.js"></script>
	<script src="../gos/ajax-presupuesto-items.js"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
@endsection
