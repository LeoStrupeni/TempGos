@extends('Layout')
@section('Content')

<div class="kt-portlet kt-portlet--mobile">
  <div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">Ventas</h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-wrapper">
        <div class="kt-portlet__head-actions">
        	<button class="btn btn-brand btn-elevate btn-icon-sm" style="width:150px;" type="button" id="crear-nueva-venta">
            <i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-12 col-md-12">
      <div class="kt-portlet__body">
        <div class="table-responsive">
          <!--begin: Datatable -->
          <table class="table table-sm table-hover" id="ventas-DataTable" style="font-size: 1rem;">
            <thead class="thead-light">
              <tr style="font-weight: 500;">
                <th>ID</th>
                <th>Fecha de Venta</th>
                <th># de Venta</th>
                <th>Nombre del Cliente</th>
                <th>Tipo de Pago</th>
                <th>Total</th>
              </tr>
            </thead>
          </table>
          <!--end: Datatable -->
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modals --}}
<div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unir a Orden de Servicio existente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          {{-- <form class="" action="{{action('Gos\OrdenDeServicioController@update',$ordenDeServicio->orden_de_servicio_id)}}" method="get"> --}}
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Buscar Orden de Servicio</label>
            <select class="form-control kt-selectpicker" data-live-search="true" name="ordenDeServicio">
              {{-- @foreach ($listaOrdenes as $orden)
                <option data-tokens="ketchup mustard" value="{{$orden->orden_id}} ">{{$orden->orden_id->nomb_orden}}</option>
              @endforeach --}}
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Unir</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
@include('Clientes/modalCliente')
@include('Ventas/modalVenta')
@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/ajax-ventas_Val.js"></script>
@endsection
