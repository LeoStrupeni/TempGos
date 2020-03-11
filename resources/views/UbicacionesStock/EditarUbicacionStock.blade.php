@extends('Layout')

@section('Content')

<div class="kt-portlet p-4">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Agregar ubicacion stock
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('ubicacionesstock.index') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-backward"></i>
                            Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
       
        <form method="POST" action="{{ isset($ubicacionStock) ? route('ubicacionesstock.update',$ubicacionStock->gos_producto_ubic_stock_id) : route('ubicacionesstock.store') }}">
            {{ csrf_field() }}
            @if (isset($ubicacionStock)) @method('PATCH') @endif
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Producto</label>
                    <select class="form-control" name="gos_producto_id" required>
                        @isset($listaProductos)
                            @foreach ($listaProductos as $producto)
                            <option value="{{$producto->gos_producto_id}}"
                                {{ isset($ubicacionStock) && $producto->gos_producto_id == $ubicacionStock->gos_producto_id ? 'selected' : '' }}>
                                {{$producto->nomb_producto}}</option>
                            @endforeach    
                        @endisset
                    </select>                   
                </div>
                <div class="form-group col-4">
                    <label>Ubicacion</label>
                    <select class="form-control" name="gos_producto_ubicacion_id" required>
                        @isset($listaUbicaciones)
                            @foreach ($listaUbicaciones as $ubicacion)
                            <option value="{{$ubicacion->gos_producto_ubicacion_id}}"
                                {{ isset($ubicacionStock) && $ubicacion->gos_producto_ubicacion_id == $ubicacionStock->gos_producto_ubicacion_id ? 'selected' : '' }}>
                                {{$ubicacion->nomb_ubicacion}}</option>
                            @endforeach                            
                        @endisset
                    </select>                   
                </div>
                <div class="form-group col-4">
                    <label>Concepto</label>
                    <input type="text" class="form-control" Name="concepto" 
                    value="{{ isset($ubicacionStock) ? $ubicacionStock->concepto : '' }}">
                </div>
                <div class="form-group col-3">
                    <label>Fecha</label>
                    <input type="date" class="form-control" Name="fecha" 
                    value="{{ isset($ubicacionStock) ? $ubicacionStock->fecha : '' }}">
                </div>
                <div class="form-group col-3">
                    <label>Ingreso</label>
                    <input type="number" min="0" class="form-control" Name="ingreso" 
                    value="{{ isset($ubicacionStock) ? $ubicacionStock->ingreso : '' }}">
                </div>
                <div class="form-group col-3">
                    <label>Egreso</label>
                    <input type="number" min="0" class="form-control" Name="egreso" 
                    value="{{ isset($ubicacionStock) ? $ubicacionStock->egreso : '' }}">                  
                </div>
                <div class="form-group col-3">
                    <label>Costo</label>
                    <input type="number" min="0" class="form-control" Name="costo" 
                    value="{{ isset($ubicacionStock) ? $ubicacionStock->costo : '' }}">                  
                </div>
            </div>           
            <button type="submit" class="btn btn-success btn-block mt-4">Guardar</button>
        </form>
        
    </div>


@endsection
