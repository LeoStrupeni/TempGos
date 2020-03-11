<div class="modal fade" id="modalAnticipo" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h6 class="modal-title">Editar anticipo</h6>
			</div>
			<div class="modal-body">
                @include('Layout/errores')
                
                <form id="OS_Anticipo_Modalform">
                    @csrf
                    <input type="hidden" id="gos_os_anticipo_id" name="gos_os_anticipo_id"> {{-- ID DE ANTICIPO DE OS --}}
                    <input type="hidden" id="gos_os_id_anticipo" name="gos_os_id_anticipo"> {{-- ID DE OS --}}
                    <div class="row">
                        <div class="col-4">
                            <label style="font-size: 1vw;">Tipo de Pago</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_metodo_pago_id" id="gos_metodo_pago_id">
                                <option></option>
                                @foreach ($listaMetodos as $metodoPago)
                                <option value="{{$metodoPago->gos_metodo_pago_id}}">{{$metodoPago->nomb_met_pago}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label style="font-size: 1vw;">Monto de anticipo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-0">$</span>
                                </div>
                                <input type="number" class="form-control" name="monto_abono" id="monto_abono">
                            </div>
                        </div>
                        <div class="col-4">
                            <label style="font-size: 1vw;">Fecha de abono</label>
                            <input type="text" class="form-control kt_datepicker_2" name="fecha_abono" id="fecha_abono" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label style="font-size: 1vw;">Observaciones</label>
                            <input type="text" class="form-control" name="observacionesAnticipo" id="observacionesAnticipo">
                        </div>
                    </div>
                    <button type="button" id="btn-EditarAnticipoOS" class="btn btn-success m-auto"> Editar</button>
                </form>
            </div>
		</div>
	</div>
</div>
