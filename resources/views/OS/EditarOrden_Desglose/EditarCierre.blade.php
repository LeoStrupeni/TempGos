<div class="row mt-5">
    <div class="col-12">
        <form id="OS_Anticipo_form">
            @csrf
            {{-- ID DE OS --}}
            <input type="hidden" id="gos_os_id_anticipo" name="gos_os_id_anticipo" value="@if(isset($os)){{$os->gos_os_id }}@endif">

            <div class="row">
                <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                    <label class="" >Creación de orden</label>
                    <div class="input-group date">
                        <input type="text" class="form-control"  id="kt_datetimepicker_2" name="fecha_creacion_os"   value="@if(isset($os)) {{$os->fecha_creacion_os }} @endif"  readonly = "readonly">
                        <div class="input-group-append">
                            <span class="input-group-text p-0">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                    <label >Ingreso del vehículo</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" id="kt_datetimepicker_2"   value="@if(isset($os)) {{0 != $os->fecha_ingreso_v_os ? $os->fecha_ingreso_v_os : '' }} @endif" name="fecha_ingreso_v_os"  readonly = "readonly">
                        <div class="input-group-append">
                            <span class="input-group-text p-0">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                    <label >Fecha de Promesa</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" id="kt_datetimepicker_2" value="@if(isset($os)) {{ 0 != $os->fecha_promesa_os ? $os->fecha_promesa_os : ''  }} @endif"  name="fecha_promesa" id="fecha_promesa" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text p-0">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group  col-lg-3 col-md-3 col-sm-12 ">
                    <label >Anticipo</label>
                    <select id="anticipo" class="custom-select"   value="@if(isset($os)) {{$os->Anticipo }} @endif" name="tipoAnticipo" id="tipoAnticipo " >
                        <option value="no" @isset($checkAnticipo){{'no'== $checkAnticipo ?'selected' : ''}}@endisset>No</option>
                        <option value="si" @isset($checkAnticipo){{'si'== $checkAnticipo ?'selected' : ''}}@endisset>Si</option>
                    </select>
                </div>
            </div>

            <div class="row" id="mostrarAnticipos" style="display: none;">
                <div class="col-3">
                    <label >Tipo de Pago</label>
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                        <option></option>
                        @foreach ($listaMetodos as $metodoPago)
                        <option value="{{$metodoPago->gos_metodo_pago_id}}">{{$metodoPago->nomb_met_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label >Monto de anticipo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text p-0">$</span>
                        </div>
                        <input type="number" class="form-control" name="monto_abono" id="monto_abono">
                    </div>
                </div>
                <div class="col-3">
                    <label >Fecha de abono</label>
                    <input type="text" class="form-control kt_datepicker_2" name="fecha_abono" id="fecha_abono" readonly>
                </div>
                <div class="col-1 align-self-end">
                    <button type="button" id="btn-AnticipoOS" class="btn btn-success" style="height:35.6px;">
                        <i class="fas fa-plus p-0" style="color: white!important;"></i>
                    </button>
                </div>
                <div class="col-12 mb-1">
                    <label >Observaciones</label>
                    <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
                </div>
                <div class="col-12 mb-1">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" id="dt-lista-anticipos">
                            <thead class="thead-light">
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

    <div class=" form-row col-md-12">
        <form id="OS_Cierre_form" class="col-md-4 offset-md-8">
            @csrf
            <div class=" row  col-sm-12 ">
                <label class="col-4 col-form-label text-right" >Importe</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="importeTotal" id="importeTotal" class="form-control" value="@if(isset($os->importeTotal)) {{$os->importeTotal }} @endif" disabled>
                    </div>
                </div>
            </div>
            <div class="row  col-sm-12">
                <label class="col-4 col-form-label text-right" >Descuento</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            @if (isset($os) && $os->descuento_tipo == 'PORCIENTO')
                                <button type="button" class="input-group-text btnCambioPeso" style="display:none;" onclick="cacltotal();">$</button>
                                <button type="button" class="input-group-text btnCambioPorciento"  onclick="cacltotal();">%</button>
                            @else
                                <button type="button" class="input-group-text btnCambioPeso" onclick="cacltotal();">$</button>
                                <button type="button" class="input-group-text btnCambioPorciento" style="display:none;"  onclick="cacltotal();">%</button>
                            @endif
                        </div>
                        <input type="hidden" id="descuento_tipo" name="descuento_tipo" value="@if(isset($os)) {{$os->descuento_tipo }} @else PESOS @endif" >
                        <input type="text" name="descuentoe" id="descuentoedt2" value="@if(isset($os)){{0}}@else 0 @endif" class="form-control" onchange="cacltotal();">
                    </div>
                </div>
                <small style="font-style: italic;" class="descuento form-text text-danger"></small>
            </div>
            <div class="row  col-sm-12">
                <label class="col-4 col-form-label text-right" >Sub-Total</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" value="@if(isset($os)) {{$os->subtotal }} @endif" readonly>
                    </div>
                </div>
            </div>
            <div class="row  col-sm-12">
                <label class="col-4 col-form-label text-right" >IVA</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                        </div>
                        <input type="text" name="iva" id="ivaedt2" class="form-control" value="@if(isset($os->iva)) {{$os->iva }} @else 0 @endif" disabled">
                        <input type="hidden" name="iva_taller" id="iva_taller" class="form-control" value="@if(isset($os->iva_taller)) {{$os->iva_taller }} @else 16 @endif" >

                    </div>
                </div>
                <small style="font-style: italic;" class="iva form-text text-danger"></small>
            </div>
            <div class="row  col-sm-12">
                <label class="col-4 col-form-label text-right" >Total</label>
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="total" id="total" class="form-control" value="@if(isset($os->total)) {{$os->total }} @endif" disabled>
                    </div>
                </div>
            </div>
            <div class="row  col-sm-12 ">
                <div class="col-8 col-md-8 offset-sm-12 offset-4">
                    <button type="button" class="btn btn-success w-100" id="btn_guardar_OS">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
