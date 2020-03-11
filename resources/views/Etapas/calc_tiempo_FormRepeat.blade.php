<div class="repeater-default">
    <div data-repeater-list="calc_tiempo">
        <div data-repeater-item>
            <div class="form-group row mb-0">
                <div class="col-6 form-group mb-2">
                    <label>Aseguradora</label>                          
                    <select class="form-control kt-selectpicker" name="gos_aseguradora_id">
                        <option></option>
                        @foreach ($listaAseguradoras as $aseguradora)
                        <option value="{{$aseguradora->gos_aseguradora_id}}">{{$aseguradora->empresa}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 form-group mb-2">
                    <label class="kt-label m-label--single">Monto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="input-group-text p-2" type="button" value="PESO">$</button>
                        </div>
                        <input type="text" id="monto" name="monto" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="gos_paq_etapa_calc_tiempo_id">
            </div>
        </div>
    </div>
    <div class="form-group mb-2">
        <div class="col p-0">
            <button class="btn btn-primary" data-repeater-create type="button"><i class="la la-plus"></i> Mas</button>
        </div>
    </div>
</div>