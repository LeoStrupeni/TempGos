<div class="form-group row mb-0">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_1" id="gos_paq_etapa_calc_tiempo_id_1">
    <div class="col-5 form-group mb-2 px-1">
        <label>Aseguradora</label>                          
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_1" id="gos_aseguradora_id_1">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <label class="kt-label m-label--single">Monto</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_1" id="monto_1">
        </div>
    </div>
    <div class="col-2 mb-2 align-self-end">
        <button type="button" class="btn btn-primary btn_calc"><i class="fas fa-plus p-0"></i></button>
    </div> 
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_2">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_2" id="gos_paq_etapa_calc_tiempo_id_2">
    <div class="col-5 form-group mb-2 px-1">
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_2" id="gos_aseguradora_id_2">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_2" id="monto_2">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_3">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_3" id="gos_paq_etapa_calc_tiempo_id_3">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_3" id="gos_aseguradora_id_3">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_3" id="monto_3">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_4">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_4" id="gos_paq_etapa_calc_tiempo_id_4">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_4" id="gos_aseguradora_id_4">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_4" id="monto_4">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_5">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_5" id="gos_paq_etapa_calc_tiempo_id_5">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_5" id="gos_aseguradora_id_5">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_5" id="monto_5">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_6">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_6" id="gos_paq_etapa_calc_tiempo_id_6">
    <div class="col-5 form-group mb-2 px-1">
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_6" id="gos_aseguradora_id_6">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_6" id="monto_6">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_7">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_7" id="gos_paq_etapa_calc_tiempo_id_7">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_7" id="gos_aseguradora_id_7">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_7" id="monto_7">
        </div>
    </div> 
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_8">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_8" id="gos_paq_etapa_calc_tiempo_id_8">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_8" id="gos_aseguradora_id_8">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_8" id="monto_8">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_9">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_9" id="gos_paq_etapa_calc_tiempo_id_9">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_9" id="gos_aseguradora_id_9">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_9" id="monto_9">
        </div>
    </div>
</div>

<div class="form-group row mb-0 d-none" id="calc_tiempo_10">
    <input type="hidden" name="gos_paq_etapa_calc_tiempo_id_10" id="gos_paq_etapa_calc_tiempo_id_10">
    <div class="col-5 form-group mb-2 px-1">                        
        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_aseguradora_id_10" id="gos_aseguradora_id_10">
            <option></option>
            @foreach ($listaAseguradoras as $aseguradora)
            <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5 form-group mb-2 px-1">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="input-group-text p-2" type="button" value="PESO">$</button>
            </div>
            <input type="text" class="form-control" name="monto_10" id="monto_10">
        </div>
    </div>
</div>