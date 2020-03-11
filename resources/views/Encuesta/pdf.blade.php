@php

@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr">
<title>Pro Order</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{$css}}">
        
    </head>
    <body style="font-size: 10px;">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-4  ">
                    <ul class="list-unstyled border text-left pl-1">
                    <?php $fecharemisionenc = $recop->fecha_encuesta; $fecharemisionenc = date("Y-m-d");?>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold">Datos de Encuesta </span></li><br>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold">Número: </span># {{$recop->gos_os_encuesta_id}}</li><br>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold">Fecha y hora de emisión: </span>{{$fecharemisionenc}}</li><br>	
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Nombre: </span>{{$encuesta->nombre_encuesta}}</li><br>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?>: </span>{{$detaseg->empresa}}</li><br>	
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;"></li>
                    </ul>
                </div>
                <div class="col-3 text-center">
                    <img src="{{$logo ??''}}" alt="logo" style="max-width:150px;">
                    <!-- <img src="{{$logoproorder ??''}}" alt="logo" style="max-width:150px;"> -->
                </div>
                <div class="col-4  ">
                    <ul class="list-unstyled border text-left pl-1">
                    <?php $fechaingreso = $OSProceso[0]->fecha_ingreso_v_os; $fechaingreso = date("Y-m-d");
                    $fechapromesa = $OSProceso[0]->fecha_promesa_os; $fechapromesa = date("Y-m-d");
                    $fechaterminado = $OSProceso[0]->fecha_terminado; $fechaterminado = date("Y-m-d");
                    $fechaentregado = $OSProceso[0]->fecha_entregado; $fechaentregado = date("Y-m-d");
                    
                    ?>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold">Datos del Cliente </span></li>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Nombre: </span>{{$os->nombre ??''}} {{$os->apellidos ??''}}</li>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Teléfono: </span> {{$os->celular ??''}}</li><br>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold">Fechas Orden de servicio </span></li>
                        
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Ingreso a reparacion:  </span>{{ $fechaingreso ?? '' }} </li>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Fecha promesa:  </span>{{($fechapromesa == 0) ? '':$fechapromesa }} </li>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Fecha terminado:  </span>{{$fechaterminado ?? '' }} </li>
                        <li style="font-size: 1.2em;"><span style="font-weight:bold;">Fecha entregado:  </span>{{$fechaentregado ?? '' }} </li>
                    </ul>
                </div>
                
            </div>
            <div class="table-responsive p-1 pt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th colspan="7" class="p-1" style="font-size: 1.3em;"style="font-size: 1.2em;"><strong>Número de Orden: {{$numorden ??''}}</strong></th>
                        </tr>
                        <tr class="text-center">
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marcas<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelos<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_anio!=null): ?>{{$taller_conf_vehiculo->nomb_anio ??''}}<?php else: ?>Año<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_color!=null): ?>{{$taller_conf_vehiculo->nomb_color ??''}}<?php else: ?>Color<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong># de <?php if ($taller_conf_vehiculo->nomb_placa!=null): ?>{{$taller_conf_vehiculo->nomb_placa ??''}}<?php else: ?>Placa<?php endif; ?></strong></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong>Kilometraje</strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong># de Serie</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="p-1" style="font-size: 1.3em;">{{$os->marca_vehiculo ??''}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->modelo_vehiculo ??''}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->anio_vehiculo ??''}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->nomb_color ??''}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->placa ??''}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->kilometraje ?? '0'}}</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->nro_serie ??''}}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1" class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?>:</strong> {{$os->empresa ??''}}</td>
                            <td colspan="2" class="p-1" style="font-size: 1.3em;"><strong>Póliza:</strong> {{$os->nro_poliza ??''}}</td>
                            <td colspan="1" class="p-1" style="font-size: 1.3em;"><strong>Siniestro:</strong> {{$os->nro_siniestro ??''}}</td>
                            <td colspan="2" class="p-1" style="font-size: 1.3em;"><strong>Daño:</strong> {{$os->tipo_danio ??''}}</td>
                            <td colspan="1" class="p-1" style="font-size: 1.3em;"><strong>Estatus:</strong> {{$os->estado_expediente ??''}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            
          
            <div class="">
                
              <form id="encuestaOs-form"  action="/Orden-terminada/Encuesta/respuestaEncuesta" method="post" >
              @CSRF
                    <!-- Preguntas encuesta -->       
              
                <div class="form-group" >
                    <?php if ($recop->contesto_encuesta== 0): ?> 
                   
                        <div class="" style="overflow: wrap" >
                            <table class="table table-bordered" >
                                <thead>
                                    <tr class="text-center">
                                        <th class="p-1" colspan="2"  style="font-size: 1.3em;"><strong>Encuesta Sin Respponder</strong></th>                                        
                                    </tr>
                                </thead>                            
                            </table>
                        </div>
                     
                        <?php else: ?>
                        @if(isset($preguntasenc))
                        @foreach($preguntasenc as $preg)
                            <div class="" style="overflow: wrap" >
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr class="text-center">
                                        <th></th>
                                            <th class="p-1" colspan="2"  style="font-size: 1.3em;"><strong>{{$preg->pregunta}}</strong></th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($recopitem))
                                    @foreach ($recopitem as $res)
                                        <tr class="text-center">  
                                            <?php if ($res->gos_enc_preguntas_id == $preg->gos_encuesta_pregunta_id): ?> 
                                            <td class="pb-1" style="font-size: 1em; width:10%; -webkit-box-align: center; " >
                                            <input type="checkbox" {{ $res->gos_enc_preguntas_id == $preg->gos_encuesta_pregunta_id ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>                            
                                            <td class="p-1" style="font-size: 1.3em; " >
                                            {{$res->tipo_respuestas}}</td>
                                            <?php endif; ?>  
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                        @endif
                    <?php endif; ?>
               
                </div>
                <!-- end encuesta -->
                <!-- Comentarios -->                          
               
                    <div class=""autosize="1" style="overflow: wrap" >
                        <table class="table table-bordered" >
                            <thead>
                                <tr class="text-center">
                                    <th class="p-1" colspan="2"  style="font-size: 1.3em;"><strong>Comentarios</strong></th>                                        
                                </tr>
                            </thead> 
                            <tbody>
                            <td class="p-3" style="font-size: 1.3em;">{{$recop->comentario_encuesta ?? ''}}</td>
                            </tbody>                           
                        </table>
                    </div>
                  <!--  Firma del Cliente  -->         
                <div class="row">
                    
                    <div class="col-4 offset-4 text-center">
                        <img src="{{$firmacliente ?? '' }}" alt="Firma Encargado" style="max-height: 200px;max-width: 200px;">
                        <div style="font-size: 1.3em;" class="mt-1 border-top text-center"><small style="font-size: 1.3em;">Firma del cliente</small></div>
                    </div>
                </div>
                
                    <input id="gos_os_id" name="gos_os_id" type="hidden" value="{{$gos_os_id}}">
                    <input id="gos_aseguradora_id" name="gos_aseguradora_id" type="hidden" value="{{$gos_aseguradora_id}}">
                    <input id="gos_encuesta_id" name="gos_encuesta_id" type="hidden" value="{{$encuesta->gos_encuesta_id}}">

               
               
              </form>    
                
            </div>
          

        </div>
    </body>
   

</html>
