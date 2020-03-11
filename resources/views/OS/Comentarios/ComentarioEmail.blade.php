<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="gos/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid rounded" style="background:#fff;border:1px solid rgba(30, 30, 45, 0.5);padding:0;">
      <header style="background:#09B180;" class="rounded-top">
        <div style="text-align:center;">
          <h1 style="color:#F2F3F8;">Comentario Nuevo</h1>
        </div>
      </header>
      <br>
      <div class="container">
        <div style="text-align:center;">
          <h3>¡Hola, buen día!</h3>
        </div>
        <br>
        <div style="text-align:center;">
          <h6 style="text-align:center;font-weight: 200;">Favor de actualizar la bandeja ya que la misma tiene fecha de entrega del día de hoy.</h6>
        </div>
        <br>
        <br>
        <div style="text-align:center;">
          <h5>Detalles</h5>
        </div>
        <br>
        <div class="">
          <div class="col-12" style="text-align:left;">
            <h6>Enviado por:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($empleado) {{$empleado->nomb_empleado}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Fecha de Envío:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($fecha_envio) {{$fecha_envio->update_at}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Prioridad:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($prioridad) {{$cliente->telefono}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Personas:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($cliente) {{$cliente->nomb_cliente}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Número de Orden:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($orden) {{$orden->orden_id}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Vehículos:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($vehiculo) {{$vehiculo->nomb_vehiculo}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6>Aseguradora:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($aseguradora) {{$aseguradora->empresa}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6># Siniestro:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($siniestro) {{$siniestro->siniestro_id}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6># Poliza:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($poliza) {{$poliza->poliza_id}} @endisset</h6>
          </div>
          <div class="col-12" style="text-align:left;">
            <h6># Reporte:</h6><h6 style="font-weight: 200;margin-left:1%;">@isset($reporte) {{$reporte->reporte_id}} @endisset</h6>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div style="text-align:center;">
        <a href="{{isset($cliente)? $cliente->url: '' }}"><button type="button" class="btn btn-success">Ver Orden</button></a>
      </div>
      <br>
    </div>
  </body>
</html>
