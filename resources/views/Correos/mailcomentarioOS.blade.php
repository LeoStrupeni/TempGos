<!DOCTYPE html>
<html>

<head>
    <style>
        .wrapper{
            width: 100%;  border-radius: 3px;
        }
         .header{
            background-color:  green;   text-align: center; margin-top: 4rem; height: 50px; padding-top: 2px; color:white;
         }
         .hi{
               text-align: center; margin-top: -1px; height: 50px; padding-top: 1px; color:black;
         }

         .footer{
            background-color: #17a2b8;   text-align: center;  margin-top: 0px;  height: 50px; padding-top: 2px; color:white;
         }
         .body{
             text-align:center; font-size: 15px;
         }
         .ff{
             text-align:left;
         }
        </style>
    <title>Pro Order Sistem - Refacciones</title>
</head>
<body>
      <div  class="wrapper">

        <div class="header">
            <h3>{{ $details['title'] }} </h3>
        </div>
        <div class="hi">
            <h3>¡Hola Tienes Un Nuevo Mensaje!</h3>
        </div>

       <div  style="width: 100%; border: solid #17a2b8 1px; margin-top: 15px;"></div>

        <div class="body">
          <small> {{ $details['body'] }}</small>
        </div>

        <div  style="width: 100%; border: solid #17a2b8 1px; margin-top: 15px;"></div>

        <div class="body">
            <a href="proordersistem.com.mx/orden-servicio-generada/{{$details['os']->gos_os_id}}">Ir A la Orden</a>
        </div>

        <div style="margin-left: 5px; padding-top:3rem;">
          <strong>Enviado por:  </strong> {{ $details['envio']->nombre_apellidos }}<br>
          <strong>Fecha envío: </strong> <?= date("Y-m-d H:i:s")  ?><br>
          <strong>Número de orden: </strong> {{ $details['os']->nro_orden_interno }}<br>
          <strong>Vehículo: </strong> {{ str_replace("|"," ",$details['os']->detallesVehiculo) }}<br>
          <?php
          $ase = explode("|",$details['os']->nomb_aseguradora_min); ?>
          <strong>Aseguradora: </strong> {{  $ase[0]}}<br>
          <strong># Reporte: </strong> {{ $details['os']->nro_reporte }}<br>
          <strong># Siniestro: </strong> {{ $details['os']->nro_siniestro }}<br>
          <strong># Póliza: </strong> {{ $details['os']->nro_poliza }}<br><br>
        </div>
        <div style="text-align:center;">
        <strong>Taller:  </strong> {{ $details['envio']->taller_nomb }}<br><br>
        <strong>Teléfono: </strong>  {{ $details['taller'][0]->taller_tel_principal}}<br>
        <strong>Email:  </strong> {{ $details['taller'][0]->correo_respuestas }}<br><br><br>
        </div>

        <div class="footer">
        &copy;Pro Order  <br> Todos Los Derechos Reservados
        </div>
      </div>
</body>
</html>
