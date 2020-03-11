<div class="modal fade" id="modal-vehiculo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-Modalvehiculo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar d-flex justify-content-end">
                            <ul class="nav nav-pills nav-pills-sm" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#vehiculo" role="tab">Agregar</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#xls" role="tab">Carga Masiva</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="vehiculo" role="tabpanel">
                                @include('Layout/errores')
                                <form id="vehiculo-form">
                                    @csrf
                                    <input type="hidden" name="gos_vehiculo_id" id="gos_vehiculo_id">
                                    <input type="hidden" name="gos_modelo" id="gos_modelo">
                                    <div class="form-group">
                                        <label style="font-size: 1rem;">Cliente</label>
                                        <div class="input-group">
                                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_cliente_id" id="gos_cliente_id">
                                                <option value="0"></option>
                                                @foreach ($listaClientes as $cliente)
                                                <option value="{{$cliente->gos_cliente_id}}">{{$cliente->nombre_apellidos}}</option>
                                                @endforeach
                                            </select>
									
                                        </div>
                                        <small style="font-style: italic;" class="gos_cliente_id form-text text-danger"></small>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Marca</label>
                                            <div class="input-group">
                                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_marca_id" id="gos_vehiculo_marca_id">
                                                    <option value="0"></option>
                                                    @foreach ($listaMarcas as $marca)
                                                    <option value="{{$marca->gos_vehiculo_marca_id}}">{{$marca->marca_vehiculo}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <small style="font-style: italic;" class="gos_vehiculo_marca_id form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Modelo</label>
                                            <div class="input-group">
                                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_vehiculo_modelo_id" id="gos_vehiculo_modelo_id">
                                                    
                                                </select>
                                            </div>
                                            <small style="font-style: italic;" class="gos_vehiculo_modelo_id form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Año</label>
                                            <input type="text" class="form-control" name="anio_vehiculo" id="anio_vehiculo">

											<small style="font-style: italic;" class="anio_vehiculo form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;">Color</label>
                                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="color_vehiculo" id="color_vehiculo">
                                                <option></option>
                                                @foreach ($coloresVehiculo as $color)
                                                <option value="{{$color->codigohex}}">{{$color->nomb_color}}</option>
                                                @endforeach
                                            </select>
                                            <small style="font-style: italic;" class="color_vehiculo form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;"># de Placa</label>
                                            <input type="text" class="form-control" name="placa" id="placa">
                                            <small style="font-style: italic;" class="placa form-text text-danger"></small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-size: 1rem;"># Económico</label>
                                            <input type="text" class="form-control" name="economico" id="economico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 1rem;"># de Serie</label>
                                        <input type="text" class="form-control" name="nro_serie" id="nro_serie">
                                        <small style="font-style: italic;" class="nro_serie form-text text-danger"></small>
                                    </div>
                                    <div class="kt-portlet">
                                        <div class="kt-portlet__body p-0">
                                            <div class="accordion accordion-light">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            <i class="flaticon2-plus"></i> Agregar Mas datos
                                                        </div>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                                        <div class="card-body">
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Tipo de combustible</label>
                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="tipo_combustible" id="tipo_combustible">
                                                                        <option></option>
                                                                        @foreach ($tiposCombustubles as $combustible)
                                                                            <option value="{{$combustible->tipo_combustible}}">{{$combustible->tipo_compubstible}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;"># Cilindros</label>
                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="vehiculo_cilindros" id="vehiculo_cilindros">
                                                                        <option></option>
                                                                        @foreach ($listaCilindros as $cilindro)
                                                                        <option value="{{$cilindro->vehiculo_cilindros}}"> {{$cilindro->cant_cilindors}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Cilindraje</label>
                                                                    <input type="text" class="form-control" name="cilindraje" id="cilindraje">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;"># Motor</label>
                                                                    <input type="text" class="form-control" name="nro_motor" id="nro_motor">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Observaciones</label>
                                                                    <input type="text" class="form-control" name="observaciones" id="observaciones">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Anexo</label>
                                                                    <input type="text" class="form-control" name="anexo" id="anexo" >
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Puertas</label>
                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="nro_puertas" id="nro_puertas">
                                                                        <option></option>
                                                                        @foreach ($listaPuertas as $puertas)
                                                                            <option value="{{$puertas->nro_puertas}}">{{$puertas->nro_puertas}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Pasajeros</label>
                                                                    <input type="text" class="form-control" name="pasajeros" id="pasajeros">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Color Interior</label>
                                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="color_interior" id="color_interior">
                                                                        <option></option>
                                                                        @foreach ($coloresInterior as $color)
                                                                            <option value="{{$color->codigohex}}">{{$color->nomb_color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Procedencia</label>
                                                                    <input type="text" class="form-control" name="procedencia" id="procedencia" >
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Aduana</label>
                                                                    <input type="text" class="form-control" name="aduana" id="aduana" >
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label style="font-size: 1rem;">Fecha de importacion</label>
                                                                    <div class="input-group date">
                                                                        <input type="text" class="form-control kt_datepicker_2" name="fecha_importacion" id="fecha_importacion" readonly>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-calendar-check-o"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-block mt-2" id="btn-guardar-vehiculo">Guardar</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="xls" role="tabpanel">
                                <form action="{{route('ImportarExcelVehiculo')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label style="font-size: 1rem;">Cliente</label>
                                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="gos_cliente_id" id="gos_cliente_id">
                                            <option></option>
                                            @foreach ($listaClientes as $cliente)
                                            <option value="{{$cliente->gos_cliente_id}}">{{$cliente->nombre_apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6 text-center my-3 border-right">
                                            <h4 class="my-3">Descargar plantilla</h4>
                                            <a href="{{route('ExportarExcelVehiculo')}}">
                                                <i class="fas fa-download fa-6x border border-primary rounded-circle p-5 text-primary" style="border-width: 8px !important;"></i>
                                            </a>
                                        </div>
                                        <div class="form-group col-6 text-center my-3">
                                                <h4 class="my-3">Subir plantilla</h4>
                                                <label for="ArchivoVehiculos">
                                                    <i class="fas fa-upload fa-5x border border-primary rounded-circle p-5 text-primary" style="border-width: 10px !important;"></i>
                                                    <input type="file" name="ArchivoVehiculos" id="ArchivoVehiculos" class="d-none">
                                                </label>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block mt-4" style="font-size: 1.25rem">Subir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
@media screen and (max-width: 500px) {
.p-5{
    padding:1.5rem !important;
}
.fa-upload{
    margin-top: 1.5rem;
}
}

</style>
    {{-- Modales --}}
    @include('Clientes/modalCliente')
    @include('Vehiculos/ModalMarcaVehiculo')
    @include('Vehiculos/ModalModeloVehiculo')
</div>
