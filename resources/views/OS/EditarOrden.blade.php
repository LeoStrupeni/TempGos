@section('estiloPorPagina')
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
<link href="{{env('APP_URL')}}/gos/datatable-editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@extends('Layout')

<title>Orden de servicio</title>

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title" id="TitleOrden">Orden de servicio</h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-actions">
        <button id="btnAbrirInventario" type="button" class="btn btn-primary" style="display:none;" data-target="#modalInventario">
          Agregar Inventario
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCliente">
          Agregar Cliente
        </button>
      </div>
    </div>
  </div>
  <div class="kt-portlet__body p-1">

    @include('OS/Clientes/EditarCliente')

    @include('OS/Items/EditarItems')
    @include('OS/Items/modalItemCargando')

{{-- PARTE BAJA OS --}}

    @include('OS/EditarOrden_Desglose/EditarCierre')

{{-- MODALES --}}
  {{-- @include('Vehiculos/Modalvehiculo') --}}
  @include('OS/Inventario/ModalInventario')
  @include('OS/Clientes/ModalClienteVehiculos')
  @include('OS/Clientes/ModalClientesVehiculosNuevo')
  @include('OS/EditarOrden_Desglose/ModalGuardar')
  @include('OS/Anticipo/ModalAnticipo')

  <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
  </div>
</div>

@endsection

@section('ScriptporPagina')

  <script src="{{env('APP_URL')}}/gos/datatable-editor/js/dataTables.editor.min.js"></script>
  <script src="{{env('APP_URL')}}/gos/OS/ajax-os-items.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <script src="{{env('APP_URL')}}/gos/OS/ajax-os.js"></script>
  <script src="{{env('APP_URL')}}/gos/OS/ajax-os-inventario-vehiculo.js"></script>
  <script src="{{env('APP_URL')}}/gos/OS/ajax-os-anticipo.js"></script>

<script src="{{env('APP_URL')}}/gos/OS/ajax-os-cliente-vehiculo.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

@endsection
