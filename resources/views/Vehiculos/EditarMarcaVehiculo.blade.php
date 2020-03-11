@extends('Layout') 

@section('Content')

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Marca vehiculo</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-pills nav-pills-sm" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                    href="#marca-vehiculo" role="tab">Crear - Editar</a></li>               
                <li class="nav-item"><a class="nav-link"
                    href="{{ route('vehiculos-marcas.index') }}"> 
                    <i class="la la-backward"></i> Lista
                </a></li>
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="marca-vehiculo" role="tabpanel">
            
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
                <form class="kt-form" method="POST" 
                    action="{{isset($marcaVehiculo)? route('vehiculos-marcas.update',$marcaVehiculo->gos_vehiculo_marca_id) : route('vehiculos-marcas.store')}}">
                    {{ csrf_field() }} @if (isset($producto)) @method('PATCH') @endif 
                    <div class="form-group">
                        <label style="font-size: 0.8vw;">Marca</label>
                        <input type="text" class="form-control" Name="marca_vehiculo" value="{{ isset($marcaVehiculo) ? $marcaVehiculo->marca_vehiculo : '' }}">
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection