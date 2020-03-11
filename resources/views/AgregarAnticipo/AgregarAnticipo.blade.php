@extends('Layout')
<title>Agregar Anticipo</title>
@section('Content')

  <div class="container">
    {{-- <form class="" action="{{route('anticipo.store') }}" method="POST"> --}}
      @csrf
      <div class="row">
        <div class="col">
          <label for="">Fecha de Entrada</label>
          <input type="date" class="form-control" name=" " value="">
        </div>
        <div class="col">
          <label for="">Fecha de Promesa</label>
          <input type="date" class="form-control" name=" " value="">
        </div>
        <div class="col">
          <label for="">Anticipo</label>
          <select name="Anticipo" class="custom-select">
            <option value="" selected>Seleccionar</option>
            <option value="">Si</option>
            <option value="">No</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="">Método de Pago</label>
          <select name="formaDePago" class="custom-select">
            <option value="" selected>Seleccionar</option>
              {{-- @foreach ($metodos as $metodo)
                <option value="{{$metodo->nomb_forma_pago}}">{{$metodo->nomb_forma_pago}}</option>
              @endforeach --}}
          </select>
        </div>
        <div class="col">
          <label for="">Anticipo</label>
          <input type="number" class="form-control" name=" " value="">
        </div>
        <div class="col">
          <label for="">Fecha de Anticipo</label>
          <input type="date" class="form-control" name=" " value="">
        </div>
        <div class="col d-flex justify-Content-center">
          <button class="btn btn-success ml-2" style="margin-top: 12%;" type="button" name="button">+</button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="">Descripción</label>
          <input type="text" class="form-control" name=" " value="">
        </div>
      </div>
    </form>
    <hr>
    <div class="">
      <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
        <table class="kt-datatable__table" id="html_table" width="100%" style="display: block;">
          <thead class="kt-datatable__head">
            <tr class="kt-datatable__row" style="left: 0px;">
            <th data-field="Order ID" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 156px;">Tipo</span></th>
            <th data-field="Car Model" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 156px;">Importe</span></th>
            <th data-field="Color" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 156px;">Fecha</span></th>
            <th data-field="Deposit Paid" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 156px;">Observaciones</span></th>
          </tr>
        </thead>
			<tbody style="" class="kt-datatable__body">
        <tr data-row="0" class="kt-datatable__row" style="left: 0px;">
          <td data-field="Order ID" class="kt-datatable__cell"><span style="width: 156px;">SUMA</span></td>
          <td data-field="Car Model" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
          <td data-field="Color" class="kt-datatable__cell"><span style="width: 156px;"></span>Exp</td>
          <td data-field="Deposit Paid" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
          </tr>
          <tr data-row="0" class="kt-datatable__row" style="left: 0px;">
            <td data-field="Order ID" class="kt-datatable__cell"><span style="width: 156px;">CAMBIO</span></td>
            <td data-field="Car Model" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
            <td data-field="Color" class="kt-datatable__cell"><span style="width: 156px;"></span>Exp</td>
            <td data-field="Deposit Paid" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
          </tr>
          <tr data-row="0" class="kt-datatable__row" style="left: 0px;">
            <td data-field="Order ID" class="kt-datatable__cell"><span style="width: 156px;">POR PAGAR</span></td>
            <td data-field="Car Model" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
            <td data-field="Color" class="kt-datatable__cell"><span style="width: 156px;"></span>Exp</td>
            <td data-field="Deposit Paid" class="kt-datatable__cell"><span style="width: 156px;">Exp</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
  <div style="margin-top:10%; margin-left:25%;" class="col-lg-10 col-md-2">
   <form class="" action="{{-- A completar --}}" method="post">
     @csrf
    <div style="margin-bottom:2%;margin-left:4.5%; width:75%;" class="input-group">
     <div class="input-group-prepend">
      <label  style="display:flex;align-items:center" class="mb-0 mr-3" for="">Importe   </label>
       <span class="input-group-text">$</span>
     </div>
     <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0">
   </div>
 <div style="margin-bottom:2%; width:80%;" class="input-group">
   <div class="input-group-prepend">
     <label style="display:flex;align-items:center" class="mb-0 mr-3" for="">Descuento</label>
      <span class="input-group-text">$</span>
    </div>
    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0">
  </div>
 <div style="margin-bottom:2%; width:80%;" class="input-group">
   <div class="input-group-prepend">
     <label style="display:flex;align-items:center" class="mb-0 mr-3" for="">Sub - Total</label>
      <span class="input-group-text">$</span>
    </div>
    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0">
  </div>
   <div style="margin-bottom:2%; width:80%;" class="input-group">
     <div class="input-group-prepend">
      <label style="display:flex;align-items:center;" class="mb-0 ml-5 mr-4" for=""><input type="checkbox" value="1" onclick= "ganancia.disabled = !this.checked"> IVA</label>
        <span class="input-group-text">%</span>
      </div>
      <select class="form-control form-control" name="ganancia" value="{{-- @if(isset($producto->gos_producto_id)) {{$producto->ganancia}} @endif --}}" disabled>
      					<option selected="">Seleccionar</option>
      					<option>16</option>
      					<option>21</option>
      </select>
    </div>
    <div style="margin-bottom:2%; width:80%;" class="input-group">
      <div class="input-group-prepend">
        <label style="display:flex;align-items:center" class="mb-0 ml-5 mr-3" for="">Total</label>
         <span class="input-group-text">$</span>
       </div>
       <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0">
     </div>
     <button style="width:60%; margin-left:22%;" name="button" class="btn btn-success">Guardar</button>
</form>
</div>
</div>




  </div>

@endsection
