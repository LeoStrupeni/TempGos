@extends('Layout')

@section('Content')

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-pills nav-pills-sm" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                    href="#vehiculo" role="tab">Crear - Editar</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                    href="#xls" role="tab">Carga Masiva</a></li>
                <li class="nav-item"><a class="nav-link"
                    href="{{ route('gestion-vehiculos.index') }}"> <i
                        class="la la-backward"></i> Lista
                </a></li>
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="vehiculo" role="tabpanel">
             @if (count($errors) > 0)
    <div class="alert alert-danger">
     Errores<br><br>
     <ul>
      @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif
   @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>

   @endif
                <form method="POST"
                action="{{isset($vehiculo->gos_vehiculo_id)? route('gestion-vehiculos.update',$vehiculo->gos_vehiculo_id) : route('gestion-vehiculos.store')}}">
                    @csrf
                    @if (isset($vehiculo)) @method('PATCH') @endif
                    <div class="form-group">
                        <label style="font-size: 0.8vw;">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-brand" type="button" data-toggle="modal"
                                    data-target="#modal-cliente">
                                    <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                                </button>
                            </div>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_cliente_id" required>
                                @foreach ($listaClientes as $cliente)

                                <option value="{{ $cliente->gos_cliente_id }}"
                                    {{ isset($vehiculo) && $cliente->gos_cliente_id == $vehiculo->gos_cliente_id ? 'selected' : ''}}>
                                    {{$cliente->nombre_apellidos}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;"><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-brand" type="button" data-toggle="modal"
                                        data-target="#modal-marca-vehiculo">
                                        <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                                    </button>
                                </div>
                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_vehiculo_marca_id" required>
                                    @foreach ($listaMarcas as $marca)
                                    <option value="{{$marca->gos_vehiculo_marca_id}}"
                                        {{ isset($vehiculo) && $marca->gos_vehiculo_marca_id == $vehiculo->gos_vehiculo_marca_id ? 'selected' : ''}}>
                                        {{$marca->marca_vehiculo}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;"><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelo<?php endif; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-brand" type="button" data-toggle="modal"
                                        data-target="#modal-modelo-vehiculo">
                                        <i class="fa fa-plus kt-shape-font-color-1 p-0"></i>
                                    </button>
                                </div>
                                <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_vehiculo_modelo_id" required>
                                    @foreach ($listaModelos as $modelo)
                                    <option value="{{$modelo->gos_vehiculo_modelo_id}}"
                                        {{ isset($vehiculo) && $vehiculo->gos_vehiculo_modelo_id == $listaModelos->gos_vehiculo_modelo_id ? 'selected' : ''
                                        }}> {{$modelo->modelo_vehiculo}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;">Año</label>
                            <input type="text" class="form-control" name="year" value="{{ isset($vehiculo) ? $vehiculo->year : '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;">Color</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="color_vehiculo" required>
                                @foreach ($coloresVehiculo as $color)
                                <option value="{{$color->codigohex}}"
                                    {{ isset($vehiculo) && $color->codigohex==$vehiculo->color_vehiculo ? 'selected' : '' }}>
                                    {{$color->nomb_color}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;"># de placa</label>
                            <input type="text" class="form-control" name="placa" value="{{ isset($vehiculo) ? $vehiculo->placa : '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label style="font-size: 0.8vw;"># economico</label>
                            <input type="text" class="form-control" name="economico" value="{{ isset($vehiculo) ? $vehiculo->economico : '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 0.8vw;"># de serie</label>
                        <input type="text" class="form-control" name="nro_serie" value="{{ isset($vehiculo) ? $vehiculo->nro_serie : '' }}">
                    </div>
                    <div class="kt-portlet ">
                        <div class="kt-portlet__body">
                            <div class="accordion accordion-light">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="card-title" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            <i class="flaticon2-plus"></i> Agregar Mas datos
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Tipo de combustible</label>
                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="tipo_combustible" required>
                                                        @foreach ($tiposCombustubles as $combustible)
                                                        <option value="{{$combustible->tipo_combustible}}"
                                                        {{ isset($vehiculo) && $combustible->tipo_combustible == $vehiculo->tipo_combustible ? 'selected' : ''}}>
                                                        {{$combustible->tipo_compubstible}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;"># cilindros</label>
                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="vehiculo_cilindros" required>
                                                        @foreach ($listaCilindros as $cilindro)
                                                        <option value="{{$cilindro->vehiculo_cilindros}}"
                                                        {{ isset($vehiculo) && $cilindro->vehiculo_cilindros == $vehiculo->vehiculo_cilindros ? 'selected' : ''
                                                        }}> {{$cilindro->cant_cilindors}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Cilindraje</label>
                                                    <input type="text" class="form-control" name="cilindraje" value="{{ isset($vehiculo) ? $vehiculo->cilindraje : '' }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;"># motor</label>
                                                    <input type="text" class="form-control" name="nro_motor" value="{{ isset($vehiculo) ? $vehiculo->nro_motor : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Observaciones</label>
                                                    <input type="text" class="form-control" name="observaciones" value="{{ isset($vehiculo) ? $vehiculo->observaciones : '' }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Anexo</label>
                                                    <input type="text" class="form-control" name="anexo" value="{{ isset($vehiculo) ? $vehiculo->anexo : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Puertas</label>
                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="nro_puertas" required>
                                                        @foreach ($listaPuertas as $puertas)
                                                            <option value="{{$puertas->nro_puertas}}"
                                                                {{ isset($vehiculo) && $vehiculo->nro_puertas==$puertas->nro_puertas ? 'selected' : '' }}>
                                                                {{$puertas->nro_puertas}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Pasajeros</label>
                                                    <input type="text" class="form-control" name="pasajeros" value="{{ isset($vehiculo) ? $vehiculo->pasajeros : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Color interior</label>
                                                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="color_interior" required>
                                                        @foreach ($coloresInterior as $color)
                                                        <option value="{{$color->codigohex}}"
                                                            {{ isset($vehiculo) && $color->codigohex==$vehiculo->color_vehiculo ? 'selected' : '' }}>
                                                            {{$color->nomb_color}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Procedencia</label>
                                                    <input type="text" class="form-control" name="procedencia" value="{{ isset($vehiculo) ? $vehiculo->procedencia : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Aduana</label>
                                                    <input type="text" class="form-control" name="aduana" value="{{ isset($vehiculo) ? $vehiculo->aduana : '' }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-size: 0.8vw;">Fecha de importacion</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" readonly id="kt_datepicker_2" name="fecha_importacion" value="{{ isset($vehiculo) ? $vehiculo->fecha_importacion : '' }}"/>
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
                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>

                {{-- Modales --}}
            @include('Clientes/modalCliente')
            @include('Vehiculos/ModalMarca')
            @include('Vehiculos/ModalModelo')

            </div>

            <div class="tab-pane" id="xls" role="tabpanel">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-6 text-center my-3 border-right">
                            <h4 class="my-3">Descargar plantilla</h4>
                            <a href="{{ url('Productos/Exportar') }}"> <i
                                class="fas fa-download fa-10x border border-primary rounded-circle p-5 text-primary"
                                style="border-width: 10px !important;"></i>
                            </a>
                        </div>
                        <div class="form-group col-6 text-center my-3">
                            <h4 class="my-3">Subir plantilla</h4>
                            <a href=""> <i
                                class="fas fa-upload fa-10x border border-primary rounded-circle p-5 text-primary"
                                style="border-width: 10px !important;"></i>
                            </a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-4" style="font-size: 1.25rem;">Subir</button>
                </form>
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



@endsection
