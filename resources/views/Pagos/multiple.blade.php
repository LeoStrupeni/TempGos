@extends('Layout')
<title>Pago Multiple</title>
@section('Content')

        <div class="kt-portlet">
          <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Agregar pago multiple
            </h3>
          </div>
          </div>
        <form class="kt-form kt-form--label-right" action="{{-- route('pagos-multiples.create') --}}" method="post">
          @csrf
          <div class="kt-portlet__body">
            <div class="form-group row">
            <div class="col-md-6">
            <label for="inputState">Cantidad</label>
            <input type="text" class="form-control" name="cantidad" placeholder="">
            </div>
            <div class="col-md-6">
            <label for="inputState">Tipo de pago</label>
            <select id="inputState" class="form-control" name="tipo_de_pago">
            {{-- @foreach ($pagos as $pago)
            <option value="{{ $pago->tipo_de_pago }}">{{ $pago->tipo_de_pago }}</option>
            @endforeach --}}
            </select>
            </div>
            </div>
            <div class="form-group">
            <div class="col-md-6">
            <label for="inputState">Fecha</label>
            <input type="date" class="form-control" name="fecha" placeholder="" id="kt_datepicker_2"/>
            </div>
           </div>
           <div class="form-group">
           <div class="">
           <label for="inputState">Observaciones</label>
           <textarea style="width:100%" name="observaciones"></textarea>
           </div>
          </div>
          <div class="table-responsive">
          <table class="table table-striped">
          <thead class="thead-white">
          <tr>
          <th class=""># Orden</th>
          <th class=""># Factura</th>
          <th class="">Total</th>
          <th class=""></th>
          <th class="">Restante</th>
          </tr>
          </thead>
          <tbody>
            {{-- @foreach ($pagos as $pago)
              <tr>
              <td scope="row">{{ $pago->nro_orden }}</td>
              <td scope="row">{{ $pago->nro_factura }}</td>
              <td scope="row">{{ $pago->total }}</td>
              <td scope="row"><input type="checkbox" name="" value=""></td>
              <td scope="row">{{ $pago->restante }}</td>
              </tr>
            @endforeach --}}
          </tbody>
          </table>
          <button type="submit" class="btn btn-success col-md-12">Guardar</button>
          </div>
        </div>
            </form>
            <!--end::Form-->
        </div>

@endsection
