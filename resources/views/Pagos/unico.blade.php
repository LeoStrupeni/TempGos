@extends('Layout')
<title>Pago unico</title>
@section('Content')

  <div class="kt-portlet">
    <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Facturacion complemento de pagos
      </h3>
    </div>
    </div>
    <form class="kt-form kt-form--label-right" action="{{-- route('pagos-unicos.create') --}}" method="post">
      @csrf
    <div class="kt-portlet__body">
      <div class="form-group">
        <p>Estas seguro de generar una nueva Factura CFDI para esta venta? <br>
        Recuerda que se consumira un timbre fiscal cada vez que realices esta accion.<br>
        Automaticamente tu cliente recibira una copia de la Factura generada(Xml y Pdf) en su correo electronico</p>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputState">Importe a pagar</label>
          <input type="text" name="importe" class="form-control" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputState">Por pagar</label>
          <input type="text" name="pago" class="form-control" placeholder="">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputState">Forma de pago</label>
          <select id="inputState" name="forma" class="form-control">
            {{-- @foreach ($pagos as $pago)
              <option value="{{ $pago->fecha_de_pago }}">{{ $pago->fecha_de_pago }}</option>
            @endforeach --}}
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="inputState">Fecha de pago</label>
          <select id="inputState" name="fecha" class="form-control">
            {{-- @foreach ($pagos as $pago)
              <option value="{{ $pago->forma_de_pago }}">{{ $pago->forma_de_pago }}</option>
            @endforeach --}}
          </select>
        </div>
      </div>
    <button type="submit" class="btn btn-success col-md-12">Guardar</button>
  </div>
      </form>
      <!--end::Form-->
  </div>

@endsection
