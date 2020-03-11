
<!-- <div class="row mt-5" >
        <div class="col-12 col-md-6 col-sm-12" >

            <div class="row">
                    <div class="form-group  col-lg-6 col-md-11 col-sm-12">
                        <label class="">Fecha de cotizacion</label>
                        <div class="input-group date">
                            <input type="text" class="form-control kt_datepicker_2" name="fecha_cotizacion" id="fecha_cotizacion" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text p-0">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
</div> -->


    <div class="form-group " >
    <div class="col-12 col-md-6 col-sm-12">


                    <div class="form-group  col-lg-6 col-md-11 col-sm-12">
                        <label class="">Fecha de cotizacion</label>
                        <div class="input-group date">
                            <input type="date" class="form-control kt_datepicker_2" name="fecha_cotizacion" id="fecha_cotizacion" data-date-format="YYYY MM DD">
                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" id="fecha_cotizacion"  value="{{$hoy ?? ''}}">
                            <div class="input-group-append">
                                <span class="input-group-text p-0">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>


        </div>
    <div class="col-md-4 offset-md-8" style="padding-bottom: 10;">
        <form id="presupuesto-cierre-form">
                <div class="row  col-sm-12">
                    <label class="col-4  col-form-label text-right">Sub-Total</label>
                    <div class="col-8 ">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" name="subtotal" id="subtotal" class="form-control" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row  col-sm-12">
                    <label class="col-4  col-form-label text-right">Descuento</label>
                    <div class="col-8">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <!--<button type="button" class="input-group-text btnCambioPeso">$</button>-->
                                <button type="button" class="input-group-text btnCambioPorciento"  >%</button>
                            </div>
                            <input type="hidden" id="descuento-tipo" name="descuento-tipo" value="PESO">
                            <input type="text" name="descuento" id="descuento" class="form-control" onchange="CalcTotal()">
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
                            <input type="text" name="iva" id="iva" class="form-control" onchange="CalcTotal()" value="16">
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
                            <input type="text" name="total" id="totalFinal" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row  col-sm-12">
                    <div class="col-8 offset-4 col-md-8 offset-sm-12 offset-md-4">
                        <button type="button" class="btn btn-success w-100" id="btn_guardar_presupuesto">
                            Guardar
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>
