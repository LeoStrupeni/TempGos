@extends('Layout') 

@section('Content')

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title"><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelos<?php endif; ?> <?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-pills nav-pills-sm" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                    href="#modelo-vehiculo" role="tab">Crear - Editar</a></li>               
                <li class="nav-item"><a class="nav-link"
                    href=" {{ route('vehiculos-modelos.index') }} "> 
                    <i class="la la-backward"></i> Lista
                </a></li>
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="modelo-vehiculo" role="tabpanel">
                <form class="kt-form" method="POST" 
                    action=" {{isset($modelo_vehiculo)? route('vehiculos-modelos.update',$modelo_vehiculo->gos_vehiculo_modelo_id) : route('vehiculos-modelos.store')}} ">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label style="font-size: 0.8vw;"><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></label>
                        <select class="form-control kt-selectpicker" data-live-search="true" data-size="3" name="gos_vehiculo_marca_id" required>
                             @foreach ($listaMarcasModelo as $marca) 
                            <option value=" {{$marca->gos_vehiculo_marca_id}} "
                                 {{ isset($modelo_vehiculo) && $modelo_vehiculo->gos_vehiculo_marca_id == $marca->gos_vehiculo_marca_id ? 'selected' : ''}} >
                                 {{$marca->marca_vehiculo}} 
                            </option>
                             @endforeach  
                        </select>          
                    </div>
                    <div class="form-group">
                        <label style="font-size: 0.8vw;"><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelo<?php endif; ?></label>
                        <input type="text" class="form-control" Name="modelo_vehiculo" value=" {{ isset($modelo_vehiculo) ? $modelo_vehiculo->modelo_vehiculo : '' }} ">
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection