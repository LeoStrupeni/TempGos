@extends('Layout')
<title>Orden</title>
@section('Content')

<div class="container">
  <h4>Orden Guardada</h4>
  <hr>
  <br>
  <form class="" action="{{ isset($mensaje) : route('mensaje.store') }}" method="POST">
    <div class="d-flex justify-content-around">
      <img src="/img/whatslogo.png" alt="" style="width: 20%;">
    </div>
    <br>
    <div class="d-flex justify-content-around">
        <input type="text" class="form-control" style="width: 25%; text-align: center;" name="telefono" value="{{$mensaje->telefono}}" placeholder="WhatsApp">
    </div>
    <br>
    <div class="d-flex justify-content-around">
        <button type="sumbit" class="btn btn-success">Continuar</button>
    </div>
  </form>
</div>

@endsection
