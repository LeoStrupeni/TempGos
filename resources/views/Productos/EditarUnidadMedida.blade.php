@extends('Layout')

@section('Content')

<!--begin::Portlet-->
<div class="kt-portlet p-4">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Unidad Medida
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('unidadesMedidas-productos.index') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-backward"></i>
                        Lista
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" 
    action="{{ isset($unidadMedida) ? route('unidadesMedidas-productos.update',$unidadMedida->gos_producto_medida_id) : route('unidadesMedidas-productos.store') }}">
        {{ csrf_field() }}
        @if (isset($unidadMedida)) @method('PATCH') @endif
        
        <div class="form-group row">
            <label class="col-2 col-form-label text-right mt-4">Nombre</label>
            <div class="col-4">
                <input type="text" class="form-control mt-4" Name="nomb_medida" 
                value="{{ isset($unidadMedida) ? $unidadMedida->nomb_medida : '' }}">
            </div>
            <label class="col-2 col-form-label text-right mt-4">Nomenclatura</label>
            <div class="col-2">
                <input type="text" class="form-control mt-4" Name="nomen" 
                value="{{ isset($unidadMedida) ? $unidadMedida->nomen : '' }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success mt-4">Guardar</button>
            </div>
        </div>      
    </form> 
</div>
    
@endsection
