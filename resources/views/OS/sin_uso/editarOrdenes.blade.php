@extends('Layout')

<title>Orden de servicio</title>

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Crear Orden
      </h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-actions">
        <button id="btnAbrirInventario" type="button" class="btn btn-primary" data-target="#modalInventario">
          Agregar Inventario
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-cliente">
          Agregar Cliente
        </button>
      </div>
    </div>
  </div>
  <div class="kt-portlet__body p-1">

    @include('OS/EditarDesglose/agregarCliente')

    @include('OS/EditarDesglose/agregarEtapas')

{{-- PARTE BAJA OS --}}

    @include('OS/EditarDesglose/cerrarOrden')

{{-- MODALES --}}
  @include('Clientes/modalCliente')
  @include('Vehiculos/Modalvehiculo')
  @include('OS/EditarDesglose/ModalElegirClienteVehiculos')
  @include('OS/EditarDesglose/modalInventario')
  @include('OS/EditarDesglose/modalGuardar')

  </div>
</div>

@endsection

@section('ScriptporPagina')

  <script src="{{env('APP_URL')}}/gos/js/OrdenServicio/OS-items.js"></script>

{{-- OS\EditarDesglose\modalIventario --}}
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
  <script src="{{env('APP_URL')}}/gos/js/OrdenServicio/OS-inventario.js"></script>

{{-- OS\EditarDesglose\agregarCliente --}}
  {{-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
   <script src="{{env('APP_URL')}}/gos/js/OrdenServicio/OS-clientes.js"></script>

{{-- OS\EditarDesglose\ModalElegirClienteVehiculos --}}
  {{-- <script src="{{env('APP_URL')}}/gos/prueba-ajaxAM.js"></script> --}}

{{-- OS\EditarDesglose\modalAnticipo --}}
  <script src="{{env('APP_URL')}}/gos/js/OrdenServicio/OS-anticipo.js"></script>
  <script src="{{env('APP_URL')}}/gos/js/OrdenServicio/OS-metodos.js"></script>


@endsection
