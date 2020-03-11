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
         .timg{
               text-align: center; margin-top: -1px; height: 6rem; padding-top: 1px; color:black;
         }
         .footer{
            background-color: #17a2b8;   text-align: center;  margin-top: 0px;  height: 40px; padding-top: 2px; color:white;
         }
         .body{
             text-align:center;
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
            <h3>¡Hola!</h3>
        </div>
        <div class="body">
          <small> {{ $details['body'] }}</small>
        </div>
        <div class="hi">
            <h5>Estimado proveedor, solicitamos de tu apoyo para el surtido de las partes asignadas.</h5>
        </div>
        <div class="table-responsive p-1 center" style="margin-top: 10px;">
                    <table class="table table-sm table-hover" id="dt-Refacciones">
                        <thead class="thead-light" style="background-color:rgb(39, 57, 92); color:white;">
                            <tr style="width:100%;">
                                <th  style="text-align: center;">- Consecutivo -</th>
                                <th  style="text-align: center;"style="width:30%;">- Nombre -</th>
                                <th  style="text-align: center;" >- # Parte -</th>
                                <th   style="text-align: center;">- Observaciones -</th>
                                <th  style="text-align: center;">- Proveedor -</th>
                                <th  style="width:30%;">- Fechas -</th>
                                <th  style="text-align: center;">- Estatus -</th>
                                <th  style="text-align: center;">- Dias -</th>
                            </tr>
                        </thead>
                    <tbody>
                       <?php $hoy = date("Y-m-d H:i:s"); ?>
                    @foreach($details['refacciones'] as $key => $refacciones)
                      <tr>
                        <td style="text-align: center;" >{{$key+1}}</td>
                        <td style="text-align: center;">{{$refacciones->nombre}}</td>
                        <td style="text-align: center;">{{$refacciones->nro_parte}}</td>
                        <td style="text-align: center;">{{$refacciones->observaciones}}</td>
                        <td style="text-align: center;">{{$refacciones->nombreProveedor}}</td>
                        <?php
                          $fechas =  explode("|",$refacciones->fechas);
                          $fechaA = date("Y-m-d",strtotime($fechas[2]));
                          $fechaP = date("Y-m-d",strtotime($fechas[1]));
                        ?>
                        <td style="text-align: center;">Fecha Asignado: {{$fechaA}}<br>Fecha Promesa: {{$fechaP}}</td>
                        <td style="text-align: center;">{{$refacciones->gos_os_refaccion_estatus}}</td>
                        <td style="text-align: center;"><strong>{{ round((strtotime($fechaP) - strtotime($hoy))/60/60/24)}}</strong></td>
                      </tr>
                    @endforeach
                    </tbody>
                    </table>

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
        <div class="timg">
         <img src="http://dev.proordersistem.com.mx/storage/{{$details['taller'][0]->taller_lototipo}}" alt="" style="height: 3rem;">

        </div>
        <div class="footer">
        &copy;Pro Order  <br> Todos Los Derechos Reservados
        </div>

      </div>
</body>
</html>
