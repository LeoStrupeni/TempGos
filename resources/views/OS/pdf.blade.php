@php

@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{$css}}">
    </head>
    <body style="font-size: 10px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4  pt-3">
                    <ul class="list-unstyled border text-right pb-5 pr-1">
                        <li style="font-size: 1.3em;">{{ $listataller->taller_nomb ?? ''}}</li>
                        <li style="font-size: 1.3em;">{{ $listataller->taller_tel_principal ?? ''}}</li>
                        <li style="font-size: 1.3em;">{{ $listataller->taller_direccion ?? ''}}</li>
                        <li style="font-size: 1.3em;">{{ $listataller->taller_municipio ?? ''}}</li>
                    </ul>
                </div>
                <div class="col-4 text-center py-1">
                    <img src="{{$logo ??''}}" alt="logo" style="max-width:150px;">
                </div>
                <div class="col-4  pt-4">
                    <ul class="pl-1 border list-unstyled text-left pb-5">
                        <li style="font-size: 1.3em;">{{$os->nombre ??''}} {{$os->apellidos ??''}}</li>
                        <li style="font-size: 1.3em;">{{$os->empresa ??''}}</li>
                        <li style="font-size: 1.3em;">{{$os->celular ??''}}</li>
                        <li style="font-size: 1.3em;"> Fecha de ingreso: {{$os->fecha_ingreso_v_os ??''}}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th colspan="7" class="p-1" style="font-size: 1.3em;"style="font-size: 1.2em;"><strong>Número de Orden: {{$number ??''}}</strong></th>
                        </tr>
                        <tr class="text-center">
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marca<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelo<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_anio!=null): ?>{{$taller_conf_vehiculo->nomb_anio ??''}}<?php else: ?>Año<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_vehiculo->nomb_color!=null): ?>{{$taller_conf_vehiculo->nomb_color ??''}}<?php else: ?>Color<?php endif; ?></strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong># de <?php if ($taller_conf_vehiculo->nomb_placa!=null): ?>{{$taller_conf_vehiculo->nomb_placa ??''}}<?php else: ?>Placa<?php endif; ?></strong></th>
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
                            <td colspan="2" class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?>{{$taller_conf_ase->nomb_campo_poliza ??''}}<?php else: ?>Poliza<?php endif; ?>:</strong> {{$os->nro_poliza ??''}}</td>
                            <td colspan="1" class="p-1" style="font-size: 1.3em;"><strong><?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?>{{$taller_conf_ase->nomb_campo_siniestro ??''}}<?php else: ?>Siniestro<?php endif; ?>:</strong> {{$os->nro_siniestro ??''}}</td>
                            <td colspan="2" class="p-1" style="font-size: 1.3em;"><strong>Daño:</strong> {{$os->tipo_danio ??''}}</td>
                            <td colspan="1" class="p-1" style="font-size: 1.3em;"><strong>Estatus:</strong> {{$os->estado_expediente ??''}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="p-1" style="font-size: 1.3em;"><strong>Interiores</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>Si</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>No</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaInteriores as $interior)
                            <tr class="text-center">
                                <td class="p-1" style="font-size: 1.3em;">{{$interior->nomb_parte_vehiculo}}</td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $interior->revisada=='1' ? 'checked' : ''}} style="margin-top: -15%; font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $interior->revisada=='0' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="p-1" style="font-size: 1.3em;"><strong>Motor</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>Si</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>No</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaMotores as $motor)
                            <tr class="text-center">
                                <td class="p-1" style="font-size: 1.3em;">{{$motor->nomb_parte_vehiculo}}</td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $motor->revisada=='1' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $motor->revisada=='0' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="p-1" style="font-size: 1.3em;"><strong>Exteriores</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>Si</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>No</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaExteriores as $exterior)
                            <tr class="text-center">
                                <td class="p-1" style="font-size: 1.3em;">{{$exterior->nomb_parte_vehiculo}}</td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $exterior->revisada=='1' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $exterior->revisada=='0' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="p-1" style="font-size: 1.3em;"><strong>Cajuela</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>Si</strong></th>
                                <th class="p-1" style="font-size: 1.3em;"><strong>No</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaCajuela as $cajuela)
                            <tr class="text-center">
                                <td class="p-1" style="font-size: 1.3em;">{{$cajuela->nomb_parte_vehiculo}}</td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $cajuela->revisada=='1' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                                <td class="p-1" style="font-size: 1em;"><input type="checkbox" {{ $cajuela->revisada=='0' ? 'checked' : ''}} style="margin-top: -15%;font-size:15px;padding-bottom:-5%;padding-top:-5%;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row my-3">                
                <div class="col-1" style="padding-left: 3rem;" >
                    <img style="width:45px; height:150px; margin-top: 9px;" src="{{$medidor}}" >
                </div>
                <div class="col-2 py-2 align-self-end">
                  <div class="bd-highlight" style="max-width: 6rem; margin-left: -10px;  padding-left: 1rem;">
                             
                 
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>16): ?>visibility: initial <?php endif; ?> ; width: 4.25rem;  height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm bg-success text-light"  >F</button><br>
                                       
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>15): ?>visibility: initial <?php endif; ?> ; width: 3.75rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm bg-success text-light"  >7/8</button><br>
                    
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>14): ?>visibility: initial <?php endif; ?> ; width: 3.25rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-info  " >6/8</button><br>
                   
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>13): ?>visibility: initial <?php endif; ?> ; width: 2.75rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-info  " >5/8</button><br>
                    
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>12): ?>visibility: initial <?php endif; ?> ; width: 2.25rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-info  " >4/8</button><br>
                    
                    <button i type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>11): ?>visibility: initial <?php endif; ?> ; width: 1.75rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-info  " >3/8</button><br>
                
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>10): ?>visibility: initial <?php endif; ?> ; width: 1.25rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-warning text-light "  >2/8</button><br>
                    
                    <button  type="button" style="visibility: hidden;<?php if ($idinventario->gos_vehiculo_medidor_gas_id>9): ?>visibility: initial <?php endif; ?>  ; width: .75rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-warning text-light "  >1/8</button><br>
                               
                    <button  type="button" style="visibility: initial; width: .25rem; height:12.5px; padding: 0px!important;    font-size: .4rem;" class="btn btn-sm btn-danger  "  >E</button>                 

                  </div>
                </div>
                <div class="col-6 " style="    margin-top: -100px;">
                        <img src="{{$carroceria}}" alt="Carroceria" style="max-width:400px;">
                        <img src="{{$carroceria2}}" alt="Carroceria" style="max-width:400px; margin-top: -230px;">
                </div>
                <div class="col-3">
                    <p class="border pb-2 pl-1"style="font-size: 1.3em;"><small style="color: gray;font-size: 1em;">Comentarios:</small><br><br>{{$comentario->comentarios ??''}}</p>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th class="p-1" style="font-size: 1.3em;"><strong>Nombre</strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong>Descripcion</strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong>Cantidad</strong></th>
                            <th class="p-1" style="font-size: 1.3em;"><strong>Precio Venta</strong> </th>
                            <th class="p-1" style="font-size: 1.3em;"><strong>Total</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($listaEtapas)
                        @foreach($listaEtapas as $etapa)
                        <tr class="text-center">
                            <td class="p-1" style="font-size: 1.3em;"></td>
                            <td class="p-1" style="font-size: 1.3em;"></td>
                            <td class="p-1" style="font-size: 1.3em;"></td>
                            <td class="p-1" style="font-size: 1.3em;"></td>
                            <td class="p-1" style="font-size: 1.3em;"></td>
                        </tr>
                        @endforeach
                        @endisset
                        <tr class="text-center">
                            <td colspan="3" rowspan="3" class="p-1 align-middle">{{$totalletra ??''}} 00/100 M.N.</td>
                            <td class="p-1" style="font-size: 1.3em;">Subtotal</td>
                            <td class="p-1" style="font-size: 1.3em;">$ <?php echo number_format($os->subtotal, 2); ?></td>
                        </tr>
                        <tr class="text-center">
                            <td class="p-1" style="font-size: 1.3em;">IVA</td>
                            <td class="p-1" style="font-size: 1.3em;">{{$os->iva   ?? '16 %'}}</td>
                        </tr>
                        <tr class="text-center">
                            <td class="p-1" style="font-size: 1.3em;">Total</td>
                            <td class="p-1" style="font-size: 1.3em;">$ <?php echo number_format($totalF, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row my-3">
                <div class="col-10 offset-1 text-center">
                    <p  style="font-size: 1.3em;" class="justify-content-around">Nota: Sin este presente comprobante no se entrega la unidad. La empresa no se hace responsable del mal uso que se le dé a este comprobante.
                        <br>La empresa no se hace responsable por objetos o daños no manifestados en la recepción del vehículo.
                        <br>Después de dos días terminado el trabajo, causara pensión.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-1 text-center">
                    <img src="{{$firma1}}" alt="Firma Encargado" style="max-height: 200px;max-width: 200px;">
                    <div style="font-size: 1.3em;" class="mt-1 border-top text-center"><small style="font-size: 1.3em;">Firma del taller</small></div>
                </div>
                <div class="col-4 offset-2 text-center">
                    <img src="{{$firma2}}" alt="Firma Encargado" style="max-height: 200px;max-width: 200px;">
                    <div style="font-size: 1.3em;" class="mt-1 border-top text-center"><small style="font-size: 1.3em;">Firma del cliente</small></div>
                </div>
            </div>
        </div>
    </body>
</html>
