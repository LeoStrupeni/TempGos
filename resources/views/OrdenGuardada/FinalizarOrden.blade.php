@extends('Layout')
<title>Finalizar Orden</title>
@section('Content')
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <div class="container">
    <h4>Orden Guardada</h4>
    <hr>
    <br>
    <div class="col-lg-3 col-md-8" style="display:inline-block;">
      <div class="d-flex justify-content-center">
        <img src="/img/WhatsApp.png" alt="" style="width: 15%;">
        <h5 style="margin-top:6px;">Enviar WhatsApp</h5>
      </div>
      <br>
      <form class="" action="{{ route('envio_mensaje.store') }}" method="POST">
        <div class="row" style="padding: 0;">
          <input type="datetime-local" class="form-control" name="telefono" value="{{$envio_mensaje->telefono}}">
        </div>
        <br>
        <div class="d-flex justify-content-center">
          <input type="checkbox" name="" value="{{$envio_mensaje->send}}">
          <p style="margin-top:-2px; margin-left:1px;">Enviar SMS</p>
        </div>
        <div class="" style="padding: 0;">
          <button type="submit" style="width: -webkit-fill-available;" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
    <div class="col-lg-8 col-sm-12 row" style="display:inline-block;">
        <img src="/img/phoneCover.png" alt="" style="width:40%; margin-left:5%;">
        <p style="color: #fff;position:absolute;margin-top:-37%;margin-left:12%;width:26%;">
          Hola {{$mensaje->gos_cliente_id->nomb_cliente}}, le informamos que su {{$mensaje->gos_vehiculo_id->nomb_vehiculo}} {{$mensaje->gos_vechiculo_id->nomb_marca}} está listo.
          Fecha de entrega: {{$mensaje->fecha_de_entrega}}. Hora: {{$mensaje->hora}}. Dudas al {{$taller->taller_tel_principal ?? $taller->correo_respuestas }}. Gracias por elegirnos.</p>
    </div>
  </div>

@endsection
