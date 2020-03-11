<div id="kt_repeater_1">
    <div class="form-group form-group-last row" id="kt_repeater_1">
        <div data-repeater-list="" class="col-12">
        
        @isset($listaCalculoTiempo)
        @for ($i=0; $i < $cant_calculo; $i++) 

            <div data-repeater-item class="form-group row align-items-center repeticion_listado">
                <div class="col-md-6">
                    <div class="kt-form__group--inline">
                        <div class="form-group">
                            <label>Aseguradora</label>                          
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" id="gos_aseguradora_id[]" name="gos_aseguradora_id[]" required>
                                    <option>Seleccione ...</option>
                                @isset($listaAseguradoras)
                                    @foreach ($listaAseguradoras as $aseguradora)
                                    <option value="{{$aseguradora->gos_aseguradora_id}}"
                                        {{isset($gos_etapa_asesor) && $aseguradora->gos_aseguradora_id== $gos_etapa_asesor->gos_aseguradora_id ?'selected' : ''}}>
                                        {{$aseguradora->empresa}}</option>
                                    @endforeach 
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="kt-label m-label--single">Monto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="input-group-text p-2" type="button" value="PESO">$</button>
                            </div>
                            <input type="text" id="monto[]" name="monto[]" class="form-control" value="{{$listaCalculoTiempo[$i]['monto']}}">
                        </div>
                    </div>
                </div>
            </div>
        @endfor
        @endisset
        </div>       
    </div>
    <div class="form-group form-group-last row">
        <label class="col-lg-2 col-form-label"></label>
        <div class="col-lg-4">
            <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand" id="btn_repeticion_listado">
                <i class="la la-plus"></i> Mas
            </a>
        </div>
    </div>
</div>


<!--
/**
* Calculo de tiempo
* Table: gos_etapa_asesor_calc_tiempo
* Columns:
* gos_etapa_asesor_calc_tiempo_id int(11) AI PK
* gos_etapa_asesor_id[] int(11)
* gos_aseguradora_id int(11)
* monto double(16,2
*/ -->
{{-- 
@isset($listaCalculoTiempo)
    @for ($i=0; $i < $cant_calculo; $i++)
        <div data-repeater-list="" class="col-12">
            <div data-repeater-item="" class="form-group row align-items-center">
                <div class="col-6">
                    <div class="form-group">
                        <label>Aseguradora</label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" id="gos_aseguradora_id[]" name="gos_aseguradora_id[]" required>
                            @isset($listaAseguradoras)
                            <option selected disabled>Seleccione ... </option>
                            @foreach ($listaAseguradoras as $aseguradora)
                            <option
                                value="{{$aseguradora->gos_aseguradora_id}}"
                                {{isset($gos_etapa_asesor) && $aseguradora->gos_aseguradora_id== $gos_etapa_asesor->gos_aseguradora_id ?'selected' : ''}}>
                                {{$aseguradora->empresa}}</option>
                            @endforeach @endisset
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="kt-label m-label--single">Monto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="input-group-text p-1" type="button" value="PESO">$</button>
                            </div>
                            <input type="text" id="monto[]" name="monto[]" class="form-control" value="{{$listaCalculoTiempo[$i]['monto']}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endisset --}}